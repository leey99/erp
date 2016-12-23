<?
$sub_menu = "1900100";
include_once("./_common.php");
echo "job_time_check_ok_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

$sql_common = " check_ok = '$check_ok' , editdt = '$now_time' ";
/*
if($check_ok == 3) {
	$sql_common2 = " , joindt = '$now_date' ";
} else {
	$sql_common2 = "";
}
*/

$sql = " update job_time_opt set 
			$sql_common
			$sql_common2
			where id = '$id' ";
//echo $sql;
sql_query($sql);
alert("정상적으로 확인체크 되었습니다.","job_time_check_ok_update.php");
?>
