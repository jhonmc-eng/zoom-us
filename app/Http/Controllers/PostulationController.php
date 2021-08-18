<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Postulation;
use App\Http\Traits\SysLog as TraitsSysLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class PostulationController extends Controller
{
    //
    use TraitsSysLog;
    public function viewPostulationCandidate(){
        return view('admin.postulation.postulationCandidate');
    }

    public function getDataPostulationCandidate(){
        try {
            $data = Postulation::with(['oficine', 'job'])->where([['state_delete', 0],['candidate_id', session('candidate')->id]])->orderBy('id', 'DESC')->get()->each(function($item){
                $item->job->modality = $item->modality($item->job->modality_id);
                $item->job->state_job = $item->state_job($item->job->state_job_id);
                $item->job->token = Crypt::encrypt($item->job->id);
            });
            $data->makeHidden(['id','constancia_path','cv_path','candidate_id','format_1_path','format_2_path','job_id','oficine_id','rnscc_path','postulation_date','modality_id','state_job_id']);
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

    public function registerPostulationCandidate(Request $request, $job_id){
        try {
            $request->validate([
                'modality' => 'required',
                'file_format_1' => 'required|mimes:pdf|max:10485760',
                'file_cv' => 'required|mimes:pdf|max:10485760',
                'file_format_2' => 'required|mimes:pdf|max:10485760',
                'file_rnscc' => 'required|mimes:pdf|max:10485760',
                'file_certificate' => 'exclude_if:modality,CAS|required|mimes:pdf|max:10485760',
                'oficine' => 'exclude_if:modality,CAS|required'
            ]);
            if(!Postulation::where([['state_delete', 0],['job_id', Crypt::decrypt($job_id)], ['candidate_id', session('candidate')->id]])->first()){
                
                //$request->modality == 'CAS' ?  : ;
                if($request->modality == 'CAS'){
                    $job_id = Job::with(['oficineCas'])->where('id', Crypt::decrypt($job_id))->first();
                }elseif ($request->modality == 'PRACTICE'){
                    $job_id =  Job::where('id', Crypt::decrypt($job_id))->first();
                }else{
                    return response()->json([
                        'success' => false,
                        'error' => 'Modalidad incorrecta'
                    ]);
                }
                $postulation = New Postulation();
                $postulation->candidate_id = session('candidate')->id;
                $postulation->job_id = $job_id->id;

                $request->modality == 'CAS' ? $postulation->oficine_id = $job_id->oficineCas->oficine_id : $postulation->oficine_id = $request->oficine;
                //$postulation->oficine_id = $job_id->oficineCas->oficine_id;
                $postulation->format_1_path = '';
                $postulation->cv_path = '';
                $postulation->format_2_path = '';
                $postulation->rnscc_path = '';
                $postulation->postulation_date = Carbon::now();
                $postulation->save();
                $this->createDirectory($postulation->job_id,$postulation->id, session('candidate')->id);
                $postulation->format_1_path = $this->uploadDocument($request->file('file_format_1'), $postulation->job_id, $postulation->id, 'formato_one' );
                $postulation->cv_path = $this->uploadDocument($request->file('file_cv'), $postulation->job_id, $postulation->id, 'cv' );
                $postulation->format_2_path = $this->uploadDocument($request->file('file_format_2'), $postulation->job_id, $postulation->id, 'formato_two' );
                $postulation->rnscc_path = $this->uploadDocument($request->file('file_rnscc'), $postulation->job_id, $postulation->id, 'formato_rnscc' );
                
                if($request->hasFile('file_certificate')){
                    $postulation->constancia_path = $this->uploadDocument($request->file('file_certificate'), $postulation->job_id, $postulation->id, 'formato_certificate' );
                }
                $postulation->syslog = $this->syslog_candidate(4, $request);
                $postulation->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Documentos subidos exitosamente'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'error' => 'Ya esta registrado en esta convocatoria'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        } 
        
    }
    public function createDirectory($id, $postulate_id, $candidate_id){
        $path = public_path().'/files/jobs/job_'.$id.'/candidates/postulate_'.$postulate_id.'_candidate_'.$candidate_id;
        File::makeDirectory($path, $mode = 0777, true, true);
    }

    public function uploadDocument($request, $id, $postulate_id, $type){
        $file = $request;
        $name = $type.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path().'/files/jobs/job_'.$id.'/candidates/postulate_'.$postulate_id.'_candidate_'.session('candidate')->id, $name);
        return '/files/jobs/job_'.$id.'/candidates/postulate_'.$postulate_id.'_candidate_'.session('candidate')->id.'/'.$name;
    }
}
