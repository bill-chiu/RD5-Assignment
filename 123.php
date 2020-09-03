<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
TEST1<br>
<a id="a1" href="javascript:;" onclick="change()">檢視xxx資料</a><br>
<div id="d1" style="display: none">
TEST2<br>
TEST3
</div>
TEST4<br>

<script>
var isShow = false;
function change() {
	if(!isShow) {
		isShow = true;
		document.getElementById('d1').style.display='';
		document.getElementById('a1').innerText = "隱藏xxx資料";
	}
	else {
		isShow = false;
		document.getElementById('d1').style.display='none';
		document.getElementById('a1').innerText = "檢視xxx資料";
	}			
}
</script>
</body>
</html>