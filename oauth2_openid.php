<?php
/*
 * 本文件位置 $redirect_url= "http://israel.duapp.com/weixin/oauth2_openid.php"; URL https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0fed524d0dbafd1e&redirect_uri=http://vipcard.guanmart.com/oauth2_openid.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect
 */
$code = $_GET ["code"];
$userinfo = getUserInfo ( $code );
function getUserInfo($code) {
	$appid = "wx0fed524d0dbafd1e";
	$appsecret = "b3fca70bef3775f844f3597bb09a2e9d";
	
	// oauth2的方式获得openid
	$access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
	$access_token_json = https_request ( $access_token_url );
	$access_token_array = json_decode ( $access_token_json, true );
	$openid = $access_token_array ['openid'];
	
	// 非oauth2的方式获得全局access token
	$new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	$new_access_token_json = https_request ( $new_access_token_url );
	$new_access_token_array = json_decode ( $new_access_token_json, true );
	$new_access_token = $new_access_token_array ['access_token'];
	
	// 全局access token获得用户基本信息
	$userinfo_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$new_access_token&openid=$openid";
	$userinfo_json = https_request ( $userinfo_url );
	$userinfo_array = json_decode ( $userinfo_json, true );
	return $userinfo_array;
}
function https_request($url) {
	$curl = curl_init ();
	curl_setopt ( $curl, CURLOPT_URL, $url );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
	$data = curl_exec ( $curl );
	if (curl_errno ( $curl )) {
		return 'ERROR ' . curl_error ( $curl );
	}
	curl_close ( $curl );
	return $data;
}
?>
<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">  
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
  <script type="text/javascript">
			document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
				WeixinJSBridge.call('hideOptionMenu');
			});
			document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
				WeixinJSBridge.call('hideToolbar');
			});
		</script>
  <form action="hykbind.php" method="get">
    <input name="subscribe" id="subscribe"
			value="<?php echo $userinfo["subscribe"];?>" type="text"
			style="display: none;">
    <input name="openid" id="openid"
			value="<?php echo $userinfo["openid"];?>" type="text"
			style="display: none;">
    <input name="sex" id="sex"
			value="<?php echo $userinfo["sex"];?>" type="text"
			style="display: none;">
    <input name="country" id="country"
			value="<?php echo $userinfo["country"];?>" type="text"
			style="display: none;">
    <input name="province" id="province"
			value="<?php echo $userinfo["province"];?>" type="text"
			style="display: none;">
    <input name="city" id="city" value="<?php echo $userinfo["city"];?>" type="text" style="display: none;">
    <input name="nickname" id="nickname" value="<?php echo $userinfo["nickname"];?>" type="text" style="display: none;">

 

        <div align="center">
        <?php echo $userinfo["nickname"];?>
        <h3><font color="#FF0000">您好,请输入您的身份证号码：</font></h3>
<?php
								require_once 'conf/db_mysqlwx.class.php';
								$openid = $userinfo ["openid"];
								$conn = new DB ();
								$conn->open ();
								$result = mysql_query ( "SELECT * FROM `vip_wechat` WHERE openid='$openid'" );
								echo "<br />";
								if (mysql_num_rows ( $result ) == 0) {
								} else {
									
									while ( $row = mysql_fetch_array ( $result ) ) {
										
										$vipid = $row ["vipid"];
										$nickname = $row ["nickname"];
										$pid = $row ["pid"];
										$tel = $row ["tel"];
										$totalamount = $row ["totalamount"];
										$totalinterest = $row ["totalinterest"];
										echo "<script>location.href='hykbindsuccess.php?vipid=$vipid&openid=$openid&nickname=$nickname&pid=$pid&tel=$tel&totalamount=$totalamount&totalinterest=$totalinterest';</script>";
									}
								}
								mysql_free_result ( $result );
								$conn->close ();
								?>
        </div>
<div align="center">

    <div class="fieldcontain">
            <input name="pid" id="pid" class="form-control"
							value="" type="text">
          </div>
          </br>
          <div>
            <input type="submit" data-inline="true" align="middle" class="btn btn-default btn-lg"
							value="绑&nbsp;定 "
							>
</div> 
</br>                        
            <?php
							if (! empty ( $_GET ['errno'] )) {
								$errno = $_GET ['errno'];
								if ($errno == 1) {
									echo "<br /><font color='red' size='3'>您的积分卡已经被某个微信号绑定，如有疑问请联系门店前台！</font>";
								}
								if($errno == 2){
									echo "<br /><font color='red' size='3'>您的证件号不存在，请到当地线下门店办理积分卡或者完善证件号等信息，没有证件认证的积分卡不能绑定微信号！谢谢您的合作！</font>";
								}
								if($errno == 3){
									echo "<br /><font color='red' size='3'>请输入有效的15或者18位身份证件号！</font>";
								}
								if($errno == 4){
									echo "<br /><font color='red' size='3'>证件号不能为空！</font>"; 
								}
							} 
		?>
          </div>
  </form>
<div>
<h3>福建会员使用须知:</h3>
<u>1、必须输入您的身份证号码进行绑定，未用身份证号码办理的积分卡无法进行绑定，请向当地门店服务台补充您的身份证号码！</u><br/>
<u>2、绑定之后您可以方便查询本人积分信息，消费记录！</u><br/>
<u>3、一个微信号只能绑定一张积分卡！</u><br/>
<u>4、如发现积分卡已经被非本人微信号盗绑，请拿上您的有效身份证件，尽快到冠超市当地门店前台解绑!</u>
</div>
</br>
<div>
  <img src="images/logo.png" class="img-responsive" alt="Responsive image">
</div>
</div>
</BODY>
</HTML>
