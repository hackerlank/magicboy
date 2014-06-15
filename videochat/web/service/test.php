<?php
require(__DIR__.'/../../app.inc');
require(__DIR__.'/Services/ChatService.php');

$obj = new ChatService();
$r = $obj->getMockUsers();
var_dump($r);
?>