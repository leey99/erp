<?php
$sub_menu = "300100";
include_once("./_common.php");

//$file_name = "retirement_pay_calculate.xls";
$file_name = "������_���.xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html>
<style type="text/css">
<!-- 
BODY 
{scrollbar-face-color:#C0C1D1 ; scrollbar-shadow-color:FFFFFF ; 
scrollbar-highlight-color:#C0C1D1 ; scrollbar-3dlight-color:FFFFFF ; 
scrollbar-darkshadow-color:#C0C1D1 ; scrollbar-track-color: DCDDE7;
scrollbar-arrow-color:FFFFFF }

a:visited {  font-family:"����"; font-size:9pt; color: #253595; text-decoration: none}
a:link {  font-family:"����"; font-size:9pt; color: #253595; text-decoration: none}
a:hover {  font-family:"����"; font-size:9pt; color: #CC675E; text-decoration: none}

td {  font-family: "����", "Verdana"; font-size: 9pt; color : #2E2F32; }
.noinput { font: 9pt "����", "Verdana", "Arial", "Helvetica", "sans-serif"; 
background: #efefef; border: 1px #909297 solid; text-indent: 2px}
.textfield { font-family: "����", "Verdana"; font-size:9pt ; 
color : #2F2F2F; background : #ffffff; BORDER:1px #909297 solid ; text-indent: 2pt}
.datainput { font-family: "����", "Verdana"; font-size:9pt ; color : #000000; 
background : #FFFFFF; BORDER:0px  solid; text-indent: 2pt }
.datainput2 { font-family: "����", "Verdana"; font-size:9pt ; color : #000000; 
background : #F1F7FA; BORDER:0px  solid; text-indent: 2pt }
.textcenterfill { text-align: center ; font-weight: bold; color: #314e73; 
background: #E4F3FB; font-size: 9pt; vertical-align: middle}
.textcenterfill2 { text-align: center ; color: #314e73; 
background: #D4E1ED; font-size: 8pt; vertical-align: middle}
.fulldbox { font: 9pt "����", "Verdana", "Arial", "Helvetica", "sans-serif"; } 
.listtextcenter { text-align: center }
.text1 { font-family: "����", "Verdana"; font-size: 8pt; color : #2E2F32; }
//-->
</style>
<body>
<table summary='' border="0" align="center">
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>
    <table summary='' border="1" bordercolor="#000000" style="font-marginheight:2pt;font-size:9pt;font-family:'����ü';table-layout:fixed" valign="middle" width="800">
			<tr height="30">
				<td bgcolor="#ffffcc"  colspan="4" align="center">* ������ ��� ��� *</td>
			</tr>
			<tr height="20" >
				<td colspan="4" ></td>
			</tr>
			<tr height="30" >
				<td colspan="2">�Ի�����: <?=$syear?>�� <?=$smon?>�� <?=$sday?>��</td>
				<td colspan="2" ></td>
			</tr>
			<tr height="30" >
				<td colspan="2">��������: <?=$eyear?>�� <?=$emon?>�� <?=$eday?>��</td>
				<td colspan="2"></td>
			</tr>
			 <tr height="30" >
				<td colspan="2">��������: <?=$termDays?> ��</td>
				<td colspan="2"></td>
			</tr>
			<tr height="30">
				<td colspan="4"></td>     
			</tr>
			<caption></caption><!--<th></th>-->
			<tbody></tbody>
		</table>
		<table summary='' border="1" bordercolor="#000000" style="font-size:9pt;font-family:'����ü';table-layout:fixed" valign="middle"> 
		  <tr height="30">
        <td colspan="4">������ 3������ �ӱ��Ѿ� </td>
      </tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center">�Ⱓ</td>
        <td bgcolor="#ffffcc" align="center">�Ⱓ���ϼ�</td>
        <td bgcolor="#ffffcc" align="center">�⺻��</td>
        <td bgcolor="#ffffcc" align="center">��Ÿ����</td>
		  </tr>
			<tr height="30">
				<td align="center"><?=$fymd1?> ~ <?=$tymd1?></td>
				<td align="center"><?=$cntday1?> ��</td>
				<td align="center"><?=$basic1?> ��</td>
				<td align="center"><?=$bonus1?> ��</td>	
		  </tr>
      <tr height="30">
				<td align="center"><?=$fymd2?> ~ <?=$tymd2?></td>
				<td align="center"><?=$cntday2?> ��</td>
				<td align="center"><?=$basic2?> ��</td>
				<td align="center"><?=$bonus2?> ��</td>	
		  </tr>
      <tr height="30">
				<td align="center"><?=$fymd3?> ~ <?=$tymd3?></td>
				<td align="center"><?=$cntday3?> ��</td>
				<td align="center"><?=$basic3?> ��</td>
				<td align="center"><?=$bonus3?> ��</td>	
		  </tr>
<?
if($fymd4) {
?>
      <tr height="30">
				<td align="center"><?=$fymd4?> ~ <?=$tymd4?></td>
				<td align="center"><?=$cntday4?> ��</td>
				<td align="center"><?=$basic4?> ��</td>
				<td align="center"><?=$bonus4?> ��</td>	
		  </tr>
<?
}
?>
      <tr height="30">
				<td align="center">�հ�</td>
				<td align="center"><?=$sumday?> ��</td>
				<td align="center"><?=$sumbasic?> �� ��</td>
				<td align="center"><?=$sumbonus?> �� ��</td>
			</tr>		    
			<caption></caption><!--<th></th>-->
			<tbody></tbody>
		</table>
    <table summary='' border="1" bordercolor="#000000" style="font-size:9pt;font-family:'����ü';table-layout:fixed" valign="middle"> 
		  <tr height="20">
				<td align="center" colspan="4"></td>
      </tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >�����󿩱� �Ѿ� ��</td>
				<td align="center" ><?=$annualBonus?> �� </td>
        <td colspan="2"></td>
      </tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >�������� ��</td>
				<td align="center" ><?=$vacaBunus?> ��</td>
        <td colspan="2"></td>
			</tr>
      <tr height="20">
        <td colspan="4"></td>
			</tr>
			<tr height="30">
				<td bgcolor="#ffffcc" align="center" >1������ӱ�</td>
				<td align="center" ><?=$avrPay?> ��</td>
        <td colspan="2"></td>
			</tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >����ӱ�</td>
				<td align="center" ><?=$comPay?> ��</td>
        <td colspan="2"></td>
			</tr>
      <tr height="20">
				<td colspan="4"></td>
			</tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >������</td>
				<td align="center" ><?=$retirePay?> ��</td>
        <td colspan="2"> </td>
			</tr>
      <tr height="30">
				<td colspan="4"></td>
			</tr>       
      <tr height="30">
				<td colspan="4" bgcolor="#ffffcc">&nbsp;&nbsp;1�� ����ӱ� ����</td>
			</tr>
      <tr height="30">
				<td colspan="4"><table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
			<tr height="30">
				<td width="80" rowspan="2" class=text1 align="right">1������ӱ� = </td>
				<td colspan="3" width="250" style="border-bottom-width:0.1pt; border-bottom-color:black; border-bottom-style:solid;" align="center" class=text1>
					������ ���� 3�������� ���� ���� �ӱ��Ѿ� 
				</td>
			</tr>
			<tr height="30">
				<td colspan="3" width="270" class=text1><p align="center">������ ���� 3�������� �� �� ��</td>
			</tr>
			<caption></caption><!--<th></th>--><tbody></tbody></table></td>
			</tr>
      <tr height="30">
				<td colspan="4">
					<table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
						<tr height="30">
							<td width="80" rowspan="2" class=text1 align="right">1������ӱ� ������ = </td>
							<td colspan="3" width="250" style="border-bottom-width:0.1pt; border-bottom-color:black; border-bottom-style:solid;" align="center" class=text1>
								<?=$sumbasic?> �� + <?=$sumbonus?> �� + <?=$annualBonus?> �� (3/12) + <?=$vacaBunus?> �� (3/12)	
							</td>
						</tr>
						<tr height="30">
							<td colspan="3" width="270" class=text1><p align="center"><?=$sumday?></td>
						</tr>
						<caption></caption><!--<th></th>-->
						<tbody></tbody>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td colspan="4" bgcolor="#ffffcc">&nbsp;&nbsp;������ ����</td>
			</tr>
			<tr height="30">
				<td colspan="4">
					<table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
						<tr  height="30">
							<td align="right" class=text1>������ = </td>
							<td colspan="3" class=text1 >&nbsp;1�� ����ӱ� X 30(��) X (�� �����ϼ�/365) </td>
						</tr>
						<caption></caption><!--<th></th>-->
						<tbody></tbody>
					</table>
				</td>
			</tr>
			<tr height="30">
				<td colspan="4">
					<table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
            <tr  height="30">
							<td align="right" class=text1>������ ������ = </td>
							<td colspan="3" class=text1 >&nbsp;1�� ����ӱ� <?=$avrPay?>�� X 30�� X (<?=$termDays?>��/ 365��)</td>
            </tr>
            <caption></caption><!--<th></th>-->
						<tbody></tbody>
						</table>
          </td>
        </tr>
				<caption></caption><!--<th></th>-->
				<tbody></tbody>
			</table>
		</td>
	</tr>
	<caption></caption><!--<th></th>-->
	<tbody></tbody>
</table>
</body>
</html>
<?
exit;
?>
