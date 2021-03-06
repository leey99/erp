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
//	if(pHwpCtrl.getAttribute("Version") == null){
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
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	pay_table='pay_stubs_ase.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		if (pHwpCtrl.MoveToField("[회사명]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[급여년도]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[급여월]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[근로자명]", true, true, false)){set.SetItem("Text",frm.pay_name.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[근로자명1]", true, true, false)){set.SetItem("Text",frm.pay_name.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[직위]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[입사일]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("[통상시급]", true, true, false)){set.SetItem("Text",frm.money_time.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[기본급여]", true, true, false)){set.SetItem("Text",frm.basic_pay.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상소계", true, true, false)){set.SetItem("Text",frm.g_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("법정소계", true, true, false)){set.SetItem("Text",frm.b_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타소계", true, true, false)){set.SetItem("Text",frm.e_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("[공제총액]", true, true, false)){set.SetItem("Text",frm.minus.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[임금총액]", true, true, false)){set.SetItem("Text",frm.money_total.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[급여지급총액]", true, true, false)){set.SetItem("Text",frm.gtotal.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[실지급액]", true, true, false)){set.SetItem("Text",frm.rtotal.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상6", true, true, false)){set.SetItem("Text",frm.g6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상7", true, true, false)){set.SetItem("Text",frm.g7_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m1", true, true, false)){set.SetItem("Text",frm.g1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m2", true, true, false)){set.SetItem("Text",frm.g2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m3", true, true, false)){set.SetItem("Text",frm.g3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m4", true, true, false)){set.SetItem("Text",frm.g4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m5", true, true, false)){set.SetItem("Text",frm.g5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m6", true, true, false)){set.SetItem("Text",frm.g6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상m7", true, true, false)){set.SetItem("Text",frm.g7.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본연장", true, true, false)){set.SetItem("Text",frm.b1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본야간", true, true, false)){set.SetItem("Text",frm.b2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본휴일", true, true, false)){set.SetItem("Text",frm.b3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가연장", true, true, false)){set.SetItem("Text",frm.b4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가야간", true, true, false)){set.SetItem("Text",frm.b5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가휴일", true, true, false)){set.SetItem("Text",frm.b6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("연차수당", true, true, false)){set.SetItem("Text",frm.b7.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1", true, true, false)){set.SetItem("Text",frm.e1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2", true, true, false)){set.SetItem("Text",frm.e2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3", true, true, false)){set.SetItem("Text",frm.e3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4", true, true, false)){set.SetItem("Text",frm.e4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타5", true, true, false)){set.SetItem("Text",frm.e5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타6", true, true, false)){set.SetItem("Text",frm.e6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타7", true, true, false)){set.SetItem("Text",frm.e7_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타8", true, true, false)){set.SetItem("Text",frm.e8_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타9", true, true, false)){set.SetItem("Text",frm.e9_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타10", true, true, false)){set.SetItem("Text",frm.e10_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타11", true, true, false)){set.SetItem("Text",frm.e11_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m1", true, true, false)){set.SetItem("Text",frm.e1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m2", true, true, false)){set.SetItem("Text",frm.e2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m3", true, true, false)){set.SetItem("Text",frm.e3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m4", true, true, false)){set.SetItem("Text",frm.e4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m5", true, true, false)){set.SetItem("Text",frm.e5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m6", true, true, false)){set.SetItem("Text",frm.e6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m7", true, true, false)){set.SetItem("Text",frm.e7.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m8", true, true, false)){set.SetItem("Text",frm.e8.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m9", true, true, false)){set.SetItem("Text",frm.e9.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m10", true, true, false)){set.SetItem("Text",frm.e10.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타m11", true, true, false)){set.SetItem("Text",frm.e11.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("제수당계", true, true, false)){set.SetItem("Text",frm.v_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("국민연금", true, true, false)){set.SetItem("Text",frm.yun.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험", true, true, false)){set.SetItem("Text",frm.goyong.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험", true, true, false)){set.SetItem("Text",frm.health.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양", true, true, false)){set.SetItem("Text",frm.hi2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세", true, true, false)){set.SetItem("Text",frm.tax_so.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("주민세", true, true, false)){set.SetItem("Text",frm.tax_jumin.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타공제1", true, true, false)){set.SetItem("Text",frm.minus1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제2", true, true, false)){set.SetItem("Text",frm.minus2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제3", true, true, false)){set.SetItem("Text",frm.minus3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제4", true, true, false)){set.SetItem("Text",frm.minus4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제5", true, true, false)){set.SetItem("Text",frm.minus5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제6", true, true, false)){set.SetItem("Text",frm.minus6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제m1", true, true, false)){set.SetItem("Text",frm.minus1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제m2", true, true, false)){set.SetItem("Text",frm.minus2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제m3", true, true, false)){set.SetItem("Text",frm.minus3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제m4", true, true, false)){set.SetItem("Text",frm.minus4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제m5", true, true, false)){set.SetItem("Text",frm.minus5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제m6", true, true, false)){set.SetItem("Text",frm.minus6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[공제합계]", true, true, false)){set.SetItem("Text",frm.minus.value);act.Execute(set);}
		if(frm.comp_type.value=='D') {
			if (pHwpCtrl.MoveToField("[기타합계]", true, true, false)){set.SetItem("Text",frm.etc_sum.value);act.Execute(set);}
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
