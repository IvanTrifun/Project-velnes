<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Tool;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index(){
        $currentUser = Auth::user();
        $rooms = Room::where("company_id", $currentUser->company_id)->get();
        $tools = Tool::where("company_id", $currentUser->company_id)->get();

        return view('resources', compact('rooms','tools'));
    }

    public function storeTool(Request $request){
        $currentUser = Auth::user();

        $tool= Tool::create([
            "tool_name" => $request->input('tool_name'),
            "company_id" => $currentUser->company_id,

        ]);

        return redirect()->route("resources.index")->with("success","success !");
    }

    public function storeRoom(Request $request){
        $currentUser = Auth::user();
        $companyId=$currentUser->company_id;
        $room= Room::create([
            "room_name" => $request->input('room_name'),
            "company_id" => $companyId,

        ]);

        return redirect()->route("resources.index")->with("success","success !");
    }

    public function updateTool(Request $request){
        $currentUser = Auth::user();
        $tool = Tool::find($request->input("tool_id"));
        $tool->update([
            "tool_name" => $request->input('tool_name'),
            "company_id" => $currentUser->company_id,
        ]);

        return redirect()->route("resources.index")->with("success","success !");
    }

    public function updateRoom(Request $request){
        $currentUser = Auth::user();
        $room = Room::find($request->input("room_id"));
        $room->update([
            "room_name" => $request->input('room_name'),
            "company_id" => $currentUser->company_id,
        ]);
        return redirect()->route("resources.index")->with("success","success !");
    }


    public function destroyTool(Request $request){
        $tool = Tool::find($request->input("tool_id"));
        $tool->delete();
        return redirect()->route('resources.index')->with('success', 'Tool deleted');
    }

    public function destroyRoom(Request $request){
        $room = Room::find($request->input("room_id"));
        $room->delete();
        return redirect()->route('resources.index')->with('success', 'Room deleted');

    }
}
