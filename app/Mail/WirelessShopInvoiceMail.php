<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WirelessShopInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction_details)
    {
        $this->transaction = $transaction_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('att@rechargemyplan.com', 'RechargeMyPlan')
            ->subject('[RechargeMyPlan] New Order')
            ->to('shafna@witellsolutions.com')
            ->cc(['shafnawitel@gmail.com'])
            ->view('emails.wirelessshop-invoice-email')
            ->with('invoice', $this->transaction);            
    }
}
