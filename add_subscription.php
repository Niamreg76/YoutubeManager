<?php

/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
 */
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}

require_once __DIR__ . '/vendor/autoload.php';
session_start();

$OAUTH2_CLIENT_ID = '114821075753-9hq3aups1gnq9386q9o1mpmfn8560e8f.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = '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';

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
    FILTER_SANITIZE_URL);
$client->setRedirectUri($redirect);

// Définir un objet pour accéder aux API de YouTube
$youtube = new Google_Service_YouTube($client);

// Vérifier si un token d'accès est présent dans la session
$tokenSessionKey = 'token-' . $client->prepareScopes();
if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    die('The session state did not match.');
  }

  $client->authenticate($_GET['code']);
  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
  header('Location: ' . $redirect);
}

if (isset($_SESSION[$tokenSessionKey])) {
  $client->setAccessToken($_SESSION[$tokenSessionKey]);
}

// Vérifier si le client a un token d'accès valide
if ($client->getAccessToken()) {
  $htmlBody = '';
  try {
    // Vérifier si l'utilisateur a déjà souscrit à la chaîne

    // Créer un objet de ressource ID et définir son ID de chaîne
    $resourceId = new Google_Service_YouTube_ResourceId();
    $resourceId->setChannelId('UC571C3e-cb52wcgROyBEpeQ');
    $resourceId->setKind('youtube#channel');

    // Créer un objet de snippet de souscription et définir la ressource ID
    $subscriptionSnippet = new Google_Service_YouTube_SubscriptionSnippet();
    $subscriptionSnippet->setResourceId($resourceId);

    // Créer un objet de souscription et définir le snippet
    $subscription = new Google_Service_YouTube_Subscription();
    $subscription->setSnippet($subscriptionSnippet);

    // Appeler la méthode API subscriptions.insert pour ajouter la souscription
    $subscriptionResponse = $youtube->subscriptions->insert('id,snippet',
        $subscription, array());

    $htmlBody .= "<h3>Subscription</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $subscriptionResponse['snippet']['title'],
        $subscriptionResponse['id']);
    $htmlBody .= '</ul>';

  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  }

  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
} elseif ($OAUTH2_CLIENT_ID == 'REPLACE_ME') {
  $htmlBody = <<<END
  <h3>Client Credentials Required</h3>
  <p>
    You need to set <code>\$OAUTH2_CLIENT_ID</code> and
    <code>\$OAUTH2_CLIENT_ID</code> before proceeding.
  <p>
END;
} else {
  // Définir l'état de la session afin de vérifier la correspondance de l'état lors de la redirection
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;

  $authUrl = $client->createAuthUrl();
  $htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}

header("Location: https://www.youtube.com/channel/UC571C3e-cb52wcgROyBEpeQ");
?>

<!doctype html>
<html>
<head>
<title>Returned Subscription</title>
</head>
<body>
  <?=$htmlBody?>
</body>
</html>
