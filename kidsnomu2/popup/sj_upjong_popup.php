<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");

$sql_common = " from sj_percent ";

$sql_search = " where 1=1";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "category_code";
    $sod = "asc";
}

//$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row[cnt];

$sub_title = "�������";
$g4[title] = $sub_title." : �˾� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
$result = sql_query($sql);

$colspan = 11;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE>4���ȸ���� �������輾�� - �������(����) �˻�</TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="css/sj_upjong.css">
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
			
		$('#sj_upjong_code',opener.document).val(value.split("_")[0]);
		$('#sj_upjong',opener.document).val(value.split("_")[1]);
		$('#sj_percent', opener.document).val(value.split("_")[2]);
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
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 640px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="�������(����) �˻�" 
src="images/sj_upjong_title.gif"></H1>
<P class=logoBg><IMG alt="4���ȸ���� �������輾��" src="images/logoBg.gif"></P>
<p>�� Ctrl + F ����Ű�� ���� �˻��� �����մϴ�.</p>
<P class=full>��ü <SPAN><?=$total_count?></SPAN>��</P>
<TABLE class=skyTable width="100%" summary="�������(����) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="7%">
  <COL width="11%">
  <COL width="40%">
  <COL width="8%">
  <COL>
	</COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>����</TH>
			<TH scope=col>�ڵ�</TH>
			<TH scope=col>��Ī</TH>
			<TH scope=col style="text-align:left">����</TH>
			<TH scope=col style="padding:0 40px 0 0">�з�</TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:470px">
<TABLE class=skyTable2 width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="7%">
  <COL width="11%">
  <COL width="40%">
  <COL width="8%">
  <COL>
	</COLGROUP>
  <TBODY>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
  <TR>
    <TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio value="<?=$row[category_code]?>_<?=$row[category_name]?>_<?=$row[category_rate]?>" name=select01></TD>
    <TD class=alignC><?=$row[category_code]?></TD>
    <TD><?=$row[category_name]?></TD>
    <TD><?=$row[category_rate]?></TD>
    <TD><?=$row[subdiv_name]?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>
</div>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=�ݱ� src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
