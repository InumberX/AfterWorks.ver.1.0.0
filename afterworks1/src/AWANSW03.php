<?php

	// ログインチェック
	// COOKIEが生成されていない
	// COOKIEの値がtrueではない場合
	if(!isset($_COOKIE["isLogin"]) || $_COOKIE["isLogin"] != "true") {
		// ログイン画面へ遷移
		header('Location:./AWLGIN01.php');
		exit();
	}

	//ページタイトル
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合せ回答入力';

	// エラー用定数
	// 必須チェック
	define("ERROR_EMPTY", "errorEmpty");
	// 文字数チェック
	define("ERROR_LENGTH", "errorLength");

	session_start();

	// パラメータが取得出来た場合
	if(isset($_GET['question_id'])){
		$_SESSION['question_id'] = $_GET['question_id'];
		header('Location:./AWANSW03.php');
	}else if(isset($_SESSION['question_id'])){
		// パラメータがSESSIONから取得出来た場合
		$questionId = $_SESSION['question_id'];
	}else{
		// パラメータが取得できなかった場合
		header('Location:./AWANSW01.php');
		exit();
	}

	// 回答内容
	if(!empty($_SESSION['answer_text'])){
		$_POST['answer_text'] = $_SESSION['answer_text'];
	}

	if(empty($_POST['back'])){
		$_POST['back'] = "";
	}

	// SESSIONクリア
	// 回答内容
	$_SESSION['answer_text'] = "";

	// 回答内容POSTが空の場合
	if(empty($_POST['answer_text'])){
		$_POST['answer_text'] = "";
	}

	$error['answer_text']="";

	if($_POST['back'] == "1"){
		//入力チェック
		// お問合せが入力されていない場合
		if($_POST['answer_text']==""){
			$error['answer_text']=ERROR_EMPTY;
		}else if(mb_strlen($_POST['question_text']) > 1000){
			// 文字数が1000文字より大きい場合
			$error['answer_text']=ERROR_LENGTH;
		}

    //問題が無ければお問合せ確認画面へ遷移
		if($error['answer_text']==""){
			$_SESSION['questionId'] = $questionId;
			$_SESSION['answer_text'] = $_POST['answer_text'];
			header('Location:./AWANSW04.php');
			exit();
		}
	}

	if($_POST['back'] == "backToAWANSW03"){
		$_SESSION['back'] = "backToAWANSW03";
		header('Location:./AWANSW01.php');
		exit();
	}

	$_POST['back'] = "";

	// データベース接続処理
  $con = mysql_connect('mysql534.db.sakura.ne.jp', 'inumberx', 'root-001');
  if (!$con) {
    exit('データベースに接続できませんでした。');
  }

  $result = mysql_select_db('inumberx_after_works', $con);
  if (!$result) {
    exit('データベースを選択できませんでした。');
  }

  $result = mysql_query('SET NAMES utf8', $con);
  if (!$result) {
    exit('文字コードを指定できませんでした。');
  }

	$sql = "SELECT ES.STAFF_FIRST_NAME, ES.STAFF_SECOND_NAME, ES.STAFF_MAIL_ADDRESS,  ESQ.QUESTION_ID, ESQ.ANSWER_ID, ESQ.QUESTION_TEXT, ESQ.REG_DATE FROM E_STAFF_QUESTION ESQ INNER JOIN E_STAFF ES ON ES.STAFF_ID = ESQ.STAFF_ID AND ES.DELETE_FLG = 0 WHERE ESQ.QUESTION_ID = '$questionId' AND ESQ.DELETE_FLG = 0";

	$result = mysql_query($sql, $con);
	while ($data = mysql_fetch_array($result)) {

		if($data['ANSWER_ID'] != null || $data['ANSWER_ID'] != ""){
			header('Location:./AWANSW01.php');
			exit();
		}

		// 姓
		$staffFirstName = "";
		$staffFirstName = $data['STAFF_FIRST_NAME'];
		// 名
		$staffSecondName = "";
		$staffSecondName = $data['STAFF_SECOND_NAME'];
		// メールアドレス
		$staffMailAddress = "";
		$staffMailAddress = $data['STAFF_MAIL_ADDRESS'];
		// お問合せ内容
		$questionText = "";
		$questionText = $data['QUESTION_TEXT'];
		// お問合せ日
		$regDate = "";
		$regDate = date('Y年n月j日',strtotime($data['REG_DATE']));
	}

	$con = mysql_close($con);
	if (!$con) {
		exit('データベースとの接続を閉じられませんでした。');
	}

?>

<?php
	// Header共通ファイルを読み込む
	include './answer-header.php';
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
お問合わせ回答入力
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
氏名
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($staffFirstName, ENT_QUOTES , 'UTF-8');
?>
&ensp;
<?php
	echo htmlspecialchars($staffSecondName, ENT_QUOTES , 'UTF-8');
?>
</p>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
メールアドレス
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($staffMailAddress, ENT_QUOTES , 'UTF-8');
?>
</p>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
お問合せ内容
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($questionText, ENT_QUOTES , 'UTF-8');
?>
</p>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
お問合せ日
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($regDate, ENT_QUOTES , 'UTF-8');
?>
</p>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
回答者氏名
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($regDate, ENT_QUOTES , 'UTF-8');
?>
</p>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
回答内容
</div>
<div class="col-sm-6">
<?php
	if($error['answer_text']==ERROR_EMPTY){
		echo('<div class="contact-error">お問合せ内容を入力して下さい（必須）</div>');
	}else if($error['answer_text']==ERROR_LENGTH){
		echo('<div class="contact-error">お問合せ内容は1000文字以内で入力して下さい</div>');
	}
?>
<textarea name="answer_text" class="contact-input" rows="8"  placeholder="回答内容を入力して下さい（最大1000文字）"><?php echo htmlspecialchars($_POST['answer_text'] , ENT_QUOTES , 'UTF-8'); ?></textarea>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="1">
<input type="submit" id="confirmation_button" class="submit_button" value="確認"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<form action="" method="post">
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="backToAWANSW03">
<input type="submit" id ="back_button" class="submit_button" value="戻る"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
