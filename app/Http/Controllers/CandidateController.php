<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Departament;
use App\Models\District;
use App\Models\Job;
use App\Models\Nationality;
use App\Models\Province;
use App\Models\StatusCivil;
use App\Models\TypeDiscapacity;
use App\Models\TypePension;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use App\Models\Postulation;

use App\Http\Traits\SysLog as TraitsSysLog;
use App\Models\Academic;
use App\Models\Experiencie;
use App\Models\Knowledge as ModelsKnowledge;
use App\Models\OtherDocument;
use App\Models\Reference;
use App\Models\Knowledge;
use App\Models\Qualification;

class CandidateController extends Controller
{
    //
    use TraitsSysLog;
    public function registerCandidate(Request $request){
        try {
            $request->validate([
                'type_document' => 'required',
                'document' => 'required',
                'type_document' => 'required',
                'name' => 'nullable',
                'lastname_patern' => 'nullable',
                'lastname_matern' => 'nullable',
                'email' => 'required|email',
                'password' => 'required',
                'password_confirmation'=> 'required'
            ]);
            //dd($request);
            if(Candidate::where('document', $request->document)->first()){
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrio un error',
                    'error' => 'El DNI ya esta registrado en el sistema'
                ]);
            }else{
                if(Candidate::where('email', $request->email)->first()){
                    return response()->json([
                        'success' => false,
                        'message' => 'Ocurrio un error',
                        'error' => 'El email ya esta registrado en el sistema'
                    ]);
                }else{
                    if($request->password == $request->password_confirmation){
                        $candidate = New Candidate();
                        $candidate->document = $request->document;
                        $candidate->type_document = $request->type_document;
                        $candidate->names = $request->name;
                        $candidate->lastname_patern = $request->lastname_patern;
                        $candidate->lastname_matern = $request->lastname_matern;
                        $candidate->email = $request->email;
                        $candidate->password = bcrypt($request->password);
                        $candidate->syslog = $this->syslog_candidate(1, $request);
                        $candidate->save();
                        $this->createDirectory($candidate->id);
                        return response()->json([
                            'success' => true,
                            'message' => 'Usuario Creado Exitosamente'
                        ]);
                    }else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Ocurrio un error',
                            'error' => 'Las contraseñas no coinciden'
                        ]);
                    }
                    
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ]);
        }
    }
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
        $type_documents = DB::table('type_documents')->where('state_delete', 0)->get();
        return view('client.register.register')->with(compact('type_documents'));
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
                $candidate->license_path = '';
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
                $candidate->discapacity_file_path = '';
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
                $candidate->license_driver_path = '';
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
            $candidate->syslog = $this->syslog_candidate(2, $request);
            $candidate->save();
            $candidate->file_dni_path == '' || is_null($candidate->file_dni_path) ? $candidate->file_dni_path = '' : $candidate->file_dni_path = Crypt::encrypt($candidate->file_dni_path);
            $candidate->license_path == '' || is_null($candidate->license_path) ? $candidate->license_path = '' : $candidate->license_path = Crypt::encrypt($candidate->license_path);
            $candidate->discapacity_file_path == '' || is_null($candidate->discapacity_file_path) ? $candidate->discapacity_file_path = '' : $candidate->discapacity_file_path = Crypt::encrypt($candidate->discapacity_file_path);
            $candidate->license_driver_path == '' || is_null($candidate->license_driver_path) ? $candidate->license_driver_path = '' : $candidate->license_driver_path = Crypt::encrypt($candidate->license_driver_path);
            $candidate->photo_perfil_path == '' || is_null($candidate->photo_perfil_path) ? $candidate->photo_perfil_path = '' : $candidate->photo_perfil_path = Crypt::encrypt($candidate->photo_perfil_path);
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
    public function viewDocument(Request $request){
        $url = Crypt::decrypt($request->id);
        return response()->file(public_path().$url);
    }
    public function createDirectory($id){
        $path = public_path().'/files/users/user_'.$id;
        $academic = public_path().'/files/users/user_'.$id.'/academic';
        $experiencie = public_path().'/files/users/user_'.$id.'/experiencie';
        $others = public_path().'/files/users/user_'.$id.'/others';
        $profile = public_path().'/files/users/user_'.$id.'/profile';
        $qualifications = public_path().'/files/users/user_'.$id.'/qualifications';
        File::makeDirectory($path, $mode = 0777, true, true);
        File::makeDirectory($academic, $mode = 0777, true, true);
        File::makeDirectory($experiencie, $mode = 0777, true);
        File::makeDirectory($others, $mode = 0777, true, true);
        File::makeDirectory($profile, $mode = 0777, true, true);
        File::makeDirectory($qualifications, $mode = 0777, true);
    }
    public function passwordCandidate(Request $request){
        try {
            $request->validate([
                'inputPasswordUpdatePassword' => 'required'
            ]);

            $password = Candidate::where('id', session('candidate')->id)->first();
            $password->password = bcrypt($request->inputPasswordUpdatePassword);
            $password->syslog = $password->syslog . ' | ' . $this->syslog_candidate(2, $request);
            $password->save();
            return response()->json([
                'success' => true,
                'message' => 'Password Actualizado Correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function viewCandidates(Request $request){
        try {
            $id = Crypt::decrypt($request->job_id);
            $job = Job::where([['state_delete', 0], ['id', $id]])->first();
            return view('admin.candidates.viewCandidates')->with(compact('job'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        } 
    }

    public function listCandidates(Request $request){
        try {
            $id = Crypt::decrypt($request->job_id);
            $data = Postulation::with(['candidate', 'oficine'])->where([['state_delete', 0], ['job_id', $id]])->get()->each(function($item){
                $item->token = Crypt::encrypt($item->id);
            });
            $data->makeHidden(['constancia_path','cv_path','format_1_path','id','format_2_path','job_id','id','oficine_id','postulation_date','rnscc_path','candidate_id','candidate.address_number']);
            //$data = Postulation::with(['candidate', 'oficine'])->join('candidates', 'postulations.candidate_id', 'candidates.id')->where('postulations.job_id', $id)->get();
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

    public function getDataCandidate(Request $request){
        try {
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function viewCandidateJobOrPractice(Request $request){
        try {
            $postulation = Crypt::decrypt($request->postulation_id);
            $candidate = Candidate::where('id', $postulation->candidate_id)->first();
            $genders = DB::table('genders')->where('state_delete', 0)->get();
            $status_civils = StatusCivil::where('state_delete', 0)->get();
            $nationalitys = Nationality::get();
            $departament = Departament::get();
            is_null($candidate->departament_birth_id) ? $province_birth = [] : $province_birth = Province::where('departament_id', $candidate->departament_birth_id)->get();
            is_null($candidate->province_birth_id) ? $district_birth = [] : $district_birth = District::where('province_id', $candidate->province_birth_id)->get();
            is_null($candidate->departament_address_id) ? $province_address = [] : $province_address = Province::where('departament_id', $candidate->departament_address_id)->get();
            is_null($candidate->province_address_id) ? $district_address = [] : $district_address = District::where('province_id', $candidate->province_address_id)->get();
            $pension = TypePension::where('state_delete', 0)->get();
            $type_discapacity = TypeDiscapacity::where('state_delete', 0)->get();
            return view('admin.candidates.viewCandidateJobPractice')->with(compact('candidate', 'genders', 'status_civils', 'nationalitys', 'departament', 'province_birth', 'district_birth','province_address', 'district_address', 'pension', 'type_discapacity'));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getAcademicCandidate(Request $request){
        try {
            $id = Crypt::decrypt($request->postulation_id);
            
            $data = Academic::with(['education_level', 'type_academic'])
                    ->where('state_delete', 0)
                    ->where('candidate_id', Postulation::select('candidate_id')->where('id', $id)->first())
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->each(function($item){
                        $item->certificate_file_path = Crypt::encrypt($item->certificate_file_path);
                        if($item->tuition_state){
                            $item->tuition_file_path = Crypt::encrypt($item->tuition_file_path);
                        }
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
    public function getQualificationsCandidate(Request $request){
        try {
            $id = Crypt::decrypt($request->postulation_id);
            
            $data = Qualification::with(['TypeQualification'])->where('state_delete', 0)
                    ->where('candidate_id', Postulation::select('candidate_id')->where('id', $id)->first())
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->each(function($item){
                        $item->certificate_file_path = Crypt::encrypt($item->certificate_file_path);
                        
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

    public function getKnowledgeCandidate(Request $request){
        try {
            $id = Crypt::decrypt($request->postulation_id);
            
            $data = Knowledge::with(['levelKnowledge'])->where('state_delete', 0)
                    ->where('candidate_id', Postulation::select('candidate_id')->where('id', $id)->first())
                    ->orderBy('id', 'DESC')
                    ->get();
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

    public function getExperiencieCandidate(Request $request){
        try {
            $id = Crypt::decrypt($request->postulation_id);
            $data = Experiencie::where('state_delete', 0)
                    ->where('candidate_id', Postulation::select('candidate_id')->where('id', $id)->first())
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->each(function($item){
                        $item->certificate_file_path = Crypt::encrypt($item->certificate_file_path);
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
    public function getTrainingCandidate(Request $request){
        try {
            $id = Crypt::decrypt($request->postulation_id);
            $data = OtherDocument::where('state_delete', 0)
                    ->where('candidate_id', Postulation::select('candidate_id')->where('id', $id)->first())
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->each(function($item){
                        $item->certificate_file_path = Crypt::encrypt($item->certificate_file_path);
                        
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

    public function getReferencesCandidate(Request $request){
        try {
            $id = Crypt::decrypt($request->postulation_id);
            $data = Reference::where('state_delete', 0)
                    ->where('candidate_id', Postulation::select('candidate_id')->where('id', $id)->first())
                    ->orderBy('id', 'DESC')
                    ->get();
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

}
