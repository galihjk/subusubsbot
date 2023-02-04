<?php
function proses_addchannel_1($botdata){
    $textsend = "<b>PROSES TAMBAH CHANNEL (1/3)</b>\n";
    $textsend .= "Masukkan Channel\nAwali dengan @\n\n<i>*bot ini perlu ditambahkan ke channel tersebut</i>\n/cancel - batalkan";
    $chat_id = $botdata["chat"]["id"];
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>$textsend,
        "parse_mode"=>"HTML",
        "reply_to_message_id"=>$botdata["message_id"],
        'reply_markup' => [
            'force_reply'=>true,
            'input_field_placeholder'=>'Channel',
            'selective'=>true,
        ],
    ]);
    return true;
}