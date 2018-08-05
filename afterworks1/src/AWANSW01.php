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
	$title = 'After&ensp;Works.&ensp;|&ensp;お問合せ検索・一覧';

	// 定数
	// 回答状況（未回答）
	define("UNANSWERED", "unanswered");
	// 回答状況（回答済）
	define("ANSWERED", "answered");

	session_start();

	if(empty($_SESSION['staff_first_name'])){
		$_SESSION['staff_first_name'] = "";
	}

	if(empty($_SESSION['staff_second_name'])){
		$_SESSION['staff_second_name'] = "";
	}

	if(empty($_SESSION['mail_address'])){
		$_SESSION['mail_address'] = "";
	}

	if(empty($_SESSION['question_text'])){
		$_SESSION['question_text'] = "";
	}

	if(empty($_SESSION['question_date_start_year'])){
		$_SESSION['question_date_start_year'] = "";
	}

	if(empty($_SESSION['question_date_start_month'])){
		$_SESSION['question_date_start_month'] = "";
	}

	if(empty($_SESSION['question_date_start_day'])){
		$_SESSION['question_date_start_day'] = "";
	}

	if(empty($_SESSION['question_date_end_year'])){
		$_SESSION['question_date_end_year'] = "";
	}

	if(empty($_SESSION['question_date_end_month'])){
		$_SESSION['question_date_end_month'] = "";
	}

	if(empty($_SESSION['question_date_end_day'])){
		$_SESSION['question_date_end_day'] = "";
	}

	if(empty($_SESSION['answer_status'])){
		$_SESSION['answer_status'] = "";
	}

	if(empty($_POST['back'])){
		$_POST['back'] = "";
	}

	if(empty($_SESSION['back'])){
		$_SESSION['back'] = "";
	}

	if(empty($_POST['staff_first_name'])){
		$_POST['staff_first_name'] = "";
	}

	if(empty($_POST['staff_second_name'])){
		$_POST['staff_second_name'] = "";
	}

	if(empty($_POST['mail_address'])){
		$_POST['mail_address'] = "";
	}

	if(empty($_POST['question_text'])){
		$_POST['question_text'] = "";
	}

	if(empty($_POST['question_date_start_year'])){
		$_POST['question_date_start_year'] = '2015';
	}

	if(empty($_POST['question_date_start_month'])){
		$_POST['question_date_start_month'] = '1';
	}

	if(empty($_POST['question_date_start_day'])){
		$_POST['question_date_start_day'] = '1';
	}

	if(empty($_POST['question_date_end_year'])){
		$_POST['question_date_end_year'] = date('Y');
	}

	if(empty($_POST['question_date_end_month'])){
		$_POST['question_date_end_month'] = "12";
	}

	if(empty($_POST['question_date_end_day'])){
		$_POST['question_date_end_day'] = "31";
	}

	if(empty($_POST['answer_status'])){
		$_POST['answer_status'] = UNANSWERED;
	}

	if($_POST['back'] == "confirmationToAWANSW01"){

		if(!empty($_POST['staff_first_name'])){
			$_SESSION['staff_first_name'] = $_POST['staff_first_name'];
		}

		if(!empty($_POST['staff_second_name'])){
			$_SESSION['staff_second_name'] = $_POST['staff_second_name'];
		}

		if(!empty($_POST['mail_address'])){
			$_SESSION['mail_address'] = $_POST['mail_address'];
		}

		if(!empty($_POST['question_text'])){
			$_SESSION['question_text'] = $_POST['question_text'];
		}

		if(!empty($_POST['question_date_start_year'])){
			$_SESSION['question_date_start_year'] = $_POST['question_date_start_year'];
		}

		if(!empty($_POST['question_date_start_month'])){
			$_SESSION['question_date_start_month'] = $_POST['question_date_start_month'];
		}

		if(!empty($_POST['question_date_start_day'])){
			$_SESSION['question_date_start_day'] = $_POST['question_date_start_day'];
		}

		if(!empty($_POST['question_date_end_year'])){
			$_SESSION['question_date_end_year'] = $_POST['question_date_end_year'];
		}

		if(!empty($_POST['question_date_end_month'])){
			$_SESSION['question_date_end_month'] = $_POST['question_date_end_month'];
		}

		if(!empty($_POST['question_date_end_day'])){
			$_SESSION['question_date_end_day'] = $_POST['question_date_end_day'];
		}

		if(!empty($_POST['answer_status'])){
			$_SESSION['answer_status'] = $_POST['answer_status'];
		}

	}

	if(($_SESSION['back'] == "backToAWANSW02") || ($_POST['back'] == "backToAWANSW02") || ($_SESSION['back'] == "backToAWANSW03") || ($_POST['back'] == "backToAWANSW03") || ($_SESSION['back'] == "backToAWANSW05") || ($_POST['back'] == "backToAWANSW05")){

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

		if(!empty($_SESSION['question_date_start_year'])){
			$_POST['question_date_start_year'] = $_SESSION['question_date_start_year'];
		}

		if(!empty($_SESSION['question_date_start_month'])){
			$_POST['question_date_start_month'] = $_SESSION['question_date_start_month'];
		}

		if(!empty($_SESSION['question_date_start_day'])){
			$_POST['question_date_start_day'] = $_SESSION['question_date_start_day'];
		}

		if(!empty($_SESSION['question_date_end_year'])){
			$_POST['question_date_end_year'] = $_SESSION['question_date_end_year'];
		}

		if(!empty($_SESSION['question_date_end_month'])){
			$_POST['question_date_end_month'] = $_SESSION['question_date_end_month'];
		}

		if(!empty($_SESSION['question_date_end_day'])){
			$_POST['question_date_end_day'] = $_SESSION['question_date_end_day'];
		}

		if(!empty($_SESSION['answer_status'])){
			$_POST['answer_status'] = $_SESSION['answer_status'];
		}
	}

	if(empty($_POST['staff_first_name'])){
		$_SESSION['staff_first_name'] = "";
	}

	if(empty($_POST['staff_second_name'])){
		$_SESSION['staff_second_name'] = "";
	}

	if(empty($_POST['mail_address'])){
		$_SESSION['mail_address'] = "";
	}

	if(empty($_POST['question_text'])){
		$_SESSION['question_text'] = "";
	}

	if(empty($_POST['question_date_start_year'])){
		$_SESSION['question_date_start_year'] = "";
	}

	if(empty($_POST['question_date_start_month'])){
		$_SESSION['question_date_start_month'] = "";
	}

	if(empty($_POST['question_date_start_day'])){
		$_SESSION['question_date_start_day'] = "";
	}

	if(empty($_POST['question_date_end_year'])){
		$_SESSION['question_date_end_year'] = "";
	}

	if(empty($_POST['question_date_end_month'])){
		$_SESSION['question_date_end_month'] = "";
	}

	if(empty($_POST['question_date_end_day'])){
		$_SESSION['question_date_end_day'] = "";
	}

	if(empty($_POST['answer_status'])){
		$_SESSION['answer_status'] = UNANSWERED;
	}

	$_POST['back'] = "";
	$_SESSION['back'] = "";

	function optionLoop($start, $end, $value = null){
		for($i = $start; $i <= $end; $i++){
			if(isset($value) &&  $value == $i){
				echo "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
			}else{
				echo "<option value=\"{$i}\">{$i}</option>";
			}
		}
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
お問合わせ検索・一覧
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
<input type="text" name="staff_first_name" class="contact-input" maxlength = "10"  placeholder="田中" value="<?php echo htmlspecialchars($_POST['staff_first_name'] , ENT_QUOTES , 'UTF-8'); ?>">
</div>
<div class="col-sm-3">
<input type="text" name="staff_second_name" class="contact-input" maxlength = "10"  placeholder="太郎" value="<?php echo htmlspecialchars($_POST['staff_second_name'] , ENT_QUOTES , 'UTF-8'); ?>">
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
<input type="text" name="mail_address" class="contact-input" maxlength = "256" placeholder="abc@efg.com" value="<?php echo htmlspecialchars($_POST['mail_address'] , ENT_QUOTES , 'UTF-8'); ?>">
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
<input type="text" name="question_text" class="contact-input" maxlength = "100" value="<?php echo htmlspecialchars($_POST['question_text'] , ENT_QUOTES , 'UTF-8'); ?>"
>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
お問合せ日時
</div>
<div class="col-sm-6 contact-select">
<select name = "question_date_start_year" id = "question_date_start_year">
<?php
  optionLoop('2015', date('Y'), $_POST["question_date_start_year"]);
?>
</select>
年
<select name = "question_date_start_month" id ="question_date_start_month">
<?php
  optionLoop('1', '12', $_POST["question_date_start_month"]);
?>
</select>
月
<select name="question_date_start_day" id = "question_date_start_day">
<?php
  optionLoop('1', '31', $_POST["question_date_start_day"]);
?>
</select>
日&ensp;<br class="visible-xs visible-sm">～&ensp;<br class="visible-xs visible-sm">
<select name = "question_date_end_year" id = "question_date_end_year">
<?php
  optionLoop('2015', date('Y'), $_POST["question_date_end_year"]);
?>
</select>
年
<select name = "question_date_end_month" id ="question_date_end_month">
<?php
  optionLoop('1', '12', $_POST["question_date_end_month"]);
?>
</select>
月
<select name="question_date_end_day" id = "question_date_end_day">
<?php
  optionLoop('1', '31', $_POST["question_date_end_day"]);
?>
</select>
日
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-2 row-title">
回答状況
</div>
<div class="col-sm-6 contact-select">
<select name = "answer_status" id = "answer_status" >
<?php
  ( $_POST["answer_status"] == UNANSWERED ) ? $val = "selected" : $val = "" ;
?>
<option value="unanswered" <?= $val?>>未回答</option>
<?php
  ( $_POST["answer_status"] == ANSWERED ) ? $val = "selected" : $val = "" ;
?>
<option value="answered" <?= $val?>>回答済</option>
</select>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<input type="hidden" name="back" value="confirmationToAWANSW01">
<input type="submit" id ="confirmation_button" class="submit_button" value="検索"/>
</div>
<div class="col-sm-4">
</div>
</div><!-- /row -->
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8">
<table class="certificate-table table table-striped table-bordered">
<thead>
<tr>
<th>氏名</th>
<th>お問合わせ内容</th>
<th>お問合わせ日時</th>
<th>回答状況</th>
</thead>
<tbody>
<tr>
<?php

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

  // お問い合わせ一覧取得用SQL
  $selectQuestionList = "SELECT ES.STAFF_FIRST_NAME, ES.STAFF_SECOND_NAME, ESQ.QUESTION_ID, ESQ.ANSWER_ID, ESQ.QUESTION_TEXT, ESQ.REG_DATE FROM E_STAFF ES INNER JOIN E_STAFF_QUESTION ESQ ON ESQ.STAFF_ID = ES.STAFF_ID AND ES.DELETE_FLG = 0 WHERE ";

  // 検索条件の設定
  // 姓が入力されている場合
  if(!empty($_POST['staff_first_name'])){
    $selectQuestionList .= "ES.STAFF_FIRST_NAME LIKE '%{$_POST['staff_first_name']}%' and ";
  }

  // 名が入力されている場合
  if(!empty($_POST['staff_second_name'])){
    $selectQuestionList .= "ES.STAFF_SECOND_NAME LIKE '%{$_POST['staff_second_name']}%' and ";
  }

  // メールアドレスが入力されている場合
  if(!empty($_POST['mail_address'])){
    $selectQuestionList .= "ES.STAFF_MAIL_ADDRESS LIKE '%{$_POST['mail_address']}%' and ";
  }

  // お問合せ内容が入力されている場合
  if(!empty($_POST['question_text'])){
    $selectQuestionList .= "ESQ.QUESTION_TEXT LIKE '%{$_POST['question_text']}%' and ";
  }

  // お問合せ日時（開始）
  $question_date_start = $_POST['question_date_start_year'].'-'.$_POST['question_date_start_month'].'-'.$_POST['question_date_start_day'];

  // お問合せ日時（終了）
  $question_date_end = $_POST['question_date_end_year'].'-'.$_POST['question_date_end_month'].'-'.$_POST['question_date_end_day'];

  $selectQuestionList .= "ESQ.REG_DATE BETWEEN '".$question_date_start."' and '".$question_date_end."' and ";

  // 回答状況
  if($_POST['answer_status'] == UNANSWERED){
    $selectQuestionList .= "ESQ.ANSWER_ID IS NULL and ";
  } else if($_POST['answer_status'] == ANSWERED){
    $selectQuestionList .= "ESQ.ANSWER_ID IS NOT NULL and ";
  }

  // 末尾の「and」を削除
  $selectQuestionList = rtrim($selectQuestionList, ' and ');

  // 「ORDER BY」条件を設定
  $selectQuestionList .= " ORDER BY ESQ.REG_DATE DESC";

  // 検索処理実行
  $resultSelectQuestionList = mysql_query($selectQuestionList, $con);

  // 結果を出力
  while ($dataSelectQuestionList = mysql_fetch_assoc($resultSelectQuestionList)) {

    // 回答状況
    $answer = $dataSelectQuestionList['ANSWER_ID'];

    // 質問ID
    $questionId = $dataSelectQuestionList['QUESTION_ID'];

    // 回答IDが取得出来なかった場合
    if($answer == NULL){
      // 遷移先URL
      $url = './src/AWANSW03.php?question_id='.$questionId;

      // 回答状況
      $answerText = "未回答";
    }else{
      // 回答IDが取得出来た場合
      // 遷移先URL
      $url = './src/AWANSW02.php?question_id='.$questionId;

      // 回答状況
      $answerText = "回答済";
    }

    // お問合せ内容（先頭20文字）
    $text = mb_substr($dataSelectQuestionList['QUESTION_TEXT'], 0, 20, "UTF-8");
    $questionText = "<a href = .$url>$text</a>";

    echo '<tr><td>' . $dataSelectQuestionList['STAFF_FIRST_NAME'] . '&ensp;' . $dataSelectQuestionList['STAFF_SECOND_NAME'] . '&ensp;様</td>' .
      '<td>' . $questionText . '</td>' .
      '<td>' . date('Y年n月j日', strtotime($dataSelectQuestionList['REG_DATE'])) . '</td>' .
      '<td>' . $answerText . '</td></tr>';
  }

  // データベース切断処理
  $con = mysql_close($con);
  if (!$con) {
    exit('データベースとの接続を閉じられませんでした。');
  }
?>
</tbody>
</table>
</div>
<div class="col-sm-2">
</div>
</div><!-- /row -->
</form>
<?php
	// Footer共通ファイルを読み込む
	include './contact-footer.php';
?>
