<?php
	//ページタイトル
	$title = 'After&ensp;Works.&ensp;|&ensp;ログイン';

	// エラー用定数
	// 必須チェック
	define("ERROR", "error");

	// COOKIE削除
	setcookie("isLogin", "true", time() - 1800);

	$loginId = "";
	$loginPassword = "";

	if(!empty($_POST['login_id'])){
		$loginId = $_POST['login_id'];
		$_POST['login_id'] = "";
	}

	if(!empty($_POST['login_password'])){
		$loginPassword = $_POST['login_password'];
		$_POST['login_password'] = "";
	}

	$error['login']="";

	if(!empty($_POST['back'])){
		// 入力チェック
		// IDまたはパスワードが入力されていない場合
		if($loginId == "" || $loginPassword == ""){
			$error['login'] = ERROR;
		}

		// IDとパスワードが入力されている場合
		if($error['login'] == ""){
			// データベース接続処理
			$link = mysql_connect('mysql534.db.sakura.ne.jp', 'inumberx', 'root-001');
			if(!$link){
				exit('データベースに接続できませんでした。');
			}

			$result = mysql_select_db('inumberx_after_works', $link);
			if(!$result){
				exit('データベースを選択できませんでした。');
			}

			$result = mysql_query('SET NAMES utf8', $link);
			if(!$result){
				exit('文字コードを指定できませんでした。');
			}

			// 登録されているユーザか確認
			$sql = "SELECT COUNT(1) FROM M_COCHARGE WHERE COCHARGE_MAIL_ADDRESS = '$loginId' AND COCHARGE_PASSWORD = '$loginPassword' AND DELETE_FLG = 0";

			$result = mysql_query($sql, $link);
			if(!$result){
				exit('データ取得処理に失敗しました。');
			}
			$data = mysql_fetch_assoc($result);
			$cnt = $data['COUNT(1)'];

			// データが取得出来た場合
			if($cnt > 0) {
				// COOKIE生成
				setcookie("isLogin", "true");
				// お問合せ内容検索画面に遷移
				header('Location:./AWANSW01.php');
				exit();
			} else {
				// データが取得出来なかった場合
				$error['login'] = ERROR;
			}
		}
	}
	$_POST['back'] = "";
?>
<?php
	// Header共通ファイルを読み込む
	include './contact-header.php';
?>
<form action="" method="post" enctype="multipart/form-data">

<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
ログイン
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8">
<?php
	if($error['login'] == ERROR){
		echo('<div class="contact-error">ID、PASSWORDに誤りがあります</div>');
	}
?>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
ID
</div>
<div class="col-sm-6">
<input type="text" name="login_id" class="contact-input" value="<?php echo htmlspecialchars($loginId, ENT_QUOTES , 'UTF-8'); ?>">
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
PASSWORD
</div>
<div class="col-sm-6">
<input type="password" name="login_password" class="contact-input" maxlength = "256" value="">
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="login">
<input type="submit" id ="form_submit_button" class="submit_button" value="ログイン"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
