<?
$sub_menu = "1901000";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//담당자 설정
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$mb_name = $member['mb_name'];

//사업장 기본정보 호출
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

//첨부파일 경로
$upload_dir = 'files/si4n_nhis/';
//급여대장
$pay_ledger_sql_1 = "";
//첨부서류
$si4n_file_sql_1 = "";
$si4n_file_sql_2 = "";
$si4n_file_sql_3 = "";
$si4n_file_sql_4 = "";
$si4n_file_sql_5 = "";
$si4n_file_sql_6 = "";
$si4n_file_sql_7 = "";
$si4n_file_sql_8 = "";
//급여대장 삭제 기능
if($pay_ledger_del_1 == 1) {
	$filename = $upload_dir.$pay_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "급여대장 파일이 존재하지 않습니다.";
	}
}
//급여대장 업로드
if($_FILES['pay_ledger']['tmp_name']) {
	$pic_name1 = $_FILES['pay_ledger']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['pay_ledger']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$pay_ledger_sql_1 = " pay_ledger = '$upload_file_name', ";
} else {
	if($pay_ledger_del_1 == 1) $pay_ledger_sql_1 = " pay_ledger = '', ";
}

//첨부서류 삭제 기능
if($si4n_file_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(7)이 존재하지 않습니다.";
	}
}
if($si4n_file_hidden_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(8)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['si4n_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['si4n_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$si4n_file_sql_1 = " si4n_file_1 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_1 == 1) $si4n_file_sql_1 = " si4n_file_1 = '', ";
}
//첨부서류2
if($_FILES['si4n_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['si4n_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$si4n_file_sql_2 = " si4n_file_2 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_2 == 1) $si4n_file_sql_2 = " si4n_file_2 = '', ";
}
//첨부서류3
if($_FILES['si4n_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['si4n_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$si4n_file_sql_3 = " si4n_file_3 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_3 == 1) $si4n_file_sql_3 = " si4n_file_3 = '', ";
}
//첨부서류4
if($_FILES['si4n_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['si4n_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$si4n_file_sql_4 = " si4n_file_4 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_4 == 1) $si4n_file_sql_4 = " si4n_file_4 = '', ";
}
//첨부서류5
if($_FILES['si4n_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['si4n_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_5']['tmp_name'], $upload_file);
} else {
	$pic_name5 = "";
}
if($pic_name5) {
	$si4n_file_sql_5 = " si4n_file_5 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_5 == 1) $si4n_file_sql_5 = " si4n_file_5 = '', ";
}
//첨부서류6
if($_FILES['si4n_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['si4n_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_6']['tmp_name'], $upload_file);
} else {
	$pic_name6 = "";
}
if($pic_name6) {
	$si4n_file_sql_6 = " si4n_file_6 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_6 == 1) $si4n_file_sql_6 = " si4n_file_6 = '', ";
}
//첨부서류7
if($_FILES['si4n_file_7']['tmp_name']) {
	$pic_name7 = $_FILES['si4n_file_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_7']['tmp_name'], $upload_file);
} else {
	$pic_name7 = "";
}
if($pic_name7) {
	$si4n_file_sql_7 = " si4n_file_7 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_7 == 1) $si4n_file_sql_7 = " si4n_file_7 = '', ";
}
//첨부서류8
if($_FILES['si4n_file_8']['tmp_name']) {
	$pic_name8 = $_FILES['si4n_file_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_file_8']['tmp_name'], $upload_file);
} else {
	$pic_name8 = "";
}
if($pic_name8) {
	$si4n_file_sql_8 = " si4n_file_8 = '$upload_file_name', ";
} else {
	if($si4n_file_hidden_del_8 == 1) $si4n_file_sql_8 = " si4n_file_8 = '', ";
}
//첨부서류(컨설팅 전)
$si4n_attach_sql_1 = "";
$si4n_attach_sql_2 = "";
$si4n_attach_sql_3 = "";
//첨부서류 삭제 기능
if($si4n_attach_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($si4n_attach_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($si4n_attach_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['si4n_attach_1']['tmp_name']) {
	$pic_name1 = $_FILES['si4n_attach_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_attach_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$si4n_attach_sql_1 = " si4n_attach_1 = '$upload_file_name', ";
} else {
	if($si4n_attach_hidden_del_1 == 1) $si4n_attach_sql_1 = " si4n_attach_1 = '', ";
}
//첨부서류2
if($_FILES['si4n_attach_2']['tmp_name']) {
	$pic_name2 = $_FILES['si4n_attach_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_attach_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$si4n_attach_sql_2 = " si4n_attach_2 = '$upload_file_name', ";
} else {
	if($si4n_attach_hidden_del_2 == 1) $si4n_attach_sql_2 = " si4n_attach_2 = '', ";
}
//첨부서류3
if($_FILES['si4n_attach_3']['tmp_name']) {
	$pic_name3 = $_FILES['si4n_attach_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['si4n_attach_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$si4n_attach_sql_3 = " si4n_attach_3 = '$upload_file_name', ";
} else {
	if($si4n_attach_hidden_del_3 == 1) $si4n_attach_sql_3 = " si4n_attach_3 = '', ";
}

//관리자, 본사 권한
if( ($is_admin == "super" || $member['mb_level'] > 6) ) {
	$sql_common_master = "
						si4n_nhis_process = '$si4n_nhis_process',
						si4n_installment = '$si4n_installment',
	";
	$sql2_common_master = "
						industrial_disaster_rate = '$industrial_disaster_rate'
	";
	//사업장 추가 정보 opt
	$sql2 = " update com_list_gy_opt set $sql2_common_master where com_code = '$id' ";
	sql_query($sql2);
} else {
	$sql_common_master = "";
}
//사업장 추가 정보 op2
$sql_common = "
						$sql_common_master

						si4n_nhis_editdt = '$now_time'
";
$sql = " update com_list_gy_opt2 set $sql_common where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);


//본사/지사 공통 필드
$sql_common_si4n_master = "
						si4n_memo = '$si4n_memo',
";
//본사 권한
if($member['mb_level'] > 6) {
	//관리 권한 필드 정의
	$sql_common_si4n_master .= "
						si4n_pay_month = '$si4n_pay_month',
						si4n_pay_year = '$si4n_pay_year',
						si4n_pay_month2 = '$si4n_pay_month2',
						si4n_pay_year2 = '$si4n_pay_year2',
						si4n_staff_cnt = '$si4n_staff_cnt',
						si4n_cnt = '$si4n_cnt',

						si4n_fee = '$si4n_fee',
						si4n_fee_choice = '$si4n_fee_choice',
						si4n_setting = '$si4n_setting',
						si4n_setting_date = '$si4n_setting_date',
						si4n_change_date = '$si4n_change_date',
						si4n_remainder = '$si4n_remainder',
						si4n_remainder_date = '$si4n_remainder_date',

						si4n_memo1 = '$si4n_memo1',
						si4n_memo1_condition = '$si4n_memo1_condition',
						si4n_memo1_problem = '$si4n_memo1_problem',
						si4n_memo2 = '$si4n_memo2',
						si4n_memo2_condition = '$si4n_memo2_condition',
						si4n_memo2_problem = '$si4n_memo2_problem',

						si4n_memo3 = '$si4n_memo3',

						si4n_etc = '$si4n_etc',
	";
} else {
	$sql_common_si4n_master .= "
	";
}
//사업장 정보 추가2 DB
$sql_common_si4n = "
							com_name_si4n = '$com_name_si4n',

							$sql_common_si4n_master
							$pay_ledger_sql_1
							$si4n_file_sql_1
							$si4n_file_sql_2
							$si4n_file_sql_3
							$si4n_file_sql_4
							$si4n_file_sql_5
							$si4n_file_sql_6
							$si4n_file_sql_7
							$si4n_file_sql_8
							$si4n_attach_sql_1
							$si4n_attach_sql_2
							$si4n_attach_sql_3

							si4n_user = '$mb_name',
							si4n_editdt = '$now_time'
";
// 데이터2 유무
$sql2 = " select * from si4n_nhis where com_code='$id' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);

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
//거래처 담당매니저 코드 160322
$manage_cust_numb = $row_com_opt['manage_cust_numb'];
//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//처리결과 등록 시 알림 지사
if($row2['si4n_etc'] != $si4n_etc) {
	$wr_subject = "[4대보험절감] ".$si4n_etc;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10008', alert_name = '4대보험절감'
	";
	sql_query($sql_alert);
}
//데이터2 존재 시 update, 미존재 시 insert
if($row2['com_code']) {
	$sql_opt2 = " update si4n_nhis set 
				$sql_common_si4n 
				where com_code = '$id' ";
} else {
	$sql_opt2 = " insert si4n_nhis set 
				$sql_common_si4n 
				, com_code = '$id' ";
}
sql_query($sql_opt2);
//이력 저장 161019
$sql_si4n_history = " insert si4n_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', si4n_nhis_process = '$si4n_nhis_process', si4n_installment = '$si4n_installment', 
		si4n_staff_cnt = '$si4n_staff_cnt', si4n_fee = '$si4n_fee', si4n_fee_choice = '$si4n_fee_choice', 
		si4n_setting = '$si4n_setting', si4n_setting_date = '$si4n_setting_date', si4n_change_date = '$si4n_change_date', 
		si4n_remainder = '$si4n_remainder', si4n_remainder_date = '$si4n_remainder_date', 
		si4n_memo1 = '$si4n_memo1', si4n_memo1_condition = '$si4n_memo1_condition',  si4n_memo1_problem = '$si4n_memo1_problem', 
		si4n_memo2 = '$si4n_memo2', si4n_memo2_condition = '$si4n_memo2_condition',  si4n_memo2_problem = '$si4n_memo2_problem',
		si4n_etc = '$si4n_etc'
";
sql_query($sql_si4n_history);

//급여대장(샘플) 등록 시 알림 : 임현미, 박소향 161026
if($_FILES['si4n_attach_1']['tmp_name'] && !$row2['si4n_attach_1']) {
	$wr_subject = "[4대보험절감] 급여대장이 등록 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = 'kcmc1007,kcmc1006,', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10008', alert_name = '4대보험절감'
	";
	sql_query($sql_alert);
}

//처리현황 접수중으로 변경 시 김국진 과장 알림 161026
if($si4n_nhis_process == 10) {
	$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	if($row2['si4n_nhis_process'] != 10) {
		$wr_subject = "[4대보험절감] 접수 되었습니다.";
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
				send_to = 'kcmc1009,', manage_code = '$manage_cust_numb',
				user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
				com_code = '$id', wr_1 = '', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				alert_code = '10008', alert_name = '4대보험절감'
		";
		sql_query($sql_alert);
	}
}

//완료 후 페이지 이동
alert("정상적으로 4대보험절감 정보가 수정 되었습니다.","si4n_nhis_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr);
?>