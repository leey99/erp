<?
$mode = "popup";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$colspan = 11;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<TITLE>���� ��ȸ</TITLE>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="./css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
<SCRIPT type=text/javascript>
function win_close(){
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY style="margin:10px"><!-- width:540px, height:650px -->
<?
$colspan = 10;
$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);
$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);
$sql4 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
$result4 = sql_query($sql4);
$row4=mysql_fetch_array($result4);
//��������
$sql_common = " from pibohum_base_nomu ";
$sql_search = " where com_code='$code' and annual_paid_holiday_day!='' and sabun='$id' ";
$sql_order  = " order by annual_paid_holiday_day desc ";
$sql_hday = " select count(*) as hday_cnt
				$sql_common
				$sql_search ";				
$result_hday = sql_query($sql_hday);
$row_hday = mysql_fetch_array($result_hday);
$sql = " select *
				$sql_common
				$sql_search $sql_order ";
$result = sql_query($sql);
?>
<!--��޴� -->
<table border=0 cellspacing=0 cellpadding=0> 
	<tr>
		<td id=""> 
			<table border=0 cellpadding=0 cellspacing=0> 
				<tr> 
					<td><img src="images/g_tab_on_lt.gif"></td> 
					<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
					�⺻����
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

<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
	<col width="11%">
	<col width="23%">
	<col width="12%">
	<col width="20%">
	<col width="10%">
	<col width="24%">
	<tr>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����<font color="red"></font></td>
		<td nowrap class="tdrow">
			<?=$row1[name]?>
		</td>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ֹε�Ϲ�ȣ<font color="red"></font></td>
		<td nowrap class="tdrow">
			<?
			$jumin_no = explode("-",$row1[jumin_no]);
			?>

			<?=$jumin_no[0]?>-<?=$jumin_no[1]?>
		</td>
		<td nowrap class="tdrowk" rowspan="3">
			<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������
		</td>
		<td nowrap class="tdrow" rowspan="3">
			<?
				//�������
				if($row2[pic]) {
					$pic = "./files/images/$row1[com_code]_$row1[sabun].jpg";
				} else {
					$pic = "./images/blank_pic.gif";
				}
			?>

			<img src="<?=$pic?>" width="90" height="90" style="margin-bottom:2px"><br>
			
		</td>
	</tr>
	<tr>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ի���<font color="red"></font></td>
		<td nowrap class="tdrow">
			<?=$row1[in_day]?>
		</td>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
		<td nowrap class="tdrow">
			<?=$row1[out_day]?>
		</td>
	</tr>
	<tr>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�</td>
		<td nowrap class="tdrow" colspan="3">
			<?
			$adr_zip = explode("-",$row1[w_postno]);
			?>
			<div>
				<?=$adr_zip[0]?>-<?=$adr_zip[1]?>
			</div>
			<?=$row1[w_juso]?>
			<br>
			<?=$row2[w_juso2]?>
		</td>
	</tr>
	<tr>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�̸���</td>
		<td nowrap class="tdrow">
			<?=$row2[emp_email]?>
		</td>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޴���</td>
		<td nowrap class="tdrow">
			<?
			$emp_cel = explode("-",$row2[emp_cel]);
			if($emp_cel[0] == "010") $emp_cel_selected1 = "selected";
			else if($emp_cel[0] == "011") $emp_cel_selected2 = "selected";
			else if($emp_cel[0] == "016") $emp_cel_selected3 = "selected";
			else if($emp_cel[0] == "017") $emp_cel_selected4 = "selected";
			else if($emp_cel[0] == "018") $emp_cel_selected5 = "selected";
			else if($emp_cel[0] == "019") $emp_cel_selected6 = "selected";
			else if($emp_cel[0] == "070") $emp_cel_selected7 = "selected";
			?>

			<?=$emp_cel[0]?>-<?=$emp_cel[1]?><?=$emp_cel[2]?>
		</td>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ��ȣ</td>
		<td nowrap class="tdrow">
			<?
			$emp_tel = explode("-",$row1[add_tel]);
			if     ($emp_tel[0] == "02")  $emp_tel_selected1 = "selected";
			else if($emp_tel[0] == "032") $emp_tel_selected2 = "selected";
			else if($emp_tel[0] == "042") $emp_tel_selected3 = "selected";
			else if($emp_tel[0] == "051") $emp_tel_selected4 = "selected";
			else if($emp_tel[0] == "052") $emp_tel_selected5 = "selected";
			else if($emp_tel[0] == "053") $emp_tel_selected6 = "selected";
			else if($emp_tel[0] == "062") $emp_tel_selected7 = "selected";
			else if($emp_tel[0] == "064") $emp_tel_selected8 = "selected";
			else if($emp_tel[0] == "031") $emp_tel_selected9 = "selected";
			else if($emp_tel[0] == "033") $emp_tel_selected10 = "selected";
			else if($emp_tel[0] == "041") $emp_tel_selected11 = "selected";
			else if($emp_tel[0] == "043") $emp_tel_selected12 = "selected";
			else if($emp_tel[0] == "054") $emp_tel_selected13 = "selected";
			else if($emp_tel[0] == "055") $emp_tel_selected14 = "selected";
			else if($emp_tel[0] == "061") $emp_tel_selected15 = "selected";
			else if($emp_tel[0] == "063") $emp_tel_selected16 = "selected";
			else if($emp_tel[0] == "070") $emp_tel_selected17 = "selected";
			?>

			<?=$add_tel[0]?>-<?=$add_tel[1]?><?=$add_tel[2]?>
		</td>
	</tr>
	<tr>
		<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
		<td nowrap class="tdrow" colspan="5">
			<?=$row2[jikjong_code]?> -
			<?=$row2[jikjong]?>
		</td>
	</tr>
</table>

<div style="height:10px;font-size:0px;line-height:0px;"></div>
<!--��޴� -->
<table border=0 cellspacing=0 cellpadding=0> 
	<tr>
		<td id=""> 
			<table border=0 cellpadding=0 cellspacing=0> 
				<tr> 
					<td><img src="images/g_tab_on_lt.gif"></td> 
					<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
					��������
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
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
	<tr>
		<td nowrap class="tdhead_center" width="80">�������</td>
		<td nowrap class="tdhead_center" width="40">���</td>
		<td nowrap class="tdhead_center" width="70">�̸�</td>
		<td nowrap class="tdhead_center" width="80">����</td>
		<td nowrap class="tdhead_center" width="70">ä������</td>
		<td nowrap class="tdhead_center" width="80">�Ի���</td>
		<td nowrap class="tdhead_center" width="60">�ѿ���</td>
		<td nowrap class="tdhead_center" width="60">���</td>
		<td nowrap class="tdhead_center" width="60">�ܿ�</td>
		<td nowrap class="tdhead_center" width="">��������</td>
	</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	$list = $i%2;
	//idx
	$idx = $row[idx];
	//����� �ڵ� / ��� / �ڵ�_���
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// ������ : ������ڵ�
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	//���DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 6, "..");
	//�Ի���, ������
	$in_day = $row_base[in_day];
	$out_day = $row_base[out_day];
	//���DB �ɼ�
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//����
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//ä������
	if($row_base[work_form] == 1) $work_form = "������";
	else if($row_base[work_form] == 2) $work_form = "�����";
	else if($row_base[work_form] == 3) $work_form = "�Ͽ���";
	else $work_form = "";
	//���DB opt2
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//��������
	$annual_day = $row[annual_paid_holiday_day];
	//��������
	$annual_reason = $row[annual_paid_holiday_reason];
	//���� ���ϼ�
	$annual_paid_hday = $row_opt2[annual_paid_holiday];
	//���� ����ϼ�
	$annual_paid_hday_use = $row_hday[hday_cnt];
	//echo $annual_paid_hday_use." = ".$annual_paid_hday." - ".$row_hday[hday_cnt];
	//���� ����ϼ�
	$annual_paid_hday_rest = $annual_paid_hday - $row_hday[hday_cnt];
?>
	<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
		<td nowrap class="ltrow1_center_h22"><?=$annual_day?></td>
		<td nowrap class="ltrow1_center_h22"><?=$id?></td>
		<td nowrap class="ltrow1_center_h22"><a href="annual_paid_holiday_view.php?w=u&idx=<?=$idx?>&page=<?=$page?>"><b><?=$name?></b></a></td>
		<td nowrap class="ltrow1_center_h22"><?=$position?></td>
		<td nowrap class="ltrow1_center_h22"><?=$work_form?></td>
		<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_use?></td>
		<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_rest?></td> 
		<td nowrap class="ltrow1_center_h22"><?=$annual_reason?></td>
	</tr>
	</tr>
	<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
	?>
</table>

<P align="center"><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=�ݱ� src="./popup/images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV>
</BODY>
</HTML>
