<?php

namespace App\Library;

class Covid19JpApi
{
    private $param = [
        'directory' => './../storage/api/',   // ./ = app/public/
        'url' => [
            // 'prefectures' => "https://covid19-japan-web-api.now.sh/api//v1/prefectures/dummy", // response 308
            'prefectures' => "https://covid19-japan-web-api.now.sh/api/v1/prefectures",
            'total' => "https://covid19-japan-web-api.now.sh/api/v1/total",
            // 'positives' => "https://covid19-japan-web-api.now.sh/api//v1/positives", // 308
            // 'positives' => "https://covid19-japan-web-api.now.sh/api/v1/positives", // 400
            'positives' => "https://covid19-japan-web-api.now.sh/api/v1/positives?prefecture=",
        ],
        'filename' => [
            'prefectures' => "covid19_prefectures.json",
            'total' => "covid19_total.json",
            'positives' => "covid19_positives.json",
        ],
        'api_log' => [
            'directory' => './../storage/logs/',
            'filename' => 'convid19api.log'
        ]
    ];

    private $update_cycle = 60 * 60 * 2; // Update data every 2 hours
    private $path;  // latest access file path
    private $time_got_from_api;
    private $hr308_redirect_url;
    private $latest_data;
    private $prefectureId = 12 ; // default tokyo
    public $data_location;  // latest access data location. web or local
    private $api_info = [
        'poweredBy' => 'COVID-19 Japan Web API',
        'poweredByUrl' => 'https://documenter.getpostman.com/view/9215231/SzYaWe6h',
        'updatedAt' => '',
    ];
    private $current_mode;
    private $NarrowDownByPrefecture = false;
    public $prefectures = [
        'name_ja' => [
            '北海道',
            '青森県',
            '岩手県',
            '宮城県',
            '秋田県',
            '山形県',
            '福島県',
            '茨城県',
            '栃木県',
            '群馬県',
            '埼玉県',
            '千葉県',
            '東京都',
            '神奈川県',
            '新潟県',
            '富山県',
            '石川県',
            '福井県',
            '山梨県',
            '長野県',
            '岐阜県',
            '静岡県',
            '愛知県',
            '三重県',
            '滋賀県',
            '京都府',
            '大阪府',
            '兵庫県',
            '奈良県',
            '和歌山県',
            '鳥取県',
            '島根県',
            '岡山県',
            '広島県',
            '山口県',
            '徳島県',
            '香川県',
            '愛媛県',
            '高知県',
            '福岡県',
            '佐賀県',
            '長崎県',
            '熊本県',
            '大分県',
            '宮崎県',
            '鹿児島県',
            '沖縄県',
        ],
        'name_en' =>[
            'Hokkaido',
            'Aomori',
            'Iwate',
            'Miyagi',
            'Akita',
            'Yamagata',
            'Fukushima',
            'Ibaraki',
            'Tochigi',
            'Gunma',
            'Saitama',
            'Chiba',
            'Tokyo',
            'Kanagawa',
            'Niigata',
            'Toyama',
            'Ishikawa',
            'Fukui',
            'Yamanashi',
            'Nagano',
            'Gifu',
            'Shizuoka',
            'Aichi',
            'Mie',
            'Shiga',
            'Kyoto',
            'Osaka',
            'Hyogo',
            'Nara',
            'Wakayama',
            'Tottori',
            'Shimane',
            'Okayama',
            'Hiroshima',
            'Yamaguchi',
            'Tokushima',
            'Kagawa',
            'Ehime',
            'Kochi',
            'Fukuoka',
            'Saga',
            'Nagasaki',
            'Kumamoto',
            'Oita',
            'Miyazaki',
            'Kagoshima',
            'Okinawa',
        ],
        'ISO_3166-2-JP' =>	[
            'JP-01',
            'JP-02',
            'JP-03',
            'JP-04',
            'JP-05',
            'JP-06',
            'JP-07',
            'JP-08',
            'JP-09',
            'JP-10',
            'JP-11',
            'JP-12',
            'JP-13',
            'JP-14',
            'JP-15',
            'JP-16',
            'JP-17',
            'JP-18',
            'JP-19',
            'JP-20',
            'JP-21',
            'JP-22',
            'JP-23',
            'JP-24',
            'JP-25',
            'JP-26',
            'JP-27',
            'JP-28',
            'JP-29',
            'JP-30',
            'JP-31',
            'JP-32',
            'JP-33',
            'JP-34',
            'JP-35',
            'JP-36',
            'JP-37',
            'JP-38',
            'JP-39',
            'JP-40',
            'JP-41',
            'JP-42',
            'JP-43',
            'JP-44',
            'JP-45',
            'JP-46',
            'JP-47',
        ],
    ];


    public function __construct()
    {
        // $this->update_cycle = 30;
    }

    public function getUpdateDatetime($date_formate = 'Y/m/d H:i')
    {
        // 即呼び出すとタイムスタンプが更新前に取得してしまうため、webから取得した際は別途時間を記録し、そちらを優先して返す
        $update_datetime = is_null($this->time_got_from_api) ? date($date_formate, filemtime($this->path)) : date($date_formate, $this->time_got_from_api);
        $this->time_got_from_api = null;
        $this->api_info['updatedAt'] = $update_datetime;
        return $update_datetime;
    }

    /**
     * set prefecture for queryPrefectures(), queryPositives()
     *
     * @param string $name ex. '東京都' or 'Tokyo' or 'JP-12'
     * @return $this
     */
    public function setPrefecture(string $name)
    {
        $index = $this->arrayRecursiveSearchKeyMap($name, $this->prefectures);
        if ($index === false) {
            // default tokyo
            $this->prefectureId = 12;
        }else{
            $this->prefectureId = $index[1];
        }
        $this->NarrowDownByPrefecture = true;
        return $this;
    }

    public function resetPrefecture()
    {
        $this->prefectureId = 12;
        $this->NarrowDownByPrefecture = false;
        return $this;
    }

    /**
     * get statistical data by prefectures
     *
     * @return $this
     */
    public function queryPrefectures()
    {
        $this->current_mode = 'prefectures';
        $this->latest_data = $this->getString('prefectures');
        return $this;
    }

    /**
     * get national statistical data
     *
     * @return $this
     */
    public function queryTotal()
    {
        $this->current_mode = 'total';
        $this->latest_data = $this->getString('total');
        return $this;
    }

    /**
     * get positives(感染者、陽性者) data
     *
     * @return $this
     */
    public function queryPositives()
    {
        $this->current_mode = 'positives';
        $this->param['url']['positives'] .= $this->prefectures['name_ja'][$this->prefectureIndex];
        list($basename, $extension) = explode('.',  $this->param['filename']['positives']);
        $this->param['filename']['positives'] = $basename . '-' . $this->prefectures['name_en'][$this->prefectureIndex] . '.' . $extension;
        $this->latest_data = $this->getString('positives');
        return $this;
    }

    /**
     * get national statistical data
     *
     * @return array
     */
    public function getArray()
    {
        $this->getUpdateDatetime();
        $ret = json_decode($this->latest_data, true);
        if ($this->NarrowDownByPrefecture && $this->current_mode = 'prefectures'){
            $ret = $ret[$this->prefectureId];
        }
        return $ret;
    }


    public function getApiInfo()
    {
        return $this->api_info;
    }


    /* =============================================================== */
    private function getString($target)
    {
        $this->path = $this->param['directory'] . $this->param['filename'][$target];

        if ($this->isUseLocalFile($this->path)) {
            return $this->getLocalData();
        }

        $result = $this->getApiData($target);

        // 308はリダイレクト先へデータを取得しに行く
        if ($result === '308') {
            $result = $this->getApiData($target, $this->hr308_redirect_url);
            $this->hr308_redirect_url = '';
        }

        // webからの取得に失敗した場合はローカルのjsonを取得
        if ($result == '' && file_exists($this->path)) {
            return $this->getLocalData();
        }

        if ($this->isJson($result)) {
            $this->time_got_from_api = $_SERVER['REQUEST_TIME'];
            $this->overwriteText($this->param['directory'], $this->param['filename'][$target], $result);
            return $result;
        }

        // failure
        return false;
    }

    private function getLocalData()
    {
        $this->data_location = 'local';
        try {
            $data = file_get_contents($this->path);
        } catch (\Throwable $th) {
            // failure
            return false;
        }
        return $data;
    }

    private function getApiData($target, $url = null): string
    {
        $this->data_location = 'web';
        $url = $url ?? $this->param['url'][$target];
        list($ret_string, $info, $errno) = $this->execCurl($url);

        if ($errno !== CURLE_OK) {
            return '';
        }

        // http response
        switch ($info['http_code']) {
            case '200':
                break;
            case '308':
                $this->hr308_redirect_url = $info['redirect_url'];
                $this->errLog($info['http_code'], $url);
                return $info['http_code'];
                break;
            case '400':
            case '404':
            case '410':
                $this->errLog($info['http_code'], $url);
                break;
            default:
                return '';
        }

        return $ret_string;
    }

    private function execCurl($url)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true, // get as a string
            CURLOPT_TIMEOUT => 2,
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $ret_string = curl_exec($ch);
        $info = curl_getinfo($ch);
        $errno = curl_errno($ch);

        return array($ret_string, $info, $errno);
    }

    private function errLog($err, $url = '')
    {
        switch ($err) {
            case '308':
                $log_message = '[Caution]' . $url . ' is ' . $err . ' responded. Redirected to ' . $this->hr308_redirect_url . "\n";
                break;
            case '400':
            case '404':
            case '410':
                $log_message = '[Warning]' . $url . ' is ' . $err . ' responded. Page not fuond.' . "\n";
                break;
            default:
        }

        if (isset($log_message)) {
            $this->appendText($this->param['api_log']['directory'], $this->param['api_log']['filename'], $log_message);
        }
    }


    /**
     * judge to use the json file stored on the server by modification timestamp
     *
     * @param string $path
     * @return boolean
     */
    private function isUseLocalFile($path): bool
    {
        if (!file_exists($path)) {
            return false;
        }

        $last_update = filemtime($path);
        if ($_SERVER['REQUEST_TIME'] - $last_update < $this->update_cycle) {
            return true;
        }
        return false;
    }


    /* =============================================================== */

    private function isJson($str): bool
    {
        json_decode($str);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    private function appendText(string $dir, string $filename, $text)
    {
        if (!file_exists($dir . $filename)) {
            if (!file_exists($dir)) {
                mkdir($dir, 0644, true);
            }
        }
        // open with exclusive lock
        file_put_contents($dir . $filename, $text, LOCK_EX | FILE_APPEND);
    }

    private function overwriteText(string $dir, string $filename, $text)
    {
        if (!file_exists($dir . $filename)) {
            if (!file_exists($dir)) {
                mkdir($dir, 0644, true);
            }
        }
        // open with exclusive lock
        file_put_contents($dir . $filename, $text, LOCK_EX);
    }

    private function arrayRecursiveSearchKeyMap($needle, $haystack) {
        foreach($haystack as $first_level_key=>$value) {
            if ($needle === $value) {
                return array($first_level_key);
            } elseif (is_array($value)) {
                $callback = $this->arrayRecursiveSearchKeyMap($needle, $value);
                if ($callback) {
                    return array_merge(array($first_level_key), $callback);
                }
            }
        }
        return false;
    }
}
