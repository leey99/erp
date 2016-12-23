<?
$sub_menu = "400103";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//현재 년도
$year_now = date("Y");

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt['comp_print_type']) {
	$comp_print_type = $row_com_opt['comp_print_type'];
} else {
	$comp_print_type = "default";
}

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
//화성시장애인부모회 활동보조인 퇴사자 포함 150819
if($comp_print_type == "H") {
	//$sql_search .= " and ( a.gubun != 2 ) ";
	//다시 근무기간 급여대장 표시로 변경 151229
	//임시퇴사 시 퇴사일 무시 160125
	$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' or a.out_temp = '1' ) ";
} else {
	$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' ) ";
}
//시급제 근로자만 표시
$sql_search .= " and ( b.pay_gbn = '1' ) ";
//화성시장애인부모회 활동보조인 $comp_print_type == "H" => $com_code == 20399 변경 160405
if($com_code == 20399) {
	$sql_search .= " and ( b.position = '13' ) ";
} else {
	//화성서남부 : 활보전담
	$sql_search .= " and ( b.position = '5' ) ";
}
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
//화성시장애인부모회 활동보조인 정렬 기준 퇴사일 지정 여부, 성명 150819
/*
if($comp_print_type == "H") {
	$sst = "a.out_day";
	$sod = "asc";
		$sst2 = ", a.name";
		$sod2 = "asc";
}
*/
//활동보조인 정렬 성명 가다라 순, 입사일 160106
if($comp_print_type == "H") {
	$sst = "a.name";
	$sod = "asc";
	$sst2 = ", a.in_day";
	$sod2 = "asc";
}
$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 999;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

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
//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
$comp_print_type = $row_com_opt[comp_print_type];
//급여지급일
if($row_com_opt[pay_day_time]) {
	if($search_month == 12) {
		$pay_date = "1월 ".$row_com_opt[pay_day_time]."일";
	} else {
		$pay_date = ($search_month+1)."월 ".$row_com_opt[pay_day_time]."일";
	}
	//급여지급일 당월 체크 유무
	if($row_com_opt[pay_day_now_month_time] == 1) {
		$pay_date = $search_month."월 ".$row_com_opt[pay_day_time]."일";
	}
} else {
	$pay_date = "급여지급일 미지정";
}
//급여지급일 말일 체크
if($row_com_opt[pay_day_last_time]) {
	if($search_month == 12) {
		$pay_date = "1월 말일";
	} else {
		$pay_date = ($search_month+1)."월 말일";
	}
	//급여지급일 당월 체크 유무
	if($row_com_opt[pay_day_now_month_time] == 1) {
		$pay_date = $search_month."월 말일";
	}
}
if($row_com_opt[pay_calculate_day1_time]) {
	$pay_calculate_date = $row_com_opt[pay_calculate_day1_time]." ".$row_com_opt[pay_calculate_day_period1_time]."일 ~ ".$row_com_opt[pay_calculate_day2_time]." ".$row_com_opt[pay_calculate_day_period2_time]."일";
}
//급여관리 DB (급여반영) 년월
$sql_w_date = " select * from pibohum_base_pay_h where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$result_w_date = sql_query($sql_w_date);
$row_w_date=mysql_fetch_array($result_w_date);
//echo $sql_w_date;
if($row_w_date['w_date'] != "0000-00-00") {
	$w_date = $row_w_date['w_date'];
	$w_time = $row_w_date['w_time'];
	$w_date_ok = "1";
} else {
	$w_date = "<span style='color:red'>임시저장</span>";
	$w_time = "";
	$w_date_ok = "";
}
if($row_w_date['w_date'] == "") {
	$w_date = "<span style='color:red'>미등록</span>";
	$w_time = "";
	$w_date_ok = "";
}
//페이지 타이틀
//화성시장애인부모회 활동보조인
$sub_title = "엑셀업로드(활동보조인)";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;
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



	f.mode.value = mode;
	f.action = "pay_update_type_h.php";
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
//2015년도 7월 개정 근로소득 간의세액표 150821
if($search_year >= 2015 && $search_month >= 7) {
	include "./inc/ary_tax_2015.php";
} else {
	include "./inc/ary_tax.php";
}
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
		}
	}
}
//국민연금 수동입력 체크 국민연금(사업장) 수동입력 텍스트 표시 함수 151029
function check_manual_yun_func(m_name) {
	if(m_name.checked) getId('check_manual_yun_text').innerHTML = "(수동입력)";
	else getId('check_manual_yun_text').innerHTML = "";
}

function cal_pay2(idx){
	var f = document.dataForm;
	var workhour_1, workhour_2, workhour_3, workhour_1_hday, workhour_2_hday, workhour_3_hday, workhour_edu, workhour_phone;
	var workhour_total;
	var money_ext,money_night,money_hday,money_year;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,etc,etc2,money_gongje,money_result;
	var c_money_yun,c_money_health,c_money_yoyang,c_money_goyong,c_money_sanjae,c_money_gongje;

	workhour_1    = toFloat(getId('workhour_1_'+idx).innerHTML);	//보건복지 평근
	workhour_1_hday    = toFloat(getId('workhour_1_hday_'+idx).innerHTML);	//보건복지 휴심
	workhour_2    = toFloat(getId('workhour_2_'+idx).innerHTML);	//경기도 평근
	workhour_2_hday    = toFloat(getId('workhour_2_hday'+idx).innerHTML);	//경기도 휴심
	workhour_3    = toFloat(getId('workhour_3_'+idx).innerHTML);	//화성시 평근
	workhour_3_hday    = toFloat(getId('workhour_3_hday'+idx).innerHTML);	//화성시 휴심
	workhour_edu    = toFloat(getId('workhour_edu_'+idx).innerHTML);	//교육시간
	workhour_phone    = toFloat(getId('workhour_phone_'+idx).innerHTML);	//스마트폰

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
	money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--        

	money_total     = toInt(f.money_total   [idx].value); //임금계       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득
	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
	tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세       
	minus           = toInt(f.minus         [idx].value);	//기타공제
	etc           	= toInt(f.etc      	 	  [idx].value);	//가불
	etc2          	= toInt(f.etc2      	  [idx].value);	//근태공제
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계
	//공제(사업장) 자동계산(수동입력 해제) 국민연금,건강보험,장기요양 복사 150910
	if(!f.c_manual_4insure.checked) {
		f.c_money_yun[idx].value = f.money_yun[idx].value;	//국민연금     
		f.c_money_health[idx].value = f.money_health[idx].value;	//건강보험     
		f.c_money_yoyang[idx].value = f.money_yoyang[idx].value;	//장기요양보험
	}
	c_money_yun     = toInt(f.c_money_yun   [idx].value);	//국민연금     
	c_money_health  = toInt(f.c_money_health[idx].value);	//건강보험     
	c_money_yoyang  = toInt(f.c_money_yoyang[idx].value);	//장기요양보험 
	c_money_goyong  = toInt(f.c_money_goyong[idx].value);	//고용보험     
	c_money_sanjae  = toInt(f.c_money_sanjae[idx].value);	//산재보험
	c_money_gongje  = toInt(f.c_money_gongje[idx].value);	//공제계
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액

	//money_gongje 공제계 = 국민연금+건강보험+장기요양보험+고용보험+소득세+주민세
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus;
	c_money_gongje = c_money_yun+c_money_health+c_money_yoyang+c_money_goyong+c_money_sanjae;

	//money_result 공제후 지급액 
	money_result = money_total - money_gongje;
	f.money_gongje[idx].value = number_format(money_gongje); //money_gongje 공제계 
	f.c_money_gongje[idx].value = number_format(c_money_gongje); //c_money_gongje 공제계 
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
//천단위 콤바 (음수 허용)
function checkThousand_negative(inputVal, type, keydown) {
	main = document.dataForm;
	var inputVal = type.value;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";
	var input	= "";
	//alert(event.keyCode);
	//백스페이스 탭 시프트+탭 좌 우 Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) chk = chk - 1;
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		type.value=total.replace(/\-,/g,"-");
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
//숫자만 입력 ('-' 포함)
function onlyNumber_negative() {
	//alert(event.keyCode);
	if(((event.keyCode<48)||(event.keyCode>57)) && event.keyCode !=13 && event.keyCode !=45) {
		event.returnValue=false;
		alert("숫자와 음수만 입력할 수 있습니다.");
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
//엑셀 업로드일 경우
if($data == "excel") {
	//엑셀 업로드 파일 추출 151214
	$sql_opt2 = " select pay_excel_1 from com_list_gy_opt2 where com_code='$com_code' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	if($row_opt2['pay_excel_1']) $excel = $row_opt2['pay_excel_1'];
	//엑셀 리더
	include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
	if($excel) {
		$UpFileExt = "xls";
		$objPHPExcel = new PHPExcel();
		$upload_path = $_SERVER["DOCUMENT_ROOT"]."/easynomu/files/pay_excel";
		$upfile_path = $upload_path."/".$excel;
		//echo $upfile_path;
		if(file_exists($upfile_path)) {
			$inputFileType = 'Excel2007';
			if($UpFileExt == "xls") {
				$inputFileType = 'Excel5';	
			}
			//echo $inputFileType;
			$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
			$objPHPExcel = $objReader->load($upfile_path);
			$objPHPExcel ->setActiveSheetIndex(0);
			$objWorksheet = $objPHPExcel->getActiveSheet(); 
			$maxRow = $objWorksheet->getHighestRow(); 
			//echo $maxRow;
			$m = 0;
			$count_page = 0;
			//연번
			$start_line = 4;
			//echo $excel_count;
			//echo $excel_type;
			$p = 0;
			for ($i = 0; $i < $maxRow; $i++) {
				$k = $i + $start_line;
				$excel_sabun = trim($objWorksheet->getCell('A' . $k)->getValue()); 
				$excel_name[$i] = $objWorksheet->getCell('B' . $k)->getValue();
				$excel_in_day[$i] = $objWorksheet->getCell('C' . $k)->getValue();
				$excel_position[$i] = $objWorksheet->getCell('D' . $k)->getValue();
				$excel_pay_gbn[$i] = $objWorksheet->getCell('E' . $k)->getValue();

				$excel_workhour_1[$excel_sabun] = trim($objWorksheet->getCell('F' . $k)->getValue()); 
				$excel_workhour_1_hday[$excel_sabun] = trim($objWorksheet->getCell('G' . $k)->getValue()); 
				$excel_workhour_2[$excel_sabun] = trim($objWorksheet->getCell('H' . $k)->getValue());
				$excel_workhour_2_hday[$excel_sabun] = trim($objWorksheet->getCell('I' . $k)->getValue()); 
				$excel_workhour_3[$excel_sabun] = trim($objWorksheet->getCell('J' . $k)->getValue());
				$excel_workhour_3_hday[$excel_sabun] = trim($objWorksheet->getCell('K' . $k)->getValue());
				$excel_workhour_edu[$excel_sabun] = trim($objWorksheet->getCell('L' . $k)->getValue());
				$excel_workhour_phone[$excel_sabun] = trim($objWorksheet->getCell('M' . $k)->getValue());
				$excel_annual_paid_holiday[$excel_sabun] = trim($objWorksheet->getCell('N' . $k)->getValue());

				$excel_yun[$excel_sabun] = trim($objWorksheet->getCell('P' . $k)->getValue());
				$excel_health[$excel_sabun] = trim($objWorksheet->getCell('Q' . $k)->getValue());
				$excel_yoyang[$excel_sabun] = trim($objWorksheet->getCell('R' . $k)->getValue());
				$excel_goyong[$excel_sabun] = trim($objWorksheet->getCell('S' . $k)->getValue());
				$excel_tax_so[$excel_sabun] = trim($objWorksheet->getCell('T' . $k)->getValue());
				$excel_tax_jumin[$excel_sabun] = trim($objWorksheet->getCell('U' . $k)->getValue());
				$excel_minus[$excel_sabun] = trim($objWorksheet->getCell('V' . $k)->getValue());

				$excel_c_yun[$excel_sabun] = trim($objWorksheet->getCell('W' . $k)->getValue());
				$excel_c_health[$excel_sabun] = trim($objWorksheet->getCell('X' . $k)->getValue());
				$excel_c_yoyang[$excel_sabun] = trim($objWorksheet->getCell('Y' . $k)->getValue());
				$excel_c_goyong[$excel_sabun] = trim($objWorksheet->getCell('Z' . $k)->getValue());
				$excel_c_sanjae[$excel_sabun] = trim($objWorksheet->getCell('AA' . $k)->getValue());

				//한글 인코딩
				$excel_name[$excel_sabun] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
				$excel_position[$excel_sabun] = iconv("UTF-8", "EUC-KR", $excel_position[$i]);
				$excel_pay_gbn[$excel_sabun] = iconv("UTF-8", "EUC-KR", $excel_pay_gbn[$i]);
				//echo $excel_name[$excel_sabun];

				// 천단위 콤마 제거 DB 저장
				$excel_annual_paid_holiday[$excel_sabun] = preg_replace('@,@', '', $excel_annual_paid_holiday[$excel_sabun]);
				$excel_yun[$excel_sabun] = preg_replace('@,@', '', $excel_yun[$excel_sabun]);
				$excel_health[$excel_sabun] = preg_replace('@,@', '', $excel_health[$excel_sabun]);
				$excel_yoyang[$excel_sabun] = preg_replace('@,@', '', $excel_yoyang[$excel_sabun]);
				$excel_goyong[$excel_sabun] = preg_replace('@,@', '', $excel_goyong[$excel_sabun]);
				$excel_tax_so[$excel_sabun] = preg_replace('@,@', '', $excel_tax_so[$excel_sabun]);
				$excel_tax_jumin[$excel_sabun] = preg_replace('@,@', '', $excel_tax_jumin[$excel_sabun]);
				$excel_minus[$excel_sabun] = preg_replace('@,@', '', $excel_minus[$excel_sabun]);
				$excel_c_yun[$excel_sabun] = preg_replace('@,@', '', $excel_c_yun[$excel_sabun]);
				$excel_c_health[$excel_sabun] = preg_replace('@,@', '', $excel_c_health[$excel_sabun]);
				$excel_c_yoyang[$excel_sabun] = preg_replace('@,@', '', $excel_c_yoyang[$excel_sabun]);
				$excel_c_goyong[$excel_sabun] = preg_replace('@,@', '', $excel_c_goyong[$excel_sabun]);
				$excel_c_sanjae[$excel_sabun] = preg_replace('@,@', '', $excel_c_sanjae[$excel_sabun]);
			}
		}
	}
}
?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1300" border="0" align="center" cellpadding="0" cellspacing="0">
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
							<form name="searchForm" method="get">
								<input type="hidden" name="select_type" value="">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="" style="table-layout:">
									<col width="220">
									<col width="440">
									<col width="">
									<tr>
										<td class="tdrow">
<?
//디윅스 / 화성시장애인부모회
if($com_code == "20284" || $com_code == "20399") {
	if($com_code == "20399") $add_where_code = " and ( code >= 3 and code <= 6 ) ";
	else $add_where_code = "";
?>
											<strong>년월</strong>
<?
}
?>
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="goSearch();">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
			<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
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
											<b>급여지급일</b> : <?=$pay_date?>  / <b>최종저장</b> : <?=$w_date?> <?=$w_time?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrow" colspan="2" style="height:38px">
											<b>임금산출기간</b> : <?=$pay_calculate_date?>
										</td>
										<td nowrap class="tdrow" colspan="" style="text-align:right">
											<a href="<?=$PHP_SELF?>?data=load&select_type=<?=$select_type?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>"><img src="images/btn_staff_pay_get_big.png" border="0"></a>
											<a href="<?=$PHP_SELF?>?select_type=<?=$select_type?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>"><img src="images/btn_last_pay_get_big.png" border="0"></a>
											<a href="javascript:cal_pay_bt();"><img src="images/btn_paycal_big.png" border="0" /></a>
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_preview = "javascript:alert_demo();";
	$url_paylist = "javascript:alert_demo();";
} else {
	$url_save = "javascript:pay_json();";
	$url_preview = "javascript:goInput('preview');";
	$url_paylist = "javascript:printPayList();";
}
?>
											<a href="<?=$url_save?>"><img src="images/btn_paysave_big.png" border="0" /></a>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
<!--제이쿼리 -->
<script type="text/javascript" src="popup/images/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="popup/images/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
function pay_step_btn(no) {
	for(i=1;i<=3;i++) {
		getId("pay_step"+i).src = "images/pay_step"+i+"_h.gif";
	}
	getId("pay_step"+no).src = "images/pay_step"+no+"_h_on.gif";
}
$(function(){
	$('#step1').click(function() { 
		$('#spanTop').scrollLeft(0);
		$('#spanMain').scrollLeft(0);
		pay_step_btn(1);
	});
	$('#step2').click(function() { 
		$('#spanTop' ).scrollLeft(764);
		$('#spanMain').scrollLeft(764);
		pay_step_btn(2);
	});
	$('#step3').click(function() { 
		$('#spanTop' ).scrollLeft(1528);
		$('#spanMain').scrollLeft(1528);
		pay_step_btn(3);
	});
});
//json ajax
function pay_json() {
	var excel = "<?=$excel?>";
	var jData = "";
	var total = $('input[name=total_count]').val();
	if(excel == "") {
		alert("엑셀서식 업로드가 되지 않았습니다.");
		return false;
	}
	var name = new Array();
	jData = '{"year":"'+$('input[name=search_year]').val()+'","month":"'+$('input[name=search_month]').val()+'","code":"<?=$com_code?>",';
	var f = document.dataForm;
	if(f.manual_4insure.checked) {
		jData += '"manual_4insure":"1",';
	}
	if(f.manual_tax.checked) {
		jData += '"manual_tax":"1",';
	}
	if(f.c_manual_4insure.checked) {
		jData += '"c_manual_4insure":"1",';
	}
	for(i=1;i<=total;i++) {
		sabun = $('input[name=sabun_'+i+']').val();
		//name = $('#name_'+i+'').html();
		workhour_1 = $('#workhour_1_'+i+'').html();
		workhour_2 = $('#workhour_2_'+i+'').html();
		workhour_3 = $('#workhour_3_'+i+'').html();
		workhour_1_hday = $('#workhour_1_hday_'+i+'').html();
		workhour_2_hday = $('#workhour_2_hday_'+i+'').html();
		workhour_3_hday = $('#workhour_3_hday_'+i+'').html();
		w_edu = $('#workhour_edu_'+i+'').html();
		w_phone = $('#workhour_phone_'+i+'').html();

		money_year = $('#money_year_'+i+'').html();
		workhour_total = $('#workhour_total_'+i+'').html();
		money_total = $('#money_total_'+i+'').html();
		money_for_tax = $('#money_for_tax_'+i+'').html();

		money_yun = $('#money_yun_'+i+'').html();
		money_health = $('#money_health_'+i+'').html();
		money_yoyang = $('#money_yoyang_'+i+'').html();
		money_goyong = $('#money_goyong_'+i+'').html();
		tax_so = $('#tax_so_'+i+'').html();
		tax_jumin = $('#tax_jumin_'+i+'').html();
		minus = $('#minus_'+i+'').html();

		money_gongje = $('#money_gongje_'+i+'').html();
		money_result = $('#money_result_'+i+'').html();

		c_money_yun = $('#c_money_yun_'+i+'').html();
		c_money_health = $('#c_money_health_'+i+'').html();
		c_money_yoyang = $('#c_money_yoyang_'+i+'').html();
		c_money_goyong = $('#c_money_goyong_'+i+'').html();
		c_money_sanjae = $('#c_money_sanjae_'+i+'').html();

		c_money_gongje = $('#c_money_gongje_'+i+'').html();
		retirement_pension = $('#retirement_pension_'+i+'').html();

		//jData += '"sabun_'+i+'":"'+sabun+'","name_'+i+'":"'+name+'",';
		jData += '"sabun_'+i+'":"'+sabun+'",';
		jData += '"workhour_1_'+i+'":"'+workhour_1+'","workhour_2_'+i+'":"'+workhour_2+'","workhour_3_'+i+'":"'+workhour_3+'",';
		jData += '"workhour_1_hday_'+i+'":"'+workhour_1_hday+'","workhour_2_hday_'+i+'":"'+workhour_2_hday+'","workhour_3_hday_'+i+'":"'+workhour_3_hday+'",';
		jData += '"w_edu_'+i+'":"'+w_edu+'","w_phone_'+i+'":"'+w_phone+'",';
		jData += '"money_year_'+i+'":"'+money_year+'","workhour_total_'+i+'":"'+workhour_total+'","money_total_'+i+'":"'+money_total+'","money_for_tax_'+i+'":"'+money_for_tax+'",';

		jData += '"money_yun_'+i+'":"'+money_yun+'","money_health_'+i+'":"'+money_health+'","money_yoyang_'+i+'":"'+money_yoyang+'","money_goyong_'+i+'":"'+money_goyong+'",';
		jData += '"tax_so_'+i+'":"'+tax_so+'","tax_jumin_'+i+'":"'+tax_jumin+'","minus_'+i+'":"'+minus+'",';

		jData += '"money_gongje_'+i+'":"'+money_gongje+'","money_result_'+i+'":"'+money_result+'",';
		jData += '"c_money_yun_'+i+'":"'+c_money_yun+'","c_money_health_'+i+'":"'+c_money_health+'","c_money_yoyang_'+i+'":"'+c_money_yoyang+'","c_money_goyong_'+i+'":"'+c_money_goyong+'","c_money_sanjae_'+i+'":"'+c_money_sanjae+'",';

		jData += '"c_money_gongje_'+i+'":"'+c_money_gongje+'","retirement_pension_'+i+'":"'+retirement_pension+'",';
	}
	jData += '"total":"'+total+'"}';
	//alert(jData);
	$.ajax({
		type: 'post',
		dataType: 'json',
		url: 'pay_excel_beistand_west_json.php',
		data: 'jData='+escape(jData),
		success: function (res) {
			var check = res.check;
			//if(check == "ok") alert("정상적으로 급여저장 되었습니다.");
			alert(res.total+"명 급여저장 되었습니다.");
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});
}
</script>
							<!--검색 -->
							<form name="dataForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="mode">
								<input type="hidden" name="pay_gbn_value" value="0">
								<input type="hidden" name="code" value="<?=$com_code?>">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="total_count" value="<?=$total_count?>">

								<div>
<!--엑셀파일/업로드 저장 -->
<script type="text/javascript">
//<![CDATA[
function excel_upload(obj) {
	var frm = document.dataForm;
	if (frm[obj].value == "") {
		alert("파일을 등록하세요.");
		frm.pay_file.focus();
		return;
	}
	frm.action = "pay_excel_beistand_west_upload.php";
	frm.submit();
	return;
}
//]]>
</script>
								<div style="padding:0 0 10px 0;">
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_excel_save = "javascript:alert_demo();";
	$url_excel_upload = "javascript:alert_demo();";
} else {
	$url_excel_save = "pay_excel_beistand_west_save.php?code=".$com_code."&data=".$data."&select_type=".$select_type."&search_year=".$search_year."&search_month=".$search_month;
	$url_excel_upload = "javascript:excel_upload('pay_excel_1');";
}
?>
									<a href="<?=$url_excel_save?>"><img src="images/btn_excel_save.png" style="vertical-align:middle;" border="0" alt="엑셀저장" /></a>
									<input name="pay_excel_1" type="file" class="textfm_search" style="width:320px;margin:0 0 0 10px;vertical-align:middle;" />
									<a href="<?=$url_excel_upload?>"><img src="images/btn_excel_upload.png" style="vertical-align:middle;" border="0" alt="엑셀업로드" /></a>
									<span style="vertical-align:middle;"><a href="/easynomu/files/pay_excel/<?=$excel?>" target="_blank"><?=$excel?></a></span>
								</div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id="Tab_cust_tab_01_0" valign="bottom"> 
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
										<td width="6"></td> 
										<td width="" align="left">
											<div id="step1" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step1_h_on.gif" id="pay_step1"></div>
										</td> 
										<td width="" align="left">
											<div id="step2" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step2_h.gif" id="pay_step2"></div>
										</td> 
										<td width="" align="left">
											<div id="step3" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step3_h.gif" id="pay_step3"></div>
										</td> 
										<td align="right" style="padding-left:20px"><strong>사원수</strong> <?=$total_count?>명</td>
										<td align="right" style="padding-left:20px">※ 공제내역 수동입력 시 공제(근로자, 사업장)의 4대보험, 세금에 채크를 하십시오.</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<!--리스트 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td width="245" valign="top">
											<table width="100%" height="79" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
												<col width="">
												<col width="68">
												<col width="68">
												<tr>
													<td class="tdhead_center" colspan="3">근로자 정보</td>
												</tr>
												<tr>
													<td class="tdhead_center">이름</td>
													<td class="tdhead_center">입사일</td>
													<td class="tdhead_center">직위</td>
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
$sql_manual = " select * from pibohum_base_pay_h where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by manual desc ";
//echo $sql_manual;
$row_manual = sql_fetch($sql_manual);
//echo "//수입".$row_manual[manual];
$manual_array = explode(",",$row_manual['manual']);
if($manual_array[3] == "1") $check_manual_4insure = "checked";
if($manual_array[4] == "1") $check_manual_tax = "checked";
if($manual_array[5] == "1") $check_c_manual_4insure = "checked";
if($manual_array[6] == "1") $check_manual_yun = "checked";
//공제액 수동입력 해제
if($data == "load") {
	$check_manual_4insure = "";
	$check_manual_tax = "";
	$check_c_manual_4insure = "";
	$check_manual_yun = "";
} else if($data == "excel") {
	if($m_4insure == "1") $check_manual_4insure = "checked";
	if($m_tax== "1") $check_manual_tax = "checked";
	if($m_4insure_c == "1") $check_c_manual_4insure = "checked";
	if($m_yun == "1") $check_manual_yun = "checked";
}

//type h 보건복지, 경기도, 화성시(평근,휴심), 교육시간, 스마트폰
/*
$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);
$money_time_edu = $row_opt2['money_time_edu'];
$money_time_phone = $row_opt2['money_time_phone'];
*/
//시간당 급여 단가 적용 DB
$start_date = $search_year.".".$search_month.".01";
$end_date = $search_year.".".$search_month.".31";
$where_time = " and end_date >= '$start_date' and start_date <= '$end_date' ";
$sql_time = " select * from com_list_gy_time where com_code='$com_code' $where_time ";
//echo $sql_time;
$result_time = sql_query($sql_time);
$row_time = mysql_fetch_array($result_time);
//type h 보건복지, 경기도, 화성시(평근,휴심), 교육시간, 스마트폰
$money_time1 = $row_time['money_time1'];
$money_time1_hday = $row_time['money_time1_hday'];
$money_time2 = $row_time['money_time2'];
$money_time2_hday = $row_time['money_time2_hday'];
$money_time3 = $row_time['money_time3'];
$money_time3_hday = $row_time['money_time3_hday'];
$money_time1_com = $row_time['money_time1_com'];
$money_time1_hday_com = $row_time['money_time1_hday_com'];
$money_time2_com = $row_time['money_time2_com'];
$money_time2_hday_com = $row_time['money_time2_hday_com'];
$money_time3_com = $row_time['money_time3_com'];
$money_time3_hday_com = $row_time['money_time3_hday_com'];
$money_time_edu = $row_time['money_time_edu'];
$money_time_phone = $row_time['money_time_phone'];
//echo "money_time1 : ".$money_time1;
//입력폼 넓이
$pay_list_width = 2293;
?>
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" height="79" border="0" cellpadding="0" cellspacing="1" class="bgtable">
																<tr>
																	<td class="tdhead_center" colspan="10">근로시간(월) </td>
																	<td class="tdhead_center" colspan="2">임금합계</td>
																	<td class="tdhead_center" colspan="8">공제(근로자)</td>
																	<td class="tdhead_center" rowspan="3" width="107">공제후<br>지급액 </td>
																	<td class="tdhead_center" colspan="6">공제(사업장)</td>
																	<td class="tdhead_center" rowspan="3" width="100">퇴직연금</td>
																	<td class="tdhead_center" rowspan="3" width=""></td>
																</tr>
																<tr>
																	<td class="tdhead_center" colspan="2">보건복지</td>
																	<td class="tdhead_center" colspan="2">경기도</td>
																	<td class="tdhead_center" colspan="2">화성시</td>
																	<td class="tdhead_center" rowspan="2" width="66">교육시간<br><?=number_format($money_time_edu)?></td>
																	<td class="tdhead_center" rowspan="2" width="66">스마트폰<br><?=number_format($money_time_phone)?></td>
																	<td class="tdhead_center" rowspan="2" width="76">교통<br>지원금</td>
																	<td class="tdhead_center" rowspan="2" width="64">총<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="72">서비스<br>이용금액</td>
																	<td class="tdhead_center" rowspan="2" width="72">급여</td>
																	<td class="tdhead_center" colspan="4"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 4대보험</td>
																	<td class="tdhead_center" colspan="2"><input type="checkbox" name="manual_tax" <?=$check_manual_tax?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 세금</td>
																	<td class="tdhead_center" colspan="1">기타</td>
																	<td class="tdhead_center" rowspan="2" width="92">공제계</td>

																	<td class="tdhead_center" colspan="5"><input type="checkbox" name="c_manual_4insure" <?=$check_c_manual_4insure?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 4대보험</td>
																	<td class="tdhead_center" rowspan="2" width="98">공제계</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="1" width="56">평근<br><?=number_format($money_time1)?></td>
																	<td class="tdhead_center" rowspan="1" width="56">휴심<br><?=number_format($money_time1_hday)?></td>
																	<td class="tdhead_center" rowspan="1" width="56">평근<br><?=number_format($money_time2)?></td>
																	<td class="tdhead_center" rowspan="1" width="56">휴심<br><?=number_format($money_time2_hday)?></td>
																	<td class="tdhead_center" rowspan="1" width="56">평근<br><?=number_format($money_time3)?></td>
																	<td class="tdhead_center" rowspan="1" width="56">휴심<br><?=number_format($money_time3_hday)?></td>

																	<td class="tdhead_center" rowspan="1" width="80">국민연금<input type="checkbox" name="manual_yun" <?=$check_manual_yun?> onclick="check_manual_yun_func(this)" value="1" title="수동입력" style="vertical-align:middle;"></td>
																	<td class="tdhead_center" rowspan="1" width="80">건강보험</td>
																	<td class="tdhead_center" rowspan="1" width="76">장기요양</td>
																	<td class="tdhead_center" rowspan="1" width="80">고용보험</td>
																	<td class="tdhead_center" rowspan="1" width="80">소득세</td>
																	<td class="tdhead_center" rowspan="1" width="80">주민세</td>
																	<td class="tdhead_center" rowspan="1" width="80">기타공제</td>

																	<td class="tdhead_center" rowspan="1" width="90">국민연금<div id="check_manual_yun_text" style="color:red;font-size:9px;"></div></td>
																	<td class="tdhead_center" rowspan="1" width="90">건강보험</td>
																	<td class="tdhead_center" rowspan="1" width="85">장기요양</td>
																	<td class="tdhead_center" rowspan="1" width="90">고용보험</td>
																	<td class="tdhead_center" rowspan="1" width="90">산재보험</td>
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
//$spanMain_height = $total_count * 25 + 25;
$spanMain_height = 351;
?>
											<div id="spanLeft" >
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<col width="">
													<col width="68">
													<col width="68">
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
														$name = cut_str($row[name], 10, "..");

														//사원정보 기본 DB
														$sql1 = " select * from pibohum_base where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result1 = sql_query($sql1);
														$row1=mysql_fetch_array($result1);

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

														//재직상태
														if($row1['gubun'] == 0) $gubun = "재직";
														else if($row1['gubun'] == "1") $gubun = "휴직";
														else if($row1['gubun'] == "2") $gubun = "퇴직";
														else if($row1['gubun'] == "3") $gubun = "수습";

														//임시퇴사자 회색 블럭 표시 150819
														if($row['out_temp'] && $row['out_day'] <= $out_day_base) {
															$tr_class = "list_row_now_gr";
														} else {
															$tr_class = "list_row_now_wh";
														}
													?>

													<tr id="tr1_<?=$i?>" class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';getId('tr2_<?=$i?>').className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';getId('tr2_<?=$i?>').className='<?=$tr_class?>';">
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
														<td nowrap class="ltrow1_left"><b title="<?=substr($row['jumin_no'],0,2).".".substr($row['jumin_no'],2,2).".".substr($row['jumin_no'],4,2)?>(<?=$gubun?>)" id="name_<?=$k?>"><?=$name?></b></td>
														<td nowrap class="ltrow1_center_h24"><span style="<?=$in_day_color?>"><?=$in_day?></span></td>
														<td nowrap class="ltrow1_center_h24"><span><?=$row_position['name']?></span></td>
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
											<!--배열 초기화용 input-->
											<input type="hidden" name="check_money_so_yn" />
											<input type="hidden" name="check_business_yn" />
											<input type="hidden" name="isgy" />
											<input type="hidden" name="issj" />
											<input type="hidden" name="iskm" />
											<input type="hidden" name="isgg" />
											<input type="hidden" name="isjy" />
											<input type="hidden" name="durunuri" />
											<input type="hidden" name="family_cnt" />
											<input type="hidden" name="child_cnt" />
											<input type="hidden" name="pay_yun" />
											<input type="hidden" name="pay_health" />
											<input type="hidden" name="pay_goyong" />
											<div id="spanMain" style="width:100%;overflow-x:hidden;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
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

														//연장근로
														$sql_attendance = " select * from a4_attendance where com_code='$row[com_code]' and sabun='$row[sabun]' and att_day like '201310%' ";
														//echo $sql_attendance;
														$result_attendance = sql_query($sql_attendance);
														$row_attendance=mysql_fetch_array($result_attendance);

														//사원정보 추가 DB (급여정보)
														$sql3 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														//echo $sql3;
														$result3 = sql_query($sql3);
														$row3=mysql_fetch_array($result3);

														//급여관리 DB (급여반영) 년월
														$sql4 = " select * from pibohum_base_pay_h where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc limit 0, 1 ";
														//echo $sql4;
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

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
														$durunuri = $row2['insurance'];
														//국민연금 만60세 해당 사원
														$now_date = date("Ymd");
														$jumin_date = "19".substr($row['jumin_no'],0,9);
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

														//임시퇴사자 회색 블럭 표시 150819
														if($row['out_temp'] && $row['out_day'] <= $out_day_base) {
															$tr_class = "list_row_now_gr";
														} else {
															$tr_class = "list_row_now_wh";
														}
													?>

													<tr id="tr2_<?=$i?>" class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';getId('tr1_<?=$i?>').className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';getId('tr1_<?=$i?>').className='<?=$tr_class?>';">
														<input type="hidden" name="sabun_<?=$k?>" value="<?=$row['sabun']?>" />
														<input type="hidden" name="check_money_so_yn" value="<?=$row2['apply_so']?>" />
														<input type="hidden" name="check_business_yn" value="<?=$check_business_yn?>" />
														<input type="hidden" name="isgy" value="<?=$isgy_chk?>">
														<input type="hidden" name="issj" value="<?=$issj_chk?>">
														<input type="hidden" name="iskm" value="<?=$iskm_chk?>">
														<input type="hidden" name="isgg" value="<?=$isgg_chk?>">
														<input type="hidden" name="isjy" value="<?=$isjy_chk?>">
														<input type="hidden" name="durunuri" value="<?=$durunuri?>" />
														<input type="hidden" name="family_cnt" value="<?=$row['family_cnt']?>">
														<input type="hidden" name="child_cnt" value="<?=$row['child_cnt']?>">
														<input type="hidden" name="pay_yun" value="<?=$row3['pay_yun']?>" /><!--국민연금-->
														<input type="hidden" name="pay_health" value="<?=$row3['pay_health']?>" /><!--건강보험-->
														<input type="hidden" name="pay_goyong" value="<?=$row3['pay_goyong']?>" /><!--고용보험-->
<?
//엑셀 업로드
if($data == "excel") {
	//사번 변수
	$sabun = $row['sabun'];

	$workhour_1 = $excel_workhour_1[$sabun];
	$workhour_2 = $excel_workhour_2[$sabun];
	$workhour_3 = $excel_workhour_3[$sabun];
	$workhour_1_hday = $excel_workhour_1_hday[$sabun];
	$workhour_2_hday = $excel_workhour_2_hday[$sabun];
	$workhour_3_hday = $excel_workhour_3_hday[$sabun];

	$workhour_edu = $excel_workhour_edu[$sabun];
	$workhour_phone = $excel_workhour_phone[$sabun];
	$annual_paid_holiday = $excel_annual_paid_holiday[$sabun];

	//공제내역, 기타공재
	$row4['yun'] = $excel_yun[$sabun];
	$row4['health'] = $excel_health[$sabun];
	$row4['yoyang'] = $excel_yoyang[$sabun];
	$row4['goyong'] = $excel_goyong[$sabun];
	$row4['tax_so'] = $excel_tax_so[$sabun];
	$row4['tax_jumin'] = $excel_tax_jumin[$sabun];
	$row4['minus'] = $excel_minus[$sabun];

	//공제내역(사업장)
	$row4['c_yun'] = $excel_c_yun[$sabun];
	$row4['c_health'] = $excel_c_health[$sabun];
	$row4['c_yoyang'] = $excel_c_yoyang[$sabun];
	$row4['c_goyong'] = $excel_c_goyong[$sabun];
	$row4['c_sanjae'] = $excel_c_sanjae[$sabun];

} else {
	//최종저장일 미등록, 사원급여정보 불러오기일 경우
	if(!$w_date_ok || $data == "load") {
		$workhour_1 = "";
		$workhour_2 = "";
		$workhour_3 = "";
		$workhour_1_hday = "";
		$workhour_2_hday = "";
		$workhour_3_hday = "";
		$workhour_edu = "";
		$workhour_phone = "";
		$workhour_total = "";
		$annual_paid_holiday = "";
		$row4['money_total'] = "";
		$row4['money_for_tax'] = "";

		//공제내역, 기타공재
		$row4['yun'] = "";
		$row4['health'] = "";
		$row4['yoyang'] = "";
		$row4['goyong'] = "";
		$row4['tax_so'] = "";
		$row4['tax_jumin'] = "";
		$row4['minus'] = "";
		$row4['money_gongje'] = "";
		$row4['money_result'] = "";

		//공제내역(사업장)
		$row4['c_yun'] = "";
		$row4['c_health'] = "";
		$row4['c_yoyang'] = "";
		$row4['c_goyong'] = "";
		$row4['c_sanjae'] = "";
		$row4['c_money_gongje'] = "";
		$row4['retirement_pension'] = "";

	} else {
		$workhour_1 = $row4['w_1'];
		$workhour_2 = $row4['w_2'];
		$workhour_3 = $row4['w_3'];
		$workhour_1_hday = $row4['w_1_hday'];
		$workhour_2_hday = $row4['w_2_hday'];
		$workhour_3_hday = $row4['w_3_hday'];
		$workhour_edu = $row4['w_edu'];
		$workhour_phone = $row4['w_phone'];
		//시간 0 일 경우 빈값으로 표시
		if(!$workhour_1) $workhour_1 = "";
		if(!$workhour_2) $workhour_2 = "";
		if(!$workhour_3) $workhour_3 = "";
		if(!$workhour_1_hday) $workhour_1_hday = "";
		if(!$workhour_2_hday) $workhour_2_hday = "";
		if(!$workhour_3_hday) $workhour_3_hday = "";
		if(!$workhour_edu) $workhour_edu = "";
		if(!$workhour_phone) $workhour_phone = "";

		$workhour_total = $row4[workhour_total];

		$money_hday = $row4[hday];
		$annual_paid_holiday = $row4['annual_paid_holiday'];
	}
}
//연차수당 -> 교통지원금
if($annual_paid_holiday) $annual_paid_holiday = number_format($annual_paid_holiday);
else $annual_paid_holiday = "";
?>
														<td nowrap class="ltrow1_center_h24" width="56">
<?
//echo $total_count;
if($k < $total_count) {
	$k_next = $k+1;
}
?>
															<span id="workhour_1_<?=$k?>"><?=$workhour_1?></span><!--보건복지 평근-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="56">
															<span id="workhour_1_hday_<?=$k?>"><?=$workhour_1_hday?></span><!--보건복지 휴심-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="56">
															<span id="workhour_2_<?=$k?>"><?=$workhour_2?></span><!--경기도 평근-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="56">
															<span id="workhour_2_hday_<?=$k?>"><?=$workhour_2_hday?></span><!--경기도 휴심-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="56">
															<span id="workhour_3_<?=$k?>"><?=$workhour_3?></span><!--화성시 평근-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="56">
															<span id="workhour_3_hday_<?=$k?>"><?=$workhour_3_hday?></span><!--화성시 휴심-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="66">
															<span id="workhour_edu_<?=$k?>"><?=$workhour_edu?></span><!--교육시간-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="66">
															<span id="workhour_phone_<?=$k?>"><?=$workhour_phone?></span><!--스마트폰-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="76"><span id="money_year_<?=$k?>"><?=$annual_paid_holiday?></span></td><!--교통지원금-->
														<td nowrap class="ltrow1_center_h24" width="64"><span id="workhour_total_<?=$k?>"><?=$workhour_total?></span></td><!--임금산출 총시간-->
														<td nowrap class="ltrow1_center_h24" width="72"><span id="money_total_<?=$k?>"><? if($row4['money_total']) echo number_format($row4['money_total']);?></span></td><!--서비스이용금액-->
														<td nowrap class="ltrow1_center_h24" width="72"><span id="money_for_tax_<?=$k?>"><? if($row4['money_for_tax']) echo number_format($row4['money_for_tax']);?></span></td><!--급여-->

														<td nowrap class="ltrow1_center_h24" width="80"><span id="money_yun_<?=$k?>"><? if($row4['yun']) echo number_format($row4['yun']);?></span></td><!--국민연금-->
														<td nowrap class="ltrow1_center_h24" width="80"><span id="money_health_<?=$k?>"><? if($row4['health']) echo number_format($row4['health']);?></span></td><!--건강보험-->
														<td nowrap class="ltrow1_center_h24" width="76"><span id="money_yoyang_<?=$k?>"><? if($row4['yoyang']) echo number_format($row4['yoyang']);?></span></td><!--장기요양보험-->
														<td nowrap class="ltrow1_center_h24" width="80"><span id="money_goyong_<?=$k?>"><? if($row4['goyong']) echo number_format($row4['goyong']);?></span></td><!--고용보험-->
														<td nowrap class="ltrow1_center_h24" width="80"><span id="tax_so_<?=$k?>"><? if($row4['tax_so']) echo number_format($row4['tax_so']);?></span></td><!--소득세-->
														<td nowrap class="ltrow1_center_h24" width="80"><span id="tax_jumin_<?=$k?>"><? if($row4['tax_jumin']) echo number_format($row4['tax_jumin']);?></span></td><!--주민세-->
														<td nowrap class="ltrow1_center_h24" width="80"><span id="minus_<?=$k?>"><? if($row4['minus']) echo number_format($row4['minus']);?></span></td><!--기타공제-->

														<td nowrap class="ltrow1_center_h24" width="92"><span id="money_gongje_<?=$k?>"><? if($row4['money_gongje']) echo number_format($row4['money_gongje'])?></span></td><!--공제계-->
														<td nowrap class="ltrow1_center_h24" width="107"><span id="money_result_<?=$k?>"><? if($row4['money_result']) echo number_format($row4['money_result']);?></span></td><!--공제후지급액-->

														<td nowrap class="ltrow1_center_h24" width="90"><span id="c_money_yun_<?=$k?>"><? if($row4['c_yun']) echo number_format($row4['c_yun']);?></span></td><!--국민연금-->
														<td nowrap class="ltrow1_center_h24" width="90"><span id="c_money_health_<?=$k?>"><? if($row4['c_health']) echo number_format($row4['c_health']);?></span></td><!--건강보험-->
														<td nowrap class="ltrow1_center_h24" width="85"><span id="c_money_yoyang_<?=$k?>"><? if($row4['c_yoyang']) echo number_format($row4['c_yoyang']);?></span></td><!--장기요양보험-->
														<td nowrap class="ltrow1_center_h24" width="90"><span id="c_money_goyong_<?=$k?>"><? if($row4['c_goyong']) echo number_format($row4['c_goyong']);?></span></td><!--고용보험-->
														<td nowrap class="ltrow1_center_h24" width="90"><span id="c_money_sanjae_<?=$k?>"><? if($row4['c_sanjae']) echo number_format($row4['c_sanjae']);?></span></td><!--산재보험-->

														<td nowrap class="ltrow1_center_h24" width="98"><span id="c_money_gongje_<?=$k?>"><? if($row4['c_money_gongje']) echo number_format($row4['c_money_gongje']);?></span></td><!--공제계-->
														<td nowrap class="ltrow1_center_h24" width="100"><span id="retirement_pension_<?=$k?>"><? if($row4['retirement_pension']) echo number_format($row4['retirement_pension']);?></span></td><!--퇴직연금-->
														<td nowrap class="ltrow1_center_h24" width=""></td><!--여유분-->
													</tr>
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

								</div>
							</form>
							<br>
						</td>
					</tr>
				</table>
<?
$mode = "popup";
?>
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
	if($i == $k) echo "alert('급여계산이 완료 되었습니다.');";
}
?>
}
<?
//공제액 수동입력 해제
if($data == "load") {
	//echo "addLoadEvent(cal_pay_bt);";
}
?>
function cal_pay(idx) {
	var f = document.dataForm;
	var money_day, pay_yun, pay_health, pay_goyong, money_for_4i, c_money_yun,c_money_health,c_money_yoyang,c_money_goyong,c_money_sanjae,c_money_gongje;
	var workhour_1, workhour_2, workhour_3, workhour_1_hday, workhour_2_hday, workhour_3_hday, workhour_edu, workhour_phone, money_pay, retirement_pension;
	var workhour_total,money_year;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,etc,etc2,money_gongje,money_result;

	workhour_1    = toFloat(getId('workhour_1_'+idx).innerHTML);	//보건복지 평근
	workhour_1_hday    = toFloat(getId('workhour_1_hday_'+idx).innerHTML);	//보건복지 휴심
	workhour_2    = toFloat(getId('workhour_2_'+idx).innerHTML);	//경기도 평근
	workhour_2_hday    = toFloat(getId('workhour_2_hday_'+idx).innerHTML);	//경기도 휴심
	workhour_3    = toFloat(getId('workhour_3_'+idx).innerHTML);	//화성시 평근
	workhour_3_hday    = toFloat(getId('workhour_3_hday_'+idx).innerHTML);	//화성시 휴심
	workhour_edu    = toFloat(getId('workhour_edu_'+idx).innerHTML);	//교육시간
	workhour_phone    = toFloat(getId('workhour_phone_'+idx).innerHTML);	//스마트폰
	money_year      = toInt(getId('money_year_'+idx).innerHTML);	//교통지원금
	workhour_total  = toFloat(getId('workhour_total_'+idx).innerHTML);	//총 근로시간

	money_total     = toInt(getId('money_total_'+idx).innerHTML); //서비스 이용금액
	money_for_tax   = toInt(getId('money_for_tax_'+idx).innerHTML);	//급여

	money_yun       = toInt(getId('money_yun_'+idx).innerHTML);	//국민연금
	money_health    = toInt(getId('money_health_'+idx).innerHTML);	//건강보험     
	money_yoyang    = toInt(getId('money_yoyang_'+idx).innerHTML);	//장기요양보험 
	money_goyong    = toInt(getId('money_goyong_'+idx).innerHTML);	//고용보험
	tax_so          = toInt(getId('tax_so_'+idx).innerHTML);	//소득세       
	tax_jumin       = toInt(getId('tax_jumin_'+idx).innerHTML);	//주민세
	minus           = toInt(getId('minus_'+idx).innerHTML);	//기타공제
	money_gongje    = toInt(getId('money_gongje_'+idx).innerHTML);	//공제계       
	money_result    = toInt(getId('money_result_'+idx).innerHTML);	//공제후 지급액

	c_money_yun    = toInt(getId('c_money_yun_'+idx).innerHTML);	//국민연금
	c_money_health = toInt(getId('c_money_health_'+idx).innerHTML);	//건강보험
	c_money_yoyang = toInt(getId('c_money_yoyang_'+idx).innerHTML);	//장기요양보험
	c_money_goyong = toInt(getId('c_money_goyong_'+idx).innerHTML);	//고용보험
	c_money_sanjae = toInt(getId('c_money_sanjae_'+idx).innerHTML);	//산재보험
	c_money_gongje = toInt(getId('c_money_gongje_'+idx).innerHTML);	//공제계(사업장)
	retirement_pension = toInt(getId('retirement_pension_'+idx).innerHTML);	//퇴직연금

	workhour_total = parseInt( ( workhour_1 + workhour_2 + workhour_3 + workhour_1_hday + workhour_2_hday + workhour_3_hday ) * 1000 ) / 1000;
	workhour_total = Math.round(workhour_total*100)/100;

	money_total = parseInt( (workhour_1*<?=$money_time1_com?>) + (workhour_2*<?=$money_time2_com?>) + (workhour_3*<?=$money_time3_com?>) + (workhour_1_hday*<?=$money_time1_hday_com?>) + (workhour_2_hday*<?=$money_time2_hday_com?>) + (workhour_3_hday*<?=$money_time3_hday_com?>) + money_year );

	money_pay = parseInt( (workhour_1*<?=$money_time1?>) + (workhour_2*<?=$money_time2?>) + (workhour_3*<?=$money_time3?>) + (workhour_1_hday*<?=$money_time1_hday?>) + (workhour_2_hday*<?=$money_time2_hday?>) + (workhour_3_hday*<?=$money_time3_hday?>) + (workhour_edu*<?=$money_time_edu?>) + (workhour_phone*<?=$money_time_phone?>) + money_year );
	money_for_tax = money_pay;

	//두루누리 지원금 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	if(f.durunuri[idx].value == "1") durunuri_50 = 2;
	else durunuri_50 = 1;
	//4대보험 수동입력 유무 (자동 보험 요율 적용)
	if(!f.manual_4insure.checked) {
		//월평균신고금액
		pay_yun = toInt(f.pay_yun[idx].value);
		//alert(pay_yun);
		pay_health = toInt(f.pay_health[idx].value);
		pay_goyong = toInt(f.pay_goyong[idx].value);
		if(pay_yun > 0) money_for_4i = pay_yun;
		else money_for_4i = money_for_tax;
		//money_yun 국민연금  
		//money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10

		//국민연금 수동입력이 아니면(자동) 151029
		if(!f.manual_yun.checked) money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//money_health 건강보험 
		//money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
		//money_health = get_round( parseInt(money_for_tax) * 0.02945 );
		//money_health = get_round( parseInt(money_for_tax) * 0.02995 );
		if(pay_health > 0) money_for_4i = pay_health;
		else money_for_4i = money_for_tax;
		money_health = get_round( parseInt(money_for_4i) * 0.03035 );
		//money_yoyang 장기요양보험 
		//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		money_yoyang = get_round( money_health* 0.0655  );
		//alert(money_yoyang);
		//money_goyong 고용보험
		if(pay_goyong > 0) money_for_4i = pay_goyong;
		else money_for_4i = money_for_tax;
		money_goyong = get_round( parseInt(money_for_4i) * 0.0065 / durunuri_50 );
		//4대보험 공제 제외
		if(f.iskm[idx].value != "checked") money_yun = 0;
		if(f.isgg[idx].value != "checked") money_health = 0;
		if(f.isjy[idx].value != "checked") money_yoyang = 0;
		if(f.isgy[idx].value != "checked") money_goyong = 0;
	}
	//세금 수동입력 유무
	//if(idx == 1) alert(f.manual_tax.checked);
	if(!f.manual_tax.checked) {
		//tax_so 소득세
		if(f.check_money_so_yn[idx].value == "0") {
			//tax_so = GetTax(idx);
			tax_so = GetTax( money_for_tax, idx );
			//if(idx == 1) alert(idx);
		} else {
			tax_so = 0;
		}
		//사업소득자 3.3% 적용
		if(f.check_business_yn[idx].value == "0") {
			tax_so = get_round(money_for_tax* 0.03 );
			if(tax_so <= 1000) tax_so = 0;
		}
		//tax_jumin 주민세
		tax_jumin = get_round(tax_so* 0.1 );
	}

	//4대보험 수동입력 유무(사업장)
	if(!f.c_manual_4insure.checked) {
		//월평균신고금액
		pay_yun = toInt(f.pay_yun[idx].value);
		//alert(pay_yun);
		pay_goyong = toInt(f.pay_goyong[idx].value);
		if(pay_yun > 0) money_for_4i = pay_yun;
		else money_for_4i = money_for_tax;
		//c_money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//국민연금 수동입력이 아니면(자동) 151029
		if(!f.manual_yun.checked) c_money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//건강보험 계산(사업장)
		pay_health = toInt(f.pay_health[idx].value);
		if(pay_health > 0) money_for_4i = pay_health;
		else money_for_4i = money_for_tax;
		c_money_health = get_round( parseInt(money_for_4i) * 0.03035 );
		//money_yoyang 장기요양보험 
		//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		c_money_yoyang = get_round( money_health* 0.0655  );
		//alert(money_yoyang);
		//money_goyong 고용보험
		if(pay_goyong > 0) money_for_4i = pay_goyong;
		else money_for_4i = money_for_tax;
		c_money_goyong = get_round( parseInt(money_for_4i) * 0.00899 / durunuri_50 );
		//산재보험
		c_money_sanjae = get_round( parseInt(money_for_4i) * 0.00784 / durunuri_50 );
		//4대보험 공제 제외 (사업장)
		if(f.iskm[idx].value != "checked") c_money_yun = 0;
		if(f.isgg[idx].value != "checked") c_money_health = 0;
		if(f.isjy[idx].value != "checked") c_money_yoyang = 0;
		if(f.isgy[idx].value != "checked") c_money_goyong = 0;
		if(f.issj[idx].value != "checked") c_money_sanjae = 0;
	}
	//국민연금, 건강보험, 장기요양, 퇴직연금 60시간 미만 근로자 0 처리 150909
	if(workhour_total < 60) {
		if(!f.manual_4insure.checked) {
			money_yun = 0;
			money_health = 0;
			money_yoyang = 0;
		}
		if(!f.c_manual_4insure.checked) {
			c_money_yun = 0;
			c_money_health = 0;
			c_money_yoyang = 0;
		}
		retirement_pension = 0;
	} else {
		retirement_pension = Math.ceil((money_for_tax / 12)/10)*10;
	}
	//money_gongje 공제계 
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus;
	c_money_gongje = c_money_yun+c_money_health+c_money_yoyang+c_money_goyong+c_money_sanjae;
	//if(idx == 1) alert(c_money_gongje);
	//money_result 공제후 지급액 
	money_result = money_for_tax - money_gongje;

	//소수점 2자리 반올림
	workhour_total = workhour_total.toFixed(2);

	//천단위 구분
	money_year = number_format(money_year);

	money_total = number_format(money_total);
	money_for_tax = number_format(money_for_tax);

	money_yun = number_format(money_yun);
	money_health = number_format(money_health);
	money_yoyang = number_format(money_yoyang);
	money_goyong = number_format(money_goyong);

	c_money_yun = number_format(c_money_yun);
	c_money_health = number_format(c_money_health);
	c_money_yoyang = number_format(c_money_yoyang);
	c_money_goyong = number_format(c_money_goyong);
	c_money_sanjae = number_format(c_money_sanjae);
	c_money_gongje = number_format(c_money_gongje);
	retirement_pension = number_format(retirement_pension);

	tax_so = number_format(tax_so);
	tax_jumin = number_format(tax_jumin);
	etc2 = number_format(etc2);

	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//변수 input 입력
	getId('workhour_total_'+idx).innerHTML = workhour_total //workhour_total 임금산출 총시간 mm--

	getId('money_total_'+idx).innerHTML = money_total //money_total 임금계 
	getId('money_for_tax_'+idx).innerHTML = money_for_tax //money_for_tax 과세소득 

	getId('money_yun_'+idx).innerHTML = money_yun //money_yun 국민연금 
	getId('money_health_'+idx).innerHTML = money_health //money_health 건강보험 
	getId('money_yoyang_'+idx).innerHTML = money_yoyang //money_yoyang 장기요양보험 
	getId('money_goyong_'+idx).innerHTML = money_goyong //money_goyong 고용보험 

	getId('c_money_yun_'+idx).innerHTML = c_money_yun //c_money_yun 국민연금 
	getId('c_money_health_'+idx).innerHTML = c_money_health //c_money_health 건강보험 
	getId('c_money_yoyang_'+idx).innerHTML = c_money_yoyang //c_money_yoyang 장기요양보험 
	getId('c_money_goyong_'+idx).innerHTML = c_money_goyong //c_money_goyong 고용보험 
	getId('c_money_sanjae_'+idx).innerHTML = c_money_sanjae //c_money_sanjae 산재보험
	getId('c_money_gongje_'+idx).innerHTML = c_money_gongje //c_money_gongje 공제계(사업장)
	getId('retirement_pension_'+idx).innerHTML = retirement_pension //퇴직연금

	getId('tax_so_'+idx).innerHTML = tax_so //tax_so 소득세 
	getId('tax_jumin_'+idx).innerHTML = tax_jumin //tax_jumin 주민세 

	getId('money_gongje_'+idx).innerHTML = money_gongje //money_gongje 공제계 
	getId('money_result_'+idx).innerHTML = money_result //money_result 공제후 지급액 
}
//급여유형 변경 (시급제)
function pay_gbn_time() {
	var frm = document.dataForm;
	frm.pay_gbn_value.value = "1";
}
addLoadEvent(pay_gbn_time);
</script>
</body>
</html>
