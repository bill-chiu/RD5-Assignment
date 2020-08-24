<?php
//啟用session
session_start();

//如果沒有驗證碼
function randowverif()
{

  $_SESSION['verification1 '] = rand(0, 9);
  $_SESSION['verification2 '] = rand(0, 9);
  $_SESSION['verification3 '] = rand(0, 9);
  $_SESSION['verification4 '] = rand(0, 9);

}


if (!isset($_POST["Verif"])) {
  randowverif();
}
$_SESSION['verification '] = $_SESSION['verification1 '] * 1000 + $_SESSION['verification2 '] * 100 + $_SESSION['verification3 '] * 10 + $_SESSION['verification4 '];

$account = "";
$password = "";
$verif = "";

//如果按下確認按鈕

if (isset($_POST["btnOK"])) {
  $account = $_POST["txtUserAccount"];
  $password = $_POST["txtPassword"];
  $verif = $_POST["Verif"];
}

//如果按下回首頁
if (isset($_POST["btnLogin"])) {

  header("Location: add.php");
  exit();
}
// 檢查是否輸入使用者名稱和密碼
if ($account != "" && $password != "") {
  // 建立MySQL的資料庫連接 
  require("connDB.php");
  // 建立SQL指令字串
  $sql = "SELECT * FROM bankuser WHERE `password`='$password' AND `account`='$account'";

  // 執行SQL查詢
  $result = mysqli_query($link, $sql);
  $total_records = mysqli_num_rows($result);
  
  // 是否有查詢到使用者記錄以及驗證碼是否正確
  if ($total_records > 0 && $_SESSION['verification '] == $verif) {

    $row = mysqli_fetch_assoc($result);
    // && $_SESSION['verification '] == $verif
    // 成功登入, 指定Session變數
    $_SESSION['user'] =  $row["username"];
    $_SESSION['id'] =  $row["userId"];
    $_SESSION['moneynow']=$row["money"];
    $_SESSION["login_session"] = true;

    header("Location: index.php");
    // 登入失敗
  } else {  
    randowverif();
    //如果沒有這個帳密
    if (!$total_records > 0) {
      echo "<center><font color='red'>";
      echo "使用者名稱或密碼錯誤!<br/>";
      echo "</font>";
      //如果驗證碼比對失敗
    } else {
      echo "<center><font color='red'>";
      echo "驗證碼錯誤!<br/>";
      echo "</font>";
    }

    $_SESSION["login_session"] = false;
  }
  // 關閉資料庫連接  
  mysqli_close($link);  
  //如果有空白
} else {
  randowverif();

  echo "<center><font color='red'>";
  echo "使用者名稱或密碼未輸入!<br/>";
  echo "</font>";
}

?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Lab - Login</title>
</head>

<body>
  <form id="form1" name="form1" method="post">

    測試用帳密:<br>
    admin / 1234 <br>

    jolin / 1234
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 登入</font>
        </td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者帳號</td>
        <td valign="baseline"><input type="text" name="txtUserAccount" id="txtUserAccount" /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">
          <font size="4">驗證碼:</font>
          <p><img src="<?php echo "images/" . $_SESSION['verification1 '] . '.png' ?>" />
            <img src="<?php echo "images/" . $_SESSION['verification2 '] . '.png' ?>" />
            <img src="<?php echo "images/" . $_SESSION['verification3 '] . '.png' ?>" />
            <img src="<?php echo "images/" . $_SESSION['verification4 '] . '.png' ?>" /></p>
        </td>

        <td><input type="text" name="Verif"  />
        </td>

      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <input type="submit" name="btnLogin" id="btnLogin" value="註冊" />
        </td>
      </tr>

    </table>
  </form>
</body>

</html>