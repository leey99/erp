<?
$sub_menu = "500100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//���������
$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];
//��������� �߰�
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);

$sql_common = " from $g4[pibohum_base] ";

$sql1 = " select * $sql_common where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
//���DB �ɼ�
$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
//���DB �빫
$sql3 = " select * from pibohum_base_nomu where idx='$idx' ";
$result3 = sql_query($sql3);
//������ ���
if($w == "u") {
	$row1=mysql_fetch_array($result1);
	$row2=mysql_fetch_array($result2);
	$row3=mysql_fetch_array($result3);
}

$sub_title = "��������";
$g4[title] = $sub_title." : �빫���� : ".$easynomu_name;
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
function checkID()
{
	var frm = document.dataForm;
	if (frm.user_id.value == "")
	{
		alert("���̵� �Է��ϼ���.");
		frm.user_id.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?uid="+frm.user_id.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip3=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	return;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;

	if (frm.sabun.value == "")
	{
		alert("����� �����ϼ���.");
		frm.sabun.focus();
		return;
	}
	if (frm.out_day.value == "")
	{
		alert("�������ڸ� �Է��ϼ���.");
		frm.out_day.focus();
		return;
	}
	if (frm.quit_cause.value == "")
	{
		alert("�������и� �����ϼ���.");
		frm.quit_cause.focus();
		return;
	}
	frm.action = "retirement_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" ������ �ּ���.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
// ���� �˻� Ȯ��
function del(page,idx) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "retirement_delete.php?page="+page+"&idx="+idx;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu5.php";
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
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
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

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�������
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

							<form name="dataForm" method="post">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row_com[com_code]?>">
							<input type="hidden" name="code" value="<?=$code?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="idx" value="<?=$idx?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<!-- �Է��� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="80%">
<?
if($w != u)	{
?>
										<select name='sabun' class='select'>
										<option value=''>�ٷ��ڼ���</option>
										<option value=''>-----------------</option>
										<!-- �ٷ��ڸ���Ʈ���� -->
										<?
										// ����Ʈ ���
										$sql = " select * $sql_common where com_code='$com_code' ";
										//echo $sql;
										$result = sql_query($sql);
										for ($i=0; $row=sql_fetch_array($result); $i++) {
											//$page
											//$total_page
											//$rows

											$no = $total_count - $i - ($rows*($page-1));
											$list = $i%2;
											// ������ : ������ڵ�
											$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
											$row_com = sql_fetch($sql_com);
											$com_name = $row_com[com_name];
											$com_name = cut_str($com_name, 21, "..");
											$name = cut_str($row[name], 6, "..");
											//$idx = $row[com_code]."_".$row[sabun];
										?>
														<option value="<?=$row[sabun]?>" <? if($row[sabun] == $row1[sabun]) echo "selected"; ?> >[<?=$row[sabun]?>] <?=$name?> (<?=$row[in_day]?>)</option>
										<?
										}
										if ($i == 0)
												echo "<option value=''>�ڷᰡ �����ϴ�.</option>";
										?>
										</select>
<?
} else {
	echo $row1[name]."<input type='hidden' name='sabun' value='$row1[sabun]'>";
}
?>

									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="out_day" type="text" class="textfm" style="width:76px;" value="<?=$row1[out_day]?>" maxlength="10">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.out_day);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										* ������ �ٹ����� ������
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<?
										for($i=0; $i<=99; $i++) {
											//echo $row3[quit_cause];
											if($row3[quit_cause] == $i) $quit_cause_select[$i] = "selected";
											else $quit_cause_select[$i] = "";
										}
										?>

										<select name="quit_cause" class="selectfm">
											<option value="">�����ϼ���</option>
											<option value="11" <?=$quit_cause_select[11]?>>���λ������� ���� �������</option>
											<option value="12" <?=$quit_cause_select[12]?>>����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</option>
											<option value="22" <?=$quit_cause_select[22]?>>���, ����</option>
											<option value="23" <?=$quit_cause_select[23]?>>�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� � ���� ���(�Ǿ��޿�)</option>
											<option value="26" <?=$quit_cause_select[26]?>>�ٷ����� ��å������ ���� ¡���ذ�, �ǰ����</option>
											<option value="31" <?=$quit_cause_select[31]?>>����</option>
											<option value="32" <?=$quit_cause_select[32]?>>��ุ��, ��������</option>
											<option value="41" <?=$quit_cause_select[41]?>>��뺸�� ������, ���߰��</option>
											<option value="98" <?=$quit_cause_select[98]?>>�Ҹ����� �ϰ�����</option>
											<option value="99" <?=$quit_cause_select[99]?>>���ٿ� ���� ����</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������</td>
									<td nowrap  class="tdrow">
										<input type="text" name="retire_reason" class="textfm" style="width:600px;" value="<?=$row3[retire_reason]?>" maxlength="" />
									</td>
								</tr>
							</table>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_del = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_del = "javascript:del($page,$idx);";
}
?>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
<?
if($w == "u") {
?>
										<a href="<?=$url_del?>" target=""><img src="images/btn_del_big.png" border="0"></a>
<? } ?>
										<a href="./retirement.php?page=<?=$page?>" target=""><img src="images/btn_list_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							</form>
							<!--��޴� -->
							<!-- �Է��� -->

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
