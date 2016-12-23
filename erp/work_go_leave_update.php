<?
$sub_menu = "100001";
include_once("./_common.php");
echo "work_go_leave_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");

//출퇴근 구분
if($type == "go") {
	$work_code = 1;
	$work_type = "출근";
} else {
	$work_code = 2;
	$work_type = "퇴근";
}

//사업장 기본정보 호출
$sql_work = "select * from work_go_leave where check_time like '$now_date%' and type = '$work_code' and user_id = '$id' ";
$row_work = sql_fetch($sql_work);
if($row_work['idx']) {
	//$check_date = explode(" ", $row_work['check_time']);
	alert("이미 ".$work_type." 체크 되었습니다. (".$row_work['check_time'].")","work_go_leave_update.php");
	exit;
}
//출퇴근 체크
$sql_common = " branch = '$branch', user_id = '$id', type = '$work_code', check_time = '$now_time' ";
$sql = " insert work_go_leave set $sql_common ";
//echo $sql;
sql_query($sql);

alert("정상적으로 ".$work_type." 체크 되었습니다.","work_go_leave_update.php");
?>
