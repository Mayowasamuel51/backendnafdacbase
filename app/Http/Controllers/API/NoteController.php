<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SupectInfo;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //
    public function notetaking($id)
    {
        $notetaking = SupectInfo::find($id);
        if ($notetaking) {
            return response()->json([
                'status' => 200,
                'notetaking' => SupectInfo::where('id', $id)->get(),
                'note'=>SupectInfo::find($id)
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'notetaking' => 'Not found '
            ]);
        }

        // return response()->json([
        //     'status'=>200,
        //     'data' =>suspectinformation::where('id', $id)->get()
        // ]);
    }
    public function getnotetaking($id) {
        return response()->json([
            'data' =>SupectInfo::where('id', $id)->get()
        ]);
    }
    public function noteform(Request $request, $id)
    {
        $flight =SupectInfo::find($id);
        if ($flight) {
            $flight->note = $request->note;
            $flight->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully'
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'NOT REROCD FOUND'
            ]);
        }
    }
}
