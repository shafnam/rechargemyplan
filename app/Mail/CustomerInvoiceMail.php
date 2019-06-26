<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice_details)
    {
        //dd($invoice_details);
        $this->invoice = $invoice_details;
        //dd($invoice_details['customer_email']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('emails.customer-invoice-email');
        return $this->from('orders@rechargemyplan.com', 'RechargeMyPlan')
            ->subject('Purchase Confirmation')
            ->cc(['shafna@witellsolutions.com'])
            ->view('emails.customer-invoice-email')
            //->markdown('emails.customer-invoice-email')
            ->with('invoice', $this->invoice);
    }
}
