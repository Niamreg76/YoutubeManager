<?php
require_once 'config.php';
  
if (isset($_POST['submit'])) {
    $arr_data = array(
        'title' => $_POST['title'],
        'summary' => $_POST['summary'],
        'video_path' => $_FILES['file']['tmp_name'],
    );
    upload_video_on_youtube($arr_data);
}
  
function upload_video_on_youtube($arr_data) {
  
    $client = new Google_Client();
  
    $db = new DB();
  
    $arr_token = (array) $db->get_access_token();
    $accessToken = array(
        'access_token' => $arr_token['access_token'],
        'expires_in' => $arr_token['expires_in'],
    );
  
    $client->setAccessToken($accessToken);
  
    $service = new Google_Service_YouTube($client);
  
    $video = new Google_Service_YouTube_Video();
  
    $videoSnippet = new Google_Service_YouTube_VideoSnippet();
    $videoSnippet->setDescription($arr_data['summary']);
    $videoSnippet->setTitle($arr_data['title']);
    $video->setSnippet($videoSnippet);
  
    $videoStatus = new Google_Service_YouTube_VideoStatus();
    $videoStatus->setPrivacyStatus('public');
    $video->setStatus($videoStatus);
  
    try {
        $response = $service->videos->insert(
            'snippet,status',
            $video,
            array(
                'data' => file_get_contents($arr_data['video_path']),
                'mimeType' => 'video/*',
                'uploadType' => 'multipart'
            )
        );
        echo "Video uploaded successfully. Video ID is ". $response->id;
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
            $refresh_token = $db->get_refersh_token();
  
            $client = new GuzzleHttp\Client(['base_uri' => 'https://accounts.google.com']);
  
            $response = $client->request('POST', '/o/oauth2/token', [
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token,
                    "client_id" => GOOGLE_CLIENT_ID,
                    "client_secret" => GOOGLE_CLIENT_SECRET,
                ],
            ]);
  
            $data = (array) json_decode($response->getBody());
            $data['refresh_token'] = $refresh_token;
  
            $db->update_access_token(json_encode($data));
  
            upload_video_on_youtube($arr_data);
        } else {
            echo $e->getMessage(); //print the error just in case your video is not uploaded.
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="styletest.css" rel="stylesheet">
    <title>Document</title>
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
            <form method="post" enctype="multipart/form-data">
                <p><input type="text" name="title" placeholder="Enter Video Title" /></p>
                <p><textarea name="summary" cols="30" rows="10" placeholder="Video description"></textarea></p>
                <p><input type="file" name="file" /></p>
                <input type="submit" name="submit" value="Submit" />
            </form>           
        </div>
        <script type="text/javascript" src="particles.js"></script>
        <script type="text/javascript" src="app.js"></script>    
</body>
</html>

