<?
$sub_menu = "300100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.damdang_code='$member[mb_profile]' ";
}
//지원금 신청 (기본 검색)
$sql_search .= " and ( c.application_kind != '0' and c.application_kind != '' ) ";

//검색 : 사업장명칭
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
//검색 : 처리현황
if($stx_proxy) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.proxy = '$stx_proxy') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
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
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " and ( ";
	//재신청일자
	if($search_day1) {
		$sql_search .= " ( (c.reapplication_date >= '$search_sday' and c.reapplication_date <= '$search_eday') or (c.reapplication_date2 >= '$search_sday' and c.reapplication_date2 <= '$search_eday') ) ";
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
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " ) ";
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

//정렬
if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}
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

$sub_title = "결산현황";
$g4[title] = $sub_title." : 결산 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 16;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_client_receipt_date_chk=".$stx_client_receipt_date_chk."&stx_main_receipt_date_chk=".$stx_main_receipt_date_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_manage_name=".$stx_manage_name."&stx_count=".$stx_count;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
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
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
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
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top03.gif" border="0"></td>
									<td width="130"><img src="images/top03_01.gif" border="0"></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
							</table>

							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--타이틀 -->	
										<form name="searchForm" method="get">
											<input type="hidden" name="search_ok">
											<input type="hidden" name="search_detail" value="<?=$search_detail?>">
											<!--데이터 -->
											<table border=0 cellspacing=0 cellpadding=0> 
												<tr> 
													<td id=""> 
														<table border=0 cellpadding=0 cellspacing=0> 
															<tr> 
																<td><img src="images/g_tab_on_lt.gif"></td> 
																<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
																검색
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
											<!--검색 -->
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명칭</td>
													<td nowrap class="tdrow">
														<input name="stx_comp_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
													<td nowrap class="tdrow">
														<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
													<td nowrap class="tdrow">
														<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">진행사항</td>
													<td nowrap class="tdrow">
														<select name="stx_proxy" class="selectfm" onchange="">
															<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>접수</option>
															<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>처리중</option>
															<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>완료</option>
															<option value="4" <? if($stx_proxy == "4") echo "selected"; ?>>진행취소</option>
															<option value="5" <? if($stx_proxy == "5") echo "selected"; ?>>반려</option>
														</select>
													</td>
<?
if($member['mb_level'] > 6) {
	//echo $stx_man_cust_name;
?>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
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
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당매니저</td>
													<td nowrap class="tdrow" colspan="">
														<input name="stx_manage_name"  type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
													<td nowrap class="tdrow" colspan="">
														<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
													<td nowrap class="tdrow" colspan="">
														<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
													<td nowrap class="tdrow" colspan="3">
														<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
													<td nowrap class="tdrowk"></td>
													<td nowrap class="tdrow" colspan="3">
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
														<input type="checkbox" name="search_day1" value="1" <? if($search_day1 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">재접수일자
														<input type="checkbox" name="search_day2" value="1" <? if($search_day2 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">업체입금일
														<input type="checkbox" name="search_day3" value="1" <? if($search_day3 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">본사입금일
														<input type="checkbox" name="search_day4" value="1" <? if($search_day4 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">거래명세서
														<input type="checkbox" name="search_day5" value="1" <? if($search_day5 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">세금계산서
																											</td>
												</tr>
											</table>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
														<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
														<a href="client_application_excel.php?<?=$qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0"></a>
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
										<!--댑메뉴 -->
<?
//검색 후 리스트 표시
//if($search_ok == "ok" || $search_ok == "branch") {
if(1==1) {
?>
										<!--리스트 -->
										<form name="dataForm" method="post">
											<input type="hidden" name="chk_data">
											<input type="hidden" name="page" value="<?=$page?>">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
												<tr>
													<td class="tdhead_center" width="26" rowspan=""><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="46" rowspan="">No</td>
													<td class="tdhead_center" rowspan="">사업장명</td>
													<td class="tdhead_center" width="50" rowspan="">지점</td>
													<td class="tdhead_center" width="90" rowspan="">담당자</td>
													<td class="tdhead_center" width="120" rowspan="">신청내용</td>
													<td class="tdhead_center" width="48" rowspan="">수수료</td>
													<td class="tdhead_center" width="72" rowspan="">신청금액</td>
													<td class="tdhead_center" width="72" rowspan="">매출금액</td>
													<td class="tdhead_center" width="60" rowspan="">신청기간<br></td>
													<td class="tdhead_center" width="72" rowspan="">재접수일자</td>
													<td class="tdhead_center" width="68" rowspan="">업체입금일</td>
													<td class="tdhead_center" width="72" rowspan="">업체입금액</td>
													<td class="tdhead_center" width="68" rowspan="">본사입금일</td>
													<td class="tdhead_center" width="68" rowspan="">거래명세서</td>
													<td class="tdhead_center" width="68" rowspan="">세금계산서</td>
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
	$application_kind = $support_kind_array[$application_kind_code]."<br>";
	if($row['application_kind2']) {
		$application_kind2_code = $row['application_kind2'];
		$application_kind2 = $support_kind_array[$application_kind2_code]."<br>";
	} else {
		$application_kind2 = "";
	}
	if($row['application_kind3']) {
		$application_kind3_code = $row['application_kind3'];
		$application_kind3 = $support_kind_array[$application_kind3_code]."<br>";
	} else {
		$application_kind3 = "";
	}
	//수수료 : 지원금, 부담금, 건설
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	if($p_support == "0%") $p_support = "-";
	if($p_support == "%") $p_support = "-";
	if($p_contribution == "0%") $p_contribution = "-";
	if($p_construction == "0%") $p_construction = "-";
	//신청예상금액 / 매출예상금액
	if($row['application_fee_sum']) {
		$application_fee_sum = number_format($row['application_fee_sum'])."<br>";
	} else {
		$application_fee_sum = "-<br>";
	}
	if($row['application_fee_sum']) {
		if($row['p_support']) $application_fee_expect = number_format($row['application_fee_sum']*($row['p_support']/100))."<br>";
		else $application_fee_expect = "-<br>";
	} else {
		$application_fee_expect = "-<br>";
	}
	if($row['application_kind2']) {
		if($row['application_fee_sum2']) {
			$application_fee_sum2 = number_format($row['application_fee_sum2'])."<br>";
		} else {
			$application_fee_sum2 = "-<br>";
		}
		if($row['application_fee_sum2']) {
			if($row['p_support']) $application_fee_expect2 = number_format($row['application_fee_sum2']*($row['p_support']/100))."<br>";
			else $application_fee_expect2 = "-<br>";
		} else {
			$application_fee_expect2 = "-<br>";
		}
	} else {
		$application_fee_sum2 = "";
		$application_fee_expect2 = "";
	}
	if($row['application_kind3']) {
		if($row['application_fee_sum3']) {
			$application_fee_sum3 = number_format($row['application_fee_sum3'])."<br>";
		} else {
			$application_fee_sum3 = "-<br>";
		}
		if($row['application_fee_sum3']) {
			if($row['p_support']) $application_fee_expect3 = number_format($row['application_fee_sum3']*($row['p_support']/100))."<br>";
			else $application_fee_expect3 = "-<br>";
		} else {
			$application_fee_expect3 = "-<br>";
		}
	} else {
		$application_fee_sum3 = "";
		$application_fee_expect3 = "";
	}
	if($row['application_kind4']) {
		if($row['application_fee_sum4']) {
			$application_fee_sum4 = number_format($row['application_fee_sum4'])."<br>";
		} else {
			$application_fee_sum4 = "-<br>";
		}
		if($row['application_fee_sum4']) {
			if($row['p_support']) $application_fee_expect4 = number_format($row['application_fee_sum4']*($row['p_support']/100))."<br>";
			else $application_fee_expect4 = "-<br>";
		} else {
			$application_fee_expect4 = "-<br>";
		}
	} else {
		$application_fee_sum4 = "";
		$application_fee_expect4 = "";
	}
	if($row['application_kind5']) {
		if($row['application_fee_sum5']) {
			$application_fee_sum5 = number_format($row['application_fee_sum5'])."";
		} else {
			$application_fee_sum5 = "-";
		}
		if($row['application_fee_sum5']) {
			if($row['p_support']) $application_fee_expect5 = number_format($row['application_fee_sum5']*($row['p_support']/100))."<br>";
			else $application_fee_expect5 = "-<br>";
		} else {
			$application_fee_expect5 = "-";
		}
	} else {
		$application_fee_sum5 = "";
		$application_fee_expect5 = "";
	}
	//신청금액 / 매출금액 합계
	$afs = str_replace(',','',$application_fee_sum);
	$afs2 = str_replace(',','',$application_fee_sum2);
	$afs3 = str_replace(',','',$application_fee_sum3);
	$afs4 = str_replace(',','',$application_fee_sum4);
	$afs5 = str_replace(',','',$application_fee_sum5);
	$application_fee_sum_sum += ($afs+$afs2+$afs3+$afs4+$afs5);
	$afe = str_replace(',','',$application_fee_expect);
	$afe2 = str_replace(',','',$application_fee_expect2);
	$afe3 = str_replace(',','',$application_fee_expect3);
	$afe4 = str_replace(',','',$application_fee_expect4);
	$afe5 = str_replace(',','',$application_fee_expect5);
	$application_fee_expect_sum += ($afe+$afe2+$afe3+$afe4+$afe5);
	//신청기간/분기 선택
	$application_date_chk = explode(',',$row['application_date_chk']);
	//신청분기 1
	$application_quarter_year = explode(',',$row['application_quarter_year']);
	$application_quarter = explode('_',$row['application_quarter']);
	$application_quarter_1 = explode(',',$application_quarter[0]);
	$application_quarter_2 = explode(',',$application_quarter[1]);
	$application_quarter_3 = explode(',',$application_quarter[2]);
	if($application_date_chk[0] == 1) {
		$application_date = "분기<br>";
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
		$application_date = "기간<br>";
		if($row['application_date_start']) $application_date_title = $row['application_date_start']."~".$row['application_date_end'];
		else $application_date_title = "-";
	}
	//신청분기 2
	if($row['application_kind2']) {
		$application_quarter_year = explode(',',$row['application_quarter_year2']);
		$application_quarter2 = explode('_',$row['application_quarter2']);
		$application_quarter_1 = explode(',',$application_quarter2[0]);
		$application_quarter_2 = explode(',',$application_quarter2[1]);
		$application_quarter_3 = explode(',',$application_quarter2[2]);
		if($application_date_chk[1] == 1) {
			$application_date2 = "분기<br>";
			if($application_quarter_year[0]) {
				$application_date2_title = $application_quarter_year[0]."년 ";
				if($application_quarter_1[0] == 1) $application_date2_title .= "1.";
				if($application_quarter_1[1] == 1) $application_date2_title .= "2.";
				if($application_quarter_1[2] == 1) $application_date2_title .= "3.";
				if($application_quarter_1[3] == 1) $application_date2_title .= "4.";
				$application_date2_title .= "분기";
			} else {
				$application_date2_title = "-\n";
			}
			if($application_quarter_year[1]) {
				$application_date2_title .= "\n".$application_quarter_year[1]."년 ";
				if($application_quarter_2[0] == 1) $application_date2_title .= "1.";
				if($application_quarter_2[1] == 1) $application_date2_title .= "2.";
				if($application_quarter_2[2] == 1) $application_date2_title .= "3.";
				if($application_quarter_2[3] == 1) $application_date2_title .= "4.";
				$application_date2_title .= "분기";
			}
			if($application_quarter_year[2]) {
				$application_date2_title .= "\n".$application_quarter_year[2]."년 ";
				if($application_quarter_3[0] == 1) $application_date2_title .= "1.";
				if($application_quarter_3[1] == 1) $application_date2_title .= "2.";
				if($application_quarter_3[2] == 1) $application_date2_title .= "3.";
				if($application_quarter_3[3] == 1) $application_date2_title .= "4.";
				$application_date2_title .= "분기";
			}
		} else {
			$application_date2 = "기간<br>";
			if($row['application_date_start2']) $application_date2_title = $row['application_date_start2']."~".$row['application_date_end2']."\n";
			else $application_date2_title = "-";
		}
	} else {
		$application_date2 = "";
		$application_date2_title = "";
	}
	//신청분기 3
	if($row['application_kind3']) {
		$application_quarter_year = explode(',',$row['application_quarter_year3']);
		$application_quarter3 = explode('_',$row['application_quarter3']);
		$application_quarter_1 = explode(',',$application_quarter2[0]);
		$application_quarter_2 = explode(',',$application_quarter2[1]);
		$application_quarter_3 = explode(',',$application_quarter2[2]);
		if($application_date_chk[1] == 1) {
			$application_date3 = "분기<br>";
			if($application_quarter_year[0]) {
				$application_date3_title = $application_quarter_year[0]."년 ";
				if($application_quarter_1[0] == 1) $application_date3_title .= "1.";
				if($application_quarter_1[1] == 1) $application_date3_title .= "2.";
				if($application_quarter_1[2] == 1) $application_date3_title .= "3.";
				if($application_quarter_1[3] == 1) $application_date3_title .= "4.";
				$application_date3_title .= "분기";
			} else {
				$application_date3_title = "-\n";
			}
			if($application_quarter_year[1]) {
				$application_date3_title .= "\n".$application_quarter_year[1]."년 ";
				if($application_quarter_2[0] == 1) $application_date3_title .= "1.";
				if($application_quarter_2[1] == 1) $application_date3_title .= "2.";
				if($application_quarter_2[2] == 1) $application_date3_title .= "3.";
				if($application_quarter_2[3] == 1) $application_date3_title .= "4.";
				$application_date3_title .= "분기";
			}
			if($application_quarter_year[2]) {
				$application_date3_title .= "\n".$application_quarter_year[2]."년 ";
				if($application_quarter_3[0] == 1) $application_date3_title .= "1.";
				if($application_quarter_3[1] == 1) $application_date3_title .= "2.";
				if($application_quarter_3[2] == 1) $application_date3_title .= "3.";
				if($application_quarter_3[3] == 1) $application_date3_title .= "4.";
				$application_date3_title .= "분기";
			}
		} else {
			$application_date3 = "기간<br>";
			if($row['application_date_start3']) $application_date3_title = $row['application_date_start3']."~".$row['application_date_end3']."\n";
			else $application_date3_title = "-";
		}
	} else {
		$application_date3 = "";
		$application_date3_title = "";
	}
	//신청분기 4
	if($row['application_kind4']) {
		$application_quarter_year = explode(',',$row['application_quarter_year4']);
		$application_quarter4 = explode('_',$row['application_quarter4']);
		$application_quarter_1 = explode(',',$application_quarter4[0]);
		$application_quarter_2 = explode(',',$application_quarter4[1]);
		$application_quarter_3 = explode(',',$application_quarter4[2]);
		if($application_date_chk[1] == 1) {
			$application_date4 = "분기<br>";
			if($application_quarter_year[0]) {
				$application_date4_title = $application_quarter_year[0]."년 ";
				if($application_quarter_1[0] == 1) $application_date4_title .= "1.";
				if($application_quarter_1[1] == 1) $application_date4_title .= "2.";
				if($application_quarter_1[2] == 1) $application_date4_title .= "3.";
				if($application_quarter_1[3] == 1) $application_date4_title .= "4.";
				$application_date4_title .= "분기";
			} else {
				$application_date4_title = "-\n";
			}
			if($application_quarter_year[1]) {
				$application_date4_title .= "\n".$application_quarter_year[1]."년 ";
				if($application_quarter_2[0] == 1) $application_date4_title .= "1.";
				if($application_quarter_2[1] == 1) $application_date4_title .= "2.";
				if($application_quarter_2[2] == 1) $application_date4_title .= "3.";
				if($application_quarter_2[3] == 1) $application_date4_title .= "4.";
				$application_date4_title .= "분기";
			}
			if($application_quarter_year[2]) {
				$application_date4_title .= "\n".$application_quarter_year[2]."년 ";
				if($application_quarter_3[0] == 1) $application_date4_title .= "1.";
				if($application_quarter_3[1] == 1) $application_date4_title .= "2.";
				if($application_quarter_3[2] == 1) $application_date4_title .= "3.";
				if($application_quarter_3[3] == 1) $application_date4_title .= "4.";
				$application_date4_title .= "분기";
			}
		} else {
			$application_date4 = "기간<br>";
			if($row['application_date_start4']) $application_date4_title = $row['application_date_start4']."~".$row['application_date_end4']."\n";
			else $application_date4_title = "-";
		}
	} else {
		$application_date4 = "";
		$application_date4_title = "";
	}
	//신청분기 5
	if($row['application_kind5']) {
		$application_quarter_year = explode(',',$row['application_quarter_year5']);
		$application_quarter5 = explode('_',$row['application_quarter5']);
		$application_quarter_1 = explode(',',$application_quarter5[0]);
		$application_quarter_2 = explode(',',$application_quarter5[1]);
		$application_quarter_3 = explode(',',$application_quarter5[2]);
		if($application_date_chk[1] == 1) {
			$application_date5 = "분기<br>";
			if($application_quarter_year[0]) {
				$application_date5_title = $application_quarter_year[0]."년 ";
				if($application_quarter_1[0] == 1) $application_date5_title .= "1.";
				if($application_quarter_1[1] == 1) $application_date5_title .= "2.";
				if($application_quarter_1[2] == 1) $application_date5_title .= "3.";
				if($application_quarter_1[3] == 1) $application_date5_title .= "4.";
				$application_date5_title .= "분기";
			} else {
				$application_date5_title = "-\n";
			}
			if($application_quarter_year[1]) {
				$application_date5_title .= "\n".$application_quarter_year[1]."년 ";
				if($application_quarter_2[0] == 1) $application_date5_title .= "1.";
				if($application_quarter_2[1] == 1) $application_date5_title .= "2.";
				if($application_quarter_2[2] == 1) $application_date5_title .= "3.";
				if($application_quarter_2[3] == 1) $application_date5_title .= "4.";
				$application_date5_title .= "분기";
			}
			if($application_quarter_year[2]) {
				$application_date5_title .= "\n".$application_quarter_year[2]."년 ";
				if($application_quarter_3[0] == 1) $application_date5_title .= "1.";
				if($application_quarter_3[1] == 1) $application_date5_title .= "2.";
				if($application_quarter_3[2] == 1) $application_date5_title .= "3.";
				if($application_quarter_3[3] == 1) $application_date5_title .= "4.";
				$application_date5_title .= "분기";
			}
		} else {
			$application_date5 = "기간<br>";
			if($row['application_date_start5']) $application_date5_title = $row['application_date_start5']."~".$row['application_date_end5']."\n";
			else $application_date5_title = "-";
		}
	} else {
		$application_date5 = "";
		$application_date5_title = "";
	}
	//재접수일자
	if($row['reapplication_date']) $reapplication_date = $row['reapplication_date']."<br>";
	else $reapplication_date = "-<br>";
	if($application_kind2) {
		if($row['reapplication_date2']) $reapplication_date2 = $row['reapplication_date2']."<br>";
		else $reapplication_date2 = "-<br>";
	} else {
		$reapplication_date2 = "";
	}
	if($row['reapplication_date3']) $reapplication_date3 = $row['reapplication_date3']."<br>";
	else $reapplication_date3 = "";
	if($row['reapplication_date4']) $reapplication_date4 = $row['reapplication_date4']."<br>";
	else $reapplication_date4 = "";
	if($row['reapplication_date5']) $reapplication_date5 = $row['reapplication_date5']."<br>";
	else $reapplication_date5 = "";
	//재접수일자 색상
	if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
	else $reapplication_date_color = "";
	//업체입금일
	if($row['client_receipt_date']) $client_receipt_date = $row['client_receipt_date']."<br>";
	else $client_receipt_date = "-<br>";
	if($application_kind2) {
		if($row['client_receipt_date2']) $client_receipt_date2 = $row['client_receipt_date2']."<br>";
		else $client_receipt_date2 = "-<br>";
	} else {
		$client_receipt_date2 = "";
	}
	//재접수일자 색상
	if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
	else $client_receipt_date_color = "";
	//업체입금액
	if($row['client_receipt_fee']) {
		$client_receipt_fee = number_format($row['client_receipt_fee'])."<br>";
	} else {
		$client_receipt_fee = "-<br>";
	}
	if($application_kind2) {
		if($row['client_receipt_fee2']) {
			$client_receipt_fee2 = number_format($row['client_receipt_fee2'])."<br>";
		} else {
			$client_receipt_fee2 = "-<br>";
		}
	} else {
		$client_receipt_fee2 = "";
	}
	if($application_kind3) {
		if($row['client_receipt_fee3']) {
			$client_receipt_fee3 = number_format($row['client_receipt_fee3'])."<br>";
		} else {
			$client_receipt_fee3 = "-<br>";
		}
	} else {
		$client_receipt_fee3 = "";
	}
	if($application_kind4) {
		if($row['client_receipt_fee4']) {
			$client_receipt_fee4 = number_format($row['client_receipt_fee4'])."<br>";
		} else {
			$client_receipt_fee4 = "-<br>";
		}
	} else {
		$client_receipt_fee4 = "";
	}
	if($application_kind5) {
		if($row['client_receipt_fee5']) {
			$client_receipt_fee5 = number_format($row['client_receipt_fee5'])."<br>";
		} else {
			$client_receipt_fee5 = "-<br>";
		}
	} else {
		$client_receipt_fee5 = "";
	}
	//업체입금액 색상
	if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
	else $client_receipt_date_color = "";
	//업체입금액 합계
	$crf = str_replace(',','',$client_receipt_fee);
	$crf2 = str_replace(',','',$client_receipt_fee2);
	$crf3 = str_replace(',','',$client_receipt_fee3);
	$crf4 = str_replace(',','',$client_receipt_fee4);
	$crf5 = str_replace(',','',$client_receipt_fee5);
	$client_receipt_fee_sum += ($crf+$crf2+$crf3+$crf4+$crf5);
	//본사입금일
	if($row['main_receipt_date']) $main_receipt_date = $row['main_receipt_date']."<br>";
	else $main_receipt_date = "-<br>";
	if($application_kind2) {
		if($row['main_receipt_date2']) $main_receipt_date2 = $row['main_receipt_date2']."<br>";
		else $main_receipt_date2 = "-<br>";
	} else {
		$main_receipt_date2 = "";
	}
	//본사입금일 색상
	if($main_receipt_date >= $search_sday && $main_receipt_date <= $search_eday) $main_receipt_date_color = "color:red";
	else $main_receipt_date_color = "";
	//거래명세서
	if($row['statement_date']) $statement_date = $row['statement_date']."<br>";
	else $statement_date = "-<br>";
	if($application_kind2) {
		if($row['statement_date2']) $statement_date2 = $row['statement_date2']."<br>";
		else $statement_date2 = "-";
	} else {
		$statement_date2 = "";
	}
	//세금계산서
	if($row['tax_invoice']) $tax_invoice = $row['tax_invoice']."<br>";
	else $tax_invoice = "-<br>";
	if($application_kind2) {
		if($row['tax_invoice2']) $tax_invoice2 = $row['tax_invoice2']."<br>";
		else $tax_invoice2 = "-";
	} else {
		$tax_invoice2 = "";
	}

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
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
	//업종
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "client_application_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
														<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a>
													</td>
													<td class="ltrow1_center_h22"><?=$branch?></td>
													<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
													<td class="ltrow1_left_h22" style=""><?=$application_kind?><?=$application_kind2?><?=$application_kind3?><?=$application_kind4?><?=$application_kind5?></td>
													<td class="ltrow1_center_h22"><?=$p_support?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$application_fee_sum?><?=$application_fee_sum2?><?=$application_fee_sum3?><?=$application_fee_sum4?><?=$application_fee_sum5?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$application_fee_expect?><?=$application_fee_expect2?><?=$application_fee_expect3?><?=$application_fee_expect4?><?=$application_fee_expect5?></td>
													<td class="ltrow1_center_h22">
														<span title="<?=$application_date_title?>"><?=$application_date?></span>
														<span title="<?=$application_date2_title?>"><?=$application_date2?></span>
														<span title="<?=$application_date3_title?>"><?=$application_date3?></span>
														<span title="<?=$application_date4_title?>"><?=$application_date4?></span>
														<span title="<?=$application_date5_title?>"><?=$application_date5?></span>
													</td>
													<td class="ltrow1_center_h22" style="<?=$reapplication_date_color?>"><?=$reapplication_date?><?=$reapplication_date2?><?=$reapplication_date3?><?=$reapplication_date4?><?=$reapplication_date5?></td>
													<td class="ltrow1_center_h22" style="<?=$client_receipt_date_color?>"><?=$client_receipt_date?><?=$client_receipt_date2?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$client_receipt_fee?><?=$client_receipt_fee2?></td>
													<td class="ltrow1_center_h22" style="<?=$main_receipt_date_color?>"><?=$main_receipt_date?><?=$main_receipt_date2?></td>
													<td class="ltrow1_center_h22"><?=$statement_date?><?=$statement_date2?></td>
													<td class="ltrow1_center_h22"><?=$tax_invoice?><?=$tax_invoice2?></td>
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
													<td class="tdhead_center" colspan="4">합계(신청금액, 매출금액)</td>
													<td class="tdhead_center"><?=number_format($application_fee_sum_sum)?></td>
													<td class="tdhead_center"><?=number_format($application_fee_expect_sum)?></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"><?=number_format($client_receipt_fee_sum)?></td>
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
<? } else { ?>
											<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td height="40">
														<div align="center">
															검색 후 리스트가 표시 됩니다.
														</div>
													</td>
												</tr>
											</table>
<? } ?>
										</form>
									</td>
								</tr>
							</table>
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
