
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ģ�Ű�</td>
														<td nowrap class="tdrow">
															<select name="stx_rules_report_if" class="selectfm" onchange="">
																<option value=""   <? if($stx_rules_report_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1"  <? if($stx_rules_report_if == "1") echo "selected"; ?>>YES</option>
																<option value="2"  <? if($stx_rules_report_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($stx_retirement_age) echo "<span style='font-weight:bold'>"; ?>���⳪��<? if($stx_retirement_age) echo "</span>";?></td>
														<td nowrap class="tdrow">
															<input name="stx_retirement_age"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_retirement_age?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ű����ڱԸ�</td>
														<td nowrap class="tdrow">
															<select name="stx_new_fund_scale_site" class="selectfm" onchange="">
																<option value=""  <? if($stx_new_fund_scale_site == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_new_fund_scale_site == "1") echo "selected"; ?>>����</option>
																<option value="2" <? if($stx_new_fund_scale_site == "2") echo "selected"; ?>>���๰</option>
																<option value="3" <? if($stx_new_fund_scale_site == "3") echo "selected"; ?>>����</option>
																<option value="4" <? if($stx_new_fund_scale_site == "4") echo "selected"; ?>>�հ�</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���弳������</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_type" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_type == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_establish_type == "1") echo "selected"; ?>>�������� ����</option>
																<option value="2" <? if($stx_establish_type == "2") echo "selected"; ?>>Ÿ��������</option>
																<option value="3" <? if($stx_establish_type == "3") echo "selected"; ?>>��Ÿ</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($stx_refund_request) echo "<span style='font-weight:bold'>"; ?>��������ȯ�޽�û<? if($stx_refund_request) echo "</span>";?></td>
														<td nowrap class="tdrow">
															<select name="stx_refund_request" class="selectfm" onchange="">
																<option value=""   <? if($stx_refund_request == "")  echo "selected"; ?>>��ü</option>
																<option value="1"  <? if($stx_refund_request == "1") echo "selected"; ?>>YES</option>
																<option value="2"  <? if($stx_refund_request == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�繫��/����и�</td>
														<td nowrap class="tdrow">
															<select name="stx_factory_split" class="selectfm" onchange="">
																<option value=""  <? if($stx_factory_split == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_factory_split == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_factory_split == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���峪��</td>
														<td nowrap class="tdrow">
															<input name="stx_extend_age"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_extend_age?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($stx_easynomu_request) echo "<span style='font-weight:bold'>"; ?>�����빫�Ƿ�<? if($stx_easynomu_request) echo "</span>";?></td>
														<td nowrap class="tdrow">
															<select name="stx_easynomu_request" class="selectfm" onchange="">
																<option value=""  <? if($stx_easynomu_request == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_easynomu_request == "1") echo "selected"; ?>>�⺻��ġ</option>
																<option value="2" <? if($stx_easynomu_request == "2") echo "selected"; ?>>�޿����̺�</option>
																<option value="3" <? if($stx_easynomu_request == "3") echo "selected"; ?>>�����Ģ��</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ھ����ش�</td>
														<td nowrap class="tdrow">
															<select name="stx_fund_type_industry" class="selectfm" onchange="">
																<option value=""  <? if($stx_fund_type_industry == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_fund_type_industry == "1") echo "selected"; ?>>�����������</option>
																<option value="2" <? if($stx_fund_type_industry == "2") echo "selected"; ?>>����������ġ����</option>
																<option value="3" <? if($stx_fund_type_industry == "3") echo "selected"; ?>>���ļ��񽺻��</option>
																<option value="4" <? if($stx_fund_type_industry == "4") echo "selected"; ?>>������������</option>
																<option value="5" <? if($stx_fund_type_industry == "5") echo "selected"; ?>>Ưȭ����</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����������α׷��̼���</td>
														<td nowrap class="tdrow">
															<select name="stx_employment_support" class="selectfm" onchange="">
																<option value=""  <? if($stx_employment_support == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_employment_support == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_employment_support == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���弳����ȹ</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_proposal_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_proposal_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_establish_proposal_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_establish_proposal_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ټ��ο�</td>
														<td nowrap class="tdrow">
															<input name="stx_multitude"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_multitude?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�δ������</td>
														<td nowrap class="tdrow">
															<select name="stx_charge_progress" class="selectfm" onchange="">
																<option value=""  <? if($stx_charge_progress == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_charge_progress == "1") echo "selected"; ?>>����</option>
																<option value="2" <? if($stx_charge_progress == "2") echo "selected"; ?>>��</option>
																<option value="3" <? if($stx_charge_progress == "3") echo "selected"; ?>>��������</option>
																<option value="4" <? if($stx_charge_progress == "4") echo "selected"; ?>>��Ÿ</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���弳�����</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_way" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_way == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_establish_way == "1") echo "selected"; ?>>�Ӵ�</option>
																<option value="2" <? if($stx_establish_way == "2") echo "selected"; ?>>�ű��ڰ����弳��</option>
																<option value="3" <? if($stx_establish_way == "3") echo "selected"; ?>>�������</option>
																<option value="4" <? if($stx_establish_way == "4") echo "selected"; ?>>��2����</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ֻ��纸�谡��</td>
														<td nowrap class="tdrow">
															<select name="stx_sj_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_sj_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_sj_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_sj_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������ä��</td>
														<td nowrap class="tdrow">
															<select name="stx_handicapped_employment" class="selectfm" onchange="">
																<option value=""  <? if($stx_handicapped_employment == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_handicapped_employment == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_handicapped_employment == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���翩��</td>
														<td nowrap class="tdrow">
															<select name="stx_disaster_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_disaster_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_disaster_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_disaster_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">â������</td>
														<td nowrap class="tdrow">
															<select name="stx_found_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_found_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_found_if == "1") echo "selected"; ?>>�ڱ����</option>
																<option value="2" <? if($stx_found_if == "2") echo "selected"; ?>>�Ӵ�</option>
																<option value="3" <? if($stx_found_if == "3") echo "selected"; ?>>��������</option>
																<option value="4" <? if($stx_found_if == "4") echo "selected"; ?>>��ȹ����</option>
																<option value="5" <? if($stx_found_if == "5") echo "selected"; ?>>������</option>
																<option value="6" <? if($stx_found_if == "6") echo "selected"; ?>>�̵��</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������������������</td>
														<td nowrap class="tdrow">
															<select name="stx_subsidy_type_if" class="selectfm" onchange="">
																<option value=""   <? if($stx_subsidy_type_if == "")   echo "selected"; ?>>��ü</option>
																<option value="1"  <? if($stx_subsidy_type_if == "1")  echo "selected"; ?>>�����������</option>
																<option value="2"  <? if($stx_subsidy_type_if == "2")  echo "selected"; ?>>������/SW</option>
																<option value="3"  <? if($stx_subsidy_type_if == "3")  echo "selected"; ?>>����������</option>
																<option value="4"  <? if($stx_subsidy_type_if == "4")  echo "selected"; ?>>LED����</option>
																<option value="5"  <? if($stx_subsidy_type_if == "5")  echo "selected"; ?>>�׸����۽ý���</option>
																<option value="6"  <? if($stx_subsidy_type_if == "6")  echo "selected"; ?>>�κ�����</option>
																<option value="7"  <? if($stx_subsidy_type_if == "7")  echo "selected"; ?>>�ż���,��������</option>
																<option value="8"  <? if($stx_subsidy_type_if == "8")  echo "selected"; ?>>IT����</option>
																<option value="9"  <? if($stx_subsidy_type_if == "9")  echo "selected"; ?>>���̿�,�ｺ�ɾ�</option>
																<option value="10" <? if($stx_subsidy_type_if == "10") echo "selected"; ?>>����</option>
																<option value="11" <? if($stx_subsidy_type_if == "11") echo "selected"; ?>>��ΰ���ǰ</option>
																<option value="12" <? if($stx_subsidy_type_if == "12") echo "selected"; ?>>ź������������</option>
																<option value="13" <? if($stx_subsidy_type_if == "13") echo "selected"; ?>>÷�ܱ׸�����</option>
																<option value="14" <? if($stx_subsidy_type_if == "14") echo "selected"; ?>>����ó��</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ڰ��������1000���̸�</td>
														<td nowrap class="tdrow">
															<select name="stx_factory_site_1000" class="selectfm" onchange="">
																<option value=""  <? if($stx_factory_site_1000 == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_factory_site_1000 == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_factory_site_1000 == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������ä��</td>
														<td nowrap class="tdrow">
															<select name="stx_women_matriarch_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_women_matriarch_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_women_matriarch_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_women_matriarch_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ϼ�</td>
														<td nowrap class="tdrow">
															<select name="stx_found_tax" class="selectfm" onchange="">
																<option value=""  <? if($stx_found_tax == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_found_tax == "1") echo "selected"; ?>>����</option>
																<option value="2" <? if($stx_found_tax == "2") echo "selected"; ?>>����</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڱ����ް�ȹ</td>
														<td nowrap class="tdrow">
															<select name="stx_disaster_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_disaster_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_disaster_if == "1") echo "selected"; ?>>�����ڱ�</option>
																<option value="2" <? if($stx_disaster_if == "2") echo "selected"; ?>>�ܺ��ڱ�</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���â������ȹ��</td>
														<td nowrap class="tdrow">
															<select name="stx_job_creation_proposal" class="selectfm" onchange="">
																<option value=""  <? if($stx_job_creation_proposal == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_job_creation_proposal == "1") echo "selected"; ?>>�����η�</option>
																<option value="2" <? if($stx_job_creation_proposal == "2") echo "selected"; ?>>���ȯ��</option>
																<option value="3" <? if($stx_job_creation_proposal == "3") echo "selected"; ?>>���ڸ��Բ�</option>
																<option value="4" <? if($stx_job_creation_proposal == "4") echo "selected"; ?>>�ð�������</option>
																<option value="5" <? if($stx_job_creation_proposal == "5") echo "selected"; ?>>��������</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ģ/�޿�����</td>
														<td nowrap class="tdrow">
															<select name="stx_rule_pay" class="selectfm" onchange="">
																<option value=""  <? if($stx_rule_pay == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_rule_pay == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_rule_pay == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������������</td>
														<td nowrap class="tdrow">
															<select name="stx_rural_areas" class="selectfm" onchange="">
																<option value=""  <? if($stx_rural_areas == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_rural_areas == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_rural_areas == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ӱ���ũ��</td>
														<td nowrap class="tdrow">
															<select name="stx_pay_peak_if" class="selectfm" onchange="">
																<option value=""   <? if($stx_pay_peak_if == "")  echo "selected"; ?>>��ü</option>
																<option value="1"  <? if($stx_pay_peak_if == "1") echo "selected"; ?>>YES</option>
																<option value="2"  <? if($stx_pay_peak_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ұ��</td>
														<td nowrap class="tdrow">
															<select name="stx_career_kind" class="selectfm" onchange="">
																<option value=""  <? if($stx_career_kind == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_career_kind == "1") echo "selected"; ?>>�����</option>
																<option value="2" <? if($stx_career_kind == "2") echo "selected"; ?>>����</option>
																<option value="3" <? if($stx_career_kind == "3") echo "selected"; ?>>�����</option>
																<option value="4" <? if($stx_career_kind == "4") echo "selected"; ?>>�ø����Ի�</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڰ�ȹ�⺻üũ����</td>
														<td nowrap class="tdrow">
															<select name="stx_fund_basic_check" class="selectfm" onchange="">
																<option value=""  <? if($stx_fund_basic_check == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_fund_basic_check == "1") echo "selected"; ?>>�ֱ�3�����</option>
																<option value="2" <? if($stx_fund_basic_check == "2") echo "selected"; ?>>�ſ���</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
														<td nowrap class="tdrow">
															<select name="stx_shift_system" class="selectfm" onchange="">
																<option value=""  <? if($stx_shift_system == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_shift_system == "1") echo "selected"; ?>>2����</option>
																<option value="2" <? if($stx_shift_system == "2") echo "selected"; ?>>3����</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���漼ü��</td>
														<td nowrap class="tdrow">
															<select name="stx_local_tax_yn" class="selectfm" onchange="">
																<option value=""  <? if($stx_local_tax_yn == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_local_tax_yn == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_local_tax_yn == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ٷΰ�༭</td>
														<td nowrap class="tdrow">
															<select name="stx_work_contract" class="selectfm" onchange="">
																<option value=""  <? if($stx_work_contract == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_work_contract == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_work_contract == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
														<td nowrap class="tdrow">
															<select name="stx_fund_kind" class="selectfm" onchange="">
																<option value=""  <? if($stx_fund_kind == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_fund_kind == "1") echo "selected"; ?>>��������</option>
																<option value="2" <? if($stx_fund_kind == "2") echo "selected"; ?>>����</option>
																<option value="3" <? if($stx_fund_kind == "3") echo "selected"; ?>>����</option>
																<option value="4" <? if($stx_fund_kind == "4") echo "selected"; ?>>��2����</option>
																<option value="5" <? if($stx_fund_kind == "5") echo "selected"; ?>>���ͱ��</option>
																<option value="6" <? if($stx_fund_kind == "6") echo "selected"; ?>>������</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���弳�������Ƿ�</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_request" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_request == "")  echo "selected"; ?>>��ü</option>
																<option value="1" <? if($stx_establish_request == "1") echo "selected"; ?>>���Ÿ�����м�</option>
																<option value="2" <? if($stx_establish_request == "2") echo "selected"; ?>>�����ȹ���ۼ�</option>
																<option value="3" <? if($stx_establish_request == "3") echo "selected"; ?>>���弳��</option>
																<option value="4" <? if($stx_establish_request == "4") echo "selected"; ?>>���弳�����ν�û</option>
																<option value="5" <? if($stx_establish_request == "5") echo "selected"; ?>>�����Ͻ�û</option>
															</select>
														</td>
														<td nowrap class="tdrowk"></td>
														<td nowrap class="tdrow">
														</td>
													</tr>
												</table>
