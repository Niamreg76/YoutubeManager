<?php

use Hybridauth\Provider\Google;
require_once 'vendor/autoload.php';
require_once 'class-db.php';
  
define('GOOGLE_CLIENT_ID', '114821075753-9hq3aups1gnq9386q9o1mpmfn8560e8f.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'http://localhost:50/callback.php',
    'keys'     => [
                    'id' => GOOGLE_CLIENT_ID,
                    'secret' => GOOGLE_CLIENT_SECRET
                ],
    'scope'    => 'https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/youtube.upload',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // Seulement si vous voulez que l'utilisateur soit redirigé vers Google pour autoriser l'application à accéder à ses données
            'access_type' => 'offline'
    ]
];
  
$adapter = new Google( $config );