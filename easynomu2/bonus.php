<?
$sub_menu = "500300";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//년도 설정
//if(!$stx_bonus_year) $stx_bonus_year = date("Y", strtotime("-1 year"));
if(!$stx_bonus_year) $stx_bonus_year = date("Y");

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b, pibohum_base_opt2 c ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun and a.com_code = c.com_code and a.sabun = c.sabun) ";
$sql_search .= " ) ";

//상여금 설정된 사원만 표시
$sql_search .= " and c.bonus_percent > 0 ";

// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
// 검색 : 상여금 설정 여부
if ($stx_bonus_percent == "0") {
	$sql_search .= " and ( ";
	$sql_search .= " (c.bonus_percent = '$stx_bonus_percent') ";
	$sql_search .= " ) ";
} else if ($stx_bonus_percent == "1") {
	$sql_search .= " and ( ";
	$sql_search .= " (c.bonus_percent > '$stx_bonus_percent') ";
	$sql_search .= " ) ";
}
//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//정렬 2순위
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//정렬 3순위
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "상여금관리";
$g4[title] = $sub_title." : 노무관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 12;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
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
	var chk_data_code ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
			chk_data_code = chk_data_code + ',' + frm.codex[i].value;
		}
	}
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else{
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			chk_data_code = chk_data_code.substring(1, chk_data_code.length);
			frm.chk_data_code.value = chk_data_code;
			frm.action="bonus_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
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
function goBonus_standard(id, obj) {
	var f = document.dataForm;
	var bonus_percent_input = f['bonus_percent_'+id];
	if(!bonus_percent_input.value) {
		alert("상여금비율이 입력 되지 않았습니다.");
		selectObj = obj;
		//alert(selectObj.options.length);
		for(i=0; i<selectObj.options.length;i++) {
			if( selectObj.options[i].value == "") {
				selectObj.options[i].selected = "selected";
				break;
			}
		}
		bonus_percent_input.focus();
		return;
	}
	bonus_standard = obj.value;
	bonus_percent = bonus_percent_input.value;
	bonus_iframe.location.href = "bonus_standard_update.php?id="+id+"&bonus_standard="+bonus_standard+"&bonus_percent="+bonus_percent;
}
function goBonus_use(m, obj) {
	var f = document.dataForm;
	//alert(obj.name);
	var id = obj.name.substring(11,15);
	//alert(id);
	//alert(f['bonus_p0_'+id].value);
	//alert(f['bonus_p'+m+'_'+id].value);
	if(!obj.checked) {
		f['bonus_b'+m+'_'+id].value = f['bonus_p'+m+'_'+id].value;
		f['bonus_p'+m+'_'+id].value = "";
	} else {
		if(f['bonus_b'+m+'_'+id].value) f['bonus_p'+m+'_'+id].value = f['bonus_b'+m+'_'+id].value;
	}
	var bonus_no = m;
	var bonus_p = f['bonus_p'+m+'_'+id].value;
	var bonus_year = f['stx_bonus_year'].value;
	bonus_iframe.location.href = "bonus_list_update.php?id="+id+"&bonus_no="+bonus_no+"&bonus_p="+bonus_p+"&bonus_year="+bonus_year;
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu5.php";
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!--데이터 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
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
<?
//지급시기
$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
$bonus_time = explode(",",$row_a4_opt[bonus_time]);	
$bonus_time_cnt = 0;
for($i=0;$i<6;$i++) {
	if($bonus_time[$i] == "") {
		$bonus_time[$i] = "-";
	} else {
		$bonus_time_cnt++;
	}
}
?>
							<form name="searchForm" method="get">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지급연도</td>
										<td nowrap class="tdrow">
											<select name="stx_bonus_year" class="selectfm" onchange="goSearch();">
<?
for($i=2013;$i<=2016;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $stx_bonus_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지급시기</td>
										<td nowrap class="tdrow">
											<select name="stx_bonus_time" class="selectfm" onchange="goSearch();">
												<option value="">전체</option>
<?
for($i=0;$i<$bonus_time_cnt;$i++) {
	$k = $i + 1;
?>
												<option value="<?=$k?>" <? if($stx_bonus_time == $k) echo "selected"; ?> ><?=$bonus_time[$i]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">상여금설정</td>
										<td nowrap class="tdrow">
											<select name="stx_bonus_percent" class="selectfm">
												<option value="">전체</option>
												<option value="1" <? if($stx_bonus_percent == "1") echo "selected"; ?> >설정완료</option>
												<option value="0" <? if($stx_bonus_percent == "0") echo "selected"; ?> >미설정</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">채용형태</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">전체</option>
												<option value="1" <? if($stx_work_form == 1) echo "selected"; ?> >정규직</option>
												<option value="2" <? if($stx_work_form == 2) echo "selected"; ?> >계약직</option>
												<option value="3" <? if($stx_work_form == 3) echo "selected"; ?> >일용직</option>
											</select>
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
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

							<!--리스트 -->
							<style>
							.btn00 {display:inline-block;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;}
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:4px 7px 4px 7px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:18px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="chk_data_code">
							<input type="hidden" name="stx_bonus_year" value="<?=$stx_bonus_year?>">
							<input type="hidden" name="page" value="<?=$page?>">
<?
//지급시기 검색시 표시 시작
if($stx_bonus_time) {
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="40">번호</td>
									<td nowrap class="tdhead_center" width="">이름</td>
									<td nowrap class="tdhead_center" width="60">직위</td>
									<td nowrap class="tdhead_center" width="70">채용형태</td>
									<td nowrap class="tdhead_center" width="70">입사일</td>
									<td nowrap class="tdhead_center" width="80">상여금기준</td>
									<td nowrap class="tdhead_center" width="80">기준액</td>
									<td nowrap class="tdhead_center" width="80">총상여비율</td>
									<td nowrap class="tdhead_center" width="70">지급시기</td>
									<td nowrap class="tdhead_center" width="70">상여비율</td>
									<td nowrap class="tdhead_center" width="80">지급일자</td>
									<td nowrap class="tdhead_center" width="80">지급액</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$list = $i%2;
	//idx
	$idx = $row[idx];
	//사업장 코드 / 사번 / 코드_사번
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	//사원DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 8, "..");
	//입사일, 퇴직일
	$in_day = $row_base[in_day];
	$out_day = $row_base[out_day];
	//사원DB 옵션
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//직위
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//채용형태
	if($row_base[work_form] == 1) $work_form = "정규직";
	else if($row_base[work_form] == 2) $work_form = "계약직";
	else if($row_base[work_form] == 3) $work_form = "일용직";
	else $work_form = "";
	//상여금기준 (산정기준, 상여비율)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//산정기준
	if($row_opt2[bonus_standard] == "1") {
		$bonus_standard = "기본급";
		$bonus_standard_pay = $row_opt2[money_hour_ms];
	} else if($row_opt2[bonus_standard] == "2") {
		$bonus_standard = "결정임금";
		$bonus_standard_pay = $row_opt2[money_month_base];
	} else if($row_opt2[bonus_standard] == "3") {
		$bonus_standard = "통상임금";
		$bonus_standard_pay = $row_opt2[money_month_base];
	} else if($row_opt2[bonus_standard] == "4") {
		$bonus_standard = "총급여";
		$bonus_standard_pay = $row_opt2[money_month_base];
	} else {
		$bonus_standard = "";
		$bonus_standard_pay = "";
	}
	$bonus_percent = $row_opt2[bonus_percent];
	if($bonus_percent != "0") {
		$bonus_percent = $bonus_percent."%";
		//상여금 수정 링크
		$bonus_url = "bonus_view.php?w=u&id=".$id."&page=".$page."&stx_bonus_time=".$stx_bonus_time;
	} else {
		$bonus_percent = "";
		//상여금 수정 링크
		$bonus_url = "javascript:alert('상여금 기본 설정이 되어 있지 않습니다.\\n먼저 사원관리에서 상여금 설정 바랍니다.');";
	}
	$bonus_p_array = explode(",",$row_opt2[bonus_p]);
	//지급일자, 지급액, 메모
	for($m=0;$m<6;$m++) {
		$k = $m + 1;
		$sql_bonus = " select * from pibohum_base_bonus where com_code='$code' and sabun='$id' and bonus_year='$stx_bonus_year' and bonus_time='$k' ";
		$result_bonus = sql_query($sql_bonus);
		$row_bonus = mysql_fetch_array($result_bonus);
		$bonus_day[$m] = $row_bonus[bonus_day];
		if($bonus_day[$m]) $bonus_pay[$m] = $row_bonus[pay];
		else $bonus_pay[$m] = "";
		$memo = $row_bonus[memo];
		//지급시기별 상여비율
		if($bonus_p_array[$m]) $bonus_p[$m] = $bonus_p_array[$m]."%";
		else $bonus_p[$m] = "";
	}
	//지급시기 구분 코드
	$m = $stx_bonus_time - 1;
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$bonus_url?>"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$position?></td>
									<td nowrap class="ltrow1_center_h22"><?=$work_form?></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?><br><span style="color:red;"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_center_h22"><?=$bonus_standard?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($bonus_standard_pay)?></td>
									<td nowrap class="ltrow1_center_h22"><?=$bonus_percent?></td>
									<td nowrap class="ltrow1_center_h22"><?=$bonus_time[$m]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$bonus_p[$m]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$bonus_day[$m]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$bonus_pay[$m]?></td>
								</tr>
								</tr>
								<?
								}
								if ($i == 0)
										echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
								?>
								<tr>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
<?
} else {
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="142">사업장명</th>
<?
}
?>
									<td nowrap class="tdhead_center" width="40">번호</td>
									<td nowrap class="tdhead_center" width="">이름</td>
									<td nowrap class="tdhead_center" width="60">직위</td>
									<td nowrap class="tdhead_center" width="70">채용형태</td>
									<td nowrap class="tdhead_center" width="70">입사일</td>
									<td nowrap class="tdhead_center" width="80">상여금기준</td>
									<td nowrap class="tdhead_center" width="80"><?=$bonus_time[0]?></td>
									<td nowrap class="tdhead_center" width="80"><?=$bonus_time[1]?></td>
									<td nowrap class="tdhead_center" width="80"><?=$bonus_time[2]?></td>
									<td nowrap class="tdhead_center" width="80"><?=$bonus_time[3]?></td>
									<td nowrap class="tdhead_center" width="80"><?=$bonus_time[4]?></td>
									<td nowrap class="tdhead_center" width="80"><?=$bonus_time[5]?></td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	$list = $i%2;
	//idx
	$idx = $row[idx];
	//사업장 코드 / 사번 / 코드_사번
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	//사원DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	//echo $sql_base;
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 8, "..");
	//입사일, 퇴직일
	$in_day = $row_base[in_day];
	$out_day = $row_base[out_day];
	//사원DB 옵션
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//직위
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//채용형태
	if($row_base[work_form] == 1) $work_form = "정규직";
	else if($row_base[work_form] == 2) $work_form = "계약직";
	else if($row_base[work_form] == 3) $work_form = "일용직";
	else $work_form = "";
	//상여금기준 (산정기준, 상여비율)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//$bonus_code = $row_opt2[bonus_standard];
	if($row_opt2[bonus_standard] == "1") $bonus_standard = "기본급";
	else if($row_opt2[bonus_standard] == "2") $bonus_standard = "결정임금";
	else if($row_opt2[bonus_standard] == "3") $bonus_standard = "통상임금";
	else if($row_opt2[bonus_standard] == "4") $bonus_standard = "총급여";
	//상여금 수동입력
	$check_bonus_money_yn = $row_opt2[check_bonus_money_yn];
	$bonus_money = $row_opt2[bonus_money];
	if($check_bonus_money_yn == "Y") {
		$bonus_standard = "회사내규";
		$bonus_standard_pay = $bonus_money;
	}
	$bonus_percent = $row_opt2[bonus_percent];
	if($bonus_percent != "0") {
		$bonus_standard_percent = $bonus_standard."<br>".$bonus_percent."%";
		//상여금 수정 링크
		$bonus_url = "bonus_view.php?w=u&id=".$id."&page=".$page."&stx_bonus_year=".$stx_bonus_year."&stx_bonus_time=".$stx_bonus_time;
	} else {
		$bonus_standard_percent = "-";
		//상여금 수정 링크
		$bonus_url = "javascript:alert('상여금 기본 설정이 되어 있지 않습니다.\\n먼저 사원관리에서 상여금 설정 바랍니다.');";
	}
	$bonus_p_array = explode(",",$row_opt2[bonus_p]);
	//지급일자, 지급액, 메모
	for($m=0;$m<6;$m++) {
		$k = $m + 1;
		$sql_bonus = " select * from pibohum_base_bonus where com_code='$code' and sabun='$id' and bonus_year='$stx_bonus_year' and bonus_time='$k' ";
		//echo $sql_bonus;
		$result_bonus = sql_query($sql_bonus);
		$row_bonus = mysql_fetch_array($result_bonus);
		$bonus_percent_array[$m] = $row_bonus[bonus_percent];
		$bonus_day[$m] = $row_bonus[bonus_day];
		if($bonus_day[$m]) $bonus_pay[$m] = $row_bonus[pay];
		else $bonus_pay[$m] = "";
		$memo = $row_bonus[memo];
		//지급시기별 상여비율
		if($bonus_percent_array[$m]) {
			$bonus_p[$m] = $bonus_percent_array[$m];
		} else {
			if($bonus_p_array[$m]) $bonus_p[$m] = $bonus_p_array[$m];
			else $bonus_p[$m] = "";
		}
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h55"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h55"><?=$no?></td>
									<td nowrap class="ltrow1_center_h55"><a href="<?=$bonus_url?>"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h55"><?=$position?></td>
									<td nowrap class="ltrow1_center_h55"><?=$work_form?></td>
									<td nowrap class="ltrow1_center_h55"><?=$in_day?><br><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_center_h55">
										<input name="bonus_percent_<?=$id?>" type="text" class="textfm" style="width:46px;ime-mode:disabled;" value="<?=$bonus_percent?>" maxlength="3" onkeyup=""> %<br>
<?
$sel_bonus_standard = array();
$bonus_standard_id = $row['bonus_standard'];
$sel_bonus_standard[$bonus_standard_id] = "selected";
?>
										<select name="bonus_standard_<?=$id?>" class="selectfm" onchange="goBonus_standard('<?=$id?>',this);">
											<option value="">미설정</option>
											<option value="1" <?=$sel_bonus_standard['1']?>>기본급</option>
											<option value="2" <?=$sel_bonus_standard['2']?>>결정임금</option>
											<option value="3" <?=$sel_bonus_standard['3']?>>통상임금</option>
											<option value="4" <?=$sel_bonus_standard['4']?>>총급여</option>
										</select>
									</td>
<?
for($j=0;$j<6;$j++) {
	if($bonus_p[$j]) $chk_bonus_use[$j] = "checked";
	else $chk_bonus_use[$j] = "";
?>
									<td nowrap class="ltrow1_center_h55">
										<input name="bonus_p<?=$j?>_<?=$id?>" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$bonus_p[$j]?>" maxlength="3" onkeyup="">
										%<input type="checkbox" name="bonus_use<?=$j?>_<?=$id?>" value="1" class="textfm" <?=$chk_bonus_use[$j]?> onclick="goBonus_use(<?=$j?>,this)" title="적용" /><br>
										<?=$bonus_day[$j]?><br><b><?=$bonus_pay[$j]?></b>
										<input name="bonus_b<?=$j?>_<?=$id?>" type="hidden" value="<?=$bonus_p[$j]?>">
									</td>
<? } ?>
								</tr>
								</tr>
								<?
								}
								if ($i == 0)
										echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
								?>
								<tr>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
<?
}
//지급시기 검색시 표시 종료
?>
							<input type="checkbox" name="idx" value="" style="display:none">
							<input type="hidden" name="codex" value="">

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
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
	$url_form_time = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "bonus_view.php?page=".$page;
	$url_form = "form_inspect.php?labor=bonus_pay_ledger&search_year=".$stx_bonus_year;
	$url_form_time = "bonus_pay_ledger.php?search_year=".$stx_bonus_year;
	//$url_form_time = "javascript:alert('준비중입니다.');";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_form?>" target=""><img src="images/btn_bonus01_big.png" border="0"></a>
										<a href="<?=$url_form_time?>" target=""><img src="images/btn_bonus02_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<iframe name="bonus_iframe" src="bonus_list_update.php" style="width:0;height:0" frameborder="0"></iframe>
</body>
</html>
