<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] ";

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}

//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (work_form like '$stx_work_form%') ";
	$sql_search .= " ) ";
}

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sabun";
	}
	$sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 18;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "급여반영";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 12;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//급여반영 테이블 넓이
$pay_list_width = 2480;

//급여관리 DB (급여반영) 년월
$sql_w_date = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$result_w_date = sql_query($sql_w_date);
$row_w_date=mysql_fetch_array($result_w_date);
//echo $sql_w_date;
if($row_w_date[w_date]) {
	$w_date = $row_w_date[w_date];
	$w_date_ok = "1";
} else {
	$w_date = "해당월 급여 미등록";
	$w_date_ok = "";
}
//급여지급일
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
if($row_com_opt[pay_day]) {
	if($search_month == 12) {
		$pay_date = "1월 ".$row_com_opt[pay_day]."일";
	} else {
		$pay_date = ($search_month+1)."월 ".$row_com_opt[pay_day]."일";
	}
} else {
	$pay_date = "급여지급일 미지정";
}
?>
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
function goInput(){
	var f = document.dataForm;
	/*
	if( f.jigub_day.value == "" ){
		alert("지급일을 입력해 주세요.");
		f.jigub_day.focus();
		return;
	}
	*/
	//alert(f.money_month[1].value);
	//alert(<?=$total_count?>);
	//alert(f.w_day.value);
	//w_day = document.getElementsByTagName("w_day[]").;
	//alert(w_day.value);

	//f["w_day_"+0].value = f.workhour_day[1].value;
	//alert(f["w_day_"+0].value);

	for(i=1;i<=<?=$total_count?>;i++) {
		//alert(f.emp_name[i].value);
		k = i-1;
		//alert(f.workhour_day[i].value);
		f["w_day_"+k].value = f.workhour_day[i].value;
		f["w_ext_"+k].value = f.workhour_ext[i].value;
		f["w_night_"+k].value = f.workhour_night[i].value;
		f["w_hday_"+k].value = f.workhour_hday[i].value;

		f["w_ext_add_"+k].value = f.workhour_ext_add[i].value;
		f["w_night_add_"+k].value = f.workhour_night_add[i].value;
		f["w_hday_add_"+k].value = f.workhour_hday_add[i].value;

		f["workhour_total_"+k].value = f.workhour_total[i].value;
		//alert(f["workhour_total_"+k].value);

		f["money_time_"+k].value = f.money_hour_ts[i].value;
		//f["money_day_"+k].value = f.money_day[i].value;
		f["money_month_"+k].value = f.money_base[i].value;

		f["g1_"+k].value = f.money_g1[i].value;
		f["g2_"+k].value = f.money_g2[i].value;
		f["g3_"+k].value = f.money_g3[i].value;
		f["g4_"+k].value = f.money_g4[i].value;
		f["g5_"+k].value = f.money_g5[i].value;

		f["ext_"+k].value = f.money_ext[i].value;
		f["ext_add_"+k].value = f.money_ext_add[i].value;
		f["night_"+k].value = f.money_night[i].value;
		f["hday_"+k].value = f.money_hday[i].value;
		f["annual_paid_holiday_"+k].value = f.money_year[i].value;

		f["e1_"+k].value = f.money_e1[i].value;
		f["e2_"+k].value = f.money_e2[i].value;
		f["e3_"+k].value = f.money_e3[i].value;
		f["e4_"+k].value = f.money_e4[i].value;
		f["e5_"+k].value = f.money_e5[i].value;
		f["e6_"+k].value = f.money_e6[i].value;
		f["e7_"+k].value = f.money_e7[i].value;
		f["e8_"+k].value = f.money_e8[i].value;

		f["tax_so_var_"+k].value = f.tax_so[i].value;
		f["tax_jumin_var_"+k].value = f.tax_jumin[i].value;
		f["advance_pay_"+k].value = f.advance_pay[i].value;
		f["health_"+k].value = f.money_health[i].value;
		f["yoyang_"+k].value = f.money_yoyang[i].value;
		f["yun_"+k].value = f.money_yun[i].value;
		f["goyong_"+k].value = f.money_goyong[i].value;
		//f["end_pay_"+k].value = f.end_pay[i].value;
		//f["minus_"+k].value = f.minus[i].value;

		f["money_total_"+k].value = f.money_total[i].value;
		f["money_for_tax_"+k].value = f.money_for_tax[i].value;
		f["money_gongje_"+k].value = f.money_gongje[i].value;
		f["money_result_"+k].value = f.money_result[i].value;
	}

	f.mode.value = "input";
	f.action = "pay_update.php";
	f.submit();
}
//급여반영 입력폼
var ary_tax = new Array();
<?
include "./inc/ary_tax.php";
?>
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");
	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};
	function onClose(calendar) {
		calendar.hide();
		calendar.destroy();
	};
}
function checkAll(){
	var f = document.dataForm;
	for( var i = 1; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function GetTax(money_for_tax) {
	//alert(money_for_tax); //460000
	var i, money_base, smoney, emoney, tax, tax_result
	money_base = parseInt( money_for_tax / 1000 )
	tax_result = 0
	//alert(money_base); //460
	//alert(ary_tax.length);
	for( var i=0; i <ary_tax.length; i++ ){
	//for( var i=0; i <10; i++ ){
		smoney = ary_tax[i][0];
		emoney = ary_tax[i][1];
		tax = ary_tax[i][2];
		//alert(smoney);
		if( money_base >= smoney && money_base < emoney ) {
			tax_result = tax;
			break;
		}
	}
	return tax_result;
}
function cal_pay(idx) {
	var f = document.dataForm;
	var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_g_sum, money_b_sum, money_e_sum;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,money_gongje,money_result, workhour_year;
	money_month     = toInt(f.money_month   [idx].value);    //기본월급 mm--        
	money_hour      = toInt(f.money_hour    [idx].value); 	//기준시급 hh--        
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)     
	workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간         
	workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간

	workhour_ext_add    = toFloat(f.workhour_ext_add  [idx].value);	//추가연장근로시간
	workhour_night_add    = toFloat(f.workhour_night_add  [idx].value);	//추가야간근로시간
	workhour_hday_add    = toFloat(f.workhour_hday_add  [idx].value);	//추가휴일근로시간

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
	week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
	money_base      = toInt(f.money_base    [idx].value);	// 기본급               
	money_ext       = toInt(f.money_ext     [idx].value);	// 연장근로수당
	money_hday      = toInt(f.money_hday    [idx].value);	// 휴일근로수당
	money_night     = toInt(f.money_night   [idx].value);	// 야간근로수당
	money_week      = toInt(f.money_week    [idx].value);	// 주휴수당 hh--
	money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--
	money_g1        = toInt(f.money_g1      [idx].value);
	money_g2        = toInt(f.money_g2      [idx].value);
	money_g3        = toInt(f.money_g3      [idx].value);
	money_g4        = toInt(f.money_g4      [idx].value);
	money_g5        = toInt(f.money_g5      [idx].value);
	money_e1        = toInt(f.money_e1      [idx].value);
	money_e2        = toInt(f.money_e2      [idx].value);
	money_e3        = toInt(f.money_e3      [idx].value);
	money_e4        = toInt(f.money_e4      [idx].value);
	money_e5        = toInt(f.money_e5      [idx].value);
	money_e6        = toInt(f.money_e6      [idx].value);
	money_e7        = toInt(f.money_e7      [idx].value);
	money_e8        = toInt(f.money_e8      [idx].value);
	money_total     = toInt(f.money_total   [idx].value);   //임금계       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득     
	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
	tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세       
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
	workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ) { // 5인이하
		rate_ext = 1;
		rate_hday = 1;
		rate_night = 1;
	}else{
		rate_ext = 1.5;
		rate_hday = 1.5;
		rate_night = 0.5;
	}

	//수당 합계
	money_g_sum = money_g1+money_g2+money_g3+money_g4+money_g5;
	//alert(money_g_sum+"="+money_g1+"+"+money_g2+"+"+money_g3+"+"+money_g4+"+"+money_g5);
	money_e_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;

	//workhour_total 임금산출 총시간 mm-- // 직원등록시 계산법과 다른데?
	workhour_total =  workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year;

	//money_base 기본급
	//money_base = money_month - money_ext - money_hday - money_night - money_year;
	money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
	//money_hour_ts 통상임금(시간급) 
	if( workhour_total != 0 ){
		//money_hour_ts = ( money_month + money_g1 + money_g2 + money_g3 ) / workhour_total;
		//money_hour_ts = ( money_month - money_g1 - money_g2 - money_g3) / workhour_total;
		//money_hour_ts = ( money_month - money_g_sum ) / workhour_total;
		//alert(money_hour_ts+"=("+money_month+"-"+money_g_sum+")/"+workhour_total);
		money_hour_ts = ( money_month - money_g_sum ) / workhour_day;
		//alert(money_hour_ts+"=("+money_month+"-"+money_g_sum+")/"+workhour_day);
	}
	//기본급 수동입력
	//alert(f.check_money_min_yn[idx].value);
	if(f.check_money_min_yn[idx].value == "Y") {
		money_base = toInt(f.money_hour_ms[idx].value);
		money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
		//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
		//alert(money_base);
	}
	//money_ext 연장근로수당 
	money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
	//money_night 야간근로수당
	money_night = Math.round(workhour_night * money_hour_ts * rate_night);
	//money_hday 휴일근로수당
	money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
	//추가근로수당
	money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
	money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
	money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
	//money_year 연차수당
	money_year = Math.round(workhour_year * money_hour_ts );

	//통상임금(시간급) 반올림
	money_hour_ts = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//기본급 계산식
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);
	//money_total 임금계 
	//money_total = money_month+money_g_sum+money_e_sum;
	money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_g_sum + money_e_sum);
	//money_for_tax 과세소득 
	//money_for_tax = money_total - money_g1 - money_g2 - money_g3;
	money_for_tax = money_total - money_e_sum;
	//money_yun 국민연금  
//		money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10
	money_yun = get_round( parseInt(money_for_tax) * 0.045 );
	//money_health 건강보험 
//		money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
	money_health = get_round(money_for_tax* 0.02945);
	//money_yoyang 장기요양보험 
//		money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
	money_yoyang = get_round(money_health* 0.0655 );
	//alert(money_yoyang);
	//money_goyong 고용보험
	money_goyong = get_round(money_for_tax* 0.0065 );
	//tax_so 소득세 
	tax_so = GetTax( money_for_tax );
	//tax_jumin 주민세 
	tax_jumin = get_round(tax_so* 0.1 );
	//money_gongje 공제계 
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin;
	//money_result 공제후 지급액 
	money_result = money_total - money_gongje;

	//소수점 2자리 반올림
	workhour_total = workhour_total.toFixed(2);
	money_hour_ts = money_hour_ts.toFixed(2);
	//alert(money_hour_ts);

	//천단위 구분
	money_hour_ts = number_format(money_hour_ts);
	money_base = number_format(money_base);
	money_ext = number_format(money_ext);
	money_hday = number_format(money_hday);
	money_night = number_format(money_night);
	money_year = number_format(money_year);

	//money_hour_ts = number_format(money_hour_ts);

	money_total = number_format(money_total);
	money_for_tax = number_format(money_for_tax);

	money_yun = number_format(money_yun);
	money_health = number_format(money_health);
	money_yoyang = number_format(money_yoyang);
	money_goyong = number_format(money_goyong);
	tax_so = number_format(tax_so);
	tax_jumin = number_format(tax_jumin);
	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//변수 input 입력
	f.money_hour_ts[idx].value = money_hour_ts //money_hour_ts 통상임금(시간급) 
	f.workhour_total[idx].value = workhour_total //workhour_total 임금산출 총시간 mm--
	f.money_base[idx].value = money_base //money_base 기본급
	f.money_ext[idx].value = money_ext //money_ext 연장근로수당 
	f.money_hday[idx].value = money_hday //money_hday 휴일근로수당 
	f.money_night[idx].value = money_night //money_night 야간근로수당 
	f.money_year[idx].value = money_year //money_year 연차수당 ------------------------
	f.money_total[idx].value = money_total //money_total 임금계 
	f.money_for_tax[idx].value = money_for_tax //money_for_tax 과세소득 
	f.money_yun[idx].value = money_yun //money_yun 국민연금 
	f.money_health[idx].value = money_health //money_health 건강보험 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang 장기요양보험 
	f.money_goyong[idx].value = money_goyong //money_goyong 고용보험 
	f.tax_so[idx].value = tax_so //tax_so 소득세 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin 주민세 
	f.money_gongje[idx].value = money_gongje //money_gongje 공제계 
	f.money_result[idx].value = money_result //money_result 공제후 지급액 
}
function cal_pay2(idx){
	var f = document.dataForm;
	var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,money_gongje,money_result, workhour_year;
	money_month     = toInt(f.money_month   [idx].value);    //기본월급 mm--        
	money_hour      = toInt(f.money_hour    [idx].value); 	//기준시급 hh--        
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)     
	workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간
	workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간         
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간         

	workhour_ext_add    = toFloat(f.workhour_ext_add  [idx].value);	//추가연장근로시간
	workhour_night_add    = toFloat(f.workhour_night_add  [idx].value);	//추가야간근로시간
	workhour_hday_add    = toFloat(f.workhour_hday_add  [idx].value);	//추가휴일근로시간

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
	week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
	money_base      = toInt(f.money_base    [idx].value);	// 기본급               
	money_ext       = toInt(f.money_ext     [idx].value);	// 연장근로수당         
	money_hday      = toInt(f.money_hday    [idx].value);	// 휴일근로수당         
	money_night     = toInt(f.money_night   [idx].value);	// 야간근로수당         
	money_week      = toInt(f.money_week    [idx].value);	// 주휴수당 hh--        
	money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--        
	money_g1        = toInt(f.money_g1      [idx].value);
	money_g2        = toInt(f.money_g2      [idx].value);
	money_g3        = toInt(f.money_g3      [idx].value);
	money_g4        = toInt(f.money_g4      [idx].value);
	money_g5        = toInt(f.money_g5      [idx].value);
	money_e1        = toInt(f.money_e1      [idx].value);
	money_e2        = toInt(f.money_e2      [idx].value);
	money_e3        = toInt(f.money_e3      [idx].value);
	money_e4        = toInt(f.money_e4      [idx].value);
	money_e5        = toInt(f.money_e5      [idx].value);
	money_e6        = toInt(f.money_e6      [idx].value);
	money_e7        = toInt(f.money_e7      [idx].value);
	money_e8        = toInt(f.money_e8      [idx].value);
	money_total     = toInt(f.money_total   [idx].value);   //임금계       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득     
	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
	tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세       
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
	workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
	//money_gongje 공제계 = 국민연금+건강보험+장기요양보험+고용보험+소득세+주민세
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin;
	//money_result 공제후 지급액 
	money_result = money_total - money_gongje;
	f.money_gongje[idx].value = money_gongje; //money_gongje 공제계 
	f.money_result[idx].value = money_result; //money_result 공제후 지급액 
}
function cal_pay3(idx) {
	var f = document.dataForm;
	var tax_so,tax_jumin;
	tax_so = toInt(f.tax_so[idx].value); //소득세
	//tax_jumin 주민세 
	tax_jumin = parseInt(tax_so*0.1*0.1)*10;
	f.tax_jumin[idx].value = tax_jumin;
	cal_pay2(idx); // 공제후 지급액 재계산
}
function focusInClass(idx) {
	var frm = document.dataForm;
	//frm.emp_pname[idx].className = "textfm_trans";
	frm.money_month[idx].className = "textfm_trans";
	frm.workhour_day[idx].className = "textfm_trans";
	frm.workhour_ext[idx].className = "textfm_trans";
	frm.workhour_night[idx].className = "textfm_trans";
	frm.workhour_hday[idx].className = "textfm_trans";

	frm.workhour_ext_add[idx].className = "textfm_trans";
	frm.workhour_night_add[idx].className = "textfm_trans";
	frm.workhour_hday_add[idx].className = "textfm_trans";

	frm.workhour_total[idx].className = "textfm5";
	frm.money_hour_ts[idx].className = "textfm5";
	frm.money_base[idx].className = "textfm5";
	frm.money_ext[idx].className = "textfm5";
	frm.money_hday[idx].className = "textfm5";
	frm.money_night[idx].className = "textfm5";
	frm.money_g1[idx].className = "textfm_trans";
	frm.money_g2[idx].className = "textfm_trans";
	frm.money_g3[idx].className = "textfm_trans";
	frm.money_g4[idx].className = "textfm_trans";
	frm.money_g5[idx].className = "textfm_trans";
	frm.money_e1[idx].className = "textfm_trans";
	frm.money_e2[idx].className = "textfm_trans";
	frm.money_e3[idx].className = "textfm_trans";
	frm.money_e4[idx].className = "textfm_trans";
	frm.money_e5[idx].className = "textfm_trans";
	frm.money_e6[idx].className = "textfm_trans";
	frm.money_e7[idx].className = "textfm_trans";
	frm.money_e8[idx].className = "textfm_trans";
	frm.money_total[idx].className = "textfm5";
	frm.money_for_tax[idx].className = "textfm5";
	frm.money_yun[idx].className = "textfm_trans";
	frm.money_health[idx].className = "textfm_trans";
	frm.money_yoyang[idx].className = "textfm_trans";
	frm.money_goyong[idx].className = "textfm_trans";
	frm.tax_so[idx].className = "textfm_trans";
	frm.tax_jumin[idx].className = "textfm_trans";
	frm.money_gongje[idx].className = "textfm5";
	frm.money_result[idx].className = "textfm5";
	frm.workhour_year[idx].className = "textfm_trans";
}
function focusOutClass(idx) {
	var frm = document.dataForm;
	//frm.emp_pname[idx].className = "textfm";
	frm.money_month[idx].className = "textfm";
	frm.workhour_day[idx].className = "textfm";
	frm.workhour_ext[idx].className = "textfm";
	frm.workhour_night[idx].className = "textfm";
	frm.workhour_hday[idx].className = "textfm";

	frm.workhour_ext_add[idx].className = "textfm";
	frm.workhour_night_add[idx].className = "textfm";
	frm.workhour_hday_add[idx].className = "textfm";

	frm.workhour_total[idx].className = "textfm5";
	frm.money_hour_ts[idx].className = "textfm5";
	frm.money_base[idx].className = "textfm5";
	frm.money_ext[idx].className = "textfm5";
	frm.money_hday[idx].className = "textfm5";
	frm.money_night[idx].className = "textfm5";
	frm.money_g1[idx].className = "textfm";
	frm.money_g2[idx].className = "textfm";
	frm.money_g3[idx].className = "textfm";
	frm.money_g4[idx].className = "textfm";
	frm.money_g5[idx].className = "textfm";
	frm.money_e1[idx].className = "textfm";
	frm.money_e2[idx].className = "textfm";
	frm.money_e3[idx].className = "textfm";
	frm.money_e4[idx].className = "textfm";
	frm.money_e5[idx].className = "textfm";
	frm.money_e6[idx].className = "textfm";
	frm.money_e7[idx].className = "textfm";
	frm.money_e8[idx].className = "textfm";
	frm.money_total[idx].className = "textfm5";
	frm.money_for_tax[idx].className = "textfm5";
	frm.money_yun[idx].className = "textfm";
	frm.money_health[idx].className = "textfm";
	frm.money_yoyang[idx].className = "textfm";
	frm.money_goyong[idx].className = "textfm";
	frm.tax_so[idx].className = "textfm";
	frm.tax_jumin[idx].className = "textfm";
	frm.money_gongje[idx].className = "textfm5";
	frm.money_result[idx].className = "textfm5";
	frm.workhour_year[idx].className = "textfm";
}
var copy_idx = -1;
function copyData(idx) {
	var frm = document.dataForm;
	copy_idx = idx;
	alert("복사되었습니다.");
	return;
}
function pasteData(idx) {
	var frm = document.dataForm;
	if (copy_idx == -1)
	{
		alert("복사된 정보가 없습니다.");
		return;
	}
	frm.money_month[idx].value = frm.money_month[copy_idx].value;
	frm.workhour_day[idx].value = frm.workhour_day[copy_idx].value;
	frm.workhour_ext[idx].value = frm.workhour_ext[copy_idx].value;
	frm.workhour_night[idx].value = frm.workhour_night[copy_idx].value;
	frm.workhour_hday[idx].value = frm.workhour_hday[copy_idx].value;

	frm.workhour_ext_add[idx].value = frm.workhour_ext_add[copy_idx].value;
	frm.workhour_night_add[idx].value = frm.workhour_night_add[copy_idx].value;
	frm.workhour_hday_add[idx].value = frm.workhour_hday_add[copy_idx].value;

	frm.workhour_total[idx].value = frm.workhour_total[copy_idx].value;
	frm.money_hour_ts[idx].value = frm.money_hour_ts[copy_idx].value;
	frm.money_base[idx].value = frm.money_base[copy_idx].value;
	frm.money_ext[idx].value = frm.money_ext[copy_idx].value;
	frm.money_hday[idx].value = frm.money_hday[copy_idx].value;
	frm.money_night[idx].value = frm.money_night[copy_idx].value;
	frm.money_g1[idx].value = frm.money_g1[copy_idx].value;
	frm.money_g2[idx].value = frm.money_g2[copy_idx].value;
	frm.money_g3[idx].value = frm.money_g3[copy_idx].value;
	frm.money_g4[idx].value = frm.money_g4[copy_idx].value;
	frm.money_g5[idx].value = frm.money_g5[copy_idx].value;
	frm.money_e1[idx].value = frm.money_e1[copy_idx].value;
	frm.money_e2[idx].value = frm.money_e2[copy_idx].value;
	frm.money_e3[idx].value = frm.money_e3[copy_idx].value;
	frm.money_e4[idx].value = frm.money_e4[copy_idx].value;
	frm.money_e5[idx].value = frm.money_e5[copy_idx].value;
	frm.money_e6[idx].value = frm.money_e6[copy_idx].value;
	frm.money_e7[idx].value = frm.money_e7[copy_idx].value;
	frm.money_e8[idx].value = frm.money_e8[copy_idx].value;
	frm.money_total[idx].value = frm.money_total[copy_idx].value;
	frm.money_for_tax[idx].value = frm.money_for_tax[copy_idx].value;
	frm.money_yun[idx].value = frm.money_yun[copy_idx].value;
	frm.money_health[idx].value = frm.money_health[copy_idx].value;
	frm.money_yoyang[idx].value = frm.money_yoyang[copy_idx].value;
	frm.money_goyong[idx].value = frm.money_goyong[copy_idx].value;
	frm.tax_so[idx].value = frm.tax_so[copy_idx].value;
	frm.tax_jumin[idx].value = frm.tax_jumin[copy_idx].value;
	frm.money_gongje[idx].value = frm.money_gongje[copy_idx].value;
	frm.money_result[idx].value = frm.money_result[copy_idx].value;
	frm.money_year[idx].value = frm.money_year[copy_idx].value;
	frm.workhour_year[idx].value = frm.workhour_year[copy_idx].value;
}
function goDelete() {
	var f = document.dataForm;
	iCheckCount = 0;
	for( var i=0; i<f.idx.length; i++ ) {
		if( f.idx[i].checked ) {
			iCheckCount++;
		}
	}
	if( iCheckCount == 0 ) {
		alert("삭제할 항목을 선택해 주세요.");
		return;
	}
	if( confirm("삭제하시겠습니까?") ) {
		f.mode.value = "delete";
		f.action = "pay_delete.php";
		f.submit();
	}
}
function addEmp(add_work_numb) {
	var f = document.searchForm;
	f.add_work_numb.value = add_work_numb;
	f.action = "";
	f.submit();
}
function printPaySome() {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("저장 후 이용해 주세요.");
		return;
	}
	var f = document.dataForm;
	var pay_no = "";
	for(var i=0; i < f.idx.length; i++) {
		if( f.idx[i].checked ){
			pay_no += (pay_no==""?"":",") + f.pay_no[i].value;
		}
	}
	if( pay_no == "" ) {
		alert("출력할 대상을 선택해 주세요.");
		return;
	} else if(stristr(pay_no, ',')) {
		alert("한명만 선택해 주세요.");
		return;
	}
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function printPayList(){
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
	frm.submit();
}
function stristr (haystack, needle, bool) {
  var pos = 0;
  haystack += '';
  pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
  if (pos == -1) {
    return false;
  } else {
    if (bool) {
      return haystack.substr(0, pos);
    } else {
      return haystack.slice(pos);
    }
  }
}

//number_format 함수
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
</script>


<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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

							<!--급여반영 입력폼-->
							<iframe name="hframe" src="" style="width:0;height:0;border:0"></iframe>
							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
							</form>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_01_0"> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="./images/g_tab_on_lt.gif"></td> 
												<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
												<a href="#">검색</a>
												</td> 
												<td><img src="./images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->
							<!--검색 -->
							<form name="searchForm" method="post">
								<input type="hidden" name="select_type" value="">
								<input type="hidden" name="search_pay_gbn" value="01">
								<input type="hidden" name="add_work_numb">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="15%">
									<col width="10%">
									<col width="45%">
									<col width="20%">
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">임금대장</td>
										<td class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<2015;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="goSearch();">
<?
for($i=1;$i<13;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_month) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 월
										</td>
										<td nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;">
												<tr>
													<td width=2></td><td><img src=images/btn9_lt.gif></td>
													<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td>
												</tr>
											</table> 
										</td>
										<td nowrap class="tdrow">
											<b>급여지급일</b> : <?=$pay_date?>  / <b>최종저장일</b> : <?=$w_date?>
										</td>
										<td nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:cal_pay_bt();" target="">자동계산</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_demo();";
	$url_paysome = "javascript:alert_demo();";
	$url_paylist = "javascript:alert_demo();";
} else {
	$url_save = "javascript:goInput();";
	$url_paysome = "javascript:printPaySome();";
	$url_paylist = "javascript:printPayList();";
}
?>
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">급여저장</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<!--검색 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="mode">
								<input type="hidden" name="code" value="<?=$com_code?>">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="total_count" value="<?=$total_count?>">
								<input type="hidden" name="search_pay_gbn" value="01">
								<!--댑메뉴 -->
								<table width="100%" border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id="Tab_cust_tab_01_0"> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="./images/g_tab_on_lt.gif"></td> 
													<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
													<a href="#">급여입력</a>
													</td> 
													<td><img src="./images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td align="right" style="padding-right:10"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<!--리스트 -->
								<table width="2700" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td width="200" height="84" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
												<col width="10%">
												<col width="">
												<col width="35%">
												<col width="25%">
												<tr>
													<td nowrap height="84" align="center" style="background-color:rgb(226, 226, 226);"><input type="checkbox" name="checkall" onclick="checkAll();"></td></td>
													<td nowrap class="tdhead_center">이름</td>
													<td nowrap class="tdhead_center">입사일</td>
													<td nowrap class="tdhead_center">직위</td>
												</tr>
											</table>
										</td>
										<td nowrap class="" valign="top">
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
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
																<tr>
																<td class="tdhead_center" colspan="10">결정급여 및 약정근로시간(월) </td>
																<td class="tdhead_center" colspan="23">기본급 및 제수당 </td>
																<td class="tdhead_center" colspan="8">공제액</td>
																<td class="tdhead_center" rowspan="4">공제후<br>지급액 </td>
																</tr>
																<tr>
																<td class="tdhead_center" rowspan="3">결정임금</td>
																<td class="tdhead_center" colspan="4">약정근로시간</td>
																<td class="tdhead_center" colspan="3">추가근로시간</td>
																<td class="tdhead_center" rowspan="3">임금산출 총시간 </td>
																<td class="tdhead_center" rowspan="3">통상임금(시간급)</td>
																<td class="tdhead_center" colspan="8">기본월급</td>
																<td class="tdhead_center" colspan="13">제수당</td>
																<td class="tdhead_center" rowspan="3">임금계</td>
																<td class="tdhead_center" rowspan="3">과세소득</td>
																<td class="tdhead_center" rowspan="3">국민연금</td>
																<td class="tdhead_center" rowspan="3">건강보험</td>
																<td class="tdhead_center" rowspan="3">장기요양</td>
																<td class="tdhead_center" rowspan="3">고용보험</td>
																<td class="tdhead_center" rowspan="3">소득세</td>
																<td class="tdhead_center" rowspan="3">주민세</td>
																<td class="tdhead_center" rowspan="3">기타공제</td>
																<td class="tdhead_center" rowspan="3">공제계</td>
																</tr>
																<tr>
																<td class="tdhead_center" rowspan="2">소정<br>근로시간</td>
																<td class="tdhead_center" rowspan="2">기본연장<br>근로시간</td>
																<td class="tdhead_center" rowspan="2">야간<br>근로시간</td>
																<td class="tdhead_center" rowspan="2">휴일<br>근로시간</td>

																<td class="tdhead_center" rowspan="2">추가연장<br>근로시간</td>
																<td class="tdhead_center" rowspan="2">추가야간<br>근로시간</td>
																<td class="tdhead_center" rowspan="2">추가휴일<br>근로시간</td>

																<td class="tdhead_center" rowspan="2">기본급</td>
																<td class="tdhead_center" colspan="7">법정수당(과세)</td>
																<td class="tdhead_center" colspan="5">통상임금</td>
																<td class="tdhead_center" colspan="8">기타수당</td>
																</tr>
																<tr>
																<td class="tdhead_center">연장근로</td>
																<td class="tdhead_center">야간근로</td>
																<td class="tdhead_center">휴일근로</td>
																<td class="tdhead_center">추가연장</td>
																<td class="tdhead_center">추가야간</td>
																<td class="tdhead_center">추가휴일</td>
																<td class="tdhead_center">연차휴가</td>
																<td class="tdhead_center"><input type="text" name="g1" class="textfm" style="width:100%;" value="<?=$money_g_txt['g1']?>"></td>
																<td class="tdhead_center"><input type="text" name="g2" class="textfm" style="width:100%;" value="<?=$money_g_txt['g2']?>"></td>
																<td class="tdhead_center"><input type="text" name="g3" class="textfm" style="width:100%;" value="<?=$money_g_txt['g3']?>"></td>
																<td class="tdhead_center"><input type="text" name="g4" class="textfm" style="width:100%;" value="<?=$money_g_txt['g4']?>"></td>
																<td class="tdhead_center"><input type="text" name="g5" class="textfm" style="width:100%;" value="<?=$money_g_txt['g5']?>"></td>
																<td class="tdhead_center"><input type="text" name="b1" class="textfm" style="width:100%;" value="<?=$money_e_txt['e1']?>"></td>
																<td class="tdhead_center"><input type="text" name="b2" class="textfm" style="width:100%;" value="<?=$money_e_txt['e2']?>"></td>
																<td class="tdhead_center"><input type="text" name="b3" class="textfm" style="width:100%;" value="<?=$money_e_txt['e3']?>"></td>
																<td class="tdhead_center"><input type="text" name="b4" class="textfm" style="width:100%;" value="<?=$money_e_txt['e4']?>"></td>
																<td class="tdhead_center"><input type="text" name="b5" class="textfm" style="width:100%;" value="<?=$money_e_txt['e5']?>"></td>
																<td class="tdhead_center"><input type="text" name="b6" class="textfm" style="width:100%;" value="<?=$money_e_txt['e6']?>"></td>
																<td class="tdhead_center"><input type="text" name="b7" class="textfm" style="width:100%;" value="<?=$money_e_txt['e7']?>"></td>
																<td class="tdhead_center"><input type="text" name="b8" class="textfm" style="width:100%;" value="<?=$money_e_txt['e8']?>"></td>
																</tr>
															</table>
														</td>
														<td nowrap bgcolor=white>&nbsp; &nbsp;&nbsp; &nbsp;</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td width="200" bgcolor="#FFFFFF">
											<div id="spanLeft" style="width:200px;height:426px;overflow:hidden">
												<div style="display:none;">
													<input type="hidden" name="pay_gbn">
													<input type="hidden" name="yyyymm">
													<input type="hidden" name="emp_name">
													<input type="hidden" name="emp_sdate">
													<input type="hidden" name="emp_pname">

													<input type="hidden" name="money_month">
													<input type="hidden" name="money_hour">
													<input type="hidden" name="money_hour_ts">
													<input type="hidden" name="workhour_day">
													<input type="hidden" name="workhour_ext">
													<input type="hidden" name="workhour_night">
													<input type="hidden" name="workhour_hday">

													<input type="hidden" name="workhour_ext_add">
													<input type="hidden" name="workhour_night_add">
													<input type="hidden" name="workhour_hday_add">

													<input type="hidden" name="workhour_total">
													<input type="hidden" name="week_hday">
													<input type="hidden" name="year_hday">
													<input type="hidden" name="money_base">
													<input type="hidden" name="money_ext">
													<input type="hidden" name="money_hday">
													<input type="hidden" name="money_night">
													<input type="hidden" name="money_week">
													<input type="hidden" name="money_year">
													<input type="hidden" name="money_g1">
													<input type="hidden" name="money_g2">
													<input type="hidden" name="money_g3">
													<input type="hidden" name="money_g4">
													<input type="hidden" name="money_g5">
													<input type="hidden" name="money_e1">
													<input type="hidden" name="money_e2">
													<input type="hidden" name="money_e3">
													<input type="hidden" name="money_e4">
													<input type="hidden" name="money_e5">
													<input type="hidden" name="money_e6">
													<input type="hidden" name="money_e7">
													<input type="hidden" name="money_e8">
													<input type="hidden" name="money_total">
													<input type="hidden" name="money_for_tax">
													<input type="hidden" name="money_yun">
													<input type="hidden" name="money_health">
													<input type="hidden" name="money_yoyang">
													<input type="hidden" name="money_goyong">
													<input type="hidden" name="tax_so">
													<input type="hidden" name="tax_jumin">
													<input type="hidden" name="money_gongje">
													<input type="hidden" name="money_result">
													<input type="hidden" name="workhour_year">
													<!--추가 필드-->
													<input type="hidden" name="money_ext_add">
													<input type="hidden" name="money_night_add">
													<input type="hidden" name="money_hday_add">
													<input type="hidden" name="money_ng4">
													<input type="hidden" name="money_ng5">
													<input type="hidden" name="advance_pay">
													<input type="hidden" name="check_money_min_yn">
													<input type="hidden" name="money_hour_ms">
												</div>
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<col width="10%">
													<col width="">
													<col width="35%">
													<col width="25%">
													<?
													// 리스트 출력
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														$code = $row[com_code];
														// 사업장명 : 사업장코드
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

														//사원정보 추가 DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//직위
														$sql_position = " select * from com_code_list where com_code = '$code' and code='$row2[position]' and item='position' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where com_code = '$code' and code='$row2[step]' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//채용형태
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "정규직";
														else if($row[work_form] == "2") $work_form = "계약직";
														else if($row[work_form] == "3") $work_form = "일용직";

													?>

													<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
														<td nowrap class="ltrow1_center_h24">
															<input type="checkbox" name="idx" value="<?=$row[sabun]?>">
														</td>
														<td nowrap class="ltrow1_center_h24"><?=$name?></td>
														<td nowrap class="ltrow1_center_h24"><?=$row[in_day]?></td>
														<td nowrap class="ltrow1_center_h24"><input type="text" name="emp_pname" value="<?=$row_position[name]?>" style="width:100%;ime-mode:active;" class="textfm5" readonly onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');"></td>
													</tr>
													<?
													}
													if ($i == 0)
															echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
													?>

												</table>
												<br>
											</div>
										</td>
										<td bgcolor="#FFFFFF" valign="top">
											<div id="spanMain">
												<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<?
													$result = sql_query($sql);
													// 리스트 출력
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														// 사업장명 : 사업장코드
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

														//사원정보 추가 DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//직위
														$sql_position = " select * from com_code_list where code='$row2[position]' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where code='$row2[step]' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//채용형태
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "정규직";
														else if($row[work_form] == "2") $work_form = "계약직";
														else if($row[work_form] == "3") $work_form = "일용직";
														//근속호봉

														//연장근로
														$sql_attendance = " select * from a4_attendance where com_code='$row[com_code]' and sabun='$row[sabun]' and att_day like '201310%' ";
														//echo $sql_attendance;
														$result_attendance = sql_query($sql_attendance);
														$row_attendance=mysql_fetch_array($result_attendance);

														//사원정보 추가 DB (급여정보)
														$sql3 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result3 = sql_query($sql3);
														$row3=mysql_fetch_array($result3);

														//급여관리 DB (급여반영) 년월
														$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' ";
														//echo $sql4;
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);
														//추가연장 근로시간 초기화
														if(!$row4[w_ext_add]) $row4[w_ext_add] = "0";
														if(!$row4[w_night_add]) $row4[w_night_add] = "0";
														if(!$row4[w_hday_add]) $row4[w_hday_add] = "0";
														if(!$row3[money_month_base]) {
															$row4[w_ext_add] = "";
															$row4[w_night_add] = "";
															$row4[w_hday_add] = "";
														}
													?>

													<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
														<input type="hidden" name="pay_no" value="<?=$row[sabun]?>">
														<input type="hidden" name="cust_numb" value="98">
														<input type="hidden" name="work_numb" value="64">
														<input type="hidden" name="pay_gbn" value="01">
														<input type="hidden" name="yyyymm" value="201311">
														<input type="hidden" name="emp_name" value="<?=$name?>">
														<input type="hidden" name="emp_sdate" value="<?=$row[in_day]?>">
														<input type="hidden" name="money_hour" value="0">
														<input type="hidden" name="week_hday" value="0">
														<input type="hidden" name="year_hday" value="0">
														<input type="hidden" name="money_week" value="">
														<input type="hidden" name="sabun[]" value="<?=$row[sabun]?>">
														<input type="hidden" name="staff_name[]" value="<?=$name?>">
														<input type="hidden" name="in_day[]" value="<?=$row[in_day]?>">
														<input type="hidden" name="out_day[]" value="<?=$row[out_day]?>">
														<input type="hidden" name="position[]" value="<?=$row2[position]?>">

														<input type="hidden" name="position_txt[]" value="<?=$row_position[name]?>">
														<input type="hidden" name="step_txt[]" value="<?=$row_step[name]?>">

														<input type="hidden" name="w_day_<?=$i?>">
														<input type="hidden" name="w_ext_<?=$i?>">
														<input type="hidden" name="w_night_<?=$i?>">
														<input type="hidden" name="w_hday_<?=$i?>">

														<input type="hidden" name="w_ext_add_<?=$i?>">
														<input type="hidden" name="w_night_add_<?=$i?>">
														<input type="hidden" name="w_hday_add_<?=$i?>">

														<input type="hidden" name="workhour_total_<?=$i?>">

														<input type="hidden" name="money_time_<?=$i?>">
														<input type="hidden" name="money_day_<?=$i?>">
														<input type="hidden" name="money_month_<?=$i?>">

														<input type="hidden" name="g1_<?=$i?>">
														<input type="hidden" name="g2_<?=$i?>">
														<input type="hidden" name="g3_<?=$i?>">
														<input type="hidden" name="g4_<?=$i?>">
														<input type="hidden" name="g5_<?=$i?>">

														<input type="hidden" name="ext_<?=$i?>">
														<input type="hidden" name="night_<?=$i?>">
														<input type="hidden" name="hday_<?=$i?>">
														<input type="hidden" name="ext_add_<?=$i?>">
														<input type="hidden" name="night_add_<?=$i?>">
														<input type="hidden" name="hday_add_<?=$i?>">
														<input type="hidden" name="annual_paid_holiday_<?=$i?>">

														<input type="hidden" name="e1_<?=$i?>">
														<input type="hidden" name="e2_<?=$i?>">
														<input type="hidden" name="e3_<?=$i?>">
														<input type="hidden" name="e4_<?=$i?>">
														<input type="hidden" name="e5_<?=$i?>">
														<input type="hidden" name="e6_<?=$i?>">
														<input type="hidden" name="e7_<?=$i?>">
														<input type="hidden" name="e8_<?=$i?>">
	 
														<input type="hidden" name="tax_so_var_<?=$i?>">
														<input type="hidden" name="tax_jumin_var_<?=$i?>">
														<input type="hidden" name="advance_pay_<?=$i?>">
														<input type="hidden" name="health_<?=$i?>">
														<input type="hidden" name="yoyang_<?=$i?>">
														<input type="hidden" name="yun_<?=$i?>">
														<input type="hidden" name="goyong_<?=$i?>">
														<input type="hidden" name="end_pay_<?=$i?>">
														<input type="hidden" name="minus_<?=$i?>">

														<input type="hidden" name="money_total_<?=$i?>">
														<input type="hidden" name="money_for_tax_<?=$i?>">
														<input type="hidden" name="money_gongje_<?=$i?>">
														<input type="hidden" name="money_result_<?=$i?>">

														<!--추가 필드-->
														<input type="hidden" name="money_ext_add">
														<input type="hidden" name="money_night_add">
														<input type="hidden" name="money_hday_add">
														<input type="hidden" name="money_ng4">
														<input type="hidden" name="money_ng5">
														<input type="hidden" name="advance_pay">
														<input type="hidden" name="check_money_min_yn" value="<?=$row3[check_money_min_yn]?>">
														<input type="hidden" name="money_hour_ms" value="<?=$row3[money_hour_ms]?>">
														<!--사용무 필드-->

														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_month" value="<?=number_format($row3[money_month_base])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 결정임금 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_day" value="<?=$row3[workhour_day]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 소정근로시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext" value="<?=$row3[workhour_ext]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 연장근로시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night" value="<?=$row3[workhour_night]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 야간근로시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday" value="<?=$row3[workhour_hday]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 휴일근로시간 -->

														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext_add" value="<?=$row4[w_ext_add]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 추가연장근로시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night_add" value="<?=$row4[w_night_add]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 추가야간근로시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday_add" value="<?=$row4[w_hday_add]?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 추가휴일근로시간 -->

														<!--<td nowrap class="ltrow1_center_h24">--><input type="text" style="width:100%;ime-mode:disabled;display:none" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_year" value="<?=$row3[workhour_year]?>" onKeyUp="cal_pay('<?=$k?>');"><!--</td>--><!-- 연차휴가시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$row4[workhour_total]?>"></td><!-- 임금산출 총시간 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_hour_ts" value="<?=number_format($row4[money_time])?>"></td><!-- 통상임금(시간급) -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_base" value="<?=number_format($row4[money_month])?>" onchage="this.form.money_month_var[].value='this.value';"></td><!-- 기본급 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_ext" value="<?=number_format($row4[ext])?>"></td><!-- 연장근로수당 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_night" value="<?=number_format($row4[night])?>"></td><!-- 야간근로수당 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_hday" value="<?=number_format($row4[hday])?>"></td><!-- 휴일근로수당 -->

														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_ext_add" value="<?=number_format($row4[ext_add])?>"></td><!-- 추가연장근로수당 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_night_add" value="<?=number_format($row4[night_add])?>"></td><!-- 추가야간근로수당 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_hday_add" value="<?=number_format($row4[hday_add])?>"></td><!-- 추가휴일근로수당 -->

														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_year" value="<?=number_format($row4[annual_paid_holiday])?>"></td><!-- 연차휴가수당 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g1" value="<?=number_format($row3[money_g1])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 고정성1 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g2" value="<?=number_format($row3[money_g2])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 고정성2 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g3" value="<?=number_format($row3[money_g3])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 고정성3 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g4" value="<?=number_format($row3[money_g4])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 고정성4 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g5" value="<?=number_format($row3[money_g5])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 고정성5 -->

														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e1" value="<?=number_format($row3[money_e1])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당1 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e2" value="<?=number_format($row3[money_e2])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당2 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e3" value="<?=number_format($row3[money_e3])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당3 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e4" value="<?=number_format($row3[money_e4])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당4 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e5" value="<?=number_format($row3[money_e5])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당5 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e6" value="<?=number_format($row3[money_e6])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당6 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e7" value="<?=number_format($row3[money_e7])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당7 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e8" value="<?=number_format($row3[money_e8])?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당8 -->

														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4[money_total])?>"></td><!-- 임금계 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4[money_for_tax])?>"></td><!-- 과세소득 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" value="<?=number_format($row4[yun])?>" onKeyUp="cal_pay2('<?=$k?>');"></td><!-- 국민연금 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" value="<?=number_format($row4[health])?>" onKeyUp="cal_pay2('<?=$k?>');"></td><!-- 건강보험 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" value="<?=number_format($row4[yoyang])?>" onKeyUp="cal_pay2('<?=$k?>');"></td><!-- 장기요양보험 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" value="<?=number_format($row4[goyong])?>" onKeyUp="cal_pay2('<?=$k?>');"></td><!-- 고용보험 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" value="<?=number_format($row4[tax_so])?>" onKeyUp="cal_pay3('<?=$k?>');"></td><!-- 소득세 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" value="<?=number_format($row4[tax_jumin])?>" onKeyUp="cal_pay2('<?=$k?>');"></td><!-- 주민세 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="minus" value="<?=number_format($row4[minus])?>" onKeyUp="cal_pay2('<?=$k?>');"></td><!-- 기타공제 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4[money_gongje])?>"></td><!-- 공제계 -->
														<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4[money_result])?>"></td><!-- 공제후지급액 -->
													</tr>
<script type="text/javascript">
//자동 계산
//cal_pay('<?=$k?>');
</script>
													<?
													}
													if ($i == 0) {
														echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
													}
													if ($i == 1) {
														echo "<input type='checkbox' name='pay_no' value='' style='display:none'><input type='checkbox' name='idx' value='' style='display:none'>";
													}
													?>
												</table>
											</div>
										</td>
									</tr>
								</table>
								<!--리스트 -->
							</form>

							<br>
							<div>
								<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
									<tr>
										<td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_paysome?>" target="">급여명세서 선택출력</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
									<tr>
										<td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_paylist?>" target="">급여대장 출력</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>			
</div>
<script language="javascript">
//자동 계산 버튼 함수
function cal_pay_bt() {
<?
for($i=1;$i<=$k;$i++) {
?>
	cal_pay('<?=$i?>');
<?
}
?>
}
</script>
</body>
</html>
