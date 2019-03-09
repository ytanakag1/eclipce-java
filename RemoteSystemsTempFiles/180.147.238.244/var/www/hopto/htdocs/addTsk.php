<?php  /*
     * 毎月/毎週/毎日 実行されるコマンドを cron に登録する*/
 $m = '23' ;  # .---------------- minute (0 - 59)
 $h = '19' ;  # | .------------- hour (0 - 23)
 $d = '4' ;  # | | .---------- day of month (1 - 31)
 $t = '3' ;  # | | | .------- month (1 - 12) OR jan,feb,mar,apr ...
 $w= '*';	 # | | | | .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
 $cmd='php /var/www/hopto/htdocs/stab.php';    //実行するコマンド
// $cmd='/var/pptr/stab.sh';    //実行するコマンド

    /* cron への登録 */
    $file_name = '/var/spool/cron/apache';
    // $file_name = '/var/pptr/screenshot.js';

 var_dump( is_writable($file_name));
  // ファイルポインタを開く
  $fp = fopen( $file_name, 'a' );
    /* crontab に登録する行情報を生成 */
  fputs( $fp, "$m $h $d $t $w $cmd "."\n" ) ;
  // 開いたファイルポインタを閉じる
  fclose( $fp );
				
				

