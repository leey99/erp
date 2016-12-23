<?
$sub_menu = "1900400";
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
$upload_dir = 'files/convey_file/';
$convey_file_sql_1 = "";
$convey_file_sql_2 = "";
$convey_file_sql_3 = "";
$convey_file_sql_4 = "";
$convey_file_sql_5 = "";
$convey_file_sql_6 = "";

//첨부서류 삭제 기능
if($convey_file_del_1 == 1) {
	$filename = $upload_dir.$c_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($convey_file_del_2 == 1) {
	$filename = $upload_dir.$c_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($convey_file_del_3 == 1) {
	$filename = $upload_dir.$c_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($convey_file_del_4 == 1) {
	$filename = $upload_dir.$c_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($convey_file_del_5 == 1) {
	$filename = $upload_dir.$c_file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($convey_file_del_6 == 1) {
	$filename = $upload_dir.$c_file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}

//첨부서류1
if($_FILES['convey_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['convey_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$convey_file_sql_1 = " convey_file_1 = '$upload_file_name', ";
} else {
	if($convey_file_del_1 == 1) $convey_file_sql_1 = " convey_file_1 = '', ";
}
//첨부서류2
if($_FILES['convey_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['convey_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$convey_file_sql_2 = " convey_file_2 = '$upload_file_name', ";
} else {
	if($convey_file_del_2 == 1) $convey_file_sql_2 = " convey_file_2 = '', ";
}
//첨부서류3
if($_FILES['convey_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['convey_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$convey_file_sql_3 = " convey_file_3 = '$upload_file_name', ";
} else {
	if($convey_file_del_3 == 1) $convey_file_sql_3 = " convey_file_3 = '', ";
}
//첨부서류4
if($_FILES['convey_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['convey_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$convey_file_sql_4 = " convey_file_4 = '$upload_file_name', ";
} else {
	if($convey_file_del_4 == 1) $convey_file_sql_4 = " convey_file_4 = '', ";
}
//첨부서류5
if($_FILES['convey_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['convey_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$convey_file_sql_5 = " convey_file_5 = '$upload_file_name', ";
} else {
	if($convey_file_del_5 == 1) $convey_file_sql_5 = " convey_file_5 = '', ";
}
//첨부서류6
if($_FILES['convey_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['convey_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$convey_file_sql_6 = " convey_file_6 = '$upload_file_name', ";
} else {
	if($convey_file_del_6 == 1) $convey_file_sql_6 = " convey_file_6 = '', ";
}

//추가 필드 데이터 유무2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);

//본사 DB 필드
if($member['mb_level'] != 6) {
	$sql_common_opt2_master = "
							$convey_file_sql_1
							$convey_file_sql_2
							$convey_file_sql_3
							$convey_file_sql_4
							$convey_file_sql_5
							$convey_file_sql_6

							support_kind = '$support_kind',
							support_kind2 = '$support_kind2',
							support_kind3 = '$support_kind3',
							support_kind4 = '$support_kind4',
							support_kind5 = '$support_kind5',

							support_document = '$support_document',
							support_document2 = '$support_document2',
							support_document3 = '$support_document3',
							support_document4 = '$support_document4',
							support_document5 = '$support_document5',

							support_person_process = '$support_person_process',
							support_person_kind1 = '$support_person_kind1',
							support_person_kind2 = '$support_person_kind2',
							support_person_kind3 = '$support_person_kind3',
	";
//광주지사 권한 151209
/*
} else if($member['mb_profile'] == 8) {
	$sql_common_opt2_master = "
						support_person_process = '$support_person_process',
	";
*/
}
//사업장 정보 추가2 DB
$sql_common_opt2 = "
						$sql_common_opt2_master

						support_person_process = '$support_person_process',

						support_person_manager = '$manager_code',
						support_person_manager_name = '$manager_name',
						support_person_user = '$mb_name',
						support_person_editdt = '$now_time'
";
$sql_opt2 = " update com_list_gy_opt2 set 
				$sql_common_opt2 
				where com_code = '$id' ";
sql_query($sql_opt2);

//본사 권한
if($member['mb_level'] != 6) {
	//담당자 설정
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	$branch2 = $man_cust_name_arry[$damdang_code2];

	//담당매니저 코드 체크
	$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];

	//신청서류안내
	if($row2['support_document'] != $support_document) {
		if($support_document) $support_document_text = "[".$support_document."]";
		else $support_document_text = "";
		$wr_subject = "신청서류안내 ".$support_document_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내2
	if($row2['support_document2'] != $support_document2) {
		if($support_document2) $support_document2_text = "[".$support_document2."]";
		else $support_document2_text = "";
		$wr_subject = "신청서류안내 ".$support_document2_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document2', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내3
	if($row2['support_document3'] != $support_document3) {
		if($support_document3) $support_document3_text = "[".$support_document3."]";
		else $support_document3_text = "";
		$wr_subject = "신청서류안내 ".$support_document3_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document3', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내4
	if($row2['support_document4'] != $support_document4) {
		if($support_document4) $support_document4_text = "[".$support_document4."]";
		else $support_document4_text = "";
		$wr_subject = "신청서류안내 ".$support_document4_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document4', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	//신청서류안내5
	if($row2['support_document5'] != $support_document5) {
		if($support_document5) $support_document5_text = "[".$support_document5."]";
		else $support_document5_text = "";
		$wr_subject = "신청서류안내 ".$support_document5_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document5', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	$qstr = $_POST['qstr'];
}
alert("정상적으로 지원대상확인 정보가 수정 되었습니다.","support_person_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr);
?>