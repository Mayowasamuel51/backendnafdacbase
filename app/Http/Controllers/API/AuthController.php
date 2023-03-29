<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return  response()->json( [
            'status' => 200,
            'message' => 'u have logout '
        ]);
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unitId' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        } else {
            // 36 states .. each state has 12 unit .. which mean 12 auth system base on role
            // each unit has frontdesk , rf , oc , ipo , admin 
            // admin create the account for frontdesk , ipo , oc , rf ,
            // these officers will login with   ===   state , unitId , tokenPass , role

            // if role === frontdesk and checking the tokenPass and state , unitId and password then grant access  to see suspect in unitId 
            // having mutple middlewares  etc unitIds in state
            $user = User::where('unitId', $request->unitId)->first();  
          
            if (!$user ||  !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message_back' => 'invaild credentials'
                ]);
            } else {
                $token_user =  $user->createToken('mytoken')->plainTextToken;
                // try checking  state 
                if ($user->unitId === 'unit1Osun') {
                    $tokenpass  =  User::where('tokenpass', $request->tokenpass)->first();
                    // $ipo_where = User::where('role', $request->role === 'ipo')->where('unitId', $request->unitId)->first();
                    if ($user->unitId === 'unit1Osun' &&   $request->role === 'frontdesk'
                       && $request->tokenpass ===  'frontdes') {
                    
                        return response()->json([
                            'role' => 'frontdesk',
                            'unitId'=>'unit1Osun',
                            'status' => 200,
                            'data' => 'THIS IS DATA FROM unit1OSUN',
                            'token' => $token_user,
                            'tokenpass'=>$tokenpass,
                            'message' => 'welcome as  frontdesk  officer'
                        ]);
                    }
                    if ( $user->unitId === 'unit1Osun' && $request->role === 'ipo'  &&  $request->tokenpass ===  'ipo1' ) {
                        return response()->json([
                            'role' => 'ipo',
                            'unitId'=>'unit1Osun',
                            'status' => 200,
                            'token' => $token_user,
                            'data' => 'THIS IS DATA FROM unit1OSUN',
                            'message' => 'welcome as  IPO  officer'
                        ]);
                    }
                    if (
                        $user->unitId === 'unit1Osun' && $request->role === 'rf'  &&   $request->tokenpass ===  'rf1'  ) {
                        $rfdata = DB::select('select * from supect_infos where  unitId = :unitId  ', ['unitId' => 'unit1Osun']);
                        return response()->json([
                            'role' => 'rf',
                            'datar'=>$rfdata,
                            'status' => 200,
                            'unitId'=>'unit1Osun',
                            'token' => $token_user,
                            'data' => 'THIS IS DATA FROM unit1OSUN',
                            'message' => 'welcome as  RF  officer'
                        ]);
                    }
                    if (
                        $user->unitId === 'unit1Osun' && $request->role === 'admin'  &&  $request->tokenpass ===  'ipo1'
                    ) {
                        return response()->json([
                            'role' => 'admin',
                            'status' => 200,
                            'unitId'=>'unit1Osun',
                            'token' => $token_user,
                            'data' => 'THIS IS DATA FROM unit1OSUN',
                            'message' => 'welcome as  admin  officer'
                        ]);
                    }

                    if ( $user->unitId === 'unit1Osun' && $request->role === 'oc'  && $request->tokenpass ===  'oc1') {
                        return response()->json([
                            'role' => 'oc',
                            'status' => 200,
                            'unitId'=>'unit1Osun',
                            'token' => $token_user,
                            'data' => 'THIS IS DATA FROM unit1OSUN',
                            'message' => 'welcome as  oc  officer'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 401,
                            'message_back' => 'invaild credentials for  OFFICER FOR unit1Osun'
                        ]);
                    }
                    //// UNIT20SUN
                }
                 else if ($user->unitId === 'unit2Osun') {
                    if (
                        $user->unitId === 'unit2Osun' && $request->role === 'frontdesk'  &&
                        $request->tokenpass ===  'frontdesk2'
                    ) {
                        $frdata = DB::select('select * from supect_infos where  unitId = :unitId  ', ['unitId' => 'unit2Osun']);
                        return response()->json([
                            'role' => 'frontdesk',
                            'unitId'=>'unit2Osun',
                            'status' => 200,
                            'datafr'=>$frdata,
                            'data' => 'THIS IS DATA OFFICER FOR unit2Osun',
                            'token' => $token_user,
                            'message' => 'welcome as  frontdesk  officer'
                        ]);
                    }
                    if ($user->unitId === 'unit2Osun' && $request->role === 'ipo') {
                        return response()->json([
                            'role' => 'ipo',
                            'status' => 200,
                            'token' => $token_user,
                            'data' => 'THIS IS OFFICER FOR unit2Osun',
                            'message' => 'welcome as  IPO  officer'
                        ]);
                    }

                    if ($request->role === 'rf') {
                        return response()->json([
                            'role' => 'rf',
                            'status' => 200,
                            'token' => $token_user,
                            'data' => 'THIS IS OFFICER FOR unit2Osun',
                            'message' => 'welcome as  RF  officer'
                        ]);
                    }
                    if ($request->role === 'admin') {
                        return response()->json([
                            'role' => 'admin',
                            'status' => 200,
                            'token' => $token_user,
                            'data' => 'THIS IS DATA OFFICER FOR unit2Osun',
                            'message' => 'welcome as  admin  officer'
                        ]);
                    }

                    if ($request->role === 'oc') {
                        return response()->json([
                            'role' => 'oc',
                            'status' => 200,
                            'token' => $token_user,
                            'data' => 'THIS IS DATA OFFICER FOR unit2Osun',
                            'message' => 'welcome as  oc  officer'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 404,

                            'message' => 'invaild credentials for  OFFICER FOR unit2Osun'
                        ]);
                    }
                } else if ($user->unitId  === 'unit1lagos') {
                    if ($request->role === 'frontdesk') {
                        return response()->json([
                            'role' => 'frontdesk',
                            'status' => 200,
                            'token' => $token_user,
                            'message' => 'welcome as  frontdesk  officer'
                        ]);
                    }
                    if ($request->role === 'ipo') {
                        return response()->json([
                            'role' => 'ipo',
                            'status' => 200,
                            'token' => $token_user,
                            'message' => 'welcome as  IPO  officer'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 401,
                            'message_back' => 'invaild credentials for  OFFICER FOR unit1lagos'
                        ]);
                    }
                }
            }
        }
    }


    public function UserAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            // 'email' => 'required|unique:users',
            "tokenpass" => "required",
            'unitId' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        } else {
            $user = User::create([
                'tokenpass' => $request->input('tokenpass'),
                'state' => $request->input('state'),
                'name' => $request->input('name'),
                'role' => $request->input('role'),
                'email' => $request->input('email'),
                'unitId' => $request->input('unitId'),
                'password' => Hash::make($request->input('password'))
            ]);
            $token_user =  $user->createToken($user->name . '_Token',)->plainTextToken;
            return response()->json([
                'status' => 200,
                'token_name' => $user->name,
                'token' => $token_user,
                'message' => 'Registerd '
            ]);
        }
    }
}
