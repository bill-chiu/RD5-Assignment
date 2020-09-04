<?php

session_start();
require("connDB.php");
$see = true;
$id = $_GET["id"];
$sql = <<<multi
select * from savelist where savelistId =$id
multi;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

?>

<script>
    var isShow = true;


    function change() {
        if (!isShow) {
            isShow = true;

            document.getElementById('d1').innerText = '<?php echo $row["nowmoney"]?>';
            document.getElementById('a1').innerHTML = '<img src=see.svg> ';
        } else {                         
            isShow = false;

            document.getElementById('d1').innerText='***'
            document.getElementById('a1').innerHTML = '<img src=nosee.svg> ';
        }
    }
</script>

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
                        <font color="#FFFFFF" align="center" >清單明細</font>
                        <div>
                            <a href="detail.php?id=<?= $row["userId"] ?>" id="back" class="btn btn-info btn-sm">返回</a>
                        </div>
                    </div>
                </td>

            </tr>
            <tr id="greenline" >
                <td>
                    <div id="ttt">
                        <div>
                            <font color="#000000">金額</font>
                        </div>

                        <div>
                        </div>
                        <div align="right" >
                        <?= $row["editmoney"]  ?>
                    </div>
                    </div>
                </td>
            </tr>
            <tr id="greenline">
                <td>
                    <div id="ttt">
                        <div>
                            <font color="#000000">帳務日期</font>
                        </div>

                        <div>
                        </div> <div align="right" >
                        <?= substr($row["data"], 5, 5)  ?>
                    </div>
                    </div>
                </td>
            </tr>
            <tr id="greenline">
                <td>
                    <div id="ttt">
                        <div>
                            <font color="#000000">交易時間</font>
                        </div>

                        <div>
                        </div> <div align="right" >
                        <?= substr($row["data"], 10, 9) ?>
                    </div>
                    </div>
                </td>
            </tr>
            <tr id="greenline">
                <td>
                    <div id="ttt">
                        <div>
                            <font color="#000000">帳戶餘額</font> <a id="a1" href="javascript:;" onclick="change()"><img src=see.svg></a>
                        </div>

                        <div>
                        </div>
                        <div id="d1"  align="right">
                            <?php echo $row["nowmoney"] ;
                          
                            ?>

                        </div>
                </td>
            </tr>
            <tr id="greenline">
                <td>
                    <div id="ttt">
                        <div >
                            <font color="#000000">交易備註</font>
                        </div>

                        <div>
                        </div>

                    </div>
                    </div>
                </td>
            </tr>
            <tr id="greenline">
                <td>
                    <div id="ttt">
                        <div>
                            <font color="#000000">轉帳說明</font>
                        </div>

                        <div>
                        </div>                     <div id="d1 " align="right">
                        <?= $row["remarks"] ?>
                    </div>
                    </div>
                </td>
            </tr>
            <tr bgcolor="#005757">

                <td> </td>
            </tr>
        </table>
    </form>
</body>


</html>