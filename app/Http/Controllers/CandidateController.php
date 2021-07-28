<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Departament;
use App\Models\District;
use App\Models\Nationality;
use App\Models\Province;
use App\Models\StatusCivil;
use App\Models\TypeDiscapacity;
use App\Models\TypePension;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CandidateController extends Controller
{
    //
    public function viewProfile(Request $request){
        try {
            $data = Candidate::where('id', session('candidate')->id)->first();
            $genders = DB::table('genders')->where('state_delete', 0)->get();
            $status_civils = StatusCivil::where('state_delete', 0)->get();
            $nationalitys = Nationality::get();
            $departament = Departament::get();
            is_null($data->departament_birth_id) ? $province_birth = [] : $province_birth = Province::where('departament_id', $data->departament_birth_id)->get();
            is_null($data->province_birth_id) ? $district_birth = [] : $district_birth = District::where('province_id', $data->province_birth_id)->get();
            is_null($data->departament_address_id) ? $province_address = [] : $province_address = Province::where('departament_id', $data->departament_address_id)->get();
            is_null($data->province_address_id) ? $district_address = [] : $district_address = District::where('province_id', $data->province_address_id)->get();
            $pension = TypePension::where('state_delete', 0)->get();
            $type_discapacity = TypeDiscapacity::where('state_delete', 0)->get();
            return view('admin.profile.profile')->with(compact('data', 'genders', 'status_civils', 'nationalitys', 'departament', 'province_birth', 'district_birth','province_address', 'district_address', 'pension', 'type_discapacity'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        
    }
    public function viewRegister(Request $request){
        return view('client.register.register');
    }
    public function updateProfile(Request $request){

        //dd($request);
        /*return response()->json([
            'data' => $request
        ]);*/
        try {
            $request->validate([
                'ruc' => 'nullable',
                'gender' => 'required',
                'state_civil' => 'required',
                'phone' => 'required',
                'nationality' => 'required',
                'departament_birth' => 'required',
                'province_birth' => 'required',
                'district_birth' => 'required',
                'date_birth' => 'required',
                'departament_address' => 'required',
                'province_address' => 'required',
                'district_address' => 'required',
                'address_one' => 'required',
                'address_two' => 'required',
                'address_number' => 'required',
                'pension_state' => 'required',
                'type_afp' => 'nullable',
                'fa_state' => 'required',
                'discapacity_state' => 'required',
                'type_discapacity' => 'nullable',
                'license_driver' => 'required',
                'consanguinity_state' => 'required',
                'description' => 'nullable',
                'file_dni' => 'exclude_if:file_dni,undefined|nullable|mimes:pdf|max:10485760',
                'file_fa' => 'exclude_if:file_fa,undefined|nullable|mimes:pdf|max:10485760',
                'file_discapacity' => 'exclude_if:file_discapacity,undefined|nullable|mimes:pdf|max:10485760',
                'file_license_driver' => 'exclude_if:file_license_driver,undefined|nullable|mimes:pdf|max:10485760',
                'file_profile' => 'exclude_if:file_profile,undefined|nullable|image|max:10485760'
            ]);
            $candidate = Candidate::where('id', session('candidate')->id)->first();
            $candidate->ruc = $request->ruc;
            $candidate->gender_id = $request->gender;
            $candidate->status_civil_id = $request->state_civil;
            $candidate->phone = $request->phone;
            $candidate->nationality_id = $request->nationality;
            $candidate->departament_birth_id = $request->departament_birth;
            $candidate->province_birth_id = $request->province_birth;
            $candidate->district_birth_id = $request->district_birth;
            $candidate->date_birth = $request->date_birth;
            $candidate->departament_address_id = $request->departament_address;
            $candidate->province_address_id = $request->province_address;
            $candidate->district_address_id = $request->district_address;
            $candidate->address_one = $request->address_one;
            $candidate->address_two = $request->address_two;
            $candidate->address_number = $request->address_number;
            $candidate->pension_id = $request->pension_state;
            $request->pension_state == 2 ? $candidate->type_pension_id = $request->type_afp : $candidate->type_pension_id = null;
            $request->fa_state == 'true' ? $candidate->license_FA = true : $candidate->license_FA = false;
            if($request->fa_state == 'true'){
                if($request->hasFile('file_fa')){
                    if($candidate->license_path != '' || !is_null($candidate->license_path)){
                        File::delete(public_path().$candidate->license_path);
                    }
                    $candidate->license_path = $this->uploadArchive($request->file('file_fa'), session('candidate')->id, 'file_fa');
                }
            }else{
                if($candidate->license_path != '' || !is_null($candidate->license_path)){
                    File::delete(public_path().$candidate->license_path);
                }
            }
            $request->discapacity_state == 'true' ? $candidate->discapacity_state = true : $candidate->discapacity_state = false;
            $request->discapacity_state ? $candidate->type_discapacity_id = $request->type_discapacity : $candidate->type_discapacity_id = null;
            
            if($request->discapacity_state == 'true'){
                if($request->hasFile('file_discapacity')){
                    if($candidate->discapacity_file_path != '' || !is_null($candidate->discapacity_file_path)){
                        File::delete(public_path().$candidate->discapacity_file_path);
                    }
                    $candidate->discapacity_file_path = $this->uploadArchive($request->file('file_discapacity'), session('candidate')->id, 'file_discapacity');
                }
            }else{
                if($candidate->discapacity_file_path != '' || !is_null($candidate->discapacity_file_path)){
                    File::delete(public_path().$candidate->discapacity_file_path);
                }
            }

            $request->license_driver == 'true' ? $candidate->license_driver = true : $candidate->license_Driver = false;
            if($request->license_driver == 'true'){
                if($request->hasFile('file_license_driver')){
                    if($candidate->license_driver_path != '' || !is_null($candidate->license_driver_path)){
                        File::delete(public_path().$candidate->license_driver_path);
                    }
                    $candidate->license_driver_path = $this->uploadArchive($request->file('file_license_driver'), session('candidate')->id, 'file_license_driver');
                }
            }else{
                if($candidate->license_driver_path != '' || !is_null($candidate->license_driver_path)){
                    File::delete(public_path().$candidate->license_driver_path);
                }
            }
            $candidate->description = $request->description;
            $request->consanguinity_state_y == 'true' ? $candidate->consanguinity = true : $candidate->consanguinity = false;
            if($request->hasFile('file_profile')){
                if($candidate->photo_perfil_path != '' || !is_null($candidate->photo_perfil_path)){
                    File::delete(public_path().$candidate->photo_perfil_path);
                }
                $candidate->photo_perfil_path = $this->uploadArchive($request->file('file_profile'), session('candidate')->id, 'file_perfil');
            }
            if($request->hasFile('file_dni')){
                if($candidate->file_dni_path != '' || !is_null($candidate->file_dni_path)){
                    File::delete(public_path().$candidate->file_dni_path);
                }
                $candidate->file_dni_path = $this->uploadArchive($request->file('file_dni'), session('candidate')->id, 'file_dni');
            }
            $candidate->save();
            return response()->json([
                'success' => true,
                'message' => 'Datos Actualizados Exitosamente',
                'data' => $candidate
            ]);
        
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function provinces(Request $request){
        try {
            $data = Province::where('departament_id', $request->departament_id)->get();
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

    public function district(Request $request){
        try {
            $data = District::where('province_id', $request->province_id)->get();
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
    public function uploadArchive($request, $id, $type){
        $file = $request;
        $name = $type.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path().'/files/users/user_'.$id.'/profile', $name);
        return '/files/users/user_'.$id.'/profile/'.$name;
        
    }
    public function verifyArchive($request){
        if($request->getClientOriginalExtension() != "pdf"){
            /*return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => 'El archivo no es un PDF',
                'type' => 'license_fa',
                'extension' => $request->getClientOriginalExtension()
            ]);*/
            return true;
        }
        return false;
    }
    public function verifyArchiveProfile($request){
        if($request->getClientOriginalExtension() != "jpeg"){
            /*return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => 'El archivo no es un PDF',
                'type' => 'license_fa',
                'extension' => $request->getClientOriginalExtension()
            ]);*/
            return true;
        }
        return false;
    }
}
