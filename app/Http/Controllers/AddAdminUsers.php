<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddAdminUsers extends Controller
{

    // List Users
    public function getUsers(){ 
        $toUser = [];
        $listofUsers = User::get();
        foreach($listofUsers as $user){
            $userRole = $user->roles()->first();
            $indUser = $user; 
            array_push($toUser,$indUser,$userRole);
        }
        return response()->json(['list of user'=>$toUser]);
    }

    public function addAdmin(Request $request){

        $validator = $this->getValidator($request);
        if ($validator->fails()) {
            return response()->json(['Error'=>"Error has occured during validation"]);
        }
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($request->password);
    
        $user = auth()->user();
        $userRole = $user->roles()->first();    
        if ($userRole) {
            $this->scope = $userRole->role;
        }    

        $userCreate = User::create($validatedData);
        $role = Role::find($request->role_id);
        $userCreate->roles()->attach($role->id);

        return response()->json(['user'=>$userCreate]);
    }

    public function getValidator(Request $request){
        $rules = [
            'name'=>'required|string',
            'email'=>'email|required|unique:users',
            'password'=>'required'
        ];
        return Validator::make($request->all(), $rules);
    }
}






