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
<title>电子会员卡</title>
<!-- --><!--我的QQ：59353073 --><!-- -->
<script language="javascript">
        //JS验证输入的内容
        function checkInput()
        {
            var txtName=document.getElementById("vipid");
            var lblMsg=document.getElementById("lblMsg");
            
            //创建正则表达式
            var re=/^[0-9]{12,13}$/; //只输入数字正则
            //var re=/^[u4e00-u9fa5]{1,10}$/; //只输入汉字的正则
               
            if(txtName.value.search(re)==-1)
            {
                lblMsg.innerText = "请输入数字，字符介于12到13个。";
                //lblMsg.innerText = "请输入汉字，字符不能超过十个。";
                return false;
            }
            else
            {
                lblMsg.innerText = "√";
                return true;
            }
        }
</script>
<script>
$(function(){ 
    var w = $("#demo2").width();//容器宽度 
    $("#demo2 img").each(function(){//如果有很多图片，我们可以使用each()遍历 
        var img_w = $(this).width();//图片宽度 
        var img_h = $(this).height();//图片高度 
        if(img_w>w){//如果图片宽度超出容器宽度--要撑破了 
            var height = (w*img_h)/img_w; //高度等比缩放 
            $(this).css({"width":w,"height":height});//设置缩放后的宽度和高度 
        } 
    }); 
}); 
</script>
</head>
<body background="images/01_04.jpg">
<div id="demo2"  align="center">
<img src="images/default1.jpg" width="1080"  height="1586"/>
<br />
 <form method="get" action="hyk.php">
<table  border="0">
<tr>
<td align="right"><h3>卡号:</h3></td>
<td ><input type="text" name="vipid" id="vipid" style="width: 200px; height: 20px;font-size:15px;" onblur="return checkInput()"></td>
<td >
<div id="lblMsg"></div>
</td>
</tr>
<br />
<tr >
<td colspan="2" align="right" ><input type="submit" data-inline="true" align="middle"  value="生&nbsp;成 &nbsp;会&nbsp;员&nbsp;卡" style="width: 400px; height: 40px;font-size:35px;"></td>
</tr>
</table>
</form>
<?php
	if(empty($_get['errno'])){
		$errno=$_GET['errno'];
		if($errno==1){
			echo "<br /><font color='red' size='3'>你的输入不正确，请重新输入！</font>";
		}
	}
?>
</div>
<div data-role="footer">
<h2>冠超市版权所有！</h2>
</div>
</body>
</html>
