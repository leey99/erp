<?
$sub_menu = "400400";
include_once("./_common.php");

//guest id
if($member['mb_id'] == "guest") {
	$member['mb_id'] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//현재 년도
$year_now = date("Y");
//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
//echo date("m");
$sql_common = " from pibohum_base_pay_h ";

//사업장 기본정보
$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];
//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt['comp_print_type'];
} else {
	$comp_print_type = "default";
}

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	//$sql_search = " where com_code='$com_code' and year='$search_year' and pay_gbn='1' ";
	$sql_search = " where com_code='$com_code' and year='$search_year' ";
}
//실지급액이 있는 경우 표시 151208
$sql_search .= " and money_result != 0 ";
//부서별 설정 : 디웍스
if($com_code == "20284") {
	if(!$stx_dept) $stx_dept = 2;
	$sql_search .= " and ( dept_code = '$stx_dept' ) ";
}
// 검색 : 년
if ($search_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (year like '$search_year%') ";
	$sql_search .= " ) ";
}
// 검색 : 월
if ($search_month) {
	$sql_search .= " and ( ";
	$sql_search .= " (month like '$search_month%') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "year";
	}
	$sod = "desc";
}
$sst2 = ", year desc";
$sst3 = ", month desc";
//$sst4 = ", w_date desc";
$sst4 = ", name asc";
$sst5 = ", w_time desc";

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sst4 $sst5 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search group by year, month, sabun
         $sql_order ";

$result = sql_query($sql);
$total_count = mysql_num_rows($result);
//echo $total_count;

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "급여명세서(활동보조인)";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search group by year, month, sabun
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$colspan = 13;

//검색 파라미터 전송
$qstr = "search_year=".$search_year."&search_month=".$search_month."&stx_dept=".$stx_dept;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// 삭제 검사 확인
function del(page,id) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
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

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	//alert(chk_data);
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else {
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="pay_ledger_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>";
	frm.submit();
}
function month_plus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var > <?=$year_now?>) {
		alert("<?=$year_now?>년까지 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01" || month_var == "") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
	} else {
		month_var = ""+(toInt(month_var) - 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var < "2013") {
		alert("2013년부터 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "N") {
	include "./inc/left_menu4_type_n.php";
} else if($comp_print_type == "H") {
	include "./inc/left_menu4_type_h.php";
} else {
	include "./inc/left_menu4.php";
}
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
							<form name="searchForm" method="get">
								<input type="hidden" name="page" value="<?=$page?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
<?
//디윅스
if($com_code == "20284") {
?>
									<col width="10%">
									<col width="20%">
<?
}
?>
									<col width="10%">
									<col width="22%">
									<col width="">
									<tr>
<?
//디윅스
if($com_code == "20284") {
?>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">부서</td>
										<td class="tdrow">
											<select name="stx_dept" class="selectfm">
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$com_code' order by code ";
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept[code]?>" <? if($stx_dept == $row_dept[code]) echo "selected"; ?> ><?=$row_dept[name]?></option>
												<?
												}
												?>
											</select>
										</td>
<?
}
?>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여년도/월</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="goSearch();">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
			<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td  nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
							</form>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												전체 출력
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

							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="60">연도</td>
									<td nowrap class="tdhead_center" width="40">월</td>
									<td nowrap class="tdhead_center" width="90">등록일</td>
									<td nowrap class="tdhead_center" width="70">등록자수</td>
									<td nowrap class="tdhead_center" width="90">보건복지</td>
									<td nowrap class="tdhead_center" width="90">경기도</td>
									<td nowrap class="tdhead_center" width="90">화성시</td>
									<td nowrap class="tdhead_center" width="90">총임금계</td>
									<td nowrap class="tdhead_center" width="90">총공제계</td>
									<td nowrap class="tdhead_center" width="">총지급액</td>
									<td nowrap class="tdhead_center" width="76">급여명세서</td>
								</tr>
<?
// 리스트 출력
$sst2 = "year desc";
$sst3 = ", month desc";
$sql_order = " order by $sst2 $sst3 ";
$sql_month = " select count(*) as cnt
				 $sql_common
				 $sql_search
				 $sql_order ";

//echo $sql;
$row_month = sql_fetch($sql_month);
$total_count_month = $row_month[cnt];

$rows_month = 15;
$total_page_month  = ceil($total_count_month / $rows_month);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows_month; // 시작 열을 구함
//전체 출력 SQL
$sql_month = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, 
					sum(money_result) as sum_result, w_date, w_time, 
					sum(w_1) as sum_w_1, sum(w_1_hday) as sum_w_1_hday, sum(w_2) as sum_w_2, sum(w_2_hday) as sum_w_2_hday, sum(w_3) as sum_w_3, sum(w_3_hday) as sum_w_3_hday,
					sum(money_month) as sum_money_month
					$sql_common
					$sql_search group by year, month
					$sql_order 
					limit $from_record, $rows ";
//echo $sql_month;
$result_month = sql_query($sql_month);
$colspan_month = 11;
//type h 보건복지, 경기도, 화성시(평근,휴심), 교육시간, 스마트폰
$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);
$money_time1 = $row_opt2['money_time1'];
$money_time1_hday = $row_opt2['money_time1_hday'];
$money_time2 = $row_opt2['money_time2'];
$money_time2_hday = $row_opt2['money_time2_hday'];
$money_time3 = $row_opt2['money_time3'];
$money_time3_hday = $row_opt2['money_time3_hday'];
$money_time1_com = $row_opt2['money_time1_com'];
$money_time1_hday_com = $row_opt2['money_time1_hday_com'];
$money_time2_com = $row_opt2['money_time2_com'];
$money_time2_hday_com = $row_opt2['money_time2_hday_com'];
$money_time3_com = $row_opt2['money_time3_com'];
$money_time3_hday_com = $row_opt2['money_time3_hday_com'];
$money_time_edu = $row_opt2['money_time_edu'];
$money_time_phone = $row_opt2['money_time_phone'];
for ($i=0; $row_month=sql_fetch_array($result_month); $i++) {
	//$page
	//$total_page
	//$rows
	$year = $row_month['year'];
	$month = $row_month['month'];
	if($year != $old_year || $month != $old_month || $i == 0) {
		$no = $total_count_month - $i - ($row_months*($page-1));
		$list = $i%2;
		//사업장 코드 / 사번 / 코드_사번
		$code = $row_month[com_code];
		$id = $row_month[sabun];
		$code_id = $code."_".$id;
		// 사업장명 : 사업장코드
		$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row_month[com_code]' ";
		$row_month_com = sql_fetch($sql_com);
		$com_name = $row_month_com[com_name];
		$com_name = cut_str($com_name, 21, "..");
		$name = cut_str($row_month[name], 6, "..");
		//연도,월
		//$search_year = 2013;
		//$search_month = 11-$i;
		//년월
		$year_month = $row_month[year]."_".$row_month[month];
		//등록일
		$reg_day = $row_month[w_date];
		//등록시
		$reg_time= $row_month[w_time];
		//등록자수
		$pay_count = $row_month[cnt];
		//보건복지 : 평근 + 휴심
		$sum_w1_total += $row_month['sum_w_1'] * $money_time1;
		$sum_w1_total += $row_month['sum_w_1_hday'] * $money_time1_hday;
		//경기도 : 평근 + 휴심
		$sum_w2_total += $row_month['sum_w_2'] * $money_time2;
		$sum_w2_total += $row_month['sum_w_2_hday'] * $money_time2_hday;
		//화성시 : 평근 + 휴심
		$sum_w3_total += $row_month['sum_w_3'] * $money_time3;
		$sum_w3_total += $row_month['sum_w_3_hday'] * $money_time3_hday;
		//서식 링크
		if($member['mb_profile'] == "guest") {
			$url_form = "javascript:alert_demo();";
			$url_pay_ledger = "javascript:alert_demo();";
		} else {
			//$url_form = "pay_stubs_beistand_all.php?code=$code&$qstr&search_year=$search_year&search_month=$search_month";
			$url_form = "pay_stubs_beistand_all_excel.php?code=$code&search_year=$search_year&search_month=$search_month";
			$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row_month['year']."&search_month=".$row_month['month'];
		}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$row_month[year]?>년</td>
									<td nowrap class="ltrow1_center_h22"><?=$row_month[month]?>월</td>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>명</td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_w1_total)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_w2_total)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_w3_total)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_total])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_gongje])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_result])?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">전체 출력</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
									</td>
								</tr>
								</tr>
<?
	}
	$old_year = $row_month['year'];
	$old_month = $row_month['month'];
}
if($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan_month' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
} else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'><input type='hidden' name='codex' value=''>";
}
?>
							</table>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												개별 출력
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
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:1px 5px 1px 5px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:13px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center" width="60">연도</td>
									<td nowrap class="tdhead_center" width="40">월</td>
									<td nowrap class="tdhead_center" width="40">사번</td>
									<td nowrap class="tdhead_center" width="70">이름</td>
									<td nowrap class="tdhead_center" width="64">생년월일</td>
									<td nowrap class="tdhead_center" width="86">보건복지</td>
									<td nowrap class="tdhead_center" width="86">경기도</td>
									<td nowrap class="tdhead_center" width="86">화성시</td>
									<td nowrap class="tdhead_center" width="86">임금계</td>
									<td nowrap class="tdhead_center" width="84">공제계</td>
									<td nowrap class="tdhead_center" width="">실지급액</td>
									<td nowrap class="tdhead_center" width="80">급여명세서</td>
								</tr>
<?
$result = sql_query($sql);
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
	$list = $i%2;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row[name], 6, "..");

	//사원정보 추가 DB
	$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);

	//생년월일
	$staff_ssnb = substr($row['ssnb'], 0, 6);

	//사원정보 급여 DB
	$sql_pay = " select * from pibohum_base_pay_h where com_code='$row[com_code]' and sabun='$row[sabun]' and year='$row[year]' and month='$row[month]' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay = mysql_fetch_array($result_pay);

	//보건복지 : 평근 + 휴심
	$w1_total = $row_pay['w_1'] * $money_time1;
	$w1_total += $row_pay['w_1_hday'] * $money_time1_hday;
	//경기도 : 평근 + 휴심
	$w2_total = $row_pay['w_2'] * $money_time2;
	$w2_total += $row_pay['w_2_hday'] * $money_time2_hday;
	//화성시 : 평근 + 휴심
	$w3_total = $row_pay['w_3'] * $money_time3;
	$w3_total += $row_pay['w_3_hday'] * $money_time3_hday;

	//서식 링크
	if($member['mb_profile'] == "guest") {
		$url_form = "javascript:alert_demo();";
	} else {
		$url_form = "pay_stubs_beistand.php?id=$row[sabun]&code=$row[com_code]&search_year=$row[year]&search_month=$row[month]&page=$page";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[year]?>년</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[month]?>월</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[sabun]?></td>
									<td nowrap class="ltrow1_center_h22"><a href="pay_view.php?id=<?=$row[sabun]?>&code=<?=$row[com_code]?>&page=<?=$page?>"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$staff_ssnb?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($w1_total)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($w2_total)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($w3_total)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay['money_for_tax'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay['money_gongje'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay['money_result'])?></td>
									<td nowrap class="ltrow1_center_h22"><span class="btn00"><a href="<?=$url_form?>">급여명세서</a></span></td>
								</tr>
<?
}
if ($i == 0)
		echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
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
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
?>
							</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
