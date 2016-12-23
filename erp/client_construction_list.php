<?
$sub_menu = "1800300";
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
}
//기본 검색어
$sql_search .= " and b.construction_yn = '1' ";

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
//검색 : 지사
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
}
//검색 : 검색기간
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7 || $search_day8) $sql_search .= " and ( ";
	//위탁서
	if($search_day1) {
		$sql_search .= " (a.regdt >= '$search_sday' and a.regdt <= '$search_eday') ";
	}
	//위탁서
	if($search_day2) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (a.editdt >= '$search_sday' and a.editdt <= '$search_eday') ";
		$sst = "a.editdt";
	}
	//위탁서
	if($search_day3) {
		if($search_day1 || $search_day2) $sql_search .= " or ";
		$sql_search .= " (b.samu_receive_date >= '$search_sday' and b.samu_receive_date <= '$search_eday') ";
		$sst = "b.samu_receive_date";
	}
	//사무수임
	if($search_day4) {
		if($search_day1 || $search_day2 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (b.samu_req_date >= '$search_sday' and b.samu_req_date <= '$search_eday') ";
		$sst = "b.samu_req_date";
	}
	//사무수임 해지
	if($search_day5) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (b.samu_close_date >= '$search_sday' and b.samu_close_date <= '$search_eday') ";
		$sst = "b.samu_close_date";
	}
	//대리인(공단)
	if($search_day6) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " or ";
		$sql_search .= " (b.agent_elect_public_edate >= '$search_sday' and b.agent_elect_public_edate <= '$search_eday') ";
		$sst = "b.agent_elect_public_edate";
	}
	//전자민원
	if($search_day7) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " or ";
		$sql_search .= " (b.agent_elect_center_edate >= '$search_sday' and b.agent_elect_center_edate <= '$search_eday') ";
		$sst = "b.agent_elect_center_edate";
	}
	//이지노무
	if($search_day8) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7) $sql_search .= " or ";
		$sql_search .= " (c.easynomu_finish_date >= '$search_sday' and c.easynomu_finish_date <= '$search_eday') ";
		$sst = "c.easynomu_finish_date";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7 || $search_day8) $sql_search .= " ) ";
}
//검색 : 업태
if($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//검색 : 의뢰서
if($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//검색1 : 위탁서
if($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색1 : 대리인선임(공단)
if($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색1 : 대리인선임(센터)
if($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색1 : 이지노무
if($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
	$sql_search .= " ) ";
}
//검색1 : 키즈노무
if($stx_comp_gubun9) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '2') ";
	$sql_search .= " ) ";
}
//검색2 : 지원금
if($stx_comp_gubun6) {
	$sql_search .= " and ( ";
	$sql_search .= " ( c.application_kind != '0' and c.application_kind != '' ) ";
	$sql_search .= " ) ";
}
//거래처구분 : 5인미만
if($stx_emp5_gbn) {
	$sql_search .= " and ( ";
	$sql_search .= " ( b.emp5_gbn != '0' and b.emp5_gbn != '' ) ";
	$sql_search .= " ) ";
}
//거래처구분 : 30인미만
if($stx_emp30_gbn) {
	$sql_search .= " and ( ";
	$sql_search .= " ( b.emp30_gbn != '0' and b.emp30_gbn != '' ) ";
	$sql_search .= " ) ";
}
//처리현황 : 프로그램
if ($easynomu_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.easynomu_process = '$easynomu_process') ";
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
//담당자 미등록
if($stx_manage_name_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '') ";
	$sql_search .= " ) ";
}
//정렬
if(!$sst) {
	//$sst = "a.com_code";
	$sst = "b.service_day_start";
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

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if(!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "건설월정액";
$g4[title] = $sub_title." : 프로그램 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 17;
//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&easynomu_process=".$easynomu_process."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_emp5_gbn=".$stx_emp5_gbn."&stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_manage_name=".$stx_manage_name."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_manage_name_input_not=".$stx_manage_name_input_not;
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
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");
	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if(calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};
	function onClose(calendar) {
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
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top18.gif" border="0" alt="프로그램" /></td>
						<td><a href="client_construction_list.php"><img src="images/top18_03.gif" border="0" alt="건설월정액" /></a></td>
						<td>
<?
$title_main_no = "18";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
							<form name="searchForm" method="get">
								<input type="hidden" name="search_ok" />
								<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
								<!--데이터 -->
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr> 
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
														검색
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
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
										<td nowrap class="tdrowk" width="90"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명칭</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:160px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="110"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
										<td nowrap class="tdrow">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk" width="74"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자</td>
										<td nowrap class="tdrow">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">범위</td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo ""; else echo "3"; ?>">
											<select name="stx_count" class="selectfm" onchange="">
												<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20건</option>
												<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100건</option>
												<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>전체</option>
											</select>
										</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0" alt="*" />지사</td>
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
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_manage_name"  type="text" class="textfm" style="width:100px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_manage_name_input_not" value="1" <? if($stx_manage_name_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_uptae"  type="text" class="textfm" style="width:90px;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo ""; else echo "3"; ?>">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">열람</td>
										<td nowrap class="tdrow">
											<select name="stx_man_cust_name2" class="selectfm">
												<option value="">전체</option>
<?
	$stx_man_cust_name = $stx_man_cust_name2;
	include "inc/stx_man_cust_name.php";
?>
											</select>
										</td>
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검색기간</td>
										<td nowrap class="tdrow" colspan="9">
											<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
												<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>오늘</option>
												<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>기간선택</option>
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
											<input type="checkbox" name="search_day1" value="1" <? if($search_day1 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">등록일자
											<input type="checkbox" name="search_day2" value="1" <? if($search_day2 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">의뢰서
											<input type="checkbox" name="search_day3" value="1" <? if($search_day3 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">위탁서
											<input type="checkbox" name="search_day4" value="1" <? if($search_day4 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">사무수임
											<input type="checkbox" name="search_day5" value="1" <? if($search_day5 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">사무해지
											<input type="checkbox" name="search_day6" value="1" <? if($search_day6 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">대리인
											<input type="checkbox" name="search_day7" value="1" <? if($search_day7 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">전자민원
											<input type="checkbox" name="search_day8" value="1" <? if($search_day8 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">이지노무
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">거래처구분</td>
										<td nowrap class="tdrow" colspan="7">
											<input type="checkbox" name="stx_comp_gubun1" value="1" <? if($stx_comp_gubun1 == 1) echo "checked"; ?> style="vertical-align:middle">의뢰서
											<input type="checkbox" name="stx_comp_gubun2" value="1" <? if($stx_comp_gubun2 == 1) echo "checked"; ?> style="vertical-align:middle">위탁서
											<input type="checkbox" name="stx_comp_gubun3" value="1" <? if($stx_comp_gubun3 == 1) echo "checked"; ?> style="vertical-align:middle">대리인선임(공단)
											<input type="checkbox" name="stx_comp_gubun4" value="1" <? if($stx_comp_gubun4 == 1) echo "checked"; ?> style="vertical-align:middle">전자민원(센터)
											<input type="checkbox" name="stx_comp_gubun6" value="1" <? if($stx_comp_gubun6 == 1) echo "checked"; ?> style="vertical-align:middle">지원금
											<input type="checkbox" name="stx_comp_gubun7" value="1" <? if($stx_comp_gubun7 == 1) echo "checked"; ?> style="vertical-align:middle">환급금
											<input type="checkbox" name="stx_comp_gubun8" value="1" <? if($stx_comp_gubun8 == 1) echo "checked"; ?> style="vertical-align:middle">기타
											<input type="checkbox" name="stx_emp5_gbn" value="1" <? if($stx_emp5_gbn == 1) echo "checked"; ?> style="vertical-align:middle">5인미만
											<input type="checkbox" name="stx_emp30_gbn" value="1" <? if($stx_emp30_gbn == 1) echo "checked"; ?> style="vertical-align:middle">30인이상
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황</td>
										<td nowrap class="tdrow" colspan="">
											<select name="easynomu_process" class="selectfm" onchange="">
												<option value=""  <? if($easynomu_process == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($easynomu_process == "1") echo "selected"; ?>>기초셋팅중</option>
												<option value="2" <? if($easynomu_process == "2") echo "selected"; ?>>급여셋팅중</option>
												<option value="3" <? if($easynomu_process == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($easynomu_process == "4") echo "selected"; ?>>보류</option>
												<option value="5" <? if($easynomu_process == "5") echo "selected"; ?>>해지</option>
												<option value="6" <? if($easynomu_process == "6") echo "selected"; ?>>보완서류요청</option>
											</select>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
											<a href="client_list.php" target=""><img src="./images/btn_customer_con_big.png" border="0"></a>
											<a href="client_process_list.php" target=""><img src="./images/btn_receipt_con_big.png" border="0"></a>
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
							<!--리스트 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="70" rowspan="2">등록일자</td>
										<td class="tdhead_center" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="98" rowspan="1">사업자등록번호</td>
										<td class="tdhead_center" width="100" rowspan="1">대표자</td>
										<td class="tdhead_center" width="110" rowspan="1">업태</td>
										<td class="tdhead_center" width="80" rowspan="1">처리현황<br></td>
										<td class="tdhead_center" width="70" rowspan="1">세팅비</td>
										<td class="tdhead_center" width="80" rowspan="2">서비스시작</td>
										<td class="tdhead_center" width="80" rowspan="2">서비스종료</td>
										<td class="tdhead_center" width="80" rowspan="1">사무위탁수임</td>
										<td class="tdhead_center" width="80" rowspan="1">대리인선임</td>
										<td class="tdhead_center" width="90" rowspan="1">관리점</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="1">사업장관리번호</td>
										<td class="tdhead_center" width="" rowspan="1">사업개시일</td>
										<td class="tdhead_center" width="" rowspan="1">업종</td>
										<td class="tdhead_center" width="" rowspan="1">결제일</td>
										<td class="tdhead_center" width="" rowspan="1">월정액</td>
										<td class="tdhead_center" width="" rowspan="1">사무위탁해지</td>
										<td class="tdhead_center" width="" rowspan="1">전자민원</td>
										<td class="tdhead_center" width="" rowspan="1">담당자</td>
									</tr>
<?
//리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
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
	$regdt_time = $row['regdt_time'];
	$regdt_time_array = explode(" ",$row['regdt_time']);
	$regdt_time_only = $regdt_time_array[1];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
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
	//사무위탁수임
	$samu_req_yn_array = Array("","미도착","수임가능","타수임","수임","해지","반려");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn = "-";
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	if($samu_req_date >= $search_sday && $samu_req_date <= $search_eday) $samu_req_date_color = "color:red";
	else $samu_req_date_color = "";
	//해지일
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
	if($samu_close_date >= $search_sday && $samu_close_date <= $search_eday) $samu_close_date_color = "color:red";
	else $samu_close_date_color = "";
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
	//이지노무
	$easynomu_process_array = Array("","기초셋팅중","급여셋팅중","완료","보류","해지","보완서류요청");
	$easynomu_process_code = $row['easynomu_process'];
	if($row['easynomu_process']) $easynomu_process = $easynomu_process_array[$easynomu_process_code];
	else $easynomu_process = "-";
	//이지노무 결제일
	if($row['settlement_day']) $settlement_day = $row['settlement_day'];
	else $settlement_day = "-";
	if($row['settlement_day_last']) $settlement_day = "말일";
	//이지노무 세팅비 : 숫자형 변수 변환 150807
	if(!$row['setting_pay']) $row['setting_pay'] = 0;
	else $row['setting_pay'] = (int)$row['setting_pay'];
	$setting_pay = number_format($row['setting_pay']);
	if(!$setting_pay) $setting_pay = "-";
	//이지노무 월정액
	if(!$row['month_pay']) $row['month_pay'] = 0;
	else $row['month_pay'] = (int)$row['month_pay'];
	$month_pay = number_format($row['month_pay']);
	if(!$month_pay) $month_pay = "-";
	//서비스 시작일 종료일
	$service_day_start = $row['service_day_start'];
	if(!$service_day_start) $service_day_start = "-";
	$service_day_end = $row['service_day_end'];
	if(!$service_day_end) $service_day_end = "-";
	//뷰 페이지 링크
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "client_construction_view.php?id=$id&w=u&page=$page&$qstr&$stx_qstr";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//진행취소, 보류 사업장 회색 블럭 표시
	if($easynomu_process_code == '5') {
		$tr_class = "list_row_now_gr";
		$program_text_cancel = "<span style='color:red;'>(해지)</span>";
	} else if($easynomu_process_code == '4') {
		$tr_class = "list_row_now_gr";
		$program_text_cancel = "<span style='color:red;'>(보류)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$program_text_cancel = "";
	}
?>
									<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?><br><?=$samu_receive_no?></td>
										<td class="ltrow1_center_h22" style="<?=$regdt_color?>" title="<?=$regdt_time_only?>"><?=$regdt?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?><?=$program_text_cancel?></a>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span><br><span title="<?=$upjong_full?>"><?=$upjong?></span></td>
										<td class="ltrow1_center_h22"><?=$easynomu_process?><br><?=$settlement_day?></td>
										<td class="ltrow1_center_h22"><?=$setting_pay?><br><?=$month_pay?></td>
										<td class="ltrow1_center_h22"><?=$service_day_start?></td>
										<td class="ltrow1_center_h22"><?=$service_day_end?></td>
										<td class="ltrow1_center_h22"><span style="<?=$samu_req_date_color?>"><?=$samu_req_date?></span><br><span style="<?=$samu_close_date_color?>"><?=$samu_close_date?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$agent_elect_public_edate_color?>"><?=$agent_elect_public_edate?></span><br><span style="<?=$agent_elect_center_edate_color?>"><?=$agent_elect_center_edate?></span></td>
										<td class="ltrow1_center_h22"><?=$branch?><br><?=$manage_cust_name?></td>
									</tr>
<?
}
if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
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
$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&$stx_qstr&page=");
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
