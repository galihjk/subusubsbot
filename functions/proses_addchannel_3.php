<?php
function proses_addchannel_3($botdata){
    $text = $botdata["text"] ?? "";
    $channel = explode("Channel: ",$botdata['reply_to_message']['text'])[1];

    if(is_numeric($text) and $text > 0){
        $chat_id = $botdata["chat"]["id"];
        $userid = $botdata["from"]["id"];
        $jmlsubs = $text;
        $textsend = "$jmlsubs subs untuk $channel";
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>$textsend,
            "parse_mode"=>"HTML",
            "reply_to_message_id"=>$botdata["message_id"],
        ]);
    }
    else{
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"GAGAL! masukkan angka saja!",
        ]);
        $botdata["text"] = $channel;
        f("proses_addchannel_2")($botdata);
    }
    return true;
}