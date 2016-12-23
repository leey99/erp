<?
$sub_menu = "100302";
include_once("./_common.php");

$g4[com_paycode_list] = "com_paycode_list";
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");

if(!$pay_gbn0) $pay_gbn0 = "0";
if(!$pay_gbn1) $pay_gbn1 = "0";
if(!$pay_gbn2) $pay_gbn2 = "0";
if(!$pay_gbn3) $pay_gbn3 = "0";

$payrpt = $pay_gbn0.$pay_gbn1.$pay_gbn2.$pay_gbn3.$pay_gbn4;
//echo $payrpt;
//exit;
$sql_common = " payrpt = '$payrpt' ";

$sql = " update $g4[com_list_gy] set 
			$sql_common 
			where com_code = '$com_code' ";
//천단위콤마 제거
$money_min_time = str_replace(',','',$money_min_time);
$money_time_input = str_replace(',','',$money_time_input);
$money_min_day = str_replace(',','',$money_min_day);
$money_day_input = str_replace(',','',$money_day_input);
$money_min_month = str_replace(',','',$money_min_month);
$money_month_input = str_replace(',','',$money_month_input);

//화성시장애인부모회, 화성서남부장애인자립생활지원센터
if($com_code==20399 || $com_code==20627) {
/*
	$money_time1 = str_replace(',','',$money_time1);
	$money_time1_hday = str_replace(',','',$money_time1_hday);
	$money_time2 = str_replace(',','',$money_time2);
	$money_time2_hday = str_replace(',','',$money_time2_hday);
	$money_time3 = str_replace(',','',$money_time3);
	$money_time3_hday = str_replace(',','',$money_time3_hday);
	$money_time1_com = str_replace(',','',$money_time1_com);
	$money_time1_hday_com = str_replace(',','',$money_time1_hday_com);
	$money_time2_com = str_replace(',','',$money_time2_com);
	$money_time2_hday_com = str_replace(',','',$money_time2_hday_com);
	$money_time3_com = str_replace(',','',$money_time3_com);
	$money_time3_hday_com = str_replace(',','',$money_time3_hday_com);
*/
	$money_time_edu = str_replace(',','',$money_time_edu);
	$money_time_phone = str_replace(',','',$money_time_phone);
	$type_h = " money_time_edu = '$money_time_edu',
							money_time_phone = '$money_time_phone', ";
} else {
	$type_h = "";
}
//추가 필드 데이터 유무 (급여유형)
$sql_common2 = " pay_gbn = '$pay_gbn',
						pay_gbn_a = '$pay_gbn_a',
						pay_gbn_b = '$pay_gbn_b',
						pay_gbn_c = '$pay_gbn_c',
						pay_gbn_d = '$pay_gbn_d',

						$type_h

						payrpt = '$payrpt',
						money_min_time = '$money_min_time',
						money_time_input = '$money_time_input',
						money_min_day = '$money_min_day',
						money_day_input = '$money_day_input',
						money_min_month = '$money_min_month',
						money_month_base_pesent = '$money_month_base_pesent',
						money_month_input = '$money_month_input',
						money_year_base_division = '$money_year_base_division',
						money_year_base_division2 = '$money_year_base_division2' ";
$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
$result_opt2 = sql_query($sql_opt2);
$total_opt2 = mysql_num_rows($result_opt2);
if($total_opt2) {
	$sql2 = " update com_list_gy_opt2 set 
				$sql_common2 
				where com_code = '$com_code' ";
} else {
	$sql2 = " insert com_list_gy_opt2 set 
				$sql_common2 
				, com_code = '$com_code', wr_date = '$now_time' ";
}
//echo $sql2;
//exit;
sql_query($sql);
sql_query($sql2);
//급여 단가 DB 화성시장애인부모회 151022
//화성서남부장애인자립생활지원센터 추가 160328
if($com_code==20399 || $com_code==20627) {
	$check_cnt = $_POST['pay_time_cnt'];
	for($i=0; $i<$check_cnt; $i++) {
		$idx = $_POST['pay_time_idx_'.$i];
		$start_date = $_POST['start_date_'.$i];
		$end_date = $_POST['end_date_'.$i];
		$money_time1 = str_replace(',','',$_POST['money_time1_'.$i]);
		$money_time1_hday = str_replace(',','',$_POST['money_time1_hday_'.$i]);
		$money_time2 = str_replace(',','',$_POST['money_time2_'.$i]);
		$money_time2_hday = str_replace(',','',$_POST['money_time2_hday_'.$i]);
		$money_time3 = str_replace(',','',$_POST['money_time3_'.$i]);
		$money_time3_hday = str_replace(',','',$_POST['money_time3_hday_'.$i]);

		$money_time1_com = str_replace(',','',$_POST['money_time1_com_'.$i]);
		$money_time1_hday_com = str_replace(',','',$_POST['money_time1_hday_com_'.$i]);
		$money_time2_com = str_replace(',','',$_POST['money_time2_com_'.$i]);
		$money_time2_hday_com = str_replace(',','',$_POST['money_time2_hday_com_'.$i]);
		$money_time3_com = str_replace(',','',$_POST['money_time3_com_'.$i]);
		$money_time3_hday_com = str_replace(',','',$_POST['money_time3_hday_com_'.$i]);

		$money_time1_helper = str_replace(',','',$_POST['money_time1_helper_'.$i]);
		$money_time2_helper = str_replace(',','',$_POST['money_time2_helper_'.$i]);

		$money_time_edu = str_replace(',','',$_POST['money_time_edu_'.$i]);
		$money_time_phone = str_replace(',','',$_POST['money_time_phone_'.$i]);
		$money_time_input = str_replace(',','',$_POST['money_time_input_'.$i]);

		$sql_common_time = "	money_time1 = '$money_time1',
													money_time2 = '$money_time2',
													money_time3 = '$money_time3',
													money_time1_hday = '$money_time1_hday',
													money_time2_hday = '$money_time2_hday',
													money_time3_hday = '$money_time3_hday',

													money_time1_com = '$money_time1_com',
													money_time2_com = '$money_time2_com',
													money_time3_com = '$money_time3_com',
													money_time1_hday_com = '$money_time1_hday_com',
													money_time2_hday_com = '$money_time2_hday_com',
													money_time3_hday_com = '$money_time3_hday_com',

													money_time1_helper = '$money_time1_helper',
													money_time2_helper = '$money_time2_helper',

													money_time_edu = '$money_time_edu',
													money_time_phone = '$money_time_phone',
													money_time_input = '$money_time_input',

													start_date = '$start_date',
													end_date = '$end_date',
		";
		$sql_time = " update com_list_gy_time set 
					$sql_common_time
					modify_date = '$now_date'
					where com_code = '$com_code' and idx = '$idx' ";
		sql_query($sql_time);
	}
}
alert("정상적으로 급여유형이 수정 되었습니다.","com_pay_gbn.php");
?>