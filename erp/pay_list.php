<?
$sub_menu = "600100";
include_once("./_common.php");

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$com_code = "00395";

$sql_common = " from pibohum_base a, pibohum_base_opt b ";

$sql_search = " where a.com_code='$com_code' ";
//�ɼ�DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";

//echo $stx_name;
// �˻� : ����
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
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

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name") $sst = "a.".$sort1;
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
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "�������(�μ���)";
$g4[title] = $sub_title." : �޿����� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
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
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top06.gif" border="0"></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top01_on.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top02_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top03_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top04_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top05_off.gif" border="0"></a></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="7"></td></tr>
							</table>

							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
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
										<form name="searchForm" method="post">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
												<col width="10%">
												<col width="">
												<col width="10%">
												<col width="">
												<col width="10%">
												<col width="">
												<col width="10%">
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
													<td nowrap class="tdrow">
														<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���</td>
													<td nowrap class="tdrow">
														<input name="stx_sabun" type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_sabun?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">ä������</td>
													<td nowrap class="tdrow">
														<select name="stx_work_form" class="selectfm">
															<option value="">��ü</option>
															<option value="1" <? if($stx_work_form == 1) echo "selected"; ?> >������</option>
															<option value="2" <? if($stx_work_form == 2) echo "selected"; ?> >�����</option>
															<option value="3" <? if($stx_work_form == 3) echo "selected"; ?> >�Ͽ���</option>
														</select>
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��濩��</td>
													<td nowrap class="tdrow">
														<select name="stx_get_ok" class="selectfm">
															<option value="">��ü</option>
															<option value="0" <? if($stx_get_ok == '0') echo "selected"; ?> >���Ϸ�</option>
															<option value="1" <? if($stx_get_ok == '1') echo "selected"; ?> >�̿Ϸ�</option>
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
												<td valign="bottom"></td> 
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
$sort_dept = $PHP_SELF."?page=".$page."&sst=b.dept_1&sod=".$sod_sort;
?>
												<td nowrap class="tdhead_center" width="34">��ȣ</td>
												<td nowrap class="tdhead_center" width="58">����</td>
												<td nowrap class="tdhead_center" width=""><a href="<?=$sort_name?>">����</a></td>
												<td nowrap class="tdhead_center" width="70">�޿�����</td>
												<td nowrap class="tdhead_center" width="58"><a href="<?=$sort_position?>">����</a></td>
												<td nowrap class="tdhead_center" width="100"><a href="<?=$sort_jumin_no?>">�ֹι�ȣ</a></td>
												<td nowrap class="tdhead_center" width="60"><a href="<?=$sort_jumin_no?>">ä������</a></td>
												<td nowrap class="tdhead_center" width="70"><a href="<?=$sort_in_day?>">��/�����</a></td>
												<td nowrap class="tdhead_center" width="92"><a href="<?=$sort_dept?>">�μ�</a></td>
												<td nowrap class="tdhead_center" width="100">��濩��</td>
												<td nowrap class="tdhead_center" width="78">�ٷΰ�༭</td>
												<td nowrap class="tdhead_center" width="40">���</td>
												<td nowrap class="tdhead_center" width="40">���</td>
											</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
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
	//��� �߰� DB
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//�μ�
	$dept = $row2[dept_1];
	//����
	$position = " ";
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//�ֹε�Ϲ�ȣ �� �ټ��ڸ� ��ǥ ó��
	$jumin_no = substr($row[jumin_no],0,9)."*****";
	//�޿�����
	if($row2[pay_gbn] == "0") $pay_gbn = "������";
	else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row2[pay_gbn] == "3") $pay_gbn = "������";
	else $pay_gbn = "-";
	//���Ѻ� ��ũ��
	/*
	if($member['mb_profile'] == "guest") {
		$url_work = "javascript:alert_demo();";
	} else {
	*/
		$url_work = "work_contract.php?id=$id&code=$code&page=$page";
	//}
	//���� �ٷΰ�༭
	$row2[work_contract] = 1;
	if($row2[work_contract] == 1) $work_contract = "<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href='$url_work' target=''>�ٷΰ�༭</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>";
	else $work_contract = "���ۼ�";
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
	$pay_url = "staff_view.php?w=u&id=$id&code=$code&page=$page&tab=tab2";
?>
											<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
												<td nowrap class="ltrow1_center_h55"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"></td>
												<td nowrap class="ltrow1_center_h55"><?=$no?></td>
												<td nowrap class="ltrow1_center_h55"><a href="<?=$staff_url?>"><img src="<?=$pic?>" width="50" height="50" alt="�������" style="border:solid 1px #dfdfdf;" /></a></td>
												<td nowrap class="ltrow1_center_h55">
													<a href="<?=$staff_url?>"><b><?=$name?></b></a>
												</td>
												<td nowrap class="ltrow1_center_h55">
													<div id="btn_bsget_82">
													 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$pay_url?>" target="">�޿�����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
													</div>
												</td>
												<td nowrap class="ltrow1_center_h55"><?=$position?></td>
												<td nowrap class="ltrow1_center_h55"><?=$jumin_no?></td>
												<td nowrap class="ltrow1_center_h55"><?=$work_form?><br><?=$pay_gbn?></td>
												<td nowrap class="ltrow1_center_h55"><?=$in_day?><br><?=$out_day?></td>
												<td nowrap class="ltrow1_center_h55"><?=$dept?>&nbsp;</td>
												<td nowrap class="ltrow1_center_h55">
													<!--��濩�� ������ 0 ��-->
													<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> >���
													<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >����<br>
													<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> >����
													<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >�ǰ�
												</td>
												<td nowrap class="ltrow1_center_h55"><?=$work_contract?></td>
												<td nowrap class="ltrow1_center_h55">
													<div id="btn_bsget_82">
													 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_write.php?mode=in&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>" target="">���</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
													</div>
												</td>
												<td nowrap class="ltrow1_center_h55">
													<div id="btn_bslost_82">
													 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_write.php?mode=out&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>" target="">���</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
													</div>
												</td>
											</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
											<tr>
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
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "staff_view.php";
}
?>

										<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
											<tr>
												<td align="left">
													<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
														<tr>
															<td width=2></td>
															<td><img src=images/btn_lt.gif></td>
															<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">���û���</a></td>
															<td><img src=images/btn_rt.gif></td>
														 <td width=2></td>
														</tr>
													</table>
													<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
														<tr>
															<td width=2></td>
															<td><img src=images/btn_lt.gif></td>
															<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">������</a></td>
															<td><img src=images/btn_rt.gif></td>
														 <td width=2></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										</form>

									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
