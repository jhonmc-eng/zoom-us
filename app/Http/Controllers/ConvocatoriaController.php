<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Job;
use App\Models\Modality;
use App\Models\StateJob;
use Illuminate\Support\Facades\Crypt;
use App\Models\JobResult;
use App\Models\TypeResult;
use Illuminate\Contracts\Encryption\DecryptException;

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
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
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

    public function viewCandidates(Request $request, $id){
        
    }

    public function viewJob(Request $request){
        try {
            $id = Crypt::decrypt($request->job_id);
            $job = Job::with(['modality','stateJob','results'])->where('id', $id)->where('state_delete', 0)->first();
            $type_select = TypeResult::where('state_delete', 0)->orderBy('id', 'ASC')->get();
            $types = TypeResult::where('state_delete', 0)->orderBy('id', 'ASC')->get();
            //dd($types);
            foreach($types as $case){
                if($case->multiple == 0){
                    $data = JobResult::with(['typeResult'])->where([
                        ['state_delete','=',0],
                        ['job_id', '=', $id],
                        ['type_result_id', '=', $case->id]
                    ])->first();
                    if($data){
                        $case->file = $data;
                    }
                }else{
                    $data = JobResult::with(['typeResult'])->where([
                        ['state_delete','=',0],
                        ['job_id', '=', $id],
                        ['type_result_id', '=', $case->id]
                    ])->get();
                    if($data){
                        $case->file = $data;
                    }
                }
            }
            //dd($types);
            return view('admin.jobs.viewJob')->with(compact('job', 'types','type_select'));
        } catch (\Exception $e) {
            report($e);
        }
        
    }

    public function uploadDocuments(Request $request, $job_id){
        
        $request->validate([
            'type_document' => 'required',
            'file_document' => 'required|file|max:10485760',
            'date_publication' => 'required|date',
        ]); 

        try {
            $id = Crypt::decrypt($job_id);
            if($request->file('file_document')->getClientOriginalExtension() != 'pdf'){
                return response() ->json([
                    'success' => false,
                    'message' => 'Ocurrio un error',
                    'error' => 'El archivo no es un PDF'
                ]);
            }   
            $job_result = New JobResult();
            $job_result->type_result_id = $request->type_document;
            $job_result->job_id = $id;
            $job_result->date_publication = $request->date_publication;
            $job_result->path = 'path';
            $job_result->syslog = $this->syslog_admin(1, $request);
            $job_result->save();
            $job_result->path = $this->uploadDocument($request->file('file_document'), $id, $request->type_document);
            $job_result->save();
            return response()->json([
                'success' => true,
                'message' => 'Archivo subido correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function changeDocument(Request $request, $id){
        
        $request->validate([
            'type_document' => 'required',
            'file_document' => 'nullable|file|max:10485760',
            'date_publication' => 'required|date'
        ]); 
        
        try {
            $id = Crypt::decrypt($id);
            $result = JobResult::where([
                ['id', '=', $id]
            ])->first();
            if($request->hasFile('file_document')){
                if($request->file('file_document')->getClientOriginalExtension() != "pdf"){
                    return response()->json([
                        'success' => false,
                        'message' => 'Ocurrio un error',
                        'error' => 'El archivo no es un PDF',
                        'type' => 'crogrnama',
                        'extension' => $request->file('inputScheduleFile')->getClientOriginalExtension()
                    ], 400);
                }
                File::delete(public_path().$result->path);
                $result->path = $this->uploadArchive($request->file('inputScheduleFile'), $result->job_id, $request->type_document);
            }
            $result->type_document = $request->type_result_id;
            $result->date_publication = $request->date_publication;
            $result->save();
            return response()->json([
                'success' => true,
                'message' => 'Documento cambiado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }    
    }

    public function deleteDocument($id){
        try {
            $id = Crypt::decrypt($id);
            $data = JobResult::where('id', $id)->first();
            $data->state_delete = 1;
            $data->save();
            File::delete(public_path().$data->path);
            return response()->json([
                'Success' => true,
                'message' => 'Documento Eliminado Correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        } 
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

    public function viewResult(Request $request){
        $url = Crypt::decrypt($request->result);
        //dd($url);
        return response()->file(public_path().$url);
    }

    public function uploadArchive($request, $id, $type){
        $file = $request;
        $name = $type.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path().'/files/jobs/job_'.$id, $name);
        return '/files/jobs/job_'.$id.'/'.$name;
        
    }

    public function uploadDocument($request, $id, $type){
        $file = $request;
        $name = $type.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path().'/files/jobs/job_'.$id.'/results', $name);
        return '/files/jobs/job_'.$id.'/results/'.$name;
    }
    public function createDirectory($id){
        $path = public_path().'/files/jobs/job_'.$id;
        $candidates = public_path().'/files/jobs/job_'.$id.'/candidates';
        $results = public_path().'/files/jobs/job_'.$id.'/results';
        File::makeDirectory($path, $mode = 0777, true, true);
        File::makeDirectory($candidates, $mode = 0777, true, true);
        File::makeDirectory($results, $mode = 0777, true);
    }

}
