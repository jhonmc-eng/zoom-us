<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Job;
use App\Models\Modality;
use App\Models\StateJob;
use Illuminate\Support\Facades\Crypt;
//use Carbon\Carbon;

class ConvocatoriaController extends Controller
{
    //
    use TraitsSysLog;
    
    public function view(){
        //dd(Carbon::now()->toDateTimeString());
        try {
            $modalitys = Modality::where('state_delete', 0)->get();
            $states = StateJob::where('state_delete', 0)->get();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ],500);
        }
        return view('admin.jobs.jobs')->with(compact('modalitys', 'states'));
    }

    public function listJobs(){
        try {
            $data = Job::with(['modality', 'stateJob'])->where('state_delete', 0)->orderBy('id', 'DESC')->get()->each(function($item){
                $item->token = Crypt::encrypt($item->id);
            });
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
            'inputBaseFile' => 'required|file|max:10485760',
            'inputScheduleFile' => 'required|file|max:10485760',
            'inputProfileFile' => 'required|file|max:10485760',
            'inputDescription' => 'required',
            'inputFunction' => 'required',
            'inputProfile' => 'required'
        ]);
        //dd($request);
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

    public function editJob(Request $request, $id){
        $request->validate([
            'inputName' => 'required',
            'inputModality' => 'required',
            'inputState' => 'required',
            'inputNumber' => 'required',
            'inputDatePublication' => 'required',
            'inputDatePostulation' => 'required',
            'inputBaseFile' => 'nullable|max:10485760',
            'inputScheduleFile' => 'nullable|max:10485760',
            'inputProfileFile' => 'nullable|max:10485760',
            'inputDescription' => 'required',
            'inputFunction' => 'required',
            'inputProfile' => 'required'
        ]);
        try {
            $job = Job::where('id', $id)->first();
            $job->title = $request->inputName;
            $job->modality_id = $request->inputModality;
            $job->state_job_id = $request->inputState;
            $job->number_jobs = $request->inputNumber;
            $job->date_publication = $request->inputDatePublication;
            $job->date_postulation = $request->inputDatePostulation;
            if($request->hasFile('inputBaseFile')) {
                if($request->file('inputBaseFile')->getClientOriginalExtension() != "pdf"){
                    return response()->json([
                        'success' => false,
                        'message' => 'Ocurrio un error',
                        'error' => 'El archivo no es un PDF',
                        'type' => 'crogrnama',
                        'extension' => $request->file('inputScheduleFile')->getClientOriginalExtension()
                    ], 400);
                }
                File::delete(public_path().$job->bases);
                $job->bases = $this->uploadArchive($request->file('inputBaseFile'), $job->id, "base");
            }
            if($request->hasFile('inputScheduleFile')) {
                if($request->file('inputScheduleFile')->getClientOriginalExtension() != "pdf"){
                    return response()->json([
                        'success' => false,
                        'message' => 'Ocurrio un error',
                        'error' => 'El archivo no es un PDF',
                        'type' => 'crogrnama',
                        'extension' => $request->file('inputScheduleFile')->getClientOriginalExtension()
                    ], 400);
                }
                File::delete(public_path().$job->schedule);
                $job->schedule = $this->uploadArchive($request->file('inputScheduleFile'), $job->id, "schedule");
            }
            if($request->hasFile('inputProfileFile')) {
                
                if($request->file('inputProfileFile')->getClientOriginalExtension() != "pdf"){
                    return response()->json([
                        'success' => false,
                        'message' => 'Ocurrio un error',
                        'error' => 'El archivo no es un PDF',
                        'type' => 'crogrnama',
                        'extension' => $request->file('inputProfileFile')->getClientOriginalExtension()
                    ], 400);
                }
                File::delete(public_path().$job->profile);
                $job->profile = $this->uploadArchive($request->file('inputProfileFile'), $job->id, 'profile');
            }

            $job->description = $request->inputDescription;
            $job->functions = $request->inputFunction;
            $job->requirements = $request->inputProfile;
            $job->syslog = $job->syslog . ' | ' . $this->syslog_admin(2, $request);
            $job->save();
            return response()->json([
                'success' => TRUE,
                'message' => 'Convocatoria actualizada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function viewCandidates(Request $request){

    }

    public function viewJob(Request $request){
        $job = Job::with(['modality','stateJob','results'])->where('id', Crypt::decrypt($request->job_id))->first()->toArray();
        dd($job['results']);

        return response()->json($job);
        $job->bases = Crypt::encrypt($job->bases);
        $job->schedule = Crypt::encrypt($job->schedule);
        $job->profile = Crypt::encrypt($job->profile);
        //dd($job);
        return view('admin.jobs.viewJob')->with(compact('job'));
    }

    public function viewUploadDocuments($job_id){

    }

    public function viewBase(Request $request){
        $url = Crypt::decrypt($request->job_base);
        return response()->file(public_path().$url);
    }

    public function viewSchedule(Request $request){
        $url = Crypt::decrypt($request->job_schedule);
        return response()->file(public_path().$url);
    }

    public function viewProfile(Request $request){
        $url = Crypt::decrypt($request->job_profile);
        return response()->file(public_path().$url);
    }

    public function uploadArchive($request, $id, $type){
        
        $file = $request;
        $name = $type.'_'.time().'.'.$file->getClientOriginalExtension();
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
