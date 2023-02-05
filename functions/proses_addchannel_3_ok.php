<?php
function proses_addchannel_3_ok($botdata){
    $explode = explode("_",$botdata["data"]);
    $creator = $explode[1];
    $channel = $explode[2];
    $jmlsubs = $explode[3];
    $user_id = $botdata["from"]["id"];
    $getChat = f("bot_kirim_perintah")('getChat',[
        'chat_id' => $channel,
    ]);
    if(!empty($getChat['result']['title'])){
        $title = $getChat['result']['title'];
        $description = $getChat['result']['description'];
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
        ]);
        $textsend = "Judul: ⏩$title⏪🡀\n";
        $textsend .= "Channel: ⏩$channel⏪🡀\n";
        $textsend .= "Deskripsi: ⏩$description⏪🡀\n";
        $textsend .= "Subscriber Diminta: ⏩$jmlsubs⏪🡀\n\n";
        $textsend .= "Creator: ⏩$creator⏪🡀\n";
        $textsend .= "Requester: ⏩$user_id\n";
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>f("get_config")("admin_chat_id"),
            "text"=>$textsend,
            "parse_mode"=>"HTML",
            'reply_markup'=>f("gen_inline_keyboard")([
                ['✅ Konfirmasi', 'admokaddchannel'],
                ['❌ Batalkan', 'admcanceladdchannel_'.$user_id.'_'.$jmlsubs],
            ]),
        ]);
    }
    else{
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
            'text' => "ERROR!",
            'show_alert' => true,
        ]);
    }
    
}