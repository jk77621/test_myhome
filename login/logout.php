<?php
session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["userlevel"]);
unset($_SESSION["userpoint"]);
?>
<script>
  location.href = 'http://<?= $_SERVER['HTTP_HOST'] ?>/test_myhome/index.php';
</script>