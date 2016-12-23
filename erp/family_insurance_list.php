<?
$sub_menu = "190500";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code ";
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
	$sql_search = " where a.com_code = b.com_code and a.damdang_code='$member[mb_profile]' ";
}
//기본 검색 : 환급신청의뢰, 근무여부, 보험가입자
$sql_search .= " and ( b.refund_request='1' or b.family_work_if='1' or b.insurance_holder!='' ) ";

//사업장명칭
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//사업자등록번호
if($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//대표자
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//전화번호
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//가족보험료환급 처리현황
if($stx_family_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.family_process = '$stx_family_process') ";
	$sql_search .= " ) ";
}
//지사
if($stx_man_cust_name) {
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
//담당매니저
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
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
    $sst = "b.family_date";
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

$sub_title = "가족보험료";
$g4[title] = $sub_title." : 지원금 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 13;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_manage_name=".$stx_manage_name."&stx_count=".$stx_count."&stx_family_process=".$stx_family_process;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript" src="js/common.js"></script>
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
<script type="text/javascript">
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
function goCheck_ok(obj) {
	var id = obj.name.substring(9,14);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "family_insurance_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>
					<td width=""><img src="images/top19_05.gif" border="0" alt="가족보험료환급" /></td>
						<td>
<?
$title_main_no = "19";
include "inc/sub_menu.php";
?>
						</td>
				</tr>
				<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
			</table>
			<form name="searchForm" method="get" style="padding:10px 0 0 0">
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
							<input name="stx_comp_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
						<td nowrap class="tdrow">
							<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
							<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
						<td nowrap class="tdrow">
							<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황</td>
						<td nowrap class="tdrow">
							<select name="stx_family_process" class="selectfm" onchange="">
								<option value="">전체</option>
								<option value="1" <? if($stx_family_process == "1") echo "selected"; ?>><?=$family_process_arry[1]?></option>
								<option value="2" <? if($stx_family_process == "2") echo "selected"; ?>><?=$family_process_arry[2]?></option>
								<option value="3" <? if($stx_family_process == "3") echo "selected"; ?>><?=$family_process_arry[3]?></option>
								<option value="4" <? if($stx_family_process == "4") echo "selected"; ?>><?=$family_process_arry[4]?></option>
								<option value="5" <? if($stx_family_process == "5") echo "selected"; ?>><?=$family_process_arry[5]?></option>
								<option value="6" <? if($stx_family_process == "6") echo "selected"; ?>><?=$family_process_arry[6]?></option>
							</select>
						</td>
<?
if($member['mb_level'] > 7) {
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
						<td nowrap class="tdrow" colspan="">
							<input name="stx_upjong"  type="text" class="textfm" style="width:90px;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">범위</td>
						<td nowrap class="tdrow" colspan="">
							<select name="stx_count" class="selectfm" onchange="">
								<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20건</option>
								<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100건</option>
								<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>전체</option>
							</select>
						</td>
						<td nowrap class="tdrowk"></td>
						<td nowrap class="tdrow" colspan="7">
						</td>
					</tr>
				</table>
			</form>
<?
//진행현황 처리현황 카운트
$unselect = 0;
$consider = 0;
$progress_task = 0;
$official_document = 0;
$work_complete = 0;
$not_target = 0;
$reserve = 0;
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
$sql_family = " select family_process from com_list_gy_opt where ( refund_request='1' or family_work_if='1' or insurance_holder!='' ) ";
//echo $sql_family;
$result_family = sql_query($sql_family);
for ($i=0; $row_family=mysql_fetch_assoc($result_family); $i++) {
	if($row_family['family_process'] == 1) $consider++;
	else if($row_family['family_process'] == 2) $progress_task++;
	else if($row_family['family_process'] == 3) $official_document++;
	else if($row_family['family_process'] == 4) $work_complete++;
	else if($row_family['family_process'] == 5) $not_target++;
	else if($row_family['family_process'] == 6) $reserve++;
	else if($row_family['family_process'] == "") $unselect++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/erp_family_insurance_tag_total.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 56px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_family_insurance_tag0.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=no&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_family_insurance_tag1.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=1&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$consider?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_family_insurance_tag2.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=2&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$progress_task?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_family_insurance_tag3.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=3&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$official_document?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px;height:36px;background:url('images/erp_family_insurance_tag4.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=4&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$work_complete?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px;height:36px;background:url('images/erp_family_insurance_tag5.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=5&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$not_target?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px;height:36px;background:url('images/erp_family_insurance_tag6.png') no-repeat;;margin:5px 10px 0 0;" onclick="location.href='family_insurance_list.php?stx_family_process=6&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
				<tr>
					<td align="center">
						<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
						<a href="client_reapplication.php" target=""><img src="./images/btn_client_reapplication_big.png" border="0"></a>
						<a href="unpaid_balance.php" target=""><img src="./images/btn_unpaid_balance_big.png" border="0"></a>
					</td>
				</tr>
			</table>

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
				<input type="hidden" name="chk_data">
				<input type="hidden" name="page" value="<?=$page?>">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr>
						<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
						<td class="tdhead_center" width="46">No</td>
						<td class="tdhead_center" width="72">등록일자</td>
						<td class="tdhead_center">사업장명</td>
						<td class="tdhead_center" width="94">사업자등록번호</td>
						<td class="tdhead_center" width="48">수수료</td>
						<td class="tdhead_center" width="62">근무여부</td>
						<td class="tdhead_center" width="62">환급신청</td>
						<td class="tdhead_center" width="207">보험가입자</td>
						<td class="tdhead_center" width="82">처리현황</td>
						<td class="tdhead_center" width="60">관리점</td>
						<td class="tdhead_center" width="60">열람점</td>
						<td class="tdhead_center" width="90">담당자</td>
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
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 40, "..");
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
	//등록일자
	//$regdt = $row['regdt'];
	$regdt = $row['family_date'];
	//보험가입자
	$insurance_holder = $row['insurance_holder'];
	if(!$insurance_holder) $insurance_holder = "-";
	//수수료 : 지원금, 부담금, 건설
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	if($p_support == "0%") $p_support = "-";
	if($p_support == "%") $p_support = "-";
	if($p_contribution == "0%") $p_contribution = "-";
	if($p_construction == "0%") $p_construction = "-";
	//부담금 수수료 적용 150626
	if($application_kind_code >= 13 && $application_kind_code <= 16) $p_support = $p_contribution;
	//근무여부
	if($row['family_work_if'] == "1") $family_work_if = "YES";
	else if($row['family_work_if'] == "2") $family_work_if = "NO";
	else $family_work_if = "-";
	//환급신청의뢰
	if($row['refund_request'] == "1") $refund_request = "YES";
	else if($row['refund_request'] == "2") $refund_request = "NO";
	else $refund_request = "-";
	//불가사유
	$family_refund_wrong = $row['family_refund_wrong'];
	if(!$family_refund_wrong) $family_refund_wrong = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	$damdang_code2 = $row['damdang_code2'];
	if($damdang_code2) $branch2 = $man_cust_name_arry[$damdang_code2];
	else $branch2 = "-";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//링크 URL
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "family_insurance_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
						<td class="ltrow1_center_h22"><?=$no?></td>
						<td class="ltrow1_center_h22" style="<?=$application_accept_color?>"><?=$regdt?></td>
						<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
							<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name.$reapplication_done_return?></a>
						</td>
						<td class="ltrow1_center_h22"><?=$biz_no?></td>
						<td class="ltrow1_center_h22"><?=$p_support?></td>
						<td class="ltrow1_center_h22" style="color:blue"><?=$family_work_if?></td>
						<td class="ltrow1_center_h22" style="color:blue"><?=$refund_request?></td>
						<td class="ltrow1_left_h22" style=""><?=$insurance_holder?></td>
						<td class="ltrow1_center_h22">
<?
$sel_check_ok = array();
$check_ok_id = $row['family_process'];
$sel_check_ok[$check_ok_id] = "selected";
$mb_id = $member['mb_id'];
if( ($is_admin == "super" && $member['mb_level'] != 6) || $mb_id=='kcmc1009' ) {
?>
							<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
								<option value="">선택</option>
								<option value="1" <?=$sel_check_ok['1']?>><?=$family_process_arry[1]?></option>
								<option value="2" <?=$sel_check_ok['2']?>><?=$family_process_arry[2]?></option>
								<option value="3" <?=$sel_check_ok['3']?>><?=$family_process_arry[3]?></option>
								<option value="4" <?=$sel_check_ok['4']?>><?=$family_process_arry[4]?></option>
								<option value="5" <?=$sel_check_ok['5']?>><?=$family_process_arry[5]?></option>
								<option value="6" <?=$sel_check_ok['6']?>><?=$family_process_arry[6]?></option>
							</select>
<?
} else {
	if($family_process_arry[$check_ok_id]) echo $family_process_arry[$check_ok_id];
	else echo "-";
}
?>
						</td>
						<td class="ltrow1_center_h22"><?=$branch?></td>
						<td class="ltrow1_center_h22"><?=$branch2?></td>
						<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
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
<iframe name="check_ok_iframe" src="support_person_check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
