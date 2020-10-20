<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
    include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/create_table.php";

    create_table($con, 'notify');
    // $con = mysqli_connect("localhost", "user1", "12345", "sample");
    
    $sql = "update notify set subject='$subject', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'notify_list.php?page=$page';
	      </script>
	  ";
?>

   
