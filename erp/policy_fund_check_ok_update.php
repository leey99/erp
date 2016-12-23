<?
$sub_menu = "1500100";
include_once("./_common.php");
if(!$id) exit;
//echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

$sql_common = " check_ok = '$check_ok' ";

if($check_ok == 3) {
	$sql_common2 = " , process_date = '$now_date' ";
} else {
	$sql_common2 = "";
}

$sql = " update policy_fund_opt set 
			$sql_common
			$sql_common2
			where id = '$id' ";
//echo $sql;
sql_query($sql);
alert("정상적으로 확인체크 되었습니다.","policy_fund_check_ok_update.php");
?>
