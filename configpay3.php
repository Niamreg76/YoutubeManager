<?php

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51M7f1wLgo1JZqCKHPQnnxYzpxhIrlHVgt3Y4MbZMKuRnoKj6y81GWvk69mmj5OzoHqSRuJD1DqCW3YzQTVTJW80j005UiDdz5E');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:50';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1MRF3kLgo1JZqCKHgYQBy6UA',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);