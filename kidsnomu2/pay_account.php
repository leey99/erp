<?
$sub_menu = "400400";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from tax_account_opt ";

$sql_a4 = " select com_code from com_list_gy where t_insureno = '$member[mb_id]' ";
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
//정렬
if (!$sst) {
	$sst = "com_code";
	$sod = "desc";
}
$sst2 = ", year desc";
$sst3 = ", month desc";

$sql_order = " order by $sst $sod $sst2 $sst3 ";

$sql = " select count(distinct year, month) as cnt
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

$sub_title = "세무관리";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;
$sql = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, 
					sum(health) as sum_health, sum(yoyang) as sum_yoyang, sum(yun) as sum_yun, sum(goyong) as sum_goyong, sum(tax_so) as sum_tax_so, sum(tax_jumin) as sum_tax_jumin, w_date, wr_datetime
          $sql_common
          $sql_search group by com_code, year, month
          $sql_order 
          limit $from_record, $rows
";
//echo $sql;
$result = sql_query($sql);

$colspan = 9;
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
// 삭제 검사 확인
function del(page,id) 
{
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
			chk_data = chk_data + ',' + frm.idx[i].value + '_' + frm.codex[i].value;
		}
	}
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
function printPayList(search_year, search_month, com_code) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.code.value = com_code;
	frm.target = "_blank";
	frm.action = "pay_ledger.php";
	frm.submit();
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
include "./inc/left_menu4.php";
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
							<form name="searchForm" method="post">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">귀속년도/월</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<=2016;$i++) {
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
										</td>
										<td  nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<form name="printForm" method="get" style="margin:0">
								<input type="hidden" name="mode" />
								<input type="hidden" name="code" />
								<input type="hidden" name="search_year" value="<?=$search_year?>" />
								<input type="hidden" name="search_month" value="<?=$search_month?>" />
							</form>

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
									<td nowrap class="tdhead_center" width="124">전송일시</td>
									<td nowrap class="tdhead_center" width="70">귀속연월</td>
									<td nowrap class="tdhead_center" width="60">인원</td>
									<td nowrap class="tdhead_center" width="90">처리일자</td>
									<td nowrap class="tdhead_center" width="90">첨부파일1</td>
									<td nowrap class="tdhead_center" width="90">첨부파일2</td>
									<td nowrap class="tdhead_center" width="">처리내용</td>
									<td nowrap class="tdhead_center" width="80">처리현황</td>
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
	$code = $row['com_code'];
	$id = $row['sabun'];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$code' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com['com_name'];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row['name'], 6, "..");
	//연도,월
	//$search_year = 2013;
	//$search_month = 11-$i;
	//년월
	$year_month = $row['year']."_".$row['month'];
	//사업장DB 옵션
	$sql1 = " select * from com_list_gy_opt where com_code='$code' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
	//귀속연월
	$revert_year_month = $row['year']."-".$row['month'];
	//등록일
	$reg_day = $row['w_date'];
	//제출일자
	$wr_datetime = $row['wr_datetime'];
	//등록자수
	$pay_count = $row['cnt'];
	//서식 링크
	if($member['mb_level'] == 6) {
		$url_form = "javascript:alert_demo();";
		$url_pay_send = "javascript:alert_demo();";
		$url_pay_ledger = "javascript:alert_demo();";
	} else {
		$url_form = "javascript:printPayList('$row[year]','$row[month]','$row[com_code]');";
		$url_pay_send = "pay_account_write.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
		$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
	}
	//원천세신고 DB
	$sql_account = " select * from tax_account where comp_code='$code' and revert_year='$row[year]' and revert_month='$row[month]' ";
	//echo $sql_account;
	$row_account = sql_fetch($sql_account);
	//발송일자
	if($row_account['send_date']) $send_date = $row_account['send_date'];
	else $send_date = "-";
	//첨부파일
	$filename_1 = $row_account['filename_1'];
	$filename_2 = $row_account['filename_2'];
	//처리내용
	$memo_master = $row_account['memo_master'];
	//처리현황
	$conduct_code = $row_account['conduct'];
	$conduct_array = array("접수완료","처리중","처리완료","대기중","반려");
	$conduct = $conduct_array[$conduct_code];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"><input type="hidden" name="codex" value="<?=$year_month?>"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$wr_datetime?></td>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_form?>" target=""><b><?=$revert_year_month?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>명</td>
									<td nowrap class="ltrow1_center_h22"><?=$send_date?></td>
									<td nowrap class="ltrow1_center_h22"><? if($filename_1) { ?><a href="/kidsnomu/files/account/<?=$filename_1?>" target="_blank"><img src="images/btn_s_file.png" border="0" /></a><? } ?></td>
									<td nowrap class="ltrow1_center_h22"><? if($filename_2) { ?><a href="/kidsnomu/files/account/<?=$filename_2?>" target="_blank"><img src="images/btn_s_file.png" border="0" /></a><? } ?></td>
									<td class="ltrow1_left_h22"><?=$memo_master?></td>
									<td nowrap class="ltrow1_center_h22"><?=$conduct?></td>
								</tr>
<?
}
if($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
} else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'><input type='hidden' name='codex' value=''>";
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
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
//최고관리자 표시
if($member['mb_level'] == 10) {
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
									</td>
								</tr>
							</table>
<?
}
?>
							</form>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												연말정산
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
									<td nowrap class="tdhead_center" width="124">전송일시</td>
									<td nowrap class="tdhead_center" width="70">접수방법</td>
									<td nowrap class="tdhead_center" width="90">접수일자</td>
									<td nowrap class="tdhead_center" width="90">신고일자</td>
									<td nowrap class="tdhead_center" width="90">첨부파일1</td>
									<td nowrap class="tdhead_center" width="90">첨부파일2</td>
									<td nowrap class="tdhead_center" width="">처리내용</td>
									<td nowrap class="tdhead_center" width="80">처리현황</td>
								</tr>
<?
//연말정산
$sql_tax_adjust = " select * from tax_adjust where comp_bznb='$member[mb_id]' and result_file_2 != '' ";
$row_tax_adjust = sql_fetch($sql_tax_adjust);
$wr_datetime = $row_tax_adjust['wr_datetime'];
//접수방법
if($row_tax_adjust['receive_way']) {
	$receive_way_arry = array("","키즈노무","우편접수","팩스","기타");
	$receive_way_code = $row_tax_adjust['receive_way'];
	$receive_way = $receive_way_arry[$receive_way_code];
} else {
	$receive_way = "";
}
//발송일자
if($row_tax_adjust['send_date']) $send_date = $row_tax_adjust['send_date'];
else $send_date = "";
//신고일자
if($row_tax_adjust['report_date']) $report_date = $row_tax_adjust['report_date'];
else $report_date = "";
$filename_2 = $row_tax_adjust['result_file_2'];
//처리현황
if($row_tax_adjust[conduct] == "0") $ok = "접수완료";
else if($row_tax_adjust[conduct] == "1") $ok = "처리중";
else if($row_tax_adjust[conduct] == "2") $ok = "처리완료";
else if($row_tax_adjust[conduct] == "3") $ok = "<span style='color:red'>대기중</span>";
else if($row_tax_adjust[conduct] == "4") $ok = "<span style='color:red'>반려</span>";
else if($row_tax_adjust[conduct] == "5") $ok = "<span style='color:blue'>직접입력</span>";
else $ok = "";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$wr_datetime?></td>
									<td nowrap class="ltrow1_center_h22"><?=$receive_way?></td>
									<td nowrap class="ltrow1_center_h22"><?=$send_date?></td>
									<td nowrap class="ltrow1_center_h22"><?=$report_date?></td>
									<td nowrap class="ltrow1_center_h22"></td>
									<td nowrap class="ltrow1_center_h22"><? if($filename_2) { ?><a href="/kidsnomu/files/adjustment_result/<?=$filename_2?>" target="_blank"><img src="images/btn_s_file.png" border="0" /></a><? } ?></td>
									<td class="ltrow1_left_h22"><?=$row_tax_adjust['memo_master']?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok?></td>
								</tr>
							</table>

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
