<?php
$vipid = $_GET ['vipid'];
$openid = $_GET ['openid'];
$nickname = $_GET ['nickname'];
$pid = $_GET ['pid'];
$tel = $_GET ['tel'];
$totalamount = $_GET ['totalamount'];
$totalinterest = $_GET ['totalinterest'];
require_once ("conf/db_mysqlwx.class.php");
$conn = new DB ();
$conn->open ();
$query = mysql_query ( "INSERT INTO `vip_wechat`(`vipid`, `openid`, `nickname`, `pid`,`tel`,`totalamount`,`totalinterest`) VALUES ('$vipid','$openid','$nickname', '$pid','$tel','$totalamount','$totalinterest')" );
if ($query) {

	echo "<script>location.href='tz.php';</script>";

} else {
	echo "<script>alert( '您的积分卡已经被某个微信号绑定，如有疑问请联系门店前台！ ')</script>";
	echo "<script>location.href='hykbindsuccess.php';</script>";
}
mysql_free_result ( $query );
$conn->close ();
?>