<?
$sub_menu = "900100";
include_once("./_common.php");
if($bo_table == "erp_notice") {
	$title_text = "공지사항";
	$title_main = "커뮤니티";
	$title_main_no = "10";
	$title_no = "01";
} else if($bo_table == "erp_dealer") {
	$title_text = "딜러전용";
	$title_main = "커뮤니티";
	$title_main_no = "10";
	$title_no = "06";
} else if($bo_table == "erp_event") {
	$title_text = "주요일정";
	$title_main = "커뮤니티";
	$title_main_no = "10";
	$title_no = "02";
} else if($bo_table == "erp_online") {
	$title_text = "Q&A";
	$title_main = "커뮤니티";
	$title_main_no = "10";
	$title_no = "03";
} else if($bo_table == "erp_faq") {
	$title_text = "신규등록현황";
	$title_main = "커뮤니티";
	$title_main_no = "10";
	$title_no = "04";
} else if($bo_table == "erp_after") {
	$title_text = "알림";
	$title_main = "커뮤니티";
	$title_main_no = "10";
	$title_no = "05";
} else if($bo_table == "erp_schedule") {
	$title_text = "스케줄관리";
	$title_main = "스케줄";
	$title_main_no = "20";
	$title_no = "00";
} else if($bo_table == "erp_electric_charges") {
	$title_text = "전기요금컨설팅";
	$title_main = "스케줄";
	$title_main_no = "20";
	$title_no = "02";
} else if($bo_table == "erp_job_education") {
	$title_text = "사업주훈련관리";
	$title_main = "스케줄";
	$title_main_no = "20";
	$title_no = "03";
	//if($member['mb_level'] == 6) alert("해당 페이지를 열람할 권한이 없습니다.");
} else if($bo_table == "erp_visit") {
	$title_text = "방문스케줄";
	$title_main = "스케줄";
	$title_main_no = "20";
	$title_no = "00";
} else if($bo_table == "erp_punctuality") {
	$title_text = "근태관리";
	$title_main = "그룹웨어";
	$title_main_no = "07";
	$title_no = "04";
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
include "inc/top.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top<?=$title_main_no?>.gif" border="0"></td>
									<td width=""><img src="images/top<?=$title_main_no?>_<?=$title_no?>.gif" border="0"></td>
									<td>
<?
include "inc/sub_menu.php";
?>
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
										<iframe src="<?=$url?>" frameborder="0" width="100%" height="400" onload="resizeFrame(this);" scrolling="no" style="margin:10px 0 0 0"></iframe>
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
