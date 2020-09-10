<?php

if (isset($_POST["btnOK"])) {

  if ($_POST["txtUserName"] != "" && $_POST["txtUserPhone"] != "" && $_POST["txtIdentityID"] != "" && $_POST["txtUserAccount"] != "" && $_POST["txtPassword"] != "") {
    $username = $_POST["txtUserName"];
    $userphone = $_POST["txtUserPhone"];
    $identityID = $_POST["txtIdentityID"];
    $account = $_POST["txtUserAccount"];
    $password = $_POST["txtPassword"];
    $sql = "SELECT * FROM bankuser WHERE `account`='$account'";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // 執行SQL查詢
    require("PDOconnDB.php");
    $select = $link->prepare($sql);
    $select->execute();
    $total_records = $select->rowCount();


    // 是否有查詢到有相同帳號
    if ($total_records > 0) {
      echo "<script>alert('此帳戶已被註冊')</script>";
    }
    //把值新增到顧客名單
    else {

      $sql = <<<multi
    insert into bankuser (username,userphone,identityID,account,password)
    values ('$username','$userphone','$identityID','$account','$hash')
    multi;
      echo $sql;
      require("PDOconnDB.php");
      $link->exec($sql);

      header("location:index.php");
    }
  } else {

    echo "<script>alert('有欄位未輸入')</script>";
  }
}

if (isset($_POST["btnLogin"])) {

  header("Location: login.php");
  exit();
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

    <form id="form1" name="form1" method="post">
      <tr bgcolor="#005757">
        <td>
          <div id="title">
            <div></div>
            <font color="#FFFFFF" align="center">註冊帳號</font>
            <div>

            </div>
          </div>
        </td>

      </tr>
      <tr>
        <td>使用者名稱<br>

          <input type="text" name="txtUserName" id="txtUserName" required></td>
      </tr>

      <td>身分證字號<br>

        <input type="text" name="txtIdentityID" id="txtIdentityID" onkeyup="value=value.replace(/[\W]/g,'') " required /></td>
      </tr>
      <tr>
        <td>使用者電話<br>

          <input type="text" name="txtUserPhone" id="txtUserPhone" onkeyup="value=value.replace(/[^\d]/g,'') " required /></td>
      </tr>

      <tr>
        <td>使用者帳號<br>

          <input type="text" name="txtUserAccount" id="txtUserAccount" onkeyup="value=value.replace(/[\W]/g,'') " required /></td>
      </tr>
      <tr>
        <td>使用者密碼<br>

          <input type="password" name="txtPassword" id="txtPassword" onkeyup="value=value.replace(/[\W]/g,'') " required /></td>
      </tr>
      <tr>

        <td colspan="2" align="center">

          <hr>

          <input type="submit" name="btnOK" id="btnOK" value="新增" />
          <a id="aurl" href="login.php " class="btn">我已經有帳號</a>




        </td>
      </tr>
      <tr bgcolor="#005757">
        <td>
          <div>
            <font color="#005757">123</font>
          </div>

        </td>


    </form>
    </tr>

    </div>
  </table>


</body>

</html>