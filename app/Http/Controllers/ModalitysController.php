<?php

namespace App\Http\Controllers;
use App\Http\Traits\SysLog as TraitsSysLog;
use Illuminate\Http\Request;
use App\Models\Modality;
use Illuminate\Support\Facades\Crypt;
class ModalitysController extends Controller

{
    //
    use TraitsSysLog;
    public function viewModalitys(){
        return view('admin.modalitys.modalitys');
    }

    public function listModalitys(){
        try {
            $data = Modality::orderBy('id', 'DESC')->get()->each(function($item){
                $item->token = Crypt::encrypt($item->id);
            });
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error.',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function registerModality(Request $request){
        $request->validate([
            'name' => 'required',
            'descripcion' => 'nullable'
        ]);
        try {
            $modality = New Modality();
            $modality->name = $request->name;
            $modality->description = $request->description;
            $modality->syslog = $this->syslog_admin(1, $request);
            $modality->save();
            return response()->json([
                'success' => false,
                'message' => 'Modalidad Creada Correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateModality(Request $request, $modality_id){
        
        $request->validate([
            'name' => 'required',
            'state_delete' => 'required',
            'descripcion' => 'nullable'
        ]);
        try {
            $id = Crypt::decrypt($modality_id);
            $modality = Modality::where('id', $id)->first();
            $modality->name = $request->name;
            $modality->description = $request->description;
            $modality->state_delete = $request->state_delete;
            $modality->syslog = $this->syslog_admin(2, $request);
            $modality->save();
            return response()->json([
                'success' => false,
                'message' => 'Modalidad Actualizada Correctamente'
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
