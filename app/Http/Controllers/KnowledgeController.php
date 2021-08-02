<?php

namespace App\Http\Controllers;

use App\Models\LevelKnowledge;
use Illuminate\Http\Request;
use App\Models\Knowledge;
use App\Http\Traits\SysLog as TraitsSysLog;

class KnowledgeController extends Controller
{
    //
    use TraitsSysLog;
    public function viewKnowledge(){
        try {
            $typeKnowledge = LevelKnowledge::where('state_delete', 0)->get();
            return view('admin.knowledge.knowledge')->with(compact('typeKnowledge'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        
    }
    public function getDataKnowledge(){
        try {
            $data = Knowledge::with(['levelKnowledge'])->where('state_delete', 0)
                    ->where('candidate_id', session('candidate')->id)
                    ->orderBy('id', 'DESC')
                    ->get();
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
    public function registerKnowledge(Request $request){
        try {
            $request->validate([
                'knowledge' => 'required',
                'detail' => 'required',
                'knowledge_level' => 'required'
            ]);
            $knowledge = New Knowledge();
            $knowledge->candidate_id = session('candidate')->id;
            $knowledge->name = $request->knowledge;
            $knowledge->detail = $request->detail;
            $knowledge->knowledge_level_id = $request->knowledge_level;
            $knowledge->syslog = $this->syslog_candidate(4, $request);
            $knowledge->save();
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
    public function updateKnowledge(Request $request){
        try {
            $request->validate([
                'id' => 'required',
                'knowledge' => 'required',
                'detail' => 'required',
                'knowledge_level' => 'required'
            ]);
            $knowledge = Knowledge::where('id', $request->id)->first();
            $knowledge->name = $request->knowledge;
            $knowledge->detail = $request->detail;
            $knowledge->knowledge_level_id = $request->knowledge_level;
            $knowledge->syslog = $knowledge->syslog . ' | ' .$this->syslog_candidate(2, $request);
            $knowledge->save();
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
    public function deleteKnowledge(Request $request){
        try {
            $knowledge = Knowledge::where('id', $request->id)->first();
            $knowledge->state_delete = 1;
            $knowledge->syslog = $knowledge->syslog. ' | ' .$this->syslog_candidate(3, $request);
            $knowledge->save();
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
}
