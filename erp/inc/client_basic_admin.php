<?
//모두 표시
//if($member['mb_level'] >= 7) {
//사무위탁 페이지일 경우 숨김
if($samu_list != "ok") {
//신규 등록시 숨김 -> 보임 (본사만)
//if($w == "u") {
if($w == $w) {
//지사 로그인 시 리포트 뷰 출력
if($member['mb_level'] == 6) $report = "ok";
?>
							<div id="client_basic_admin">
								<!--댑메뉴 -->
								<a name="10002"><!--의뢰서접수--></a>
								<a name="10003"><!--계약서접수--></a>
								<a name="15000"><!--위탁서접수--></a>
								<a name="15001"><!--사무위탁--></a>
								<a name="20001"><!--대리인선임(공단)--></a>
								<a name="20002"><!--전자민원(센터)--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='admin_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														본사처리현황
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
<?
//대표님, 전기요금컨설팅 숨김
if($member['mb_id'] == "kcmc1001" || $client_basic_admin_hide) $admin_div_display = "display:none;";
else $admin_div_display = "";
?>
								<div id="admin_div" style="<?=$admin_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">의뢰서접수</td>
										<td nowrap class="tdrow" width="199">
<?
//사무위탁수임
$chk_contract = $row['chk_contract'];
$editdt_chk = $row['editdt_chk'];
$editdt = $row['editdt'];
if($report != "ok") {
?>
											<select name="editdt_chk" class="selectfm" onchange="input_today(this,'editdt', '1')">
												<option value=""  <? if($editdt_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($editdt_chk == "1") echo "selected"; ?>>도착</option>
												<option value="2" <? if($editdt_chk == "2") echo "selected"; ?>>미도착</option>
											</select>
											<input name="editdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$editdt?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $editdt;
	if($editdt_chk == "2") echo "미도착";
}
?>
										</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">계약서접수</td>
										<td nowrap  class="tdrow" width="">
<?
//계약서 번호
if($row['chk_contract_no']) $chk_contract_no = $row['chk_contract_no'];
else $chk_contract_no = "";
if($report != "ok") {
?>
											<select name="chk_contract" class="selectfm" onchange="input_today(this,'chk_contract_date', '1')">
												<option value=""  <? if($chk_contract == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($chk_contract == "1") echo "selected"; ?>>도착</option>
												<option value="2" <? if($chk_contract == "2") echo "selected"; ?>>미도착</option>
											</select>
											<input name="chk_contract_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['chk_contract_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<input name="chk_contract_date_old" type="hidden" value="<?=$row['chk_contract_date']?>">
											번호 <input name="chk_contract_no" type="text" class="textfm" style="width:55px;ime-mode:disabled;" value="<?=$chk_contract_no?>" maxlength="4" onkeydown="only_number();">
<?
} else {
	echo $row['chk_contract_date']." ";
	if($row['chk_contract_no']) echo "(".$row['chk_contract_no'].")";
	if($chk_contract == "2") echo "미도착";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">위탁서접수</td>
										<td nowrap  class="tdrow" width="">
<?
//신규 등록시 의뢰서접수일자 자동 등록 
if ($w != 'u') {
	$editdt = $now_date;
} else {
	$editdt = $row['editdt'];
}
$samu_receive_chk = $row['samu_receive_chk'];
if($report != "ok") {
?>
											<select name="samu_receive_chk" class="selectfm" onchange="input_today(this,'samu_receive_date', '1')">
												<option value=""  <? if($samu_receive_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($samu_receive_chk == "1") echo "selected"; ?>>도착</option>
												<option value="2" <? if($samu_receive_chk == "2") echo "selected"; ?>>미도착</option>
											</select>
											<input name="samu_receive_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_receive_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $row['samu_receive_date']." ";
	if($samu_receive_chk == "2") echo "미도착";
}
?>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사무위탁수임</td>
										<td nowrap  class="tdrow">
<?
//사무위탁수임
$samu_req_yn = $row['samu_req_yn'];
$samu_req_yn_arry = array("","반려","수임가능","타수임","수임","해지");
//위탁번호 0 제거
if($row['samu_receive_no']) $samu_receive_no = $row['samu_receive_no'];
else  $samu_receive_no = "";
if($report != "ok") {
?>
											<select name="samu_req_yn" class="selectfm" onchange="input_today_samu(this,'samu_req_date','samu_close_date')">
												<option value=""  <? if($samu_req_yn == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>수임가능</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>타수임</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>수임</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
											수임
											<input name="samu_req_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_req_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											번호
											<input name="samu_receive_no" type="text" class="textfm5" style="width:55px;ime-mode:disabled;" value="<?=$samu_receive_no?>" maxlength="5" onkeydown="only_number();">
											해지
											<input name="samu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_close_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	if($samu_req_yn) echo "<b>".$samu_req_yn_arry[$samu_req_yn]."</b> ";
	if($row['samu_req_date']) echo "수임일 : ".$row['samu_req_date']." ";
	if($samu_receive_no) echo "(".$samu_receive_no.") ";
	if($row['samu_close_date']) echo "해지일 : ".$row['samu_close_date'];
}
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./samu_view.php?w=<?=$w?>&id=<?=$id?>" target="">사무위탁현황</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
//본사만 표시 150916
if($member['mb_level'] != 6) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:open_samu_history('<?=$id?>');" target="">이력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대리인선임(공단)</td>
										<td nowrap  class="tdrow" colspan="3">
<?
$agent_elect_public_chk = $row['agent_elect_public_chk'];
$agent_elect_public_yn = $row['agent_elect_public_yn'];
if($report != "ok") {
?>
											<select name="agent_elect_public_chk" class="selectfm" onchange="input_today(this,'agent_elect_public_date', '1')">
												<option value=""  <? if($agent_elect_public_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($agent_elect_public_chk == "1") echo "selected"; ?>>도착</option>
												<option value="2" <? if($agent_elect_public_chk == "2") echo "selected"; ?>>미도착</option>
											</select>
											<input name="agent_elect_public_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_public_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<select name="agent_elect_public_yn" class="selectfm" onchange="input_today_agent_elect_public(this,'agent_elect_public_edate','agent_elect_public_cdate')">
												<option value=""  <? if($agent_elect_public_yn == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($agent_elect_public_yn == "1") echo "selected"; ?>>없음</option>
												<option value="2" <? if($agent_elect_public_yn == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($agent_elect_public_yn == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($agent_elect_public_yn == "4") echo "selected"; ?>>미접수</option>
												<option value="5" <? if($agent_elect_public_yn == "5") echo "selected"; ?>>지사요청</option>
												<option value="6" <? if($agent_elect_public_yn == "6") echo "selected"; ?>>회원가입</option>
												<option value="7" <? if($agent_elect_public_yn == "7") echo "selected"; ?>>해지완료</option>
												<option value="8" <? if($agent_elect_public_yn == "8") echo "selected"; ?>>해지요청</option>
											</select>
											대리인
											<select name="agent_elect_public_charge" class="selectfm">
												<option value="">선택</option>
<?
$agent_elect_public_charge = $row['agent_elect_public_charge'];
?>
												<option value="1" <? if($row['agent_elect_public_charge'] == "1") echo "selected"; ?>><?=$agent_elect_public_charge_arry[1]?></option>
												<option value="2" <? if($row['agent_elect_public_charge'] == "2") echo "selected"; ?>><?=$agent_elect_public_charge_arry[2]?></option>
												<option value="3" <? if($row['agent_elect_public_charge'] == "3") echo "selected"; ?>><?=$agent_elect_public_charge_arry[3]?></option>
												<option value="4" <? if($row['agent_elect_public_charge'] == "4") echo "selected"; ?>><?=$agent_elect_public_charge_arry[4]?></option>
											</select>
											완료
											<input name="agent_elect_public_edate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_public_edate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											해지
											<input name="agent_elect_public_cdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_public_cdate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											메모 <input name="agent_elect_public_memo" type="text" class="textfm" style="width:280px;ime-mode:active;" value="<?=$row['agent_elect_public_memo']?>" onkeydown="">
<?
} else {
	if($agent_elect_public_chk == "2") echo "미도착";
	if($row['agent_elect_public_edate']) echo "완료 : ".$row['agent_elect_public_edate']." ";
	if($row['agent_elect_public_cdate']) echo "해지 : ".$row['agent_elect_public_cdate']." ";
	if($row['agent_elect_public_memo']) echo $row['agent_elect_public_memo'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전자민원(센터)</td>
										<td nowrap  class="tdrow" colspan="3">
<?
$agent_elect_center_chk = $row['agent_elect_center_chk'];
$agent_elect_center_yn = $row['agent_elect_center_yn'];
if($report != "ok") {
?>
											<select name="agent_elect_center_chk" class="selectfm" onchange="input_today(this,'agent_elect_center_date', '1')">
												<option value=""  <? if($agent_elect_center_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($agent_elect_center_chk == "1") echo "selected"; ?>>도착</option>
												<option value="2" <? if($agent_elect_center_chk == "2") echo "selected"; ?>>미도착</option>
											</select>
											<input name="agent_elect_center_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row[agent_elect_center_date]?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<select name="agent_elect_center_yn" class="selectfm" onchange="input_today_agent_elect_public(this,'agent_elect_center_edate','agent_elect_center_cdate')">
												<option value=""  <? if($agent_elect_center_yn == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($agent_elect_center_yn == "1") echo "selected"; ?>>없음</option>
												<option value="2" <? if($agent_elect_center_yn == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($agent_elect_center_yn == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($agent_elect_center_yn == "4") echo "selected"; ?>>미접수</option>
												<option value="5" <? if($agent_elect_center_yn == "5") echo "selected"; ?>>지사요청</option>
												<option value="6" <? if($agent_elect_center_yn == "6") echo "selected"; ?>>회원가입</option>
												<option value="7" <? if($agent_elect_center_yn == "7") echo "selected"; ?>>해지완료</option>
												<option value="8" <? if($agent_elect_center_yn == "8") echo "selected"; ?>>해지요청</option>
											</select>
											완료
											<input name="agent_elect_center_edate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_center_edate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											해지
											<input name="agent_elect_center_cdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_center_cdate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											메모 <input name="agent_elect_center_memo" type="text" class="textfm" style="width:386px;ime-mode:active;" value="<?=$row['agent_elect_center_memo']?>" onkeydown="">
<?
} else {
	if($agent_elect_center_chk == "2") echo "미도착";
	if($row['agent_elect_center_edate']) echo "완료 : ".$row['agent_elect_center_edate']." ";
	if($row['agent_elect_center_cdate']) echo "해지 : ".$row['agent_elect_center_cdate']." ";
	if($row['agent_elect_center_memo']) echo $row['agent_elect_center_memo'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금신청내역유무</td>
										<td nowrap  class="tdrow" colspan="5">
<?
if($report != "ok") {
?>
											<input name="support_history_memo" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['support_history_memo']?>" onkeydown="">
<?
} else {
	echo $row['support_history_memo'];
}
?>
										</td>
									</tr>
								</table>
								</div>
<?
}
}
//사무위탁 페이지일 경우 숨김
?>
							</div>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
