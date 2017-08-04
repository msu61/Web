<?php
/********************데이터 베이스의 정보를 읽어온다.*************************/
$s=mysqli_connect("localhost:3360","root","zero");
mysqli_select_db($s,"db1");

/*********************   타이틀과 화면 표시  *****************************/

print <<<eot1
				<html>
				<head>
				<meta http-equiv="content-type" content="text/html;charset=utf-8">
				<title>카페 화면</title>
				</head>
				<body bgcolor="lightsteelblue">
				<img src="pic/parent.jpg">
				<font size="7" color="indigo">
							sql 카페 게시판입니다.
							</font>
							<br><br>
							확인하고자 하는 스레드 번호를 누르세요.
							<hr>
							<font size="5">
							(스레드 목록)
							</font>
							<br>
eot1;
/*************클라이언트의 IP주소 가져오기 ******************/
$ip=getenv("REMOTE_ADDR");
/*************스레드 제목(th)에 데이터가 있으면 테이블 tbj0에 대입*********/
$th_d=isset($_GET["th"])? htmlspecialchars($_GET["th"]):null;
if($th_d<>""){mysqli_query($s,"insert into tbj0 (thread,date,ipaddr) values('$th_d',now(),'$ip')");}
/**************tbj0의 모든 데이터 추출 ***************************/
$re=mysqli_query($s,"select * from tbj0");

while($result=mysqli_fetch_array($re)){
	print <<<eot2
	<a href= "board.php?gn=$result[0]">$result[0] $result[1]</A>
	<br>
	$result[2]작성<br><br>
eot2;

}
/***********************데이터 베이스 접속 종료************************/
mysqli_close($s);

/***********************스레드 제목 입력과 메인 화면으로 이동하는 링크등******/

print <<<eot3
<hr>
<font size="5">스레드 작성</font>
<br>
여기에 새로운 스레드를 작성합니다!
<br>
<form method="get" action="board_top.php">
	새로작성할 스레드의 제목
	<input type="text" name="th" size="50">
	<br>
	<input type="submit" value="확인">
	</form>
<hr>
	<font size="5">
		메시지 검색
		</font>
		<a href="board_search.php"> 검색을 하려면 여기를 누르세요 </a>
		<hr>
		</body>
		</html>
eot3;
?>
