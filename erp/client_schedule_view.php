<?
$sub_menu = "101002";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";
$sql_order = "";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top_schedule_subtile.png";
$sub_title = "스케줄(뷰)";
$g4['title'] = $sub_title." : 거래처 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	if(!$row['com_code']) alert("해당 거래처는 삭제 되었거나 존재하지 않습니다.","main.php");
	//master 로그인시 com_code 오류
	if(!$com_code) $com_code = $id;
	//신규고용확인 DB
	$sql2 = " select * from com_employment where com_code='$com_code' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//고용창출 DB
	$sql_job = " select * from job_time where com_code='$com_code' ";
	$result_job = sql_query($sql_job);
	$row_job = mysql_fetch_array($result_job);
	//사업장DB 옵션2
	$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	//echo $sql_opt2;
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//지원금 DB
	$sql_application = " select * from erp_application where com_code='$com_code' order by idx desc ";
	$result_application = sql_query($sql_application);
	$row_application = mysql_fetch_array($result_application);
	//최종확인자 로그 저장 (관리자 제외)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//메모
$memo = $row['memo'];
//검색 파라미터 전송
$qstr = "stx_process=".$stx_process."&amp;stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_contract=".$stx_contract."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;stx_search_day_chk=".$stx_search_day_chk;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_employment_kind1=".$stx_employment_kind1."&amp;stx_employment_kind2=".$stx_employment_kind2."&amp;stx_employment_kind3=".$stx_employment_kind3."&stx_employment_manager_name=".$stx_employment_manager_name;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4[title]?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css">
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd;">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkData(action_file) {
	var frm = document.dataForm;
	var rv = 0;
	frm.action = action_file;
	frm.submit();
	return;
}
// 삭제 검사 확인
function del(page,id) {
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
function only_number() {
	//alert(event.keyCode);
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 45) event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 46) event.returnValue = false;
		}
	}
}
function only_number_isnan() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
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
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122))  event.preventDefault ? event.preventDefault() : event.returnValue = false;
}
//스케줄 등록 160121
function new_schedule(url, com_code) {
	var ret = window.open(url+"?com_code="+com_code, "pop_new_schedule", "top=100, left=100, width=800,height=440, scrollbars=no, resizable=no");
	return;
}
//스케줄 삭제 군산지사 이현희 대리 의견 161027
function goDel(id) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "client_schedule_delete.php?id="+id;
	}
}
//]]>
</script>
<?
include "inc/top.php";
//목록 파일 존재하지 않음
$php_self_list = "data_list.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0" alt="거래처" /></td>
						<td width="130"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></td>
						<td>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
<?
//$samu_list = "ok";
$report = "ok";
//관리점 숨기기
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $hidden_branch = "";
else $hidden_branch = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--프린트 영역 DIV 종료-->
								<!--탭메뉴 -->
<?
//현재 탭 메뉴 번호
//$tab_onoff_this = 16;
//프로그램 종류
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
if( ($row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code) || $mb_profile_code == 1 ) include "inc/tab_menu.php";
?>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='client_schedule_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															<span onclick="getId('client_schedule_div').style.display='';" style="cursor:pointer">스케줄등록</span>
														</td> 
														<td><img src="images/sb_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;">
											</td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="client_schedule_div">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
											<tr>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분
												</td>
												<td class="tdrow" width="200">
<?
//스케줄 처리현황 160726
$client_schedule_visitdt_check_ok = $row['client_schedule_visitdt_check_ok'];
?>
													<?=$job_time_process_arry[$client_schedule_visitdt_check_ok]?>
												</td>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일정
												</td>
												<td class="tdrow">
													<span id="client_schedule_visitdt"><?=$row['client_schedule_visitdt']?></span>
													<span id="client_schedule_visitdt_time"><?=$row['client_schedule_visitdt_time']?></span>
												</td>
												<td class="tdrow" width="120">
													<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:0;">
														<tr>
															<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
															<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goDel('<?=$id?>');">삭제</a></td>
															<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />메모</td>
												<td class="tdrow" colspan="3">
													<span id="client_schedule_memo"><?=$row['client_schedule_memo']?></span>
												</td>
												<td class="tdrow" width="120">
													<a href="pop_new_schedule.php" onclick="new_schedule(this.href,<?=$id?>);return false;" onkeypress="this.onclick;"><img src="images/btn_new_schedule.png" border="0" alt="스케줄 등록" /></a>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px"></div>
									<a name="18000"><!--전기요금컨설팅--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															<span onclick="getId('electric_charges_div').style.display='';" style="cursor:pointer">전기요금컨설팅</span>
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;">
											</td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="electric_charges_div">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
											<tr>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분
												</td>
												<td class="tdrow" width="200">
													<?=$row['electric_charges_visit_kind']?>
												</td>
												<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일정</td>
												<td class="tdrow">
													<?=$row['electric_charges_visitdt']?>
													<?=$row['electric_charges_visitdt_time']?>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="18001"><!--사업주훈련--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															사업주훈련
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;"></td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="job_file_div">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
											<tr>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분
												</td>
												<td class="tdrow" width="200">
													<? if($row['job_recall_date']) echo "재연락"; ?>
												</td>
												<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일정</td>
												<td class="tdrow">
													<?=$row['job_recall_date']?>
													<?=$row['job_recall_memo']?>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="18002"><!--신규고용확인--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='acceleration_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															신규고용확인
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;"></td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="acceleration_div">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
											<tr>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분
												</td>
												<td class="tdrow" width="200">
													<?=$row2['employment_visit_kind']?>
												</td>
												<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일정</td>
												<td class="tdrow">
													<?=$row2['employment_visitdt']?>
													<?=$row2['employment_visitdt_time']?>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="18003"><!--고용창출--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='acceleration_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															고용창출
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;"></td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="acceleration_div">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
											<tr>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분
												</td>
												<td class="tdrow" width="200">
													<? if($row_job['visitdt']) echo "방문예정일"; ?>
												</td>
												<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일정</td>
												<td class="tdrow">
													<?=$row_job['visitdt']?>
													<?=$row_job['visitdt_time']?>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="18004"><!--지원금--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='acceleration_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															지원금
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;"></td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="acceleration_div">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
											<tr>
												<td nowrap class="tdrowk" width="120">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분
												</td>
												<td class="tdrow" width="200">
													<? if($row_application['reapplication_date']) echo "재접수일자"; ?>
												</td>
												<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일정</td>
												<td class="tdrow">
													<?=$row_application['reapplication_date']?>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

								</div>
								<div id="tab2" >
									<a name="40001"><!--전달사항--></a>
<?
//$memo_type = 13;
include "inc/client_comment_only.php";
?>
								<div style="height:20px;font-size:0px"></div>
								<input type="hidden" name="id" value="<?=$id?>" />
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
