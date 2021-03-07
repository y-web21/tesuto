<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class ViewLog extends Model
{
    use HasFactory;

    /**
     * IP毎の記事の閲覧回数を積算します。(デフォルト:最終アクセスから1日後に再カウント)
     *
     * @param integer $id
     * @param integer $recount_second
     * @return void
     */
    public static function createViewLog(int $id = 0, int $recount_second = 60*60*24) {
        $record = ViewLog::orderBy('updated_at', 'desc')->Article($id)->Ip()->first();

        if (is_null($record)){
            ViewLog::addArticleLog($id);
        } else {
            $last_access = new Carbon($record->updated_at);

            if ($last_access->diffInSeconds(Carbon::now()) > $recount_second){
                ViewLog::addArticleLog($id);
            };
        }
    }

    private static function addArticleLog($id){
        $log = new ViewLog();
        $log->article_id = $id;
        $log->session_id = Request::getSession()->getId();
        $log->ip = Request::getClientIp();
        $log->agent = Request::header('User-Agent');
        $log->save();
    }

    public function scopeIp($query){
        return $query->where('ip', '=', Request::getClientIp());
    }

    public function scopeArticle($query, $id){
        return $query->where('article_id', '=', $id);
    }
}
