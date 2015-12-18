<?php
session_start ();
if (empty ( $_SESSION ['openid'] )) {
	header ( "location:wx_login.php" );
	exit ();
}
?>
<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>冠超市-努力做最好的(福建)</title>
<link href="bootstrap3.3/css/bootstrap.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="bootstrap3.3/js/jquery-1.10.2.js"></script>

<script src="bootstrap3.3/js/bootstrap.js"></script>

<script type="text/javascript"> 
$(document).ready(function(){
$(".flip").click(function(){
    $(".panel").slideToggle("slow");
  });
});
</script>
<script type="text/javascript"> 
$(document).ready(function(){
$(".flippid").click(function(){
    $(".panelpid").slideToggle("slow");
  });
});
</script>
<script type="text/javascript"> 
$(document).ready(function(){
$(".flipxf").click(function(){
    $(".panelxf").slideToggle("slow");
  });
});
</script>

<script type="text/javascript"> 
$(document).ready(function(){
$(".flipmd").click(function(){
    $(".panelmd").slideToggle("slow");
  });
});
</script>

<style type="text/css">
div.panel,p.flip {
	margin: 0px;
	padding: 5px;
	text-align: center;
	border: solid 0px #c3c3c3;
}

div.panel {
	height: %;
	display: none;
}
</style>
<style type="text/css">
div.panelpid,p.flippid {
	margin: 0px;
	padding: 5px;
	text-align: center;
	border: solid 0px #c3c3c3;
}

div.panelpid {
	height: %;
	display: none;
}
</style>
<style type="text/css">
div.panelxf,p.flipxf {
	margin: 0px;
	padding: 5px;
	text-align: center;
	border: solid 0px #c3c3c3;
}

div.panelxf {
	height: %;
	display: none;
}
</style>

</style>
<style type="text/css">
div.panelmd,p.flipmd {
	margin: 0px;
	padding: 5px;
	text-align: center;
	border: solid 0px #c3c3c3;
}

div.panelmd {
	height: %;
	display: none;
}
</style>


<style type="text/css">
.align-center {
	margin: 0 auto; /* 居中 这个是必须的，，其它的属性非必须 */
	text-align: center; /* 文字等内容居中 */
}
</style>
</head>
<body>
	<div class="container-fluid align-center">
		<div>
<?php
require_once 'conf/db_mysqlwx.class.php';
$openid = $_SESSION ['openid'];
$conn = new DB ();
$conn->open ();
$result = mysql_query ( "SELECT * FROM `vip_wechat` WHERE openid='$openid'" );
while ( $row = mysql_fetch_array ( $result ) ) {
	
	$vipid = $row ["vipid"];
	$nickname = $row ["nickname"];
	$pid = $row ["pid"];
	$tel = $row ["tel"];
	$totalamount = $row ["totalamount"];
	$totalinterest = $row ["totalinterest"];
}

mysql_free_result ( $result );
$conn->close ();
?>
<br /> <img src="images/huiyuanka.jpg" class="img-responsive"
				alt="Responsive image">
  <?php
		$image = "buildcode.php?cardid=$vipid";
		?>
<h4>使用时向收银员出示此卡</h4>
			<img src="<?php echo $image;?>" class="img-responsive"
				alt="Responsive image" />
			<p></p>

		</div>


		<table class="table table-bordered" style="text-align: center">

			<tr>
				<td>
					<h3>会员信息</h3>
			
			</tr>
			</td>
			<tr>
				<td>

					<li>
						<p class="flip">1、我的积分</p>
						<div class="panel">
        <?php
								$nowtime = date ( 'y-m-d h:i:s', time () );
								$ms_host = "test"; // 这里是ODBC的连接名称
								$ms_user = "weixin"; // 用户名
								$ms_pass = "123456"; // 密码
								$conn = mssql_connect ( $ms_host, $ms_user, $ms_pass );
								mssql_select_db ( "currentdb" );
								$sql = "SELECT vipid,totalamount,totalinterest,status from vip where vipid=$vipid and status='有效'";
								$rs = mssql_query ( "$sql" );
								while ( $row = mssql_fetch_array ( $rs ) ) {
									$vipid = $row ["vipid"];
									$totalamount = floor ( ($row ["totalamount"]) * 100 ) / 100;
									$totalinterest = floor ( $row ["totalinterest"] ); // 获取username字段值
									echo "亲！您的会员卡($vipid)，截至($nowtime)，已累积消费($totalamount)元，当前积分为($totalinterest)。\n如有疑问以门店数据为准！";
								}
								mssql_free_result ( $rs );
								mssql_close ( $conn );
								?>
      </div>
				</li>
				</td>
			</tr>
			<tr>
				<td>
					<li>
						<p class="flipxf ">2、我的消费</p>
						<div class="panelxf">
        <?php
								echo "暂无法查询";
								?>
      </div>
				</li>
				</td>
			</tr>
			<tr>
				<td>
					<li>
						<p class="flippid">3、个人资料</p>
						<div class="panelpid">
        <?php
								
								echo "卡号：$vipid";
								echo "<br />";
								echo "身份证号：$pid";
								echo "<br />";
								echo "手机号：$tel";
								?>
      </div>
				</li>
				</td>
			</tr>
			<tr>
				<td>
					<li><p class="flipmd ">4、附近门店</p>
						<div class="panelmd">
        <?php
								echo "暂无法查询";
								?>
      </div></li>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>