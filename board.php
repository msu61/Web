<?php
/************************ 데이터 베이스 정보 등을 읽어온다.*****************************/
$s=mysqli_connect("localhost:3360","root","zero") or die("실패입니다.");
mysqli_select_db($s,"db1");

/*******************스레드의 그룹 번호 (gn)을 가져와서 $gn_d에 대입 ********************/

$gn_d=$_GET["gn"];

/******************$gn_d에 숫자 이외의 값이 포함되어 있으면 처리 중단*********************/
if(preg_match("/[^0-9]/",$gn_d)){
	print <<<eot1
	부정확한 값이 입력되었습니다.<br>
	<a href="board_top.php">스레드 목록으로 돌아가려면 여기를 누르세요</A>
eot1;
/***********************$gn_d에 숫자만 포함되어 있으면 정상 처리 **************************/

}elseif (preg_match("/[0-9]/",$gn_d)){


/********************이름과메세지를 가져오고 태그는 삭제**********************/

$na_d=isset($_GET["na"])?htmlspecialchars($_GET["na"]):null;
$me_d=isset($_GET["me"])?htmlspecialchars($_GET["me"]):null;

/***********************ip 주소 가져오기*************************/
$ip=getenv("REMOTE_ADDR");

/************************스레드의 그룹번호(Gn)와 일치하는 레코드를 표시한다.**********************************/
$re=mysqli_query($s,"select thread from tbj0 where gnum=$gn_d");
$result=mysqli_fetch_array($re);

/************************스레드의 댓글을 표시하는 문자열 $thread_com을 작성한다.*********************************/
$thread_com="[".$gn_d." ".$result[0]."]";

/************************스레드를 표시하는 제목등을 출력한다.**********************************/
print <<<eot2
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>sql 카페 $thread_com 스레드</title>
</head>
<body bgcolor="darkgray">
<font size="7" color="indigo">
$thread_com 스레드!
</font>
<br>
<br>
<font size="5">
$thread_com 의 메세지 </font>
<br>
eot2;

/****************이름($na_d)이 입력되면 tbj1에 레코드를 추가한다.******************************************/
if($na_d<>""){
mysqli_query($s,"insert into tbj1 values(0,'$na_d','$me_d',now(),$gn_d,'$ip')");
}
/**************************수평선 표시********************************/
print "<hr>";
/*********************날짜와시간순으로 댓글(메시지)을 표시*************************************/
$re = mysqli_query($s,"select * from tbj1 where gnum=$gn_d order by date");
$i=1;
while($result=mysqli_fetch_array($re)){
	print "$i:($result[0]):<U>$result[1]</U>:$result[3]<br>";
	print nl2br($result[2]);
	print "<br><br>";
	$i++;
}

/*********************데이터 베이스 접속 종료*************************************/
mysqli_close($s);
print <<<eot3
<hr>
<font size="5">
$thread_com 에 메세지를 작성하세요
</font>
<form method="get" action="board.php">
이름 <input type="text" name="na"><br>
메시지 <br>
<textAREA name="me" rows="10" cols="70"></textarea>
<br>
<input type="hidden" name="gn" value=$gn_d>
<input type="submit" value="확인">
</form>
<hr>
<a href ="board_top.php">스레드목록으로</a>
</body>
</html>
eot3;
/****************$gn_d에 숫자 이외의 문자가 있거나 숫자가 포함되어 있지 않을때 처리*************************/
}else{
	print "스레드를 선택하세요.<br>";
	print "<A href='board_top.php'>스레드 목록으로 돌아가려면 여기를 누르세요</A>";
}


?>