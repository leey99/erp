<?
$mode = "main";
include_once("./_common.php");

$sql_common = " from shipbuilding_gy a, shipbuilding_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code = b.com_code and a.delete_yn != '1' ";
if($member['mb_id'] == "user") {
	$sql_search .= " and a.view_restrict != '1' ";
}

// 검색 : 사업장명칭
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// 검색 : 출근여부
if ($stx_attend) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.attend = '$stx_attend') ";
	$sql_search .= " ) ";
}
// 검색 : 출근일자
if ($stx_attend_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.attend_date = '$stx_attend_date') ";
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

$top_sub_title = "images/top14_01.gif";
$sub_title = "조선인력관리";
$g4[title] = $sub_title." : 조선인력 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_attend=".$stx_attend;
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
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goSearch() {
	var frm = document.searchForm;
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
	//alert("데이터 삭제는 관리자에게 문의하십시오.");
	//return;
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
			frm.action="shipbuilding_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./shipbuilding_memo.php?id="+id, "window_memo", "scrollbars=yes,width=520,height=240");
	return;
}
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
function goCheck_ok(obj) {
	//alert(obj.name+" "+obj.value);
	var id = obj.name.substring(9,14);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "shipbuilding_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top14.gif" border="0"></td>
									<td width="130"><img src="<?=$top_sub_title?>" border="0"></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
							</table>
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
															<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
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
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이름</td>
													<td nowrap class="tdrow">
														<input name="stx_comp_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호</td>
													<td nowrap class="tdrow">
														<input name="stx_comp_tel"  type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">출근여부</td>
													<td nowrap class="tdrow">
														<select name="stx_attend" class="selectfm" onchange="goSearch();">
															<option value=""  <? if($stx_attend == "")  echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_attend == "1") echo "selected"; ?>>출근</option>
															<option value="2" <? if($stx_attend == "2") echo "selected"; ?>>미출근</option>
															<option value="3" <? if($stx_attend == "3") echo "selected"; ?>>보류</option>
														</select>
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">출근일자</td>
													<td nowrap class="tdrow">
														<input name="stx_attend_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_attend_date?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
														<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_attend_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>
													</td>
													<td align="center" class="tdrow_center">
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
															<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
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
													<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="40">No</td>
													<td class="tdhead_center" width="70">등록일자</td>
													<td class="tdhead_center" width="70">이름</td>
													<td class="tdhead_center" width="45">나이</td>
													<td class="tdhead_center" width="100">전화번호/지역</td>
													<td class="tdhead_center" width="70">재통화</td>
													<td class="tdhead_center">내용</td>
													<td class="tdhead_center" width="94">확인체크</td>
													<td class="tdhead_center" width="94">최초통화자</td>
													<td class="tdhead_center" width="104">건강검진/이동수단</td>
													<td class="tdhead_center" width="70">출발/도착</td>
													<td class="tdhead_center" width="70">출근여부</td>
													<td class="tdhead_center" width="70">출근일자</td>
												</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//사업장 옵션 DB
	$sql_opt = " select * from shipbuilding_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;

	$id = $row[com_code];
	$com_name_full = $row[com_name];
	$com_name = cut_str($com_name_full, 28, "..");
	if($row[upche_div] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	$memo_full = $row[memo];
	$memo = cut_str($memo_full, 48, "..");
	//담당매니저
	$manage_cust_name = $row_opt[manage_cust_name];
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
	//위임장
	if($row_opt[proxy] == "1") {
		$proxy = "○";
	} else {
		$proxy = "";
	}
	//출근여부
	$attend_id = $row['attend'];
	if($attend_id == 1) $attend = "출근";
	else if($attend_id == 2) $attend = "미출근";
	else if($attend_id == 3) $attend = "보류";
	else $attend = "-";
	//데이터 없을 경우 - 표시 / 지역 / 재통화 / 최초통화자 / 직통전화 / 건강검진 / 이동수단 / 출발일시 / 도착일시 / 출근일자
	if(!$row[area]) $row[area] = "-";
	if(!$row[teldt]) $row[teldt] = "-";
	if(!$row[writer]) {
		$writer = "-";
	}
	else {
		if($row[writer] == 1) $writer = $writer_arry[1];
		else if($row[writer] == 2) $writer = $writer_arry[2];
		else if($row[writer] == 3) $writer = $writer_arry[3];
		else if($row[writer] == 4) $writer = $writer_arry[4];
	}
	if(!$row[writer_tel]) $row[writer_tel] = "-";
	if(!$row[check_health]) $row[check_health] = "-";
	if(!$row[vehicle]) $row[vehicle] = "-";
	if(!$row[start_date]) $row[start_date] = "-";
	if(!$row[arrival]) $row[arrival] = "-";
	if(!$row[attend_date]) $row[attend_date] = "-";
	//덧글
	$sql_comment = " select count(*) as cnt from shipbuilding_comment where com_code='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment[cnt];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//덧글 최신글 new 표시
	$sql_comment_new = " select * from shipbuilding_comment where com_code='$id' and delete_yn!='1' order by regdt desc limit 0,1 ";
	//echo $sql_comment_new;
	$row_comment_new = sql_fetch($sql_comment_new);
	//echo date("Y-m-d H:i:s", time() - 12 * 3600);
	//echo $row_comment_new[regdt];
	if($row_comment_new[regdt] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	$comment_cnt = $comment_count.$comment_new;
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_center_h22"><?=$row[regdt]?></td>
													<td class="ltrow1_center_h22" title="<?=$com_name_full?>">
														<a href="shipbuilding_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
													</td>
													<td class="ltrow1_center_h22"><?=$row[age]?></td>
													<td class="ltrow1_center_h22"><?=$row[com_tel]?><br><?=$row[area]?></td>
													<td class="ltrow1_center_h22"><?=$row[teldt]?></td>
													<td class="ltrow1_left_h22" title="<?=$memo_full?>">
														<a href="javascript:open_memo('<?=$id?>')"><?=$memo?></a><?=$comment_cnt?>
													</td>
													<td class="ltrow1_center_h22">
<?
$sel_check_ok = array();
$check_ok_id = $row['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
														<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
															<option value="">미확인</option>
															<option value="1" <?=$sel_check_ok['1']?>>긴급통화</option>
															<option value="2" <?=$sel_check_ok['2']?>>2시간이내</option>
															<option value="3" <?=$sel_check_ok['3']?>>금일통화</option>
														</select>
													</td>
													<td class="ltrow1_center_h22"><?=$writer?><br><?=$row[writer_tel]?></td>
													<td class="ltrow1_center_h22"><?=$row[check_health]?><br><?=$row[vehicle]?></td>
													<td class="ltrow1_center_h22"><?=$row[start_date]?><br><?=$row[arrival]?></td>
													<td class="ltrow1_center_h22"><?=$attend?></td>
													<td class="ltrow1_center_h22"><?=$row[attend_date]?></td>
												</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
												<tr>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
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
													<td align="center">
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
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="shipbuilding_view.php" target="">신규등록</a></td>
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
<iframe name="check_ok_iframe" src="check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
