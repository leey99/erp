<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE>4���ȸ���� �������輾�� - �����ڵ�3(139�� �� KECO �ڵ�, ���,����)(���� 138��) �˻�</TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="images/pko.css">
<SCRIPT type=text/javascript src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$_GET['n']) $n = "";
else $n = $_GET['n'];
?>
<SCRIPT type=text/javascript>
	$(function(){
        var nhicRowNum = "null";
        var rowNum     = "null";
		$("input[name='select01']").click(function() { 
			  var i = $("input[name='select01']").index(this); 
			  var value = $("input[name='select01']").eq(i).val();
			  
			  if( rowNum != "null" && nhicRowNum != "null" ){
				  parent.value_set('join_note<?=$n?>',value.split("_")[0],'join_jikjong<?=$n?>',value.split("_")[1])
				  //parent.ifr_close('join_note','join_jikjong');
			  }else{
	              //$('#join_jikjong',opener.document).focus();
	              $('#join_jikjong_code<?=$n?>',opener.document).val(value.split("_")[0]);
	              $('#join_jikjong<?=$n?>',opener.document).val(value.split("_")[1]);
								//alert(value.split("_")[0]);
	              self.close();
			  }
		}); 
		
		if( rowNum != "null" && nhicRowNum != "null" ){
			//parent.iframe_focus(rowNum,nhicRowNum);
		}
		
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
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="011_���������� �� ��� �����ӿ�" name=select01></TD>
    <TD class=alignC>011</TD>
    <TD>���������� �� ��� �����ӿ�</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="012_�濵����, ���� �� ���� ���� ������" name=select01></TD>
    <TD class=alignC>012</TD>
    <TD>�濵����, ���� �� ���� ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="013_��ȸ���� ���� ������(����, ����, ���� ��)" name=select01></TD>
    <TD class=alignC>013</TD>
    <TD>��ȸ���� ���� ������(����, ����, ���� ��)</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="014_��ȭ, ����, ������, ���� ���� ������" name=select01></TD>
    <TD class=alignC>014</TD>
    <TD>��ȭ, ����, ������, ���� ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="015_�Ǽ� �� ���� ���� ������" name=select01></TD>
    <TD class=alignC>015</TD>
    <TD>�Ǽ� �� ���� ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="016_������� ���� ������" name=select01></TD>
    <TD class=alignC>016</TD>
    <TD>������� ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="017_����, �Ǹ� �� ��� ���� ������" name=select01></TD>
    <TD class=alignC>017</TD>
    <TD>����, �Ǹ� �� ��� ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="018_����, ����, ����, ���� �� ������ ���� ������" name=select01></TD>
    <TD class=alignC>018</TD>
    <TD>����, ����, ����, ���� �� ������ ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="019_ȯ��, û�� �� ��� ���� ������" name=select01></TD>
    <TD class=alignC>019</TD>
    <TD>ȯ��, û�� �� ��� ���� ������</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="021_�濵 �� ���� ���� ������" name=select01></TD>
    <TD class=alignC>021</TD>
    <TD>�濵 �� ���� ���� ������</TD></TR>

	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="022_ȸ��, ���� �� ������ ���� ������"/></td>
		<td class="alignC">022</td>
		<td>ȸ��, ���� �� ������ ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="023_����, ȫ��, ����, ����ȹ ���� ������"/></td>
		<td class="alignC">023</td>
		<td>����, ȫ��, ����, ����ȹ ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="024_�濵���� �� ���� ���� �繫��"/></td>
		<td class="alignC">024</td>
		<td>�濵���� �� ���� ���� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="025_���� ���� �繫��"/></td>
		<td class="alignC">025</td>
		<td>���� ���� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="026_���� �� ��� ���� �繫��"/></td>
		<td class="alignC">026</td>
		<td>���� �� ��� ���� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="027_ȸ�� �� �渮 ���� �繫��"/></td>
		<td class="alignC">027</td>
		<td>ȸ�� �� �渮 ���� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="028_�ȳ�,����, ������, ������� ���� �繫��"/></td>
		<td class="alignC">028</td>
		<td>�ȳ�,����, ������, ������� ���� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="029_�� �� �繫������"/></td>
		<td class="alignC">029</td>
		<td>�� �� �繫������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="031_����, ���� ���� ������"/></td>
		<td class="alignC">031</td>
		<td>����, ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="032_���� �� ���� ���� �繫��"/></td>
		<td class="alignC">032</td>
		<td>���� �� ���� ���� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="033_���� ���� ������"/></td>
		<td class="alignC">033</td>
		<td>���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="041_���б���(�ð����� ����)"/></td>
		<td class="alignC">041</td>
		<td>���б���(�ð����� ����)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="042_���а� �� ���� ���� ������"/></td>
		<td class="alignC">042</td>
		<td>���а� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="043_�ڿ�����, ������� ���� ������"/></td>
		<td class="alignC">043</td>
		<td>�ڿ�����, ������� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="044_�ι���ȸ���� ���� ������"/></td>
		<td class="alignC">044</td>
		<td>�ι���ȸ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="045_�ڿ�����, ������� ���� �����"/></td>
		<td class="alignC">045</td>
		<td>�ڿ�����, ������� ���� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="046_�б�����"/></td>
		<td class="alignC">046</td>
		<td>�б�����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="047_��ġ������"/></td>
		<td class="alignC">047</td>
		<td>��ġ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="048_�п����� �� �н��� ����"/></td>
		<td class="alignC">048</td>
		<td>�п����� �� �н��� ����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="051_����������"/></td>
		<td class="alignC">051</td>
		<td>����������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="052_�������� �繫��"/></td>
		<td class="alignC">052</td>
		<td>�������� �繫��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="053_����, �ҹ�, ���� ���� ������"/></td>
		<td class="alignC">053</td>
		<td>����, �ҹ�, ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="061_�ǻ�"/></td>
		<td class="alignC">061</td>
		<td>�ǻ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="062_���ǻ�"/></td>
		<td class="alignC">062</td>
		<td>���ǻ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="063_���"/></td>
		<td class="alignC">063</td>
		<td>���</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="064_��ȣ�� �� ġ��������"/></td>
		<td class="alignC">064</td>
		<td>��ȣ�� �� ġ��������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="065_ġ���"/></td>
		<td class="alignC">065</td>
		<td>ġ���</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="066_�Ƿ���� �� ġ�� ���� ��� ������"/></td>
		<td class="alignC">066</td>
		<td>�Ƿ���� �� ġ�� ���� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="067_�Ƿ� �� ���� ���� ���� ������"/></td>
		<td class="alignC">067</td>
		<td>�Ƿ� �� ���� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="068_�Ƿẹ�� ���� �ܼ� ������"/></td>
		<td class="alignC">068</td>
		<td>�Ƿẹ�� ���� �ܼ� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="071_��ȸ���� �� ��� ������"/></td>
		<td class="alignC">071</td>
		<td>��ȸ���� �� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="072_��������, ���Ƶ���� �� ��Ȱ������"/></td>
		<td class="alignC">072</td>
		<td>��������, ���Ƶ���� �� ��Ȱ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="073_������ �� ���� ���� ������"/></td>
		<td class="alignC">073</td>
		<td>������ �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="081_�۰� �� ���� ������"/></td>
		<td class="alignC">081</td>
		<td>�۰� �� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="082_�п���, �缭 �� ��Ϲ�������"/></td>
		<td class="alignC">082</td>
		<td>�п���, �缭 �� ��Ϲ�������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="083_����"/></td>
		<td class="alignC">083</td>
		<td>����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="084_â�� �� ���� ���� ������"/></td>
		<td class="alignC">084</td>
		<td>â�� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="085_�����̳�"/></td>
		<td class="alignC">085</td>
		<td>�����̳�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="086_��ȭ, ���� �� ��� ���� ������"/></td>
		<td class="alignC">086</td>
		<td>��ȭ, ���� �� ��� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="087_��ȭ, ���� �� ��� ���� ��� ������"/></td>
		<td class="alignC">087</td>
		<td>��ȭ, ���� �� ��� ���� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="088_������ �Ŵ��� �� ��Ÿ ��ȭ/���� ���� ������"/></td>
		<td class="alignC">088</td>
		<td>������ �Ŵ��� �� ��Ÿ ��ȭ/���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="091_����, �װ��� ���� �� ���� ���� ������"/></td>
		<td class="alignC">091</td>
		<td>����, �װ��� ���� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="092_ö��, ����ö ����� �� ���� ������"/></td>
		<td class="alignC">092</td>
		<td>ö��, ����ö ����� �� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="093_�ڵ��� ������"/></td>
		<td class="alignC">093</td>
		<td>�ڵ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="094_��ǰ�̵���� ���ۿ�"/></td>
		<td class="alignC">094</td>
		<td>��ǰ�̵���� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="095_��޿� �� ��� ���� �ܼ� ������"/></td>
		<td class="alignC">095</td>
		<td>��޿� �� ��� ���� �ܼ� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="101_������ �� ��ǰ�߰���"/></td>
		<td class="alignC">101</td>
		<td>������ �� ��ǰ�߰���</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="102_�ε��� �߰���"/></td>
		<td class="alignC">102</td>
		<td>�ε��� �߰���</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="103_�Ǹſ� �� ��ǰ�뿩��"/></td>
		<td class="alignC">103</td>
		<td>�Ǹſ� �� ��ǰ�뿩��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="104_���� �� ��ǥ��"/></td>
		<td class="alignC">104</td>
		<td>���� �� ��ǥ��</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="105_����,�̵�,�湮 �Ǹſ� �� �ǸŰ��� �� �ܼ� �����"/></td>
		<td class="alignC">105</td>
		<td>����,�̵�,�湮 �Ǹſ� �� �ǸŰ��� �� �ܼ� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="111_��ȣ��, û������, ���� ���� ������"/></td>
		<td class="alignC">111</td>
		<td>��ȣ��, û������, ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="112_����"/></td>
		<td class="alignC">112</td>
		<td>����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="113_û�ҿ�, ���絵���, �� �� û�Ұ��� �ܼ� ������"/></td>
		<td class="alignC">113</td>
		<td>û�ҿ�, ���絵���, �� �� û�Ұ��� �ܼ� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="114_��Ź�� �� �ٸ�����"/></td>
		<td class="alignC">114</td>
		<td>��Ź�� �� �ٸ�����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="115_����ħ, ���� �� �������� ���� �ܼ� ������"/></td>
		<td class="alignC">115</td>
		<td>����ħ, ���� �� �������� ���� �ܼ� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="121_��, �̿� �� ���� ���� ������"/></td>
		<td class="alignC">121</td>
		<td>��, �̿� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="122_��ȥ �� ��� ���� ���� ������"/></td>
		<td class="alignC">122</td>
		<td>��ȥ �� ��� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="123_���� ���� ���� ������"/></td>
		<td class="alignC">123</td>
		<td>���� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="124_�¹���"/></td>
		<td class="alignC">124</td>
		<td>�¹���</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="125_���ڽü� ���� ���� ������"/></td>
		<td class="alignC">125</td>
		<td>���ڽü� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="126_�����ü� ���� ���� ������"/></td>
		<td class="alignC">126</td>
		<td>�����ü� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="127_������ �� ��ũ���̼� ���� ������"/></td>
		<td class="alignC">127</td>
		<td>������ �� ��ũ���̼� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="131_�ֹ��� �� ������"/></td>
		<td class="alignC">131</td>
		<td>�ֹ��� �� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="132_�Ĵ� ���� ���� ������"/></td>
		<td class="alignC">132</td>
		<td>�Ĵ� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="141_���� �� ��� ���� ����� �� �����"/></td>
		<td class="alignC">141</td>
		<td>���� �� ��� ���� ����� �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="142_�Ǽ��������� ��� ������"/></td>
		<td class="alignC">142</td>
		<td>�Ǽ��������� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="143_�Ǽ����� ���� ��� ������"/></td>
		<td class="alignC">143</td>
		<td>�Ǽ����� ���� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="144_�����"/></td>
		<td class="alignC">144</td>
		<td>�����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="145_�Ǽ� �� ä����� ������"/></td>
		<td class="alignC">145</td>
		<td>�Ǽ� �� ä����� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="146_��� �� ä�� ���� ������"/></td>
		<td class="alignC">146</td>
		<td>��� �� ä�� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="147_�Ǽ� �� ���� ���� �ܼ� ������"/></td>
		<td class="alignC">147</td>
		<td>�Ǽ� �� ���� ���� �ܼ� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="151_������ �����,������ �� �����"/></td>
		<td class="alignC">151</td>
		<td>������ �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="152_������ ��ġ �� �����"/></td>
		<td class="alignC">152</td>
		<td>������ ��ġ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="153_������ �����(�ڵ��� ����)"/></td>
		<td class="alignC">153</td>
		<td>������ �����(�ڵ��� ����)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="154_�ڵ��������"/></td>
		<td class="alignC">154</td>
		<td>�ڵ��������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="155_���� �� ���۱�� ���ۿ�"/></td>
		<td class="alignC">155</td>
		<td>���� �� ���۱�� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="156_�ó��� ���� ���� ���ۿ�"/></td>
		<td class="alignC">156</td>
		<td>�ó��� ���� ���� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="157_�ڵ��������� �� ����� �κ� ���ۿ�"/></td>
		<td class="alignC">157</td>
		<td>�ڵ��������� �� ����� �κ� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="158_�ڵ��� �� �ڵ��� �κ�ǰ ������"/></td>
		<td class="alignC">158</td>
		<td>�ڵ��� �� �ڵ��� �κ�ǰ ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="159_������� �� ��� ���� ������"/></td>
		<td class="alignC">159</td>
		<td>������� �� ��� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="161_�ݼ� �� ������ �����,������ �� �����"/></td>
		<td class="alignC">161</td>
		<td>�ݼ� �� ������ �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="162_�Ǳ�, ���� �� ���� ���� ������"/></td>
		<td class="alignC">162</td>
		<td>�Ǳ�, ���� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="163_������ �� ������"/></td>
		<td class="alignC">163</td>
		<td>������ �� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="164_������"/></td>
		<td class="alignC">164</td>
		<td>������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="165_����� �� ���ݱ� ���ۿ�"/></td>
		<td class="alignC">165</td>
		<td>����� �� ���ݱ� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="166_�ݼӰ��� ���� ��ġ �� ��� ���ۿ�"/></td>
		<td class="alignC">166</td>
		<td>�ݼӰ��� ���� ��ġ �� ��� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="167_��ݼ����� ���� ��ġ �� ��� ���ۿ�(����/����/�ø�Ʈ/����ǰ)"/></td>
		<td class="alignC">167</td>
		<td>��ݼ����� ���� ��ġ �� ��� ���ۿ�(����/����/�ø�Ʈ/����ǰ)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="171_ȭ�а��� �����,������ �� �����"/></td>
		<td class="alignC">171</td>
		<td>ȭ�а��� �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="172_���� �� ȭ�й� ������ġ ���ۿ�"/></td>
		<td class="alignC">172</td>
		<td>���� �� ȭ�й� ������ġ ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="173_ȭ��,�� �� �ö�ƽ ��ǰ ����� ���ۿ�"/></td>
		<td class="alignC">173</td>
		<td>ȭ��,�� �� �ö�ƽ ��ǰ ����� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="181_�������� �����,������ �� �����"/></td>
		<td class="alignC">181</td>
		<td>�������� �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="182_����������� ���ۿ�"/></td>
		<td class="alignC">182</td>
		<td>����������� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="183_�������� ���� ���ۿ�"/></td>
		<td class="alignC">183</td>
		<td>�������� ���� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="184_�Ǻ� ������ �� ������"/></td>
		<td class="alignC">184</td>
		<td>�Ǻ� ������ �� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="185_���, ��� �� ���� ��� ������"/></td>
		<td class="alignC">185</td>
		<td>���, ��� �� ���� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="186_��ȭ �� ��Ÿ ���� ���� ������ۿ� �� ������"/></td>
		<td class="alignC">186</td>
		<td>��ȭ �� ��Ÿ ���� ���� ������ۿ� �� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="191_���� �� ���ڰ��� �����,������ �� �����"/></td>
		<td class="alignC">191</td>
		<td>���� �� ���ڰ��� �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="192_����"/></td>
		<td class="alignC">192</td>
		<td>����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="193_����, ���ڱ�� ��ġ �� ������"/></td>
		<td class="alignC">193</td>
		<td>����, ���ڱ�� ��ġ �� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="194_���� �� ������ġ ���ۿ�"/></td>
		<td class="alignC">194</td>
		<td>���� �� ������ġ ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="195_���� �� ���ڼ��� ���ۿ�"/></td>
		<td class="alignC">195</td>
		<td>���� �� ���ڼ��� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="196_��������� ��ǰ �� ��ǰ ���� ��� ���ۿ�"/></td>
		<td class="alignC">196</td>
		<td>��������� ��ǰ �� ��ǰ ���� ��� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="197_��������� ��ǰ �� ��ǰ ������"/></td>
		<td class="alignC">197</td>
		<td>��������� ��ǰ �� ��ǰ ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="201_��ǻ�� �ϵ���� �� ��Ű��� �����,������"/></td>
		<td class="alignC">201</td>
		<td>��ǻ�� �ϵ���� �� ��Ű��� �����,������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="202_��ǻ�� �ý��� ���� ������"/></td>
		<td class="alignC">202</td>
		<td>��ǻ�� �ý��� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="203_����Ʈ���� ���� ������"/></td>
		<td class="alignC">203</td>
		<td>����Ʈ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="204_�� ������"/></td>
		<td class="alignC">204</td>
		<td>�� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="205_�����ͺ��̽� �� �����ý��� � ������"/></td>
		<td class="alignC">205</td>
		<td>�����ͺ��̽� �� �����ý��� � ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="206_���,��� �����,��ġ �� ������"/></td>
		<td class="alignC">206</td>
		<td>���,��� �����,��ġ �� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="211_��ǰ���� �����,������ �� �����"/></td>
		<td class="alignC">211</td>
		<td>��ǰ���� �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="212_����,������ �� ��������"/></td>
		<td class="alignC">212</td>
		<td>����,������ �� ��������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="213_��ǰ���� ���� ��� ������"/></td>
		<td class="alignC">213</td>
		<td>��ǰ���� ���� ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="214_��ǰ���� ��� ���ۿ�"/></td>
		<td class="alignC">214</td>
		<td>��ǰ���� ��� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="221_ȯ����� �����,������ �� ���� �����"/></td>
		<td class="alignC">221</td>
		<td>ȯ����� �����,������ �� ���� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="222_������� �� ������, ��Ÿ ���� �����,������ �� �����"/></td>
		<td class="alignC">222</td>
		<td>������� �� ������, ��Ÿ ���� �����,������ �� �����</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="223_ȯ����� ��ġ ���ۿ�(���ϼ�, �Ұ�)"/></td>
		<td class="alignC">223</td>
		<td>ȯ����� ��ġ ���ۿ�(���ϼ�, �Ұ�)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="224_�μ� �� �������� ���� ���ۿ�"/></td>
		<td class="alignC">224</td>
		<td>�μ� �� �������� ���� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="225_����, ����, ���̰��� �� ���� ���� ���ۿ�"/></td>
		<td class="alignC">225</td>
		<td>����, ����, ���̰��� �� ���� ���� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="226_����, ����ǰ ���� �� ���� ���� ������"/></td>
		<td class="alignC">226</td>
		<td>����, ����ǰ ���� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="227_������, ������ �� �Ǳ�������, ��Ÿ ��� ������"/></td>
		<td class="alignC">227</td>
		<td>������, ������ �� �Ǳ�������, ��Ÿ ��� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="228_���� ����,��ġ �� ��Ÿ ���� ���� ��� ���ۿ�"/></td>
		<td class="alignC">228</td>
		<td>���� ����,��ġ �� ��Ÿ ���� ���� ��� ���ۿ�</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="229_�������� �ܼ� ������"/></td>
		<td class="alignC">229</td>
		<td>�������� �ܼ� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="231_�۹���� ������"/></td>
		<td class="alignC">231</td>
		<td>�۹���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="232_���� �� ���� ���� ������"/></td>
		<td class="alignC">232</td>
		<td>���� �� ���� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="233_�Ӿ� ���� ������"/></td>
		<td class="alignC">233</td>
		<td>�Ӿ� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="234_��� ���� ������"/></td>
		<td class="alignC">234</td>
		<td>��� ���� ������</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="�ڵ弱��" value="235_�󸲾�� ���� �ܼ� ������"/></td>
		<td class="alignC">235</td>
		<td>�󸲾�� ���� �ܼ� ������</td>
	</tr>
	</TBODY>
</TABLE>
</div>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=�ݱ� src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
