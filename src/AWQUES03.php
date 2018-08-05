<?php

	//ページタイトル
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合せ完了';

	session_start();

	// 未入力の項目があれば入力画面に遷移
	if(empty($_SESSION['staff_first_name']) || empty($_SESSION['staff_second_name']) || empty($_SESSION['mail_address']) || empty($_SESSION['question_text'])){
		header('Location:./AWQUES01.php');
		exit();
	}

	$staffFirstName = addslashes($_SESSION['staff_first_name']);
	$staffSecondName = addslashes($_SESSION['staff_second_name']);
	$mailAddress = addslashes($_SESSION['mail_address']);
	$questionText = addslashes($_SESSION['question_text']);
	$questionId = "0";

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

	// STAFF_ID取得用SQL
	$selectStaffId = "SELECT STAFF_ID FROM E_STAFF WHERE STAFF_FIRST_NAME = '$staffFirstName' AND STAFF_SECOND_NAME = '$staffSecondName' AND STAFF_MAIL_ADDRESS = '$mailAddress'";

	// STAFF_ID取得処理
	$resultSelectStaffId = mysql_query($selectStaffId, $link);
	if(!$resultSelectStaffId){
		exit('データ取得処理に失敗しました。');
	}
	$dataSelectStaffId = mysql_fetch_assoc($resultSelectStaffId);
	$staffId = $dataSelectStaffId['STAFF_ID'];

	// STAFF_IDが取得出来た場合
	if($staffId != NULL) {
		// E_STAFF更新用SQL
		$updateEStaff = "UPDATE E_STAFF SET UPD_ID = 0, UPD_DATE = cast(now() as datetime) WHERE STAFF_ID = '$staffId'";

		// E_STAFF更新処理
		$resultUpdateEStaff = mysql_query($updateEStaff, $link);
		if(!$resultUpdateEStaff){
			exit('データ更新処理に失敗しました。');
		}
	} else {
		// STAFF_IDが取得出来なかった場合
		// STAFF_IDカウント用SQL
		$countStaffId = "SELECT COUNT(1) FROM E_STAFF";

		// STAFF_IDカウント処理
		$resultCountStaffId = mysql_query($countStaffId, $link);
		if(!$resultCountStaffId){
			exit('データ取得処理に失敗しました。');
		}

		$dataCountStaffId = mysql_fetch_assoc($resultCountStaffId);
		$staffId = $dataCountStaffId['COUNT(1)'];
		$staffId += 1;

		// E_STAFF登録用SQL
		$insertEStaff = "INSERT INTO E_STAFF (STAFF_ID, STAFF_FIRST_NAME, STAFF_SECOND_NAME, STAFF_MAIL_ADDRESS, DELETE_FLG, REG_ID, REG_DATE, UPD_ID, UPD_DATE) VALUES ('$staffId', '$staffFirstName', '$staffSecondName', '$mailAddress', 0, 0, cast(now() as datetime), 0, cast(now() as datetime))";

		// E_STAFF更新処理
		$resultInsertEStaff = mysql_query($insertEStaff, $link);
		if(!$resultInsertEStaff){
			exit('データ登録処理に失敗しました。');
		}
	}

	// QUESTION_IDカウント用SQL
	$countQuestionId = "SELECT COUNT(1) FROM E_STAFF_QUESTION";

	// QUESTION_IDカウント処理
	$resultCountQuestionId = mysql_query($countQuestionId, $link);
	if(!$resultCountQuestionId){
		exit('データ取得処理に失敗しました。');
	}

	$dataCountQuestionId = mysql_fetch_assoc($resultCountQuestionId);
	$newQuestionId = $dataCountQuestionId['COUNT(1)'];
	$newQuestionId += 1;

	// E_STAFF_QUESTION登録用SQL
	$insertEStaffQuestion = "INSERT INTO E_STAFF_QUESTION (QUESTION_ID, ANSWER_ID, STAFF_ID, QUESTION_TEXT, DELETE_FLG, REG_ID, REG_DATE, UPD_ID, UPD_DATE) VALUES ('$newQuestionId', NULL, '$staffId', '$questionText', 0, 0, cast(now() as datetime), 0, cast(now() as datetime))";

	// E_STAFF_QUESTION更新処理
	$resultInsertEStaffQuestion = mysql_query($insertEStaffQuestion, $link);
	if(!$resultInsertEStaffQuestion){
		exit('データ登録処理に失敗しました。');
	}

	// データベース切断処理
	$link = mysql_close($link);
	if(!$link){
		exit('データベースとの接続を閉じられませんでした。');
	}

	$_SESSION["staff_first_name"] = $staffFirstName;
	$_SESSION["staff_second_name"] = $staffSecondName;
	$_SESSION["mail_address"] = $mailAddress;
	$_SESSION["question_text"] = "";
	$question_id = "";
?>

<?php
	// Header共通ファイルを読み込む
	include './contact-header.php';
?>
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
お問合せ完了
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-text">
<div class="row-title">
送信が完了しました。
</div>
<div class="contact-text">
お問合せありがとうございました。<br>
回答につきましては、後日ご連絡を差し上げます。
</div>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<form action="./AWQUES01.php" method="post">
<input type="hidden" name="back" value="2">
<input type="submit" id ="next_button" class="submit_button" value="続けてお問合せを入力"/>
</form>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="button" id ="top_button" class="submit_button" value="トップへ戻る" onClick="location.href='http://after-works.2-d.jp/src/index.html'" />
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
