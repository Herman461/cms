<?php

class Router {
    private $pages = [];

    public function addRoute($url, $path) {
        $this->pages[$url] = $path;
    }
    private function deleteSlashes($str) {
        $str = substr_replace($str, '', 0, 1);
        if ($str[-1]) {
            $str = substr_replace($str, '', -1, 1);
        }
        return $str;
    }
    public function route($url) {

        $url = $this->deleteSlashes($url);

        $page = array_key_exists($url, $this->pages) ? $this->pages[$url] : "404.php";
        echo $url;
        if (file_exists($page)) {
            include_once $page;
        }
    }
}
