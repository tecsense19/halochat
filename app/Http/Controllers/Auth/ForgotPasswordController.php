<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    public function sendResetLinkEmail(Request $request)
{
    $this->validateEmail($request);

    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($response)
        : $this->sendResetLinkFailedResponse($request, $response);
}

}
