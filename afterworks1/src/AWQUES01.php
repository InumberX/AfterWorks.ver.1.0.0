<?php
	//ページタイトル
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合せ入力';

	// エラー用定数
	// 必須チェック
	define("ERROR_EMPTY", "errorEmpty");
	// 文字数チェック
	define("ERROR_LENGTH", "errorLength");
	// メールアドレス形式チェック
	define("ERROR_ADDRESS", "errorAddress");

	session_start();

	if(!empty($_SESSION['staff_first_name'])){
		$_POST['staff_first_name'] = $_SESSION['staff_first_name'];
	}

	if(!empty($_SESSION['staff_second_name'])){
		$_POST['staff_second_name'] = $_SESSION['staff_second_name'];
	}

	if(!empty($_SESSION['mail_address'])){
		$_POST['mail_address'] = $_SESSION['mail_address'];
	}

	if(!empty($_SESSION['question_text'])){
		$_POST['question_text'] = $_SESSION['question_text'];
	}

	if(empty($_POST['back'])){
		$_POST['back'] = "";
	}

	$_SESSION['staff_first_name'] = "";
	$_SESSION['staff_second_name'] = "";
	$_SESSION['mail_address'] = "";
	$_SESSION['question_text'] = "";


	if( empty($_POST['staff_first_name']) ) {
		$_POST['staff_first_name'] = "";
	}

	if( empty($_POST['staff_second_name']) ) {
		$_POST['staff_second_name'] = "";
	}

	if( empty($_POST['mail_address']) ) {
		$_POST['mail_address'] = "";
	}

	if( empty($_POST['question_text']) ) {
		$_POST['question_text'] = "";
	}

	$error['staff_first_name']="";
	$error['staff_second_name']="";
	$error['mail_address']="";
	$error['question_text']="";

	if($_POST['back'] == "2"){
		$_POST['back'] = "";
	}

	if(!empty($_POST['back'])){
		// 入力チェック
		// 姓が入力されていない場合
		if($_POST['staff_first_name']==""){
			$error['staff_first_name']=ERROR_EMPTY;
		}else if(mb_strlen($_POST['staff_first_name']) > 10){
			// 文字数が10文字より大きい場合
			$error['staff_first_name']=ERROR_LENGTH;
		}

		// 名が入力されていない場合
		if($_POST['staff_second_name']==""){
			$error['staff_second_name']=ERROR_EMPTY;
		}else if(mb_strlen($_POST['staff_second_name']) > 10){
			// 文字数が10文字より大きい場合
			$error['staff_second_name']=ERROR_LENGTH;
		}

		// メールアドレスが入力されていない場合
		if($_POST['mail_address']==""){
			$error['mail_address']=ERROR_EMPTY;
		}else if ( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9])+([a-zA-Z0-9\._-]+)+$/",$_POST['mail_address'] ) ) {
			// メールアドレスの形式ではない場合
			$error['mail_address']='m';
		}else if(mb_strlen($_POST['mail_address']) > 256){
			// 文字数が256文字より大きい場合
			$error['mail_address']=ERROR_LENGTH;
		}

		// お問合せが入力されていない場合
		if($_POST['question_text']==""){
			$error['question_text']=ERROR_EMPTY;
		}else if(mb_strlen($_POST['question_text']) > 1000){
			// 文字数が1000文字より大きい場合
			$error['question_text']=ERROR_LENGTH;
		}

		// 問題が無ければお問合せ確認画面へ遷移
		if($error['staff_first_name']=="" && $error['staff_second_name']=="" && $error['mail_address']=="" && $error['question_text']==""){
			$_SESSION['staff_first_name'] = $_POST['staff_first_name'];
			$_SESSION['staff_second_name'] = $_POST['staff_second_name'];
			$_SESSION['mail_address'] = $_POST['mail_address'];
			$_SESSION['question_type'] = $_POST['question_type'];
			$_SESSION['question_text'] = $_POST['question_text'];
			header('Location:./AWQUES02.php');
			exit();
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
お問合せ入力
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
<div class="col-sm-3">
<?php
	if($error['staff_first_name']==ERROR_EMPTY){
		echo('<div class="contact-error">姓を入力して下さい（必須）</div>');
	}else if($error['staff_first_name']==ERROR_LENGTH){
		echo('<div class="contact-error">姓は10文字以内で入力して下さい</div>');
	}
?>
<input type="text" name="staff_first_name" class="contact-input" maxlength = "10"  placeholder="姓を10文字までで入力して下さい" value="<?php echo htmlspecialchars($_POST['staff_first_name'] , ENT_QUOTES , 'UTF-8'); ?>">
</div>
<div class="col-sm-3">
<?php
	if($error['staff_second_name']==ERROR_EMPTY){
		echo('<div class="contact-error">名を入力して下さい（必須）</div>');
	}else if($error['staff_second_name']==ERROR_LENGTH){
		echo('<div class="contact-error">名は10文字以内で入力して下さい</div>');
	}
?>
<input type="text" name="staff_second_name" class="contact-input" maxlength = "10"  placeholder="名を10文字までで入力して下さい" value="<?php echo htmlspecialchars($_POST['staff_second_name'] , ENT_QUOTES , 'UTF-8'); ?>">
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
<div class="col-sm-6">
<?php
	if($error['mail_address']==ERROR_EMPTY){
		echo('<div class="contact-error">メールアドレスを入力して下さい（必須）</div>');
	}else if($error['mail_address']==ERROR_ADDRESS){
		echo('<div class="contact-error">メールアドレスの形式が不正です</div>');
	}else if($error['mail_address']==ERROR_LENGTH){
		echo('<div class="contact-error">メールアドレスは256文字以内で入力して下さい</div>');
	}
?>
<input type="text" name="mail_address" class="contact-input" maxlength = "256" placeholder="メールアドレスを256文字までで半角英数字で入力して下さい" value="<?php echo htmlspecialchars($_POST['mail_address'] , ENT_QUOTES , 'UTF-8'); ?>">
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
<div class="col-sm-6">
<?php
	if($error['question_text']==ERROR_EMPTY){
		echo('<div class="contact-error">お問合せ内容を入力して下さい（必須）</div>');
	}else if($error['question_text']==ERROR_LENGTH){
		echo('<div class="contact-error">お問合せ内容は1000文字以内で入力して下さい</div>');
	}
?>
<textarea name="question_text" class="contact-input" rows="8"  placeholder="お問合せ内容を入力して下さい（最大1000文字）"><?php echo htmlspecialchars($_POST['question_text'] , ENT_QUOTES , 'UTF-8'); ?></textarea>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="1">
<input type="submit" id ="form_submit_button" class="submit_button" value="確認"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
