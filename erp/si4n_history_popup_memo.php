<?
$sub_menu = "1901000";
include_once("./_common.php");
$sql_common = " from si4n_history ";
$is_admin = "super";
//echo $is_admin;
$sql_search = " where idx='$idx' ";
$sql = " select * $sql_common $sql_search ";
//echo $sql;
$row = sql_fetch($sql);
//사업장 기본정보 호출
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$sub_title = $row_com['com_name'];
$g4[title] = $sub_title." : 4대보험절감컨설팅 이력 : ".$easynomu_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
</head>
<body style="margin:10px;">
<pre style="padding:0 0 5px 0;">
<?
//처리결과
if($memo == "etc") {
	echo $row['si4n_etc'];
//현황1
} else if($memo == "condition1") {
	echo $row['si4n_memo1_condition'];
//문제점1
} else if($memo == "problem1") {
	echo $row['si4n_memo1_problem'];
//방향1
} else if($memo == "memo1") {
	echo $row['si4n_memo1'];
//현황2
} else if($memo == "condition2") {
	echo $row['si4n_memo2_condition'];
//문제점2
} else if($memo == "problem2") {
	echo $row['si4n_memo2_problem'];
//방향2
} else if($memo == "memo2") {
	echo $row['si4n_memo2'];
}
?>
</pre>
</body>
</html>
