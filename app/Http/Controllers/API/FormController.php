<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\SupectInfo;
use App\Models\SuretyInfo;
use Illuminate\Http\Request;
use App\Models\SuspectInfomation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{

    public function more_info($martic_number)
    {
        return response()->json([
            'suspect' => SupectInfo::where('martic_number', $martic_number)->get(),
            'surety' => SuretyInfo::where('martic_number', $martic_number)->get(),
        ]);
    }

    public function getAllSuspect($unitId)
    {
        $suspect = SupectInfo::where('unitId', $unitId)->latest()->get();
        // $suspect =   SupectInfo::where('unitId', true)
        //     ->lazyById(200, $column = $unitId)->get();

        // foreach (SupectInfo::lazy() as $suspect) {
        //     $suspect = SupectInfo::where('unitId', $suspect->unitId)->latest()->get();
        //     return response()->json([
        //         'status' => 200,
        //         'data' => $suspect
        //     ]);
        // }
        return response()->json([
            'status' => 200,
            'data' => $suspect
        ]);
    }
    public function check()
    {
    }
    public function findsuspectName(Request $request)
    {
    }
    public function findsuretyName(Request $request)
    {
    }
    public function getYear(Request $request)
    {
        // get year and unitId year date and time     
        $getyear = $request->year;
        $getId = $request->unitId;
        $suspect_infomations = DB::table('suspect_infomations')
            ->whereYear('created_at', $getyear)->where('unitId', $getId)
            ->first();
        if (!$getyear || !$getId) {
            return response()->json([
                'status' => 422,
                'errors' => 'not data found for'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'data' => $suspect_infomations
            ]);
        }
    }

    public function getFullYear(Request $request, $getyear, $unitId)
    {
        // get year and unitId year date and time     
        $suspect_infomations = DB::table('supect_infos')
            ->whereDate('created_at', $getyear)->where('unitId', $unitId )
            ->first();
        if ($suspect_infomations) {
            return response()->json([
                'status' => 200,
                'data' =>DB::table('supect_infos')
                ->whereDate('created_at', $getyear)->where('unitId', $unitId )
                ->get()
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'not body was found'
            ]);
        }
    }



    public function suspect(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'unitId' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'mobile_phone' => 'required|unique:supect_infos',
            'office_phone' => 'required|unique:supect_infos',
            'note' => 'required',
            'spouse_name' => 'required',
            'mother_name' => 'required',
            'father_name' => 'required',
            'father_res_address' => 'required',
            'mother_res_address' => 'required',
            'Landlord_name' => 'required',
            'Landlord_phone' => 'required',
            'Landlord_address' => 'required',
            'hereby_name' => 'required',
            'hereby_signature' => 'required',
            'Sibling1_name' => 'required',
            'Sibling2_name' => 'required',
            'last_place' => 'required',
            'address_employer' => 'required',
            'Penultimate_Place' => 'required',
            'address_of_penultimate' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('unitId', $request->unitId)->first();
            // if (!$user) {
            //     return response()->json([
            //         'status' => 401,
            //         'message_back' => 'invaild credentials unitId by officer '
            //     ]);
            // } else {
            $img = $request->affix_left;
            $folderPath = "public/uploads/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("data:image/png", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1], true);
            $fileName =  uniqid() . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);


            $img_front = $request->affix_front;
            $folderPath = "public/front/";
            $image_parts = explode(";base64,", $img_front);
            $image_type_aux = explode("data:image/png", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1], true);
            $fileName_front =  uniqid() . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);



            $img_right = $request->affix_right;
            $folderPath = "public/right/";
            $image_parts = explode(";base64,", $img_right);
            $image_type_aux = explode("data:image/png", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1], true);
            $fileName_right =  uniqid() . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);
            SupectInfo::create([
                'affix_left' => $fileName,
                'affix_front' => $fileName_front,
                'affix_right' => $fileName_right,


                'Landlord_name' => $request->Landlord_name,
                'Landlord_address' => $request->Landlord_address,
                'Landlord_phone' => $request->Landlord_phone,


                'hereby_name' => $request->hereby_name,
                'hereby_signature' => $request->hereby_signature,



                'Sibling1_name' => $request->Sibling1_name,
                'Sibling1_birth' => $request->Sibling1_birth,
                'Sibling1_phone' => $request->Sibling1_phone,
                'Sibling1_res_address' => $request->Sibling1_res_address,


                'Sibling2_name' => $request->Sibling2_name,
                'Sibling2_birth' => $request->Sibling2_birth,
                'Sibling2_phone' => $request->Sibling2_phone,
                'Sibling2_res_address' => $request->Sibling2_res_address,

                'mother_name' => $request->mother_name,
                'mother_birth' => $request->mother_birth,
                'mother_phone' => $request->mother_phone,
                'mother_res_address' => $request->mother_res_address,

                'father_name' => $request->father_name,
                'father_birth' => $request->father_birth,
                'father_phone' => $request->father_phone,
                'father_res_address' => $request->father_res_addres,
                'martic_number' => $request->martic_number,
                'spouse_name' => $request->spouse_name,
                'spouse_maiden' => $request->spouse_maiden,
                'spouse_date_brith' => $request->spouse_date_brith,
                'spouse_residential_address' => $request->spouse_residential_address,
                'spouse_phone' => $request->spouse_phone,
                'spouse_work' => $request->spouse_work,


                'tertiary_i' => $request->tertiary_i,
                'tertiary_y' => $request->tertiary_y,
                'tertiary_yg' => $request->tertiary_y_g,
                'secondary' => $request->secondary,
                's_year_of_entry' => $request->s_year_of_entry,
                's_year_of_gradution' => $request->s_year_of_gradution,
                // i just changed something here 
                'p_year' => $request->primary_year,
                'p_year_g' => $request->p_year_g,
                'primary' => $request->primary,
                'nationality' => $request->nationality,
                'state' => $request->state,
                // 'ethnic_group' => $request->ethnic_group,
                // 'local-govt' => $request->local_govt,
                // 'town_village' => $request->town_village

                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'unitId' => $request->unitId,
                'last_place' => $request->last_place,
                'address_employer' => $request->address_employer,
                'Penultimate_Place' => $request->Penultimate_Place,
                'address_of_penultimate' => $request->address_of_penultimate,
                'gender' => $request->gender,
                'date_birth' => $request->date_birth,
                'place_birth' => $request->place_birth,
                'mobile_phone' => $request->mobile_phone,
                'office_phone' => $request->office_phone,
                'email' => $request->email,
                'langugaes' => $request->langugaes,
                'residental_address' => $request->residental_address,
                'international_passport' => $request->international_passport,
                'office_shop' => $request->office_shop,
                'note' => $request->note,
                'fringer' => $request->fringer
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'U have successfully create a suspect in the system'
            ]);
            // }
        }
    }

    public function surety(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'unitId' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        } else {

            $img = $request->affix_left;
            $folderPath = "public/uploads/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("data:image/jpeg", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1], true);
            $fileName =  uniqid() . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);


            // yi4L(k!]{ep@
            $findSuspect_id = SupectInfo::where('martic_number', $id)->first();
            $surety_infos = new SuretyInfo;
            $surety_infos->user_id = $findSuspect_id->martic_number;
            $surety_infos->unitId = $request->unitId;
            $surety_infos->tertiary_i = $request->input('tertiary_i');
            $surety_infos->tertiary_y = $request->input('tertiary_y');
            $surety_infos->tertiary_yg = $request->input('tertiary_yg');
            $surety_infos->secondary = $request->input('secondary');
            $surety_infos->s_year_of_entry = $request->input('s_year_of_entry');
            $surety_infos->s_year_of_gradution = $request->input('s_year_of_gradution');
            $surety_infos->p_year = $request->input('p_year');
            $surety_infos->martic_number = $request->input('martic_number');
            $surety_infos->p_year_g = $request->input('p_year_g');
            $surety_infos->primary = $request->input('primary');

            $surety_infos->hereby_name = $request->suspect_name;
            $surety_infos->hereby_signature = $request->date_signature;
            $surety_infos->martic_number = $findSuspect_id->martic_number;
            $surety_infos->nationality = $request->nationality;
            $surety_infos->state = $request->state;
            $surety_infos->ethnic_group = $request->ethnic_group;
            $surety_infos->local_govt = $request->local_govt;
            $surety_infos->town_village = $request->town_village;
            $surety_infos->last_place = $request->last_place;
            $surety_infos->address_employer = $request->address_employer;
            $surety_infos->Penultimate_Place = $request->Penultimate_Place;
            $surety_infos->address_of_empolyer = $request->address_of_empolyer;
            // $surety_infos->martic_number = $request->martic_number
            $surety_infos->relationship = $request->relationship;
            $surety_infos->crime = $request->crime;
            $surety_infos->penalty = $request->penalty;
            $surety_infos->time_known = $request->time_known;
            $surety_infos->surety_requirement = $request->surety_requirement;
            // p_year=>$request->p_year;
            $surety_infos->prior_case = $request->prior_case;
            $surety_infos->prior_surety = $request->prior_surety;
            $surety_infos->suspect_name = $request->suspect_name;
            $surety_infos->date_signature = $request->date_signature;
            $surety_infos->affix_left = $fileName;
            $surety_infos->firstname = $request->firstname;
            $surety_infos->lastname = $request->lastname;
            $surety_infos->middlename = $request->middlename;
            $surety_infos->gender = $request->gender;
            $surety_infos->date_birth = $request->date_birth;
            $surety_infos->place_birth = $request->place_birth;
            $surety_infos->mobile_phone = $request->mobile_phone;
            $surety_infos->office_phone = $request->office_phone;
            $surety_infos->email = $request->email;
            $surety_infos->langugaes = $request->langugaes;
            $surety_infos->residental_address = $request->residental_address;
            $surety_infos->international_passport = $request->international_passport;
            $surety_infos->office_shop = $request->office_shop;
            $surety_infos->martic_number = $request->martic_number;

            $surety_infos->save();

            if ($findSuspect_id) {
                return response()->json([
                    'status' => 200,
                    'data' => $surety_infos,
                    'message' => ' U have successfully create a surety  in the system '
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'errors' => 'SORRY ID NOT FOUND PLEASE CONTACT THE ADMIN OFFICER',
                ]);
            }
        }
    }
}

   // SuretyInfo::create([
                //     'suspect_id'=>$findSuspect_id->id,
                //     'firstname' => $request->firstname,
                //     'lastname' => $request->lastname,
                //     'middlename' => $request->middlename,
                //     'unitId' => $request->unitId
                // ]);