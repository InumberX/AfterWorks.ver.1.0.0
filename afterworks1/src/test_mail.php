<?php
if(mb_send_mail('ueno.t.humansystem@gmail.com', 'TEST SUBJECT', 'TEST BODY')){
echo '送信完了';
}else{
echo '送信失敗';
}
?>