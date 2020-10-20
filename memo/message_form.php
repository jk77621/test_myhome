<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/normalize.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/slide.css">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/common.css?ver=2">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/memo/css/message.css?ver=2">
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/memo/js/message.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/modernizr.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-1.10.2.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/slide.js"></script>
</head>

<body>
	<header>
		<?php include  $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/header.php"; ?>
	</header>
	<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";
	include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/create_table.php";

	create_table($con, 'message');

	if (!$userid) {
		echo ("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
	?>
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
			<h3 id="write_title">
				쪽지 보내기
			</h3>
			<ul class="top_buttons">
				<li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
				<li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
			</ul>
			<form name="message_form" method="post" action="message_insert.php">
				<div id="write_msg">
					<ul>
						<li>
							<span class="col1">보내는 사람 : </span>
							<span class="col2"><?= $userid ?><input name="send_id" type="hidden" value="<?= $userid ?>"></span>
						</li>
						<li>
							<span class="col1">수신 아이디 : </span>
							<span class="col2"><input name="rv_id" type="text"></span>
						</li>
						<li>
							<span class="col1">제목 : </span>
							<span class="col2"><input name="subject" type="text"></span>
						</li>
						<li id="text_area">
							<span class="col1">내용 : </span>
							<span class="col2">
								<textarea name="content"></textarea>
							</span>
						</li>
					</ul>
					<button type="button" onclick="check_input()">보내기</button>
				</div>
			</form>
		</div> <!-- message_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/footer.php"; ?>
	</footer>
</body>

</html>