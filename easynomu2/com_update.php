<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
// ��ǥ���ڵ���
if($cust_cel1) $cust_cel = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//��ȭ��ȣ
//if($cust_tel1) $cust_tel = "(".$cust_tel1.") ".$cust_tel2."-".$cust_tel3;
if($cust_tel1) $cust_tel = $cust_tel1."-".$cust_tel2."-".$cust_tel3;
//�ѽ���ȣ
//if($cust_fax1) $cust_fax = "(".$cust_fax1.") ".$cust_fax2."-".$cust_fax3;
if($cust_fax1) $cust_fax = $cust_fax1."-".$cust_fax2."-".$cust_fax3;
//�������ȭ
if($damdang_cel1) $damdang_cel = $damdang_cel1."-".$damdang_cel2."-".$damdang_cel3;
//�����ȣ
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;
//�����ȣ ��ǥ��
if($boss_adr_zip1) $boss_adr_zip = $boss_adr_zip1."-".$boss_adr_zip2;
//�޿������� ����
if($pay_day_last == 1) $pay_day = "";
//�����װ����� ����
if($settlement_day_last == 1) $settlement_day = "";

//������� ���
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

//���̵� �߱�
$mb_id = $user_id;
$mb_password = $user_pass;
$sql_common_id = " mb_name         = '$firm_name',
                mb_nick         = '$firm_name',
                mb_email        = 'kcmc4519@naver.com',
								mb_level        = '3'
							";

$sql_common = " com_name = '$firm_name',
						upche_div = '$comp_type',
						biz_no = '$comp_bznb',
						bupin_no = '$bupin_no',
						uptae = '$uptae',

						upjong_code = '$upjong_code',
						upjong = '$upjong',
						t_insureno = '$user_id',

						boss_name = '$cust_name',
						jumin_no = '$cust_ssnb',

						boss_hp = '$cust_cel',
						com_tel = '$cust_tel',
						com_fax = '$cust_fax',

						com_damdang = '$damdang_name',

						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',

						boss_postno = '$boss_adr_zip',
						boss_juso = '$boss_adr_adr1',
						boss_juso2 = '$boss_adr_adr2',

						com_mail = '$cust_email' ";

//õ�����޸� ����
$bonus_money = str_replace(',','',$bonus_money);
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);
//�󿩱� ������
$bonus_array = $bonus_0.",".$bonus_1.",".$bonus_2.",".$bonus_3.",".$bonus_4.",".$bonus_5;
$bonus_p_array = $bonus_p_0.",".$bonus_p_1.",".$bonus_p_2.",".$bonus_p_3.",".$bonus_p_4.",".$bonus_p_5;
//������
$retirement_gbn = $retirement_gbn1.",".$retirement_gbn2.",".$retirement_gbn3;

//����� �߰����� (������ ����)
if($member['mb_level'] != 3) {
	$sql_common2_master = "
							man_cust_name = '$man_cust_name',
							manage_cust_numb = '$manage_cust_numb',
							manage_cust_name = '$manage_cust_name',
							settlement_day = '$settlement_day',
							settlement_day_last = '$settlement_day_last',
							samu_req_yn = '$samu_req_yn',
							samu_state = '$samu_state',
							service_day_start = '$service_day_start',
							service_day_end = '$service_day_end',
							comp_print_type = '$comp_print_type',
							setting_pay = '$setting_pay',
							month_pay = '$month_pay',
	";
} else {
	$sql_common2_master = "";
}

$sql_common2 = " jongmok = '$jongmok',
						password = '$user_pass',
						cntr_sdate = '$cntr_sdate',
						com_damdang_tel = '$damdang_cel',
						emp5_gbn = '$emp5_gbn',
						workday_month = '$workday_month',

						$sql_common2_master

						pay_day = '$pay_day',
						pay_day_last = '$pay_day_last',
						pay_day_now_month = '$pay_day_now_month',

						pay_day_time = '$pay_day_time',
						pay_day_last_time = '$pay_day_last_time',
						pay_day_now_month_time = '$pay_day_now_month_time',

						pay_calculate_day1 = '$pay_calculate_day1',
						pay_calculate_day_period1 = '$pay_calculate_day_period1',
						pay_calculate_day2 = '$pay_calculate_day2',
						pay_calculate_day_period2 = '$pay_calculate_day_period2',

						pay_calculate_day1_time = '$pay_calculate_day1_time',
						pay_calculate_day_period1_time = '$pay_calculate_day_period1_time',
						pay_calculate_day2_time = '$pay_calculate_day2_time',
						pay_calculate_day_period2_time = '$pay_calculate_day_period2_time',

						pay_day_time2 = '$pay_day_time2',
						pay_day_last_time2 = '$pay_day_last_time2',
						pay_day_now_month_time2 = '$pay_day_now_month_time2',

						pay_calculate_day1_time2 = '$pay_calculate_day1_time2',
						pay_calculate_day_period1_time2 = '$pay_calculate_day_period1_time2',
						pay_calculate_day2_time2 = '$pay_calculate_day2_time2',
						pay_calculate_day_period2_time2 = '$pay_calculate_day_period2_time2',

						pay_calculate_day1_hday = '$pay_calculate_day1_hday',
						pay_calculate_day_period1_hday = '$pay_calculate_day_period1_hday',
						pay_calculate_day2_hday = '$pay_calculate_day2_hday',
						pay_calculate_day_period2_hday = '$pay_calculate_day_period2_hday',

						$pic_name_sql
						employment_report = '$employment_report',
						employment_report_date = '$employment_report_date',
						retirement_age = '$retirement_age'

";

//�߰� �ʵ� ������ ����
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//����
if ($w == 'u'){
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
	//��й�ȣ ����
	$sql3 = " update $g4[member_table] set mb_password = '".sql_password($mb_password)."' where mb_id='$mb_id' ";
	sql_query($sql3);
	alert("���������� ����� �⺻������ ���� �Ǿ����ϴ�.","com_view.php?id=$id&w=$w&page=$page");
//���
}else{
	$sql_max = "select max(com_code) from $g4[com_list_gy] ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;
	if(strlen($id) == 4) $id = "0".$id;
	else if(strlen($id) == 3) $id = "00".$id;
	else if(strlen($id) == 2) $id = "000".$id;
	else if(strlen($id) == 1) $id = "0000".$id;
	//echo strlen($id);
	//echo $id;
	//exit;
	$sql = " insert $g4[com_list_gy] set 
					$sql_common 
					, com_code = '$id' ";
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
	//ȸ�����
	//sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_password = '".sql_password($mb_password)."', mb_datetime = '$g4[time_ymdhis]', mb_ip = '$_SERVER[REMOTE_ADDR]', mb_email_certify = '$g4[time_ymdhis]', mb_open = '1', $sql_common_id  ");
	//������ ���� mb_email_certify ����
	sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_password = '".sql_password($mb_password)."', mb_datetime = '$g4[time_ymdhis]', mb_ip = '$_SERVER[REMOTE_ADDR]', mb_open = '1', $sql_common_id  ");

	sql_query($sql2);
  //$id = mysql_insert_id();

	if($member['mb_level'] != 5) {
		alert("���������� ����� �⺻������ ��� �Ǿ����ϴ�.","com_list.php?page=$page");
	} else {
		alert("���������� ����� �⺻������ ��� �Ǿ����ϴ�.","/bbs/logout.php?url=%2Feasynomu%2Flogin.php");
	}
}
//echo $sql;
//echo $sql2;
//exit;
//goto_url("./4insure_list.php");
?>