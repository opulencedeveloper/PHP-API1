<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request


include_once '../../models/Music.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($music->validate_params($_POST['user_id'])) {
        $music->user_id = $_POST['user_id'];
    } else {
        echo json_encode(array('success' => 0, 'error' => 'User ID is required!'));
        die();
    }

    if ($music->validate_params($_POST['song_name'])) {
        $music->song_name = $_POST['song_name'];
    } else {
        echo json_encode(array('success' => 0, 'error' => 'Song Name is required!'));
        die();
    }

    if ($music->validate_params($_POST['artist'])) {
        $music->artist = $_POST['artist'];
    } else {
        echo json_encode(array('success' => 0, 'error' => 'Artist Name is required!'));
        die();
    }

    if ($music->validate_params($_POST['sessions'])) {
        $music->sessions = $_POST['sessions'];
    } else {
        echo json_encode(array('success' => 0, 'error' => 'Sesssion is required!'));
        die();
    }

    if ($music->add_music()) {
        echo json_encode(array('success' => 1, 'message' => 'Music successfully added!'));
    } else {
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error!'));
    }

} else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
