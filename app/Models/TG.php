<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Telegram;

class TG extends Model
{
    use HasFactory;

    public $telegram;
     function __construct()
    {
    
        $this->telegram = new Telegram("526089126:AAFiI4Kbe-kSaIF4SLducdVyI6FSJtesFZM",false/*,["type"=>CURLPROXY_SOCKS5,
        "url"=>"127.0.0.1",
    "port"=>"1080"]*/);

    }

    public function sendTextToGroup($text)
    {
       
        $content = array('chat_id' => "-1001700457489", 'text' => $text);
        return $this->telegram->sendMessage($content);
    }

}
