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
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where branch='$member[mb_profile]' ";
}
//현재 이전 알림만 표시 : 미래 알림 해당 일시에 표시됨 151111
$sql_search .= " and ( wr_datetime < '$now_date_type 23:59:59' ) ";
//회원ID
$mb_id = $member['mb_id'];
//내알림
if($member['mb_id'] == "kcmc1006" || $member['mb_id'] == "kcmc1007" || $member['mb_id'] == "kcmc1009" || $member['mb_id'] == "kcmc2006") $sql_search .= " and ( send_to like '%$member[mb_id]%' ";
else if($member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1005") $sql_search .= " and ( send_to like '%manager%' ";
else if($member['mb_id'] == "master") $sql_search .= " and (1=1 ";
else $sql_search .= " and ( send_to like '%$member[mb_id]%' ";
//의뢰서 : 정경용 김영진 . 의뢰서 검토현황 지사접수
if($member['mb_id'] == "kcmc1004") $sql_search .= " or user_id='$mb_id' or send_to like '%$member[mb_id]%' ) ";
//사무업무 : 박소향 (직무교육, 전기요금컨설팅, 전기담당)
else if($member['mb_id'] == "kcmc1006") $sql_search .= " or user_id='$mb_id' or alert_code='80003' or send_to like '%kcmc1001%'  ) ";
//지원금관리 : 전정애 (계약서, 지원금)
else if($member['mb_id'] == "kcmc1008") $sql_search .= " or send_to like '%manager%' or alert_code='10003' ) ";
//사무위탁 : 임현미
else if($member['mb_id'] == "kcmc1007") $sql_search .= " or alert_code='15000' ) ";
//영업관리1 : 임영진 (고용창출), 담당자 122
else if($member['mb_id'] == "kcmc0331") $sql_search .= " or user_id='$mb_id' or alert_code='40003' or manage_code=122 ) ";
//영업관리2 : 최희용, 담당자 126
else if($member['mb_id'] == "kcmc2001") $sql_search .= " or user_id='$mb_id' or manage_code=126 ) ";
//한국기업경영원 : 최성민
else if($member['mb_id'] == "kcmc1001") $sql_search .= " or user_id='$mb_id' ) ";
//이지노무/가족보험 : 김국진 : 대상자(send_to) 사업주훈련(김소향 kcmc1006) 알림 표시 150915 / kcmc1006(1년 전기요금절감 요청 알림) 제거 160411 / 담당자 
else if($member['mb_id'] == "kcmc1009") $sql_search .= " or user_id='$mb_id' or manage_code=26 ) ";
//ERP문의 : 이영래
else if($member['mb_id'] == "kcmc2006") $sql_search .= " or user_id='$mb_id' or alert_code='90001' ) ";
else $sql_search .= " ) ";

//전달사항 제외 160628 / 알림구분 전체 선택 시 전달사항 제외 160912
if(!$stx_alert_code) $sql_search .= " and alert_code != '80001' ";

//삭제 알림 제외 (로그인 ID 비교) 160120
$sql_search .= " and del_main not like '%$member[mb_id]%' ";

//거래처 정보(사업장명) 있는 알림만 표시
$sql_search .= " and com_name!='' ";

//최고관리자 : 삭제요청만 표시
//if($member['mb_id'] == "master" && !$stx_alert_code) $stx_alert_code = "90001";

//사업장명
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//사업자등록번호
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//대표자
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
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
//접수, 업무 알림 구분
$stx_receive_arry = array("","의뢰서","계약서","건설업체","가족보험","전기요금","위탁서","대리인","전자민원","시간선택제","고용창출","신규고용","이지노무","직무교육");
$stx_work_arry = array("","신청서류","보완서류","우편물발송","검토현황","지원금접수","전달첨부서류","삭제요청");
//접수 체크박스 갯수 160428
$stx_receive_cnt = 13;
//업무 체크박스 갯수
$stx_work_cnt = 7;

//접수, 업무 알림구분 체크 시 where 쿼리 추가
if($stx_receive_1 || $stx_receive_2 || $stx_receive_3 || $stx_receive_4 || $stx_receive_5 || $stx_receive_6 || $stx_receive_7 || $stx_receive_8 || $stx_receive_9 || $stx_receive_10 || $stx_receive_11 || $stx_receive_12 || $stx_receive_13 || $stx_receive_14 || $stx_work_1 || $stx_work_2 || $stx_work_3 || $stx_work_4 || $stx_work_5 || $stx_work_6 || $stx_work_7 ) {
	$search_or = "";
	$sql_search .= " and ( ";
	if($stx_receive_1) {
		$sql_search_add[1] = " alert_code =10002 ";
		$search_or = "or";
	}
	if($stx_receive_2) {
		$sql_search_add[2] = $search_or." alert_code =10003 ";
		$search_or = "or";
	}
	if($stx_receive_3) {
		$sql_search_add[3] = $search_or." alert_code =10004 ";
		$search_or = "or";
	}
	if($stx_receive_4) {
		$sql_search_add[4] = $search_or." alert_code =10005 ";
		$search_or = "or";
	}
	if($stx_receive_5) {
		$sql_search_add[5] = $search_or." alert_code =10006 ";
		$search_or = "or";
	}
	if($stx_receive_6) {
		$sql_search_add[6] = $search_or." alert_code =15000 ";
		$search_or = "or";
	}
	if($stx_receive_7) {
		$sql_search_add[7] = $search_or." alert_code =20001 ";
		$search_or = "or";
	}
	if($stx_receive_8) {
		$sql_search_add[8] = $search_or." alert_code =20002 ";
		$search_or = "or";
	}
	if($stx_receive_9) {
		$sql_search_add[9] = $search_or." alert_code =40002 ";
		$search_or = "or";
	}
	if($stx_receive_10) {
		$sql_search_add[10] = $search_or." alert_code =40003 ";
		$search_or = "or";
	}
	if($stx_receive_11) {
		$sql_search_add[11] = $search_or." alert_code =40004 ";
		$search_or = "or";
	}
	if($stx_receive_12) {
		$sql_search_add[12] = $search_or." alert_code =50001 ";
		$search_or = "or";
	}
	if($stx_receive_13) {
		$sql_search_add[13] = $search_or." alert_code =80003 ";
		$search_or = "or";
	}
	for($i=1;$i<=$stx_receive_cnt;$i++) {
		$sql_search .= $sql_search_add[$i];
	}
	if($stx_work_1) {
		$sql_search_add2[1] = $search_or." alert_code =30001 ";
		$search_or = "or";
	}
	if($stx_work_2) {
		$sql_search_add2[2] = $search_or." alert_code =30002 ";
		$search_or = "or";
	}
	if($stx_work_3) {
		$sql_search_add2[3] = $search_or." alert_code =40001 ";
		$search_or = "or";
	}
	if($stx_work_4) {
		$sql_search_add2[4] = $search_or." alert_code =60001 ";
		$search_or = "or";
	}
	if($stx_work_5) {
		$sql_search_add2[5] = $search_or." alert_code =70001 ";
		$search_or = "or";
	}
	if($stx_work_6) {
		$sql_search_add2[6] = $search_or." alert_code =80002 ";
		$search_or = "or";
	}
	if($stx_work_7) {
		$sql_search_add2[7] = $search_or." alert_code =90001 ";
	}
	for($i=1;$i<=$stx_work_cnt;$i++) {
		$sql_search .= $sql_search_add2[$i];
	}
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
$colspan = 12;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;search_ok=".$search_ok."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday;
//추가검색
$qstr .= "&amp;stx_alert_code=".$stx_alert_code."&amp;stx_charge=".$stx_charge."&amp;stx_read_my=".$stx_read_my."&amp;stx_read_main=".$stx_read_main."&amp;stx_read_branch=".$stx_read_branch;
//알림구분 접수, 업무
for($i=1;$i<=$stx_receive_cnt;$i++) {
	$qstr .= "&amp;stx_receive_".$i."=".$_GET['stx_receive_'.$i];
}
for($i=1;$i<=$stx_work_cnt;$i++) {
	$qstr .= "&amp;stx_work_".$i."=".$_GET['stx_work_'.$i];
}
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
//검색기간
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
									<td width=""><a href="alert_my.php"><img src="images/top_alert_my.gif" border="0" /></a></td>
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
													<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명</td>
													<td nowrap class="tdrow" width="180">
														<input name="stx_comp_name" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="110"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
													<td nowrap class="tdrow" width="140">
														<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkBznb(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
													<td nowrap class="tdrow" width="130">
														<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">알림구분</td>
													<td nowrap class="tdrow" width="140">
														<select name="stx_alert_code" class="selectfm">
															<option value="all">전체</option>
															<option value="10002" <? if($stx_alert_code == '10002') echo "selected"; ?>>의뢰서접수</option>
															<option value="10003" <? if($stx_alert_code == '10003') echo "selected"; ?>>계약서접수</option>
															<option value="10004" <? if($stx_alert_code == '10004') echo "selected"; ?>>건설업체</option>
															<option value="10005" <? if($stx_alert_code == '10005') echo "selected"; ?>>가족보험환급</option>
															<option value="10006" <? if($stx_alert_code == '10006') echo "selected"; ?>>전기요금컨설팅</option>
															<option value="15000" <? if($stx_alert_code == '15000') echo "selected"; ?>>위탁서접수</option>
															<option value="15001" <? if($stx_alert_code == '15001') echo "selected"; ?>>사무위탁</option>
															<option value="20001" <? if($stx_alert_code == '20001') echo "selected"; ?>>대리인선임</option>
															<option value="20002" <? if($stx_alert_code == '20002') echo "selected"; ?>>전자민원</option>
															<option value="30001" <? if($stx_alert_code == '30001') echo "selected"; ?>>신청서류안내</option>
															<option value="30002" <? if($stx_alert_code == '30002') echo "selected"; ?>>보완서류</option>
															<option value="40001" <? if($stx_alert_code == '40001') echo "selected"; ?>>우편물발송</option>
															<option value="40002" <? if($stx_alert_code == '40002') echo "selected"; ?>>시간선택제</option>
															<option value="40003" <? if($stx_alert_code == '40003') echo "selected"; ?>>고용창출</option>
															<option value="40004" <? if($stx_alert_code == '40004') echo "selected"; ?>>신규고용확인</option>
															<option value="50001" <? if($stx_alert_code == '50001') echo "selected"; ?>>이지노무</option>
															<option value="60001" <? if($stx_alert_code == '60001') echo "selected"; ?>>검토현황</option>
															<option value="70001" <? if($stx_alert_code == '70001') echo "selected"; ?>>지사접수</option>
															<option value="80001" <? if($stx_alert_code == '80001') echo "selected"; ?>>전달사항</option>
															<option value="80002" <? if($stx_alert_code == '80002') echo "selected"; ?>>전달첨부서류</option>
															<option value="80003" <? if($stx_alert_code == '80003') echo "selected"; ?>>직무교육</option>
															<option value="90001" <? if($stx_alert_code == '90001') echo "selected"; ?>>삭제요청</option>
														</select>
													</td>
<?
$search_colspan = 3;
if($member['mb_level'] > 6) {
	$search_colspan = 3;
	//echo $stx_man_cust_name;
?>
													<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
													<td nowrap class="tdrow" width="100">
														<select name="stx_man_cust_name" class="selectfm">
															<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
														</select>
													</td>
<?
}
?>
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
<?
if($member['mb_level'] > 6) {
?>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">등록자</td>
													<td nowrap class="tdrow">
														<input name="stx_charge"  type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_charge?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
<?
}
?>
												</tr>
<?
//전달사항일 경우 접수/업무 숨김 160429
if($stx_alert_code != 80001) {
?>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">접수</td>
													<td nowrap class="tdrow" colspan="<?=$search_colspan+6?>">
<?
	//접수 알림
	for($i=1;$i<=$stx_receive_cnt;$i++) {
?>
														<input type="checkbox" name="stx_receive_<?=$i?>" value="1" style="vertical-align:middle;" <? if($_GET['stx_receive_'.$i]) echo "checked"; ?> /><?=$stx_receive_arry[$i]?>
<?
	}
?>
													</td>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업무</td>
													<td nowrap class="tdrow" colspan="<?=$search_colspan+6?>">
<?
	//업무 알림
	for($i=1;$i<=$stx_work_cnt;$i++) {
?>
														<input type="checkbox" name="stx_work_<?=$i?>" value="1" style="vertical-align:middle;" <? if($_GET['stx_work_'.$i]) echo "checked"; ?> /><?=$stx_work_arry[$i]?>
<?
	}
?>
													</td>
												</tr>
<?
}
?>
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
											<input type="hidden" name="this_url" value="alert_client" />
											<input type="hidden" name="page" value="<?=$page?>" />
											<input type="hidden" name="qstr" value="<?=$qstr?>" />
											<input type="hidden" name="stx_my"  value="1" />
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed">
												<tr>
													<td class="tdhead_center" width="26" rowspan=""><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="46" rowspan="">No</td>
													<td class="tdhead_center" width="74" rowspan="">등록일자</td>
													<td class="tdhead_center" width="80" rowspan="">관리점</td>
													<td class="tdhead_center" width="202" rowspan="">거래처명</td>
													<td class="tdhead_center" width="94" rowspan="">사업자등록번호</td>
													<td class="tdhead_center" width="70" rowspan="">대표자</td>
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
			if($send_to_array[$sta] == "kcmc1007") $send_to = "사무위탁";
			else if($send_to_array[$sta] == "kcmc1006") $send_to .= "사업주훈련";
			else if($send_to_array[$sta] == "kcmc1008") $send_to .= "대리인선임";
			else if($send_to_array[$sta] == "manager") $send_to .= "지원금";
			else if($send_to_array[$sta] == "kcmc1009") $send_to .= "이지노무";
			else if($send_to_array[$sta] == "branch") $send_to .= "담당지사";
			else if($send_to_array[$sta] == "kcmc1001") $send_to .= "총괄관리";
			else if($send_to_array[$sta] == "kcmc1003") $send_to .= "전기담당";
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
	//대표님 성함 제외
	if($mb_nick == "최성민") $mb_nick = "";
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
													<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
														<a href="<?=$client_process_view?>" style="<?=$text_bold?>"><?=$com_name?></a>
													</td>
													<td class="ltrow1_center_h22"><?=$biz_no?></td>
													<td class="ltrow1_center_h22"><?=$boss_name?></td>
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
