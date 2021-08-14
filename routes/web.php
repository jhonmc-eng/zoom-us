<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'AdminController@index')->name('login.admin');
/*Route::get('/admin/users','UserController@view');
Route::get('/admin/users/list-users','UserController@listUsers');
Route::post('/admin/users/create-user','UserController@registerUser');
Route::post('/admin/users/update-user/{id}','UserController@editUser');
Route::post('/admin/users/resetPassword', 'UserController@resetPassword');
Route::get('/admin/users/get-data-dni/{dni}', 'UserController@getApiDni');*/
Route::post('/login-verification', 'LoginController@loginAdmin');
Route::post('/login-verification-candidate', 'LoginController@loginCandidate');
Route::get('/register', 'CandidateController@viewRegister');
Route::get('/get-data-dni/{dni}', 'UserController@getApiDni');
Route::post('/validate-register-candidate', 'CandidateController@registerCandidate');
Route::get('/getDataUser', 'AdminController@getDataUser');

Route::group(['prefix' => 'admin', 'middleware' => 'auth_admin', 'as' => 'admin.'], function(){
    /*LOGUEARSE DEL ADMIN */
    Route::get('/', 'AdminController@dashboard');
    Route::get('/logout','LoginController@logoutAdmin');
    Route::get('/dashboard','AdminController@dashboard');
    /*MODULO DE USUARIOS*/
    Route::group(['prefix' => 'users', 'middleware' => 'admin'], function(){
        Route::get('/', 'UserController@view');
        Route::get('/list-users', 'UserController@listUsers');
        Route::post('/create-user', 'UserController@registerUser');
        Route::post('/update-user/{id}', 'UserController@editUser');
        Route::post('/resetPassword', 'UserController@resetPassword');
        Route::get('/get-data-dni/{dni}', 'UserController@getApiDni');
    });
    /* MODULO DE CONVOCATORIA*/
    Route::group(['prefix' => 'jobs'], function(){
        Route::get('/', 'ConvocatoriaController@view');
        Route::get('/list-jobs', 'ConvocatoriaController@listJobs');
        Route::post('/register-job', 'ConvocatoriaController@registerJob');
        Route::post('/update-job/{id}', 'ConvocatoriaController@editJob');
        Route::get('/view-job', 'ConvocatoriaController@viewJob');
        Route::get('/view-base', 'ConvocatoriaController@viewBase');
        Route::get('/view-schedule','ConvocatoriaController@viewSchedule');
        Route::get('/view-profile', 'ConvocatoriaController@viewProfile');
        Route::get('/view-result', 'ConvocatoriaController@viewResult');
        Route::post('/upload-result/{id}', 'ConvocatoriaController@uploadDocuments');
        Route::post('/change-document/{id}', 'ConvocatoriaController@changeDocument');
        Route::post('/delete-document/{id}', 'ConvocatoriaController@deleteDocument');
    });
    Route::group(['prefix' => 'practices'], function(){
        Route::get('/', 'ConvocatoriaController@viewPractices');
        Route::get('/list-practices', 'ConvocatoriaController@listPractices');
        Route::post('/register-practice', 'ConvocatoriaController@registerPractice');
        Route::post('/update-practice/{id}', 'ConvocatoriaController@editPractice');
        Route::post('/add-oficine', 'ConvocatoriaController@addOficine');
        Route::post('/delete-oficine', 'ConvocatoriaController@deleteOficine');
        Route::get('/list-oficine', 'ConvocatoriaController@listOficines');
        Route::get('/view-practice', 'ConvocatoriaController@viewJob');
        Route::get('/view-base', 'ConvocatoriaController@viewBase');
        Route::get('/view-schedule','ConvocatoriaController@viewSchedule');
        Route::get('/view-profile', 'ConvocatoriaController@viewProfile');
        Route::get('/view-result', 'ConvocatoriaController@viewResult');
        Route::post('/upload-result/{id}', 'ConvocatoriaController@uploadDocuments');
        Route::post('/change-document/{id}', 'ConvocatoriaController@changeDocument');
        Route::post('/delete-document/{id}', 'ConvocatoriaController@deleteDocument');
    });
    /*MODULO DE MODALIDADES*/
    Route::group(['prefix' => 'modalitys', 'middleware' => 'admin'], function(){
        Route::get('/', 'ModalitysController@viewModalitys');
        Route::post('/register-modality','ModalitysController@registerModality');
        Route::get('/list-modalitys','ModalitysController@listModalitys');
        Route::post('/update-modality/{id}','ModalitysController@updateModality');
    });
});

Route::group(['prefix' => 'candidate', 'middleware' => 'auth_candidate', 'as' => 'candidate.'], function(){

    Route::get('/logout-candidate','LoginController@logoutCandidate');

    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'CandidateController@viewProfile');
        Route::get('/get-province', 'CandidateController@provinces');
        Route::get('/get-district', 'CandidateController@district');
        Route::post('/update-profile', 'CandidateController@updateProfile');
        Route::get('/view-document', 'CandidateController@viewDocument');
    }); 

    Route::group(['prefix' => 'academic'], function(){
        Route::get('/', 'AcademicController@viewAcademic');
        Route::get('/get-data', 'AcademicController@getDataAcademic');
        Route::post('/register-academic', 'AcademicController@registerAcademic');
        Route::get('/view-document', 'AcademicController@viewDocument');
        Route::post('/update-academic', 'AcademicController@updateAcademic');
        Route::post('/delete-academic', 'AcademicController@deleteAcademic');
    });

    Route::group(['prefix' =>  'qualifications'], function(){
        Route::get('/', 'QualificationsController@viewQualifications');
        Route::get('/get-data-qualifications', 'QualificationsController@getDataQualification');
        Route::post('/register-qualification', 'QualificationsController@registerQualification');
        Route::get('/view-document', 'QualificationsController@viewDocument');
        Route::post('/update-qualification', 'QualificationsController@updateQualification');
        Route::post('/delete-qualification', 'QualificationsController@deleteQualification');
    });

    Route::group(['prefix' => 'knowledge'], function(){
        Route::get('/', 'KnowledgeController@viewKnowledge');
        Route::get('/get-data-knowledge', 'KnowledgeController@getDataKnowledge');
        Route::post('/register-knowledge', 'KnowledgeController@registerKnowledge');
        Route::post('/update-knowledge', 'KnowledgeController@updateKnowledge');
        Route::post('/delete-knowledge', 'KnowledgeController@deleteKnowledge');
    });

    Route::group(['prefix' => 'references'], function(){
        Route::get('/', 'ReferenceController@viewReference');
        Route::get('/get-data-references', 'ReferenceController@getDataReferences');
        Route::post('/register-reference', 'ReferenceController@registerReference');
        Route::post('/update-reference', 'ReferenceController@updateReference');
        Route::post('/delete-reference', 'ReferenceController@deleteReference');
    });

    Route::group(['prefix' => 'training'], function(){
        Route::get('/', 'TrainingController@viewTraining');
        Route::get('/get-data-trainings', 'TrainingController@getDataTrainings');
        Route::post('/register-training', 'TrainingController@registerTraining');
        Route::post('/update-training', 'TrainingController@updateTraining');
        Route::get('/view-document', 'TrainingController@viewDocument');
        Route::post('/delete-training', 'TrainingController@deleteTraining');
    });
    Route::group(['prefix' => 'experiencie'], function(){
        Route::get('/', 'ExperienciesController@viewExperiencie');
        Route::get('/get-data-experiencies', 'ExperienciesController@getDataExperiencies');
        Route::post('/register-experiencie', 'ExperienciesController@registerExperiencie');
        Route::post('/update-experiencie', 'ExperienciesController@updateExperiencie');
        Route::get('/view-document', 'ExperienciesController@viewDocument');
        Route::post('/delete-experiencie', 'ExperienciesController@deleteExperiencie');
    });

    Route::group(['prefix' => 'jobs'], function(){
        Route::get('/', 'ConvocatoriaController@viewJobsCandidate');
        Route::get('/list-jobs', 'ConvocatoriaController@listJobsCandidate');
        Route::get('/view-job', 'ConvocatoriaController@viewJobCandidate');
        Route::post('/postulation-job', 'ConvocatoriaController@postulationJob');
        Route::get('/view-schedule','ConvocatoriaController@viewSchedule');
        Route::get('/view-profile', 'ConvocatoriaController@viewProfile');
        Route::get('/view-result', 'ConvocatoriaController@viewResult');
        Route::get('/view-base', 'ConvocatoriaController@viewBase');
        Route::post('/postulate/{job_id}', 'PostulationController@registerPostulationCandidate');
    });

    Route::group(['prefix' => 'practices'], function(){
        Route::get('/', 'ConvocatoriaController@viewPracticesCandidate');
        Route::get('/list-practices', 'ConvocatoriaController@listPracticesCandidate');
        Route::get('/view-practice', 'ConvocatoriaController@viewJobCandidate');
        Route::post('/postulation-practice', 'ConvocatoriaController@postulationPractice');
    });

    Route::group(['prefix' => 'postulations'], function(){
        Route::get('/', 'PostulationController@viewPostulationCandidate');
        Route::get('/get-data-postulations', 'PostulationController@getDataPostulationCandidate');
    });
});



