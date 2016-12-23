<?
$sub_menu = "400100";
include_once("./_common.php");

//현재 년도
$year_now = date("Y");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

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

//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and a.com_name like '%$stx_comp_name%' ";
}
//검색 : 사업자등록번호
if($stx_biz_no) {
	$sql_search .= " and a.biz_no like '%$stx_biz_no%' ";
}
//검색 : 대표자
if($stx_boss_name) {
	$sql_search .= " and a.boss_name like '%$stx_boss_name%' ";
}
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and b.manage_cust_name = '$stx_manage_name' ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and a.t_insureno like '%$stx_t_no%' ";
}
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and a.com_tel like '%$stx_comp_tel%' ";
}
//검색 : 팩스번호
if($stx_comp_fax) {
	$sql_search .= " and a.com_fax like '%$stx_comp_fax%' ";
}
//검색 : 이메일
if($stx_com_mail) {
	$sql_search .= " and a.com_mail like '%$stx_ccom_mail%' ";
}
//검색 : 이메일 등록 여부
if($stx_com_mail_yn) {
	if($stx_com_mail_yn == 1) $sql_search .= " and a.com_mail != '-' ";
	else if($stx_com_mail_yn == 2) $sql_search .= " and a.com_mail = '-' ";
}
//검색 : 처리현황
if($stx_proxy) {
	$sql_search .= " and b.proxy = '$stx_proxy' ";
}
//검색 : 지사
if($stx_man_cust_name) {
	$sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//검색 : 사업개시일
if($stx_reg_day_chk) {
	if($stx_reg_day_chk == 1) {
		$sql_search .= " and b.registration_day != '' ";
	} else if($stx_reg_day_chk == 2) {
		$sql_search .= " and (b.registration_day >= '$search_year.$search_month.00' and b.registration_day <= '$search_year_end.$search_month_end.32') ";
	}
	$sst = "b.registration_day";
	$sod = "desc";
}
//검색 : 검색기간
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " and ( ";
	//등록일자
	if($search_day1) {
		$sql_search .= " (a.regdt >= '$search_sday' and a.regdt <= '$search_eday') ";
	}
	//위탁서
	if($search_day3) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (b.samu_receive_date >= '$search_sday' and b.samu_receive_date <= '$search_eday') ";
		$sst = "b.samu_receive_date";
	}
	//사무수임
	if($search_day4) {
		if($search_day1 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (b.samu_req_date >= '$search_sday' and b.samu_req_date <= '$search_eday') ";
		$sst = "b.samu_req_date";
	}
	//사무수임 해지
	if($search_day5) {
		if($search_day1 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (b.samu_close_date >= '$search_sday' and b.samu_close_date <= '$search_eday') ";
		$sst = "b.samu_close_date";
	}
	if($search_day_all || $search_day1 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " ) ";
}
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and a.uptae like '%$stx_uptae%' ";
}
//검색 : 업종
if ($stx_upjong) {
	$sql_search .= " and a.upjong like '%$stx_upjong%' ";
}
//검색 : 위탁번호
if ($stx_samu_receive_no_search) {
	$sql_search .= " and b.samu_receive_no = '$stx_samu_receive_no_search' ";
}
//검색 : 위탁번호(구)
if ($stx_samu_receive_no_old_search) {
	$sql_search .= " and b.samu_receive_no_old = '$stx_samu_receive_no_old_search' ";
}
//검색2 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and b.samu_receive_date != '' ";
}
//사무위탁수임 : 초기선택 수임 / 전체 검색 150326
//if(!$samu_req_yn) $samu_req_yn = "4";
if(!$samu_req_yn) $samu_req_yn = "all";
if ($samu_req_yn != "all") {
	$sql_search .= " and b.samu_req_yn = '$samu_req_yn' ";
}
//건강EDI위임
if ($health_req_yn) {
	$sql_search .= " and b.health_req_yn = '$health_req_yn' ";
}
//위탁번호 : 초기선택 입력
if(!$stx_samu_receive_no) $stx_samu_receive_no = "1";
if($stx_samu_receive_no != "all") {
	if($stx_samu_receive_no == 1) {
		$sql_search .= " and b.samu_receive_no != '' ";
	} else if($stx_samu_receive_no == 2) {
		$sql_search .= " and b.samu_receive_no = '' ";
	}
	$sst = "b.samu_receive_no+0";
	$sod = "desc";
}
//사업자등록번호 미등록
if($stx_biz_no_input_not) {
	$sql_search .= " and (a.biz_no = '-' or a.biz_no = '') ";
}
//사업장관리번호 미등록
if($stx_t_no_input_not) {
	$sql_search .= " and (a.t_insureno = '-' or a.t_insureno = '') ";
}
//사무위탁수임 미등록
if($samu_req_yn_input_not) {
	$sql_search .= " and b.samu_req_yn = '' ";
}
//주소검색
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//보험구분
if ($stx_samu_state_total != "2" && $stx_samu_state) {
	if($stx_samu_state == "1") $sql_search .= " and a.samu_state_gy <> '' ";
	else if($stx_samu_state == "2") $sql_search .= " and a.samu_state_sj <> '' ";
}
//부과고지구분
if($stx_levy_kind) {
	$sql_search .= " and a.levy_kind = '$stx_levy_kind' ";
}
//사업장상태 정상/소멸 : 초기선택 정상 / 다시 전체로 변경 150325
//if(!$stx_samu_state_total) $stx_samu_state_total = "1";
if($stx_samu_state_total != "all") {
	if($stx_samu_state_total == "2") {
		if($stx_samu_state == "1") {
			$sql_search .= " and a.samu_state_gy = '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_sj = '1' ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and a.samu_state_sj = '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_gy = '1' ";
		} else {
			$sql_search .= " and (a.samu_state_gy = '2' or a.samu_state_sj = '2') ";
		}
	} else if($stx_samu_state_total == "1") {
		if($stx_samu_state == "1") {
			$sql_search .= " and a.samu_state_gy <> '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_sj = '2' ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_gy = '2' ";
		} else {
			$sql_search .= " and (a.samu_state_gy <> '2' or a.samu_state_sj <> '2') ";
		}
	}
}
//관리공단지사
if($stx_samu_branch) {
	$sql_search .= " and a.samu_branch = '$stx_samu_branch' ";
}
//사업구분
if($stx_employer_insure) {
	$sql_search .= " and a.employer_insure = '$stx_employer_insure' ";
}
//적용담당자
if($stx_samu_charge) {
	$sql_search .= " and a.samu_charge = '$stx_samu_charge' ";
}

//정렬
if (!$sst) {
	$sst = "a.com_code";
	$sod = "desc";
}
$sst2 = "b.samu_receive_no_old";
$sod2 = "desc";
$sql_order = " order by $sst $sod , $sst2 $sod2 ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "사무위탁현황";
$g4[title] = $sub_title." : 사무위탁 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 16;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&amp;stx_t_no=".$stx_t_no."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_comp_fax=".$stx_comp_fax."&amp;stx_proxy=".$stx_proxy."&amp;stx_comp_gubun2=".$stx_comp_gubun2."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;search_ok=".$search_ok;
$qstr .= "&amp;samu_req_yn=".$samu_req_yn."&amp;health_req_yn=".$health_req_yn."&amp;stx_samu_receive_no=".$stx_samu_receive_no."&amp;stx_samu_receive_no_search=".$stx_samu_receive_no_search."&amp;stx_samu_receive_no_old_search=".$stx_samu_receive_no_old_search."&amp;stx_reg_day_chk=".$stx_reg_day_chk."&amp;search_year=".$search_year."&amp;search_month=".$search_month."&amp;search_year_end=".$search_year_end."&amp;search_month_end=".$search_month_end."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday;
$qstr .= "&amp;search_day_all=".$search_day_all."&amp;search_day1=".$search_day1."&amp;search_day3=".$search_day3."&amp;search_day4=".$search_day4."&amp;search_day5=".$search_day5."&amp;stx_biz_no_input_not=".$stx_biz_no_input_not."&amp;stx_t_no_input_not=".$stx_t_no_input_not."&amp;stx_com_mail_yn=".$stx_com_mail_yn;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_manage_name=".$stx_manage_name."&amp;stx_samu_state=".$stx_samu_state."&amp;stx_levy_kind=".$stx_levy_kind."&amp;stx_samu_state_total=".$stx_samu_state_total."&amp;stx_samu_branch=".$stx_samu_branch."&amp;stx_employer_insure=".$stx_employer_insure;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
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
<script type="text/javascript">
<!--
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
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$today?>";
		frm['search_eday'].value = "<?=$today?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			frm['search_day1'].checked = true;
			frm['search_day3'].checked = true;
			frm['search_day4'].checked = true;
			frm['search_day5'].checked = true;
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		frm['search_day1'].checked = false;
		frm['search_day3'].checked = false;
		frm['search_day4'].checked = false;
		frm['search_day5'].checked = false;
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
//-->
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top05.gif" border="0" alt="" /></td>
						<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top05_01.gif" border="0" alt="" /></a></td>
						<td>
<?
$title_main_no = "05";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
							<form name="searchForm" method="get">
								<input type="hidden" name="search_ok" />
								<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
								<!--데이터 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="" /></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80px;text-align:center;'> 
													검색
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />사업장명칭</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />사업자등록번호</td>
										<td nowrap class="tdrow">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />대표자</td>
										<td nowrap class="tdrow">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />진행사항</td>
										<td nowrap class="tdrow" <? if($member['mb_level'] <= 7) echo "colspan='3'"; ?> >
											<select name="stx_proxy" class="selectfm" onchange="">
												<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>접수</option>
												<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>완료</option>
											</select>
										</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />지사</td>
										<td nowrap class="tdrow">
											<select name="stx_man_cust_name" class="selectfm">
												<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
											</select>
										</td>
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />담당자</td>
										<td nowrap class="tdrow">
											<input name="stx_manage_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />사업장관리번호</td>
										<td nowrap class="tdrow">
											<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />주소검색</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_addr"  type="text" class="textfm" style="width:75px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="선검색어" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />전화번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<!--<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />팩스번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_comp_fax"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>-->
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />이메일</td>
										<td nowrap class="tdrow" colspan="">
											등록여부
											<select name="stx_com_mail_yn" class="selectfm" style="" onchange="">
												<option value="" >전체</option>
												<option value="1" <? if($stx_com_mail_yn == "1") echo "selected"; ?>>등록</option>
												<option value="2" <? if($stx_com_mail_yn == "2") echo "selected"; ?>>미등록</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />처리현황</td>
										<td nowrap class="tdrow" colspan="3">
											<b>위탁번호</b>
											<select name="stx_samu_receive_no" class="selectfm" style="color:red;font-weight:bold;" onchange="">
												<option value="all"  <? if($stx_samu_receive_no == "all")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_receive_no == "1") echo "selected"; ?>>입력</option>
												<option value="2" <? if($stx_samu_receive_no == "2") echo "selected"; ?>>미입력</option>
											</select>
											<b>사무위탁수임</b>
											<select name="samu_req_yn" class="selectfm" style="color:red;font-weight:bold;" onchange="">
												<option value="all" <? if($samu_req_yn == "all")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>수임가능</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>타수임</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>수임</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
											<input type="checkbox" name="samu_req_yn_input_not" value="1" <? if($samu_req_yn_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />사업장상태</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_state_total" class="selectfm" style="color:red;font-weight:bold;" onchange="">
												<option value="all"  <? if($stx_samu_state_total == "all")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_state_total == "1") echo "selected"; ?>>정상</option>
												<option value="2" <? if($stx_samu_state_total == "2") echo "selected"; ?>>소멸</option>
											</select>
											<input type="checkbox" name="stx_samu_state_total_only" value="1" <? if($stx_samu_state_total_only == 1) echo "checked"; ?> style="vertical-align:middle" />단독
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />소멸일자</td>
										<td nowrap class="tdrow" colspan="3">
											<div style="float:left;">
												<select name="stx_discharge_date_chk" class="selectfm" onchange="stx_discharge_date_select(this)">
													<option value=""  <? if($stx_discharge_date_chk == "")  echo "selected"; ?>>전체</option>
													<option value="2" <? if($stx_discharge_date_chk == "2") echo "selected"; ?>>기간선택</option>
												</select>
												<input name="discharge_date_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$discharge_date_start?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											</div>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="" /></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.discharge_date_start);" target="">달력</a></td><td><img src="./images/btn2_rt.gif" alt="" /></td> <td width="2"></td></tr></table>
											<div style="float:left;">
												~
												<input name="discharge_date_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$discharge_date_end?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											</div>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;margin:1px 0 0 0;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="" /></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.discharge_date_end);" target="">달력</a></td><td><img src="./images/btn2_rt.gif" alt="" /></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />보험구분</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_state" class="selectfm" onchange="">
												<option value=""  <? if($stx_samu_state == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_state == "1") echo "selected"; ?>>고용</option>
												<option value="2" <? if($stx_samu_state == "2") echo "selected"; ?>>산재</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />부과고지구분</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_levy_kind" class="selectfm" onchange="">
												<option value=""  <? if($stx_levy_kind == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_levy_kind == "1") echo "selected"; ?>>부과고지</option>
												<option value="2" <? if($stx_levy_kind == "2") echo "selected"; ?>>자진신고</option>
												<option value="3" <? if($stx_levy_kind == "3") echo "selected"; ?>>부과+자진</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />관리공단지사</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_branch" class="selectfm" onchange="">
												<option value="">선택</option>
<?
for($i=1;$i<count($samu_branch_arry);$i++) {
?>
												<option value="<?=$samu_branch_arry[$i]?>" <? if($stx_samu_branch == $samu_branch_arry[$i]) echo "selected"; ?>><?=$samu_branch_arry[$i]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />사업구분</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_employer_insure" class="selectfm" onchange="">
												<option value=""  <? if($stx_employer_insure == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_employer_insure == "1") echo "selected"; ?>>사업주산재</option>
												<option value="2" <? if($stx_employer_insure == "2") echo "selected"; ?>>자영업자고용</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />적용담당자</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_samu_charge"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_samu_charge?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />사업개시일</td>
										<td nowrap class="tdrow" colspan="3">
											<select name="stx_reg_day_chk" class="selectfm" onchange="">
												<option value=""  <? if($stx_reg_day_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_reg_day_chk == "1") echo "selected"; ?>>입력</option>
												<option value="2" <? if($stx_reg_day_chk == "2") echo "selected"; ?>>기간선택</option>
											</select>
											<select name="search_year" class="selectfm" onChange="">
												<option value="1980" <? if(1980 == $search_year) echo "selected"; ?> >1980 이전</option>
<?
if(!$search_year) $search_year = $year_now;
for($i=1981;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월 ~
											<select name="search_year_end" class="selectfm" onChange="">
<?
if(!$search_year_end) $search_year_end = $year_now;
for($i=1981;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year_end) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month_end" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month_end) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />업태</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />업종</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />위탁번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_samu_receive_no_search" type="text" class="textfm" style="width:54px;ime-mode:disabled;" value="<?=$stx_samu_receive_no_search?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<span style="font-size:8pt;">구</span><input name="stx_samu_receive_no_old_search"  type="text" class="textfm" style="width:40px;ime-mode:disabled;margin-left:2px;" value="<?=$stx_samu_receive_no_old_search?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />검색기간</td>
										<td nowrap class="tdrow" colspan="7">
											<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
												<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>오늘</option>
												<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>기간선택</option>
											</select>
											<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											<a href="javascript:loadCalendar(document.searchForm.search_sday);"><img src="images/icon_calender_btn.png" width="28" height="17" border="0" style="vertical-align:middle;" /></a>
											~
											<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											<a href="javascript:loadCalendar(document.searchForm.search_eday);"><img src="images/icon_calender_btn.png" width="28" height="17" border="0" style="vertical-align:middle;" /></a>
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
											<input type="checkbox" name="search_day_all" value="1" <? if($search_day_all == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)" /><b>전체</b>
											<input type="checkbox" name="search_day1" value="1" <? if($search_day1 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)" />등록일자
											<input type="checkbox" name="search_day3" value="1" <? if($search_day3 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)" />위탁서
											<input type="checkbox" name="search_day4" value="1" <? if($search_day4 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)" />사무수임
											<input type="checkbox" name="search_day5" value="1" <? if($search_day5 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)" />사무해지
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />건강EDI</td>
										<td nowrap class="tdrow" colspan="">
											<select name="health_req_yn" class="selectfm" onchange="">
												<option value=""  <? if($health_req_yn == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($health_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($health_req_yn == "2") echo "selected"; ?>>위임가능</option>
												<option value="3" <? if($health_req_yn == "3") echo "selected"; ?>>타위임</option>
												<option value="4" <? if($health_req_yn == "4") echo "selected"; ?>>위임</option>
												<option value="5" <? if($health_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<div id="request" style="<? if(!$search_detail) echo "display:none"; ?>">

								</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0" alt="" /></a>
											<a href="client_list.php" target=""><img src="./images/btn_customer_con_big.png" border="0" alt="" /></a>
											<a href="samu_excel.php?<?=$qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0" alt="" /></a>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px"></div>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif" alt="" /></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80px;text-align:center;'> 
												리스트
												</td> 
												<td><img src="images/g_tab_on_rt.gif" alt="" /></td> 
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
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" /></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="46" rowspan="2">위탁No</td>
										<td class="tdhead_center" width="68" rowspan="">등록일자</td>
										<td class="tdhead_center" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="98" rowspan="">사업자등록번호</td>
										<td class="tdhead_center" width="90" rowspan="">전화번호</td>
										<td class="tdhead_center" width="78" rowspan="">대표자</td>
										<td class="tdhead_center" width="110" rowspan="">업태</td>
										<td class="tdhead_center" width="70" rowspan="2">위탁서접수<br></td>
										<td class="tdhead_center" width="70" rowspan="">수임일자</td>
										<td class="tdhead_center" width="66" rowspan="2">건강EDI</td>
										<td class="tdhead_center" width="44" rowspan="">고용</td>
										<td class="tdhead_center" width="70" rowspan="">관리점</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="">부과고지</td>
										<td class="tdhead_center" width="" rowspan="">사업장관리번호</td>
										<td class="tdhead_center" width="" rowspan="">팩스번호</td>
										<td class="tdhead_center" width="" rowspan="">사업개시일</td>
										<td class="tdhead_center" width="" rowspan="">업종</td>
										<td class="tdhead_center" width="" rowspan="">해지일자</td>
										<td class="tdhead_center" width="" rowspan="">산재</td>
										<td class="tdhead_center" width="" rowspan="">담당자</td>
									</tr>
<?
//위탁번호 이전 번호 초기화
$samu_receive_no_old = "";
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no'] > 0) {
		$samu_receive_no = $row['samu_receive_no']."<br>";
	} else if($row['samu_receive_no'] == "-") {
		$samu_receive_no = "";
	} else {
		$samu_receive_no = "";
	}
	//echo $samu_receive_no." != ".$samu_receive_no_old." / ";
	//if($samu_receive_no_old && $samu_receive_no != $samu_receive_no_old-1) $samu_receive_no_color = "color:red";
	//else $samu_receive_no_color = "";
	//위탁번호 색상 변경 안함 150318
	$samu_receive_no_color = "";
	//위탁번호 이전 번호
	if($row['samu_receive_no_old']) {
		$samu_receive_no_old = $row['samu_receive_no_old'];
	} else {
		$samu_receive_no_old = "";
	}
	//등록일자
	$regdt = $row['regdt'];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//등록일시
	if($row['regdt_time'] != "0000-00-00 00:00:00") $regdt_time = $row['regdt_time'];
	else $regdt_time = "";
	//부과고지
	if($row['levy_kind'] == 1) $levy_kind = "부과고지";
	else if($row['levy_kind'] == 2) $levy_kind = "자진신고";
	else $levy_kind = "-";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//전화번호
	$com_tel = $row['com_tel'];
	//1544 국번 지역번호 제거
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//사무위탁
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
		$samu_req = "신청";
	}
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
	//업종
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	if($editdt >= $search_sday && $editdt <= $search_eday) $editdt_color = "color:red";
	else $editdt_color = "";
	//위탁서
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	if($samu_receive_date >= $search_sday && $samu_receive_date <= $search_eday) $samu_receive_date_color = "color:red";
	else $samu_receive_date_color = "";
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	if($samu_req_date >= $search_sday && $samu_req_date <= $search_eday) $samu_req_date_color = "color:red";
	else $samu_req_date_color = "";
	//해지일
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
	$samu_close_date_color = "";
	//처리상태(대리인, 전자민원)
	$agent_elect_public_text = array("없음","처리중","완료","미접수","지사요청","회원가입","해지완료","해지요청");
	//대리인(공단)
	if($row['agent_elect_public_edate']) {
		$agent_elect_public_edate = $row['agent_elect_public_edate'];
	} else {
		if($row['agent_elect_public_date']) $agent_elect_public_edate = "접수";
		else $agent_elect_public_edate = "-";
		for ($k=0; $k<=7; $k++) {
			if($row['agent_elect_public_yn'] == ($k+1)) $agent_elect_public_edate = $agent_elect_public_text[$k];
		}
	}
	if($agent_elect_public_edate >= $search_sday && $agent_elect_public_edate <= $search_eday) $agent_elect_public_edate_color = "color:red";
	else $agent_elect_public_edate_color = "";
	//전자민원(센터)
	if($row['agent_elect_center_edate']) {
		$agent_elect_center_edate = $row['agent_elect_center_edate'];
	} else {
		if($row['agent_elect_center_date']) $agent_elect_center_edate = "접수";
		else $agent_elect_center_edate = "-";
		for ($k=0; $k<=7; $k++) {
			if($row['agent_elect_center_yn'] == ($k+1)) $agent_elect_center_edate = $agent_elect_public_text[$k];
		}
	}
	if($agent_elect_center_edate >= $search_sday && $agent_elect_center_edate <= $search_eday) $agent_elect_center_edate_color = "color:red";
	else $agent_elect_center_edate_color = "";
	//검토현황
	$review_process_array = Array("","검토중","완료","해당없음");
	$review_process_code = $row['review_process'];
	if($row['review_process']) $review_process = $review_process_array[$review_process_code];
	else $review_process = "-";
	//이지노무
	$easynomu_process_array = Array("","기초셋팅중","급여셋팅중","완료","보류","해지","보완서류요청");
	$easynomu_process_code = $row['easynomu_process'];
	if($row['easynomu_process']) $easynomu_process = $easynomu_process_array[$easynomu_process_code];
	else $easynomu_process = "-";
	//이지노무 월정액
	if($easynomu_process_code == 3) {
		if($row['month_pay']) $easynomu_process = number_format($row['month_pay']);
	}
	//진행사항
	if($row['editdt']) $p_accept = "접수";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "처리중";
	if($row['samu_req_date']) $p_accept = "처리중";
	if($row['agent_elect_public_date']) $p_accept = "처리중";
	if($row['agent_elect_center_date']) $p_accept = "처리중";
	if($row['easynomu_process']) $p_accept = "처리중";
	if($row['proxy'] == 1)  $p_accept = "접수";
	else if($row['proxy'] == 3) $p_accept = "완료";
	//처리현황 (사무위탁)
	$samu_req_yn_array = Array("","반려","수임가능","타수임","수임","해지");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn_text = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn_text = "-";
	//소멸 사업장
	if($row['samu_state_gy'] == "2") $samu_req_yn_text1 = "<span style='color:red'>소멸</span>(고용)";
	else $samu_req_yn_text1 = "";
	if($row['samu_state_sj'] == "2") $samu_req_yn_text2 = "<span style='color:red'>소멸</span>(산재)";
	else $samu_req_yn_text2 = "";
	if($samu_req_yn_text1) $samu_req_yn_text_br = "<br>";
	else $samu_req_yn_text_br = "";
	if($samu_req_yn_text1 || $samu_req_yn_text2) {
		$samu_req_yn_text = $samu_req_yn_text1.$samu_req_yn_text_br.$samu_req_yn_text2;
		$samu_termination = "<span style='color:red;'>(소멸)</span>";
	} else {
		$samu_req_yn_text = "";
		$samu_termination = "";
	}
	//상시근로자 고용/산재
	$persons_gy = $row['persons_gy'];
	$persons_sj = $row['persons_sj'];
	if($persons_gy == "0") $persons_gy = "<span style='color:red'>-</span>";
	if($persons_sj == "0") $persons_sj = "<span style='color:red'>-</span>";
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "samu_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//해지 사업장 회색 블럭 표시
	if($samu_req_yn_code == '5') {
		$tr_class = "list_row_now_gr";
		$samu_close_text = "<span style='color:red;'>(해지)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$samu_close_text = "";
	}
	//건강EDI
	$health_req_yn_array = Array("","반려","위임가능","타위임","위임","해지");
	$health_req_yn_code = $row['health_req_yn'];
	if($row['health_req_yn']) $health_req_yn_text = $health_req_yn_array[$health_req_yn_code];
	else $health_req_yn_text = "-";
?>
									<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" /></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_center_h22" style="<?=$samu_receive_no_color?>">
											<div style="line-height:12px;">
												<span style="font-weight:bold;"><?=$samu_receive_no?></span><span style="font-size:8pt;"><?=$samu_receive_no_old?></span>
											</div>
										</td>
										<td class="ltrow1_center_h22" ><span style="<?=$regdt_color?>" title="<?=$regdt_time?>"><?=$regdt?></span><br><?=$levy_kind?></td>
										<td class="ltrow1_left_h22" title="">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name_full?><?=$samu_close_text?><?=$samu_termination?></a>
											<br />
<?
if($stx_com_mail_yn == 1) {
 echo $row['com_mail'];
} else {
?>
											(<?=$row['new_postno']?>) <?=$com_juso_full?>
<?
}
?>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22"><?=$com_tel?><br><?=$row['com_fax']?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span><br><span title="<?=$upjong_full?>"><?=$upjong?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$samu_receive_date_color?>"><?=$samu_receive_date?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$samu_req_date_color?>"><?=$samu_req_date?></span><br><span style="<?=$samu_close_date_color?>"><?=$samu_close_date?></span></td>
										<td class="ltrow1_center_h22"><?=$health_req_yn_text?></td>
										<td class="ltrow1_center_h22"><?=$persons_gy?><br><?=$persons_sj?></td>
										<td class="ltrow1_center_h22"><?=$branch?><br><?=$manage_cust_name?></td>
									</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
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
