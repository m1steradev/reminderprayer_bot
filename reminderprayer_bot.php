<?php
    //Dasturchi Yaxyobek Raxmonov
    //MANBA BILAN OLING!

    ob_start();
    define("API_KEY","api token"); //BU YERGA BOT TOKENI
    $admin = "admin id";

    function bot($method,$datas=[]){
        $url = "https://api.telegram.org/bot".API_KEY. "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);

        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }else{
            return json_decode($res);
        }
    }

    $update = json_decode(file_get_contents("php://input"));
    $message = $update->message;
    $chat_id = $message->chat->id;
    $messaga_id = $message->message_id;
    $username = $message->from->username;
    $uid = $message->from->id;
    $ism = $message->from->first_name;
    $familya = $message->from->last_name;
    $name = "<a href='tg://user?id=$uid'>$ism $familya</a>";
    $text = $message->text;
    $type = $message->chat->type;
    $sana1 = date('d.m.Y');
    $time=date('H:i:s',strtotime('2 hour'));
    $adminuser="admin user";
    $botuser="https://t.me/reminderprayer_bot";
    $opened="2023-yil 14-sentabr soat 08:10 da";
    $reklama="Bu yerda 🫵sizning reklamangiz bo‘lishi mumkin edi, kechqolmadiz reklama bo‘yicha: 🤵‍♂-> $adminuser ga yozing"; 
    $reklama2="<a href='https://t.me/+RQzEqtJ9dPU4Mzdi'><b> KANALIMIZ </b> </a>";
    $idi = $message->from->id;
    if(!file_exists('steep.txt')){
    fopen('steep.txt','wr');
    }

    $xabar = $update->message;
    $xabar_id = $xabar->message_id;

    $step = file_get_contents('steep.txt');
    $step2 = file_get_contents("step/$chat_id.step");

    mkdir("step");
    mkdir("step/$chat_id");
    mkdir("stat");
    mkdir("ism");

    $sana = date('d-M Y',strtotime('2 hour'));
    $oy_nomi = date('F',strtotime('2 hour'));
    $bu_oy = date('t',strtotime('2 hour'));
    $bugungi_sana = date('d',strtotime('2 hour'));
    $natija=$bugungi_sana+72;
    $boldi="$natija kun bo‘ldi";

    //inline method
    $data = $update->callback_query->data;
    $qid = $update->callback_query->id;
    $id = $update->inline_query->id;
    $query = $update->inline_query->query;
    $query_id = $update->inline_query->from->id;
    $cid2 = $update->callback_query->message->chat->id;
    $mid2 = $update->callback_query->message->message_id;
    $callfrid = $update->callback_query->from->id;
    $callname = $update->callback_query->from->first_name;
    $calluser = $update->callback_query->from->username;
    $surname = $update->callback_query->from->last_name;
    $about = $update->callback_query->from->about;
    $nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";
    $back = "◀️ Orqaga";


    mkdir("data");

    $id = $message->from->id;
    $username = $message->from->username;

    $userlar = file_get_contents("stat/stat.txt");
    $stat = substr_count($userlar, "n");
    if(isset($message)){
    $baza = file_get_contents("stat/stat.txt");
    if(mb_stripos($baza,$chat_id) !==false){
    }else{
    $txt="n$chat_id";
    $file=fopen("stat/stat.txt","a");
    fwrite($file,$txt);
    fclose($file);
    }
    }

    // Yozmoqda... funksiyasi
    function sendTypingIndicator($chat_id) {
        $typingIndicator = array(
        'chat_id' => $chat_id,
        'action' => 'typing',
    );

    bot('sendChatAction', $typingIndicator);
    }

    function sendMessageWithTyping($chat_id, $message) {
    $typingDelay = 1; 
    sendTypingIndicator($chat_id);
    usleep($typingDelay * 1000);
    $mid = $message->message_id;
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $message,
        'reply_to_message_id' =>$message,
    ]);
    }

    sendMessageWithTyping($chat_id, "");

    // Botning tezligini o'lchash funksiyasi
    if($text=="/speed"){
        $start_time = round(microtime(true) * 1000);
            $send=  bot('sendmessage', [
                        'chat_id' => $chat_id, 
                        'text' =>"Loading...",
                    ])->result->message_id;
    
                            $end_time = round(microtime(true) * 1000);
                            $time_taken = $end_time - $start_time;
                            bot('editMessagetext',[
                                "chat_id" => $chat_id,
                                "message_id" => $send,
                                "text" => "$botuser botining tezligi👇🏻\n\n⚡️ Ботнинг тезлиги: " . $time_taken .  "Ms",
        ]);
        }

    // Asosiy qismi 
    if($text=="/start"){
        bot('SendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b> Ассаламу алейкум ва Раҳматуллаҳи ва Баракатуҳу $name!\n\nСиз ушбу бот оркали Намоз вактларида хабарлар олиб туришингиз мумкин!\n\nБот Тошкент вакти билан эслатма юборади. $time</b>",
            'parse_mode'=>"html",
        ]);
        }
    
        // if ($time == "08:48:00"){
        //     bot('SendMessage',[
        //         'chat_id'=>$admin,
        //         'message_id'=>$messaga_id,
        //         'text'=>"<b>PESHINGA</b>",
        //         'parse_mode'=>"html",
        //     ]);
        // }

          // ADMIN PANEL

    $admpan = json_encode([
        'resize_keyboard'=>true,
    'keyboard'=>[
    [['text'=>"📊 Statistika"],['text'=>"📫Pochta tizimi"]],[['text'=>"📁 Bot kodi"]],
    [['text'=>"⬅️ Orqaga"]],
    ]
    ]);

    if ($text == "⬅️ Orqaga"){
        bot('SendMessage',[
            'chat_id'=>$admin,
            'message_id'=>$messaga_id,
            'parse_mode'=>"html",
            'text'=>"Admin siz asosiy menyudasiz!" ,
            'reply_markup'=>$asosiy,
        ]);
    }

    $pochta = json_encode([
        'resize_keyboard'=>true,
    'keyboard'=>[
    [['text'=>"📝 Oddiy xabar"],['text'=>"🗑O‘chirish mumkin bo‘lgan xabar"]], 
    [['text'=>"🗑 Orqaga"]],
    ]
    ]);

    if ($text == "🗑 Orqaga"){
        bot('SendMessage',[
            'chat_id'=>$admin,
            'message_id'=>$messaga_id,
            'parse_mode'=>"html",
            'text'=>"Admin siz asosiy admin menyusidasiz!" ,
            'reply_markup'=>$admpan,
        ]);
    }

    if($text=="📫Pochta tizimi"){
    if($chat_id==$admin){
        bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>"<b>👨‍💻Xurmatli Admin, 📫Pochta tizimiga xush kelibsiz.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>$pochta,
    ]);
    }
    } 

    if($text=="/panel"){
    if($chat_id==$admin){
        bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>"<b>👨‍💻Admin paneliga xush kelibsiz.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>$admpan,
    ]);
    }else{
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>🚫 Ushbu bo'lim siz uchun emas.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>$asosiy,
    ]);
    }
    }
    $yubor1=file_get_contents("yubor.txt");
    if($text == "📝 Oddiy xabar" and $chat_id == $admin){
    $lichka=file_get_contents("stat/stat.txt");
    $lich=substr_count($lichka,"n");
    bot('deleteMessage',[
    'chat_id'=>$admin,
    'message_id'=>$message_id,
    ]);
    bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>🤖: $botuser\n
    👥Jami obunachilar:  $stat
    🙌Halol bo‘l va yana bir narsani unutma: Obunachilaring puldan ustun\n
    Xabar matnini yuboring:</b>",
    'parse_mode'=>'html',
    ]); 
    file_put_contents("yubor.txt","sendpost");
    }
    if($yubor1=="sendpost" and $idi == $admin){
    unlink("yubor.txt");
    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>↗️ Foydalanuvchilarga xabar yuborish boshlandi.</b>",
    "parse_mode"=>"html",
    ]);
    $x=0;
    $y=0;
    $lich = file_get_contents("stat/stat.txt");
    $lichim = substr_count($lich,"n");
    $lichka = explode("n",$lich);
    foreach($lichka as $lichkalar){
    $ok=bot('sendmessage',[
    'chat_id'=>$lichkalar,
    'text'=>"<b>$text</b>",
    'parse_mode'=>'html',
    json_encode([
    'inline_keyboard'=>[
    [['text'=>"",'url'=>"tg://user?id=$admin"]],
    ]
    ]),
    ])->ok;
    if($ok==true){
    $y=$y+1;
    bot('editmessagetext',[
    'chat_id'=>$chat_id,
    'text'=>"<b>✅️ Xabar yuborildi: $y ta

    ❌️ Xabar yuborilmadi: $x ta</b>",
    'message_id'=>$message_id+1,
    'parse_mode'=>'html',
    ]);
    }else{

    $x=$x+1;
    bot('editmessagetext',[
    'chat_id'=>$chat_id,
    'text'=>"<b>✅️ Xabar yuborildi: $y ta

    ❌️ Xabar yuborilmadi: $x ta</b>",
    'message_id'=>$message_id+1,
    'parse_mode'=>'html',
    ]);
    }
    }
    bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id+1,
    ]);
    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>✅️ Xabar yuborildi: $y ta

    ❌️ Xabar yuborilmadi: $x ta</b>",
    'parse_mode'=>'html',
    "reply_markup"=>$pochta,
    ]);
    }

    $xabar1=file_get_contents("xabar.txt");
    if($text == "🗑O‘chirish mumkin bo‘lgan xabar" and $chat_id == $admin){
    $lichka=file_get_contents("stat/stat.txt");
    $lich=substr_count($lichka,"n");
    bot('deleteMessage',[
    'chat_id'=>$admin,
    'message_id'=>$message_id,
    ]);
    bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>🤖: $botuser\n
    👥Jami obunachilar:  $stat
    🙌Halol bo‘l va yana bir narsani unutma: Obunachilaring puldan ustun\n
    Xabar matnini yuboring:</b>",
    'parse_mode'=>'html',
    ]); 
    file_put_contents("xabar.txt","sendpost");
    }
    if($xabar1=="sendpost" and $idi == $admin){
    unlink("xabar.txt");
    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>↗️ Foydalanuvchilarga xabar yuborish boshlandi.</b>",
    "parse_mode"=>"html",
    ]);
    $x=0;
    $y=0;
    $lich = file_get_contents("stat/stat.txt");
    $lichim = substr_count($lich,"n");
    $lichka = explode("n",$lich);
    foreach($lichka as $lichkalar){
    $ok=bot('sendmessage',[
    'chat_id'=>$lichkalar,
    'text'=>"<b>$text</b>",
    'parse_mode'=>'html',
    'reply_markup'=>$ochir,
    ])->ok;
    if($ok==true){
    $y=$y+1;
    bot('editmessagetext',[
    'chat_id'=>$chat_id,
    'text'=>"<b>✅️ Xabar yuborildi: $y ta

    ❌️ Xabar yuborilmadi: $x ta</b>",
    'message_id'=>$message_id+1,
    'parse_mode'=>'html',
    ]);
    }else{

    $x=$x+1;
    bot('editmessagetext',[
    'chat_id'=>$chat_id,
    'text'=>"<b>✅️ Xabar yuborildi: $y ta

    ❌️ Xabar yuborilmadi: $x ta</b>",
    'message_id'=>$message_id+1,
    'parse_mode'=>'html',
    ]);
    }
    }
    bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id+1,
    ]);
    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>✅️ Xabar yuborildi: $y ta

    ❌️ Xabar yuborilmadi: $x ta</b>",
    'parse_mode'=>'html',
    "reply_markup"=>$pochta, 
    ]);
    }



    if($text == "📊 Statistika"){
    bot('sendMessage',[
    'chat_id'=>$admin,
        'text'=>"<b>🤖$botuser 
    📊 Bot statistikasi

    👤 A'zolar: $stat ta

    📅 Sana: $sana
    ⌚️Soat: $time 
    🤵‍♂Admin: $adminuser

    ⚡️Bot ochilgan sana: $opened
    📌Bot ochilganiga: $boldi</b>",
    'parse_mode'=>'html',
    ]);
    }

    if($text == "📁 Bot kodi")
                if($chat_id == $admin){
            bot('sendDocument',[
            'chat_id'=>$admin,
            'document'=>new CURLFile(__FILE__),
            'caption'=>"<b>$botuser kodi</b>",
            'parse_mode'=>'html',
            ]);
            }else{
                bot('SendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"⚠️ Bu kod faqat Adminlar uchun!",
                'parse_mode'=>"html",
                ]);
                }
                
