	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="addr2" value="<?=$row2[w_juso2]?> " />
	<input type="hidden" name="cel" value="<?=$row2[emp_cel]?> " title="�ڵ�����ȣ" />
	<input type="hidden" name="tel" value="<?=$row1[add_tel]?> " title="�����ȭ" />
	<input type="hidden" name="email" value="<?=$row2[emp_email]?> " title="EMAIL" />

	<input type="hidden" name="bank_1" value="" title="�����" />
	<input type="hidden" name="bank_2" value="" title="���¹�ȣ" />
	<input type="hidden" name="bank_3" value="" title="������" />
	<input type="hidden" name="jdate" value="<?=$in_day?>" title="�Ի���" />
	<input type="hidden" name="edate" value="<?=$out_day?>" title="������" />
	<input type="hidden" name="job_div" value="<?=$work_form?>" />
	<input type="hidden" name="work_form" value="<?=$row1[work_form]?>" />
<?
//���Ⱓ
$contract_sdate = str_replace(".","-",$row2[contract_sdate]);
$contract_edate = str_replace(".","-",$row2[contract_edate]);
//�޿�ü��
if($row2[pay_gbn] == "0") $pay_gbn = "������";
else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
else if($row2[pay_gbn] == "3") $pay_gbn = "������";
//�󿩱�
$bonus_percent = $row3[bonus_percent];
$bonus_standard_array = array("","�⺻��","�����ӱ�","����ӱ�","�ѱ޿�");
$bonus_standard = " ";
for($i=0;$i<=count($bonus_standard_array);$i++) {
	if($row3[bonus_standard] == $i) $bonus_standard = $bonus_standard_array[$i];
}
$bonus_array = explode(",",$row3[bonus_p]);
$bonus_time = 0;
for($i=0;$i<=count($bonus_array);$i++) {
	if($bonus_array[$i] != "") $bonus_time++;
}
if($bonus_percent == "0") {
	$bonus1 = "��";
	$bonus2 = " ";
	$bonus3 = " ";
} else {
	$bonus1 = " ";
	$bonus2 = "��";
	if($row3[check_bonus_money_yn] == "Y") $bonus_standard = number_format($row3[bonus_money])."��";
	$bonus3 = $bonus_standard." * ".$bonus_percent."% (".$bonus_time.")ȸ ����";
}
//�ްԽð�2(���ɽð�)
/*
if($row_a4_opt[rest2]) $rest2 = $row_a4_opt[rest2]."~".$row_a4_opt[rest2e];
else $rest2 = "����";
*/
if($contract_sdate) {
	$contract_sdate_text = date("Y�� m�� d��",strtotime($contract_sdate));
} else {
	$contract_sdate_text = "";
}
if($contract_edate) {
	$contract_edate_text = date("Y�� m�� d��",strtotime($contract_edate));
} else {
	$contract_edate_text = "";
}
?>
	<input type="hidden" name="contract_sdate" value="<?=$contract_sdate_text?>" />
	<input type="hidden" name="contract_edate" value="<?=$contract_edate_text?>" />

	<input type="hidden" name="employee_id" value="10150011" title="���" />
	<input type="hidden" name="dept" value="������" title="�μ�" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?>" title="����" />

	<input type="hidden" name="jogun" value="40" />
	<input type="hidden" name="wtime" value="10:00" />
<?
//�ְ��ٹ��ð�
$sql_a4_work_time = " select * from a4_work_time where com_code = '$com_code' ";
$row_a4_work_time = sql_fetch($sql_a4_work_time);
//�ٹ��ð�
$work_shour = explode(",",$row_a4_work_time[work_shour]);
$work_smin  = explode(",",$row_a4_work_time[work_smin]);
if($work_smin[0] == "0" || $work_smin[0] == "") $work_smin[0] = "00";
$stime = $work_shour[0].":".$work_smin[0];
$work_ehour = explode(",",$row_a4_work_time[work_ehour]);
$work_emin  = explode(",",$row_a4_work_time[work_emin]);
if($work_emin[0] == "0" || $work_emin[0] == "") $work_emin[0] = "00";
$etime = $work_ehour[0].":".$work_emin[0];
//�ްԽð�
$rest_shour = explode(",",$row_a4_work_time[rest_shour]);
$rest_smin  = explode(",",$row_a4_work_time[rest_smin]);
if($rest_shour[0] != "") {
	if($rest_smin[0] == "0" || $rest_smin[0] == "") $rest_smin[0] = "00";
	$rest_ehour = explode(",",$row_a4_work_time[rest_ehour]);
	$rest_emin  = explode(",",$row_a4_work_time[rest_emin]);
	if($rest_emin[0] == "0" || $rest_emin[0] == "") $rest_emin[0] = "00";
	$rest2 = $rest_shour[0].":".$rest_smin[0]."~".$rest_ehour[0].":".$rest_emin[0];
} else {
	$rest2 = "����";
}
//�ްԽð�2
$rest_shour = explode(",",$row_a4_work_time[rest_shour2]);
$rest_smin  = explode(",",$row_a4_work_time[rest_smin2]);
if($rest_shour[0] != "") {
	if($rest_smin[0] == "0" || $rest_smin[0] == "") $rest_smin[0] = "00";
	$rest_ehour = explode(",",$row_a4_work_time[rest_ehour2]);
	$rest_emin  = explode(",",$row_a4_work_time[rest_emin2]);
	if($rest_emin[0] == "0" || $rest_emin[0] == "") $rest_emin[0] = "00";
	$rest2 .= " / �ް�2 : ". $rest_shour[0].":".$rest_smin[0]."~".$rest_ehour[0].":".$rest_emin[0];
}
//�ްԽð�3
$rest_shour = explode(",",$row_a4_work_time[rest_shour3]);
$rest_smin  = explode(",",$row_a4_work_time[rest_smin3]);
if($rest_shour[0] != "") {
	if($rest_smin[0] == "0" || $rest_smin[0] == "") $rest_smin[0] = "00";
	$rest_ehour = explode(",",$row_a4_work_time[rest_ehour3]);
	$rest_emin  = explode(",",$row_a4_work_time[rest_emin3]);
	if($rest_emin[0] == "0" || $rest_emin[0] == "") $rest_emin[0] = "00";
	$rest2 .= " / �ް�3 : ". $rest_shour[0].":".$rest_smin[0]."~".$rest_ehour[0].":".$rest_emin[0];
}
//����ٹ�
$ext_shour = explode(",",$row_a4_work_time[ext_shour]);
$ext_smin  = explode(",",$row_a4_work_time[ext_smin]);
if($ext_shour[0] != "") {
	if($ext_smin[0] == "0" || $ext_smin[0] == "") $ext_smin[0] = "00";
	$ext_ehour = explode(",",$row_a4_work_time[ext_ehour]);
	$ext_emin  = explode(",",$row_a4_work_time[ext_emin]);
	if($ext_emin[0] == "0" || $ext_emin[0] == "") $ext_emin[0] = "00";
	$ext_time = $ext_shour[0].":".$ext_smin[0]." ~ ".$ext_ehour[0].":".$ext_emin[0];
} else {
	//û�����ǿ� ����ٹ� ����
	if($code == "20247") $ext_time = "������ ���� �Ǵ� Ư���� �������� �ʿ��� ��쿡�� ����ڰ��� ���ǿ� ���Ͽ� 1���Ͽ� 12�ð�(�� 52�ð�) �ѵ��� ����ٷ� �� �� �ִ�.";
	else $ext_time = "����";
}
//����� �ٹ�����
$work_shour = explode(",",$row_a4_work_time[work_shour]);
$work_smin  = explode(",",$row_a4_work_time[work_smin]);
if($work_shour[5] != "") {
	if($work_smin[5] == "0" || $work_smin[5] == "") $work_smin[5] = "00";
	$work_ehour = explode(",",$row_a4_work_time[work_ehour]);
	$work_emin  = explode(",",$row_a4_work_time[work_emin]);
	if($work_emin[5] == "0" || $work_emin[5] == "") $work_emin[5] = "00";
	$saturday_time = "(".$work_shour[5].":".$work_smin[5]."~".$work_ehour[5].":".$work_emin[5].")";
	$saturday1 = " ";
	$saturday2 = "��";
} else {
	$saturday_time = " ";
	$saturday1 = "��";
	$saturday2 = " ";
}
//���޹��
if($row_a4_opt[pay_payment] == "1") $payment1 = "��";
else $payment1 = " ";
if($row_a4_opt[pay_payment] == "2") $payment2 = "��";
else $payment2 = " ";
//������ : �ٷΰ�༭ �߰� 160822
$retirement_gbn_array = explode(",",$row_a4_opt[retirement_gbn]);
if($retirement_gbn_array[0] == "1") $retirement_gbn_text[1] = "����������";
if($retirement_gbn_array[1] == "1") $retirement_gbn_text[2] = "��������";
if($retirement_gbn_array[2] == "1") $retirement_gbn_text[3] = "�������߰�����";
for($i=1;$i<4;$i++) {
	$retirement_gbn .= $retirement_gbn_text[$i];
	if($retirement_gbn_text[$i]) {
		$retirement_gbn .= ". ";
	}
}
if($retirement_gbn == "") $retirement_gbn = " ";
//��������
if($row_a4_opt[retirement_annuity] == "") {
	$retirement_annuity = " ";
} else {
	$retirement_annuity = $row_a4_opt[retirement_annuity];
}
?>
	<input type="hidden" name="workhour_40" value="��" />
	<input type="hidden" name="workhour_44" value=" " />
	<input type="hidden" name="stime" value="<?=$stime?>" />
	<input type="hidden" name="etime" value="<?=$etime?>" />
	<input type="hidden" name="rest2" value="<?=$rest2?>" />
	<input type="hidden" name="ext_time" value="<?=$ext_time?>" />

	<input type="hidden" name="saturday1" value="<?=$saturday1?>" title="����ϱٹ�����" />
	<input type="hidden" name="saturday2" value="<?=$saturday2?>" title="����ϱٹ�����" />
	<input type="hidden" name="saturday_time" value="<?=$saturday_time?>" />
	<input type="hidden" name="workday1" value="��" />
	<input type="hidden" name="workday2" value="��" />
	<input type="hidden" name="workday3" value="5" />

	<input type="hidden" name="pay_gbn_txt" value="<?=$pay_gbn?>" title="�޿�ü��"/>
	<input type="hidden" name="time_chk" value="��" title="�ñ�"/>
	<input type="hidden" name="day_chk" value=" " title="�ϱ�"/>
	<input type="hidden" name="timegub" value="<?=number_format($row3[money_hour_ts])?>" title="�ð���"/>
	<input type="hidden" name="calculate1" value="<?=$row_a4_opt[pay_calculate_day_period1]?>" title="����1"/>
	<input type="hidden" name="calculate2" value="<?=$row_a4_opt[pay_calculate_day_period2]?>" title="����2"/>
	<input type="hidden" name="pay_day" value=" <?=$row_a4_opt[pay_day]?>" /><!--�޿�������-->
	<input type="hidden" name="payment1" value="<?=$payment1?>" title="��������"/>
	<input type="hidden" name="payment2" value="<?=$payment2?>" title="�Ա�"/>

	<input type="hidden" name="hday" value="<?=$row_a4_opt[hday]?>" title="������" />
	<input type="hidden" name="bonus1" value="<?=$bonus1?>" title="�󿩱�1"/>
	<input type="hidden" name="bonus2" value="<?=$bonus2?>" title="�󿩱�2"/>
	<input type="hidden" name="bonus3" value="<?=$bonus3?>" title="�󿩱�3"/>
	<input type="hidden" name="bonus_standard" value=" <?=$bonus_standard?>" title="��������"/>
	<input type="hidden" name="bonus_percent" value=" <?=$bonus_percent?>%" title="�󿩺���"/>
	<input type="hidden" name="bonus_time" value="<?=$bonus_time?>" title="ȸ"/>

	<input type="hidden" name="pay1" value="<?=number_format($row3[money_hour_ms])?>" />
	<input type="hidden" name="pay2" value="<?=number_format($row3[money_g1]+$row3[money_g2]+$row3[money_g3]+$row3[money_g4]+$row3[money_g5])?>" /><!--����ӱݼ���-->
	<input type="hidden" name="pay3" value="<?=number_format($row3[money_b1]+$row3[money_b2]+$row3[money_b3])?>" /><!--��������-->
	<input type="hidden" name="pay4" value="<?=number_format($row3[money_e1]+$row3[money_e2]+$row3[money_e3]+$row3[money_e4]+$row3[money_e5]+$row3[money_e6]+$row3[money_e7]+$row3[money_e8])?>" /><!--��Ÿ����-->
	<input type="hidden" name="pay_car" value="<?=number_format($row3[money_e1])?>" />
	<input type="hidden" name="pay_board" value="<?=number_format($row3[money_e2])?>" />
	<input type="hidden" name="pay_child_care" value="<?=number_format($row3[money_e3])?>" />
	<input type="hidden" name="pay_e5" value="<?=number_format($row3[money_e5])?>" />
	<input type="hidden" name="pay_e6" value="<?=number_format($row3[money_e6])?>" />
	<input type="hidden" name="pay5" value="<?=number_format($row3[money_month_base])?>" /><!--�����Ѿ�(�޿������Ѿ�+���������Ѿ�)-->
	<input type="hidden" name="annual_salary" value="<?=number_format($row3[money_month_base]*12)?>" /><!--�����Ѿ�-->
	<input type="hidden" name="jikjong" value="<?=$row2[jikjong]?> " /><!--����-->
	<input type="hidden" name="retirement_gbn" value="<?=$retirement_gbn?>" title="������" />
	<input type="hidden" name="retirement_annuity" value="<?=$retirement_annuity?>" title="��������" />
