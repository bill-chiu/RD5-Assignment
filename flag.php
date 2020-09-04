<?php

session_start();
require("connDB.php");
$id = $_SESSION['id'];
$sql = <<<multi
select * from savelist where userId =$id ORDER BY `savelist`.`data` DESC

multi;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$listid = $row["savelistId"];

if (isset($_POST["btnExit"])) {
    $_SESSION["end1"] = false;
    header("Location: flag.php");
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="mycss.css">
    <style>

    </style>
</head>

<body>
    <form id="form1" name="form1" method="post">
        <h6>
            <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

                <tr bgcolor="#005757">
                    <td>
                        <div id="title">
                            <div></div>
                            <div>
                                <font color="#005757">123</font>
                            </div>
                            <div>

                            </div>
                        </div>
                    </td>

                </tr>

                <?php if ($_SESSION["delete"] == true) { ?>

                    <td> 是否刪除帳號(注意！刪除後將無法取回帳戶內的金錢)
                        <a href="admin.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">取消</a>
                        <a href="delete.php?id=<?= $row["userId"] ?>" class="btn btn-danger btn-sm">刪除</a>

                    </td>
                <?php } else { ?>


                    <?php if ($_SESSION["end1"] == true) {
                        $_SESSION["end1"] = false
                    ?>

                        <td> 是否顯示明細表
                            <a href="see_money.php?id= <?= $row["savelistId"] ?>" class="btn btn-success btn-sm">查看明細表</a>
                            <a href="flag.php?id=<?= $id ?>" class="btn btn-danger btn-sm">取消</a>

                        </td>
                    <?php } else { ?>

                        <!-- <?php if ($_SESSION["end2"] == true) { ?> -->

                        <td> 是否結束交易
                            <a href="admin.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">繼續交易</a>
                            <a href="sign_out.php?id=<?= $id ?>" class="btn btn-danger btn-sm">登出</a>

                        </td>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <tr bgcolor="#005757">
                <td colspan="2" align="center">
                    <div>
                        <font color="#005757">123</font>
                    </div>


                </td>
            </tr>
            </table>
    </form>
</body>


</html>