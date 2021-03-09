<?php

namespace App\Library;

class Convid19Api
{

    // curl --location --request GET 'https://covid19-japan-web-api.now.sh/api//v1/prefectures' | jq
    // private $api_url = "https://covid19-japan-web-api.now.sh/api//v1/prefectures"; // response 308
    private $api_url = "https://covid19-japan-web-api.now.sh/api/v1/prefectures";
    public $lastUpdate = '';
    private $update_cycle = 60 * 60 * 2; // Update data every 2 hours
    private $directory = './../storage/api/';   // ./ = app/public/
    private $filename = 'covid19.json';
    private $update_log_file = 'covid19.txt';
    private $path;
    private $log_path;

    public function __construct()
    {
        $this->path = $this->directory . $this->filename;
        $this->log_path = $this->directory . $this->update_log_file;
        $this->initTimestampFile();
    }


    private function initTimestampFile()
    {
        if (!file_exists($this->log_path)) {
            if (!file_exists($this->directory)) {
                if (!mkdir($this->directory, 0644, true)) {
                    die('Failed to create folders...');
                }
            }
            file_put_contents($this->log_path, $_SERVER['REQUEST_TIME']);
        }
    }

    private function writeText(string $dir, string $filename, $text)
    {
        if (!file_exists($dir . $filename)) {
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0644, true)) {
                    die('Failed to create folders...');
                }
            }
        }
        file_put_contents($dir . $filename, $text);
    }

    public function getJson()
    {
        if ($this->isUseLocalFile()) {
            // return 'local json';
            return file_get_contents($this->path);
        } else {
            // return 'wep json';

            $result = $this->getApiData($this->api_url);

            if (empty($result)) {
                return null;
            }

            if ($this->isJson($result)) {
                $this->writeText($this->directory, $this->filename, $result);
                $this->writeText($this->directory, $this->update_log_file, $_SERVER['REQUEST_TIME']);
                return $result;
            }

            // if (is_string($result)) {

            // }

        }
        return null;
    }

    private function isJson($str): bool
    {
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    private function isUseLocalFile(): bool
    {
        $last_update = file($this->log_path, FILE_IGNORE_NEW_LINES)[0];
        if (
            $_SERVER['REQUEST_TIME'] - $last_update < $this->update_cycle &&
            file_exists($this->path)
        ) {
            return true;
        }
        return false;
    }

    private function curlCore($url)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true, // get as a string
            CURLOPT_TIMEOUT => 2,
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        return $ch;
    }

    private function getApiData($url)
    {
        $ch = $this->curlCore($url);
        $ret_string = curl_exec($ch);
        $info = curl_getinfo($ch);
        $errno = curl_errno($ch);

        if ($errno !== CURLE_OK) {
            return [];
        }

        switch ($info['http_code']) {
            case 200:
                break;
            case 308:
                return $info['redirect_url'];
                break;
            default:
                return [];
        }

        return $ret_string;
    }
}
