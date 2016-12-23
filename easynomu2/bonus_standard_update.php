<?
$sub_menu = "500301";
include_once("./_common.php");

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];

if(!$id) exit;

$sql_common = " bonus_standard = '$bonus_standard',
	bonus_percent = '$bonus_percent'
";
$sql = " update pibohum_base_opt2 set 
			$sql_common 
			where com_code = '$com_code' and sabun = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
alert("정상적으로 적용 되었습니다.","bonus_standard_update.php");
?>
