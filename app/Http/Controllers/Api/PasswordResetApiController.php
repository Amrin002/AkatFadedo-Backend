<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpResetPasswordMail;
use App\Models\PasswordOtp;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use \Illuminate\Support\Str;

class PasswordResetApiController extends Controller
{
    // Kirim link reset password ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Link reset password berhasil dikirim.'], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }

    // Reset password menggunakan token
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password berhasil direset.'], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = strtoupper(Str::random(6));

        PasswordOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(15),
            ]
        );
        Log::info('OTP berhasil dibuat dan disimpan ke database', [
            'email' => $request->email,
            'otp' => $otp
        ]);


        // Buat link ke halaman reset password (frontend/app)
        $resetLink = url('/reset-password?email=' . $request->email . '&otp=' . $otp);

        // Kirim email
        Mail::to($request->email)->send(new OtpResetPasswordMail($otp, $resetLink));
        Log::info('Email OTP berhasil dikirim', [
            'email' => $request->email
        ]);
        return response()->json([
            'message' => 'OTP berhasil dikirim ke email.',
        ]);
    }
    public function resetWithOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $otpRecord = PasswordOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord || $otpRecord->expires_at->isPast()) {
            return response()->json(['message' => 'OTP tidak valid atau sudah kedaluwarsa.'], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        // Hapus OTP setelah berhasil digunakan
        $otpRecord->delete();

        return response()->json(['message' => 'Password berhasil direset.']);
    }
}
