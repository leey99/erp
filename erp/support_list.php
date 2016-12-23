<?
$sub_menu = "200100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where a.com_code = b.com_code ";
} else {
	$sql_search = " where a.com_code='$member[mb_id]' ";
}

// 검색 : 관리지사
if ($stx_man_cust_name) {
	if($stx_man_cust_name == "no") $stx_man_cust_name = "";
	$sql_search .= " and ( ";
	if($stx_man_cust_name == "yes") {
		$sql_search .= " (b.man_cust_name != '') ";
	} else {
		$sql_search .= " (b.man_cust_name = '$stx_man_cust_name') ";
	}
	$sql_search .= " ) ";
}
// 검색 : 사무위탁
if($stx_samu_req_yn != "") {
	$sql_search .= " and ( ";
	if($stx_samu_req_yn == "0") {
		$sql_search .= " (b.samu_req_yn != '1') ";
	} else {
		$sql_search .= " (b.samu_req_yn = '1') ";
	}
	$sql_search .= " ) ";
}
//echo $stx_samu_req_yn;
// 검색 : 사업장명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 업체구분
if ($stx_upche_div) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upche_div = '$stx_upche_div') ";
	$sql_search .= " ) ";
}

if (!$sst) {
    $sst = "a.com_code";
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

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "지원금 관리";
$g4[title] = $sub_title." : 신청서관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 16;

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
function del(page,id) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
	var frm = document.searchForm;
	frm.action = "/easynomu/com_list_admin.php";
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
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<div style="border:1px solid #cccccc">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="100"><img src="images/top02.gif" border="0"></td>
										<td width="129"><a href="support_list.php"><img src="images/menu02_top01_on.gif" border="0"></a></td>
										<td width="129"><a href="client_list.php"><img src="images/menu02_top02_off.gif" border="0"></a></td>
										<td width="129"><a href="client_list.php"><img src="images/menu02_top03_off.gif" border="0"></a></td>
									</tr>
								</table>
							</div>
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--타이틀 -->	
<?
if($is_admin == "super") {
	//echo $stx_man_cust_name;
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
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
												<tr>
													<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">관리지사</td>
													<td nowrap class="tdrow">
														<select name="stx_man_cust_name" class="selectfm" onchange="goSearch();">
															<option value="" <? if($stx_man_cust_name == "") echo "selected"; ?>>전체</option>
															<option value="yes" <? if($stx_man_cust_name == "yes") echo "selected"; ?>>분류</option>
															<option value="no" <? if($stx_man_cust_name == "no") echo "selected"; ?>>미분류</option>
<?
for($i=1;$i<count($man_cust_name_arry);$i++) {
	if($stx_man_cust_name == $i) $sel_man_cust_name[$i] = "selected";
?>
															<option value="<?=$i?>" <?=$sel_man_cust_name[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
}
?>
														</select>
													</td>
													<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사무위탁</td>
													<td nowrap class="tdrow">
														<select name="stx_samu_req_yn" class="selectfm" onchange="goSearch();">
															<option value="" <? if($stx_samu_req_yn == "") echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_samu_req_yn == "1") echo "selected"; ?>>신청</option>
															<option value="0" <? if($stx_samu_req_yn == "0") echo "selected"; ?>>미신청</option>
														</select>
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
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
												<tr>
													<td nowrap class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td nowrap class="tdhead_center" width="46" rowspan="2">No</td>
													<td nowrap class="tdhead_center" rowspan="2">사업장명</td>
													<td nowrap class="tdhead_center" width="70" rowspan="2">대표자명</td>
													<td nowrap class="tdhead_center" width="40" rowspan="2">구분</td>
													<td nowrap class="tdhead_center" width="98" rowspan="2">사업자등록번호</td>
													<td nowrap class="tdhead_center" width="94" rowspan="2">업태</td>
													<td nowrap class="tdhead_center" width="94" rowspan="2">업종</td>
													<td nowrap class="tdhead_center" width="94" rowspan="2">전화번호</td>
													<td nowrap class="tdhead_center" width="90" rowspan="2">의뢰서</td>
													<td nowrap class="tdhead_center" colspan="3">수수료</td>
													<td nowrap class="tdhead_center" width="82" rowspan="2">담당자</td>
													<td nowrap class="tdhead_center" width="40" rowspan="2"></td>
													<td nowrap class="tdhead_center" width="36" rowspan="2"></td>
												</tr>
												<tr>
													<td nowrap class="tdhead_center" width="48">지원금</td>
													<td nowrap class="tdhead_center" width="48">부담금</td>
													<td nowrap class="tdhead_center" width="48">건설</td>
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

	$id = $row[com_code];
	$com_name = cut_str($row[com_name], 28, "..");
	if($row[upche_div] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	$com_juso = $row[com_juso]." ".$row[com_juso2];
	$com_juso = cut_str($com_juso, 29, "..");
	//서비스기간
	if($row_opt[service_day_start]) {
		$service_day = $row_opt[service_day_start]."~".$row_opt[service_day_end];
		//echo $id." ".$service_day;
	} else {
		$service_day = "";
	}
	//세팅비
	if($row_opt[setting_pay]) {
		$setting_pay = number_format($row_opt[setting_pay]);
		$setting_sum += $row_opt[setting_pay];
	} else {
		$setting_pay = "";
	}
	//월정액금
	if($row_opt[month_pay]) {
		$month_pay = number_format($row_opt[month_pay]);
		$month_sum += $row_opt[month_pay];
	} else {
		$month_pay = "";
	}	
	//담당지사
	$man_cusr_numb = $row_opt[man_cust_name];
	$man_cusr_array = array("","본사","창원","강릉","평택","대전1","대전2","고양","광주","대구1","대구2","의정부","청주","목포","성남","전주","경산","나주","부산1","부산2");
	$man_cust_name = $man_cusr_array[$man_cusr_numb];
	//담당매니저
	$manage_cust_name = $row_opt[manage_cust_name];
	//월정액결제일
	if($row_opt[settlement_day] == "" || $row_opt[settlement_day] == 0) $settlement_day = "";
	else $settlement_day = $row_opt[settlement_day]."일";
	//결제일 말일
	if($row_opt[settlement_day_last]) $settlement_day = "말일";
	//사무위탁
	if($row_opt[samu_req_yn] == "0" || $row_opt[samu_req_yn] == "") {
		$samu_req = "";
	} else if($row_opt[samu_req_yn] == "1") {
		$samu_req = "신청";
	}
	//의뢰서
	$editdt = $row[editdt];
	//수수료 : 지원금, 부담금, 건설
	$p_support = $row_opt[p_support]."%";
	$p_contribution = $row_opt[p_contribution]."%";
	$p_construction = $row_opt[p_construction]."%";
	if($p_support == "0%") $p_support = "";
	if($p_contribution == "0%") $p_contribution = "";
	if($p_construction == "0%") $p_construction = "";
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
													<td nowrap class="ltrow1_center_h22"><?=$no?></td>
													<td nowrap class="ltrow1_left_h22">
														<a href="com_view_admin.php?id=<?=$id?>&w=u<?=$qstr?>" style="font-weight:bold"><?=$com_name?></a>
													</td>
													<td nowrap class="ltrow1_center_h22"><?=$row[boss_name]?></td>
													<td nowrap class="ltrow1_center_h22"><?=$upche_div?></td>
													<td nowrap class="ltrow1_center_h22"><?=$row[biz_no]?></td>
													<td nowrap class="ltrow1_center_h22"><?=$uptae?></td>
													<td nowrap class="ltrow1_center_h22"><?=$upjong?></td>
													<td nowrap class="ltrow1_center_h22"><?=$row[com_tel]?></td>
													<td nowrap class="ltrow1_center_h22"><?=$editdt?></td>
													<td nowrap class="ltrow1_center_h22"><?=$p_support?></td>
													<td nowrap class="ltrow1_center_h22"><?=$p_contribution?></td>
													<td nowrap class="ltrow1_center_h22"><?=$p_construction?></td>
													<td nowrap class="ltrow1_center_h22"><?=$manage_cust_name?></td>
													<td nowrap class="ltrow1_center_h22"><?=$join_cnt?></td>
													<td nowrap class="ltrow1_center_h22"><?=$join_cnt?></td>
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
if($is_admin == "super" && $member['mb_level'] != 6) {
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
