<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        if($request->get('contact_form') == 1){
            return $this->from('att@rechargemyplan.com', 'RechargeMyPlan')
            ->subject('RechargeMyPlan Contact Inquiry')
            ->view('emails.contact-email',['contact_name'=>$request->fullname,'contact_email'=>$request->email,'content'=>$request->message])
            ->to('shafnawitel@gmail.com')
            ->cc(['shafna@witellsolutions.com']);
        } 
        else if($request->get('registration_form') == 1){
            return $this->from('info@rechargemyplan.com', 'RechargeMyPlan')
            ->subject('Welcome to RechargeMyPlan!')
            ->view('emails.registration-email',['name'=>$request->name,'email'=>$request->email,'content'=>$request->message])
            ->to($request->email)
            ->cc(['shafna@witellsolutions.com']);
        }
        else {
            return 123;     
        }
         
    }
}
