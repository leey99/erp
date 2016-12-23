<?
include_once("./_common.php");

//id 파라미터 존재 시 스케줄 삭제
if($id) {
	$sql_common = "
						client_schedule_visitdt_manager = '',
						client_schedule_visitdt_writer = '',
						client_schedule_visitdt = '',
						client_schedule_visitdt_time = '',
						client_schedule_visitdt_check_ok = '',
						client_schedule_memo = ''
	";
	$sql = " update com_list_gy set $sql_common where com_code = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
}
goto_url("./client_schedule_view.php?w=u&id=".$id);
?>