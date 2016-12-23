<div id="loading" style="position:absolute;top:0px;right:0px;left:0px;bottom:0px;background:#000;z-index:100;color:#FFF;padding:20px;">
	잠시만 기다려 주십시오. 페이지 로딩 중입니다.
</div>
<?
$sub_menu = "300600";
include_once("./_common.php");

//결산 : 권한(대표, 지사장, 본부장, 부장, 경리담당, 관리자) 설정 150914
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master") {
	alert("해당 페이지를 열람할 권한이 없습니다.");
} else {
	//접근 권한 있는 사용자 관리자 권한 160331
	$is_admin = "super";
}

//현재 년도
$year_now = date("Y");
//전체
$mode = "all";

//년도 설정
if(!$search_year) $search_year = date("Y");

//년도, 월 설정 (현재 년월 이전달) 150703
if(!$search_month) {
	$search_month = date("m");
	//echo $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month = 12;
	} else {
		$search_year_minus = 0;
		$search_month -= 1;
	}
	if($search_month < 10) $search_month = "0".$search_month;
	$search_year = date("Y");
	$search_year -= $search_year_minus;
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

if($is_admin == "super") {
	$com_code = 395;
}
$colspan = 12;

$sql_search = " where a.com_code='$com_code' ";

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
//$sql_search .= " and ( b.dept = '1' ) ";
//모두 표시 160118 ---------------------------------------------------------------------------------------
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

if($is_admin == "super") {
	$sst = "a.com_code";
	$sod = "desc";
}
if($sort1) $sod .= ", ";

if (!$sst1) {
	if($sort1) {
		if($sort1 == "dept") $sort1 = "dept_1";
		if($sort1 == "in_day" || $sort1 == "name") $sst1 = "a.".$sort1;
		else $sst1 = "b.".$sort1;
	} else {
		$sst1 = "b.position";
		$sod1 = "asc";
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "dept") $sort2 = "dept_1";
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "dept") $sort3 = "dept_1";
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
	} else {
		$sst3 = ", b.dept_1";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "dept") $sort4 = "dept_1";
		if($sort4 == "in_day" || $sort4 == "name") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sub_title = "급여관리";
$g4[title] = $sub_title." : 결산 : ".$easynomu_name;

$sql_order = " order by $sst $sod $sst1 $sod1 $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

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

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "급여계산 : 전체";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
//echo $sql;

//급여반영 테이블 넓이
$pay_list_width = 3550;

//급여관리 DB (급여반영) 년월
$sql_w_date = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$result_w_date = sql_query($sql_w_date);
$row_w_date=mysql_fetch_array($result_w_date);
//echo $sql_w_date;
if($row_w_date['w_date'] != "0000-00-00") {
	$w_date = $row_w_date['w_date'];
	$w_date_ok = "1";
} else {
	$w_date = "<span style='color:red'>임시저장</span>";
	$w_date_ok = "";
}
if($row_w_date['w_date'] == "") {
	$w_date = "<span style='color:red'>미등록</span>";
	$w_date_ok = "";
}
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
//급여지급일
if($row_com_opt['pay_day']) {
	if($search_month == 12) {
		$pay_date = "1월 ".$row_com_opt['pay_day']."일";
	} else {
		$pay_date = number_format($search_month+1)."월 ".$row_com_opt['pay_day']."일";
	}
	//급여지급일 당월 체크 유무
	if($row_com_opt['pay_day_now_month'] == 1) {
		$pay_date = number_format($search_month)."월 ".$row_com_opt['pay_day']."일";
	}
} else {
	$pay_date = "급여지급일 미지정";
}
//임금산출기간
//임금산출기간1 전월
if($row_com_opt['pay_calculate_day1'] == "전월") {
	if($search_month == 1) {
		$pay_calculate_year1 = ($search_year-1);
		$pay_calculate_month1 = 12;
	} else {
		$pay_calculate_year1 = $search_year;
		$pay_calculate_month1 = ($search_month-1);
	}
} else {
	$pay_calculate_year1 = $search_year;
	$pay_calculate_month1 = $search_month;
}
//임금산출기간2 익월
if($row_com_opt['pay_calculate_day2'] == "익월") {
	if($search_month == 12) {
		$pay_calculate_year2 = ($search_year+1);
		$pay_calculate_month2 = 1;
	} else {
		$pay_calculate_year2 = $search_year;
		$pay_calculate_month2 = ($search_month+1);
	}
} else {
	$pay_calculate_year2 = $search_year;
	$pay_calculate_month2 = $search_month;
}
$pay_calculate_date = $pay_calculate_year1."년 ".number_format($pay_calculate_month1)."월 ".$row_com_opt['pay_calculate_day_period1']."일 ~ ".$pay_calculate_year2."년 ".number_format($pay_calculate_month2)."월 ".$row_com_opt['pay_calculate_day_period2']."일";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
<?
$previous_month_start = date("Y.m.01",strtotime("-1month"));
$previous_month_last_day = date('t', strtotime($previous_month_start));
$previous_month_end = date("Y.m",strtotime("-1month")).".".$previous_month_last_day;
$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
$next_month_start = date("Y.m.01",strtotime("+1month"));
$next_month_last_day = date('t', strtotime($next_month_start));
$next_month_end = date("Y.m",strtotime("+1month")).".".$next_month_last_day;
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 3) {
		frm['search_sday'].value = "<?=$next_month_start?>";
		frm['search_eday'].value = "<?=$next_month_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			for(i=1; i<=8; i++) {
				frm['search_day'+i].checked = true;
			}
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		for(i=1; i<=8; i++) {
			frm['search_day'+i].checked = false;
		}
	}
}
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { //모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//사업장관리번호 입력 하이픈
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { //모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function search_day_chk() {
	var frm = document.searchForm;
	if(frm.stx_search_day_chk.value=='') {
		alert('기간선택 후 날짜를 입력하세요.');
		frm.stx_search_day_chk.focus();
	}
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top03.gif" border="0" alt="결산" /></td>
						<td width="132"><a href="settlement_pay.php"><img src="images/top03_06.gif" border="0" alt="급여관리" /></a></td>
						<td width="129"><a href="settlement_pay.php"><img src="images/menu06_top04_off.gif" border="0" alt="급여대장" /></a></td>
						<td width="129"><a href="pay_all.php"><img src="images/menu06_top03_on.gif" border="0" alt="급여반영" /></a></td>
						<td width="129"><a href="pay_stubs_list.php"><img src="images/menu06_top05_off.gif" border="0" alt="월/년 통계" /></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">

							<div style="width:900px;">

<?
$money_month_text = "결정임금";
//echo "comp_print_type : ".$comp_print_type;
if($comp_print_type == "E") {
	include "pay_list_e.php";
} else if($comp_print_type == "G") {
	include "pay_list_g.php";
} else if($comp_print_type == "I") {
	include "pay_list_i.php";
} else if($comp_print_type == "J") {
	include "pay_list_j.php";
} else if($comp_print_type == "K") {
	include "pay_list_k.php";
} else if($comp_print_type == "P") {
	include "pay_list_p.php";
} else {
	include "pay_list_default.php";
}
?>
<script language="javascript">
function getInternetVersion(browser) {
	var rv = -1; // Return value assumes failure.     
	var ua = navigator.userAgent; 
	var re = null;
	if(browser=="MSIE") {
	 re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	 if(re.exec(ua) == null) { // IE11 above (Trident)
		re = new RegExp("rv:([0-9]{1,}[\.0-9]{0,})");
	 }
	}
	else if(browser=="Safari" || browser=="Opera") re = new RegExp("Version/([0-9]{1,}[\.0-9]{0,})");
	else re = new RegExp(browser+"/([0-9]{1,}[\.0-9]{0,})");
	if(re.exec(ua) != null) {
	 rv = parseInt(RegExp.$1);
	}
	return rv; 
}
//브라우저 종류 및 버전확인 
function getBroswserType() {
	var browser = "UnKnown";
	if(navigator.appName.charAt(0) == "N") { // Netscape
	 if(navigator.userAgent.indexOf("Chrome") != -1) browser = "Chrome";
	 else if(navigator.userAgent.indexOf("Firefox") != -1) browser = "Firefox";
	 else if(navigator.userAgent.indexOf("Safari") != -1) browser = "Safari";
	 else if(navigator.userAgent.indexOf("Opera") != -1) browser = "Opera";
	 else if(navigator.userAgent.indexOf("Trident") != -1) browser = "MSIE"; // IE11 above (Trident)
	}
	else if(navigator.appName.charAt(0) == "M") { // Microsoft Internet Explorer
	 browser = "MSIE";
	}
	else if(navigator.appName.indexOf("Opera") != -1) { // Opera
	 browser = "Opera";
	}
	return browser;
}
//좌표 설정
function clientxy(e) {
	var frm = document.dataForm;

	// InternetVersion
 var browser = getBroswserType();
 var ver = getInternetVersion(browser);

	//var browser = navigator.userAgent
	//frm.error_code.value = browser+" "+ver;
	if(browser=="MSIE") {   //브라우저가 IE일때 돌아간다. 크롬에서 써도 잘 된다.
		//alert("현재 좌표는 " + event.x + "/" + event.y);
		x = event.x;
		y = event.y+document.body.scrollTop;
	} else {   //그외(파이어폭스)일 때 돌아간다.
		//alert("현재 좌표는 " + e.clientX + "/" + e.clientY);
		x = e.clientX;
		y = e.clientY;
	}
	//이거는 그냥 덤으로 현재 브라우저의 가운데 좌표 표시
	//alert("가운데 좌표는" + screen.width/2 + "/" + screen.height/2 )
	div_id = document.getElementById('couponHelpDiv');
	div_id.style.display = 'block';
	div_id.style.top = y+"px";
	div_id.style.left = x+"px";
}
function emp_text(emp_name,emp_sdate,emp_position,family_count,emp_work_gbn,emp_pay_gbn,emp_money_base,emp_money_min,emp_money_time) {
	getId('emp_name').innerHTML = emp_name;
	getId('emp_sdate').innerHTML = emp_sdate;
	getId('emp_position').innerHTML = emp_position;
	getId('family_count').innerHTML = family_count;
	getId('emp_work_gbn').innerHTML = emp_work_gbn;
	getId('emp_pay_gbn').innerHTML = emp_pay_gbn;
}
//급여유형 변경 (월급제)
function pay_gbn_month() {
	var frm = document.dataForm;
	frm.pay_gbn_value.value = "0";
}
addLoadEvent(pay_gbn_month);
//페이지 로딩중 160329
$(document).ready(function(){
	$("#loading").css("display","none");
});
</script>
<style type="text/css">
#wrapper02 .CPWalletArea {
	background: rgb(255, 255, 255); margin: auto; border: 1px solid rgb(226, 1, 102); width:300px; display: block;
}
#wrapper02 .CPWalletArea .CPImg {
	top: -5px; right: 22px; display: block; position: absolute;
}
*:first-child + html #wrapper02 .CPWalletArea .CPImg {
	top: -9px; right: 22px; display: block; position: absolute;
}
#wrapper02 .CPWalletArea .nwapClsBtn01 {
	top: 15px; right: 15px; display: block; position: absolute;
}
#wrapper02 .CPWalletArea h3 {
	margin: 0px; padding: 20px 0px 10px 20px; color: rgb(226, 1, 102); font-size: 12px;
}
#wrapper02 .CPWalletArea ol {
	list-style: none; margin: 0px; padding: 0px 20px 20px; text-align: left; color: rgb(102, 102, 102); font-size: 11px;
}
#wrapper02 .CPWalletArea ol li {
	margin: 0px; padding: 0px;
}
#wrapper02 .CPWalletArea ol .nwapCPDisc {
	line-height: 15px; padding-top: 5px;
}
#wrapper02 .CPWalletArea ol .nwapCPStit {
	padding-top: 25px;
}
#wrapper02 .CPWalletArea ol .nwapCPDisc01 {
	
}
#wrapper02 .CPWalletArea ol .nwapCPDisc01 img {
	vertical-align: middle;
}
#wrapper02 .CPWalletArea .nwapCPDisc a {
	color: rgb(51, 51, 51); text-decoration: underline !important;
}
#wrapper02 .CPWalletArea .nwapCPDisc span {
	color: rgb(51, 51, 51);
}
</style>
<!-- 도움말 :: start -->
<div id="couponHelpDiv" style="display:none; position:absolute; top:0; left:0;">
	<div id="wrapper02">
		<div class="CPWalletArea">
			<!--<div class="CPImg"><img src="./images/pay_img01.gif" width="8" height="6" alt="" /></div>-->
			<h3>사원 기본/급여 정보</h3>
			<ol>
				<li><strong>1. 기본정보</strong>
					<ul class="nwapCPDisc">
						<li>성명 : <span id="emp_name"></span></li>
						<li>입사일 : <span id="emp_sdate"></span></li>
						<li>직위 : <span id="emp_position"></span></li>
						<li>부양가족 : <span id="family_count"></span></li>
					</ul>
				</li>
				<li class="nwapCPStit"><strong>2. 급여정보</strong>
					<ul class="nwapCPDisc">
						<li>주근무시간 : <span id="emp_work_gbn"></span></li>
						<li>급여유형 : <span id="emp_pay_gbn"></span></li>
						<li>결정임금 : <span id="emp_money_base"></span></li>
						<li>기본급 : <span id="emp_money_min"></span></li>
						<li>기본시급 : <span id="emp_money_time"></span></li>
					</ul>
				</li>
			</ol>
			<div style="position:absolute; right:15px; top:15px;">
				<img src="https://img.akmall.com/imgs/ak_wap/cart_box/pay_cls_btn02.gif" alt="닫기" onclick="$('#couponHelpDiv').css('display','none')" style="cursor:pointer" />
			</div>
		</div>
	</div>
</div>
<!-- 도움말 :: end -->



							</div>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
