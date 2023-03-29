<?php

namespace App\Http\Controllers\API;

use App\Models\SupectInfo;
use App\Models\policofficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PoliceApi extends Controller
{
    //
    public function getAllOfficers($unitId){
        $results = policofficer::where('unitId', $unitId)->get();
        return [
            'status' => 200,
            'data' => $results
        ];
    }
    public function suspectsurety($martic_number)
    {
        $results =  SupectInfo::where('martic_number', $martic_number)->get();
        return [
            'status' => 200,
            'suspect' => $results
        ];
    }

    public function officerspost(Request $request) {
        $validator = Validator::make($request->all(), [
            'suspect_name' => 'bail|required|unique:policofficers',
            // 'martic_number'=>'required|unique:policeofficers',
            'height_of_suspect' => 'required',
            'weight_of_suspect' => 'required',
            'distinguinshing_features' => 'required',
            'nature_of_crime' => 'required',
            'reg_officer_name' => 'required',
            // 'oc_name' => 'required',
            // 'officer_name' => "required",
            'enfd' => "required",
            'environment_commited' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        } else {
            // $suspect_infomations = SupectInfo:;
            
            
            
            policofficer::create([
                'suspect_name' => $request->suspect_name,
                'unitId'=>$request->unitId,
                'height_of_suspect' => $request->height_of_suspect,
                'weight_of_suspect' => $request->weight_of_suspect,
                'distinguinshing_features' => $request->distinguinshing_features,
                'nature_of_crime' => $request->nature_of_crime,
                'number_of_offense' => $request->number_of_offense,
                'accomplices' => $request->accomplices,
                'motive' => $request->motive,
                'financial_benefits' => $request->financial_benefits,
                'environment_commited' => $request->environment_commited,
                'enfd' => $request->enfd,
                'cr' => $request->cr,
                'reg_officer_name' => $request->reg_officer_name,
                'reg_signature_date' => $request->reg_signature_date,
                'officer_name' => $request->officer_name,
                'officer_signature_date' => $request->officer_signature_date,
                'oc_name' => $request->oc_name,
                'oc_signature_date' => $request->oc_signature_date,
                'martic_number' => $request->martic_number,
                'note'=>$request->note
            ]);
            
            $suspect_infomations = SupectInfo::where('martic_number', $request->martic_number)->first();
            if($suspect_infomations){
                $suspect_infomations->reg_officer_name = $request->reg_officer_name;
                $suspect_infomations->update();

            }
            return response()->json([
                'status' => 200,
                // 'data'=>$affected,
                'officer_name' => $request->officer_name,
                'message' => 'Register Done for officer'
            ]);
        }
    }

    public function value($martic_number, $unitId)  {
        $data = DB::table('policofficers')->where('martic_number', $martic_number)->where('unitId', $unitId)->get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function officeripoupdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'officer_name' => 'required',
            'officer_signature_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        } else {
        $officer  = policofficer::findOrFail($id);
        $suspect_infomations = SupectInfo::where('martic_number', $request->martic_number)->first();
        if ($officer) {
            $officer->officer_name = $request->officer_name;
            $officer->officer_signature_date = $request->officer_signature_date;
            $officer->iponote = $request->iponote;
            if($suspect_infomations){
                $suspect_infomations->officer_name  = $request->officer_name;
                $suspect_infomations->update();
            }
            $officer->update();
        
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully'
            ]);
            // }
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Updated failed'
            ]);
        }
    }}


    public function officeroc(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'oc_name' => 'required',
            // 'suspect_name'=>'required|unique:policeofficers',
            'oc_signature_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        } else {
        $officer  = policofficer::findOrFail($id);
        if ($officer) {
            $officer->oc_name = $request->oc_name;
            $officer->oc_signature_date = $request->oc_signature_date;
            $officer->ocnote = $request->ocnote;
            $suspect_infomations = SupectInfo::where('martic_number', $request->martic_number)->first();
            if ($officer) {
                $officer->officer_name = $request->officer_name;
                $officer->officer_signature_date = $request->officer_signature_date;
                $officer->iponote = $request->iponote;
                if($suspect_infomations){
                    $suspect_infomations->oc_name  = $request->oc_name;
                    $suspect_infomations->update();
                }
                $officer->update();
            
            }
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully'
            ]);
            // }
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Updated failed'
            ]);
        }
    }}

}
