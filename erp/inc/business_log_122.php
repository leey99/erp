								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														������������
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="50">����</td>
										<td class="tdhead_center" width="68">�̼���</td>
										<td class="tdhead_center" width="68">��ȸ�Ұ�</td>
										<td class="tdhead_center" width="68">�����ȸ</td>
										<td class="tdhead_center" width="68">�������</td>
										<td class="tdhead_center" width="68">���Ϸ�</td>
										<td class="tdhead_center" width="68">��������</td>
										<td class="tdhead_center" width="68">����Ұ�</td>
										<td class="tdhead_center" width="68">����</td>
										<td class="tdhead_center" width="68">����Ϸ�</td>
										<td class="tdhead_center" width="68">�ǻ�Ϸ�</td>
										<td class="tdhead_center" width="68">�����Ϸ�</td>
										<td class="tdhead_center">�հ�</td>
									</tr>
<?
//���� �ʱ�ȭ
$count_electric_sum = 0;
for($i=0; $i<=11; $i++) {
	$count_electric[$i] = 0;
}
//������
$sql_electric = " select * from com_list_gy a, com_list_gy_opt b where  a.com_code=b.com_code and (b.manage_cust_numb='$drafter_code' and a.damdang_code='1') and a.electric_charges_no!='' ";
$result_electric = sql_query($sql_electric);
for($i=0; $row_electric=mysql_fetch_assoc($result_electric); $i++) {
	//�̼���
	if($row_electric['electric_charges_process'] == "") {
		$count_electric[1] ++;
	//��ȸ�Ұ�
	} else if($row_electric['electric_charges_process'] == 1) {
		$count_electric[2] ++;
	//�����ȸ
	} else if($row_electric['electric_charges_process'] == 2) {
		$count_electric[3] ++;
	//�������
	} else if($row_electric['electric_charges_process'] == 3) {
		$count_electric[4] ++;
	//��������
	} else if($row_electric['electric_charges_process'] == 4) {
		$count_electric[5] ++;
	//����Ұ�
	} else if($row_electric['electric_charges_process'] == 5) {
		$count_electric[6] ++;
	//����
	} else if($row_electric['electric_charges_process'] == 6) {
		$count_electric[7] ++;
	//����Ϸ�
	} else if($row_electric['electric_charges_process'] == 7) {
		$count_electric[8] ++;
	//�ǻ�Ϸ�
	} else if($row_electric['electric_charges_process'] == 8) {
		$count_electric[9] ++;
	//�����Ϸ�
	} else if($row_electric['electric_charges_process'] == 9) {
		$count_electric[10] ++;
	//���Ϸ�
	} else {
		if($row_electric['electric_charges_process'] == 10) $count_electric[11] ++;
	}
}
//�հ�
for($i=1;$i<=count($count_electric);$i++) {
	$count_electric_sum += $count_electric[$i];
}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">��ü</td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=no" target="_blank"><?=$count_electric[1]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=1" target="_blank"><?=$count_electric[2]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=2" target="_blank"><?=$count_electric[3]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=3" target="_blank"><?=$count_electric[4]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=10" target="_blank"><?=$count_electric[11]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=4" target="_blank"><?=$count_electric[5]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=5" target="_blank"><?=$count_electric[6]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=6" target="_blank"><?=$count_electric[7]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=7" target="_blank"><?=$count_electric[8]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=8" target="_blank"><?=$count_electric[9]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=9" target="_blank"><?=$count_electric[10]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_electric_sum?></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														�ŷ�ó ��Ȳ
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="50">����</td>
										<td class="tdhead_center" width="68">������</td>
										<td class="tdhead_center" width="68">�ű԰��</td>
										<td class="tdhead_center" width="68">�ټ����</td>
										<td class="tdhead_center" width="68">��������</td>
										<td class="tdhead_center" width="68">��������</td>
										<td class="tdhead_center" width="68">�ð�����</td>
										<td class="tdhead_center" width="68">��������</td>
										<td class="tdhead_center" width="68">�������</td>
										<td class="tdhead_center" width="68">��ü�η�</td>
										<td class="tdhead_center" width="68">��������</td>
										<td class="tdhead_center" width="68">��Ÿ</td>
										<td class="tdhead_center">�հ�</td>
									</tr>
<?
//���� �ʱ�ȭ
$count_total_today_sum = 0;
$count_total_sum = 0;
for($i=0; $i<=11; $i++) {
	$count_total_today[$i] = 0;
	$count_total[$i] = 0;
}
//��¥ ���� ����
$subject_date_arry = explode(".", $subject_date);
$subject_date_transform = $subject_date_arry[0]."-".$subject_date_arry[1]."-".$subject_date_arry[2];
//������
$sql_electric = " select count(*) as cnt from com_list_gy a, com_list_gy_opt b where  a.com_code=b.com_code and (b.manage_cust_numb='$drafter_code') and a.electric_charges_no!='' ";
$row_electric = sql_fetch($sql_electric);
$count_total[1] = $row_electric['cnt'];
//�ű԰��
$sql_employment = " select count(distinct c.com_code) as cnt from com_list_gy a, com_list_gy_opt b, com_employment c, com_list_gy_opt2 d where a.com_code=b.com_code and a.com_code=c.com_code and a.com_code=d.com_code and c.delete_yn!='1' and (b.manage_cust_numb='$drafter_code') ";
$row_employment = sql_fetch($sql_employment);
$count_total[2] = $row_employment['cnt'];
//��������ȲDB : 60���ټ����, ���������ȯ��, ����������Ӱ��, �ð����������ڸ�, ��������, �������, ��ü�η�������, �������������, ��Ÿ
$sql_application = " select * from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and b.manage_cust_numb='$drafter_code' order by c.application_accept desc ";
$result_application = sql_query($sql_application);
for($i=0; $row_application=mysql_fetch_assoc($result_application); $i++) {
	//���� ������ ���
	if(strpos($row_application['w_date'], $subject_date_transform)) {
		 //���� �հ�
		$count_total_today_sum ++;
		//�ټ����
		if($row_application['application_kind'] == 2) {
			$count_total_today[3] ++;
		//��������
		} else if($row_application['application_kind'] == 16) {
			$count_total_today[4] ++;
		//��������
		} else if($row_application['application_kind'] == 3) {
			$count_total_today[5] ++;
		//�ð�����
		} else if($row_application['application_kind'] == 9) {
			$count_total_today[6] ++;
		//��������
		} else if($row_application['application_kind'] == 20) {
			$count_total_today[7] ++;
		//�������
		} else if($row_application['application_kind'] == 7) {
			$count_total_today[8] ++;
		//��ü�η�
		} else if($row_application['application_kind'] == 25) {
			$count_total_today[9] ++;
		//��������
		} else if($row_application['application_kind'] == 24) {
			$count_total_today[10] ++;
		//��Ÿ
		} else {
			//������������ ������ ����
			if($row_application['application_kind'] != 23) $count_total_today[11] ++;
		}
	}
	//�ټ����
	if($row_application['application_kind'] == 2) {
		$count_total[3] ++;
	//��������
	} else if($row_application['application_kind'] == 16) {
		$count_total[4] ++;
	//��������
	} else if($row_application['application_kind'] == 3) {
		$count_total[5] ++;
	//�ð�����
	} else if($row_application['application_kind'] == 9) {
		$count_total[6] ++;
	//��������
	} else if($row_application['application_kind'] == 20) {
		$count_total[7] ++;
	//�������
	} else if($row_application['application_kind'] == 7) {
		$count_total[8] ++;
	//��ü�η�
	} else if($row_application['application_kind'] == 25) {
		$count_total[9] ++;
	//��������
	} else if($row_application['application_kind'] == 24) {
		$count_total[10] ++;
	//��Ÿ
	} else {
		if($row_application['application_kind'] != 23) $count_total[11] ++;
	}
}
//�հ�
for($i=1;$i<=count($count_total);$i++) {
	$count_total_sum += $count_total[$i];
}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">����</td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[1]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[2]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[3]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[4]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[5]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[6]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[7]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[8]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[9]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[10]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[11]?></td>
										<td class="ltrow1_right_h22_padding" style=""><?=$count_total_today_sum?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">��ü</td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>" target="_blank"><?=$count_total[1]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="acceleration_employment.php?stx_manage_name=<?=$drafter_name?>" target="_blank"><?=$count_total[2]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=2" target="_blank"><?=$count_total[3]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=16" target="_blank"><?=$count_total[4]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=3" target="_blank"><?=$count_total[5]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=9" target="_blank"><?=$count_total[6]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=20" target="_blank"><?=$count_total[7]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=7" target="_blank"><?=$count_total[8]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=25" target="_blank"><?=$count_total[9]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=24" target="_blank"><?=$count_total[10]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>" target="_blank"><?=$count_total[11]?></a></td>
										<td class="ltrow1_right_h22_padding" style=""><?=$count_total_sum?></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>