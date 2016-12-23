<?
$sub_menu = "1900400";
include_once("./_common.php");
echo "check_ok_update";
if(!$id) exit;
echo $id."<br />".$damdang_code2;

//열람 설정
$sql_common = " damdang_code2 = '$damdang_code2' ";
$sql = " update com_list_gy set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
?>
