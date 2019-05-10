<?php
include_once('simple_html_dom.php');
$message 	= file_get_contents('http://localhost/sendEmail-v156/resume.php');
$message2 	= file_get_html('http://localhost/sendEmail-v156/resume.php');
echo $message ;
echo "<br>";
echo $message2 ;

?>