<?
include_once("./_common.php");

if($item == "trade") {
	$sub_title = "����ӱݼ����׸�";
	$sub_menu = "100302";
} else if($item == "court") {
	$sub_title = "���������׸�";
	$sub_menu = "100303";
} else if($item == "privilege") {
	$sub_title = "��Ÿ�����׸�";
	$sub_menu = "100304";
}

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$g4[title] = $sub_title." : �޿������ڵ� : �������� : ".$easynomu_name;

//com_code ���
$sql_common_com = " from $g4[com_list_gy] ";
$sql_search_com = " where t_insureno='$member[mb_id]' ";
$sql_com = " select *
          $sql_common_com
          $sql_search_com ";
//echo $sql_com;
$result_com = sql_query($sql_com);
$row_com = mysql_fetch_array($result_com);
//echo $row_com[com_code];

$sql_common = " from com_paycode_list ";

//echo $is_admin;
if(!$item) $item = "trade";

//������ ���
if($w == "u") {
	$sql_search = " where com_code = '$code' and code='$id' ";

	$sql = " select *
						$sql_common
						$sql_search";

	//echo $sql;
	$result = sql_query($sql);
	$row=mysql_fetch_array($result);
	//echo $row[com_code];
}
?>
<?
if($item == "trade") {
	$pay_name = "�����׸�";
	$pay_type = "�ݾ�";
} else if($item == "court") {
	$pay_name = "�����׸�";
	$pay_type = "�ݾ�";
} else {
	$pay_name = "�����׸�";
	$pay_type = "������ѵ�";
}
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
	if (frm.pay_name.value == "")
	{
		alert("<?=$pay_name?>�� �Է��ϼ���.");
		frm.pay_name.focus();
		return;
	}
<?
if($item != "privilege" && $item != "trade") {
?>
	if (frm.multiple.value == "")
	{
		alert("������ �Է��ϼ���.");
		frm.multiple.focus();
		return;
	}
<? } ?>
	frm.action = "com_paycode_update.php";
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
function del(item,page,id) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "com_paycode_delete.php?item="+item+"&page="+page+"&id="+id;
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


//===============================================
// event.shiftKey : Ű�ڵ尪
// event.shiftKey, event.altKey, event.ctrlKey : boolean
// event.srcElement : �̺�Ʈ�� �߻��� ��ü
// 8: BackSpace, 46: Del
// ","=44, "-"=45, "."=46, "/"=47
// "0"=48, "9"=57
//"." = 190
// "@"=64, "A"=65, "Z"=90, "a"=97, "z"=122
// 37:LeftArrow, 38:UpArrow, 39:RightArrow, 40:DownArrow **
/** =============================================
Return : event.returnValue = boolean
Comment: Ű�Է½� ���ڸ� �Է� �ް� �Ѵ�.
Usage  : onKeyDown="fn_onKeyOnlyNumber();"
---------------------------------------------- */
function fn_onKeyOnlyNumber() {

}
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	if (inputVal.length > 3){
		input = delCom(inputVal, inputVal.length);
		/*
		for(i=0; i<inputVal.length; i++){
			if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
				input += inputVal.substring(i,i+1);	// ���� ��� , �� ����
			}
		}*/
		chk = (input.length)/3;					// input ���� 3�Ƿ� ���� �� ���
		chk = Math.floor(chk);					// �� ������ �۰ų� ���� �� �� �ִ��� ���� ���
		share = (input.length)%3;				// 200,000 �� ���� 3�� ����� ���� �ɷ����� ���� ������ ���
		if (share == 0 ) {						
			chk = chk - 1;					// ���̰� 3�� ����� ���� ���� chk ���� �ϳ� ����.
		}
		for(i=chk; i>0; i--){
			triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
			end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
			total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
			start = end;					// end ���� �������� start ������ ����.
		}
		total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
	} else {
		total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
	}
	if(keydown =='Y'){
		if ( type =='1' ) {
			main.calculate.value=total;					// type �� ���� �������� �־� �ش�.
		} else if ( type =='2' ) {
			main.tax_limit.value=total;
		}
	}else if(keydown =='N'){
		return total
	}
	return total
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
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
include "./inc/left_menu1.php";
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
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												�ڵ���� �⺻����
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

							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row_com[com_code]?>">
							<input type="hidden" name="item" value="<?=$item?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="page" value="<?=$page?>">

							<!-- �Է��� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><?=$pay_name?><font color="red">*</font></td>
									<td nowrap  class="tdrow" width="80%">
										<input type="text" name="pay_name" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row[name]?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap  class="tdrow">
										<input type="text" name="memo" class="textfm" style="width:550px;ime-mode:active;" value="<?=$row[memo]?>" maxlength="100">
									</td>
								</tr>
<?
if($item != "court") {
?>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><?=$pay_type?></td>
									<td nowrap  class="tdrow">
<?
	//��Ÿ���� �ѵ� ����
	if($item == "privilege") {
?>
										<input type="text" name="tax_limit" class="textfm" style="width:150px;" value="<?=$row[tax_limit]?>" maxlength="25" onkeyup="checkThousand(this.value, '2','Y')" />
<?
	} else {
?>
										<input type="text" name="calculate" class="textfm" style="width:150px;" value="<?=$row[calculate]?>" maxlength="25" onkeyup="checkThousand(this.value, '1','Y')" />
<?
	}
?>
									</td>
								</tr>
<?
}
//if($item != "privilege") {
//����ӱݼ���, ��Ÿ���� �� ���� ����
if($item == "court") {
?>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input type="text" name="multiple" class="textfm" style="width:150px;" value="<?=$row[multiple]?>" maxlength="15">
									</td>
								</tr>
<? } ?>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ڵ��ݿ�</td>
									<td nowrap  class="tdrow">
										<input type="checkbox" name="auto" value="Y" <? if($row[auto] == "Y") echo "checked"; ?> />	
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ӱ����� ����</td>
									<td nowrap  class="tdrow">
										<input type="checkbox" name="gy_yn" value="Y" <? if($row[gy_yn] == "Y") echo "checked"; ?> />	
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������ ���ݾ�</td>
									<td nowrap  class="tdrow">
										<input type="checkbox" name="retirement" value="Y" <? if($row[retirement] == "Y") echo "checked"; ?> />	
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������� ����</td>
									<td nowrap  class="tdrow">
										<input type="checkbox" name="income" value="Y" <? if($row[income] == "Y") echo "checked"; ?> />	
									</td>
								</tr>
<?
//}
?>
							</table>
<?
//���Ѻ� ��ũ��
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_save = "javascript:alert_demo();";
} else {
	$url_del = "javascript:del('$item',$page,$id);";
	$url_save = "javascript:checkData();";
}
?>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
if($member['mb_level'] >= 7) {
	if($w != "w") {
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
	}
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./com_paycode_list.php?item=<?=$item?>&page=<?=$page?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							</form>
							<!--��޴� -->
							<!-- �Է��� -->

<?
if($item == "trade") {
?>
							<div id="help_div">
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													����ӱ� ����
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

								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" style="padding:10px">
											'����ӱ�'�̶� �ٷ��ڿ��� �������̰� �Ϸ������� ����(���)�ٷ� �Ǵ� �� �ٷο� ���� �����ϱ�� ���� �ݾ�(���ٷα��ع� ����ɡ� ��6����1��)
											<br><br>
											EX. ��������, ��������, ��������, �������, �ڰݼ���, �������, ������� ��
										</td>
									</tr>
								</table>
							</div>
<? } ?>
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
