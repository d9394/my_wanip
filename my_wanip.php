<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IP地址查询">
<?php 
	if(isset($_GET['dns'])){
		$get_dns = htmlspecialchars(trim($_GET['dns']));
	}
	if(!isset($get_dns))
	{
		//Gets the IP address
		$ip = getenv("REMOTE_ADDR") ; 
		Echo "Your IP is " . $ip; 
//		Echo "<br/>是否代理 : " . $_SERVER['HTTP_VIA'];
		if(!empty($_SERVER['HTTP_VIA']))    //使用了代理
		{
			if(!isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				//Anonymous Proxies    普通匿名代理服务器
				//代理IP地址为 $_SERVER['REMOTE_ADDR']
				echo "<br/>普通匿名代理服务器 : " . $_SERVER['REMOTE_ADDR'];
			} else {
				//Transparent Proxies 透明代理服务器
				//代理IP地址为 $_SERVER['REMOTE_ADDR']
				//真实ip地址为 $_SERVER['HTTP_X_FORWARDED_FOR']
				echo "<br/>透明代理服务器 : " . $_SERVER['REMOTE_ADDR'];
			}
		} else {
			//没有代理或者是高匿名代理
			//真实ip地址为 $_SERVER['REMOTE_ADDR']
		}
	} else {
		$get_dns = strtolower($get_dns);
		$get_dns = str_replace("select","",$get_dns);
		$get_dns = str_replace("*","",$get_dns);
		$ip = dns_get_record($get_dns, DNS_A);
//		echo json_encode($ip)."<BR/>";
		if(count($ip)>0)
		{
			echo "DNS is ".$ip[0]['ip'];
		}
	}
?>
