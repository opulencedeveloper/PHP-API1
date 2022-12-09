<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__). $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php"); // Including database

class Content {
    private $table = 'ndienuani_content';

    public $content_id;
    public $content_name;
    public $content_details;
    public $content_type;
    public $content_img;
    public $content_link;

    public  function __construct(){}

    public function all_content() {
        global $database;

        $sql = "SELECT content_id, content_name, content_details, content_type, content_img, content_link FROM $this->table";

        $result = $database->query($sql);

        return $database->fetch_array($result);
    }
}

$music = new Content();