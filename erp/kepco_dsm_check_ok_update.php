<?
$sub_menu = "1901100";
include_once("./_common.php");
echo "kepco_dsm_check_ok_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//담당자 설정
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$sql_common = " kepco_dsm_process = '$check_ok', kepco_dsm_user = '$mb_nick', kepco_dsm_editdt = '$now_time' ";
$sql = " update com_list_gy_opt2 set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
//사업장 추가정보2 호출
$sql_com = "select * from com_list_gy_opt2 where com_code = '$id' ";
$row_com = sql_fetch($sql_com);
$kepco_dsm_process = $row_com['kepco_dsm_process'];
$kepco_dsm_no = $row_com['kepco_dsm_no'];
$kepco_dsm_memo = $row_com['kepco_dsm_memo'];
//이력 DB 저장
$sql_kepco_dsm_history = " insert kepco_dsm_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', kepco_dsm_process = '$kepco_dsm_process', 
		kepco_dsm_no = '$kepco_dsm_no',
		kepco_dsm_memo = '$kepco_dsm_memo'
";
sql_query($sql_kepco_dsm_history);

alert("정상적으로 확인체크 되었습니다.","kepco_dsm_check_ok_update.php");
?>
