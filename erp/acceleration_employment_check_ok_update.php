<?
$sub_menu = "1900500";
include_once("./_common.php");
echo "check_ok_update";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//담당자 설정
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];

//이력 DB 저장용 쿼리
$sql_employment = " select * from com_employment where com_code='$id' ";
$result_employment = sql_query($sql_employment);
$row_employment = mysql_fetch_array($result_employment);
$branch_file_1 = $row_employment['branch_file_1'];
$branch_file_2 = $row_employment['branch_file_2'];
$branch_file_3 = $row_employment['branch_file_3'];
$branch_file_4 = $row_employment['branch_file_4'];
$main_file_1 = $row_employment['main_file_1'];
$main_file_2 = $row_employment['main_file_2'];
$main_file_3 = $row_employment['main_file_3'];
$main_file_4 = $row_employment['main_file_4'];
$employment_file_1 = $row_employment['employment_file_1'];
$employment_file_2 = $row_employment['employment_file_2'];
$employment_file_3 = $row_employment['employment_file_3'];
$employment_file_4 = $row_employment['employment_file_4'];
$employment_memo = $row_employment['employment_memo'];
$employment_process = $row_employment['employment_process'];
//첨부파일
$branch_file_sql_1 = " branch_file_1 = '$branch_file_1', ";
$branch_file_sql_2 = " branch_file_2 = '$branch_file_2', ";
$branch_file_sql_3 = " branch_file_3 = '$branch_file_3', ";
$branch_file_sql_4 = " branch_file_4 = '$branch_file_4', ";
$main_file_sql_1 = " main_file_1 = '$main_file_1', ";
$main_file_sql_2 = " main_file_2 = '$main_file_1', ";
$main_file_sql_3 = " main_file_3 = '$main_file_3', ";
$main_file_sql_4 = " main_file_4 = '$main_file_4', ";
$employment_file_sql_1 = " employment_file_1 = '$employment_file_1', ";
$employment_file_sql_2 = " employment_file_2 = '$employment_file_2', ";
$employment_file_sql_3 = " employment_file_3 = '$employment_file_3', ";
$employment_file_sql_4 = " employment_file_4 = '$employment_file_4', ";
$employment_memo_sql = " employment_memo = '$employment_memo', ";

//처리현황 변경
$sql_common = " employment_process = '$check_ok', employment_user = '$mb_nick', employment_editdt = '$now_time' ";
//처리현황(검토)일 경우 등록일자 변경 151201
if($employment_process != 6 && $check_ok == 6) $sql_common2 = " , employment_regt='$now_time' ";
else $sql_common2 = "";
$sql = " update com_employment set $sql_common $sql_common2 where com_code = '$id' ";
//echo $sql;
sql_query($sql);
//해당없음 처리현황 선택 시 자동 감원방지기간조회 처리현황 해당없음 처리 151126
if($check_ok == 5) {
	$sql2 = " select * from com_reduction where com_code='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	if($row2['com_code']) {
		$sql_common = " reduction_process = '$check_ok', reduction_user = '$mb_nick', reduction_editdt = '$now_time' ";
		$sql = " update com_reduction set $sql_common where com_code = '$id' ";
		sql_query($sql);
	}
}
//이력 DB 저장
$sql_history = " insert com_employment_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', 
		$branch_file_sql_1
		$branch_file_sql_2
		$branch_file_sql_3
		$branch_file_sql_4
		$main_file_sql_1
		$main_file_sql_2
		$main_file_sql_3
		$main_file_sql_4
		$employment_file_sql_1
		$employment_file_sql_2
		$employment_file_sql_3
		$employment_file_sql_4
		$employment_memo_sql
		employment_process = '$check_ok'
";
sql_query($sql_history);
alert("정상적으로 확인체크 되었습니다.", $_SERVER['PHP_SELF']);
?>
