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
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合わせ回答確認';

	session_start();

	if(empty($_SESSION['question_id']) || empty($_SESSION['answer_text'])){
		header('Location:./AWANSW01.php');
		exit();
	}

	if(empty($_POST['back'])){
		$_POST['back'] = "";
	}

	if($_POST['back'] == "confirmationToAWANSW04"){

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

		$answerText = addslashes($_SESSION['answer_text']);
		$questionId = $_SESSION['question_id'];

		// mb_language("Japanese");
		// mb_internal_encoding("UTF-8");
		//
		// $to      = $mail_address_db;
		// $subject = "お問合わせの回答に関するご連絡";
		// $message = $answer_text;
		// $headers = "From:inumberx@gmail.com";
		//
		// if(mb_send_mail($to,$subject,$message,$headers)){
		// }else{
		// 	exit('メールを送信できませんでした。');
		// }

		// ANSWER_IDカウント用SQL
		$countAnswerId = "SELECT COUNT(1) FROM E_STAFF_ANSWER;";

		// ANSWER_IDカウント処理
		$resultCountAnswerId = mysql_query($countAnswerId, $con);
		if(!$resultCountAnswerId){
			exit('データ取得処理に失敗しました。');
		}

		$dataCountAnswerId = mysql_fetch_assoc($resultCountAnswerId);
		$answerId = $dataCountAnswerId['COUNT(1)'];
		$answerId += 1;

		$cochargeId = "1";

		// E_STAFF_ANSWER登録処理
		$insertEStaffAnswer = "INSERT INTO E_STAFF_ANSWER (ANSWER_ID, COCHARGE_ID, ANSWER_TEXT, DELETE_FLG, REG_ID, REG_DATE, UPD_ID, UPD_DATE) VALUES ('$answerId', '$cochargeId', '$answerText', 0, '$cochargeId', cast(now() as datetime), '$cochargeId', cast(now() as datetime))";
		$result = mysql_query($insertEStaffAnswer, $con);
		if(!$result){
			exit('データを登録できませんでした。');
		}

		// E_STAFF_QUESTION更新処理
		$updateEStaffQuestion = "UPDATE E_STAFF_QUESTION SET ANSWER_ID = '$answerId', UPD_ID = '$answerId', UPD_DATE = cast(now() as datetime) WHERE QUESTION_ID = '$questionId'";
		$result = mysql_query($updateEStaffQuestion, $con);
		if(!$result){
			exit('データを登録できませんでした。');
		}

		$con = mysql_close($con);
		if (!$con) {
			exit('データベースとの接続を閉じられませんでした。');
		}

		$_SESSION['answer_name'] = "";
		$_SESSION['answer_text'] = "";

		header('Location:./AWANSW05.php');
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

	$questionId = $_SESSION['question_id'];

	$sql = "SELECT ES.STAFF_FIRST_NAME, ES.STAFF_SECOND_NAME, ES.STAFF_MAIL_ADDRESS,  ESQ.QUESTION_ID, ESQ.ANSWER_ID, ESQ.QUESTION_TEXT, ESQ.REG_DATE FROM E_STAFF_QUESTION ESQ INNER JOIN E_STAFF ES ON ES.STAFF_ID = ESQ.STAFF_ID AND ES.DELETE_FLG = 0 WHERE ESQ.QUESTION_ID = '$questionId' AND ESQ.DELETE_FLG = 0";

	$result = mysql_query($sql, $con);
	while ($data = mysql_fetch_array($result)) {

		if($data['ANSWER_ID'] != null || $data['ANSWER_ID'] != ""){
			header('Location:./AWANSW01.php');
			exit();
		}

		// 姓
		$stafFirstName = "";
		$stafFirstName = $data['STAFF_FIRST_NAME'];
		// 名
		$stafSecondName = "";
		$stafSecondName = $data['STAFF_SECOND_NAME'];
		// メールアドレス
		$stafMailAddress = "";
		$stafMailAddress = $data['STAFF_MAIL_ADDRESS'];
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

<form action="" method="post">
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
お問合わせ回答確認
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
	echo htmlspecialchars($stafFirstName, ENT_QUOTES , 'UTF-8');
?>
&ensp;
<?php
	echo htmlspecialchars($stafSecondName, ENT_QUOTES , 'UTF-8');
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
	echo htmlspecialchars($stafMailAddress, ENT_QUOTES , 'UTF-8');
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
回答内容
</div>
<div class="col-sm-8">
<p>
<?php
	echo htmlspecialchars($_SESSION['answer_text'], ENT_QUOTES , 'UTF-8');
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
<input type="hidden" name="back" value="confirmationToAWANSW04">
<input type="submit" id="confirmation_button" class="submit_button" value="送信"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<form action="./AWANSW03.php" method="post">
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="backToAWANSW04">
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
