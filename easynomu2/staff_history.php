<?
$sub_menu = "200200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

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

$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "���泻�� �� ���";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 11;
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
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
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
include "./inc/left_menu2.php";
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
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���</td>
										<td nowrap class="tdrow">
											<input name="stx_sabun" type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_sabun?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">��ü</option>
												<option value="1" <? if($stx_work_form == 1) echo "selected"; ?> >������</option>
												<option value="2" <? if($stx_work_form == 2) echo "selected"; ?> >�����</option>
												<option value="3" <? if($stx_work_form == 3) echo "selected"; ?> >�Ͽ���</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��濩��</td>
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
							<!--����Ʈ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="40">���</td>
									<td nowrap class="tdhead_center" width="58">����</td>
									<td nowrap class="tdhead_center" width=""><a href="<?=$sort_name?>">����</a></td>
									<td nowrap class="tdhead_center" width="82"><a href="<?=$sort_position?>">����</a></td>
									<td nowrap class="tdhead_center" width="110"><a href="<?=$sort_jumin_no?>">�ֹι�ȣ</a></td>
									<td nowrap class="tdhead_center" width="94">���ʵ���Ͻ�</td>
									<td nowrap class="tdhead_center" width="94">�ֱٺ����Ͻ�</td>
									<td nowrap class="tdhead_center" width="64">����Ƚ��</td>
									<td nowrap class="tdhead_center" width="60"><a href="<?=$sort_jumin_no?>">ä������</a></td>
									<td nowrap class="tdhead_center" width="84"><a href="<?=$sort_in_day?>">��/�����</a></td>
									<td nowrap class="tdhead_center" width="100">��濩��</td>
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
	//������ : ������ڵ�
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$code' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row[name], 8, "..");
	//ä������
	if($row[work_form] == "") $work_form = "";
	else if($row[work_form] == "1") $work_form = "������";
	else if($row[work_form] == "2") $work_form = "�����";
	else if($row[work_form] == "3") $work_form = "�Ͽ���";
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
	//���� �ٷΰ�༭
	if($row2[work_contract] == 1) $work_contract = "<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href='work_contract.php?id=$id&code=$code&page=$page' target=''>�ٷΰ�༭</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>";
	else $work_contract = "���ۼ�";
	//�޿�����
	if($row2[pay_gbn] == "0") $pay_gbn = "������";
	else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row2[pay_gbn] == "3") $pay_gbn = "������";
	else $pay_gbn = "-";
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
	//���ʵ������
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2=mysql_fetch_array($result_opt2);
	$registration_date = $row_opt2[wr_date];
	//�ֱٺ�������
	$sql_bak_opt2 = " select max(wr_date) as modify_date from pibohum_bak_opt2 where com_code='$code' and sabun='$id' ";
	$result_bak_opt2 = sql_query($sql_bak_opt2);
	$row_bak_opt2=mysql_fetch_array($result_bak_opt2);
	$modify_date = $row_bak_opt2[modify_date];
	//����Ƚ��
	$sql_bak_opt2 = " select count(*) as cnt from pibohum_bak_opt2 where com_code='$code' and sabun='$id' ";
	$result_bak_opt2 = sql_query($sql_bak_opt2);
	$row_bak_opt2=mysql_fetch_array($result_bak_opt2);
	$modify_count = $row_bak_opt2[cnt];
	//������� ��ũ
	if($modify_count > 0) {
		$staff_url = "staff_history_view.php?id=$id&code=$code&page=$page";
	} else {
		$staff_url = "javascript:alert('�ش� ����� ����� ������ �����ϴ�.');";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h55"><?=$id?></td>
									<td nowrap class="ltrow1_center_h55"><a href="<?=$staff_url?>"><img src="<?=$pic?>" width="50" height="50" alt="�������" style="border:solid 1px #dfdfdf;" /></a></td>
									<td nowrap class="ltrow1_center_h55"><a href="<?=$staff_url?>"><b><?=$name?></b><br><?=$out_text?></a></td>
									<td nowrap class="ltrow1_center_h55"><?=$position?></td>
									<td nowrap class="ltrow1_center_h55"><?=$row[jumin_no]?></td>
									<td class="ltrow1_center_h55"><?=$registration_date?></td>
									<td class="ltrow1_center_h55"><?=$modify_date?></td>
									<td nowrap class="ltrow1_center_h55"><?=$modify_count?></td>
									<td nowrap class="ltrow1_center_h55"><?=$work_form?><br><?=$pay_gbn?></td>
									<td nowrap class="ltrow1_center_h55"><?=$in_day?><br><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_center_h55">
										<!--��濩�� ������ 0 ��-->
										<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> >���
										<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >����<br>
										<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> >����
										<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >�ǰ�
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
								</tr>
							</table>

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
