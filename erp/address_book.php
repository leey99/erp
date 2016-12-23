<?
$sub_menu = "700300";
include_once("./_common.php");

$sql_common = " from a4_manage ";
$sql_search = " where item='manage' ";
//재직상태 재직 강제 설정 161205
if(!$search_state) $search_state = 1;
//재직상태
if($search_state != "all") {
	$sql_search .= " and state='$search_state'  ";
}
//지사 권한
if($member['mb_level'] == 6) $stx_man_cust_name = $member['mb_profile'];
//검색 : 소속
if($stx_man_cust_name) {
	//광주딜러
	if($stx_man_cust_name == "gj_dealer") $sql_search .= " and (belong>=112 and belong<=117) ";
	else $sql_search .= " and belong = '$stx_man_cust_name' ";
}
//검색 : 담당자명
if($search_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '%$search_cust_name%') ";
	$sql_search .= " ) ";
}
//검색 : 직통전화
if($search_cust_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (tel like '%$search_cust_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 팩스
if($search_cust_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (fax like '%$search_cust_fax%') ";
	$sql_search .= " ) ";
}
//검색 : 휴대폰
if($search_cust_hp) {
	$sql_search .= " and ( ";
	$sql_search .= " (hp like '%$search_cust_hp%') ";
	$sql_search .= " ) ";
}
$sql_order = " order by state asc, belong asc, p_code asc ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//범위 : 페이지 20건 / 100건 / 전체
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if(!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
//$row=mysql_fetch_array($result);
$colspan = 11;
$qstr = "kind=".$kind."&amp;search_state=".$search_state."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;search_cust_name=".$search_cust_name."&amp;search_cust_tel=".$search_cust_tel."&amp;search_cust_fax=".$search_cust_fax."&amp;search_cust_hp=".$search_cust_hp;
$qstr .= "&amp;stx_count=".$stx_count;
$sub_title = "주소록";
$g4['title'] = $sub_title." : 그룹웨어 : ".$easynomu_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">

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
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
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
			frm.action="client_delete.php";
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
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top07.gif" border="0" /></td>
					<td width="130"><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top07_03.png" border="0" /></a></td>
					<td>
<?
$title_main_no = "07";
include "inc/sub_menu.php";
?>
					</td>
				</tr>
				<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
			</table>

			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
				<tr>
					<td valign="top" style="padding:10px 0 0 0">
						<!--타이틀 -->	
						<form name="searchForm" method="get">
							<input type="hidden" name="search_ok" />
							<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
							<!--데이터 -->
							<table border="0" cellpadding="0" cellspacing="0">
								<tr> 
									<td id=""> 
										<table border="0" cellpadding="0" cellspacing="0">
											<tr> 
												<td><img src="images/g_tab_on_lt.gif" /></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												검색
												</td> 
												<td><img src="images/g_tab_on_rt.gif" /></td> 
											</tr> 
										</table> 
									</td> 
									<td width="2"></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--검색 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자명</td>
									<td nowrap class="tdrow">
										<input name="search_cust_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$search_cust_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">직통전화</td>
									<td nowrap class="tdrow">
										<input name="search_cust_tel" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$search_cust_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="60"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">팩스</td>
									<td nowrap class="tdrow">
										<input name="search_cust_fax" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$search_cust_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">휴대폰</td>
									<td nowrap class="tdrow">
										<input name="search_cust_hp" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$search_cust_hp?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재직상태</td>
									<td nowrap class="tdrow">
										<select name="search_state" class="selectfm">
											<option value="all"  <? if($search_state == "all")  echo "selected"; ?>>전체</option>
											<option value="1" <? if($search_state == "1") echo "selected"; ?>>재직</option>
											<option value="2" <? if($search_state == "2") echo "selected"; ?>>퇴직</option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">관리점</td>
									<td nowrap class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
								<select name="stx_man_cust_name" class="selectfm" onchange="goSearch()">
									<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
								</select>
<?
} else {
	echo $man_cust_name_arry[$search_belong];
	echo "<input type='hidden' name='search_belong' value='".$search_belong."' />";
}
?>
									</td>
										<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">범위</td>
										<td nowrap class="tdrow">
											<select name="stx_count" class="selectfm" onchange="">
												<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20건</option>
												<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100건</option>
												<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>전체</option>
											</select>
										</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0" /></a>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:10px;font-size:0px"></div>

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
						<!--리스트 -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
								<tr>
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" /></td>
									<td class="tdhead_center" width="46">No</td>
									<td class="tdhead_center" width="70">관리점</td>
									<td class="tdhead_center" width="100">담당자명</td>
									<td class="tdhead_center" width="80">직위</td>
									<td class="tdhead_center" width="96">아이디</td>
									<td class="tdhead_center" width="110">대표/직통전화</td>
									<td class="tdhead_center" width="110">팩스</td>
									<td class="tdhead_center" width="110">휴대폰</td>
									<td class="tdhead_center">이메일/주소</td>
									<td class="tdhead_center" width="70">재직상태</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	//echo $total_count;
  $list = $i%2;
	if($row['state'] == 1) {
		$state = "재직";
	} else {
		$state = "퇴직";
	}
	$code = $row['code'];
	//소속
	$belong_code = $row['belong'];
	$belong_text = $man_cust_name_arry[$belong_code];
	//아이디
	$user_id = $row['user_id'];
	//퇴직자 회색 블럭 표시
	if($row['state'] == 2) {
		$tr_class = "list_row_now_gr";
	} else {
		$tr_class = "list_row_now_wh";
	}
	//주소
	$sql_member = " select * from a4_member where mb_id='$user_id' ";
	$result_member = sql_query($sql_member);
	$row_member = mysql_fetch_array($result_member);
	$address = $row_member['mb_addr1']." ".$row_member['mb_addr2'];
	if($row['state'] == 2) $address = "";
?>
								<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" /></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22"><?=$belong_text?></td>
									<td class="ltrow1_center_h22"><?=$row['name']?></td>
									<td class="ltrow1_center_h22"><?=$row['position']?></td>
									<td class="ltrow1_center_h22"><?=$row['user_id']?></td>
									<td class="ltrow1_center_h22"><div><?=$row['tel_main']?></div><div><?=$row['tel']?></div></td>
									<td class="ltrow1_center_h22"><?=$row['fax']?></td>
									<td class="ltrow1_center_h22"><?=$row['hp']?></td>
									<td class="ltrow1_left_h22"><div><?=$row['email']?></div><div><?=$address?></div></td>
									<td class="ltrow1_center_h22"><?=$state?></td>
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
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
