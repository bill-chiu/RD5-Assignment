<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>sign_out.php</title>
</head>
<body>
<?php
 // 啟用交談期
session_start(); 

// 檢查Session變數是否存在, 表示是否已成功登入
$_SESSION["login_session"] = false;
$_SESSION["id"]="-1";
$_SESSION['user']="Guest";
//回index.php
header("location:index.php");  

?>
</body>
</html>