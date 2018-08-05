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
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合わせ回答完了';

	session_start();

	if(empty($_SESSION['question_id'])){
		header('Location:./AWANSW01.php');
		exit();
	} else {
		$_SESSION['question_id'] = "";
	}

	$SESSION['back'] = "backToAWANSW05";
?>

<?php
	// Header共通ファイルを読み込む
	include './answer-header.php';
?>

<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-title">
お問合わせ回答完了
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8 contact-text">
<div class="row-title">
登録が完了しました。
</div>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<form action="./AWANSW01.php" method="post">
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="backToAWANSW05">
<input type="submit" id ="back_button" class="submit_button" value="お問合わせ検索・一覧へ"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
</form>
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
