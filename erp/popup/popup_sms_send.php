<?
$mode = "popup";
include_once("./_common.php");
$sub_title = "���� �߼�";
$g4[title] = $sub_title." : �˾� : ".$easynomu_name;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="IE=7.0000" http-equiv="X-UA-Compatible">
<title><?=$g4[title]?></title>
<meta content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<meta content="IE=7 http-equiv=X-UA-Compatible">
<meta content="text/css http-equiv=Content-Style-Type">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
<meta name=GENERATOR content="MSHTML 10.00.9200.16686">
<script type="text/javascript"  src="../js/common.js"></script>
<script type="text/javascript">
//<![CDATA[
function getId(id) {
	return document.getElementById(id);
}
//���� 80byte üũ
function displayBytes( sz, id ) {
	var form= document.dataForm;
	var obj = document.getElementById( id );
	if(obj.value.bytes() > sz) {
		if(event.keyCode != '8') {
			alert( sz+'�ڱ��� �Է��� �����մϴ�.');
			obj_value = obj.value;
			obj.value = cutStr(obj_value, sz+1);
		}
		obj.value = obj.value.substring(0, obj.value.length - 1);
	}
	getId(id+'_bytes').value = form[id].value.bytes()+"��";
}
String.prototype.bytes = function() {
	var str = this;
	var l = 0;
	for(var i=0; i<str.length; i++) l += (str.charCodeAt(i) > 128) ? 2 : 1;
	return l;
}
//���ڿ� ����Ʈ�� �ڸ���
function cutStr(str, limit) {
	var retstr = '';
	var strlength = 0;
	var character = '';
	for(var i = 0; i < str.length; i++) {
		character = str.charAt(i);
		strlength += chk_byte(character);
		if(strlength > limit) {
			retstr += '';
			break;
		} else {
			retstr += character;
		}
	}
	return retstr;
} 
function chk_byte(character) { 
	if(escape(character).length > 4) return 2; 
	else return 1;
}
//���ڹ߼�
function sms_send() {
	//alert("���ڹ߼� ���񽺴� ������ ���� �� �̿� �����մϴ�.");
	//return;
	var frm = document.dataForm;
	if (frm.chk1.value == "") {
		alert("���� ������ �Է��ϼ���.");
		frm.chk1.focus();
		return;
	}
	if (frm.to_sms.value == "") {
		alert("ȸ�Ź�ȣ�� �Է��ϼ���.");
		frm.to_sms.focus();
		return;
	}
	if (frm.to_hp.value == "") {
	 alert("���Ź�ȣ�� �Է��ϼ���.");
	 return;
	} else{
		if(confirm("���� ���� �߼� �Ͻðڽ��ϱ�?")) {
			frm.action="popup_sms_update.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//]]>
</script>
</head>
<body>
<form name="dataForm" method="post" style="margin:4px;">
	<table border=0 cellspacing=0 cellpadding=0> 
		<tr>
			<td id=""> 
				<table border=0 cellpadding=0 cellspacing=0> 
					<tr> 
						<td><img src="../images/g_tab_on_lt.gif"></td> 
						<td background="../images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
						���ڹ߼�
						</td> 
						<td><img src="../images/g_tab_on_rt.gif"></td> 
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
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
		<tr>
			<td nowrap class="tdrowk" width="80"><img src="../images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڳ���</td>
			<td nowrap class="tdrow">
				<textarea id="chk1" name="chk1" onkeyup="displayBytes(80,'chk1');" style="width:228px;height:150px;font-size:18pt;"></textarea>
				<br />
				<input type="text" name='chk1_bytes' id='chk1_bytes' style="width:40px;" value="80��" />
			</td>
		</tr>
		<tr>
			<td nowrap class="tdrowk"><img src="../images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���Ź�ȣ</td>
			<td nowrap class="tdrow">
				<input type="text" name='to_hp' style="width:110px;" value="<?=$to_phone?>" />
			</td>
		</tr>
		<tr>
			<td nowrap class="tdrowk"><img src="../images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ȸ�Ź�ȣ</td>
			<td nowrap class="tdrow">
				<input type="text" name='to_sms' style="width:110px;" value="1544-4519" />
			</td>
		</tr>
	</table>
	<div style="text-align:center;margin-top:10px;">
		<a href="javascript:sms_send();"><img src="./../images/btn_sms_send.png" border="0" /></a>
	</div>
</form>
</body>
</html>
