<?
$sub_menu = "500200";
include_once("./_common.php");

$sql_common = " from pibohum_base_nomu ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 and annual_paid_holiday_day != '' ";
} else {
	$sql_search = " where com_code='$com_code' and annual_paid_holiday_day != '' ";
}

//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "idx";
	}
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

$rows = 11;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "연차관리";
$g4[title] = $sub_title." : 노무관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 13;
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
			frm.action="annual_paid_holiday_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
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
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname05.gif" /></td>
								</tr>
								<tr>
									<td><a href="retirement.php" onmouseover="limg1.src='images/menu05_sub01_on.gif'" onmouseout="limg1.src='images/menu05_sub01_off.gif'"><img src="images/menu05_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="annual_paid_holiday.php" onmouseover="limg2.src='images/menu05_sub02_on.gif'" onmouseout="limg2.src='images/menu05_sub02_off.gif'"><img src="images/menu05_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="bonus.php" onmouseover="limg3.src='images/menu05_sub03_on.gif'" onmouseout="limg3.src='images/menu05_sub03_off.gif'"><img src="images/menu05_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
							</table>
<?
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
									<col width="10%">
									<col width="">
									<col width="10%">
									<col width="">
									<col width="10%">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사번</td>
										<td nowrap class="tdrow">
											<input name="stx_sabun" type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_sabun?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">고용형태</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">전체</option>
												<option value="1" >정규직</option>
												<option value="2" >계약직</option>
												<option value="3" >일용직</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">입사일</td>
										<td nowrap class="tdrow">
											<input name="stx_in_day" type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_in_day?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="chk_all" value="1" class="textfm"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="142">사업장명</th>
<?
}
?>
									<td nowrap class="tdhead_center" width="80">사용일자</td>
									<td nowrap class="tdhead_center" width="40">사번</td>
									<td nowrap class="tdhead_center" width="70">이름</td>
									<td nowrap class="tdhead_center" width="90">직위</td>
									<td nowrap class="tdhead_center" width="70">채용형태</td>
									<td nowrap class="tdhead_center" width="80">입사일</td>
									<td nowrap class="tdhead_center" width="60">총연차</td>
									<td nowrap class="tdhead_center" width="60">사용</td>
									<td nowrap class="tdhead_center" width="60">잔여</td>
									<td nowrap class="tdhead_center" width="">연차사유</td>
									<td nowrap class="tdhead_center" width="80">연차조회</td>
									<td nowrap class="tdhead_center" width="5%">수정</td>
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
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 6, "..");
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
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
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
	//사원DB opt2
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//연차일자
	$annual_day = $row[annual_paid_holiday_day];
	//연차사유
	$annual_reason = $row[annual_paid_holiday_reason];
	//연차 총일수
	$annual_paid_hday = $row_opt2[annual_paid_holiday];
	//연차 사용일수
	$sql_hday = " select count(*) as hday_cnt
          $sql_common
          $sql_search and sabun='$id' ";
	//echo $sql_hday;
	$result_hday = sql_query($sql_hday);
	$row_hday = mysql_fetch_array($result_hday);
	//echo $row_hday[hday_cnt];
	$annual_paid_hday_use = $row_hday[hday_cnt];
	//echo $annual_paid_hday_use." = ".$annual_paid_hday." - ".$row_hday[hday_cnt];
	//연차 사용일수
	$annual_paid_hday_rest = $annual_paid_hday - $row_hday[hday_cnt];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$idx?>" class="no_borer"><input type="hidden" name="codex" value="<?=$code?>"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$annual_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_center_h22"><a href="annual_paid_holiday_view.php?w=u&idx=<?=$idx?>&page=<?=$page?>"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$position?></td>
									<td nowrap class="ltrow1_center_h22"><?=$work_form?></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_use?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_rest?></td> 
									<td nowrap class="ltrow1_center_h22"><?=$annual_reason?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./popup_annual_paid_holiday.php?code=<?=$code?>&id=<?=$id?>" target="" onclick="cal_open(this.href,'popup_annual_paid_holiday',800,400);return false;">연차조회</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="annual_paid_holiday_view.php?w=u&idx=<?=$idx?>&page=<?=$page?>" target="">수정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
								</tr>
								<?
								}
								if ($i == 0)
										echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
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
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
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

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checked_ok();" target="">선택삭제</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="annual_paid_holiday_view.php?page=<?=$page?>" target="">연차등록</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="form_labor.php?labor=annual_paid_holiday&page=<?=$page?>" target="">연차관리대장</a></td>
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
