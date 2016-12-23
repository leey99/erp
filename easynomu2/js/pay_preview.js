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
		location.href='<?=$PHP_SELF?>';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	var pay_count = frm.pay_count.value;

	if(pay_count > 6 && pay_count < 13) pay_table = 'pay_preview_2page.hwp';
	else if(pay_count > 12 && pay_count < 19) pay_table = 'pay_preview_3page.hwp';
	else if(pay_count > 18) pay_table = 'pay_preview_4page.hwp';
	else pay_table = 'pay_preview.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		if (pHwpCtrl.MoveToField("[사업장]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[급여년도]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[급여월]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타5", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타6", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타7", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타8", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}

		if(pay_count > 6 && pay_count < 25) {
			if (pHwpCtrl.MoveToField("[사업장2]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도2]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월2]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1b", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2b", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3b", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4b", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5b", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1b", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2b", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3b", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4b", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타5b", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6b", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7b", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8b", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		if(pay_count > 12 && pay_count < 25) {
			if (pHwpCtrl.MoveToField("[사업장3]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도3]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월3]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1c", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2c", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3c", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4c", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5c", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1c", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2c", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3c", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4c", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타5c", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6c", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7c", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8c", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		if(pay_count > 18 && pay_count < 25) {
			if (pHwpCtrl.MoveToField("[사업장4]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도4]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월4]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1d", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2d", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3d", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4d", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5d", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1d", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2d", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3d", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4d", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타5d", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타6d", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타7d", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타8d", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		if(pay_count > 6 && pay_count < 13) tr_count = '12';
		else if(pay_count > 12 && pay_count < 19) tr_count = 18;
		else if(pay_count > 18 && pay_count < 25) tr_count = 24;
		else tr_count = 6;
		for(i=0;i<=tr_count;i++){
			if (pHwpCtrl.MoveToField("연번"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[성명"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[직위"+i+"]", true, true, false)){set.SetItem("Text",frm.position[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[호봉"+i+"]", true, true, false)){set.SetItem("Text",frm.step[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[입사일"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[퇴사일"+i+"]", true, true, false)){set.SetItem("Text",frm.edate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("채용형태"+i, true, true, false)){set.SetItem("Text",frm.work_form[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("부서"+i, true, true, false)){set.SetItem("Text",frm.dept[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[기본근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_day[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본연장"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[야간근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[휴일근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[추가연장"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[추가야간"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[추가휴일"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday_add[i].value);act.Execute(set);}
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
			if (pHwpCtrl.MoveToField("기타3"+i, true, true, false)){set.SetItem("Text",frm.b3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4"+i, true, true, false)){set.SetItem("Text",frm.b4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타5"+i, true, true, false)){set.SetItem("Text",frm.b5[i].value);act.Execute(set);}
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
		if (pHwpCtrl.MoveToField("[기본근로s]", true, true, false)){set.SetItem("Text",frm.w_day_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[기본연장s]", true, true, false)){set.SetItem("Text",frm.w_ext_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[야간근로s]", true, true, false)){set.SetItem("Text",frm.w_night_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[휴일근로s]", true, true, false)){set.SetItem("Text",frm.w_hday_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가연장s]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가야간s]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가휴일s]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[소계s]", true, true, false)){set.SetItem("Text",frm.w_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본시급s", true, true, false)){set.SetItem("Text",frm.money_time_low_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상시급s", true, true, false)){set.SetItem("Text",frm.money_time_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본급s", true, true, false)){set.SetItem("Text",frm.money_month_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본연장s", true, true, false)){set.SetItem("Text",frm.ext_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("야간근로s", true, true, false)){set.SetItem("Text",frm.night_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴일근로s", true, true, false)){set.SetItem("Text",frm.hday_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("연차수당s", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가연장s", true, true, false)){set.SetItem("Text",frm.ext_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가야간s", true, true, false)){set.SetItem("Text",frm.night_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가휴일s", true, true, false)){set.SetItem("Text",frm.hday_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("법정수당계s", true, true, false)){set.SetItem("Text",frm.s_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1s", true, true, false)){set.SetItem("Text",frm.g1_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2s", true, true, false)){set.SetItem("Text",frm.g2_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3s", true, true, false)){set.SetItem("Text",frm.g3_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4s", true, true, false)){set.SetItem("Text",frm.g4_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5s", true, true, false)){set.SetItem("Text",frm.g5_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상임금계s", true, true, false)){set.SetItem("Text",frm.g_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1s", true, true, false)){set.SetItem("Text",frm.b1_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2s", true, true, false)){set.SetItem("Text",frm.b2_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3s", true, true, false)){set.SetItem("Text",frm.b3_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4s", true, true, false)){set.SetItem("Text",frm.b4_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타5s", true, true, false)){set.SetItem("Text",frm.b5_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타6s", true, true, false)){set.SetItem("Text",frm.b6_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타7s", true, true, false)){set.SetItem("Text",frm.b7_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타8s", true, true, false)){set.SetItem("Text",frm.b8_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타수당계s", true, true, false)){set.SetItem("Text",frm.b_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("연금보험s", true, true, false)){set.SetItem("Text",frm.yun_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험s", true, true, false)){set.SetItem("Text",frm.health_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양s", true, true, false)){set.SetItem("Text",frm.yoyang_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험s", true, true, false)){set.SetItem("Text",frm.goyong_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("주민세s", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세s", true, true, false)){set.SetItem("Text",frm.tax_so_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제s", true, true, false)){set.SetItem("Text",frm.minus_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("공제계s", true, true, false)){set.SetItem("Text",frm.m_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("급여총액s", true, true, false)){set.SetItem("Text",frm.money_total_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("지급총액s", true, true, false)){set.SetItem("Text",frm.money_result_sum.value);act.Execute(set);}

		//2page
		if (pHwpCtrl.MoveToField("[기본근로s2]", true, true, false)){set.SetItem("Text",frm.w_day_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[기본연장s2]", true, true, false)){set.SetItem("Text",frm.w_ext_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[야간근로s2]", true, true, false)){set.SetItem("Text",frm.w_night_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[휴일근로s2]", true, true, false)){set.SetItem("Text",frm.w_hday_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가연장s2]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가야간s2]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가휴일s2]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[소계s2]", true, true, false)){set.SetItem("Text",frm.w_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본시급s2", true, true, false)){set.SetItem("Text",frm.money_time_low_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상시급s2", true, true, false)){set.SetItem("Text",frm.money_time_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본급s2", true, true, false)){set.SetItem("Text",frm.money_month_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본연장s2", true, true, false)){set.SetItem("Text",frm.ext_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("야간근로s2", true, true, false)){set.SetItem("Text",frm.night_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴일근로s2", true, true, false)){set.SetItem("Text",frm.hday_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("연차수당s2", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가연장s2", true, true, false)){set.SetItem("Text",frm.ext_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가야간s2", true, true, false)){set.SetItem("Text",frm.night_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가휴일s2", true, true, false)){set.SetItem("Text",frm.hday_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("법정수당계s2", true, true, false)){set.SetItem("Text",frm.s_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1s2", true, true, false)){set.SetItem("Text",frm.g1_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2s2", true, true, false)){set.SetItem("Text",frm.g2_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3s2", true, true, false)){set.SetItem("Text",frm.g3_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4s2", true, true, false)){set.SetItem("Text",frm.g4_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5s2", true, true, false)){set.SetItem("Text",frm.g5_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상임금계s2", true, true, false)){set.SetItem("Text",frm.g_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1s2", true, true, false)){set.SetItem("Text",frm.b1_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2s2", true, true, false)){set.SetItem("Text",frm.b2_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3s2", true, true, false)){set.SetItem("Text",frm.b3_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4s2", true, true, false)){set.SetItem("Text",frm.b4_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타5s2", true, true, false)){set.SetItem("Text",frm.b5_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타6s2", true, true, false)){set.SetItem("Text",frm.b6_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타7s2", true, true, false)){set.SetItem("Text",frm.b7_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타8s2", true, true, false)){set.SetItem("Text",frm.b8_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타수당계s2", true, true, false)){set.SetItem("Text",frm.b_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("연금보험s2", true, true, false)){set.SetItem("Text",frm.yun_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험s2", true, true, false)){set.SetItem("Text",frm.health_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양s2", true, true, false)){set.SetItem("Text",frm.yoyang_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험s2", true, true, false)){set.SetItem("Text",frm.goyong_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("주민세s2", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세s2", true, true, false)){set.SetItem("Text",frm.tax_so_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제s2", true, true, false)){set.SetItem("Text",frm.minus_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("공제계s2", true, true, false)){set.SetItem("Text",frm.m_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("급여총액s2", true, true, false)){set.SetItem("Text",frm.money_total_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("지급총액s2", true, true, false)){set.SetItem("Text",frm.money_result_sum2.value);act.Execute(set);}

		//3page
		if (pHwpCtrl.MoveToField("[기본근로s3]", true, true, false)){set.SetItem("Text",frm.w_day_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[기본연장s3]", true, true, false)){set.SetItem("Text",frm.w_ext_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[야간근로s3]", true, true, false)){set.SetItem("Text",frm.w_night_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[휴일근로s3]", true, true, false)){set.SetItem("Text",frm.w_hday_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가연장s3]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가야간s3]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가휴일s3]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[소계s3]", true, true, false)){set.SetItem("Text",frm.w_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본시급s3", true, true, false)){set.SetItem("Text",frm.money_time_low_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상시급s3", true, true, false)){set.SetItem("Text",frm.money_time_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본급s3", true, true, false)){set.SetItem("Text",frm.money_month_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본연장s3", true, true, false)){set.SetItem("Text",frm.ext_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("야간근로s3", true, true, false)){set.SetItem("Text",frm.night_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴일근로s3", true, true, false)){set.SetItem("Text",frm.hday_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("연차수당s3", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가연장s3", true, true, false)){set.SetItem("Text",frm.ext_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가야간s3", true, true, false)){set.SetItem("Text",frm.night_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가휴일s3", true, true, false)){set.SetItem("Text",frm.hday_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("법정수당계s3", true, true, false)){set.SetItem("Text",frm.s_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1s3", true, true, false)){set.SetItem("Text",frm.g1_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2s3", true, true, false)){set.SetItem("Text",frm.g2_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3s3", true, true, false)){set.SetItem("Text",frm.g3_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4s3", true, true, false)){set.SetItem("Text",frm.g4_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5s3", true, true, false)){set.SetItem("Text",frm.g5_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상임금계s3", true, true, false)){set.SetItem("Text",frm.g_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1s3", true, true, false)){set.SetItem("Text",frm.b1_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2s3", true, true, false)){set.SetItem("Text",frm.b2_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3s3", true, true, false)){set.SetItem("Text",frm.b3_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4s3", true, true, false)){set.SetItem("Text",frm.b4_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타5s3", true, true, false)){set.SetItem("Text",frm.b5_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타6s3", true, true, false)){set.SetItem("Text",frm.b6_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타7s3", true, true, false)){set.SetItem("Text",frm.b7_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타8s3", true, true, false)){set.SetItem("Text",frm.b8_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타수당계s3", true, true, false)){set.SetItem("Text",frm.b_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("연금보험s3", true, true, false)){set.SetItem("Text",frm.yun_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험s3", true, true, false)){set.SetItem("Text",frm.health_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양s3", true, true, false)){set.SetItem("Text",frm.yoyang_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험s3", true, true, false)){set.SetItem("Text",frm.goyong_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("주민세s3", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세s3", true, true, false)){set.SetItem("Text",frm.tax_so_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제s3", true, true, false)){set.SetItem("Text",frm.minus_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("공제계s3", true, true, false)){set.SetItem("Text",frm.m_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("급여총액s3", true, true, false)){set.SetItem("Text",frm.money_total_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("지급총액s3", true, true, false)){set.SetItem("Text",frm.money_result_sum3.value);act.Execute(set);}

		//4page
		if (pHwpCtrl.MoveToField("[기본근로s4]", true, true, false)){set.SetItem("Text",frm.w_day_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[기본연장s4]", true, true, false)){set.SetItem("Text",frm.w_ext_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[야간근로s4]", true, true, false)){set.SetItem("Text",frm.w_night_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[휴일근로s4]", true, true, false)){set.SetItem("Text",frm.w_hday_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가연장s4]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가야간s4]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[추가휴일s4]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[소계s4]", true, true, false)){set.SetItem("Text",frm.w_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본시급s4", true, true, false)){set.SetItem("Text",frm.money_time_low_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상시급s4", true, true, false)){set.SetItem("Text",frm.money_time_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본급s4", true, true, false)){set.SetItem("Text",frm.money_month_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본연장s4", true, true, false)){set.SetItem("Text",frm.ext_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("야간근로s4", true, true, false)){set.SetItem("Text",frm.night_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴일근로s4", true, true, false)){set.SetItem("Text",frm.hday_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("연차수당s4", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가연장s4", true, true, false)){set.SetItem("Text",frm.ext_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가야간s4", true, true, false)){set.SetItem("Text",frm.night_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("추가휴일s4", true, true, false)){set.SetItem("Text",frm.hday_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("법정수당계s4", true, true, false)){set.SetItem("Text",frm.s_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1s4", true, true, false)){set.SetItem("Text",frm.g1_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2s4", true, true, false)){set.SetItem("Text",frm.g2_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3s4", true, true, false)){set.SetItem("Text",frm.g3_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4s4", true, true, false)){set.SetItem("Text",frm.g4_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5s4", true, true, false)){set.SetItem("Text",frm.g5_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상임금계s4", true, true, false)){set.SetItem("Text",frm.g_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1s4", true, true, false)){set.SetItem("Text",frm.b1_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2s4", true, true, false)){set.SetItem("Text",frm.b2_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3s4", true, true, false)){set.SetItem("Text",frm.b3_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4s4", true, true, false)){set.SetItem("Text",frm.b4_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타5s4", true, true, false)){set.SetItem("Text",frm.b5_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타6s4", true, true, false)){set.SetItem("Text",frm.b6_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타7s4", true, true, false)){set.SetItem("Text",frm.b7_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타8s4", true, true, false)){set.SetItem("Text",frm.b8_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타수당계s4", true, true, false)){set.SetItem("Text",frm.b_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("연금보험s4", true, true, false)){set.SetItem("Text",frm.yun_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험s4", true, true, false)){set.SetItem("Text",frm.health_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양s4", true, true, false)){set.SetItem("Text",frm.yoyang_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험s4", true, true, false)){set.SetItem("Text",frm.goyong_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("주민세s4", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세s4", true, true, false)){set.SetItem("Text",frm.tax_so_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제s4", true, true, false)){set.SetItem("Text",frm.minus_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("공제계s4", true, true, false)){set.SetItem("Text",frm.m_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("급여총액s4", true, true, false)){set.SetItem("Text",frm.money_total_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("지급총액s4", true, true, false)){set.SetItem("Text",frm.money_result_sum4.value);act.Execute(set);}
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