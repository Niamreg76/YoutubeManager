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

$htmlBody = <<<END
<form method="GET">
  <br>
  <div style="margin-bottom: 10px;">
    Recherche: <input type="search" id="q" name="q" placeholder="Entrer le nom d'une vidéo">
  </div>
  <div style="margin-bottom: 10px;">
    Localisation: <input type="text" id="location" name="location" placeholder="37.42307,-122.08427">
  </div>
  <div style="margin-bottom: 10px;">
    Rayon: <input type="text" id="locationRadius" name="locationRadius" placeholder="5km">
  </div>
  <div style="margin-bottom: 10px;">
    Nombre de résultats: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="5">
  </div>
  <input type="submit" value="Chercher">
</form>
END;

// Le code va s'éxécuter uniquement si le formulaire a été soumis
if (isset($_GET['q']) && isset($_GET['maxResults'])) {
  // Définir une clé de développeur pour accéder aux API de YouTube
  $DEVELOPER_KEY = 'AIzaSyBsNJ73LB8TTAArgT_IYfo35yXllkrDPYs';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Définir un objet pour accéder aux API de YouTube
  $youtube = new Google_Service_YouTube($client);

  try {
    // Appeler la méthode search.list pour récupérer les résultats de recherche
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'type' => 'video',
        'q' => $_GET['q'],
        'location' =>  $_GET['location'],
        'locationRadius' =>  $_GET['locationRadius'],
        'maxResults' => $_GET['maxResults'],
    ));

    $videoResults = array();
    # Fusionner les résultats de recherche pour créer une liste d'identifiants de vidéo
    foreach ($searchResponse['items'] as $searchResult) {
      array_push($videoResults, $searchResult['id']['videoId']);
    }
    $videoIds = join(',', $videoResults);

    # Appeler la méthode videos.list pour récupérer les métadonnées des vidéos
    $videosResponse = $youtube->videos->listVideos('snippet, recordingDetails', array(
    'id' => $videoIds,
    ));

    $videos = '';

    // Afficher les résultats de la recherche
    foreach ($videosResponse['items'] as $videoResult) {
      $videos .= sprintf('<li>%s (%s,%s)</li>',
          $videoResult['snippet']['title'],
          $videoResult['recordingDetails']['location']['latitude'],
          $videoResult['recordingDetails']['location']['longitude']);
    }

    // Afficher les résultats de la recherche en HTML
    $htmlBody .= <<<END
    <h3>Videos</h3>
    <ul>$videos</ul>
END;
  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
<head>
  <link href="styletest.css" rel="stylesheet">
  <!-- <link href="./dist/output.css" rel="stylesheet"> -->
<title>YouTube Geolocation Search</title>
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
