<?
$sub_menu = "1900900";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");

//����� �⺻����
$sql_common = "
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
						work_emp = '$work_emp',
						work_pay = '$work_pay',
						commission = '$commission',
						work_period = '$work_period',
						work_period2 = '$work_period2',
						board_lodging = '$board_lodging',
						staff_memo = '$staff_memo'
";
$sql = " update employment_agency set $sql_common where idx = '$idx' ";
//echo $sql;
//exit;
sql_query($sql);
alert("���������� �η°��� ������ ���� �Ǿ����ϴ�.","employment_agency_view.php?id=".$id."&amp;idx=".$idx."&amp;w=".$w."&amp;page=".$page."&amp;".$qstr);
?>