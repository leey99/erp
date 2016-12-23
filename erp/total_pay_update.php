<?
$sub_menu = "400300";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//사업장 기본정보
$sql_common = " 
						samu_keep = '$samu_keep',
						samu_keep_date = '$samu_keep_date'
";

//사업장 추가정보 (관리자 전용)
$sql_common2 = " 
						tm_cust_numb = '$tm_cust_numb',
						tm_cust_name = '$tm_cust_name'
";
//사업장 추가정보 2
$sql_common_opt2 = " samu_call_date = '$samu_call_date',
						samu_feedback_memo = '$samu_feedback_memo'
";
//기본 필드 데이터 추가/수정
$sql = " update com_list_gy set 
			$sql_common 
			where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
//추가 필드 데이터 유무
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
if($total1) {
	$sql2 = " update com_list_gy_opt set 
				$sql_common2 
				where com_code = '$id' ";
} else {
	$sql2 = " insert com_list_gy_opt set 
				$sql_common2 
				, com_code = '$id' ";
}
sql_query($sql2);
//보수총액신고 데이터 유무
$sql_common_total = " 
						com_name = '$total_com_name',
						year = '$total_year',
						t_no = '$total_t_no',
						easynomu = '$total_input1',
						kidsnomu = '$total_input2',
						duzon = '$total_input3',
						fax = '$total_input4',
						mail = '$total_input5',
						etc = '$total_input6',
						etc_memo = '$total_input_etc',
						input_date = '$total_input_date',
						ok_report = '$total_process',
						ok_date = '$total_process_date',
						ok_report_gg = '$total_process_gg',
						ok_date_gg = '$total_process_date_gg'
";
$sql_total = " select * from com_total_pay where com_code='$id' and year='$total_year' ";
$result_total = sql_query($sql_total);
$total_total = mysql_num_rows($result_total);
if($total_total) {
	$sql_total = " update com_total_pay set 
				$sql_common_total
				where com_code = '$id' and year='$total_year' ";
} else {
	$sql_total = " insert com_total_pay set 
				$sql_common_total 
				, com_code = '$id' ";
}
sql_query($sql_total);

//보험료신고 데이터 유무
$sql_common_total_insure = " 
						com_name = '$total_insure_com_name',
						year = '$total_insure_year',
						t_no = '$total_insure_t_no',
						easynomu = '$total_insure_input1',
						data = '$total_insure_input2',
						duzon = '$total_insure_input3',
						fax = '$total_insure_input4',
						mail = '$total_insure_input5',
						report = '$total_insure_input6',
						input_date = '$total_insure_input_date',
						ok_report = '$total_insure_process',
						ok_date = '$total_insure_process_date'
";
$sql_total_insure = " select * from com_total_insure where com_code='$id' and year='$total_insure_year' ";
$result_total_insure = sql_query($sql_total_insure);
$total_insure_total_insure = mysql_num_rows($result_total_insure);
if($total_insure_total_insure) {
	$sql_total_insure = " update com_total_insure set 
				$sql_common_total_insure
				where com_code = '$id' and year='$total_insure_year' ";
} else {
	$sql_total_insure = " insert com_total_insure set 
				$sql_common_total_insure 
				, com_code = '$id' ";
}
sql_query($sql_total_insure);

alert("정상적으로 보수총액신고 정보가 수정 되었습니다.","total_pay_view.php?id=$id&w=$w&page=$page");
?>