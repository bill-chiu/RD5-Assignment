<?php
session_start();

require("connDB.php");

$id = $_SESSION['id'];

if (isset($_POST["btnOK"]) && $_POST["txtMoney"] != "") {
    $addmoney = $_POST["txtMoney"];
    $afteraddmoney = $_SESSION['moneynow'] - $addmoney;
    $moneynow = $_SESSION['moneynow'];
    $remarks = $_POST["txtRemarks"];
    $account = $_POST["txtAccount"];

    if ($afteraddmoney >= 0) {

        $sql = "SELECT * FROM bankuser WHERE `account`='$account'";

        // 執行SQL查詢
        $result = mysqli_query($link, $sql);
        $total_records = mysqli_num_rows($result);

        // 是否有查詢到使用者記錄以及驗證碼是否正確
        if ($total_records > 0) {
            $row = mysqli_fetch_assoc($result);
            $otherid = $row["userId"];
            $sql = "SELECT * FROM `savelist` where userId=$otherid ORDER BY `savelist`.`data` DESC";
            echo $sql;
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            $othermoneynow = $row["nowmoney"];
            $otherafteraddmoney = $othermoneynow + $addmoney;

            $sql = <<<multi
    insert into savelist 
    (originalmoney,editmoney,nowmoney,userId,data,remarks) values 
    ($othermoneynow,$addmoney,$otherafteraddmoney,$otherid,current_timestamp(),'$remarks')
  multi;
            $result = mysqli_query($link, $sql);
            $sql = <<<multi
    insert into savelist 
    (originalmoney,editmoney,nowmoney,userId,data,remarks) values 
    ($moneynow,-$addmoney,$afteraddmoney,$id,current_timestamp(),'$remarks')
  multi;
            $result = mysqli_query($link, $sql);

            $_SESSION['moneynow'] = $afteraddmoney;

            header("Location: if_see_money.php");
            exit();
        }
    } else {
        echo "<center><font color='red'>";
        echo "餘額不足!<br/>";
        echo "</font>";
    }
} else {

    $sql = <<<multi
      select * from bankuser where userId =$id
  multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
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
        <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

            <tr bgcolor="#005757" >
                <td>
                    <div id="title">
                        <div></div>
                        <font color="#FFFFFF">轉帳</font>
                        <div>
                       <a href="admin.php" id="back" class="btn btn-info btn-sm">返回</a>
                       </div> 
                       </div>
                </td>

            </tr>
            <tr>
                <td align="left" style="color:#009393">轉出金額(存款帳戶尚餘$<?= $_SESSION["moneynow"] ?>)
                    <input type="text" name="txtMoney" id="txtMoney" placeholder="輸入金額" />
                    <hr>


                </td>
            </tr>
            <tr align="center">
                <td>給</td>
            </tr>
            <tr>

                <td align="left" style="color:#009393">轉入對象<br>
                    <input align="center" type="text" name="txtAccount" id="txtAccount" placeholder="輸入對方帳號" /></td>
            </tr>
            <tr>
                <td align="left" style="color:#009393">轉帳說明(非必填)<br>
                    <input type="text" name="txtRemarks" id="txtRemarks" placeholder="將顯示在雙方交易明細" /></td>
            </tr>

            <tr bgcolor="#005757">
                <td colspan="2" align="center">
                    <input type="submit" name="btnOK" id="btnOK" value="立刻轉帳" style="color:#009393" />


                </td>
            </tr>
        </table>
    </form>
</body>


</html>