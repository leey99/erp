<?
$sub_menu = "300200";
include_once("./_common.php");

$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "�ް���û��";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
//echo $sql2;
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);

$sql3 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
//echo $sql3;
$result3 = sql_query($sql3);
$row3=mysql_fetch_array($result3);

//�Ի���
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
//������
if($row1[out_day] == "") {
	$out_day = "��������";
} else {
	$out_day_array = explode(".",$row1[out_day]);
	$out_day = $out_day_array[0]."�� ".$out_day_array[1]."�� ".$out_day_array[2]."��";
}
//ä������
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "������";
else if($row1[work_form] == "2") $work_form = "�����";
else if($row1[work_form] == "3") $work_form = "�Ͽ���";
//����
$sql_position = " select * from com_code_list where code='$row2[position]' ";
$result_position = sql_query($sql_position);
$row_position=mysql_fetch_array($result_position);
//echo $row_position[name];
//����/�ް�/���� DB
$sql_nomu = " select * from pibohum_base_nomu where idx='$idx' ";
$result_nomu = sql_query($sql_nomu);
$row_nomu = mysql_fetch_array($result_nomu);
//�ް�����
$cause_array = array("","�����ް�(����)","�����ް�(����)","�������ް�(����)","�������ް�(����)","����(����)","����(����)");
for($i=1; $i<count($cause_array); $i++) {
	if($i == $row_nomu[vacation_cause]) $cause = $cause_array[$i];
}
//�ް�����
$reason = $row_nomu[vacation_reason];
//�ް��Ⱓ
$vdate = $row_nomu[vacation_sdate]." ~ ".$row_nomu[vacation_edate];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function back_url() {
	//location.href = "vacation.php?idx=<?=$idx?>&page=<?=$page?>";
	location.href = "vacation.php?page=<?=$page?>";
}
function work_contract_ok() {
	document.work_contract_form.submit();
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname06.gif" /></td>
								</tr>
								<tr>
									<td><a href="form_labor.php"   onmouseover="limg2.src='images/menu06_sub02_on.gif'" onmouseout="limg2.src='images/menu06_sub02_off.gif'"><img src="images/menu06_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="form_inspect.php" onmouseover="limg3.src='images/menu06_sub03_on.gif'" onmouseout="limg3.src='images/menu06_sub03_off.gif'"><img src="images/menu06_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
							</table>
							<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px">
								<tr>
									<td>
										<a href="http://e-consulting.kr" target="_blank"><img src="./images/banner01.gif" border="0"></a>
										<br>
										<a href="http://cafe.naver.com/kcmcceo" target="_blank"><img src="./images/banner02.gif" border="0"></a>
										<br>
										<a href="http://blog.naver.com/kcmc4519" target="_blank"><img src="./images/banner03.gif" border="0"></a>
									</td>
								</tr>
							</table>
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


<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = '<?=$rooturl?>';
var rootssl = '<?=$rootssl?>';
var raccount= 'home';
var moduleid= 'home';
var memberid= 'master';
var is_admin= '0';
var needlog = '�α����Ŀ� �̿��Ͻ� �� �ֽ��ϴ�. ';
var neednum = '���ڸ� �Է��� �ּ���.';
var myagent	= navigator.appName.indexOf('Explorer') != -1 ? 'ie' : 'ns';
//]]>
</script>
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<div id="rcontent" class="center m_side">
	<table border="0">
		<tr>
			<td>
				<div style="padding:2px">
					<form name="vacation_form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
					<input type="button" name="history_back_bt" value="�������" onclick="back_url()" /> 
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="code" value="<?=$code?>" />
					</form>
				</div>
			</td>
			<td>���� : <?=$row1[name]?> / �ֹε�Ϲ�ȣ : <?=$row1[jumin_no]?> / �Ի��� : <?=$in_day?> / ä������ : <?=$work_form?></td>
		</tr>
	</table>

<form name = "HwpControl" id="HwpControl" method="post">
	<input type="hidden" name="labor" value="vacation" />
	<!--�ް���û��(ȸ��)-->
	<input type="hidden" name="dept" value="<?=$row2[dept_1]?> "/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="tel" value="<?=$tel?> " />
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="cause" value="<?=$cause?>" title="�ް�����" />
	<input type="hidden" name="vdate" value="<?=$vdate?>" title="�Ⱓ" />
	<input type="hidden" name="space" value="<?=$space?> " />
	<input type="hidden" name="reason" value="<?=$reason?>" />
	<!--����-->
	<input type="hidden" name="today" value="<?=date("Y�� m�� d��")?>" title="��������"/>
	<input type="hidden" name="mb_name" value="" />
	<!-- �ѱ� ��Ʈ�� �� -->
	<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
		<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
	</p>
	</form>
	<script type="text/javascript">
	document.getElementById('HwpCtrl').style.height = "710px";
	function setAppendRow1(){
	}

	function setAppendRow2(){
	}

	function setAppendRow3(){
	}

	function setAppendRow4(){
	}

	function setAppendRow5(){
	}

	function setAppendRow6(){
	}
	//toggleLayer('employeeList',this.name);
	//addLoadEvent(goSubmit_vacation);
	</script>
	<script src="./js/form_labor.js" type="text/javascript" charset="euc-kr"></script>
</div>



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
