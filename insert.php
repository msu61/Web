
<?php
$s=mysqli_connect("localhost:3360","root","zero") or die("실패입니다.");
print "성공입니다.!";

mysqli_select_db($s,"db1");
mysqli_query($s,"insert into tb1 values('k888','sql',25)");
$re=mysqli_query($s,"select * from tb1");
while($result=mysqli_fetch_array($re)){
		print $result[0];
		print ":";
		print $result[1];
		print ":";
		print $result[2];
		print ":";
		print "<br>";


}

mysqli_close($s);
?>