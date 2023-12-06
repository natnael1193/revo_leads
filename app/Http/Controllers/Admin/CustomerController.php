<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginate = request()->query('paginate');
        $data = Leads::simplepaginate($paginate);
        return response()->json([
            "message" => "Get all leads",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            "name" => ['required'],
            "phone_one" => ['required', 'unique:leads'],
            "phone_two" => ['', 'unique:leads'],
            "phone_three" => ['', 'unique:leads'],
            "phone_four" => ['', 'unique:leads'],
            "email" => [''],
            "information_source" => ['required'],
            "property_type" => ['required'],
            "youtube" => [''],
            "facebook" => [''],
            "instagram" => [''],
            "website" => [''],
            "whatsapp" => [''],
            "telegram" => [''],
            "linkedin" => [''],
            "tiktok" => [''],
        ]);

        $check_phone_one = Leads::where('phone_one', $validate_data['phone_one'])->orWhere('phone_two', $validate_data['phone_one'])->orWhere('phone_three', $validate_data['phone_one'])->orWhere('phone_four', $validate_data['phone_one'])->count();
        $check_phone_two = Leads::where('phone_one', $validate_data['phone_two'])->orWhere('phone_two', $validate_data['phone_two'])->orWhere('phone_three', $validate_data['phone_two'])->orWhere('phone_four', $validate_data['phone_two'])->count();
        $check_phone_three = Leads::where('phone_one', $validate_data['phone_three'])->orWhere('phone_two', $validate_data['phone_three'])->orWhere('phone_three', $validate_data['phone_three'])->orWhere('phone_four', $validate_data['phone_three'])->count();
        $check_phone_four = Leads::where('phone_one', $validate_data['phone_four'])->orWhere('phone_two', $validate_data['phone_four'])->orWhere('phone_three', $validate_data['phone_four'])->orWhere('phone_four', $validate_data['phone_four'])->count();

//        return response()->json([
//            $check_phone_one, $check_phone_two, $check_phone_three, $check_phone_four
//        ]);
//The phone three has already been taken.

        if ($check_phone_one) {
            return response()->json([
                "message" => 'The Phone one' . " has already been taken."
            ], 422);
        }

        if ($check_phone_two) {
            return response()->json([
                "message" => 'The Phone two' . " has already been taken."
            ], 422);
        }

        if ($check_phone_three) {
            return response()->json([
                "message" => 'The Phone three'. " has already been taken."
            ], 422);
        }

        if ($check_phone_four) {
            return response()->json([
                "message" => 'The Phone four'. " has already been taken."
            ], 422);
        }

        $validate_data['user_id'] = auth()->user()->id;

        if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image' => $imagePath];
            $data = Leads::create(array_merge($validate_data, $imageArray));
            return response()->json([
                "message" => "Registered Successfully",
                "data" => $data,
            ]);
        }


        $data = Leads::create(array_merge($validate_data));
        return response()->json([
            "message" => "Registered Successfully",
            "data" => $data,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}