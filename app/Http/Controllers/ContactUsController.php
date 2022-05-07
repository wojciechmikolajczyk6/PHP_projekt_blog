<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
class ContactUsController
{
    public function createForm(Request $request) {
        return view('contact');
    }

    public function ContactForm (Request $request) {
        $user_contact_data =  request()->validate([
           'name' => 'required',
           'email' => 'required',
           'subject' => 'required',
            'message' => 'required'
        ]);
//        ddd($user_contact_data['name']);
        // Store data in database
        Contact::create($user_contact_data);

        // Send mail
        \Mail::send('mail', array(
            'name' => $user_contact_data['name'],
            'email' => $user_contact_data['email'],
            'subject' => $user_contact_data['subject'],
            'user_query' => $user_contact_data['message'],
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('wojciechmikolajczyk5@gmail.com', 'Admin')->subject($request->get('subject'));
        });

        Return back()->with('succes', 'Otrzymalismy wiadomosc!');
    }



}
