<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
class ConvocatoriaController extends Controller
{
    //

    public function view(){
        return view('admin.convocatorias.convocatorias');
    }

    public function listJobs(){
        try {
            $data = Job::with(['modality', 'stateJob'])->get();
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

    }

    public function editJob(Request $request){

    }

    public function viewCandidates(Request $request){

    }

    public function viewJob($job_id){
        
    }

    public function viewUploadDocuments($job_id){

    }
}
