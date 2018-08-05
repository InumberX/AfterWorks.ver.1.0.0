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
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合せ回答参照';

	session_start();

	// パラメータが取得出来た場合
	if(isset($_GET['question_id'])){
		$_SESSION['question_id'] = $_GET['question_id'];
		header('Location:./AWANSW02.php');
	}else if(isset($_SESSION['question_id'])){
		// パラメータがSESSIONから取得出来た場合
		$questionId = $_SESSION['question_id'];
	}else{
		// パラメータが取得できなかった場合
		header('Location:./AWANSW01.php');
		exit();
	}

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

	$sql = "SELECT
	  ES.STAFF_FIRST_NAME,
	  ES.STAFF_SECOND_NAME,
	  ES.STAFF_MAIL_ADDRESS,
	  ESQ.QUESTION_TEXT,
	  ESQ.REG_DATE AS QUESTION_DATE,
	  ESA.ANSWER_TEXT,
	  ESA.REG_DATE AS ANSWER_DATE,
	  MC.COCHARGE_FIRST_NAME,
	  MC.COCHARGE_SECOND_NAME,
	  MC.COCHARGE_MAIL_ADDRESS
	FROM
	  E_STAFF_QUESTION ESQ
	INNER JOIN
	  E_STAFF ES
	    ON
	      ES.STAFF_ID = ESQ.STAFF_ID
	      AND ES.DELETE_FLG = 0
	INNER JOIN
	  E_STAFF_ANSWER ESA
	    ON
	      ESA.ANSWER_ID = ESQ.ANSWER_ID
	      AND ESA.DELETE_FLG = 0
	INNER JOIN
	  M_COCHARGE MC
	    ON
	      MC.COCHARGE_ID = ESA.COCHARGE_ID
	      AND MC.DELETE_FLG = 0
	WHERE
	  ESQ.QUESTION_ID = '$questionId'
	  AND ESQ.DELETE_FLG = 0";

	$result = mysql_query($sql, $con);

	while ($data = mysql_fetch_array($result)) {

		if($data['STAFF_FIRST_NAME'] == null || $data['STAFF_FIRST_NAME'] == ""){
			header('Location:./AWANSW01.php');
			exit();
		}

		// 姓
		$staffFirstName = "";
		$staffFirstName = addslashes($data['STAFF_FIRST_NAME']);
		// 名
		$staffSecondName = "";
		$staffSecondName = addslashes($data['STAFF_SECOND_NAME']);
		// メールアドレス
		$staffMailAddress = "";
		$staffMailAddress = addslashes($data['STAFF_MAIL_ADDRESS']);
		// お問合せ内容
		$questionText = "";
		$questionText = addslashes($data['QUESTION_TEXT']);
		// お問合せ日
		$questionDate = "";
		$questionDate = date('Y年n月j日',strtotime($data['QUESTION_DATE']));
		// 回答者姓
		$cochargeFirstName = "";
		$cochargeFirstName = addslashes($data['COCHARGE_FIRST_NAME']);
		// 回答者名
		$cochargeSecondName = "";
		$cochargeSecondName = addslashes($data['COCHARGE_SECOND_NAME']);
		// 回答者メールアドレス
		$cochargeMailAddress = "";
		$cochargeMailAddress = addslashes($data['COCHARGE_MAIL_ADDRESS']);
		// 回答内容
		$answerText = "";
		$answerText = addslashes($data['ANSWER_DATE']);
		// 回答日
		$answerDate = "";
		$answerDate = date('Y年n月j日',strtotime($data['ANSWER_DATE']));
	}

	$con = mysql_close($con);
	if (!$con) {
		exit('データベースとの接続を閉じられませんでした。');
	}

	$_SESSION['back'] = "backToAWANSW02";

?>

<?php
	// Header共通ファイルを読み込む
	include './answer-header.php';
?>

<form action="./AWANSW01.php" method="post">
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
お問合せ回答参照
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
	echo htmlspecialchars($questionDate, ENT_QUOTES , 'UTF-8');
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
	echo htmlspecialchars($cochargeFirstName, ENT_QUOTES , 'UTF-8');
?>
&ensp;
<?php
	echo htmlspecialchars($cochargeSecondName, ENT_QUOTES , 'UTF-8');
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
回答者メールアドレス
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($cochargeMailAddress, ENT_QUOTES , 'UTF-8');
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
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($answerText, ENT_QUOTES , 'UTF-8');
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
回答日
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($answerDate, ENT_QUOTES , 'UTF-8');
?>
</p>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="backToAWANSW02">
<input type="submit" class="submit_button" value="戻る"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
