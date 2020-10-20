<meta charset='utf-8'>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/test_myhome/db/db_connector.php";

$num  = $_GET["num"];

if (!($_SERVER["REQUEST_METHOD"] === "POST")) {
	alert_back("method 방식이 올바르지 않습니다.");
}
if (!isset($_POST["send_id"])) {
	alert_back("로그인 후 이용해주세요.");
}
if (!isset($_POST["rv_id"])) {
	alert_back("rv_id 값이 존재하지 않습니다.");
}
if (!isset($_POST["subject"])) {
	alert_back("subject 값이 존재하지 않습니다.");
}
if (!isset($_POST["content"])) {
	alert_back("content 값이 존재하지 않습니다.");
}

$send_id = $_POST["send_id"]; // 보내는 사람
$rv_id = $_POST['rv_id'];	  // 받는 사람
$subject = $_POST['subject']; // 쪽지 주제
$content = $_POST['content']; // 쪽지 내용

test_input($subject); // 특수문자 충돌나는것을 방지
test_input($content);

$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

// $con = mysqli_connect("localhost", "user1", "12345", "sample");
// 받는사람이 멤버테이블에 실제로 존재하는지 점검
$sql = "select * from members where id='$rv_id'";
$result = mysqli_query($con, $sql);
// 레코드셋에 갯수를 체크해서 저장한다.
$num_record = mysqli_num_rows($result);

if ($num_record) {
    $sql = "update message set subject = '$subject', content = '$content' where num = {$num}";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
} else {
	alert_back("수신 id가 잘못되었습니다.");
}

mysqli_close($con);                // DB 연결 끊기

echo "
	   <script>
	    location.href = './message_box.php?mode=send';
	   </script>
	";
?>