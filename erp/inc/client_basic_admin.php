<?
//��� ǥ��
//if($member['mb_level'] >= 7) {
//�繫��Ź �������� ��� ����
if($samu_list != "ok") {
//�ű� ��Ͻ� ���� -> ���� (���縸)
//if($w == "u") {
if($w == $w) {
//���� �α��� �� ����Ʈ �� ���
if($member['mb_level'] == 6) $report = "ok";
?>
							<div id="client_basic_admin">
								<!--��޴� -->
								<a name="10002"><!--�Ƿڼ�����--></a>
								<a name="10003"><!--��༭����--></a>
								<a name="15000"><!--��Ź������--></a>
								<a name="15001"><!--�繫��Ź--></a>
								<a name="20001"><!--�븮�μ���(����)--></a>
								<a name="20002"><!--���ڹο�(����)--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='admin_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														����ó����Ȳ
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
//��ǥ��, ������������ ����
if($member['mb_id'] == "kcmc1001" || $client_basic_admin_hide) $admin_div_display = "display:none;";
else $admin_div_display = "";
?>
								<div id="admin_div" style="<?=$admin_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ƿڼ�����</td>
										<td nowrap class="tdrow" width="199">
<?
//�繫��Ź����
$chk_contract = $row['chk_contract'];
$editdt_chk = $row['editdt_chk'];
$editdt = $row['editdt'];
if($report != "ok") {
?>
											<select name="editdt_chk" class="selectfm" onchange="input_today(this,'editdt', '1')">
												<option value=""  <? if($editdt_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($editdt_chk == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($editdt_chk == "2") echo "selected"; ?>>�̵���</option>
											</select>
											<input name="editdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$editdt?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $editdt;
	if($editdt_chk == "2") echo "�̵���";
}
?>
										</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��༭����</td>
										<td nowrap  class="tdrow" width="">
<?
//��༭ ��ȣ
if($row['chk_contract_no']) $chk_contract_no = $row['chk_contract_no'];
else $chk_contract_no = "";
if($report != "ok") {
?>
											<select name="chk_contract" class="selectfm" onchange="input_today(this,'chk_contract_date', '1')">
												<option value=""  <? if($chk_contract == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($chk_contract == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($chk_contract == "2") echo "selected"; ?>>�̵���</option>
											</select>
											<input name="chk_contract_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['chk_contract_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<input name="chk_contract_date_old" type="hidden" value="<?=$row['chk_contract_date']?>">
											��ȣ <input name="chk_contract_no" type="text" class="textfm" style="width:55px;ime-mode:disabled;" value="<?=$chk_contract_no?>" maxlength="4" onkeydown="only_number();">
<?
} else {
	echo $row['chk_contract_date']." ";
	if($row['chk_contract_no']) echo "(".$row['chk_contract_no'].")";
	if($chk_contract == "2") echo "�̵���";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ź������</td>
										<td nowrap  class="tdrow" width="">
<?
//�ű� ��Ͻ� �Ƿڼ��������� �ڵ� ��� 
if ($w != 'u') {
	$editdt = $now_date;
} else {
	$editdt = $row['editdt'];
}
$samu_receive_chk = $row['samu_receive_chk'];
if($report != "ok") {
?>
											<select name="samu_receive_chk" class="selectfm" onchange="input_today(this,'samu_receive_date', '1')">
												<option value=""  <? if($samu_receive_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($samu_receive_chk == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($samu_receive_chk == "2") echo "selected"; ?>>�̵���</option>
											</select>
											<input name="samu_receive_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_receive_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $row['samu_receive_date']." ";
	if($samu_receive_chk == "2") echo "�̵���";
}
?>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�繫��Ź����</td>
										<td nowrap  class="tdrow">
<?
//�繫��Ź����
$samu_req_yn = $row['samu_req_yn'];
$samu_req_yn_arry = array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
//��Ź��ȣ 0 ����
if($row['samu_receive_no']) $samu_receive_no = $row['samu_receive_no'];
else  $samu_receive_no = "";
if($report != "ok") {
?>
											<select name="samu_req_yn" class="selectfm" onchange="input_today_samu(this,'samu_req_date','samu_close_date')">
												<option value=""  <? if($samu_req_yn == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>�ݷ�</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>���Ӱ���</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>Ÿ����</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>����</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>����</option>
											</select>
											����
											<input name="samu_req_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_req_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											��ȣ
											<input name="samu_receive_no" type="text" class="textfm5" style="width:55px;ime-mode:disabled;" value="<?=$samu_receive_no?>" maxlength="5" onkeydown="only_number();">
											����
											<input name="samu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_close_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	if($samu_req_yn) echo "<b>".$samu_req_yn_arry[$samu_req_yn]."</b> ";
	if($row['samu_req_date']) echo "������ : ".$row['samu_req_date']." ";
	if($samu_receive_no) echo "(".$samu_receive_no.") ";
	if($row['samu_close_date']) echo "������ : ".$row['samu_close_date'];
}
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./samu_view.php?w=<?=$w?>&id=<?=$id?>" target="">�繫��Ź��Ȳ</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
//���縸 ǥ�� 150916
if($member['mb_level'] != 6) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:open_samu_history('<?=$id?>');" target="">�̷�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�븮�μ���(����)</td>
										<td nowrap  class="tdrow" colspan="3">
<?
$agent_elect_public_chk = $row['agent_elect_public_chk'];
$agent_elect_public_yn = $row['agent_elect_public_yn'];
if($report != "ok") {
?>
											<select name="agent_elect_public_chk" class="selectfm" onchange="input_today(this,'agent_elect_public_date', '1')">
												<option value=""  <? if($agent_elect_public_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($agent_elect_public_chk == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($agent_elect_public_chk == "2") echo "selected"; ?>>�̵���</option>
											</select>
											<input name="agent_elect_public_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_public_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<select name="agent_elect_public_yn" class="selectfm" onchange="input_today_agent_elect_public(this,'agent_elect_public_edate','agent_elect_public_cdate')">
												<option value=""  <? if($agent_elect_public_yn == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($agent_elect_public_yn == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($agent_elect_public_yn == "2") echo "selected"; ?>>ó����</option>
												<option value="3" <? if($agent_elect_public_yn == "3") echo "selected"; ?>>�Ϸ�</option>
												<option value="4" <? if($agent_elect_public_yn == "4") echo "selected"; ?>>������</option>
												<option value="5" <? if($agent_elect_public_yn == "5") echo "selected"; ?>>�����û</option>
												<option value="6" <? if($agent_elect_public_yn == "6") echo "selected"; ?>>ȸ������</option>
												<option value="7" <? if($agent_elect_public_yn == "7") echo "selected"; ?>>�����Ϸ�</option>
												<option value="8" <? if($agent_elect_public_yn == "8") echo "selected"; ?>>������û</option>
											</select>
											�븮��
											<select name="agent_elect_public_charge" class="selectfm">
												<option value="">����</option>
<?
$agent_elect_public_charge = $row['agent_elect_public_charge'];
?>
												<option value="1" <? if($row['agent_elect_public_charge'] == "1") echo "selected"; ?>><?=$agent_elect_public_charge_arry[1]?></option>
												<option value="2" <? if($row['agent_elect_public_charge'] == "2") echo "selected"; ?>><?=$agent_elect_public_charge_arry[2]?></option>
												<option value="3" <? if($row['agent_elect_public_charge'] == "3") echo "selected"; ?>><?=$agent_elect_public_charge_arry[3]?></option>
												<option value="4" <? if($row['agent_elect_public_charge'] == "4") echo "selected"; ?>><?=$agent_elect_public_charge_arry[4]?></option>
											</select>
											�Ϸ�
											<input name="agent_elect_public_edate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_public_edate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											����
											<input name="agent_elect_public_cdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_public_cdate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											�޸� <input name="agent_elect_public_memo" type="text" class="textfm" style="width:280px;ime-mode:active;" value="<?=$row['agent_elect_public_memo']?>" onkeydown="">
<?
} else {
	if($agent_elect_public_chk == "2") echo "�̵���";
	if($row['agent_elect_public_edate']) echo "�Ϸ� : ".$row['agent_elect_public_edate']." ";
	if($row['agent_elect_public_cdate']) echo "���� : ".$row['agent_elect_public_cdate']." ";
	if($row['agent_elect_public_memo']) echo $row['agent_elect_public_memo'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڹο�(����)</td>
										<td nowrap  class="tdrow" colspan="3">
<?
$agent_elect_center_chk = $row['agent_elect_center_chk'];
$agent_elect_center_yn = $row['agent_elect_center_yn'];
if($report != "ok") {
?>
											<select name="agent_elect_center_chk" class="selectfm" onchange="input_today(this,'agent_elect_center_date', '1')">
												<option value=""  <? if($agent_elect_center_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($agent_elect_center_chk == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($agent_elect_center_chk == "2") echo "selected"; ?>>�̵���</option>
											</select>
											<input name="agent_elect_center_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row[agent_elect_center_date]?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<select name="agent_elect_center_yn" class="selectfm" onchange="input_today_agent_elect_public(this,'agent_elect_center_edate','agent_elect_center_cdate')">
												<option value=""  <? if($agent_elect_center_yn == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($agent_elect_center_yn == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($agent_elect_center_yn == "2") echo "selected"; ?>>ó����</option>
												<option value="3" <? if($agent_elect_center_yn == "3") echo "selected"; ?>>�Ϸ�</option>
												<option value="4" <? if($agent_elect_center_yn == "4") echo "selected"; ?>>������</option>
												<option value="5" <? if($agent_elect_center_yn == "5") echo "selected"; ?>>�����û</option>
												<option value="6" <? if($agent_elect_center_yn == "6") echo "selected"; ?>>ȸ������</option>
												<option value="7" <? if($agent_elect_center_yn == "7") echo "selected"; ?>>�����Ϸ�</option>
												<option value="8" <? if($agent_elect_center_yn == "8") echo "selected"; ?>>������û</option>
											</select>
											�Ϸ�
											<input name="agent_elect_center_edate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_center_edate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											����
											<input name="agent_elect_center_cdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['agent_elect_center_cdate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											�޸� <input name="agent_elect_center_memo" type="text" class="textfm" style="width:386px;ime-mode:active;" value="<?=$row['agent_elect_center_memo']?>" onkeydown="">
<?
} else {
	if($agent_elect_center_chk == "2") echo "�̵���";
	if($row['agent_elect_center_edate']) echo "�Ϸ� : ".$row['agent_elect_center_edate']." ";
	if($row['agent_elect_center_cdate']) echo "���� : ".$row['agent_elect_center_cdate']." ";
	if($row['agent_elect_center_memo']) echo $row['agent_elect_center_memo'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����ݽ�û��������</td>
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
//�繫��Ź �������� ��� ����
?>
							</div>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
