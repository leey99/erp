<?
include_once("./_common.php");

$sql = " select * from a4_manage where item='manage' order by belong asc, p_code asc ";
//echo $sql;
$result = sql_query($sql);
//$row=mysql_fetch_array($result);
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
		opener.document.dataForm.manage_cust_numb.value = tempval[0];
		opener.document.dataForm.manage_cust_name.value = tempval[1];
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
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
					<tr>
						<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڸ�</td>
						<td nowrap  class="tdrow">
							<input name="search_cust_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������ȭ</td>
						<td nowrap  class="tdrow">
							<input name="search_cust_tel" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ</td>
						<td nowrap  class="tdrow">
							<input name="search_cust_fax" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
						<td nowrap class="tdhead_center">�ѽ���ȣ</td>
						<td nowrap class="tdhead_center">�޴���</td>
					</tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
	if($row[state] == 1) {
		$state = "����";
	} else {
		$state = "����";
	}
	//�Ҽ�
	$belong = $row[belong];
	//�ڵ��ȣ 00 �߰�
	//echo "�ڵ� �ڸ���".strlen($row[code]);
	if(strlen($row[code]) == 1) $code = "000".$row[code];
	else if(strlen($row[code]) == 2) $code = "00".$row[code];
	else if(strlen($row[code]) == 3) $code = "0".$row[code];
?>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22"><input type="radio" name="temp_cust_numb" value="<?=$code?>#<?=$row[name]?>"></td>
						<td nowrap class="ltrow1_center_h22"><?=$man_cust_name_arry[$belong]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[name]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[position]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[tel]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[fax]?></td>
						<td nowrap class="ltrow1_center_h22"><?=$row[hp]?></td>
					</tr>
<?
}
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
				<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td height="40">
							<div align="center">

							</div>
						</td>
					</tr>
				</table>
				<!--����Ʈ -->
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
					<tr>
						<td align="center">
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn_lt.gif></td><td background=./images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">�� ��</a></td>      <td><img src=./images/btn_rt.gif></td>     <td width=2></td>    </tr>  </table>  <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>   <tr>     <td width=2></td>      <td><img src=./images/btn_lt.gif></td>      <td background=./images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:window.close();" target="">�� ��</a></td><td><img src=./images/btn_rt.gif></td><td width=2></td></tr></table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
</table>
<form name="pageForm" method="post">
	<input type="hidden" name="page" value="1">
	<input type="hidden" name="pageurl" value="pop_nomu_cust.php">
	<input type="hidden" name="search_top_cate" value="">
	<input type="hidden" name="search_first" value="">
	<input type="hidden" name="order_sort" value="">
	<input type="hidden" name="cate_code" value="">
	<input type="hidden" name="sub_cate_code" value="">
	<input type="hidden" name="search_sub_key" value="">
	<input type="hidden" name="notice_type" value="">
</form>
<script language="javascript">
function goPageList(strpage)
{
	var frm = document.pageForm;
	var strUrl = frm.pageurl.value;
	frm.page.value=strpage;
	frm.action = strUrl;
	frm.submit();
	return;
}
</script>
<form name="listForm" method="post">
	<input type="hidden" name="cust_numb" value="">
	<input type="hidden" name="url" value="pop_nomu_cust.php">
</form>
</body>
</html>
