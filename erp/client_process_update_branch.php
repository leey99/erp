<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");
// ��ǥ���ڵ���
if($cust_cel1) $cust_cel = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//��ȭ��ȣ
if($cust_tel1) $cust_tel = $cust_tel1."-".$cust_tel2."-".$cust_tel3;
//�ѽ���ȣ
if($cust_fax1) $cust_fax = $cust_fax1."-".$cust_fax2."-".$cust_fax3;
//�������ȭ
if($damdang_cel1) $damdang_cel = $damdang_cel1."-".$damdang_cel2."-".$damdang_cel3;
//�����ȣ
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;

//ȸ��� ��ȭ��ȣ
if($treasurer_tel1) $treasurer_tel = $treasurer_tel1."-".$treasurer_tel2."-".$treasurer_tel3;
//ȸ��� �ѽ���ȣ
if($treasurer_fax1) $treasurer_fax = $treasurer_fax1."-".$treasurer_fax2."-".$treasurer_fax3;

//����ڵ��� ���
$upload_dir = 'files/seal/';

if($_FILES['filename']['tmp_name']) {
	$pic_name = $id.".jpg";
	$upload_file = $upload_dir . $pic_name;
	//echo $upload_file;
	//echo $_FILES['filename']['tmp_name'];
	//exit;
	if ( move_uploaded_file($_FILES['filename']['tmp_name'], $upload_file) ) {
		//echo "SUCCESS";
	} else {
		alert("���������� ���� ���ε尡 ���� �ʾҽ��ϴ�.\n������ Ȯ���Ͻ� �� �ٽ� ���ε��Ͽ� �ֽʽÿ�.","staff_view.php?id=$id&code=$code&page=$page");
	}
} else {
	if(!is_file($upload_file)) $pic_name = "";
}
//���� ���ε� ���� �� ������
if($pic_name) {
	$pic_name_sql = " pic = '$pic_name', ";
} else {
	$pic_name_sql = "";
}

//�������� �⺻����
//÷�μ��� üũ
for($i=1;$i<=5;$i++) {
	$job_file_check_var .= $_POST['job_file_check'.$i].",";
}
//÷������ ���
$upload_dir = 'files/job_file/';
$job_file_sql_1 = "";
$job_file_sql_2 = "";
//÷�μ��� ���� ���
if($job_file_del_1 == 1) {
	$filename = $upload_dir.$c_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($job_file_del_2 == 1) {
	$filename = $upload_dir.$c_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($job_file_del_3 == 1) {
	$filename = $upload_dir.$c_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($job_file_del_4 == 1) {
	$filename = $upload_dir.$c_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
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
//÷�μ���2
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
//÷�μ���3
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
//÷�μ���4
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

$sql_common = " com_name = '$firm_name',
						damdang_code = '$damdang_code',
						upche_div = '$comp_type',
						biz_no = '$comp_bznb',
						bupin_no = '$bupin_no',

						uptae = '$uptae',
						uptae_code = '$uptae_code',
						upjong_code = '$upjong_code',
						upjong = '$upjong',
						jongmok = '$jongmok',

						t_insureno = '$t_insureno',

						boss_name = '$cust_name',
						jumin_no = '$cust_ssnb',

						boss_hp = '$cust_cel',
						com_tel = '$cust_tel',
						com_fax = '$cust_fax',

						treasurer_name = '$treasurer_name',
						treasurer_tel = '$treasurer_tel',
						treasurer_fax = '$treasurer_fax',
						treasurer_adr_zip1 = '$treasurer_adr_zip1',
						treasurer_adr_zip2 = '$treasurer_adr_zip2',
						treasurer_adr_adr1 = '$treasurer_adr_adr1',
						treasurer_adr_adr2 = '$treasurer_adr_adr2',

						com_damdang = '$damdang_name',

						editdt = '$editdt',

						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						com_mail = '$cust_email',

						$job_file_sql_1
						$job_file_sql_2

						job_manager_name = '$job_manager_name',
						job_manager_hp = '$job_manager_hp',
						job_manager_mail = '$job_manager_mail',
						job_work_time = '$job_work_time',
						job_shift_system = '$job_shift_system',
						job_main_produce = '$job_main_produce',
						job_produce_method = '$job_produce_method',
						job_hrd_id = '$job_hrd_id',
						job_hrd_pw = '$job_hrd_pw',
						job_education_industrial_safety = '$job_education_industrial_safety',
						job_education_health = '$job_education_health',
						job_file_check = '$job_file_check_var'
";

//õ�����޸� ����
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);
$application_fee_sum = str_replace(',','',$application_fee_sum);
$application_fee_sum2 = str_replace(',','',$application_fee_sum2);
$application_fee_sum3 = str_replace(',','',$application_fee_sum3);
$application_fee_sum4 = str_replace(',','',$application_fee_sum4);
$application_fee_sum5 = str_replace(',','',$application_fee_sum5);

//���â�� ��뱸��
$employment_kind = $employment_kind1.",".$employment_kind2.",".$employment_kind3.",".$employment_kind4;

//��û�⵵
$application_quarter_year = $application_quarter_year_1.",".$application_quarter_year_2.",".$application_quarter_year_3;
$application_quarter_year2 = $application_quarter_year2_1.",".$application_quarter_year2_2.",".$application_quarter_year2_3;
$application_quarter_year3 = $application_quarter_year3_1.",".$application_quarter_year3_2.",".$application_quarter_year3_3;
$application_quarter_year4 = $application_quarter_year4_1.",".$application_quarter_year4_2.",".$application_quarter_year4_3;
$application_quarter_year5 = $application_quarter_year5_1.",".$application_quarter_year5_2.",".$application_quarter_year5_3;
//��û�Ⱓ/�б� ����
$application_date_chk = $application_date_chk1.",".$application_date_chk2.",".$application_date_chk3.",".$application_date_chk4.",".$application_date_chk5;
//��û�б�
$application_quarter = $application_quarter_1_1.",".$application_quarter_1_2.",".$application_quarter_1_3.",".$application_quarter_1_4."_".$application_quarter_2_1.",".$application_quarter_2_2.",".$application_quarter_2_3.",".$application_quarter_2_4."_".$application_quarter_3_1.",".$application_quarter_3_2.",".$application_quarter_3_3.",".$application_quarter_3_4;
$application_quarter2 = $application_quarter2_1_1.",".$application_quarter2_1_2.",".$application_quarter2_1_3.",".$application_quarter2_1_4."_".$application_quarter2_2_1.",".$application_quarter2_2_2.",".$application_quarter2_2_3.",".$application_quarter2_2_4."_".$application_quarter2_3_1.",".$application_quarter2_3_2.",".$application_quarter2_3_3.",".$application_quarter2_3_4;
$application_quarter3 = $application_quarter3_1_1.",".$application_quarter3_1_2.",".$application_quarter3_1_3.",".$application_quarter3_1_4."_".$application_quarter3_2_1.",".$application_quarter3_2_2.",".$application_quarter3_2_3.",".$application_quarter3_2_4."_".$application_quarter3_3_1.",".$application_quarter3_3_2.",".$application_quarter3_3_3.",".$application_quarter3_3_4;
$application_quarter4 = $application_quarter4_1_1.",".$application_quarter4_1_2.",".$application_quarter4_1_3.",".$application_quarter4_1_4."_".$application_quarter4_2_1.",".$application_quarter4_2_2.",".$application_quarter4_2_3.",".$application_quarter4_2_4."_".$application_quarter4_3_1.",".$application_quarter4_3_2.",".$application_quarter4_3_3.",".$application_quarter4_3_4;
$application_quarter5 = $application_quarter5_1_1.",".$application_quarter5_1_2.",".$application_quarter5_1_3.",".$application_quarter5_1_4."_".$application_quarter5_2_1.",".$application_quarter5_2_2.",".$application_quarter5_2_3.",".$application_quarter5_2_4."_".$application_quarter5_3_1.",".$application_quarter5_3_2.",".$application_quarter5_3_3.",".$application_quarter5_3_4;
//��û�ݾ�
$application_fee = $application_fee_1."_".$application_fee_2."_".$application_fee_3;
$application_fee2 = $application_fee2_1."_".$application_fee2_2."_".$application_fee2_3;
$application_fee3 = $application_fee3_1."_".$application_fee3_2."_".$application_fee3_3;
$application_fee4 = $application_fee4_1."_".$application_fee4_2."_".$application_fee4_3;
$application_fee5 = $application_fee5_1."_".$application_fee5_2."_".$application_fee5_3;
//���û���� �Ϸ�
$reapplication_done = $reapplication_done1.",".$reapplication_done2.",".$reapplication_done3.",".$reapplication_done4.",".$reapplication_done5;

//����� �߰����� (������ ����)
$sql_common2_master = "
						manage_cust_numb = '$manage_cust_numb',
						manage_cust_name = '$manage_cust_name',
";
$sql_common2 = " jongmok = '$jongmok',
						password = '$user_pass',
						registration_day = '$cntr_sdate',
						cntr_sdate = '$cntr_sdate',
						com_damdang_tel = '$damdang_cel',
						emp5_gbn = '$emp5_gbn',
						workday_month = '$workday_month',

						$sql_common2_master

						p_support = '$p_support',
						p_contribution = '$p_contribution',
						p_construction = '$p_construction',
						p_construction_yn = '$p_construction_yn',
						p_training = '$p_training',

						employment_report = '$employment_report',
						employment_report_date = '$employment_report_date',
						persons = '$persons',
						persons_temp = '$persons_temp',

						emp30_gbn = '$emp30_gbn',
						emp0_gbn = '$emp0_gbn',
						persons_gy = '$persons_gy',
						persons_sj = '$persons_sj',

						boss_mail = '$boss_mail',
						$pic_name_sql
						memo = '$memo',
						easynomu_yn = '$easynomu_yn',
						construction_yn = '$construction_yn'
";
$sql_common_opt2 = " 
						employment_kind = '$employment_kind',
						time_choice_work_date = '$time_choice_work_date',
						youth_intern_date = '$youth_intern_date',
						middle_age_intern_date = '$middle_age_intern_date',
						professional_date = '$professional_date',

						application_kind = '$application_kind',
						application_kind2 = '$application_kind2',
						application_kind3 = '$application_kind3',
						application_kind4 = '$application_kind4',
						application_kind5 = '$application_kind5',
						application_review = '$application_review',
						application_review2 = '$application_review2',
						application_review3 = '$application_review3',
						application_review4 = '$application_review4',
						application_review5 = '$application_review5',
						application_recognize = '$application_recognize',
						application_recognize2 = '$application_recognize2',
						application_recognize3 = '$application_recognize3',
						application_recognize4 = '$application_recognize4',
						application_recognize5 = '$application_recognize5',
						application_send = '$application_send',
						application_send2 = '$application_send2',
						application_send3 = '$application_send3',
						application_send4 = '$application_send4',
						application_send5 = '$application_send5',
						application_send_no = '$application_send_no',
						application_send_no2 = '$application_send_no2',
						application_send_no3 = '$application_send_no3',
						application_send_no4 = '$application_send_no4',
						application_send_no5 = '$application_send_no5',
						application_accept = '$application_accept',
						application_accept2 = '$application_accept2',
						application_accept3 = '$application_accept3',
						application_accept4 = '$application_accept4',
						application_accept5 = '$application_accept5',

						application_date_chk = '$application_date_chk',

						application_date_start = '$application_date_start',
						application_date_start2 = '$application_date_start2',
						application_date_start3 = '$application_date_start3',
						application_date_start4 = '$application_date_start4',
						application_date_start5 = '$application_date_start5',
						application_date_end = '$application_date_end',
						application_date_end2 = '$application_date_end2',
						application_date_end3 = '$application_date_end3',
						application_date_end4 = '$application_date_end4',
						application_date_end5 = '$application_date_end5',

						application_quarter_year = '$application_quarter_year',
						application_quarter_year2 = '$application_quarter_year2',
						application_quarter_year3 = '$application_quarter_year3',
						application_quarter_year4 = '$application_quarter_year4',
						application_quarter_year5 = '$application_quarter_year5',
						application_quarter = '$application_quarter',
						application_quarter2 = '$application_quarter2',
						application_quarter3 = '$application_quarter3',
						application_quarter4 = '$application_quarter4',
						application_quarter5 = '$application_quarter5',
						application_quarter = '$application_quarter',
						application_quarter2 = '$application_quarter2',
						application_quarter3 = '$application_quarter3',
						application_quarter4 = '$application_quarter4',
						application_quarter5 = '$application_quarter5',
						application_fee = '$application_fee',
						application_fee2 = '$application_fee2',
						application_fee3 = '$application_fee3',
						application_fee4 = '$application_fee4',
						application_fee5 = '$application_fee5',
						application_fee_sum = '$application_fee_sum',
						application_fee_sum2 = '$application_fee_sum2',
						application_fee_sum3 = '$application_fee_sum3',
						application_fee_sum4 = '$application_fee_sum4',
						application_fee_sum5 = '$application_fee_sum5',

						reapplication_date = '$reapplication_date',
						reapplication_date2 = '$reapplication_date2',
						reapplication_date3 = '$reapplication_date3',
						reapplication_date4 = '$reapplication_date4',
						reapplication_date5 = '$reapplication_date5',

						reapplication_done = '$reapplication_done',

						memo_total = '$memo_total'
";
//����� �⺻����
$sql_base = " select * from com_list_gy where com_code='$id' ";
$result_base = sql_query($sql_base);
$row = mysql_fetch_array($result_base);
//�߰� �ʵ� ������ ����
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//����
$sql = " update $g4[com_list_gy] set 
			$sql_common 
			where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
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
//�߰� �ʵ� ������ ����2
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

//�α��� ID
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];

//������DB insert / update
for($app_no=1;$app_no<=$app_count;$app_no++) {
	$k = $app_no;
	if($k == 1) $k = "";
	$idx = $_POST['idx'.$k];
	//õ�����޸� ����
	$application_fee_sum = str_replace(',','',$_POST['application_fee_sum'.$k]);
	//������ ����
	$application_kind = $_POST['application_kind'.$k];
	$application_review = $_POST['application_review'.$k];
	$application_recognize = $_POST['application_recognize'.$k];
	$application_send = $_POST['application_send'.$k];
	$application_send_no = $_POST['application_send_no'.$k];
	$application_accept = $_POST['application_accept'.$k];
	//��û�Ⱓ/�б� ����
	$application_date_chk = $_POST['application_date_chk'.$k];
	$application_date_start = $_POST['application_date_start'.$k];
	$application_date_end = $_POST['application_date_end'.$k];
	//��û�⵵
	$application_quarter_year = $_POST['application_quarter_year'.$k.'_1'].",".$_POST['application_quarter_year'.$k.'_2'].",".$_POST['application_quarter_year'.$k.'_3'];
	//��û�б�
	$application_quarter = $_POST['application_quarter'.$k.'_1_1'].",".$_POST['application_quarter'.$k.'_1_2'].",".$_POST['application_quarter'.$k.'_1_3'].",".$_POST['application_quarter'.$k.'_1_4']."_".$_POST['application_quarter'.$k.'_2_1'].",".$_POST['application_quarter'.$k.'_2_2'].",".$_POST['application_quarter'.$k.'_2_3'].",".$_POST['application_quarter'.$k.'_2_4']."_".$_POST['application_quarter'.$k.'_3_1'].",".$_POST['application_quarter'.$k.'_3_2'].",".$_POST['application_quarter'.$k.'_3_3'].",".$_POST['application_quarter'.$k.'_3_4'];
	//���ᱸ��
	$close_kind = $_POST['close_kind'.$k];
	//��������
	$close_date = $_POST['close_date'.$k];
	//����⵵
	$close_year = $_POST['close_year'.$k];
	//����б�
	$close_quarter = $_POST['close_quarter'.$k];
	//��û�ֱ�
	$application_cycle = $_POST['application_cycle'.$k];
	//���û����
	$reapplication_date = $_POST['reapplication_date'.$k];
	//���û���� �Ϸ�
	$reapplication_done = $_POST['reapplication_done'.$k];
	//������DB
	$sql_common_app = " 
						w_date = '$now_time',
						w_user = '$mb_id',
						com_code = '$id',
						com_name_app = '$firm_name',

						application_kind = '$application_kind',
						application_review = '$application_review',
						application_recognize = '$application_recognize',
						application_send = '$application_send',
						application_send_no = '$application_send_no',
						application_accept = '$application_accept',
						application_date_chk = '$application_date_chk',
						application_date_start = '$application_date_start',
						application_date_end = '$application_date_end',
						application_quarter_year = '$application_quarter_year',
						application_quarter = '$application_quarter',
						application_fee_sum = '$application_fee_sum',

						close_kind = '$close_kind',
						close_date = '$close_date',
						close_year = '$close_year',
						close_quarter = '$close_quarter',
						application_cycle = '$application_cycle',

						reapplication_date = '$reapplication_date',
						reapplication_done = '$reapplication_done'
	";
	//������DB ������ ����
	$sql_app_chk = " select * from erp_application where idx='$idx' ";
	$result_app_chk = sql_query($sql_app_chk);
	$total_app_chk = mysql_num_rows($result_app_chk);
	if($total_app_chk) {
		$sql_app = " update erp_application set 
					$sql_common_app 
					where idx = '$idx'
		";
	} else {
		$sql_app = " insert erp_application set 
					$sql_common_app 
		";
	}
	//echo $sql_app."<br><br>";
	sql_query($sql_app);
}
//exit;

//�������� ���� ���� �� ����
if($train_kind) {
	//��������DB insert / update
	for($job_no=1;$job_no<=$job_count;$job_no++) {
		$k = $job_no;
		if($k == 1) $k = "";
		$job_idx = $_POST['job_idx'.$k];
		//������ ����
		$train_kind = $_POST['train_kind'.$k];
		$permission_date = $_POST['permission_date'.$k];
		$scale = $_POST['scale'.$k];
		$staff = $_POST['staff'.$k];
		$facility = $_POST['facility_'.$k];
		$facility2 = $_POST['facility2_'.$k];
		$facility3 = $_POST['facility3_'.$k];
		//����å����
		$chief_name = $_POST['chief_name'.$k];
		$chief_ssnb = $_POST['chief_ssnb'.$k];
		$chief_position = $_POST['chief_position'.$k];
		$chief_job = $_POST['chief_job'.$k];
		$chief_career = $_POST['chief_career'.$k];
		//����1
		$teacher_name = $_POST['teacher_name_'.$k];
		$teacher_ssnb = $_POST['teacher_ssnb_'.$k];
		$teacher_position = $_POST['teacher_position_'.$k];
		$teacher_job = $_POST['teacher_job_'.$k];
		$teacher_career = $_POST['teacher_career_'.$k];
		$teacher_mail = $_POST['teacher_mail_'.$k];
		$teacher_scholarship = $_POST['teacher_scholarship_'.$k];
		//����2
		$teacher_name2 = $_POST['teacher_name2_'.$k];
		$teacher_ssnb2 = $_POST['teacher_ssnb2_'.$k];
		$teacher_position2 = $_POST['teacher_position2_'.$k];
		$teacher_job2 = $_POST['teacher_job2_'.$k];
		$teacher_career2 = $_POST['teacher_career2_'.$k];
		$teacher_mail2 = $_POST['teacher_mail2_'.$k];
		$teacher_scholarship2 = $_POST['teacher_scholarship2_'.$k];
		//������ȿ�Ⱓ
		$approval_effective = $_POST['approval_effective'.$k];
		$approval_expiration = $_POST['approval_expiration'.$k];
		//�����ǽ��� ����������
		$education_conduct_report = $_POST['education_conduct_report'.$k.'_1'];
		$education_close_date = $_POST['education_close_date'.$k.'_1'];
		//������ : õ�����޸� ����
		$job_fee = str_replace(',','',$_POST['job_fee'.$k.'_1']);
		//�޸�
		$job_review = $_POST['job_memo'.$k.'_1'];

		//������DB
		$sql_common_job = " 
							w_date = '$now_time',
							w_user = '$mb_id',
							com_code = '$id',
							com_name_job = '$firm_name',

							train_kind = '$train_kind',
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

							teacher_name = '$teacher_name',
							teacher_ssnb = '$teacher_ssnb',
							teacher_position = '$teacher_position',
							teacher_job = '$teacher_job',
							teacher_career = '$teacher_career',
							teacher_mail = '$teacher_mail',
							teacher_scholarship = '$teacher_scholarship',

							teacher_name2 = '$teacher_name2',
							teacher_ssnb2 = '$teacher_ssnb2',
							teacher_position2 = '$teacher_position2',
							teacher_job2 = '$teacher_job2',
							teacher_career2 = '$teacher_career2',
							teacher_mail2 = '$teacher_mail2',
							teacher_scholarship2 = '$teacher_scholarship2',

							approval_effective = '$approval_effective',
							approval_expiration = '$approval_expiration',
							education_conduct_report = '$education_conduct_report',
							education_close_date = '$education_close_date',
							job_fee = '$job_fee',

							job_review = '$job_review'
		";
		//��������DB ������ ����
		$sql_job_chk = " select * from job_education where idx='$job_idx' ";
		$result_job_chk = sql_query($sql_job_chk);
		$total_job_chk = mysql_num_rows($result_job_chk);
		if($total_job_chk) {
			$sql_job = " update job_education set $sql_common_job where idx = '$job_idx' ";
		} else {
			$sql_job = " insert job_education set $sql_common_job ";
		}
		sql_query($sql_job);
		//�������� idx ������ �� idx ����
		if(!$job_idx) {
			$sql_job_idx = " select idx from job_education where com_code='$id' ";
			$row_job_idx = sql_fetch($sql_job_idx);
			$job_idx = $row_job_idx['idx'];
		}

		//��������DB insert / update
		for($job_opt_no=1;$job_opt_no<=$_POST['job_opt_count'.$k];$job_opt_no++) {
			$t = $job_opt_no;
			if($t == 1) $t = "";
			$id_opt = $_POST['id_opt'.$k.'_'.$t];
			//�����ǽ��� ���������� ������ �޸�
			$education_conduct_report = $_POST['education_conduct_report'.$k.'_'.$t];
			$education_close_date = $_POST['education_close_date'.$k.'_'.$t];
			$job_fee = str_replace(',','',$_POST['job_fee'.$k.'_'.$t]);
			$job_memo = $_POST['job_memo'.$k.'_'.$t];
			//�������� ����DB
			$sql_common_job_opt = " 
								education_conduct_report = '$education_conduct_report',
								education_close_date = '$education_close_date',
								job_fee = '$job_fee',
								job_memo = '$job_memo'
			";
			//��������DB ������ ����
			$sql_job_opt_chk = " select * from job_education_opt where mid='$job_idx' and id='$id_opt' ";
			$result_job_opt_chk = sql_query($sql_job_opt_chk);
			$total_job_opt_chk = mysql_num_rows($result_job_opt_chk);
			if($total_job_opt_chk) {
				$sql_job_opt = " update job_education_opt set $sql_common_job_opt where mid='$job_idx' and id='$id_opt' ";
			} else {
				$sql_job_opt = " insert job_education_opt set $sql_common_job_opt , mid='$job_idx' ";
			}
			sql_query($sql_job_opt);
		}
	}
}

//�˸� DB ����� ������ select
//$row1 = mysql_fetch_array($result1);
$row2 = mysql_fetch_array($result2);

//��������
if($row2['application_accept'] != $application_accept) {
	$wr_subject = $application_accept." ���� ���� �Ǿ����ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '70001', alert_name = '��������'
	";
	sql_query($sql_alert);
}
//�Ǽ� �ŷ�ó ��� �˸�
$strpos_text = "�Ǽ�";
if(strpos($row['uptae'], $strpos_text) === false && strpos($uptae, $strpos_text) !== false) {
	$wr_subject = $now_date." �Ǽ� �ŷ�ó�� ��� �Ǿ����ϴ�.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10004', alert_name = '�Ǽ���ü'
	";
	sql_query($sql_alert);
}
alert("���������� ó����Ȳ�� ���� �Ǿ����ϴ�.","client_process_view.php?id=$id&w=$w&page=$page");
//goto_url("./4insure_list.php");
?>