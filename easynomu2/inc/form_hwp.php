	<!--mb_name ������-->
	<input type="hidden" name="mb_name" value="<?=$row_a4['com_name']?>" />
	<!--���뺯��-->
<?
$comp_type = $row_a4['class_gubun'];
if($comp_type != "D") $comp_type = "A";
//$comp_type = "A";
//������� ���� : û�����ǿ�
if($com_code == "20247") {
	$approval1 = "���";
	$approval2 = "����";
	$approval3 = "����";
} else {
	$approval1 = "����";
	$approval2 = "�̻�";
	$approval3 = "��ǥ";
}
?>
	<input type="hidden" name="comp_type" value="<?=$comp_type?>" title="���������"/>
	<input type="hidden" name="comp_num" value="<?=$row_a4['biz_no']?> " title="����ڵ�Ϲ�ȣ" />
	<input type="hidden" name="bupin_no" value="<?=$row_a4['bupin_no']?> " title="���ε�Ϲ�ȣ" />
	<input type="hidden" name="comp_name" value="<?=$row_a4['com_name']?>" title="������" />
	<input type="hidden" name="comp_ceo" value="<?=$row_a4['boss_name']?> " title="��ǥ�ڸ�" />
	<input type="hidden" name="comp_jumin" value="<?=$row_a4['jumin_no']?> " title="��ǥ���ֹι�ȣ" />
	<input type="hidden" name="comp_upte" value="<?=$row_a4['uptae']?> " title="����" />
	<input type="hidden" name="comp_jongmok" value="<?=$row_a4['upjong']?> " title="����" />
	<input type="hidden" name="comp_tel" value="<?=$row_a4['com_tel']?> " title="�������ȭ" />
	<input type="hidden" name="comp_fax" value="<?=$row_a4['com_fax']?> " title="������ѽ�" />
	<input type="hidden" name="comp_cel" value="<?=$row_a4['boss_hp']?> " title="��ǥ���ڵ���" />
	<input type="hidden" name="comp_email" value="<?=$row_a4_opt['boss_mail']?> " title="��ǥ��email" />
	<input type="hidden" name="comp_addr1" value="<?=$row_a4['com_juso']?>" title="������ּ�1" />
	<input type="hidden" name="comp_addr2" value="<?=$row_a4['com_juso2']?> " title="������ּ�2" />
	<input type="hidden" name="today" value="<?=date("Y�� m�� d��")?>" title="���ó�¥"/>
	<input type="hidden" name="yy" value="<?=$search_year?>" title="�⵵"/>
	<input type="hidden" name="ceo_jik" value="��ǥ"/>
	<!--�������-->
	<input type="hidden" name="approval1" value="<?=$approval1?>" />
	<input type="hidden" name="approval2" value="<?=$approval2?>" />
	<input type="hidden" name="approval3" value="<?=$approval3?>" />
<?
//echo $labor;
if($labor == "labor1") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
	$result1 = sql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$sabun' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//echo $sql2;
	//����ó
	if(!$row1[add_tel]) {
		$tel_cel = $row2[emp_cel];
	} else {
		$tel_cel = $row1[add_tel];
	}
	//�Ի���
	if($row1[in_day] == "") {
		//������ ���� �� ���� ó��
		$in_day = " ";
	} else {
		$in_day_array = explode(".",$row1[in_day]);
		$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
	}
	//������
	//echo "a".$row1[out_day]."b";
	if($row1[out_day] == "") {
		$out_day = " �� �� ��";
	} else {
		$out_day_array = explode(".",$row1[out_day]);
		$out_day = $out_day_array[0]."�� ".$out_day_array[1]."�� ".$out_day_array[2]."��";
	}
	//ä������
	if($row1[work_form] == "") $work_form = "";
	else if($row1[work_form] == "1") $work_form = "������";
	else if($row1[work_form] == "2") $work_form = "�����";
	else if($row1[work_form] == "3") $work_form = "�Ͽ���";

	//include �ٷΰ�༭
	include "work_contract_inc.php";

} else if($labor == "pay_table") {
	$sql_pay = " select * from pibohum_base_pay where com_code='$code' and sabun='$id' and year = '$search_year' and month = '$search_month' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay=mysql_fetch_array($result_pay);
	//����ӱ�
	$sql_g = " select * from com_paycode_list where com_code = '$code' and item='trade' ";
	//echo $sql_g;
	$result_g = sql_query($sql_g);
	for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
		$g_code = $row_g[code];
		$money_g_txt[$g_code] = $row_g[name];
		//echo $g_code;
	}
	//��Ÿ����
	$sql_e = " select * from com_paycode_list where com_code = '$code' and item='privilege' ";
	$result_e = sql_query($sql_e);
	for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
		$e_code = $row_e[code];
		$money_e_txt[$e_code] = $row_e[name];
	}
?>
									<!-- �޿����� -->
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>
									<input type="hidden" name="pay_name" value="<?=$row1[name]?>"/>
									<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
									<input type="hidden" name="jdate" value="<?=$in_day?>"/>

									<input type="hidden" name="money_time" value="<?=number_format($row_pay[money_time])?>" title="���ñ�" />
									<input type="hidden" name="basic_pay" value="<?=number_format($row_pay[money_month])?>" title="�⺻�޿�" />
									<input type="hidden" name="money_total" value="<?=number_format($row_pay[money_total])?>" title="�޿��Ѿ�" />
									<input type="hidden" name="rtotal" value="<?=number_format($row_pay[money_result])?>" title="�����Ѿ�" />

									<input type="hidden" name="yun" value="<?=number_format($row_pay[yun])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row_pay[goyong])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row_pay[health])?>"/>
									<input type="hidden" name="hi2" value="<?=number_format($row_pay[yoyang])?>"/>
									<input type="hidden" name="tax_so" value="<?=number_format($row_pay[tax_so])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row_pay[tax_jumin])?>"/>

									<input type="hidden" name="minus1_text" value="���°���"/>
									<input type="hidden" name="minus2_text" value="����"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="0"/>
									<input type="hidden" name="minus2" value="0"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
									<input type="hidden" name="minus" value="<?=number_format($row_pay[money_gongje])?>" title="�����հ�" />

									<input type="hidden" name="g1_text" value="<?=$money_g_txt['g1']?>"/>
									<input type="hidden" name="g2_text" value="<?=$money_g_txt['g2']?>"/>
									<input type="hidden" name="g3_text" value="<?=$money_g_txt['g3']?>"/>
									<input type="hidden" name="g4_text" value="<?=$money_g_txt['g4']?>"/>
									<input type="hidden" name="g5_text" value="<?=$money_g_txt['g5']?>"/>
									<input type="hidden" name="g6_text" value="-"/>
									<input type="hidden" name="g7_text" value="-"/>

									<input type="hidden" name="g1" value="<?=number_format($row_pay[g1])?>"/>
									<input type="hidden" name="g2" value="<?=number_format($row_pay[g2])?>"/>
									<input type="hidden" name="g3" value="<?=number_format($row_pay[g3])?>"/>
									<input type="hidden" name="g4" value="<?=number_format($row_pay[g4])?>"/>
									<input type="hidden" name="g5" value="<?=number_format($row_pay[g5])?>"/>
									<input type="hidden" name="g6" value="-"/>
									<input type="hidden" name="g7" value="-"/>
									<input type="hidden" name="g_sum" value="<?=number_format($row_pay[g1]+$row_pay[g2]+$row_pay[g3]+$row_pay[g4]+$row_pay[g5])?>"/>

									<input type="hidden" name="b1" value="<?=number_format($row_pay[ext])?>"/>
									<input type="hidden" name="b2" value="<?=number_format($row_pay[night])?>"/>
									<input type="hidden" name="b3" value="<?=number_format($row_pay[hday])?>"/>
									<input type="hidden" name="b4" value="<?=number_format($row_pay[ext_add])?>"/>
									<input type="hidden" name="b5" value="<?=number_format($row_pay[night_add])?>"/>
									<input type="hidden" name="b6" value="<?=number_format($row_pay[hday_add])?>"/>
									<input type="hidden" name="b7" value="<?=number_format($row_pay[annual_paid_holiday])?>"/>
									<input type="hidden" name="b_sum" value="<?=number_format($row_pay[ext]+$row_pay[night]+$row_pay[hday]+$row_pay[ext_add]+$row_pay[night_add]+$row_pay[hday_add]+$row_pay[annual_paid_holiday])?>"/>

									<input type="hidden" name="e1_text" value="<?=$money_e_txt['e1']?>"/>
									<input type="hidden" name="e2_text" value="<?=$money_e_txt['e2']?>"/>
									<input type="hidden" name="e3_text" value="<?=$money_e_txt['e3']?>"/>
									<input type="hidden" name="e4_text" value="<?=$money_e_txt['e4']?>"/>
									<input type="hidden" name="e5_text" value="<?=$money_e_txt['e5']?>"/>
									<input type="hidden" name="e6_text" value="<?=$money_e_txt['e6']?>"/>
									<input type="hidden" name="e7_text" value="<?=$money_e_txt['e7']?>"/>
									<input type="hidden" name="e8_text" value="<?=$money_e_txt['e8']?>"/>
									<input type="hidden" name="e9_text" value="-"/>
									<input type="hidden" name="e10_text" value="-"/>
									<input type="hidden" name="e11_text" value="-"/>
									<input type="hidden" name="e1" value="<?=number_format($row_pay[b1])?>"/>
									<input type="hidden" name="e2" value="<?=number_format($row_pay[b2])?>"/>
									<input type="hidden" name="e3" value="<?=number_format($row_pay[b3])?>"/>
									<input type="hidden" name="e4" value="<?=number_format($row_pay[b4])?>"/>
									<input type="hidden" name="e5" value="<?=number_format($row_pay[b5])?>"/>
									<input type="hidden" name="e6" value="<?=number_format($row_pay[b6])?>"/>
									<input type="hidden" name="e7" value="<?=number_format($row_pay[b7])?>"/>
									<input type="hidden" name="e8" value="<?=number_format($row_pay[b8])?>"/>
									<input type="hidden" name="e9" value="-"/>
									<input type="hidden" name="e10" value="-"/>
									<input type="hidden" name="e11" value="-"/>
									<input type="hidden" name="e_sum" value="<?=number_format($row_pay[b1]+$row_pay[b2]+$row_pay[b3]+$row_pay[b4]+$row_pay[b5]+$row_pay[b6]+$row_pay[b7]+$row_pay[b8])?>"/>

<?
} else if($labor == "rule1") {
	//$rule1_ok = 1;
	$rule1_ok = $row_a4[fee_amt];
	//echo $rule1_ok
	if($is_admin != "super") {
		if($rule1_ok == "0") alert("�����Ģ ����� ������ ������ �־�� �մϴ�.\\n������ 1544-4519 ���� �ٶ��ϴ�.");
	}
	//ä��������
	for($i=1;$i<7;$i++) {
		$document_before .= $row_a4_opt["document_before".$i];
		if($row_a4_opt["document_before".$i]) {
			$document_before .= ". ";
		}
	}
	//ä���ļ���
	for($i=1;$i<7;$i++) {
		$document_after .= $row_a4_opt["document_after".$i];
		if($row_a4_opt["document_after".$i]) {
			$document_after .= ". ";
		}
	}
	//�ٹ��ð� �ްԽð�
	if($row_a4_opt[rest1] == "") $rest1 = "����";
	else $rest1 = $row_a4_opt[rest1]."~".$row_a4_opt[rest1e];
	if($row_a4_opt[rest2] == "") $rest2 = "����";
	else $rest2 = $row_a4_opt[rest2]."~".$row_a4_opt[rest2e];
	if($row_a4_opt[rest3] == "") $rest3 = "����";
	else $rest3 = $row_a4_opt[rest3]."~".$row_a4_opt[rest3e];
	if($row_a4_opt[stime_b]) {
		if($row_a4_opt[rest1_b] == "") $rest1_b = "����";
		else $rest1_b = $row_a4_opt[rest1_b]."~".$row_a4_opt[rest1e_b];
		if($row_a4_opt[rest2_b] == "") $rest2_b = "����";
		else $rest2_b = $row_a4_opt[rest2_b]."~".$row_a4_opt[rest2e_b];
		if($row_a4_opt[rest3_b] == "") $rest3_b = "����";
		else $rest3_b = $row_a4_opt[rest3_b]."~".$row_a4_opt[rest3e_b];
	}
	//����/�߰��ٹ�
	if($row_a4_opt[ext] == "") $ext = "����";
	else $ext = $row_a4_opt[ext]."~".$row_a4_opt[exte];
	if($row_a4_opt[night] == "") $night = "����";
	else $night = $row_a4_opt[night]."~".$row_a4_opt[nighte];
	if($row_a4_opt[stime_b]) {
		if($row_a4_opt[ext_b] == "") $ext_b = "����";
		else $ext_b = $row_a4_opt[ext_b]."~".$row_a4_opt[exte_b];
		if($row_a4_opt[night_b] == "") $night_b = "����";
		else $night_b = $row_a4_opt[night_b]."~".$row_a4_opt[nighte_b];
	}
	//��/�Ͽ��ϱٹ�
	if($row_a4_opt['saturday_work']) $saturday_work = "�ٹ���.";
	if($row_a4_opt['saturday_work_b']) $saturday_work_b = "�ٹ���.";
	if($row_a4_opt['sunday_work']) $sunday_work = "�ٹ���.";
	if($row_a4_opt['sunday_work_b']) $sunday_work_b = "�ٹ���.";
	if($row_a4_opt['saturday_time'] == "") $saturday_time = " ";
	else $saturday_time = $row_a4_opt['saturday_time']."~".$row_a4_opt['saturday_timee'];
	if($row_a4_opt['saturday_time_b'] == "") $saturday_time_b = " ";
	else $saturday_time_b = $row_a4_opt['saturday_time_b']."~".$row_a4_opt['saturday_timee_b'];
	if($row_a4_opt['sunday_time'] == "") $sunday_time = " ";
	else $sunday_time = $row_a4_opt['sunday_time']."~".$row_a4_opt['sunday_timee'];
	if($row_a4_opt['sunday_time_b'] == "") $sunday_time_b = " ";
	else $sunday_time_b = $row_a4_opt['sunday_time_b']."~".$row_a4_opt['sunday_timee_b'];
	//����� ��������
	if($row_a4_opt[saturday_paid] == "1") {
		$saturday_paid = "(����� ��������)";
		$saturday_paid_text = "�� ������� �������Ϸ� �ϸ� �����ٹ��Ͽ� �����Ѵ�.";
	} else {
		$saturday_paid = "";
		$saturday_paid_text = "";
	}
	//����
	for($i=1;$i<4;$i++) {
		$fday .= $row_a4_opt["fday".$i];
		if($row_a4_opt["fday".$i]) {
			$fday .= ". ";
		}
	}
	//��������
	for($i=1;$i<13;$i++) {
		//echo $row_a4_opt["hday".$i];
		$new_hday .= $row_a4_opt["hday".$i];
		if($row_a4_opt["hday".$i]) {
			$new_hday .= ". ";
		}
		//echo $new_hday;
	}
	if(!$new_hday) $new_hday = "���Ͼ���";
	//��������
	for($i=1;$i<7;$i++) {
		$new_holiday .= $row_a4_opt["holiday".$i];
		if($row_a4_opt["holiday".$i]) {
			$new_holiday .= ". ";
		}
	}
	if(!$new_holiday) $new_holiday = "���Ͼ���";
	//������(����)
	for($i=1;$i<13;$i++) {
		$affair .= $row_a4_opt["affair".$i];
		if($row_a4_opt["affair".$i]) {
			$affair .= ". ";
		}
	}
	if(!$affair) $affair = "�ް�����";
	//�����ް�
	for($i=1;$i<13;$i++) {
		$new_vacation .= $row_a4_opt["vacation".$i];
		if($row_a4_opt["vacation".$i]) {
			$new_vacation .= ". ";
		}
	}
	if(!$new_vacation) $new_vacation = "�ް�����";
	//�����ް�
	for($i=1;$i<7;$i++) {
		$new_celebrate_mourn .= $row_a4_opt["celebrate_mourn".$i];
		if($row_a4_opt["celebrate_mourn".$i]) {
			$new_celebrate_mourn .= ". ";
		}
	}
	if(!$new_celebrate_mourn) $new_celebrate_mourn = "�ް�����";
	//�ӱݰ��Ⱓ
	if($row_a4_opt['pay_calculate_a']) $pay_calculate_a = $row_a4_opt['pay_calculate_a']." ";
	else $pay_calculate_a = "";
	$pay_calculate_day_period = $pay_calculate_a.$row_a4_opt['pay_calculate_day1']." ".$row_a4_opt['pay_calculate_day_period1']."�Ϻ��� ".$row_a4_opt['pay_calculate_day2']." ".$row_a4_opt['pay_calculate_day_period2']."�ϱ����� �ϸ�, ".$row_a4_opt['pay_calculate_day3']." ".$row_a4_opt['pay_calculate_day_period3']."��";
	if($row_a4_opt['check_pay_calculate_b']) $pay_calculate_day_period .= "�� �����ϰ�, ".$row_a4_opt['pay_calculate_b']." ".$row_a4_opt['pay_calculate_day1_b']." ".$row_a4_opt['pay_calculate_day_period1_b']."�Ϻ��� ".$row_a4_opt['pay_calculate_day2_b']." ".$row_a4_opt['pay_calculate_day_period2_b']."�ϱ����� �ϸ�, ".$row_a4_opt['pay_calculate_day3_b']." ".$row_a4_opt['pay_calculate_day_period3_b']."��";
	//������
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
	//��������
	if($row_a4_opt[retirement_annuity] == "") {
		$retirement_annuity = " ";
	} else {
		$retirement_annuity = "(���Ի�ǰ: ".$row_a4_opt[retirement_annuity].")";
	}
	//����󿩱�
	if($row_a4_opt[bonus]) $bonus = $row_a4_opt[bonus];
	else $bonus = "�ش���� ����.";
	if($row_a4_opt['check_bonus_money_payment']) $bonus = "�ش���� ����.";
	//������
	if($row_a4_opt[conduct_day] == "") {
		$conduct_day = "      ��    ��   ��";
	} else {
		$conduct_day_array = explode(".",$row_a4_opt[conduct_day]);
		$conduct_day = $conduct_day_array[0]."�� ".$conduct_day_array[1]."�� ".$conduct_day_array[2]."��";
	}
	//��������2
	//echo "����ڵ�Ϲ�ȣ : ".$row_a4['t_insureno'];
	if($row_a4['t_insureno'] == "513-16-98675") {
		$annual_paid_holiday_standard = "�Ի�����";
		$out_procedure2 = "������, �۾���, ����ȭ �� ȸ�翡�� ������ ���� ��ǰ, ��ǰ�� ��� �ٹ��Ⱓ�� 3���� �̸��� ��� �޿����� ������ �� �ִ�.";
	} else {
		$annual_paid_holiday_standard = "ȸ�迬����";
		$out_procedure2 = "����� ������ ȸ��� �ʿ��� ��� ������� �������� ��к�ȣ �� �������� ���� ���༭�� û�� �� �� �ִ�.";
	}
	//������ 5�� �̻� / 5�� �̸�
	if($row_a4_opt['persons'] > 5) {
		//������ 86��
		$allowance_86 = "����� �ð��� ����, �߰� �� ���ϱٹ��� �� ��쿡�� �ð��� ����ӱ��� 50%�� ������ �ӱ��� �����Ѵ�. �ٸ�, �����ӱ� �ٷΰ���� ü���� ���� ���ܷ� �Ѵ�.";
		//������ 88��
		$allowance_88 = "�� ȸ���� �������� ���� �޾� �ÿ��� �޾��Ⱓ �� �ش� ������� ����ӱ��� 70%�� �ش��ϴ� �ݾ��� �����Ѵ�. �ٸ�, �ε����� ������ ���Ͽ� �������� �Ұ����Ͽ� �뵿����ȸ�� ������ ���� ��쿡�� ���ܷ� �Ѵ�. �� ȸ��� �������� ���Ͽ� ���� �Ǵ� ������ ����� ���Ͽ� �޹� �Ǵ� �ٹ������� �ǽ��� �� �ִ�.";
	} else {
		$allowance_86 = "��ñٷ��� 5�ι̸� ������(����,�߰�,���ϱٷο� ���� �������)";
		$allowance_88 = "��ñٷ��� 5�ι̸� ������";
	}
?>
	<!--�����Ģ-->
	<input type="hidden" name="head" value="<?=$row_a4[com_name]?>" title="�Ӹ���" />
	<input type="hidden" name="document_before" value="<?=$document_before?>" title="ä��������" />
	<input type="hidden" name="document_after" value="<?=$document_after?>" title="ä���ļ���" />
	<input type="hidden" name="persons" value="<?=$row_a4_opt[persons]?>" title="��" />
	<input type="hidden" name="man" value="<?=$row_a4_opt[man]?>" title="��" />
	<input type="hidden" name="woman" value="<?=$row_a4_opt[woman]?>" title="��" />
	<input type="hidden" name="work_gbn_text_a" value="<?=$row_a4_opt[work_gbn_text_a]?>" title="�ٹ��ð�A" />
	<input type="hidden" name="work_gbn_text_b" value="<?=$row_a4_opt[work_gbn_text_b]?>" title="�ٹ��ð�B" />
	<input type="hidden" name="stime" value="<?=$row_a4_opt[stime]?>" title="�þ��ð�" />
	<input type="hidden" name="etime" value="<?=$row_a4_opt[etime]?>" title="�����ð�" />
	<input type="hidden" name="rest1" value="<?=$rest1?>" title="�ްԽð�1" />
	<input type="hidden" name="rest2" value="<?=$rest2?>" title="�ްԽð�2" />
	<input type="hidden" name="rest3" value="<?=$rest3?>" title="�ްԽð�3" />
	<input type="hidden" name="stime_b" value="<?=$row_a4_opt[stime_b]?>" title="�þ��ð�" />
	<input type="hidden" name="etime_b" value="<?=$row_a4_opt[etime_b]?>" title="�����ð�" />
	<input type="hidden" name="rest1_b" value="<?=$rest1_b?>" title="�ްԽð�1" />
	<input type="hidden" name="rest2_b" value="<?=$rest2_b?>" title="�ްԽð�2" />
	<input type="hidden" name="rest3_b" value="<?=$rest3_b?>" title="�ްԽð�3" />
	<input type="hidden" name="ext" value="<?=$ext?>" title="����ٷ�" />
	<input type="hidden" name="ext_b" value="<?=$ext_b?>" title="����ٷ�b" />
	<input type="hidden" name="night" value="<?=$night?>" title="�߰��ٷ�" />
	<input type="hidden" name="night_b" value="<?=$night_b?>" title="�߰��ٷ�b" />
	<input type="hidden" name="saturday_work" value="<?=$saturday_work?>" title="����ϱٹ�" />
	<input type="hidden" name="saturday_work_b" value="<?=$saturday_work_b?>" title="����ϱٹ�b" />
	<input type="hidden" name="sunday_work" value="<?=$sunday_work?>" title="�Ͽ��ϱٹ�" />
	<input type="hidden" name="sunday_work_b" value="<?=$sunday_work_b?>" title="�Ͽ��ϱٹ�b" />
	<input type="hidden" name="saturday_time" value="<?=$saturday_time?>" title="����ϱٹ��ð�" />
	<input type="hidden" name="saturday_time_b" value="<?=$saturday_time_b?>" title="����ϱٹ��ð�b" />
	<input type="hidden" name="sunday_time" value="<?=$sunday_time?>" title="�Ͽ��ϱٹ��ð�" />
	<input type="hidden" name="sunday_time_b" value="<?=$sunday_time_b?>" title="�Ͽ��ϱٹ��ð�b" />
	<input type="hidden" name="hday" value="<?=$row_a4_opt[hday]?> <?=$saturday_paid?>" title="������" />
	<input type="hidden" name="saturday_paid" value="<?=$saturday_paid_text?> " title="���������" />
	<input type="hidden" name="fday" value="<?=$fday?>" title="����" />
	<input type="hidden" name="new_hday" value="- <?=$new_hday?>" title="��������" />
	<input type="hidden" name="new_holiday" value="- <?=$new_holiday?>" title="��������" />
	<input type="hidden" name="affair" value="- <?=$affair?>" title="������(����)" />
	<input type="hidden" name="new_vacation" value="- <?=$new_vacation?>" title="�����ް�" />
	<input type="hidden" name="new_celebrate_mourn" value="- <?=$new_celebrate_mourn?>" title="�����ް�" />
	<input type="hidden" name="summer_vacation" value="<?=$row_a4_opt[summer_vacation]?>" title="�ϱ��ް�" />
	<input type="hidden" name="pay_system" value="<?=$row_a4_opt[pay_system]?>" title="�ӱ�ü��" />
	<input type="hidden" name="pay_structure" value="<?=$row_a4_opt[pay_structure]?>" title="�ӱݱ���" />
	<input type="hidden" name="pay_calculate_day_period" value="<?=$pay_calculate_day_period?>" title="�ӱݰ��Ⱓ" />

	<input type="hidden" name="allowance_86" value="<?=$allowance_86?>" title="�ð��ܱٹ�����" />
	<input type="hidden" name="allowance_88" value="<?=$allowance_88?>" title="�޾�����" />

	<input type="hidden" name="retirement_age_rule" value="<?=$row_a4_opt[retirement_age_rule]?>" title="����" />
	<input type="hidden" name="retirement_gbn" value="<?=$retirement_gbn?>" title="������" />
	<input type="hidden" name="out_procedure2" value="<?=$out_procedure2?>" title="��������2" />
	<input type="hidden" name="annual_paid_holiday_standard" value="<?=$annual_paid_holiday_standard?>" title="��������" />
	<input type="hidden" name="bonus" value="<?=$bonus?>" title="����󿩱�" />
	<input type="hidden" name="retirement_annuity" value="<?=$retirement_annuity?>" title="��������" />
	<input type="hidden" name="conduct_day" value="<?=$conduct_day?>" title="������" />
<?
} else if($labor == "career_describe") {
	$age_year = "19".substr($row1[jumin_no],0,2);
	$age = date("Y") - $age_year;
	if(substr($row1[jumin_no],7,1) == 1) $sex = "��";
	else if(substr($row1[jumin_no],7,1) == 2) $sex = "��";
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
	//�����
	if($row2[career_sdate]) $career_date1 = $row2[career_sdate]."~".$row2[career_edate];
	if($row2[career_sdate2]) $career_date2 = $row2[career_sdate2]."~".$row2[career_edate2];
	if($row2[career_sdate3]) $career_date3 = $row2[career_sdate3]."~".$row2[career_edate3];
?>
	<!--��±����-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="sex" value="<?=$sex?> " />
	<input type="hidden" name="age" value="<?=$age?> " />
	<input type="hidden" name="hak1" value="<?=$row2[school_name]?> " />
	<input type="hidden" name="hak2" value="<?=$row2[school_name2]?> " />
	<input type="hidden" name="hak3" value="<?=$row2[school_name3]?> " />
	<input type="hidden" name="graduate1" value="<?=$row2[school_edate]?> " />
	<input type="hidden" name="graduate2" value="<?=$row2[school_edate2]?> " />
	<input type="hidden" name="graduate3" value="<?=$row2[school_edate3]?> " />
	<input type="hidden" name="career_date1" value="<?=$career_date1?> " />
	<input type="hidden" name="career_date2" value="<?=$career_date2?> " />
	<input type="hidden" name="career_date3" value="<?=$career_date3?> " />
	<input type="hidden" name="career_space1" value="<?=$row2[career_name]?> " />
	<input type="hidden" name="career_space2" value="<?=$row2[career_name2]?> " />
	<input type="hidden" name="career_space3" value="<?=$row2[career_name3]?> " />
	<input type="hidden" name="career_jik1" value="<?=$row2[career_part]?> " />
	<input type="hidden" name="career_jik2" value="<?=$row2[career_part2]?> " />
	<input type="hidden" name="career_jik3" value="<?=$row2[career_part3]?> " />
<?//=$row2[emp_cel]?>
<?
} else if($labor == "labor15") {
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		//echo $sql_dept;
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
	} else {
		$dept = "-";
	}
?>
	<!--�������-->
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> "/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="dept" value="<?=$dept?>"/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="sdate" value="<?=$row1[in_day]?>"/>
	<input type="hidden" name="edate" value="<?=$row1[out_day]?> "/>
<?
} else if($labor == "public_document") {
?>
	<!--����(����������)-->
	<!--���뺯�� �̿�-->
<?
} else if($labor == "advice_resign") {
?>
	<!--�ǰ������-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
<?
} else if($labor == "minor_consent") {
	$age_year = "19".substr($row1[jumin_no],0,2);
	$age = date("Y") - $age_year;
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
?>
	<!--�̼�����������Ǽ�-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="age" value="<?=$age?> " />
<?
} else if($labor == "resign") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
	$result1 = sql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	//�Ի���
	if($row1[in_day] == "") {
		//������ ���� �� ���� ó��
		$in_day = " ";
	} else {
		$in_day_array = explode(".",$row1[in_day]);
		$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
	}
	//������
	//echo "a".$row1[out_day]."b";
	if($row1[out_day] == "") {
		$out_day = " �� �� ��";
	} else {
		$out_day_array = explode(".",$row1[out_day]);
		$out_day = $out_day_array[0]."�� ".$out_day_array[1]."�� ".$out_day_array[2]."��";
	}
	//��������(����)
	$sql_nomu = " select * from pibohum_base_nomu where com_code='$code' and sabun='$sabun' and quit_cause<>'0' ";
	//echo $sql_nomu;
	$result_nomu = sql_query($sql_nomu);
	$row_nomu = mysql_fetch_array($result_nomu);
	//echo $row_nomu[idx];
	//�������� �迭
	$quit_cause_text[11] = "����,�ڿ���";
	$quit_cause_text[12] = "��ȥ,���,����������";
	$quit_cause_text[13] = "����,�λ�,���";
	$quit_cause_text[14] = "¡���ذ�";
	$quit_cause_text[15] = "��Ÿ ���λ���";
	$quit_cause_text[22] = "���,����,�����ߴ�";
	$quit_cause_text[23] = "�濵�� �ذ�";
	$quit_cause_text[24] = "�޾�,�ӱ�ü��,ȸ������";
	$quit_cause_text[25] = "��Ÿ ȸ�����";
	$quit_cause_text[31] = "����";
	$quit_cause_text[32] = "���Ⱓ ����";
	$quit_cause_text[33] = "��������";
	$quit_cause_text[41] = "��뺸�� ������";
	$quit_cause_text[42] = "���߰��";
	$quit_cause_text[98] = "�Ҹ����� �ϰ�����";
	$quit_cause_text[99] = "���ٿ� ���� ����";
	$retire_cause = $row_nomu[quit_cause];
	//echo $retire_cause;
	if($quit_cause_text[$retire_cause]) {
		$retire_cause = $quit_cause_text[$retire_cause];
	} else {
		$retire_cause = " ";
	}
?>
	<!--������-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="dept" value="<?=$dept?>"/>
	<input type="hidden" name="tel" value="<?=$row1[add_tel]?>"/>
	<input type="hidden" name="resign_cause" value="<?=$retire_cause?>" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="jdate" value="<?=$row1['in_day']?>" title="�Ի���" />
	<input type="hidden" name="edate" value="<?=$row1['out_day']?>" title="������" />
<?
} else if($labor == "identity") {
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
?>
	<!--�ſ�������-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
<?
//�λ�߷���
} else if($labor == "personnel_appointment") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//����(����)����
} else if($labor == "hold_retirement_certificate") {
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		//echo $sql_dept;
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
	} else {
		$dept = "-";
	}
?>
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> "/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="dept" value="<?=$dept?>"/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="sdate" value="<?=$row1[in_day]?>"/>
	<input type="hidden" name="edate" value="<?=$row1[out_day]?> "/>
<?
//����ǰ�Ǽ�
} else if($labor == "business_trip_report") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//�ٷ��ڸ��(������)
} else if($labor == "worker_register_holder") {
	//����, �Ի�����
	$sql_base = " select * from pibohum_base a, pibohum_base_opt b where a.com_code=b.com_code and a.sabun=b.sabun and a.com_code='$com_code' and a.out_day = '' order by b.position ";
	$result_base = sql_query($sql_base);
	for ($i=0; $row_base=sql_fetch_array($result_base); $i++) {
		//���DB �ɼ�
		$sql_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$row_base[sabun]' ";
		//echo $sql_opt;
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		//����
		$sql_position = " select * from com_code_list where com_code='$com_code' and code='$row_opt[position]' and item='position' ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position=mysql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = " ";
		//ȣ��
		$sql_step = " select * from com_code_list where com_code='$com_code' and code='$row_opt[step]' and item='step' ";
		//echo $sql_step;
		$result_step = sql_query($sql_step);
		$row_step=mysql_fetch_array($result_step);
		if($row_step[rate]) $step = $row_step[rate];
		else $step = " ";
		//�ڰ���, �ڰ�����ȣ, ����ȭ, �޴���ȭ
		if(!$row_opt[license_name]) $row_opt[license_name] = " ";
		if(!$row_opt[license_step]) $row_opt[license_step] = " ";
		//�ּ�
		if($row_base[w_juso]) {
			$w_juso_full = $row_base[w_juso]." ".$row_opt[w_juso2];
			$w_juso = cut_str($w_juso_full, 70, "..");
		} else {
			$w_juso = " ";
		}
		if(!$row_base[add_tel]) $row_base[add_tel] = " ";
		if(!$row_opt[emp_cel]) $row_opt[emp_cel] = " ";
?>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row_base[jumin_no]?>"/>
	<input type="hidden" name="license_name" value="<?=$row_opt[license_name]?>"/>
	<input type="hidden" name="license_step" value="<?=$row_opt[license_step]?>"/>
	<input type="hidden" name="addr" value="<?=$w_juso?>"/>
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>"/>
	<input type="hidden" name="step" value="<?=$step?>"/>
	<input type="hidden" name="tel" value="<?=$row_base[add_tel]?>"/>
	<input type="hidden" name="hp" value="<?=$row_opt[emp_cel]?>"/>
<?
	}
	//���� ��� hwp control ����
	if($i >= 0 && $i < 16) $k_limit = 16 - $i;
	else if($i >= 16 && $i < 32) $k_limit = 32 - $i;
	else if($i >= 32 && $i < 48) $k_limit = 48 - $i;
	else if($i >= 48 && $i < 64) $k_limit = 64 - $i;
	for($k=0;$k<$k_limit;$k++) {
?>
	<input type="hidden" name="jik" value=" "/>
	<input type="hidden" name="name_k" value=" "/>
	<input type="hidden" name="jumin" value=" "/>
	<input type="hidden" name="license_name" value=" "/>
	<input type="hidden" name="license_step" value=" "/>
	<input type="hidden" name="addr" value=" "/>
	<input type="hidden" name="in_day" value=" "/>
	<input type="hidden" name="step" value=" "/>
	<input type="hidden" name="tel" value=" "/>
	<input type="hidden" name="hp" value=" "/>
<?
	}
	$worker_count = $i + 1;
?>
	<input type="hidden" name="worker_count" value="<?=$worker_count?>"/>
<?
//�ٷ��ڸ��(������)
} else if($labor == "worker_register_retiree") {
	//����, �Ի�����
	$sql_base = " select * from pibohum_base where com_code='$com_code' and out_day != '' ";
	$result_base = sql_query($sql_base);
	for ($i=0; $row_base=sql_fetch_array($result_base); $i++) {
		//���DB �ɼ�
		$sql_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$row_base[sabun]' ";
		//echo $sql_opt;
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		//����
		$sql_position = " select * from com_code_list where com_code='$com_code' and code='$row_opt[position]' and item='position' ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position=mysql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = " ";
		//ȣ��
		$sql_step = " select * from com_code_list where com_code='$com_code' and code='$row_opt[step]' and item='step' ";
		//echo $sql_step;
		$result_step = sql_query($sql_step);
		$row_step=mysql_fetch_array($result_step);
		if($row_step[rate]) $step = $row_step[rate];
		else $step = " ";
		//��������(����)
		$sql_nomu = " select * from pibohum_base_nomu where com_code='$com_code' and sabun='$row_base[sabun]' and quit_cause<>'0' ";
		//echo $sql_nomu;
		$result_nomu = sql_query($sql_nomu);
		$row_nomu = mysql_fetch_array($result_nomu);
		//echo $row_nomu[idx];
		//��������
		$quit_cause_text[11] = "����,�ڿ���";
		$quit_cause_text[12] = "��ȥ,���,����������";
		$quit_cause_text[13] = "����,�λ�,���";
		$quit_cause_text[14] = "¡���ذ�";
		$quit_cause_text[15] = "��Ÿ ���λ���";
		$quit_cause_text[22] = "���,����,�����ߴ�";
		$quit_cause_text[23] = "�濵�� �ذ�";
		$quit_cause_text[24] = "�޾�,�ӱ�ü��,ȸ������";
		$quit_cause_text[25] = "��Ÿ ȸ�����";
		$quit_cause_text[31] = "����";
		$quit_cause_text[32] = "���Ⱓ ����";
		$quit_cause_text[33] = "��������";
		$quit_cause_text[41] = "��뺸�� ������";
		$quit_cause_text[42] = "���߰��";
		$quit_cause_text[98] = "�Ҹ����� �ϰ�����";
		$quit_cause_text[99] = "���ٿ� ���� ����";
		$retire_cause = $row_nomu[quit_cause];
		//echo $retire_cause;
		$retire_cause = $quit_cause_text[$retire_cause];
		//�ڰ���, �ڰ�����ȣ, ����ȭ, �޴���ȭ
		if(!$row_opt[license_name]) $row_opt[license_name] = " ";
		if(!$row_opt[license_step]) $row_opt[license_step] = " ";
		if(!$row_base[add_tel]) $row_base[add_tel] = " ";
		if(!$row_opt[emp_cel]) $row_opt[emp_cel] = " ";
?>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row_base[jumin_no]?>"/>
	<input type="hidden" name="license_name" value="<?=$row_opt[license_name]?>"/>
	<input type="hidden" name="license_step" value="<?=$row_opt[license_step]?>"/>
	<input type="hidden" name="addr" value="<?=$row_base[w_juso]?> <?=$row_opt[w_juso2]?>"/>
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>"/>
	<input type="hidden" name="step" value="<?=$step?>"/>
	<input type="hidden" name="out_day" value="<?=$row_base[out_day]?>"/>
	<input type="hidden" name="retire_cause" value="<?=$retire_cause?>"/>
	<input type="hidden" name="tel" value="<?=$row_base[add_tel]?>"/>
	<input type="hidden" name="hp" value="<?=$row_opt[emp_cel]?>"/>
<?
	}
	//���� ��� hwp control ����
	if($i >= 0 && $i < 16) $k_limit = 16 - $i;
	else if($i >= 16 && $i < 32) $k_limit = 32 - $i;
	else if($i >= 32 && $i < 48) $k_limit = 48 - $i;
	else if($i >= 48 && $i < 64) $k_limit = 64 - $i;
	for($k=0;$k<$k_limit;$k++) {
?>
	<input type="hidden" name="jik" value=" "/>
	<input type="hidden" name="name_k" value=" "/>
	<input type="hidden" name="jumin" value=" "/>
	<input type="hidden" name="license_name" value=" "/>
	<input type="hidden" name="license_step" value=" "/>
	<input type="hidden" name="addr" value=" "/>
	<input type="hidden" name="in_day" value=" "/>
	<input type="hidden" name="step" value=" "/>
	<input type="hidden" name="out_day" value=" "/>
	<input type="hidden" name="retire_cause" value=" "/>
	<input type="hidden" name="tel" value=" "/>
	<input type="hidden" name="hp" value=" "/>
<?
	}
	$worker_count = $i + 1;
?>
	<input type="hidden" name="worker_count" value="<?=$worker_count?>"/>
<?
//�߰����ϱٷε��Ǽ�
} else if($labor == "night_holiday_work_consent") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	//���DB �ɼ�
	$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun = '$sabun' ";
	//echo $sql_opt;
	$result_opt = sql_query($sql_opt);
	$row_opt = mysql_fetch_array($result_opt);
	//����
	$sql_position = " select * from com_code_list where com_code='$code' and code='$row_opt[position]' and item='position' ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	if($row_position[name]) $position = $row_position[name];
	else $position = " ";
?>
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="time" value="���� 10�ú��� ���� ���� 6�ñ���"/>
<?
//����ٷε��Ǽ�
} else if($labor == "extend_work_consent") {
?>
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//�λ���ī��(����)
} else if($labor == "personnel_document_card") {
	$age_year = "19".substr($row1[jumin_no],0,2);
	$age = date("Y") - $age_year;
	if(substr($row1[jumin_no],7,1) == 1) $sex = "��";
	else if(substr($row1[jumin_no],7,1) == 2) $sex = "��";
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
?>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="sex" value="<?=$sex?> " />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> <?=$row_opt[w_juso2]?>"/>
<?
//��ü�ް����Ǽ�
} else if($labor == "change_vacation_agree") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> <?=$row_opt[w_juso2]?>"/>
<?
//�ø���
} else if($labor == "written_apology") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	//���DB �ɼ�
	$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun = '$sabun' ";
	$result_opt = sql_query($sql_opt);
	$row_opt = mysql_fetch_array($result_opt);
	//����
	$sql_position = " select * from com_code_list where com_code='$code' and code='$row_opt[position]' and item='position' ";
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	if($row_position[name]) $position = $row_position[name];
	else $position = " ";
?>
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//������������
} else if($labor == "annual_paid_holiday") {
	//echo $search_year;
	//���� ���κ� ����Ʈ : �����ڸ� ǥ�� 160317
	//$sql_annual = " select * from pibohum_base_nomu a, pibohum_base b, pibohum_base_opt c where a.com_code='$com_code' and a.com_code=b.com_code and a.com_code=c.com_code and a.sabun=b.sabun and a.sabun=c.sabun and b.gubun='0' group by a.com_code, a.sabun order by c.position asc ";
	$sql_annual = " select * from pibohum_base b, pibohum_base_opt c where b.com_code='$com_code' and b.com_code=c.com_code and b.sabun=c.sabun and b.gubun='0' order by c.position asc ";
	//echo $sql_annual;
	$result_annual = sql_query($sql_annual);
	// ����Ʈ ���
	for ($i=0; $row_annual=sql_fetch_array($result_annual); $i++) {
		//���DB �ɼ�
		$sql_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$row_annual[sabun]' ";
		//echo $sql_opt;
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		//����
		$sql_position = " select * from com_code_list where com_code='$com_code' and code='$row_opt[position]' and item='position' ";
		$result_position = sql_query($sql_position);
		$row_position=mysql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = " ";
		//����, �Ի�����
		$sql_base = " select * from pibohum_base where com_code='$com_code' and sabun = '$row_annual[sabun]' ";
		$result_base = sql_query($sql_base);
		$row_base = mysql_fetch_array($result_base);
		//���DB �ɼ�2
		$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun = '$row_annual[sabun]' ";
		$result_opt2 = sql_query($sql_opt2);
		$row_opt2 = mysql_fetch_array($result_opt2);
		//��������ϼ�
		$sql_annual_cnt = " select count(*) as cnt from pibohum_base_nomu where com_code = '$com_code' and sabun = '$row_annual[sabun]' and ( annual_paid_holiday_day != '' and annual_paid_holiday_day like '$search_year%' ) ";
		//echo $sql_annual_cnt;
		$result_annual_cnt = sql_query($sql_annual_cnt);
		$row_annual_cnt = mysql_fetch_array($result_annual_cnt);
?>
	<!--������������-->
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>" />
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>" title="�Ի�����" />
	<input type="hidden" name="annual_sum" value="<?=$row_opt2[annual_paid_holiday]?>" title="�߻��ϼ�" />
	<input type="hidden" name="annual_use" value="<?=$row_annual_cnt[cnt]?>" title="����ϼ�" />
	<input type="hidden" name="annual_rest" value="<?=($row_opt2[annual_paid_holiday]-$row_annual_cnt[cnt])?>" title="�ܿ��ϼ�" />
<?
	}
	//���� ��� hwp control ����
	$k_limit = 30 - $i;
	for($k=0;$k<$k_limit;$k++) {
?>
	<input type="hidden" name="jik" value=" "/>
	<input type="hidden" name="name_k" value=" " />
	<input type="hidden" name="in_day" value=" " title="�Ի�����" />
	<input type="hidden" name="annual_sum" value=" " title="�߻��ϼ�" />
	<input type="hidden" name="annual_use" value=" " title="����ϼ�" />
	<input type="hidden" name="annual_rest" value=" " title="�ܿ��ϼ�" />
<?
	}
//����,����,��� ������
} else if($labor == "attendance_reason") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//�ް���û��(ȸ��)
} else if($labor == "vacation") {
	if($row1[emp_cel]) {
		$tel = $row1[emp_cel];
	} else {
		$tel = $row1[add_tel];
	}
	//����/�ް�/���� DB
	$sql_nomu = " select * from pibohum_base_nomu where idx='$idx' ";
	$result_nomu = sql_query($sql_nomu);
	$row_nomu = mysql_fetch_array($result_nomu);
	//�ް�����
	$cause_array = array("","�����ް�(����)","�����ް�(����)","�������ް�(����)","�������ް�(����)","����(����)","����(����)","�ӽ�/����������","��������");
	$cause_no = $row_nomu[vacation_cause];
	$cause = $cause_array[$cause_no];
	//�ް�����
	$reason = $row_nomu[vacation_reason];
?>
	<!--�ް���û��(ȸ��)-->
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="tel" value="<?=$tel?> " />
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="cause" value="<?=$cause?>" title="�ް�����" />
	<input type="hidden" name="vdate" value="<?=$out_day?>" title="�Ⱓ" />
	<input type="hidden" name="space" value="<?=$space?> " />
	<input type="hidden" name="reason" value="<?=$reason?>" />
<?
//�뵿�� �������˼���
//�󿩱����޴���
} else if($labor == "bonus_pay_ledger") {
	$bonus_array = explode(",",$row_a4_opt[bonus_time]);
	if($bonus_array[0]) $bonus_time1 = $bonus_array[0];
	else $bonus_time1 = " ";
	if($bonus_array[1]) $bonus_time2 = $bonus_array[1];
	else $bonus_time2 = " ";
	if($bonus_array[2]) $bonus_time3 = $bonus_array[2];
	else $bonus_time3 = " ";
	if($bonus_array[3]) $bonus_time4 = $bonus_array[3];
	else $bonus_time4 = " ";
	if($bonus_array[4]) $bonus_time5 = $bonus_array[4];
	else $bonus_time5 = " ";
	if($bonus_array[5]) $bonus_time6 = $bonus_array[5];
	else $bonus_time6 = " ";
?>
<input type="hidden" name="bonus_time1" value="<?=$bonus_time1?>" />
<input type="hidden" name="bonus_time2" value="<?=$bonus_time2?>" />
<input type="hidden" name="bonus_time3" value="<?=$bonus_time3?>" />
<input type="hidden" name="bonus_time4" value="<?=$bonus_time4?>" />
<input type="hidden" name="bonus_time5" value="<?=$bonus_time5?>" />
<input type="hidden" name="bonus_time6" value="<?=$bonus_time6?>" />
<script type="text/javascript">
function setRowInsert() {
<?
$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b, pibohum_base_opt2 c ";
$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];
$sql_search = " where a.com_code='$com_code' ";
//�ɼ�DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun and a.com_code = c.com_code and a.sabun = c.sabun) ";
$sql_search .= " ) ";
//����
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//���� 1����
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//���� 2����
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//���� 3����
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
if($sort1) {
	if($sort1 == "in_day" || $sort1 == "name") $sst = "a.".$sort1;
	else $sst = "b.".$sort1;
	$sod = $sod1;
} else {
	$sst = "b.position";
	$sod = "asc";
}
if($sort2) {
	if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
	else $sst2 = ", b.".$sort2;
	$sod2 = $sod2;
} else {
	$sst2 = ", a.in_day";
	$sod2 = "asc";
}
if($sort3) {
	if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
	else $sst3 = ", b.".$sort3;
	$sod3 = $sod3;
} else {
	$sst3 = ", b.dept";
	$sod3 = "asc";
}
$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 ";
$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql);
//���޽ñ�
$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
$bonus_time = explode(",",$row_a4_opt[bonus_time]);	
$bonus_time_cnt = 0;
for($i=0;$i<6;$i++) {
	if($bonus_time[$i] == "") {
		$bonus_time[$i] = "-";
	} else {
		$bonus_time_cnt++;
	}
}
$j = 1;
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $j;
	$list = $i%2;
	//idx
	$idx = $row[idx];
	//����� �ڵ� / ��� / �ڵ�_���
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// ������ : ������ڵ�
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	//���DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 8, "..");
	//�Ի���, ������
	$in_day = $row_base[in_day];
	$out_day = $row_base[out_day];
	//���DB �ɼ�
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//����
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//ä������
	if($row_base[work_form] == 1) $work_form = "������";
	else if($row_base[work_form] == 2) $work_form = "�����";
	else if($row_base[work_form] == 3) $work_form = "�Ͽ���";
	else $work_form = "";
	//�󿩱ݱ��� (��������, �󿩺���)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//$bonus_code = $row_opt2[bonus_standard];
	if($row_opt2[bonus_standard] == "1") $bonus_standard = "�⺻��";
	else if($row_opt2[bonus_standard] == "2") $bonus_standard = "�����ӱ�";
	else if($row_opt2[bonus_standard] == "3") $bonus_standard = "����ӱ�";
	else if($row_opt2[bonus_standard] == "4") $bonus_standard = "�ѱ޿�";
	//�󿩱� �����Է�
	$check_bonus_money_yn = $row_opt2[check_bonus_money_yn];
	$bonus_money = $row_opt2[bonus_money];
	if($check_bonus_money_yn == "Y") {
		$bonus_standard = "ȸ�系��";
		$bonus_standard_pay = $bonus_money;
	}
	$bonus_percent = $row_opt2[bonus_percent];
	if($bonus_percent != "0") {
		$bonus_standard_percent = $bonus_standard."<br>".$bonus_percent."%";
		//�󿩱� ���� ��ũ
		$bonus_url = "bonus_view.php?w=u&id=".$id."&page=".$page."&stx_bonus_time=".$stx_bonus_time;
	} else {
		$bonus_standard_percent = "-";
	}
	$bonus_p_array = explode(",",$row_opt2[bonus_p]);
	//��������, ���޾�, �޸�
	for($m=0;$m<6;$m++) {
		$k = $m + 1;
		$sql_bonus = " select * from pibohum_base_bonus where com_code='$code' and sabun='$id' and bonus_time='$k' ";
		$result_bonus = sql_query($sql_bonus);
		$row_bonus = mysql_fetch_array($result_bonus);
		$bonus_percent_array[$m] = $row_bonus[bonus_percent];
		$bonus_day[$m] = $row_bonus[bonus_day];
		if($bonus_day[$m]) {
			$bonus_pay[$m] = $row_bonus[pay];
		} else {
			$bonus_day[$m] = "             ";
			$bonus_pay[$m] = " ";
		}
		$memo = $row_bonus[memo];
		//���޽ñ⺰ �󿩺���
		if($bonus_percent_array[$m]) {
			$bonus_p[$m] = $bonus_percent_array[$m]."%";
		} else {
			if($bonus_p_array[$m]) $bonus_p[$m] = $bonus_p_array[$m]."%";
			else $bonus_p[$m] = " ";
		}
	}
	if($bonus_percent && !$sabun) {
?>
	TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$position?>","<?=$bonus_standard?>","<?=$bonus_percent?>","<?=$bonus_day[0]?><?=$bonus_p[0]?>","<?=$bonus_pay[0]?>","<?=$bonus_day[1]?><?=$bonus_p[1]?>","<?=$bonus_pay[1]?>","<?=$bonus_day[2]?><?=$bonus_p[2]?>","<?=$bonus_pay[2]?>","<?=$bonus_day[3]?><?=$bonus_p[3]?>","<?=$bonus_pay[3]?>","<?=$bonus_day[4]?><?=$bonus_p[4]?>","<?=$bonus_pay[4]?>","<?=$bonus_day[5]?><?=$bonus_p[5]?>","<?=$bonus_pay[5]?>"));
<?
		$j++;
	} else {
		if($sabun == $id) {	
?>
	TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$position?>","<?=$bonus_standard?>","<?=$bonus_percent?>","<?=$bonus_day[0]?><?=$bonus_p[0]?>","<?=$bonus_pay[0]?>","<?=$bonus_day[1]?><?=$bonus_p[1]?>","<?=$bonus_pay[1]?>","<?=$bonus_day[2]?><?=$bonus_p[2]?>","<?=$bonus_pay[2]?>","<?=$bonus_day[3]?><?=$bonus_p[3]?>","<?=$bonus_pay[3]?>","<?=$bonus_day[4]?><?=$bonus_p[4]?>","<?=$bonus_pay[4]?>","<?=$bonus_day[5]?><?=$bonus_p[5]?>","<?=$bonus_pay[5]?>"));
<?
		}
	}
}
?>
	pHwpCtrl.MoveToField("tbl_s", false, false, false);
	pHwpCtrl.Run("TableDeleteRow");
	pHwpCtrl.MovePos(20);
}
</script>
<?
//���������޴���
} else if($labor == "retirement_pay_ledger") {
?>
<script type="text/javascript">
function setRowInsert() {
<?
	$sql_common = " from pibohum_base_nomu ";
	if($is_admin == "super") {
		$sql_search = " where 1=1 ";
		$sst = "com_code";
	} else {
		$sql_search = " where com_code='$com_code' and quit_cause<>'0' ";
		$sst = "idx";
	}
	$sod = "desc";
	$sql_order = " order by $sst $sod ";
	$sql = " select count(*) as cnt
					 $sql_common
					 $sql_search
					 $sql_order ";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 15;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows;
	$sql = " select *
						$sql_common
						$sql_search
						$sql_order
						limit $from_record, $rows ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $total_count - $i - ($rows*($page-1));
		//����� �ڵ� / ��� / �ڵ�_���
		$code = $row[com_code];
		$id = $row[sabun];
		//���DB
		$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
		$result_base = sql_query($sql_base);
		$row_base = mysql_fetch_array($result_base);
		$name = cut_str($row_base[name], 6, "..");
		$jumin = $row_base[jumin_no];
		//���DB �ɼ�
		$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		$dept = $row_opt[dept_1];
		//���DB �ɼ�
		$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
		$result_opt2 = sql_query($sql_opt2);
		$row_opt2 = mysql_fetch_array($result_opt2);
		$money_hour_ms_int = $row_opt2[money_hour_ms];
		$money_hour_ms = number_format($money_hour_ms_int);
		//�ּ�
		$addr = $row_base[w_juso]." ".$row_opt[w_juso2];
		//�ټӱⰣ
		function dateDiff($date1, $date2) { 
			$date1 = date_parse($date1); 
			$date2 = date_parse($date2); 
			return ((gmmktime(0, 0, 0, $date1['month'], $date1['day'], $date1['year']) - gmmktime(0, 0, 0, $date2['month'], $date2['day'], $date2['year']))/3600/24);
		}
		/*
		$frDate = str_replace(".","-",$row_base[in_day]);
		$toDate = str_replace(".","-",$row_base[out_day]);
		$datetime1 = date_create($frDate);
		$datetime2 = date_create($toDate);
		$date_diff = $datetime2 - $datetime1;
		//$interval = date_diff($datetime1, $datetime2);
		//$str =  $interval->format('%y�� %m���� %d��');
		$long_service_date = dateDiff($frDate, $toDate);
		$long_service_date = date_format($date_diff, 'y�� m���� d��');
		*/
		$frDate = str_replace(".","-",$row_base[in_day]);
		$toDate = str_replace(".","-",$row_base[out_day]);
		$stime = ($frDate == "")?date("Y-m-d"):$frDate;
		$etime = ($toDate == "")?date("Y-m-d"):$toDate;
		//echo "document.write('".$stime.$etime."');";
		// ���۳�¥�� ���� ��¥�� �Ⱓ ���
		$intStime = substr(str_replace("-","",$stime),0,8);
		$intSyear = substr($intStime ,0,4);
		$intSmonth = substr($intStime ,4,2);
		$intSday = substr($intStime ,6,2);
		$intEtime = substr(str_replace("-","",$etime),0,8);
		$intEyear = substr($intEtime ,0,4);
		$intEmonth = substr($intEtime ,4,2);
		$intEday = substr($intEtime ,6,2) ;
		$intStime = mktime(0,0,0, $intSmonth , $intSday , $intSyear );//Ÿ�ӽ������� ��ȯ
		$intEtime = mktime(0,0,0, $intEmonth , $intEday +1, $intEyear );
		//echo "document.write('".$intStime." ".$intEtime."');";
		$strDay = ($intEtime - $intStime ) / 86400;
		$strDaycnt = floor($strDay)."��"; //�� ��¥ ������ �Ⱓ
		
?>
		TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$jumin?>","<?=$addr?>","<?=$strDaycnt?>","<?=$money_sum?>","<?=$bonus_percent?>","","","","",""));
<?
	}
?>
	pHwpCtrl.MoveToField("tbl_s", false, false, false);
	pHwpCtrl.Run("TableDeleteRow");
	pHwpCtrl.MovePos(20);
}
</script>
<?
} else if($labor == "security_covenant") {
	//���ȼ��༭
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//echo $intStime." ".$intEtime;
}
//guest id
if($member[mb_id] != "guest") {
?>
	<!-- �ѱ� ��Ʈ�� �� -->
	<div style="">
		<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052" style="margin:4px 0 0 0;border:1px solid #ccc"></object>
	</div>
<?
} else {
	echo "���� �̿�� �����մϴ�.";
}
?>
	</form>
</div>
<script type="text/javascript">
<?
if($labor == "labor2") {
?>
document.getElementById('HwpCtrl').style.height = "2570px";
<?
} else if($labor == "worker_register_holder" || $labor == "worker_register_retiree" || $labor == "personnel_document_card" || $labor == "bonus_pay_ledger" || $labor == "retirement_paid_holiday" || $labor == "retirement_pay_ledger") {
?>
document.getElementById('HwpCtrl').style.height = "680px";
<?
} else if($labor == "rule1") {
?>
document.getElementById('HwpCtrl').style.width = "642px";
document.getElementById('HwpCtrl').style.height = "720px";
<?
//} else if($labor == "labor1" || $labor == "labor3" || $labor == "labor4" || $labor == "pay_table" || $labor == "labor15" || $labor == "career_describe" ) {
//} else {
} else if($labor != "") {
?>
document.getElementById('HwpCtrl').style.height = "1310px";
<?
}
?>

function toggleLayer(id,name) {
	//alert(id);
	document.getElementById('employeeList').style.display='none';
	if(name != "pay_table") {
		document.getElementById('search_year').style.display='none';
		document.getElementById('search_month').style.display='none';
	}
	document.getElementById('yearList').style.display='none';
	document.getElementById('monthList').style.display='none';
	document.getElementById(id).style.display='inline';
	document.HwpControl.labor.value = name;
}
function toggleLayer_hidden(id,name) {
	document.getElementById('employeeList').style.display='none';
	document.getElementById('search_year').style.display='none';
	document.getElementById('search_month').style.display='none';
	document.getElementById('employeeList_text').style.display='none';
	document.getElementById('yearList').style.display='none';
	document.getElementById('monthList').style.display='none';
}
function toggleLayer2(id,name) {
	if(document.getElementById(id).style.display=='block'){
		document.getElementById(id).style.display='none';
		document.getElementById('yy2').style.display='none';
	}else{
		document.getElementById(id).style.display='block';
		document.getElementById('yy2').style.display='inline';
	}
	document.HwpControl.labor.value = name;
}
function goSubmit(name) {
	//alert(name);
	document.HwpControl.labor.value = name;
	document.HwpControl.submit();
}
function goSubmit_vacation() {
	name = "vacation";
	document.HwpControl.labor.value = name;
	document.HwpControl.submit();
}
<?
if($labor == "pay_table") {
	$hwp_js = "pay_stubs.js";
	echo "toggleLayer('employeeList','$labor');";
} else if($labor == "rule1") {
	$hwp_js = "arbeitsordnung.js";
	echo "toggleLayer_hidden();";
} else if($labor == "labor1") {
	if($member['mb_id'] == "410-86-38857") $hwp_js = "work_contract_cns.js";
	else $hwp_js = "work_contract.js";
	//$hwp_js = "work_contract.js";
	echo "toggleLayer('employeeList','$labor');";
} else if($labor == "security_covenant") {
	$hwp_js = "security_covenant.js";
	echo "toggleLayer('employeeList','$labor');";
} else {
	$hwp_js = "form_labor.js";
	//ȭ��������κθ�ȸ ����
	if($member['mb_id'] == "124-82-18063") $hwp_js = "form_labor_h.js";	
	if($labor == "rule1" || $labor == "public_document" || $labor == "business_trip_report" || $labor == "worker_register_holder" || $labor == "worker_register_retiree") {
		//�ٷ��� ���� ���� : �����Ģ, ����(����������)
	} else {
		echo "toggleLayer('employeeList','$labor');";
	}
}
//������������, �󿩱����޴���, ���������޴���
if($labor == "annual_paid_holiday" || $labor == "bonus_pay_ledger" || $labor == "retirement_paid_holiday") {
	echo "document.getElementById('employeeList').style.display='none';";
	echo "document.getElementById('employeeList_text').style.display='none';";
	echo "document.getElementById('search_year').style.display='inline';";
//����ǰ�Ǽ�, �ٷ��ڸ��(������,������), 
} else if($labor == "" || $labor == "business_trip_report" || $labor == "worker_register_holder" || $labor == "worker_register_retiree") {
	echo "toggleLayer_hidden();";
}
//�ް����� idx ������ ����
//if($idx) echo "addLoadEvent(goSubmit_vacation);";
?>
//hwp��Ʈ�ѷ� 20px �ϴ����� �̵� fix
for(i=1;i<10;i++) {
	box = getId('subMenuBox'+i+'00');
	//box.style.top = -20;
}

</script>
<script src="./js/<?=$hwp_js?>" type="text/javascript" charset="euc-kr"></script>
			</td>
		</tr>
	</table>
