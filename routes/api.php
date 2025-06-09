<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function(){
    return 'pong';
});

Route::post('/auth/signup', function(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    $returnData = [];
    $returnData['user'] = $user;
    $returnData['token'] = $user->createToken($user->id.'-'.$user->email)->plainTextToken;

    return $returnData;
});

Route::post('/auth/signin', function(Request $request){
    $request->validate([
        'email' => 'required',
        'password' => 'required|min:6'
    ]);

    $user = User::firstWhere('email', $request->email);

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Authentication failed'], 401);
    }

    $token = $user->createToken($user->id.'-'.$user->email)->plainTextToken;

    return response()->json([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ],
        'token' => $token
    ]);
});

Route::get('/auth/verify', function(Request $request) {
    $user = $request->user();

    return response()->json([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]
    ]);
})->middleware('auth:sanctum');
