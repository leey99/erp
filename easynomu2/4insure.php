<? 
include_once("_common.php");
//include_once("$g4[path]/lib/popup.lib.php"); 
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>4�뺸�� ���/��� �Ű�</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function checkData() {
	var frm = document.dataForm;
	if (frm.comp_name.value == "")
	{
		alert("������Ī�� �Է��ϼ���.");
		frm.comp_name.focus();
		return;
	}
	if (frm.comp_adr.value == "")
	{
		alert("������������ �Է��ϼ���.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_bznb.value == "")
	{
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}

	if(frm.join_ok.checked) {

		if (frm.join_name.value == "")
		{
			alert("����(�Ի���)�� �Է��ϼ���.");
			frm.join_name.focus();
			return;
		}
		if (frm.join_ssnb.value == "")
		{
			alert("�ֹε�Ϲ�ȣ(�Ի���)�� �Է��ϼ���.");
			frm.join_ssnb.focus();
			return;
		}
		if (frm.join_date.value == "")
		{
			alert("�Ի����� �Է��ϼ���.");
			frm.join_date.focus();
			return;
		}
		if (frm.join_jikjong.value == "")
		{
			alert("������ �Է��ϼ���.");
			frm.join_jikjong.focus();
			return;
		}
		if (frm.join_time.value == "")
		{
			alert("�ּ����ٷνð��� �Է��ϼ���.");
			frm.join_time.focus();
			return;
		}
		if (frm.join_salary.value == "")
		{
			alert("���ӱ��� �Է��ϼ���.");
			frm.join_salary.focus();
			return;
		}
		//alert(frm.isgy.checked);
		if (!frm.isgy.checked && !frm.issj.checked && !frm.iskm.checked && !frm.isgg.checked)
		{
			alert("�������뿩�θ� ������ �ּ���.");
			frm.isgy.focus();
			return;
		}
	}

	if(frm.quit_ok.checked) {
		if (frm.quit_name.value == "")
		{
			alert("����(�����)�� �Է��ϼ���.");
			frm.quit_name.focus();
			return;
		}
		if (frm.quit_ssnb.value == "")
		{
			alert("�ֹε�Ϲ�ȣ(�����)�� �Է��ϼ���.");
			frm.quit_ssnb.focus();
			return;
		}
		if (frm.quit_tel.value == "")
		{
			alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
			frm.quit_tel.focus();
			return;
		}
		if (frm.quit_date.value == "")
		{
			alert("������� �Է��ϼ���.");
			frm.quit_date.focus();
			return;
		}
		if (frm.quit_cause.value == "")
		{
			alert("���������� �Է��ϼ���.");
			frm.quit_cause.focus();
			return;
		}
		if (frm.quit_sum_now.value == "")
		{
			alert("�ش翬���ӱ��Ѿ��� �Է��ϼ���.");
			frm.quit_sum_now.focus();
			return;
		}
		if (frm.quit_sum_now_month.value == "")
		{
			alert("�ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
			frm.quit_sum_now_month.focus();
			return;
		}
	}
	frm.action = "4insure_update.php";
	frm.submit();
	return;
}
function join_ok_func() {
	var frm = document.dataForm;
	if(!frm.join_ok.checked) frm.join_ok.checked = true;
}
function quit_ok_func() {
	var frm = document.dataForm;
	if(!frm.quit_ok.checked) frm.quit_ok.checked = true;
}
</script>
<div style="background-image:url(images/body_bg.jpg); background-repeat:repeat-x">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td>
					<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td width="200"><a href="main.php" target="mainFrame3"><img src="images/logo.jpg" width="260" height="70" /></a></td>
							<td width="800" style="padding-top:10px">
								<table width="90%" border="0" align="right" cellpadding="0" cellspacing="0" id="tables">
									<tr>
										<td width="594">
											<div align="right" class="text011g">
											[ �泲�簡���κ������� ]&nbsp;&nbsp;&nbsp;
											���Ŵ��� : ����ȣ&nbsp;&nbsp;&nbsp;
											TEL : 010-5050-4291&nbsp;&nbsp;&nbsp;
											<!--���� : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
											HP : 052-700-3556
											</div>
										</td>
										<td width="72"><div align="right"><a href="#"><img src="images/btn_logout.gif" width="61" height="23"></a></div></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td height="18">
						<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
							<tr>
								<td width="168"><div align="center"><a href='m01s01.asp' target="mainFrame3" onmouseover='img1.src="images/menu_01_on.gif"' onmouseout='img1.src="images/menu_01.gif"'><img src='images/menu_01.gif' name='img1' border="0" id="img1" /></a></div></td>
								<td width="2"><div align="center"><img src="images/menu_bar.gif"></div></td>
								<td width="156"><div align="center"><a href='m02s01.asp' target="mainFrame3" onmouseover='img2.src="images/menu_02_on.gif"' onmouseout='img2.src="images/menu_02.gif"'><img src='images/menu_02.gif' name='img2' border="0" id="img2" /></a></div></td>
								<td width="2"><div align="center"><img src="images/menu_bar.gif"></div></td>
								<td width="170"><div align="center"><a href='m03s01.asp' target="mainFrame3" onmouseover='img3.src="images/menu_03_on.gif"' onmouseout='img3.src="images/menu_03.gif"'><img src='images/menu_03.gif' name='img3' border="0" id="img3" /></a></div></td>
								<td width="2"><div align="center"><img src="images/menu_bar.gif"></div></td>
								<td width="163"><div align="center"><a href='m04s01.asp' target="mainFrame3" onmouseover='img4.src="images/menu_04_on.gif"' onmouseout='img4.src="images/menu_04.gif"'><img src='images/menu_04.gif' name='img4' border="0" id="img4" /></a></div></td>
								<td width="2"><div align="center"><img src="images/menu_bar.gif"></div></td>
								<td width="172"><div align="center"><a href='http://nomu.daine.co.kr:9000/bs/doc/searchU.jsp?cust_numb=98' target="mainFrame3" onmouseover='img5.src="images/menu_05_on.gif"' onmouseout='img5.src="images/menu_05.gif"'><img src='images/menu_05.gif' name='img5' border="0" id="img5" /></a></div></td>
								<td width="2"><div align="center"><img src="images/menu_bar.gif"></div></td>
								<td width="165"><div align="center"><a href='list_notice.asp?notice_type=notice' target="mainFrame3" onmouseover='img6.src="images/menu_06_on.gif"' onmouseout='img6.src="images/menu_06.gif"'><img src='images/menu_06.gif' name='img6' border="0" id="img6" /></a></div></td>
              </tr>
            </table>
          </td>
                </tr>
                <tr>
                  <td height="9"><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><a href="m01s01.asp" target="mainFrame3"><img src="images/go_01.gif"></a></td>
                      <td><a href="m03s01.asp" target="mainFrame3"><img src="images/go_02.gif"></a></td>
                      <td><a href="m02s01.asp" target="mainFrame3"><img src="images/go_03.gif"></a></td>
                      <td><a href="m02s01.asp" target="mainFrame3"><img src="images/go_04.gif"></a></td>
                      <td><a href="m03s01.asp" target="mainFrame3"><img src="images/go_05.gif"></a></td>
                      <td><a href="m04s01.asp" target="mainFrame3"><img src="images/go_06.gif"></a></td>
                      <td><a href="http://nomu.daine.co.kr:9000/bs/doc/searchU.jsp?cust_numb=98" target="mainFrame3"><img src="images/go_07.gif"></a></td>
                      <td><a href="javascript:;" target="mainFrame3"><img src="images/go_08.gif"></a></td>
                    </tr>
                  </table>
								</td>
                </tr>
                <tr>
                  <td height="2">
										<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td width="200" height="2"><img src="images/Left_top_line.gif" width="200" height="2"></td>
												<td bgcolor="#32374a"></td>
											</tr>
										</table>
                  </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

<div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
			<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top" width="200" background="images/Left_bg.gif">
						<table width="200" border="0" cellspacing="0" cellpadding="0" background="images/Left_bg.gif">
							<tr>
								<td width="200"><img src="images/Left_top_img.gif" width="200" height="44" /></td>
							</tr>
							<tr>
								<td style="padding:15px 14px 15px 14px" valign="top" height="600">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
									<td>
										<img src="images/icon_star.gif" width="13" height="13" align="absmiddle" /> 
										<span class="text011b">��������</span>
									</td>
							  </tr>
							  <tr>
									<td height="10"></td>
							  </tr>
							  <tr>
									<td style="padding-left:20px">

									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr><td height="25">- <a href="m01s01.asp">��������</a></td></tr>
									  <tr><td height="2" background="images/Left_menu_bg.gif" style="padding-left:20px"></td></tr>
									  <tr><td height="25">- <a href="m01s02.asp">������������</a></td></tr>
									  <tr><td height="2" background="images/Left_menu_bg.gif" style="padding-left:20px"></td></tr>
									  <tr><td height="25">- ���°���</td></tr>
									  <tr><td height="2" background="images/Left_menu_bg.gif" style="padding-left:20px"></td></tr>
									  <tr><td height="25">- 4�뺸���ǽŰ�</td></tr>
									  <tr><td height="2" background="images/Left_menu_bg.gif" style="padding-left:20px"></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
    <td valign="top" style="padding:10px 10px 10px 10px">

			<!--Ÿ��Ʋ -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width=100% border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:8pt;color:black;'>4�뺸�� ���/��� �Ű�</span>
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
			<form name="dataForm" method="post">
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									���������
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
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="30%">
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_name" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_adr" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_bznb" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_tel" type="text" class="textfm" style="width:100px;" value="" maxlength="15"> ��) 055-1234-1234
						</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									�Ի���
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
						<td valign="bottom"> <input type="checkbox" name="join_ok" value="1" class="textfm"> �Ի��� �Է½� üũ���ֽʽÿ�.</td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="30%">
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="join_name" type="text" class="textfm" style="width:150px;" value="" maxlength="25" onclick="join_ok_func()">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="join_ssnb" type="text" class="textfm" style="width:150px;" value="" maxlength="14">
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�Ի���<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="join_date" type="text" class="textfm" style="width:100px;" value="" maxlength="15"> ��) 2013-09-05
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="join_jikjong" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ּ����ٷνð�<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="join_time" type="text" class="textfm" style="width:100px;" value="" maxlength="4">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ӱ�<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="join_salary" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������뿩��<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input type="checkbox" name="isgy" value="1" class="textfm"> ���
							<input type="checkbox" name="issj" value="1" class="textfm"> ����
							<input type="checkbox" name="iskm" value="1" class="textfm"> ����
							<input type="checkbox" name="isgg" value="1" class="textfm"> �ǰ�
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
						<td nowrap class="tdrow">
							<input name="join_note" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
						</td>
					</tr>
				</table>
				<div style="height:5px;font-size:0px;line-height:0px;"></div>

				<script language="javascript">
				function join_plus(n){
					var frm = document.dataForm;
					if(frm.join_count.value > 4) {
						alert("�ѹ��� �Ű��� �� �ִ� �ο��� 5����� �Դϴ�.");
						return false;
					} else { 
						document.getElementById('join_add_div').style.display = "";
						var Tbl = document.getElementById('join_optable'); 
						tRow = Tbl.insertRow();//tr �߰�
						tCell = tRow.insertCell();//td �߰�
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_name_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";

						tRow = Tbl.insertRow();
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�Ի���<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_date_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"15\">";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_jikjong_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";

						tRow = Tbl.insertRow();
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ּ����ٷνð�<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_time_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"4\">";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ӱ�<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_salary_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";

						tRow = Tbl.insertRow();
						tCell = tRow.insertCell();
						tCell.className = "tdrowk_end"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������뿩��<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow_end"; 
						tCell.innerHTML = "<input type=\"checkbox\" name=\"isgy_[]\" value=\"1\" class=\"textfm\"> ��� <input type=\"checkbox\" name=\"issj_[]\" value=\"1\" class=\"textfm\"> ���� <input type=\"checkbox\" name=\"iskm_[]\" value=\"1\" class=\"textfm\"> ���� <input type=\"checkbox\" name=\"isgg_[]\" value=\"1\" class=\"textfm\"> �ǰ�";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk_end"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow_end"; 
						tCell.innerHTML = "<input name=\"join_note_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";

						frm.join_count.value++;
						//alert(frm.join_count.value);
					} 
				}

				function quit_plus(n){
					var frm = document.dataForm;
					if(frm.quit_count.value > 4) {
						alert("�ѹ��� �Ű��� �� �ִ� �ο��� 5����� �Դϴ�.");
						return false;
					} else { 
						document.getElementById('quit_add_div').style.display = "";
						var Tbl = document.getElementById('quit_optable'); 
						tRow = Tbl.insertRow();//tr �߰�
						tCell = tRow.insertCell();//td �߰�
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"quit_name_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"quit_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";

						tRow = Tbl.insertRow();
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">��ȭ��ȣ<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_date_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"15\">";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�����<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"join_jikjong_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";

						tRow = Tbl.insertRow();
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">��������<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<select name=\"quit_cause_[]\" class=\"selectfm\"><option value=\"\">�����ϼ���</option><option value=\"11\">����,�ڿ���</option><option value=\"12\">��ȥ,���,����������</option><option value=\"13\">����,�λ�,���</option><option value=\"14\">¡���ذ�</option><option value=\"15\">��Ÿ ���λ���</option><option value=\"22\">���,����,�����ߴ�</option><option value=\"23\">�濵�� �ذ�</option><option value=\"24\">�޾�,�ӱ�ü��,ȸ������</option><option value=\"25\">��Ÿ ȸ�����</option><option value=\"31\">����</option><option value=\"32\">���Ⱓ ����</option><option value=\"33\">��������</option><option value=\"41\">��뺸�� ������</option><option value=\"42\">���߰��</option><option value=\"98\">�Ҹ����� �ϰ�����</option><option value=\"99\">���ٿ� ���� ����</option></select>";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ش翬���ӱ��Ѿ�<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"quit_sum_now_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\"> �������� <input name=\"quit_sum_now_month_[]\" type=\"text\" class=\"textfm\" style=\"width:30px;\" value=\"\" maxlength=\"4\">";

						tRow = Tbl.insertRow();
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">������3������ ����ӱ�<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"quit_3month_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";
						tCell = tRow.insertCell();
						tCell.className = "tdrowk"; 
						tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���⵵�ӱ��Ѿ�<font color=\"red\"></font>";
						tCell = tRow.insertCell();
						tCell.className = "tdrow"; 
						tCell.innerHTML = "<input name=\"quit_sum_pre_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\"> �������� <input name=\"quit_sum_pre_month_[]\" type=\"text\" class=\"textfm\" style=\"width:30px;\" value=\"\" maxlength=\"4\">";

						frm.quit_count.value++;
						//alert(frm.join_count.value);
					} 
				}
				</script>

				<div id="join_add_div" style="display:none">
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
										�Ի���(�߰�)
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
				</div>
				<!--�˻� -->
				<input type="hidden" name="join_count" value="1">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="join_optable">
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="30%">
				</table>
 
				<div style="height:5px;font-size:0px;line-height:0px;"></div>
				<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
					<tr>
						<td width=2></td>
						<td><img src="images/btn_lt.gif"></td>        
						<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="join_plus();" style="cursor:pointer">�Ի��� �߰�</label></td>
						<td><img src="images/btn_rt.gif"></td>
						<td width=2></td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									�����
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
						<td valign="bottom"> <input type="checkbox" name="quit_ok" value="1" class="textfm"> ����� �Է½� üũ���ֽʽÿ�.</td>  
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="30%">
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="quit_name" type="text" class="textfm" style="width:130px;" value="" maxlength="25" onclick="quit_ok_func()">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="quit_ssnb" type="text" class="textfm" style="width:130px;" value="" maxlength="25">
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="quit_tel" type="text" class="textfm" style="width:100px;" value="" maxlength="15"> ��) 055-1234-1234
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�����<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="quit_date" type="text" class="textfm" style="width:130px;" value="" maxlength="25"> (������ �ٹ� ������)
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<select name="quit_cause" class="selectfm">
								<option value="">�����ϼ���</option>
								<option value="11">����,�ڿ���</option>
								<option value="12">��ȥ,���,����������</option>
								<option value="13">����,�λ�,���</option>
								<option value="14">¡���ذ�</option>
								<option value="15">��Ÿ ���λ���</option>
								<option value="22">���,����,�����ߴ�</option>
								<option value="23">�濵�� �ذ�</option>
								<option value="24">�޾�,�ӱ�ü��,ȸ������</option>
								<option value="25">��Ÿ ȸ�����</option>
								<option value="31">����</option>
								<option value="32">���Ⱓ ����</option>
								<option value="33">��������</option>
								<option value="41">��뺸�� ������</option>
								<option value="42">���߰��</option>
								<option value="98">�Ҹ����� �ϰ�����</option>
								<option value="99">���ٿ� ���� ����</option>
							</select>
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ش翬���ӱ��Ѿ�<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="quit_sum_now" type="text" class="textfm" style="width:130px;" value="" maxlength="25"> ��������
							<input name="quit_sum_now_month" type="text" class="textfm" style="width:30px;" value="" maxlength="4"> 
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������3������ ����ӱ�<font color="red"></font></td>
						<td nowrap class="tdrow">
							<input name="quit_3month" type="text" class="textfm" style="width:130px;" value="" maxlength="25">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���⵵�ӱ��Ѿ�<font color="red"></font></td>
						<td nowrap class="tdrow">
							<input name="quit_sum_pre" type="text" class="textfm" style="width:130px;" value="" maxlength="25"> ��������
							<input name="quit_sum_pre_month" type="text" class="textfm" style="width:30px;" value="" maxlength="4"> 
						</td>
					</tr>
				</table>
				<div style="height:5px;font-size:0px;line-height:0px;"></div>

				<div id="quit_add_div" style="display:none">
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									�����(�߰�)
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
				</div>
				<!--�˻� -->
				<input type="hidden" name="quit_count" value="1">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="quit_optable">
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="30%">
				</table>
 
				<div style="height:5px;font-size:0px;line-height:0px;"></div>
				<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
					<tr>
						<td width=2></td>
						<td><img src="images/btn_lt.gif"></td>        
						<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="quit_plus();" style="cursor:pointer">����� �߰�</label></td>
						<td><img src="images/btn_rt.gif"></td>
						<td width=2></td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
					<tr>
						<td align="" style="padding-bottom:15px">
							�� 4�� ���� ��� ��� �Ű����<br>
							����� �ڷḦ �������� ���� �Ű������ �ѹ��� �ż��ϰ� ó��, 
							�ǰ���������� ��꺸��� �� ���ݰ��������� �ӱ��Ѿ� �Ű� ���� ó��
						</td>
					</tr>
					<tr>
						<td align="center">
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">�� ��</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
							 <tr>
								 <td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_list.php" target="">�� ��</a></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/copy_bg.gif">
  <tr>
    <td height="65"><div align="center">
      <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center"><img src="images/copy_txt.gif" width="279" height="27" /></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>

</div>
</body>
</html>
