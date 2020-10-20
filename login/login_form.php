<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome//css/normalize.css">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome//css/slide.css">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/common.css?ver=2">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/login/css/login.css?ver=2">
	<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/login/js/login.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/modernizr.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-1.10.2.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/slide.js"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT']."/test_myhome/header.php"; ?>
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

		<div id="main_content">
			<div id="login_box">
				<div id="login_title">
					<span>로그인</span>
				</div>
				<div id="login_form">
					<form name="login_form" method="post" action="login.php">
						<ul>
							<li><input type="text" name="id" placeholder="아이디"></li>
							<li><input type="password" id="pass" name="pass" placeholder="비밀번호"></li> <!-- pass -->
						</ul>
						<div id="login_btn">
							<a href="#"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/img/login.png" onclick="check_input()"></a>
						</div>
					</form>
				</div> <!-- login_form -->
			</div> <!-- login_box -->
		</div> <!-- main_content -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT']."/test_myhome/footer.php"; ?>
	</footer>
</body>

</html>