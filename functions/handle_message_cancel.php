<?php
function handle_message_cancel($botdata){
    $text = $botdata["text"] ?? "";
    if($text == "/cancel" or $text == "/cancel@".f("get_config")("botuname","")){
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"Dibatalkan",
        ]);
        return true;
    }
    return false;
}