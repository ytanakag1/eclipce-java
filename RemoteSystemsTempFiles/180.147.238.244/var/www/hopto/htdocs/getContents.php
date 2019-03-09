<?php // 終了時刻5分前にタイマー起動、現在値を15sサイクルで取得するクラス
session_start();
//require_once 'header.php';

class GetContents{
	
	const Price__value  = 'Price__value'; //タグクラスネーム 現在値
	const Price__tax   = '<span class="Price__tax">'; 
	const Close__datetime = '<span class="ProductDetail__bullet">：</span>'; //終了時間 自動延長
  
	function getplice(){
	// URLパラメータでIDを渡す	http://localhost/getContents.php?q118147976
		
	if(empty($_SERVER['QUERY_STRING'])) exit("<h2>URLパラメータがありません");
	
	
	$yahoacID = $_GET['yahoacID'];
	 if( empty($_SESSION[$yahoacID])){ //商品情報がなければCSVから取得
	    $taskfile = new SplFileObject("task.csv"); 
	    $taskfile->setFlags(SplFileObject::READ_CSV); 
	
	    foreach ($taskfile as $key => $line) {
	      if(!is_null($line[0])){
	      	
	        $strt = strripos($line[0], '/') +1; //文字列の最後にある/の位置
	        	$strt = 'id_'. substr($line[0], $strt); // id_yahacID
	        
	          if($yahoacID ==  $strt ){  //URLパラメータと等しい場合
	          
	   //page5 サブドメイン取得
			        $sttd = strpos($line[0], '.'); //文字列の最初にある.の位置
			        $stts = strpos($line[0], '/') +2; //文字列の最初にある/の位置
							$page =  substr($line[0], $stts,$sttd-$stts);
								$_SESSION[$yahoacID]= array('yahoacURL'=>trim($line[0]),
														 'goalPlice'=>$line[1],
														 'taskName'=>$line[2],
														 'close_time'=>$line[4],
														 'page'=>$page,
														 'crumb'=>$line[5]
														 );
		
		//	タスクを削除
								require 'setCondition.php';
									$tc = new TascController();
									$tc->tascdelete($_SESSION[$yahoacID]['taskName']);
								  break;
	          }
	      } 
	    } //end foreach 
		//csvから行削除
								$taskfile   = file('task.csv');
								unset($taskfile[$key]);
								file_put_contents('task.csv', $taskfile);						
	      
	  } 
   
	 
		$yahoac = file_get_contents( "{$_SESSION[$yahoacID]['yahoacURL']}" ); //ページ取得
		$pos_value = mb_strpos($yahoac, self::Price__value);  //値段 文字位置検索
		$pos_tax = mb_strpos($yahoac, self::Price__tax);

		
		
 //価格取得開始echo $yahoac;
		if ($pos_value !== false) {
			
			$pos_value += 14;
			$pos_tax -= $pos_value + 1;
			$price = mb_substr( $yahoac , $pos_value, $pos_tax ); //値段切り出し
			$price = str_replace(',', '', $price); //カンマ除去
			$price = (int)trim($price);
					
				if( preg_match("/^[0-9]+$/",$price)  )	{ //数字のみなら
						if( $price >= $_SESSION[$yahoacID]['goalPlice']){  
							//目標価格を超えていたら終了する
							echo '<p>現在値'. $price .' →  目標'.$_SESSION[$yahoacID]['goalPlice'];
							$_SESSION[$yahoacID]=null;
								exit("目標価格を超えていたので終了する");
								
						}else{
							//目標価格を超えていない場合。15sごとに再帰する
							//終了時間取得


						  $pos = mb_strpos($yahoac, '<dt class="ProductDetail__title">終了日時</dt>');  //最初の位置を検索
						  
						 //日時 開始位置取得
						      if($pos !== false){
						        $yahoac=mb_substr( $yahoac , $pos); //終了時間以降を切り出し
						
						        $pos_datetime = mb_stripos($yahoac, self::Close__datetime) +44;
						        $close_date = mb_substr( $yahoac , $pos_datetime,10 ); //日付切り出し
						        $close_date = str_replace('.', '/', $close_date);
						        $close_time = mb_substr( $yahoac , $pos_datetime+ 13  ,5 ); //時間切り出し
						        $close_time = date("H:i:s", strtotime($close_time ) );  
						        
								  if($close_date === date("Y/m/d", strtotime($close_date)) &&  //日付として正しいかチェック
								     $close_time===date("H:i:s", strtotime($close_time ))) //時間として正しいかチェック
								        $close_arry = array($close_date , $close_time);
								    }

							
							 		echo '<meta http-equiv="refresh" content="10"></head>';
									echo '<h2>現在値' .$price .'目標'.$_SESSION[$yahoacID]['goalPlice'].'</h2>';
           //詳細書き出し
              echo "<table>";
                foreach ($_SESSION[$yahoacID] as $key => $value) {
                  if($key == 'taskName'){
                    echo '<tr><td> taskName </td><td> '.mb_convert_encoding($_SESSION[$yahoacID]['taskName'] ,"UTF-8","SJIS" )."</td></tr>";
                  } else{
                    echo '<tr><td>'.$key ." </td><td> " .$value ."</td></tr>";
                  }
                }   
              echo "</table>";   

       					 date_default_timezone_set('Asia/Tokyo');
                 $noww = date('H:i:s');;
								  $now = date('H:i:s',strtotime("+30 second")); //現在時刻の1分先
									
									 echo "<p>今は " .  $noww; 
                    echo "<p>残り時間は " .gmdate('i:s',strtotime($close_time) - strtotime($noww) );
								 
			//時間になっても達成しないので終了			 
    								 if(strtotime($close_time) <= strtotime($now) ){  
    								 	header( "Location: http://localhost/cancel.php?yahoacID=".urlencode($yahoacID)
    								 	."&page=".$_SESSION[$yahoacID]['page'].'&crumb='. $_SESSION[$yahoacID]['crumb']) ;
    								 exit();
                     }
						}

				}else{echo "<h3> 現在値 に数字以外が含まれていると思われる</h3>";
					 exit($price);
				}
						 
		} else {
			echo '<meta http-equiv="refresh" content="10"></head>';
		     echo "文字列 'Price__value' は、文字列 '検索ページ' の中で見つかりませんでした";
				 exit();
		}
	

	}//End function
}

  $getcont = new GetContents();
  $getcont->getplice();
?>
