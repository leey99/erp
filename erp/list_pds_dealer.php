<?
$sub_menu = "2100100";
include_once("./_common.php");
if($bo_table == "erp_pds") {
	$title_text = "서식자료실";
	$title_main = "자료실";
	$title_main_no = "21";
	$title_no = "01";
} else if($bo_table == "erp_pds2") {
	$title_text = "영업자료실";
	$title_main = "자료실";
	$title_main_no = "21";
	$title_no = "02";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$title_text?> : <?=$title_main?> : <?=$easynomu_name?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<?
include "inc/top_dealer.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top<?=$title_main_no?>.gif" border="0"></td>
									<td width=""><img src="images/top<?=$title_main_no?>_<?=$title_no?>.gif" border="0"></td>
									<td>
									</td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
							</table>

							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--타이틀 -->	
										<table width="100%" border=0 cellspacing=0 cellpadding=0>
											<tr>     
												<td height="18">
													<table width=100% border=0 cellspacing=0 cellpadding=0>
														<tr>
															<td>
															</td>
															<td align=right class=navi style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align="absmiddle"  style='margin:0 5px 6px 0'><span style='font-size:9pt;color:black;'><?=$title_text?> > <?=$title_main?></span></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr><td height=1 bgcolor=e0e0de></td></tr>
											<tr><td height=2 bgcolor=f5f5f5></td></tr>
											<tr><td height=5></td></tr>
										</table>
<!--리스트 -->
<?
//echo substr($bo_table,0,3);
if($wr_id == "") {
	$url = "/bbs/board.php?bo_table=".$bo_table;
} else {
	$url = "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$wr_id;
}
?>
										<script type="text/javascript">
										function resizeFrame(frm) {
										 frm.style.height = "auto";
										 contentHeight = frm.contentWindow.document.body.scrollHeight;
										 frm.style.height = contentHeight + 4 + "px";
										}
										</script>
										<iframe src="<?=$url?>" frameborder="0" width="100%" height="400" onload=resizeFrame(this) scrolling="no" style="margin:10px 0 0 0"></iframe>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
