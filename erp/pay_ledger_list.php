<?
$sub_menu = "600400";
include_once("./_common.php");

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;

$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
//if(!$search_month) $search_month = date("m");

//echo $stx_name;
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

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sort";
	}
	$sod = "desc";
}
$sst2 = ", year desc";
$sst3 = ", month desc";

$sql_order = " order by $sst $sod $sst2 $sst3 ";

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

$sql = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, w_date
          $sql_common
          $sql_search group by year, month
          $sql_order 
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$colspan = 13;

$sub_title = "급여대장";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;
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
// 삭제 검사 확인
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
	if(year_var == "2015") {
		alert("20141년까지 조회가 가능합니다.");
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
	if(year_var == "2012") {
		alert("2013년부터 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top06.gif" border="0"></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top01_on.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top02_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top03_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top04_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top05_off.gif" border="0"></a></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="7"></td></tr>
							</table>

							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
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
										<form name="searchForm" method="post">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
												<col width="10%">
												<col width="">
												<col width="">
												<tr>
													<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여년도/월</td>
													<td nowrap class="tdrow">
														<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<2015;$i++) {
?>
															<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
														</select> 년
														<select name="search_month" class="selectfm" onChange="goSearch();">
															<option value="" >전체</option>
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
										<input type="hidden" name="page" value="<?=$page?>">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
											<tr>
												<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
<?
if($is_admin == "super") {
?>
												<td nowrap class="tdhead_center" width="142">사업장명</th>
<?
}
?>
												<td nowrap class="tdhead_center" width="60">연도</td>
												<td nowrap class="tdhead_center" width="40">월</td>
												<td nowrap class="tdhead_center" width="">급여대장명</td>
												<td nowrap class="tdhead_center" width="90">등록일</td>
												<td nowrap class="tdhead_center" width="70">등록자수</td>
												<td nowrap class="tdhead_center" width="90">총임금계</td>
												<td nowrap class="tdhead_center" width="90">총공제계</td>
												<td nowrap class="tdhead_center" width="90">총지급액</td>
												<td nowrap class="tdhead_center" width="80">급여대장</td>
												<td nowrap class="tdhead_center" width="44">엑셀</td>
												<td nowrap class="tdhead_center" width="44">수정</td>
											</tr>
											<?
											// 리스트 출력
											for ($i=0; $row=sql_fetch_array($result); $i++) {
												//$page
												//$total_page
												//$rows
												$no = $total_count - $i - ($rows*($page-1));
												$list = $i%2;
												//사업장 코드 / 사번 / 코드_사번
												$code = $row[com_code];
												$id = $row[sabun];
												$code_id = $code."_".$id;
												// 사업장명 : 사업장코드
												$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
												$row_com = sql_fetch($sql_com);
												$com_name = $row_com[com_name];
												$com_name = cut_str($com_name, 21, "..");
												$name = cut_str($row[name], 6, "..");
												//연도,월
												//$search_year = 2013;
												//$search_month = 11-$i;
												//년월
												$year_month = $row[year]."_".$row[month];
												//등록일
												$reg_day = $row[w_date];
												//등록자수
												$pay_count = $row[cnt];
												//서식 링크
												if($member['mb_profile'] == "guest") {
													$url_form = "javascript:alert_demo();";
													$url_pay_ledger = "javascript:alert_demo();";
													$url_pay_ledger_excel = "javascript:alert_demo();";
												} else {
													$url_form = "javascript:printPayList('$row[year]','$row[month]');";
													$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row[year]."&search_month=".$row[month];
													$url_pay_ledger_excel = "pay_ledger_excel.php?code=".$code."&search_year=".$row[year]."&search_month=".$row[month];
												}
											?>
											<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
												<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
												<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
												<td nowrap class="ltrow1_center_h22"><?=$row[year]?>년</td>
												<td nowrap class="ltrow1_center_h22"><?=$row[month]?>월</td>
												<td nowrap class="ltrow1_center_h22"><a href="<?=$url_form?>" target=""><b><?=$row[year]?>년 <?=$row[month]?>월 급여대장</b></a></td>
												<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
												<td nowrap class="ltrow1_center_h22"><?=$pay_count?>명</td>
												<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_total])?></td>
												<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_gongje])?></td>
												<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_result])?></td>
												<td nowrap class="ltrow1_center_h22">
													<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">급여대장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
												</td>
												<td nowrap class="ltrow1_center_h22">
													<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_pay_ledger_excel?>" target="">엑셀</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
												</td>
												<td nowrap class="ltrow1_center_h22">
													<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_pay_ledger?>" target="">수정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
												</td>
											</tr>
											</tr>
											<?
											}
											if($i == 0) {
												echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
											} else if($i == 1) {
												echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
											}
											?>
											<tr>
												<td nowrap class="tdhead_center"></td>
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

										<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
											<tr>
												<td align="left">
													<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
														<tr>
															<td width=2></td>
															<td><img src=images/btn_lt.gif></td>
															<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">선택삭제</a></td>
															<td><img src=images/btn_rt.gif></td>
														 <td width=2></td>
														</tr>
													</table>
													<!--<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
														<tr>
															<td width=2></td>
															<td><img src=images/btn_lt.gif></td>
															<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">급여반영</a></td>
															<td><img src=images/btn_rt.gif></td>
														 <td width=2></td>
														</tr>
													</table>-->
												</td>
											</tr>
										</table>
										<input type="hidden" name="idx">
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
