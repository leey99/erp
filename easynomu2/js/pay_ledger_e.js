var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //설치 확인
	if(pHwpCtrl.Version == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("한글  컨트롤이 설치되지 않았습니다.");
		return false;
	}
	//버젼 확인
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl의 버젼이 낮아서 정상적으로 동작하지 않을 수 있습니다.\n"+
			"최신 버젼으로 업데이트하기를 권장합니다.\n\n"+
			"현재 버젼:" + CurVersion + "\n"+
			"권장 버젼:" + MinVersion + " 이상"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath를 구한다.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath 생성
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// 를 지워버린다.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath 생성
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // 테이블 내에 커서가 있는가?
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			if(i==4){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else if(i==9){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else{
				dact.Execute(dset);
				pHwpCtrl.Run("TableRightCell");
			}
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("현재 커서의 위치가 표의 내부가 아님.");
		return false;
	}
}

function TableAppendRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false)){
		pHwpCtrl.Run("TableCellBlock");
		pHwpCtrl.Run("TableColPageDown");
		pHwpCtrl.Run("Cancel");
		pHwpCtrl.Run("TableAppendRow");
		return true;
	}else	{
		if (_DEBUG)
			alert("셀필드(" + FirstCellName +")가 존재하지 않습니다.");
		return false;
	}
}


// 표에 마지막 행을 추가하고, 내용을 채운다.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}

function TableAppendRowContents2(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents2(ColumnArray);
}



function TableColumnContents2(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ 
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			dact.Execute(dset);
			pHwpCtrl.Run("TableRightCell");
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("현재 커서의 위치가 표의 내부가 아님.");
		return false;
	}
}

function TableDeleteRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false))
	{
		pHwpCtrl.Run("TableDeleteRow");
	}
}

function OnStart(){
	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()){
		location.href='main.php';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;

	if(pay_page > 1) pay_table = 'pay_ledger_e_'+pay_page+'page.hwp';
	else pay_table = 'pay_ledger.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";
		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
			if (pHwpCtrl.MoveToField("[사업장"+p+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1"+u, true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2"+u, true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3"+u, true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4"+u, true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5"+u, true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1"+u, true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2"+u, true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6"+u, true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7"+u, true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8"+u, true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		tr_count = pay_page * 10;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("연번"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[성명"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[직위"+i+"]", true, true, false)){set.SetItem("Text",frm.position[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[입사일"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("부서"+i, true, true, false)){set.SetItem("Text",frm.dept[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[기본근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_day[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본연장"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[야간근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[휴일근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[추가연장"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[소계"+i+"]", true, true, false)){set.SetItem("Text",frm.w_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본시급"+i, true, true, false)){set.SetItem("Text",frm.money_time_low[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상시급"+i, true, true, false)){set.SetItem("Text",frm.money_time[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기본급"+i, true, true, false)){set.SetItem("Text",frm.money_month[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("급여유형"+i, true, true, false)){set.SetItem("Text",frm.pay_gbn[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1"+i, true, true, false)){set.SetItem("Text",frm.g1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2"+i, true, true, false)){set.SetItem("Text",frm.g2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3"+i, true, true, false)){set.SetItem("Text",frm.g3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4"+i, true, true, false)){set.SetItem("Text",frm.g4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5"+i, true, true, false)){set.SetItem("Text",frm.g5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상임금계"+i, true, true, false)){set.SetItem("Text",frm.g_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본연장"+i, true, true, false)){set.SetItem("Text",frm.ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("야간근로"+i, true, true, false)){set.SetItem("Text",frm.night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴일근로"+i, true, true, false)){set.SetItem("Text",frm.hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("연차수당"+i, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가연장"+i, true, true, false)){set.SetItem("Text",frm.ext_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가야간"+i, true, true, false)){set.SetItem("Text",frm.night_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가휴일"+i, true, true, false)){set.SetItem("Text",frm.hday_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("법정수당계"+i, true, true, false)){set.SetItem("Text",frm.s_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1"+i, true, true, false)){set.SetItem("Text",frm.b1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2"+i, true, true, false)){set.SetItem("Text",frm.b2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6"+i, true, true, false)){set.SetItem("Text",frm.b6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7"+i, true, true, false)){set.SetItem("Text",frm.b7[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8"+i, true, true, false)){set.SetItem("Text",frm.b8[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타수당계"+i, true, true, false)){set.SetItem("Text",frm.b_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("연금보험"+i, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("건강보험"+i, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("장기요양"+i, true, true, false)){set.SetItem("Text",frm.yoyang[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("고용보험"+i, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("소득세"+i, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민세"+i, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제"+i, true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("공제계"+i, true, true, false)){set.SetItem("Text",frm.m_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("급여총액"+i, true, true, false)){set.SetItem("Text",frm.money_total[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("지급총액"+i, true, true, false)){set.SetItem("Text",frm.money_result[i].value);act.Execute(set);}
		}
		for(k=0;k<pay_page;k++) {
			if(k == 0) m = "";
			else m = k+1;
			if (pHwpCtrl.MoveToField("[기본근로s"+m+"]", true, true, false)){set.SetItem("Text",frm.w_day_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본연장s"+m+"]", true, true, false)){set.SetItem("Text",frm.w_ext_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[야간근로s"+m+"]", true, true, false)){set.SetItem("Text",frm.w_night_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[휴일근로s"+m+"]", true, true, false)){set.SetItem("Text",frm.w_hday_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[추가연장s"+m+"]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[소계s"+m+"]", true, true, false)){set.SetItem("Text",frm.w_sum_sum[k].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본시급s"+m, true, true, false)){set.SetItem("Text",frm.money_time_low_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상시급s"+m, true, true, false)){set.SetItem("Text",frm.money_time_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기본급s"+m, true, true, false)){set.SetItem("Text",frm.money_month_sum[k].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본연장s"+m, true, true, false)){set.SetItem("Text",frm.ext_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("야간근로s"+m, true, true, false)){set.SetItem("Text",frm.night_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴일근로s"+m, true, true, false)){set.SetItem("Text",frm.hday_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("연차수당s"+m, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가연장s"+m, true, true, false)){set.SetItem("Text",frm.ext_add_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가야간s"+m, true, true, false)){set.SetItem("Text",frm.night_add_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가휴일s"+m, true, true, false)){set.SetItem("Text",frm.hday_add_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("법정수당계s"+m, true, true, false)){set.SetItem("Text",frm.s_sum_sum[k].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1s"+m, true, true, false)){set.SetItem("Text",frm.g1_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2s"+m, true, true, false)){set.SetItem("Text",frm.g2_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3s"+m, true, true, false)){set.SetItem("Text",frm.g3_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4s"+m, true, true, false)){set.SetItem("Text",frm.g4_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5s"+m, true, true, false)){set.SetItem("Text",frm.g5_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상임금계s"+m, true, true, false)){set.SetItem("Text",frm.g_sum_sum[k].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1s"+m, true, true, false)){set.SetItem("Text",frm.b1_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2s"+m, true, true, false)){set.SetItem("Text",frm.b2_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6s"+m, true, true, false)){set.SetItem("Text",frm.b6_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7s"+m, true, true, false)){set.SetItem("Text",frm.b7_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8s"+m, true, true, false)){set.SetItem("Text",frm.b8_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타수당계s"+m, true, true, false)){set.SetItem("Text",frm.b_sum_sum[k].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("연금보험s"+m, true, true, false)){set.SetItem("Text",frm.yun_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("건강보험s"+m, true, true, false)){set.SetItem("Text",frm.health_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("장기요양s"+m, true, true, false)){set.SetItem("Text",frm.yoyang_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("고용보험s"+m, true, true, false)){set.SetItem("Text",frm.goyong_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민세s"+m, true, true, false)){set.SetItem("Text",frm.tax_jumin_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("소득세s"+m, true, true, false)){set.SetItem("Text",frm.tax_so_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제s"+m, true, true, false)){set.SetItem("Text",frm.minus_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("공제계s"+m, true, true, false)){set.SetItem("Text",frm.m_sum_sum[k].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("급여총액s"+m, true, true, false)){set.SetItem("Text",frm.money_total_sum[k].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("지급총액s"+m, true, true, false)){set.SetItem("Text",frm.money_result_sum[k].value);act.Execute(set);}
		}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='index.php';
	}		
});