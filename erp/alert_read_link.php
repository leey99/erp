<?
$sub_menu = "100100";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
//담당자 설정
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_profile_code = $member['mb_profile'];
//알림 DB
$sql_read_check = "select read_check, read_main, wr_1 from erp_alert where idx = '$idx' ";
$row_read_check = sql_fetch($sql_read_check);
$var_read_check = $row_read_check['read_check'];
$var_read_main = $row_read_check['read_main'];
$wr_1 = $row_read_check['wr_1'];
//관리자 제외
if($member['mb_level'] != 10) {
	//본사
	if($mb_profile_code == 1) {
		$read_main = $mb_id;
		$read_main_time = $now_time;
		//읽음처리 여부 파악 (담당자 변경 방지)
		if(strstr($var_read_main, $mb_id) == true) {
			$read_main_add = "";
		} else {
			if(!$var_read_main) $read_main_add = $read_main;
			else $read_main_add = ",".$read_main;
		}
		$read_main_sql = " read_main = '".$var_read_main."".$read_main_add."', read_main_time = '$read_main_time' ";
		if(!$var_read_check) {
			$sql = " update erp_alert set read_check = '1', $read_main_sql where idx = '$idx' ";
			sql_query($sql);
		} else {
			if(strstr($var_read_main, $mb_id) == false) {
				$sql = " update erp_alert set $read_main_sql where idx = '$idx' ";
				//echo $sql;
				sql_query($sql);
			}
		}
	//지사
	} else {
		$read_branch = $mb_id;
		$read_branch_time = $now_time;
		$read_branch_sql = " read_branch = '$read_branch', read_branch_time = '$read_branch_time' ";
		//지사 읽음 확인
		sql_query(" update erp_alert set read_check = '1', $read_branch_sql where idx = '$idx' ");
	}
}
if($link_url == "process") {
	//echo $alert_code;
	//exit;
	if($alert_code == "80003" && $wr_1) goto_url("./job_education_view.php?alert_list=ok&id=$wr_1&w=u");
	else if( ($alert_code == "40003" && $wr_1) || $memo_type == "10" ) goto_url("./job_time_view.php?alert_list=ok&id=$wr_1&w=u");
	else if($alert_code == "40004") goto_url("./acceleration_employment_view.php?alert_list=ok&id=$id&w=u");
	else if($alert_code == "10006") goto_url("./electric_charges_view.php?alert_list=ok&id=$id&w=u");
	else if($alert_code == "90002" && $wr_1) goto_url("./list_notice.php?bo_table=erp_event&wr_id=$wr_1");
	else if($alert_code == "50001" && $wr_1) {
		//프로그램 종류별 링크
		if($wr_1 == 2) goto_url("./client_kidsnomu_view.php?id=$id&w=u");
		else if($wr_1 == 3) goto_url("./client_construction_view.php?id=$id&w=u");
		else goto_url("./client_program_view.php?id=$id&w=u");
	}
	//그룹웨어(전자결재) : 업무일지, 근태신청, 시말서, 휴가신청
	else if($alert_code == "90003") goto_url("./groupware_business_view.php?id=$wr_1&w=u");
	else if($alert_code == "90010") goto_url("./groupware_business_view.php?id=$wr_1&w=u");
	else if($alert_code == "90012") goto_url("./groupware_attendance_report_view.php?id=$wr_1&w=u");
	else if($alert_code == "90013") goto_url("./groupware_apology_view.php?id=$wr_1&w=u");
	else if($alert_code == "90014") goto_url("./groupware_vacation_report_view.php?id=$wr_1&w=u");
	else goto_url("./client_process_view.php?alert_list=ok&id=$id&w=u&$qstr&page=$page#$alert_code");
} else if($link_url == "view_dealer") {
	goto_url("./client_view_dealer.php?alert_list=ok&id=$id&w=u&$qstr&page=$page");
} else {
	goto_url("./client_view.php?alert_list=ok&id=$id&w=u&$qstr&page=$page");
}
?>
