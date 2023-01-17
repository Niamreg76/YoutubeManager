<?php

class StripePayment
{
    public function __construct(readonly private string $clientSecret)
    {
        Stripe::setApiKey($this->clientSecret);
        Stripe::setApiVersion('2020-08-27');

    }

    public function startPayment(){
        $session = Session::create([
            'mode'
        ])
    }

}