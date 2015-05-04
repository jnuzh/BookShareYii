<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BookShare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <script type="text/javascript" src="js/md5.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    
    
    
    <script type="text/javascript">
    $(function(){//google验证
	    $("#vcode_img").click(function(){
		    $(this).attr("src",'verification_code/create_code.php?' + Math.random());
	    });
	    
	});
	function md5_password(){
            var md5Result;
            md5Result = hex_md5(document.getElementById("password").value);
            document.getElementById("password").value = md5Result;
    }
    </script>
</head>
   
<body background="image/login_bg.jpg">
    <div class="row" >
        <div class="container col-sm-offset-2 col-sm-8" >
            <form class="form-signin" action="../controlers/clogin.php" role="form" onsubmit="return md5_password();" method="post">
                <h2 class="form-signin-heading" style="color:#ffffff">JNU Book Share</h2>
                <input type="text" class="form-control" placeholder="帐号" name="username" id="username" required autofocus>
                </br>
                <input type="password" class="form-control" placeholder="密码" name="password" id="password" required></br>
                
                <input type="text" class="form-control" placeholder="验证码" name="vcode" id="vcode" required></br>
                <img src="verification_code/create_code.php" id="vcode_img">
                </br></br>
               
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
                <button class="btn btn-lg btn-info btn-block" onclick='alert()'>注册</button>
            </form>
        </div>
    </div>
    
    <div class="text-center">
    </br></br></br>
        <p style="color:#ffffff"><?php echo "CopyRight 2014-".date("Y")." JNU ZHACM All Rights Reserved."."</br>"."暨南大学珠海校区ACM团队 版权所有";?></p>
    </div>
    
</body>
</html>
