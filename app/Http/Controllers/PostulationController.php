<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Postulation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class PostulationController extends Controller
{
    //
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
                'file_format_1' => 'required|mimes:pdf|max:10485760',
                'file_cv' => 'required|mimes:pdf|max:10485760',
                'file_format_2' => 'required|mimes:pdf|max:10485760',
                'file_rnscc' => 'required|mimes:pdf|max:10485760'
            ]);
            if(!Postulation::where([['state_delete', 0],['job_id', Crypt::decrypt($job_id)], ['candidate_id', session('candidate')->id]])->first()){
                $job_id =  Job::with(['oficineCas'])->where('id', Crypt::decrypt($job_id))->first();
                /*return response()->json([
                    'success' => false,
                    'error' => $job_id
                ]);*/
                $postulation = New Postulation();
                $postulation->candidate_id = session('candidate')->id;
                $postulation->job_id = $job_id->id;
                $postulation->oficine_id = $job_id->oficineCas->oficine_id;
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
