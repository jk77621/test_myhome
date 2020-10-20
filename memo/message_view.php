<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/normalize.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/slide.css">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/common.css?ver=2">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/memo/css/message.css?ver=2">
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/modernizr.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-1.10.2.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/slide.js"></script>
</head>

<body>
	<header>
		<?php include  $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/header.php"; ?>
	</header>
	<section>
		<div id="main_img_bar">
			<div class="slideshow">
				<div class="slideshow_slides">
					<a href="#"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/img/slide-1.jpg" alt="slide1"></a>
					<a href="#"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/img/slide-2.jpg" alt="slide2"></a>
					<a href="#"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/img/slide-3.jpg" alt="slide3"></a>
					<a href="#"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/img/slide-4.jpg" alt="slide4"></a>
				</div>
				<div class="slideshow_nav">
					<a href="#" class="prev">prev</a>
					<a href="#" class="next">next</a>
				</div>
				<div class="slideshow_indicator">
					<a href="#" class="active"></a>
					<a href="#"></a>
					<a href="#"></a>
					<a href="#"></a>
				</div>
			</div>
		</div>
		<div id="message_box">
			<h3 class="title">
				<?php
				$mode = $_GET["mode"];
				$num  = $_GET["num"];

				include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";
				// $con = mysqli_connect("localhost", "user1", "12345", "sample");
				$sql = "select * from message where num=$num";
				$result = mysqli_query($con, $sql);

				$row = mysqli_fetch_array($result);
				$send_id    = $row["send_id"];
				$rv_id      = $row["rv_id"];
				$regist_day = $row["regist_day"];
				$subject    = $row["subject"];
				$content    = $row["content"];

				$content = str_replace(" ", "&nbsp;", $content);
				$content = str_replace("\n", "<br>", $content);

				if ($mode == "send")
					$result2 = mysqli_query($con, "select name from members where id='$rv_id'");
				else
					$result2 = mysqli_query($con, "select name from members where id='$send_id'");

				$record = mysqli_fetch_array($result2);
				$msg_name = $record["name"];

				if ($mode == "send")
					echo "송신 쪽지함 > 내용보기";
				else
					echo "수신 쪽지함 > 내용보기";
				?>
			</h3>
			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2"><?= $msg_name ?> | <?= $regist_day ?></span>
				</li>
				<li>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
				<?php
				if ($mode == "rv") {
				?>
					<li><button onclick="location.href='message_response_form.php?num=<?= $num ?>'">답변 쪽지</button></li>
				<?php
				} else {
				?>
					<li><button onclick="location.href='message_update_form.php?num=<?= $num ?>'">수정</button></li>
				<?php
				}
				?>
				<li><button onclick="location.href='message_delete.php?num=<?= $num ?>&mode=<?= $mode ?>'">삭제</button></li>
			</ul>
		</div> <!-- message_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/footer.php"; ?>
	</footer>
</body>

</html>