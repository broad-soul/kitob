<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerify;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    protected $redirectTo = '/home';

    public function email_verify(Request $request)
    {
        $email = $request->email;
        $id = $request->id;
        if (User::find($id)->email == $email)
            return response()->json(["message" => "Error email same", "code" => 1]);

        $new_user = DB::table('user_confirmation')->where('email', $email)->first();
        if ($new_user)
            return response()->json(["message" => "Письмо отправленно!", "code" => 2]);

        $token = str_random(55);
        $expires = Carbon::now()->addHour();
        DB::table('user_confirmation')->insert([
            'user_id' => $id,
            'email' => $email,
            'token' => $token,
            'expires' => $expires
        ]);
        try {
            Mail::to($email)->send(new EmailVerify($token));

            return response()->json(["message" => "Email send"]);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 422);
        }
    }

    public function email_confirmation($token)
    {
        $data = DB::table('user_confirmation')->where('token', $token)->get()->toArray();
        if (count($data) == 0)
            return response()->json(["message" => "Error! Token not found!"], 422);

        $user_id = $data[0]->user_id;
        $email = $data[0]->email;
        $expires = $data[0]->expires;
        if(!(Carbon::create($expires)->unix() > Carbon::now()->unix())) {
            DB::table('user_confirmation')->where('token', $token)->delete();
            return response()->json(["message" => "Error! Token is expired!"], 422);
        }
        $user = User::find($user_id);
        $user->update(['email' => $email, 'email_verify' => 1]);
        DB::table('user_confirmation')->where('token', $token)->delete();
        return response()->json(["message" => "Success! Email changed"]);
    }
}
