<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function _construct(){                    
        $this->middleware('auth:api', ['except' =>['login', 'register']]);             
    }  

    public function register(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email|unique:users',   
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',     
        ]);
        if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
   }
   $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;             
        $success['name'] =  $user->name;         
   
   $response = [
       "success" => true,
       "data" => $success,
       "message" => "User register successfully."   
   ];
   
   return Response::json($response,200);            

    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [ 
            'email' => 'required',         
            'password' => 'required',          
        ]);
        if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);                 
    }
    if(!$token=auth()->attempt($validator->validated())){
        return response()->json(['error'=> 'Unauthorized'],401);                         
    }
    return $this->createNewToken($token);
}
public function createNewToken($token){
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL()*60,
        'user'=> auth()->user(),            
    ]);
}

public function profile(){
    return response()->json(auth()->user());       
}

public function logout(){
    auth()->logout();
    return response()->json([
        'message' => 'User logged out.'                             
    ]);    
}

}
