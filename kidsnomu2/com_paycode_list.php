<?
$sub_menu = "100301";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
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
$code = $row_com[com_code];

//����� �߰� ����
$sql_com_opt = " select * from com_list_gy_opt where com_code='$row_com[com_code]' ";
//echo $sql1;
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);

//�޿� �����ڵ� DB
$sql_common = " from com_paycode_list ";

//echo $is_admin;
if(!$item) $item = "trade";
if($is_admin == "super") {
	$sql_search = " where item='$item' ";
} else {
	$sql_search = " where item='$item' and com_code='$code' ";
}
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
    $sst = "code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

if($item == "company") {
	$sub_title = "�ְ��ٹ��ð�";
} else if($item == "trade") {
	$sub_title = "����ӱݼ����׸�";
} else if($item == "court") {
	$sub_title = "���������׸�";
} else {
	$sub_title = "��Ÿ�����׸�";
}
$g4[title] = $sub_title." : �ڵ���� : �������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 10;

//����ӱݼ���, ��Ÿ���� �� ���� ����
if($item == "court") {
	//�ݾ� �׸� �߰��� colspan ���� 150416
	//$colspan -= 1;
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
function com_paycode_reset(item) {
	if(item == "trade") text = "����ӱݼ��� ";
	else if(item == "court") text = "�������� ";
	else if(item == "privilege") text = "��Ÿ���� ";
	else text = "�߰� ";
	if(confirm(text+"�ڵ带 �ʱ�ȭ �Ͻðڽ��ϱ�?\n���� �ڵ带 ������ �˴ϴ�.")) {
		location.href = "com_paycode_reset.php?item="+item;
	}
	//return false;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="com_paycode_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
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
<?
if($item == "company") {
?>

<?
include "com_paycode_select_work_time.php";
?>
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
<?
	exit;
}
?>
							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												����Ʈ
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

							<!--����Ʈ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<input type="hidden" name="item" value="<?=$item?>">
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td class="tdhead_center" width="3%" style="height:34px"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td class="tdhead_center" width="40">�ڵ�</td>
									<td class="tdhead_center" width="150"><?=$pay_name?></td>
									<td class="tdhead_center">����</td>
<?
if($item != "court") {
?>
									<td class="tdhead_center" width="100"><?=$pay_type?></td>
<?
}
?>

<?
//���� 131111
if($item != "_privilege") {
?>
<?
//����ӱݼ���, ��Ÿ���� �� ���� ����
if($item == "court") {
?>
									<td class="tdhead_center" width="60">����</td>
<? } ?>
									<td class="tdhead_center" width="60">�ڵ��ݿ�</td>
									<td class="tdhead_center" width="60">�ӱ�����<br>����</td>
									<td class="tdhead_center" width="60">������<br>�����</td>
									<td class="tdhead_center" width="60">��������<br>����</td>
<? } ?>
									<td class="tdhead_center" width="5%">����</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;

	$code = $row[com_code];
	$id = $row[code];
	$code_id = $code."_".$id;
	$view_url = "com_paycode_view.php?code=".$code."&id=".$id."&w=u&item=".$item."".$qstr;
	$meno = cut_str($row[memo], 46, "..");
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_center_h22">
										<a href="<?=$view_url?>" style="font-weight:bold" title="<?=$row[memo]?>"><?=$row[name]?></a>
									</td>
									<td nowrap class="ltrow1_h22" style="padding:0 0 0 10px"><?=$meno?></td>
<?
if($item != "court") {
	//��Ÿ���� �ѵ� ����
	if($item == "privilege") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[tax_limit]?></td>
<?
	} else {
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[calculate]?></td>
<?
	}
}
//���� 131111
if($item != "_privilege") {
//����ӱݼ���, ��Ÿ���� �� ���� ����
if($item == "court") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[multiple]?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$row[auto]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[gy_yn]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[retirement]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[income]?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22">
										<div id="btn_bslost_82">
										 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$view_url?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
										</div>
									</td>
								</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
	//echo "<script language='javascript'>com_paycode_reset('$item');</script>";
}
else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
}
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
<?
if($item != "court") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
<?
//���� 131111
if($item != "_privilege") {
?>
<?
//����ӱݼ���, ��Ÿ���� �� ���� ����
if($item == "court") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
<?
//���Ѻ� ��ũ��
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_reset = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "com_paycode_view.php?w=w&item=$item";
	$url_reset = "javascript:com_paycode_reset('$item');";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
<?
if($member['mb_level'] >= 7) {
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">���û���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">�ڵ���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
<?
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_reset?>" target="">�ڵ��ʱ�ȭ</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;padding:0 0 0 4px">
											<tr>
												<td>�� <?=$easynomu_name?>���� ������ �ʱ���ð����� ����</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</form>

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
