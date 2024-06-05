<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $form_data = $request->all();
        $validator = Validator::make(
            $form_data,
            [
                'name' => 'required|min:3|max:100',
                'surname' => 'required|min:3|max:100',
                'email' => 'required|email',
                'message' => 'required|min:3',
            ],
            [
                'name.required' => 'The name field is mandatory',
                'name.min' => 'The name field must not be less than :min characters',
                'name.max' => 'The name field must not be greater than :max characters',

                'surname.required' => 'The surname field is mandatory',
                'surname.min' => 'The surname field must not be less than :min characters',
                'surname.max' => 'The surname field must not be greater than :max characters',

                'email.required' => 'The email field is mandatory',
                'email.email' => 'The email field must be of type email with a @',

                'message.required' => 'The message field is mandatory',
                'message.min' => 'The message field must not be less than :min characters',
            ]
        );

        if ($validator->fails()) {
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($new_lead));

        $success = true;
        return response()->json(compact('success'));
    }
}
