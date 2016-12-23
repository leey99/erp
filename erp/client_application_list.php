<?
$sub_menu = "200100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	//지사 영업사원 권한
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
}
//지원금 신청 (기본 검색)
$sql_search .= " and ( c.application_kind != '0' and c.application_kind != '' ) ";

//검색 : 사업장명
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 사업자등록번호
if($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 지사
/*
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
*/
if($stx_man_cust_name) {
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code='110' or a.damdang_code='111') ";
	else if($stx_man_cust_name == "1") $sql_search .= " and (a.damdang_code = '$stx_man_cust_name' and a.damdang_code2 = '') ";
	else $sql_search .= " and (a.damdang_code = '$stx_man_cust_name' or a.damdang_code2 = '$stx_man_cust_name') ";
}
//검색 : 담당매니저
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
}
//검색 : 업체입금일
if($stx_client_receipt_date_chk) {
	$sql_search .= " and ( ";
	if($stx_client_receipt_date_chk == 1) {
		$sql_search .= " (c.client_receipt_date != '') ";
	} else if($stx_client_receipt_date_chk == 2) {
		$sql_search .= " (c.client_receipt_date = '') ";
	}
	$sql_search .= " ) ";
	$sst = "c.client_receipt_date";
	$sod = "desc";
}
//신청금액 없음
if($stx_application_fee_sum_chk) {
	$sql_search .= " and ( c.application_fee_sum = '' ) ";
}
//검색 : 본사입금일
if($stx_main_receipt_date_chk) {
	$sql_search .= " and ( ";
	if($stx_main_receipt_date_chk == 1) {
		$sql_search .= " (c.main_receipt_date != '') ";
	} else if($stx_main_receipt_date_chk == 2) {
		$sql_search .= " (c.main_receipt_date = '') ";
	}
	$sql_search .= " ) ";
	$sst = "c.main_receipt_date";
	$sod = "desc";
}
//검색 : 검색기간
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7) $sql_search .= " and ( ";
	//재접수일자
	if($search_day1) {
		$sql_search .= " ( (c.reapplication_date >= '$search_sday' and c.reapplication_date <= '$search_eday') ) ";
		$sst = "c.reapplication_date";
	}
	//업체입금일
	if($search_day2) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (c.client_receipt_date >= '$search_sday' and c.client_receipt_date <= '$search_eday') ";
		$sst = "c.client_receipt_date";
	}
	//본사입금일
	if($search_day3) {
		if($search_day1 || $search_day2) $sql_search .= " or ";
		$sql_search .= " (c.main_receipt_date >= '$search_sday' and c.main_receipt_date <= '$search_eday') ";
		$sst = "c.main_receipt_date";
	}
	//거래명세서
	if($search_day4) {
		if($search_day1 || $search_day2 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (c.statement_date >= '$search_sday' and c.statement_date <= '$search_eday') ";
		$sst = "c.statement_date";
	}
	//세금계산서
	if($search_day5) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (c.tax_invoice >= '$search_sday' and c.tax_invoice <= '$search_eday') ";
		$sst = "c.tax_invoice";
	}
	//접수일자
	if($search_day6) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " or ";
		$sql_search .= " (c.application_accept >= '$search_sday' and c.application_accept <= '$search_eday') ";
		$sst = "c.application_accept";
	}
	//계약금 입금일
	if($search_day7) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " or ";
		$sql_search .= " (c.down_payment_date >= '$search_sday' and c.down_payment_date <= '$search_eday') ";
		$sst = "c.down_payment_date";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7) $sql_search .= " ) ";
}
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//검색2 : 의뢰서
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//검색2 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(공단)
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(센터)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 이지노무
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
	$sql_search .= " ) ";
}
//사업자등록번호 미등록
if($stx_biz_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no = '-' or a.biz_no = '') ";
	$sql_search .= " ) ";
}
//사업장관리번호 미등록
if($stx_t_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno = '-' or a.t_insureno = '') ";
	$sql_search .= " ) ";
}
//검색 : 최종완료
if($stx_reapplication_done) {
	$sql_search .= " and ( ";
	if($stx_reapplication_done == "ing") $sql_search .= " (c.reapplication_done = '') ";
	else $sql_search .= " (c.reapplication_done = '$stx_reapplication_done') ";
	$sql_search .= " ) ";
}
//지원금 신청내용
if($stx_application_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.application_kind = '$stx_application_kind') ";
	$sql_search .= " ) ";
}
//정렬
if(!$sst) {
	$sst = "c.application_accept";
	$sod = "desc";
}
//검색 정렬
if($stx_line_up == 1) $sst = "c.application_accept ";
else if($stx_line_up == 2) $sst = "c.reapplication_date ";
else if($stx_line_up == 3) $sst = "c.application_send ";
else if($stx_line_up == 4) $sst = "c.down_payment_date ";
else if($stx_line_up == 5) $sst = "c.client_receipt_date ";
else if($stx_line_up == 6) $sst = "c.main_receipt_date ";
else if($stx_line_up == 7) $sst = "c.statement_date ";
else if($stx_line_up == 8) $sst = "c.tax_invoice ";

//정렬 쿼리
$sql_order = " order by $sst $sod ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

//페이지 20건 / 100건 / 전체
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "지원금현황";
$g4[title] = $sub_title." : 지원금 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 15;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_client_receipt_date_chk=".$stx_client_receipt_date_chk."&stx_main_receipt_date_chk=".$stx_main_receipt_date_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_application_kind=".$stx_application_kind;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_manage_name=".$stx_manage_name."&stx_count=".$stx_count;
$qstr .= "&stx_reapplication_done=".$stx_reapplication_done."&stx_application_fee_sum_chk=".$stx_application_fee_sum_chk."&stx_line_up=".$stx_line_up;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else{
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="client_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	var frm = document.searchForm;
	if(obj.style.display == "none") {
		obj.style.display = "";
		frm.search_detail.value = "ok";
	} else {
		obj.style.display = "none";
		frm.search_detail.value = "";
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
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
//1~3년
$year1_start = date("Y.m.01",strtotime("-1year"));
$year2_start = date("Y.m.01",strtotime("-2year"));
$year3_start = date("Y.m.01",strtotime("-3year"));
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	//1~3년
	} else 	if(input_obj.value == 5) {
		frm['search_sday'].value = "<?=$year1_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 6) {
		frm['search_sday'].value = "<?=$year2_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 7) {
		frm['search_sday'].value = "<?=$year3_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			for(i=1; i<=7; i++) {
				frm['search_day'+i].checked = true;
			}
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		for(i=1; i<=7; i++) {
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
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="padding:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top02.gif" border="0"></td>
						<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top02_01.gif" border="0" /></a></td>
						<td>
<?
$title_main_no = "02";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
							<form name="searchForm" method="get" style="padding:10px 0 0 0">
								<input type="hidden" name="search_ok" />
								<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
								<!--데이터 -->
								<table border="0" cellpadding="0" cellspacing="0">
									<tr> 
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" /></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
													검색
													</td> 
													<td><img src="images/g_tab_on_rt.gif" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="2"></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="90"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명</td>
										<td nowrap class="tdrow" width="180">
											<input name="stx_comp_name" type="text" class="textfm" style="width:160px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="105"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
										<td nowrap class="tdrow" width="200">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
										<td nowrap class="tdrow" width="110">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최종완료</td>
										<td nowrap class="tdrow" width="100">
											<select name="stx_reapplication_done" class="selectfm" onchange="goSearch();">
												<option value=""  <? if($stx_reapplication_done == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_reapplication_done == "1") echo "selected"; ?>>완료</option>
												<option value="2" <? if($stx_reapplication_done == "2") echo "selected"; ?>>반려</option>
												<option value="3" <? if($stx_reapplication_done == "3") echo "selected"; ?>>취소</option>
												<option value="4" <? if($stx_reapplication_done == "4") echo "selected"; ?>>이관</option>
												<option value="ing" <? if($stx_reapplication_done == "ing") echo "selected"; ?>>진행중</option>
											</select>
										</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
										<td nowrap class="tdrow" width="100">
											<select name="stx_man_cust_name" class="selectfm">
												<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
											</select>
										</td>
<? } else { ?>
										<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">정렬</td>
										<td nowrap class="tdrow">
											<select name="stx_line_up" class="selectfm">
												<option value="1" <? if($stx_line_up == 1) echo "selected"; ?>>접수일자</option>
												<option value="2" <? if($stx_line_up == 2) echo "selected"; ?>>재접수일자</option>
												<option value="3" <? if($stx_line_up == 3) echo "selected"; ?>>우편물발송</option>
												<option value="4" <? if($stx_line_up == 4) echo "selected"; ?>>계약입금일</option>
												<option value="5" <? if($stx_line_up == 5) echo "selected"; ?>>업체입금일</option>
												<option value="6" <? if($stx_line_up == 6) echo "selected"; ?>>본사입금일</option>
												<option value="7" <? if($stx_line_up == 7) echo "selected"; ?>>거래명세서</option>
												<option value="8" <? if($stx_line_up == 8) echo "selected"; ?>>세금계산서</option>
											</select>
										</td>
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당매니저</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_manage_name"  type="text" class="textfm" style="width:120px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_uptae"  type="text" class="textfm" style="width:90px;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
										<td nowrap class="tdrow" colspan="3">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업체입금일</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_client_receipt_date_chk" class="selectfm" onchange="">
												<option value=""  <? if($stx_client_receipt_date_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_client_receipt_date_chk == "1") echo "selected"; ?>>입금</option>
												<option value="2" <? if($stx_client_receipt_date_chk == "2") echo "selected"; ?>>미입급</option>
											</select>
											<input type="checkbox" name="stx_application_fee_sum_chk" value="1" <? if($stx_application_fee_sum_chk == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">지원금 미입력
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">본사입금일</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_main_receipt_date_chk" class="selectfm" onchange="">
												<option value=""  <? if($stx_main_receipt_date_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_main_receipt_date_chk == "1") echo "selected"; ?>>입금</option>
												<option value="2" <? if($stx_main_receipt_date_chk == "2") echo "selected"; ?>>미입급</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">범위</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_count" class="selectfm" onchange="">
												<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20건</option>
												<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100건</option>
												<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>전체</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청내용</td>
										<td nowrap class="tdrow" colspan="3">
											<select name="stx_application_kind" class="selectfm">
												<option value="0" >선택</option>
<?
for($i=1;$i<count($support_kind_array);$i++) {
?>
												<option value="<?=$i?>" <? if($stx_application_kind == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
}
?>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검색기간</td>
										<td nowrap class="tdrow" colspan="9">
											<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
												<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>전월</option>
												<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>금월</option>
												<option value="3" <? if($stx_search_day_chk == "3") echo "selected"; ?>>익월</option>
												<option value="5" <? if($stx_search_day_chk == "5") echo "selected"; ?>>1년</option>
												<option value="6" <? if($stx_search_day_chk == "6") echo "selected"; ?>>2년</option>
												<option value="7" <? if($stx_search_day_chk == "7") echo "selected"; ?>>3년</option>
												<option value="4" <? if($stx_search_day_chk == "4") echo "selected"; ?>>기간선택</option>
											</select>
											<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_sday);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											~
											<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_eday);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
for($i=1;$i<=8;$i++) {
	if($search_day_all != "1" && $_GET['search_day'.$i]) $search_day_all = "no";
}
if($search_day_all == "no") {
	$search_day_all = "";
} else {
	$search_day_all = 1;
	$search_day1 = 1;
	$search_day2 = 1;
	$search_day3 = 1;
	$search_day4 = 1;
	$search_day5 = 1;
	$search_day6 = 1;
	$search_day7 = 1;
	$search_day8 = 1;
}
?>
											<input type="checkbox" name="search_day_all" value="1" <? if($search_day_all == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)"><b>전체</b>
											<input type="checkbox" name="search_day6" value="1" <? if($search_day6 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">접수일자
											<input type="checkbox" name="search_day1" value="1" <? if($search_day1 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">재접수일자
											<input type="checkbox" name="search_day7" value="1" <? if($search_day7 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">계약입금일
											<input type="checkbox" name="search_day2" value="1" <? if($search_day2 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">업체입금일
											<input type="checkbox" name="search_day3" value="1" <? if($search_day3 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">본사입금일
											<input type="checkbox" name="search_day4" value="1" <? if($search_day4 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">거래명세서
											<input type="checkbox" name="search_day5" value="1" <? if($search_day5 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">세금계산서
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
											<a href="client_reapplication.php" target=""><img src="./images/btn_client_reapplication_big.png" border="0"></a>
											<a href="unpaid_balance.php" target=""><img src="./images/btn_unpaid_balance_big.png" border="0"></a>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
								<tr>
									<td id=""> 
										<table border="0" cellpadding="0" cellspacing="0"> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												리스트
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--리스트 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data">
								<input type="hidden" name="page" value="<?=$page?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="120" rowspan="2">신청내용</td>
										<td class="tdhead_center" width="48" rowspan="2">수수료</td>
										<td class="tdhead_center" width="72" rowspan="2">신청금액</td>
										<td class="tdhead_center" width="72" rowspan="2">매출금액</td>
										<td class="tdhead_center" width="72" rowspan="">접수일자</td>
										<td class="tdhead_center" width="72" rowspan="">재접수일자</td>
										<td class="tdhead_center" width="72" rowspan="">계약입금일</td>
										<td class="tdhead_center" width="70" rowspan="">업체입금일</td>
										<td class="tdhead_center" width="70" rowspan="">본사입금일</td>
										<td class="tdhead_center" width="68" rowspan="">거래명세서</td>
										<td class="tdhead_center" width="60" rowspan="2">최종완료</td>
										<td class="tdhead_center" width="90" rowspan="">지점</td>
									</tr>
									<tr>
										<td class="tdhead_center" rowspan="">신청기간</td>
										<td class="tdhead_center" rowspan="">우편물발송</td>
										<td class="tdhead_center" rowspan="">계약금</td>
										<td class="tdhead_center" rowspan="">업체입금액</td>
										<td class="tdhead_center" rowspan="">본사입금액</td>
										<td class="tdhead_center" rowspan="">세금계산서</td>
										<td class="tdhead_center" rowspan="">담당자</td>
									</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no']) {
		$samu_receive_no = "(".$row['samu_receive_no'].")";
	} else {
		$samu_receive_no = "";
	}
	//등록일자
	$regdt = $row['regdt'];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//신청내용
	$application_kind_code = $row['application_kind'];
	$application_kind = $support_kind_array[$application_kind_code];
	//수수료 : 지원금, 부담금, 건설, 직무교육
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	$p_training = $row['p_training']."%";
	if($p_support == "0%") $p_support = "-";
	if($p_contribution == "0%") $p_contribution = "-";
	if($p_construction == "0%") $p_construction = "-";
	if($p_training == "0%") $p_training = "-";
	if($p_support == "%") $p_support = "-";
	if($p_contribution == "%") $p_contribution = "-";
	if($p_construction == "%") $p_construction = "-";
	if($p_training == "%") $p_training = "-";
	//부담금, 직무교육, 전기요금컨설팅, 시간선택제일자리 수수료 적용 151210
	if($application_kind_code >= 13 && $application_kind_code <= 16) $p_support = $p_contribution;
	else if($application_kind_code == 22) $p_support = $p_training;
	else if($application_kind_code == 25) $p_support = "-";
	else if($application_kind_code == 11) $p_support = "-";
	//신청예상금액 / 매출예상금액
	if($row['application_fee_sum']) {
		$application_fee_sum = number_format($row['application_fee_sum']);
	} else {
		$application_fee_sum = "-";
	}
	if($row['application_fee_sum']) {
		if($row['p_support']) $application_fee_expect = number_format($row['application_fee_sum']*($row['p_support']/100));
		else $application_fee_expect = "-";
	} else {
		$application_fee_expect = "-";
	}
	//신청금액 / 매출금액 합계
	$afs = str_replace(',','',$application_fee_sum);
	$application_fee_sum_sum += ($afs);
	$afe = str_replace(',','',$application_fee_expect);
	$application_fee_expect_sum += ($afe);
	//신청기간/분기 선택
	$application_date_chk = $row['application_date_chk'];
	//신청분기 1
	$application_quarter_year = explode(',',$row['application_quarter_year']);
	$application_quarter = explode('_',$row['application_quarter']);
	$application_quarter_1 = explode(',',$application_quarter[0]);
	$application_quarter_2 = explode(',',$application_quarter[1]);
	$application_quarter_3 = explode(',',$application_quarter[2]);
	if($application_date_chk == 1) {
		$application_date = "분기";
		if($application_quarter_year[0]) {
			$application_date_title = $application_quarter_year[0]."년 ";
			if($application_quarter_1[0] == 1) $application_date_title .= "1.";
			if($application_quarter_1[1] == 1) $application_date_title .= "2.";
			if($application_quarter_1[2] == 1) $application_date_title .= "3.";
			if($application_quarter_1[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "분기";
		} else {
			$application_date_title = "-\n";
		}
		if($application_quarter_year[1]) {
			$application_date_title .= "\n".$application_quarter_year[1]."년 ";
			if($application_quarter_2[0] == 1) $application_date_title .= "1.";
			if($application_quarter_2[1] == 1) $application_date_title .= "2.";
			if($application_quarter_2[2] == 1) $application_date_title .= "3.";
			if($application_quarter_2[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "분기";
		}
		if($application_quarter_year[2]) {
			$application_date_title .= "\n".$application_quarter_year[2]."년 ";
			if($application_quarter_3[0] == 1) $application_date_title .= "1.";
			if($application_quarter_3[1] == 1) $application_date_title .= "2.";
			if($application_quarter_3[2] == 1) $application_date_title .= "3.";
			if($application_quarter_3[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "분기";
		}
	} else {
		if($row['application_date_start']) {
			$application_date = "기간";
			$application_date_title = $row['application_date_start']."~".$row['application_date_end'];
		} else {
			$application_date = "-";
			$application_date_title = "";
		}
	}
	//접수일자
	if($row['application_accept']) $application_accept = $row['application_accept'];
	else $application_accept = "-";
	//접수일자 색상
	if($search_day6) {
		if($application_accept >= $search_sday && $application_accept <= $search_eday) $application_accept_color = "color:red";
		else $application_accept_color = "";
	}
	//재접수일자
	if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
	else $reapplication_date = "-";
	//재접수일자 색상
	if($search_day1) {
		if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
		else $reapplication_date_color = "";
	}
	//우편물발송
	if($row['application_send']) $application_send = $row['application_send'];
	else $application_send = "-";
	//계약입금일
	if($row['down_payment_date']) $down_payment_date = $row['down_payment_date'];
	else $down_payment_date = "-";
	//계약금
	if($row['down_payment']) $down_payment = number_format($row['down_payment']);
	else $down_payment = "-";
	//계약금 합계
	$dpay = str_replace(',','',$row['down_payment']);
	$down_payment_sum += ($dpay);
	//업체입금일
	if($row['client_receipt_date']) $client_receipt_date = $row['client_receipt_date'];
	else $client_receipt_date = "-";
	//업체입금일 색상
	if($search_day2) {
		if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
		else $client_receipt_date_color = "";
	}
	//업체입금액
	if($row['client_receipt_fee']) {
		$client_receipt_fee = number_format($row['client_receipt_fee']);
	} else {
		$client_receipt_fee = "-";
	}
	//업체입금액 합계
	$crf = str_replace(',','',$client_receipt_fee);
	$client_receipt_fee_sum += ($crf);
	//본사입금일
	if($row['main_receipt_date']) $main_receipt_date = $row['main_receipt_date'];
	else $main_receipt_date = "-";
	//본사입금일 색상
	if($search_day3) {
		if($main_receipt_date >= $search_sday && $main_receipt_date <= $search_eday) $main_receipt_date_color = "color:red";
		else $main_receipt_date_color = "";
	}
	//본사입금액
	if($row['main_receipt_fee']) {
		$main_receipt_fee = number_format($row['main_receipt_fee']);
	} else {
		$main_receipt_fee = "-";
	}
	//본사입금액 합계
	$mrf = str_replace(',','',$main_receipt_fee);
	$main_receipt_fee_sum += ($mrf);
	//거래명세서
	if($row['statement_date']) $statement_date = $row['statement_date'];
	else $statement_date = "-";
	//거래명세서 색상
	if($search_day4) {
		if($statement_date >= $search_sday && $statement_date <= $search_eday) $statement_date_color = "color:red";
		else $statement_date_color = "";
	}
	//세금계산서
	if($row['tax_invoice']) $tax_invoice = $row['tax_invoice'];
	else $tax_invoice = "-";
	//거래명세서 색상
	if($search_day5) {
		if($tax_invoice >= $search_sday && $tax_invoice <= $search_eday) $tax_invoice_color = "color:red";
		else $tax_invoice_color = "";
	}
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//최종완료 : 반려, 취소, 이관
	if($row['reapplication_done'] == 2) $reapplication_done_return = "<span style='color:red;'>(반려)</span>";
	else if($row['reapplication_done'] == 3) $reapplication_done_return = "<span style='color:red;'>(취소)</span>";
	else if($row['reapplication_done'] == 4) $reapplication_done_return = "<span style='color:blue;'>(이관)</span>";
	else $reapplication_done_return = "";
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
/*
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	$damdang_code2 = $row['damdang_code2'];
	if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
*/
	if($damdang_code) {
		$branch = $man_cust_name_arry[$damdang_code];
		$damdang_code2 = $row['damdang_code2'];
		//광주딜러 -> 광주로 표시
		if($damdang_code >= 112 && $damdang_code <= 118) {
			$branch = $man_cust_name_arry[$damdang_code2];
		} else {
			if($damdang_code2) {
				$branch .= ">".$man_cust_name_arry[$damdang_code2];
			}
		}
	} else {
		$branch = "-";
	}
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//최종완료
	$reapplication_done_code = $row['reapplication_done'];
	$reapplication_done = $reapplication_done_array[$reapplication_done_code];
	if(!$reapplication_done) $reapplication_done = "-";
	//링크 URL
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "client_application_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//취소 사업장 회색 블럭 표시 151210
	if($reapplication_done_return) {
		$tr_class = "list_row_now_gr";
	} else {
		$tr_class = "list_row_now_wh";
	}
?>
									<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name.$reapplication_done_return?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_center_h22"><?=$p_support?></td>
										<td class="ltrow1_right_h22_padding" style="color:blue"><?=$application_fee_sum?></td>
										<td class="ltrow1_right_h22_padding" style="color:blue"><?=$application_fee_expect?></td>
										<td class="ltrow1_center_h22">
											<div style="<?=$application_accept_color?>"><?=$application_accept?></div>
											<div title="<?=$application_date_title?>"><?=$application_date?></div>
										</td>
										<td class="ltrow1_center_h22" style="<?=$reapplication_date_color?>"><?=$reapplication_date?><br /><?=$application_send?></td>
										<td class="ltrow1_right_h22_padding" style="<?=$down_payment_date_color?>"><?=$down_payment_date?><br /><div style="color:blue;text-align:right;"><?=$down_payment?></div></td>
										<td class="ltrow1_right_h22_padding" style="<?=$client_receipt_date_color?>"><?=$client_receipt_date?><br /><div style="color:blue;text-align:right;"><?=$client_receipt_fee?></div></td>
										<td class="ltrow1_right_h22_padding" style="<?=$main_receipt_date_color?>"><?=$main_receipt_date?><br /><div style="color:blue;text-align:right;"><?=$main_receipt_fee?></div></td>
										<td class="ltrow1_center_h22"><div style="<?=$statement_date_color?>"><?=$statement_date?></div><div style="<?=$tax_invoice_color?>"><?=$tax_invoice?></div></td>
										<td class="ltrow1_center_h22"><?=$reapplication_done?></td>
										<td class="ltrow1_center_h22"><?=$branch?><br /><?=$manage_cust_name?></td>
									</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">합계(신청금액, 매출금액)</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"><?=number_format($application_fee_sum_sum)?></td>
										<td class="tdhead_center"><?=number_format($application_fee_expect_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"><?=number_format($down_payment_sum)?></td>
										<td class="tdhead_center"><?=number_format($client_receipt_fee_sum)?></td>
										<td class="tdhead_center"><?=number_format($main_receipt_fee_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
								</table>
								<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40">
											<div align="center">
												<?
												$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
												echo $pagelist;
												?>
											</div>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="client_application_excel.php?<?=$qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0"></a>
										</td>
									</tr>
								</table>
							</form>
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
