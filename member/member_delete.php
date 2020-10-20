<?php
$id = $_GET["id"];

$con = mysqli_connect("localhost", "root", "123456", "sample");
$sql = "delete from members";
$sql .= " where id='$id'";
mysqli_query($con, $sql);

mysqli_close($con);

session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["userlevel"]);
unset($_SESSION["userpoint"]);
?>
<script>
    location.href = 'http://<?=$_SERVER['HTTP_HOST']?>/test_myhome/index.php';
</script>