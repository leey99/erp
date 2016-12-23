<?
$sub_menu = "500200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b, pibohum_base_opt2 c ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " ( a.com_code = b.com_code and a.sabun = b.sabun and a.com_code = c.com_code and a.sabun = c.sabun ) ";
$sql_search .= " ) ";

// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		$sst = "a.sabun";
		$sod = "asc";
	}
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

if($page == "all") $rows = 90;
else $rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "연차관리";
$g4[title] = $sub_title." : 노무관리 : ".$member['mb_nick'];

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
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
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function goYearHoliday() {
	var frm = document.searchForm;
	if(confirm("기존의 적용된 연차가 초기화됩니다.\n정말 적용하시겠습니까?")) {
		frm.action = "annual_paid_holiday_apply.php";
		frm.submit();
	}
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
<?
include "./inc/left_menu5.php";
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
									<col width="6%">
									<col width="12%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<col width="9%">
									<col width="8%">
									<col width="11%">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">적용여부</td>
										<td nowrap class="tdrow">
											<select name="stx_year_holiday_yn" class="selectfm">
												<option value="">전체</option>
												<option value="1" >적용</option>
												<option value="2" >미적용</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">고용형태</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">전체</option>
												<option value="1" >정규직</option>
												<option value="2" >계약직</option>
												<option value="3" >일용직</option>
												<option value="4" >사업소득</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">입사일</td>
										<td nowrap class="tdrow">
											<input name="stx_in_day" type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_in_day?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goYearHoliday();" target="" title="입사일 기준">연차일괄적용</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
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
									<td nowrap class="tdhead_center" width="40">사번</td>
									<td nowrap class="tdhead_center" width="70">이름</td>
									<td nowrap class="tdhead_center" width="90">직위</td>
									<td nowrap class="tdhead_center" width="70">재직상태</td>
									<td nowrap class="tdhead_center" width="80">입사일</td>
									<td nowrap class="tdhead_center" width="60">총연차</td>
									<td nowrap class="tdhead_center" width="60">사용</td>
									<td nowrap class="tdhead_center" width="60">잔여</td>
									<td nowrap class="tdhead_center" width="80">최근사용일</td>
									<td nowrap class="tdhead_center" width="">연차사유</td>
									<td nowrap class="tdhead_center" width="5%">사용</td>
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
	$com_name = $row_com['com_name'];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row['name'], 6, "..");
	//입사일, 퇴직일
	$in_day = $row['in_day'];
	$out_day = $row['out_day'];
	//직위
	if($row['position']) {
		$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code=$row[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position['name'];
	} else {
		$position = "-";
	}
	//재직상태
	if($row[gubun] == "0") $emp_stat = "재직";
	else if($row[gubun] == "1") $emp_stat = "휴직";
	else if($row[gubun] == "2") $emp_stat = "<span style='color:red'>퇴직</span>";
	//채용형태
	if($row[work_form] == 1) $work_form = "정규직";
	else if($row[work_form] == 2) $work_form = "계약직";
	else if($row[work_form] == 3) $work_form = "일용직";
	else if($row[work_form] == 4) $work_form = "사업소득";
	else $work_form = "-";
	//노무관리 DB
	$sql_nomu = " select * from pibohum_base_nomu where com_code='$code' and sabun='$id' and annual_paid_holiday_day!='' order by annual_paid_holiday_day desc limit 0,1 ";
	//echo $sql_nomu;
	$row_nomu = sql_fetch($sql_nomu);
	//idx
	$idx = $row_nomu['idx'];
	//연차일자
	$annual_day = $row_nomu['annual_paid_holiday_day'];
	//연차사유
	$annual_reason = $row_nomu['annual_paid_holiday_reason'];
	//연차 총일수
	$annual_paid_hday = $row['annual_paid_holiday'];
	//연차 사용일수
	$sql_common = " from pibohum_base_nomu ";
	$sql_search = " where com_code='$com_code' and annual_paid_holiday_day != '' ";
	$sql_hday = " select count(*) as hday_cnt
          $sql_common
          $sql_search and sabun='$id' ";
	//echo $sql_hday;
	$result_hday = sql_query($sql_hday);
	$row_hday = mysql_fetch_array($result_hday);
	//echo $row_hday[hday_cnt];
	$annual_paid_hday_use = $row_hday['hday_cnt'];
	//echo $annual_paid_hday_use." = ".$annual_paid_hday." - ".$row_hday[hday_cnt];
	//연차 사용일수
	$annual_paid_hday_rest = $annual_paid_hday - $row_hday['hday_cnt'];

	//권한별 링크값
	if($member['mb_profile'] == "guest") {
		$url_use = "javascript:alert_demo();";
	} else {
		$url_modify = "annual_paid_holiday_view.php?w=u&idx=$idx&page=$page";
		$url_use = "annual_paid_holiday_view.php?w=u&id=$id&page=$page";
	}
	//재직자만 표시 => 모두 표시 160317
	//if(!$out_day) {
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$idx?>" class="no_borer"><input type="hidden" name="codex" value="<?=$code?>"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_center_h22"><a href="./popup_annual_paid_holiday.php?code=<?=$code?>&id=<?=$id?>" target="" onclick="cal_open(this.href,'popup_annual_paid_holiday',800,400);return false;"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$position?></td>
									<td nowrap class="ltrow1_center_h22"><?=$emp_stat?></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_use?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_rest?></td> 
									<td nowrap class="ltrow1_center_h22"><a href="annual_paid_holiday_view.php?w=u&id=<?=$id?>&idx=<?=$idx?>&page=<?=$page?>"><b><?=$annual_day?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_reason?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_use?>" target="">사용</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
								</tr>
								<?
	//}
	//재직자만 표시
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
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_apply = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "annual_paid_holiday_view.php?page=$page";
	$url_apply = "javascript:alert('준비중입니다.');";
	$url_form = "form_labor.php?labor=annual_paid_holiday&page=$page";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_apply?>" target=""><img src="images/btn_choice_apply_big.png" border="0"></a>
										<a href="<?=$url_form?>" target=""><img src="images/btn_annualmanage_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							</form>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_01_0"> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="./images/g_tab_on_lt.gif"></td> 
												<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												<a href="#">체크 사항</a> 
												</td> 
												<td><img src="./images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
								<tr>
									<td class="tdrow" style="font-size:15px">※ 입사일 기준으로 근속 1년되는 날에 연차 15개 부여됩니다. 근속 2, 4, 6년(짝수)마다 1개씩 늘어납니다.</td>
								</tr>
								<tr>
									<td class="tdrow" style="font-size:15px">
										※ 예로 2009년 10월 10일이 입사일일 경우 근속 1년이 되는 2010년 10월 10일에 연차 <b>15개</b>가 부여됩니다.
										<br>&nbsp;&nbsp;&nbsp;근속 2년이 되는 2011년 10월 10일은 연차 1개가 추가된 <b>16개</b>가 됩니다. 근속 4년차(2013.10.10)에는 <b>17</b>개가 됩니다.
									</td>
								</tr>
								<tr>
									<td class="tdrow" style="font-size:13px;">
										<div style="padding:4px;">
											근로기준법 제60조에 따라 사용자는 근로자가 1년간 80% 이상 개근한 경우에는 기본 15일(계속근로연수 2년마다 1일 가산)의 연차유급휴가를 부여하여야 하고, 계속근로기간이 1년 미만인 근로자 또는 1년간 80% 미만 출근한 근로자에게는 1개월 개근시 1일의 연차유급휴가를 주어야 합니다.
											<br>연차유급휴가는 입사일을 기준으로 부여하는 것이 원칙이나 사업장의 노무관리 등의 편의를 위해 취업규칙 등에 의하여 계속근로기간에 관계없이 전 근로자에게 회계연도를 기준으로 일률적으로 정할 수 있지만 근로자에게 불리하지 않아야 합니다.
											<br>따라서 회계연도를 기준으로 휴가를 계산할 경우 연도 중 입사자에게 불리하지 않게 휴가를 부여하려면, 입사한 지 1년이 되지 못한 근로자에 대하여도 다음연도에 입사연도의 근속기간에 비례하여 유급휴가를 부여하고 이후 연도부터는 회계연도를 기준으로 연차유급휴가를 부여하면 될 것이며, 근로자 퇴직시에 입사일을 기준으로 산정한 연차휴가에 비해 실제 부여한 연차휴가가 적을 경우에는 그 차이만큼 수당을 지급해야 할 것입니다.
										</div>
									</td>
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
