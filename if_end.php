<?php

session_start();
require("connDB.php");
$id = $_SESSION['id'];
$sql = <<<multi
select * from bankuser where userId =$id
multi;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Lag - Member Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <table width="450" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>

      <td align="left" bgcolor="#CCCCCC">
        <font color="#FFFFFF">網銀系統 － 管理</font>
      <td bgcolor="#CCCCCC"></td>
      <td bgcolor="#CCCCCC"></td>
      <td bgcolor="#CCCCCC"></td>
      <td align="left" bgcolor="#CCCCCC" valign="baseline">

        <?php if ($_SESSION["login_session"] == false) { ?>
    <tr>
      <td>

        <a >This page for user only.</a>
      </td>
    </tr>


  <?php } else { ?>
    <a><?= $_SESSION["user"] ?> </a>
    <tr>

      <td> 是否顯示結束交易
          <a href="admin.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">繼續交易</a>
        <a href="sign_out.php?id=<?= $row["userId"] ?>" class="btn btn-danger btn-sm">登出</a>
      
      </td>
    </tr>
  <?php } ?>

  <tr>
    <td align="left" bgcolor="#CCCCCC"><a></a>
    </td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
  </tr>
  </table>


</body>

</html>