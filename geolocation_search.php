<?php

/**
 * This sample lists videos that are associated with a particular keyword and are in the radius of
 *   particular geographic coordinates by:
 *
 * 1. Searching videos with "youtube.search.list" method and setting "type", "q", "location" and
 *   "locationRadius" parameters.
 * 2. Retrieving location details for each video with "youtube.videos.list" method and setting
 *   "id" parameter to comma separated list of video IDs in search result.
 *
 * @author Ibrahim Ulukaya
 */

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

// This code executes if the user enters a search query in the form
// and submits the form. Otherwise, the page displays the form above.
if (isset($_GET['q']) && isset($_GET['maxResults'])) {
  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
  * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
  * Please ensure that you have enabled the YouTube Data API for your project.
  */
  $DEVELOPER_KEY = 'AIzaSyBsNJ73LB8TTAArgT_IYfo35yXllkrDPYs';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'type' => 'video',
        'q' => $_GET['q'],
        'location' =>  $_GET['location'],
        'locationRadius' =>  $_GET['locationRadius'],
        'maxResults' => $_GET['maxResults'],
    ));

    $videoResults = array();
    # Merge video ids
    foreach ($searchResponse['items'] as $searchResult) {
      array_push($videoResults, $searchResult['id']['videoId']);
    }
    $videoIds = join(',', $videoResults);

    # Call the videos.list method to retrieve location details for each video.
    $videosResponse = $youtube->videos->listVideos('snippet, recordingDetails', array(
    'id' => $videoIds,
    ));

    $videos = '';

    // Display the list of matching videos.
    foreach ($videosResponse['items'] as $videoResult) {
      $videos .= sprintf('<li>%s (%s,%s)</li>',
          $videoResult['snippet']['title'],
          $videoResult['recordingDetails']['location']['latitude'],
          $videoResult['recordingDetails']['location']['longitude']);
    }

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
    <a href="index.php">Youtube Manager</a>
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
