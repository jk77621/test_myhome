<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";
if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
else $userpoint = "";
?>
<div id="top">
    <h3>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/index.php"><b>JJK Personal Page</b></a>
    </h3>
    <ul id="top_menu">
        <?php
        if (!$userid) {
        ?>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/member/member_form.php">Sign up</a> </li>
            <li>&nbsp;&nbsp;</li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/login/login_form.php">Login</a></li>
        <?php
        } else {
            $logged = $username . "(" . $userid . ")님  [Level:" . $userlevel . ", Point:" . $userpoint . "]";
        ?>
            <li><?= $logged ?> </li>
            <li>&nbsp;&nbsp;</li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/login/logout.php">Logout</a> </li>
            <li>&nbsp;&nbsp;</li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/member/member_modify_form.php">Modify</a></li>
            <li>&nbsp;&nbsp;</li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/member/member_delete_form.php">Delete</a></li>
        <?php
        }
        ?>
        <?php
        if ($userlevel == 1) {
        ?>
            <li>&nbsp;&nbsp;</li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/admin/admin.php">Admin</a></li>
        <?php
        }
        ?>
    </ul>
</div>
<div id="menu_bar">
    <ul>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/index.php">Home</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/memo/message_form.php">Message</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/board/board_list.php">Board</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/free/list.php">Ripple Board</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/notify/notify_list.php">Notice</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/imgboard/code_list.php">Image Board</a></li>
    </ul>
</div>