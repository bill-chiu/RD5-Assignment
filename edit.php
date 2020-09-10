<?php




session_start();
require("PDOconnDB.php");

if (isset($_POST["btnDelete"])) {
  $_SESSION["delete"] = true;
  header("Location: flag.php");
  exit();
}


if (!isset($_GET["id"])) {
  die("id not found.");
}
$id = $_GET["id"];
if (!is_numeric($id)) {
  die("id is not a number");
}

if (isset($_POST["btnOK"]) && $_POST["txtUserPhone"] != ""  && $_POST["txtPassword"] != "") {
  $username = $_POST["txtUserName"];
  $userphone = $_POST["txtUserPhone"];
  $account = $_SESSION['account'];
  $password = $_POST["txtPassword"];
  $newpassword = $_POST["txtNewPassword"];
  $hash2 = password_hash($newpassword, PASSWORD_DEFAULT);
  //查詢帳號資料
  $sql = "SELECT * FROM bankuser WHERE `account`='$account'";
  // 執行SQL查詢


  $result = $link->query($sql);
  $row = $result->fetch();
  $hash = $row["password"];

  if (password_verify($password, $hash)) {

    $sql = <<<multi
    update bankuser set 
    username='$username',
    userphone='$userphone',
    account='$account',
    password='$hash2'
    where bankuser .userId=$id
multi;

    $result = $link->query($sql);
    echo "<script>alert('更改成功')</script>";
    $_SESSION['user'] = $username;

    header("Refresh:0.1;index.php");
    exit();
  } else {
    echo "<script>alert('密碼錯誤')</script>";
    $sql = "select * from bankuser where userId =$id";

    $result = $link->query($sql);
    $row = $result->fetch();
  }
} else {

  $sql = <<<multi
    select * from bankuser where userId =$id
multi;

  $result = $link->query($sql);
  $row = $result->fetch();
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
            <font color="#FFFFFF" align="center">修改帳號</font>
            <div>
              <a href="index.php?id=<?= $row["userId"] ?>" id="back" class="btn btn-info btn-sm">返回</a>
            </div>
          </div>
        </td>

      </tr>
      <tr>
        <td>使用者名稱<br>

          <input type="text" name="txtUserName" id="txtUserName" value="<?= $row["username"] ?>"></td>
      </tr>

      <tr>
        <td>使用者電話<br>

          <input type="text" name="txtUserPhone" id="txtUserPhone" value="<?= $row["userphone"] ?>" /></td>
      </tr>

      <td>舊密碼<br>

        <input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      <tr>
        <td>使用者密碼<br>

          <input type="password" name="txtNewPassword" required id="txtNewPassword" /></td>

      <tr>
        <td>
          <!-- <div id="gg" > -->
          <hr><input type="submit" name="btnOK" id="btnOK" value="修改" />

    </form>
    <form id="form2" name="form2" method="post">
      <input type="submit" name="btnDelete" id="btnDelete" value="刪除帳號" />

    </form>
    <!-- </div> -->

    </td>
    </tr>

    <tr bgcolor="#005757">
      <td>
        <div>
          <font color="#005757">123</font>
        </div>
      </td>


    </tr>

    </div>
  </table>


</body>

</html>