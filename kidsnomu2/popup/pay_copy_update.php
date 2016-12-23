<?
//$mode = "popup";
$member['mb_id'] = "test";
$sub_menu = "100200";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");

//추가 필드 데이터 기준DB (급여정보)
$sql_pay = " select * from pibohum_base_pay where com_code='$code' and year='$send_year' and month='$send_month' ";
$result_pay = sql_query($sql_pay);

//전송 데이터 배열 분해
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);

//복사 대상 급여정보 DB 데이터 조회 삭제
for($k=0; $k<$check_cnt; $k++) {
	$code_id_array = explode("_", $chk_data_array[$k]);
	$copy_year = $code_id_array[0];
	$copy_month = $code_id_array[1];
	//대상 데이터 유무 (급여대장)
	$sql_opt2 = " select * from pibohum_base_pay where com_code='$code' and year='$copy_year' and month='$copy_month' ";
	$result_opt2 = sql_query($sql_opt2);
	$total_opt2 = mysql_num_rows($result_opt2);
	if($total_opt2) {
		$sql3_delete = " delete from pibohum_base_pay where com_code='$code' and year='$copy_year' and month='$copy_month' ";
		sql_query($sql3_delete);
	}
}
//급여대장 DB 사업장, 급여년도, 급여월 조회
for($i=0; $row_pay=sql_fetch_array($result_pay); $i++) {
	//전송 데이터 배열 카운트 반복
	for($k=0; $k<$check_cnt; $k++) {
		$code_id_array = explode("_", $chk_data_array[$k]);
		$copy_year = $code_id_array[0];
		$copy_month = $code_id_array[1];
		//변수 전달
		$sql_common3 = " com_code = '$row_pay[com_code]',
								sabun = '$row_pay[sabun]',
								name = '$row_pay[name]',
								w_date = '$now_date',

								position = '$row_pay[position]',
								position_txt = '$row_pay[position_txt]',
								step_txt = '$row_pay[step_txt]',
								step = '$row_pay[step]',
								in_day = '$row_pay[in_day]',
								out_day = '$row_pay[out_day]',
								work_form = '$row_pay[work_form]',
								dept = '$row_pay[dept]',
								pay_gbn = '$row_pay[pay_gbn]',

								w_day = '$row_pay[w_day]',
								w_ext = '$row_pay[w_ext]',
								w_night = '$row_pay[w_night]',
								w_hday = '$row_pay[w_hday]',
								w_late = '$row_pay[w_late]',
								w_leave = '$row_pay[w_leave]',
								w_out = '$row_pay[w_out]',
								w_absence = '$row_pay[w_absence]',
								workhour_total = '$row_pay[workhour_total]',

								ext = '$row_pay[ext]',
								night = '$row_pay[night]',
								hday = '$row_pay[hday]',

								money_hour_ds = '$row_pay[money_hour_ds]',
								money_time = '$row_pay[money_time]',
								money_min_base = '$row_pay[money_min_base]',
								money_day = '$row_pay[money_day]',
								money_month = '$row_pay[money_month]',
								money_month_fix = '$row_pay[money_month_fix]',
								g1 = '$row_pay[g1]',
								g2 = '$row_pay[g2]',
								manual = '$row_pay[manual]',
								annual_paid_holiday = '$row_pay[annual_paid_holiday]',
								b1 = '$row_pay[b1]',
								b2 = '$row_pay[b2]',
								tax_so = '$row_pay[tax_so]',
								tax_jumin = '$row_pay[tax_jumin]',
								health = '$row_pay[health]',
								yoyang = '$row_pay[yoyang]',
								yun = '$row_pay[yun]',
								goyong = '$row_pay[goyong]',
								minus = '$row_pay[minus]',
								money_total = '$row_pay[money_total]',
								money_for_tax = '$row_pay[money_for_tax]',
								money_gongje = '$row_pay[money_gongje]',
								money_result = '$row_pay[money_result]'
								";
		//입사일 기준
		$year_month = $copy_year.".".$copy_month;
		$in_day_base = $year_month.".32";
		//echo $in_day_base." > ".$row_pay['in_day'];
		//exit;
		//2015.04.32 > 2015.05.04 : 입사일 미래일 경우 제외, 과거일 경우 표함
		if($in_day_base > $row_pay['in_day']) {
			//퇴사일 기준
			$out_day_base = $year_month.".01";
			//echo $out_day_base. " < ".$row_pay['out_day'];
			//exit;
			//2015.04.01 < 2015.05.10 : 퇴사일 없을 경우, 퇴사일 미래일 경우 포함
			if(!$row_pay['out_day'] || $out_day_base < $row_pay['out_day']) {
				$sql3 = " insert pibohum_base_pay set $sql_common3 , year='$copy_year', month='$copy_month' ";
				//echo $sql3;
				//exit;
				sql_query($sql3);
			}
		}
	}
}
//exit;
echo "<script>alert(\"정상적으로 복사 되었습니다.\"); opener.location.reload(); close();</script>";
?>