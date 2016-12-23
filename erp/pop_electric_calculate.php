<?
include_once("./_common.php");
$html_title = "�����ݰ��";
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="./css/style_chongmu.css">
</head>
<body topmargin="0" leftmargin="0">
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
function getId(id) {
	return document.getElementById(id);
}
//number_format �Լ�
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
function high_voltage() {
	frm = document.dataForm;
	var g5 = Number(frm.a5.value) * Number(frm.d5.value);
	getId('g5').innerHTML = number_format(g5);
	var g9 = Number(frm.d9.value);
	getId('g9').innerHTML = number_format(g9);
	var a13 = Number(frm.a13.value);
	var d13 = Number(frm.d13.value);
	var g13 = (a13*d13);
	getId('g13').innerHTML = number_format(a13*d13);
	var a17 = (g9+g13);
	getId('a17').innerHTML = number_format(a17);
	getId('d17').innerHTML = number_format(g5);
	var g17 = a17-g5;
	getId('g17').innerHTML = number_format(a17-g5);
	frm.electric_charges_payments.value = g17;
}
//�������Ա� ���
function data_input() {
	frm = document.dataForm;
	if(frm.electric_charges_payments.value == "") {
		alert('�������Ա� ����� ���� �ʾҽ��ϴ�.');
		return false;
	}
<?
//������(2��)
if($id == 2) {
?>
	opener.document.dataForm.electric_charges_payments2.value = number_format(frm.electric_charges_payments.value);
<?
} else {
?>
	opener.document.dataForm.electric_charges_payments.value = number_format(frm.electric_charges_payments.value);
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
						<table width="100%" border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'>
									<img src="./images/title_icon.gif" align="absmiddle" style="margin:0 5px 2px 0;"><span style="font-size:9pt;color:black;"><?=$html_title?></span>
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
			<!--��޴� -->
			<form name="dataForm" style="margin:0;">
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
									<a href="#">���</a> 
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
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center">�������</td>
						<td nowrap class="tdhead_center">�ܰ�</td>
						<td nowrap class="tdhead_center">�����</td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22"><input name="a5"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10"  onkeyup="high_voltage();">kW</td>
						<td nowrap class="ltrow1_center_h22">
							<select name="d5" class="selectfm" style="vertical-align:middle;" onchange="high_voltage()">
								<option value="17000">17,000</option>
								<option value="44000">44,000</option>
							</select>
							��
						</td>
						<td nowrap class="ltrow1_center_h22"><span id="g5"></span>��</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
									<a href="#">����(�⺻5kW)</a> 
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
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center">�������</td>
						<td nowrap class="tdhead_center">�ܰ�</td>
						<td nowrap class="tdhead_center">�����</td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22">5kW</td>
						<td nowrap class="ltrow1_center_h22">
							<select name="d9" class="selectfm" style="vertical-align:middle;" onchange="high_voltage()">
								<option value="527000">527,000</option>
								<option value="220000">220,000</option>
							</select>
							��
						</td>
						<td nowrap class="ltrow1_center_h22"><span id="g9"></span>��</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
									<a href="#">����(�ʰ���)</a> 
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
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center">�������</td>
						<td nowrap class="tdhead_center">�ܰ�</td>
						<td nowrap class="tdhead_center">�����</td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22"><input name="a13"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10"  onkeyup="high_voltage();">kW</td>
						<td nowrap class="ltrow1_center_h22">
							<select name="d13" class="selectfm" style="vertical-align:middle;" onchange="high_voltage()">
								<option value="123000">123,000</option>
								<option value="86000">86,000</option>
							</select>
							��
						</td>
						<td nowrap class="ltrow1_center_h22"><span id="g13"></span>��</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
									<a href="#">�������Ա�</a> 
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
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center">����</td>
						<td nowrap class="tdhead_center">���</td>
						<td nowrap class="tdhead_center" style="font-weight:bold;">�������Ա�</td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22"><span id="a17"></span>��</td>
						<td nowrap class="ltrow1_center_h22"><span id="d17"></span>��</td>
						<td nowrap class="ltrow1_center_h22"><span id="g17" style="font-weight:bold;"></span>��</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
				<input type="hidden" name="electric_charges_payments" />
			</form>
			<div style="height:20px;font-size:0px;line-height:0px;"></div>

			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id=""> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/sb_tab_on_lt.gif"></td> 
								<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
								<a href="#">�ܰ�ǥ</a> 
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
			<!--�˻� -->
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
				<tr>
					<td nowrap class="tdhead_center" colspan="2">����</td>
					<td nowrap class="tdhead_center">���߰���</td>
					<td nowrap class="tdhead_center">���߰���</td>
				</tr>
				<tr class="list_row_now_wh">
					<td nowrap class="ltrow1_center_h22" colspan="2">���</td>
					<td nowrap class="ltrow1_center_h22">17,000��</td>
					<td nowrap class="ltrow1_center_h22">44,000��</td>
				</tr>
				<tr class="list_row_now_wh">
					<td nowrap class="ltrow1_center_h22" width="50" rowspan="2">����</td>
					<td nowrap class="ltrow1_center_h22" width="40" >5kW</td>
					<td nowrap class="ltrow1_center_h22">220,000��</td>
					<td nowrap class="ltrow1_center_h22">527,000��</td>
				</tr>
				<tr class="list_row_now_wh">
					<td nowrap class="ltrow1_center_h22">�ʰ�</td>
					<td nowrap class="ltrow1_center_h22">86,000��</td>
					<td nowrap class="ltrow1_center_h22">123,000��</td>
				</tr>
			</table>
			<div style="height:10px;font-size:0px;line-height:0px;"></div>
			<input type="hidden" name="electric_charges_payments" />

			<div style="height:10px;font-size:0px;line-height:0px;"></div>
			<!--����Ʈ -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
						<table border="0" cellpadding="0" cellspacing="0" style=display:inline;><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:data_input();" target="">�Է�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style=display:inline;><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:window.close();" target="">�ݱ�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
