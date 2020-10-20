<?php
//userid에 세션이 없다면 ""가 기본값으로 들어가게 되어있음, ""은 null과 같고 null은 0과 같음, 0은 조건문에서 false와 같음 

include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/create_table.php";

create_table($con, 'code'); //코드리뷰 테이블생성
create_table($con, 'code_ripple'); //코드리뷰 덧글 테이블생성

//상수 정의한 것, final int SCALE = 10; 이거와 같음
define('SCALE', 9);
$memo_content = "";

if (isset($_POST["mode"]) && $_POST["mode"] == "search") {
    //제목, 내용, 아이디
    $find = test_input($_POST["find"]);
    $search = test_input($_POST["search"]);

    // 방어막 설치 검색할 때는 꼭 해야함
    $q_search = mysqli_real_escape_string($con, $search);
    // 콤보박스에서 선택한 것이 find에 들어가고 검색하는 내용이 %$q_search% 안에 들어감
    $sql = "SELECT * from `code` where $find like '%$q_search%' order by num desc;";
} else {
    $sql = "SELECT * from `code` order by num desc";
}

$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result);

//페이지 나타낼 때 사용하는 것
$total_page = ($total_record % SCALE == 0) ? ($total_record / SCALE) : (ceil($total_record / SCALE));

//2.페이지가 없으면 디폴트 페이지 1페이지
if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start = ($page - 1) * SCALE;
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/normalize.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/slide.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/common.css?ver=2">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/imgboard/css/code.css?ver=2">
    <!-- <script type="text/javascript" src="./js/member_form.js"></script> -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/modernizr.custom.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-1.10.2.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/js/slide.js"></script>
    <title></title>
</head>

<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/header.php"; ?>
    </header>
    <?php
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
        <!-- ********************** -->
        <!-- data list -->
        <!-- ********************** -->
        <div class="list_box">
            <h3>코드리뷰 > 목록보기</h3>
            <ul id="image_list">
                <?php
                // db의 code table 내용을 가져옴
                $sql = "SELECT * from `code` order by num desc;";
                $result = mysqli_query($con, $sql);

                // 전체 레코드 수
                $num_row = mysqli_num_rows($result);

                // 한페이지에 나타낼 레코드 수 9개

                // 전체 페이지 수
                ($num_row % SCALE == 0) ? $total_page = $num_row / SCALE : $total_page = ceil($num_row / SCALE);

                //출력을 시작할 레코드 위치 구하기 : 현재 페이지에서 -1 한 값에 뿌릴 개수를 곱하여 이전에 출력한 수를 구하고 남은 위치부터 출력함
                $start = ($page - 1) * SCALE;
                mysqli_data_seek($result, $start);

                //list 출력하기
                $flag_break = 0;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <li class='code_view_anchor'>
                        <a href='./view.php?page=<?= $page ?>&num=<?= $row['num'] ?>&hit=<?= $row['hit'] + 1 ?>'>
                            <span class='imageBox'>
                                <img src='./img/<?= $row['language'] ?>.png' alt="<?= $row['language'] ?>">
                            </span>
                            <span class='contentBox'>
                                <h3>제목 : 
                                    <?= $row['subject'] ?></h3>
                                <span class="content_explain">
                                    <p>언어 :
                                        <?= $row['language'] ?></p>
                                    <p>날짜 :
                                        <?= $row['regist_day'] ?></p>
                                    <p>아이디 :
                                        <?= $row['id'] ?></p>
                                    <p>조회수 :
                                        <?= $row['hit'] ?></p>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php
                    if ($flag_break == 8) {
                        $flag_break = 0;
                        break;
                    } else {
                        $flag_break++;
                    }
                }
                ?>
            </ul>
            <!-- ********************** -->
            <!-- 하단 페이지 수 -->
            <!-- ********************** -->
            <ul id="page_num">
                <?php
                if ($total_page >= 2 && $page >= 2) {
                    $new_page = $page - 1;
                    echo "<li><a href='code_list.php?page=$new_page'>◀ 이전</a> </li>";
                } else
                    echo "<li>&nbsp;</li>";

                // 게시판 목록 하단에 페이지 링크 번호 출력
                for ($i = 1; $i <= $total_page; $i++) {
                    // 현재 페이지 번호 링크 안함
                    if ($page == $i) {
                        echo "<li><b> $i </b></li>";
                    } else {
                        echo "<li><a href='code_list.php?page=$i'> $i </a><li>";
                    }
                }
                if ($total_page >= 2 && $page != $total_page) {
                    $new_page = $page + 1;
                    echo "<li> <a href='code_list.php?page=$new_page'>다음 ▶</a> </li>";
                } else
                    echo "<li>&nbsp;</li>";
                ?>
            </ul>

            <!-- ********************** -->
            <!-- 하단 글쓰기 버튼 -->
            <!-- ********************** -->
            <ul class="buttons">
                <li>
                    <?php
                    //로그인 안해도 글쓰기 버튼을 보여줌, 바로 alert 찍을 수 있도록 설계함
                    if ($userid) {
                    ?>
                        <button onclick="location.href='code_write_edit_form.php'">글쓰기</button>
                    <?php
                    } else {
                    ?>
                        <a href="javascript:alert('로그인 후 이용해 주세요!')">
                            <button>글쓰기</button>
                        </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
        <!-- code_box -->
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/footer.php"; ?>
    </footer>
</body>

</html>