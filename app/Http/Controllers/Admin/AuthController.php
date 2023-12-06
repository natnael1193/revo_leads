<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validate_data = request()->validate([
            "profile_picture" => ["image"],
            "name" => ['required'],
//            "last_name" => ['required'],
            "email" => ['required', 'unique:users'],
            "phone" => ['required', 'unique:users'],
            "password" => ['required'],
        ]);
        $password = ['password' => Hash::make($validate_data['password'])];


        if (request('profile_picture')) {
            $imagePath = request('profile_picture')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['profile_picture' => $imagePath];
            $data = User::create(array_merge($validate_data, $password, $imageArray));
            return response()->json([
                "message" => "Registered Successfully",
                "data" => $data,
            ]);
        }
        $data = User::create(array_merge($validate_data, $password));

        return response()->json([
            "message" => "Registered Successfully",
            "data" => $data,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);
        $user = User::where("phone", $request->email_or_phone)->orWhere("email", $request->email_or_phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 400);
        }

        return ["message" => "Login Successfully", "data" => $user, "token" => $user->createToken('API Token')->plainTextToken];
    }
}
