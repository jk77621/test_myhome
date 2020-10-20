<?php
    $num   = $_GET["num"];
    $page   = $_GET["page"];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/create_table.php";

    create_table($con, 'notify');
    // $con = mysqli_connect("localhost", "user1", "12345", "sample");

    $sql = "select * from notify where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $sql = "delete from notify where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'notify_list.php?page=$page';
	     </script>
	   ";
?>

