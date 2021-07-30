<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\TypeQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Traits\SysLog as TraitsSysLog;
use Illuminate\Support\Facades\File;


class QualificationsController extends Controller
{
    //
    use TraitsSysLog;
    public function viewQualifications(){
        try {
            $type_qualification = TypeQualification::where('state_delete', 0)->get();
            return view('admin.qualifications.qualifications')->with(compact('type_qualification'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getDataQualification(){
        try {
            $data = Qualification::with(['TypeQualification'])->where('state_delete', 0)
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
    public function registerQualification(Request $request){
        try {
            $request->validate([
                'type_academic' => 'required',
                'cant_hours' => 'required',
                'name_institution' => 'required',
                'name_course' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'certificate' => 'required|mimes:pdf|max:10485760'
            ]);
            $qualification = New Qualification();
            $qualification->candidate_id = session('candidate')->id;
            $qualification->type_qualifications_id = $request->type_academic;
            $qualification->cant_hours = $request->cant_hours;
            $qualification->name_institution = $request->name_institution;
            $qualification->title_course = $request->name_course;
            $qualification->date_start = $request->date_start;
            $qualification->date_end = $request->date_end;
            $qualification->syslog = $this->syslog_candidate(4, $request);
            $qualification->save();
            $qualification->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $qualification->id);
            $qualification->save();
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
    public function updateQualification(Request $request){
        try {
            $request->validate([
                'id' => 'required',
                'type_academic' => 'required',
                'cant_hours' => 'required',
                'name_institution' => 'required',
                'name_course' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'certificate' => 'exclude_if:certificate,undefined|nullable|mimes:pdf|max:10485760'
            ]);
            $qualification = Qualification::where('id', $request->id)->first();
            $qualification->type_qualifications_id = $request->type_academic;
            $qualification->cant_hours = $request->cant_hours;
            $qualification->name_institution = $request->name_institution;
            $qualification->title_course = $request->name_course;
            $qualification->date_start = $request->date_start;
            $qualification->date_end = $request->date_end;
            if($request->hasFile('certificate')){
                if($qualification->certificate_file_path != '' || !is_null($qualification->certificate_file_path)){
                    File::delete(public_path().$qualification->certificate_file_path);
                }
                $qualification->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $qualification->id);            
            }
            $qualification->syslog = $qualification->syslog. ' | ' .$this->syslog_candidate(2, $request);
            $qualification->save();
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

    public function deleteQualification(Request $request){
        try {
            $qualification = Qualification::where('id', $request->id)->first();
            $qualification->state_delete = 1;
            $qualification->syslog = $qualification->syslog. ' | ' .$this->syslog_candidate(3, $request);
            /*ELIMINAR ARCHIVOS DESPUES DE SER ELIMINADOS(OPCIONAL) ACIVADO */
            if($qualification->certificate_file_path != '' || !is_null($qualification->certificate_file_path)){
                File::delete(public_path().$qualification->certificate_file_path);
            }
            /*ELIMINAR ARCHIVOS DESPUES DE SER ELIMINADOS(OPCIONAL) ACIVADO */
            $qualification->save();
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
        $file->move(public_path().'/files/users/user_'.$id.'/qualifications', $name);
        return '/files/users/user_'.$id.'/qualifications/'.$name;
        
    }
    public function viewDocument(Request $request){
        $url = Crypt::decrypt($request->id);
        return response()->file(public_path().$url);
    }
}
