<script language="javascript">
var fm = document.fhead;
function setCookie (name, value, expiredays)
 {
  var todayDate = new Date();
  todayDate.setDate( todayDate.getDate() + expiredays );
  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
 }
function setValue()
 {
	if(fm.id_save.checked == true) setCookie ('id', fm.mb_id.value, 1);
 }
function getCookie(name) // ��Ű ����� �����ϴ� �Լ��Դϴ�. 
{
	var rose = name + "=" ; //��Ű����=
	var rose2 = rose.length ;
	//��Ű�� ����
	var rose3 = document.cookie.length 
	var i = 0;
	while (i < rose3)
	{
		var j = i + rose2;
		if (document.cookie.substring(i,j) == rose) 
		{
			var rose4 = document.cookie.indexOf(";",j);
			if (rose4 == -1)
			{
				rose4 = document.cookie.length;
			}
			return unescape(document.cookie.substring(j,rose4));
		}
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) 
		{
			break;
		}
	}
	return "";
}
</script>
<style type="text/css">
.clsDrag {
	position:relative;
}
</style>
<?
$rs[po_id] = 1;
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
if (trim($_COOKIE["it_ck_pop_".$rs[po_id]]) != "done") {
	//�˾�1 ��ǥ
	$pop_left = 84;
	$pop_top = 61
;
?>
<style type="text/css">
#pop1 {
	position:absolute;
	z-index:100;
	left:<?=$pop_left?>px;
	top:<?=$pop_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:400px;
}
</style>
<div id="pop1" class="clsDrag" style="display:" onmouseover="showM('900')">
	<table width="400" height="400" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="background:url('images/visit_call_popup.png') no-repeat;padding-top:96px" valign="top">
				<div style="overflow-y:auto;height:290px;width:394px">
<?
//�ݿ� �˻�
$today = date("Y.m.d");
//$this_month_start = date("Y.m.d");
//�湮/���� ��Ȳ ��Ʋ �� �����ٺ��� ǥ�� 160224 / ���Ϻ��� ǥ�� 160415
$this_month_start = date("Y.m.d",strtotime("0day"));
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
$search_sday = $this_month_start;
$search_eday = $this_month_end;

//������������(������� �ŷ�ó ǥ��)
if($member['mb_level'] <= 6) {
	$sql_search = " (a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]') and ";
	//���� ������� ����
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " b.manage_cust_numb='$manage_code' and ";
	}
} else {
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search = " b.manage_cust_numb='$manage_code' and ";
	} else {
		$sql_search = "";
	}
}
//�ش� �� �����͸� ǥ��
$sql_search .= " (a.electric_charges_visitdt >= '$search_sday' and a.electric_charges_visitdt <= '$search_eday') and ";
//������������(SQL����) �湮���� ���Ϻ��� ������� ���� 160415
$sql_electric_charges = " select * from com_list_gy a, com_list_gy_opt b where  $sql_search a.com_code = b.com_code and a.electric_charges_visitdt != '' order by a.electric_charges_visitdt asc ";
$result_electric_charges = sql_query($sql_electric_charges);

//���â��
$sql_common = " from job_time a, job_time_opt b ";
//�ش� ������� �湮������ ǥ��
$sql_search = " where (a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]') ";
//���� �ŷ�ó ����, �翬�� or �湮���� 150811
$sql_search .= " and a.id=b.id and a.delete_yn != '1' and ( b.check_ok='9' or  b.check_ok='10' ) ";
//���Ϻ��� �ݿ������� ǥ�� ���� 150709 -> �ش� �� �����͸� ǥ�� 150104
$sql_search .= " and ( (a.visitdt >= '$search_sday' and a.visitdt <= '$search_eday') ) ";
//�����ٰ��� �Ϸ� �� ��ǥ�� 160224
$sql_search .= " and (a.visitdt_ok = '') ";
//�����, ��������ڿ��Ը� ǥ�� 160211
$sql_search .= " and (a.writer='$manage_code' or a.manager='$manage_code') ";
//������ ��û (�⺻ �˻�)
$sql_search .= " ";
$sql_order = " order by a.visitdt asc, b.recall asc ";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql;
$result = sql_query($sql);
$colspan = 3;

//�ű԰��Ȯ��(������� �ŷ�ó ǥ��)
if($member['mb_level'] <= 6) {
	$sql_search = " (a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]') and ";
	//���� �������
	if($member['mb_level'] == 5) {
		//���Ŵ��� �ڵ� üũ
		$sql_search .= " c.manage_cust_numb='$manage_code' and ";
	}
} else {
	//$sql_search = "";
	if($member['mb_level'] == 7) {
		//���Ŵ��� �ڵ� üũ
		$sql_search = " c.manage_cust_numb='$manage_code' and ";
	} else {
		$sql_search = "";
	}
}
//�ش� �� �����͸� ǥ��
$sql_search .= " (b.employment_visitdt >= '$search_sday' and b.employment_visitdt <= '$search_eday') and ";
//�����ٰ��� �Ϸ� �� ��ǥ�� 160224
$sql_search .= " (b.employment_visitdt_ok = '') and ";
//�ű԰��Ȯ��(SQL����)
$sql_employment = " select * from com_list_gy a, com_employment b, com_list_gy_opt c where  $sql_search a.com_code = b.com_code and a.com_code = c.com_code and b.employment_visitdt != '' order by b.employment_visitdt asc ";
$result_employment = sql_query($sql_employment);
?>
					<table width="360" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
						<tr>
							<td class="tdhead_center" width="72" rowspan="">����</td>
							<td class="tdhead_center" width="62" rowspan="">�������</td>
							<td class="tdhead_center" rowspan="">������</td>
						</tr>
<?
//������������ ����Ʈ ���
for ($k=0; $row_electric_charges=sql_fetch_array($result_electric_charges); $k++) {
	//�ŷ�ó �ڵ�
	$com_code = $row_electric_charges['com_code'];
	//ó����Ȳ
	$check_ok_id = $row_electric_charges['check_ok'];
	//�湮����
	$memo_date = $row_electric_charges['electric_charges_visitdt'];
	$visitdt_time = $row_electric_charges['electric_charges_visitdt_time'];
	$com_name_full = $row_electric_charges['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	if($member['mb_level'] > 6 || $row_electric_charges['damdang_code'] == $member['mb_profile']) {
		$com_view = "electric_charges_view.php?id=".$com_code."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//������
	$damdang_code = $row_electric_charges['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//�����
	$user_nick = $row_electric_charges['manage_cust_name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	$check_ok = "������";
	if($row_electric_charges['electric_charges_visit_kind'] == "�湮") $visit_kind = "(�湮)";
	else if($row_electric_charges['electric_charges_visit_kind'] == "�翬��") $visit_kind = "(�翬��)";
	else $visit_kind = "";
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style="<?=$memo_date_color?>"><?=$memo_date?><br><?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$check_ok?><br /><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>"><span style="font-weight:bold"><?=$com_name?></span></a>
								<?=$branch?> <? if($user_nick) echo $user_nick; ?>
							</td>
						</tr>
<?
}
//������������ ī��Ʈ
$k_electric_charges = $k;
//�ű԰��Ȯ�� ����Ʈ ���
for ($k=0; $row_employment=sql_fetch_array($result_employment); $k++) {
	//�ŷ�ó �ڵ�
	$com_code = $row_employment['com_code'];
	//ó����Ȳ
	$check_ok_id = $row_employment['check_ok'];
	//�湮����
	$memo_date = $row_employment['employment_visitdt'];
	$visitdt_time = $row_employment['employment_visitdt_time'];
	$com_name_full = $row_employment['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	if($member['mb_level'] > 6 || $row_employment['damdang_code'] == $member['mb_profile']) {
		$com_view = "acceleration_employment_view.php?id=".$com_code."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//������
	$damdang_code = $row_employment['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//�����
	$user_nick = $row_employment['manage_cust_name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	$check_ok = "�ű԰��";
	if($row_employment['employment_visit_kind'] == "�湮") $visit_kind = "(�湮)";
	else if($row_employment['employment_visit_kind'] == "�翬��") $visit_kind = "(�翬��)";
	else $visit_kind = "";
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style="<?=$memo_date_color?>"><?=$memo_date?><br><?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$check_ok?><br /><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>"><span style="font-weight:bold"><?=$com_name?></span></a>
								<?=$branch?> <? if($user_nick) echo $user_nick; ?>
							</td>
						</tr>
<?
}
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$job_time_id = $row['id'];
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$com_code = $row['com_code'];
	//ó����Ȳ
	$check_ok_id = $row['check_ok'];
	//�翬�� ��
	if($check_ok_id == 9) {
		//�湮����
		$memo_date = $row['recall'];
		$visitdt_time = "";
	} else {
		//�湮����
		$memo_date = $row['visitdt'];
		$visitdt_time = $row['visitdt_time'];
	}
	//���� ����
	//if($memo_date >= $today && $memo_date <= $search_eday) $memo_date_color = "color:#ff0000;";
	//else $memo_date_color = "";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		//$com_view = "client_memo_view.php?id=$com_code&w=u#40001";
		$com_view = "job_time_view.php?id=".$job_time_id."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//�޸� ����
	$visit_call_memo_full = $row['memo'];
	$visit_call_memo = cut_str($visit_call_memo_full, 28, "..");
	//ó����� �߰�
	$visit_call_memo_full .= "\n".$row['etc'];
	//�����
	$user_nick = $row['writer_name'];
	//�����
	$manager_name = $row['manager_name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	//$check_ok = $job_time_process_arry[$check_ok_id];
	$check_ok = "���â��";
	if($check_ok_id) {
		if($job_time_process_arry[$check_ok_id] == "�湮����") $visit_kind = "(�湮)";
		else $visit_kind = "(".$job_time_process_arry[$check_ok_id].")";
	} else {
		$visit_kind = "";
	}
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$memo_date = "-";
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style="<?=$memo_date_color?>"><?=$memo_date?><br><?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$check_ok?><br /><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>"><span style="font-weight:bold"><?=$com_name?></span></a>
								<?=$user_nick?> <? if($manager_name) echo $manager_name; ?>
							</td>
						</tr>
<?
}
if($k_electric_charges == 0 && $k == 0 && $i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ݿ� �湮/���� ��Ȳ�� �����ϴ�.</td></tr>";
?>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="height:26px;margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours1" name="expirehours1" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(1)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop1').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<?
}
?>
<!--�˾�1 ����-->
<?
$rs['po_id'] = 3;
//���� �˾� �ݱ� ���� 150824
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
if (trim($_COOKIE["it_ck_pop_".$rs['po_id']]) != "done") {
	$pop3_left = 84;
	$pop3_top = 265;
?>
<style type="text/css">
#pop3 {
	position:absolute;
	z-index:103;
	left:<?=$pop3_left?>px;
	top:<?=$pop3_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:440px;
}
</style>
<div id="pop3" class="clsDrag" style="display:none;">
	<img src="popup_images/erp_popup_160505.png" border="0" usemap="" />
	<div id="popup_close_bt" style="margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours3" name="expirehours3" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(3)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop3').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<map name="erp_popup_150720">
	<area shape="rect" coords="289,362,419,395" href="list_notice.php?bo_table=erp_schedule" alt="" />
	<area shape="rect" coords="289,540,420,574" href="job_time_list.php" alt="" />
</map>
<?
}
?>
<?
$rs['po_id'] = 4;
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
if (trim($_COOKIE["it_ck_pop_".$rs['po_id']]) != "done") {
	//�˾�2 ��ǥ
	$pop4_left = 496;
	$pop4_top = 61;
?>
<style type="text/css">
#pop4 {
	position:absolute;
	z-index:100;
	left:<?=$pop4_left?>px;
	top:<?=$pop4_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:600px;
}
</style>
<img src='images/notification_popup.png' style="display:none;width:1px;height:1px;">
<!--�˾� ���� style display:none;-->
<div id="pop4" class="clsDrag" style="display:;">
	<table width="600" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="background:url('images/notification_popup.png') no-repeat;padding:56px 0 0 0" valign="top">
				<div style="padding-left:8px;height:40px;color:white;">
<?
	$mb_id = $member['mb_id'];
	$sql_common = " from erp_alert ";
	if($member['mb_profile'] == 1) {
		$sql_search = " where read_main not like '%$mb_id%' ";
		if($mb_id == "kcmc1006" || $mb_id == "kcmc1007" || $mb_id == "kcmc2006") $sql_search .= " and ( send_to like '%$member[mb_id]%' ) ";
		else if($mb_id == "kcmc1004" || $mb_id == "kcmc1005") $sql_search .= " and ( send_to like '%manager%' ) ";
		//else if($mb_id == "kcmc1009") $sql_search .= " and ( send_to like '%$member[mb_id]%' or user_id='$mb_id' or send_to like '%kcmc1006%' or alert_code='50001' or alert_code='10004' or alert_code='10005' ) ";
		//�豹�� ���� : �ڼ��� ��� �˸� ���� 160414 / ������ �߰� 160919
		else if($mb_id == "kcmc1009") $sql_search .= " and ( send_to like '%$member[mb_id]%' or user_id='$mb_id' or send_to like '%electric%' or alert_code='50001' or alert_code='10004' or alert_code='10005' ) ";
		//�ѱ�����濵�� : ���ȣ 160602
		else if($mb_id == "kcmc1003") $sql_search .= " and ( user_id='$mb_id'  or send_to like '%kcmc1001%' ) ";
		else $sql_search .= " and ( send_to like '%$mb_id%' ) ";
		//��ǥ�� : ���ȣ ��� ���� �� �ڵ� ���� ���� 160711
		if($mb_id == "kcmc1001") $sql_search .= " and read_main not like '%kcmc1003%' ";
		//���� �˸� ���� (�α��� ID ��) 160120
		$sql_search .= " and del_main not like '%$member[mb_id]%' ";
	} else {
		$sql_search = " where ( branch='$member[mb_profile]' or branch2='$member[mb_profile]' ) and ( read_branch = '' ) ";
		//���� ������� ����
		if($member['mb_level'] == 5) {
			$sql_search .= " and (send_to like '%$mb_id%' or user_code='$manage_code') ";
		}
		//������� ��� ���� ���� 160706
		$sql_search .= " and send_to not like '%contractor%' ";
		//������� ��� ���� ���� / �޸� Ÿ�� 99 ����
		$sql_search .= " and memo_type!=99 ";
		//�뱸����(�������Ȯ��, �ű԰��Ȯ��) ���޻��� ���� �˸� ���� 161007
		if($member['mb_profile'] != 16) $sql_search .= " and user_name != '�뱸����' ";
	}
	//���� �ð����� ǥ�� 160629
	$sql_search .= " and ( wr_datetime < '$now_date_type 23:59:59' ) ";

	//ī��Ʈ
	$sql = " select count(*) as cnt $sql_common $sql_search ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];
	echo $total_count." ��";
?>
				</div>
				<div style="overflow-y:auto;height:290px;width:594px;margin:0 0 14px 0;" id="notification_div">
<?
	//����
	$sql_order = " order by idx desc ";
	$sql = " select *
						$sql_common
						$sql_search
						$sql_order
						limit 0, 6 ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 5;
?>
					<table width="560" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
						<tr>
							<td class="tdhead_center" width="72" rowspan="">�������</td>
							<td class="tdhead_center" width="108">������</td>
							<td class="tdhead_center" width="" rowspan="">����</td>
							<td class="tdhead_center" width="74" rowspan="">�����</td>
							<td class="tdhead_center" width="74" rowspan="">�����</td>
						</tr>
<?
	// ����Ʈ ���
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $total_count - $i - ($rows*($page-1));
		$list = $i%2;
		$idx = $row['idx'];
		//�ŷ�ó �ڵ�
		$id = $row['com_code'];
		//�������
		$reg_date = substr($row['wr_datetime'],0,10);
		//������
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 14, "..");
		//����
		$memo = $row['memo'];
		//�˸�����
		$alert_code = $row['alert_code'];
		//�����
		$sql_member = " select * from a4_member where mb_id = '$row[user_id]' ";
		$row_member = sql_fetch($sql_member);
		$mb_name = $row_member['mb_name'];
		$mb_nick = $row_member['mb_nick'];
		if($mb_name) {
			$reg_user = $mb_name;
			$reg_user_name = $mb_nick;
		} else {
			$reg_user = "-";
			$reg_user_name = "";
		}
		//�����
		$send_to_array = explode(",", $row['send_to']);
		$send_to = "";
		for($sta=0; $sta<=count($send_to_array);$sta++) {
			if($send_to_array[0]) {
				//echo $idx." ".$sta." ".$send_to_array[$sta]." / ";
				if($send_to_array[$sta] == "kcmc1007") $send_to = "<div>�繫��Ź</div>";
				else if($send_to_array[$sta] == "kcmc1006") $send_to .= "<div>������Ʒ�</div>";
				else if($send_to_array[$sta] == "kcmc1008") $send_to .= "<div>�븮�μ���</div>";
				else if($send_to_array[$sta] == "manager") $send_to .= "<div>������</div>";
				else if($send_to_array[$sta] == "kcmc1009") $send_to .= "<div>�����빫</div>";
				else if($send_to_array[$sta] == "branch") $send_to .= "<div>�������</div>";
				else if($send_to_array[$sta] == "kcmc1001") $send_to .= "<div>�Ѱ����</div>";
				else if($send_to_array[$sta] == "electric") $send_to .= "<div>������</div>";
			} else {
				$send_to = "��ü";
			}
		}
		//��ũ URL
		if($member['mb_level'] > 6 || $row['branch'] == $member['mb_profile'] || $row['branch2'] == $member['mb_profile']) {
			$client_process_view = "alert_read_link.php?link_url=process&idx=$idx&id=$id&w=u&alert_code=$alert_code";
		} else {
			$client_process_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
		}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style=""><?=$reg_date?></td>
							<td class="ltrow1_left_h22" title="<?=$com_name_full?>"><?=$com_name?></td>
							<td class="ltrow1_left_h22">
								<a href="<?=$client_process_view?>" style="font-weight:bold"><?=$memo?></a>
							</td>
							<td class="ltrow1_center_h22" style=""><?=$reg_user?></td>
							<td class="ltrow1_center_h22" style=""><?=$send_to?></td>
						</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�̿��� �˸��޼����� �����ϴ�.</td></tr>";
?>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours4" name="expirehours4" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(4)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop4').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<script type="text/JavaScript">
function notification_func() {
	//alert(getId('notification_div').style.height);
	getId('notification_div').style.height = "60px";
}
<?
	if($total_count == 0) {
?>
addLoadEvent(notification_func);
<?
	}
?>
</script>
<?
}
?>
<!--�˾�4 ����-->
<?
$rs[po_id] = 2;
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
if (trim($_COOKIE["it_ck_pop_".$rs[po_id]]) != "done") {
	//�˾�2 ��ǥ
	$pop2_left = 496;
	//�̿��� �˸��޼��� 0 ���� ��� top �� ����
	if($total_count == 0) {
		$pop2_top = 499-238;
	} else {
		$pop2_top = 499;
	}
	//���� ���� 151014 �뱸 ��ȭ�� ������ ���������� �˾� ������� ���� (IE ��ũ ȣȯ�� ����)
	//$pop2_top = 499;
	//������ DB
	$sql_common = " from erp_application ";
	if($member['mb_level'] > 6 || $search_ok == "ok") {
		$sql_search = " where 1=1 ";
		//���� ������� ����
		if($member['mb_level'] == 7) {
			$mb_nick = $member['mb_nick'];
			$sql_search .= " and person_charge='$mb_nick' ";
		}
	} else {
		$sql_search = " where 1=1 and ( damdang_code_app='$member[mb_profile]' or damdang_code_app2='$member[mb_profile]' ) ";
		//���� ������� ����
		if($member['mb_level'] == 5) {
			$mb_nick = $member['mb_nick'];
			$sql_search .= " and person_charge='$mb_nick' ";
		}
	}
	//������ ��û (�⺻ �˻�)
	$sql_search .= " and ( application_kind != '0' and application_kind != '' ) ";
	//�ݿ� �˻�
	$today = date("Y.m.d");
	$this_month_start = date("Y.m.01");
	$this_month_last_day = date('t', strtotime($this_month_start));
	$this_month_end = date("Y.m").".".$this_month_last_day;
	$search_sday = $this_month_start;
	$search_eday = $this_month_end;
	//���� �˻��Ⱓ ���� �ݿ�
	/*
	$stx_search_day_chk = "2";
	$search_day1 = 1;
	//�˻� : �˻��Ⱓ
	if($stx_search_day_chk) {
		$sst = "idx";
		$sod = "desc";
		if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " and ( ";
		//����������
		if($search_day1) {
			$sql_search .= " (reapplication_date >= '$search_sday' and reapplication_date <= '$search_eday') ";
			$sst = "reapplication_date";
		}
		if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " ) ";
	}
	*/
	$sql_search .= " and application_accept = '' ";
	//�ݿ� ���� ���� �˻�
	$sql_search .= " and (reapplication_date <= '$search_eday' and reapplication_date != '') ";
	//���û �ݿ� ���� ī��Ʈ
	$sql = " select count(*) as cnt $sql_common $sql_search ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];
	if($total_count >= 2 && $total_count <= 11) $popup2_height = (22*$total_count)+62;
	else if($total_count <= 1) $popup2_height = 22+62;
	else $popup2_height = 298;
?>
<style type="text/css">
#pop2 {
	position:absolute;
	z-index:100;
	left:<?=$pop2_left?>px;
	top:<?=$pop2_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:600px;
}
</style>
<img src='images/reapplication_popup.png' style="display:none;width:1px;height:1px;">
<div id="pop2" class="clsDrag" style="display:;">
	<table width="600" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="background:url('images/reapplication_popup.png') no-repeat;padding:56px 0 10px 0" valign="top">
				<div style="height:40px;width:594px;padding:0 0 0 8px;color:white;">
					<?=$total_count?> ��
				</div>
				<div style="overflow-y:auto;height:<?=$popup2_height?>px;width:594px;">
<?
//����
if (!$sst) {
    $sst = "reapplication_date";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql;
$result = sql_query($sql);
$colspan = 5;
?>
					<table width="560" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
						<tr>
							<td class="tdhead_center" width="72" rowspan="">����������</td>
							<td class="tdhead_center" rowspan="">������</td>
							<td class="tdhead_center" width="120" rowspan="">��û����</td>
							<td class="tdhead_center" width="74" rowspan="">�������</td>
							<td class="tdhead_center" width="66" rowspan="">ó����Ȳ</td>
						</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//��û����
	$application_kind_code = $row['application_kind'];
	$application_kind = $support_kind_array[$application_kind_code];
	//����������
	if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
	else $reapplication_date = "-";
	//���������� ����
	if($search_day1) {
		if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
		else $reapplication_date_color = "";
	}
	//������
	$com_name_full = $row['com_name_app'];
	$com_name = cut_str($com_name_full, 28, "..");
	//������
	$sql_a4 = " select * from com_list_gy where com_code = '$id' ";
	$row_a4 = sql_fetch($sql_a4);
	$damdang_code = $row_a4['damdang_code'];
	if($damdang_code) {
		$branch = $man_cust_name_arry[$damdang_code];
		if($row_a4['damdang_code2']) {
			$damdang_code2 = $row_a4['damdang_code2'];
			$branch .= ">".$man_cust_name_arry[$damdang_code2];
		}
	} else {
		$branch = "-";
	}
	//ó����Ȳ
	if(!$row['application_accept']) $application_accept = "������";
	else $application_accept = "�����Ϸ�";
	//��ũ URL
	if($member['mb_level'] > 6 || $row['damdang_code_app'] == $member['mb_profile'] || $row['damdang_code_app2'] == $member['mb_profile']) {
		//$com_view = "client_process_view.php?id=$id&w=u#40001";
		$com_view = "client_application_view.php?id=$id&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style="<?=$reapplication_date_color?>"><?=$reapplication_date?></td>
							<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
								<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a>
							</td>
							<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
							<td class="ltrow1_center_h22" style=""><?=$branch?></td>
							<td class="ltrow1_center_h22" style=""><?=$application_accept?></td>
						</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ݿ� ������ ���û ��Ȳ�� �����ϴ�.</td></tr>";
?>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours2" name="expirehours2" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(2)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop2').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<?
}
?>
<!--�˾�2 ����-->
<?
$rs['po_id'] = 5;
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
//���� ���� : ������, ������, ����, ���������� 151109
if($mb_id != "master" && $mb_id != "kcmc1002" && $mb_id != "kcmc1004" && $mb_id != "kcmc1008") $_COOKIE["it_ck_pop_".$rs['po_id']] = "done";
if(trim($_COOKIE["it_ck_pop_".$rs['po_id']]) != "done") {
	//�˾�1 ��ǥ
	$pop_left = 84;
	$pop_top = 499;
?>
<style type="text/css">
#pop5 {
	position:absolute;
	z-index:100;
	left:<?=$pop_left?>px;
	top:<?=$pop_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:400px;
}
</style>
<div id="pop5" class="clsDrag" style="display:" onmouseover="showM('900')">
<?
//������������ ������ ��Ȳ �˾� �ӽú��� 151030
if($popup_temp) {
?>
	<table width="400" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="background:url('images/remainder_date_popup.png') no-repeat;padding-top:96px" valign="top">
				<div style="overflow-y:auto;height:290px;width:394px" id="remainder_date_div">
<?
	//������������
	if($member['mb_level'] == 6) $sql_search = " a.damdang_code='$member[mb_profile]' and ";
	else $sql_search = "";
	$sql_search .= " a.com_code = b.com_code and a.remainder_date != '' ";
	$sql_common = " from com_list_gy a, com_list_gy_opt b where ";
	$sql_electric_charges = " select * $sql_common $sql_search order by a.remainder_date desc ";
	$result_electric_charges = sql_query($sql_electric_charges);
	$colspan = 3;
	//ī��Ʈ
	$sql = " select count(*) as cnt $sql_common $sql_search ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];
?>
											<table width="360" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
												<tr>
													<td class="tdhead_center" width="72" rowspan="">����</td>
													<td class="tdhead_center" width="62" rowspan="">ó����Ȳ</td>
													<td class="tdhead_center" rowspan="">������</td>
												</tr>
<?
	// ����Ʈ ���
	for ($i=0; $row_electric_charges=sql_fetch_array($result_electric_charges); $i++) {
		//�ŷ�ó �ڵ�
		$com_code = $row_electric_charges['com_code'];
		//����
		$memo_date = $row_electric_charges['remainder_date'];
		$visitdt_time = $row_electric_charges['electric_charges_visitdt_time'];
		$com_name_full = $row_electric_charges['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		if($member['mb_level'] > 6 || $row_electric_charges['damdang_code'] == $member['mb_profile']) {
			$com_view = "electric_charges_view.php?id=".$com_code."&w=u";
		} else {
			$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
		}
		//������
		$damdang_code = $row_electric_charges['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		//�����
		$user_nick = $row_electric_charges['manage_cust_name'];
		//���� �迭
		$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
		$this_date_chk = explode(".", $memo_date);
		$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
		$yoil_chk = date("w", strtotime($this_date));
		$yoil_text = $doms[$yoil_chk];
		//�翬����, �湮���� ���� ���
		if(!$memo_date) {
			$yoil_text = "";
		} else {
			$yoil_text = "(".$yoil_text.")";
		}
		//ó����Ȳ
		$check_ok_id = $row_electric_charges['electric_charges_process'];
		$electric_charges_process = $electric_charges_process_arry[$check_ok_id]
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22" style="<?=$memo_date_color?>"><?=$memo_date?><br><?=$yoil_text?></td>
													<td class="ltrow1_center_h22" style=""><?=$electric_charges_process?></td>
													<td class="ltrow1_left_h22">
														<a href="<?=$com_view?>"><span style="font-weight:bold"><?=$com_name?></span></a>
														<?=$branch?> <? if($user_nick) echo $user_nick; ?>
													</td>
												</tr>
<?
	}
	if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">������������ ������ ��Ȳ�� �����ϴ�.</td></tr>";
?>
											</table>
				</div>
			</td>
		</tr>
	</table>
<?
//������������ ������ ��Ȳ �˾� �ӽú��� 151030
}
//������ �ܱݽ�û ��Ȳ 151030
?>
	<table width="400" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="background:url('images/app_remainder_date_popup.png') no-repeat;padding:56px 0 10px 0;" valign="top">
				<div style="padding-left:8px;height:40px;color:white;">
<?
	//������DB
	if($member['mb_level'] == 6) $sql_search = " a.damdang_code='$member[mb_profile]' and ";
	else $sql_search = "";
	$sql_search .= " a.com_code = b.com_code and b.remainder_date != '' and b.reapplication_done != 3 ";
	//�ܱ������� �̿����� ǥ��
	$next_month_start = date("Y.m.01",strtotime("51month"));
	$next_month_last_day = date('t', strtotime($next_month_start));
	$next_month_end = date("Y.m",strtotime("+1month")).".".$next_month_last_day;
	$sql_search .= " and ( b.remainder_date <= '$next_month_end' ) ";
	$sql_common = " from com_list_gy a, erp_application b where ";
	$sql_remainder = " select * $sql_common $sql_search order by b.remainder_date desc ";
	$result_remainder = sql_query($sql_remainder);
	$colspan = 3;
	//ī��Ʈ
	$sql = " select count(*) as cnt $sql_common $sql_search ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];
	echo $total_count." ��";
	if($total_count >= 2 && $total_count <= 7) $popup5_height = (36*$total_count)+46;
	else if($total_count <= 1) $popup5_height = 36+46;
	else $popup5_height = 290;
?>
				</div>
				<div style="overflow-y:auto;height:<?=$popup5_height?>px;width:394px" id="remainder_date_div">
					<table width="360" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
						<tr>
							<td class="tdhead_center" width="72" rowspan="">����</td>
							<td class="tdhead_center" width="72" rowspan="">�ܱ�/�г�</td>
							<td class="tdhead_center" rowspan="">������</td>
						</tr>
<?
	// ����Ʈ ���
	for ($i=0; $row_remainder=sql_fetch_array($result_remainder); $i++) {
		//�ŷ�ó �ڵ�
		$com_code = $row_remainder['com_code'];
		//����
		$memo_date = $row_remainder['remainder_date'];
		$visitdt_time = $row_remainder['remainder_visitdt_time'];
		$com_name_full = $row_remainder['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		if($member['mb_level'] > 6 || $row_remainder['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=".$com_code."&w=u";
		} else {
			$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
		}
		//������
		$damdang_code = $row_remainder['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		//������
		$damdang_code2 = $row_remainder['damdang_code2'];
		if($damdang_code) $branch2 = $man_cust_name_arry[$damdang_code2];
		else $branch2 = "-";
		//���� �迭
		$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
		$this_date_chk = explode(".", $memo_date);
		$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
		$yoil_chk = date("w", strtotime($this_date));
		$yoil_text = $doms[$yoil_chk];
		//�翬����, �湮���� ���� ���
		if(!$memo_date) {
			$yoil_text = "";
		} else {
			$yoil_text = "(".$yoil_text.")";
		}
		//ó����Ȳ
		$check_ok_id = $row_remainder['remainder_process'];
		$remainder_process = $remainder_process_arry[$check_ok_id];
		//�ܱ�
		if($row_remainder['remainder']) $remainder = number_format($row_remainder['remainder']);
		else $remainder = "-";
		//�г�
		if($row_remainder['electric_charges_installment']) $electric_charges_installment = "(".$row_remainder['electric_charges_installment']."ȸ)";
		else $electric_charges_installment = "";
		//������ ����
		$application_kind_app_no = $row_remainder['application_kind'];
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style="<?=$memo_date_color?>"><?=$memo_date?><br /><?=$yoil_text?></td>
							<td class="ltrow1_right_h22" style=""><?=$remainder?><br /><?=$electric_charges_installment?></td>
							<td class="ltrow1_left_h22">
								<a href="<?=$com_view?>"><span style="font-weight:bold"><?=$com_name?></span></a>
								<?=$branch?><? if($branch2) echo ">".$branch2; ?>
								<br />
								<?=$support_kind_array[$application_kind_app_no];?>
<?
		//�������������� ��� ó����Ȳ ǥ�� 161124
		if($application_kind_app_no == 23) {
			$electric_charges_process = $row_remainder['electric_charges_process'];
			echo "(".$electric_charges_process_arry[$electric_charges_process].")";
		}
?>
							</td>
						</tr>
<?
	}
	if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">��ϵ� �����Ͱ� �����ϴ�.</td></tr>";
?>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours5" name="expirehours5" value="24" style="display:none" checked /></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(5)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop5').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<script type="text/JavaScript">
function remainder_date_func() {
	//alert(getId('remainder_date_div').style.height);
	getId('remainder_date_div').style.height = "60px";
}
function remainder_date_func1() { getId('remainder_date_div').style.height = "80px"; }
function remainder_date_func2() { getId('remainder_date_div').style.height = "160px"; }
<?
	if($total_count == 0) {
?>
addLoadEvent(remainder_date_func);
<?
	} else if($total_count == 1) {
?>
addLoadEvent(remainder_date_func1);
<?
	} else if($total_count == 2) {
?>
addLoadEvent(remainder_date_func2);
<?
	}
?>
</script>
<?
}
?>
<!--�˾�5 ����-->
<script type="text/JavaScript">
// ��Ű �Է�
function set_cookie(name, value, expirehours, domain) {
		var today = new Date();
		today.setTime(today.getTime() + (60*60*1000*expirehours));
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
		if (domain) {
				document.cookie += "domain=" + domain + ";";
		}
		//alert(domain);
}
// ��Ű ����
function get_cookie(name) {
		var find_sw = false;
		var start, end;
		var i = 0;
		for (i=0; i<= document.cookie.length; i++)
		{
				start = i;
				end = start + name.length;
				if(document.cookie.substring(start, end) == name) 
				{
						find_sw = true
						break
				}
		}
		if (find_sw == true) 
		{
				start = end + 1;
				end = document.cookie.indexOf(";", start);
				if(end < start)
						end = document.cookie.length;
				return document.cookie.substring(start, end);
		}
		return "";
}
// ��Ű ����
function delete_cookie(name) {
		var today = new Date();
		today.setTime(today.getTime() - 1);
		var value = get_cookie(name);
		if(value != "")
				document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}
//��Ű ��ü ����
function delete_cookie_all() {
	delete_cookie('it_ck_pop_1');
	delete_cookie('it_ck_pop_2');
	delete_cookie('it_ck_pop_3');
	delete_cookie('it_ck_pop_4');
	delete_cookie('it_ck_pop_5');
	alert("���������� �˾� ���� �Ǿ����ϴ�.");
	location.reload();
}

function layer_close(id) {
	var obj = document.getElementById("expirehours"+ id);
	if (obj.checked == true) {
		set_cookie("it_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	document.getElementById("pop"+id).style.display = "none";
	selectbox_visible();
}
function selectbox_hidden(layer_id) { 
	var ly = eval(layer_id); 
	// ���̾� ��ǥ 
	var ly_left  = ly.offsetLeft; 
	var ly_top    = ly.offsetTop; 
	var ly_right  = ly.offsetLeft + ly.offsetWidth; 
	var ly_bottom = ly.offsetTop + ly.offsetHeight; 
	// ����Ʈ�ڽ��� ��ǥ 
	var el; 
	for(i=0; i<document.forms.length; i++) { 
		for(k=0; k<document.forms[i].length; k++) { 
			el = document.forms[i].elements[k];    
			if (el.type == "select-one") { 
				var el_left = el_top = 0; 
				var obj = el; 
				if(obj.offsetParent) { 
					while (obj.offsetParent) { 
							el_left += obj.offsetLeft; 
							el_top  += obj.offsetTop; 
							obj = obj.offsetParent; 
						} 
				} 
				el_left  += el.clientLeft; 
				el_top    += el.clientTop; 
				el_right  = el_left + el.clientWidth; 
				el_bottom = el_top + el.clientHeight; 
				// ��ǥ�� ���� ���̾ ����Ʈ �ڽ��� ħ�������� ����Ʈ �ڽ��� hidden ��Ŵ 
				if ( (el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || 
					(el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) || 
					(el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) || 
					(el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) ) 
					el.style.visibility = 'hidden'; 
			} 
		}
	}
} 
// ���߾��� ����Ʈ �ڽ��� ��� ���̰� �� 
function selectbox_visible() {
	for(i=0; i<document.forms.length; i++) { 
		for(k=0; k<document.forms[i].length; k++) { 
			el = document.forms[i].elements[k];    
			if(el.type == "select-one" && el.style.visibility == 'hidden') 
				el.style.visibility = 'visible'; 
		} 
	} 
}
</script>