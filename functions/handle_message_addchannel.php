<?php
function handle_message_addchannel($botdata){
    
    $text = $botdata["text"] ?? "";
    if($text == "/addchannel" or $text == "/addchannel@".f("get_config")("botuname","")){
        return f("proses_addchannel_1")($botdata);
    }
    elseif(!empty($botdata['reply_to_message']['text'])
    and f("str_contains")($botdata['reply_to_message']['text'], "PROSES TAMBAH CHANNEL (1/3)")){
        return f("proses_addchannel_2")($botdata);
    }
    elseif(!empty($botdata['reply_to_message']['text'])
    and f("str_contains")($botdata['reply_to_message']['text'], "PROSES TAMBAH CHANNEL (2/3)")){
        return f("proses_addchannel_3")($botdata);
    }
    return false;
}