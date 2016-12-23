<?
include_once("./_common.php");
//타이틀
if($item == "trade") {
	$sub_title = "통상임금수당항목";
	$sub_menu = "100401";
} else if($item == "court") {
	$sub_title = "법정수당항목";
	$sub_menu = "100402";
} else if($item == "company") {
	$sub_title = "주간근로시간";
	$sub_menu = "100301";
} else {
	$sub_title = "기타수당항목";
	$sub_menu = "100403";
}
//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
}

//com_code 출력
$sql_common_com = " from $g4[com_list_gy] ";
$sql_search_com = " where t_insureno='$member[mb_id]' ";
$sql_com = " select *
          $sql_common_com
          $sql_search_com ";
//echo $sql_com;
$result_com = sql_query($sql_com);
$row_com = mysql_fetch_array($result_com);
//echo $row_com[com_code];
$code = $row_com[com_code];

//사업장 추가 정보
$sql_com_opt = " select * from com_list_gy_opt where com_code='$row_com[com_code]' ";
//echo $sql1;
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);

//급여 기초코드 DB
$sql_common = " from com_paycode_list ";

//echo $is_admin;
if(!$item) $item = "trade";
if($item == "privilege") {
	$sql_search_add = " and income != 'Y' ";
} else if($item == "court") {
	$sql_search_add = " and ( code='b1' or code='b2' or code='b3' or code='b7' or code='b8' or code='b9' ) ";
}
$sql_search = " where item='$item' and com_code='$code' $sql_search_add ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

//코드 초기화
//echo $total_count;
if($total_count == 0) {
	$g4[com_paycode_list] = "com_paycode_list";
	$sql_reset = " select * from $g4[com_paycode_list] where com_code = '00001' and item = '$item' ";
	$result_reset = sql_query($sql_reset);
	for($i=0; $row_reset=sql_fetch_array($result_reset); $i++) {
		$sql_common_reset = " com_code = '$com_code',
										code = '$row_reset[code]',
										item = '$row_reset[item]',
										name = '$row_reset[name]',
										auto = '$row_reset[auto]',
										calculate = '$row_reset[calculate]',
										tax_limit = '$row_reset[tax_limit]',
										gy_yn = '$row_reset[gy_yn]',
										retirement = '$row_reset[retirement]',
										multiple = '$row_reset[multiple]',
										income = '$row_reset[income]',
										tax_exemption = '$row_reset[tax_exemption]',
										memo = '$row_reset[memo]'
									";
		$sql_insert = " insert $g4[com_paycode_list] set $sql_common_reset ";
		sql_query($sql_insert);
	}
}

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$g4['title'] = $sub_title." : 코드관리 : 사업장관리 : ".$member['mb_nick'];

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
//echo $sql;
$colspan = 10;

//통상임금수당, 기타수당 시 배율 제거
if($item == "court") {
	$colspan -= 1;
}
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
function com_paycode_reset(item) {
	if(item == "trade") text = "통상임금수당 ";
	else if(item == "court") text = "법정수당 ";
	else if(item == "privilege") text = "기타수당 ";
	else text = "추가 ";
	if(confirm(text+"코드를 초기화 하시겠습니까?\n기존 코드를 삭제가 됩니다.")) {
		location.href = "com_paycode_reset.php?item="+item;
	}
	//return false;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function com_paycode_save() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) idx_value = "Y";
		else idx_value = "N";
		cnt++;
		chk_data = chk_data + ',' + frm.idx[i].value +  "_" + idx_value;
	}
	if(confirm("정말 저장 하시겠습니까?")) {
		chk_data = chk_data.substring(1, chk_data.length);
		frm.chk_data.value = chk_data;
		//alert(chk_data);
		frm.action="com_paycode_save.php";
		frm.submit();
	} else {
		return;
	} 
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu1.php";
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
<?
if($item == "company") {
?>

<?
include "com_paycode_select_work_time.php";
?>
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
<?
	exit;
}
?>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													<? if($item != "privilege") echo "리스트"; else echo "비과세"; ?>
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
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<input type="hidden" name="item" value="<?=$item?>">
<?
if($item == "trade") {
	$pay_name = "수당항목";
	$pay_type = "금액";
} else if($item == "court") {
	$pay_name = "수당항목";
	$pay_type = "금액";
} else {
	$pay_name = "수당항목";
	//$pay_type = "비과세한도";
	$pay_type = "금액";
}
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td class="tdhead_center" width="40" style="height:34px">사용</td>
									<td class="tdhead_center" width="40">코드</td>
									<td class="tdhead_center" width="150"><?=$pay_name?></td>
									<td class="tdhead_center">설명</td>
<?
if($item != "court") {
?>
									<td class="tdhead_center" width="100"><?=$pay_type?></td>
<?
}
?>

<?
//제거 131111
if($item != "_privilege") {
?>
<?
//통상임금수당, 기타수당 시 배율 제거
if($item == "court") {
?>
									<td class="tdhead_center" width="60">배율</td>
<? } ?>
									<td class="tdhead_center" width="60">임금포함<br>여부</td>
									<td class="tdhead_center" width="60">퇴직금<br>계상대상</td>
									<td class="tdhead_center" width="60">과세포함<br>여부</td>
<? } ?>
									<td class="tdhead_center" width="5%">수정</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;

	$code = $row[com_code];
	$id = $row[code];
	$code_id = $code."_".$id;
	$view_url = "com_paycode_view.php?code=".$code."&id=".$id."&w=u&item=".$item."".$qstr;
	$meno = cut_str($row[memo], 46, "..");
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" <? if($row[auto] == "Y") echo "checked"; ?>></td>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_center_h22">
										<a href="<?=$view_url?>" style="font-weight:bold" title="<?=$row[memo]?>"><?=$row[name]?></a>
									</td>
									<td nowrap class="ltrow1_h22" style="padding:0 0 0 10px"><?=$meno?></td>
<?
if($item != "court") {
	//기타수당 한도 설정 : 비과세한도 제거 140627
	if($item == "_privilege") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[tax_limit]?></td>
<?
	} else {
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[calculate]?></td>
<?
	}
}
//제거 131111
if($item != "_privilege") {
//통상임금수당, 기타수당 시 배율 제거
if($item == "court") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[multiple]?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$row[gy_yn]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[retirement]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[income]?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22">
										<div id="btn_bslost_82">
										 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$view_url?>" target="">수정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
										</div>
									</td>
								</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
	//echo "<script language='javascript'>com_paycode_reset('$item');</script>";
}
else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
}
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
<?
if($item != "court") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
<?
//제거 131111
if($item != "_privilege") {
?>
<?
//통상임금수당, 기타수당 시 배율 제거
if($item == "court") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
<?
if($item == "privilege") {
?>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													과세
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td class="tdhead_center" width="40" style="height:34px">사용</td>
									<td class="tdhead_center" width="40">코드</td>
									<td class="tdhead_center" width="150">수당항목</td>
									<td class="tdhead_center">설명</td>
									<td class="tdhead_center" width="100">금액</td>
									<td class="tdhead_center" width="60">임금포함<br>여부</td>
									<td class="tdhead_center" width="60">퇴직금<br>계상대상</td>
									<td class="tdhead_center" width="60">과세포함<br>여부</td>
									<td class="tdhead_center" width="5%">수정</td>
								</tr>
<?
$sql_search_add = " and income = 'Y' ";
$sql_search = " where item='$item' and com_code='$code' $sql_search_add ";
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql);
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;

	$code = $row[com_code];
	$id = $row[code];
	$code_id = $code."_".$id;
	$view_url = "com_paycode_view.php?code=".$code."&id=".$id."&w=u&item=".$item."".$qstr;
	$meno = cut_str($row[memo], 46, "..");
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" <? if($row[auto] == "Y") echo "checked"; ?>></td>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_center_h22">
										<a href="<?=$view_url?>" style="font-weight:bold" title="<?=$row[memo]?>"><?=$row[name]?></a>
									</td>
									<td nowrap class="ltrow1_h22" style="padding:0 0 0 10px"><?=$meno?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[calculate]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[gy_yn]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[retirement]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[income]?></td>
									<td nowrap class="ltrow1_center_h22">
										<div id="btn_bslost_82">
										 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$view_url?>" target="">수정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
										</div>
									</td>
								</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
	//echo "<script language='javascript'>com_paycode_reset('$item');</script>";
}
else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
}
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
								</tr>
							</table>
<? } ?>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_reset = "javascript:alert_demo();";
	$url_save = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "com_paycode_view.php?w=w&item=$item";
	$url_reset = "javascript:com_paycode_reset('$item');";
	$url_save = "javascript:com_paycode_save('$item');";
}
?>
							<div style="height:30px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
<?
if($member['mb_level'] >= 7) {
?>
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
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">코드등록</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
<?
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;padding:0 20px 0 4px">
											<tr>
												<td>※ 사용 수당코드 저장</td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_reset?>" target="">코드초기화</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;padding:0 0 0 4px">
											<tr>
												<td>※ <?=$easynomu_name?>에서 셋팅한 초기셋팅값으로 적용</td>
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
