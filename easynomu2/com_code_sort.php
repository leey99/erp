<?
$sub_title = "�����ڵ�";
$sub_menu = "100204";

include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

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

$sql_common = " from com_code_sort ";

$sql_search = " where com_code = '$row_com[com_code]' ";

$sql1 = " select *
					$sql_common
					$sql_search  and code = '1' ";

//echo $sql1;
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//���� 2����
$sql2 = " select * $sql_common $sql_search  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//���� 3����
$sql3 = " select * $sql_common $sql_search  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//���� 4����
$sql4 = " select * $sql_common $sql_search  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

$g4[title] = $sub_title." : �ڵ���� : �������� : ".$easynomu_name;
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
function checkData() {
	var frm = document.dataForm;
	var rv = 0;

	if (frm.sort1.value == "")
	{
		alert("���� 1������ �����ϼ���.");
		frm.sort1.focus();
		return;
	}
	frm.action = "com_code_sort_update.php";
	frm.submit();
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
							<!-- �Է��� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� 1����<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="80%">
										<select name="sort1" class="selectfm" onChange="">
											<option value="" <? if($sort1 == "") echo "selected"; ?> >����</option>
											<option value="position" <? if($sort1 == "position") echo "selected"; ?> >����</option>
											<option value="in_day" <? if($sort1 == "in_day") echo "selected"; ?> >�Ի���</option>
											<option value="dept" <? if($sort1 == "dept") echo "selected"; ?> >�μ�</option>
											<option value="name" <? if($sort1 == "name") echo "selected"; ?> >����</option>
											<option value="pay_gbn" <? if($sort1 == "pay_gbn") echo "selected"; ?> >�޿�����</option>
											<option value="work_form" <? if($sort1 == "work_form") echo "selected"; ?> >ä������</option>
										</select> 
										<select name="sod1" class="selectfm" onChange="">
											<option value="asc" <? if($sod1 == "asc") echo "selected"; ?> >��������</option>
											<option value="desc" <? if($sod1 == "desc") echo "selected"; ?> >��������</option>
										</select> 
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� 2����<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<select name="sort2" class="selectfm" onChange="">
											<option value="" <? if($sort2 == "") echo "selected"; ?> >����</option>
											<option value="position" <? if($sort2 == "position") echo "selected"; ?> >����</option>
											<option value="in_day" <? if($sort2 == "in_day") echo "selected"; ?> >�Ի���</option>
											<option value="dept" <? if($sort2 == "dept") echo "selected"; ?> >�μ�</option>
											<option value="name" <? if($sort2 == "name") echo "selected"; ?> >����</option>
											<option value="pay_gbn" <? if($sort2 == "pay_gbn") echo "selected"; ?> >�޿�����</option>
											<option value="work_form" <? if($sort2 == "work_form") echo "selected"; ?> >ä������</option>
										</select> 
										<select name="sod2" class="selectfm" onChange="">
											<option value="asc" <? if($sod2 == "asc") echo "selected"; ?> >��������</option>
											<option value="desc" <? if($sod2 == "desc") echo "selected"; ?> >��������</option>
										</select> 
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� 3����<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<select name="sort3" class="selectfm" onChange="">
											<option value="" <? if($sort3 == "") echo "selected"; ?> >����</option>
											<option value="position" <? if($sort3 == "position") echo "selected"; ?> >����</option>
											<option value="in_day" <? if($sort3 == "in_day") echo "selected"; ?> >�Ի���</option>
											<option value="dept" <? if($sort3 == "dept") echo "selected"; ?> >�μ�</option>
											<option value="name" <? if($sort3 == "name") echo "selected"; ?> >����</option>
											<option value="pay_gbn" <? if($sort3 == "pay_gbn") echo "selected"; ?> >�޿�����</option>
											<option value="work_form" <? if($sort3 == "work_form") echo "selected"; ?> >ä������</option>
										</select> 
										<select name="sod3" class="selectfm" onChange="">
											<option value="asc" <? if($sod3 == "asc") echo "selected"; ?> >��������</option>
											<option value="desc" <? if($sod3 == "desc") echo "selected"; ?> >��������</option>
										</select> 
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� 4����<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<select name="sort4" class="selectfm" onChange="">
											<option value="" <? if($sort4 == "") echo "selected"; ?> >����</option>
											<option value="position" <? if($sort4 == "position") echo "selected"; ?> >����</option>
											<option value="in_day" <? if($sort4 == "in_day") echo "selected"; ?> >�Ի���</option>
											<option value="dept" <? if($sort4 == "dept") echo "selected"; ?> >�μ�</option>
											<option value="name" <? if($sort4 == "name") echo "selected"; ?> >����</option>
											<option value="pay_gbn" <? if($sort4 == "pay_gbn") echo "selected"; ?> >�޿�����</option>
											<option value="work_form" <? if($sort4 == "work_form") echo "selected"; ?> >ä������</option>
										</select> 
										<select name="sod4" class="selectfm" onChange="">
											<option value="asc" <? if($sod4 == "asc") echo "selected"; ?> >��������</option>
											<option value="desc" <? if($sod4 == "desc") echo "selected"; ?> >��������</option>
										</select> 
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
<?
//���Ѻ� ��ũ��
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
}
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="left">�� �޿����� (������, �ñ���, ������) ���� ���</td>
								</tr>
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
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
