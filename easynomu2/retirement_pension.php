<?
$sub_menu = "200400";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//���� ����
//$now_year = date("Y");
$now_year = 2015;

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
//ȭ��������κθ�ȸ : ������� ����
if($comp_print_type == "H") {
	if($kind == "beistand") $sql_search .= " and ( b.position = '13' ) ";
	else if($kind == "helper") $sql_search .= " and ( b.position = '14' ) ";
	else $sql_search .= " and ( b.position != '13' and b.position != '14' ) ";
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
	$sql_search .= " (a.name like '%$stx_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ���
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// �˻� : ä������
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
// �˻� : ��濩��
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
//if(!$stx_emp_stat) $stx_emp_stat = "0";
if(!$stx_emp_stat) $stx_emp_stat = "all";
if ($stx_emp_stat != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (a.gubun = '$stx_emp_stat') ";
	$sql_search .= " ) ";
}
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
//���� 4����
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

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
$total_count = $row[cnt];
//������ ���� ��ü����
if($page == "all") $rows = 100;
else $rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";
if($kind == "beistand") $kind_text = "(Ȱ��������)";
else if($kind == "helper") $kind_text = "(����)";
else $kind_text = "(�����)";
$sub_title = "��������".$kind_text;
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;
//�˻� �Ķ���� ����
$qstr  = "kind=".$kind."&stx_dept=".$stx_dept."&stx_name=".$stx_name."&stx_sabun=".$stx_sabun."&stx_work_form=".$stx_work_form."&stx_emp_stat=".$stx_emp_stat."&sst=".$sst."&sod=".$sod;
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
function checked_ok() {
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
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="staff_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//�޿�����
function pay_copy(id) {
	var ret = window.open("./popup/staff_pay_copy.php?id="+id, "pay_copy", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	return;
}
//�������
function printIt(printThis)  {
	var win=null;
	win = window.open();
	self.focus();
	win.document.open();
	win.document.write('<'+'html'+'><'+'head'+'>');
	win.document.write("<"+"link rel='stylesheet' type='text/css' href='http://easynomu.com/easynomu2/css/style.css'"+">");
	win.document.write("<"+"link rel='stylesheet' type='text/css' href='http://easynomu.com/easynomu2/css/style_admin.css'"+">");
	win.document.write('<'+'/'+'head'+'>');
	win.document.write("<"+"body style='text-align:center'"+">");
	win.document.write("<"+"div style='width:910px'"+">");
	win.document.write(printThis);
	win.document.write("<"+"/"+"div"+">");
	win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
	win.document.close();
	win.print();
	win.close();
}
//�������� ������ ��� ����
function rp_sum_func(year, code, id) {
	var ret = window.open("./retirement_popup.php?year="+year+"&code="+code+"&id="+id, "retirement_popup", "width=200, height=370, toolbar=no, menubar=no, scrollbars=yes, resizable=no" );
	return;
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
								<input type="hidden" name="kind" value="<?=$kind?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="7%">
									<col width="16%">
									<col width="7%">
									<col width="15%">
									<col width="10%">
									<col width="">
									<col width="10%">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><b>�μ�</b></td>
										<td nowrap class="tdrow">
											<select name="stx_dept" class="selectfm">
												<option value="">��ü</option>
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$com_code' and ( code >= 3 and code <= 6 ) order by code ";
												//echo $sql_dept;
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept[code]?>" <? if($stx_dept == $row_dept[code]) echo "selected"; ?> ><?=$row_dept[name]?></option>
												<?
												}
												?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">ä������</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">��ü</option>
												<option value="1" <? if($stx_work_form == 1) echo "selected"; ?> >������</option>
												<option value="2" <? if($stx_work_form == 2) echo "selected"; ?> >�����</option>
												<option value="3" <? if($stx_work_form == 3) echo "selected"; ?> >�Ͽ���</option>
												<option value="4" <? if($stx_work_form == 4) echo "selected"; ?> >����ҵ�</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������</td>
										<td nowrap class="tdrow">
											<select name="stx_emp_stat" class="selectfm">
												<option value="all">��ü</option>
												<option value="0" <? if($stx_emp_stat == '0') echo "selected"; ?> >����</option>
												<option value="1" <? if($stx_emp_stat == '1') echo "selected"; ?> >����</option>
												<option value="2" <? if($stx_emp_stat == '2') echo "selected"; ?> >����</option>
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
							<div id="printme">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
								<tr>
<?
//���� ���
if($sod == "asc") $sod_sort = "desc";
else $sod_sort = "asc";
$sort_name = $PHP_SELF."?page=".$page."&sst=a.name&sod=".$sod_sort;
$sort_position = $PHP_SELF."?page=".$page."&sst=b.position&sod=".$sod_sort;
$sort_jumin_no = $PHP_SELF."?page=".$page."&sst=a.jumin_no&sod=".$sod_sort;
$sort_in_day = $PHP_SELF."?page=".$page."&sst=a.in_day&sod=".$sod_sort;
$sort_dept = $PHP_SELF."?page=".$page."&sst=b.dept_1&sod=".$sod_sort;

if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="156" rowspan="2">�����</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="34" rowspan="2">��ȣ</td>

									<td nowrap class="tdhead_center" width="" rowspan="2"><a href="<?=$sort_name?>">����</a></td>
									<td nowrap class="tdhead_center" width="78" rowspan="2"><a href="<?=$sort_position?>">����</a></td>
									<td nowrap class="tdhead_center" width="108" rowspan="2"><a href="<?=$sort_dept?>">�μ�</a></td>
									<td nowrap class="tdhead_center" width="80" rowspan="2"><a href="<?=$sort_jumin_no?>">�ֹι�ȣ<br>������</a></td>
									<td nowrap class="tdhead_center" width="80" rowspan="2"><a href="<?=$sort_in_day?>">�Ի���<br>�����</a></td>
									<td nowrap class="tdhead_center" width="80" colspan="6">��������</td>
								</tr>
								<tr>
									<td nowrap class="tdhead_center" width="68"><?=$now_year-3?></td>
									<td nowrap class="tdhead_center" width="68"><?=$now_year-2?></td>
									<td nowrap class="tdhead_center" width="68"><?=$now_year-1?></td>
									<td nowrap class="tdhead_center" width="68"><?=$now_year?></td>
									<td nowrap class="tdhead_center" width="68"><?=$now_year+1?></td>
									<td nowrap class="tdhead_center" width="74">�Ѿ�</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
	//$no = $i + 1;
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
	//ä������
	if($row[work_form] == "") $work_form = "-";
	else if($row[work_form] == "1") $work_form = "������";
	else if($row[work_form] == "2") $work_form = "�����";
	else if($row[work_form] == "3") $work_form = "�Ͽ���";
	else $work_form = "-";
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
	//��� �߰� DB
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//����
	$position = " ";
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
		if($position == "�ܽð��ٷ���") $position = "�ܽð�<br>�ٷ���";
	}
	//�μ�
	//$dept = $row2[dept_1];
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
		if($dept == "������(����)") $dept = "������<br>(����)";
		else if($dept == "�Ⱦ�����(����)") $dept = "�Ⱦ�����<br>(����)";
		else if($dept == "������(�븮����)") $dept = "������<br>(�븮����)";
		else if($dept == "�Ⱦ�����(�븮����)") $dept = "�Ⱦ�����<br>(�븮����)";
	} else {
		$dept = "-";
	}
	//�ֹε�Ϲ�ȣ �� �ټ��ڸ� ��ǥ ó��
	$jumin_no = substr($row[jumin_no],0,9)."*";
	//������
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//�ٷνð�
	$work_gbn = $row2[work_gbn];
	$sql_time = " select * from a4_work_time where com_code = '$code' and work_gbn = '$work_gbn' ";
	$result_time = sql_query($sql_time);
	$row_time = sql_fetch_array($result_time);
	$work_gbn_text = $row_time[work_gbn_text];
	if($work_gbn_text) $work_gbn_text = cut_str($work_gbn_text, 8, "..");
	//�޿�����
	if($row2[pay_gbn] == "0") $pay_gbn = "������";
	else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row2[pay_gbn] == "3") $pay_gbn = "������";
	else if($row2[pay_gbn] == "4") $pay_gbn = "�ϱ���";
	else if($row2[pay_gbn] == "5") $pay_gbn = "����ҵ�";
	else $pay_gbn = "-";
	//�������� �Ѿ�
	$rp_sum_sum = 0;
	$rp_month = 0;
	for($y=($now_year-3);$y<=($now_year+1);$y++) {
		$sql_rp = " select sum(retirement_pension) as rp_sum from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$y' ";
		//echo $sql_rp."<br />";
		$result_rp = sql_query($sql_rp);
		$row_rp = sql_fetch_array($result_rp);
		$rp_sum[$y] = $row_rp['rp_sum'];
		$rp_sum_sum += $rp_sum[$y];
		$sql_rp_month = " select retirement_pension, month from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$y' ";
		$result_rp_month = sql_query($sql_rp_month);
		for($m=0; $row_rp_month=sql_fetch_array($result_rp_month); $m++) {
			//echo $row_rp_month['month']." ".$row_rp_month['retirement_pension']."<br />";
			if($row_rp_month['retirement_pension'] > 0) $rp_month++;
		}
		//if($rp_sum[$y] > 0) echo $sql_rp."<br />";
	}
	//���� �Ⱓ
	$rp_year = (int)($rp_month/12);
	if($rp_year > 0) $rp_year = $rp_year."��";
	else $rp_year = "";
	$rp_month = $rp_month - ($rp_year*12)."����";
	$rp_month_text = "<span style='font-size:11px;'>".$rp_year.$rp_month."</span>";
	//���Ѻ� ��ũ��
	if($member['mb_profile'] == "guest") {
		$url_pay_copy = "javascript:alert_demo();";
	} else {
		$url_pay_copy = "javascript:pay_copy('".$code_id."');";
	}
	//�������
	if($row2[pic]) {
		$pic = "./files/images/$row[com_code]_$row[sabun].jpg";
	} else {
		$pic = "./images/blank_pic.gif";
	}
	//����ó
	if(!$row[add_tel]) {
		$tel_cel = $row2[emp_cel];
	} else {
		$tel_cel = $row[add_tel];
	}
	//������� ��ũ
	$staff_url = "staff_view.php?w=u&id=$id&code=$code&page=$page";
	//�޿����� ��ũ
	$pay_url = "staff_pay_view.php?w=u&id=$id&code=$code&page=$page&tab=tab2";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_left_h55" style="padding:4px"><?=$com_name?>&nbsp;</td>
<?
}
?>
									<td nowrap class="ltrow1_center_h55"><?=$no?></td>
									<td nowrap class="ltrow1_center_h55">
										<!--<a href="<?=$pay_url?>"><b>--><?=$name?><!--</b>--><br><?=$out_text?></a>
									</td>
									<td nowrap class="ltrow1_center_h55"><?=$position?></td>
									<td nowrap class="ltrow1_center_h55"><?=$dept?>&nbsp;</td>
									<td nowrap class="ltrow1_center_h55"><?=$jumin_no?><br>(�� <?=$age?>)</td>
									<td nowrap class="ltrow1_center_h55"><?=$in_day?><br><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_center_h55"><a href="#rp_sum_func" onclick="rp_sum_func('<?=$now_year-3?>','<?=$code?>','<?=$id?>');return false;" onkeypess="this.onclick;"><?=number_format($rp_sum[$now_year-3])?></a></td>
									<td nowrap class="ltrow1_center_h55"><a href="#rp_sum_func" onclick="rp_sum_func('<?=$now_year-2?>','<?=$code?>','<?=$id?>');return false;" onkeypess="this.onclick;"><?=number_format($rp_sum[$now_year-2])?></a></td>
									<td nowrap class="ltrow1_center_h55"><a href="#rp_sum_func" onclick="rp_sum_func('<?=$now_year-1?>','<?=$code?>','<?=$id?>');return false;" onkeypess="this.onclick;"><?=number_format($rp_sum[$now_year-1])?></a></td>
									<td nowrap class="ltrow1_center_h55"><a href="#rp_sum_func" onclick="rp_sum_func('<?=$now_year?>','<?=$code?>','<?=$id?>');return false;" onkeypess="this.onclick;"><?=number_format($rp_sum[$now_year])?></a></td>
									<td nowrap class="ltrow1_center_h55"><a href="#rp_sum_func" onclick="rp_sum_func('<?=$now_year+1?>','<?=$code?>','<?=$id?>');return false;" onkeypess="this.onclick;"><?=number_format($rp_sum[$now_year+1])?></a></td>
									<td nowrap class="ltrow1_center_h55"><strong><?=number_format($rp_sum_sum)?></strong><br /><?=$rp_month_text?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
								<tr>
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
<?
if($is_admin != "super") {
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
								</tr>
							</table>
							</div><!--�������-->
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
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_print = "javascript:alert_demo();";
	$url_excel = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "staff_view.php?code=".$code;
	$url_excel = "retirement_pension_excel.php?code=".$code."&amp;kind=".$kind;
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_excel?>" target=""><img src="images/btn_excel_print_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							</form>
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
