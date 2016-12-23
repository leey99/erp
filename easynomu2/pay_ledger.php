<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//현재 년도
$year_now = date("Y");

$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
//사업장 타입
$comp_print_type = $row_a4_opt[comp_print_type];
//강제 K타입 설정
if(!$comp_print_type) $comp_print_type = "K";

$sub_title = "급여대장";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
//echo $sql1;
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
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = ", com_code";
		$sod = "desc";
	} else {
		//echo $sort1;
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name") $sst = ", ".$sort1;
			else $sst = ", ".$sort1;
			$sod = $sod1;
		} else {
			$sst = ", position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", ".$sort2;
		else $sst2 = ", ".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", ".$sort3;
		else $sst3 = ", ".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name") $sst4 = ", ".$sort4;
		else $sst4 = ", ".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", pay_gbn";
		$sod4 = "asc";
	}
}
$sst5 = ", name";
$sod5 = "asc";
//월급제 연봉제 시급제 정렬 -> 급여유형 정렬 안함 150210
//$sst0 = " w_date desc, w_time desc, field(pay_gbn, 0,3,2,1) ";
$sst0 = " w_date desc, w_time desc ";

//급여대장 저장일시
if($dept_code) {
	if($dept_code == 2) $dept_code_sql = " and ( dept_code >= 2 and dept_code <= 6 ) ";
	else $dept_code_sql = " and dept_code = '$dept_code' ";
} else {
	$dept_code_sql = "";
}
if($w_date) {
	$w_date_sql = " and w_date = '$w_date' and w_time = '$w_time' $dept_code_sql ";
}
//급여대장
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' and money_result != 0 $w_date_sql ";
$sql_order = " order by $sst0 $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 $sst5 $sod5 ";
$from_record = 0;
//$rows = 7;

//최근 급여DB 추출
$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
$row = sql_fetch($sql);
$w_date = $row[w_date];
$w_time = $row[w_time];

//급여대장 근로자수
$sql = " select count(*) as cnt
          $sql_common
          $sql_search  and w_date = '$w_date' and w_time ='$w_time' ";
//echo $sql;
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
// 삭제 검사 확인
function del(page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
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
function month_plus() {
	f = document.HwpControl;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var > <?=$year_now?>) {
		alert("<?=$year_now?>년까지 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	//goSearch();
}
function month_minus() {
	f = document.HwpControl;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01" || month_var == "") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
	} else {
		month_var = ""+(toInt(month_var) - 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var < "2013") {
		alert("2013년부터 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	//goSearch();
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
									<!--<input type="hidden" name="w_date" value="<?=$w_date?>">
									<input type="hidden" name="w_time" value="<?=$w_time?>">-->
									<input type="hidden" name="dept_code" value="<?=$dept_code?>">
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
for($i=2013;$i<=$year_now;$i++) {
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
													<div style="padding:0 0 0 2px;display:inline">
														<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
														<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
													</div>
													<input type="submit" value="조회" class="btnblue" />
												</div>
											</td>
											<td>
												사업장명 : <?=$row_a4['com_name']?> / 사업자등록번호 : <?=$row_a4['biz_no']?>
<?
if($dept_code) {
	if($dept_code == 1) echo " / 부서 : 사무직";
	else if($dept_code == 7) echo " / 부서 : 사무직(제외)";
	else if($dept_code == 8) echo " / 부서 : 현장직(제외)";
	else echo " / 부서 : 현장직";
}
echo " / 사원수 : ".$total_count."명";
?>
											</td>
										</tr>
									</table>
									<!--급여대장-->
									<input type="hidden" name="comp_type" value="<?=$comp_print_type?>"/>
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
<?
//주식회사 우리네트워크
if($code == "20182") {
?>
									<input type="hidden" name="b3_text" value="<?=$money_e_txt['e4']?>"/>
<?
} else {
?>
									<input type="hidden" name="b3_text" value="<?=$money_e_txt['e3']?>"/>
<?
}
?>
									<input type="hidden" name="b4_text" value="<?=$money_e_txt['e4']?>"/>
									<input type="hidden" name="b5_text" value="<?=$money_e_txt['e5']?>"/>
									<input type="hidden" name="b6_text" value="<?=$money_e_txt['e6']?>"/>
									<input type="hidden" name="b7_text" value="<?=$money_e_txt['e7']?>"/>
									<input type="hidden" name="b8_text" value="<?=$money_e_txt['e8']?>"/>
									<input type="hidden" name="b9_text" value="<?=$money_e_txt['e9']?>"/>
<?
//기타공제2,3 추가 160308
$minus2_text = " ";
$minus3_text = " ";
//씨앤에스
if($row_a4['biz_no'] == "410-86-38857" || $row_a4['biz_no'] == "321-87-00290") $minus_text="상조회비";
else {
	//포밍, 2~3월 급여대장
	if($comp_print_type == "P" && ($search_month == "02" || $search_month == "03")) {
		$minus_text="연말정산";
		$minus2_text="건강정산";
		$minus3_text="요양정산";
	} else {
		$minus_text="기타공제";
		//노아텍 연말정산 2016년 3월 160321
		if($com_code == 20623 && ($search_year == "2016" && $search_month == "03")) $minus_text="연말정산";
	}
}
?>
									<input type="hidden" name="minus_text" value="<?=$minus_text?>"/>
									<input type="hidden" name="minus2_text" value="<?=$minus2_text?>"/>
									<input type="hidden" name="minus3_text" value="<?=$minus3_text?>"/>

									<!--반복 변수 배열 처리-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
<?
//(주)노아텍
if($com_code == 20623) {
?>
									<input type="hidden" name="employee_no" value=" "/>
<?
}
?>
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
									<input type="hidden" name="w_year" value=" "/>
									<input type="hidden" name="w_etc" value=" "/>

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
									<input type="hidden" name="money_period" value=" "/>
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
									<input type="hidden" name="b9" value=" "/>
									<input type="hidden" name="b_sum" value=" "/>

									<input type="hidden" name="etc" value=" "/>
									<input type="hidden" name="etc2" value=" "/>

									<input type="hidden" name="tax_so" value=" "/>
									<input type="hidden" name="tax_jumin" value=" "/>
									<input type="hidden" name="advance_pay" value=" "/>
									<input type="hidden" name="health" value=" "/>
									<input type="hidden" name="yoyang" value=" "/>
									<input type="hidden" name="yun" value=" "/>
									<input type="hidden" name="goyong" value=" "/>
									<input type="hidden" name="end_pay" value=" "/>
									<input type="hidden" name="minus" value=" "/>
									<input type="hidden" name="minus2" value=" "/>
									<input type="hidden" name="m_sum" value=" "/>

									<input type="hidden" name="c_health" value=" "/>
									<input type="hidden" name="c_yoyang" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_result" value=" "/>

<?
// 리스트 출력
if($comp_print_type == "E" || $comp_print_type == "G") {
	$pay_worker_count = 10;
} else if($comp_print_type == "K" || $comp_print_type == "C" || $comp_print_type == "J" || $comp_print_type == "B") {
	$pay_worker_count = 9;
	if($rows == 54) $row_add = 1;
	else $row_add = 0;
} else if($comp_print_type == "L" || $comp_print_type == "N") {
	$pay_worker_count = 9;
} else {
	$pay_worker_count = 9;
}
$pay_page = ceil($rows / $pay_worker_count) + $row_add;
//사업장 타입에 따른 자바스크립트 호출
//echo $comp_print_type;
if($comp_print_type == "E") {
	$pay_ledger_js = "pay_ledger_e";
} else if($comp_print_type == "G") {
	$pay_ledger_js = "pay_ledger_g";
} else if($comp_print_type == "J") {
	$pay_ledger_js = "pay_ledger_j";
} else if($comp_print_type == "K") {
	$pay_ledger_js = "pay_ledger_k";
} else if($comp_print_type == "L") {
	$pay_ledger_js = "pay_ledger_l";
} else if($comp_print_type == "C") {
	$pay_ledger_js = "pay_ledger_c";
} else if($comp_print_type == "D") {
	$pay_ledger_js = "pay_ledger_d";
} else if($comp_print_type == "B") {
	$pay_ledger_js = "pay_ledger_b";
} else if($comp_print_type == "P") {
	$pay_ledger_js = "pay_ledger_p";
} else if($comp_print_type == "noa") {
	$pay_ledger_js = "pay_ledger_noa";
} else {
	$pay_ledger_js = "pay_ledger";
}
//특정 사업장 : 네오스
//echo $member['mb_id'];
if($member['mb_id'] == "513-16-98675") {
	$pay_ledger_js = "pay_ledger_z";
}
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//비고
	$memo1 = $row['memo1'];
	$memo2 = $row['memo2'];
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
	if($comp_print_type == "K") {
		$money_time_low = $row[money_min_base];
	} else {
		//$money_time_low = $row[money_hour_ds];
		$money_time_low = $row[money_min_base];
	}

	if($row[w_ext] == "") $row[w_ext] = 0;
	if($row[w_ext_add] == "") $row[w_ext_add] = 0;
	if($row[w_night] == "") $row[w_night] = 0;
	if($row[w_hday] == "") $row[w_hday] = 0;
	if($row[w_year] == "") $row[w_year] = 0;

	if($row[hday] == "") $row[hday] = 0;
	if($row[annual_paid_holiday] == "") $row[annual_paid_holiday] = 0;
	if($row[money_period] == "") $row[money_period] = 0;

	//근태공제시간
	$w_etc = ($row[w_late] + $row[w_leave] + $row[w_out] + $row[w_absence]) * (-1);

	//근로시간 계산
	//$w_sum = $row[w_day] + ($row[w_ext]*1.5) + ($row[w_ext_add]*1.5) + ($row[w_night]*0.5) + ($row[w_hday]*1.5);
	//$w_sum = round($w_sum,2);
	$w_sum = $row[workhour_total];
	$s_sum = $row[ext] + $row[ext_add] + $row[night] + $row[hday] + $row[annual_paid_holiday]  + $row[money_period];
	$g_sum = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g5];
	//표준 v2.0 기타수당8,9 제외 150303
	if($comp_print_type != "K") {
		$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7] + $row[b8] + $row[b9];
	} else {
		$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7];
	}
	if($comp_print_type == "D") {
		$m_sum = $row[tax_so] + $row[tax_jumin] + $row[advance_pay] + $row[health] + $row[yoyang] + $row[yun] + $row[goyong] + $row[end_pay] + $row[minus] + $row[minus2]+$row[etc];;
	} else {
		$m_sum = $row[tax_so] + $row[tax_jumin] + $row[advance_pay] + $row[health] + $row[yoyang] + $row[yun] + $row[goyong] + $row[end_pay] + $row[minus] + $row[minus2];
	}
	$money_total = $row[money_month] + $row[ext];

	//6명씩 1페이지씩 (E type : 10명씩)
	$p = ceil(($i+1)/$pay_worker_count);
	//echo $w_day_sum[$p];
	$w_day_sum[$p] = $w_day_sum[$p] + $row[w_day];

	$w_ext_sum[$p] = $w_ext_sum[$p] + $row[w_ext];
	$w_night_sum[$p] = $w_night_sum[$p] + $row[w_night];
	$w_hday_sum[$p] = $w_hday_sum[$p] + $row[w_hday];
	$w_year_sum[$p] = $w_year_sum[$p] + $row[w_year];
	$w_etc_sum[$p] = $w_etc_sum[$p] + $w_etc;

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
	$money_period_sum[$p] = $money_period_sum[$p] + $row[money_period];
	$ext_add_sum[$p] = $ext_add_sum[$p] + $row[ext_add];
	$night_add_sum[$p] = $night_add_sum[$p] + $row[night_add];
	$hday_add_sum[$p] = $hday_add_sum[$p] + $row[hday_add];
	$s_sum_sum[$p] = $s_sum_sum[$p] + $s_sum;

	$g1_sum[$p] = $g1_sum[$p] + $row[g1];
	$g2_sum[$p] = $g2_sum[$p] + $row[g2];
	$g3_sum[$p] = $g3_sum[$p] + $row[g3];
	$g4_sum[$p] = $g4_sum[$p] + $row[g4];
	$g5_sum[$p] = $g5_sum[$p] + $row[g5];
	$g_sum_sum[$p] = $g_sum_sum[$p] + $g_sum;

	$b1_sum[$p] = $b1_sum[$p] + $row[b1];
	$b2_sum[$p] = $b2_sum[$p] + $row[b2];
	$b3_sum[$p] = $b3_sum[$p] + $row[b3];
	$b4_sum[$p] = $b4_sum[$p] + $row[b4];
	$b5_sum[$p] = $b5_sum[$p] + $row[b5];
	$b6_sum[$p] = $b6_sum[$p] + $row[b6];
	$b7_sum[$p] = $b7_sum[$p] + $row[b7];
	$b8_sum[$p] = $b8_sum[$p] + $row[b8];
	$b9_sum[$p] = $b9_sum[$p] + $row[b9];
	$b_sum_sum[$p] = $b_sum_sum[$p] + $b_sum;

	$etc_sum[$p] = $etc_sum[$p] + $row[etc];
	$etc2_sum[$p] = $etc2_sum[$p] + $row[etc2];

	$tax_so_sum[$p] = $tax_so_sum[$p] + $row[tax_so];
	$tax_jumin_sum[$p] = $tax_jumin_sum[$p] + $row[tax_jumin];
	$advance_pay_sum[$p] = $advance_pay_sum[$p] + $row[advance_pay];
	$health_sum[$p] = $health_sum[$p] + $row[health];
	$yoyang_sum[$p] = $yoyang_sum[$p] + $row[yoyang];
	$yun_sum[$p] = $yun_sum[$p] + $row[yun];
	$goyong_sum[$p] = $goyong_sum[$p] + $row[goyong];
	$end_pay_sum[$p] = $end_pay_sum[$p] + $row[end_pay];
	$minus_sum[$p] = $minus_sum[$p] + $row[minus];
	$minus2_sum[$p] = $minus2_sum[$p] + $row[minus2];
	$m_sum_sum[$p] = $m_sum_sum[$p] + $m_sum;

	$c_health_sum[$p] = $c_health_sum[$p] + $row[c_health];
	$c_yoyang_sum[$p] = $c_yoyang_sum[$p] + $row[c_yoyang];

	$money_total_sum[$p] = $money_total_sum[$p] + $row[money_total];
	$money_result_sum[$p] = $money_result_sum[$p] + $row[money_result];

	//E type 휴일근로 = 휴일근로 + 추가휴일
	if($comp_print_type == "E") {
		$w_hday = $row[w_hday] + $row[w_hday_add];
		$w_night = $row[w_night] + $row[w_night_add];
		$hday = $row[hday] + $row[hday_add];
		$night = $row[night] + $row[night_add];
	} else if($comp_print_type == "G") {
		$w_hday = $row[w_hday] + $row[w_hday_add];
		$w_night = $row[w_night] + $row[w_night_add];
		$hday = $row[hday] + $row[hday_add];
		$night = $row[night] + $row[night_add];
	} else {
		$w_hday = $row[w_hday];
		$w_night = $row[w_night];
		$hday = $row[hday];
		$night = $row[night];
	}
	//연차수당(기본값) 특근수당(계명전자)
	$w_year = $row[w_year];
	//직위 글자수 제한
	if($row[position_txt]) {
		$position_txt = $row[position_txt];
		$position_txt_len = strlen($position_txt);
		if($position_txt_len > 8) $position_txt = cut_str($position_txt, 6, "..");
	}
	//부서 글자수 제한
	if($row[dept]) {
		$dept = $row[dept];
		$dept_len = strlen($dept);
		if($dept_len > 14) $dept = cut_str($dept, 12, "..");
	} else {
		$dept = "-";
	}
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="pay_name" value="<?=$row[name]?>"/>
<?
//(주)노아텍
if($com_code == 20623) {
	$sql_staff = " select * from $g4[pibohum_base] where com_code='$com_code' and sabun='$row[sabun]' ";
	$result_staff = sql_query($sql_staff);
	$row_staff = mysql_fetch_array($result_staff);
?>
									<input type="hidden" name="employee_no" value="<?=$row_staff['employee_no']?>"/>
<?
}
?>
									<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
									<input type="hidden" name="jdate" value="<?=$row[in_day]?>"/>
									<input type="hidden" name="edate" value="<?=$row[out_day]?>"/>
									<input type="hidden" name="position" value="<?=$position_txt?>"/>
									<input type="hidden" name="step" value="<?=$row[step_txt]?>"/>
									<input type="hidden" name="work_form" value="<?=$row[work_form]?> "/>
									<input type="hidden" name="dept" value="<?=$dept?>"/>
									<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?> "/>

									<input type="hidden" name="w_day" value="<?=$row[w_day]?>"/>
									<input type="hidden" name="w_ext" value="<?=$row[w_ext]?>"/>
									<input type="hidden" name="w_night" value="<?=$w_night?>"/>
									<input type="hidden" name="w_hday" value="<?=$w_hday?>"/>
									<input type="hidden" name="w_year" value="<?=$w_year?>"/>
									<input type="hidden" name="w_etc" value="<?=$w_etc?>"/>

									<input type="hidden" name="w_ext_add" value="<?=$row[w_ext_add]?>"/>
									<input type="hidden" name="w_night_add" value="<?=$row[w_night_add]?>"/>
									<input type="hidden" name="w_hday_add" value="<?=$row[w_hday_add]?>"/>
									<input type="hidden" name="w_sum" value="<?=$w_sum?>"/>
<?
	if($comp_print_type == "K") {
?>
									<input type="hidden" name="money_time_low" value="<?=number_format($row[money_min_base])?>"/>
<? } else { ?>
									<input type="hidden" name="money_time_low" value="<?=number_format($money_time_low)?>"/>
<? } ?>
									<input type="hidden" name="money_time" value="<?=number_format($row[money_time])?>"/>
									<input type="hidden" name="money_day" value="<?=number_format($row[money_day])?>"/>
									<input type="hidden" name="money_month" value="<?=number_format($row[money_month])?>"/>

									<input type="hidden" name="ext" value="<?=number_format($row[ext])?>"/>
									<input type="hidden" name="night" value="<?=number_format($night)?>"/>
									<input type="hidden" name="hday" value="<?=number_format($hday)?>"/>
									<input type="hidden" name="ext_add" value="<?=number_format($row[ext_add])?>"/>
									<input type="hidden" name="night_add" value="<?=number_format($row[night_add])?>"/>
									<input type="hidden" name="hday_add" value="<?=number_format($row[hday_add])?>"/>
									<input type="hidden" name="annual_paid_holiday" value="<?=number_format($row[annual_paid_holiday])?>"/>
									<input type="hidden" name="money_period" value="<?=number_format($row[money_period])?>"/>
									<input type="hidden" name="s_sum" value="<?=number_format($s_sum)?>"/>

									<input type="hidden" name="g1" value="<?=number_format($row[g1])?>"/>
									<input type="hidden" name="g2" value="<?=number_format($row[g2])?>"/>
									<input type="hidden" name="g3" value="<?=number_format($row[g3])?>"/>
									<input type="hidden" name="g4" value="<?=number_format($row[g4])?>"/>
									<input type="hidden" name="g5" value="<?=number_format($row[g5])?>"/>
									<input type="hidden" name="g_sum" value="<?=number_format($g_sum)?>"/>

									<input type="hidden" name="b1" value="<?=number_format($row[b1])?>"/>
									<input type="hidden" name="b2" value="<?=number_format($row[b2])?>"/>
<?
//주식회사 우리네트워크
if($code == "20182") {
?>
									<input type="hidden" name="b3" value="<?=number_format($row[b4])?>"/>
<?
} else {
?>
									<input type="hidden" name="b3" value="<?=number_format($row[b3])?>"/>
<?
}
?>
									<input type="hidden" name="b4" value="<?=number_format($row[b4])?>"/>
									<input type="hidden" name="b5" value="<?=number_format($row[b5])?>"/>
									<input type="hidden" name="b6" value="<?=number_format($row[b6])?>"/>
									<input type="hidden" name="b7" value="<?=number_format($row[b7])?>"/>
									<input type="hidden" name="b8" value="<?=number_format($row[b8])?>"/>
									<input type="hidden" name="b9" value="<?=number_format($row[b9])?>"/>
									<input type="hidden" name="b_sum" value="<?=number_format($b_sum)?>"/>

									<input type="hidden" name="etc" value="<?=number_format($row[etc])?>"/>
									<input type="hidden" name="etc2" value="<?=number_format($row[etc2]*(-1))?>"/>

									<input type="hidden" name="tax_so" value="<?=number_format($row[tax_so])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row[tax_jumin])?>"/>
									<input type="hidden" name="advance_pay" value="<?=number_format($row[advance_pay])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row[health])?>"/>
									<input type="hidden" name="yoyang" value="<?=number_format($row[yoyang])?>"/>
									<input type="hidden" name="yun" value="<?=number_format($row[yun])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row[goyong])?>"/>
									<input type="hidden" name="end_pay" value="<?=number_format($row[end_pay])?>"/>
									<input type="hidden" name="minus" value="<?=number_format($row[minus])?>"/>
									<input type="hidden" name="minus2" value="<?=number_format($row[minus2])?>"/>
									<input type="hidden" name="m_sum" value="<?=number_format($m_sum)?>"/>

									<input type="hidden" name="c_health" value="<?=number_format($row[c_health])?>"/>
									<input type="hidden" name="c_yoyang" value="<?=number_format($row[c_yoyang])?>"/>

									<input type="hidden" name="money_total" value="<?=number_format($row[money_total])?>"/>
									<input type="hidden" name="money_result" value="<?=number_format($row[money_result])?>"/>
<?
}
//echo $i;
if($i == 0) alert("해당 년월의 급여대장은 존재하지 않습니다.");
?>
									<input type="hidden" name="pay_count" value="<?=$i?>"/>
									<input type="hidden" name="pay_page" value="<?=$pay_page?>"/>
<?
//여분 출력 hwp control 셋팅
$tr_count = $pay_page * $pay_worker_count;
$k_limit = $tr_count - $i;
for($k=0;$k<$k_limit;$k++) {
?>
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
<?
//(주)노아텍
if($com_code == 20623) {
?>
									<input type="hidden" name="employee_no" value=" "/>
<?
}
?>
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
									<input type="hidden" name="w_year" value=" "/>
									<input type="hidden" name="w_etc" value=" "/>

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
									<input type="hidden" name="money_period" value=" "/>
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
									<input type="hidden" name="b9" value=" "/>
									<input type="hidden" name="b_sum" value=" "/>

									<input type="hidden" name="etc" value=" "/>
									<input type="hidden" name="etc2" value=" "/>

									<input type="hidden" name="tax_so" value=" "/>
									<input type="hidden" name="tax_jumin" value=" "/>
									<input type="hidden" name="advance_pay" value=" "/>
									<input type="hidden" name="health" value=" "/>
									<input type="hidden" name="yoyang" value=" "/>
									<input type="hidden" name="yun" value=" "/>
									<input type="hidden" name="goyong" value=" "/>
									<input type="hidden" name="end_pay" value=" "/>
									<input type="hidden" name="minus" value=" "/>
									<input type="hidden" name="minus2" value=" "/>
									<input type="hidden" name="m_sum" value=" "/>

									<input type="hidden" name="c_health" value=" "/>
									<input type="hidden" name="c_yoyang" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_result" value=" "/>
<?
}
?>

<?
for($i=1;$i<=$pay_page;$i++) {
?>
									<input type="hidden" name="w_day_sum" value="<?=number_format($w_day_sum[$i],2)?>"/>
									<input type="hidden" name="w_ext_sum" value="<?=number_format($w_ext_sum[$i],2)?>"/>
									<input type="hidden" name="w_night_sum" value="<?=number_format($w_night_sum[$i],2)?>"/>
									<input type="hidden" name="w_hday_sum" value="<?=number_format($w_hday_sum[$i],2)?>"/>
									<input type="hidden" name="w_year_sum" value="<?=number_format($w_year_sum[$i],2)?>"/>
									<input type="hidden" name="w_etc_sum" value="<?=number_format($w_etc_sum[$i],2)?>"/>

									<input type="hidden" name="w_ext_add_sum" value="<?=number_format($w_ext_add_sum[$i],2)?>"/>
									<input type="hidden" name="w_night_add_sum" value="<?=number_format($w_night_add_sum[$i],2)?>"/>
									<input type="hidden" name="w_hday_add_sum" value="<?=number_format($w_hday_add_sum[$i],2)?>"/>
									<input type="hidden" name="w_sum_sum" value="<?=number_format($w_sum_sum[$i],2)?>"/>

									<input type="hidden" name="money_time_low_sum" value="<?=number_format($money_time_low_sum[$i])?>"/>
									<input type="hidden" name="money_time_sum" value="<?=number_format($money_time_sum[$i])?>"/>
									<input type="hidden" name="money_month_sum" value="<?=number_format($money_month_sum[$i])?>"/>

									<input type="hidden" name="ext_sum" value="<?=number_format($ext_sum[$i])?>"/>
									<input type="hidden" name="night_sum" value="<?=number_format($night_sum[$i])?>"/>
									<input type="hidden" name="hday_sum" value="<?=number_format($hday_sum[$i])?>"/>
									<input type="hidden" name="annual_paid_holiday_sum" value="<?=number_format($annual_paid_holiday_sum[$i])?>"/>
									<input type="hidden" name="money_period_sum" value="<?=number_format($money_period_sum[$i])?>"/>
									<input type="hidden" name="ext_add_sum" value="<?=number_format($ext_add_sum[$i])?>"/>
									<input type="hidden" name="night_add_sum" value="<?=number_format($ext_add_sum[$i])?>"/>
									<input type="hidden" name="hday_add_sum" value="<?=number_format($ext_add_sum[$i])?>"/>
									<input type="hidden" name="s_sum_sum" value="<?=number_format($s_sum_sum[$i])?>"/>

									<input type="hidden" name="g1_sum" value="<?=number_format($g1_sum[$i])?>"/>
									<input type="hidden" name="g2_sum" value="<?=number_format($g2_sum[$i])?>"/>
									<input type="hidden" name="g3_sum" value="<?=number_format($g3_sum[$i])?>"/>
									<input type="hidden" name="g4_sum" value="<?=number_format($g4_sum[$i])?>"/>
									<input type="hidden" name="g5_sum" value="<?=number_format($g5_sum[$i])?>"/>
									<input type="hidden" name="g_sum_sum" value="<?=number_format($g_sum_sum[$i])?>"/>

									<input type="hidden" name="b1_sum" value="<?=number_format($b1_sum[$i])?>"/>
									<input type="hidden" name="b2_sum" value="<?=number_format($b2_sum[$i])?>"/>
									<input type="hidden" name="b3_sum" value="<?=number_format($b3_sum[$i])?>"/>
									<input type="hidden" name="b4_sum" value="<?=number_format($b4_sum[$i])?>"/>
									<input type="hidden" name="b5_sum" value="<?=number_format($b5_sum[$i])?>"/>
									<input type="hidden" name="b6_sum" value="<?=number_format($b6_sum[$i])?>"/>
									<input type="hidden" name="b7_sum" value="<?=number_format($b7_sum[$i])?>"/>
									<input type="hidden" name="b8_sum" value="<?=number_format($b8_sum[$i])?>"/>
									<input type="hidden" name="b9_sum" value="<?=number_format($b9_sum[$i])?>"/>
									<input type="hidden" name="b_sum_sum" value="<?=number_format($b_sum_sum[$i])?>"/>

									<input type="hidden" name="etc_sum" value="<?=number_format($etc_sum[$i])?>"/>
									<input type="hidden" name="etc2_sum" value="<?=number_format($etc2_sum[$i]*(-1))?>"/>

									<input type="hidden" name="tax_so_sum" value="<?=number_format($tax_so_sum[$i])?>"/>
									<input type="hidden" name="tax_jumin_sum" value="<?=number_format($tax_jumin_sum[$i])?>"/>
									<input type="hidden" name="advance_pay_sum" value="<?=number_format($advance_pay_sum[$i])?>"/>
									<input type="hidden" name="health_sum" value="<?=number_format($health_sum[$i])?>"/>
									<input type="hidden" name="yoyang_sum" value="<?=number_format($yoyang_sum[$i])?>"/>
									<input type="hidden" name="yun_sum" value="<?=number_format($yun_sum[$i])?>"/>
									<input type="hidden" name="goyong_sum" value="<?=number_format($goyong_sum[$i])?>"/>
									<input type="hidden" name="end_pay_sum" value="<?=number_format($end_pay_sum[$i])?>"/>
									<input type="hidden" name="minus_sum" value="<?=number_format($minus_sum[$i])?>"/>
									<input type="hidden" name="minus2_sum" value="<?=number_format($minus2_sum[$i])?>"/>
									<input type="hidden" name="m_sum_sum" value="<?=number_format($m_sum_sum[$i])?>"/>

									<input type="hidden" name="c_health_sum" value="<?=number_format($c_health_sum[$i])?>"/>
									<input type="hidden" name="c_yoyang_sum" value="<?=number_format($c_yoyang_sum[$i])?>"/>

									<input type="hidden" name="money_total_sum" value="<?=number_format($money_total_sum[$i])?>"/>
									<input type="hidden" name="money_result_sum" value="<?=number_format($money_result_sum[$i])?>"/>
<?
	//총계 계산
	$w_day_sum_t += $w_day_sum[$i];
	$w_ext_sum_t += $w_ext_sum[$i];
	$w_night_sum_t += $w_night_sum[$i];
	$w_hday_sum_t += $w_hday_sum[$i];
	$w_year_sum_t += $w_year_sum[$i];
	$w_etc_sum_t += $w_etc_sum[$i];
	$w_ext_add_sum_t += $w_ext_add_sum[$i];
	$w_night_add_sum_t += $w_night_add_sum[$i];
	$w_hday_add_sum_t += $w_hday_add_sum[$i];
	$w_sum_sum_t += $w_sum_sum[$i];
	$money_time_low_sum_t += $money_time_low_sum[$i];
	$money_time_sum_t += $money_time_sum[$i];
	$money_month_sum_t += $money_month_sum[$i];
	$ext_sum_t += $ext_sum[$i];
	$night_sum_t += $night_sum[$i];
	$hday_sum_t += $hday_sum[$i];
	$annual_paid_holiday_sum_t += $annual_paid_holiday_sum[$i];
	$money_period_sum_t += $money_period_sum[$i];
	$ext_add_sum_t += $ext_add_sum[$i];
	$night_add_sum_t += $night_add_sum[$i];
	$hday_add_sum_t += $hday_add_sum[$i];
	$s_sum_sum_t += $s_sum_sum[$i];
	$g1_sum_t += $g1_sum[$i];
	$g2_sum_t += $g2_sum[$i];
	$g3_sum_t += $g3_sum[$i];
	$g4_sum_t += $g4_sum[$i];
	$g5_sum_t += $g5_sum[$i];
	$g_sum_sum_t += $g_sum_sum[$i];
	$b1_sum_t += $b1_sum[$i];
	$b2_sum_t += $b2_sum[$i];
	$b3_sum_t += $b3_sum[$i];
	$b4_sum_t += $b4_sum[$i];
	$b5_sum_t += $b5_sum[$i];
	$b6_sum_t += $b6_sum[$i];
	$b7_sum_t += $b7_sum[$i];
	$b8_sum_t += $b8_sum[$i];
	$b9_sum_t += $b9_sum[$i];
	$b_sum_sum_t += $b_sum_sum[$i];

	$etc_sum_t += $etc_sum[$i];
	$etc2_sum_t += $etc2_sum[$i];

	$tax_so_sum_t += $tax_so_sum[$i];
	$tax_jumin_sum_t += $tax_jumin_sum[$i];
	$advance_pay_sum_t += $advance_pay_sum[$i];
	$health_sum_t += $health_sum[$i];
	$yoyang_sum_t += $yoyang_sum[$i];
	$yun_sum_t += $yun_sum[$i];
	$goyong_sum_t += $goyong_sum[$i];
	$end_pay_sum_t += $end_pay_sum[$i];
	$minus_sum_t += $minus_sum[$i];
	$minus2_sum_t += $minus2_sum[$i];
	$m_sum_sum_t += $m_sum_sum[$i];

	$c_health_sum_t += $c_health_sum[$i];
	$c_yoyang_sum_t += $c_yoyang_sum[$i];

	$money_total_sum_t += $money_total_sum[$i];
	$money_result_sum_t += $money_result_sum[$i];
}
?>
									<!-- 배열용 -->
									<input type="hidden" name="w_day_sum" value=""/>
									<input type="hidden" name="w_ext_sum" value=""/>
									<input type="hidden" name="w_night_sum" value=""/>
									<input type="hidden" name="w_hday_sum" value=""/>
									<input type="hidden" name="w_year_sum" value=""/>
									<input type="hidden" name="w_etc_sum" value=""/>

									<input type="hidden" name="w_ext_add_sum" value=""/>
									<input type="hidden" name="w_night_add_sum" value=""/>
									<input type="hidden" name="w_hday_add_sum" value=""/>
									<input type="hidden" name="w_sum_sum" value=""/>

									<input type="hidden" name="money_time_low_sum" value=""/>
									<input type="hidden" name="money_time_sum" value=""/>
									<input type="hidden" name="money_month_sum" value=""/>

									<input type="hidden" name="ext_sum" value=""/>
									<input type="hidden" name="night_sum" value=""/>
									<input type="hidden" name="hday_sum" value=""/>
									<input type="hidden" name="annual_paid_holiday_sum" value=""/>
									<input type="hidden" name="money_period_sum" value=""/>
									<input type="hidden" name="ext_add_sum" value=""/>
									<input type="hidden" name="night_add_sum" value=""/>
									<input type="hidden" name="hday_add_sum" value=""/>
									<input type="hidden" name="s_sum_sum" value=""/>

									<input type="hidden" name="g1_sum" value=""/>
									<input type="hidden" name="g2_sum" value=""/>
									<input type="hidden" name="g3_sum" value=""/>
									<input type="hidden" name="g4_sum" value=""/>
									<input type="hidden" name="g5_sum" value=""/>
									<input type="hidden" name="g_sum_sum" value=""/>

									<input type="hidden" name="b1_sum" value=""/>
									<input type="hidden" name="b2_sum" value=""/>
									<input type="hidden" name="b3_sum" value=""/>
									<input type="hidden" name="b4_sum" value=""/>
									<input type="hidden" name="b5_sum" value=""/>
									<input type="hidden" name="b6_sum" value=""/>
									<input type="hidden" name="b7_sum" value=""/>
									<input type="hidden" name="b8_sum" value=""/>
									<input type="hidden" name="b9_sum" value=""/>
									<input type="hidden" name="b_sum_sum" value=""/>

									<input type="hidden" name="etc_sum" value=""/>
									<input type="hidden" name="etc2_sum" value=""/>

									<input type="hidden" name="tax_so_sum" value=""/>
									<input type="hidden" name="tax_jumin_sum" value=""/>
									<input type="hidden" name="advance_pay_sum" value=""/>
									<input type="hidden" name="health_sum" value=""/>
									<input type="hidden" name="yoyang_sum" value=""/>
									<input type="hidden" name="yun_sum" value=""/>
									<input type="hidden" name="goyong_sum" value=""/>
									<input type="hidden" name="end_pay_sum" value=""/>
									<input type="hidden" name="minus_sum" value=""/>
									<input type="hidden" name="minus_sum2" value=""/>
									<input type="hidden" name="m_sum_sum" value=""/>

									<input type="hidden" name="c_health_sum" value=""/>
									<input type="hidden" name="c_yoyang_sum" value=""/>

									<input type="hidden" name="money_total_sum" value=""/>
									<input type="hidden" name="money_result_sum" value=""/>

									<!-- 총계 -->
									<input type="hidden" name="w_day_sum_t" value="<?=number_format($w_day_sum_t,2)?>"/>
									<input type="hidden" name="w_ext_sum_t" value="<?=number_format($w_ext_sum_t,2)?>"/>
									<input type="hidden" name="w_night_sum_t" value="<?=number_format($w_night_sum_t,2)?>"/>
									<input type="hidden" name="w_hday_sum_t" value="<?=number_format($w_hday_sum_t,2)?>"/>
									<input type="hidden" name="w_year_sum_t" value="<?=number_format($w_year_sum_t,2)?>"/>
									<input type="hidden" name="w_etc_sum_t" value="<?=number_format($w_etc_sum_t,2)?>"/>

									<input type="hidden" name="w_ext_add_sum_t" value="<?=number_format($w_ext_add_sum_t,2)?>"/>
									<input type="hidden" name="w_night_add_sum_t" value="<?=number_format($w_night_add_sum_t,2)?>"/>
									<input type="hidden" name="w_hday_add_sum_t" value="<?=number_format($w_hday_add_sum_t,2)?>"/>
									<input type="hidden" name="w_sum_sum_t" value="<?=number_format($w_sum_sum_t,2)?>"/>

									<input type="hidden" name="money_time_low_sum_t" value="<?=number_format($money_time_low_sum_t)?>"/>
									<input type="hidden" name="money_time_sum_t" value="<?=number_format($money_time_sum_t)?>"/>
									<input type="hidden" name="money_month_sum_t" value="<?=number_format($money_month_sum_t)?>"/>

									<input type="hidden" name="ext_sum_t" value="<?=number_format($ext_sum_t)?>"/>
									<input type="hidden" name="night_sum_t" value="<?=number_format($night_sum_t)?>"/>
									<input type="hidden" name="hday_sum_t" value="<?=number_format($hday_sum_t)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum_t" value="<?=number_format($annual_paid_holiday_sum_t)?>"/>
									<input type="hidden" name="money_period_sum_t" value="<?=number_format($money_period_sum_t)?>"/>
									<input type="hidden" name="ext_add_sum_t" value="<?=number_format($ext_add_sum_t)?>"/>
									<input type="hidden" name="night_add_sum_t" value="<?=number_format($ext_add_sum_t)?>"/>
									<input type="hidden" name="hday_add_sum_t" value="<?=number_format($ext_add_sum_t)?>"/>
									<input type="hidden" name="s_sum_sum_t" value="<?=number_format($s_sum_sum_t)?>"/>

									<input type="hidden" name="g1_sum_t" value="<?=number_format($g1_sum_t)?>"/>
									<input type="hidden" name="g2_sum_t" value="<?=number_format($g2_sum_t)?>"/>
									<input type="hidden" name="g3_sum_t" value="<?=number_format($g3_sum_t)?>"/>
									<input type="hidden" name="g4_sum_t" value="<?=number_format($g4_sum_t)?>"/>
									<input type="hidden" name="g5_sum_t" value="<?=number_format($g5_sum_t)?>"/>
									<input type="hidden" name="g_sum_sum_t" value="<?=number_format($g_sum_sum_t)?>"/>

									<input type="hidden" name="b1_sum_t" value="<?=number_format($b1_sum_t)?>"/>
									<input type="hidden" name="b2_sum_t" value="<?=number_format($b2_sum_t)?>"/>
									<input type="hidden" name="b3_sum_t" value="<?=number_format($b3_sum_t)?>"/>
									<input type="hidden" name="b4_sum_t" value="<?=number_format($b4_sum_t)?>"/>
									<input type="hidden" name="b5_sum_t" value="<?=number_format($b5_sum_t)?>"/>
									<input type="hidden" name="b6_sum_t" value="<?=number_format($b6_sum_t)?>"/>
									<input type="hidden" name="b7_sum_t" value="<?=number_format($b7_sum_t)?>"/>
									<input type="hidden" name="b8_sum_t" value="<?=number_format($b8_sum_t)?>"/>
									<input type="hidden" name="b9_sum_t" value="<?=number_format($b9_sum_t)?>"/>
									<input type="hidden" name="b_sum_sum_t" value="<?=number_format($b_sum_sum_t)?>"/>

									<input type="hidden" name="etc_sum_t" value="<?=number_format($etc_sum_t)?>"/>
									<input type="hidden" name="etc2_sum_t" value="<?=number_format($etc2_sum_t*(-1))?>"/>

									<input type="hidden" name="tax_so_sum_t" value="<?=number_format($tax_so_sum_t)?>"/>
									<input type="hidden" name="tax_jumin_sum_t" value="<?=number_format($tax_jumin_sum_t)?>"/>
									<input type="hidden" name="advance_pay_sum_t" value="<?=number_format($advance_pay_sum_t)?>"/>
									<input type="hidden" name="health_sum_t" value="<?=number_format($health_sum_t)?>"/>
									<input type="hidden" name="yoyang_sum_t" value="<?=number_format($yoyang_sum_t)?>"/>
									<input type="hidden" name="yun_sum_t" value="<?=number_format($yun_sum_t)?>"/>
									<input type="hidden" name="goyong_sum_t" value="<?=number_format($goyong_sum_t)?>"/>
									<input type="hidden" name="end_pay_sum_t" value="<?=number_format($end_pay_sum_t)?>"/>
									<input type="hidden" name="minus_sum_t" value="<?=number_format($minus_sum_t)?>"/>
									<input type="hidden" name="minus2_sum_t" value="<?=number_format($minus2_sum_t)?>"/>
									<input type="hidden" name="m_sum_sum_t" value="<?=number_format($m_sum_sum_t)?>"/>

									<input type="hidden" name="c_health_sum_t" value="<?=number_format($c_health_sum_t)?>"/>
									<input type="hidden" name="c_yoyang_sum_t" value="<?=number_format($c_yoyang_sum_t)?>"/>

									<input type="hidden" name="money_total_sum_t" value="<?=number_format($money_total_sum_t)?>"/>
									<input type="hidden" name="money_result_sum_t" value="<?=number_format($money_result_sum_t)?>"/>

									<input type="hidden" name="memo1" value="<?=$memo1?>"/>
									<input type="hidden" name="memo2" value="<?=$memo2?>"/>
									<!-- 한글 컨트롤 폼 -->
									<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
										<object id="HwpCtrl" width="100%" height="1100" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
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
<script language="javascript" src="js/<?=$pay_ledger_js?>.js"></script>
</body>
</html>
