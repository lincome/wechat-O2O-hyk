<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0 minimum-scale=0.3, maximum-scale=2.0, user-scalable=yes" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div align="center">
<!--<FONT style="FONT-SIZE: 20pt; FILTER: glow(color=gray,strength=6); WIDTH: 100%; color:#0F0; LINE-HEIGHT: 150%; FONT-FAMILY: 华文行楷" >
<B> 主人~我是你的电子会卡<br />使用时向收银员出示此卡！</B></FONT>-->

<TABLE cellSpacing=0 cellPadding=0 align=center background=http://nxm.16789.net/s-helpSite/domName/nxm/2004121215545877458.gif border=0>
<TBODY>
<TR>
<TD style="FILTER: chroma(color=#336699">
<TABLE align=center bgColor=#fcf3f4>
<TBODY>
<TR>
<TD align=middle><FONT style="FONT-SIZE: 20pt" face=华文新魏 color="#0000FF"><B> 主人~我是你的电子会卡<br />使用时向收银员出示此卡</B></FONT></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

<img src="images/huiyuanka.jpg" width="304" height="185" ><br />
<!--<FONT style="FONT-SIZE: 25pt; FILTER: shadow(color=#af2dco); WIDTH: 100%; COLOR: #730404; LINE-HEIGHT: 100%; FONT-FAMILY: 华文行楷" size=6>&nbsp;
刷我！刷我！刷我！
</FONT><br />-->
<?php
$cId = $_REQUEST['vipid'];
if(strlen($cId)==12 || strlen($cId)==13 )
{
	$image="buildcode.php?cardid=$cId";
}
else {
	header("Location:default.php?errno=1");
	exit();
}
?>
<img  src="<?php echo $image;?>" width="304" height="127" /><p></p>
</div>
<div data-role="footer">
<h2>冠超市版权所有！</h2>
</div>
</body>
</html>