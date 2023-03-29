<?php

namespace App\Http\Controllers\API;

use App\Models\SupectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SearchApi extends Controller
{
    //
    public function search($firstname, $unitId)
    {
        // search  == suspect , surety, martic_number , unitId
        // search by name 
        


        $suspectFirstname = SupectInfo::where('firstname', 'like', $firstname . '%')->where('unitId', $unitId)->first();
        if ($suspectFirstname) {
            return response()->json([
                'status' => 200,
                'data' => SupectInfo::where('firstname', 'like', $firstname . '%')->where('unitId', $unitId)->get()
                // $suspectFirstname
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'not ture not found'
            ]);
           
        }
    }
}
