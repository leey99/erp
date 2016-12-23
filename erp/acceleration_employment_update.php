<?
$sub_menu = "1900600";
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

//첨부파일 경로
$upload_dir = 'files/employment_file/';

//명부(지사)
$branch_file_sql_1 = "";
$branch_file_sql_2 = "";
$branch_file_sql_3 = "";
$branch_file_sql_4 = "";
//첨부서류 삭제 기능
if($branch_file_del_1 == 1) {
	$filename = $upload_dir.$b_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($branch_file_del_2 == 1) {
	$filename = $upload_dir.$b_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($branch_file_del_3 == 1) {
	$filename = $upload_dir.$b_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($branch_file_del_4 == 1) {
	$filename = $upload_dir.$b_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['branch_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['branch_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$branch_file_sql_1 = " branch_file_1 = '$upload_file_name', ";
} else {
	if($branch_file_del_1 == 1) $branch_file_sql_1 = " branch_file_1 = '', ";
}
//첨부서류2
if($_FILES['branch_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['branch_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$branch_file_sql_2 = " branch_file_2 = '$upload_file_name', ";
} else {
	if($branch_file_del_2 == 1) $branch_file_sql_2 = " branch_file_2 = '', ";
}
//첨부서류3
if($_FILES['branch_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['branch_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$branch_file_sql_3 = " branch_file_3 = '$upload_file_name', ";
} else {
	if($branch_file_del_3 == 1) $branch_file_sql_3 = " branch_file_3 = '', ";
}
//첨부서류4
if($_FILES['branch_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['branch_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$branch_file_sql_4 = " branch_file_4 = '$upload_file_name', ";
} else {
	if($branch_file_del_4 == 1) $branch_file_sql_4 = " branch_file_4 = '', ";
}
//명부(본사)
$main_file_sql_1 = "";
$main_file_sql_2 = "";
$main_file_sql_3 = "";
$main_file_sql_4 = "";
//첨부서류 삭제 기능
if($main_file_del_1 == 1) {
	$filename = $upload_dir.$m_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($main_file_del_2 == 1) {
	$filename = $upload_dir.$m_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($main_file_del_3 == 1) {
	$filename = $upload_dir.$m_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($main_file_del_4 == 1) {
	$filename = $upload_dir.$m_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['main_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['main_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$main_file_sql_1 = " main_file_1 = '$upload_file_name', ";
} else {
	if($main_file_del_1 == 1) $main_file_sql_1 = " main_file_1 = '', ";
}
//첨부서류2
if($_FILES['main_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['main_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$main_file_sql_2 = " main_file_2 = '$upload_file_name', ";
} else {
	if($main_file_del_2 == 1) $main_file_sql_2 = " main_file_2 = '', ";
}
//첨부서류3
if($_FILES['main_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['main_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$main_file_sql_3 = " main_file_3 = '$upload_file_name', ";
} else {
	if($main_file_del_3 == 1) $main_file_sql_3 = " main_file_3 = '', ";
}
//첨부서류4
if($_FILES['main_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['main_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$main_file_sql_4 = " main_file_4 = '$upload_file_name', ";
} else {
	if($main_file_del_4 == 1) $main_file_sql_4 = " main_file_4 = '', ";
}
//명부(경산)
$employment_file_sql_1 = "";
$employment_file_sql_2 = "";
$employment_file_sql_3 = "";
$employment_file_sql_4 = "";
//첨부서류 삭제 기능
if($employment_file_del_1 == 1) {
	$filename = $upload_dir.$e_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($employment_file_del_2 == 1) {
	$filename = $upload_dir.$e_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($employment_file_del_3 == 1) {
	$filename = $upload_dir.$e_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($employment_file_del_4 == 1) {
	$filename = $upload_dir.$e_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['employment_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['employment_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$employment_file_sql_1 = " employment_file_1 = '$upload_file_name', ";
} else {
	if($employment_file_del_1 == 1) $employment_file_sql_1 = " employment_file_1 = '', ";
}
//첨부서류2
if($_FILES['employment_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['employment_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$employment_file_sql_2 = " employment_file_2 = '$upload_file_name', ";
} else {
	if($employment_file_del_2 == 1) $employment_file_sql_2 = " employment_file_2 = '', ";
}
//첨부서류3
if($_FILES['employment_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['employment_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$employment_file_sql_3 = " employment_file_3 = '$upload_file_name', ";
} else {
	if($employment_file_del_3 == 1) $employment_file_sql_3 = " employment_file_3 = '', ";
}
//첨부서류4
if($_FILES['employment_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['employment_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$employment_file_sql_4 = " employment_file_4 = '$upload_file_name', ";
} else {
	if($employment_file_del_4 == 1) $employment_file_sql_4 = " employment_file_4 = '', ";
}
// 데이터2 유무
$sql2 = " select * from com_employment where com_code='$id' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
//자동 처리현황 입력 기능 151117
if(!$row2['employment_process'] && !$employment_process) {
	$employment_process = 1;
}
//자동 처리현황 검토 변경 151118 (검토 파일 업로드 필수, 처리현황 미선택, 의뢰일 경우)
if( ($employment_process == "" || $employment_process == 1) && $main_file_sql_1 ) {
	$employment_process = 6;
	//감원방지기간조회 거래처 삭제 처리 151118
	$sql_common_del = " update com_reduction set delete_yn='1' where com_code = '$id' ";
	sql_query($sql_common_del);
}
//자동 처리현황 확인 변경 151119 (진행 파일 업로드 필수, 처리현황 검토일 경우)
if( ($employment_process == 6) && $employment_file_sql_1 ) {
	$employment_process = 9;
}
//처리현황 검토 변경 시 자동 등록일자 변경 151210
if($row2['employment_process'] != 6 && $employment_process == 6) $employment_regt_sql = " employment_regt='$now_time', ";
else $employment_regt_sql = "";
//메모 유무 / 본사 내용 수정/삭제 가능 전정애 대리 요청 161215
/*
if($employment_memo) $employment_memo_sql = " employment_memo = '$employment_memo', ";
else $employment_memo_sql = "";
*/
$employment_memo_sql = " employment_memo = '$employment_memo', ";
//관리자, 본사, 경산지사 
if( ($is_admin == "super" || $member['mb_profile'] == 1) || $member['mb_profile'] == '16' ) {
	//관리 권한 필드 정의
	$sql_common_employment_master = "

							$main_file_sql_1
							$main_file_sql_2
							$main_file_sql_3
							$main_file_sql_4

							$employment_file_sql_1
							$employment_file_sql_2
							$employment_file_sql_3
							$employment_file_sql_4

							$employment_regt_sql

							$employment_memo_sql
							employment_process = '$employment_process',
	";
} else {
	$sql_common_employment_master = "
							$employment_memo_sql
							employment_process = '$employment_process',
	";
}
//사업장 정보 추가2 DB
$sql_common_employment = "
							$sql_common_employment_master

							$branch_file_sql_1
							$branch_file_sql_2
							$branch_file_sql_3
							$branch_file_sql_4

							employment_visit_kind = '$employment_visit_kind',
							employment_visitdt = '$employment_visitdt',
							employment_visitdt_time = '$employment_visitdt_time',
							employment_visitdt_ok = '$employment_visitdt_ok',

							employment_user = '$mb_name',
							employment_editdt = '$now_time'
";
//데이터2 존재 시 update, 미존재 시 insert
if($row2['com_code']) {
	$sql_employment = " update com_employment set 
				$sql_common_employment 
				where com_code = '$id' ";
} else {
	$sql_employment = " insert com_employment set 
				$sql_common_employment 
				, com_code='$id' ";
	//1110 : Column 'employment_regt' specified twice 오류 수정 151210
	if(!$employment_regt_sql) $sql_employment .= " , employment_regt='$now_time' ";
}
//echo $sql_employment;
//exit;
sql_query($sql_employment);

//추가 필드 데이터 유무2
$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);

//본사 DB 필드
if($member['mb_level'] != 6) {
	$sql_common_opt2_master = "
							support_kind = '$support_kind',
							support_kind2 = '$support_kind2',
							support_kind3 = '$support_kind3',
							support_kind4 = '$support_kind4',
							support_kind5 = '$support_kind5',

							support_document = '$support_document',
							support_document2 = '$support_document2',
							support_document3 = '$support_document3',
							support_document4 = '$support_document4',
							support_document5 = '$support_document5'
	";
	$sql_opt2 = " update com_list_gy_opt2 set 
					$sql_common_opt2_master 
					where com_code = '$id' ";
	sql_query($sql_opt2);
}
//해당없음 처리현황 선택 시 자동 감원방지기간조회 처리현황 해당없음 처리 151126
if($employment_process == 5) {
	$sql2 = " select * from com_reduction where com_code='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	if($row2['com_code']) {
		$sql_common = " reduction_process = '$employment_process', reduction_user = '$mb_nick', reduction_editdt = '$now_time' ";
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
		employment_process = '$employment_process'
";
sql_query($sql_history);

//사업장 정보 + opt DB
$sql_com = "select * from com_list_gy a, com_list_gy b where a.com_code='$id' and a.com_code=b.com_code ";
$row_com = sql_fetch($sql_com);

//담당자 설정
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$damdang_code = $row_com['damdang_code'];
$branch = $man_cust_name_arry[$damdang_code];
$damdang_code2 = $row_com['damdang_code2'];
$branch2 = $man_cust_name_arry[$damdang_code2];

//등록자
$mb_name = $member['mb_name'];
$mb_id = $member['mb_id'];

//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];


//진행 파일 업로드 시(대구남부) 알림 151119 : 기본 파일과 다를 경우, 파일 삭제가 아닐 경우
if($row2['employment_file_1'] != $employment_file_sql_1 && $employment_file_sql_1 && !$employment_file_del_1) {
	//시간선택제 신규 등록 알림
	$wr_subject = "신규고용확인 대상자 확인 되었습니다.";
	//대상자
	$send_to = "manager";
	//$branch = $damdang_code;
	//강제 본사 설정
	$branch_code = 1;
	$sql_alert = " insert erp_alert set 
			branch = '$branch_code', branch_name = '$branch', branch2 = '$branch_code', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to',
			com_code = '$id' , wr_1 = '$row2[idx]', com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40004', alert_name = '신규고용확인'
	";
	sql_query($sql_alert);
}

//본사 권한
if($member['mb_level'] != 6) {
	//신청서류안내
	if($row_opt2['support_document'] != $support_document) {
		if($support_document) $support_document_text = "[".$support_document."]";
		else $support_document_text = "";
		$wr_subject = "신청서류안내 ".$support_document_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내2
	if($row_opt2['support_document2'] != $support_document2) {
		if($support_document2) $support_document2_text = "[".$support_document2."]";
		else $support_document2_text = "";
		$wr_subject = "신청서류안내 ".$support_document2_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document2', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내3
	if($row_opt2['support_document3'] != $support_document3) {
		if($support_document3) $support_document3_text = "[".$support_document3."]";
		else $support_document3_text = "";
		$wr_subject = "신청서류안내 ".$support_document3_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document3', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내4
	if($row_opt2['support_document4'] != $support_document4) {
		if($support_document4) $support_document4_text = "[".$support_document4."]";
		else $support_document4_text = "";
		$wr_subject = "신청서류안내 ".$support_document4_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document4', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내5
	if($row_opt2['support_document5'] != $support_document5) {
		if($support_document5) $support_document5_text = "[".$support_document5."]";
		else $support_document5_text = "";
		$wr_subject = "신청서류안내 ".$support_document5_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document5', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
}

//완료 후 페이지 이동
alert("정상적으로 신규고용확인 정보가 수정 되었습니다.","acceleration_employment_view.php?w=".$w."&id=".$id."&page=".$page."&".$qstr);
?>