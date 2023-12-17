<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function index(){
        $groups = Group::all();
        $groupsData = [];
        foreach ($groups as $group){
            $customersCount= count($group->customers);
            array_push($groupsData,[
                'group_id' => $group->id,
                'group' => $group->group,
                'customerCount' => $customersCount
            ]);
        }
      $groupsData = array_map(function ($item) {
            return (object)$item;
        }, $groupsData);
        return view('group', compact('groupsData'));
    }
    public function store(Request $request){
        $group = Group::create([
            'group' => $request->group_name,
        ]);

        return back();
    }

    public function update(Request $request, Group $group){
        $group->update([
            'group' => $request->group_name,
        ]);

        return back();
    }

    public function destroy(Request $request){
        $group = Group::find($request->group_id);
        $group->delete();
        return back();
    }


}
