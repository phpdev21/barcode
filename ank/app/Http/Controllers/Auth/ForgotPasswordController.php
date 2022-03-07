<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails,UserTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|exists:users']);
    }
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $id = $this->repo->getUserFromEmail($request->input('email'))['id'];
        $otp = $this->repo->generateOtp(30,$id);
        if($otp){
            $this->repo->sendForgetPasswordMail($request,$otp);
            $response = "Reset password link send to your mail!";
        }else{
            $response = "Something went wrong";
        }
        return redirect('forget')->with('reset_pass', $response);
    }
}
