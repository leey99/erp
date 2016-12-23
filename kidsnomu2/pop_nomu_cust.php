
<title>노무사선택</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="./css/style_chongmu.css">
<script language="javascript" src="./js/common.js"></script>

<script language="javascript">
	function goSearch()
	{
		var frm = document.searchForm;
		frm.action = "/_admin/pop_nomu_cust.asp";
		frm.submit();
		return;
	}

	function checkData()
	{
		var tempval = "";
		var frm = document.dataForm;
		if (frm.temp_cust_numb == undefined)
		{
			alert("노무사가 없습니다.");
			return;
		}
		
		var bflag = false;
		if (frm.temp_cust_numb.length == undefined)
		{
			if (frm.temp_cust_numb.checked == false)
			{
				bflag = false;
			}
			else
			{
				bflag = true;
				tempval = frm.temp_cust_numb.value;
			}
		}
		else
		{
			for (var i=0;i<frm.temp_cust_numb.length;i++)
			{
				if (frm.temp_cust_numb[i].checked == true)
				{
					tempval = frm.temp_cust_numb[i].value;
					bflag = true;
					break;
				}
			}
		}

		if (bflag == false)
		{
			alert("노무사를 선택하세요.");
			return;
		}

		tempval = tempval.split("#");
		opener.document.dataForm.nomu_cust_numb.value = tempval[0];
		opener.document.dataForm.nomu_cust_name.value = tempval[1];
		window.close();
		return;
	}
</script>

<body topmargin="0" leftmargin="0">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td style="padding:0 20 0 20">
<!--타이틀 -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:8pt;color:#929292;'><img src=/img/ims/title_icon.gif align=absmiddle  style='margin:0 5 2 0'><span style='font-size:8pt;color:black;'>노무사선택</span>
									</td>
									<td align=right class=navi></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height=1 bgcolor=e0e0de></td>
					</tr>
					<tr>
						<td height=2 bgcolor=f5f5f5></td>
					</tr>
					<tr>
						<td height=5></td>
					</tr>
				</table>
<!--타이틀 -->

<!--댑메뉴 -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="/img/ims/sb_tab_on_lt.gif"></td> 
									<td background="/img/ims/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									<a href="#">검색</a> 
									</td> 
									<td><img src="/img/ims/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>

				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
<!--댑메뉴 -->

<!--검색 -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
<form name="searchForm" method="post">
					<tr>
						<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">대표자명</td>
						<td nowrap  class="tdrow">
						<input name="search_cust_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">핸드폰</td>
						<td nowrap  class="tdrow">
						<input name="search_cust_cell" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호</td>
						<td nowrap  class="tdrow">
						<input name="search_cust_tell" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
						</td>
						<td align="center" nowrap class="tdrow_center">
						 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>   <tr>      <td width=2></td>       <td><img src=/img/ims/btn9_lt.gif></td>       <td background=/img/ims/btn9_bg.gif class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td>       <td><img src=/img/ims/btn9_rt.gif></td>      <td width=2></td>     </tr>   </table> 
						</td>
					</tr>
</form>
				</table>
				<div style="height:10px;font-size:0px"></div>
<!--검색 -->

<!--댑메뉴 -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="/img/ims/sb_tab_on_lt.gif"></td> 
									<td background="/img/ims/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									<a href="#">노무사리스트</a>
									</td> 
									<td><img src="/img/ims/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>

				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
<!--댑메뉴 -->

<!--리스트 -->

				<table width="" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center" width="5%">선택</td>
						<td nowrap class="tdhead_center" width="8%">상태</td>
						<td nowrap class="tdhead_center">등록일자</td>
						<td nowrap class="tdhead_center">대표자</td>
						<td nowrap class="tdhead_center">핸드폰</td>
						<td nowrap class="tdhead_center">전화번호</td>
						<td nowrap class="tdhead_center">팩스번호</td>
					</tr>
<form name="dataForm">

					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h22"><input type="radio" name="temp_cust_numb" value="5#조이철"></td>
						<td nowrap class="ltrow1_center_h22">정상</td>
						<td nowrap class="ltrow1_center_h22">2013-04-05</td>
						<td nowrap class="ltrow1_center_h22">조이철</td>
						<td nowrap class="ltrow1_center_h22">010-1111-1111</td>
						<td nowrap class="ltrow1_center_h22">042-222-2222</td>
						<td nowrap class="ltrow1_center_h22"></td>
					</tr>

</form>
					<tr>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
					</tr>
				</table>

				<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td height="40">
							
							<div align="center">
                            <table width="70%" height="15" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="6%">

								<img src="/common/img/gray_list_pre.gif" width="30" height="15" align="absmiddle">

								</td>
                                <td width="88%"><div align="center" class="text07">

								<strong><font color="#000000">1</font></strong>

								</div></td>
                                <td width="6%">

								<img src="/common/img/gray_list_next.gif" width="30" height="15" align="absmiddle">

								</td>
                              </tr>
                            </table>
							</div>
<form name="pageForm" method="post">
	<input type="hidden" name="page" value="1">
	<input type="hidden" name="pageurl" value="/_admin/pop_nomu_cust.asp">

<input type="hidden" name="search_top_cate" value="">
<input type="hidden" name="search_first" value="">
<input type="hidden" name="order_sort" value="">
<input type="hidden" name="cate_code" value="">
<input type="hidden" name="sub_cate_code" value="">
<input type="hidden" name="search_sub_key" value="">
<input type="hidden" name="notice_type" value="">

</form>
<script language="javascript">
	function goPageList(strpage)
	{
		var frm = document.pageForm;
		var strUrl = frm.pageurl.value;
		frm.page.value=strpage;
		frm.action = strUrl;
		frm.submit();
		return;
	}
</script>
						</td>
					</tr>
				</table>
<!--리스트 -->
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
					<tr>
						<td align="center">
 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>   <tr>     <td width=2></td>      <td><img src=/img/ims/btn_lt.gif></td>      <td background=/img/ims/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">노무사선택</a></td>      <td><img src=/img/ims/btn_rt.gif></td>     <td width=2></td>    </tr>  </table>  <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>   <tr>     <td width=2></td>      <td><img src=/img/ims/btn_lt.gif></td>      <td background=/img/ims/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:window.close();" target="">닫 기</a></td>      <td><img src=/img/ims/btn_rt.gif></td>     <td width=2></td>    </tr>  </table> 
						</td>
					</tr>
				</table>

			</td>
		</tr>
<form name="listForm" method="post">
<input type="hidden" name="cust_numb" value="">
<input type="hidden" name="url" value="/_admin/pop_nomu_cust.asp">
</form>
	</table>
</body>
