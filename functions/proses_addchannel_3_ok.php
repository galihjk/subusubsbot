<?php
function proses_addchannel_3_ok($botdata){
    $addchanneldata = $botdata["data"];
    f("bot_kirim_perintah")('answerCallbackQuery',[
        'callback_query_id' => $botdata['id'],
        'text' => "under!".print_r($addchanneldata,true),
        'show_alert' => true,
    ]);
}