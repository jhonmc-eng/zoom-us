<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Reference;


class ReferenceController extends Controller
{
    use TraitsSysLog;
    public function viewReference(){
        try {
            return view('admin.references.references');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        
    }
    public function getDataReferences(){
        try {
            $data = Reference::where('state_delete', 0)
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
    public function registerReference(Request $request){
        try {
            $request->validate([
                'names' => 'required',
                'email' => 'required',
                'charge' => 'required',
                'phone' => 'required',
                'institution' => 'required'
            ]);
            $reference = New Reference();
            $reference->candidate_id = session('candidate')->id;
            $reference->names = $request->names;
            $reference->email = $request->email;
            $reference->charge = $request->charge;
            $reference->institution = $request->institution;
            $reference->phone = $request->phone;
            $reference->syslog = $this->syslog_candidate(4, $request);
            $reference->save();
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
    public function updateReference(Request $request){
        try {
            $request->validate([
                'names' => 'required',
                'email' => 'required',
                'charge' => 'required',
                'phone' => 'required',
                'institution' => 'required'
            ]);
            $reference = Reference::where('id', $request->id)->first();
            $reference->names = $request->names;
            $reference->email = $request->email;
            $reference->charge = $request->charge;
            $reference->institution = $request->institution;
            $reference->phone = $request->phone;
            $reference->syslog = $reference->syslog . ' | ' .$this->syslog_candidate(2, $request);
            $reference->save();
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
    public function deleteReference(Request $request){
        try {
            $reference = Reference::where('id', $request->id)->first();
            $reference->state_delete = 1;
            $reference->syslog = $reference->syslog. ' | ' .$this->syslog_candidate(3, $request);
            $reference->save();
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
