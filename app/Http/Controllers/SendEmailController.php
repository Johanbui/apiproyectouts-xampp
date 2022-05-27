<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index(Request $request)
    {
        $emails = $request->get('emails');
        $emails = explode(',', $emails);

        $asunto = 'prueba';

        foreach ($emails as $email) {
            $arrayInfo['email'] = $email;

            Mail::to($email)->send(new NotifyMail($arrayInfo, $asunto));
        }

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return null;
        }
    }
}
