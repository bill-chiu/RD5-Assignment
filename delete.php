<?php
session_start();
$id=$_SESSION['id'];
if ($id!=1){
$sql = <<<multi
    delete from bankuser where userId =$id
multi;

require("PDOconnDB.php");
$link->exec($sql);
}
require("sign_out.php");

?>