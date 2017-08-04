
<?php
$s=mysqli_connect("localhost:3360","root","zero") or die("실패입니다.");
print "성공입니다.!";

mysqli_select_db("db1",$s);
mysqli_query("insert into tb1 values('k777','php',20)");


mysqli_close($s);
?>