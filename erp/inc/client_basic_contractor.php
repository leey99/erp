<?
//열람 사용자 로그 저장 (관리자 제외)
if($member['mb_level'] != 10) {
	$mb_profile_code = $member['mb_profile'];
	$mb_id = $member['mb_id'];
	$user_ip = $_SERVER[REMOTE_ADDR];
	$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time', user_ip='$user_ip' ";
	sql_query($sql_erp_view_log);
}
?>
<script type="text/javascript">
//<![CDATA[
//중복확인 : 사업장관리번호
function check_tno() {
	var frm = document.dataForm;
	if(frm.t_insureno.value == "") {
		alert("사업장관리번호를 입력하세요.");
		frm.t_insureno.focus();
		return;
	}
	if(frm.t_insureno.value.length < 14) {
		alert("사업장관리번호 14자리('-'포함)를 입력하세요.");
		frm.t_insureno.focus();
		return;
	}
	var ret = window.open("./popup/comp_tno_popup_overlap.php?tno="+frm.t_insureno.value, "tno_check", "width=540, height=290, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	return;
}
function input_today(input_obj, output_name, vars) {
	var frm = document.dataForm;
	if(input_obj.value == vars) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_agent_elect_public(input_obj, output_name, output_name2) {
	var frm = document.dataForm;
	if(input_obj.value == 3) {
		frm[output_name].value = "<?=$today?>";
	} else 	if(input_obj.value == 7 || input_obj.value == 8) {
		frm[output_name2].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_samu(input_obj, output_name, output_name2) {
	var frm = document.dataForm;
	if(input_obj.value == 4) {
		frm[output_name].value = "<?=$today?>";
		frm[output_name2].value = "";
	} else 	if(input_obj.value == 5) {
		frm[output_name2].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_easynomu(input_obj, output_name, output_name2) {
	var frm = document.dataForm;
	if(input_obj.value == 3) {
		frm[output_name].value = "<?=$today?>";
	} else 	if(input_obj.value == 5) {
		frm[output_name2].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_double(input_obj, output_name, vars, vars2) {
	var frm = document.dataForm;
	if(input_obj.value == vars || input_obj.value == vars2) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function checkbox_today(input_obj, output_name) {
	var frm = document.dataForm;
	if(input_obj.checked == true) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function chk_today(output_name, vars) {
	var frm = document.dataForm;
	frm[output_name].value = "<?=$today?>";
}
function uptae_change(obj_text) {
	var frm = document.dataForm;
	frm.uptae.value = obj_text;
}
function persons_0(obj) {
	var frm = document.dataForm;
	if(obj.checked) {
		frm.persons_gy_old.value = frm.persons_gy.value;
		frm.persons_sj_old.value = frm.persons_sj.value;
		frm.persons_gy.value = "";
		frm.persons_sj.value = "";
	} else {
		frm.persons_gy.value = frm.persons_gy_old.value;
		frm.persons_sj.value = frm.persons_sj_old.value;
	}
}
//사무위탁 이력
function open_samu_history(id) {
	var ret = window.open("./samu_history_popup.php?id="+id, "window_samu_history", "scrollbars=yes,width=640,height=240");
	return;
}
//]]>
</script>
<script type="text/javascript" src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2,zip) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					if(data.postcode1) {
						frm[zip1].value = data.postcode1;
						frm[zip2].value = data.postcode2;
					}
					//if(data.userSelectedType === 'R') frm[addr1].value = data.address
					if(data.userSelectedType === 'R') frm[addr1].value = data.roadAddress
					else frm[addr1].value = data.jibunAddress;;
					//무조건 도로명 표시 160127
					//frm[addr1].value = data.roadAddress;
					frm[zip].value = data.zonecode;
					frm[addr2].focus();
			}
	}).open();
}
function openDaumPostcode_new(zip,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm[zip].value = data.zonecode;
					frm[addr1].value = data.roadAddress;
					frm[addr2].focus();
			}
	}).open();
}
function btn_pg_click(btn_id, div_id) {
	if(getId(div_id).style.display == 'none') {
		getId(btn_id).src = "images/btn_pgClose.gif";
		getId(div_id).style.display = '';
	} else {
		getId(btn_id).src = "images/btn_pgOpen.gif";
		getId(div_id).style.display = 'none';
	}
}
//사업자등록번호 중복 확인
function getCont( id, code ) {
	var frm = document.dataForm;
	//alert(id);
	var xmlhttp = fncGetXMLHttpRequest();
	// 아이디를 체크할 php 페이지에 체크 하려하는 id 값을 파라미터로 넘겨 줍니다.
	xmlhttp.open('POST', 'ajax_check_bizno_confirm.php?id='+id+'&code='+code, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=euc-kr');
	xmlhttp.onreadystatechange = function () {
		//alert(xmlhttp.readyState);
		//alert(xmlhttp.status);
		if(xmlhttp.readyState=='4' && xmlhttp.status==200) {
			if(xmlhttp.status==500 || xmlhttp.status==404 || xmlhttp.status==403)	alert("페이지 오류 : "+xmlhttp.status);
			else {
				var dp  = document.getElementById('rst');
				if(xmlhttp.responseText=='Y') {
					dp.innerHTML = "이미 등록된 사업장입니다.(본사문의요망)";
					frm.rst_chk.value = "y";
				} else {
					dp.innerHTML = "";
					frm.rst_chk.value = "";
				}
			}
		}
	}
	xmlhttp.send();
}
//대표자명 중복 확인
function getCont_boss( id, code ) {
	var frm = document.dataForm;
	var xmlhttp = fncGetXMLHttpRequest();
	xmlhttp.open('POST', 'ajax_check_boss_confirm.php?id='+id+'&code='+code, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=euc-kr');
	xmlhttp.onreadystatechange = function () {
		if(xmlhttp.readyState=='4' && xmlhttp.status==200) {
			if(xmlhttp.status==500 || xmlhttp.status==404 || xmlhttp.status==403)	alert("페이지 오류 : "+xmlhttp.status);
			else {
				var dp  = document.getElementById('rst_boss');
				if(xmlhttp.responseText=='Y') {
					dp.innerHTML = "이미 등록된 대표자명입니다.";
				} else {
					dp.innerHTML = "";
				}
			}
		}
	}
	xmlhttp.send();
}
//Ajax 함수
function fncGetXMLHttpRequest() {
	if(window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		}	catch(e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e1) {
				return null;
			}
		}
		//IE 외 파이어폭스 오페라 같은 브라우저에서 XMLHttpRequest 객체 구하기
	} else if(window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}
//문자 발송 팝업 151014
function popup_sms_send(url, to_phone) {
	window.open(url+"?to_phone="+to_phone, "window_sms_send", "width=340, height=350, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//열람 수정
function modify_damdang_code2() {
	getId('table_damdang_code2').style.display = "none";
	getId('div_damdang_code2').style.display = "inline";
}
//열람 저장
function save_damdang_code2() {
	var frm = document.dataForm;
	getId('table_damdang_code2').style.display = "inline";
	getId('div_damdang_code2').style.display = "none";
	var var_damdang_code2 = frm.sel_damdang_code2.value;
	var text_damdang_code2 = frm.hid_damdang_code2.value;
	iframe_damdang_code2.location.href = "damdang_code2_update.php?id=<?=$com_code?>&damdang_code2="+var_damdang_code2;
	alert("열람 관리점("+text_damdang_code2+")으로 저장 되었습니다.");
	getId('span_damdang_code2').innerHTML = "열람("+text_damdang_code2+")";
}
//담당매니저 수정
function modify_manage_cust_numb() {
	getId('table_manage_cust_numb').style.display = "none";
	getId('div_manage_cust_numb').style.display = "inline";
}
//담당매니저 저장
function save_manage_cust_numb() {
	var frm = document.dataForm;
	getId('table_manage_cust_numb').style.display = "inline";
	getId('div_manage_cust_numb').style.display = "none";
	var var_manage_cust_numb = frm.inp_manage_cust_numb.value;
	var var_manage_cust_name = frm.inp_manage_cust_name.value;
	iframe_manage_cust_numb.location.href = "manage_cust_numb_update.php?id=<?=$com_code?>&manage_cust_numb="+var_manage_cust_numb+"&manage_cust_name="+var_manage_cust_name;
	alert("담당매니저("+var_manage_cust_name+")로 저장 되었습니다.");
	getId('span_manage_cust_name').innerHTML = "변경("+var_manage_cust_name+")";
}
//담당자매니저 수정
function findNomu_modify() {
	var frm = document.dataForm;
	var branch = frm.sel_damdang_code2.value;
	if(branch == "") branch = frm.damdang_code.value;
	var kind = "";
	var ret = window.open("pop_manage_cust_modify.php?search_belong="+branch+"&kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//]]>
</script>
<?
if($samu_list == "ok") {
	$sql_samu = " select * from com_samu where com_code='$com_code' ";
	$result_samu = sql_query($sql_samu);
	$row_samu = mysql_fetch_array($result_samu);
}
?>
							<!--dataForm 폼 시작-->
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
								<input type="hidden" name="w" value="<?=$w?>">
								<!--거래처 기본정보 인쇄 영역-->
								<div id='print_page'>
									<!--댑메뉴 -->
									<table border="0" cellspacing="0" cellpadding="0"> 
										<tr>
											<td id=""> 
												<table border="0" cellspacing="0" cellpadding="0"> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif" /></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style="width:100;text-align:center;"> 
														사업장 기본정보
														</td> 
														<td><img src="images/g_tab_on_rt.gif" /></td> 
													</tr> 
												</table> 
											</td> 
											<td width="10"></td> 
											<td valign="bottom">※ 필수값 정보가 없을 경우 "-" (하이픈)으로 입력해주십시오.</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<!-- 입력폼 -->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
										<tr>
											<td nowrap class="tdrowk_h30" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30" width="238">
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
											<td nowrap class="tdrowk_h30" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업개시일</td>
											<td nowrap  class="tdrow_h30" width="210">
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
											<td nowrap class="tdrowk_h30" width="98"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자구분<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30" width="">
<?
if($row[upche_div] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "개인";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "법인";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "유한";
}
if($report != "ok") {
?>
												<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?>>개인
												<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?>>법인
												<input type="radio" name="comp_type" value="3" <?=$chk_comp_type3?>>유한
<?
} else {
	echo $comp_type_text;
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자번호<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30">
<?
if($report != "ok") {
?>
												<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['biz_no']?>" maxlength="12" onkeydown="only_number_hyphen()" onkeyup="checkhyphen(this.value, '1','Y')" onblur="getCont(this.value, '<?=$id?>');" />
												<div id='rst' style="color:red;"></div>
												<input type="hidden" name="rst_chk" value="" />
<?
} else {
	echo $row['biz_no'];
	echo "<input type='hidden' name='comp_bznb' value='".$row['biz_no']."' />";
}
?>
											</td>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
											<td nowrap  class="tdrow_h30">
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
											<td nowrap class="tdrowk_h30" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">법인등록번호<font color="red"></font></td>
											<td nowrap  class="tdrow_h30" width="">
<?
if($report != "ok") {
?>
												<input name="bupin_no" type="text" class="textfm" style="width:150px;" value="<?=$row['bupin_no']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '1','Y')">
<?
} else {
	echo $row['bupin_no'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30">
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
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
											<td nowrap  class="tdrow_h30" colspan="3">
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
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최초등록일시</td>
											<td nowrap  class="tdrow_h30" colspan="5">
<?
echo $row['regdt_time'];
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종목</td>
											<td nowrap  class="tdrow_h30" colspan="3">
<?
if($report != "ok") {
?>
												<input name="jongmok" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['jongmok']?>" maxlength="100">
<?
} else {
	echo $row['jongmok'];
}
?>
											</td>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30">
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
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30">
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
<?
//딜러 제외 팩스번호 필수값 160125
if($member['mb_profile'] < 110) $essential_fax = "*";
else $essential_fax = "";
?>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">팩스번호<font color="red"><?=$essential_fax?></font></td>
											<td nowrap  class="tdrow_h30">
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
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자주민번호</td>
											<td nowrap class="tdrow_h30">
<?
if($report != "ok") {
?>
												<input name="cust_ssnb" type="text" class="textfm" style="width:150;ime-mode:disabled;" value="<?=$row[jumin_no]?>" maxlength="14"  onkeydown="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
<?
} else {
	echo $row['jumin_no'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자명<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30">
<?
if($report != "ok") {
?>
												<input name="damdang_name" type="text" class="textfm" style="width:140;ime-mode:active;" value="<?=$row[com_damdang]?>" maxlength="20" >
												예) 홍길동 과장
<?
} else {
	echo $row['com_damdang'];
}
?>
											</td>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자전화</td>
											<td nowrap class="tdrow_h30">
<?
$damdang_cel = explode("-",$row[com_damdang_tel]);
$damdang_cel1 = $damdang_cel[0];
$sel_damdang_cel1 = array();
$sel_damdang_cel1[$damdang_cel1] = "selected";
$damdang_cel2 = $damdang_cel[1];
$damdang_cel3 = $damdang_cel[2];
if($report != "ok") {
?>
												<select name="damdang_cel1" class="selectfm">
													<option value="">선택</option>
													<option value="02"  <?=$sel_damdang_cel1['02']?> >02</option>
													<option value="031" <?=$sel_damdang_cel1['031']?>>031</option>
													<option value="032" <?=$sel_damdang_cel1['032']?>>032</option>
													<option value="033" <?=$sel_damdang_cel1['033']?>>033</option>
													<option value="041" <?=$sel_damdang_cel1['041']?>>041</option>
													<option value="042" <?=$sel_damdang_cel1['042']?>>042</option>
													<option value="043" <?=$sel_damdang_cel1['043']?>>043</option>
													<option value="044" <?=$sel_damdang_cel1['044']?>>044</option>
													<option value="051" <?=$sel_damdang_cel1['051']?>>051</option>
													<option value="052" <?=$sel_damdang_cel1['052']?>>052</option>
													<option value="053" <?=$sel_damdang_cel1['053']?>>053</option>
													<option value="054" <?=$sel_damdang_cel1['054']?>>054</option>
													<option value="055" <?=$sel_damdang_cel1['055']?>>055</option>
													<option value="061" <?=$sel_damdang_cel1['061']?>>061</option>
													<option value="062" <?=$sel_damdang_cel1['062']?>>062</option>
													<option value="063" <?=$sel_damdang_cel1['063']?>>063</option>
													<option value="064" <?=$sel_damdang_cel1['064']?>>064</option>
													<option value="070" <?=$sel_damdang_cel1['070']?>>070</option>
													<option value="010" <?=$sel_damdang_cel1['010']?>>010</option>
													<option value="011" <?=$sel_damdang_cel1['011']?>>011</option>
													<option value="016" <?=$sel_damdang_cel1['016']?>>016</option>
													<option value="017" <?=$sel_damdang_cel1['017']?>>017</option>
													<option value="018" <?=$sel_damdang_cel1['018']?>>018</option>
													<option value="019" <?=$sel_damdang_cel1['019']?>>019</option>
												</select>
												-
												<input name="damdang_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$damdang_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="damdang_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$damdang_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['com_damdang_tel'];
}
//본사만 표시 문자 발송 151014
if($member['mb_level'] != 6 && $row['com_damdang_tel']) {
?>
												<a href="popup/popup_sms_send.php" onclick="popup_sms_send(this.href, '<?=$row['com_damdang_tel']?>');return false;" onkeypress="this.onclick;"><img src="images/icon_sms_send.png" style="vertical-align:middle;" border="0" alt="문자발송" /></a>
<?
}
?>
											</td>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자핸드폰</td>
											<td nowrap  class="tdrow_h30">
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
//본사만 표시 문자 발송 151014
if($member['mb_level'] != 6 && $row['boss_hp']) {
?>
												<a href="popup/popup_sms_send.php" onclick="popup_sms_send(this.href, '<?=$row['boss_hp']?>');return false;" onkeypress="this.onclick;"><img src="images/icon_sms_send.png" style="vertical-align:middle;" border="0" alt="문자발송" /></a>
<?
}
$adr_rowspan = 1;
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30" rowspan="<?=$adr_rowspan?>"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30" rowspan="<?=$adr_rowspan?>" colspan="3">
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
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">이메일<font color="red">*</font></td>
											<td nowrap  class="tdrow_h30">
<?
if($report != "ok") {
?>
												<input name="cust_email" type="text" class="textfm" style="width:192px;ime-mode:disabled;" value="<?=$row[com_mail]?>" maxlength="100">
<?
} else {
	echo $row['com_mail'];
}
?>
											</td>
										</tr>
									</table>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="client_basic_addition" style="display:none;margin-top:4px;">
										<tr>
											<td nowrap class="tdrowk_h30" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장 규모</td>
											<td nowrap  class="tdrow_h30" width="238">
<?
if($row['emp5_gbn'] == 1) $emp5_gbn = "checked";
if($row['emp30_gbn'] == 1) $emp30_gbn = "checked";
if($report != "ok") {
?>
												<input type="checkbox" name="emp5_gbn" value="1" <?=$emp5_gbn?> style="vertical-align:middle">5인 미만
												<input type="checkbox" name="emp30_gbn" value="1" <?=$emp30_gbn?> style="vertical-align:middle">30인 이상
<?
} else {
	if($row['emp5_gbn']) echo "5인 미만";
	if($row['emp30_gbn']) echo "30인 이상";
}
?>
											</td>
											<td nowrap class="tdrowk_h30" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">취업규칙신고</td>
											<td nowrap class="tdrow_h30" width="210">
<?
if($row['employment_report'] == "") $sel_employment_report1 = "selected";
else if($row['employment_report'] == "1") $sel_employment_report2 = "selected";
else if($row['employment_report'] == "2") $sel_employment_report3 = "selected";
if($report != "ok") {
?>
												<select name="employment_report" class="selectfm">
													<option value="" <?=$sel_employment_report1?>>모름</option>
													<option value="1" <?=$sel_employment_report2?>>무</option>
													<option value="2" <?=$sel_employment_report3?>>유</option>
												</select>
												<input name="employment_report_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['employment_report_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.employment_report_date);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	echo $row['employment_report_date'];
}
?>
											</td>
											<td nowrap class="tdrowk_h30" width="98"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자도장</td>
											<td nowrap class="tdrow_h30">
<?
if($report != "ok") {
?>
												<input name="filename" type="file" class="textfm_search" style="width:160px;">
<?
}
//증명사진
//echo $row[pic];
if($row[pic]) {
	$pic = "./files/seal/$id.jpg";
} else {
	$pic = "./images/seal.gif";
}
?>
												<a href="<?=$pic?>" target="_blank"><img src="<?=$pic?>" width="22" height="22" border="0" style="vertical-align:middle;" /></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">회계사</td>
											<td nowrap class="tdrow_h30" >
<?
if($report != "ok") {
?>
												<input name="treasurer_name" type="text" class="textfm" style="width:220px;ime-mode:active;" value="<?=$row['treasurer_name']?>" maxlength="50">
<?
} else {
	echo $row['treasurer_name'];
}
?>
											</td>
											<td nowrap class="tdrowk_h30" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">회계주소</td>
											<td nowrap  class="tdrow_h30" rowspan="3" colspan="3">
<?
if($report != "ok") {
?>
												<input name="treasurer_adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$row['treasurer_adr_zip1']?>" readonly>
												-
												<input name="treasurer_adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$row['treasurer_adr_zip2']?>" readonly>
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('treasurer_adr_zip1','treasurer_adr_zip2','treasurer_adr_adr1','treasurer_adr_adr2');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
												<br>
												<input name="treasurer_adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['treasurer_adr_adr1']?>" readonly>
												<br>
												<input name="treasurer_adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['treasurer_adr_adr2']?>" maxlength="150">
<?
} else {
	if($row['treasurer_adr_zip1']) echo "(".$row['treasurer_adr_zip1']."-".$row['treasurer_adr_zip2'].") ";
	echo $row['treasurer_adr_adr1']." ".$row['treasurer_adr_adr2'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">회계전화</td>
											<td nowrap class="tdrow_h30">
<?
$treasurer_tel = explode("-",$row['treasurer_tel']);
$treasurer_tel1 = $treasurer_tel[0];
$sel_treasurer_tel1 = array();
$sel_treasurer_tel1[$treasurer_tel1] = "selected";
$treasurer_tel2 = $treasurer_tel[1];
$treasurer_tel3 = $treasurer_tel[2];
if($report != "ok") {
?>
												<select name="treasurer_tel1" class="selectfm">
													<option value="">선택</option>
													<option value="02"  <?=$sel_treasurer_tel1['02']?> >02</option>
													<option value="031" <?=$sel_treasurer_tel1['031']?>>031</option>
													<option value="032" <?=$sel_treasurer_tel1['032']?>>032</option>
													<option value="033" <?=$sel_treasurer_tel1['033']?>>033</option>
													<option value="041" <?=$sel_treasurer_tel1['041']?>>041</option>
													<option value="042" <?=$sel_treasurer_tel1['042']?>>042</option>
													<option value="043" <?=$sel_treasurer_tel1['043']?>>043</option>
													<option value="044" <?=$sel_treasurer_tel1['043']?>>044</option>
													<option value="051" <?=$sel_treasurer_tel1['051']?>>051</option>
													<option value="052" <?=$sel_treasurer_tel1['052']?>>052</option>
													<option value="053" <?=$sel_treasurer_tel1['053']?>>053</option>
													<option value="054" <?=$sel_treasurer_tel1['054']?>>054</option>
													<option value="055" <?=$sel_treasurer_tel1['055']?>>055</option>
													<option value="061" <?=$sel_treasurer_tel1['061']?>>061</option>
													<option value="062" <?=$sel_treasurer_tel1['062']?>>062</option>
													<option value="063" <?=$sel_treasurer_tel1['063']?>>063</option>
													<option value="064" <?=$sel_treasurer_tel1['064']?>>064</option>
													<option value="070" <?=$sel_treasurer_tel1['070']?>>070</option>
													<option value="010" <?=$sel_treasurer_tel1['010']?>>010</option>
													<option value="011" <?=$sel_treasurer_tel1['011']?>>011</option>
													<option value="016" <?=$sel_treasurer_tel1['016']?>>016</option>
													<option value="017" <?=$sel_treasurer_tel1['017']?>>017</option>
													<option value="018" <?=$sel_treasurer_tel1['018']?>>018</option>
													<option value="019" <?=$sel_treasurer_tel1['019']?>>019</option>
												</select>
												-
												<input name="treasurer_tel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$treasurer_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="treasurer_tel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$treasurer_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['treasurer_tel'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk_h30"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">회계팩스</td>
											<td nowrap class="tdrow_h30">
<?
$treasurer_fax = explode("-",$row['treasurer_fax']);
$treasurer_fax1 = $treasurer_fax[0];
$sel_treasurer_fax1 = array();
$sel_treasurer_fax1[$treasurer_fax1] = "selected";
$treasurer_fax2 = $treasurer_fax[1];
$treasurer_fax3 = $treasurer_fax[2];
if($report != "ok") {
?>
												<select name="treasurer_fax1" class="selectfm">
													<option value="">선택</option>
													<option value="02"  <?=$sel_treasurer_fax1['02']?> >02</option>
													<option value="031" <?=$sel_treasurer_fax1['031']?>>031</option>
													<option value="032" <?=$sel_treasurer_fax1['032']?>>032</option>
													<option value="033" <?=$sel_treasurer_fax1['033']?>>033</option>
													<option value="041" <?=$sel_treasurer_fax1['041']?>>041</option>
													<option value="042" <?=$sel_treasurer_fax1['042']?>>042</option>
													<option value="043" <?=$sel_treasurer_fax1['043']?>>043</option>
													<option value="044" <?=$sel_treasurer_fax1['044']?>>044</option>
													<option value="051" <?=$sel_treasurer_fax1['051']?>>051</option>
													<option value="052" <?=$sel_treasurer_fax1['052']?>>052</option>
													<option value="053" <?=$sel_treasurer_fax1['053']?>>053</option>
													<option value="054" <?=$sel_treasurer_fax1['054']?>>054</option>
													<option value="055" <?=$sel_treasurer_fax1['055']?>>055</option>
													<option value="061" <?=$sel_treasurer_fax1['061']?>>061</option>
													<option value="062" <?=$sel_treasurer_fax1['062']?>>062</option>
													<option value="063" <?=$sel_treasurer_fax1['063']?>>063</option>
													<option value="064" <?=$sel_treasurer_fax1['064']?>>064</option>
													<option value="070" <?=$sel_treasurer_fax1['070']?>>070</option>
													<option value="070" <?=$sel_treasurer_fax1['0303']?>>0303</option>
													<option value="070" <?=$sel_treasurer_fax1['0505']?>>0505</option>
												</select>
												-
												<input name="treasurer_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$treasurer_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="treasurer_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$treasurer_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['treasurer_fax'];
}
?>
											</td>
										</tr>
									</table>
									<div style="width:100%;text-align:center;"><span style="cursor:pointer;" onclick="btn_pg_click('btn_pg','client_basic_addition');"><img src="images/btn_pgOpen.gif" border="0" id="btn_pg" /></span></div>
