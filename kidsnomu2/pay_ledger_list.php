<?
$sub_menu = "400200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//현재 년도
$year_now = date("Y");


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
//결정입금 0 제외
$sql_search .= " and money_total!=0 ";
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

$sub_title = "급여대장";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;

$sql = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result,
					sum(health) as sum_health, sum(yoyang) as sum_yoyang, sum(yun) as sum_yun, sum(goyong) as sum_goyong, sum(tax_so) as sum_tax_so, sum(tax_jumin) as sum_tax_jumin, w_date
          $sql_common
          $sql_search group by com_code, year, month
          $sql_order 
          limit $from_record, $rows
";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;
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
//일괄 전송 기능 (원천세 신고)
function pay_send_ok() {
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
		if(confirm("정말 전송하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="pay_ledger_send_batch.php";
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
//세무전송
function pay_send(send_year, send_month, com_code) {
	frm = document.dataForm;
	frm.send_year.value = send_year;
	frm.send_month.value = send_month;
	frm.memo.value = frm['memo_'+send_year+'_'+send_month].value;
	frm.com_code.value = com_code;
	frm.action = "pay_ledger_send.php";
	frm.submit();
}
//급여 복사
function pay_copy(send_year, send_month, com_code) {
	var ret = window.open("./popup/pay_copy.php?id="+com_code+"&send_year="+send_year+"&send_month="+send_month, "pay_copy", "width=640, height=650, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	return;
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
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여년도/월</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<=$year_now;$i++) {
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
							<form name="dataForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<input type="hidden" name="com_code" />
								<input type="hidden" name="search_year" value="<?=$search_year?>" />
								<input type="hidden" name="search_month" value="<?=$search_month?>" />
								<input type="hidden" name="send_year" value="<?=$send_year?>" />
								<input type="hidden" name="send_month" value="<?=$send_month?>" />
								<input type="hidden" name="memo" />
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
									<td nowrap class="tdhead_center" width="54">연도</td>
									<td nowrap class="tdhead_center" width="40">월</td>
									<td nowrap class="tdhead_center" width="">급여대장명</td>
									<td nowrap class="tdhead_center" width="40">엑셀</td>
									<td nowrap class="tdhead_center" width="40">복사</td>
									<td nowrap class="tdhead_center" width="80">등록일</td>
									<td nowrap class="tdhead_center" width="64">등록자수</td>
									<td nowrap class="tdhead_center" width="86">총지급액</td>
									<td nowrap class="tdhead_center" width="80">4대보험</td>
									<td nowrap class="tdhead_center" width="76">소득세등</td>
									<td nowrap class="tdhead_center" width="40">전송</td>
									<td nowrap class="tdhead_center" width="84">전송일자</td>
									<td nowrap class="tdhead_center" width="40">수정</td>
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
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com['com_name'];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row['name'], 6, "..");
	//연도,월
	//$search_year = 2013;
	//$search_month = 11-$i;
	//년월
	$year_month = $row['year']."_".$row['month'];
	//등록일
	$reg_day = $row['w_date'];
	//등록자수
	$pay_count = $row['cnt'];
	//4대보험 합계
	$insure4_sum = (int)$row['sum_health'] + (int)$row['sum_yoyang'] + (int)$row['sum_yun'] + (int)$row['sum_goyong'];
	//소득세등 합계
	$tax_sum = (int)$row['sum_tax_so'] + (int)$row['sum_tax_jumin'];
	//전송일자
	$sql_account = " select wr_datetime, filename_3, filename_4 from tax_account where comp_code='$row[com_code]' and revert_year='$row[year]' and revert_month='$row[month]' ";
	$row_account = sql_fetch($sql_account);
	$wr_datetime = explode(" ",$row_account['wr_datetime']);
	if(!$wr_datetime[0]) $wr_datetime[0] = "-";
	if($row_account['wr_datetime'] == "0000-00-00 00:00:00") $wr_datetime[0] = "-";
	//서식 링크 : 무료회원 권한 없음
	if($member['mb_level'] == 6) {
		$url_form = "javascript:alert_demo();";
		$url_pay_excel = "javascript:alert_demo();";
		$url_pay_copy = "javascript:alert_demo();";
		$url_pay_send = "javascript:alert_demo();";
		$url_pay_ledger = "javascript:alert_demo();";
	} else {
		$url_form = "javascript:printPayList('$row[year]','$row[month]');";
		$url_pay_excel = "pay_ledger_excel.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
		$url_pay_copy = "javascript:pay_copy('$row[year]','$row[month]','$code');";
		$url_pay_send = "javascript:pay_send('$row[year]','$row[month]','$code');";
		$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
	}
	//안양지사 전송 권한 없음 151126
	if($code == "20378") $url_pay_send = "javascript:alert_demo();";
	//사업장코드, 사번코드, 연도, 월 (선택삭제 변수 설정) 160203
	$code_id_year_month = $code."_".$id."_".$row['year']."_".$row['month'];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id_year_month?>" class="no_borer"><input type="hidden" name="codex" value="<?=$year_month?>"></td>
<?
	if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$row['year']?>년</td>
									<td nowrap class="ltrow1_center_h22"><?=$row['month']?>월</td>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_form?>" target=""><b><?=$row['year']?>년 <?=$row['month']?>월 급여대장</b></a></td>
									<td nowrap class="ltrow1_center_h22">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" /></td><td style="background:url('images/btn_bg.gif');" class="ftbutton1" nowrap><a href="<?=$url_pay_excel?>" target="">엑셀</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table>
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" /></td><td style="background:url('images/btn_bg.gif');" class="ftbutton1" nowrap><a href="<?=$url_pay_copy?>" target="">복사</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>명</td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row['sum_result'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($insure4_sum)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($tax_sum)?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" /></td><td style="background:url('images/btn_bg.gif');" class="ftbutton1" nowrap><a href="<?=$url_pay_send?>" target="">전송</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$wr_datetime[0]?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" /></td><td style="background:url('images/btn_bg.gif');" class="ftbutton1" nowrap><a href="<?=$url_pay_ledger?>" target="">수정</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table> 
									</td>
								</tr>
								<tr class="list_row_now_wh">
									<td class="ltrow1_left" colspan="9">
<?
	//처리현황 데이터
	$sql_conduct = " select memo from tax_account where comp_code='$row[com_code]' and revert_year='$row[year]' and revert_month='$row[month]' ";
	$row_conduct = sql_fetch($sql_conduct);
	$is_damdang = "ok"
?>
										<textarea name="memo_<?=$row['year']?>_<?=$row['month']?>" class="textfm" style="width:574px;height:52px;word-break:break-all;vertical-align:middle;"><?=$row_conduct['memo']?></textarea>
									</td>
									<td nowrap class="ltrow1_left" colspan="5">
										<? if($is_damdang == "ok") { ?>
										<input name="filename_3_<?=$row['year']?>_<?=$row['month']?>" type="file" class="textfm_search" style="width:150px;margin:0 0 4px 0;"><? } ?>
										<a href="/kidsnomu/files/account/<?=$row_account['filename_3']?>" target="_blank" title="<?=substr($row_account['filename_3'],16)?>"><?=cut_str(substr($row_account['filename_3'],16), 28, "..")?></a>
										<input type="hidden" name="file_3_<?=$row['year']?>_<?=$row['month']?>" value="<?=$row_account['filename_3']?>">
										<? if(!$row_account['filename_3']) echo "파일첨부가능"; ?>
										<br>
										<? if($is_damdang == "ok") { ?>
										<input name="filename_4_<?=$row['year']?>_<?=$row['month']?>" type="file" class="textfm_search" style="width:150px;margin:0 0 4px 0;"><? } ?>
										<a href="/kidsnomu/files/account/<?=$row_account['filename_4']?>" target="_blank" title="<?=substr($row_account['filename_4'],16)?>"><?=cut_str(substr($row_account['filename_4'],16), 28, "..")?></a>
										<input type="hidden" name="file_4_<?=$row['year']?>_<?=$row['month']?>" value="<?=$row_account['filename_4']?>">
										<? if(!$row_account['filename_4']) echo "파일첨부가능"; ?>
									</td>
								</tr>
<?
}
if($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
} else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'><input type='hidden' name='codex' value=''>";
}
?>
							</table>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_send = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_send = "javascript:pay_send_ok();";
	$url_view = "pay_list.php";
}
//안양지사 전송 권한 없음 151126
if($code == "20378") $url_send = "javascript:alert_demo();";
?>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
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
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_send?>" target="">일괄전송</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
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
</body>
</html>
