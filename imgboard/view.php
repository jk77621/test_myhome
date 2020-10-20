<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";
include $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/imgboard/lib/code_func.php";
$num = $id = $subject = $content = $day = $hit = $image_width = $q_num = "";
$file_type_0 = "";
if (empty($_POST['page'])) {
  $page = 1;
} else {
  $page = $_POST['page'];
}


//get으로 보내는 것도 있고, post로 보내는 것도 있어서 둘다 받을 수 있도록 설계
switch (isset($_POST["num"])) {
  case true:
    $postAndget_num = $_POST["num"];
    $postAndget_hit = $_POST["hit"];
    break;
  case false:
    $postAndget_num = $_GET["num"];
    $postAndget_hit = $_GET["hit"];
    break;
  default:
    break;
}

if (isset($postAndget_num) && !empty($postAndget_num)) {
  $num = test_input($postAndget_num);
  $hit = test_input($postAndget_hit);
  $q_num = mysqli_real_escape_string($con, $num);

  // 조회수 증가
  $sql = "UPDATE `code` SET `hit`=$hit WHERE `num`=$q_num;";
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }

  // 내용 출력을 위한 구문
  $sql = "SELECT * from `code` where num = $q_num;";
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }
  $row = mysqli_fetch_array($result);

  $id = $row['id'];
  $hit = $row['hit'];
  $language = $row['language'];
  $subject = htmlspecialchars($row['subject']);
  $content = htmlspecialchars($row['content']);
  $code_content = htmlspecialchars($row['code_content']);
  $subject = str_replace("\n", "<br>", $subject);
  $subject = str_replace(" ", "&nbsp;", $subject);
  $content = str_replace("\n", "<br>", $content);
  $content = str_replace(" ", "&nbsp;", $content);
  $code_content = str_replace("\n", "<br>", $code_content);
  $code_content = str_replace(" ", "&nbsp;", $code_content);
  $day = $row['regist_day'];

  // file 있을 때만 
  if (isset($row['file_name_0'])) {
    $file_name_0 = $row['file_name_0'];
    $file_copied_0 = $row['file_copied_0'];
    $file_type_0 = $row['file_type_0'];
  }


  //숫자 0 " " '0' null 0.0   $a = array()
  if (!empty($file_copied_0) && $file_type_0 == "image") {
    //이미지 정보를 가져오기 위한 함수 width, height, type
    $image_info = getimagesize("./data/" . $file_copied_0);
    $image_width = $image_info[0];
    $image_height = $image_info[1];
    $image_type = $image_info[2];
    if ($image_width > 400) $image_width = 400;
  } else {
    $image_width = 0;
    $image_height = 0;
    $image_type = "";
  }
}

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/normalize.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/slide.css">
  <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/common.css?ver=2">
  <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/imgboard/css/code.css">

  <!-- <link rel="stylesheet" href="../css/memo.css"> -->
  <script type="text/javascript" src="./js/member_form.js?ver=1"></script>
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
  <div id="wrap">
    <div id="content">
      <div id="col2">
        <div id="title">
          <h3>코드리뷰</h3>
        </div>
        <div class="clear"></div>
        <div id="write_form_title"></div>
        <div class="clear"></div>
        <div id="write_form">
          <div class="write_line"></div>
          <div id="write_row1">
            <div class="col1">아이디</div>
            <div class="col2"><?= $id ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 조회 :
              <?= $hit ?>
              &nbsp;&nbsp;&nbsp; 입력날짜:
              <?= $day ?>
            </div>
          </div>
          <!--end of write_row1 -->
          <div class="write_line"></div>

          <div id="write_row2">
            <div class="col1">제&nbsp;&nbsp;목</div>
            <div class="col2"><input type="text" name="subject" value="<?= $subject ?>" readonly="readonly"></div>
          </div>
          <!--end of write_row2 -->
          <div class="write_line"></div>

          <div id="write_row3">
            <div class="col1">내&nbsp;&nbsp;용</div>
            <div class="col2">
              <textarea name="content" id="content" value="<?= $content ?>" rows="15" cols="79" readonly="readonly"><?= $content ?></textarea>
            </div>
          </div>
          <!--end of write_row3 -->
          <div class="write_line"></div>

          <div id="write_row4">
            <div class="col1">코&nbsp;&nbsp;드</div>
            <div class="col2">
              <textarea name="code_content" id="code_content" value="<?= $code_content ?>" rows="15" cols="79" readonly="readonly"><?= $code_content ?>
            </textarea>
            </div>
          </div>
          <!--end of write_row3 -->
          <div class="write_line"></div>

          <br>
          <br>
        </div>
        <!--end of write_form -->
        <div class="write_line"></div>

        <!--덧글내용시작  -->
        <div id="ripple">
          <div id="ripple1">덧글</div>
          <div id="ripple2">
            <?php
            $sql = "select * from `code_ripple` where parent=$q_num ";
            $ripple_result = mysqli_query($con, $sql);
            while ($ripple_row = mysqli_fetch_array($ripple_result)) {
              $ripple_num = $ripple_row['num'];
              $ripple_id = $ripple_row['id'];
              $ripple_nick = $ripple_row['nick'];
              $ripple_date = $ripple_row['regist_day'];
              $ripple_content = $ripple_row['content'];
              $ripple_content = str_replace("\n", "<br>", $ripple_content);
              $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
            ?>
              <div id="ripple_title">
                <ul>
                  <li><?= $ripple_id . "&nbsp;&nbsp;" . $ripple_date ?></li>
                  <li id="mdi_del">
                    <?php
                    $message = code_ripple_delete($ripple_id, $ripple_num, 'dml_board.php', $page, $hit, $q_num);
                    echo $message;
                    ?>
                  </li>
                </ul>
              </div>
              <div id="ripple_content">
                <?= $ripple_content ?>
              </div>
            <?php
            } //end of while
            mysqli_close($con);
            ?>

            <form name="ripple_form" action="dml_board.php" method="post">
              <input type="hidden" name="mode" value="insert_ripple">
              <input type="hidden" name="num" value="<?= $q_num ?>">
              <input type="hidden" name="parent" value="<?= $q_num ?>">
              <input type="hidden" name="hit" value="<?= $hit ?>">
              <input type="hidden" name="page" value="<?= $page ?>">
              <div id="ripple_insert">
                <div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
                <div id="ripple_button"> <input type="image" src="../free/img/memo_ripple_button.png"></div>
              </div>
              <!--end of ripple_insert -->
            </form>


          </div>
          <!--end of ripple2  -->
        </div>
        <!--end of ripple  -->

        <div id="write_button">
          <a href="./code_list.php?page=<?= $page ?>"><img src="../free/img/list.png"></a>

          <?php
          //관리자이거나 해당된 작성자일경우 수정, 삭제가 가능하도록 설정
          if ($_SESSION['userid'] == "admin" || $_SESSION['userid'] == $id) {
            echo ('<a href="./code_write_edit_form.php?mode=update&num=' . $q_num . '"><img src="../free/img/modify.png"></a>&nbsp;');
            echo ('<img src="../free/img/delete.png" onclick="check_delete(' . $q_num . ')">&nbsp;');
          }
          //로그인하는 유저에게 글쓰기 기능을 부여함.
          if (!empty($_SESSION['userid'])) {
            echo '<a href="code_write_edit_form.php"><img src="../free/img/write.png"></a>';
          }
          ?>
        </div>
        <!--end of write_button-->
      </div>
      <!--end of col2  -->
    </div>
    <!--end of content -->
  </div>
  <!--end of wrap  -->
</body>

</html>