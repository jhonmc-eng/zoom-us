<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Job;
use App\Models\Modality;
use App\Models\StateJob;
class ConvocatoriaController extends Controller
{
    //
    use TraitsSysLog;
    public function view(){
        try {
            $modalitys = Modality::where('state_delete', 0)->get();
            $states = StateJob::where('state_delete', 0)->get();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ],500);
        }
        return view('admin.convocatorias.convocatorias')->with(compact('modalitys', 'states'));
    }

    public function listJobs(){
        try {
            $data = Job::with(['modality', 'stateJob'])->orderBy('id', 'DESC')->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([

            ]);
        }
    }
    public function registerJob(Request $request){
        $request->validate([
            'inputName' => 'required',
            'inputModality' => 'required',
            'inputState' => 'required',
            'inputNumber' => 'required',
            'inputDatePublication' => 'required',
            'inputDatePostulation' => 'required',
            'inputBaseFile' => 'required|file|max:10000000',
            'inputScheduleFile' => 'required|file|max:10485760',
            'inputProfileFile' => 'required|file|max:10485760',
            'inputDescription' => 'required',
            'inputFunction' => 'required',
            'inputProfile' => 'required'
        ]);
        if($request->file('inputBaseFile')->getClientOriginalExtension() != "pdf"){
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => 'El archivo no es un PDF',
                'type' => 'bases',
                'extension' => $request->file('inputBaseFile')->getClientOriginalExtension()
            ], 400);
        }
        if($request->file('inputScheduleFile')->getClientOriginalExtension() != "pdf"){
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => 'El archivo no es un PDF',
                'type' => 'crogrnama',
                'extension' => $request->file('inputScheduleFile')->getClientOriginalExtension()
            ], 400);
        }
        if($request->file('inputProfileFile')->getClientOriginalExtension() != "pdf"){
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => 'El archivo no es un PDF',
                'type' => 'perfil',
                'extension' => $request->file('inputProfileFile')->getClientOriginalExtension()
            ], 400);
        }
        //$this->verifyPDF($request);
        /*$this->verifyPDF($request->file('inputScheduleFile'));
        $this->verifyPDF($request->file('inputProfileFile'));*/
        try {
            
            $job = New Job();
            $job->title = $request->inputName;
            $job->modality_id = $request->inputModality;
            $job->state_job_id = $request->inputState;
            $job->number_jobs = $request->inputNumber;
            $job->date_publication = $request->inputDatePublication;
            $job->date_postulation = $request->inputDatePostulation;
            $job->bases = '$request->inputBaseFile';
            $job->schedule = '$request->inputScheduleFile';
            $job->profile = '$request->inputProfileFile';
            $job->description = $request->inputDescription;
            $job->functions = $request->inputFunction;
            $job->requirements = $request->inputProfile;
            $job->syslog = $this->syslog_admin(1, $request);
            $job->save();
            $this->createDirectory($job->id);
            if($request->hasFile('inputBaseFile')) {
                $job->bases = $this->uploadArchive($request->file('inputBaseFile'), $job->id, "base");
            }
            if($request->hasFile('inputScheduleFile')) {
                $job->schedule = $this->uploadArchive($request->file('inputScheduleFile'), $job->id, "schedule");
            }
            if($request->hasFile('inputProfileFile')) {
                $job->profile = $this->uploadArchive($request->file('inputProfileFile'), $job->id, 'profile');
            }
            $job->save();
            return response()->json([
                'success' => TRUE,
                'message' => 'Convocatoria creada exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage() 
            ]);
        }
    }

    public function editJob(Request $request){

    }

    public function viewCandidates(Request $request){

    }

    public function viewJob($job_id){
        
    }

    public function viewUploadDocuments($job_id){

    }

    public function uploadArchive($request, $id, $type){
        $file = $request;
        $name = $type.'_'.time().'.'.$file->extension();
        $file->move(public_path().'/files/jobs/job_'.$id, $name);
        return '/files/jobs/job_'.$id.'/'.$name;
        
    }
    public function createDirectory($id){
        $path = public_path().'/files/jobs/job_'.$id;
        $candidates = public_path().'/files/jobs/job_'.$id.'/candidates';
        File::makeDirectory($path, $mode = 0777, true, true);
        File::makeDirectory($candidates, $mode = 0777, true, true);
    }

}
