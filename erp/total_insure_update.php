<?
$sub_menu = "400400";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//����� �⺻����
$sql_common = " 
						samu_keep = '$samu_keep',
						samu_keep_date = '$samu_keep_date'
";

//����� �߰����� (������ ����)
$sql_common2 = " 
						tm_cust_numb = '$tm_cust_numb',
						tm_cust_name = '$tm_cust_name'
";
//����� �߰����� 2
$sql_common_opt2 = " samu_call_date = '$samu_call_date',
						samu_feedback_memo = '$samu_feedback_memo'
";
//�⺻ �ʵ� ������ �߰�/����
$sql = " update com_list_gy set 
			$sql_common 
			where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
//�߰� �ʵ� ������ ����
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
//�����Ű� ������ ����
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

alert("���������� �����Ű� ������ ���� �Ǿ����ϴ�.","total_insure_view.php?id=$id&w=$w&page=$page");
?>