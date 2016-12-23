var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

//custom Toolbar 사용시 기본 액션에는 새로만들기, 저장, 다른이름으로 저장, 열기, 가 없는데 대체 액션을 만들어서 사용
//html의 onstart()에 다음과 같이 넣고 사용하면 된다. 상단에 함수로 onstart있다.
function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
//	HwpControl.HwpCtrl.SetToolBar(3, "FileNew, FileSave, FileSaveAs, FileOpen");
	/*
	HwpControl.HwpCtrl.SetToolBar(0, "FileNew, FileSave, FileSaveAs, FileOpen, Separator, FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	*/
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	/*
	HwpControl.HwpCtrl.SetToolBar(1, "DrawObjCreatorLine, DrawObjCreatorRectangle, DrawObjCreatorEllipse,"
	+"DrawObjCreatorArc, DrawObjCreatorPolygon, DrawObjCreatorCurve, DrawObjTemplateLoad,"
	+"Separator, ShapeObjSelect, ShapeObjGroup, ShapeObjUngroup, Separator, ShapeObjBringToFront,"
	+"ShapeObjSendToBack, ShapeObjDialog, ShapeObjAttrDialog");

	HwpControl.HwpCtrl.SetToolBar(2, "StyleCombo, CharShapeLanguage, CharShapeTypeFace, CharShapeHeight,"
	+"CharShapeBold, CharShapeItalic, CharShapeUnderline, ParagraphShapeAlignJustify, ParagraphShapeAlignLeft,"
	+"ParagraphShapeAlignCenter, ParagraphShapeAlignRight, Separator, ParaShapeLineSpacing,"
	+"ParagraphShapeDecreaseLeftMargin, ParagraphShapeIncreaseLeftMargin");
	*/
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

	var pay_count = frm.pay_count.value;

	if(frm.comp_type.value == "G") comp_type = "_g";
	else comp_type = "";
	if(pay_count > 1) pay_table = 'pay_stubs'+comp_type+'_'+pay_count+'page.hwp';
	else pay_table = 'pay_stubs.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		for(i=1;i<=pay_count;i++) {
			j = i;
			if(i == 1) j = "";
			if (pHwpCtrl.MoveToField("[회사명"+j+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[근로자명"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[성명"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[직위"+j+"]", true, true, false)){set.SetItem("Text",frm.jik[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[입사일"+j+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[통상시급"+j+"]", true, true, false)){set.SetItem("Text",frm.money_time[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본시급"+j+"]", true, true, false)){set.SetItem("Text",frm.money_min_base[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본급여"+j+"]", true, true, false)){set.SetItem("Text",frm.basic_pay[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상소계"+j, true, true, false)){set.SetItem("Text",frm.g_sum[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("법정소계"+j, true, true, false)){set.SetItem("Text",frm.b_sum[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타소계"+j, true, true, false)){set.SetItem("Text",frm.e_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[공제총액"+j+"]", true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[임금총액"+j+"]", true, true, false)){set.SetItem("Text",frm.money_total[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여지급총액"+j+"]", true, true, false)){set.SetItem("Text",frm.gtotal[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[실지급액"+j+"]", true, true, false)){set.SetItem("Text",frm.rtotal[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1"+j, true, true, false)){set.SetItem("Text",frm.g1_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2"+j, true, true, false)){set.SetItem("Text",frm.g2_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3"+j, true, true, false)){set.SetItem("Text",frm.g3_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4"+j, true, true, false)){set.SetItem("Text",frm.g4_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5"+j, true, true, false)){set.SetItem("Text",frm.g5_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상6"+j, true, true, false)){set.SetItem("Text",frm.g6_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상7"+j, true, true, false)){set.SetItem("Text",frm.g7_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m1"+j, true, true, false)){set.SetItem("Text",frm.g1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m2"+j, true, true, false)){set.SetItem("Text",frm.g2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m3"+j, true, true, false)){set.SetItem("Text",frm.g3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m4"+j, true, true, false)){set.SetItem("Text",frm.g4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m5"+j, true, true, false)){set.SetItem("Text",frm.g5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m6"+j, true, true, false)){set.SetItem("Text",frm.g6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상m7"+j, true, true, false)){set.SetItem("Text",frm.g7[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본연장"+j, true, true, false)){set.SetItem("Text",frm.b1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기본야간"+j, true, true, false)){set.SetItem("Text",frm.b2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기본휴일"+j, true, true, false)){set.SetItem("Text",frm.b3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가연장"+j, true, true, false)){set.SetItem("Text",frm.b4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가야간"+j, true, true, false)){set.SetItem("Text",frm.b5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("추가휴일"+j, true, true, false)){set.SetItem("Text",frm.b6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("연차수당"+j, true, true, false)){set.SetItem("Text",frm.b7[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1"+j, true, true, false)){set.SetItem("Text",frm.e1_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2"+j, true, true, false)){set.SetItem("Text",frm.e2_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3"+j, true, true, false)){set.SetItem("Text",frm.e3_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4"+j, true, true, false)){set.SetItem("Text",frm.e4_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타5"+j, true, true, false)){set.SetItem("Text",frm.e5_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6"+j, true, true, false)){set.SetItem("Text",frm.e6_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7"+j, true, true, false)){set.SetItem("Text",frm.e7_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8"+j, true, true, false)){set.SetItem("Text",frm.e8_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타9"+j, true, true, false)){set.SetItem("Text",frm.e9_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타10"+j, true, true, false)){set.SetItem("Text",frm.e10_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타11_"+j, true, true, false)){set.SetItem("Text",frm.e11_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m1"+j, true, true, false)){set.SetItem("Text",frm.e1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m2"+j, true, true, false)){set.SetItem("Text",frm.e2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m3"+j, true, true, false)){set.SetItem("Text",frm.e3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m4"+j, true, true, false)){set.SetItem("Text",frm.e4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m5"+j, true, true, false)){set.SetItem("Text",frm.e5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m6"+j, true, true, false)){set.SetItem("Text",frm.e6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m7"+j, true, true, false)){set.SetItem("Text",frm.e7[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m8"+j, true, true, false)){set.SetItem("Text",frm.e8[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m9"+j, true, true, false)){set.SetItem("Text",frm.e9[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m10"+j, true, true, false)){set.SetItem("Text",frm.e10[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타m11_"+j, true, true, false)){set.SetItem("Text",frm.e11[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("국민연금"+j, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("고용보험"+j, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("건강보험"+j, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("장기요양"+j, true, true, false)){set.SetItem("Text",frm.hi2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("소득세"+j, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민세"+j, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타공제1"+j, true, true, false)){set.SetItem("Text",frm.minus1_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제2"+j, true, true, false)){set.SetItem("Text",frm.minus2_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제3"+j, true, true, false)){set.SetItem("Text",frm.minus3_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제4"+j, true, true, false)){set.SetItem("Text",frm.minus4_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제5"+j, true, true, false)){set.SetItem("Text",frm.minus5_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제6"+j, true, true, false)){set.SetItem("Text",frm.minus6_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제m1"+j, true, true, false)){set.SetItem("Text",frm.minus1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제m2"+j, true, true, false)){set.SetItem("Text",frm.minus2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제m3"+j, true, true, false)){set.SetItem("Text",frm.minus3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제m4"+j, true, true, false)){set.SetItem("Text",frm.minus4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제m5"+j, true, true, false)){set.SetItem("Text",frm.minus5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제m6"+j, true, true, false)){set.SetItem("Text",frm.minus6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[공제합계"+j+"]", true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
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
