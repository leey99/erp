<?
$sub_menu = "700100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");

$approval_process_id = "approval".$approval_no."_process";
$approval_process = $_POST[$approval_process_id];
if($approval_no == 1) $sql_approval1_process = " approval1_process='$approval_process', approval1_time='$now_time', ";
else if($approval_no == 2) $sql_approval2_process = " approval2_process='$approval2_process', approval2_time='$now_time', ";
else if($approval_no == 3) $sql_approval3_process = " approval3_process='$approval3_process', approval3_time='$now_time', ";
else if($approval_no == 4) $sql_approval4_process = " approval4_process='$approval4_process', approval4_time='$now_time', ";
else if($approval_no == 5) $sql_approval5_process = " approval5_process='$approval5_process', approval5_time='$now_time', ";
$sql_approval = " update business_log set 
									$sql_approval1_process
									$sql_approval2_process
									$sql_approval3_process
									$sql_approval4_process
									$sql_approval5_process
									id = '$id'
									where id = '$id' ";
//echo $sql_approval;
//exit;
sql_query($sql_approval);
$qstr = $_POST['qstr'];
alert("정상적으로 반려 되었습니다.","groupware_business_log.php?page=".$page."&".$qstr);
?>
