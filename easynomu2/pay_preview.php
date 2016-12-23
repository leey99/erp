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

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "급여 미리보기";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//급여대장
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_day > 0 ";
//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//정렬 2순위
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//정렬 3순위
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];

if (!$sst) {
	if($sort1) {
		$sst = $sort1;
		$sod = $sod1;
	} else {
		$sst = "position";
		$sod = "asc";
	}
}
if (!$sst2) {
	if($sort2) {
		$sst2 = ", ".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		$sst3 = ", ".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", dept";
		$sod3 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 ";

$from_record = 0;
//$rows = 7;
$rows = 24;
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function back_url() {
	location.href = "pay_list.php?search_year=<?=$search_year?>&search_month=<?=$search_month?>";
}
</script>

<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = '<?=$rooturl?>';
var rootssl = '<?=$rootssl?>';
var raccount= 'home';
var moduleid= 'home';
var memberid= 'master';
var is_admin= '0';
var needlog = '로그인후에 이용하실 수 있습니다. ';
var neednum = '숫자만 입력해 주세요.';
var myagent	= navigator.appName.indexOf('Explorer') != -1 ? 'ie' : 'ns';
//]]>
</script>
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>

<div id="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<div id="rcontent" class="center m_side">
									<form name = "HwpControl" id="HwpControl" method="post" action="<?=$PHP_SELF?>">
									<table border="0">
										<tr>
											<td>
												<div style="padding:2px">
													<input type="button" name="history_back_bt" value="창닫기" onclick="window.close()" /> 
												</div>
											</td>
											<td>
												<div id="year_month">
													<select name="search_year">
<?
for($i=2013;$i<2015;$i++) {
?>
														<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
													</select>년
													<select name="search_month">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
														<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>


													</select>월
													<input type="submit" value="조회" class="btnblue" />
												</div>
											</td>
											<td>사업장명 : <?=$row_a4[com_name]?> / 사업자등록번호 : <?=$row_a4[biz_no]?></td>
										</tr>
									</table>
									<!--급여대장-->
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>
<?
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
?>
									<input type="hidden" name="g1_text" value="<?=$money_g_txt['g1']?>"/>
									<input type="hidden" name="g2_text" value="<?=$money_g_txt['g2']?>"/>
									<input type="hidden" name="g3_text" value="<?=$money_g_txt['g3']?>"/>
									<input type="hidden" name="g4_text" value="<?=$money_g_txt['g4']?>"/>
									<input type="hidden" name="g5_text" value="<?=$money_g_txt['g5']?>"/>
									<input type="hidden" name="b1_text" value="<?=$money_e_txt['e1']?>"/>
									<input type="hidden" name="b2_text" value="<?=$money_e_txt['e2']?>"/>
									<input type="hidden" name="b3_text" value="<?=$money_e_txt['e3']?>"/>
									<input type="hidden" name="b4_text" value="<?=$money_e_txt['e4']?>"/>
									<input type="hidden" name="b5_text" value="<?=$money_e_txt['e5']?>"/>
									<input type="hidden" name="b6_text" value="<?=$money_e_txt['e6']?>"/>
									<input type="hidden" name="b7_text" value="<?=$money_e_txt['e7']?>"/>
									<input type="hidden" name="b8_text" value="<?=$money_e_txt['e8']?>"/>
									<input type="hidden" name="minus_text" value="기타공제"/>

									<!--반복 변수 배열 처리-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="jik" value=" "/>
									<input type="hidden" name="jdate" value=" "/>
									<input type="hidden" name="edate" value=" "/>
									<input type="hidden" name="position" value=" "/>
									<input type="hidden" name="step" value=" "/>
									<input type="hidden" name="work_form" value=" "/>
									<input type="hidden" name="dept" value=" "/>
									<input type="hidden" name="pay_gbn" value=" "/>

									<input type="hidden" name="w_day" value=" "/>
									<input type="hidden" name="w_ext" value=" "/>
									<input type="hidden" name="w_night" value=" "/>
									<input type="hidden" name="w_hday" value=" "/>
									<input type="hidden" name="w_ext_add" value=" "/>
									<input type="hidden" name="w_night_add" value=" "/>
									<input type="hidden" name="w_hday_add" value=" "/>
									<input type="hidden" name="w_sum" value=" "/>

									<input type="hidden" name="money_time_low" value=" "/>
									<input type="hidden" name="money_time" value=" "/>
									<input type="hidden" name="money_month" value=" "/>

									<input type="hidden" name="ext" value=" "/>
									<input type="hidden" name="night" value=" "/>
									<input type="hidden" name="hday" value=" "/>
									<input type="hidden" name="annual_paid_holiday" value=" "/>
									<input type="hidden" name="ext_add" value=" "/>
									<input type="hidden" name="night_add" value=" "/>
									<input type="hidden" name="hday_add" value=" "/>
									<input type="hidden" name="s_sum" value=" "/>

									<input type="hidden" name="g1" value=" "/>
									<input type="hidden" name="g2" value=" "/>
									<input type="hidden" name="g3" value=" "/>
									<input type="hidden" name="g4" value=" "/>
									<input type="hidden" name="g5" value=" "/>
									<input type="hidden" name="g_sum" value=" "/>

									<input type="hidden" name="b1" value=" "/>
									<input type="hidden" name="b2" value=" "/>
									<input type="hidden" name="b3" value=" "/>
									<input type="hidden" name="b4" value=" "/>
									<input type="hidden" name="b5" value=" "/>
									<input type="hidden" name="b6" value=" "/>
									<input type="hidden" name="b7" value=" "/>
									<input type="hidden" name="b8" value=" "/>
									<input type="hidden" name="b_sum" value=" "/>

									<input type="hidden" name="tax_so" value=" "/>
									<input type="hidden" name="tax_jumin" value=" "/>
									<input type="hidden" name="advance_pay" value=" "/>
									<input type="hidden" name="health" value=" "/>
									<input type="hidden" name="yoyang" value=" "/>
									<input type="hidden" name="yun" value=" "/>
									<input type="hidden" name="goyong" value=" "/>
									<input type="hidden" name="end_pay" value=" "/>
									<input type="hidden" name="minus" value=" "/>
									<input type="hidden" name="m_sum" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_result" value=" "/>

<?
// 리스트 출력
$w_day_sum = 0;
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//데이터 없을시 공백처리
	if(!$row[in_day]) $row[in_day] = "-";
	if(!$row[out_day]) $row[out_day] = "-";
	if(!$row[position_txt]) $row[position_txt] = "-";
	if(!$row[step_txt]) $row[step_txt] = "-";
	if(!$row[work_form]) $row[work_form] = "-";
	if(!$row[dept]) $row[dept] = "-";
	if(!$row[pay_gbn]) {
		$pay_gbn = "-";
	} else {
		if($row[pay_gbn] == 0) $pay_gbn = "월급제";
		else if($row[pay_gbn] == 1) $pay_gbn = "시급제";
		else if($row[pay_gbn] == 2) $pay_gbn = "복합근무";
		else if($row[pay_gbn] == 3) $pay_gbn = "연봉제";
		else $pay_gbn = "-";
	}
	//기준시급 (시급제)
	if($row[pay_gbn] == 1) $money_time_low = $row[money_hour_ds];
	else $money_time_low = 4860; //최저임금

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
	$g_sum = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g5];
	$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7] + $row[b8];
	$m_sum = $row[tax_so] + $row[tax_jumin] + $row[advance_pay] + $row[health] + $row[yoyang] + $row[yun] + $row[goyong] + $row[end_pay] + $row[minus];
	$money_total = $row[money_month] + $row[ext];

	if($i < 6) {

		$w_day_sum = $w_day_sum + $row[w_day];
		//echo $w_day_sum;
		$w_ext_sum = $w_ext_sum + $row[w_ext];
		$w_night_sum = $w_night_sum + $row[w_night];
		$w_hday_sum = $w_hday_sum + $row[w_hday];
		$w_ext_add_sum = $w_ext_add_sum + $row[w_ext_add];
		$w_night_add_sum = $w_night_add_sum + $row[w_night_add];
		$w_hday_add_sum = $w_hday_add_sum + $row[w_hday_add];
		$w_sum_sum = $w_sum_sum + $w_sum;

		$money_time_low_sum = $money_time_low_sum + $money_time_low;
		$money_time_sum = $money_time_sum + $row[money_time];
		$money_month_sum = $money_month_sum + $row[money_month];

		$ext_sum = $ext_sum + $row[ext];
		$night_sum = $night_sum + $row[night];
		$hday_sum = $hday_sum + $row[hday];
		$annual_paid_holiday_sum = $annual_paid_holiday_sum + $row[annual_paid_holiday];
		$ext_add_sum = $ext_add_sum + $row[ext_add];
		$night_add_sum = $night_add_sum + $row[night_add];
		$hday_add_sum = $hday_add_sum + $row[hday_add];
		$s_sum_sum = $s_sum_sum + $s_sum;

		$g1_sum = $g1_sum + $row[g1];
		$g2_sum = $g2_sum + $row[g2];
		$g3_sum = $g3_sum + $row[g3];
		$g4_sum = $g4_sum + $row[g4];
		$g5_sum = $g5_sum + $row[g5];
		$g_sum_sum = $g_sum_sum + $g_sum;

		$b1_sum = $b1_sum + $row[b1];
		$b2_sum = $b2_sum + $row[b2];
		$b3_sum = $b3_sum + $row[b3];
		$b4_sum = $b4_sum + $row[b4];
		$b5_sum = $b5_sum + $row[b5];
		$b6_sum = $b6_sum + $row[b6];
		$b7_sum = $b7_sum + $row[b7];
		$b8_sum = $b8_sum + $row[b8];
		$b_sum_sum = $b_sum_sum + $b_sum;

		$tax_so_sum = $tax_so_sum + $row[tax_so];
		$tax_jumin_sum = $tax_jumin_sum + $row[tax_jumin];
		$advance_pay_sum = $advance_pay_sum + $row[advance_pay];
		$health_sum = $health_sum + $row[health];
		$yoyang_sum = $yoyang_sum + $row[yoyang];
		$yun_sum = $yun_sum + $row[yun];
		$goyong_sum = $goyong_sum + $row[goyong];
		$end_pay_sum = $end_pay_sum + $row[end_pay];
		$minus_sum = $minus_sum + $row[minus];
		$m_sum_sum = $m_sum_sum + $m_sum;
		//echo $m_sum_sum;
		$money_total_sum = $money_total_sum + $row[money_total];
		$money_result_sum = $money_result_sum + $row[money_result];

	} else if($i < 12 && $i > 5) {
		$w_day_sum2 = $w_day_sum2 + $row[w_day];
		$w_ext_sum2 = $w_ext_sum2 + $row[w_ext];
		$w_night_sum2 = $w_night_sum2 + $row[w_night];
		$w_hday_sum2 = $w_hday_sum2 + $row[w_hday];
		$w_ext_add_sum2 = $w_ext_add_sum2 + $row[w_ext_add];
		$w_night_add_sum2 = $w_night_add_sum2 + $row[w_night_add];
		$w_hday_add_sum2 = $w_hday_add_sum2 + $row[w_hday_add];
		$w_sum2_sum2 = $w_sum2_sum2 + $w_sum;

		$money_time_low_sum2 = $money_time_low_sum2 + $money_time_low;
		$money_time_sum2 = $money_time_sum2 + $row[money_time];
		$money_month_sum2 = $money_month_sum2 + $row[money_month];

		$ext_sum2 = $ext_sum2 + $row[ext];
		$night_sum2 = $night_sum2 + $row[night];
		$hday_sum2 = $hday_sum2 + $row[hday];
		$annual_paid_holiday_sum2 = $annual_paid_holiday_sum2 + $row[annual_paid_holiday];
		$ext_add_sum2 = $ext_add_sum2 + $row[ext_add];
		$night_add_sum2 = $night_add_sum2 + $row[night_add];
		$hday_add_sum2 = $hday_add_sum2 + $row[hday_add];
		$s_sum2_sum2 = $s_sum2_sum2 + $s_sum2;

		$g1_sum2 = $g1_sum2 + $row[g1];
		$g2_sum2 = $g2_sum2 + $row[g2];
		$g3_sum2 = $g3_sum2 + $row[g3];
		$g4_sum2 = $g4_sum2 + $row[g4];
		$g5_sum2 = $g5_sum2 + $row[g5];
		$g_sum2_sum2 = $g_sum2_sum2 + $g_sum;

		$b1_sum2 = $b1_sum2 + $row[b1];
		$b2_sum2 = $b2_sum2 + $row[b2];
		$b3_sum2 = $b3_sum2 + $row[b3];
		$b4_sum2 = $b4_sum2 + $row[b4];
		$b5_sum2 = $b5_sum2 + $row[b5];
		$b6_sum2 = $b6_sum2 + $row[b6];
		$b7_sum2 = $b7_sum2 + $row[b7];
		$b8_sum2 = $b8_sum2 + $row[b8];
		$b_sum2_sum2 = $b_sum2_sum2 + $b_sum;

		$tax_so_sum2 = $tax_so_sum2 + $row[tax_so];
		$tax_jumin_sum2 = $tax_jumin_sum2 + $row[tax_jumin];
		$advance_pay_sum2 = $advance_pay_sum2 + $row[advance_pay];
		$health_sum2 = $health_sum2 + $row[health];
		$yoyang_sum2 = $yoyang_sum2 + $row[yoyang];
		$yun_sum2 = $yun_sum2 + $row[yun];
		$goyong_sum2 = $goyong_sum2 + $row[goyong];
		$end_pay_sum2 = $end_pay_sum2 + $row[end_pay];
		$minus_sum2 = $minus_sum2 + $row[minus];
		$m_sum2_sum2 = $m_sum2_sum2 + $m_sum;

		$money_total_sum2 = $money_total_sum2 + $row[money_total];
		$money_result_sum2 = $money_result_sum2 + $row[money_result];

	} else if($i < 18 && $i > 11) {
		$w_day_sum3 = $w_day_sum3 + $row[w_day];
		$w_ext_sum3 = $w_ext_sum3 + $row[w_ext];
		$w_night_sum3 = $w_night_sum3 + $row[w_night];
		$w_hday_sum3 = $w_hday_sum3 + $row[w_hday];
		$w_ext_add_sum3 = $w_ext_add_sum3 + $row[w_ext_add];
		$w_night_add_sum3 = $w_night_add_sum3 + $row[w_night_add];
		$w_hday_add_sum3 = $w_hday_add_sum3 + $row[w_hday_add];
		$w_sum3_sum3 = $w_sum3_sum3 + $w_sum;

		$money_time_low_sum3 = $money_time_low_sum3 + $money_time_low;
		$money_time_sum3 = $money_time_sum3 + $row[money_time];
		$money_month_sum3 = $money_month_sum3 + $row[money_month];

		$ext_sum3 = $ext_sum3 + $row[ext];
		$night_sum3 = $night_sum3 + $row[night];
		$hday_sum3 = $hday_sum3 + $row[hday];
		$annual_paid_holiday_sum3 = $annual_paid_holiday_sum3 + $row[annual_paid_holiday];
		$ext_add_sum3 = $ext_add_sum3 + $row[ext_add];
		$night_add_sum3 = $night_add_sum3 + $row[night_add];
		$hday_add_sum3 = $hday_add_sum3 + $row[hday_add];
		$s_sum3_sum3 = $s_sum3_sum3 + $s_sum3;

		$g1_sum3 = $g1_sum3 + $row[g1];
		$g2_sum3 = $g2_sum3 + $row[g2];
		$g3_sum3 = $g3_sum3 + $row[g3];
		$g4_sum3 = $g4_sum3 + $row[g4];
		$g5_sum3 = $g5_sum3 + $row[g5];
		$g_sum3_sum3 = $g_sum3_sum3 + $g_sum;

		$b1_sum3 = $b1_sum3 + $row[b1];
		$b2_sum3 = $b2_sum3 + $row[b2];
		$b3_sum3 = $b3_sum3 + $row[b3];
		$b4_sum3 = $b4_sum3 + $row[b4];
		$b5_sum3 = $b5_sum3 + $row[b5];
		$b6_sum3 = $b6_sum3 + $row[b6];
		$b7_sum3 = $b7_sum3 + $row[b7];
		$b8_sum3 = $b8_sum3 + $row[b8];
		$b_sum3_sum3 = $b_sum3_sum3 + $b_sum;

		$tax_so_sum3 = $tax_so_sum3 + $row[tax_so];
		$tax_jumin_sum3 = $tax_jumin_sum3 + $row[tax_jumin];
		$advance_pay_sum3 = $advance_pay_sum3 + $row[advance_pay];
		$health_sum3 = $health_sum3 + $row[health];
		$yoyang_sum3 = $yoyang_sum3 + $row[yoyang];
		$yun_sum3 = $yun_sum3 + $row[yun];
		$goyong_sum3 = $goyong_sum3 + $row[goyong];
		$end_pay_sum3 = $end_pay_sum3 + $row[end_pay];
		$minus_sum3 = $minus_sum3 + $row[minus];
		$m_sum3_sum3 = $m_sum3_sum3 + $m_sum;

		$money_total_sum3 = $money_total_sum3 + $row[money_total];
		$money_result_sum3 = $money_result_sum3 + $row[money_result];

	} else if($i < 24 && $i > 17) {
		$w_day_sum4 = $w_day_sum4 + $row[w_day];
		$w_ext_sum4 = $w_ext_sum4 + $row[w_ext];
		$w_night_sum4 = $w_night_sum4 + $row[w_night];
		$w_hday_sum4 = $w_hday_sum4 + $row[w_hday];
		$w_ext_add_sum4 = $w_ext_add_sum4 + $row[w_ext_add];
		$w_night_add_sum4 = $w_night_add_sum4 + $row[w_night_add];
		$w_hday_add_sum4 = $w_hday_add_sum4 + $row[w_hday_add];
		$w_sum4_sum4 = $w_sum4_sum4 + $w_sum;

		$money_time_low_sum4 = $money_time_low_sum4 + $money_time_low;
		$money_time_sum4 = $money_time_sum4 + $row[money_time];
		$money_month_sum4 = $money_month_sum4 + $row[money_month];

		$ext_sum4 = $ext_sum4 + $row[ext];
		$night_sum4 = $night_sum4 + $row[night];
		$hday_sum4 = $hday_sum4 + $row[hday];
		$annual_paid_holiday_sum4 = $annual_paid_holiday_sum4 + $row[annual_paid_holiday];
		$ext_add_sum4 = $ext_add_sum4 + $row[ext_add];
		$night_add_sum4 = $night_add_sum4 + $row[night_add];
		$hday_add_sum4 = $hday_add_sum4 + $row[hday_add];
		$s_sum4_sum4 = $s_sum4_sum4 + $s_sum4;

		$g1_sum4 = $g1_sum4 + $row[g1];
		$g2_sum4 = $g2_sum4 + $row[g2];
		$g3_sum4 = $g3_sum4 + $row[g3];
		$g4_sum4 = $g4_sum4 + $row[g4];
		$g5_sum4 = $g5_sum4 + $row[g5];
		$g_sum4_sum4 = $g_sum4_sum4 + $g_sum;

		$b1_sum4 = $b1_sum4 + $row[b1];
		$b2_sum4 = $b2_sum4 + $row[b2];
		$b3_sum4 = $b3_sum4 + $row[b3];
		$b4_sum4 = $b4_sum4 + $row[b4];
		$b5_sum4 = $b5_sum4 + $row[b5];
		$b6_sum4 = $b6_sum4 + $row[b6];
		$b7_sum4 = $b7_sum4 + $row[b7];
		$b8_sum4 = $b8_sum4 + $row[b8];
		$b_sum4_sum4 = $b_sum4_sum4 + $b_sum;

		$tax_so_sum4 = $tax_so_sum4 + $row[tax_so];
		$tax_jumin_sum4 = $tax_jumin_sum4 + $row[tax_jumin];
		$advance_pay_sum4 = $advance_pay_sum4 + $row[advance_pay];
		$health_sum4 = $health_sum4 + $row[health];
		$yoyang_sum4 = $yoyang_sum4 + $row[yoyang];
		$yun_sum4 = $yun_sum4 + $row[yun];
		$goyong_sum4 = $goyong_sum4 + $row[goyong];
		$end_pay_sum4 = $end_pay_sum4 + $row[end_pay];
		$minus_sum4 = $minus_sum4 + $row[minus];
		$m_sum4_sum4 = $m_sum4_sum4 + $m_sum;

		$money_total_sum4 = $money_total_sum4 + $row[money_total];
		$money_result_sum4 = $money_result_sum4 + $row[money_result];
	}
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="pay_name" value="<?=$row[name]?>"/>
									<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
									<input type="hidden" name="jdate" value="<?=$row[in_day]?>"/>
									<input type="hidden" name="edate" value="<?=$row[out_day]?>"/>
									<input type="hidden" name="position" value="<?=$row[position_txt]?>"/>
									<input type="hidden" name="step" value="<?=$row[step_txt]?>"/>
									<input type="hidden" name="work_form" value="<?=$row[work_form]?> "/>
									<input type="hidden" name="dept" value="<?=$row[dept]?> "/>
									<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?> "/>

									<input type="hidden" name="w_day" value="<?=$row[w_day]?>"/>
									<input type="hidden" name="w_ext" value="<?=$row[w_ext]?>"/>
									<input type="hidden" name="w_night" value="<?=$row[w_night]?>"/>
									<input type="hidden" name="w_hday" value="<?=$row[w_hday]?>"/>
									<input type="hidden" name="w_ext_add" value="<?=$row[w_ext_add]?>"/>
									<input type="hidden" name="w_night_add" value="<?=$row[w_night_add]?>"/>
									<input type="hidden" name="w_hday_add" value="<?=$row[w_hday_add]?>"/>
									<input type="hidden" name="w_sum" value="<?=$w_sum?>"/>

									<input type="hidden" name="money_time_low" value="<?=number_format($money_time_low)?>"/>
									<input type="hidden" name="money_time" value="<?=number_format($row[money_time])?>"/>
									<input type="hidden" name="money_day" value="<?=number_format($row[money_day])?>"/>
									<input type="hidden" name="money_month" value="<?=number_format($row[money_month])?>"/>

									<input type="hidden" name="ext" value="<?=number_format($row[ext])?>"/>
									<input type="hidden" name="night" value="<?=number_format($row[night])?>"/>
									<input type="hidden" name="hday" value="<?=number_format($row[hday])?>"/>
									<input type="hidden" name="ext_add" value="<?=number_format($row[ext_add])?>"/>
									<input type="hidden" name="night_add" value="<?=number_format($row[night_add])?>"/>
									<input type="hidden" name="hday_add" value="<?=number_format($row[hday_add])?>"/>
									<input type="hidden" name="annual_paid_holiday" value="<?=number_format($row[annual_paid_holiday])?>"/>
									<input type="hidden" name="s_sum" value="<?=number_format($s_sum)?>"/>

									<input type="hidden" name="g1" value="<?=number_format($row[g1])?>"/>
									<input type="hidden" name="g2" value="<?=number_format($row[g2])?>"/>
									<input type="hidden" name="g3" value="<?=number_format($row[g3])?>"/>
									<input type="hidden" name="g4" value="<?=number_format($row[g4])?>"/>
									<input type="hidden" name="g5" value="<?=number_format($row[g5])?>"/>
									<input type="hidden" name="g_sum" value="<?=number_format($g_sum)?>"/>

									<input type="hidden" name="b1" value="<?=number_format($row[b1])?>"/>
									<input type="hidden" name="b2" value="<?=number_format($row[b2])?>"/>
									<input type="hidden" name="b3" value="<?=number_format($row[b3])?>"/>
									<input type="hidden" name="b4" value="<?=number_format($row[b4])?>"/>
									<input type="hidden" name="b5" value="<?=number_format($row[b5])?>"/>
									<input type="hidden" name="b6" value="<?=number_format($row[b6])?>"/>
									<input type="hidden" name="b7" value="<?=number_format($row[b7])?>"/>
									<input type="hidden" name="b8" value="<?=number_format($row[b8])?>"/>
									<input type="hidden" name="b_sum" value="<?=number_format($b_sum)?>"/>

									<input type="hidden" name="tax_so" value="<?=number_format($row[tax_so])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row[tax_jumin])?>"/>
									<input type="hidden" name="advance_pay" value="<?=number_format($row[advance_pay])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row[health])?>"/>
									<input type="hidden" name="yoyang" value="<?=number_format($row[yoyang])?>"/>
									<input type="hidden" name="yun" value="<?=number_format($row[yun])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row[goyong])?>"/>
									<input type="hidden" name="end_pay" value="<?=number_format($row[end_pay])?>"/>
									<input type="hidden" name="minus" value="<?=number_format($row[minus])?>"/>
									<input type="hidden" name="m_sum" value="<?=number_format($m_sum)?>"/>

									<input type="hidden" name="money_total" value="<?=number_format($row[money_total])?>"/>
									<input type="hidden" name="money_result" value="<?=number_format($row[money_result])?>"/>
<?
}
//echo $i;
?>

									<input type="hidden" name="pay_count" value="<?=$i?>"/>

<?
//여분 출력 hwp control 셋팅
$k_limit = 24 - $i;
for($k=0;$k<$k_limit;$k++) {
?>
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="jik" value=" "/>
									<input type="hidden" name="jdate" value=" "/>
									<input type="hidden" name="edate" value=" "/>
									<input type="hidden" name="position" value=" "/>
									<input type="hidden" name="step" value=" "/>
									<input type="hidden" name="work_form" value=" "/>
									<input type="hidden" name="dept" value=" "/>
									<input type="hidden" name="pay_gbn" value=" "/>

									<input type="hidden" name="w_day" value=" "/>
									<input type="hidden" name="w_ext" value=" "/>
									<input type="hidden" name="w_night" value=" "/>
									<input type="hidden" name="w_hday" value=" "/>
									<input type="hidden" name="w_ext_add" value=" "/>
									<input type="hidden" name="w_night_add" value=" "/>
									<input type="hidden" name="w_hday_add" value=" "/>
									<input type="hidden" name="w_sum" value=" "/>

									<input type="hidden" name="money_time_low" value=" "/>
									<input type="hidden" name="money_time" value=" "/>
									<input type="hidden" name="money_month" value=" "/>

									<input type="hidden" name="ext" value=" "/>
									<input type="hidden" name="night" value=" "/>
									<input type="hidden" name="hday" value=" "/>
									<input type="hidden" name="annual_paid_holiday" value=" "/>
									<input type="hidden" name="ext_add" value=" "/>
									<input type="hidden" name="night_add" value=" "/>
									<input type="hidden" name="hday_add" value=" "/>
									<input type="hidden" name="s_sum" value=" "/>

									<input type="hidden" name="g1" value=" "/>
									<input type="hidden" name="g2" value=" "/>
									<input type="hidden" name="g3" value=" "/>
									<input type="hidden" name="g4" value=" "/>
									<input type="hidden" name="g5" value=" "/>
									<input type="hidden" name="g_sum" value=" "/>

									<input type="hidden" name="b1" value=" "/>
									<input type="hidden" name="b2" value=" "/>
									<input type="hidden" name="b3" value=" "/>
									<input type="hidden" name="b4" value=" "/>
									<input type="hidden" name="b5" value=" "/>
									<input type="hidden" name="b6" value=" "/>
									<input type="hidden" name="b7" value=" "/>
									<input type="hidden" name="b8" value=" "/>
									<input type="hidden" name="b_sum" value=" "/>

									<input type="hidden" name="tax_so" value=" "/>
									<input type="hidden" name="tax_jumin" value=" "/>
									<input type="hidden" name="advance_pay" value=" "/>
									<input type="hidden" name="health" value=" "/>
									<input type="hidden" name="yoyang" value=" "/>
									<input type="hidden" name="yun" value=" "/>
									<input type="hidden" name="goyong" value=" "/>
									<input type="hidden" name="end_pay" value=" "/>
									<input type="hidden" name="minus" value=" "/>
									<input type="hidden" name="m_sum" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_result" value=" "/>
<?
}
?>
									<input type="hidden" name="w_day_sum" value="<?=number_format($w_day_sum,2)?>"/>
									<input type="hidden" name="w_ext_sum" value="<?=number_format($w_ext_sum,2)?>"/>
									<input type="hidden" name="w_night_sum" value="<?=number_format($w_night_sum,2)?>"/>
									<input type="hidden" name="w_hday_sum" value="<?=number_format($w_hday_sum,2)?>"/>
									<input type="hidden" name="w_ext_add_sum" value="<?=number_format($w_ext_add_sum,2)?>"/>
									<input type="hidden" name="w_night_add_sum" value="<?=number_format($w_night_add_sum,2)?>"/>
									<input type="hidden" name="w_hday_add_sum" value="<?=number_format($w_hday_add_sum,2)?>"/>
									<input type="hidden" name="w_sum_sum" value="<?=number_format($w_sum_sum,2)?>"/>

									<input type="hidden" name="money_time_low_sum" value="<?=number_format($money_time_low_sum)?>"/>
									<input type="hidden" name="money_time_sum" value="<?=number_format($money_time_sum)?>"/>
									<input type="hidden" name="money_month_sum" value="<?=number_format($money_month_sum)?>"/>

									<input type="hidden" name="ext_sum" value="<?=number_format($ext_sum)?>"/>
									<input type="hidden" name="night_sum" value="<?=number_format($night_sum)?>"/>
									<input type="hidden" name="hday_sum" value="<?=number_format($hday_sum)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum" value="<?=number_format($annual_paid_holiday_sum)?>"/>
									<input type="hidden" name="ext_add_sum" value="<?=number_format($ext_add_sum)?>"/>
									<input type="hidden" name="night_add_sum" value="<?=number_format($ext_add_sum)?>"/>
									<input type="hidden" name="hday_add_sum" value="<?=number_format($ext_add_sum)?>"/>
									<input type="hidden" name="s_sum_sum" value="<?=number_format($s_sum_sum)?>"/>

									<input type="hidden" name="g1_sum" value="<?=number_format($g1_sum)?>"/>
									<input type="hidden" name="g2_sum" value="<?=number_format($g2_sum)?>"/>
									<input type="hidden" name="g3_sum" value="<?=number_format($g3_sum)?>"/>
									<input type="hidden" name="g4_sum" value="<?=number_format($g4_sum)?>"/>
									<input type="hidden" name="g5_sum" value="<?=number_format($g5_sum)?>"/>
									<input type="hidden" name="g_sum_sum" value="<?=number_format($g_sum_sum)?>"/>

									<input type="hidden" name="b1_sum" value="<?=number_format($b1_sum)?>"/>
									<input type="hidden" name="b2_sum" value="<?=number_format($b2_sum)?>"/>
									<input type="hidden" name="b3_sum" value="<?=number_format($b3_sum)?>"/>
									<input type="hidden" name="b4_sum" value="<?=number_format($b4_sum)?>"/>
									<input type="hidden" name="b5_sum" value="<?=number_format($b5_sum)?>"/>
									<input type="hidden" name="b6_sum" value="<?=number_format($b6_sum)?>"/>
									<input type="hidden" name="b7_sum" value="<?=number_format($b7_sum)?>"/>
									<input type="hidden" name="b8_sum" value="<?=number_format($b8_sum)?>"/>
									<input type="hidden" name="b_sum_sum" value="<?=number_format($b_sum_sum)?>"/>

									<input type="hidden" name="tax_so_sum" value="<?=number_format($tax_so_sum)?>"/>
									<input type="hidden" name="tax_jumin_sum" value="<?=number_format($tax_jumin_sum)?>"/>
									<input type="hidden" name="advance_pay_sum" value="<?=number_format($advance_pay_sum)?>"/>
									<input type="hidden" name="health_sum" value="<?=number_format($health_sum)?>"/>
									<input type="hidden" name="yoyang_sum" value="<?=number_format($yoyang_sum)?>"/>
									<input type="hidden" name="yun_sum" value="<?=number_format($yun_sum)?>"/>
									<input type="hidden" name="goyong_sum" value="<?=number_format($goyong_sum)?>"/>
									<input type="hidden" name="end_pay_sum" value="<?=number_format($end_pay_sum)?>"/>
									<input type="hidden" name="minus_sum" value="<?=number_format($minus_sum)?>"/>
									<input type="hidden" name="m_sum_sum" value="<?=number_format($m_sum_sum)?>"/>

									<input type="hidden" name="money_total_sum" value="<?=number_format($money_total_sum)?>"/>
									<input type="hidden" name="money_result_sum" value="<?=number_format($money_result_sum)?>"/>

<!--2page-->
									<input type="hidden" name="w_day_sum2" value="<?=number_format($w_day_sum2,2)?>"/>
									<input type="hidden" name="w_ext_sum2" value="<?=number_format($w_ext_sum2,2)?>"/>
									<input type="hidden" name="w_night_sum2" value="<?=number_format($w_night_sum2,2)?>"/>
									<input type="hidden" name="w_hday_sum2" value="<?=number_format($w_hday_sum2,2)?>"/>
									<input type="hidden" name="w_ext_add_sum2" value="<?=number_format($w_ext_add_sum2,2)?>"/>
									<input type="hidden" name="w_night_add_sum2" value="<?=number_format($w_night_add_sum2,2)?>"/>
									<input type="hidden" name="w_hday_add_sum2" value="<?=number_format($w_hday_add_sum2,2)?>"/>
									<input type="hidden" name="w_sum2_sum2" value="<?=number_format($w_sum2_sum2,2)?>"/>

									<input type="hidden" name="money_time_low_sum2" value="<?=number_format($money_time_low_sum2)?>"/>
									<input type="hidden" name="money_time_sum2" value="<?=number_format($money_time_sum2)?>"/>
									<input type="hidden" name="money_month_sum2" value="<?=number_format($money_month_sum2)?>"/>

									<input type="hidden" name="ext_sum2" value="<?=number_format($ext_sum2)?>"/>
									<input type="hidden" name="night_sum2" value="<?=number_format($night_sum2)?>"/>
									<input type="hidden" name="hday_sum2" value="<?=number_format($hday_sum2)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum2" value="<?=number_format($annual_paid_holiday_sum2)?>"/>
									<input type="hidden" name="ext_add_sum2" value="<?=number_format($ext_add_sum2)?>"/>
									<input type="hidden" name="night_add_sum2" value="<?=number_format($ext_add_sum2)?>"/>
									<input type="hidden" name="hday_add_sum2" value="<?=number_format($ext_add_sum2)?>"/>
									<input type="hidden" name="s_sum2_sum2" value="<?=number_format($s_sum2_sum2)?>"/>

									<input type="hidden" name="g1_sum2" value="<?=number_format($g1_sum2)?>"/>
									<input type="hidden" name="g2_sum2" value="<?=number_format($g2_sum2)?>"/>
									<input type="hidden" name="g3_sum2" value="<?=number_format($g3_sum2)?>"/>
									<input type="hidden" name="g4_sum2" value="<?=number_format($g4_sum2)?>"/>
									<input type="hidden" name="g5_sum2" value="<?=number_format($g5_sum2)?>"/>
									<input type="hidden" name="g_sum2_sum2" value="<?=number_format($g_sum2_sum2)?>"/>

									<input type="hidden" name="b1_sum2" value="<?=number_format($b1_sum2)?>"/>
									<input type="hidden" name="b2_sum2" value="<?=number_format($b2_sum2)?>"/>
									<input type="hidden" name="b3_sum2" value="<?=number_format($b3_sum2)?>"/>
									<input type="hidden" name="b4_sum2" value="<?=number_format($b4_sum2)?>"/>
									<input type="hidden" name="b5_sum2" value="<?=number_format($b5_sum2)?>"/>
									<input type="hidden" name="b6_sum2" value="<?=number_format($b6_sum2)?>"/>
									<input type="hidden" name="b7_sum2" value="<?=number_format($b7_sum2)?>"/>
									<input type="hidden" name="b8_sum2" value="<?=number_format($b8_sum2)?>"/>
									<input type="hidden" name="b_sum2_sum2" value="<?=number_format($b_sum2_sum2)?>"/>

									<input type="hidden" name="tax_so_sum2" value="<?=number_format($tax_so_sum2)?>"/>
									<input type="hidden" name="tax_jumin_sum2" value="<?=number_format($tax_jumin_sum2)?>"/>
									<input type="hidden" name="advance_pay_sum2" value="<?=number_format($advance_pay_sum2)?>"/>
									<input type="hidden" name="health_sum2" value="<?=number_format($health_sum2)?>"/>
									<input type="hidden" name="yoyang_sum2" value="<?=number_format($yoyang_sum2)?>"/>
									<input type="hidden" name="yun_sum2" value="<?=number_format($yun_sum2)?>"/>
									<input type="hidden" name="goyong_sum2" value="<?=number_format($goyong_sum2)?>"/>
									<input type="hidden" name="end_pay_sum2" value="<?=number_format($end_pay_sum2)?>"/>
									<input type="hidden" name="minus_sum2" value="<?=number_format($minus_sum2)?>"/>
									<input type="hidden" name="m_sum2_sum2" value="<?=number_format($m_sum2_sum2)?>"/>

									<input type="hidden" name="money_total_sum2" value="<?=number_format($money_total_sum2)?>"/>
									<input type="hidden" name="money_result_sum2" value="<?=number_format($money_result_sum2)?>"/>

<!--3page-->
									<input type="hidden" name="w_day_sum3" value="<?=number_format($w_day_sum3,2)?>"/>
									<input type="hidden" name="w_ext_sum3" value="<?=number_format($w_ext_sum3,2)?>"/>
									<input type="hidden" name="w_night_sum3" value="<?=number_format($w_night_sum3,2)?>"/>
									<input type="hidden" name="w_hday_sum3" value="<?=number_format($w_hday_sum3,2)?>"/>
									<input type="hidden" name="w_ext_add_sum3" value="<?=number_format($w_ext_add_sum3,2)?>"/>
									<input type="hidden" name="w_night_add_sum3" value="<?=number_format($w_night_add_sum3,2)?>"/>
									<input type="hidden" name="w_hday_add_sum3" value="<?=number_format($w_hday_add_sum3,2)?>"/>
									<input type="hidden" name="w_sum3_sum3" value="<?=number_format($w_sum3_sum3,2)?>"/>

									<input type="hidden" name="money_time_low_sum3" value="<?=number_format($money_time_low_sum3)?>"/>
									<input type="hidden" name="money_time_sum3" value="<?=number_format($money_time_sum3)?>"/>
									<input type="hidden" name="money_month_sum3" value="<?=number_format($money_month_sum3)?>"/>

									<input type="hidden" name="ext_sum3" value="<?=number_format($ext_sum3)?>"/>
									<input type="hidden" name="night_sum3" value="<?=number_format($night_sum3)?>"/>
									<input type="hidden" name="hday_sum3" value="<?=number_format($hday_sum3)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum3" value="<?=number_format($annual_paid_holiday_sum3)?>"/>
									<input type="hidden" name="ext_add_sum3" value="<?=number_format($ext_add_sum3)?>"/>
									<input type="hidden" name="night_add_sum3" value="<?=number_format($ext_add_sum3)?>"/>
									<input type="hidden" name="hday_add_sum3" value="<?=number_format($ext_add_sum3)?>"/>
									<input type="hidden" name="s_sum3_sum3" value="<?=number_format($s_sum3_sum3)?>"/>

									<input type="hidden" name="g1_sum3" value="<?=number_format($g1_sum3)?>"/>
									<input type="hidden" name="g2_sum3" value="<?=number_format($g2_sum3)?>"/>
									<input type="hidden" name="g3_sum3" value="<?=number_format($g3_sum3)?>"/>
									<input type="hidden" name="g4_sum3" value="<?=number_format($g4_sum3)?>"/>
									<input type="hidden" name="g5_sum3" value="<?=number_format($g5_sum3)?>"/>
									<input type="hidden" name="g_sum3_sum3" value="<?=number_format($g_sum3_sum3)?>"/>

									<input type="hidden" name="b1_sum3" value="<?=number_format($b1_sum3)?>"/>
									<input type="hidden" name="b2_sum3" value="<?=number_format($b2_sum3)?>"/>
									<input type="hidden" name="b3_sum3" value="<?=number_format($b3_sum3)?>"/>
									<input type="hidden" name="b4_sum3" value="<?=number_format($b4_sum3)?>"/>
									<input type="hidden" name="b5_sum3" value="<?=number_format($b5_sum3)?>"/>
									<input type="hidden" name="b6_sum3" value="<?=number_format($b6_sum3)?>"/>
									<input type="hidden" name="b7_sum3" value="<?=number_format($b7_sum3)?>"/>
									<input type="hidden" name="b8_sum3" value="<?=number_format($b8_sum3)?>"/>
									<input type="hidden" name="b_sum3_sum3" value="<?=number_format($b_sum3_sum3)?>"/>

									<input type="hidden" name="tax_so_sum3" value="<?=number_format($tax_so_sum3)?>"/>
									<input type="hidden" name="tax_jumin_sum3" value="<?=number_format($tax_jumin_sum3)?>"/>
									<input type="hidden" name="advance_pay_sum3" value="<?=number_format($advance_pay_sum3)?>"/>
									<input type="hidden" name="health_sum3" value="<?=number_format($health_sum3)?>"/>
									<input type="hidden" name="yoyang_sum3" value="<?=number_format($yoyang_sum3)?>"/>
									<input type="hidden" name="yun_sum3" value="<?=number_format($yun_sum3)?>"/>
									<input type="hidden" name="goyong_sum3" value="<?=number_format($goyong_sum3)?>"/>
									<input type="hidden" name="end_pay_sum3" value="<?=number_format($end_pay_sum3)?>"/>
									<input type="hidden" name="minus_sum3" value="<?=number_format($minus_sum3)?>"/>
									<input type="hidden" name="m_sum3_sum3" value="<?=number_format($m_sum3_sum3)?>"/>

									<input type="hidden" name="money_total_sum3" value="<?=number_format($money_total_sum3)?>"/>
									<input type="hidden" name="money_result_sum3" value="<?=number_format($money_result_sum3)?>"/>

<!--4page-->
									<input type="hidden" name="w_day_sum4" value="<?=number_format($w_day_sum4,2)?>"/>
									<input type="hidden" name="w_ext_sum4" value="<?=number_format($w_ext_sum4,2)?>"/>
									<input type="hidden" name="w_night_sum4" value="<?=number_format($w_night_sum4,2)?>"/>
									<input type="hidden" name="w_hday_sum4" value="<?=number_format($w_hday_sum4,2)?>"/>
									<input type="hidden" name="w_ext_add_sum4" value="<?=number_format($w_ext_add_sum4,2)?>"/>
									<input type="hidden" name="w_night_add_sum4" value="<?=number_format($w_night_add_sum4,2)?>"/>
									<input type="hidden" name="w_hday_add_sum4" value="<?=number_format($w_hday_add_sum4,2)?>"/>
									<input type="hidden" name="w_sum4_sum4" value="<?=number_format($w_sum4_sum4,2)?>"/>

									<input type="hidden" name="money_time_low_sum4" value="<?=number_format($money_time_low_sum4)?>"/>
									<input type="hidden" name="money_time_sum4" value="<?=number_format($money_time_sum4)?>"/>
									<input type="hidden" name="money_month_sum4" value="<?=number_format($money_month_sum4)?>"/>

									<input type="hidden" name="ext_sum4" value="<?=number_format($ext_sum4)?>"/>
									<input type="hidden" name="night_sum4" value="<?=number_format($night_sum4)?>"/>
									<input type="hidden" name="hday_sum4" value="<?=number_format($hday_sum4)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum4" value="<?=number_format($annual_paid_holiday_sum4)?>"/>
									<input type="hidden" name="ext_add_sum4" value="<?=number_format($ext_add_sum4)?>"/>
									<input type="hidden" name="night_add_sum4" value="<?=number_format($ext_add_sum4)?>"/>
									<input type="hidden" name="hday_add_sum4" value="<?=number_format($ext_add_sum4)?>"/>
									<input type="hidden" name="s_sum4_sum4" value="<?=number_format($s_sum4_sum4)?>"/>

									<input type="hidden" name="g1_sum4" value="<?=number_format($g1_sum4)?>"/>
									<input type="hidden" name="g2_sum4" value="<?=number_format($g2_sum4)?>"/>
									<input type="hidden" name="g3_sum4" value="<?=number_format($g3_sum4)?>"/>
									<input type="hidden" name="g4_sum4" value="<?=number_format($g4_sum4)?>"/>
									<input type="hidden" name="g5_sum4" value="<?=number_format($g5_sum4)?>"/>
									<input type="hidden" name="g_sum4_sum4" value="<?=number_format($g_sum4_sum4)?>"/>

									<input type="hidden" name="b1_sum4" value="<?=number_format($b1_sum4)?>"/>
									<input type="hidden" name="b2_sum4" value="<?=number_format($b2_sum4)?>"/>
									<input type="hidden" name="b3_sum4" value="<?=number_format($b3_sum4)?>"/>
									<input type="hidden" name="b4_sum4" value="<?=number_format($b4_sum4)?>"/>
									<input type="hidden" name="b5_sum4" value="<?=number_format($b5_sum4)?>"/>
									<input type="hidden" name="b6_sum4" value="<?=number_format($b6_sum4)?>"/>
									<input type="hidden" name="b7_sum4" value="<?=number_format($b7_sum4)?>"/>
									<input type="hidden" name="b8_sum4" value="<?=number_format($b8_sum4)?>"/>
									<input type="hidden" name="b_sum4_sum4" value="<?=number_format($b_sum4_sum4)?>"/>

									<input type="hidden" name="tax_so_sum4" value="<?=number_format($tax_so_sum4)?>"/>
									<input type="hidden" name="tax_jumin_sum4" value="<?=number_format($tax_jumin_sum4)?>"/>
									<input type="hidden" name="advance_pay_sum4" value="<?=number_format($advance_pay_sum4)?>"/>
									<input type="hidden" name="health_sum4" value="<?=number_format($health_sum4)?>"/>
									<input type="hidden" name="yoyang_sum4" value="<?=number_format($yoyang_sum4)?>"/>
									<input type="hidden" name="yun_sum4" value="<?=number_format($yun_sum4)?>"/>
									<input type="hidden" name="goyong_sum4" value="<?=number_format($goyong_sum4)?>"/>
									<input type="hidden" name="end_pay_sum4" value="<?=number_format($end_pay_sum4)?>"/>
									<input type="hidden" name="minus_sum4" value="<?=number_format($minus_sum4)?>"/>
									<input type="hidden" name="m_sum4_sum4" value="<?=number_format($m_sum4_sum4)?>"/>

									<input type="hidden" name="money_total_sum4" value="<?=number_format($money_total_sum4)?>"/>
									<input type="hidden" name="money_result_sum4" value="<?=number_format($money_result_sum4)?>"/>


									<!-- 한글 컨트롤 폼 -->
									<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
										<object id="HwpCtrl" width="100%" height="860" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
									</p>
								</form>
							</div>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>			
</div>
<script language="javascript" src="js/pay_preview.js"></script>
</body>
</html>
