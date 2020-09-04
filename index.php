<?php

session_start();

if(!isset($_SESSION["login_session"])or $_SESSION["login_session"]== false){
header("Location: login.php");

}

require("connDB.php");

$_SESSION["delete"] = false;
$_SESSION["end1"] = false;
$_SESSION["end2"] = false;

if (($_SESSION['num'] > 5)) {
  $_SESSION['num'] = 5;
}
$id = $_SESSION['id'];

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

            <tr bgcolor="#005757">
                <td>
                    <div id="title">
                        <div></div>
                        <font color="#FFFFFF">管理</font>
                        <div>
                            
                        </div>
                    </div>
                </td>

            </tr>
            <td> 
            <div id="ttt">
            <a href="save.php?id=<?= $id ?>" class="btn btn-info btn-sm">存款</a>
        <a href="withdrawal.php?id=<?= $id ?>" class="btn btn-info btn-sm">提款</a>
        <a href="turn_money.php?id=<?= $id?>" class="btn btn-info btn-sm">轉帳</a>
        </div>  <br>
        <div id="ttt">
        <a href="detail.php?id=<?= $id ?>" class="btn btn-info btn-sm">查詢交易紀錄</a>
        <a href="edit.php?id=<?= $id?>" class="btn btn-info btn-sm">修改帳戶資料</a>
        <a href="sign_out.php?id=<?= $id?>" class="btn btn-info btn-sm">登出</a></div>  

      </td>

            <tr bgcolor="#005757">
                <td colspan="2" align="center">
                   
                <div>
                        <font color="#005757">0</font>
                    </div>
                </td>
            </tr>
        </table>   </h3>  
    </form>
</body>


</html>