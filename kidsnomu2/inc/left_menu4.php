							<!--�ѿ��� �̹��� ������Ʈ-->
							<img src="images/menu04_sub02_on.gif" style="display:none;" />
							<img src="images/menu04_sub03_on.gif" style="display:none;" />
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname04.gif" /></td>
								</tr>
								<tr>
									<td><a href="pay_list.php" onmouseover="limg1.src='images/menu04_sub01_on.gif'" onmouseout="limg1.src='images/menu04_sub01_off.gif'"><img src="images/menu04_sub01_off.gif" name="limg1" id="limg1" alt="�޿��ݿ�" /></a></td>
								</tr>
<?
//�������ε� �ݱ� �Ű� ��ü ���� 160629
if($excel_upload_com == "ok") {
?>
								<tr>
									<td><a href="pay_excel.php" onmouseover="limg5.src='images/menu04_sub05_on.gif'" onmouseout="limg5.src='images/menu04_sub05_off.gif'"><img src="images/menu04_sub05_off.gif" name="limg5" id="limg5" alt="�޿��ݿ�" /></a></td>
								</tr>
<?
}
?>
								<tr>
									<td><a href="pay_ledger_list.php" onmouseover="limg2.src='images/menu04_sub02_on.gif'" onmouseout="limg2.src='images/menu04_sub02_off.gif'"><img src="images/menu04_sub02_off.gif" name="limg2" id="limg2" alt="�޿�����" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_statistics.php" onmouseover="limg3.src='images/menu04_sub03_on.gif'" onmouseout="limg3.src='images/menu04_sub03_off.gif'"><img src="images/menu04_sub03_off.gif" name="limg3" id="limg3" alt="���,��ȸ" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_account.php" onmouseover="limg4.src='images/menu04_sub04_on.png'" onmouseout="limg4.src='images/menu04_sub04_off.png'"><img src="images/menu04_sub04_off.png" name="limg4" id="limg4" alt="��������" /></a></td>
								</tr>
							</table>