<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from $g4[com_list_gy] ";

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where t_insureno='$member[mb_id]' ";
}

// 검색 : 통합관리번호
if ($stx_id) {
	$sql_search .= " and ( ";
	$sql_search .= " (t_insureno like '%$stx_id%') ";
	$sql_search .= " ) ";
}
// 검색 : 사업장명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (com_name like '%$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 업체구분
if ($stx_upche_div) {
	$sql_search .= " and ( ";
	$sql_search .= " (upche_div = '$stx_upche_div') ";
	$sql_search .= " ) ";
}

if (!$sst) {
    $sst = "com_code";
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

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "기본정보";
$g4[title] = $sub_title." : 사업장관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 11;

if($is_admin != "super") {
	header("Location:./com_view.php?id=$com_code&w=u");
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
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else{
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="com_delete.php";
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
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname01.gif" /></td>
								</tr>
								<tr>
									<td><a href="com_list.php" onmouseover="limg1.src='images/menu01_sub01_on.gif'" onmouseout="limg1.src='images/menu01_sub01_off.gif'"><img src="images/menu01_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="com_code_list.php?item=position" onmouseover="limg2.src='images/menu01_sub02_on.gif'" onmouseout="limg2.src='images/menu01_sub02_off.gif'"><img src="images/menu01_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="com_code_list.php?item=position" onmouseover="limg2_1.src='images/menu01_sub02_sub01_on.gif'" onmouseout="limg2_1.src='images/menu01_sub02_sub01_off.gif'"><img src="images/menu01_sub02_sub01_off.gif" name="limg2_1" id="limg2_1" /></a></td>
								</tr>
								<tr>
									<td><a href="com_code_list.php?item=step" onmouseover="limg2_2.src='images/menu01_sub02_sub02_on.gif'" onmouseout="limg2_2.src='images/menu01_sub02_sub02_off.gif'"><img src="images/menu01_sub02_sub02_off.gif" name="limg2_2" id="limg2_2" /></a></td>
								</tr>
								<tr>
									<td style="border-top:1px #8e7a5e solid"><a href="com_paycode_list.php?item=company" onmouseover="limg3.src='images/menu01_sub03_on.gif'" onmouseout="limg3.src='images/menu01_sub03_off.gif'"><img src="images/menu01_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
								<tr>
									<td><a href="com_paycode_list.php?item=company" onmouseover="limg3_1.src='images/menu01_sub03_sub01_on.gif'" onmouseout="limg3_1.src='images/menu01_sub03_sub01_off.gif'"><img src="images/menu01_sub03_sub01_off.gif" name="limg3_1" id="limg3_1" /></a></td>
								</tr>
								<tr>
									<td><a href="com_paycode_list.php?item=step" onmouseover="limg3_2.src='images/menu01_sub03_sub02_on.gif'" onmouseout="limg3_2.src='images/menu01_sub03_sub02_off.gif'"><img src="images/menu01_sub03_sub02_off.gif" name="limg3_2" id="limg3_2" /></a></td>
								</tr>
								<tr>
									<td><a href="com_paycode_list.php?item=step" onmouseover="limg3_3.src='images/menu01_sub03_sub03_on.gif'" onmouseout="limg3_3.src='images/menu01_sub03_sub03_off.gif'"><img src="images/menu01_sub03_sub03_off.gif" name="limg3_3" id="limg3_3" /></a></td>
								</tr>
								<tr>
									<td style="border-bottom:1px #8e7a5e solid"><a href="com_paycode_list.php?item=step" onmouseover="limg3_4.src='images/menu01_sub03_sub04_on.gif'" onmouseout="limg3_4.src='images/menu01_sub03_sub04_off.gif'"><img src="images/menu01_sub03_sub04_off.gif" name="limg3_4" id="limg3_4" /></a></td>
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
<?
if($is_admin == "super") {
?>
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
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">통합관리번호</td>
										<td nowrap class="tdrow">
											<input name="stx_id" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">업체구분</td>
										<td nowrap class="tdrow">
											<select name="stx_upche_div" class="selectfm">
												<option value="">전체</option>
												<option value="1" >개인</option>
												<option value="2" >법인</option>
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
<? } ?>
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
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td nowrap class="tdhead_center" width="40">코드</td>
									<td nowrap class="tdhead_center">사업장명</td>
									<td nowrap class="tdhead_center" width="54">대표자명</td>
									<td nowrap class="tdhead_center" width="54">업체구분</td>
									<td nowrap class="tdhead_center" width="98">사업자등록번호</td>
									<td nowrap class="tdhead_center" width="94">사업장전화</td>
									<td nowrap class="tdhead_center" width="52">관리지사</td>
									<td nowrap class="tdhead_center" width="52">매니저</td>
									<td nowrap class="tdhead_center" width="52">재직자</td>
									<td nowrap class="tdhead_center" width="52">퇴직자</td>
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

	$id = $row[com_code];
	$com_name = cut_str($row[com_name], 26, "..");
	if($row[upche_div] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	$com_juso = $row[com_juso]." ".$row[com_juso2];
	$com_juso = cut_str($com_juso, 29, "..");
	//입사자
	$sql1 = " select count(*) as cnt from pibohum_base where com_code='$row[com_code]' and out_day='' ";
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
	$join_cnt = $row1[cnt];
	//퇴사자
	$sql1 = " select count(*) as cnt from pibohum_base where com_code='$row[com_code]' and out_day!='' ";
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
	$quit_cnt = $row1[cnt];
	//담당지사
	$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	$man_cusr_numb = $row_opt[man_cust_name];
	$man_cusr_array = array("","본사","창원","강릉","평택","대전1","대전2","고양","광주","대구1","대구2","의정부","청주","목포","성남","전주","경산","나주","부산1","부산2");
	$man_cust_name = $man_cusr_array[$man_cusr_numb];
	//담당매니저
	$manage_cust_name = $row_opt[manage_cust_name];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_left_h22">
										<a href="com_view.php?id=<?=$id?>&w=u<?=$qstr?>" style="font-weight:bold"><?=$com_name?></a>
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[boss_name]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$upche_div?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[biz_no]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[com_tel]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$man_cust_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$join_cnt?>명</td>
									<td nowrap class="ltrow1_center_h22"><?=$quit_cnt?>명</td>
									<td nowrap class="ltrow1_center_h22">
										<div id="btn_bslost_82">
										 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="com_view.php?id=<?=$id?>&w=u<?=$qstr?>" target="">수정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
										</div>
									</td>
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
if($is_admin == "super") {
?>
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
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="com_view.php" target="">신규등록</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
<? } ?>
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
