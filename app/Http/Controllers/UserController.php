<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;


class UserController extends Controller
{
    public function register(Request $request)
    {
        //Validation
        $validatedData = Validator::make($request->json()->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|same:password',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error'=>$validatedData->errors()],422)->header('content-Type','application/json');
        }
       

        //save to db
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->remember_token = substr(sha1(rand()), 0, 10);
        $user->save();

        $loginData = array(
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        );

        //confirm registration
        if(!auth()->attempt($loginData)){
            return response(['message'=>'Invalid Credentials'])->header('content-Type','application/json');
        }

        //Generate token after successful registration

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $userData = array(
            'fullname'=>$user->name,
            'id'=>$user->id,
            'email'=>$user->email,
            'token'=>$accessToken,
        );

        return response()->json($userData,200)->header('content-Type','application/json');

    }

    public function login(Request $request)
    {
        $validatedData= Validator::make($request->json()->all(), [
            
            'email' => 'required',
            'password'=>'required',
           
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error'=>$validatedData->errors()],422)->header('content-Type','application/json');
        }

        $loginData=array(
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        );

        if(!auth()->attempt($loginData)){
            return response()->json(['message'=>'Invalid Credentials'],401)->header('content-Type','application/json');
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $userData = array(
            'name'=>auth()->user()->name,
            'id'=>auth()->user()->id,
            'email'=>auth()->user()->email,
            'token'=>$accessToken,       
        );
        return response()->json($userData,200)->header('content-Type','application/json');
        

    }

    

}
