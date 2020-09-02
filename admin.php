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

  <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
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
    <a>您好<?= $_SESSION["user"] ?> </a><br>
    <a>目前帳戶餘額為<?= $_SESSION["moneynow"] ?> </a>
    <tr>


      <td> <a href="save.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">存款</a>
        <a href="withdrawal.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">提款</a>
        <a href="turn_money.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">轉帳</a>
        <a href="see_money.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">查詢交易紀錄</a>
        <a href="edit.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">修改帳戶資料</a>
     
      </td>
    </tr>
  <?php } ?>

  <tr>
    <td align="left" bgcolor="#CCCCCC"><a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
    </td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
  </tr>
  </table>


</body>

</html>