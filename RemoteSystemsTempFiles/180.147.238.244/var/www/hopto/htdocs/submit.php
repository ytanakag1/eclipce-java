<?php
/**
 * ルビ振りAPIへのリクエストサンプル（GET）
 *
$appid = 'dj00aiZpPW5xUDhkYm82U29vVyZzPWNvbnN1bWVyc2VjcmV0Jng9YTQ-';
 */

/*********************************************************
 ************   Yahoo! OAuth サンプルコード   ************
 *********************************************************
 *
 * Yahoo! マイ・オークションのウォッチリストを表示します
 *
 * *******************************************************
 *
 * 本サンプルを動作させるためには、予めトークンなどを
 * 保存するための機能を用意してください
 *
 * 例) $your_db = new YourDatabaseSecret();
 *
 * また、各フローの状態をクエリのパラメータで管理し
 * リダイレクトさせていますが、実装の際はCookieなどで
 * 状態を保存する必要があります
 *
 *********************************************************/

// 登録したアプリケーションのConsumer Key
$consumer_key    = 'dj00aiZpPThseUdjbFpnYlozNSZzPWNvbnN1bWVyc2VjcmV0Jng9NWQ-';
// 登録したアプリケーションのConsumer Secret
$consumer_secret = 'b4pOVp5WsJifeTGRpPyZPDxHRA84bupeC5SAiqR7';
// コールバックURL
$callback_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

// フィーチャーフォン向けの同意画面出しわけフラグ
$is_mobile = false;

// リクエストトークンURL
$request_token_url = 'https://auth.login.yahoo.co.jp/oauth/v2/get_request_token';
// アクセストークンURL
$access_token_url = 'https://auth.login.yahoo.co.jp/oauth/v2/get_token';
// Web API URL(マイ・オークション)
$auc_api_url = 'http://auctions.yahooapis.jp/AuctionWebService/V2/openWatchList';

try {

	/**
	 * OAuth インスタンス生成
	 * 署名方式は "OAUTH_SIG_METHOD_HMACSHA1" を指定
	 */
	$oauth = new OAuth($consumer_key, $consumer_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
	$oauth->disableSSLChecks(); // 開発時以外は使用しないようにしてください

	/**
	 * トークン・トークンシークレット保存用DBアクセスクラス
	 * (必要に応じて、MySQLやファイルなどに保存するための機能を用意してください)
	 */
	$your_db = new YourDatabaseSecret();

	if(!isset($_GET['authorized'])) {

		/**
		 * 1. リクエストトークン取得
		 */

		// リクエストトークン取得
		$request_token_info = $oauth->getRequestToken($request_token_url, $callback_url.'?authorized=1');

		// リクエストトークンをキーにして共有鍵を保存
		$your_db->set($request_token_info['oauth_token'], $request_token_info['oauth_token_secret']);

		// フューチャーフォンの同意画面出しわけ
		$redirect_url = $request_token_info['xoauth_request_auth_url'];
		$redirect_url .= $is_mobile ? "&xoauth_yahoo_mobile=1" : "";

		/**
		 * 2. End User認可リクエスト
		 */

		header('Location: '.$redirect_url);
		exit;

	} elseif ($_GET['authorized'] == 1) {

		/**
		 * 3. アクセストークン取得
		 */

		// 保存しておいたリクエストトークンシークレットを取り出す
		$request_token = $_GET['oauth_token'];
		$request_token_secret = $your_db->get($request_token);
		$verifier = $_GET['oauth_verifier'];

		// アクセストークン取得
		$oauth->setToken($request_token, $request_token_secret);
		$access_token_info = $oauth->getAccessToken($access_token_url, '', $verifier);

		// ユーザ識別子をキーにして共有鍵を保存
		$guid = $access_token_info['xoauth_yahoo_guid'];
		$session_handle = $access_token_info['oauth_session_handle'];
		$access_token = $access_token_info['oauth_token'];
		$access_token_secret = $access_token_info['oauth_token_secret'];
		$your_db->set($guid, "$session_handle&$access_token&$access_token_secret");

		header('Location: '.$callback_url.'?authorized=0&refresh=0&web_api=1&guid='.$guid);
		exit;

	} elseif ($_GET['refresh'] == 1) {

		/**
		 * アクセストークン更新
		 * (アクセストークンの有効期限が切れている場合に再発行する)
		 */

		// ユーザ識別子でセッションハンドルとアクセストークンを取り出す
		$guid = $_GET['guid'];
		$params = preg_split("/&/", $your_db->get($guid));
		$session_handle = $params[0];
		$access_token = $params[1];
		$access_token_secret = $params[2];

		// アクセストークン更新
		$oauth->setToken($access_token, $access_token_secret);
		$access_token_info = $oauth->getAccessToken($access_token_url, $session_handle);

		header('Location: '.$callback_url.'?authorized=0&refresh=0&web_api=1&guid='.$guid);
		exit;

	} elseif ($_GET['web_api'] == 1) {

		/**
		 * 4. Web API アクセス
		 */

		// ユーザ識別子でアクセストークンとアクセストークンシークレットを取り出す
		$guid = $_GET['guid'];
		$params = preg_split("/&/", $your_db->get($guid));
		$access_token = $params[1];
		$access_token_secret = $params[2];

		// Web APIにアクセスしてレスポンスを表示
		$oauth->setToken($access_token, $access_token_secret);
		$oauth->fetch($auc_api_url);
		$response = $oauth->getLastResponse();
		echo "<html><body><pre>".htmlspecialchars($response)."</pre></body></html>";

	}

} catch (OAuthException $e) {

	$last_response = $e->lastResponse;

	if(preg_match('/oauth_problem="token_expired"/', $last_response)) {

		// アクセストークンの有効期間が切れている場合はアクセストークンを更新
		$guid = $_GET['guid'];
		header('Location: '.$callback_url.'?authorized=0&refresh=1&web_api=0&guid='.$guid);
		exit;

	} elseif (preg_match('/oauth_problem="permission_denied"/', $last_response)) {

		// セッションハンドルの有効期間が切れている場合はリクエストトークンを取り直す
		header('Location: '.$callback_url);
		exit;

	}

	echo 'ERROR: '.$e;
}

/**
 * トークン・トークンシークレット保存用DBアクセスクラス
 * (必要に応じて、MySQLやファイルなどに保存するための機能を用意してください)
 */
class YourDatabaseSecret {

	public function __construct() {
		// 初期化
	}

	public function set( $key, $value ) {
		// 値を保存する処理
	}

	public function get( $key ) {
		// 値を取り出す処理
		return $value;
	}
}
