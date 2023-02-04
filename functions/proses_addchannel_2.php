<?php
function proses_addchannel_2($botdata){
    $text = $botdata["text"] ?? "";

    if(f("str_is_diawali")($text,"@")){
        $chat_id = $botdata["chat"]["id"];
        $userid = $botdata["from"]["id"];
        $getChatMember = f("bot_kirim_perintah")("getChatMember",[
            'chat_id'=>$text,
            'user_id'=>$userid,
        ]);
        if(empty($getChatMember["result"]["status"])){
            f("bot_kirim_perintah")("sendMessage",[
                "chat_id"=>$chat_id,
                "text"=>"GAGAL! Tambahkan dulu bot ini (@".f("get_config")("botuname","").") ke channel $text!",
            ]);
            f("proses_addchannel_1")($botdata);
        }
        elseif( $getChatMember["result"]["status"] != "creator" ){
            f("bot_kirim_perintah")("sendMessage",[
                "chat_id"=>$chat_id,
                "text"=>"GAGAL! Anda bukan creator channel itu!",
            ]);
            f("proses_addchannel_1")($botdata);
        }
        else{
            $textsend = "<b>PROSES TAMBAH CHANNEL (2/3)</b>\n";
            $textsend .= "Mau berapa subscriber? Biaya: 1 Koin per subscriber. Channel: $text";
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
        }
    }
    else{
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"GAGAL! awali dengan @",
        ]);
        f("proses_addchannel_1")($botdata);
    }
    return true;
}