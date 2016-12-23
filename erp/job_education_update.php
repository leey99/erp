<?
$sub_menu = "1700100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");
$com_code = $_POST['com_code'];
//전화번호
if($com_tel1) $com_tel = $com_tel1."-".$com_tel2."-".$com_tel3;
//휴대폰
if($cust_fax1) $com_fax = $cust_fax1."-".$cust_fax2."-".$cust_fax3;
//우편번호
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;

//첨부파일 경로
$upload_dir = 'files/job_file/';
$job_file_sql_1 = "";
$job_file_sql_2 = "";
$job_file_sql_3 = "";
$job_file_sql_4 = "";
$job_file_sql_5 = "";
$job_file_sql_6 = "";
$job_file_sql_7 = "";
$job_file_sql_8 = "";

//첨부서류 삭제 기능
if($job_file_del_1 == 1) {
	$filename = $upload_dir.$p_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($job_file_del_2 == 1) {
	$filename = $upload_dir.$p_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($job_file_del_3 == 1) {
	$filename = $upload_dir.$p_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($job_file_del_4 == 1) {
	$filename = $upload_dir.$p_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($job_file_del_5 == 1) {
	$filename = $upload_dir.$p_file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($job_file_del_6 == 1) {
	$filename = $upload_dir.$p_file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}
if($job_file_del_7 == 1) {
	$filename = $upload_dir.$p_file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(7)이 존재하지 않습니다.";
	}
}
if($job_file_del_8 == 1) {
	$filename = $upload_dir.$p_file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(8)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['job_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['job_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$job_file_sql_1 = " job_file_1 = '$upload_file_name', ";
} else {
	if($job_file_del_1 == 1) $job_file_sql_1 = " job_file_1 = '', ";
}
//첨부서류2
if($_FILES['job_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['job_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$job_file_sql_2 = " job_file_2 = '$upload_file_name', ";
} else {
	if($job_file_del_2 == 1) $job_file_sql_2 = " job_file_2 = '', ";
}
//첨부서류3
if($_FILES['job_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['job_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$job_file_sql_3 = " job_file_3 = '$upload_file_name', ";
} else {
	if($job_file_del_3 == 1) $job_file_sql_3 = " job_file_3 = '', ";
}
//첨부서류4
if($_FILES['job_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['job_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$job_file_sql_4 = " job_file_4 = '$upload_file_name', ";
} else {
	if($job_file_del_4 == 1) $job_file_sql_4 = " job_file_4 = '', ";
}
//첨부서류5
if($_FILES['job_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['job_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$job_file_sql_5 = " job_file_5 = '$upload_file_name', ";
} else {
	if($job_file_del_5 == 1) $job_file_sql_5 = " job_file_5 = '', ";
}
//첨부서류6
if($_FILES['job_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['job_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$job_file_sql_6 = " job_file_6 = '$upload_file_name', ";
} else {
	if($job_file_del_6 == 1) $job_file_sql_6 = " job_file_6 = '', ";
}
//첨부서류7
if($_FILES['job_file_7']['tmp_name']) {
	$pic_name7 = $_FILES['job_file_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_7']['tmp_name'], $upload_file);
}
if($pic_name7) {
	$job_file_sql_7 = " job_file_7 = '$upload_file_name', ";
} else {
	if($job_file_del_7 == 1) $job_file_sql_7 = " job_file_7 = '', ";
}
//첨부서류8
if($_FILES['job_file_8']['tmp_name']) {
	$pic_name8 = $_FILES['job_file_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_8']['tmp_name'], $upload_file);
}
if($pic_name8) {
	$job_file_sql_8 = " job_file_8 = '$upload_file_name', ";
} else {
	if($job_file_del_8 == 1) $job_file_sql_8 = " job_file_8 = '', ";
}
//첨부서류목록
$job_file_check_cnt = count($job_file_check_array);
for($i=1;$i<=$job_file_check_cnt;$i++) {
	$job_file_check_var .= $_POST['job_file_check'.$i].",";
}
$mb_profile_code = $member['mb_profile'];
if($mb_profile_code == 1) {
	$sql_master = " job_proxy = '$job_proxy', job_proxy_date = '$job_proxy_date', ";
	$sql_master .= " job_recall_memo = '$job_recall_memo', job_recall_date = '$job_recall_date', ";
} else {
	$sql_master = "";
}
$sql_common = " com_name = '$com_name',
						upche_div = '$comp_type',
						biz_no = '$comp_bznb',
						t_insureno = '$t_insureno',
						uptae = '$uptae',

						boss_name = '$boss_name',
						jumin_no = '$jumin_no',

						com_tel = '$com_tel',
						com_fax = '$com_fax',

						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',

						$job_file_sql_1
						$job_file_sql_2
						$job_file_sql_3
						$job_file_sql_4
						$job_file_sql_5
						$job_file_sql_6
						$job_file_sql_7
						$job_file_sql_8

						job_memo = '$job_memo',
						job_manager_name = '$job_manager_name',
						job_manager_hp = '$job_manager_hp',
						job_manager_mail = '$job_manager_mail',
						job_work_time = '$job_work_time',
						job_shift_system = '$job_shift_system',
						job_main_produce = '$job_main_produce',
						job_produce_method = '$job_produce_method',
						$sql_master
						job_kras_id = '$job_kras_id',
						job_kras_pw = '$job_kras_pw',
						job_hrd_id = '$job_hrd_id',
						job_hrd_pw = '$job_hrd_pw',
						job_education_industrial_safety = '$job_education_industrial_safety',
						job_education_health = '$job_education_health',
						job_file_check = '$job_file_check_var'
";

//수정
if ($w == 'u') {
	//거래처 정보 추출
	$sql1 = " select * from com_list_gy where com_code = '$com_code' ";
	$result1 = sql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	//거래처 정보 입력
	$sql2 = " update com_list_gy set 
				$sql_common
				where com_code = '$com_code' ";
	sql_query($sql2);
	//사업주훈련 기본정보
	$k = "";
	$job_idx = $_POST['idx'.$k];
	$permission_date = $_POST['permission_date'.$k];
	$scale = $_POST['scale'.$k];
	$staff = $_POST['staff'.$k];
	$facility = $_POST['facility_'.$k];
	$facility2 = $_POST['facility2_'.$k];
	$facility3 = $_POST['facility3_'.$k];
	//관리책임자
	$chief_name = $_POST['chief_name'.$k];
	$chief_ssnb = $_POST['chief_ssnb'.$k];
	$chief_position = $_POST['chief_position'.$k];
	$chief_job = $_POST['chief_job'.$k];
	$chief_career = $_POST['chief_career'.$k];
	//인증유효기간(집체)
	$approval_effective = $_POST['approval_effective'.$k];
	$approval_expiration = $_POST['approval_expiration'.$k];
	//인증유효기간(현장)
	$site_approval_effective = $_POST['site_approval_effective'.$k];
	$site_approval_expiration = $_POST['site_approval_expiration'.$k];
	//지원금한도(연도)
	$job_fee_year = $_POST['job_fee_year'.$k];
	$job_fee2_year = $_POST['job_fee2_year'.$k];
	//지원금한도(금액)
	$job_fee_limit = $_POST['job_fee_limit'.$k];
	$job_fee2_limit = $_POST['job_fee2_limit'.$k];
	//교육실시일 교육종료일
	$education_conduct_report = $_POST['education_conduct_report'.$k.'_1'];
	$education_close_date = $_POST['education_close_date'.$k.'_1'];
	//지원금 : 천단위콤마 제거
	$job_fee = str_replace(',','',$_POST['job_fee'.$k.'_1']);
	//메모
	$job_review = $_POST['job_memo'.$k.'_1'];
	//교육구분 (최종)
	for($job_opt_no=1;$job_opt_no<=$_POST['job_opt_count'.$k];$job_opt_no++) {
		$t = $job_opt_no;
		if($t == 1) $t = "";
		//지원금 종류
		if($_POST['train_kind'.$k.'_'.$t]) $train_kind = $_POST['train_kind'.$k.'_'.$t];
	}
	//직무교육DB
	$sql_common_job = " 
						m_date = '$now_time',
						w_user = '$mb_id',
						com_code = '$com_code',
						com_name_job = '$com_name',

						job_cust_numb = '$manage_cust_numb',
						job_cust_name = '$manage_cust_name',
						hrd_korea = '$hrd_korea',

						permission_date = '$permission_date',
						scale = '$scale',
						staff = '$staff',
						facility = '$facility',
						facility2 = '$facility2',
						facility3 = '$facility3',

						chief_name = '$chief_name',
						chief_ssnb = '$chief_ssnb',
						chief_position = '$chief_position',
						chief_job = '$chief_job',
						chief_career = '$chief_career',

						approval_effective = '$approval_effective',
						approval_expiration = '$approval_expiration',
						site_approval_effective = '$site_approval_effective',
						site_approval_expiration = '$site_approval_expiration',

						job_fee_year = '$job_fee_year',
						job_fee2_year = '$job_fee2_year',
						job_fee_limit = '$job_fee_limit',
						job_fee2_limit = '$job_fee2_limit',

						education_conduct_report = '$education_conduct_report',
						education_close_date = '$education_close_date',
						job_fee = '$job_fee',

						train_kind = '$train_kind',

						job_review = '$job_review'
	";
	//직무교육DB 데이터 유무
	$sql_job_chk = " select * from job_education where idx='$job_idx' ";
	$result_job_chk = sql_query($sql_job_chk);
	$total_job_chk = mysql_num_rows($result_job_chk);
	if($total_job_chk) {
		$sql_job = " update job_education set $sql_common_job where idx = '$job_idx' ";
	} else {
		$sql_job = " insert job_education set $sql_common_job ";
	}
	sql_query($sql_job);

	//직무교육 세부내용 DB insert / update
	for($job_no=1;$job_no<=$job_count;$job_no++) {
		$k = $job_no;
		if($k == 1) $k = "";
		$scale = $_POST['scale'.$k];
		$staff = $_POST['staff'.$k];
		//지원금한도(연도/금액)
		$job_fee_year = $_POST['job_fee_year'.$k];
		$job_fee2_year = $_POST['job_fee2_year'.$k];
		$job_fee_limit = $_POST['job_fee_limit'.$k];
		$job_fee2_limit = $_POST['job_fee2_limit'.$k];
		//인증유효기간(집체/현장) 160623
		$approval_effective = $_POST['approval_effective'.$k];
		$approval_expiration = $_POST['approval_expiration'.$k];
		$site_approval_effective = $_POST['site_approval_effective'.$k];
		$site_approval_expiration = $_POST['site_approval_expiration'.$k];
		//직무교육DB
		$sql_common_job_step = " 
							step = '$job_no',
							scale = '$scale',
							staff = '$staff',
							job_fee_year = '$job_fee_year',
							job_fee_limit = '$job_fee_limit',
							job_fee2_year = '$job_fee2_year',
							job_fee2_limit = '$job_fee2_limit',
							approval_effective = '$approval_effective',
							approval_expiration = '$approval_expiration',
							site_approval_effective = '$site_approval_effective',
							site_approval_expiration = '$site_approval_expiration'
		";
		//직무교육DB 데이터 유무
		$sql_job_step_chk = " select * from job_education_step where mid='$job_idx' and step='$job_no' ";
		$result_job_step_chk = sql_query($sql_job_step_chk);
		$total_job_step_chk = mysql_num_rows($result_job_step_chk);
		if($total_job_step_chk) {
			$sql_job_step = " update job_education_step set $sql_common_job_step where mid='$job_idx' and step='$job_no' ";
		} else {
			$sql_job_step = " insert job_education_step set $sql_common_job_step , mid='$job_idx' ";
		}
		sql_query($sql_job_step);

		//직무교육DB insert / update
		for($job_opt_no=1;$job_opt_no<=$_POST['job_opt_count'.$k];$job_opt_no++) {
			$t = $job_opt_no;
			if($t == 1) $t = "";
			$id_opt = $_POST['id_opt'.$k.'_'.$t];
			//지원금 종류
			$train_kind = $_POST['train_kind'.$k.'_'.$t];
			//교재발송
			$job_teaching_material = $_POST['job_teaching_material'.$k.'_'.$t];
			//발송일자 운송장번호
			$education_send = $_POST['education_send'.$k.'_'.$t];
			$education_send_no = $_POST['education_send_no'.$k.'_'.$t];
			//교육실시일 교육종료일
			$education_conduct_report = $_POST['education_conduct_report'.$k.'_'.$t];
			$education_close_date = $_POST['education_close_date'.$k.'_'.$t];
			//수료보고 수료보고일
			$job_complete = $_POST['job_complete'.$k.'_'.$t];
			$job_complete_date = $_POST['job_complete_date'.$k.'_'.$t];
			//지원금, 입금일,  메모
			$job_fee = str_replace(',','',$_POST['job_fee'.$k.'_'.$t]);
			$job_fee_date = $_POST['job_fee_date'.$k.'_'.$t];
			$job_memo = $_POST['job_memo'.$k.'_'.$t];
			//직무교육 세부DB
			$sql_common_job_opt = " 
								step = '$job_no',
								train_kind = '$train_kind',
								job_teaching_material = '$job_teaching_material',
								education_send = '$education_send',
								education_send_no = '$education_send_no',
								education_conduct_report = '$education_conduct_report',
								education_close_date = '$education_close_date',
								job_complete = '$job_complete',
								job_complete_date = '$job_complete_date',
								job_fee = '$job_fee',
								job_fee_date = '$job_fee_date',
								job_memo = '$job_memo'
			";
			//직무교육DB 데이터 유무
			$sql_job_opt_chk = " select * from job_education_opt where mid='$job_idx' and id='$id_opt' and step='$job_no' ";
			//echo $sql_job_opt_chk;
			//exit;
			$result_job_opt_chk = sql_query($sql_job_opt_chk);
			$row_job_opt_chk = mysql_fetch_assoc($result_job_opt_chk);
			//지원금 금액 입력 여부 151210
			$job_fee_chk = $row_job_opt_chk['job_fee'];
			if($row_job_opt_chk['id']) {
				$sql_job_opt = " update job_education_opt set $sql_common_job_opt where mid='$job_idx' and id='$id_opt' and step='$job_no' ";
			} else {
				$sql_job_opt = " insert job_education_opt set $sql_common_job_opt , mid='$job_idx' ";
			}
			sql_query($sql_job_opt);
		}
	}
	//담당자 설정
	$mb_id = $member['mb_id'];
	$mb_name = $member['mb_name'];
	$mb_nick = $member['mb_nick'];
	//직무교육 처리현황 이력 DB 저장
	//echo $job_proxy;
	//exit;
	if( $row1['job_proxy'] != $job_proxy || $row1['job_proxy_date'] != $job_proxy_date ) {
		$sql_job_history = " insert job_history set 
			mid = '$job_idx', com_code = '$com_code', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', job_proxy = '$job_proxy', job_proxy_date = '$job_proxy_date'
		";
		//echo $sql_job_history;
		//exit;
		sql_query($sql_job_history);
	}
	//사업주훈련 재연락일자 이력 DB 저장
	if( $row1['job_recall_date'] != $job_recall_date || $row1['job_recall_date'] != $job_recall_date ) {
		$sql_job_recall = " insert job_recall set 
			mid = '$job_idx', com_code = '$com_code', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', job_recall_memo = '$job_recall_memo', job_recall_date = '$job_recall_date'
		";
		sql_query($sql_job_recall);
	}
	//지원금 직무교육 중복 등록 방지, 김국진 과장 요청 161109
	$sql_app = " select application_date_start from erp_application where com_code='$id' and application_kind='20' order by idx desc limit 0, 1 ";
	$row_app = sql_fetch($sql_app);
	//echo $education_conduct_report." ".$row_app['application_date_start'];
	//exit;
	if($education_conduct_report && $education_conduct_report != $row_app['application_date_start']) {
		//지원금 DB 저장 / 22 -> 20 변경 / 박소향 의견 160510
		//$application_kind = 22;
		$application_kind = 20;
		$sql_common_app = " 
							w_date = '$now_time',
							w_user = '$mb_id',
							com_code = '$com_code',
							com_name_app = '$com_name',

							application_kind = '$application_kind',
							application_send = '$education_send',
							application_send_no = '$education_send_no',
							application_date_start = '$education_conduct_report',
							application_date_end = '$education_close_date',
							application_fee_sum = '$job_fee'
		";
		$sql_app = " insert erp_application set $sql_common_app ";
		sql_query($sql_app);
	}
	alert("정상적으로 직무교육 정보가 수정 되었습니다.","job_education_view.php?id=$id&w=$w&page=$page");
//등록
}else{
	//신규등록
}
?>
