<?
include_once("./_common.php");

$sql_common = " from a4_upjong ";

$sql_search = " where 1=1";
$sfl = "upjong";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}
if ($stx_code) {
	$sql_search .= " and ( ";
	$sql_search .= " (code like '%$stx_code%') ";
	$sql_search .= " ) ";
}
if (!$sst) {
    $sst = "code";
    $sod = "asc";
}

//$sql_order = " order by $sst $sod ";

$sub_title = "�����ڵ�";
$g4[title] = $sub_title." : �˾� : ".$easynomu_name;

$search_text = "�ش��ϴ� ������ �����ϴ�.";

if($stx_code || $stx) {
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
} else {
	$total_count = 0;
	$search_text = "�����ڵ� �Ǵ� ���������� �˻��Ͻʽÿ�.";
}
$colspan = 3;
//4���ȸ���� �������輾�� - �����ڵ�(���� 1936��) �˻�
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
<SCRIPT type=text/javascript>
$(function(){
			var nhicRowNum = "null";
			var rowNum     = "null";
	$("input[name='select01']").click(function() { 
			var i = $("input[name='select01']").index(this); 
			var value = $("input[name='select01']").eq(i).val();
			
			if( rowNum != "null" && nhicRowNum != "null" ){
				parent.value_set('join_note<?=$n?>',value.split("_")[0],'upjong<?=$n?>',value.split("_")[1])
				//parent.ifr_close('join_note','upjong');
			}else{
							//$('#upjong',opener.document).focus();
							$('#upjong_code<?=$n?>',opener.document).val(value.split("_")[0]);
							$('#upjong<?=$n?>',opener.document).val(value.split("_")[1]);
							//alert(value.split("_")[0]);
							self.close();
			}
	}); 
	$("#searchKeyword").focus();
});
function win_close() {
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="�����ڵ�3(139�� �� KECO �ڵ�, ���,����)(���� 138��) �˻�" src="images/D107.gif"></H1>
<P class=logoBg><IMG alt="4���ȸ���� �������輾��" src="images/logoBg.gif"></P>
<form name="searchForm" method="post" style="margin:0" action="<?=$_PHP_SELF?>">
<p>�����ڵ� <input type="text" name="stx_code" value="<?=$stx_code?>" style="width:80px;ime-mode:active"> ������ <input type="text" name="stx" value="<?=$stx?>" style="width:180px;ime-mode:active"> <input type="image" src="images/btn_search.gif" onclick="this.form.submit()"></p>
</form>
<P class=full>��ü <SPAN><?=$total_count?></SPAN>��</P>
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
<div style="overflow:auto;overflow-x:hidden;height:454px">
<TABLE class=skyTable2 width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <TBODY>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio 
      value="<?=$row[code]?>_<?=$row[upjong]?>" name=select01></TD>
    <TD class=alignC><?=$row[code]?></TD>
    <TD><?=$row[upjong]?></TD>
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

<P class="close"><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt="�ݱ�" src="images/btn_close.gif"></A></P>
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
addLoadEvent(stx_focus);
</script>
</BODY></HTML>
