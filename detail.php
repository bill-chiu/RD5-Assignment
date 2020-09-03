<?php

session_start();
require("connDB.php");
$id = $_SESSION['id'];

if (empty($_SESSION['num'])) {
    $_SESSION['num'] = 5;
}



if (isset($_POST["btnOK"])) {
    $_SESSION['num'] = $_SESSION['num'] + 5;
    $num = $_SESSION['num'];

    $sql = <<<multi
    select * from savelist where userId =$id  ORDER BY `savelist`.`data` DESC limit $num
    multi;
    $result = mysqli_query($link, $sql);
} else {
    $num = $_SESSION['num'];
    $sql = <<<multi
select * from savelist where userId =$id  ORDER BY `savelist`.`data` DESC limit $num
multi;
    $result = mysqli_query($link, $sql);
}
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
    <link rel="stylesheet" href="mycss.css">
</head>

<body>

  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">


        <tr bgcolor="#005757" >
            <td>
            </td>
            <td>
                <font color="#FFFFFF">清單</font>
            </td>
            <td>
                <a href="admin.php" id="back" class="btn btn-info btn-sm">返回</a>
            </td>
        </tr>
        <tr id="greenline">
            <td>交易日期</td>
            <td>交易備註</td>
            <td>交易金額</td>

        </tr>

        <?php $row = mysqli_fetch_assoc($result)  ?>
        <tr bgcolor="#F2F2F2" id="greenline">
            <?php $maxlist = $row["savelistId"]; ?>

            <td><?= substr($row["data"], 5, 5) ?></td>
            <td><?= $row["remarks"] ?></td>
            <td><?= $row["editmoney"] ?> <a href="see_money.php?id= <?= $row["savelistId"]; ?>" id="back" class="btn btn-info btn-sm">></a></td>

        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr id="greenline">
                <?php $maxlist = $row["savelistId"]; ?>
                <td><?= substr($row["data"], 5, 5) ?></td>
                <td><?= $row["remarks"] ?></td>
                <td><?= $row["editmoney"] ?> <a href="see_money.php?id= <?= $row["savelistId"] ?>" id="back" class="btn btn-info btn-sm">></a></td>

            </tr>
        <?php  } ?>
        <tr bgcolor="#005757">
            <td></td>
            <form id="form1" name="form1" method="post">
                <td>
                    <?php if ($maxlist > $num) { ?>
                        <input type="submit" name="btnOK" id="btnOK" value="我想看更多" style="color:#009393" />
                    <?php } ?>
                </td>
                <td></td>
            </form>
        </tr>
        </div>
    </table>


</body>

</html>