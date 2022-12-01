<?php

class Plugins {
    private $plugins = [];

    public function getPlugins() {

        $dir = DIR . 'admin/plugins_folder/';

        $folders = scandir($dir);

        foreach ($folders as $folder) {
            if ($folder === '.' || $folder === '..') continue;

            $plugin = $dir . $folder;
            if (!is_dir($plugin)) continue;

            $arr = [];

            $index_file = fopen($plugin . '/index.php', "r");
            if (!$index_file) continue;


            $begin = false;

            while (true) {
                $line = trim(fgets($index_file, 9999));

                if ($begin) {
                    if (preg_match('/\w+: \w+/', $line, $matches)) {
                        $property = $matches[0];

                        $delimiter = strpos($property, ':');

                        $key = substr($property, 0, $delimiter);
                        $value = substr($property, $delimiter + 1);
                        $arr[$key] = $value;
                    }
                }

                if (!$begin && stripos($line, '/*') !== false) {
                    $begin = true;
                }

                if (stripos($line, '*/') !== false) {
                    break;
                }

                if (feof($index_file)) break;
            }

            $this->plugins[$folder] = $arr;
        }
        var_dump($this->plugins);
    }
}
?>