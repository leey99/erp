<?
include_once("./_common.php");

$sql_common = " from electric_charges_process_memo ";
$sql_search = "";

if (!$sst) {
    $sst = "idx";
    $sod = "asc";
}

$sql_order = " order by $sst $sod ";

$sub_title = "������������ ó�����";
$g4[title] = $sub_title." : �˾� : ".$easynomu_name;

$sql = " select count(*) as cnt
				 $sql_common
				 $sql_search
				 $sql_order ";

$row = sql_fetch($sql);
$total_count = $row[cnt];

$sql = " select *
					$sql_common
					$sql_search
					$sql_order ";
$result = sql_query($sql);

$colspan = 3;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE><?=$g4[title]?></TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="images/pko.css">
<SCRIPT type=text/javascript src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$n) $n = "";
?>
<SCRIPT type="text/javascript">
/*
$(function(){
	var nhicRowNum = "null";
	var rowNum     = "null";
	$("input[name='select01']").click(function() { 
			var i = $("input[name='select01']").index(this); 
			alert(this.name);
			var value = $("input[name='select01']").eq(i).val();
			//�θ�â ID �˻� �� �迭 2��° ������ ����
			$('#electric_charges_etc',opener.document).val(value);
			self.close();
	}); 
	//$("#searchKeyword").focus();
});
*/
function win_close() {
	window.close();
}
//���� ���� ���, ��ǥ�� ���� 160511
function select_click() {
	var str = "";
	$('input[type="checkbox"]:checked').each(function(){
		str += $(this).val() + "\n";
	});
	if(str == "") {
		alert('���õ� ó������� �����ϴ�.');
		return;
	} else {
		//alert(str);
	}
	//���ڿ� ������ �ٹٲ� ���� \n ���� trim ���
	$('#electric_charges_etc',opener.document).val($.trim(str));
	self.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<P class=full style="margin-top:10px;">��ü <SPAN><?=$total_count?></SPAN>��</P>
<TABLE class=skyTable width="100%">
  <COLGROUP>
  <COL width="50">
  <COL>
  <COL width="20">
	</COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>����</TH>
			<TH scope=col>����</TH>
			<TH scope=col></TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:540px">
<TABLE class=skyTable2 width="100%">
  <COLGROUP>
  <COL width="50">
  <COL>
  <COL width="20">
	</COLGROUP>
  <TBODY>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
  <TR>
    <TD class="alignC"><INPUT title="�ڵ弱��" class="select01" type="checkbox" value="<?=$row['process_memo']?>" name="select<?=$i?>"></TD>
    <TD><?=$row['process_memo']?></TD>
    <TD class="alignC"></TD>
	</TR>
<?
}
if(!$i) {
?>
  <TR>
    <TD colspan="<?=$colspan?>" align="center"><?=$search_text?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>
</div>
<p class="close">
	<a onclick="select_click();" href="#" style="margin-right:10px;"><img alt="����" src="images/btn_select.gif"></a>
	<a onclick="win_close();event.returnvalue = false;" href="#"><img alt="�ݱ�" src="images/btn_close.gif"></a>
</p>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV>
<script language="javascript">
// onload 2�� �̻� ���� ���� �Լ�
function addLoadEvent(func) {
    var oldonload = window.onload;
        if(typeof window.onload != 'function') {
            window.onload = func;
        } else {
            window.onload = function() {
                oldonload();
                func();
        }
    }
}
function stx_focus() {
	var frm = document.searchForm;
	frm.stx.focus();
}
//addLoadEvent(stx_focus);
</script>
</BODY></HTML>
