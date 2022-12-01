<?php

require_once 'Database.php';

class FileManager {
    private $images = [];
    private $uploads_dir = '../../assets/images';
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function setImages() {
        $files = $this->reArrayFiles();

        $sql = '';
        foreach ($files as $file) {
            $filename = $file['name'];
            $fullpath =  "assets/images/" . $filename;

            $sql .= "INSERT INTO images (name, path) VALUES ('$filename', '$fullpath');";


            move_uploaded_file($file['tmp_name'], $fullpath);
        }
        var_dump($sql);
        $this->db->multi_query($sql);
    }

    private function renameFile() {
        // get image id
        // compare old name and current name
    }

    public function getImages() {
        $sql = "SELECT * FROM images LIMIT 5";
        $response = $this->db->query($sql);

        if ($response !== false) {
            $images = mysqli_fetch_all($response, MYSQLI_ASSOC);
            echo json_encode($images);
        }


    }

    private function reArrayFiles() {

        $files = $_FILES['files'];
        $arr = [];

        for ($i = 0; $i < count($files['name']); $i++) {
            foreach ($files as $key => $value) {
                $arr[$i][$key] = $files[$key][$i];
            }
        }

        return $arr;

    }
}

$file_manager = new FileManager($conn);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $file_manager->setImages();
        break;
    case 'GET':
        $file_manager->getImages();
        break;
}

