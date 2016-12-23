<?
$sub_menu = "100204";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
$sql_delete = " delete from com_code_sort where com_code = '$com_code' ";
sql_query($sql_delete);
$sql1 = " insert com_code_sort set item = '$sort1', sod = '$sod1', com_code = '$com_code', code = '1' ";
$sql2 = " insert com_code_sort set item = '$sort2', sod = '$sod2', com_code = '$com_code', code = '2' ";
$sql3 = " insert com_code_sort set item = '$sort3', sod = '$sod3', com_code = '$com_code', code = '3' ";
$sql4 = " insert com_code_sort set item = '$sort4', sod = '$sod4', com_code = '$com_code', code = '4' ";
sql_query($sql1);
sql_query($sql2);
sql_query($sql3);
sql_query($sql4);
alert("정상적으로 정렬코드가 저장 되었습니다.","com_code_sort.php");
?>
