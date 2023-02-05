<?php
function proses_addchannel_3($botdata){
    $text = $botdata["text"] ?? "";
    $chat_id = $botdata["chat"]["id"];
    $channel = explode("Channel: ",$botdata['reply_to_message']['text'])[1];
    $explode_creator = explode("Creator: [",$botdata['reply_to_message']['text'])[1];
    $creator = explode("]",$explode_creator)[0];

    if(is_numeric($text) and $text > 0){
        $userid = $botdata["from"]["id"];
        $jmlsubs = $text;
        $textsend = "<b>PROSES TAMBAH CHANNEL (3/3)</b>\n";
        $textsend .= "KONFIRMASI\n";
        $textsend .= "Channel: [$channel]\n";
        $textsend .= "Creator: [$creator]\n";
        $textsend .= "Subscribers diminta: [$jmlsubs]\n";
        $textsend .= "Biaya: $jmlsubs Koin";
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>$textsend,
            "parse_mode"=>"HTML",
            "reply_to_message_id"=>$botdata["message_id"],
            'reply_markup'=>f("gen_inline_keyboard")([
                ['✅ Kirim', 'addchannel_'.$creator.'_'.$channel.'_'.$jmlsubs],
                ['❌ Batal', 'cancel'],
            ]),
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