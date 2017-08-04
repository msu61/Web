<?php 
	$s=mysqli_connect("localhost:3360","root","zero") or die("실패입니다.");
	print "접속 OK<br>";
	mysqli_select_db($s,"db1");

	$c1_d=$_POST["c1"];

	$re=mysqli_query($s,"select * from tbk where mess like '%$c1_d%'");
	while($result=mysqli_fetch_array($re)){

		print $result[0];
		print ":";

		print $result[1];
		print ":";

		print $result[2];
		print "<br>";

	}

mysqli_close($s);
print "<br> <A Href='simple.html'> 메인화면으로</A>";

?>