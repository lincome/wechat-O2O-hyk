<?php

$appid = "wx0fed524d0dbafd1e";
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0fed524d0dbafd1e&redirect_uri=http://guanmart.senfun.com/hyk/oauth.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
header("Location:".$url);
