<?php

	//ページタイトル
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合せ確認';

	session_start();

	// 未入力の項目があれば入力画面に遷移
	if(empty($_SESSION['staff_first_name']) || empty($_SESSION['staff_second_name']) || empty($_SESSION['mail_address']) || empty($_SESSION['question_text'])){
		header('Location:./AWQUES01.php');
		exit();
	}

?>
<?php
	// Header共通ファイルを読み込む
	include './contact-header.php';
?>

<form action="./AWQUES03.php" method="post">
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
お問合せ確認
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
<div class="col-sm-6">
<div class="contact-text">
<?php
	print htmlspecialchars($_SESSION['staff_first_name'], ENT_QUOTES, 'UTF-8');
?>
&ensp;&ensp;
<?php
  print htmlspecialchars($_SESSION['staff_second_name'], ENT_QUOTES, 'UTF-8');
?>
&ensp;様
</div>
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
<div class="contact-text">
<?php
	print htmlspecialchars($_SESSION['mail_address'], ENT_QUOTES, 'UTF-8');
?>
</div>
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
<div class="contact-text">
<?php
  print htmlspecialchars($_SESSION['question_text'], ENT_QUOTES, 'UTF-8');
?>
</div>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="1">
<input type="submit" id="confirmation_button" class="submit_button" value="送信"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<form action="./AWQUES01.php" method="post">
<input type="hidden" name="back" value="2">
<input type="submit" id ="back_button" class="submit_button" value="戻る"/>
</form>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
