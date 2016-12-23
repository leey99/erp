<?
$sub_menu = "100200";
include_once("./_common.php");
?>
<html>
<head>
<title>:::로그인페이지:::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
</head>

<script language=javascript>
<?
if(!$member['mb_id']) {
?>
location.href = "login.php?url=%2Fkidsnomu%2Fmain.php";
<?
} else {
?>
location.href = "main.php";
<?
}
?>
</script>

<body onLoad="">
<table border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
	    <td height="100"></td>
	</tr>
</table>
</body>
</html>