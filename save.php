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

    header("Location: if_see_money.php");
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
    <style>
        .box {

            padding-left: 100px;
            padding-right: 100px;


        }
    </style>
</head>

<body>
    <form id="form1" name="form1" method="post">
        <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <font color="#FFFFFF">網銀系統 - 存款</font>
                  
                    <a>目前帳戶餘額為<?= $_SESSION["moneynow"] ?> </a>

           
                </td>
            </tr>
            <tr>
    
            <td width="100" align="left" valign="baseline">輸入欲存款的金額</td>
            <td width="100" align="left" valign="baseline">備註</td>
            </tr>
            <tr>
               
                <td valign="baseline"><input type="text" name="txtMoney" id="txtMoney" /></td>
                <td valign="baseline"><input type="text" name="txtRemarks" id="txtRemarks" /></td>
            </tr>



            <tr>


                <!-- <td > <a class="btn btn-success btn-sm">１</a>
                    <a class="btn btn-success btn-sm">２</a>
                    <a class="btn btn-success btn-sm">３</a>
                    <br>
         
                    <a class="btn btn-success btn-sm">４</a>
                    <a class="btn btn-success btn-sm">５</a>
                    <a class="btn btn-success btn-sm">６</a>
                  <br>
          
                    <a class="btn btn-success btn-sm">７</a>
                    <a class="btn btn-success btn-sm">８</a>
                    <a class="btn btn-success btn-sm">９</a>

                </td> -->
            </tr>
            <tr>
                <td colspan="2" align="left" bgcolor="#CCCCCC">
                    <input type="submit" name="btnOK" id="btnOK" value="新增" />
                    <input type="reset" name="btnReset" id="btnReset" value="重設" />
                    <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
                </td>
            </tr>
        </table>
    </form>
</body>


</html>