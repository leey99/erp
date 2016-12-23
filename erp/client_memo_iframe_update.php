<?
$sub_menu = "100401";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$sql_common = " regdt = '$now_time',
						com_code = '$id',
						memo = '$memo',
						visit = '$visit',
						call_day = '$call',
						damdang_code_memo = '$mb_profile_code',
						user_id = '$mb_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name'
";
//수정
if ($w == 'u'){
	$sql = " update com_list_gy_memo set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 수정 되었습니다.","client_memo_iframe.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert com_list_gy_memo set 
					$sql_common 
					";
	sql_query($sql);
	//거래처 통합 전달사항
	$memo_type = 12;
	$secret = "";
	$sql_common = " regdt = '$now_time',
							com_code = '$id',
							memo_type = '$memo_type',
							memo = '$memo',
							user_id = '$mb_id',
							user_nick = '$mb_nick',
							user_name = '$mb_name',
							secret = '$secret'
	";
	$sql = " insert com_list_gy_comment set 
					$sql_common 
					";
	sql_query($sql);
	//관리자 제외
	if($mb_id != "master") {
		//거래처 정보
		$sql_com = "select * from com_list_gy where com_code = '$id' ";
		$row_com = sql_fetch($sql_com);
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
		$wr_subject = $memo;
		//신규고용확인 전달사항
		$alert_code = "80001";
		$alert_name = "전달사항";
		//알림 DB 등록
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
				send_to = '$send_to',
				user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo_type = '$memo_type', alert_code = '$alert_code', alert_name = '$alert_name', wr_1 = '$job_id'
		";
		sql_query($sql_alert);
	}
	alert("정상적으로 등록 되었습니다.","client_memo_iframe.php?id=$id");
}
?>