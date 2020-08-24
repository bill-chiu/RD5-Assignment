<?php

session_start();
require("connDB.php");
echo $_SESSION['moneynow'];
$id = $_SESSION['id'];
echo $id;
$sql = <<<multi
select * from savelist where userId =$id
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
                <font color="#FFFFFF">網銀系統 － 金流</font>
            <td bgcolor="#CCCCCC"></td>
            <td bgcolor="#CCCCCC"></td>
            <td bgcolor="#CCCCCC"></td>
            <td align="left" bgcolor="#CCCCCC" valign="baseline">


                <a>您好<?= $_SESSION["user"] ?> </a>

                <tr>
                <td>交易前餘額</td>
                <td>交易金額</td>
                <td>帳戶餘額</td>
                <td>交易時間</td>
                <td>備註</td>
                </tr>
        <tr>


            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <td><?= $row["originalmoney"] ?></td>
                <td><?= $row["editmoney"] ?></td>
                <td><?= $row["nowmoney"] ?></td>
                <td><?= $row["data"] ?></td>
                <td><?= $row["remarks"] ?></td>

        </tr>
    <?php  } ?>




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