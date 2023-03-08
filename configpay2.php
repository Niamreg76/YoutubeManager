<?php

require 'vendor/autoload.php';
// Clé secrète de l'API
\Stripe\Stripe::setApiKey('sk_test_51M7f1wLgo1JZqCKHPQnnxYzpxhIrlHVgt3Y4MbZMKuRnoKj6y81GWvk69mmj5OzoHqSRuJD1DqCW3YzQTVTJW80j005UiDdz5E');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:50';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Prix du produit Stripe
    'price' => 'price_1MRF5qLgo1JZqCKHMop0yhVt',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);