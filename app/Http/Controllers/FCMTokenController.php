<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FCMTokenController extends Controller
{
    public function updateToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string'
        ]);

        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'FCM Token updated successfully'
        ]);
    }
}
