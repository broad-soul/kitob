<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = User::find($request->id);
        $user->update(['password' => bcrypt($request->password)]);
    }

    public function password_reset_email(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $email = $user->email;
        if (!$user) return response()->json(["message" => "Error! Email not found"], 422);

        $password_reset_user = DB::table('password_resets')->where('email', $email)->first();
        if ($password_reset_user)
            return response()->json(["message" => "Error! Письмо уже отправлено!", "code" => 1]);

        $token = str_random(55);
        $expires = Carbon::now()->addHour();
        DB::table('password_resets')->insert([
            'user_id' => $user->id,
            'email' => $email,
            'token' => $token,
            'expires' => $expires
        ]);
        try {
            Mail::to($email)->send(new PasswordReset($token));

            return response()->json(["message" => "Email send"]);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 422);
        }
    }

    public function password_reset(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $token = $request->token;
        $password_reset_user = DB::table('password_resets')->where('token', $token)->first();
        if (!$password_reset_user)
            return response()->json(["message" => "Error! Email not found"], 422);

        $user = User::find($password_reset_user->user_id);
        $user->update(['password' => bcrypt($request->password)]);
        DB::table('password_resets')->where('token', $token)->delete();
    }

}
