<?
$sub_menu = "1900301";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");

//사업장 기본정보 호출
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$mb_name = $member['mb_name'];
$sql_common = " electric_charges_editdt = '$now_time',
						electric_charges_etc = '$etc',
						electric_charges_user = '$mb_name'
";
$sql = " update com_list_gy set $sql_common where com_code = '$id' ";
sql_query($sql);
//이력 DB 저장
$electric_charges_process = $row_com['electric_charges_process'];
$electric_charges_no = $row_com['electric_charges_no'];
$electric_charges_watt = $row_com['electric_charges_watt'];
$electric_charges_year_fee = $row_com['electric_charges_year_fee'];
$electric_charges_payments = $row_com['electric_charges_payments'];
$electric_charges_reduce = $row_com['electric_charges_reduce'];
$electric_charges_etc = $row_com['electric_charges_etc'];
$sql_samu_history = " insert electric_charges_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', electric_charges_process = '$electric_charges_process', 
		electric_charges_no = '$electric_charges_no', electric_charges_watt = '$electric_charges_watt', electric_charges_year_fee = '$electric_charges_year_fee', 
		electric_charges_payments = '$electric_charges_payments', electric_charges_reduce = '$electric_charges_reduce', 
		electric_charges_etc = '$electric_charges_etc'
";
sql_query($sql_samu_history);
//알림 지사
if($row_com['electric_charges_etc'] != $etc) {
	//사업장 정보 변수
	$damdang_code = $row_com['damdang_code'];
	$damdang_code2 = $row_com['damdang_code2'];
	$firm_name = $row_com['com_name'];
	$cust_name = $row_com['boss_name'];
	$comp_bznb = $row_com['biz_no'];
	//담당자 설정
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	$branch2 = $man_cust_name_arry[$damdang_code2];
	//담당매니저 코드 체크
	$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	$wr_subject = "[전기요금컨설팅] ".$etc;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '전기요금컨설팅'
	";
	sql_query($sql_alert);
}
alert("정상적으로 처리결과가 수정 되었습니다.","electric_charges_etc.php?id=$id&w=$w&idx=$idx");
?>