<?
$sub_menu = "800100";
include_once("./_common.php");
if($bo_table == "oc_notice")      $title_text = "공지사항";
else if($bo_table == "oc_event")  $title_text = "일정등록";
else if($bo_table == "oc_free")   $title_text = "무료노무상담";
else if($bo_table == "oc_pds")    $title_text = "자료실";
else if($bo_table == "oc_online") $title_text = "온라인문의";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$title_text?> : 커뮤니티 : 이지노무</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">

</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname08.gif" /></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_notice" onmouseover="limg1.src='images/menu08_sub01_on.gif'" onmouseout="limg1.src='images/menu08_sub01_off.gif'"><img src="images/menu08_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_event"  onmouseover="limg2.src='images/menu08_sub02_on.gif'" onmouseout="limg2.src='images/menu08_sub02_off.gif'"><img src="images/menu08_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_free"   onmouseover="limg3.src='images/menu08_sub03_on.gif'" onmouseout="limg3.src='images/menu08_sub03_off.gif'"><img src="images/menu08_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_pds"    onmouseover="limg4.src='images/menu08_sub04_on.gif'" onmouseout="limg4.src='images/menu08_sub04_off.gif'"><img src="images/menu08_sub04_off.gif" name="limg4" id="limg4" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_online" onmouseover="limg5.src='images/menu08_sub05_on.gif'" onmouseout="limg5.src='images/menu08_sub05_off.gif'"><img src="images/menu08_sub05_off.gif" name="limg5" id="limg5" /></a></td>
								</tr>
							</table>
<?
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$title_text?></span>
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
				<iframe src="<?=$url?>" frameborder="0" width="100%" height="400" onload=resizeFrame(this) scrolling="no"></iframe>
			</td>
		</tr>
	</table>
<? include "./inc/bottom.php";?>
</div>
</body>
</html>
