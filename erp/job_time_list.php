<?
//$sub_menu = "1900100";
$sub_menu = "200700";
include_once("./_common.php");

$sql_common = " from job_time a, job_time_opt b ";

//첫페이지 담당지사 표시
//if(!$stx_man_cust_name) $stx_man_cust_name = $member['mb_profile'];
$is_admin = "super";
//권한별 표시
if($member['mb_level'] <= 6) {
	$stx_man_cust_name = $member['mb_profile'];
	$sql_search = " where a.id=b.id and a.delete_yn != '1' and a.damdang_code='$stx_man_cust_name' ";
	//지사 영업사원 권한
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and (a.writer='$manage_code' or a.manager='$manage_code') ";
	}
} else {
	$sql_search = " where a.id=b.id and a.delete_yn != '1' ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and (a.writer='$manage_code' or a.manager='$manage_code') ";
	}
}
if($member['mb_id'] == "user") {
	$sql_search .= " and a.view_restrict != '1' ";
}

//검색 : 사업장명칭
if($stx_com_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_com_name%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
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
//검색 : 주소
if($stx_com_juso) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_com_juso%') ";
	$sql_search .= " ) ";
}
//검색 : 처리현황
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (b.check_ok = '') ";
	else $sql_search .= " (b.check_ok = '$stx_process') ";
	$sql_search .= " ) ";
}
//검색 : 참여신청일
if($stx_joindt) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.joindt = '$stx_joindt') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_job_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.writer_name like '%$stx_job_name%') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if($stx_man_cust_name != "all" && $stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//검색 : ERP등록
if($stx_client_register) {
	$sql_search .= " and ( ";
	if($stx_client_register == "no") $sql_search .= " (a.com_code = '') ";
	else $sql_search .= " (a.com_code != '') ";
	$sql_search .= " ) ";
}
if (!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top19_01.gif";
$sub_title = "고용창출";
//$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;
$g4['title'] = $sub_title." : 지원금 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso."&stx_man_cust_name=".$stx_man_cust_name;
$qstr .= "&stx_process=".$stx_process."&stx_joindt=".$stx_joindt."&stx_job_name=".$stx_job_name."&stx_client_register=".$stx_client_register."&stx_com_juso=".$stx_com_juso;
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
			frm.action="job_time_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./job_time_etc.php?id="+id, "job_time_etc", "scrollbars=yes,width=600,height=360");
	return;
}
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
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
function goCheck_ok(obj) {
	//alert(obj.name+" "+obj.value);
	var id = obj.name.substring(9,14);
	//alert(id);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "job_time_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;border:0 solid red;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<!--<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>-->
					<td width="100"><img src="images/top02.gif" border="0" alt="지원금" /></td>
					<td><a href="job_time_list.php"><img src="<?=$top_sub_title?>" border="0" alt="시간선택제" /></a></td>
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
					<td valign="top" style="padding:10px 0 0 0;">
						<!--타이틀 -->	
<?
//현대 전체 사용자 열람 가능
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
						<!--데이터 -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
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
						<form name="searchForm" method="get">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="110">사업장명</td>
									<td nowrap class="tdrow" width="190">
										<input name="stx_com_name" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$stx_com_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="74">업종</td>
									<td nowrap class="tdrow" width="140">
										<input name="stx_upjong" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="74">주소</td>
									<td nowrap class="tdrow" width="140">
										<input name="stx_com_juso" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_com_juso?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="100">전화번호</td>
									<td nowrap class="tdrow">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="100">처리현황</td>
									<td nowrap class="tdrow">
										<select name="stx_process" class="selectfm" onchange="goSearch();">
											<option value=""  <? if($stx_process == "")  echo "selected"; ?>>전체</option>
											<option value="1" <? if($stx_process == "1") echo "selected"; ?>><?=$job_time_process_arry[1]?></option>
											<option value="2" <? if($stx_process == "2") echo "selected"; ?>><?=$job_time_process_arry[2]?></option>
											<option value="3" <? if($stx_process == "3") echo "selected"; ?>><?=$job_time_process_arry[3]?></option>
											<option value="4" <? if($stx_process == "4") echo "selected"; ?>><?=$job_time_process_arry[4]?></option>
											<option value="5" <? if($stx_process == "5") echo "selected"; ?>><?=$job_time_process_arry[5]?></option>
											<option value="6" <? if($stx_process == "6") echo "selected"; ?>><?=$job_time_process_arry[6]?></option>
											<option value="7" <? if($stx_process == "7") echo "selected"; ?>><?=$job_time_process_arry[7]?></option>
											<option value="8" <? if($stx_process == "8") echo "selected"; ?>><?=$job_time_process_arry[8]?></option>
											<option value="9" <? if($stx_process == "9") echo "selected"; ?>><?=$job_time_process_arry[9]?></option>
											<option value="10" <? if($stx_process == "10") echo "selected"; ?>><?=$job_time_process_arry[10]?></option>
											<option value="no" <? if($stx_process == "no") echo "selected"; ?>>미선택</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk">참여신청일</td>
									<td nowrap class="tdrow">
										<input name="stx_joindt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_joindt?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
										<table border="0" cellpadding="0" cellspacing="0" style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_joindt);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk">담당자</td>
									<td nowrap class="tdrow">
										<input name="stx_job_name" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_job_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk">ERP등록</td>
									<td nowrap class="tdrow">
										<select name="stx_client_register" class="selectfm" onchange="goSearch();">
											<option value=""   <? if($stx_client_register == "")   echo "selected"; ?>>전체</option>
											<option value="ok" <? if($stx_client_register == "ok") echo "selected"; ?>>등록</option>
											<option value="no" <? if($stx_client_register == "no") echo "selected"; ?>>미등록</option>
										</select>
									</td>
<?
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk">지사</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="all">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
								</tr>
							</table>
						</form>
<?
//진행현황 처리현황 카운트
$consult_done = 0;
$receive_completion = 0;
$participate_apply = 0;
$recognize_done = 0;
$progress_wrong = 0;
$reserve = 0;
$veto = 0;
$call_ready = 0;
$re_contact = 0;
$visit_planned = 0;
$unselect = 0;
//본사, 지사 구분 검색
if($stx_man_cust_name != "all" && $stx_man_cust_name) {
	$sql_search_add = " and a.damdang_code='$stx_man_cust_name' ";
} 
//시간선택제 DB
$sql_job_time = " select b.check_ok from job_time a, job_time_opt b where a.id = b.id and a.delete_yn != '1' $sql_search_add ";
$result_job_time = sql_query($sql_job_time);
for ($i=0; $row_job_time=mysql_fetch_assoc($result_job_time); $i++) {
	if($row_job_time['check_ok'] == 1) $consult_done++;
	else if($row_job_time['check_ok'] == 2) $receive_completion++;
	else if($row_job_time['check_ok'] == 3) $participate_apply++;
	else if($row_job_time['check_ok'] == 4) $recognize_done++;
	else if($row_job_time['check_ok'] == 5) $progress_wrong++;
	else if($row_job_time['check_ok'] == 6) $reserve++;
	else if($row_job_time['check_ok'] == 7) $veto++;
	else if($row_job_time['check_ok'] == 8) $call_ready++;
	else if($row_job_time['check_ok'] == 9) $re_contact++;
	else if($row_job_time['check_ok'] == 10) $visit_planned++;
	else if($row_job_time['check_ok'] == "") $unselect++;
	//$job_total_count = $row_job_time['job_time_total_cnt'];
}
//$job_total_count = (int)$consult_done+(int)$receive_completion+(int)$participate_apply+(int)$recognize_done+(int)$progress_wrong+(int)$reserve+(int)$veto+(int)$call_ready+(int)$re_contact+(int)$visit_planned;
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/erp_job_time_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 56px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag11.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=no&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag9.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=9&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$re_contact?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag10.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=10&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$visit_planned?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag8.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=8&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$call_ready?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag1.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=1&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$consult_done?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag2.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=2&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$receive_completion?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag3.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=3&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$participate_apply?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag4.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=4&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$recognize_done?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px;height:36px;background:url('images/erp_job_time_tag6.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=6&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag7.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=7&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$veto?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag5.png');margin:5px 10px 0 0;" onclick="location.href='job_time_list.php?stx_process=5&stx_job_name=<?=$stx_job_name?>&stx_man_cust_name=<?=$stx_man_cust_name?>';">
								<div class="ftwhite_div"><?=$progress_wrong?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
									<a href="job_time_view.php"><img src="./images/btn_new_big.png" border="0" /></a>
									<a href="job_time_excel.php?<?=$qstr?>"><img src="./images/btn_excel_print_big.png" border="0" /></a>
								</td>
							</tr>
						</table>
						<div style="height:1px;font-size:0px"></div>
<? } ?>

						<!--댑메뉴 -->
						<table border="0" cellspacing="0" cellpadding="0"> 
							<tr>
								<td id=""> 
									<table border="0" cellspacing="0" cellpadding="0"> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif" /></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											리스트
											</td> 
											<td><img src="images/g_tab_on_rt.gif" /></td> 
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

						<!--리스트 -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="idx">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
								<tr>
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" width="40">No</td>
									<td class="tdhead_center" width="70">등록일자</td>
									<td class="tdhead_center" width="198">사업장명</td>
									<td class="tdhead_center" width="70">업종</td>
									<td class="tdhead_center" width="76">방문일자</td>
									<td class="tdhead_center" width="98">전화번호</td>
									<td class="tdhead_center" style="minwidth:150px;">상담메모</td>
									<td class="tdhead_center" width="70">보험가입자</td>
									<td class="tdhead_center" width="78">참여/승인</td>
									<td class="tdhead_center" width="98">처리현황</td>
									<td class="tdhead_center" width="70">등록자</td>
									<td class="tdhead_center" width="80">담당자</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//NO 넘버
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row['id'];
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//업종
	$upjong = $row['upjong'];
	//시업장 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 28, "..");
	if($row['memo']) $memo_full = $row['memo'];
	else $memo_full = "상담메모 없음";
	$memo = cut_str($memo_full, 48, "..");
	if($row['etc']) $etc_full = $row['etc'];
	else $etc_full = "";
	$etc = "<br>".cut_str($etc_full, 48, "..");
	//최근 수정일자 NEW 표시
	//echo date("Y-m-d H:i:s", time() - 96 * 3600);
	if($row['editdt'] >= date("Y-m-d H:i:s", time() - 24 * 3600)) { 
		$etc_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$etc_new = "";
	}
	$etc = $etc.$etc_new;
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) {
		if(!$man_cust_name_arry[$damdang_code]) $man_cust_name_arry[$damdang_code] = $ban_cust_name_arry[$damdang_code];
		$branch = $man_cust_name_arry[$damdang_code];
		if($row['damdang_code2']) {
			$damdang_code2 = $row['damdang_code2'];
			if(!$man_cust_name_arry[$damdang_code2]) $man_cust_name_arry[$damdang_code2] = $ban_cust_name_arry[$damdang_code2];
			$branch .= ">".$man_cust_name_arry[$damdang_code2];
		}
	} else {
		$branch = "-";
	}
	//방문일자
	if($row['visitdt']) {
		$visitdt = $row['visitdt']."<br />".$row['visitdt_time'];
	} else {
		$visitdt = "-";
	}
	//데이터 없을 경우 - 표시 : 전화번호, 휴대폰
	if(!$row['com_tel']) $row['com_tel'] = "-";
	if(!$row['com_hp']) $row['com_hp'] = "-";
	if(!$row['area']) $row['area'] = "-";
	//등록자
	if(!$row['writer_name']) {
		$writer = "-";
	} else {
		$writer = $row['writer_name'];
	}
	if(!$row['manager_name']) {
		$manager = "-";
	} else {
		$manager = $row['manager_name'];
	}
	if(!$row['writer_tel']) $row['writer_tel'] = "-";
	if(!$row['process_date']) $row['process_date'] = "-";
	if(!$row['process_date2']) $row['process_date2'] = "-";
	//덧글
	$sql_comment = " select count(*) as cnt from job_time_comment where mid='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment['cnt'];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//덧글 최신글 new 표시
	$sql_comment_new = " select * from job_time_comment where mid='$id' and delete_yn!='1' order by regdt desc limit 0,1 ";
	//echo $sql_comment_new;
	$row_comment_new = sql_fetch($sql_comment_new);
	//echo date("Y-m-d H:i:s", time() - 12 * 3600);
	//echo $row_comment_new[regdt];
	if($row_comment_new['regdt'] >= date("Y-m-d H:i:s", time() - 24 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	$comment_cnt = $comment_count.$comment_new;
	//참여신청일
	if($row['joindt']) $joindt = $row['joindt'];
	else $joindt = "-";
	//승인완료일
	if($row['approval']) $ok_loan_policy = $row['approval'];
	else $approval = "-";
	//보험가입인원
	$insurance_persons = $row['insurance_persons']."명 ".$row['insurance_persons_over'];
	if(!$row['insurance_persons']) $insurance_persons = "-";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22" title="<?=$row['regtime']?>"><?=$row['regdt']?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="job_time_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
<?
//거래처 정보 등록 여부
if($row['com_code']) {
?>
										<img src="images/erp_icon.png" width="23" height="13" border="0" style="vertical-align:middle;margin-bottom:4px;" />
<?
}
?>
										<br><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22"><?=$row['upjong']?></td>
									<td class="ltrow1_center_h22"><?=$visitdt?></td>
									<td class="ltrow1_center_h22"><?=$row['com_tel']."<br />".$row['com_hp']?></td>
									<td class="ltrow1_left_h22">
										<a href="javascript:open_memo('<?=$id?>')" title="<?=$memo_full?>"><?=$memo?><?=$comment_cnt?><span style="color:blue;" title="<?=$etc_full?>"><?=$etc?></span></a>
									</td>
									<td class="ltrow1_center_h22"><?=$insurance_persons?></td>
									<td class="ltrow1_center_h22"><?=$joindt?><br /><?=$approval?></td>
<?
$sel_check_ok = array();
$check_ok_id = $row['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22">
<?
//if($is_admin == "super" && $member['mb_level'] != 6) {
if(1==1) {
?>
										<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
											<option value="">선택</option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$job_time_process_arry[9]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$job_time_process_arry[10]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$job_time_process_arry[8]?></option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$job_time_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$job_time_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$job_time_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$job_time_process_arry[4]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$job_time_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$job_time_process_arry[7]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$job_time_process_arry[5]?></option>
										</select>
<?
} else {
 echo $job_time_process_arry[$check_ok_id];
}
?>
									</td>
									<td class="ltrow1_center_h22"><?=$writer?></td>
									<td class="ltrow1_center_h22"><?=$branch?><br><?=$manager?></td>
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
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
<?
if($is_admin == "super" && $member['mb_level'] != 6) {
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checked_ok();" target="">선택삭제</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
<?
}
?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<iframe name="check_ok_iframe" src="job_time_check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
