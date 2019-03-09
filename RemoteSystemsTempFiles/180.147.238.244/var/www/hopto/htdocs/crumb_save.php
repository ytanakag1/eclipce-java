<?php
 function getCrumb(){
	
	$filename = '/var/www/hopto/htdocs/js/return_crumb.sh';
	$sh = file_exists($filename) ? $filename : false;
	$ck = '/var/www/hopto/htdocs/js/cookies_yhk.json';
	$ck = file_exists($ck) ? $ck : false;
	//var_dump($ck);

	if($sh){
		$cmd = 'sh '.$sh;
	//	var_dump($cmd);
		  system("$cmd > /dev/null &");
			$crumb = file_get_contents('js/crumb.txt');  
			return $crumb;
	//	var_dump($crumb);
	}
}