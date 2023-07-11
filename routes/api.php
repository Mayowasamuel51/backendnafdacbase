<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChildController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\PoliceApi;
use App\Http\Controllers\API\SearchApi;
use App\Http\Controllers\API\UNIT\UnitOneOsunController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Controllers\API\UNIT\UnitOneOsun;

// create surety
Route::post('/mysuspectsuretys/{martic_number}', [FormController::class, 'surety']);
// get full year
Route::get('/fullyear/{getyear}/{unitId}', [FormController::class, 'getFullYear']);
//search code 
Route::get('/search/{firstname}/{unitId}', [SearchApi::class, 'search']);
Route::get('/check', [FormController::class, 'check']);

// login and register 
Route::post('/create', [AuthController::class, 'UserAuth']);
Route::post('/login', [AuthController::class, 'loginUser']);
/// proteceted routes
Route::group(['middleware' => ['auth:sanctum', 'throttle:none']],  function () {
    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message' => 'Your are in ', 'status' => 200], 200);
    });

    // searching
    // Route::get('/search/{firstname}/{unitId}', [SearchApi::class, 'search']);


    // more info.................
    Route::get('/moreinfo/{martic_number}', [FormController::class, 'more_info']);
    Route::get('/moreinfo/surety/{martic_number}', [FormController::class, 'more_info_surety']);

    // create a new suspect 
    Route::post('/suspect', [FormController::class, 'suspect']);
    Route::get('/suspectinfo', [FormController::class, 'getYear']);
    // get all suspect...............................
    Route::get('/suspect/{unitId}', [FormController::class, 'getAllSuspect']);


    // officer post and get resquest
    //rf section 
    Route::post('/officers', [PoliceApi::class, 'officerspost']);
    Route::get('/add-suspect-officerrf/{martic_number}', [PoliceApi::class, 'suspectsurety']);

    /// getting all officers
    Route::get('/officers/{unitId}',  [PoliceApi::class, 'getAllOfficers']);


    // ipo  section .................
    Route::put('/officeripo/{id}', [PoliceApi::class, 'officeripoupdate']);
    Route::get('/officerdetails/{martic_number}/{unitId}', [PoliceApi::class, 'value']);

    // oc section 
    Route::put('/officeroc/{id}', [PoliceApi::class, 'officeroc']);
    Route::get('/officervalueoc/{martic_number}/{unitId}', [PoliceApi::class, 'value']);
    // Route::get('/officervalue/{id}', [OfficerController::class, 'value']);
    Route::get('/add-suspect-officeroc/{martic_number}', [PoliceApi::class, 'suspectsurety']);




    // child stufff.................
    Route::get('/suspectchild', [ChildController::class, 'index']);
    Route::post('/suspectchild', [ChildController::class, 'childstore']);
    Route::get('/edit-suspect/{martic_number}', [ChildController::class, 'updateinfo']);
    Route::get('/suspectchild/{martic_number}', [ChildController::class, 'childindex']);

    Route::get('/suspectchildad', [ChildController::class, 'index']);
    Route::post('/suspectchildad', [ChildController::class, 'childstore']);
    Route::get('/edit-suspectad/{martic_number}', [ChildController::class, 'updateinfo']);
    Route::get('/suspectchildad/{martic_number}', [ChildController::class, 'childindex']);


    //note frontdesk
    Route::get('/notefd/{id}', [NoteController::class, 'notetaking']);
    Route::get('/getnotefd/{id}', [NoteController::class, 'getnotetaking']);
    Route::put('/noteformfd/{id}', [NoteController::class, 'noteform']);

    //admin /moreinfo/{martic_number}
    Route::get('/admin/moreinfo/{martic_number}', [MoreController::class, 'more_info']);
    //end here 
    // childern stuff start here 
    Route::get('/suspectchildad', [ChildController::class, 'index']);
    Route::post('/suspectchildad', [ChildController::class, 'childstore']);
    Route::get('/edit-suspectad/{martic_number}', [ChildController::class, 'updateinfo']);
    Route::get('/suspectchildad/{martic_number}', [ChildController::class, 'childindex']);
    // ends here 
    // suspect having many surety 
    // Route::post('/suretyad', [FormApiController::class, 'suretystores']);
    Route::get('/edit-suspect-suretyad/{id}', [SuspectManySurety::class, 'suspectsurety']);
    Route::get('/suspect-many-suretyad/{martic_number}', [SuspectManySurety::class, 'suspectmanysurety']);
    // end 
    //note stuff 
    Route::get('/notead/{id}', [NoteController::class, 'notetaking']);
    Route::get('/getnotead/{id}', [NoteController::class, 'getnotetaking']);
    Route::put('/noteformad/{id}', [NoteController::class, 'noteform']);
    // suspect form 
    // Route::post('/suspect', [FormApiController::class, 'storesuspect']);
    Route::get('/suspectsad',  [FormApiController::class, 'indexsusupect']);

    Route::get('/add-suspect-officerad/{id}', [OfficerController::class, 'suspectsurety']);
    Route::get('/officervaluead/{martic_number}', [OfficerController::class, 'value']);
    //logout for the system
    Route::post('/logout', [AuthController::class, 'logout']);
});




// Route::group(['middleware' => ['unitOneOsun']],  function () {
//     Route::post('/login/un', [UnitOneOsunController::class, 'login']);    
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// {
//     "unitId":"LagosID121113",
//    "tokenpass":"rfid",
//     "password":"1234567"
// }