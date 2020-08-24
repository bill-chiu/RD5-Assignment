<?php

session_start();
echo $_SESSION['moneynow'];
$userName = "Guest";
if (isset($_SESSION["user"])) {
  $userName = $_SESSION["user"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Lab - index</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <form id="form1" name="form1" method="post">
    <table width="450" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#F2F2F2">
      <tr>
        <td align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">網銀系統 - 首頁</font>
        </td>
      </tr>
      <tr>
        <td colspan="" align="center" bgcolor="#F2F2F2">

          <p><a href="admin.php"  class="btn btn-primary   btn-sm">管理資料</a>
       
            <?php
            if ($_SESSION["login_session"] == false) { ?>
              <a href="login.php" class="btn btn-info   btn-sm">登入帳號</a>
              <a href="add.php" class="btn btn-warning  btn-sm">註冊帳號</a></a>
            <?php } else { ?>

             <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
        <?php } ?>
      
  
        <a href="edit.php?id=<?=$_SESSION['id']?>" class="btn btn-success  btn-sm">修改帳號</a></p>
      



        
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">您好 <?= $userName ?> &nbsp;</td>
      </tr>
    </table>
  </form>


</body>

</html>