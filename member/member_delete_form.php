<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/css/normalize.css">
    <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/css/slide.css">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/css/common.css?ver=2">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/member/css/member.css?ver=2">
    <script type="text/javascript" src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/member/js/member_modify.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/vendor/modernizr.custom.min.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/vendor/jquery-1.10.2.min.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/slide.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT']."/test_myhome/header.php"; ?>
    </header>
    <section>
        <div id="main_img_bar">
            <div class="slideshow">
                <div class="slideshow_slides">
                    <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/slide-1.jpg" alt="slide1"></a>
                    <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/slide-2.jpg" alt="slide2"></a>
                    <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/slide-3.jpg" alt="slide3"></a>
                    <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/slide-4.jpg" alt="slide4"></a>
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
            <div id="join_box">
                <form name="member_form" method="post" action="member_delete.php?id=<?= $userid ?>">
                    <h2>회원 탈퇴</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <?= $userid ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="buttons">
                        <input style="cursor:pointer" type="submit" value="삭제하기">
                        &nbsp;
                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/index.php">
                            <input id="reset_button" style="cursor:pointer" type="button" value="취소하기">
                        </a>
                    </div>
                </form>
            </div> <!-- join_box -->
        </div> <!-- main_content -->
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT']."/test_myhome/footer.php"; ?>
    </footer>
</body>

</html>