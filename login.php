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

//如果按下回註冊
if (isset($_POST["btnLogin"])) {

  header("Location: add.php");
  exit();
}
if(isset($_POST["btnOK"])){
// 檢查是否輸入使用者名稱和密碼
if ($account != "" && $password != ""){
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
    $_SESSION['account'] =  $row["account"];
    $_SESSION['id'] =  $row["userId"];
    $id = $row["userId"];
    $_SESSION["login_session"] = true;
    //搜尋該帳戶最後一筆交易資料
    $sql = "SELECT * FROM `savelist` where userId=$id ORDER BY `savelist`.`data` DESC";
    $moneyresult = mysqli_query($link, $sql);
    //計算交易紀錄次數
    $money_records = mysqli_num_rows($moneyresult);
    //如果曾經有交易紀錄
    if ($money_records > 0) {
      //紀錄現在的數字並儲存到SESSION
      $row = mysqli_fetch_assoc($moneyresult);
      $_SESSION['moneynow'] = $row["nowmoney"];
      //如果沒有任何交易紀錄，則設定為0
    } else {
      $sql = <<<multi
      insert into savelist 
      (originalmoney,editmoney,nowmoney,userId,data,species,remarks) values 
      (0,0,0,$id,current_timestamp(),'新帳號','新帳號')
    multi;
      $result = mysqli_query($link, $sql);
    }
    header("Location: index.php");
    // 登入失敗
  } else {
    randowverif();
    //如果沒有這個帳密
    if (!$total_records > 0) {

      echo "<script>alert('使用者名稱或密碼錯誤')</script>";
      //如果驗證碼比對失敗
    } else {

      echo "<script>alert('驗證碼錯誤')</script>";
    }

    $_SESSION["login_session"] = false;
  }
  // 關閉資料庫連接  
  mysqli_close($link);
  //如果有空白
} else {
  randowverif();
  echo "<script>alert('使用者名稱或密碼未輸入')</script>";
}
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
            <font color="#FFFFFF" align="center">登入</font>
            <div>

            </div>
          </div>
        </td>

      </tr>
      <tr>
        <td>使用者帳號<br>

          <input type="text" name="txtUserAccount" id="txtUserAccount" /></td>
      </tr>
      <tr>
        <td>使用者密碼<br>

          <input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>

      <tr>
        <td>
          <font size="4">驗證碼:</font>
          <img src="<?php echo "images/" . $_SESSION['verification1 '] . '.png' ?>" />
          <img src="<?php echo "images/" . $_SESSION['verification2 '] . '.png' ?>" />
          <img src="<?php echo "images/" . $_SESSION['verification3 '] . '.png' ?>" />
          <img src="<?php echo "images/" . $_SESSION['verification4 '] . '.png' ?>" />
          <input type="text" name="Verif" id="Verif" />
        </td>
        </td>
      </tr>

      <tr>
        <td colspan="2" align="center">
          <hr><input type="submit" name="btnOK" id="btnOK" value="登入" />
          <input type="submit" name="btnLogin" id="btnLogin" value="註冊" />
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