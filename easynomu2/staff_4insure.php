<?
$sub_menu = "200500";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//����� Ÿ��
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//�ɼ�DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";
//ȭ��������κθ�ȸ : Ȱ�������� ����
if($comp_print_type == "H") {
	$sql_search .= " and ( b.position = '13' ) ";
}
// �˻� : �μ�
if ($stx_dept) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.dept = '$stx_dept') ";
	$sql_search .= " ) ";
}
//echo $stx_name;
// �˻� : ����
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ���
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
//�˻� : ��濩��
//echo $stx_get_ok;
//exit;
if ($stx_get_ok == '0') {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '$stx_get_ok') ";
	$sql_search .= " ) ";
} else if ($stx_get_ok == 1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '') ";
	$sql_search .= " ) ";
}
//�˻� : ��������
if(!$stx_emp_stat) $stx_emp_stat = "0";
if ($stx_emp_stat != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (a.gubun = '$stx_emp_stat') ";
	$sql_search .= " ) ";
}
//�˻� : �ӽ����
if($stx_out_temp == "no") $stx_out_temp_var = "";
if($stx_out_temp != "all") {
	if($stx_out_temp == 1) $stx_out_temp_var = 1;
	$sql_search .= " and ( ";
	$sql_search .= " (a.out_temp = '$stx_out_temp_var') ";
	$sql_search .= " ) ";
}
//����
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//���� 1����
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1['item'];
$sod1 = $row1['sod'];
//���� 2����
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2['item'];
$sod2 = $row2['sod'];
//���� 3����
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3['item'];
$sod3 = $row3['sod'];
//���� 4����
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4['item'];
$sod4 = $row4['sod'];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 25;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "4�뺸��Ű�(Ȱ��������)";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;

//�˻� �Ķ���� ����
$qstr  = "stx_dept=".$stx_dept."&amp;stx_name=".$stx_name."&amp;stx_sabun=".$stx_sabun."&amp;stx_work_form=".$stx_work_form."&amp;stx_emp_stat=".$stx_emp_stat."&amp;stx_out_temp=".$stx_out_temp."&amp;sst=".$sst."&amp;sod=".$sod;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function func_4insure(mode) {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";
	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	var msg = "";
	if(mode == "in") msg = "���� ���Ű� �Ͻðڽ��ϱ�?";
	else if(mode == "out") msg = "���� ��ǽŰ� �Ͻðڽ��ϱ�?";
	else if(mode == "modify") msg = "���� ����Ű� �Ͻðڽ��ϱ�?";
	if(cnt==0) {
	 alert("���õ� �ٷ��ڰ� �����ϴ�.");
	 return;
	} else{
		if(confirm(msg)) {
			var url = "staff_4insure_in.php";
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action = url;
			frm.submit();
		} else {
			return;
		}
	} 
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "H") {
	include "./inc/left_menu2_type_h.php";
} else {
	include "./inc/left_menu2.php";
}
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--Ÿ��Ʋ -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!--������ -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												�˻�
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
							<!--�˻� -->
							<form name="searchForm" method="get">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td nowrap class="tdrowk"><b>�μ�</b></td>
										<td nowrap class="tdrow">
											<select name="stx_dept" class="selectfm">
												<option value="">��ü</option>
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$com_code' order by code ";
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept[code]?>" <? if($stx_dept == $row_dept[code]) echo "selected"; ?> ><?=$row_dept[name]?></option>
												<?
												}
												?>
											</select>
										</td>
										<td nowrap class="tdrowk">����</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk">��������</td>
										<td nowrap class="tdrow">
											<select name="stx_emp_stat" class="selectfm">
												<option value="all">��ü</option>
												<option value="0" <? if($stx_emp_stat == '0') echo "selected"; ?> >����</option>
												<option value="1" <? if($stx_emp_stat == '1') echo "selected"; ?> >����</option>
												<option value="2" <? if($stx_emp_stat == '2') echo "selected"; ?> >����</option>
											</select>
										</td>
										<td nowrap class="tdrowk">�ӽ����</td>
										<td nowrap class="tdrow">
											<select name="stx_out_temp" class="selectfm">
												<option value="all">��ü</option>
												<option value="1" <? if($stx_out_temp == '1') echo "selected"; ?> >�ӽ����</option>
												<option value="no" <? if($stx_out_temp == 'no') echo "selected"; ?> >������</option>
											</select>
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												����Ʈ
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom" style="padding:0 0 0 10px"><b>�� <?=$total_count?>��</b> (������ Ŭ�� �� �� ������ �� �� �ֽ��ϴ�.)</td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--��޴� -->

							<!--����Ʈ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
<?
//���� ���
if($sod == "asc") $sod_sort = "desc";
else $sod_sort = "asc";
$sort_name = $PHP_SELF."?page=".$page."&sst=a.name&sod=".$sod_sort;
$sort_position = $PHP_SELF."?page=".$page."&sst=b.position&sod=".$sod_sort;
$sort_jumin_no = $PHP_SELF."?page=".$page."&sst=a.jumin_no&sod=".$sod_sort;
$sort_in_day = $PHP_SELF."?page=".$page."&sst=a.in_day&sod=".$sod_sort;
$sort_out_day = $PHP_SELF."?page=".$page."&sst=a.out_day&sod=".$sod_sort;
$sort_dept = $PHP_SELF."?page=".$page."&sst=b.dept_1&sod=".$sod_sort;

if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="156">�����</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="34">��ȣ</td>
									<td nowrap class="tdhead_center" width=""><a href="<?=$sort_name?>">����</a></td>
									<td nowrap class="tdhead_center" width="78"><a href="<?=$sort_position?>">����</a></td>
									<td nowrap class="tdhead_center" width="105"><a href="<?=$sort_dept?>">�μ�</a></td>
									<td nowrap class="tdhead_center" width="100"><a href="<?=$sort_jumin_no?>">�ֹε�Ϲ�ȣ</a></td>
									<td nowrap class="tdhead_center" width="50">������</a></td>
									<td nowrap class="tdhead_center" width="70"><a href="<?=$sort_in_day?>">�Ի���</a></td>
									<td nowrap class="tdhead_center" width="70"><a href="<?=$sort_out_day?>">�����</a></td>
									<td nowrap class="tdhead_center" width="200">��濩��</td>
									<td nowrap class="tdhead_center" width="70">��������</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - ($total_count - $i - ($rows*($page-1))) + 1;
  $list = $i%2;
	//����� �ڵ� / ��� / �ڵ�_���
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// ������ : ������ڵ�
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$code' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row[name], 6, "..");
	//�Ի���/�����
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//����� ǥ��
	if($row[out_day] == "..") $out_text = "";
	else if($row[out_day] == "") $out_text = "";
	else $out_text = "(���)";
	//����
	$position = " ";
	if($row[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
		if($position == "�ܽð��ٷ���") $position = "�ܽð�<br>�ٷ���";
	}
	//�μ�
	//$dept = $row[dept_1];
	if($row[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row[dept] ";
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
		if($dept == "��������(����)") $dept = "��������<br>(����)";
		else if($dept == "�Ⱦ�����(����)") $dept = "�Ⱦ�����<br>(����)";
		else if($dept == "��������(�븮����)") $dept = "��������<br>(�븮����)";
		else if($dept == "�Ⱦ�����(�븮����)") $dept = "�Ⱦ�����<br>(�븮����)";
	} else {
		$dept = "-";
	}
	//�ֹε�Ϲ�ȣ �� �ټ��ڸ� ��ǥ ó��
	$jumin_no = substr($row[jumin_no],0,9)."*****";
	//������
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//���ο��� ��60�� �ش� ���
	if($age_cal >= 60) {
		$color_km = "style='color:red' title='�� 60�� �̻� �ٷ���'";
	} else {
		$color_km = "";
	}
	//���뺸�� ��65�� �ش� ���
	if($age_cal >= 65) {
		$color_gy = "style='color:red' title='�� 65�� �̻� �ٷ���'";
	} else {
		$color_gy = "";
	}
	//�޿�����
	if($row[pay_gbn] == "0") $pay_gbn = "������";
	else if($row[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row[pay_gbn] == "3") $pay_gbn = "������";
	else $pay_gbn = "-";
	//��������
	if($row[gubun] == "0") $emp_stat = "����";
	else if($row[gubun] == "1") $emp_stat = "����";
	else if($row[gubun] == "2") $emp_stat = "<span style='color:red'>����</span>";
	//�ٷΰ�༭
	$url_work = "work_contract.php?id=$id&code=$code&page=$page";
	//����������Ű�
	$url_pay_modify = "a4_modify_write.php?mode=in&sabun=".$id."&code=".$code."&page=".$page;
	//�ٷΰ�༭ -> ����Ű�
	$work_contract = "<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href='$url_pay_modify' target=''>����Ű�</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>";
	//����ó
	if(!$row[add_tel]) {
		$tel_cel = $row[emp_cel];
	} else {
		$tel_cel = $row[add_tel];
	}
	//������� ��ũ
	$staff_url = "javascript:alert('������� ������ ���� ������� �������� �̵��մϴ�.');self.location.href='staff_view.php?w=u&id=$id&code=$code&page=$page';";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_left_h22" style="padding:4px"><?=$com_name?>&nbsp;</td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_center_h22">
										<a href="<?=$staff_url?>"><b><?=$name?></b></a>
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$position?></td>
									<td nowrap class="ltrow1_center_h22"><?=$dept?></td>
									<td nowrap class="ltrow1_center_h22"><?=$jumin_no?></td>
									<td nowrap class="ltrow1_center_h22">�� <?=$age?></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_center_h22">
										<!--��濩�� ������ 0 ��-->
										<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> ><span <?=$color_gy?>>����</span>
										<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >����
										<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> ><span <?=$color_km?>>����</span>
										<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >�ǰ�
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$emp_stat?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<?
}
?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
							<input type="checkbox" name="idx" value="" style="display:none">

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_4insure_in = "alert_demo();";
	$url_4insure_out = "alert_demo();";
	$url_4insure_modify = "alert_demo();";
	$url_4insure_modify_auto = "alert_demo();";
} else {
	$url_4insure_in = "func_4insure('in');";
	$url_4insure_out = "func_4insure('out');";
	$url_4insure_modify = "func_4insure('modify');";
	$url_4insure_modify_auto = "location.href='staff_4insure_modify_auto.php';";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="#url_4insure_in" onclick="<?=$url_4insure_in?>return false;"><img src="images/btn_4insure_in.png" border="0" /></a>
										<a href="#url_4insure_out" onclick="<?=$url_4insure_out?>return false;"><img src="images/btn_4insure_out.png" border="0" /></a>
										<a href="#url_4insure_modify" onclick="<?=$url_4insure_modify?>return false;"><img src="images/btn_4insure_modify.png" border="0" /></a>
										<a href="#url_4insure_modify_auto" onclick="<?=$url_4insure_modify_auto?>return false;"><img src="images/btn_4insure_modify_auto.png" border="0" /></a>
									</td>
								</tr>
							</table>
							</form>

						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>