<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");
if($frm == 2) {
	$sql_common = " from a4_modify ";
} else {
	$sql_common = " from a4_4insure ";
}
$sql_search = " where comp_bznb='$comp_bznb' order by id desc ";

$sub_title = "����� �˻�";
$g4[title] = $sub_title." : �˾� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";

//echo $sql;
$result = sql_query($sql);

$colspan = 11;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE><?=$g4[title]?></TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content="IE=7 http-equiv=X-UA-Compatible">
<META content="text/css http-equiv=Content-Style-Type">
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="images/pko.css">
<SCRIPT type=text/javascript src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$n) $n = "";
?>
<SCRIPT type=text/javascript>
$(function(){
	var nhicRowNum = "null";
	var rowNum     = "null";
	$("input[name='select01']").click(function() { 
			var i = $("input[name='select01']").index(this); 
			var value = $("input[name='select01']").eq(i).val();
<?
if($frm == 2) {
?>			
			$('#comp_bznb2',opener.document).val(value.split("_")[0]);
			$('#comp_name2',opener.document).val(value.split("_")[1]);
			$('#comp_adr2', opener.document).val(value.split("_")[2]);
			$('#comp_tel2', opener.document).val(value.split("_")[3]);
			$('#comp_email2', opener.document).val(value.split("_")[4]);
			$('#comp_fax2', opener.document).val(value.split("_")[5]);
<?
} else {
?>
			$('#comp_bznb',opener.document).val(value.split("_")[0]);
			$('#comp_name',opener.document).val(value.split("_")[1]);
			$('#comp_adr', opener.document).val(value.split("_")[2]);
			$('#comp_tel', opener.document).val(value.split("_")[3]);
			$('#comp_email', opener.document).val(value.split("_")[4]);
			$('#comp_fax', opener.document).val(value.split("_")[5]);
<?
}
?>
			self.close();
	}); 
	
	if( rowNum != "null" && nhicRowNum != "null" ){
		//parent.iframe_focus(rowNum,nhicRowNum);
	}
	
	$("#searchKeyword").focus();
});

function win_close(){
	window.close();
}
function search_comp() {
	var frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("����ڵ�Ϲ�ȣ�� �Է� �� �˻��� �ֽʽÿ�.");
		return;
	}
	location.href = "<?=$PHP_SELF?>?comp_bznb="+n;
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="�����ڵ�3(139�� �� KECO �ڵ�, ���,����)(���� 138��) �˻�" 
src="images/D108.gif"></H1>
<P class=logoBg><IMG alt="4���ȸ���� �������輾��" src="images/logoBg.gif"></P>
<p style="margin:0 0 10px">
	<form name="dataForm" method="post" style="margin:0">
	�� ����ڵ�Ϲ�ȣ
	<input name="comp_bznb" id="searchKeyword" type="text" class="textfm" style="width:100px;" value="<?=$comp_bznb?>" maxlength="12">
	<label onclick="search_comp();" style="cursor:pointer"><img src="../images/search_bt.png" align=absmiddle></label>
	��) 123-12-12345
	</form>
</p>
<div style="margin-bottom:10px">
<?
//���հ������α׷� DB
include_once("../../dbconfig_erp.php");
$db2 = mysql_connect($mysql_host,$mysql_user,$mysql_password);
mysql_select_db($mysql_db,$db2);
mysql_query(" set names euckr ");
//����� �ڵ�
$sql_a4 = " select * from com_list_gy where biz_no = '$comp_bznb' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
if($com_code) {
	$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
	$row_a4_opt = sql_fetch($sql_a4_opt);
	$samu_req_yn = $row_a4_opt['samu_req_yn'];
	if($samu_req_yn == "4") $samu_text = "������";
	else $samu_text = "���Ӱ���";
	//echo $sql_a4;
	//echo $com_code;
	echo "���繫��Ź���� : <b style='color:blue;'>".$samu_text."</b> (".$row_a4['com_name'].")<br>";
	if($samu_req_yn != "4") {
		echo "<div style='padding:0 0 4px 10px'><a href='/easynomu/files/hwp/samu_reg.hwp'><img src='/easynomu/images/btn_samu_reg.gif' border='0'></a></div>";
		echo "���繫��Ź�� �ۼ� �� FAX <b>0505-609-0001</b> �����ֽʽÿ�.<br>";
	}
}
?>
</div>
<TABLE class=skyTable width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="40%"></COLGROUP>
  <COL></COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>����</TH>
			<TH scope=col>������</TH>
			<TH scope=col>��ȭ��ȣ</TH>
			<TH scope=col>��������</TH>
		</TR>
	</THEAD>
  <TBODY>
<?
//�ڵ�
//$code_var = $row[comp_bznb]."_".$row[comp_name]."_".$row[comp_adr]."_".$row[comp_tel]."_".$row[comp_email]."_".$row[comp_fax];
$code_var = $row_a4['biz_no']."_".$row_a4['com_name']."_".$row_a4['com_juso']." ".$row_a4['com_juso2']."_".$row_a4['com_tel']."_".$row_a4['com_mail']."_".$row_a4['com_fax'];
//$w_date_array = explode(" ", $row[wr_datetime]);
//$w_date = $w_date_array[0];
$w_date = $row_a4_opt['samu_req_date'];
if($com_code) {
?>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio value="<?=$code_var?>" name=select01></TD>
    <TD class=alignC><?=$row_a4['com_name']?></TD>
    <TD class=alignC><?=$row_a4['com_tel']?></TD>
    <TD class=alignC><?=$w_date?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=�ݱ� src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
