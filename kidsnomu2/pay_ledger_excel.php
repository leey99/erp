<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select * from $g4[com_list_gy] where com_code = '$code' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
$com_name = $row_a4['com_name'];

$sub_title = "급여대장";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//급여대장
//$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_day > 0 ";
//엑셀 업로드 기능으로 근로시간 미입력 160706
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' and money_result != 0 ";
$sql_order = " order by position asc, in_day asc, name asc ";
$from_record = 0;
//$rows = 7;

//급여대장 근로자수
$sql = " select count(*) as cnt
          $sql_common
          $sql_search ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
//echo $total_count;
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

//통상임금
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//기타수당
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
}
$g1_text = $money_g_txt['g1'];
$g2_text = $money_g_txt['g2'];
$g3_text = $money_g_txt['g3'];
$g4_text = $money_g_txt['g4'];
$g5_text = $money_g_txt['g5'];
$g6_text = $money_g_txt['g6'];
$b1_text = $money_e_txt['e1'];
$b2_text = $money_e_txt['e2'];
$b3_text = $money_e_txt['e3'];
$b4_text = $money_e_txt['e4'];
$b5_text = $money_e_txt['e5'];
$b6_text = $money_e_txt['e6'];
$b7_text = $money_e_txt['e7'];
$b8_text = $money_e_txt['e8'];

//사업장 타입
$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
$comp_print_type = $row_a4_opt['comp_print_type'];
//계룡상록 어린이집
if($comp_print_type == "G") {
	$cell = array("연번","성명","주민등록번호","직위","입사일","퇴사일","기본월급","기본연장","야근근로","휴일근로","연차수당","수당계","$g1_text","$g2_text","$g3_text","$g4_text","수당계","$b1_text","$b2_text","수당계","급여총액","국민연금","건강보험","장기요양","고용보험","소득세","주민세","기타공제","공제계","지급총액");
//               0      1      2              3      4        5        6          7          8          9          10         11       12         13         14         15         16       17         18         19       20         21         22         23         24         25       26       27         28       29         30         31         32         33       34       35         36       37         38         39         40         41         42       43       44         45       46
//아이좋아어린이집
} else if($com_code == "20368") {
	$cell = array("연번","성명","주민등록번호","직위","입사일","퇴사일","기본월급","기본연장","야근근로","휴일근로","연차수당","수당계","$g1_text","$g2_text","$g3_text","$g4_text","수당계","$b1_text","$b2_text","$b3_text","$b4_text","$b5_text","$b6_text","$b7_text","$b8_text","수당계","환급/소급","급여총액","국민연금","건강보험","장기요양","고용보험","소득세","주민세","기타공제","공제계","지급총액");
//ASE어린이집 전월급여 g5 추가 160407 g6 추가 160921
} else if($com_code == "20482") {
	$cell = array("연번","성명","주민등록번호","직위","입사일","퇴사일","기본월급","기본연장","야근근로","휴일근로","연차수당","수당계","$g1_text","$g2_text","$g3_text","$g4_text","$g5_text","$g6_text","수당계","$b1_text","$b2_text","$b3_text","$b4_text","$b5_text","$b6_text","$b7_text","$b8_text","수당계","급여총액","국민연금","건강보험","장기요양","고용보험","소득세","주민세","기타공제","공제계","지급총액");
} else {
	//모든 사업장 제수당 4개로 표시 151005 -> 8개 표시 151231
	$cell = array("연번","성명","주민등록번호","직위","입사일","퇴사일","기본월급","기본연장","야근근로","휴일근로","연차수당","수당계","$g1_text","$g2_text","$g3_text","$g4_text","수당계","$b1_text","$b2_text","$b3_text","$b4_text","$b5_text","$b6_text","$b7_text","$b8_text","수당계","급여총액","국민연금","건강보험","장기요양","고용보험","소득세","주민세","기타공제","공제계","지급총액");
//               0      1      2              3      4        5        6          7          8          9          10         11       12         13         14         15         16       17         18         19         20         21       22         23         24         25         26         27       28       29         30       31         32         33       34       35         36       37         38         39         40         41         42       43       44         45       46
}
//$file_name = iconv("UTF-8", "EUC-KR", "급여대장_".$search_year."_".$search_month.".xls");
$file_name = $com_name."_".$search_year."_".$search_month.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>

<table width='1200' border='1' cellspacing=1 cellpadding=3 bgcolor="#5B8398">
	<tr bgcolor="#FFFFFF" align=left>
		<td colspan="<?=count($cell)?>"><?=$search_year?><?=iconv("EUC-KR", "UTF-8", "년")?> <?=$search_month?><?=iconv("EUC-KR", "UTF-8", "월 급여대장")?> : <?=iconv("EUC-KR", "UTF-8", $row_a4[com_name])?></td>
	</tr>
	<tr bgcolor="#65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $cell[$i])?></td>
<?
}
?>
	</tr>
<?
// 리스트 출력
$pay_page = ceil($rows / 6);
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//근로자 추가 정보
	$sql_staff = " select jumin_no from pibohum_base where com_code = '$com_code' and sabun = $row[sabun] ";
	$row_staff = sql_fetch($sql_staff);
	$staff_ssnb = $row_staff['jumin_no'];
	//데이터 없을시 공백처리
	if(!$row[in_day]) $row[in_day] = "-";
	if(!$row[out_day]) $row[out_day] = "-";
	if(!$row[position_txt]) $row[position_txt] = "-";
	if(!$row[step_txt]) $row[step_txt] = "-";
	if(!$row[work_form]) $row[work_form] = "-";
	if(!$row[dept]) $row[dept] = "-";
	if($row[pay_gbn] == "") {
		$pay_gbn = "-";
	} else {
		if($row[pay_gbn] == 0) $pay_gbn = "월급제";
		else if($row[pay_gbn] == 1) $pay_gbn = "시급제";
		else if($row[pay_gbn] == 2) $pay_gbn = "복합근무";
		else if($row[pay_gbn] == 3) $pay_gbn = "연봉제";
		else $pay_gbn = "-";
	}
	//기준시급 (시급제)
	/*
	if($row[pay_gbn] == 1) $money_time_low = $row[money_hour_ds];
	else $money_time_low = 4860; //최저임금
	*/
	$money_time_low = $row[money_hour_ds];

	if($row[w_ext] == "") $row[w_ext] = 0;
	if($row[w_ext_add] == "") $row[w_ext_add] = 0;
	if($row[w_night] == "") $row[w_night] = 0;
	if($row[w_hday] == "") $row[w_hday] = 0;

	if($row[hday] == "") $row[hday] = 0;
	if($row[annual_paid_holiday] == "") $row[annual_paid_holiday] = 0;

	//근로시간 계산
	//$w_sum = $row[w_day] + ($row[w_ext]*1.5) + ($row[w_ext_add]*1.5) + ($row[w_night]*0.5) + ($row[w_hday]*1.5);
	//$w_sum = round($w_sum,2);
	$w_sum = $row[workhour_total];
	$s_sum = $row[ext] + $row[ext_add] + $row[night] + $row[hday] + $row[annual_paid_holiday];
	$g_sum = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g5] + $row[g6];
	$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7] + $row[b8];
	$m_sum = $row[tax_so] + $row[tax_jumin] + $row[advance_pay] + $row[health] + $row[yoyang] + $row[yun] + $row[goyong] + $row[end_pay] + $row[minus];
	$money_total = $row[money_month] + $row[ext];

	//6명씩 1페이지씩
	$p = ceil(($i+1)/6);
	//echo $w_day_sum[$p];
	$w_day_sum[$p] = $w_day_sum[$p] + $row[w_day];

	$w_ext_sum[$p] = $w_ext_sum[$p] + $row[w_ext];
	$w_night_sum[$p] = $w_night_sum[$p] + $row[w_night];
	$w_hday_sum[$p] = $w_hday_sum[$p] + $row[w_hday];
	$w_ext_add_sum[$p] = $w_ext_add_sum[$p] + $row[w_ext_add];
	$w_night_add_sum[$p] = $w_night_add_sum[$p] + $row[w_night_add];
	$w_hday_add_sum[$p] = $w_hday_add_sum[$p] + $row[w_hday_add];
	$w_sum_sum[$p] = $w_sum_sum[$p] + $w_sum;

	$money_time_low_sum[$p] = $money_time_low_sum[$p] + $money_time_low;
	$money_time_sum[$p] = $money_time_sum[$p] + $row[money_time];
	$money_month_sum[$p] = $money_month_sum[$p] + $row[money_month];

	$ext_sum[$p] = $ext_sum[$p] + $row[ext];
	$night_sum[$p] = $night_sum[$p] + $row[night];
	$hday_sum[$p] = $hday_sum[$p] + $row[hday];
	$annual_paid_holiday_sum[$p] = $annual_paid_holiday_sum[$p] + $row[annual_paid_holiday];
	$ext_add_sum[$p] = $ext_add_sum[$p] + $row[ext_add];
	$night_add_sum[$p] = $night_add_sum[$p] + $row[night_add];
	$hday_add_sum[$p] = $hday_add_sum[$p] + $row[hday_add];
	$s_sum_sum[$p] = $s_sum_sum[$p] + $s_sum;

	$g1_sum[$p] = $g1_sum[$p] + $row[g1];
	$g2_sum[$p] = $g2_sum[$p] + $row[g2];
	$g3_sum[$p] = $g3_sum[$p] + $row[g3];
	$g4_sum[$p] = $g4_sum[$p] + $row[g4];
	$g5_sum[$p] = $g5_sum[$p] + $row[g5];
	$g6_sum[$p] = $g6_sum[$p] + $row[g6];
	$g_sum_sum[$p] = $g_sum_sum[$p] + $g_sum;

	$b1_sum[$p] = $b1_sum[$p] + $row[b1];
	$b2_sum[$p] = $b2_sum[$p] + $row[b2];
	$b3_sum[$p] = $b3_sum[$p] + $row[b3];
	$b4_sum[$p] = $b4_sum[$p] + $row[b4];
	$b5_sum[$p] = $b5_sum[$p] + $row[b5];
	$b6_sum[$p] = $b6_sum[$p] + $row[b6];
	$b7_sum[$p] = $b7_sum[$p] + $row[b7];
	$b8_sum[$p] = $b8_sum[$p] + $row[b8];
	$b_sum_sum[$p] = $b_sum_sum[$p] + $b_sum;

	$tax_so_sum[$p] = $tax_so_sum[$p] + $row[tax_so];
	$tax_jumin_sum[$p] = $tax_jumin_sum[$p] + $row[tax_jumin];
	$advance_pay_sum[$p] = $advance_pay_sum[$p] + $row[advance_pay];
	$health_sum[$p] = $health_sum[$p] + $row[health];
	$yoyang_sum[$p] = $yoyang_sum[$p] + $row[yoyang];
	$yun_sum[$p] = $yun_sum[$p] + $row[yun];
	$goyong_sum[$p] = $goyong_sum[$p] + $row[goyong];
	$end_pay_sum[$p] = $end_pay_sum[$p] + $row[end_pay];
	$minus_sum[$p] = $minus_sum[$p] + $row[minus];
	$m_sum_sum[$p] = $m_sum_sum[$p] + $m_sum;

	$money_total_sum[$p] = $money_total_sum[$p] + $row[money_total];
	$money_result_sum[$p] = $money_result_sum[$p] + $row[money_result];
?>
	<tr bgcolor="#ffffff" align=center>
		<td><?=$i+1?></td>
		<td><?=iconv("EUC-KR", "UTF-8", $row[name])?></td>
		<td><?=$staff_ssnb?></td>
		<td><?=iconv("EUC-KR", "UTF-8", $row[position_txt])?></td>
		<td><?=$row[in_day]?></td>
		<td><?=$row[out_day]?></td>

		<td><?=number_format($row[money_month])?></td>

		<td><?=number_format($row[ext])?></td>
		<td><?=number_format($row[night])?></td>
		<td><?=number_format($row[hday])?></td>
		<td><?=number_format($row[annual_paid_holiday])?></td>
		<td><?=number_format($s_sum)?></td>
<?
//계룡상록 어린이집
if($comp_print_type == "G") {
?>
		<td><?=number_format($row[g1])?></td>
		<td><?=number_format($row[g2])?></td>
		<td><?=number_format($row[g3])?></td>
		<td><?=number_format($row[g4])?></td>
		<td><?=number_format($g_sum)?></td>

		<td><?=number_format($row[b1])?></td>
		<td><?=number_format($row[b2])?></td>
		<td><?=number_format($b_sum)?></td>
<?
} else {
?>
		<td><?=number_format($row[g1])?></td>
		<td><?=number_format($row[g2])?></td>
		<td><?=number_format($row[g3])?></td>
		<td><?=number_format($row[g4])?></td>
<?
//ASE어린이집
if($com_code == "20482") {
?>
		<td><?=number_format($row['g5'])?></td>
		<td><?=number_format($row['g6'])?></td>
<?
}
?>
		<td><?=number_format($g_sum)?></td>

		<td><?=number_format($row[b1])?></td>
		<td><?=number_format($row[b2])?></td>
		<td><?=number_format($row[b3])?></td>
		<td><?=number_format($row[b4])?></td>
		<td><?=number_format($row[b5])?></td>
		<td><?=number_format($row[b6])?></td>
		<td><?=number_format($row[b7])?></td>
		<td><?=number_format($row[b8])?></td>
		<td><?=number_format($b_sum)?></td>
<?
}
//아이좋아어린이집
if($com_code == "20368") {
?>
		<td><?=number_format($row['etc'])?></td>
<?
}
?>
		<td><?=number_format($row[money_total])?></td>

		<td><?=number_format($row[yun])?></td>
		<td><?=number_format($row[health])?></td>
		<td><?=number_format($row[yoyang])?></td>
		<td><?=number_format($row[goyong])?></td>
		<td><?=number_format($row[tax_so])?></td>
		<td><?=number_format($row[tax_jumin])?></td>
		<td><?=number_format($row[minus])?></td>
		<td><?=number_format($m_sum)?></td>

		<td><?=number_format($row[money_result])?></td>
	</tr>
<?
}
?>
</table>			
</body>
</html>
