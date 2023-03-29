<?php

namespace App\Http\Controllers\API\UNIT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UnitOneOsun extends Controller
{
    //
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'unitId' => 'required',
            'password' => 'required',
            'state'=>'required',
            'name'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        } else {
            
            return response()->json([
               'message'=>'working'
            ]);

        }
    }
}
