<?php 
session_start();
	$yahoacIDar= explode('_', $_GET['yahoacID']) ;
$yahoacID = $yahoacIDar[1]; 
	$page=$_GET['page'];
	$crumb=$_GET['crumb'];

$_POST = array();			
$_SESSION= array();
require_once 'header.php';  

	 echo "<p>" ,$page , "<p>", $crumb ;

?>
 </head>

<body onLoad="document.F.submit();"> <!-- 起動するだけでボタンが押される --> 
	<form name="F" action="https://<?=$page?>.auctions.yahoo.co.jp/jp/config/cancelauction" method="post">
		<input type="hidden" name="aID" value="<?=$yahoacID?>">
		<input type="hidden" name="crumb" value="<?=$crumb?>"> <!-- ブラウザごとに違う qLMutxTstAa-->
		<input type="hidden" name="cancel_fee" value="none">
		<input type="submit" name="confirm" value="取り消す">
	</form>
	<p><?= $yahoacID ?>の商品は取り消されました</p>
</body>
</html>