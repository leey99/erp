<?
$sub_menu = "100100";
include_once("./_common.php");

$now_date_type = date("Y-m-d");

$sql_common = " from erp_alert ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	//$sql_search = " where 1=1 ";
	//$sql_search = " where send_to like '%$member[mb_id]%' ";
	$sql_search = " where alert_code like '9001%' ";
} else {
	$sql_search = " where branch='$member[mb_profile]' ";
}
//현재 이전 알림만 표시 : 미래 알림 해당 일시에 표시됨 151111
$sql_search .= " and ( wr_datetime < '$now_date_type 23:59:59' ) ";
//회원ID
$mb_id = $member['mb_id'];

//내알림 / 대상자 미설정(전체 알림) 표시 160427
if($member['mb_id'] == "master") $sql_search .= " ";
else $sql_search .= " and ( user_id='$mb_id' or ( send_to like '%$member[mb_id]%' or send_to='' ) ) ";

//삭제 알림 제외 (로그인 ID 비교) 160120
$sql_search .= " and del_main not like '%$member[mb_id]%' ";

//거래처 정보(사업장명) 없는 알림
$sql_search .= " and com_name='' ";

//지사
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (branch = '$stx_man_cust_name' or branch2 = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//알림구분
if ($stx_alert_code && $stx_alert_code != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (alert_code = '$stx_alert_code') ";
	$sql_search .= " ) ";
}
//검색기간
if($stx_search_day_chk) {
	$sql_search .= " and ( ";
	$sql_search .= " (wr_datetime >= '$search_sday 00:00:00' and wr_datetime <= '$search_eday 23:59:59') ";
	$sql_search .= " ) ";
	$sst = "wr_datetime";
	$sod = "desc";
}
//읽음/안읽음 (본인)
if ($stx_read_my) {
	$sql_search .= " and ( ";
	if ($stx_read_my == 1) {
		$sql_search .= " (read_main not like '%$mb_id%') ";
	} else if ($stx_read_my == 2) {
		$sql_search .= " (read_main like '%$mb_id%') ";
	}
	$sql_search .= " ) ";
}
//읽음/안읽음 (본사)
if ($stx_read_main) {
	$sql_search .= " and ( ";
	if ($stx_read_main == 1) {
		$sql_search .= " (read_main = '') ";
	} else if ($stx_read_main == 2) {
		$sql_search .= " (read_main != '') ";
	}
	$sql_search .= " ) ";
}
//읽음/안읽음 (지사)
if ($stx_read_branch) {
	$sql_search .= " and ( ";
	if ($stx_read_branch == 1) {
		$sql_search .= " (read_branch = '') ";
	} else if ($stx_read_branch == 2) {
		$sql_search .= " (read_branch != '') ";
	}
	$sql_search .= " ) ";
}
//등록자
if($stx_charge) {
	$sql_search .= " and ( ";
	$sql_search .= " (user_name like '%$stx_charge%') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
    $sst = "wr_datetime";
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

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "내알림";
$g4[title] = $sub_title." : 알림 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 9;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;search_ok=".$search_ok."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday;
//추가검색
$qstr .= "&amp;stx_alert_code=".$stx_alert_code."&amp;stx_charge=".$stx_charge."&amp;stx_read_my=".$stx_read_my."&amp;stx_read_main=".$stx_read_main."&amp;stx_read_branch=".$stx_read_branch;
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
function del_ok() {
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
			frm.action="alert_my_delete.php";
			frm.submit();
		} else {
			return;
		}
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
		if(confirm("정말 읽음처리 하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="alert_read_check.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function not_read_ok() {
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
		if(confirm("정말 안읽음처리 하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="alert_not_read_check.php";
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
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top_alert.gif" border="0" /></td>
									<td width=""><a href="alert_my.php"><img src="images/top_alert_groupware.gif" border="0" /></a></td>
									<td>
<?
include "inc/sub_menu_alert.php";
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
													<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">등록자</td>
													<td nowrap class="tdrow" width="180">
														<input name="stx_charge"  type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_charge?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="110"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">알림구분</td>
													<td nowrap class="tdrow" width="140">
														<select name="stx_alert_code" class="selectfm">
															<option value="all">전체</option>
															<option value="90002" <? if($stx_alert_code == '90002') echo "selected"; ?>>주요일정</option>
															<option value="90003" <? if($stx_alert_code == '90003') echo "selected"; ?>>업무일지</option>
														</select>
													</td>
<?
$search_colspan = 3;
?>
													<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
													<td nowrap class="tdrow"  colspan="<?=$search_colspan?>">
														<select name="stx_man_cust_name" class="selectfm">
															<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
														</select>
													</td>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검색기간</td>
													<td nowrap class="tdrow" colspan="3">
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
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">읽음여부</td>
													<td nowrap class="tdrow" colspan="<?=$search_colspan?>">
														본인
														<select name="stx_read_my" class="selectfm" onchange="">
															<option value=""  <? if($stx_read_my == "")  echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_read_my == "1") echo "selected"; ?>>안읽음</option>
															<option value="2" <? if($stx_read_my == "2") echo "selected"; ?>>읽음</option>
														</select>
														본사
														<select name="stx_read_main" class="selectfm" onchange="">
															<option value=""  <? if($stx_read_main == "")  echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_read_main == "1") echo "selected"; ?>>안읽음</option>
															<option value="2" <? if($stx_read_main == "2") echo "selected"; ?>>읽음</option>
														</select>
														지사
														<select name="stx_read_branch" class="selectfm" onchange="">
															<option value=""  <? if($stx_read_branch == "")  echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_read_branch == "1") echo "selected"; ?>>안읽음</option>
															<option value="2" <? if($stx_read_branch == "2") echo "selected"; ?>>읽음</option>
														</select>
													</td>
												</tr>
											</table>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>

											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
														<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
														<a href="javascript:checked_ok();" target=""><img src="./images/btn_read_check_big.png" border="0"></a>
														<a href="javascript:not_read_ok();" target=""><img src="./images/btn_not_read_check_big.png" border="0"></a>
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
											<input type="hidden" name="chk_data" />
											<input type="hidden" name="this_url" value="alert_groupware" />
											<input type="hidden" name="page" value="<?=$page?>" />
											<input type="hidden" name="qstr" value="<?=$qstr?>" />
											<input type="hidden" name="stx_my"  value="1" />
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed">
												<tr>
													<td class="tdhead_center" width="26" rowspan=""><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="46" rowspan="">No</td>
													<td class="tdhead_center" width="74" rowspan="">등록일자</td>
													<td class="tdhead_center" width="80" rowspan="">관리점</td>
													<td class="tdhead_center" width="" rowspan="">내용</td>
													<td class="tdhead_center" width="78" rowspan="">등록자</td>
													<td class="tdhead_center" width="78" rowspan="">대상자</td>
													<td class="tdhead_center" width="84" rowspan="">확인자(본사)</td>
													<td class="tdhead_center" width="84" rowspan="">확인자(지사)</td>
												</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//사업장 옵션 DB
	$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$idx = $row['idx'];
	$id = $row['com_code'];
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
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
	if($row['boss_name']) $boss_name = $row['boss_name'];
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['branch'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//관리점 : 열람
	$damdang_code2 = $row['branch2'];
	if($damdang_code2) $branch2 = ">".$man_cust_name_arry[$damdang_code2];
	else $branch2 = "";
	//담당매니저
	$manage_cust_name = $row_opt['manage_cust_name'];
	$memo = $row['memo'];
	//확인자(본사)
	$mb_name = "";
	$mb_nick = "";
	$read_main_array = explode(",", $row['read_main']);
	for($rm=0;$rm<count($read_main_array);$rm++) {
		$sql_member = " select * from a4_member where mb_id = '$read_main_array[$rm]' ";
		$row_member = sql_fetch($sql_member);
		$mb_name .= $row_member['mb_name'];
		if($rm < count($read_main_array) && $read_main_array[$rm]) $mb_name .="<br />";
		$mb_nick .= $row_member['mb_nick'].". ";
	}
	if($mb_name) {
		$read_main = $mb_name;
		$read_main_name = $mb_nick;
	} else {
		$read_main = "-";
	}
	//확인자(지사)
	$sql_member = " select * from a4_member where mb_id = '$row[read_branch]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		$read_branch = $mb_name;
		$read_branch_name = $mb_nick;
	} else {
		$read_branch = "-";
	}
	//최종확인자
/*
	$sql_erp_view_log = " select * from erp_view_log where com_code = '$row[com_code]' order by idx desc limit 0, 1 ";
	$row_erp_view_log = sql_fetch($sql_erp_view_log);
	$sql_member = " select * from a4_member where mb_id = '$row_erp_view_log[user_id]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		//$latest_user = $mb_name." (".$mb_nick.")";
		$latest_user = $mb_name;
		$latest_user_name = $mb_nick;
	} else {
		$latest_user = "-";
	}
*/
	//대상자
	$send_to_array = explode(",", $row['send_to']);
	$send_to = "";
	for($sta=0; $sta<=count($send_to_array);$sta++) {
		if($send_to_array[0]) {
			//echo $idx." ".$sta." ".$send_to_array[$sta]." / ";
			if($send_to_array[$sta] == "branch") $send_to = "담당지사";
			else if($send_to_array[$sta] == "kcmc1006") $send_to .= "박소향 사원";
			else if($send_to_array[$sta] == "kcmc1008") $send_to .= "전정애 주임";
			else if($send_to_array[$sta] == "manager") $send_to .= "지원금";
			else if($send_to_array[$sta] == "kcmc1009") $send_to .= "김국진 과장";
			else if($send_to_array[$sta] == "kcmc1007") $send_to .= "임현미 사원";
			else if($send_to_array[$sta] == "kcmc1001") $send_to .= "최성민 대표";
			else if($send_to_array[$sta] == "kcmc2007") $send_to .= "이경화 사원";
			else if($send_to_array[$sta] == "kcmc1004") $send_to .= "정경용 부장";
			else if($send_to_array[$sta] == "kcmc0331") $send_to .= "임영진 주임";
			else if($send_to_array[$sta] == "kcmc2001") $send_to .= "최희용 주임";
			if($sta<=count($send_to_array) && $send_to_array[$sta]) $send_to .= "<br />";
		} else {
			$send_to = "전체";
		}
	}
	//등록자
	$sql_member = " select * from a4_member where mb_id = '$row[user_id]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		$reg_user = $mb_name;
		$reg_user_name = $mb_nick;
	} else {
		$reg_user = "-";
		$reg_user_name = "";
	}
	//담당자 성명
	if($member['mb_level'] > 6 && $reg_user_name) $reg_user_name_text = "<br />(".$reg_user_name.")";
	else $reg_user_name_text = "";
	//등록일자
	$date1 = substr($row['wr_datetime'],0,10); //날짜표시형식변경
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$latest_date = $year."-".$month."-".$day."";
	//echo $row['branch']." == ".$member['mb_profile'];
	//알림코드
	$alert_code = $row['alert_code'];
	//전달사항 코드
	$memo_type = $row['memo_type'];
	//링크
	if($member['mb_level'] > 6 || $row['branch'] == $member['mb_profile']) {
		$client_view = "alert_read_link.php?link_url=view&idx=$idx&id=$id&w=u&$qstr&page=$page";
		$client_process_view = "alert_read_link.php?link_url=process&idx=$idx&id=$id&w=u&$qstr&page=$page&alert_code=$alert_code&memo_type=$memo_type";
	} else {
		$client_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		$client_process_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//덧글 최신글 new 표시
	if($row['wr_datetime'] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	//읽음처리
	if($member['mb_profile'] == 1) {
		//자기 자신이 확인하지 않은 알림은 안읽음 처리
		//echo $member['mb_id']."=".$row['read_main'].strpos($row['read_main'], $mb_id)." ";
		if(strpos($row['read_main'], $member['mb_id']) !== false) {
			$text_bold = "";
		} else {
			$text_bold = "font-weight:bold";
		}
	} else {
		if($row['read_branch']) {
			$text_bold = "";
		} else {
			$text_bold = "font-weight:bold";
		}
	}
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$idx?>" class="no_borer"></td>
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_center_h22"><?=$latest_date?></td>
													<td class="ltrow1_center_h22"><?=$branch?><?=$branch2?></td>
													<td class="ltrow1_left_h22"><a href="<?=$client_process_view?>" style="<?=$text_bold?>"><?=$memo?> <?=$comment_new?></a></td>
													<td class="ltrow1_center_h22" title="<?=$reg_user_name?> <?=$row['wr_datetime']?>"><?=$reg_user?><?=$reg_user_name_text?></td>
													<td class="ltrow1_center_h22" title="<?=$send_to_name?>"><?=$send_to?></td>
													<td class="ltrow1_center_h22" title="<?=$read_main_name?> <?=$row['read_main_time']?>"><?=$read_main?></td>
													<td class="ltrow1_center_h22" title="<?=$read_branch_name?> <?=$row['read_branch_time']?>"><?=$read_branch?></td>

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
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
<?
if($is_admin == "super" || $member['mb_level'] >= 9) {
?>
														<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
															<tr>
																<td width=2></td>
																<td><img src=images/btn_lt.gif></td>
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:del_ok();" target="">선택삭제</a></td>
																<td><img src=images/btn_rt.gif></td>
															 <td width=2></td>
															</tr>
														</table>
<?
}
?>
											<input type="checkbox" name="idx" style="display:none;" />
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
