<?php

session_start();
require("connDB.php");
echo $_SESSION['moneynow'];
$id = $_SESSION['id'];
echo $id;
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

  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
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

      <td> 是否顯示明細表
          <a href="see_money.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">是</a>
        <a href="if_end.php?id=<?= $row["userId"] ?>" class="btn btn-danger btn-sm">否</a>
      
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