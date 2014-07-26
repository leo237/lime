<?php
    include_once("url.php");

    $rawImage = $_REQUEST['image'];


    define ('UPLOAD_DIR', 'upload/');

    $img = str_replace('data:image/png;base64,', '', $rawImage);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    
    $data = $rawImage;
    $fileName = uniqid() . '.jpg';
    $file = UPLOAD_DIR . $fileName;

    $success = file_put_contents($file, $data);

    $fileHandle = fopen($fileName, "rb");
    $fileContents = stream_get_contents($fileHandle);
    fclose($fileHandle);

    $params = array(
        'http' => array
        (
            'method' => 'POST',
            'header'=>"Content-Type: multipart/form-data\r\n",
            'content' => $fileContents
        )
    );

    $ctx = stream_context_create($params);
    $fp = fopen($url, 'rb', false, $ctx);

    $response = stream_get_contents($fp)  

?>