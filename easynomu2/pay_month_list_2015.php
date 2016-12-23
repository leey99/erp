<?
$sub_menu = "400102";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";
//급여월 이후 입사자 제외
$year_month = $search_year.".".$search_month;
$in_day_base = $year_month.".32";
$sql_search .= " and ( a.in_day = '' or a.in_day < '$in_day_base' ) ";
//퇴직자 제외
$year_month = $search_year.".".$search_month;
$out_day_base = $year_month.".01";
$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' ) ";
//급여정보 미설정자 제외
//$sql_search .= " and ( b.pay_gbn != '' ) ";
//월급제, 연봉제 근로자만 표시
$sql_search .= " and ( b.pay_gbn = '0' or b.pay_gbn = '3' ) ";

//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form like '$stx_work_form%') ";
	$sql_search .= " ) ";
}
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
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 180;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "급여계산";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
//echo $sql;
$colspan = 12;

//급여반영 테이블 넓이
$pay_list_width = 3550;

//급여관리 DB (급여반영) 년월
$sql_w_date = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' order by w_date desc, w_time desc limit 0, 1 ";
$result_w_date = sql_query($sql_w_date);
$row_w_date=mysql_fetch_array($result_w_date);
//echo $sql_w_date;
if($row_w_date[w_date] != "0000-00-00") {
	$w_date = $row_w_date[w_date];
	$w_date_ok = "1";
} else {
	$w_date = "<span style='color:red'>임시저장</span>";
	$w_date_ok = "";
}
if($row_w_date[w_date] == "") {
	$w_date = "<span style='color:red'>미등록</span>";
	$w_date_ok = "";
}
//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}
if($comp_print_type == "N") {
	header('Location:./pay_white.php');
}
//급여지급일
if($row_com_opt[pay_day]) {
	if($search_month == 12) {
		$pay_date = "1월 ".$row_com_opt[pay_day]."일";
	} else {
		$pay_date = ($search_month+1)."월 ".$row_com_opt[pay_day]."일";
	}
	//급여지급일 당월 체크 유무
	if($row_com_opt[pay_day_now_month] == 1) {
		$pay_date = $search_month."월 ".$row_com_opt[pay_day]."일";
	}
} else {
	$pay_date = "급여지급일 미지정";
}
//급여지급일 말일 체크
if($row_com_opt[pay_day_last]) {
	if($search_month == 12) {
		$pay_date = "1월 말일";
	} else {
		$pay_date = ($search_month+1)."월 말일";
	}
	//급여지급일 당월 체크 유무
	if($row_com_opt[pay_day_now_month] == 1) {
		$pay_date = $search_month."월 말일";
	}
}
//임금산출기간
if($row_com_opt[pay_calculate_day1]) {
	$pay_calculate_date = $row_com_opt[pay_calculate_day1]." ".$row_com_opt[pay_calculate_day_period1]."일 ~ ".$row_com_opt[pay_calculate_day2]." ".$row_com_opt[pay_calculate_day_period2]."일";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?> Type : <?=$comp_print_type?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<?
$money_month_text = "결정임금";
?>
<?
//일반 Type
?>
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
function goInput(mode){
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
		f["pay_gbn_"+k].value = f.pay_gbn[i].value;

		f["w_day_"+k].value = f.workhour_day[i].value;
		f["w_ext_"+k].value = f.workhour_ext[i].value;
		f["w_night_"+k].value = f.workhour_night[i].value;
		f["w_hday_"+k].value = f.workhour_hday[i].value;

		f["w_ext_add_"+k].value = f.workhour_ext_add[i].value;
		f["w_night_add_"+k].value = f.workhour_night_add[i].value;
		f["w_hday_add_"+k].value = f.workhour_hday_add[i].value;
		//alert(f["w_night_add_"+k].value);

		f["w_late_"+k].value = f.workhour_late[i].value;
		f["w_leave_"+k].value = f.workhour_leave[i].value;
		f["w_out_"+k].value = f.workhour_out[i].value;
		f["w_absence_"+k].value = f.workhour_absence[i].value;

		f["workhour_total_"+k].value = f.workhour_total[i].value;
		//alert(f["workhour_total_"+k].value);



		f["money_hour_ds_"+k].value = f.money_hour_ds[i].value;
		//alert(f["money_hour_ds_"+k].value);
		f["money_hour_ts_"+k].value = f.money_hour_ts[i].value;
		//기본시급
		f["money_time_"+k].value = f.money_time[i].value;
		//f["money_day_"+k].value = f.money_day[i].value;
		f["money_month_"+k].value = f.money_base[i].value;
		f["money_setting_"+k].value = f.money_month[i].value;

		f["g1_"+k].value = f.money_g1[i].value;
		f["g2_"+k].value = f.money_g2[i].value;
		f["g3_"+k].value = f.money_g3[i].value;
		f["g4_"+k].value = f.money_g4[i].value;
		f["g5_"+k].value = f.money_g5[i].value;

		f["ext_"+k].value = f.money_ext[i].value;
		f["night_"+k].value = f.money_night[i].value;
		f["hday_"+k].value = f.money_hday[i].value;
		f["annual_paid_holiday_"+k].value = f.money_year[i].value;

		f["ext_add_"+k].value = f.money_ext_add[i].value;
		f["night_add_"+k].value = f.money_night_add[i].value;
		f["hday_add_"+k].value = f.money_hday_add[i].value;

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
		f["minus_"+k].value = f.minus[i].value;
		f["minus2_"+k].value = f.minus2[i].value;
		f["etc_"+k].value = f.etc[i].value;
		f["etc2_"+k].value = f.etc2[i].value;

		f["money_total_"+k].value = f.money_total[i].value;
		f["money_for_tax_"+k].value = f.money_for_tax[i].value;
		f["money_gongje_"+k].value = f.money_gongje[i].value;
		f["money_result_"+k].value = f.money_result[i].value;
	}

	f.mode.value = mode;
	f.action = "pay_update.php";
	f.submit();
}
//급여반영 입력폼
var ary_tax = new Array();
var ary_tax2 = new Array();
var ary_tax3 = new Array();
var ary_tax4 = new Array();
var ary_tax5 = new Array();
var ary_tax6 = new Array();
var ary_tax7 = new Array();
var ary_tax8 = new Array();
var ary_tax9 = new Array();
var ary_tax10 = new Array();
var ary_tax11 = new Array();
<?
include "./inc/ary_tax_2015.php";
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
function GetTax(money_for_tax, idx) {
	var f = document.dataForm;
	//alert(idx+" / "+f.family_cnt[idx].value);
	family_cnt = parseInt(f.family_cnt[idx].value)+parseInt(f.child_cnt[idx].value);
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
		if(family_cnt == 2) {
			tax = ary_tax2[i][2];
		} else if(family_cnt == 3) {
			tax = ary_tax3[i][2];
		} else if(family_cnt == 4) {
			tax = ary_tax4[i][2];
		} else if(family_cnt == 5) {
			tax = ary_tax5[i][2];
		} else if(family_cnt == 6) {
			tax = ary_tax6[i][2];
		} else if(family_cnt == 7) {
			tax = ary_tax7[i][2];
		} else if(family_cnt == 8) {
			tax = ary_tax8[i][2];
		} else if(family_cnt == 9) {
			tax = ary_tax9[i][2];
		} else if(family_cnt == 10) {
			tax = ary_tax10[i][2];
		} else if(family_cnt >= 11) {
			tax = ary_tax11[i][2];
		} else {
			tax = ary_tax[i][2];
		}
		//alert(smoney);
		if( money_base >= smoney && money_base < emoney ) {
			tax_result = tax;
			break;
		}
	}
	return tax_result;
}
function check_manual(m_name) {
	var frm = document.dataForm;
	var total_cnt = frm.total_cnt.value;
	for(i=1;i<=total_cnt;i++) {
		if(m_name.name == "manual_ext") {
			if(m_name.checked) frm.money_ext[i].className = "textfm";
			else frm.money_ext[i].className = "textfm5";
		} else if(m_name.name == "manual_night") {
			if(m_name.checked) frm.money_night[i].className = "textfm";
			else frm.money_night[i].className = "textfm5";
		} else if(m_name.name == "manual_hday") {
			if(m_name.checked) frm.money_hday[i].className = "textfm";
			else frm.money_hday[i].className = "textfm5";
/*
		} else if(m_name.name == "manual_4insure") {
			if(m_name.checked) {
				frm.money_yun[i].className = "textfm";
				frm.money_health[i].className = "textfm";
				frm.money_yoyang[i].className = "textfm";
				frm.money_goyong[i].className = "textfm";
			} else {
				frm.money_yun[i].className = "textfm5";
				frm.money_health[i].className = "textfm5";
				frm.money_yoyang[i].className = "textfm5";
				frm.money_goyong[i].className = "textfm5";
			}
		} else if(m_name.name == "manual_tax") {
			if(m_name.checked) {
				frm.tax_so[i].className = "textfm";
				frm.tax_jumin[i].className = "textfm";
			} else {
				frm.tax_so[i].className = "textfm5";
				frm.tax_jumin[i].className = "textfm5";
			}
*/
		}
	}
}
function money_month_fix_ft(obj) {
	var f = document.dataForm;
	//if(obj.checked) alert(obj.value);
	for( var i = 1; i<f.idx.length; i++ ) {
		if(obj.checked) {
			f.money_base[i].className = "textfm";
			f.money_base[i].readOnly = false;
		} else  {
			f.money_base[i].className = "textfm5";
			f.money_base[i].readOnly = true;
		}
	}
}
function cal_pay2(idx){
	var f = document.dataForm;
	var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result, workhour_year;
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

	money_ext_add   = toInt(f.money_ext_add [idx].value);	// 연장근로수당(추가)     
	money_hday_add  = toInt(f.money_hday_add[idx].value);	// 휴일근로수당(추가)
	money_night_add = toInt(f.money_night_add[idx].value);	// 야간근로수당(추가)

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
	minus           = toInt(f.minus         [idx].value);	//기타공제
	minus2          = toInt(f.minus2        [idx].value);	//기타공제2
	etc           	= toInt(f.etc      	 	  [idx].value);	//가불
	etc2          	= toInt(f.etc2      	  [idx].value);	//근태공제
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
<?
//대성하이테크 , 대성산업기계, 네오스 공제계 가불 포함
if($comp_print_type == "D" || $com_code == "20099") {
?>
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2+etc;
	//alert(money_gongje);
<?
} else {
?>
	//money_gongje 공제계 = 국민연금+건강보험+장기요양보험+고용보험+소득세+주민세
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
<?
}
?>
	//money_result 공제후 지급액 
	money_result = money_total - money_gongje;
	f.money_gongje[idx].value = number_format(money_gongje); //money_gongje 공제계 
	f.money_result[idx].value = number_format(money_result); //money_result 공제후 지급액 
}
function cal_pay3(idx) {
	var f = document.dataForm;
	var tax_so,tax_jumin;
	tax_so = toInt(f.tax_so[idx].value); //소득세
	//tax_jumin 주민세 
	tax_jumin = parseInt(tax_so*0.1*0.1)*10;
	f.tax_jumin[idx].value = number_format(tax_jumin);
	cal_pay2(idx); // 공제후 지급액 재계산
}
function focusClickClass(idx) {
	var frm = document.dataForm;
	//alert(f.idx[idx].checked);
	if(frm.idx[idx].checked == true) {
		focusInClass(idx);
	} else {
		focusOutClass(idx);
	}
}
function focusInClass(idx) {
	var frm = document.dataForm;
	//frm.emp_pname[idx].className = "textfm_trans";
	frm.money_month[idx].className = "textfm_trans";

	frm.workhour_day[idx].className = "textfm_trans";
	frm.workhour_ext[idx].className = "textfm_trans";
	frm.workhour_night[idx].className = "textfm_trans";
	frm.workhour_hday[idx].className = "textfm_trans";

	frm.workhour_late[idx].className = "textfm_trans";
	frm.workhour_leave[idx].className = "textfm_trans";
	frm.workhour_out[idx].className = "textfm_trans";
	frm.workhour_absence[idx].className = "textfm_trans";

	frm.workhour_total[idx].className = "textfm_trans";


	frm.money_hour_ts[idx].className = "textfm_trans";
	frm.money_time[idx].className = "textfm_trans";

	if(frm.money_month_fix.checked) {
		frm.money_base[idx].className = "textfm_trans";
	} else {
		frm.money_base[idx].className = "textfm5";
	}

	frm.money_ext[idx].className = "textfm_trans";
	frm.money_night[idx].className = "textfm_trans";
	frm.money_hday[idx].className = "textfm_trans";

	frm.money_ext_add[idx].className = "textfm_trans";
	frm.money_hday_add[idx].className = "textfm_trans";
	frm.money_night_add[idx].className = "textfm_trans";
	frm.money_year[idx].className = "textfm_trans";

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
	frm.money_total[idx].className = "textfm_trans";
	frm.money_for_tax[idx].className = "textfm_trans";
	frm.money_yun[idx].className = "textfm_trans";
	frm.money_health[idx].className = "textfm_trans";
	frm.money_yoyang[idx].className = "textfm_trans";
	frm.money_goyong[idx].className = "textfm_trans";
	frm.tax_so[idx].className = "textfm_trans";
	frm.tax_jumin[idx].className = "textfm_trans";
	frm.minus[idx].className = "textfm_trans";
	frm.minus2[idx].className = "textfm_trans";
	frm.etc[idx].className = "textfm_trans";
	frm.etc2[idx].className = "textfm_trans";
	frm.money_gongje[idx].className = "textfm_trans";
	frm.money_result[idx].className = "textfm_trans";
	//frm.workhour_year[idx].className = "textfm_trans";
}
function focusOutClass(idx) {
	var frm = document.dataForm;
	if(frm.idx[idx].checked == false) {
		//frm.emp_pname[idx].className = "textfm";
		frm.money_month[idx].className = "textfm";

		frm.workhour_day[idx].className = "textfm";
		frm.workhour_ext[idx].className = "textfm";
		frm.workhour_night[idx].className = "textfm";
		frm.workhour_hday[idx].className = "textfm";

		frm.workhour_late[idx].className = "textfm";
		frm.workhour_leave[idx].className = "textfm";
		frm.workhour_out[idx].className = "textfm";
		frm.workhour_absence[idx].className = "textfm";

		frm.workhour_total[idx].className = "textfm5";


		frm.money_hour_ts[idx].className = "textfm";
		frm.money_time[idx].className = "textfm";

		if(frm.money_month_fix.checked) {
			frm.money_base[idx].className = "textfm";
		} else {
			frm.money_base[idx].className = "textfm5";
		}

		if(frm.manual_ext.checked) frm.money_ext[idx].className = "textfm";
		else frm.money_ext[idx].className = "textfm5";
		if(frm.manual_night.checked) frm.money_night[idx].className = "textfm";
		else frm.money_night[idx].className = "textfm5";
		if(frm.manual_hday.checked) frm.money_hday[idx].className = "textfm";
		else frm.money_hday[idx].className = "textfm5";

		frm.money_ext_add[idx].className = "textfm";
		frm.money_hday_add[idx].className = "textfm";
		frm.money_night_add[idx].className = "textfm";
		frm.money_year[idx].className = "textfm";

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
		frm.minus[idx].className = "textfm";
		frm.minus2[idx].className = "textfm";
		frm.etc[idx].className = "textfm";
		frm.etc2[idx].className = "textfm5";
		frm.money_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
		//frm.workhour_year[idx].className = "textfm";
	}
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
function printPaySome_name(pay_no) {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("저장 후 이용해 주세요.");
		return;
	}
	var f = document.dataForm;
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function pay_preview() {
	//alert('준비중입니다.');
	//return;
	goInput('preview');
/*
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_preview.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
	frm.submit();
*/
}
function printPayList(){
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("저장 후 이용해 주세요.");
		return;
	}
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
//천단위 콤바
function checkThousand(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//alert(event.keyCode);
	//백스페이스 탭 시프트+탭 좌 우 Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if (inputVal.length > 3){
			input = delCom(inputVal, inputVal.length);
			/*
			for(i=0; i<inputVal.length; i++){
				if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
					input += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
				}
			}*/
			chk = (input.length)/3;					// input 값을 3의로 나눈 값 계산
			chk = Math.floor(chk);					// 그 값보다 작거나 같은 값 중 최대의 정수 계산
			share = (input.length)%3;				// 200,000 와 같은 3의 배수인 수를 걸러내기 위해 나머지 계산
			if (share == 0 ) {						
				chk = chk - 1;					// 길이가 3의 배수인 수를 위해 chk 값을 하나 뺀다.
			}
			for(i=chk; i>0; i--){
				triple = i * 3;					// 3의 배수 계산 9,6,3 등과 같은 순으로
				end = Number(input.length)-Number(triple);	// 이 때의 end 값은 점차 늘어 나게 된다.
				total += input.substring(start,end)+",";	// total은 앞에서 부터 차례로 붙인다.
				start = end;					// end 값은 다음번의 start 값으로 들어간다.
			}
			total +=input.substring(start,input.length);		// 최종적으로 마지막 3자리 수를 뒤에 붙힌다.
		} else {
			total = inputVal;					// 3의 배수가 되기 이전에는 값이 그대로 유지된다.
		}
		if(keydown =='Y'){
			type.value=total;					// type 에 따라 최종값을 넣어 준다.
		}else if(keydown =='N'){
			return total
		}
		return total
	}
}
//천단위 마이너스 부호 허용
function commify(n, type) {
	var reg = /(^[+-]?\d+)(\d{3})/;
	n += '';  // 숫자를 문자열로 변환
	while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');
	type.value=n;	
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function month_plus() {
	f = document.searchForm;
	//alert(f.search_month.value);
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
		//alert(year_var);
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
		//alert(year_var);
	} else {
		//alert(month_var.length);
		//alert(month_var.substring(0,1));
		//if(month_var.substring(0,1) != "0") {
		month_var = ""+(toInt(month_var) - 1);
		//alert(month_var.length);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
		//alert(month_var);
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_middle_cal(idx,end_day,work_day) {
	var f = document.dataForm;
	if(confirm("일할 계산 하시겠습니까?")) {
		//
		money_month = toInt(f.money_month[idx].value);
		money_month_var = (money_month / end_day) * work_day;
		f.money_month[idx].value = number_format(Math.floor(money_month_var/10)*10);
		//근로시간
		workhour_day = toInt(f.workhour_day[idx].value);
		workhour_day_var = (workhour_day / end_day) * work_day;
		alert("("+workhour_day+" / "+end_day+") * "+work_day);
		f.workhour_day[idx].value = Math.ceil(workhour_day_var);
		workhour_ext = toInt(f.workhour_ext[idx].value);
		workhour_ext_var = (workhour_ext / end_day) * work_day;
		f.workhour_ext[idx].value = (workhour_ext_var).toFixed(2);
		workhour_night = toInt(f.workhour_night[idx].value);
		workhour_night_var = (workhour_night / end_day) * work_day;
		f.workhour_night[idx].value = (workhour_night_var).toFixed(2);
		workhour_hday = toInt(f.workhour_hday[idx].value);
		workhour_hday_var = (workhour_hday / end_day) * work_day;
		f.workhour_hday[idx].value = (workhour_hday_var).toFixed(2);
		//통상임금수당
		money_g1 = toInt(f.money_g1[idx].value);
		money_g1_var = (money_g1/end_day) * work_day;
		f.money_g1[idx].value = number_format(Math.floor(money_g1_var/10)*10);
		money_g2 = toInt(f.money_g2[idx].value);
		money_g2_var = (money_g2/end_day) * work_day;
		f.money_g2[idx].value = number_format(Math.floor(money_g2_var/10)*10);
		money_g3 = toInt(f.money_g3[idx].value);
		money_g3_var = (money_g3/end_day) * work_day;
		f.money_g3[idx].value = number_format(Math.floor(money_g3_var/10)*10);
		money_g4 = toInt(f.money_g4[idx].value);
		money_g4_var = (money_g4/end_day) * work_day;
		f.money_g4[idx].value = number_format(Math.floor(money_g4_var/10)*10);
		money_g5 = toInt(f.money_g5[idx].value);
		money_g5_var = (money_g5/end_day) * work_day
		f.money_g5[idx].value = number_format(Math.floor(money_g5_var/10)*10);
		//기타수당
		money_e1 = toInt(f.money_e1[idx].value);
		money_e1_var = (money_e1/end_day) * work_day;
		f.money_e1[idx].value = number_format(Math.floor(money_e1_var/10)*10);
		money_e2 = toInt(f.money_e2[idx].value);
		money_e2_var = (money_e2/end_day) * work_day;
		f.money_e2[idx].value = number_format(Math.floor(money_e2_var/10)*10);
		money_e3 = toInt(f.money_e3[idx].value);
		money_e3_var = (money_e3/end_day) * work_day;
		f.money_e3[idx].value = number_format(Math.floor(money_e3_var/10)*10);
		money_e4 = toInt(f.money_e4[idx].value);
		money_e4_var = (money_e4/end_day) * work_day;
		f.money_e4[idx].value = number_format(Math.floor(money_e4_var/10)*10);
		money_e5 = toInt(f.money_e5[idx].value);
		money_e5_var = (money_e5/end_day) * work_day;
		f.money_e5[idx].value = number_format(Math.floor(money_e5_var/10)*10);
		money_e6 = toInt(f.money_e6[idx].value);
		money_e6_var = (money_e6/end_day) * work_day;
		f.money_e6[idx].value = number_format(Math.floor(money_e6_var/10)*10);
		money_e7 = toInt(f.money_e7[idx].value);
		money_e7_var = (money_e7/end_day) * work_day;
		f.money_e7[idx].value = number_format(Math.floor(money_e7_var/10)*10);
		money_e8 = toInt(f.money_e8[idx].value);
		money_e8_var = (money_e8/end_day) * work_day;
		f.money_e8[idx].value = number_format(Math.floor(money_e8_var/10)*10);
		cal_pay(idx);
	} else {
		return;
	}
}
</script>
<? include "./inc/top.php"; ?>
<?
if($member[mb_id] == "master") {
?>
<div id="content" style="padding:20px">
	일반 사업장 로그인시 이용 가능합니다.
</div>
<?
	exit;
}
?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "N") {
	include "./inc/left_menu4_type_n.php";
} else if($comp_print_type == "H") {
	include "./inc/left_menu4_type_h.php";
} else {
	include "./inc/left_menu4.php";
}
include "./inc/left_banner.php";
?>
						</td>
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
<?
include "./inc/pay_list_include.php";
?>
								<!--리스트 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td width="200" height="84" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
												<col width="10%">
												<col width="">
												<col width="35%">
												<col width="25%">
												<tr>
													<td nowrap height="85" align="center" style="background-color:rgb(226, 226, 226);"></td></td>
													<td nowrap class="tdhead_center">이름</td>
													<td nowrap class="tdhead_center">입사일</td>
													<td nowrap class="tdhead_center">직위</td>
												</tr>
											</table>
										</td>
										<td nowrap class="tdhead_center" valign="top">
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
	//임금포함여부
	$money_e_gy[$e_code] = $row_e[gy_yn];
	//과세포함여부
	$money_e_income[$e_code] = $row_e[income];
}
//수동입력
$sql_manual = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by manual desc ";
//echo $sql_manual;
$row_manual = sql_fetch($sql_manual);
//echo "//수입".$row_manual[manual];
$manual_array = explode(",",$row_manual[manual]);
if($manual_array[0] == "1") $check_manual_ext = "checked";
if($manual_array[1] == "1") $check_manual_night = "checked";
if($manual_array[2] == "1") $check_manual_hday = "checked";
if($manual_array[3] == "1") $check_manual_4insure = "checked";
if($manual_array[4] == "1") $check_manual_tax = "checked";
//공제액 수동입력 해제
if($data == "load") {
	$check_manual_4insure = "";
	$check_manual_tax = "";
}
//기본급 고정
$sql_money_month = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc ";
$row_money_month = sql_fetch($sql_money_month);
if($row_money_month['money_month_fix'] == "Y") $check_money_month_fix = "checked";
//급여정보 미등록시 기본급 수동입력 체크
if(!$w_date_ok) $check_money_month_fix = "checked";
?>
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
																<tr>
																	<td class="tdhead_center" rowspan="4" width="45">유형</td>
																	<td class="tdhead_center" colspan="10">결정급여 및 근로시간(월) </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="7">기본급 및 제수당 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="5">기본급 및 제수당 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="10">기본급 및 제수당 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="2"> </td>
																	<td class="tdhead_center" colspan="8">공제액</td>
																	<td class="tdhead_center" rowspan="4" width="74">공제후<br>지급액 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="3" width="66"><?=$money_month_text?></td>
																	<td class="tdhead_center" colspan="4">근로시간</td>
																	<td class="tdhead_center" colspan="4">근태공제시간</td>
																	<td class="tdhead_center" rowspan="3" width="63">임금산출<br>총시간 </td>

																	<td class="tdhead_center" colspan="7">기본월급</td>
																	<td class="tdhead_center" colspan="5">제수당</td>
																	<td class="tdhead_center" colspan="8">기타수당</td>
																	<td class="tdhead_center" colspan="2">기타</td>
																	<td class="tdhead_center" rowspan="3" width="68">임금계</td>
																	<td class="tdhead_center" rowspan="3" width="68">과세소득</td>
																	<td class="tdhead_center" colspan="4"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 4대보험</td>
																	<td class="tdhead_center" colspan="2"><input type="checkbox" name="manual_tax" <?=$check_manual_tax?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 세금</td>
																	<td class="tdhead_center" colspan="1">기타</td>
																	<td class="tdhead_center" rowspan="3" width="72">공제계</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="2" width="63">소정<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">연장<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">야간<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">휴일<br>근로시간</td>

																	<td class="tdhead_center" rowspan="2" width="64">지각</td>
																	<td class="tdhead_center" rowspan="2" width="64">조퇴</td>
																	<td class="tdhead_center" rowspan="2" width="64">외출</td>
																	<td class="tdhead_center" rowspan="2" width="64">결근</td>

																	<td class="tdhead_center" rowspan="2" width="77">통상시급</td>
																	<td class="tdhead_center" rowspan="2" width="78">기본시급</td>
																	<td class="tdhead_center" rowspan="2" width="102"><input type="checkbox" name="money_month_fix" <?=$check_money_month_fix?> onclick="money_month_fix_ft(this);" value="Y" title="수동입력"> 기본급</td>
																	<td class="tdhead_center" colspan="4">법정수당(과세)</td>
																	<td class="tdhead_center" colspan="5">통상임금수당</td>
																	<td class="tdhead_center" colspan="4">비과세</td>
																	<td class="tdhead_center" colspan="4">과세</td>
																	<td class="tdhead_center" rowspan="2" width="71">가불</td>
																	<td class="tdhead_center" rowspan="2" width="71">근태공제</td>

																	<td class="tdhead_center" rowspan="2" width="57">국민연금</td>
																	<td class="tdhead_center" rowspan="2" width="57">건강보험</td>
																	<td class="tdhead_center" rowspan="2" width="57">장기요양</td>
																	<td class="tdhead_center" rowspan="2" width="57">고용보험</td>
																	<td class="tdhead_center" rowspan="2" width="57">소득세</td>
																	<td class="tdhead_center" rowspan="2" width="57">주민세</td>
																	<td class="tdhead_center" rowspan="2" width="60">
<?
//씨앤에스
if($member['mb_id'] == "410-86-38857") echo "상조회비";
else echo "기타공제";
?>
																	</td>
																</tr>
																<tr>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_ext" <?=$check_manual_ext?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 연장근로</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_night" <?=$check_manual_night?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 야간근로</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_hday" <?=$check_manual_hday?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 휴일근로</td>
																	<td class="tdhead_center" width="101">연차수당</td>



																	<td class="tdhead_center" width="138"><input type="text" name="g1" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g1']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g2" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g2']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g3" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g3']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g4" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g4']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g5" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g5']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b1" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e1']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b2" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e2']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b3" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e3']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b4" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e4']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b5" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e5']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b6" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e6']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b7" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e7']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b8" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e8']?>"></td>
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
										<td width="200" bgcolor="#FFFFFF" valign="top">
<?
$spanMain_height = $total_count * 25 + 25;
//$spanMain_height = 351;
?>
											<div id="spanLeft" style="width:200px;height:<?=$spanMain_height?>px;overflow:hidden">
												<div style="display:none;">
													<input type="hidden" name="idx">
													<input type="hidden" name="pay_gbn">
													<input type="hidden" name="yyyymm">
													<input type="hidden" name="emp_name">
													<input type="hidden" name="emp_sdate">
													<input type="hidden" name="emp_pname">
													<input type="hidden" name="family_cnt">
													<input type="hidden" name="child_cnt">

													<input type="hidden" name="money_month">
													<input type="hidden" name="money_hour">
													<input type="hidden" name="money_hour_ds">
													<input type="hidden" name="money_hour_ts">

													<input type="hidden" name="workhour_day">
													<input type="hidden" name="workhour_ext">
													<input type="hidden" name="workhour_night">
													<input type="hidden" name="workhour_hday">

													<input type="hidden" name="workhour_ext_add">
													<input type="hidden" name="workhour_night_add">
													<input type="hidden" name="workhour_hday_add">

													<input type="hidden" name="workhour_late">
													<input type="hidden" name="workhour_leave">
													<input type="hidden" name="workhour_out">
													<input type="hidden" name="workhour_absence">

													<input type="hidden" name="money_time">
													<input type="hidden" name="workhour_total">

													<input type="hidden" name="week_hday">
													<input type="hidden" name="year_hday">
													<input type="hidden" name="money_base">
													<input type="hidden" name="money_ext">
													<input type="hidden" name="money_hday">
													<input type="hidden" name="money_night">
													<input type="hidden" name="money_week">
													<input type="hidden" name="money_year">

													<input type="hidden" name="money_ext_add">
													<input type="hidden" name="money_night_add">
													<input type="hidden" name="money_hday_add">

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
													<!--합계포함 여부-->
													<input type="hidden" name="money_e1_gy" value="<?=$money_e_gy['e1']?>">
													<input type="hidden" name="money_e2_gy" value="<?=$money_e_gy['e2']?>">
													<input type="hidden" name="money_e3_gy" value="<?=$money_e_gy['e3']?>">
													<input type="hidden" name="money_e4_gy" value="<?=$money_e_gy['e4']?>">
													<input type="hidden" name="money_e5_gy" value="<?=$money_e_gy['e5']?>">
													<input type="hidden" name="money_e6_gy" value="<?=$money_e_gy['e6']?>">
													<input type="hidden" name="money_e7_gy" value="<?=$money_e_gy['e7']?>">
													<input type="hidden" name="money_e8_gy" value="<?=$money_e_gy['e8']?>">
													<!--과세포함 여부-->
													<input type="hidden" name="money_e1_income" value="<?=$money_e_income['e1']?>">
													<input type="hidden" name="money_e2_income" value="<?=$money_e_income['e2']?>">
													<input type="hidden" name="money_e3_income" value="<?=$money_e_income['e3']?>">
													<input type="hidden" name="money_e4_income" value="<?=$money_e_income['e4']?>">
													<input type="hidden" name="money_e5_income" value="<?=$money_e_income['e5']?>">
													<input type="hidden" name="money_e6_income" value="<?=$money_e_income['e6']?>">
													<input type="hidden" name="money_e7_income" value="<?=$money_e_income['e7']?>">
													<input type="hidden" name="money_e8_income" value="<?=$money_e_income['e8']?>">
													<!--임금총액-->
													<input type="hidden" name="money_total">
													<input type="hidden" name="money_for_tax">
													<input type="hidden" name="money_yun">
													<input type="hidden" name="money_health">
													<input type="hidden" name="money_yoyang">
													<input type="hidden" name="money_goyong">
													<input type="hidden" name="tax_so">
													<input type="hidden" name="tax_jumin">
													<input type="hidden" name="minus">
													<input type="hidden" name="minus2">
													<input type="hidden" name="etc">
													<input type="hidden" name="etc2">
													<input type="hidden" name="money_gongje">
													<input type="hidden" name="money_result">
													<input type="hidden" name="workhour_year">
													<!--추가 필드-->
													<input type="hidden" name="money_ng4">
													<input type="hidden" name="money_ng5">
													<input type="hidden" name="advance_pay">
													<input type="hidden" name="check_money_min_yn">
													<input type="hidden" name="check_money_b_yn">
													<input type="hidden" name="check_money_so_yn">
													<input type="hidden" name="money_hour_ms">
													<input type="hidden" name="check_business_yn">
													<!--법정수당-->
													<input type="hidden" name="money_b1">
													<input type="hidden" name="money_b2">
													<input type="hidden" name="money_b3">
													<input type="hidden" name="money_b4">
													<!--4대보험여부-->
													<input type="hidden" name="isgy">
													<input type="hidden" name="issj">
													<input type="hidden" name="iskm">
													<input type="hidden" name="isgg">
													<input type="hidden" name="isjy">
													<!--두리누리-->
													<input type="hidden" name="durunuri">
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

														//사원정보 추가 DB 2
														$sql4 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//직위
														$sql_position = " select * from com_code_list where com_code = '$code' and code='$row2[position]' and item='position' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where com_code = '$code' and code='$row2[step]' and item='step' ";
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
															<input type="checkbox" name="idx" value="<?=$row[sabun]?>" onclick="focusClickClass('<?=$k?>')">
														</td>
<?
if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
if($row4[input_type] == "1") $input_type = "(A)";
else if($row4[input_type] == "2") $input_type = "(B)";
else if($row4[input_type] == "3") $input_type = "(C)";
//월 중간 입사자 일할 계산
$join_year = $search_year;
$join_month = $search_month;
$join_day = $row_com_opt['pay_calculate_day_period1'];
if($join_day < 10) $join_day = "0".$join_day;
$start_date = $join_year.".".$join_month.".".$join_day;
$end_year = $search_year;
$end_month = $search_month;
$end_day = $row_com_opt['pay_calculate_day_period2'];
if($end_day == "말") {
	$end_day = date("t",mktime(0,0,0,$end_month,1,$end_year));
} else if($end_day < 10) {
	$end_day = "0".$end_day;
}
$end_date = $end_year.".".$end_month.".".$end_day;
$in_day = $row['in_day'];
if($in_day > $start_date && $in_day <= $end_date) {
	$in_day_color = "color:red";
	$in_day_hyphen = str_replace('.','-',$in_day);
	$start_date_hyphen = str_replace('.','-',$start_date);
	$end_date_hyphen = str_replace('.','-',$end_date);
	$in_day_var = new DateTime($in_day_hyphen);
	$end_date_var = new DateTime($end_date_hyphen);
	$date_diff_var = date_diff($in_day_var, $end_date_var);
	$work_day = ($date_diff_var->days)+1;
} else {
	$in_day_color = "";
}
?>
														<td nowrap class="ltrow1_center_h24"><b onclick="emp_text('<?=$row[name]?>','<?=$in_day?>','<?=$row_position[name]?>','<?=$row2[family_cnt]?>','<?=$row2[work_gbn]?>','<?=$pay_gbn.$input_type?>','<?=number_format($row4['money_month_base'])?>','<?=number_format($row4['money_hour_ms'])?>','<?=number_format($row4['money_min_base'])?>');" style="cursor:pointer"><?=$name?></b></td>
														<td nowrap class="ltrow1_center_h24"><span onclick="month_middle_cal('<?=$k?>','<?=$end_day?>','<?=$work_day?>')" style="cursor:pointer;<?=$in_day_color?>"><?=$in_day?></span></td>
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
											<div id="spanMain" style="width:100%;height:<?=$spanMain_height?>px;overflow-x:hidden;overflow-y:auto;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
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
														$sql_position = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[position]' and item='position' ";
														//echo $sql_position;
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//채용형태
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "정규직";
														else if($row[work_form] == "2") $work_form = "계약직";
														else if($row[work_form] == "3") $work_form = "일용직";

														//급여유형
														//echo $row2[pay_gbn];
														if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
														else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
														else if($row2[pay_gbn] == "2") $pay_gbn = "복합근무";
														else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
														else if($row2[pay_gbn] == "4") $pay_gbn = "일급제";
														else $pay_gbn = "-";
														$pay_gbn_no = $row2[pay_gbn];

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
														$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc limit 0, 1 ";
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
														//4대보험여부
														if($row[apply_gy] == "0") $isgy_chk = "checked";
														else $isgy_chk = "";
														if($row[apply_sj] == "0") $issj_chk = "checked";
														else $issj_chk = "";
														if($row[apply_km] == "0") $iskm_chk = "checked";
														else $iskm_chk = "";
														if($row[apply_gg] == "0") $isgg_chk = "checked"; 
														else $isgg_chk = "";
														if($row[apply_jy] == "0") $isjy_chk = "checked"; 
														else $isjy_chk = "";
														//두리누리 지원 여부
														$durunuri = $row2[insurance];
														//국민연금 만60세 해당 사원
														$now_date = date("Ymd");
														$jumin_date = "19".substr($row[jumin_no],0,9);
														$age_cal = ( $now_date - $jumin_date ) / 10000;
														$age = (int)$age_cal;
														if($age_cal >= 60) {
															$iskm_chk = "";
														}
														//사업소득자 3.3% 소득세/주민세
														if($row['work_form'] == 4) {
															$check_business_yn = "0";
															$pay_gbn = "<span style='color:red' title='사업소득자'>".$pay_gbn."</a>";
														}
														else $check_business_yn = "";
													?>

													<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
														<input type="hidden" name="pay_no" value="<?=$row['sabun']?>">
														<input type="hidden" name="cust_numb" value="98">
														<input type="hidden" name="work_numb" value="64">
														<input type="hidden" name="pay_gbn" value="<?=$pay_gbn_no?>">
														<input type="hidden" name="yyyymm" value="201311">
														<input type="hidden" name="emp_name" value="<?=$name?>">
														<input type="hidden" name="emp_sdate" value="<?=$row['in_day']?>">
														<input type="hidden" name="money_hour" value="0">
														<input type="hidden" name="week_hday" value="0">
														<input type="hidden" name="year_hday" value="0">
														<input type="hidden" name="money_week" value="">
														<input type="hidden" name="sabun[]" value="<?=$row['sabun']?>">
														<input type="hidden" name="staff_name[]" value="<?=$name?>">
														<input type="hidden" name="in_day[]" value="<?=$row['in_day']?>">
														<input type="hidden" name="out_day[]" value="<?=$row['out_day']?>">
														<input type="hidden" name="position[]" value="<?=$row2['position']?>">
														<input type="hidden" name="position_txt[]" value="<?=$row_position['name']?>">
														<input type="hidden" name="step[]" value="<?=$row2['step']?>">
														<input type="hidden" name="step_txt[]" value="<?=$row_step['name']?>">
														<input type="hidden" name="work_form[]" value="<?=$work_form?>">
														<input type="hidden" name="dept_code[]" value="<?=$row2['dept']?>">
														<input type="hidden" name="dept[]" value="<?=$row2['dept_1']?>">
														<input type="hidden" name="pay_gbn_txt[]" value="<?=$pay_gbn_txt?>">
														<input type="hidden" name="pay_gbn_<?=$i?>">

														<input type="hidden" name="family_cnt" value="<?=$row['family_cnt']?>">
														<input type="hidden" name="child_cnt" value="<?=$row['child_cnt']?>">

<?
if($row4['money_month'] == 0 || $data == "load") {
	if($pay_gbn_no == 1) {
		$money_total = $row3['money_hour_ds'];
		$money_hour_ds = $row3['money_hour_ds'];
	} else if($pay_gbn_no == 4) {
		$money_total = $row3['money_day_base'];
		$money_hour_ds = $row3['money_hour_ds'];
	} else {
		$money_total = $row3['money_month_base'];
		$money_hour_ds = 0;
	}
	$workhour_day = $row3['workhour_day'];
	$workhour_ext = $row3['workhour_ext'];
	$workhour_night = $row3['workhour_night'];
	$workhour_hday = $row3['workhour_hday'];
	$workhour_year = $row3[workhour_year];

	$w_ext_add = 0;
	$w_night_add = 0;
	$w_hday_add = 0;

	//근태정보
	$att_ymd = $search_year."".$search_month;
	$sql_attendance = " select * from a4_attendance where com_code='$com_code' and sabun='$row[sabun]' ";
	//echo $sql_attendance;
	$result_attendance = sql_query($sql_attendance);
	$att_rule = array();
	//근태정보 초기화
	$w_late = "";
	$w_leave = "";
	$w_out = "";
	$w_absence = "";
	for($j=0; $row_attendance=sql_fetch_array($result_attendance); $j++) {
		//적용일자
		$att_day = date('Y-m-d',strtotime($row_attendance[att_day]));
		$att_date = explode("-", $att_day);
		//echo $att_date[0];
		//해당 년도
		if($att_date[0] == $search_year && $att_date[1] == $search_month) {
			$monthday = date('md',strtotime($row_attendance[att_day]));
			$att_rule_2 = explode(":", $row_attendance[att_time2]);
			$att_rule_1 = explode(":", $row_attendance[att_time]);
			if($att_rule_2[0] < $att_rule_1[0]) {
				$att_rule_hour = (24 - $att_rule_1[0]) + $att_rule_2[0];
			} else {
				$att_rule_hour = ($att_rule_2[0] - $att_rule_1[0]);
			}
			$att_rule_min = ($att_rule_2[1] - $att_rule_1[1]);
			$att_rule_min_cal = $att_rule_min / 60;
			$att_category = $row_attendance[att_category];
			//echo $att_category;
			$att_rule[$att_category] = $att_rule_hour + $att_rule_min_cal;
			//$att_rule[$att_category] += $att_rule[$att_category];
			if($att_category == 3) $w_late += $att_rule[$att_category];
			else if($att_category == 2) $w_leave += $att_rule[$att_category];
			else if($att_category == 4) $w_out += $att_rule[$att_category];
			else if($att_category == 1) $w_absence += $att_rule[$att_category] -1;
		}
	}
	if($j == 0) {
		$w_late = "";
		$w_leave = "";
		$w_out = "";
		$w_absence = "";
	}
	$workhour_total = 0;

	$money_hour_ts = $row3[money_hour_ts];
	//기본시급
	$money_time = $row3[money_min_base];
	$money_base = $row3[money_hour_ms];

	$money_ext = $row3[money_b1];
	$money_night = $row3[money_b2];
	$money_hday = $row3[money_b3];
	$annual_paid_holiday = $row3[money_b4];

	$money_ext_add = $row4[ext_add];
	$money_night_add = $row4[night_add];
	$money_hday_add = $row4[hday_add];

	$money_g1 = $row3[money_g1];
	$money_g2 = $row3[money_g2];
	$money_g3 = $row3[money_g3];
	$money_g4 = $row3[money_g4];
	$money_g5 = $row3[money_g5];

	$money_e1 = $row3[money_e1];
	$money_e2 = $row3[money_e2];
	$money_e3 = $row3[money_e3];
	$money_e4 = $row3[money_e4];
	$money_e5 = $row3[money_e5];
	$money_e6 = $row3[money_e6];
	$money_e7 = $row3[money_e7];
	$money_e8 = $row3[money_e8];
} else {
	if($pay_gbn_no == 1) {
		if($row4[money_hour_ds]) {
			$money_total = $row4[money_hour_ds];
		} else {
			$money_total = $row3[money_hour_ds];
		}
		$money_hour_ds = $row4[money_hour_ds];
	} else {
		//echo $row4[money_setting];
		$money_total = $row4[money_setting];
		$money_hour_ds = 0;
	}

	$workhour_day = $row4[w_day];
	$workhour_ext = $row4[w_ext];
	$workhour_night = $row4[w_night];
	$workhour_hday = $row4[w_hday];
	$workhour_year = 0;

	$w_ext_add = $row4[w_ext_add];
	$w_night_add = $row4[w_night_add];
	$w_hday_add = $row4[w_hday_add];

	$w_late = $row4[w_late];
	$w_leave = $row4[w_leave];
	$w_out = $row4[w_out];
	$w_absence = $row4[w_absence];

	$workhour_total = $row4[workhour_total];

	$money_hour_ts = $row4[money_time];
	//기본시급
	$money_time = $row4[money_min_base];
	$money_base = $row4[money_month];

	$money_ext = $row4[ext];
	$money_night = $row4[night];
	$money_hday = $row4[hday];
	$annual_paid_holiday = $row4[annual_paid_holiday];

	$money_ext_add = $row4[ext_add];
	$money_night_add = $row4[night_add];
	$money_hday_add = $row4[hday_add];

	$money_g1 = $row4[g1];
	$money_g2 = $row4[g2];
	$money_g3 = $row4[g3];
	$money_g4 = $row4[g4];
	$money_g5 = $row4[g5];

	$money_e1 = $row4[b1];
	$money_e2 = $row4[b2];
	$money_e3 = $row4[b3];
	$money_e4 = $row4[b4];
	$money_e5 = $row4[b5];
	$money_e6 = $row4[b6];
	$money_e7 = $row4[b7];
	$money_e8 = $row4[b8];
}
//최저시급 DB 출력
if($row4[money_hour_ds] == 0) {
	$money_hour_ds = $row3[money_hour_ds];
} else {
	$money_hour_ds = $row4[money_hour_ds];
}
?>

														<input type="hidden" name="w_day_<?=$i?>">
														<input type="hidden" name="w_ext_<?=$i?>">
														<input type="hidden" name="w_night_<?=$i?>">
														<input type="hidden" name="w_hday_<?=$i?>">

														<input type="hidden" name="w_ext_add_<?=$i?>">
														<input type="hidden" name="w_night_add_<?=$i?>">
														<input type="hidden" name="w_hday_add_<?=$i?>">

														<input type="hidden" name="w_late_<?=$i?>">
														<input type="hidden" name="w_leave_<?=$i?>">
														<input type="hidden" name="w_out_<?=$i?>">
														<input type="hidden" name="w_absence_<?=$i?>">

														<input type="hidden" name="workhour_total_<?=$i?>">

														<input type="hidden" name="money_hour_ds_<?=$i?>">
														<input type="hidden" name="money_hour_ts_<?=$i?>">
														<input type="hidden" name="money_time_<?=$i?>">
														<input type="hidden" name="money_day_<?=$i?>">
														<input type="hidden" name="money_month_<?=$i?>" value="<?=$money_total?>">
														<input type="hidden" name="money_setting_<?=$i?>">

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

														<!--공제내역-->
														<input type="hidden" name="tax_so_var_<?=$i?>">
														<input type="hidden" name="tax_jumin_var_<?=$i?>">
														<input type="hidden" name="advance_pay_<?=$i?>">
														<input type="hidden" name="health_<?=$i?>">
														<input type="hidden" name="yoyang_<?=$i?>">
														<input type="hidden" name="yun_<?=$i?>">
														<input type="hidden" name="goyong_<?=$i?>">
														<input type="hidden" name="end_pay_<?=$i?>">
														<input type="hidden" name="minus_<?=$i?>">
														<input type="hidden" name="minus2_<?=$i?>">
														<input type="hidden" name="etc_<?=$i?>">
														<input type="hidden" name="etc2_<?=$i?>">

														<input type="hidden" name="money_total_<?=$i?>">
														<input type="hidden" name="money_for_tax_<?=$i?>">
														<input type="hidden" name="money_gongje_<?=$i?>">
														<input type="hidden" name="money_result_<?=$i?>">
														<!--추가 필드-->
														<input type="hidden" name="money_ng4">
														<input type="hidden" name="money_ng5">
														<input type="hidden" name="advance_pay">
														<input type="hidden" name="check_money_min_yn" value="<?=$row3[check_money_min_yn]?>">
														<input type="hidden" name="check_money_b_yn" value="<?=$row3[check_money_b_yn]?>">
														<input type="hidden" name="check_money_so_yn" value="<?=$row2[apply_so]?>">
														<input type="hidden" name="money_hour_ms" value="<?=$row3[money_hour_ms]?>">
														<input type="hidden" name="check_business_yn" value="<?=$check_business_yn?>">
														<!--법정수당-->
														<input type="hidden" name="money_b1" value="<?=$row3[money_b1]?>">
														<input type="hidden" name="money_b2" value="<?=$row3[money_b2]?>">
														<input type="hidden" name="money_b3" value="<?=$row3[money_b3]?>">
														<input type="hidden" name="money_b4" value="<?=$row3[money_b4]?>">
														<!--4대보험여부-->
														<input type="hidden" name="isgy" value="<?=$isgy_chk?>">
														<input type="hidden" name="issj" value="<?=$issj_chk?>">
														<input type="hidden" name="iskm" value="<?=$iskm_chk?>">
														<input type="hidden" name="isgg" value="<?=$isgg_chk?>">
														<input type="hidden" name="isjy" value="<?=$isjy_chk?>">
														<!--두리누리-->
														<input type="hidden" name="durunuri" value="<?=$durunuri?>">
														<!--연차수당-->
														<!--<input type="hidden" name="money_year" value="<?=number_format($annual_paid_holiday)?>">-->
														<!--추가연장 추가야간 추가휴일-->
														<input type="hidden" name="workhour_ext_add" value="<?=$w_ext_add?>">
														<input type="hidden" name="workhour_night_add" value="<?=$w_night_add?>">
														<input type="hidden" name="workhour_hday_add" value="<?=$w_hday_add?>">
														<input type="hidden" name="money_ext_add" value="<?=number_format($money_ext_add)?>">
														<input type="hidden" name="money_night_add" value="<?=number_format($money_night_add)?>">
														<input type="hidden" name="money_hday_add" value="<?=number_format($money_hday_add)?>">
														<!--기타공제-->
														<!--<input type="hidden" name="minus" value="<?=$row4[minus]?>">-->
														<input type="hidden" name="minus2" value="<?=$row4[minus2]?>">
														<!--기준시급(시급제) 필드-->
														<input type="hidden" name="money_hour_ds" value="<?=$money_hour_ds?>">
														<td nowrap class="ltrow1_center_h24" style="background-color:#ffffff" width="45"><input type="hidden" style="width:100%;ime-mode:disabled;" class="textfm5" name="pay_gbn_txt" value="<?=$pay_gbn?>"><?=$pay_gbn?></td><!-- 근무유형 -->
														<td nowrap class="ltrow1_center_h24" width="65"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_month" value="<?=number_format($money_total)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 결정임금 -->

														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_day" value="<?=$workhour_day?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 소정근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext" value="<?=$workhour_ext?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 연장근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night" value="<?=$workhour_night?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 야간근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday" value="<?=$workhour_hday?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 휴일근로시간 -->

														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_late" value="<?=$w_late?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 지각 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_leave" value="<?=$w_leave?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 조퇴 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_out" value="<?=$w_out?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 외출 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_absence" value="<?=$w_absence?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 결근 -->


														<!--<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;display:none" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_year" value="<?=$workhour_year?>" onKeyUp="cal_pay('<?=$k?>');"></td>--><!-- 연차휴가시간 -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$workhour_total?>"></td><!-- 임금산출 총시간 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_hour_ts" value="<?=number_format($money_hour_ts)?>"></td><!-- 통상임금(시간급) -->
														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_time" value="<?=number_format($money_time)?>"></td><!-- 기본시급 -->
<?
//기본급 수동입력 클래스 설정
if($check_money_month_fix) {
	$class_money_base = "textfm";
	$readonly_money_base = "";
} else {
	$class_money_base = "textfm5";
	$readonly_money_base = "readonly";
}
?>
														<td nowrap class="ltrow1_center_h24" width="100"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<?=$class_money_base?>" <?=$readonly_money_base?> name="money_base" value="<?=number_format($money_base)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onchage=""></td><!-- 기본급 -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_ext != "checked") echo "textfm5"; else echo "textfm"; ?>" name="money_ext" value="<?=number_format($money_ext)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 연장근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_night != "checked") echo "textfm5"; else echo "textfm"; ?>" name="money_night" value="<?=number_format($money_night)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 야간근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_hday != "checked") echo "textfm5"; else echo "textfm"; ?>" name="money_hday" value="<?=number_format($money_hday)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 휴일근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="101"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm"  name="money_year" value="<?=number_format($annual_paid_holiday)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 연차수당 -->




														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g1" value="<?=number_format($money_g1)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성1 -->
														<td nowrap class="ltrow1_center_h24" width="138"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g2" value="<?=number_format($money_g2)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성2 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g3" value="<?=number_format($money_g3)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성3 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g4" value="<?=number_format($money_g4)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성4 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g5" value="<?=number_format($money_g5)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성5 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e1" value="<?=number_format($money_e1)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당1 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e2" value="<?=number_format($money_e2)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당2 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e3" value="<?=number_format($money_e3)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당3 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e4" value="<?=number_format($money_e4)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당4 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e5" value="<?=number_format($money_e5)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당5 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e6" value="<?=number_format($money_e6)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당6 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e7" value="<?=number_format($money_e7)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당7 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="commify(this.value, this);javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e8" value="<?=number_format($money_e8)?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 기타수당8 -->

														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="etc"  value="<?=number_format($row4[etc])?>"    onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 가불 -->
														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="etc2" value="<?=number_format($row4[etc2])?>"></td><!-- 근태공제 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4[money_total])?>"></td><!-- 임금계 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4[money_for_tax])?>"></td><!-- 과세소득 -->

														<td nowrap class="ltrow1_center_h24" width="56"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" value="<?=number_format($row4[yun])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 국민연금 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" value="<?=number_format($row4[health])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 건강보험 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" value="<?=number_format($row4[yoyang])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 장기요양보험 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" value="<?=number_format($row4[goyong])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 고용보험 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" value="<?=number_format($row4[tax_so])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay3('<?=$k?>');"></td><!-- 소득세 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" value="<?=number_format($row4[tax_jumin])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 주민세 -->
														<td nowrap class="ltrow1_center_h24" width="60"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="minus" value="<?=number_format($row4[minus])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 기타공제 -->

														<td nowrap class="ltrow1_center_h24" width="72"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4[money_gongje])?>"></td><!-- 공제계 -->
														<td nowrap class="ltrow1_center_h24" width="73"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4[money_result])?>"></td><!-- 공제후지급액 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>
													</tr>
<script type="text/javascript">
//alert('<?=$row4[money_total]?>');
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
								<div style="height:10px"></div>
								<input type="hidden" name="total_cnt" value="<?=$k?>">
								<input type="hidden" name="error_code" style="width:100%" value="code">
<?
include "./inc/pay_list_text.php";
?>
							</form>
							<br>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
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
function money_month_fix_time() {
	var f = document.dataForm;
	f.money_month_fix.checked = false;
}
<?
//공제액 수동입력 해제
if($data == "load") {
	echo "addLoadEvent(cal_pay_bt);";
}
if($pay_gbn_no == 1 && !$w_date_ok) {
	echo "addLoadEvent(money_month_fix_time);";
}
?>

function cal_pay(idx) {
	var f = document.dataForm;
	var pay_gbn,money_day;
	var money_month,money_hour,money_hour_ds,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var workhour_late,workhour_leave,workhour_out,workhour_absence,money_hour_ms;
	var week_hday,year_hday,money_base,money_time,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_g_sum, money_b_sum, money_e_sum;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result,workhour_year;

	pay_gbn 		    = toInt(f.pay_gbn 		  [idx].value);
	money_month     = toInt(f.money_month   [idx].value); //기본월급 mm--
	money_hour      = toInt(f.money_hour    [idx].value);	//기준시급 hh--
	money_hour_ds   = toInt(f.money_month 	[idx].value);	//기준시급(시급제)
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)


	workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간         
	workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간

	workhour_ext_add    = toFloat(f.workhour_ext_add   [idx].value);	//추가연장근로시간
	workhour_night_add  = toFloat(f.workhour_night_add [idx].value);	//추가야간근로시간
	workhour_hday_add   = toFloat(f.workhour_hday_add  [idx].value);	//추가휴일근로시간

	workhour_late    = toFloat(f.workhour_late   [idx].value);
	workhour_leave   = toFloat(f.workhour_leave  [idx].value);
	workhour_out     = toFloat(f.workhour_out    [idx].value);
	workhour_absence = toFloat(f.workhour_absence[idx].value);

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 


	week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
	money_base      = toInt(f.money_base    [idx].value);	// 기본급      
	money_time      = toInt(f.money_time    [idx].value);	// 기본시급
	money_ext       = toInt(f.money_ext     [idx].value);	// 연장근로수당
	money_hday      = toInt(f.money_hday    [idx].value);	// 휴일근로수당
	money_night     = toInt(f.money_night   [idx].value);	// 야간근로수당
	money_week      = toInt(f.money_week    [idx].value);	// 주휴수당 hh--
	money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--

	money_ext_add   = toInt(f.money_ext_add [idx].value);	// 연장근로수당(추가)
	money_hday_add  = toInt(f.money_hday_add[idx].value);	// 휴일근로수당(추가)
	money_night_add = toInt(f.money_night_add[idx].value);	// 야간근로수당(추가)

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
	money_total     = toInt(f.money_total   [idx].value); //임금계       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득     
	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
	tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세
	minus           = toInt(f.minus         [idx].value);	//기타공제
	minus2          = toInt(f.minus2        [idx].value);	//기타공제2
	etc           	= toInt(f.etc      	 	  [idx].value);	//가불
	etc2          	= toInt(f.etc2      	  [idx].value);	//근태공제
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
	workhour_year   = 0;
	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ) { // 5인이하
		rate_ext = 1;
		rate_night = 1;
		rate_hday = 1;
	}else{
/*
		rate_ext = 1.5;
		rate_night = 0.5;
		rate_hday = 1.5;
*/
<?
//기본연장
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_ext = $row_paycode[multiple];
} else {
	$rate_ext = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_ext = "checked";
//야간근로
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
if($row_paycode[manual] == "Y") $check_manual_night = "checked";
//휴일근로
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_hday = $row_paycode[multiple];
} else {
	$rate_hday = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_hday = "checked";
?>
		rate_ext = <?=$rate_ext?>;
		rate_night = <?=$rate_night?>;
		rate_hday = <?=$rate_hday?>;
	}

	//통상임금수당 합계
	money_g_sum = money_g1+money_g2+money_g3+money_g4+money_g5;
	//alert(money_g_sum+"="+money_g1+"+"+money_g2+"+"+money_g3+"+"+money_g4+"+"+money_g5);


	//임금합계 제외
	if(f.money_e1_gy.value != "Y") money_e1 = 0;
	if(f.money_e2_gy.value != "Y") money_e2 = 0;
	if(f.money_e3_gy.value != "Y") money_e3 = 0;
	if(f.money_e4_gy.value != "Y") money_e4 = 0;
	if(f.money_e5_gy.value != "Y") money_e5 = 0;
	if(f.money_e6_gy.value != "Y") money_e6 = 0;
	if(f.money_e7_gy.value != "Y") money_e7 = 0;
	if(f.money_e8_gy.value != "Y") money_e8 = 0;
	//기타수당 합계
	money_e_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;

	k = idx-1;
	money_month_old = f['money_month_'+k].value;
	//시급제
	//alert(pay_gbn);
	if(pay_gbn == 1) {
		money_hour = money_month;
		//임금산출 총시간
		//workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday)  -(workhour_late+workhour_leave+workhour_out+workhour_absence) ) * 1000 ) / 1000;
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//money_base = Math.round( money_hour * workhour_day );
		//기본급 고정 : 고정이 아닐 경우 기본급 계산
		if(!f.money_month_fix.checked) money_base = Math.round( money_hour * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//통상임금 = 결정임금 -> 통상임금 (기본급+통상임금수당)/근로시간 150624 (국과장 오류 발견으로 소스 수정)
		//money_hour_ts = money_month;
		money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day );
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	//일급제
	} else if(pay_gbn == 4) {
		money_hour = money_month;
		//임금산출 총시간
		//workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday)  -(workhour_late+workhour_leave+workhour_out+workhour_absence) ) * 1000 ) / 1000;
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//alert(money_hour);
		money_base = Math.round( (money_hour/8) * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//통상임금 = 결정임금
		money_hour_ts = money_month;
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	} else {
		//workhour_total 임금산출 총시간 mm--
		//workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year -(workhour_late+workhour_leave+workhour_out+workhour_absence);
		workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year;

		//money_base 기본급
		//money_base = money_month - money_ext - money_hday - money_night - money_year;
		
		//alert(money_base);
		//money_hour_ts 통상임금(시간급) 
		if( workhour_total != 0 ){
			//기본급 수동입력
			//alert(f.check_money_min_yn[idx].value);
			if(f.check_money_min_yn[idx].value == "Y") {
				//alert(f['money_month_'+k].value);
				if(money_month_old == money_month) {
					money_hour_ms = toInt(f.money_hour_ms[idx].value);
					if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					if(money_hour_ms != money_base) {
						if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					}
					//if(idx == 3) alert(money_base);
				} else {
					if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
				}
				//급여 해당월 중간 입사자 기본급 설정
				if(money_base > money_month_old) {
					if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				}
				money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
				//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
				//alert(money_base);
			} else {
				if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				money_hour_ts = ( money_month - money_g_sum ) / workhour_day;
			}
		}
	}
	//결정임금 0 이면 통상시급, 기본급 0
	if(money_month == 0) money_hour_ts = 0;
	if(money_month == 0) money_base = 0;
	//money_ext 연장근로수당 
	//money_hday 휴일근로수당
	//money_night 야간근로수당 
	//money_year 연차수당 -----------------------------------

	//법정수당 수동입력 (사원관리-급여정보) 연장근로 수동입력 140610
	if(!f.manual_ext.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_ext = parseInt(f.money_b1[idx].value);
		else money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
	}
	//alert(money_ext);
	//수동입력 야간근로
	if(!f.manual_night.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_night = parseInt(f.money_b2[idx].value);
		else money_night = Math.round(workhour_night * money_hour_ts * rate_night);
	}
	//수동입력 휴일근로
	if(!f.manual_hday.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_hday = parseInt(f.money_b3[idx].value);
		else money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
	}
	//추가근로수당
	money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
	money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
	money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
	//연차수당
	//money_year = Math.round(workhour_year * money_hour_ts );

	//결정임금 변경으로 통상시급, 기본급 변경 반복문
	if(money_month_old != money_month) {
		for(i=0;i<20;i++) {
			//money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
			//시급제 (통상임금 설정)
			if(pay_gbn == 1) money_hour_ts = money_month;
			else money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
			//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
			money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
			//alert(money_ext);
			money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
			money_night = Math.round(workhour_night * money_hour_ts * rate_night);
			money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
			money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
			money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
		}
	}
	//통상임금(시간급) 반올림
	money_hour_ts = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//기본급 계산식
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);

	//근태공제
	etc2 = money_time * (workhour_late+workhour_leave+workhour_out+workhour_absence);

	//money_total 임금계 
	//money_total = money_month+money_g_sum+money_e_sum;
	//money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - (etc + etc2);
	//가불 임금계(입금총액)에 포함
	money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - etc2;
	//money_for_tax 과세소득 
	//money_for_tax = money_total - money_g1 - money_g2 - money_g3;

<?
//차량유지
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e1_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e1_tax_limit = 0;
}
//식대
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e2_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e2_tax_limit = 0;
}
//자녀보육
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e3_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e3_tax_limit = 0;
}
//연구활동비
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e4' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e4_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e4_tax_limit = 0;
}
?>

	//기타수당 과세포함 여부, 비과세 한도 설정
	//alert(f.money_e6_income.value);
	if(f.money_e1_income.value != "Y") {
		if(money_e1 > toInt(<?=$money_e1_tax_limit?>)) money_e1 = money_e1 - toInt(<?=$money_e1_tax_limit?>);
		else money_e1 = 0;		
	}
	if(f.money_e2_income.value != "Y") {
		if(money_e2 > toInt(<?=$money_e2_tax_limit?>)) money_e2 = money_e2 - toInt(<?=$money_e2_tax_limit?>);
		else money_e2 = 0;
	}
	if(f.money_e3_income.value != "Y") {
		if(money_e3 > toInt(<?=$money_e3_tax_limit?>)) money_e3 = money_e3 - toInt(<?=$money_e3_tax_limit?>);
		else money_e3 = 0;
	}
	if(f.money_e4_income.value != "Y") {
		if(money_e4 > toInt(<?=$money_e4_tax_limit?>)) money_e4 = money_e4 - toInt(<?=$money_e4_tax_limit?>);
		else money_e4 = 0;
	}
	if(f.money_e5_income.value != "Y") {
		if(money_e5 > toInt(<?=$money_e5_tax_limit?>)) money_e5 = money_e5 - toInt(<?=$money_e5_tax_limit?>);
		else money_e5 = 0;
	}
	if(f.money_e6_income.value != "Y") {
		if(money_e6 > toInt(<?=$money_e6_tax_limit?>)) money_e6 = money_e6 - toInt(<?=$money_e6_tax_limit?>);
		else money_e6 = 0;
	}
	if(f.money_e7_income.value != "Y") {
		if(money_e7 > toInt(<?=$money_e7_tax_limit?>)) money_e7 = money_e7 - toInt(<?=$money_e7_tax_limit?>);
		else money_e7 = 0;
	}
	if(f.money_e8_income.value != "Y") {
		if(money_e8 > toInt(<?=$money_e8_tax_limit?>)) money_e8 = money_e8 - toInt(<?=$money_e8_tax_limit?>);
		else money_e8 = 0;
	}

	//f.error_code.value += money_e1;
	//기타수당 합계 (과세소득 계산용)
	money_e_income_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;
	//alert(money_e_income_sum);
	//f.error_code.value += ", "+money_e_income_sum;

	money_for_tax = (money_total - money_e_sum) + money_e_income_sum;

	//두루누리 지원금 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	if(f.durunuri[idx].value == "1") durunuri_50 = 2;
	else durunuri_50 = 1;

	//4대보험 수동입력 유무
	if(!f.manual_4insure.checked) {
		//money_yun 국민연금  
		//money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10
		money_yun = get_round( parseInt(money_for_tax) * 0.045 / durunuri_50 );
		//money_health 건강보험 
		//money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
		//money_health = get_round( parseInt(money_for_tax) * 0.02945 );
		//money_health = get_round( parseInt(money_for_tax) * 0.02995 );
		money_health = get_round( parseInt(money_for_tax) * 0.03035 );
		//money_yoyang 장기요양보험 
		//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		money_yoyang = get_round( money_health* 0.0655  );
		//alert(money_yoyang);
		//money_goyong 고용보험
		money_goyong = get_round( parseInt(money_for_tax) * 0.0065 / durunuri_50 );
		//4대보험 공제 제외
		if(f.iskm[idx].value != "checked") money_yun = 0;
		if(f.isgg[idx].value != "checked") money_health = 0;
		if(f.isjy[idx].value != "checked") money_yoyang = 0;
		if(f.isgy[idx].value != "checked") money_goyong = 0;
		//if(f.isgy.value == "checked") money_goyong = 0;
	}
	//세금 수동입력 유무
	if(!f.manual_tax.checked) {
		//tax_so 소득세
		if(f.check_money_so_yn[idx].value == "0") {
			tax_so = GetTax( money_for_tax, idx );
		} else {
			tax_so = 0;
		}
		//사업소득자 3.3% 적용
		if(f.check_business_yn[idx].value == "0") {
			//alert(f.money_time[idx].value);
			//money_day = toInt(f.money_time[idx].value) * 8;
			tax_so = get_round(money_for_tax* 0.03 );
			if(tax_so <= 1000) tax_so = 0;
		}
		//tax_jumin 주민세
		tax_jumin = get_round(tax_so* 0.1 );
	}

	//money_gongje 공제계 
<?
//대성하이테크 , 대성산업기계, 네오스 공제계 가불 포함
if($comp_print_type == "D" || $com_code == "20099") {
?>
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2+etc;
<?
} else {
?>
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
<?
}
?>
	//money_result 공제후 지급액 
<?
//에스피아이, 씨앤에스 가불 처리
if($com_code == "20232" || $com_code == "20149") {
?>
	money_result = money_total - (money_gongje + etc);
<?
} else {
?>
	money_result = money_total - money_gongje;
<?
}
?>
	//소수점 2자리 반올림
	workhour_total = workhour_total.toFixed(2);
	money_hour_ts = money_hour_ts.toFixed(2);
	//alert(money_hour_ts);

	//통상임금(시간급) < 최저임금(2014년)
	money_min = 5210;
	if(money_hour_ts < money_min) {
		f.money_hour_ts[idx].style.color = "red";
	} else {
		f.money_hour_ts[idx].style.color = "#343434";
	}

	//천단위 구분
	money_hour_ts = number_format(money_hour_ts);
	money_base = number_format(money_base);
	money_ext = number_format(money_ext);
	money_hday = number_format(money_hday);
	money_night = number_format(money_night);
	money_year = number_format(money_year);

	money_ext_add = number_format(money_ext_add);
	money_hday_add = number_format(money_hday_add);
	money_night_add = number_format(money_night_add);

	//money_hour_ts = number_format(money_hour_ts);

	money_total = number_format(money_total);
	money_for_tax = number_format(money_for_tax);

	money_yun = number_format(money_yun);
	money_health = number_format(money_health);
	money_yoyang = number_format(money_yoyang);
	money_goyong = number_format(money_goyong);
	tax_so = number_format(tax_so);
	tax_jumin = number_format(tax_jumin);
	minus2 = number_format(minus2);
	etc2 = number_format(etc2);

	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//변수 input 입력
	//f.error_code.value = money_base;
	f.money_hour_ts[idx].value = money_hour_ts //money_hour_ts 통상임금(시간급) 
	f.workhour_total[idx].value = workhour_total //workhour_total 임금산출 총시간 mm--
<?
if(!$row3['money_month']) {
?>
	f.money_base[idx].value = money_base //money_base 기본급
<? } ?>
	if(f.check_money_b_yn[idx].value != "Y") {
		if(!f.manual_ext.checked) f.money_ext[idx].value = money_ext //money_ext 연장근로수당
		if(!f.manual_night.checked) f.money_night[idx].value = money_night //money_night 야간근로수당
		if(!f.manual_hday.checked) f.money_hday[idx].value = money_hday //money_hday 휴일근로수당
	}
	//f.money_year[idx].value = money_year //money_year 연차수당 ------------------------

	f.money_ext_add[idx].value = money_ext_add //money_ext 연장근로수당(추가)
	f.money_hday_add[idx].value = money_hday_add //money_hday 휴일근로수당(추가)
	f.money_night_add[idx].value = money_night_add //money_night 야간근로수당(추가)





	f.money_total[idx].value = money_total //money_total 임금계 
	f.money_for_tax[idx].value = money_for_tax //money_for_tax 과세소득 

	f.money_yun[idx].value = money_yun //money_yun 국민연금 
	f.money_health[idx].value = money_health //money_health 건강보험 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang 장기요양보험 
	f.money_goyong[idx].value = money_goyong //money_goyong 고용보험 

	f.tax_so[idx].value = tax_so //tax_so 소득세 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin 주민세 

	f.minus2[idx].value = minus2 //근태공제
	f.etc2[idx].value = etc2 //근태공제

	f.money_gongje[idx].value = money_gongje //money_gongje 공제계 
	f.money_result[idx].value = money_result //money_result 공제후 지급액 
}
</script>
<?
//도움말
include "inc/pay_list_help.php";
?>
<script language="javascript">
//급여유형 변경 (월급제)
function pay_gbn_month() {
	var frm = document.dataForm;
	frm.pay_gbn_value.value = "0";
}
addLoadEvent(pay_gbn_month);
</script>
</body>
</html>
