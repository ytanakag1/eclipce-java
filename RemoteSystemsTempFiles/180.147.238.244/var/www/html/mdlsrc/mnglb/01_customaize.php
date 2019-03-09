<?php include 'header.php'; ?>
<style>.kiji img{max-width: 550px;}</style>
		<div  class="container bs-docs-container">

			<div id="article">
	
	
	
	
	
	<div id="text_area">
  <p><span style="font-size: 1.1em; font-weight: bold; line-height: 27.7992px;">ここまでの完成見本</span><br></p>
<img src="mt01/chap01.png" alt="完成見本">
</div>
<section class="kiji">
  <h2 id="1">1.この記事でカスタマイズすること</h2>
<ul>
  <li>3-1.グローバルメニューのデザインを変更する。
    <br> 2行にして大きく、左右にボーダーと背景色を追加する。
    <br>
    <img src="mt01/wordpress-simplicity-custom02.png" alt="メニューのカスタマイズ後" width="540">
  </li>

  <li>
    3-2.トップページのイメージ画像をスライドショーに
    <br>
    <img src="mt01/1a90_m1.png" alt="Meta Slider プラグイン">
  </li>

  <li>
    3-3.TOPページに「新着情報」が表示されるようにする
    <br>
    <img src="mt01/plugin_what_new.png" alt="What's New Plugin">
  </li>

  <li>
    3-3-1.見出しデザインのスタイルをカスタマイズ
    <br>
    <img src="mt01/midashi_h2.png" alt="見出しのカスタマイズ">
  </li>

  <li>
   3-4.特定のカテゴリーの最新記事リストを表示する。<br>見出しにアイコンも追加する
    <br>
    <img src="mt01/widget-left3.png" alt="ウィジェット アイコン">
  </li>

  <li>
    3-6.facebookのマングローブ畑のちいさなカレー屋さんをサイドバーに表示する（facebook page pluginの設置)
    <br>
    <img src="mt01/widget-left2.png" alt="カスタム ウィジェット facebook">
  </li>
 
  <li>
    3-7.サイドバーTOPに今週のランチ情報が表示されるようにする
    <br>
    <img src="mt01/widget-left4.png" width="350"alt="カスタム ウィジェット背景">
  </li>

  <li>
    全体の完成見本
    <br>
    <img src="mt01/chap02.png" alt="この章の完成">
  </li>
  </ul>
</section>

<section class="junbi">
  <h2 id="2">2.カスタマイズの準備</h2>
  <p>
    管理画面(ダッシュボード)の機能だけでできるカスタマイズには限界があります｡
    <br>
    この章ではオリジナルなカスタマイズ方法について記載していきます｡
    <br>
  </p>
  <p>
    カスタマイズは既存のファイルを<em>書き換える方法と</em>､WordPressにもともと備わっていない<em>機能を補完</em>するファイルを追加して
    行う方法があります｡
    <br>
  </p>
 <ul>
  <li>
    書き換える､または書き足すファイルは主に<em>スタイルシート｢style.css｣</em>です｡
    <br>
    このファイルはサイトの見た目を装飾する､つまりデザインのためのファイルです｡
  </li>
  <li>
    機能を補完するファイル(ファイルの集まり)のことを<em>｢プラグイン｣</em>といいます｡
  </li>
</ul>  <p>
    ただし準備といっても特に用意するものはなく､ブラウザだけですべてできてしまいますので､コードの部分はコピペしていくだけでOKです｡
    あとは効率の良い操作方法ですが、今から紹介しますので覚えていてください。<br>
  <br>
    wordpressで更新してからサイトを表示すると描画までには結構な時間がかかります。<br>
    スピードはサーバー次第ですが、早くても10秒くらいはかかると思います。<br>
   <br />
    せめて画面移動がないようにブラウザで管理画面と描画画面を別々にします。<br>
    <span class="relative" style="top:190px;left:250px">サイトを表示を右クリック→シークレットウィンドウで開く</span>
    <img src="mt01/wordpress-custom03.png" alt="管理画面"><br>
    <span class="relative" style="top:50px;left:300px">ログインしていない別ウィンドウがでてきます</span>
    <img src="mt01/wordpress-custom04.gif" alt="シークレットウィンドウ"><br>
    <span>こっちのウィンドウは更新ごとに<em>Shit+Cnrol+R</em>でリロードします。</span>
    
  </p>
  <p>さらに投稿者情報を表示しないようにもしておきましょう<br>
    外観→ カスタマイズ→ レイアウト(投稿・固定)の設定で「投稿者情報の表示」のチェックをオフにします
    <br>
    <img src="mt01/wordpress-custom06.gif" alt="レイアウト(投稿・固定)"><br>
    <span class="relative" style="top:130px;left:5px;width: 160px">ログイン状態で表示</span>
    <span class="relative" style="top:103px;left:175px;width: 160px">非ログイン状態で表示</span>
    <span class="relative" style="top:77px;left:344px;width: 150px">投稿者情報の表示なしでログイン状態で表示</span>
    <span class="relative" style="top:30px;left:507px;width: 141px">投稿者情報の表示なしで非ログイン状態で表示</span>
    <img src="mt01/wordpress-custom05.gif" alt="投稿者情報の表示"><br>
  </p>
  
  <div class="topics-container topics_width">
  <h2>スタイルシートの書き方</h2>
  <p>最後にもう一つ。
    <br>事前知識として知っておいたほうがいいのはスタイルシートの書き方のルールです。  </p>
    <p>
    下の例は&lt;h2&gt;という見出しのタグで囲ったメニューが表示されている状態です。  <br>
    タグで囲まない状態と比べると、文字が大きい事がわかります。<br><br>
    <em>タグで囲っただけで何かしらの色や大きさが加わる</em>ものがありますが、&lt;h2&gt;はサイズが24pxで
    色は黒です。<br>
    デザインするとは、簡単に言うと初期の色と大きさを変えるということです。<br>
     <img src="mt01/css01.gif" alt="tag css" style="margin-left: -18px;"> 
    </p>
 <p>スタイルシートのルールとは、「どのタグにどんなデザインを与えるか」という命令の書き方のことで   
    例として、
    &lt;h2&gt;で囲ったメニューという文字の色を変えてみます。<br>
    <br /><em>メニューの文字のところで右クリック → 検証 を選んでください。</em>
<img src="mt01/css04.gif" alt="" />
    <img src="mt01/css03.gif" alt="クラス適用" style="margin-left: -18px;"> <br>
    
      右側の囲み .article h2 が適用され、文字色は#333が指定されています。<br>
     <em> #9a2 に変えてみましょう。</em><br />
    <img src="mt01/css05.gif" alt="クラス適用" style="margin-left: -18px;"> <br>
      その下にある打ち消し線のスタイルは現在有効ではありません。<br><br>
      
      
 <div class="panel panel-warning">  <div class="panel-heading">    
      <h3 class="panel-title">注目すべきは、h2が&lt;div class="article"&gt;で囲まれているということです。</h3>
      </div>
      <br>つまり
       .article h2 の意味は、<em>「articleクラスに囲まれたh2に対して」</em>ということです。<br>
       もちろん全てのh2に対してであれば .article は不要です。
</p><p>       
デザインをどうしたいかはそれに続く中括弧{&nbsp;}で囲った中に、<em>{何が:どうなる;}</em>と書きます。
コロンは~"が"の役目でつまり助詞です。<br>
セミコロンは文の終わりの役目でつまり句点です。<br>
まとめると、<em>「articleクラスに囲まれたh2の色が緑になれ」</em>です。</p>
<p>
それぞれの名前は、.article h2が<em>「要素名」</em>colorが<em>「プロパティ」</em>、#9a2は<em>「値」</em>です。<br>
 </p>  
 <p>見本通りにならない場合は、先頭の .や# <br>
   改行のセミコロン; 区切り文字のコロン: <br>中カッコ{ &nbsp;}の閉じ忘れが主な原因だと思います。</p>
 </div>   
 </div> 
   <a href="" onclick="scrollToTop(); return false">トップに戻る</a>

</section>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
			</div>
	
		</div>
