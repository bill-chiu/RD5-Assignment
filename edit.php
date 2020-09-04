<?php




session_start();


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
require("connDB.php");
if (isset($_POST["btnOK"]) && $_POST["txtUserPhone"] != "" && $_POST["txtUserAccount"] != "" && $_POST["txtPassword"] != "") {
  $username = $_POST["txtUserName"];
  $userphone = $_POST["txtUserPhone"];
  $account = $_POST["txtUserAccount"];
  $password = $_POST["txtPassword"];


  $sql = <<<multi
    update bankuser set 
    username='$username',
    userphone='$userphone',
    account='$account',
    password='$password'
    where bankuser .userId=$id
multi;
  $result = mysqli_query($link, $sql);
  $_SESSION['user'] = $username;

  header("location:index.php");
  exit();
} else {

  $sql = <<<multi
    select * from bankuser where userId =$id
multi;
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
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

      <tr>
        <td>使用者密碼<br>

          <input type="password" name="txtPassword" id="txtPassword" value="<?= $row["password"] ?>" /></td>
      </tr>
      <tr>
        <td>
          <hr><input type="submit" name="btnOK" id="btnOK" value="修改" />

          <input type="submit" name="btnDelete" id="btnDelete" value="刪除帳號" />
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