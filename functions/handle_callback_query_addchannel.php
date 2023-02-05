<?php
function handle_callback_query_addchannel($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "addchannel_")
    and !empty($botdata["message"])){
        f("proses_addchannel_3_ok")($botdata);
        return true;
    }
    return false;
}