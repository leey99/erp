<?
$sub_menu = "200100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_pay_h c ";

//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}

//년도, 월 설정 (현재 년월 이전달 -1) 151005
if(!$search_month) {
	$search_month = date("m");
	//echo $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month = 12;
	} else {
		$search_year_minus = 0;
		$search_month -= 1;
	}
	if($search_month < 10) $search_month = "0".$search_month;
	$search_year = date("Y");
	$search_year -= $search_year_minus;
	//이전 달 -2
	$search_month_pre = $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month_pre = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre -= 1;
	}
	if($search_month_pre < 10) $search_month_pre = "0".$search_month_pre;
	$search_year_pre = $search_year;
	$search_year_pre -= $search_year_minus;
}

if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//급여대장 DB join
$sql_search .= " and (a.com_code = c.com_code and a.sabun = c.sabun) ";
//전월 급여대장
$sql_search .= " and ( c.year = '$search_year' and c.month = '$search_month' ) ";
//과세 급여 존재
$sql_search .= " and c.money_for_tax > 0 ";
//그룹
$group_by = " group by c.com_code, c.sabun ";
$sql_order = " order by a.name ";

$sql = " select count(distinct c.sabun) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 200;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "월평균보수변경(자동)";
$g4[title] = $sub_title." : 사원관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
					$group_by
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;

//검색 파라미터 전송
$qstr  = "stx_dept=".$stx_dept."&amp;stx_name=".$stx_name."&amp;stx_sabun=".$stx_sabun."&amp;stx_work_form=".$stx_work_form."&amp;stx_emp_stat=".$stx_emp_stat."&amp;stx_out_temp=".$stx_out_temp."&amp;sst=".$sst."&amp;sod=".$sod;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm.adr_zip1.value = data.postcode1;
					frm.adr_zip2.value = data.postcode2;
					frm.adr_adr1.value = data.address;
					frm.adr_adr2.focus();
			}
	}).open();
}
function func_checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
//]]>
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
if($comp_print_type == "H") {
	include "./inc/left_menu2_type_h.php";
} else {
	include "./inc/left_menu2.php";
}
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
									<td valign="bottom" style="padding:0 0 0 10px"><b>총 <?=$total_count?>명</b> (성명을 클릭 시 상세 내용을 볼 수 있습니다.)</td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->

							<!--리스트 -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" checked onclick="func_checkAll()"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="156">사업장</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="34">번호</td>
									<td nowrap class="tdhead_center" width="">성명</td>
									<td nowrap class="tdhead_center" width="100">주민등록번호</td>
									<td nowrap class="tdhead_center" width="70">입사일</td>
									<td nowrap class="tdhead_center" width="70">퇴사일</td>
									<td nowrap class="tdhead_center" width="94">보수(<strong><?=$search_year_pre.".".$search_month_pre?></strong>)</td>
									<td nowrap class="tdhead_center" width="94">보수(<strong><?=$search_year.".".$search_month?></strong>)</td>
									<td nowrap class="tdhead_center" width="70">변경사유</td>
									<td nowrap class="tdhead_center" width="70">변경연월</td>
									<td nowrap class="tdhead_center" width="200">신고보험</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - ($total_count - $i - ($rows*($page-1))) + 1;
  $list = $i%2;
	//사업장 코드 / 사번 / 코드_사번
	$code = $row['com_code'];
	$id = $row['sabun'];
	$code_id = $code."_".$id;
	//사원명
	$name = cut_str($row[name], 6, "..");
	//입사일/퇴사일
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//퇴사자 표시
	if($row[out_day] == "..") $out_text = "";
	else if($row[out_day] == "") $out_text = "";
	else $out_text = "(퇴사)";
	//주민등록번호 뒷 다섯자리 별표 처리
	$jumin_no = substr($row[jumin_no],0,9)."*****";
	//만나이
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//국민연금 만60세 해당 사원
	if($age_cal >= 60) {
		$color_km = "style='color:red' title='만 60세 이상 근로자'";
	} else {
		$color_km = "";
	}
	//고용보험 만65세 해당 사원
	if($age_cal >= 65) {
		$color_gy = "style='color:red' title='만 65세 이상 근로자'";
	} else {
		$color_gy = "";
	}
	//보수(이전월)
	$sql_month_pre = " select money_for_tax from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre' and month='$search_month_pre' ";
	$row_month_pre = sql_fetch($sql_month_pre);
	$money_month_pre = $row_month_pre['money_for_tax'];
	//보수(해당월)
	$money_month = $row['money_for_tax'];
	//변경사유
	if($money_month_pre < $money_month) $modify_reason = "보수인상";
	else $modify_reason = "보수인하";
	//신고보험 선택
	if($money_month_pre == 0) {
		$row['apply_km'] = "";
		$row['apply_gg'] = "";
	}
	//사원정보 링크
	$staff_url = "javascript:alert('사원정보 수정을 위해 사원정보 페이지로 이동합니다.');self.location.href='staff_view.php?w=u&id=$id&code=$code&page=$page';";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_left_h22" style="padding:4px"><?=$com_name?>&nbsp;</td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_center_h22">
										<a href="<?=$staff_url?>"><b><?=$name?></b></a>
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$jumin_no?></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_right_h22"><div style="padding-right:4px;"><?=number_format($money_month_pre)?></div></td>
									<td nowrap class="ltrow1_right_h22"><div style="padding-right:4px;"><?=number_format($money_month)?></div></td>
									<td nowrap class="ltrow1_center_h22"><?=$modify_reason?></td>
									<td nowrap class="ltrow1_center_h22"><?=$search_year.".".$search_month?></td>
									<td nowrap class="ltrow1_center_h22">
										<!--취득여부 문자형 0 비교-->
<?
//연금 신고 유무 : 보수인하 20% 차이 151012
if($row['apply_km'] == "0") {
	//보수인상 체크 해지
	if($money_month_pre < $money_month) {
		$apply_km_checked = "";
	} else {
		//보수인하 20$ 차이 비교
		if( ($money_month_pre-$money_month) > ($money_month_pre/5) ) $apply_km_checked = "checked";
		else $apply_km_checked = "";
	}
} else {
	$apply_km_checked = "";
}
?>
										<input type="checkbox" name="isgy" value="1" class="checkbox" disabled <? if($row['apply_gy'] == "0") echo "checked"; ?> ><span <?=$color_gy?>>고용</span>
										<input type="checkbox" name="issj" value="1" class="checkbox" disabled <? if($row['apply_sj'] == "0") echo "checked"; ?> >산재
										<input type="checkbox" name="iskm" value="1" class="checkbox" disabled <?=$apply_km_checked?> ><span <?=$color_km?>>연금</span>
										<input type="checkbox" name="isgg" value="1" class="checkbox" disabled <? if($row['apply_gg'] == "0") echo "checked"; ?> >건강
									</td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
							</table>
							<input type="checkbox" name="idx" value="" style="display:none">
<?
//권한별 링크값
//echo $member[mb_profile];
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_form = "./work_contract.php?id=$id&code=$code&page=$page";
}
if($id) {
	$url_pay = "./staff_pay_view.php?w=u&id=$id&code=$code&page=$page";
} else {
	$url_pay = "javascript:alert('저장 후 이용하십시오.');";
}
//화성시장애인부모회 : 활동보조인
if($comp_print_type == "H") {
	if($row2['position'] == "13" || $kind == "beistand") {
		$url_list = "staff_list_beistand.php?page=".$page;
	} else if($row2['position'] == "14" || $kind == "helper") {
		$url_list = "staff_list_helper.php?page=".$page;
	} else {
		$url_list = "staff_list.php?page=".$page;
	}
} else {
	$url_list = "staff_list.php?page=".$page;
}
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:20px">
								<tr>
									<td style="text-align:center">
										<a href="<?=$url_save?>" target=""><img src="images/btn_transmit.png" border="0"></a>
										<a href="<?=$url_list?>" target=""><img src="images/btn_cancel.png" border="0"></a>
									</td>
								</tr>
							</table>
							<input type="hidden" name="error_code" style="width:100%" value="">
							</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>

			</td>
		</tr>
	</table>			
</div>
<script type="text/javascript">
//<![CDATA[
addLoadEvent(func_checkAll);
//]]>
</script>
</body>
</html>
