<?
//��� ����� ǥ�� 150923
//if($member['mb_level'] > 6) {
	if($title_main_no == "01") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_process_list.php'"><div style="margin:8px 0 0 0;">����ó����Ȳ</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_list.php'"><div style="padding:8px 0 0 0">�ŷ�ó����</div></div>
<?
		//if($member['mb_level'] > 6) {
		//6���� -> 7������� �ʰ� ����, ���� ������ ���� 160824
		if($member['mb_level'] > 7) {
?>
							<!--<a href="client_memo.php">�ŷ�ó�湮/����</a>-->
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_sms_list.php'"><div style="padding:8px 0 0 0">���ڸ޼����߼�</div></div>
<?
		} else {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_search.php'"><div style="padding:8px 0 0 0">�ŷ�ó�˻�</div></div>
<?
		}
	} else if($title_main_no == "02") {
?>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_application_list.php'"><div style="padding:8px 0 0 0">��������Ȳ</div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_reapplication.php'"><div style="padding:8px 0 0 0">���û��Ȳ</div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='unpaid_balance.php'"><div style="padding:8px 0 0 0">�̼�����Ȳ</div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='app_family_insurance_list.php'"><div style="padding:8px 0 0 0">���������</div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_application_cycle.php'"><div style="padding:8px 0 0 0">��û�ֱ�</div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="support_person_list.php" class="white">�������</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="acceleration_employment.php" class="white">�ű԰��</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="reduction_prevention.php" class="white">��������</a></div></div>
							<div style="width:90px; height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="job_time_list.php" class="white">���â��</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='reduction_application.php'"><div style="padding:8px 0 0 0">��������2</div></div>
<?
	} else if($title_main_no == "03") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_list.php'"><div style="padding:8px 0 0 0">�����Ȳ</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_report.php'"><div style="padding:8px 0 0 0">��꺸��</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_sales.php'"><div style="padding:8px 0 0 0">��������</div></div>
<?
		//���縸 ǥ�� 160405
		if($member['mb_level'] > 6) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_pay.php'"><div style="padding:8px 0 0 0">�޿�����</div></div>

<?
		} else {
			//������, ������� ���� 160509
			if($member['mb_level'] == 6) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_pay_branch.php'"><div style="padding:8px 0 0 0">�޿�����</div></div>
<?
			}
		}
	} else if($title_main_no == "05") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='samu_list.php'"><div style="padding:8px 0 0 0">�繫��Ź��Ȳ</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='samu_insure_list.php'"><div style="padding:8px 0 0 0">�Ǻ����ڽŰ�</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='total_pay_list.php'"><div style="padding:8px 0 0 0">�����Ѿ׽Ű�</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='total_insure_list.php'"><div style="padding:8px 0 0 0">�����Ű�</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='accountant_list.php'"><div style="padding:8px 0 0 0">ȸ��繫��</div></div>
<?
	} else if($title_main_no == "10") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_notice'"><div style="padding:8px 0 0 0">��������</div></div>
<?
		//���縸 ǥ�� 160126
		if($member['mb_level'] > 6) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_dealer'"><div style="padding:8px 0 0 0">����(������)</div></div>
<?
		}
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_event'"><div style="padding:8px 0 0 0">�ֿ�����</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_online'"><div style="padding:8px 0 0 0">Q&amp;A</div></div>
<?
	} else if($title_main_no == "18") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_kidsnomu_list.php'"><div style="padding:8px 0 0 0">Ű��빫</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_program_list.php'"><div style="padding:8px 0 0 0">�����빫</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_construction_list.php'"><div style="padding:8px 0 0 0">�Ǽ�������</div></div>
<?
	} else if($title_main_no == "19") {
?>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="electric_charges_list.php" class="white">������</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="job_invent_recompense.php" class="white">�����߸�</a></div></div>
<?
//���� ���� �Ұ� �豹�� ���� �ǰ� 161019
if($member['mb_level'] > 6) {
?>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="si4n_nhis_list.php" class="white">4�뺸��</a></div></div>
<?
}
?>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="kepco_dsm_list.php" class="white">�������</a></div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="job_education_list.php" class="white">������Ʒ�</a></div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="danger_evaluate_list.php" class="white">���輺��</a></div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="family_insurance_list.php" class="white">���������</a></div></div>
							<div style="width:90px; height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="policy_fund_list.php" class="white">��å�ڱ�</a></div></div>
							<div style="width:90px; height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="employment_agency.php" class="white">�η°���</a></div></div>
<?
	} else if($title_main_no == "20") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_schedule'"><div style="padding:8px 0 0 0">�����ٰ���</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='schedule_view.php'"><div style="padding:8px 0 0 0">�湮�����ٵ��</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_job_education'"><div style="padding:8px 0 0 0">������Ʒð���</div></div>
<?
	} else if($title_main_no == "21") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_pds.php?bo_table=erp_pds'"><div style="padding:8px 0 0 0">�����ڷ��</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_pds.php?bo_table=erp_pds2'"><div style="padding:8px 0 0 0">�����ڷ��</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_pds.php?bo_table=erp_pds3'"><div style="padding:8px 0 0 0">�����ڷ��</div></div>
<?
	} else if($title_main_no == "07") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='groupware_business_log.php'"><div style="padding:8px 0 0 0">���ڰ���</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='groupware_pay_stubs.php'"><div style="padding:8px 0 0 0">�޿���</div></div>
<?
		//������� ���� 160823
		if($member['mb_level'] != 7) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_punctuality'"><div style="padding:8px 0 0 0">���°���</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='groupware_attendance.php'"><div style="padding:8px 0 0 0">��ٺ�</div></div>
<?
			//������, ��ǥ, ����, ����, ȸ�� ����� 161205
			if($member['mb_id'] == "master" || $member['mb_id'] == "kcmc1001" || $member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1008") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='address_book.php'"><div style="padding:8px 0 0 0">�ּҷ�</div></div>
<?
			}
		}
	}
//}
?>