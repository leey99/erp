<?php
$sub_menu = "300100";
include_once("./_common.php");

//$file_name = "retirement_pay_calculate.xls";
$file_name = "퇴직금_계산.xls";
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

a:visited {  font-family:"돋움"; font-size:9pt; color: #253595; text-decoration: none}
a:link {  font-family:"돋움"; font-size:9pt; color: #253595; text-decoration: none}
a:hover {  font-family:"돋움"; font-size:9pt; color: #CC675E; text-decoration: none}

td {  font-family: "돋움", "Verdana"; font-size: 9pt; color : #2E2F32; }
.noinput { font: 9pt "돋움", "Verdana", "Arial", "Helvetica", "sans-serif"; 
background: #efefef; border: 1px #909297 solid; text-indent: 2px}
.textfield { font-family: "돋움", "Verdana"; font-size:9pt ; 
color : #2F2F2F; background : #ffffff; BORDER:1px #909297 solid ; text-indent: 2pt}
.datainput { font-family: "돋움", "Verdana"; font-size:9pt ; color : #000000; 
background : #FFFFFF; BORDER:0px  solid; text-indent: 2pt }
.datainput2 { font-family: "돋움", "Verdana"; font-size:9pt ; color : #000000; 
background : #F1F7FA; BORDER:0px  solid; text-indent: 2pt }
.textcenterfill { text-align: center ; font-weight: bold; color: #314e73; 
background: #E4F3FB; font-size: 9pt; vertical-align: middle}
.textcenterfill2 { text-align: center ; color: #314e73; 
background: #D4E1ED; font-size: 8pt; vertical-align: middle}
.fulldbox { font: 9pt "돋움", "Verdana", "Arial", "Helvetica", "sans-serif"; } 
.listtextcenter { text-align: center }
.text1 { font-family: "굴림", "Verdana"; font-size: 8pt; color : #2E2F32; }
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
    <table summary='' border="1" bordercolor="#000000" style="font-marginheight:2pt;font-size:9pt;font-family:'굴림체';table-layout:fixed" valign="middle" width="800">
			<tr height="30">
				<td bgcolor="#ffffcc"  colspan="4" align="center">* 퇴직금 계산 결과 *</td>
			</tr>
			<tr height="20" >
				<td colspan="4" ></td>
			</tr>
			<tr height="30" >
				<td colspan="2">입사일자: <?=$syear?>년 <?=$smon?>월 <?=$sday?>일</td>
				<td colspan="2" ></td>
			</tr>
			<tr height="30" >
				<td colspan="2">퇴직일자: <?=$eyear?>년 <?=$emon?>월 <?=$eday?>일</td>
				<td colspan="2"></td>
			</tr>
			 <tr height="30" >
				<td colspan="2">재직일자: <?=$termDays?> 일</td>
				<td colspan="2"></td>
			</tr>
			<tr height="30">
				<td colspan="4"></td>     
			</tr>
			<caption></caption><!--<th></th>-->
			<tbody></tbody>
		</table>
		<table summary='' border="1" bordercolor="#000000" style="font-size:9pt;font-family:'굴림체';table-layout:fixed" valign="middle"> 
		  <tr height="30">
        <td colspan="4">퇴직전 3개월간 임금총액 </td>
      </tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center">기간</td>
        <td bgcolor="#ffffcc" align="center">기간별일수</td>
        <td bgcolor="#ffffcc" align="center">기본급</td>
        <td bgcolor="#ffffcc" align="center">기타수당</td>
		  </tr>
			<tr height="30">
				<td align="center"><?=$fymd1?> ~ <?=$tymd1?></td>
				<td align="center"><?=$cntday1?> 일</td>
				<td align="center"><?=$basic1?> 원</td>
				<td align="center"><?=$bonus1?> 원</td>	
		  </tr>
      <tr height="30">
				<td align="center"><?=$fymd2?> ~ <?=$tymd2?></td>
				<td align="center"><?=$cntday2?> 일</td>
				<td align="center"><?=$basic2?> 원</td>
				<td align="center"><?=$bonus2?> 원</td>	
		  </tr>
      <tr height="30">
				<td align="center"><?=$fymd3?> ~ <?=$tymd3?></td>
				<td align="center"><?=$cntday3?> 일</td>
				<td align="center"><?=$basic3?> 원</td>
				<td align="center"><?=$bonus3?> 원</td>	
		  </tr>
<?
if($fymd4) {
?>
      <tr height="30">
				<td align="center"><?=$fymd4?> ~ <?=$tymd4?></td>
				<td align="center"><?=$cntday4?> 일</td>
				<td align="center"><?=$basic4?> 원</td>
				<td align="center"><?=$bonus4?> 원</td>	
		  </tr>
<?
}
?>
      <tr height="30">
				<td align="center">합계</td>
				<td align="center"><?=$sumday?> 일</td>
				<td align="center"><?=$sumbasic?> 원 ①</td>
				<td align="center"><?=$sumbonus?> 원 ②</td>
			</tr>		    
			<caption></caption><!--<th></th>-->
			<tbody></tbody>
		</table>
    <table summary='' border="1" bordercolor="#000000" style="font-size:9pt;font-family:'굴림체';table-layout:fixed" valign="middle"> 
		  <tr height="20">
				<td align="center" colspan="4"></td>
      </tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >연간상여금 총액 ③</td>
				<td align="center" ><?=$annualBonus?> 원 </td>
        <td colspan="2"></td>
      </tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >연차수당 ④</td>
				<td align="center" ><?=$vacaBunus?> 원</td>
        <td colspan="2"></td>
			</tr>
      <tr height="20">
        <td colspan="4"></td>
			</tr>
			<tr height="30">
				<td bgcolor="#ffffcc" align="center" >1일평균임금</td>
				<td align="center" ><?=$avrPay?> 원</td>
        <td colspan="2"></td>
			</tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >통상임금</td>
				<td align="center" ><?=$comPay?> 원</td>
        <td colspan="2"></td>
			</tr>
      <tr height="20">
				<td colspan="4"></td>
			</tr>
      <tr height="30">
				<td bgcolor="#ffffcc" align="center" >퇴직금</td>
				<td align="center" ><?=$retirePay?> 원</td>
        <td colspan="2"> </td>
			</tr>
      <tr height="30">
				<td colspan="4"></td>
			</tr>       
      <tr height="30">
				<td colspan="4" bgcolor="#ffffcc">&nbsp;&nbsp;1일 평균임금 계산식</td>
			</tr>
      <tr height="30">
				<td colspan="4"><table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
			<tr height="30">
				<td width="80" rowspan="2" class=text1 align="right">1일평균임금 = </td>
				<td colspan="3" width="250" style="border-bottom-width:0.1pt; border-bottom-color:black; border-bottom-style:solid;" align="center" class=text1>
					퇴직일 이전 3개월간에 지급 받은 임금총액 
				</td>
			</tr>
			<tr height="30">
				<td colspan="3" width="270" class=text1><p align="center">퇴직일 이전 3개월간의 총 일 수</td>
			</tr>
			<caption></caption><!--<th></th>--><tbody></tbody></table></td>
			</tr>
      <tr height="30">
				<td colspan="4">
					<table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
						<tr height="30">
							<td width="80" rowspan="2" class=text1 align="right">1일평균임금 계산과정 = </td>
							<td colspan="3" width="250" style="border-bottom-width:0.1pt; border-bottom-color:black; border-bottom-style:solid;" align="center" class=text1>
								<?=$sumbasic?> ① + <?=$sumbonus?> ② + <?=$annualBonus?> ③ (3/12) + <?=$vacaBunus?> ④ (3/12)	
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
				<td colspan="4" bgcolor="#ffffcc">&nbsp;&nbsp;퇴직금 계산식</td>
			</tr>
			<tr height="30">
				<td colspan="4">
					<table summary='' style="margin-bottom:5pt;margin-top:3pt;" cellpadding="0" cellspacing="0" width="330" border="0" >
						<tr  height="30">
							<td align="right" class=text1>퇴직금 = </td>
							<td colspan="3" class=text1 >&nbsp;1일 평균임금 X 30(일) X (총 재직일수/365) </td>
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
							<td align="right" class=text1>퇴직금 계산과정 = </td>
							<td colspan="3" class=text1 >&nbsp;1일 평균임금 <?=$avrPay?>원 X 30일 X (<?=$termDays?>일/ 365일)</td>
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
