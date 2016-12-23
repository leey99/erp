<?
$sub_menu = "1500100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
//전화번호
if($com_tel1) $com_tel = $com_tel1."-".$com_tel2."-".$com_tel3;
//휴대폰
if($cust_cel1) $com_hp = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//우편번호
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;

//첨부파일 경로
$upload_dir = 'files/policy_fund/';
$pic_name_sql_1 = "";
$pic_name_sql_2 = "";
$pic_name_sql_3 = "";
$pic_name_sql_4 = "";
$pic_name_sql_5 = "";
$pic_name_sql_6 = "";
$pic_name_sql_7 = "";
$pic_name_sql_8 = "";

//첨부서류 삭제 기능
if($file_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($file_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($file_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($file_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($file_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($file_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}
if($file_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(7)이 존재하지 않습니다.";
	}
}
if($file_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(8)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['filename_1']['tmp_name']) {
	$pic_name1 = $_FILES['filename_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$pic_name_sql_1 = " filename_1 = '$upload_file_name', ";
} else {
	if($file_del_1 == 1) $pic_name_sql_1 = " filename_1 = '', ";
}
//첨부서류2
if($_FILES['filename_2']['tmp_name']) {
	$pic_name2 = $_FILES['filename_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$pic_name_sql_2 = " filename_2 = '$upload_file_name', ";
} else {
	if($file_del_2 == 1) $pic_name_sql_2 = " filename_2 = '', ";
}
//첨부서류3
if($_FILES['filename_3']['tmp_name']) {
	$pic_name3 = $_FILES['filename_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$pic_name_sql_3 = " filename_3 = '$upload_file_name', ";
} else {
	if($file_del_3 == 1) $pic_name_sql_3 = " filename_3 = '', ";
}
//첨부서류4
if($_FILES['filename_4']['tmp_name']) {
	$pic_name4 = $_FILES['filename_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$pic_name_sql_4 = " filename_4 = '$upload_file_name', ";
} else {
	if($file_del_4 == 1) $pic_name_sql_4 = " filename_4 = '', ";
}
//첨부서류5
if($_FILES['filename_5']['tmp_name']) {
	$pic_name5 = $_FILES['filename_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$pic_name_sql_5 = " filename_5 = '$upload_file_name', ";
} else {
	if($file_del_5 == 1) $pic_name_sql_5 = " filename_5 = '', ";
}
//첨부서류6
if($_FILES['filename_6']['tmp_name']) {
	$pic_name6 = $_FILES['filename_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$pic_name_sql_6 = " filename_6 = '$upload_file_name', ";
} else {
	if($file_del_6 == 1) $pic_name_sql_6 = " filename_6 = '', ";
}
//첨부서류7
if($_FILES['filename_7']['tmp_name']) {
	$pic_name7 = $_FILES['filename_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_7']['tmp_name'], $upload_file);
}
if($pic_name7) {
	$pic_name_sql_7 = " filename_7 = '$upload_file_name', ";
} else {
	if($file_del_7 == 1) $pic_name_sql_7 = " filename_7 = '', ";
}
//첨부서류8
if($_FILES['filename_8']['tmp_name']) {
	$pic_name8 = $_FILES['filename_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_8']['tmp_name'], $upload_file);
}
if($pic_name8) {
	$pic_name_sql_8 = " filename_8 = '$upload_file_name', ";
} else {
	if($file_del_8 == 1) $pic_name_sql_8 = " filename_8 = '', ";
}

$sql_common = " regdt = '$regdt',
						com_name = '$com_name',
						upche_div = '$comp_type',
						upjong = '$upjong',
						damdang_code = '$damdang_code',

						jumin_no = '$jumin_no',
						reg_factory = '$reg_factory',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						boss_name = '$boss_name',
						com_tel = '$com_tel',
						com_fax = '$com_fax',
						com_hp = '$com_hp',
						com_mail = '$com_mail',
						area = '$area',

						credit_com = '$credit_com',
						credit_per = '$credit_per',
						property = '$property',
						charter = '$charter',
						rent_month = '$rent_month',
						area_site = '$area_site',
						area_building = '$area_building',
						area_facility = '$area_facility',
						teldt = '$teldt',

						ok_loan_facility = '$ok_loan_facility',
						ok_loan_policy = '$ok_loan_policy',
						ok_loan_fee = '$ok_loan_fee',

						memo = '$memo',
						loan_policy = '$loan_policy',
						loan_finance = '$loan_finance',
						loan_etc = '$loan_etc',
						process = '$process',
						process_date = '$process_date',
						writer = '$writer',
						writer_tel = '$writer_tel'
";

//인력 추가정보 (현지 전용)
$sql_common2 = " check_ok = '$check_ok',
						bank_1 = '$bank_1', 
						bank_2 = '$bank_2',
						bank_3 = '$bank_3',
						bank_4 = '$bank_4',
						bank_5 = '$bank_5',
						bank_6 = '$bank_6',
						bank_7 = '$bank_7',
						amount_1 = '$amount_1',
						amount_2 = '$amount_2',
						amount_3 = '$amount_3',
						amount_4 = '$amount_4',
						amount_5 = '$amount_5',
						amount_6 = '$amount_6',
						amount_7 = '$amount_7',
						interst_1 = '$interst_1',
						interst_2 = '$interst_2',
						interst_3 = '$interst_3',
						interst_4 = '$interst_4',
						interst_5 = '$interst_5',
						interst_6 = '$interst_6',
						interst_7 = '$interst_7',
						lend_bank_1 = '$lend_bank_1',
						lend_bank_2 = '$lend_bank_2',
						lend_bank_3 = '$lend_bank_3',
						lend_bank_4 = '$lend_bank_4',
						lend_kind_1 = '$lend_kind_1',
						lend_kind_2 = '$lend_kind_2',
						lend_kind_3 = '$lend_kind_3',
						lend_kind_4 = '$lend_kind_4',
						lend_amount_1 = '$lend_amount_1',
						lend_amount_2 = '$lend_amount_2',
						lend_amount_3 = '$lend_amount_3',
						lend_amount_4 = '$lend_amount_4',
						lend_interst_1 = '$lend_interst_1',
						lend_interst_2 = '$lend_interst_2',
						lend_interst_3 = '$lend_interst_3',
						lend_interst_4 = '$lend_interst_4',

						$pic_name_sql_1
						$pic_name_sql_2
						$pic_name_sql_3
						$pic_name_sql_4
						$pic_name_sql_5
						$pic_name_sql_6
						$pic_name_sql_7
						$pic_name_sql_8

						security = '$security',
						primary_bank = '$primary_bank',
						etc = '$etc',
						editdt = '$now_time'
";

//추가 필드 데이터 유무
$sql1 = " select * from policy_fund_opt where id='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//수정
if ($w == 'u'){
	$sql = " update policy_fund set 
				$sql_common 
			  where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	if($total1) {
		$sql2 = " update policy_fund_opt set 
					$sql_common2 
					where id = '$id' ";
	} else {
		$id = mysql_insert_id();
		$sql2 = " insert policy_fund_opt set 
					$sql_common2 
					, id = '$id'
					, com_code = '$com_code' ";
	}
	//echo $sql2;
	sql_query($sql2);
	alert("정상적으로 정책자금 의뢰정보가 수정 되었습니다.","policy_fund_view.php?id=$id&w=$w&page=$page");
//등록
}else{
	$sql = " insert policy_fund set 
					$sql_common 
					, com_code = '$com_code' ";
	sql_query($sql);
	if($total1) {
		$sql2 = " update policy_fund_opt set 
					$sql_common2 
					where id = '$id' ";
	} else {
		$id = mysql_insert_id();
		$sql2 = " insert policy_fund_opt set 
					$sql_common2 
					, id = '$id'
					, com_code = '$com_code' ";
	}
	sql_query($sql2);
  //$id = mysql_insert_id();
	alert("정상적으로 정책자금 의뢰정보가 등록 되었습니다.","policy_fund_list.php?page=$page");
}
?>
