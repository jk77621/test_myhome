<!DOCTYPE html>
<html lang="ko" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/normalize.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/slide.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/imgboard/css/code.css">
    <script type="text/javascript" src="./js/member_form.js"></script>
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
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";

    if (!isset($_SESSION['userid'])) {
        echo "<script>alert('권한없음11!');history.go(-1);</script>";
        exit;
    }

    $mode = "insert";
    $language = "";
    $checked = "";
    $subject = "";
    $content = "";
    $code_content = "";
    $id = $_SESSION['userid'];

    if (isset($_GET["mode"]) && $_GET["mode"] == "update") {
        $mode = "update";
        $num = test_input($_GET["num"]);
        // 쿼리문의 ''와 겹칠 수 있기 때문에 \ 표기를 자동으로 해줌, ,보안상 해줘야 하는 것
        $q_num = mysqli_real_escape_string($con, $num);

        $sql = "SELECT * from `code` where num ='$q_num';";
        $result = mysqli_query($con, $sql);

        if (!$result) alert_back("Error: " . mysqli_error($con));

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
        mysqli_close($con);
    }
    ?>
    <div id="wrap">
        <div id="col2">
            <div id="title">
                <h3>코드리뷰 > 글쓰기</h3>
            </div>
            <div class="clear"></div>
            <div id="write_form_title"><img src="../free/img/write_form_title.gif"></div>
            <div class="clear"></div>
            <form name="board_form" action="dml_board.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="<?= $mode ?>">
                <input type="hidden" name="num" value="<?= $num ?>">
                <input type="hidden" name="hit" value="<?= $hit ?>">
                <table>
                    <tr>
                        <td>아이디</td>
                        <td><?= $id ?></td>
                    </tr>
                    <tr>
                        <td>언&nbsp;&nbsp;어</td>
                        <td>
                            <select name="language">
                                <option value="">--선택하세요--</option>
                                <option value="java" <?php if ($language == 'java') echo "SELECTED"; ?>>java</option>
                                <option value="javascript" <?php if ($language == 'javascript') echo "SELECTED"; ?>>javascript</option>
                                <option value="kotlin" <?php if ($language == 'kotlin') echo "SELECTED"; ?>>kotlin</option>
                                <option value="html" <?php if ($language == 'html') echo "SELECTED"; ?>>html</option>
                                <option value="css" <?php if ($language == 'css') echo "SELECTED"; ?>>css</option>
                                <option value="php" <?php if ($language == 'php') echo "SELECTED"; ?>>php</option>
                                <option value="mysql" <?php if ($language == 'mysql') echo "SELECTEDs"; ?>>mysql</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>제&nbsp;&nbsp;목</td>
                        <td>
                            <input id="input_subject" type="text" name="subject" value=<?= $subject ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>내&nbsp;&nbsp;용</td>
                        <td>
                            <textarea name="content" rows="15" cols="79"><?= $content ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>코&nbsp;&nbsp;드</td>
                        <td>
                            <textarea name="code_content" rows="15" cols="79"><?= $code_content ?></textarea>
                        </td>
                    </tr>

                    <!-- <tr>
                            <td>파&nbsp;&nbsp;일</td>
                            <td>
                            <?php
                            // 업데이트를 할지 삽입을 할지
                            if ($mode == "insert") {
                                echo '<input type="file" name="upfile" >이미지(2MB)파일(0.5MB)';
                            } else if ($mode == "update") {
                            ?>
                                <input
                                    type="file"
                                    name="upfile"
                                    onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true'>
                                <?php
                            }
                                ?>
                                <?php
                                if ($mode == "update" && !empty($file_name_0)) {
                                    echo "$file_name_0 파일등록";
                                    echo '<input type="checkbox" id="del_file" name="del_file" value="1">삭제';
                                    echo '<div class="clear"></div>';
                                }
                                ?>
                            </td>
                        </tr> -->
                </table>
                <div id="write_button">
                    <input type="image" onclick='document.getElementById("del_file").disabled=false' src="../free/img/ok.png">&nbsp;
                    <a href="./code_list.php"><img src="../free/img/list.png"></a>
                </div>
                <!--end of write_button-->
            </form>

        </div>
        <!--end of col2 -->
    </div>
    <!--end of content -->
    </div>
    <!--end of wrap -->
</body>

</html>