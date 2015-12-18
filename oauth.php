<?php
$appid = "wx0fed524d0dbafd1e";
$secret = "b3fca70bef3775f844f3597bb09a2e9d";
$code = $_GET ["code"];
$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';

$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $get_token_url );
curl_setopt ( $ch, CURLOPT_HEADER, 0 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
$res = curl_exec ( $ch );
curl_close ( $ch );
$json_obj = json_decode ( $res, true );

// 根据openid和access_token查询用户信息
$access_token = $json_obj ['access_token'];
$openid = $json_obj ['openid'];
$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';

$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $get_user_info_url );
curl_setopt ( $ch, CURLOPT_HEADER, 0 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
$res = curl_exec ( $ch );
curl_close ( $ch );

// 解析json
$user_obj = json_decode ( $res, true );

/* $_SESSION ['user'] = $user_obj; */
?>  

<?php
require_once 'conf/db_mysqlwx.class.php';
$openid = $user_obj ["openid"];
$conn = new DB ();
$conn->open ();
$result = mysql_query ( "SELECT * FROM `vip_wechat` WHERE openid='$openid'" );
echo "<br />";
if (mysql_num_rows ( $result ) == 0) {
} else {
	while ( $row = mysql_fetch_array ( $result ) ) {
		$lifeTime = 60;
		session_set_cookie_params ( $lifeTime );
		session_start ();
		$_SESSION ['openid'] = $openid;
		echo "<script>location.href='hykbindsuccess.php';</script>";
	}
}
mysql_free_result ( $result );
$conn->close ();
?>
<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
<title>冠超市-努力做最好的</title>
<link href="bootstrap3.3/css/bootstrap.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="bootstrap3.3/js/jquery-1.10.2.js"></script>
<script src="bootstrap3.3/js/bootstrap.js"></script>
<script type="text/javascript">
    // 对浏览器的UserAgent进行正则匹配，不含有微信独有标识的则为其他浏览器
    var useragent = navigator.userAgent;
    if (useragent.match(/MicroMessenger/i) != 'MicroMessenger') {
        // 这里警告框会阻塞当前页面继续加载
        alert('已禁止本次访问：您必须使用微信内置浏览器访问本页面！');
        // 以下代码是用javascript强行关闭当前页面
        var opened = window.open('about:blank', '_self');
        opened.opener = null;
        opened.close();
    }
</script>
</head>
<BODY class="bg-warning">
	<div class="container">
		<form action="hykbind.php" method="get">
			<input name="openid" id="openid" type="hidden"
				value="<?php echo $user_obj["openid"];?>" type="text"> <input
				name="sex" id="sex" type="hidden"
				value="<?php echo $user_obj["sex"];?>" type="text"> <input
				name="country" id="country" type="hidden"
				value="<?php echo $user_obj["country"];?>" type="text"> <input
				name="province" id="province" type="hidden"
				value="<?php echo $user_obj["province"];?>" type="text"> <input
				name="city" id="city" type="hidden"
				value="<?php echo $user_obj["city"];?>" type="text"> <input
				name="nickname" id="nickname" type="hidden"
				value="<?php echo $user_obj["nickname"];?>" type="text">

			<div align="center">
				<h3> <?php echo $user_obj["nickname"];?></h3>
				<h3>
					<font color="#FF0000">您好,请输入您的身份证号码：</font>
				</h3>

			</div>
			<div align="center">

				<div class="fieldcontain">
					<input name="pid" id="pid" class="form-control" value=""
						type="text" required />
				</div>
				</br>
				<div>
					<input type="submit" data-inline="true" align="middle"
						class="btn btn-default btn-lg" value="绑&nbsp;定 ">
				</div>
				</br>                        
            <?php
												if (! empty ( $_GET ['errno'] )) {
													$errno = $_GET ['errno'];
													if ($errno == 1) {
														echo "<br /><font color='red' size='3'>您的积分卡已经被某个微信号绑定，如有疑问请联系门店前台！</font>";
													}
													if ($errno == 2) {
														echo "<br /><font color='red' size='3'>您的证件号不存在，请到当地线下门店办理积分卡或者完善证件号等信息，没有证件认证的积分卡不能绑定微信号！谢谢您的合作！</font>";
													}
													if ($errno == 3) {
														echo "<br /><font color='red' size='3'>请输入有效的15或者18位身份证件号！</font>";
													}
													if ($errno == 4) {
														echo "<br /><font color='red' size='3'>证件号不能为空！</font>";
													}
												}
												?>
          </div>
		</form>
		<div>
			<h3>福建会员使用须知:</h3>
			<u>1、必须输入您的身份证号码进行绑定，未用身份证号码办理的积分卡无法进行绑定，请向当地门店服务台补充您的身份证号码！</u><br />
			<u>2、绑定之后您可以方便查询本人积分信息，消费记录！</u><br /> <u>3、一个微信号只能绑定一张积分卡！</u><br />
			<u>4、如发现积分卡已经被非本人微信号盗绑，请拿上您的有效身份证件，尽快到冠超市当地门店前台解绑!</u>
		</div>
		</br>
		<div>
			<img src="images/logo.png" class="img-responsive"
				alt="Responsive image">
		</div>
	</div>
</BODY>
</HTML>