<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\OtherDocument;
use Illuminate\Support\Facades\File;

class TrainingController extends Controller
{
    use TraitsSysLog;
    public function viewTraining(){
        try {
            return view('admin.training.training');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getDataTrainings(){
        try {
            $data = OtherDocument::where('state_delete', 0)
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
    public function registerTraining(Request $request){
        try {
            $request->validate([
                'title' => 'required',
                'institution' => 'required',
                'date_emition' => 'required',
                'certificate' => 'required|mimes:pdf|max:10485760'
            ]);
            $training = New OtherDocument();
            $training->candidate_id = session('candidate')->id;
            $training->title = $request->title;
            $training->institution = $request->institution;
            $training->date_emition = $request->date_emition;
            $training->syslog = $this->syslog_candidate(4, $request);
            $training->save();
            $training->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $training->id);
            $training->save();
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
    public function updateTraining(Request $request){
        try {
            $request->validate([
                'id' => 'required',
                'title' => 'required',
                'institution' => 'required',
                'date_emition' => 'required',
                'certificate' => 'exclude_if:certificate,undefined|nullable|mimes:pdf|max:10485760'
            ]);
            $training = OtherDocument::where('id', $request->id)->first();
            $training->title = $request->title;
            $training->institution = $request->institution;
            $training->date_emition = $request->date_emition;
            if($request->hasFile('certificate')){
                if($training->certificate_file_path != '' || !is_null($training->certificate_file_path)){
                    File::delete(public_path().$training->certificate_file_path);
                }
                $training->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $training->id);            
            }
            $training->syslog = $training->syslog. ' | ' .$this->syslog_candidate(2, $request);
            $training->save();
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

    public function deleteTraining(Request $request){
        try {
            $training = OtherDocument::where('id', $request->id)->first();
            $training->state_delete = 1;
            $training->syslog = $training->syslog. ' | ' .$this->syslog_candidate(3, $request);
            /*ELIMINAR ARCHIVOS DESPUES DE SER ELIMINADOS(OPCIONAL) ACIVADO */
            if($training->certificate_file_path != '' || !is_null($training->certificate_file_path)){
                File::delete(public_path().$training->certificate_file_path);
            }
            /*ELIMINAR ARCHIVOS DESPUES DE SER ELIMINADOS(OPCIONAL) ACIVADO */
            $training->save();
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
        $file->move(public_path().'/files/users/user_'.$id.'/others', $name);
        return '/files/users/user_'.$id.'/others/'.$name;
        
    }
    public function viewDocument(Request $request){
        $url = Crypt::decrypt($request->id);
        return response()->file(public_path().$url);
    }
}
