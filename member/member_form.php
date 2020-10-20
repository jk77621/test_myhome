<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/css/normalize.css">
    <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/css/slide.css">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/css/common.css?ver=2">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/member/css/member.css?ver=2">
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/vendor/modernizr.custom.min.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/vendor/jquery-1.10.2.min.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/js/slide.js"></script>
    <script>
        function check_input() {
            if (!document.member_form.id.value) {
                alert("아이디를 입력하세요!");
                document.member_form.id.focus();
                return;
            }

            if (!document.member_form.pass.value) {
                alert("비밀번호를 입력하세요!");
                document.member_form.pass.focus();
                return;
            }

            if (!document.member_form.pass_confirm.value) {
                alert("비밀번호확인을 입력하세요!");
                document.member_form.pass_confirm.focus();
                return;
            }

            if (!document.member_form.name.value) {
                alert("이름을 입력하세요!");
                document.member_form.name.focus();
                return;
            }

            if (!document.member_form.email1.value) {
                alert("이메일 주소를 입력하세요!");
                document.member_form.email1.focus();
                return;
            }

            if (!document.member_form.email2.value) {
                alert("이메일 주소를 입력하세요!");
                document.member_form.email2.focus();
                return;
            }

            if (document.member_form.pass.value !=
                document.member_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return;
            }

            document.member_form.submit();
        }

        function reset_form() {
            document.member_form.id.value = "";
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = "";
            document.member_form.email1.value = "";
            document.member_form.email2.value = "";
            document.ember_form.id.focus();
            return;
        }

        function check_id() {
            window.open("member_check_id.php?id=" + document.member_form.id.value,
                "IDcheck",
                "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
        }
    </script>
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
                    <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/slide-2.png" alt="slide2"></a>
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
                <form name="member_form" method="post" action="member_insert.php">
                    <h2>회원 가입</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <input type="text" name="id">
                        </div>
                        <div class="col3">
                            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/check_id.gif" onclick="check_id()"></a>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2">
                            <input type="password" name="pass">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">비밀번호 확인</div>
                        <div class="col2">
                            <input type="password" name="pass_confirm">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2">
                            <input type="text" name="name">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form email">
                        <div class="col1">이메일</div>
                        <div class="col2">
                            <input type="text" name="email1">@<input type="text" name="email2">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="bottom_line"> </div>
                    <div class="buttons">
                        <img style="cursor:pointer" src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/button_save.gif" onclick="check_input()">&nbsp;
                        <img id="reset_button" style="cursor:pointer" src="http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/img/button_reset.gif" onclick="reset_form()">
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