<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SupectInfo;
use App\Models\SuretyInfo;
use Illuminate\Http\Request;

class MoreController extends Controller
{
    //
    public function more_info_surety($martic_number){
    
        // $id = SupectInfo::find($id)->postsuretys()->where('user_id', $id)->latest()->get();
        // return response()->json([
        //     'status' => 200,
        //     'surety' => $id,
        // ]);
        return response()->json([
            'status'=>200,
            'surety' => SuretyInfo::where('martic_number', $martic_number)->get(),
            // 'surety' =>SupectInfo::where('martic_number', $martic_number)->get(),
        ]);
    }
    public function more_info($martic_number)
    {
        return response()->json([
            'status'=>200,
            'suspect' => SupectInfo::where('martic_number', $martic_number)->get(),
            'surety' => SuretyInfo::where('martic_number', $martic_number)->get(),
        ]);
    }

}
