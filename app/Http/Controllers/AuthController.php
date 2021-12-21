<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        try {

            $data = $request->all();

            $data['password'] = bcrypt($data['password']);

            $user =  User::create($data);

            $token = createToken($user);

            $responseData = ['user' => $user, 'token' => $token];

            return $this->successResponse($responseData);

        } catch (\Exception $e) {
            return $this->failureResponse($e->getMessage());
        }


    }

    public function login(LoginRequest $request)
    {
       try {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();


        if (!$user || !Hash::check($data['password'], $user->password)) {
            return 'wrong';
        }

        $token = createToken($user);
        $responseData = ['user' => $user, 'token' => $token];
        return $this->successResponse($responseData);

       } catch (\Exception $e) {
        return $this->failureResponse($e->getMessage());
    }
    }


    public function logout(Request $request)
    {
       try {
        auth()->user()->delete();

        return $this->successResponse('User Logged Out Successfully');

       }  catch (\Exception $e) {
        return $this->failureResponse($e->getMessage());
    }
    }
}
