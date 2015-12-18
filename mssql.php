<?php
$conn = mssql_connect ( "test", "weixin", "guan8899" );
if ($conn) {
	echo "连接成功！";
}
/* mssql_select_db ( "currentdb" );
$sql = "SELECT vipid,totalamount,totalinterest,status from vip where vipid=$keyword";
$rs = mssql_query ( "$sql" );
while ( $row = mssql_fetch_array ( $rs ) ) {
	$vipid = $row ["vipid"];
	$totalamount = floor ( ($row ["totalamount"]) * 100 ) / 100;
	$totalinterest = floor ( $row ["totalinterest"] );
	echo "亲！您的会员卡($vipid)，截至($nowtime)，已累积消费($totalamount)元，当前积分为($totalinterest)。\n如有疑问以门店数据为准！";
}
mssql_free_result ( $rs ); */
mssql_close ( $conn );
/* phpinfo (); */
?>
