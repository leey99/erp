<?
$sub_menu = "400101";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");

$sql_a4 = " select * from com_list_gy where com_code = '$id' ";
$result_a4 = sql_query($sql_a4);
$row_a4 = mysql_fetch_array($result_a4);
$com_name_emp = $row_a4['com_name'];
$com_tel_emp = $row_a4['com_tel'];
$sql_common = " com_code = '$id',
						com_name_emp = '$com_name_emp',
						com_tel_emp = '$com_tel_emp',

						regdt = '$now_time',
						report_date = '$report_date',
						staff_name = '$staff_name',
						staff_ssnb = '$staff_ssnb',
						staff_tel = '$staff_tel',
						scholarship = '$scholarship',
						hope_job = '$hope_job',
						certificate = '$certificate',
						career = '$career',
						com_job = '$com_job',
						staff_memo = '$staff_memo'
";
//수정
if ($w == 'u'){
	$sql = " update employment_agency set $sql_common where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 인력관리 정보가 수정 되었습니다.","popup_emp_agency.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert employment_agency set $sql_common ";
	sql_query($sql);
	alert("정상적으로 인력관리 정보가 등록 되었습니다.","popup_emp_agency.php?id=$id");
}
?>