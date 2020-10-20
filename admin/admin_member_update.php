<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";

session_start();
if (!isset($_SESSION["userlevel"]) || $_SESSION["userlevel"] !== '1') {
    alert_back("Warning : 수정권한이 없습니다.");
}

$num   = $_POST["num"];
$level = $_POST["level"];
$point = $_POST["point"];

// $con = mysqli_connect("localhost", "user1", "12345", "sample");
$sql = "update members set level=$level, point=$point where num=$num";
mysqli_query($con, $sql);

mysqli_close($con);

echo "
         <script>
             alert('Success : 수정되었습니다.');
	         location.href = 'admin.php';
	     </script>
       ";
?>
