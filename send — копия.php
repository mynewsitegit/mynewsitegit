<? // #начало Обработчик данных
header("Content-Type: text/html; charset=UTF-8");

if($_POST['name']) { $name = htmlspecialchars ($_POST['name']); }
if($_POST['phone']) { $phone = htmlspecialchars ($_POST['phone']); }
if($_POST['title']) { $title = htmlspecialchars ($_POST['title']); }
$ip_r = $_SERVER['REMOTE_ADDR'];

$product = "Срочная компьютерная помощь на дому"; // Подпись отправителя

$name1 =  substr(htmlspecialchars(trim($name)), 0, 100); 
$phone1 =  substr(htmlspecialchars(trim($phone)), 0, 20);

 
	
if(empty($phone1)) {
	echo '<h2><p align=center><font color="red">Внимание! Запрещено отправлять пустые поля.<br> Вернитесь и заполните обязательные поля <b>"Имя"</b> и <b>"Телефон"</b></font><br><br><a href="javascript:history.back()">Вернуться назад</a></p></h2>';
	exit; } 
	
	if($_POST['tip']) { 
	
	if($_POST['tip'] == '1') { $model = 'Hover Ball 1 шт'; }
	if($_POST['tip'] == '2') { $model = 'Hover Ball 3 шт'; }
	if($_POST['tip'] == '3') { $model = 'Hover Ball 6 шт'; }
	
	} else { $model = '<span style="color:grey;">Данных нет</span>'; }
	
$tema_r = 'ЗАКАЗ: на Срочную компьютерную помощь на дому';	 
$to = "почта"; // ЗДЕСЬ МЕНЯЕМ ПОЧТУ НА КОТОРУЮ ПРИХОДЯТ ЗАКАЗЫ!
$from="{$product} <noreply@{$_SERVER['HTTP_HOST']}>"; // Адрес отправителя

$subject="=?utf-8?B?". base64_encode("$tema_r"). "?=";
$header="From: $from"; 
$header.="\nContent-type: text/html; charset=\"utf-8\"";
$message = 'Имя: '.$name.' <br>Телефон: '.$phone.' 
 

<br>Заказано с лендинга: '.$_SERVER['HTTP_REFERER'].' <br>IP адрес клиента: <a href="http://ipgeobase.ru/?address='.$ip_r.'">'.$ip_r.'</a><br>Время заказа: '.date("Y-m-d H:i:s").'';
?>

<?if(mail($to, $subject, $message, $header)):?>

<!-- ========================================================= НАЧИНАЕМ ФОРМИРОВАТЬ HTML СТРАНИЦУ ПОДТВЕРЖДЕНИЯ ======================================================== --> 
	
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<meta name='robots' content='noindex,follow' />
	<title>Ваш заказ принят!</title>
	<link rel="stylesheet" href="cssl/style.css" />
	<style>
		#senks_block {color: #313E47;text-align: center;position: fixed;top: 10%;width: 100%;}
		#senks_block img {width: 185px;margin-bottom: 10px;}
		#senks_block h1 {font-size: 36px;font-weight: 700;text-transform: uppercase;color: rgba(9, 14, 100, 0.7);}
		.senks_text {line-height: 1.2;font-size: 18px;margin: 25px auto;}
		.senks_red {color: #fff;font-size: 19px;font-weight: bold;background: rgba(9, 14, 100, 0.7);height: 45px;line-height: 45px;}
	</style>
 
</head>
<body style="background-size: 100% 100%;">
	<div id="senks_block">
		<img src="index.png" alt="">
		<h1><? if(isset($name)){echo $name;} ?><br>Ваш заказ принят!</h1>
		<p class='senks_text'>В рабочее время (09:00 - 21:00) ожидайте звонок от нашего оператора для подтверждения заказа.<br><br>Пожалуйста, проконтролируйте чтобы ваш контактный телефон <b>"<?=$phone?>"</b> был включен.</p>
		<p class='senks_red'>Пожалуйста<? if(isset($name)){echo " ".$name;} ?>, дождитесь звонка от оператора</p>
	</div>
</body>
</html>


<!-- ======================================================== ОКОНЧАНИЕ СТРАНИЦЫ ПОДТВЕРЖДЕНИЯ ======================================================== --> 
	
 

<!-- ======================================================== ОКОНЧАНИЕ СТРАНИЦЫ ПОДТВЕРЖДЕНИЯ ======================================================== --> 
	
<?endif;?>