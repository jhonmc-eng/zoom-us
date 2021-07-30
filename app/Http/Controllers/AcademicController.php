<?php

namespace App\Http\Controllers;
use App\Models\TypeAcademic;
use App\Models\Academic;
use App\Models\EducationLevel;
use Illuminate\Http\Request;
use App\Http\Traits\SysLog as TraitsSysLog;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
class AcademicController extends Controller
{
    //
    use TraitsSysLog;
    public function viewAcademic(){
        try {
            $typeAcademic = TypeAcademic::where('state_delete', 0)->get();
            $educationLevel = EducationLevel::where('state_delete', 0)->get();
            return view('admin.academic.academic')->with(compact('typeAcademic', 'educationLevel'));
        } catch (\Exception $e) {
            return response()->json([
                'sucess' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
        
    }

    public function getDataAcademic(){
        try {
            $data = Academic::with(['education_level', 'type_academic'])
                    ->where('state_delete', 0)
                    ->where('candidate_id', session('candidate')->id)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->each(function($item){
                        $item->certificate_file_path = Crypt::encrypt($item->certificate_file_path);
                        if($item->tuition_state){
                            $item->tuition_file_path = Crypt::encrypt($item->tuition_file_path);
                        }
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

    public function registerAcademic(Request $request){
        try {
            $request->validate([
                'study_center' => 'required',
                'type_academic' => 'required',
                'education_level' => 'required',
                'career' => 'required',
                'tuition_state' => 'required',
                'tuition_number' => 'exclude_if:tuition_state,false|required',
                'tuition_file' => 'exclude_if:tuition_state,false|required|mimes:pdf|max:10485760',
                'date_start' => 'required',
                'date_end' => 'required',
                'certificate' => 'required|mimes:pdf|max:10485760',
            ]);
            $academic = New Academic();
            $academic->candidate_id = session('candidate')->id;
            $academic->type_academic_id = $request->type_academic;
            $academic->education_level_id = $request->education_level;
            $academic->study_center = $request->study_center;
            $academic->career = $request->career;
            $academic->date_start = $request->date_start;
            $academic->date_end = $request->date_end;
            $request->tuition_state == 'true' ? $academic->tuition_state = true : $academic->tuition_state = false;
            $academic->syslog = $this->syslog_candidate(4, $request);
            $academic->save();
            if($request->tuition_state == 'true'){
                $academic->tuition_number = $request->tuition_number;
                $academic->tuition_file_path = $this->uploadArchive($request->file('tuition_file'), session('candidate')->id, 'tuition_file', $academic->id);
            }
            $academic->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $academic->id);
            $academic->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro ingresado exitosamente'
            ]);
            dd($request);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function updateAcademic(Request $request){
        try {
            //dd($request);
            $request->validate([
                'study_center' => 'required',
                'type_academic' => 'required',
                'education_level' => 'required',
                'career' => 'required',
                'tuition_state' => 'required',
                'tuition_number' => 'exclude_if:tuition_state,false|required',
                'tuition_file' => 'exclude_if:tuition_file,undefined|nullable|mimes:pdf|max:10485760',
                'date_start' => 'required',
                'date_end' => 'required',
                'certificate' => 'exclude_if:certificate,undefined|nullable|mimes:pdf|max:10485760',
            ]);
            //dd($request);
            $academic = Academic::where('id', $request->id)->first();
            $academic->type_academic_id = $request->type_academic;
            $academic->education_level_id = $request->education_level;
            $academic->study_center = $request->study_center;
            $academic->career = $request->career;
            $academic->date_start = $request->date_start;
            $academic->date_end = $request->date_end;
            $request->tuition_state == 'true' ? $academic->tuition_state = true : $academic->tuition_state = false;
            $academic->syslog = $this->syslog_candidate(2, $request);
            //$academic->save();
            if($request->tuition_state == 'true'){
                $academic->tuition_number = $request->tuition_number;
                if($request->hasFile('tuition_file')){
                    if($academic->tuition_file_path != '' || !is_null($academic->tuition_file_path)){
                        File::delete(public_path().$academic->tuition_file_path);
                    }
                    $academic->tuition_file_path = $this->uploadArchive($request->file('tuition_file'), session('candidate')->id, 'tuition_file', $academic->id);
                }
            }else{
                $academic->tuition_number = null;
                if($academic->tuition_file_path != '' || !is_null($academic->tuition_file_path)){
                    File::delete(public_path().$academic->tuition_file_path);
                }
                $academic->tuition_file_path = '';
            }
            if($request->hasFile('certificate')){
                if($academic->certificate_file_path != '' || !is_null($academic->certificate_file_path)){
                    File::delete(public_path().$academic->certificate_file_path);
                }
                $academic->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $academic->id);            
            }
            //$academic->certificate_file_path = $this->uploadArchive($request->file('certificate'), session('candidate')->id, 'certificate_file', $academic->id);
            $academic->save();
            return response()->json([
                'success' => true,
                'message' => 'Registro actualizado exitosamente'
            ]);
            dd($request);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function deleteAcademic(Request $request){
        try {
            $academic = Academic::where('id', $request->id)->first();
            $academic->state_delete = 1;
            $academic->syslog = $academic->syslog. ' | ' .$this->syslog_candidate(3, $request);
            /*ELIMINAR ARCHIVOS DESPUES DE SER ELIMINADOS(OPCIONAL) ACIVADO */
            if($academic->certificate_file_path != '' || !is_null($academic->certificate_file_path)){
                File::delete(public_path().$academic->certificate_file_path);
            }
            if($academic->tuition_file_path != '' || !is_null($academic->tuition_file_path)){
                File::delete(public_path().$academic->tuition_file_path);
            }
            /*ELIMINAR ARCHIVOS DESPUES DE SER ELIMINADOS(OPCIONAL) ACIVADO */
            $academic->save();
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
        $file->move(public_path().'/files/users/user_'.$id.'/academic', $name);
        return '/files/users/user_'.$id.'/academic/'.$name;
        
    }
    public function viewDocument(Request $request){
        $url = Crypt::decrypt($request->id);
        return response()->file(public_path().$url);
    }
}
