<?
//$sub_menu = "1900700";
$sub_menu = "200700";
include_once("./_common.php");
//사업장명 검색 시
if(!$stx_comp_name && !$stx_biz_no) {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_reduction c, com_list_gy_opt2 d ";
} else {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 d ";
}
if($member['mb_level'] > 6 || $search_ok == "ok" || $member['mb_profile'] == '16') {
	if(!$stx_comp_name && !$stx_biz_no) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.com_code = d.com_code ";
		//삭제된 거래처 제외
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and a.com_code = d.com_code ";
	}
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
	if(!$stx_comp_name && !$stx_biz_no) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.com_code = d.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
		//삭제된 거래처 제외
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and a.com_code = d.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	}
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
//사업장명칭
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//사업자등록번호
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//대표자
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//주소검색
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//지사
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//열람
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//검색기간
if($stx_search_day_chk) {
	//$sst = "a.report_date";
	//$sod = "desc";
	$search_sday_date = explode(".", $search_sday); 
	$year = $search_sday_date[0];
	$month = $search_sday_date[1]; 
	$day = $search_sday_date[2]; 
	$search_sday_time = $year."-".$month."-".$day." 00:00:00";
	$search_eday_date = explode(".", $search_eday); 
	$year = $search_eday_date[0];
	$month = $search_eday_date[1]; 
	$day = $search_eday_date[2]; 
	$search_eday_time = $year."-".$month."-".$day." 23:59:59";
	$sql_search .= " and (c.reduction_regt >= '$search_sday_time' and c.reduction_regt <= '$search_eday_time') ";
}
//업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//업종
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//명부 등록 여부
if($stx_employment_kind1) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.in_file_1 != '') ";
	$sql_search .= " ) ";
}
if($stx_employment_kind2) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.out_file_1 != '') ";
	$sql_search .= " ) ";
}
if($stx_employment_kind3) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.recipient_file_1 != '') ";
	$sql_search .= " ) ";
}
//처리현황
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (c.reduction_process = '') ";
	else $sql_search .= " (c.reduction_process = '$stx_process') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
	if(!$stx_comp_name && !$stx_biz_no) {
		$sst = "c.idx";
	} else {
		$sst = "a.com_code";
	}
	$sod = "desc";
}
//그룹바이
if(!$stx_comp_name && !$stx_biz_no) {
	$group_by = " group by c.com_code ";
} else {
	$group_by = "";
}
$sql_order = " order by $sst $sod ";
//카운트
if(!$stx_comp_name && !$stx_biz_no) {
	$sql = " select count(distinct c.com_code) as cnt $sql_common $sql_search $sql_order ";
} else {
	$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
}
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top19_07.gif";
$sub_title = "감원방지기간조회";
//$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;
$g4['title'] = $sub_title." : 지원금 : ".$easynomu_name;

$sql = " select *
					$sql_common
					$sql_search
					$group_by
					$sql_order
					limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;
//검색 파라미터 전송
$qstr = "stx_process=".$stx_process."&amp;stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_contract=".$stx_contract."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;stx_search_day_chk=".$stx_search_day_chk;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_employment_kind1=".$stx_employment_kind1."&amp;stx_employment_kind2=".$stx_employment_kind2."&amp;stx_employment_kind3=".$stx_employment_kind3."&stx_employment_manager_name=".$stx_employment_manager_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
function goSearch() {
	var frm = document.searchForm;
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
	//alert("데이터 삭제는 관리자에게 문의하십시오.");
	//return;
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
			frm.action="electric_charges_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./electric_charges_etc.php?id="+id, "electric_charges_etc", "scrollbars=yes,width=600,height=360");
	return;
}
function loadCalendar(obj) {
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
	function onClose(calendar) {
		calendar.hide();
		calendar.destroy();
	};
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
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
	//탭 시프트+탭 좌 우 Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		//alert(inputVal.length);
		//alert(input);
		if(inputVal.length == 3) {
			//input = delhyphen(inputVal, inputVal.length);
			total += input.substring(0,3)+"-";
		} else if(inputVal.length == 6) {
			total += inputVal.substring(0,8)+"-";
		} else if(inputVal.length == 12) {
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y') {
			type.value = total;
		}else if(keydown =='N') {
			return total;
		}
	}
	return total;
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='-') {		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
//처리현황 변경 함수
function goCheck_ok(obj) {
	var id = obj.name.substring(9,14);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "reduction_prevention_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
<?
//검색기간 함수
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
	} else if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
</script>
<?
include "inc/top.php";
$php_self = $_SERVER['PHP_SELF'];
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<!--<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>-->
					<td width="100"><img src="images/top02.gif" border="0" alt="지원금" /></td>
					<td><a href="<?=$php_self?>"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
					<td>
<?
//$title_main_no = "19";
$title_main_no = "02";
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
<?
//현대 전체 사용자 열람 가능
$is_admin = "super";
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
						<!--데이터 -->
						<table border="0" cellpadding="0" cellspacing="0"> 
							<tr> 
								<td id=""> 
									<table border="0" cellpadding="0" cellspacing="0"> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											검색
											</td> 
											<td><img src="images/g_tab_on_rt.gif"></td> 
										</tr> 
									</table> 
								</td> 
								<td width="2"></td> 
								<td valign="bottom"> ※ 지원대상자가 있는 해당 "사업장명" 또는 "사업자등록번호"로 검색 후, 사업장명을 클릭하여 지원대상자 정보를 입력하면 됩니다.</td> 
							</tr> 
						</table>
						<div style="height:2px;font-size:0px" class="bgtr"></div>
						<div style="height:2px;font-size:0px;line-height:0px;"></div>
						<!--검색 -->
						<form name="searchForm" method="get">
							<!--데이터 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="100"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;font-weight:bold;">사업장명</td>
									<td nowrap class="tdrow" width="164">
										<input name="stx_comp_name" type="text" class="textfm" style="width:140px;border:2px solid red;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="116"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
									<td nowrap class="tdrow" width="146">
										<input name="stx_biz_no" type="text" class="textfm" style="width:120px;border:2px solid red;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="94"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
									<td nowrap class="tdrow" width="116">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="94"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />주소검색</td>
									<td nowrap class="tdrow"  width="116">
										<input name="stx_addr"  type="text" class="textfm" style="width:75px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="선검색어" />
									</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="">전체</option>
<?
//$damdang_code = $stx_man_cust_name;
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검색기간</td>
									<td nowrap class="tdrow" colspan="3">
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
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">열람</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name2" class="selectfm">
											<option value="">전체</option>
<?
//지사 검색 데이터 유지 151027
$stx_man_cust_name_old = $stx_man_cust_name;
$stx_man_cust_name = $stx_man_cust_name2;
include "inc/stx_man_cust_name.php";
$stx_man_cust_name = $stx_man_cust_name_old;
?>
										</select>
									</td>
<? } ?>
								</tr>
							</table>
						</form>
<?
//진행현황 처리현황 카운트
$progress_task = 0;
$progress_confirm = 0;
$contracts_progress = 0;
$support_request = 0;
$work_complete = 0;
$not_target = 0;
$progress_review = 0;
$reserve = 0;
$unselect = 0;
//본사, 지사 구분 검색
if($damdang_code != "all" && $damdang_code) {
	$sql_search_add = " and a.damdang_code='$damdang_code' ";
} 
//사업장 기본정보 DB : 담당 지사 검색 쿼리
if($member['mb_level'] == 6) {
	$sql_search_add2 = " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
} else {
	if($stx_man_cust_name) $sql_search_add2 = " and ( a.damdang_code='$stx_man_cust_name' ) ";
	if($stx_man_cust_name2) $sql_search_add2 .= " and ( a.damdang_code2='$stx_man_cust_name2' ) ";
}
$sql_reduction = " select c.reduction_process from com_list_gy a, com_reduction c where a.com_code=c.com_code and c.delete_yn != '1' $sql_search_add $sql_search_add2 ";
//echo $sql_reduction;
$result_reduction = sql_query($sql_reduction);
for ($i=0; $row_reduction=mysql_fetch_assoc($result_reduction); $i++) {
	if($row_reduction['reduction_process'] == 1) $progress_confirm++; //확인
	else if($row_reduction['reduction_process'] == 2) $progress_task++; //진행
	else if($row_reduction['reduction_process'] == 3) $support_request++;
	else if($row_reduction['reduction_process'] == 4) $work_complete++;
	else if($row_reduction['reduction_process'] == 5) $not_target++;
	else if($row_reduction['reduction_process'] == 6) $progress_review++; //검토
	else if($row_reduction['reduction_process'] == 7) $reserve++;
	else if($row_reduction['reduction_process'] == 8) $contracts_progress++;
	else if($row_reduction['reduction_process'] == "") $unselect++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/support_person_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 49px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/bold_tag11.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_process=no&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/reduction_prevention_tag1.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_process=1&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$progress_confirm?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/acceleration_employment_tag6.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_process=6&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$progress_review?></div>
							</div>
							<!--<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/acceleration_employment_tag2.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_process=2&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$progress_task?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/erp_electric_charges_tag6.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_process=7&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>-->
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/acceleration_employment_tag5.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self?>?stx_process=5&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 84px;"><?=$not_target?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
								</td>
							</tr>
						</table>
						<div style="height:1px;font-size:0px"></div>
<? } ?>
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
							<!--리스트 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="240" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="110" rowspan="1">사업자등록번호</td>
										<td class="tdhead_center" width="100" rowspan="1">대표자</td>
										<td class="tdhead_center" width="70" rowspan="2">사무위탁</td>
										<td class="tdhead_center" width="70" rowspan="1">대리인</td>
										<td class="tdhead_center" width="60" rowspan="1">취득</td>
										<td class="tdhead_center" width="" rowspan="2">메모</td>
										<td class="tdhead_center" width="94" rowspan="2">처리자</td>
										<td class="tdhead_center" width="94" rowspan="2">처리현황</td>
										<td class="tdhead_center" width="114" rowspan="1">관리점</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="1">사업장관리번호</td>
										<td class="tdhead_center" width="" rowspan="1">사업개시일</td>
										<td class="tdhead_center" width="" rowspan="1">전자민원</td>
										<td class="tdhead_center" width="" rowspan="1">상실</td>
										<td class="tdhead_center" width="" rowspan="1">담당자</td>
									</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	//echo $total_count;
  $list = $i%2;
	//사업장 코드번호
	$id = $row['com_code'];
	//등록일자
	$regdt = $row['employment_regd'];
	if($regdt) $regdt_br = "<br>".$regdt;
	else $regdt_br = "";
	$regdt_time = $row['employment_regt'];
	$regdt_time_array = explode(" ",$row['employment_regt']);
	$regdt_time_only = $regdt_time_array[1];
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 26, "..");
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
	$com_juso = $row['com_juso'];
	$com_juso_full = $com_juso." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 24, "..");
	//우편번호
	$com_postno = $row['com_postno'];
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
	if($damdang_code) {
		$branch = $man_cust_name_arry[$damdang_code];
		if($row['damdang_code2']) {
			$damdang_code2 = $row['damdang_code2'];
			$branch .= ">".$man_cust_name_arry[$damdang_code2];
		}
	} else {
		$branch = "-";
	}
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//뷰페이지 링크
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "reduction_prevention_view.php?w=u&amp;id=$id&amp;page=$page&amp;$qstr";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//사무위탁수임
	$samu_req_yn_array = Array("","미도착","수임가능","타수임","수임","해지","반려");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn = "-";
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
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
	//사업장명, 사업자등록번호 검색 시 신규고용확인 DB 접속 151119
	if($stx_comp_name || $stx_biz_no) {
		$sql_reduction = " select * from com_reduction where com_code='$id' ";
		$result_reduction = sql_query($sql_reduction);
		$row = mysql_fetch_array($result_reduction);
	}
	//취득
	if($row['in_file_1']) $in_file = "○";
	else $in_file = "-";
	//상실
	if($row['out_file_1']) $out_file = "○";
	else $out_file = "-";
	//확인
	if($row['in_file_1'] && $row['out_file_1']) $reduction_check = "○";
	else $reduction_check = "-";
	//메모
	$memo = $row['reduction_memo'];
	//처리자
	$reduction_user = $row['reduction_user'];
	//처리현황
	$reduction_process = $row['reduction_process'];
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a><?//=$regdt_br?>
<?
	if($com_juso) {
?>
											<br>											(<?=$com_postno?>) <?=$com_juso?>
<?
	}
?>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><?=$samu_req_date?></td>
										<td class="ltrow1_center_h22"><?=$agent_elect_public_edate?><br /><?=$agent_elect_center_edate?></td>
										<td class="ltrow1_center_h22"><?=$in_file?><br /><?=$out_file?></td>
										<td class="ltrow1_left_h22"><?=$memo?></td>
										<td class="ltrow1_center_h22"><?=$reduction_user?></td>
										<td class="ltrow1_center_h22">
<?
	$sel_check_ok = array();
	$check_ok_id = $reduction_process;
	$sel_check_ok[$check_ok_id] = "selected";
	if( ($is_admin == "super" && $member['mb_level'] != 6) || $member['mb_profile'] == '16' ) {
?>
											<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
												<option value="">선택</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$reduction_process_arry[1]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$reduction_process_arry[6]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$reduction_process_arry[2]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$reduction_process_arry[7]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$reduction_process_arry[5]?></option>
											</select>
<?
	} else {
		if($reduction_process_arry[$check_ok_id]) echo $reduction_process_arry[$check_ok_id];
		else echo "-";
	}
?>
										</td>
										<td class="ltrow1_center_h22">
<?
	//본사만 괸리점, 담당자 표시 151112
	if($member['mb_level'] != 6) echo $branch."<br />".$manage_cust_name;
	else echo "-";
?>
										</td>
									</tr>
<?
}
//echo $i;
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
									</tr>
								</table>
								<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40">
											<div align="center">
												<?
												$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page=");
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
<iframe name="check_ok_iframe" src="reduction_prevention_check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
