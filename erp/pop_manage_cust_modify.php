<?
include_once("./_common.php");
$sql_common = " from a4_manage ";
$sql_search = " where item='manage' ";
//���������
if(!$search_state) {
	$sql_search .= " and state='1'  ";
}
$sql_order = " order by belong asc, p_code asc ";
//�˻� : �Ҽ�
if ($search_belong) {
	$sql_search .= " and ( ";
	$sql_search .= " belong = '$search_belong' ";
	$sql_search .= " ) ";
}
//�˻� : ����ڸ�
if ($search_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '%$search_cust_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ������ȭ
if ($search_cust_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (tel like '%$search_cust_tel%') ";
	$sql_search .= " ) ";
}
//�˻� : �ѽ���ȣ
if ($search_cust_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (fax like '%$search_cust_fax%') ";
	$sql_search .= " ) ";
}
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
//$row=mysql_fetch_array($result);
$colspan = 7;
$qstr = "kind=".$kind."&amp;search_state=".$search_state."&amp;search_belong=".$search_belong."&amp;search_cust_name=".$search_cust_name."&amp;search_cust_tel=".$search_cust_tel."&amp;search_cust_fax=".$search_cust_fax;
?>
<html>
<head>
<title>���Ŵ��� ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="./css/style_chongmu.css">
</head>
<body topmargin="0" leftmargin="0">
<script language="javascript" src="./js/common.js"></script>
<script language="javascript">
	function goSearch()
	{
		var frm = document.searchForm;
		if(frm.search_state.checked) {
			if(frm.search_cust_name.value == "") {
				alert("����ڸ��� �Է��Ͻʽÿ�.");
				frm.search_cust_name.focus();
				return;
			}
		}
		frm.action = "<?=$PHP_SELF?>";
		frm.submit();
		return;
	}

	function checkData()
	{
		var tempval = "";
		var frm = document.dataForm;
		if (frm.temp_cust_numb == undefined)
		{
			alert("���Ŵ����� �����ϴ�.");
			return;
		}
		
		var bflag = false;
		if (frm.temp_cust_numb.length == undefined)
		{
			if (frm.temp_cust_numb.checked == false)
			{
				bflag = false;
			}
			else
			{
				bflag = true;
				tempval = frm.temp_cust_numb.value;
			}
		}
		else
		{
			for (var i=0;i<frm.temp_cust_numb.length;i++)
			{
				if (frm.temp_cust_numb[i].checked == true)
				{
					tempval = frm.temp_cust_numb[i].value;
					bflag = true;
					break;
				}
			}
		}

		if (bflag == false)
		{
			alert("���Ŵ����� �����ϼ���.");
			return;
		}

		tempval = tempval.split("#");
<?
//���â�� ����ڰ� �ƴ� ��� 150811
if($kind != 2) {
	if($mode == "tm") {
?>
		opener.document.dataForm.tm_cust_numb.value = tempval[0];
		opener.document.dataForm.tm_cust_name.value = tempval[1];
<?
	} else {
?>
		opener.document.dataForm.inp_manage_cust_numb.value = tempval[0];
		opener.document.dataForm.inp_manage_cust_name.value = tempval[1];
<?
	}
//���â�� �����
} else {
?>
		opener.document.dataForm.manager_code.value = tempval[0];
		opener.document.dataForm.manager_name.value = tempval[1];
		//opener.document.getElementById('manager_code').value = tempval[0];
		//opener.document.getElementById('manager_name').value = tempval[1];
<?
}
?>
		window.close();
		return;
	}
</script>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
		<tr>
			<td style="padding:0 20 0 20">
<!--Ÿ��Ʋ -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:8pt;color:#929292;'><img src=./images/title_icon.gif align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>���Ŵ��� ����</span>
									</td>
									<td align=right class=navi></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height=1 bgcolor=e0e0de></td>
					</tr>
					<tr>
						<td height=2 bgcolor=f5f5f5></td>
					</tr>
					<tr>
						<td height=5></td>
					</tr>
				</table>
<!--Ÿ��Ʋ -->

<!--��޴� -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									<a href="#">�˻�</a> 
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>

				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
<!--��޴� -->

<!--�˻� -->
				<form name="searchForm" method="post">
					<input type="hidden" name="mode" value="<?=$mode?>" />
					<input type="hidden" name="kind" value="<?=$kind?>" />
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ҽ�</td>
							<td nowrap  class="tdrow" width="81">
<?
if($member['mb_level'] != 6) {
?>
								<select name="search_belong" class="selectfm" onchange="goSearch()">
									<option value=""  <? if($search_belong == "")  echo "selected"; ?>>��ü</option>
<?
	for($i=1;$i<count($man_cust_name_arry)-1;$i++) {
		if($search_belong == $i) $sel_man_cust_name[$i] = "selected";
?>
									<option value="<?=$i?>" <?=$sel_man_cust_name[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
	}
?>
									<option value="101" <? if($search_belong == 101) echo "selected"; ?>>���»�1</option>
								</select>
<?
} else {
	echo $man_cust_name_arry[$search_belong];
	echo "<input type='hidden' name='search_belong' value='".$search_belong."' />";
}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڸ�</td>
							<td nowrap  class="tdrow">
								<input name="search_cust_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$search_cust_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
								<input type="checkbox" name="search_state" style="vertical-align:middle" value="Y" <? if($search_state == "Y") echo "checked"; ?> title="���������">
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������ȭ</td>
							<td nowrap  class="tdrow">
								<input name="search_cust_tel" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$search_cust_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ѽ���ȣ</td>
							<td nowrap  class="tdrow">
								<input name="search_cust_fax" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$search_cust_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
							</td>
							<td align="center" nowrap class="tdrow_center">
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn9_lt.gif></td><td class=ftbutton5_white nowrap style="background:url(./images/btn9_bg.gif) repeat-x;"><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=./images/btn9_rt.gif></td><td width=2></td></tr></table>
							</td>
						</tr>
					</table>
				</form>
				<div style="height:10px;font-size:0px"></div>
<!--�˻� -->

<!--��޴� -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									<a href="#">����Ʈ</a>
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>

				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
<!--��޴� -->

<!--����Ʈ -->
<form name="dataForm" style="margin:0">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center" width="5%">����</td>
						<td nowrap class="tdhead_center" width="8%">�Ҽ�</td>
						<td nowrap class="tdhead_center">����ڸ�</td>
						<td nowrap class="tdhead_center">����</td>
						<td nowrap class="tdhead_center">������ȭ</td>
						<td nowrap class="tdhead_center">�ѽ�</td>
						<td nowrap class="tdhead_center">�޴���</td>
					</tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
	if($row[state] == 1) {
		$state = "����";
	} else {
		$state = "����";
	}
	$code = $row[code];
	//�Ҽ�
	$belong_code = $row['belong'];
	$belong_text = $man_cust_name_arry[$belong_code];
?>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22"><input type="radio" name="temp_cust_numb" value="<?=$code?>#<?=$row[name]?>" onclick="checkData();"></td>
						<td nowrap class="ltrow1_center_h22"><?=$belong_text?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[name]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[position]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[tel]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[fax]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[hp]?></td>
					</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
					<tr>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
					</tr>
				</table>
			</form>
			<div style="height:10px;font-size:0px;line-height:0px;"></div>
			<div align="center">
				<?
				$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
				echo $pagelist;
				?>
			</div>
			<div style="height:10px;font-size:0px;line-height:0px;"></div>
			<!--����Ʈ -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn_lt.gif></td><td background=./images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:window.close();" target="">�� ��</a></td><td><img src=./images/btn_rt.gif></td><td width=2></td></tr></table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
