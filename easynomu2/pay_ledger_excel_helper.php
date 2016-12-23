<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from pibohum_base_pay_helper ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
$com_name = $row_a4['com_name'];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "급여대장";
$g4['title'] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
//퇴사일 기준 150819
$year_month = $search_year.".".$search_month;
$out_day_base = $year_month.".01";

//급여대장
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$sql_search2 = " and ( out_day = '' or out_day > '$out_day_base' ) ";
//$sql_search2 .= " and  money_total != 0 ";
$sql_search2 .= " and  money_for_tax != 0 ";
//공제, 환급 발생으로 실지급액 존재 시 표시 160310
//$sql_search2 .= " and  money_result != 0 ";
$sql_order = " order by name asc ";
$from_record = 0;
//$rows = 7;

//급여대장 근로자수
$sql = " select count(*) as cnt
          $sql_common
          $sql_search $sql_search2 ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
//echo $total_count;
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$file_name = $com_name."_헬퍼_급여대장_".$search_year."_".$search_month.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<table width="1200" border="1" cellspacing="1" cellpadding="3">
	<tr>
		<td align="left" colspan="30"><?=$search_year?><?=iconv("EUC-KR", "UTF-8", "년")?> <?=$search_month?><?=iconv("EUC-KR", "UTF-8", "월 급여대장")?> : <?=iconv("EUC-KR", "UTF-8", $com_name)?></td>
	</tr>
	<tr>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "연번")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "성명")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "주민등록번호")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "은행명")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "계좌번호")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "입사일")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "퇴사일")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "총<br>근로시간")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="1"><?=iconv("EUC-KR", "UTF-8", "동부권")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="1"><?=iconv("EUC-KR", "UTF-8", "남서부권")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "교통<br>지원금")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "급여")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", "급여내역")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", "갑근세")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="1"><?=iconv("EUC-KR", "UTF-8", "기타")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="4"><?=iconv("EUC-KR", "UTF-8", "사회보험(근로자)")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "공제합계")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "실제<br>지급액")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="5"><?=iconv("EUC-KR", "UTF-8", "사회보험(사업장)")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "공제합계")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "퇴직연금")?></td>
	</tr>
	<tr>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "평근")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "평근")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "동부권")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "남서부권")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "소득세")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "주민세")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "기타공제")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "국민연금")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "건강보험")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "장기요양")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "고용보험")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "국민연금")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "건강보험")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "장기요양")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "고용보험")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "산재보험")?></td>
	</tr>

<?
//시간당 급여 단가 적용 DB
$start_date = $search_year.".".$search_month.".01";
$end_date = $search_year.".".$search_month.".31";
$where_time = " and end_date >= '$start_date' and start_date <= '$end_date' ";
$sql_time = " select * from com_list_gy_time where com_code='$code' $where_time ";
//echo $sql_time;
$result_time = sql_query($sql_time);
$row_time = mysql_fetch_array($result_time);
//type h 동부권, 서남부권, 여분
$money_time1_helper = $row_time['money_time1_helper'];
$money_time2_helper = $row_time['money_time2_helper'];
$money_time3_helper = 0;
// 리스트 출력
$pay_page = ceil($rows / 6);
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//데이터 없을시 공백처리
	if(!$row['in_day']) $row['in_day'] = "-";
	if(!$row['out_day']) $row['out_day'] = "-";
	//주민등록번호
	$sql_sabun = " select * from pibohum_base a, pibohum_base_opt b where a.com_code=b.com_code and a.sabun=b.sabun and a.com_code='$row[com_code]' and a.sabun='$row[sabun]' ";
	$result_sabun = sql_query($sql_sabun);
	$row_sabun = mysql_fetch_array($result_sabun);
	if($row_sabun['jumin_no']) {
		$ssnb_txt = $row_sabun['jumin_no'];
	} else {
		$ssnb_txt = " ";
	}
	//계좌번호
	$account_info = $row_sabun['bank_name']." ".$row_sabun['bank_account'];
	$bank_name = $row_sabun['bank_name'];
	$bank_account = $row_sabun['bank_account'];
	//교통지원금
	if($row['annual_paid_holiday'] == "") $row['annual_paid_holiday'] = 0;
	//근로시간
	$w_sum = $row['workhour_total'];
	$w_1_s = $row['w_1'];
	$w_2_s = $row['w_2'];
	//공제합계, 기타공제 추가 160309
	$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['minus'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'];
	//급여내역
	$w_1_pay = ($row['w_1']*$money_time1_helper);
	$w_2_pay = ($row['w_2']*$money_time2_helper);
	$w_3_pay = 0;
	//공제합계(사업장)
	$c_m_sum = $row['c_health'] + $row['c_yoyang'] + $row['c_yun'] + $row['c_goyong'] + $row['c_sanjae'];
	//퇴직연금
	$retirement_pension = $row['retirement_pension'];
	//총계
	$money_total_sum = $money_total_sum + $row['money_total'];
	$w_sum_sum = $w_sum_sum + $w_sum;
	$w_1_s_sum += $w_1_s;
	$w_2_s_sum += $w_2_s;
	$w_1_sum = $w_1_sum + $row['w_1'];
	$w_2_sum = $w_2_sum + $row['w_2'];
	$w_edu_sum = $w_edu_sum + $row['w_edu'];
	$w_phone_sum = $w_phone_sum + $row['w_phone'];
	$annual_paid_holiday_sum = $annual_paid_holiday_sum + $row['annual_paid_holiday'];
	$money_for_tax_sum = $money_for_tax_sum + $row['money_for_tax'];
	$w_1_pay_sum += $w_1_pay;
	$w_2_pay_sum += $w_2_pay;
	$w_3_pay_sum += $w_3_pay;
	//갑근세 사회보험 공계합계
	$tax_so_sum = $tax_so_sum + $row['tax_so'];
	$tax_jumin_sum = $tax_jumin_sum + $row['tax_jumin'];
	//기타공제 160309
	$minus_sum = $minus_sum + $row['minus'];
	//4대보험
	$yun_sum = $yun_sum + $row['yun'];
	$health_sum = $health_sum + $row['health'];
	$yoyang_sum = $yoyang_sum + $row['yoyang'];
	$goyong_sum = $goyong_sum + $row['goyong'];
	$m_sum_sum += $m_sum;
	$money_result_sum = $money_result_sum + $row['money_result'];
	//사회보험(사업장)
	$c_yun_sum = $c_yun_sum + $row['c_yun'];
	$c_health_sum = $c_health_sum + $row['c_health'];
	$c_yoyang_sum = $c_yoyang_sum + $row['c_yoyang'];
	$c_goyong_sum = $c_goyong_sum + $row['c_goyong'];
	$c_sanjae_sum = $c_sanjae_sum + $row['c_sanjae'];
	$c_m_sum_sum += $c_m_sum;
	$retirement_pension_sum = $retirement_pension_sum + $retirement_pension;
?>
	<tr>
		<td align="center"><?=$i+1?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $row['name'])?></td>
		<td align="center"><?=$ssnb_txt?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $bank_name)?></td>
		<td align="center" x:str><?=iconv("EUC-KR", "UTF-8", $bank_account)?></td>
		<td align="center"><?=$row['in_day']?></td>
		<td align="center"><?=$row['out_day']?></td>
		<td align="center"><?=$w_sum?></td>
		<td align="center"><?=$row['w_1']?></td>
		<td align="center"><?=$row['w_2']?></td>

		<td align="center"><?=number_format($row['annual_paid_holiday'])?></td>
		<td align="center"><?=number_format($row['money_for_tax'])?></td>
		<td align="center"><?=number_format($w_1_pay)?></td>
		<td align="center"><?=number_format($w_2_pay)?></td>

		<td align="center"><?=number_format($row['tax_so'])?></td>
		<td align="center"><?=number_format($row['tax_jumin'])?></td>
		<td align="center"><?=number_format($row['minus'])?></td>
		<td align="center"><?=number_format($row['yun'])?></td>
		<td align="center"><?=number_format($row['health'])?></td>
		<td align="center"><?=number_format($row['yoyang'])?></td>
		<td align="center"><?=number_format($row['goyong'])?></td>
		<td align="center"><?=number_format($m_sum)?></td>
		<td align="center"><?=number_format($row['money_result'])?></td>
		<td align="center"><?=number_format($row['c_yun'])?></td>
		<td align="center"><?=number_format($row['c_health'])?></td>
		<td align="center"><?=number_format($row['c_yoyang'])?></td>
		<td align="center"><?=number_format($row['c_goyong'])?></td>
		<td align="center"><?=number_format($row['c_sanjae'])?></td>
		<td align="center"><?=number_format($c_m_sum)?></td>
		<td align="center"><?=number_format($retirement_pension)?></td>
	</tr>
<?
}
//임시퇴사자 표시
//$sql_search2 = " and ( out_day != '' and out_day <= '$out_day_base' ) ";
//$sql_search2 = " and  money_total = 0 ";
$sql_search2 = " and  money_for_tax = 0 ";
//$sql_search2 .= " and  money_total = 0 and c_money_gongje != 0 ";
//급여총액이 0 이고, ( 실지급액이 0 이 아니거나 사업장 사회보험 공제합계가 0 이 아닌 경우 ) 160310
$sql_search2 .= " and (money_result != 0  or c_money_gongje != 0) ";
$sql = " select count(*) as cnt
          $sql_common
          $sql_search $sql_search2 ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
for ($j=0; $row=sql_fetch_array($result); $j++) {
	//데이터 없을시 공백처리
	if(!$row['in_day']) $row['in_day'] = "-";
	if(!$row['out_day']) $row['out_day'] = "-";
	//주민등록번호
	$sql_sabun = " select * from pibohum_base a, pibohum_base_opt b where a.com_code=b.com_code and a.sabun=b.sabun and a.com_code='$row[com_code]' and a.sabun='$row[sabun]' ";
	$result_sabun = sql_query($sql_sabun);
	$row_sabun = mysql_fetch_array($result_sabun);
	if($row_sabun['jumin_no']) {
		$ssnb_txt = $row_sabun['jumin_no'];
	} else {
		$ssnb_txt = " ";
	}
	//계좌번호
	$account_info = $row_sabun['bank_name']." ".$row_sabun['bank_account'];
	$bank_name = $row_sabun['bank_name'];
	$bank_account = $row_sabun['bank_account'];
	//교통지원금
	if($row['annual_paid_holiday'] == "") $row['annual_paid_holiday'] = 0;
	//근로시간
	$w_sum = $row['workhour_total'];
	$w_1_s = $row['w_1'];
	$w_2_s = $row['w_2'];
	//공제합계, 기타공제 추가 160309
	$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['minus'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'];
	//급여내역
	$w_1_pay = ($row['w_1']*$money_time1_helper);
	$w_2_pay = ($row['w_2']*$money_time2_helper);
	$w_3_pay = 0;
	//공제합계(사업장)
	$c_m_sum = $row['c_health'] + $row['c_yoyang'] + $row['c_yun'] + $row['c_goyong'] + $row['c_sanjae'];
	//퇴직연금
	$retirement_pension = $row['retirement_pension'];
	//총계
	$money_total_sum = $money_total_sum + $row['money_total'];
	$w_sum_sum = $w_sum_sum + $w_sum;
	$w_1_s_sum += $w_1_s;
	$w_2_s_sum += $w_2_s;
	$w_1_sum = $w_1_sum + $row['w_1'];
	$w_2_sum = $w_2_sum + $row['w_2'];
	$w_edu_sum = $w_edu_sum + $row['w_edu'];
	$w_phone_sum = $w_phone_sum + $row['w_phone'];
	$annual_paid_holiday_sum = $annual_paid_holiday_sum + $row['annual_paid_holiday'];
	$money_for_tax_sum = $money_for_tax_sum + $row['money_for_tax'];
	$w_1_pay_sum += $w_1_pay;
	$w_2_pay_sum += $w_2_pay;
	$w_3_pay_sum += $w_3_pay;
	//갑근세 사회보험 공계합계
	$tax_so_sum = $tax_so_sum + $row['tax_so'];
	$tax_jumin_sum = $tax_jumin_sum + $row['tax_jumin'];
	//기타공제 160309
	$minus_sum = $minus_sum + $row['minus'];
	//4대보험
	$yun_sum = $yun_sum + $row['yun'];
	$health_sum = $health_sum + $row['health'];
	$yoyang_sum = $yoyang_sum + $row['yoyang'];
	$goyong_sum = $goyong_sum + $row['goyong'];
	$m_sum_sum += $m_sum;
	$money_result_sum = $money_result_sum + $row['money_result'];
	//사회보험(사업장)
	$c_yun_sum = $c_yun_sum + $row['c_yun'];
	$c_health_sum = $c_health_sum + $row['c_health'];
	$c_yoyang_sum = $c_yoyang_sum + $row['c_yoyang'];
	$c_goyong_sum = $c_goyong_sum + $row['c_goyong'];
	$c_sanjae_sum = $c_sanjae_sum + $row['c_sanjae'];
	$c_m_sum_sum += $c_m_sum;
	$retirement_pension_sum = $retirement_pension_sum + $retirement_pension;
?>
	<tr bgcolor="#e2e2e2">
		<td align="center"><?=$i+$j+1?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $row['name'])?></td>
		<td align="center"><?=$ssnb_txt?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $bank_name)?></td>
		<td align="center" x:str><?=iconv("EUC-KR", "UTF-8", $bank_account)?></td>
		<td align="center"><?=$row['in_day']?></td>
<?
	//재직상태가 휴직이며, 휴직기간일 경우 휴직 표시 160315
	$layoff_sdate = $row_sabun['layoff_sdate'];
	$layoff_edate = $row_sabun['layoff_edate'];
	$year_month = $search_year.".".$search_month;
	$layoff_day_base = $year_month.".01";
	// 2016.01.01 ~ 2016.03.01
	// 2016.02.01
	//echo $layloff_sdate." <= ".$layloff_day_base." && ".$layoff_edate." > ".$layoff_day_base;
	if($row_sabun['gubun'] == 1 && ( $layoff_sdate <= $layoff_day_base && $layoff_edate > $layoff_day_base )) {
?>
		<td align="center" style="color:red;"><?=iconv("EUC-KR", "UTF-8", "휴직")?></td>
<?
	} else {
?>
		<td align="center"><?=$row['out_day']?></td>
<?
	}
?>

		<td align="center"><?=$w_sum?></td>
		<td align="center"><?=$row['w_1']?></td>
		<td align="center"><?=$row['w_2']?></td>

		<td align="center"><?=number_format($row['annual_paid_holiday'])?></td>
		<td align="center"><?=number_format($row['money_for_tax'])?></td>
		<td align="center"><?=number_format($w_1_pay)?></td>
		<td align="center"><?=number_format($w_2_pay)?></td>

		<td align="center"><?=number_format($row['tax_so'])?></td>
		<td align="center"><?=number_format($row['tax_jumin'])?></td>
		<td align="center"><?=number_format($row['minus'])?></td>
		<td align="center"><?=number_format($row['yun'])?></td>
		<td align="center"><?=number_format($row['health'])?></td>
		<td align="center"><?=number_format($row['yoyang'])?></td>
		<td align="center"><?=number_format($row['goyong'])?></td>
		<td align="center"><?=number_format($m_sum)?></td>
		<td align="center"><?=number_format($row['money_result'])?></td>
		<td align="center"><?=number_format($row['c_yun'])?></td>
		<td align="center"><?=number_format($row['c_health'])?></td>
		<td align="center"><?=number_format($row['c_yoyang'])?></td>
		<td align="center"><?=number_format($row['c_goyong'])?></td>
		<td align="center"><?=number_format($row['c_sanjae'])?></td>
		<td align="center"><?=number_format($c_m_sum)?></td>
		<td align="center"><?=number_format($retirement_pension)?></td>
	</tr>
<?
}
?>
	<tr>
		<td align="center" rowspan="2" colspan="7"><?=iconv("EUC-KR", "UTF-8", "총 계")?></td>
		<td align="center" rowspan="2"><?=number_format($w_sum_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($w_1_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($w_2_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($annual_paid_holiday_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($money_for_tax_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($w_1_pay_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($w_2_pay_sum)?></td>

		<td align="center"><?=number_format($tax_so_sum)?></td>
		<td align="center"><?=number_format($tax_jumin_sum)?></td>
		<td align="center"><?=number_format($minus_sum)?></td>
		<td align="center"><?=number_format($yun_sum)?></td>
		<td align="center"><?=number_format($health_sum)?></td>
		<td align="center"><?=number_format($yoyang_sum)?></td>
		<td align="center"><?=number_format($goyong_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($m_sum_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($money_result_sum)?></td>
		<td align="center"><?=number_format($c_yun_sum)?></td>
		<td align="center"><?=number_format($c_health_sum)?></td>
		<td align="center"><?=number_format($c_yoyang_sum)?></td>
		<td align="center"><?=number_format($c_goyong_sum)?></td>
		<td align="center"><?=number_format($c_sanjae_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($c_m_sum_sum)?></td>
		<td align="center" rowspan="2"><?=number_format($retirement_pension_sum)?></td>
	</tr>
	<tr>
		<td align="center" colspan="3"><?=number_format($tax_so_sum+$tax_jumin_sum+$minus_sum)?></td>
		<td align="center" colspan="4"><?=number_format($yun_sum+$health_sum+$yoyang_sum+$goyong_sum)?></td>
		<td align="center" colspan="5"><?=number_format($c_yun_sum+$c_health_sum+$c_yoyang_sum+$c_goyong_sum+$c_sanjae_sum)?></td>
	</tr>
</table>			
</body>
</html>
