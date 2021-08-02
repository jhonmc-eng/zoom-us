<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Experiencie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExperienciesController extends Controller
{
    //
    use TraitsSysLog;
    public function viewExperiencie(){
        try {
            return view('admin.experiencie.experiencie');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getDataExperiencies(){
        try {
            $data = Experiencie::where('state_delete', 0)
                    ->where('candidate_id', session('candidate')->id)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->each(function($item){
                        $item->certificate_file_path = Crypt::encrypt($item->certificate_file_path);
                    });
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function registerExperiencie(Request $request){
        try {
            $request->validate([
                'institution' => 'required',
                'boss' => 'required',
                'phone' => 'required',
                'charge' => 'required',
                'area' => 'required',
                'sector' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'functions' => 'required',
                'certificate' => 'required|mimes:pdf|max:10485760'
            ]);
            $experiencie = New Experiencie();
            $experiencie->candidate_id = session('candidate')->id;
            $experiencie->institution = $request->institution;
            $experiencie->boss = $request->boss;
            $experiencie->phone = $request->phone;
            $experiencie->charge = $request->charge;
            $experiencie->area = $request->area;
            $request->sector == 1 ? $experiencie->sector = 'PUBLICO' : $experiencie->sector = 'PRIVADO';
            $experiencie->date_start = $request->date_start;
            $experiencie->date_end = $request->date_end;
            $experiencie->functions = $request->functions;
            $experiencie->syslog = $this->syslog_candidate(4, $request);
            $experiencie->save();
            $experiencie->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'experiencie_file', $experiencie->id);
            $experiencie->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro ingresado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function updateExperiencie(Request $request){
        try {
            $request->validate([
                'id'=> 'required',
                'institution' => 'required',
                'boss' => 'required',
                'phone' => 'required',
                'charge' => 'required',
                'area' => 'required',
                'sector' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'functions' => 'required',
                'certificate' => 'exclude_if:certificate,undefined|nullable|mimes:pdf|max:10485760'
            ]);
            $experiencie = Experiencie::where('id', $request->id)->first();
            $experiencie->institution = $request->institution;
            $experiencie->boss = $request->boss;
            $experiencie->phone = $request->phone;
            $experiencie->charge = $request->charge;
            $experiencie->area = $request->area;
            $request->sector == 1 ? $experiencie->sector = 'PUBLICO' : $experiencie->sector = 'PRIVADO';
            $experiencie->date_start = $request->date_start;
            $experiencie->date_end = $request->date_end;
            $experiencie->functions = $request->functions;
            if($request->hasFile('certificate')){
                if($experiencie->certificate_file_path != '' || !is_null($experiencie->certificate_file_path)){
                    File::delete(public_path().$experiencie->certificate_file_path);
                }
                $experiencie->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $experiencie->id);            
            }
            $experiencie->syslog = $experiencie->syslog. ' | ' .$this->syslog_candidate(2, $request);
            $experiencie->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteExperiencie(Request $request){
        try {
            $experiencie = Experiencie::where('id', $request->id)->first();
            $experiencie->state_delete = 1;
            $experiencie->syslog = $experiencie->syslog. ' | ' .$this->syslog_candidate(3, $request);
            
            if($experiencie->certificate_file_path != '' || !is_null($experiencie->certificate_file_path)){
                File::delete(public_path().$experiencie->certificate_file_path);
            }
            
            $experiencie->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function uploadArchive($request, $id, $type, $academic){
        $file = $request;
        $name = $type.'_'.$academic.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path().'/files/users/user_'.$id.'/experiencie', $name);
        return '/files/users/user_'.$id.'/experiencie/'.$name;
        
    }
    public function viewDocument(Request $request){
        $url = Crypt::decrypt($request->id);
        return response()->file(public_path().$url);
    }
}
