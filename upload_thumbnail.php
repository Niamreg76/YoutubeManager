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

// Vérifier si le token d'accès a expiré
if ($client->getAccessToken()) {
  $htmlBody = '';
  try{

    // Remplacer la valeur par l'ID de la vidéo pour laquelle vous souhaitez définir une miniature.
    $videoId = "XirDe5IlS1Q";

    // Remplacer par le chemin vers l'image que vous souhaitez utiliser comme miniature.
    $imagePath = "images/licon.png ";

    // Définir la taille du fichier de la miniature en octets.
    $chunkSizeBytes = 1 * 1024 * 1024;

    $client->setDefer(true);

    // Créer une demande pour définir la miniature de la vidéo.
    $setRequest = $youtube->thumbnails->set($videoId);

    // Créer un objet MediaFileUpload et définir sa propriété resumable à true pour indiquer que vous souhaitez télécharger le fichier en plusieurs parties.
    $media = new Google_Http_MediaFileUpload(
        $client,
        $setRequest,
        'image/png',
        null,
        true,
        $chunkSizeBytes
    );
    $media->setFileSize(filesize($imagePath));


    // Lire le fichier et l'envoyer en plusieurs morceaux.
    $status = false;
    $handle = fopen($imagePath, "rb");
    while (!$status && !feof($handle)) {
      $chunk = fread($handle, $chunkSizeBytes);
      $status = $media->nextChunk($chunk);
    }

    fclose($handle);

    $client->setDefer(false);


    $thumbnailUrl = $status['items'][0]['default']['url'];
    $htmlBody .= "<h3>Thumbnail Uploaded</h3><ul>";
    $htmlBody .= sprintf('<li>%s (%s)</li>',
        $videoId,
        $thumbnailUrl);
    $htmlBody .= sprintf('<img src="%s">', $thumbnailUrl);
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
  // Si aucun token d'accès n'est présent dans la session, demander à l'utilisateur d'autoriser l'application
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;

  $authUrl = $client->createAuthUrl();
  $htmlBody = <<<END
<h3>Authorization Required</h3>
<p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}
?>

<!doctype html>
<html>
<head>
<link href="styletest.css" rel="stylesheet">
<title>Claim Uploaded</title>
</head>
<header>
  <div class="header-gauche">
    <a href="index.php">YouTube Manager</a>
  </div>
  <div class="header-milieu">
  <nav>
    <a href="index.php" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Accueil</a>
    <a href="geolocation_search.php" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Recherche Géographique</a>
    <a href="my_uploads.php" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Mes Vidéos</a>
    <a href="upload_thumbnail.php" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Mettre à jour</a>
    <a href="upload_video2.php" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Upload une vidéo</a>
  </nav>
  </div>
  <div class="header-droite">
  </div>
</header>
<body>
    <div id="particles-js">
        <div class="aligncenter" style="position:relative">
        <?=$htmlBody?>      
    </div>
      <script type="text/javascript" src="particles.js"></script>
      <script type="text/javascript" src="app.js"></script>
</body>
</html>