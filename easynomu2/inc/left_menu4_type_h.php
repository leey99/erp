							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname04.gif" /></td>
								</tr>
								<tr>
									<td><a href="pay_month_list.php" onmouseover="limg1.src='images/menu04_sub01_on.gif'" onmouseout="limg1.src='images/menu04_sub01_off.gif'"><img src="images/menu04_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_month_list.php" onmouseover="limg1_1.src='images/menu04_sub01_sub01_h_on.gif'" onmouseout="limg1_1.src='images/menu04_sub01_sub01_h_off.gif'"><img src="images/menu04_sub01_sub01_h_off.gif" name="limg1_1" id="limg1_1" /></a></td>
								</tr>
<?
//화성서남부 160405
if($com_code == 20627) {
	$pay_time_list = "pay_excel_beistand_west.php";
} else {
	$pay_time_list = "pay_time_list.php";
}
?>
								<tr>
									<td><a href="<?=$pay_time_list?>"   onmouseover="limg1_2.src='images/menu04_sub01_sub02_h_on.gif'" onmouseout="limg1_2.src='images/menu04_sub01_sub02_h_off.gif'"><img src="images/menu04_sub01_sub02_h_off.gif" name="limg1_2" id="limg1_2" /></a></td>
								</tr>
								<tr>
									<td style="border-bottom:1px #8e7a5e solid"><a href="pay_excel_helper.php"   onmouseover="limg1_3.src='images/menu04_sub01_sub03_h_on.gif'" onmouseout="limg1_3.src='images/menu04_sub01_sub03_h_off.gif'"><img src="images/menu04_sub01_sub03_h_off.gif" name="limg1_3" id="limg1_3" /></a></td>
								</tr>
<?
//화성시장애인 160405
if($com_code == 20399) {
?>
								<tr>
									<td><a href="pay_excel_beistand.php" onmouseover="limg5.src='images/menu04_sub05_on.gif'" onmouseout="limg5.src='images/menu04_sub05_off.gif'"><img src="images/menu04_sub05_off.gif" name="limg5" id="limg5" /></a></td>
								</tr>
<?
}
?>
								<tr>
									<td style="border-top:0 #8e7a5e solid"><a href="pay_ledger_list_beistand.php" onmouseover="limg2.src='images/menu04_sub02_on.gif'" onmouseout="limg2.src='images/menu04_sub02_off.gif'"><img src="images/menu04_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_ledger_list_beistand.php"   onmouseover="limg2_2.src='images/menu04_sub01_sub02_h_on.gif'" onmouseout="limg2_2.src='images/menu04_sub01_sub02_h_off.gif'"><img src="images/menu04_sub01_sub02_h_off.gif" name="limg2_2" id="limg2_2" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_ledger_list.php" onmouseover="limg2_1.src='images/menu04_sub01_sub01_h_on.gif'" onmouseout="limg2_1.src='images/menu04_sub01_sub01_h_off.gif'"><img src="images/menu04_sub01_sub01_h_off.gif" name="limg2_1" id="limg2_1" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_ledger_list_helper.php"   onmouseover="limg2_3.src='images/menu04_sub01_sub03_h_on.gif'" onmouseout="limg2_3.src='images/menu04_sub01_sub03_h_off.gif'"><img src="images/menu04_sub01_sub03_h_off.gif" name="limg2_3" id="limg2_3" /></a></td>
								</tr>
								<tr>
									<td style="border-top:1px #8e7a5e solid"><a href="pay_stubs_time_beistand.php" onmouseover="limg4.src='images/menu04_sub04_on.gif'" onmouseout="limg4.src='images/menu04_sub04_off.gif'"><img src="images/menu04_sub04_off.gif" name="limg4" id="limg4" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_stubs_time_beistand.php"   onmouseover="limg4_2.src='images/menu04_sub01_sub02_h_on.gif'" onmouseout="limg4_2.src='images/menu04_sub01_sub02_h_off.gif'"><img src="images/menu04_sub01_sub02_h_off.gif" name="limg4_2" id="limg4_2" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_stubs_month_list.php" onmouseover="limg4_1.src='images/menu04_sub01_sub01_h_on.gif'" onmouseout="limg4_1.src='images/menu04_sub01_sub01_h_off.gif'"><img src="images/menu04_sub01_sub01_h_off.gif" name="limg4_1" id="limg4_1" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_stubs_time_helper.php"   onmouseover="limg4_3.src='images/menu04_sub01_sub03_h_on.gif'" onmouseout="limg4_3.src='images/menu04_sub01_sub03_h_off.gif'"><img src="images/menu04_sub01_sub03_h_off.gif" name="limg4_3" id="limg4_3" /></a></td>
								</tr>
								<tr>
									<td style="border-top:1px #8e7a5e solid"><a href="pay_statistics.php" onmouseover="limg3.src='images/menu04_sub03_on.gif'" onmouseout="limg3.src='images/menu04_sub03_off.gif'"><img src="images/menu04_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_statistics.php" onmouseover="limg3_1.src='images/menu04_sub05_sub01_on.gif'" onmouseout="limg3_1.src='images/menu04_sub05_sub01_off.gif'"><img src="images/menu04_sub05_sub01_off.gif" name="limg3_1" id="limg3_1" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_statistics_year.php"   onmouseover="limg3_2.src='images/menu04_sub05_sub02_on.gif'" onmouseout="limg3_2.src='images/menu04_sub05_sub02_off.gif'"><img src="images/menu04_sub05_sub02_off.gif" name="limg3_2" id="limg3_2" /></a></td>
								</tr>
							</table>