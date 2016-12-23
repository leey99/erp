<?
$sub_menu = "700200";
include_once("./_common.php");

//현재 연도
$year_now = date("Y");
//현재 월
$month_now = date("m");

$sql_common = " from a4_manage ";
$sql_search = " where item='manage' ";
//연도
if(!$stx_year) $stx_year = $year_now;
//월
if(!$stx_month) $stx_month = $month_now;
//검색 : 담당자명
if($search_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '%$search_cust_name%') ";
	$sql_search .= " ) ";
}
//재직상태
if(!$search_state) $search_state = 1;
if($search_state) {
	//전체일 경우 160801
	if($search_state != "all" ) $sql_search .= " and state='$search_state'  ";
}
//지사 권한
if($member['mb_level'] == 6) $stx_man_cust_name = $member['mb_profile'];
//본사 직원만 표시 1600304
else if(!$stx_man_cust_name) $stx_man_cust_name = 1;
//부서
if($search_dept) $sql_search .= " and dept_code = '$search_dept' ";
//소속
if($stx_man_cust_name) {
	if($stx_man_cust_name != "all") {
		//제휴점 : 102 김민찬 ~ 123 삼호전력
		if($stx_man_cust_name == "dl") $sql_search .= " and belong >= 102 ";
		else $sql_search .= " and belong = '$stx_man_cust_name' ";
	}
}
//구분 : 지사장(대표)만 출력 161124
if($stx_head_branch) $sql_search .= " and p_code = '$stx_head_branch' ";
//정렬, 재직상태, 소속, 부서 160304, 직위
$sql_order = " order by state asc, belong asc, dept_code asc, p_code asc ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//범위 : 페이지 20건 / 100건 / 전체
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if(!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
//$row=mysql_fetch_array($result);
$colspan = 38;
$qstr = "kind=".$kind."&amp;search_state=".$search_state."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;search_cust_name=".$search_cust_name."&amp;search_dept=".$search_dept."&amp;stx_year=".$stx_year."&amp;stx_month=".$stx_month;
$qstr .= "&amp;stx_count=".$stx_count."&amp;stx_head_branch=".$stx_head_branch;
$sub_title = "출근부";
$g4['title'] = $sub_title." : 그룹웨어 : ".$easynomu_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
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
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top07.gif" border="0" /></td>
					<td width="130"><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top07_02.png" border="0" /></a></td>
					<td>
<?
$title_main_no = "07";
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
						<form name="searchForm" method="get">
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
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">연도</td>
									<td nowrap class="tdrow">
										<select name="stx_year" class="selectfm">
<?
//2016년부터 ~ 현재 연도까지
for($year=2016;$year<=$year_now;$year++) {
?>
											<option value="<?=$year?>" <? if($stx_year == $year) echo "selected"; ?>><?=$year?></option>
<?
}
?>
										</select>
									</td>
									<td nowrap class="tdrowk" width="30"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">월</td>
									<td nowrap class="tdrow">
										<select name="stx_month" class="selectfm">
<?
//1월부터 ~ 12월까지
for($month=1;$month<=12;$month++) {
	if($month < 10) $month = "0".$month;
?>
											<option value="<?=$month?>" <? if($stx_month == $month) echo "selected"; ?>><?=$month?></option>
<?
}
?>
										</select>
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자명</td>
									<td nowrap class="tdrow">
										<input name="search_cust_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$search_cust_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상태</td>
									<td nowrap class="tdrow">
										<select name="search_state" class="selectfm">
											<option value="all">전체</option>
											<option value="1" <? if($search_state == "1") echo "selected"; ?>>재직</option>
											<option value="2" <? if($search_state == "2") echo "selected"; ?>>퇴직</option>
										</select>
									</td>
<?
//본사 권한
if($member['mb_level'] > 6) {
?>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">부서</td>
									<td nowrap class="tdrow">
										<select name="search_dept" class="selectfm">
											<option value="">전체</option>
<?
	//부서 : 관리부, 기업지원과, TM부 총 3개 160304
	for($i=1;$i<=3;$i++) {
?>
											<option value="<?=$i?>" <? if($search_dept == $i) echo "selected"; ?>><?=$dept_code_arry[$i]?></option>
<?
	}
?>
										</select>
									</td>
<?
}
?>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">소속</td>
									<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
										<select name="stx_man_cust_name" class="selectfm" onchange="goSearch()">
											<option value="all" <? if($stx_man_cust_name == "all") echo "selected"; ?>>전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
										</select>
<?
} else {
	echo $man_cust_name_arry[$search_belong];
	echo "<input type='hidden' name='search_belong' value='".$search_belong."' />";
}
?>
									</td>
<?
if($member['mb_level'] != 6) {
?>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">구분</td>
									<td nowrap class="tdrow">
										<select name="stx_head_branch" class="selectfm" onchange="goSearch()">
											<option value="" <? if($stx_head_branch == "") echo "selected"; ?>>전체</option>
											<option value="1" <? if($stx_head_branch == "1") echo "selected"; ?>>대표</option>
										</select>
									</td>
<?
}
?>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">범위</td>
									<td nowrap class="tdrow">
										<select name="stx_count" class="selectfm" onchange="">
											<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20건</option>
											<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100건</option>
											<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>전체</option>
										</select>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0" /></a>
										<a href="groupware_attendance_excel.php?<?=$qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0"></a>
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
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80px;text-align:center'> 
											<?//=$sub_title?>
<?
echo $stx_year."년 ".$stx_month."월";
?>
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
<?
//해당 월 말일 160307
$stx_month_last_day = date("t", mktime(0, 0, 0, $stx_month, 1, $stx_year));
?>
						<!--리스트 -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
								<tr>
									<td class="tdhead_center" rowspan="2" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" /></td>
									<td class="tdhead_center" rowspan="2" width="46">No</td>
									<td class="tdhead_center" rowspan="2" width="90">부서</td>
									<td class="tdhead_center" rowspan="2" width="90">담당자명</td>
									<td class="tdhead_center" rowspan="2" width="70">직위</td>
									<td class="tdhead_center" rowspan="2" width="90">아이디</td>
									<td class="tdhead_center" colspan="<?=$stx_month_last_day?>"><?=$stx_year?>년 <?=$stx_month?>월 근태현황</td>
									<td class="tdhead_center" rowspan="2" width="50">상태</td>
									<td class="tdhead_center" rowspan="2" width="">비고</td>
								</tr>
								<tr>
<?
//해당 월 일자 표시 160304
for($m=1;$m<=$stx_month_last_day;$m++) {
	//휴일 회색 처리
	if($m < 10) $m = "0".$m;
	$this_date = $stx_year."-".$stx_month."-".$m;
	//법정 공휴일, 삼일절
	if($this_date == "2016-03-01") $hday_color[$m] = "background:#f1f1f1;";
	//2016년 20대 국회의원 선거(총선) 임시정부수립일
	if($this_date == "2016-04-13") $hday_color[$m] = "background:#f1f1f1;";
	//어린이날
	if($this_date == "2016-05-05") $hday_color[$m] = "background:#f1f1f1;";
	//임시공휴일
	if($this_date == "2016-05-06") $hday_color[$m] = "background:#f1f1f1;";
	//현충일
	if($this_date == "2016-06-06") $hday_color[$m] = "background:#f1f1f1;";
	//광복절
	if($this_date == "2016-08-15") $hday_color[$m] = "background:#f1f1f1;";
	//개천절
	if($this_date == "2016-10-03") $hday_color[$m] = "background:#f1f1f1;";
	//해당 일 요일 추출
	$yoil_chk = date("w", strtotime($this_date));
	if($yoil_chk == 6 || $yoil_chk == 0) {
		if($yoil_chk == 6) {
			$yoil_style = "background:#E6F2FF;"; //토요일
		} else if($yoil_chk == 0) {
			$yoil_style = "background:#FFEEFF;"; //일요일
		}
		//해당 일 토/일 색상 표시 160307
		$hday_color[$m] = $yoil_style;
	} else {
		//$hday_color[$m] = "";
		$yoil_style = "";
	}
?>
									<td class="tdhead_center" style="<?=$yoil_style?>" width="20"><?=$m?></td>
<?
}
?>
								</tr>
<?
//요일 체크
$week_array = array("일", "월", "화", "수", "목", "금", "토");
// 리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	//echo $total_count;
  $list = $i%2;
	if($row['state'] == 1) {
		$state = "재직";
	} else {
		$state = "퇴직";
	}
	$code = $row['code'];
	//부서
	$dept_code = $row['dept_code'];
	$dept_text = $dept_code_arry[$dept_code];
	//아이디
	$user_id = $row['user_id'];
	//퇴직자 회색 블럭 표시
	if($row['state'] == 2) {
		$tr_class = "list_row_now_gr";
	} else {
		$tr_class = "list_row_now_wh";
	}
	//근태현황
	$sql_attendance = " select * from work_go_leave where user_id='$user_id' and date_format(check_time,'%Y-%m')='$stx_year-$stx_month' ";
	//echo $sql_attendance."<br />";
	$result_attendance = sql_query($sql_attendance);
	for($att=0; $row_attendance=sql_fetch_array($result_attendance); $att++) {
		//$att_user_id[$att] = $row_attendance['user_id'];
		$att_type = $row_attendance['type'];
		$att_memo = $row_attendance['memo'];
		$att_check_time[$user_id][$att] = $row_attendance['check_time'];
		$att_check_day = substr($att_check_time[$user_id][$att], 8, 2);
		//$att_check_time[$user_id][$att_check_day] = $att_check_time[$user_id][$att];
		if($att_type == 1) $att_check_in[$user_id][$att_check_day] = $att_check_time[$user_id][$att];
		if($att_type == 2) $att_check_out[$user_id][$att_check_day] = $att_check_time[$user_id][$att];
		//연차, 표시 160308
		if($att_type >= 3) {
			$att_check_type[$user_id][$att_check_day] = $att_type;
			$att_check_memo[$user_id][$att_check_day] = $att_memo;
		}
		//echo $att_type." ";
		//모바일 로그인 여부
		$att_mobile[$user_id][$att_check_day] = $row_attendance['mobile'];
	}
?>
								<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" /></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22"><?=$dept_text?></td>
									<td class="ltrow1_center_h22"><?=$row['name']?></td>
									<td class="ltrow1_center_h22"><?=$row['position']?></td>
									<td class="ltrow1_center_h22"><?=$row['user_id']?></td>
<?
	for($m=1;$m<=$stx_month_last_day;$m++) {
		if($m < 10) $m = "0".$m;
		$att_day[$m] = "";
		$att_in[$m] = "";
		$att_out[$m] = "";
		$att_title[$m] = "";
		$att_phone[$m] = "";
		//echo count($att_check_time)." ";
		/*
		for($att=0;$att<count($att_check_time[$user_id]);$att++) {
			//echo $att_check_time[$att];
			//$att_check_time_day = substr($att_check_time[$user_id][$att], 8, 2);
			//echo $user_id.".".$att.".".$att_check_day[$user_id][$att]." ";
			if($att_check_day[$user_id][$att] = $m) $att_day[$m] = "O";
		}
		*/
		if($att_check_out[$user_id][$m]) $att_out[$m] = substr($att_check_out[$user_id][$m], 11, 8);
		if($att_check_in[$user_id][$m]) {
			$att_day[$m] = "O";
			$att_in[$m] = substr($att_check_in[$user_id][$m], 11, 8);
			//모바일 로그인 여부 160411
			if($att_mobile[$user_id][$m]) $att_phone[$m] = "(모바일)";
			$att_title[$m] = "출근 ".$att_in[$m]."".$att_phone[$m]."&#13퇴근 ".$att_out[$m];
		}
		//if($att_check_time[$att] = )
		//연차, 결근, 출장, 교육(160601) 표시
		if($att_check_type[$user_id][$m] >= 3) {
			//연차
			if($att_check_type[$user_id][$m] == 3) $att_day[$m] = "<img src='images/year_leave.png' border='0' />";
			else if($att_check_type[$user_id][$m] == 4) $att_day[$m] = "<img src='images/icon_absence.png' border='0' />";
			else if($att_check_type[$user_id][$m] == 5) $att_day[$m] = "<img src='images/icon_appear.png' border='0' />";
			else if($att_check_type[$user_id][$m] == 6) $att_day[$m] = "<img src='images/icon_educate.png' border='0' />";
			//메모
			$att_title[$m] = $att_check_memo[$user_id][$m];
		}
?>
									<td class="ltrow1_center_h22" title="<?=$att_title[$m]?>" style="<?=$hday_color[$m]?>"><?=$att_day[$m]?></td>
<?
	}
?>
									<td class="ltrow1_center_h22"><?=$state?></td>
									<td class="ltrow1_center_h22"><?=$memo?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
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
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
