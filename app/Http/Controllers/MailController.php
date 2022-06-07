<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = [
            'title'  => 'test send mail',
            'domain' => 'http://nested.sonthinh.cloud/',
        ];
        dispatch(new SendEmailJob($request->input('email'), $data));
    }
}
