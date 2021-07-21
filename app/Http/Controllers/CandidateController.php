<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Departament;
use App\Models\District;
use App\Models\Nationality;
use App\Models\Pension;
use App\Models\Province;
use App\Models\StatusCivil;
use App\Models\TypeDiscapacity;
use App\Models\TypePension;
use Illuminate\Support\Facades\DB;

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

    public function updateProfile(Request $request){
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
                'type_afp' => 'required',
                'fa_state' => 'required',
                'discapacity_state' => 'required',
                'type_discapacity' => 'required',
                'license_driver' => 'required',
                'consanguinity_state' => 'required',
                'description' => 'required',
                'file_dni' => 'required|file|max:10485760',
                'file_fa' => 'nullable|file|max:10485760',
                'file_discapacity' => 'nullable|file|max:10485760',
                'file_license_driver' => 'nullable|file|max:10485760',
                'file_profile' => 'nullable|file|max:10485760'
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
            $candidate->save();
            dd($request, $candidate);
        
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
}
