<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Job;
use App\Models\JobOficine;
use App\Models\Modality;
use App\Models\StateJob;
use Illuminate\Support\Facades\Crypt;
use App\Models\JobResult;
use App\Models\Oficine;
use App\Models\TypeResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConvocatoriaController extends Controller
{
    //
    use TraitsSysLog;
    
    public function view(){
        try {
            $modalitys = Modality::where('state_delete', 0)->where('id', '!=', 2)->get();
            $states = StateJob::where('state_delete', 0)->get();
            $oficines = Oficine::where('state_delete', 0)->get();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ],500);
        }
        return view('admin.jobs.jobs')->with(compact('modalitys', 'states', 'oficines'));
    }
    public function viewPractices(){
        try {
            $states = StateJob::where('state_delete', 0)->get();
            $oficines = Oficine::where('state_delete', 0)->get();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ],500);
        }
        return view('admin.practices.practices')->with(compact('states', 'oficines'));
    }

    public function viewJobsCandidate(){
        try {
            return view('admin.jobs.jobsCandidate');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function viewPracticesCandidate(){
        try {
            return view('admin.practices.practicesCandidate');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function listJobsCandidate(){
        try {
            $data = Job::with(['stateJob','oficineCas'])
            ->leftJoin(
                DB::raw('(SELECT * FROM `postulations` WHERE `candidate_id` = '.session('candidate')->id.' AND `state_delete` = 0) `postulation_candidate`'),
                'postulation_candidate.job_id', 
                'jobs.id')->whereNull('postulation_candidate.id')
                ->where([
                    ['jobs.state_delete', 0],
                    ['jobs.date_publication', '<', Carbon::now()],
                    ['jobs.modality_id', '<>', 2]
                ])->select('jobs.*')->get()->each(function($item){
                    $item->oficineCas->oficine = $item->oficine($item->oficineCas->oficine_id);
                    $item->token = Crypt::encrypt($item->id);
                });
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function listPracticesCandidate(){
        try {
            $data = Job::with(['stateJob'])
            ->leftJoin(
                DB::raw('(SELECT * FROM `postulations` WHERE `candidate_id` = '.session('candidate')->id.' AND `state_delete` = 0) `postulation_candidate`'),
                'postulation_candidate.job_id', 
                'jobs.id')->whereNull('postulation_candidate.id')
                ->where([
                    ['jobs.state_delete', 0],
                    ['jobs.date_publication', '<', Carbon::now()],
                    ['jobs.modality_id', '=', 2]
                ])->select('jobs.*')->get()->each(function($item){
                    //$item->oficineCas->oficine = $item->oficine($item->oficineCas->oficine_id);
                    $item->token = Crypt::encrypt($item->id);
                });
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function listJobs(){
        try {
            $data = Job::with(['modality', 'stateJob','oficineCas'])
            ->where('state_delete', 0)
            ->where('modality_id', '!=', 2)
            ->orderBy('id', 'DESC')
            ->get()
            ->each(function($item){
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
    public function listPractices(){
        try {
            $data = Job::with(['modality', 'stateJob', 'oficinePractices'])
            ->where('state_delete', 0)
            ->where('modality_id', '=', 2)
            ->orderBy('id', 'DESC')
            ->get()
            ->each(function($item){
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

    public function listOficines(Request $request){
        try {
            $request->validate([
                'id' => 'required'
            ]);
            $data = JobOficine::with(['name'])->where('job_id', $request->id)->where('state_delete', 0)->orderBy('id', 'DESC')->get();
            $oficinas_restantes = DB::select('SELECT a.id, a.name FROM oficines a LEFT JOIN (SELECT * from job_oficines where state_delete = 0 and job_id = :job_id) b on a.id = b.oficine_id where b.id is null', ['job_id' => $request->id]);
            return response()->json([
                'success' => true,
                'data' => $data,
                'oficinas' => $oficinas_restantes
            ]);
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function listOficineCandidate(Request $request){
        try {
            $request->validate([
                'job_id' => 'required'
            ]);
            $data = JobOficine::with(['name'])->where('job_id', Crypt::decrypt($request->job_id))->where('state_delete', 0)->orderBy('id', 'DESC')->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
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
            'inputBaseFile' => 'required|mimes:pdf|max:10485760',
            'inputScheduleFile' => 'required|mimes:pdf|max:10485760',
            'inputProfileFile' => 'required|mimes:pdf|max:10485760',
            'inputDescription' => 'required',
            'inputFunction' => 'required',
            'inputProfile' => 'required',
            'inputOficine' => 'required'
        ]);
        try {
            $year = Carbon::createFromFormat('Y-m-d', $request->inputDatePublication)->year;
            if(Job::where('state_delete', 0)->where('modality_id', $request->inputModality)->where('number_jobs', $request->inputNumber)->whereYear('date_publication', $year)->first()){
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrio un error',
                    'error' => 'Existe una convocatoria con ese número'
                ]);
            }else{
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
                if($request->inputModality == '2'){
                    $array = json_decode($request->inputOficine);
                    foreach($array as $item){
                        $oficine_job = New JobOficine();
                        $oficine_job->job_id = $job->id;
                        $oficine_job->oficine_id = $item->id;
                        $oficine_job->syslog = $this->syslog_admin(1, $request);
                        $oficine_job->save();
                    }
                }else{
                    $oficine = New JobOficine();
                    $oficine->job_id = $job->id;
                    $oficine->oficine_id = $request->inputOficine;
                    $oficine->syslog = $this->syslog_admin(1, $request);
                    $oficine->save();
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Convocatoria creada exitosamente'
                ]);
            }
            

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
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
            'inputBaseFile' => 'exclude_if:inputBaseFile,undefined|nullable|mimes:pdf|max:10485760',
            'inputScheduleFile' => 'exclude_if:inputScheduleFile,undefined|nullable|mimes:pdf|max:10485760',
            'inputProfileFile' => 'exclude_if:inputProfileFile,undefined|nullable|mimes:pdf|max:10485760',
            'inputDescription' => 'required',
            'inputFunction' => 'required',
            'inputProfile' => 'required',
            'inputOficine' => 'exclude_if:inputModality,2|required'
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
                File::delete(public_path().$job->bases);
                $job->bases = $this->uploadArchive($request->file('inputBaseFile'), $job->id, "base");
            }
            if($request->hasFile('inputScheduleFile')) {
                File::delete(public_path().$job->schedule);
                $job->schedule = $this->uploadArchive($request->file('inputScheduleFile'), $job->id, "schedule");
            }
            if($request->hasFile('inputProfileFile')) {
                File::delete(public_path().$job->profile);
                $job->profile = $this->uploadArchive($request->file('inputProfileFile'), $job->id, 'profile');
            }

            $job->description = $request->inputDescription;
            $job->functions = $request->inputFunction;
            $job->requirements = $request->inputProfile;
            $job->syslog = $job->syslog . ' | ' . $this->syslog_admin(2, $request);
            $job->save();
            if($request->inputModality != 2){
                $oficine = JobOficine::where('job_id', $id)->first();
                $oficine->oficine_id = $request->inputOficine;
                $oficine->syslog = $this->syslog_admin(2, $request);
                $oficine->save();
            }
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
    public function addOficine(Request $request){
        try {
            $request->validate([
                'oficine_id' => 'required',
                'job_id' => 'required'
            ]);
            if(JobOficine::where('job_id', $request->job_id)->where('oficine_id', $request->oficine_id)->where('state_delete', 0)->first()){
                return response()->json([
                    'success' => false,
                    'error' => 'La oficina ya se encuentra agregada'
                ]);
            }else{
                $job_oficine = New JobOficine();
                $job_oficine->job_id = $request->job_id;
                $job_oficine->oficine_id = $request->oficine_id;
                $job_oficine->syslog = $this->syslog_admin(1, $request);
                $job_oficine->save();
                $data_new = JobOficine::with(['name'])->where('job_id', $request->job_id)->where('state_delete', 0)->orderBy('id', 'DESC')->get();
                $oficinas_restantes = DB::select('SELECT a.id, a.name FROM oficines a LEFT JOIN (SELECT * from job_oficines where state_delete = 0 and job_id = :job_id) b on a.id = b.oficine_id where b.id is null', ['job_id' => $request->job_id]);
                return response()->json([
                    'success' => true,
                    'message' => 'Oficina agregada exitosamente',
                    'new' => $data_new,
                    'oficinas' => $oficinas_restantes
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function deleteOficine(Request $request){
        try {
            $request->validate([
                'job_oficine_id' => 'required'
            ]);
            $job_oficine = JobOficine::where('id', $request->job_oficine_id)->first();
            $job_oficine->state_delete = 1;
            $job_oficine->syslog = $this->syslog_admin(3, $request);
            $job_oficine->save();

            $data_new = JobOficine::with(['name'])->where('job_id', $job_oficine->job_id)->where('state_delete', 0)->orderBy('id', 'DESC')->get();
            $oficinas_restantes = DB::select('SELECT a.id, a.name FROM oficines a LEFT JOIN (SELECT * from job_oficines where state_delete = 0 and job_id = :job_id) b on a.id = b.oficine_id where b.id is null', ['job_id' => $job_oficine->job_id]);
            return response()->json([
                'success' => true,
                'message' => 'Oficina removida exitosamente',
                'new' => $data_new,
                'oficinas' => $oficinas_restantes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
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
                        //$data->token = $data->path;
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
    public function viewJobCandidate(Request $request){
        try {
            //dd($request);
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
                        ['type_result_id', '=', $case->id],
                        ['date_publication', '<=', Carbon::now()->format('Y-m-d')]
                    ])->first();
                    if($data){
                        $case->file = $data;
                    }
                }else{
                    $data = JobResult::with(['typeResult'])->where([
                        ['state_delete','=',0],
                        ['job_id', '=', $id],
                        ['type_result_id', '=', $case->id],
                        ['date_publication', '<=', Carbon::now()->format('Y-m-d')]
                    ])->get();
                    if($data){
                        $case->file = $data;
                    }
                }
            }
            //Postulation::where([['job_id', $id],['state_delete', 0],['candidate_id', session('candidate')->id]])->first() ? $flag = true : $flag = false;
            return view('admin.jobs.viewJobCandidate')->with(compact('job', 'types','type_select'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function viewPracticeCandidate(Request $request){
        try {
            //dd($request);
            $id = Crypt::decrypt($request->practice_id);
            //dd($id);
            $job = Job::with(['modality','stateJob','results'])->where('id', $id)->where('state_delete', 0)->first();
            $type_select = TypeResult::where('state_delete', 0)->orderBy('id', 'ASC')->get();
            $types = TypeResult::where('state_delete', 0)->orderBy('id', 'ASC')->get();
            foreach($types as $case){
                if($case->multiple == 0){
                    $data = JobResult::with(['typeResult'])->where([
                        ['state_delete','=',0],
                        ['job_id', '=', $id],
                        ['type_result_id', '=', $case->id],
                        ['date_publication', '<=', Carbon::now()->format('Y-m-d')]
                    ])->first();
                    if($data){
                        $case->file = $data;
                    }
                }else{
                    $data = JobResult::with(['typeResult'])->where([
                        ['state_delete','=',0],
                        ['job_id', '=', $id],
                        ['type_result_id', '=', $case->id],
                        ['date_publication', '<=', Carbon::now()->format('Y-m-d')]
                    ])->get();
                    if($data){
                        $case->file = $data;
                    }
                }
            }
            $oficines = JobOficine::with(['name'])->where([['id', $id],['state_delete', 0]])->get();
            //Postulation::where([['job_id', $id],['state_delete', 0],['candidate_id', session('candidate')->id]])->first() ? $flag = true : $flag = false;
            return view('admin.practices.practicesViewCandidate')->with(compact('job', 'types','type_select', 'oficines'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function uploadDocuments(Request $request, $job_id){
        
        $request->validate([
            'type_document' => 'required',
            'file_document' => 'required|mimes:pdf|max:10485760',
            'date_publication' => 'required|date',
        ]); 

        try {
            $id = Crypt::decrypt($job_id);
            if(!JobResult::where([['type_result_id','=', $request->type_document],['job_id', '=', $id]])->first()){
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
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Existe un documento ya existente'
                ]);
            }
            
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
            'file_document' => 'exclude_if:file_document,undefined|nullable|mimes:pdf|max:10485760',
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
                            'extension' => $request->file('file_document')->getClientOriginalExtension()
                        ], 400);
                    }
                    File::delete(public_path().$result->path);
                    $result->path = $this->uploadDocument($request->file('file_document'), $result->job_id, $request->type_document);
                }
                $result->type_result_id = $request->type_document;
                $result->date_publication = $request->date_publication;
                $result->syslog = $result->syslog . ' | ' . $this->syslog_admin(2, $request);
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

    public function deleteDocument(Request $request, $id){
        try {
            $id = Crypt::decrypt($id);
            $data = JobResult::where('id', $id)->first();
            $data->syslog = $data->syslog . ' | ' . $this->syslog_admin(3, $request);
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
