<?
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");

//저장 / 처리현황 추가 / 일정 또는 처리현황이 있을 경우 저장 160726
if($client_schedule_visitdt || $client_schedule_visitdt_check_ok) {
	$sql_common = "
						client_schedule_visitdt_manager = '$client_schedule_visitdt_manager',
						client_schedule_visitdt_writer = '$client_schedule_visitdt_writer',
						client_schedule_visitdt = '$client_schedule_visitdt',
						client_schedule_visitdt_time = '$client_schedule_visitdt_time',
						client_schedule_visitdt_check_ok = '$client_schedule_visitdt_check_ok',
						client_schedule_memo = '$client_schedule_memo'
	";
	$sql = " update com_list_gy set $sql_common where com_code = '$com_code' ";
	//echo $sql;
	//exit;
	sql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>저장</title>
</head>
<body>
<script type="text/javascript">
//<![CDATA[
	alert("정상적으로 스케줄 등록 되었습니다.");
	window.close();
//]]>
</script>
</body>
</html>
<?
	exit;
}
//사업장 정보 DB
$sql_common = " from com_list_gy a, com_list_gy_opt b ";
$report = "ok";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$com_code' ";
$sql_order = "";

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];
$colspan = 11;
$row = mysql_fetch_array($result);

//메모
$client_schedule_memo = $row['client_schedule_memo'];

//등록자 코드
$mb_id = $member['mb_id'];
$sql_manage = " select * from a4_manage where state=1 and user_id='$mb_id' ";
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$writer_code = $row_manage['code'];
?>
<html>
<head>
<title>스케줄 등록</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="./css/style_chongmu.css">
</head>
<body topmargin="0" leftmargin="0">
<script type="text/javascript" src="./js/common.js"></script>
<script type="text/javascript">
//<![CDATA[
function checkData() {
	var frm = document.dataForm;
/*
	if (frm.client_schedule_visitdt.value == "") {
		alert("일정을 입력하세요.");
		return;
	}
*/
	if (frm.client_schedule_visitdt_check_ok.value == "") {
		alert("처리현황을 선택하세요.");
		return;
	}
	if (frm.client_schedule_memo.value == "") {
		alert("메모를 입력하세요.");
		return;
	}
	opener.document.getElementById("client_schedule_visitdt").innerHTML = frm.client_schedule_visitdt.value;
	opener.document.getElementById("client_schedule_visitdt_time").innerHTML = frm.client_schedule_visitdt_time.value;
	opener.document.getElementById("client_schedule_memo").innerHTML = frm.client_schedule_memo.value;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
}
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
//<![CDATA[
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
//]]>
</script>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
		<tr>
			<td style="padding:0 20 0 20">
				<!--타이틀 -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:8pt;color:#929292;'>
										<img src="./images/title_icon.gif" align="absmiddle" style="margin:0 5px 2px 0;"><span style="font-size:9pt;color:black;">스케줄 등록</span>
									</td>
									<td align=right class=navi></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height=1 bgcolor=e0e0de></td>
					</tr>
					<tr>
						<td height=2 bgcolor=f5f5f5></td>
					</tr>
					<tr>
						<td height=5></td>
					</tr>
				</table>
				<!--댑메뉴 -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border="0" cellspacing="0" cellpadding="0"> 
								<tr> 
									<td><img src="images/sb_tab_on_lt.gif" /></td> 
									<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style="width:100px;text-align:center;"> 
									사업장 기본정보
									</td> 
									<td><img src="images/sb_tab_on_rt.gif" /></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
				<!--사업장-->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
										<tr class="list_row_now_wh">
											<td nowrap class="tdhead" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22" width="238">
												<div style="padding-top:3px;">
<?
if($report != "ok") {
?>
													<input name="firm_name" type="text" class="textfm" style="width:220px;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50">
<?
} else {
	echo $row['com_name'];
	echo "<input type='hidden' name='firm_name' value='".$row['com_name']."'>";
	if($samu_list == "ok") {
		echo "<br><span style='color:blue'>";
		if($row_samu['com_name_samu']) echo $row_samu['com_name_samu'];
		echo "</span>";
	}
}
?>
												</div>
											</td>
											<td nowrap class="tdhead" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업개시일</td>
											<td nowrap  class="ltrow1_left_h22" width="">
<?
if($report != "ok") {
?>
												<input name="cntr_sdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['cntr_sdate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellspacing="0" cellpadding="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.cntr_sdate);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
												예)2012.01.01
<?
} else {
	echo $row['cntr_sdate'];
}
?>
											</td>
										</tr>
										<tr class="list_row_now_wh">
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자번호<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22">
<?
if($report != "ok") {
?>
												<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['biz_no']?>" maxlength="12" onkeydown="only_number()" onkeyup="checkhyphen(this.value, '1','Y')" onblur="getCont(this.value, '<?=$id?>');" />
												<div id='rst' style="color:red;"></div>
												<input type="hidden" name="rst_chk" value="" />
<?
} else {
	echo $row['biz_no'];
	echo "<input type='hidden' name='comp_bznb' value='".$row['biz_no']."' />";
}
?>
											</td>
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
											<td nowrap  class="ltrow1_left_h22">
<?
if($report != "ok") {
?>
												<input name="t_insureno" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['t_insureno']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkhyphen_tno(this.value, '2','Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:check_tno();" target="">중복확인</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	echo $row['t_insureno'];
}
?>
											</td>
										</tr>
										<tr class="list_row_now_wh">
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22">
<?
if($row['uptae_code']) {
	$uptae_code = $row['uptae_code'];
}
if($report != "ok") {
?>
												<input name="uptae" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row['uptae']?>" maxlength="50">
												<select name="uptae_code" class="selectfm" onchange="uptae_change(this[this.selectedIndex].text);">
													<option value="">선택</option>
<?
	for($i=1;$i<count($uptae_arry);$i++) {
		if($row['uptae_code'] == $i) $sel_uptae_code[$i] = "selected";
?>
													<option value="<?=$i?>" <?=$sel_uptae_code[$i]?>><?=$uptae_arry[$i]?></option>
<?
	}
?>
												</select>
<?
} else {
	echo $row['uptae'];
}
?>
											</td>
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
											<td nowrap  class="ltrow1_left_h22" colspan="3">
												<div style="padding-top:3px;">
<?
if($report != "ok") {
?>
												<input name="upjong_code" id="upjong_code_undefined" type="text" class="textfm" style="width:40px;" value="<?=$row['upjong_code']?>" maxlength="5" readonly>
												<label onclick="open_upjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
												<input name="upjong" id="upjong_undefined" type="text" class="textfm" style="width:450px;" value="<?=$row['upjong']?>" maxlength="25" readonly>
<?
} else {
	echo $row['upjong'];
	if($row['upjong_code']) echo " (".$row['upjong_code'].")";
	if($samu_list == "ok") {
		echo "<br><span style='color:blue'>";
		if($row_samu['upjong_gy']) echo " 고용: ".$row_samu['upjong_gy'];
		if($row_samu['upjong_sj']) echo " 산재: ".$row_samu['upjong_sj'];
		echo "</span>";
	}
}
?>
												</div>
											</td>
										</tr>
										<tr class="list_row_now_wh">
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22">
<?
if($report != "ok") {
?>
												<input name="cust_name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25" onblur="getCont_boss(this.value, '<?=$id?>');" />
												<div id='rst_boss' style="color:blue;"></div>
<?
} else {
	echo $row['boss_name'];
	echo "<input type='hidden' name='cust_name' value='".$row['boss_name']."'>";
	if($samu_list == "ok") {
		echo "<span style='color:blue'>";
		if($row_samu['boss_name']) echo " ".$row_samu['boss_name'];
		echo "</span>";
	}
}
?>
											</td>
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자핸드폰</td>
											<td nowrap  class="ltrow1_left_h22">
<?
$cust_cel = explode("-",$row['boss_hp']);
$cust_cel1 = $cust_cel[0];
//echo $cust_cel1;
$sel_cust_cel1 = array();
$sel_cust_cel1[$cust_cel1] = "selected";
//echo $sel_cust_cel1[$cust_cel1];
$cust_cel2 = $cust_cel[1];
$cust_cel3 = $cust_cel[2];
if($report != "ok") {
?>
												<select name="cust_cel1" class="selectfm">
													<option value="">선택</option>
													<option value="010" <?=$sel_cust_cel1['010']?>>010</option>
													<option value="011" <?=$sel_cust_cel1['011']?>>011</option>
													<option value="016" <?=$sel_cust_cel1['016']?>>016</option>
													<option value="017" <?=$sel_cust_cel1['017']?>>017</option>
													<option value="018" <?=$sel_cust_cel1['018']?>>018</option>
													<option value="019" <?=$sel_cust_cel1['019']?>>019</option>
													<option value="070" <?=$sel_cust_cel1['070']?>>070</option>
												</select>
												-
												<input name="cust_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="cust_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['boss_hp'];
}
?>

<?
//딜러 제외 모두 표시 160112
if($member['mb_profile'] < 110) {
	$adr_rowspan = 3;
} else {
	$adr_rowspan = 2;
}
?>
											</td>
										</tr>
										<tr class="list_row_now_wh">
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22">
<?
$com_tel = explode("-",$row[com_tel]);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
if($report != "ok") {
?>
												<select name="cust_tel1" class="selectfm">
												<option value="">선택</option>
													<option value="02"  <?=$sel_cust_tel1['02']?> >02</option>
													<option value="031" <?=$sel_cust_tel1['031']?>>031</option>
													<option value="032" <?=$sel_cust_tel1['032']?>>032</option>
													<option value="033" <?=$sel_cust_tel1['033']?>>033</option>
													<option value="041" <?=$sel_cust_tel1['041']?>>041</option>
													<option value="042" <?=$sel_cust_tel1['042']?>>042</option>
													<option value="043" <?=$sel_cust_tel1['043']?>>043</option>
													<option value="044" <?=$sel_cust_tel1['044']?>>044</option>
													<option value="051" <?=$sel_cust_tel1['051']?>>051</option>
													<option value="052" <?=$sel_cust_tel1['052']?>>052</option>
													<option value="053" <?=$sel_cust_tel1['053']?>>053</option>
													<option value="054" <?=$sel_cust_tel1['054']?>>054</option>
													<option value="055" <?=$sel_cust_tel1['055']?>>055</option>
													<option value="061" <?=$sel_cust_tel1['061']?>>061</option>
													<option value="062" <?=$sel_cust_tel1['062']?>>062</option>
													<option value="063" <?=$sel_cust_tel1['063']?>>063</option>
													<option value="064" <?=$sel_cust_tel1['064']?>>064</option>
													<option value="070" <?=$sel_cust_tel1['070']?>>070</option>
													<option value="000" <?=$sel_cust_tel1['000']?>>빈칸</option>
													<option value="010" <?=$sel_cust_tel1['010']?>>010</option>
													<option value="011" <?=$sel_cust_tel1['011']?>>011</option>
													<option value="016" <?=$sel_cust_tel1['016']?>>016</option>
													<option value="017" <?=$sel_cust_tel1['017']?>>017</option>
													<option value="018" <?=$sel_cust_tel1['018']?>>018</option>
													<option value="019" <?=$sel_cust_tel1['019']?>>019</option>
												</select>
												-
												<input name="cust_tel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="cust_tel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	if($row['com_tel']) {
		//전화번호
		$com_tel = $row['com_tel'];
		//1544 국번 지역번호 제거
		$com_tel_array = explode("-", $com_tel);
		if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
		echo $com_tel;
	}
	if($samu_list == "ok") {
		echo "<span style='color:blue'>";
		if($row_samu['com_tel']) echo " ".$row_samu['com_tel'];
		echo "</span>";
	}
}
?>
											</td>
											<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">팩스번호<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22">
<?
$com_fax = explode("-",$row[com_fax]);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax2 = $com_fax[1];
$com_fax3 = $com_fax[2];
if($report != "ok") {
?>
												<select name="cust_fax1" class="selectfm">
												<option value="">선택</option>
													<option value="02"  <?=$sel_cust_fax1['02']?> >02</option>
													<option value="031" <?=$sel_cust_fax1['031']?>>031</option>
													<option value="032" <?=$sel_cust_fax1['032']?>>032</option>
													<option value="033" <?=$sel_cust_fax1['033']?>>033</option>
													<option value="041" <?=$sel_cust_fax1['041']?>>041</option>
													<option value="042" <?=$sel_cust_fax1['042']?>>042</option>
													<option value="043" <?=$sel_cust_fax1['043']?>>043</option>
													<option value="044" <?=$sel_cust_fax1['044']?>>044</option>
													<option value="051" <?=$sel_cust_fax1['051']?>>051</option>
													<option value="052" <?=$sel_cust_fax1['052']?>>052</option>
													<option value="053" <?=$sel_cust_fax1['053']?>>053</option>
													<option value="054" <?=$sel_cust_fax1['054']?>>054</option>
													<option value="055" <?=$sel_cust_fax1['055']?>>055</option>
													<option value="061" <?=$sel_cust_fax1['061']?>>061</option>
													<option value="062" <?=$sel_cust_fax1['062']?>>062</option>
													<option value="063" <?=$sel_cust_fax1['063']?>>063</option>
													<option value="064" <?=$sel_cust_fax1['064']?>>064</option>
													<option value="070" <?=$sel_cust_fax1['070']?>>070</option>
													<option value="0303" <?=$sel_cust_fax1['0303']?>>0303</option>
													<option value="0502" <?=$sel_cust_fax1['0502']?>>0502</option>
													<option value="0504" <?=$sel_cust_fax1['0504']?>>0504</option>
													<option value="0505" <?=$sel_cust_fax1['0505']?>>0505</option>
													<option value="0507" <?=$sel_cust_fax1['0507']?>>0507</option>
												</select>
												-
												<input name="cust_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="cust_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['com_fax'];
	$fax_error_array = array("","정상전송","부분전달","전화연결","응답없음","없는번호","통화중","기타");
	$fax_error = $row['fax_error'];
	if($fax_error) echo " (".$fax_error_array[$fax_error].")";
}
$sql_fax = " select * from fax_not where com_fax = '$row[com_fax]' ";
$row_fax = sql_fetch($sql_fax);
if($row_fax['fax_error']) echo "<span style='color:red'> 팩스불가</span>";
?>
											</td>
										</tr>
										<tr class="list_row_now_wh">
											<td nowrap class="tdhead" rowspan="<?=$adr_rowspan?>"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소<font color="red">*</font></td>
											<td nowrap  class="ltrow1_left_h22" rowspan="<?=$adr_rowspan?>" colspan="3">
<?
$adr_zip = explode("-",$row['com_postno']);
$new_zip = $row['new_postno'];
if($report != "ok") {
?>
												<input name="new_zip" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$new_zip?>" maxlength="5" />
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2','new_zip');" target="">주소찾기</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												(구)우편번호
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$adr_zip[0]?>" maxlength="3" />
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$adr_zip[1]?>" maxlength="3" />
												<!--<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:openDaumPostcode_new('new_zip','adr_adr1','adr_adr2');" target="">(신)우편번호</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>-->
												<br>
												<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['com_juso']?>" maxlength="150" />
												<br>
												<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['com_juso2']?>" maxlength="150" />
<?
} else {
	if($row['new_postno']) echo "(<strong>".$row['new_postno']."</strong>) ";
	if($row['com_postno']) echo "구(".$row['com_postno'].") ";
	echo $row['com_juso']." ".$row['com_juso2'];
	if($samu_list == "ok") {
		echo "<span style='color:blue'>";
		if($row_samu['com_juso']) echo "<br>".$row_samu['com_juso'];
		echo "</span>";
	}
}
?>
											</td>
										</tr>
									</table>

				<div style="height:10px;font-size:0px"></div>
				<!--리스트 -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
										스케줄 등록
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
				<!--리스트 -->
				<form name="dataForm" style="margin:0" method="post">
					<input type="hidden" name="com_code" value="<?=$com_code?>" />
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr class="list_row_now_wh">
						<td nowrap class="tdhead" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />일정<font color="red">*</font></td>
						<td nowrap class="ltrow1_left_h22">
							<input name="client_schedule_visitdt" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;" value="<?=$row['client_schedule_visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
							<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.client_schedule_visitdt);">달력</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
							<select name="client_schedule_visitdt_time" class="selectfm" style="float:left;">
								<option value="">선택</option>
								<option value="오전" <? if($row['client_schedule_visitdt_time'] == "오전") echo "selected"; ?>>오전</option>
								<option value="오후" <? if($row['client_schedule_visitdt_time'] == "오후") echo "selected"; ?>>오후</option>
							</select>
							<div style="float:left;padding:4px;">담당자 코드</div>
							<div style="float:left;">
								<input name="client_schedule_visitdt_manager" type="text" class="textfm" style="width:48px;ime-mode:disabled;float:left;" value="<?=$row['client_schedule_visitdt_manager']?>" maxlength="4" />
							</div>
							<div style="float:left;padding:4px;">등록자 코드</div>
							<div style="float:left;">
								<input name="client_schedule_visitdt_writer" type="text" class="textfm" style="width:48px;ime-mode:disabled;float:left;" value="<?=$writer_code?>" maxlength="4" />
							</div>
						</td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />처리현황<font color="red">*</font></td>
						<td nowrap class="ltrow1_left_h22">
<?
$sel_check_ok = array();
$check_ok_id = $row['client_schedule_visitdt_check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
							<select name="client_schedule_visitdt_check_ok" class="selectfm">
								<option value="">선택</option>
								<option value="9" <?=$sel_check_ok['9']?>><?=$job_time_process_arry[9]?></option>
								<option value="10" <?=$sel_check_ok['10']?>><?=$job_time_process_arry[10]?></option>
								<option value="8" <?=$sel_check_ok['8']?>><?=$job_time_process_arry[8]?></option>
								<option value="1" <?=$sel_check_ok['1']?>><?=$job_time_process_arry[1]?></option>
								<option value="2" <?=$sel_check_ok['2']?>><?=$job_time_process_arry[2]?></option>
								<option value="3" <?=$sel_check_ok['3']?>><?=$job_time_process_arry[3]?></option>
								<option value="4" <?=$sel_check_ok['4']?>><?=$job_time_process_arry[4]?></option>
								<option value="6" <?=$sel_check_ok['6']?>><?=$job_time_process_arry[6]?></option>
								<option value="7" <?=$sel_check_ok['7']?>><?=$job_time_process_arry[7]?></option>
								<option value="5" <?=$sel_check_ok['5']?>><?=$job_time_process_arry[5]?></option>
							</select>
						</td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="tdhead"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />메모<font color="red">*</font></td>
						<td nowrap class="ltrow1_left_h22">
							<textarea name="client_schedule_memo" class="textfm" style='width:100%;height:88px;word-break:break-all;'><?=$row['client_schedule_memo']?></textarea>
						</td>
					</tr>
				</table>
			</form>
			<div style="height:20px;font-size:0px;line-height:0px;"></div>
			<!--리스트 -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
<?
$url_save = "javascript:checkData();";
?>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;" id="btn_save" ><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="" >저 장</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;" id="btn_close"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:window.close();">닫 기</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
