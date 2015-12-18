<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php
$openid = $_GET ["openid"];
$nickname = $_GET ["nickname"];
$pidget = $_GET ["pid"]; // 获取身份证号码
$tel = $_GET ['tel'];
if ($pidget == "" || $pidget=="null" || $pidget==null) {
	echo "<script>alert( '输入不能为空！ ')</script>";
	echo "<script>location.href='hykbindsuccess.php';</script>";
} else {
	if (preg_match ( "/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/", $pidget )) {
		require_once ("conf/db_mssql.class.php");
		$conn = new DB ();
		$conn->open ();
		$sql = mssql_query ( "SELECT vipid,pid,tel,totalamount,totalinterest from vip where pid='$pidget' and status='有效'" );
		// echo mssql_num_rows ( $sql );
		if (mssql_num_rows ( $sql ) == 0) {
			echo "<script>alert( '您的证件号不存在，请到当地线下门店办理积分卡或者完善证件号等信息，没有证件认证的积分卡不能绑定微信号！谢谢您的合作！ ')</script>";
			echo "<script>location.href='hykbindsuccess.php';</script>";
		}elseif (mssql_num_rows ( $sql )>1)
		{
			echo "<script>alert( '亲，您好，您的身份证绑定了多张会员卡！暂时无法使用电子会员卡！ ')</script>";
			echo "<script>location.href='hykbindsuccess.php';</script>";
		} 
		 else {
			while ( $row = mssql_fetch_array ( $sql ) ) {
				$vipid = $row ["vipid"];
				$tel = $row ["tel"];
				$totalamount = floor ( ($row ["totalamount"]) * 100 ) / 100;
				$totalinterest = floor ( $row ["totalinterest"] );
				// echo $vipid;
				echo "<script>location.href='insertwx.php?vipid=$vipid&openid=$openid&nickname=$nickname&pid=$pidget&tel=$tel&totalamount=$totalamount&totalinterest=$totalinterest';</script>";
			}
		}
		mssql_free_result ( $sql );
		$conn->close ();
	} else {
		echo "<script>alert( '请输入有效的15或者18位身份证件号！ ')</script>";
		echo "<script>location.href='hykbindsuccess.php';</script>";
	}
}
?>
</body>
</html>