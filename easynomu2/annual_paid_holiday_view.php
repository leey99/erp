<?
$sub_menu = "500200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//사업장정보
$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_a4['com_code'];
$com_name = $row_a4['com_name'];
//사업장정보 추가
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//대표 DB 테이블
$sql_common = " from $g4[pibohum_base] ";
//노무DB 데이터 없을 경우
if(!$row3[com_code]) $com_code = $com_code;
else $com_code = $row3[com_code];
if(!$row3[sabun]) $sabun = $id;
else $sabun = $row3[sabun];
//수정일 경우
if($w == "u") {
//사원DB 노무
	$sql3 = " select * from pibohum_base_nomu where idx='$idx' ";
	$result3 = sql_query($sql3);
	$row3=mysql_fetch_array($result3);
	//노무 idx 데이터 추출 후 처리
	$sql1 = " select * $sql_common where com_code='$com_code' and sabun='$sabun' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	//사원DB 옵션
	$sql2 = " select * from pibohum_base_opt where com_code='$com_code' and sabun='$sabun' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row1=mysql_fetch_array($result1);
	$row2=mysql_fetch_array($result2);
	//사원DB opt2
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun='$sabun' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
}

$sub_title = "연차관리";
$g4[title] = $sub_title." : 노무관리 : ".$easynomu_name;
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
function checkID()
{
	var frm = document.dataForm;
	if (frm.user_id.value == "")
	{
		alert("아이디를 입력하세요.");
		frm.user_id.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?uid="+frm.user_id.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip3=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	return;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;

	if (frm.sabun.value == "")
	{
		alert("사원을 선택하세요.");
		frm.sabun.focus();
		return;
	}
	if (frm.annual_paid_holiday_day.value == "")
	{
		alert("연차일자를 입력하세요.");
		frm.annual_paid_holiday_day.focus();
		return;
	}
	frm.action = "annual_paid_holiday_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" 선택해 주세요.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
// 삭제 검사 확인
function del(page,idx) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "annual_paid_holiday_delete.php?page="+page+"&idx="+idx;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
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

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													연차등록
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

							<form name="dataForm" method="post">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row_com[com_code]?>">
							<input type="hidden" name="code" value="<?=$code?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="idx" value="<?=$idx?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<!-- 입력폼 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사원선택<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="80%">
<?
if($w != u)	{
?>
										<select name='sabun' class='select'>
										<option value=''>근로자선택</option>
										<option value=''>-----------------</option>
										<!-- 근로자리스트사항 -->
										<?
										// 리스트 출력
										$sql = " select * $sql_common where com_code='$com_code' ";
										//echo $sql;
										$result = sql_query($sql);
										for ($i=0; $row=sql_fetch_array($result); $i++) {
											//$page
											//$total_page
											//$rows

											$no = $total_count - $i - ($rows*($page-1));
											$list = $i%2;
											// 사업장명 : 사업장코드
											$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
											$row_com = sql_fetch($sql_com);
											$com_name = $row_com[com_name];
											$com_name = cut_str($com_name, 21, "..");
											$name = cut_str($row[name], 6, "..");
											//$idx = $row[com_code]."_".$row[sabun];
										?>
														<option value="<?=$row[sabun]?>" <? if($row[sabun] == $row1[sabun]) echo "selected"; ?> >[<?=$row[sabun]?>] <?=$name?> (<?=$row[in_day]?>)</option>
										<?
										}
										if ($i == 0)
												echo "<option value=''>자료가 없습니다.</option>";
										?>
										</select>
<?
} else {
	echo $row1[name]."<input type='hidden' name='sabun' value='$row1[sabun]'>";
}
?>

									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">총연차<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="annual_paid_holiday" type="text" class="textfm" style="width:76px;" value="<?=$row_opt2[annual_paid_holiday]?>" maxlength="10">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">연차일자<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="annual_paid_holiday_day" type="text" class="textfm" style="width:76px;" value="<?=$row3[annual_paid_holiday_day]?>" maxlength="10">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.annual_paid_holiday_day);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										* 연차 사용일자
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">연차사유</td>
									<td nowrap  class="tdrow">
										<input type="text" name="annual_paid_holiday_reason" class="textfm" style="width:600px;" value="<?=$row3[annual_paid_holiday_reason]?>" maxlength="" />
									</td>
								</tr>
							</table>
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_del = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_del = "javascript:del($page,$idx);";
}
?>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
<?
if($w == "u") {
?>
										<a href="<?=$url_del?>" target=""><img src="images/btn_del_big.png" border="0"></a>
<? } ?>
										<a href="./annual_paid_holiday.php?page=<?=$page?>" target=""><img src="images/btn_list_big.png" border="0"></a>
									</td>
								</tr>
							</table>

<?
$colspan = 11;
//연차정보
$sql_common = " from pibohum_base_nomu ";
$sql_search = " where com_code='$com_code' and annual_paid_holiday_day!='' and sabun='$id' ";
$sql_order  = " order by annual_paid_holiday_day asc ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 99;
$total_page  = ceil($total_count / $rows);

$sql = " select *
				$sql_common
				$sql_search $sql_order ";
$result = sql_query($sql);
?>
<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$annual_paid_holiday_width = "720";
?>
<div style="width:<?=$annual_paid_holiday_width?>px;text-align:center;font-size:20px">
	<?=$com_name?>
</div>
<!--댑메뉴 -->
<table border=0 cellspacing=0 cellpadding=0> 
	<tr>
		<td id=""> 
			<table border=0 cellpadding=0 cellspacing=0> 
				<tr> 
					<td><img src="images/g_tab_on_lt.gif"></td> 
					<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
					연차정보
					</td> 
					<td><img src="images/g_tab_on_rt.gif"></td> 
				</tr> 
			</table> 
		</td> 
		<td width=2></td> 
		<td valign="bottom"></td> 
	</tr> 
</table>
<div style="height:2px;font-size:0px;width:<?=$annual_paid_holiday_width?>px" class="bgtr"></div>
<div style="height:2px;font-size:0px;line-height:0px;"></div>
<table width="<?=$annual_paid_holiday_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
	<tr>
		<td nowrap class="tdhead_center" width="30">번호</td>
		<td nowrap class="tdhead_center" width="40">사번</td>
		<td nowrap class="tdhead_center" width="70">이름</td>
		<td nowrap class="tdhead_center" width="70">직위</td>
		<td nowrap class="tdhead_center" width="68">채용형태</td>
		<td nowrap class="tdhead_center" width="76">입사일</td>
		<td nowrap class="tdhead_center" width="48">총연차</td>
		<td nowrap class="tdhead_center" width="40">사용</td>
		<td nowrap class="tdhead_center" width="40">잔여</td>
		<td nowrap class="tdhead_center" width="76">사용일자</td>
		<td nowrap class="tdhead_center" width="">연차사유</td>
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
	$idx = $row['idx'];
	//사업장 코드 / 사번 / 코드_사번
	$code = $row['com_code'];
	$id = $row['sabun'];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com['com_name'];
	$com_name = cut_str($com_name, 21, "..");
	//사원DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base['name'], 6, "..");
	//입사일, 퇴직일
	$in_day = $row_base['in_day'];
	$out_day = $row_base['out_day'];
	//사원DB 옵션
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//직위
	if($row2['position']) {
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position['name'];
	}
	//채용형태
	if($row_base['work_form'] == 1) $work_form = "정규직";
	else if($row_base['work_form'] == 2) $work_form = "계약직";
	else if($row_base['work_form'] == 3) $work_form = "일용직";
	else if($row_base['work_form'] == 4) $work_form = "사업소득";
	else $work_form = "";
	//사원DB opt2
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//연차일자
	$annual_day = $row['annual_paid_holiday_day'];
	//연차사유
	$annual_reason = $row['annual_paid_holiday_reason'];
	//연차 총일수
	$annual_paid_hday = $row['annual_paid_holiday'];
	//연차 사용일수
	$in_day_array = explode('.', $in_day);
	$year1 = ($in_day_array[0]+1).".".$in_day_array[1].".".$in_day_array[2];
	$year2 = ($in_day_array[0]+2).".".$in_day_array[1].".".$in_day_array[2];
	$year3 = ($in_day_array[0]+3).".".$in_day_array[1].".".$in_day_array[2];
	$year4 = ($in_day_array[0]+4).".".$in_day_array[1].".".$in_day_array[2];
	$year5 = ($in_day_array[0]+5).".".$in_day_array[1].".".$in_day_array[2];
	$year6 = ($in_day_array[0]+6).".".$in_day_array[1].".".$in_day_array[2];
	$year7 = ($in_day_array[0]+7).".".$in_day_array[1].".".$in_day_array[2];
	$year9 = ($in_day_array[0]+9).".".$in_day_array[1].".".$in_day_array[2];
	$year11 = ($in_day_array[0]+11).".".$in_day_array[1].".".$in_day_array[2];
	$year13 = ($in_day_array[0]+13).".".$in_day_array[1].".".$in_day_array[2];
	$year15 = ($in_day_array[0]+15).".".$in_day_array[1].".".$in_day_array[2];
	$year17 = ($in_day_array[0]+17).".".$in_day_array[1].".".$in_day_array[2];
	$year19 = ($in_day_array[0]+19).".".$in_day_array[1].".".$in_day_array[2];
	$year21 = ($in_day_array[0]+21).".".$in_day_array[1].".".$in_day_array[2];
	if($year1 >= $row['annual_paid_holiday_day']) {
		$annual_paid_hday_use = $i+1;
	}
	if($year2 >= $row['annual_paid_holiday_day'] && $year1 < $row['annual_paid_holiday_day']) {
		if(!isset($i2)) $i2 = 0;
		$i2++;
		$annual_paid_hday_use = $i2;
	}
	if($year3 >= $row['annual_paid_holiday_day'] && $year2 < $row['annual_paid_holiday_day']) {
		if(!isset($i3)) $i3 = 0;
		$i3++;
		$annual_paid_hday_use = $i3;
	}
	if($year4 >= $row['annual_paid_holiday_day'] && $year3 < $row['annual_paid_holiday_day']) {
		if(!isset($i4)) $i4 = 0;
		$i4++;
		$annual_paid_hday_use = $i4;
	}
	if($year5 >= $row['annual_paid_holiday_day'] && $year4 < $row['annual_paid_holiday_day']) {
		if(!isset($i5)) $i5 = 0;
		$i5++;
		$annual_paid_hday_use = $i5;
	}
	if($year6 >= $row['annual_paid_holiday_day'] && $year5 < $row['annual_paid_holiday_day']) {
		if(!isset($i6)) $i6 = 0;
		$i6++;
		$annual_paid_hday_use = $i6;
	}
	//echo $annual_paid_hday_use." = ".$annual_paid_hday." - ".$row_hday[hday_cnt];
	//연차 사용일수
	$annual_paid_hday_rest = $annual_paid_hday - $annual_paid_hday_use;
?>
	<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
		<td nowrap class="ltrow1_center_h22"><?=$no?></td>
		<td nowrap class="ltrow1_center_h22"><?=$id?></td>
		<td nowrap class="ltrow1_center_h22"><a href="annual_paid_holiday_view.php?w=u&id=<?=$id?>&idx=<?=$idx?>&page=<?=$page?>"><b><?=$name?></b></a></td>
		<td nowrap class="ltrow1_center_h22"><?=$position?></td>
		<td nowrap class="ltrow1_center_h22"><?=$work_form?></td>
		<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_use?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_rest?></td> 
		<td nowrap class="ltrow1_center_h22"><?=$annual_day?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_reason?></td>
	</tr>
	</tr>
	<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
	?>
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

							<div style="height:20px;font-size:0px"></div>
							</form>
							<!--댑메뉴 -->
							<!-- 입력폼 -->

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
