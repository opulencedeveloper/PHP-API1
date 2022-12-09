<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__). $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php"); // Including database

class Music {
    private $table = 'musics';

    public $id;
    public $user_id;
    public $song_name;
    public $artist;
    public $sessions;

    public  function __construct(){}

    public function validate_params($value) {
        return(!empty($value));
    }

    public function add_music() {
        global $database;

        $this->user_id = trim(htmlspecialchars(strip_tags($this->user_id)));
        $this->song_name = trim(htmlspecialchars(strip_tags($this->song_name)));
        $this->artist = trim(htmlspecialchars(strip_tags($this->artist)));
        $this->sessions = trim(htmlspecialchars(strip_tags($this->sessions)));
        
        $sql = "INSERT INTO $this->table (user_id, song_name, artist, sessions) VALUES (
            '" .$database->escape_value($this->user_id). "',
            '" .$database->escape_value($this->song_name). "',
            '" .$database->escape_value($this->artist). "',
            '" .$database->escape_value($this->sessions). "'
            )";

        $result = $database->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function all_music() {
        global $database;

        $sql = "SELECT id, user_id, song_name, artist, sessions FROM $this->table";

        $result = $database->query($sql);

        return $database->fetch_array($result);
    }
}

$music = new Music();