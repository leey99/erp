<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META content="IE=7.0000" http-equiv="X-UA-Compatible">
<META content="text/html; charset=ks_c_5601-1987" http-equiv="Content-Type">
<META content="IE=7 http-equiv=X-UA-Compatible">
<META content="text/css http-equiv=Content-Style-Type">
<TITLE>��������</TITLE>
<LINK rel="stylesheet" type="text/css" href="images/default.css">
<LINK rel="stylesheet" type="text/css" href="images/pko.css">
<SCRIPT type="text/javascript" src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type="text/javascript" src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$_GET['n']) $n = "";
else $n = $_GET['n'];
?>
<SCRIPT type="text/javascript">
$(function(){
	var nhicRowNum = "null";
	var rowNum     = "null";
	$("input[name='select01']").click(function() { 
			var i = $("input[name='select01']").index(this); 
			var value = $("input[name='select01']").eq(i).val();
			if( rowNum != "null" && nhicRowNum != "null" ){

			}else{
				$('#quit_cause<?=$n?>',opener.document).val(value.split("_")[0]);
				$('#quit_cause_text<?=$n?>',opener.document).val(value.split("_")[1]);
				self.close();
			}
	}); 
	$("#searchKeyword").focus();
});
function win_close(){
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="�����ڵ�3(139�� �� KECO �ڵ�, ���,����)(���� 138��) �˻�" 
src="images/D107.gif"></H1>
<P class=logoBg><IMG alt="4���ȸ���� �������輾��" src="images/logoBg.gif"></P>
<p>�� Ctrl + F ����Ű�� ���� �˻��� �����մϴ�.</p>
<P class=full>��ü <SPAN>138</SPAN>��</P>
<TABLE class=skyTable width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>����</TH>
			<TH scope=col>�ڵ�</TH>
			<TH scope=col>��Ī</TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:470px">
<TABLE class=skyTable2 width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <TBODY>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="11_���λ������� ���� �������" name="select01"></TD>
    <TD class="alignC">11</TD>
    <TD>���λ������� ���� �������</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="12_����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������" name="select01"></TD>
    <TD class="alignC">12</TD>
    <TD>����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="22_���, �������� ���� ����" name="select01"></TD>
    <TD class="alignC">22</TD>
    <TD>���, �������� ���� ����</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="23_�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� ���(�Ǿ��޿�)" name="select01"></TD>
    <TD class="alignC">23</TD>
    <TD>�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� ���(<span style="color:red;">�Ǿ��޿�</span>)</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="26_�ٷ����� ��å������ ���� ¡���ذ�, �ǰ����" name="select01"></TD>
    <TD class="alignC">26</TD>
    <TD>�ٷ����� ��å������ ���� ¡���ذ�</TD></TR>
		<!--, �ǰ���� ���� ������, �豹�� ��û 160603-->
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="31_�������� ���� ����" name="select01"></TD>
    <TD class="alignC">31</TD>
    <TD>�������� ���� ����</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="32_��ุ��, ��������" name="select01"></TD>
    <TD class="alignC">32</TD>
    <TD>��ุ��, ��������</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="radio" value="41_��뺸�� ������, ���߰��" name="select01"></TD>
    <TD class="alignC">41</TD>
    <TD>��뺸�� ������, ���߰��</TD></TR>
	</TBODY>
</TABLE>
</div>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=�ݱ� src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
