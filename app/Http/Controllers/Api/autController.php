<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class autController extends Controller
{
    public function register(Request $request)
    {
        $data=$request->all();
        $validateData=Validator::make($data,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:20',
        ]);
        if($validateData->fails()){
            return response()->json([
                'error'=> $validateData->messages(),
                'success'=>'false'
            ],401);
        }
        $data['password']=bcrypt($request->input('password'));
        $user=User::create($data);
        $token=$user->createToken('authToken')->accessToken;
        return response()->json([
            'user'=>$user,
            'token'=>$token,
            'success'=>true
        ],201);
    }

    public function login(Request $request)
    {
        $data=$request->all();
        $validateData=Validator::make($data,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validateData->fails()){
            return response()->json([
                'error'=> $validateData->messages(),
                'success'=>false
            ],400);
        }
        if(!auth()->attempt($request->all())){
            return response()->json([
                'Message'=>'invalid tokhmi user',
                'success'=>false
            ],401);
        }
        $user=auth()->user();
        $token=$user->createToken('authToken')->accessToken;
        return response()->json([
            'user'=>$user,
            'token'=>$token,
            'success'=>true
        ],200);
    }

    public function users()
    {
        return response()->json(User::all(),200);
    }
}
