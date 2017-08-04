<?php
/***************데이터 베이스 등의 정보 읽어오기***********************/
$s=mysqli_connect("localhost:3360","root","zero");
mysqli_select_db($s,"db1");
/****************타이틀 등 표시****************************/
print <<<eot1
	<html>
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>sql 카페 검색 화면</title>
	</head>
	<body bgcolor="orange">
	<hr>php<font size="5">
	(검색 결과는 여기에)</font>
eot1;


/*************검색문자열을 가져와서 태그 삭제********************************/
$se_d=isset($_GET["se"])?htmlspecialchars($_GET["se"]):null;

/**************검색 문자열 ($se_d)에 데이터가 있으면 검색 처리*******************************/
if($se_d<>""){
	/*******************검색 sql문 , 테이블 tbj1에 tbj0을 조인 **************************/
$str=<<<eot2
select tbj1.number,tbj1.name,tbj1.mess,tbj0.thread
from tbj1 join tbj0 on tbj1.gnum=tbj0.gnum 
where tbj1.mess like "%se_d%"
eot2;

/*****************검색 질의 실행****************************/
$re=mysqli_query($s,$str);
while($result=mysqli_fetch_array($re)){
	print "$result[o]:$result[1]:$result[2]:$result[3]";
	print "<br><br>";
}
}


/***************데이터 베이스 접속종료******************************/
mysqli_close($s);

/***************검색 문자열 입력란, 메인 화면에 링크***************************/
print <<<eot3
<hr>
메세지에 포함되는 문자를 입력하세요!
<br>
<form method="get" action="board_search.php">
검색할 문자열
<input type="text" name="se">
<br>
<input type="submit" value="검색">
</form>
<br>
<a href="board_top.php">스레드 목록으로 돌아가기</a>
</body>
</html>
eot3;


?>