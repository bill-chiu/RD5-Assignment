<?php
session_start();

require("connDB.php");

$id = $_SESSION['id'];

if (isset($_POST["btnOK"]) && $_POST["txtMoney"] != "") {
    $addmoney = $_POST["txtMoney"];
    $afteraddmoney = $_SESSION['moneynow'] + $addmoney;
    $moneynow = $_SESSION['moneynow'];
    $remarks = $_POST["txtRemarks"];

    $sql = <<<multi
    insert into savelist 
    (originalmoney,editmoney,nowmoney,userId,data,remarks) values 
    ($moneynow,$addmoney,$afteraddmoney,$id,current_timestamp(),'$remarks')


  multi;
    $result = mysqli_query($link, $sql);

    //     $sql = <<<multi
    //       update bankuser set 
    //       money='$afteraddmoney'    
    //       where bankuser .userId=$id
    //   multi;
    $_SESSION['moneynow'] = $afteraddmoney;
    //     $result = mysqli_query($link, $sql);
    $_SESSION["end1"]=true;
    $_SESSION["end2"]=true;
    header("Location: flag.php");
    exit();
} else {

    $sql = <<<multi
      select * from bankuser where userId =$id
  multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
}




if (isset($_POST["btnHome"])) {

    header("Location: index.php");
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
    <h6>  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

            <tr bgcolor="#005757">
                <td>
                    <div id="title">
                        <div></div>
                        <div>  <font color="#FFFFFF">存款</font></div>
                        <div>
                            <a href="admin.php" id="back" class="btn btn-info btn-sm">返回</a>
                        </div>
                    </div>
                </td>

            </tr>  
            <tr>
                <td align="left" style="color:#009393">存款金額(存款帳戶尚餘$<?= $_SESSION["moneynow"] ?>)
                    <input type="text" name="txtMoney" id="txtMoney" placeholder="輸入金額" />
                    <hr>


                </td>
            </tr>
            <tr align="center">

            </tr>

            <tr>
                <td align="left" style="color:#009393">存款說明(非必填)<br>
                    <input type="text" name="txtRemarks" id="txtRemarks" placeholder="將顯示在交易明細" /></td>
            </tr>

            <tr bgcolor="#005757">
                <td colspan="2" align="center">
                    <input type="submit" name="btnOK" id="btnOK" value="立刻存款" style="color:#009393" />


                </td>
            </tr>
        </table>
    </form>
</body>


</html>