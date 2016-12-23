<?
$sub_menu = "1800300";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//천단위콤마 제거
$setting_pay = preg_replace('@,@','',$setting_pay);
$month_pay   = preg_replace('@,@','',$month_pay);

//사업장 추가정보
$sql_common2 = " 
						settlement_day = '$settlement_day',
						settlement_day_last = '$settlement_day_last',

						easynomu_id = '$easynomu_id',
						easynomu_pw = '$easynomu_pw',

						service_day_start = '$service_day_start',
						service_day_end = '$service_day_end',

						setting_pay = '$setting_pay',
						month_pay = '$month_pay'
";
$sql_common_opt2 = " easynomu_process = '$easynomu_process',
						easynomu_finish_date = '$easynomu_finish_date',
						easynomu_close_date = '$easynomu_close_date',
						easynomu_memo = '$easynomu_memo'
";
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

//추가 필드 데이터 유무2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$total2 = mysql_num_rows($result2);
if($total2) {
	$sql_opt2 = " update com_list_gy_opt2 set 
				$sql_common_opt2 
				where com_code = '$id' ";
} else {
	$sql_opt2 = " insert com_list_gy_opt2 set 
				$sql_common_opt2 
				, com_code = '$id' ";
}
sql_query($sql_opt2);
//echo $sql;
//echo $sql2;
//echo $sql_opt2;
//exit;
//$id = mysql_insert_id();

//담당자 설정
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
$branch2 = $man_cust_name_arry[$damdang_code2];

//알림 DB 저장용 데이터 select
//$row1 = mysql_fetch_array($result1);
$row2 = mysql_fetch_array($result2);

//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//셋팅완료
if($row2['easynomu_process'] != "3" && $easynomu_process == "3") {
	$wr_subject = $easynomu_finish_date." 건설월정액 셋팅 완료 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '이지노무'
	";
	sql_query($sql_alert);
}
//해지
if($row2['easynomu_process'] != "5" && $easynomu_process == "5") {
	$wr_subject = $easynomu_close_date." 건설월정액 해지 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '이지노무'
	";
	sql_query($sql_alert);
}
//검색 파라미터 전달
$qstr = $_POST['qstr'];
alert("정상적으로 정보가 수정 되었습니다.$branch2","client_construction_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
//goto_url("./4insure_list.php");
?>