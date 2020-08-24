<?php

if (isset($_POST["btnOK"])) {
  
    if($_POST["txtUserName"]!=""&&$_POST["txtUserPhone"]!=""&&$_POST["txtIdentityID"]!=""&&$_POST["txtUserAccount"]!=""&&$_POST["txtPassword"]!=""){
    $username=$_POST["txtUserName"];
    $userphone=$_POST["txtUserPhone"];
    $identityID=$_POST["txtIdentityID"];
    $account = $_POST["txtUserAccount"];
    $password = $_POST["txtPassword"];
    $money=0;

    $sql = <<<multi
    insert into bankuser (username,userphone,identityID,account,password,money)
    values ('$username','$userphone','$identityID','$account','$password','$money')
    multi;
    echo $sql;
    require("connDB.php");
    mysqli_query($link, $sql);
    // $_SESSION["toast"]="Row inserted";
    header("location:index.php");
}else{
    echo "<center><font color='red'>";
    echo "有欄位未輸入!<br/>";
    echo "</font>";
}
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
    <style>
        .box {

            padding-left: 100px;
            padding-right: 100px;


        }
    </style>
</head>

<body>
  <form id="form1" name="form1" method="post">
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">網銀系統 - 註冊帳戶</font>
        </td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者名稱</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName"  /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">身分證字號</td>
        <td valign="baseline"><input type="text" name="txtIdentityID" id="txtIdentityID"  /></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者電話</td>
        <td valign="baseline"><input type="text" name="txtUserPhone" id="txtUserPhone" /></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者帳號</td>
        <td valign="baseline"><input type="text" name="txtUserAccount" id="txtUserAccount" /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="新增" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
        </td>
      </tr>

    </table>
  </form>
</body>


</html>