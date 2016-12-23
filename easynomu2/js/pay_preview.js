var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

//custom Toolbar ���� �⺻ �׼ǿ��� ���θ����, ����, �ٸ��̸����� ����, ����, �� ���µ� ��ü �׼��� ���� ���
//html�� onstart()�� ������ ���� �ְ� ����ϸ� �ȴ�. ��ܿ� �Լ��� onstart�ִ�.
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

function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
//	if(pHwpCtrl.getAttribute("Version") == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("�ѱ�  ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.");
		return false;
	}
	//���� Ȯ��
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl�� ������ ���Ƽ� ���������� �������� ���� �� �ֽ��ϴ�.\n"+
			"�ֽ� �������� ������Ʈ�ϱ⸦ �����մϴ�.\n\n"+
			"���� ����:" + CurVersion + "\n"+
			"���� ����:" + MinVersion + " �̻�"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath�� ���Ѵ�.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath ����
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// �� ����������.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath ����
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // ���̺� ���� Ŀ���� �ִ°�?
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
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
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
			alert("���ʵ�(" + FirstCellName +")�� �������� �ʽ��ϴ�.");
		return false;
	}
}


// ǥ�� ������ ���� �߰��ϰ�, ������ ä���.
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
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
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
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

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
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("[�����]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�޿��⵵]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�޿���]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ5", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ6", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ7", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ8", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}

		if(pay_count > 6 && pay_count < 25) {
			if (pHwpCtrl.MoveToField("[�����2]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿��⵵2]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿���2]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1b", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2b", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3b", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4b", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5b", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1b", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2b", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3b", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4b", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ5b", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ6b", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ7b", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ8b", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		if(pay_count > 12 && pay_count < 25) {
			if (pHwpCtrl.MoveToField("[�����3]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿��⵵3]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿���3]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1c", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2c", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3c", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4c", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5c", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1c", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2c", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3c", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4c", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ5c", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ6c", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ7c", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ8c", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		if(pay_count > 18 && pay_count < 25) {
			if (pHwpCtrl.MoveToField("[�����4]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿��⵵4]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿���4]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1d", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2d", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3d", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4d", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5d", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1d", true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2d", true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3d", true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4d", true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ5d", true, true, false)){set.SetItem("Text",frm.b5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ6d", true, true, false)){set.SetItem("Text",frm.b6_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ7d", true, true, false)){set.SetItem("Text",frm.b7_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ8d", true, true, false)){set.SetItem("Text",frm.b8_text.value);act.Execute(set);}
		}
		if(pay_count > 6 && pay_count < 13) tr_count = '12';
		else if(pay_count > 12 && pay_count < 19) tr_count = 18;
		else if(pay_count > 18 && pay_count < 25) tr_count = 24;
		else tr_count = 6;
		for(i=0;i<=tr_count;i++){
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+i+"]", true, true, false)){set.SetItem("Text",frm.position[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[ȣ��"+i+"]", true, true, false)){set.SetItem("Text",frm.step[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ի���"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�����"+i+"]", true, true, false)){set.SetItem("Text",frm.edate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("ä������"+i, true, true, false)){set.SetItem("Text",frm.work_form[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�μ�"+i, true, true, false)){set.SetItem("Text",frm.dept[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[�⺻�ٷ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_day[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�⺻����"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�߰��ٷ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[���ϱٷ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�߰�����"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�߰��߰�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�߰�����"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ұ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻�ñ�"+i, true, true, false)){set.SetItem("Text",frm.money_time_low[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ñ�"+i, true, true, false)){set.SetItem("Text",frm.money_time[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�⺻��"+i, true, true, false)){set.SetItem("Text",frm.money_month[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޿�����"+i, true, true, false)){set.SetItem("Text",frm.pay_gbn[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1"+i, true, true, false)){set.SetItem("Text",frm.g1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2"+i, true, true, false)){set.SetItem("Text",frm.g2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3"+i, true, true, false)){set.SetItem("Text",frm.g3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4"+i, true, true, false)){set.SetItem("Text",frm.g4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5"+i, true, true, false)){set.SetItem("Text",frm.g5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����ӱݰ�"+i, true, true, false)){set.SetItem("Text",frm.g_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻����"+i, true, true, false)){set.SetItem("Text",frm.ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰��ٷ�"+i, true, true, false)){set.SetItem("Text",frm.night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ϱٷ�"+i, true, true, false)){set.SetItem("Text",frm.hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��������"+i, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰�����"+i, true, true, false)){set.SetItem("Text",frm.ext_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰��߰�"+i, true, true, false)){set.SetItem("Text",frm.night_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰�����"+i, true, true, false)){set.SetItem("Text",frm.hday_add[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���������"+i, true, true, false)){set.SetItem("Text",frm.s_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1"+i, true, true, false)){set.SetItem("Text",frm.b1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2"+i, true, true, false)){set.SetItem("Text",frm.b2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3"+i, true, true, false)){set.SetItem("Text",frm.b3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4"+i, true, true, false)){set.SetItem("Text",frm.b4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ5"+i, true, true, false)){set.SetItem("Text",frm.b5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ6"+i, true, true, false)){set.SetItem("Text",frm.b6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ7"+i, true, true, false)){set.SetItem("Text",frm.b7[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ8"+i, true, true, false)){set.SetItem("Text",frm.b8[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ�����"+i, true, true, false)){set.SetItem("Text",frm.b_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���ݺ���"+i, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ǰ�����"+i, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.yoyang[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��뺸��"+i, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ҵ漼"+i, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹμ�"+i, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����"+i, true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("������"+i, true, true, false)){set.SetItem("Text",frm.m_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�޿��Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.money_total[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.money_result[i].value);act.Execute(set);}
		}
		if (pHwpCtrl.MoveToField("[�⺻�ٷ�s]", true, true, false)){set.SetItem("Text",frm.w_day_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�⺻����s]", true, true, false)){set.SetItem("Text",frm.w_ext_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��ٷ�s]", true, true, false)){set.SetItem("Text",frm.w_night_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[���ϱٷ�s]", true, true, false)){set.SetItem("Text",frm.w_hday_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��߰�s]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�Ұ�s]", true, true, false)){set.SetItem("Text",frm.w_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻�ñ�s", true, true, false)){set.SetItem("Text",frm.money_time_low_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ñ�s", true, true, false)){set.SetItem("Text",frm.money_time_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻��s", true, true, false)){set.SetItem("Text",frm.money_month_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻����s", true, true, false)){set.SetItem("Text",frm.ext_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��ٷ�s", true, true, false)){set.SetItem("Text",frm.night_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ϱٷ�s", true, true, false)){set.SetItem("Text",frm.hday_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������s", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s", true, true, false)){set.SetItem("Text",frm.ext_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��߰�s", true, true, false)){set.SetItem("Text",frm.night_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s", true, true, false)){set.SetItem("Text",frm.hday_add_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���������s", true, true, false)){set.SetItem("Text",frm.s_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1s", true, true, false)){set.SetItem("Text",frm.g1_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2s", true, true, false)){set.SetItem("Text",frm.g2_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3s", true, true, false)){set.SetItem("Text",frm.g3_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4s", true, true, false)){set.SetItem("Text",frm.g4_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5s", true, true, false)){set.SetItem("Text",frm.g5_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����ӱݰ�s", true, true, false)){set.SetItem("Text",frm.g_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1s", true, true, false)){set.SetItem("Text",frm.b1_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2s", true, true, false)){set.SetItem("Text",frm.b2_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3s", true, true, false)){set.SetItem("Text",frm.b3_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4s", true, true, false)){set.SetItem("Text",frm.b4_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ5s", true, true, false)){set.SetItem("Text",frm.b5_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ6s", true, true, false)){set.SetItem("Text",frm.b6_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ7s", true, true, false)){set.SetItem("Text",frm.b7_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ8s", true, true, false)){set.SetItem("Text",frm.b8_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ�����s", true, true, false)){set.SetItem("Text",frm.b_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���ݺ���s", true, true, false)){set.SetItem("Text",frm.yun_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����s", true, true, false)){set.SetItem("Text",frm.health_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����s", true, true, false)){set.SetItem("Text",frm.yoyang_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��s", true, true, false)){set.SetItem("Text",frm.goyong_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ֹμ�s", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼s", true, true, false)){set.SetItem("Text",frm.tax_so_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����s", true, true, false)){set.SetItem("Text",frm.minus_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("������s", true, true, false)){set.SetItem("Text",frm.m_sum_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�޿��Ѿ�s", true, true, false)){set.SetItem("Text",frm.money_total_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����Ѿ�s", true, true, false)){set.SetItem("Text",frm.money_result_sum.value);act.Execute(set);}

		//2page
		if (pHwpCtrl.MoveToField("[�⺻�ٷ�s2]", true, true, false)){set.SetItem("Text",frm.w_day_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�⺻����s2]", true, true, false)){set.SetItem("Text",frm.w_ext_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��ٷ�s2]", true, true, false)){set.SetItem("Text",frm.w_night_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[���ϱٷ�s2]", true, true, false)){set.SetItem("Text",frm.w_hday_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s2]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��߰�s2]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s2]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�Ұ�s2]", true, true, false)){set.SetItem("Text",frm.w_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻�ñ�s2", true, true, false)){set.SetItem("Text",frm.money_time_low_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ñ�s2", true, true, false)){set.SetItem("Text",frm.money_time_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻��s2", true, true, false)){set.SetItem("Text",frm.money_month_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻����s2", true, true, false)){set.SetItem("Text",frm.ext_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��ٷ�s2", true, true, false)){set.SetItem("Text",frm.night_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ϱٷ�s2", true, true, false)){set.SetItem("Text",frm.hday_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������s2", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s2", true, true, false)){set.SetItem("Text",frm.ext_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��߰�s2", true, true, false)){set.SetItem("Text",frm.night_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s2", true, true, false)){set.SetItem("Text",frm.hday_add_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���������s2", true, true, false)){set.SetItem("Text",frm.s_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1s2", true, true, false)){set.SetItem("Text",frm.g1_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2s2", true, true, false)){set.SetItem("Text",frm.g2_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3s2", true, true, false)){set.SetItem("Text",frm.g3_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4s2", true, true, false)){set.SetItem("Text",frm.g4_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5s2", true, true, false)){set.SetItem("Text",frm.g5_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����ӱݰ�s2", true, true, false)){set.SetItem("Text",frm.g_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1s2", true, true, false)){set.SetItem("Text",frm.b1_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2s2", true, true, false)){set.SetItem("Text",frm.b2_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3s2", true, true, false)){set.SetItem("Text",frm.b3_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4s2", true, true, false)){set.SetItem("Text",frm.b4_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ5s2", true, true, false)){set.SetItem("Text",frm.b5_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ6s2", true, true, false)){set.SetItem("Text",frm.b6_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ7s2", true, true, false)){set.SetItem("Text",frm.b7_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ8s2", true, true, false)){set.SetItem("Text",frm.b8_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ�����s2", true, true, false)){set.SetItem("Text",frm.b_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���ݺ���s2", true, true, false)){set.SetItem("Text",frm.yun_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����s2", true, true, false)){set.SetItem("Text",frm.health_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����s2", true, true, false)){set.SetItem("Text",frm.yoyang_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��s2", true, true, false)){set.SetItem("Text",frm.goyong_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ֹμ�s2", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼s2", true, true, false)){set.SetItem("Text",frm.tax_so_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����s2", true, true, false)){set.SetItem("Text",frm.minus_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("������s2", true, true, false)){set.SetItem("Text",frm.m_sum2_sum2.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�޿��Ѿ�s2", true, true, false)){set.SetItem("Text",frm.money_total_sum2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����Ѿ�s2", true, true, false)){set.SetItem("Text",frm.money_result_sum2.value);act.Execute(set);}

		//3page
		if (pHwpCtrl.MoveToField("[�⺻�ٷ�s3]", true, true, false)){set.SetItem("Text",frm.w_day_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�⺻����s3]", true, true, false)){set.SetItem("Text",frm.w_ext_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��ٷ�s3]", true, true, false)){set.SetItem("Text",frm.w_night_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[���ϱٷ�s3]", true, true, false)){set.SetItem("Text",frm.w_hday_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s3]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��߰�s3]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s3]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�Ұ�s3]", true, true, false)){set.SetItem("Text",frm.w_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻�ñ�s3", true, true, false)){set.SetItem("Text",frm.money_time_low_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ñ�s3", true, true, false)){set.SetItem("Text",frm.money_time_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻��s3", true, true, false)){set.SetItem("Text",frm.money_month_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻����s3", true, true, false)){set.SetItem("Text",frm.ext_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��ٷ�s3", true, true, false)){set.SetItem("Text",frm.night_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ϱٷ�s3", true, true, false)){set.SetItem("Text",frm.hday_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������s3", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s3", true, true, false)){set.SetItem("Text",frm.ext_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��߰�s3", true, true, false)){set.SetItem("Text",frm.night_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s3", true, true, false)){set.SetItem("Text",frm.hday_add_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���������s3", true, true, false)){set.SetItem("Text",frm.s_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1s3", true, true, false)){set.SetItem("Text",frm.g1_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2s3", true, true, false)){set.SetItem("Text",frm.g2_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3s3", true, true, false)){set.SetItem("Text",frm.g3_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4s3", true, true, false)){set.SetItem("Text",frm.g4_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5s3", true, true, false)){set.SetItem("Text",frm.g5_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����ӱݰ�s3", true, true, false)){set.SetItem("Text",frm.g_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1s3", true, true, false)){set.SetItem("Text",frm.b1_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2s3", true, true, false)){set.SetItem("Text",frm.b2_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3s3", true, true, false)){set.SetItem("Text",frm.b3_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4s3", true, true, false)){set.SetItem("Text",frm.b4_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ5s3", true, true, false)){set.SetItem("Text",frm.b5_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ6s3", true, true, false)){set.SetItem("Text",frm.b6_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ7s3", true, true, false)){set.SetItem("Text",frm.b7_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ8s3", true, true, false)){set.SetItem("Text",frm.b8_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ�����s3", true, true, false)){set.SetItem("Text",frm.b_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���ݺ���s3", true, true, false)){set.SetItem("Text",frm.yun_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����s3", true, true, false)){set.SetItem("Text",frm.health_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����s3", true, true, false)){set.SetItem("Text",frm.yoyang_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��s3", true, true, false)){set.SetItem("Text",frm.goyong_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ֹμ�s3", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼s3", true, true, false)){set.SetItem("Text",frm.tax_so_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����s3", true, true, false)){set.SetItem("Text",frm.minus_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("������s3", true, true, false)){set.SetItem("Text",frm.m_sum3_sum3.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�޿��Ѿ�s3", true, true, false)){set.SetItem("Text",frm.money_total_sum3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����Ѿ�s3", true, true, false)){set.SetItem("Text",frm.money_result_sum3.value);act.Execute(set);}

		//4page
		if (pHwpCtrl.MoveToField("[�⺻�ٷ�s4]", true, true, false)){set.SetItem("Text",frm.w_day_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�⺻����s4]", true, true, false)){set.SetItem("Text",frm.w_ext_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��ٷ�s4]", true, true, false)){set.SetItem("Text",frm.w_night_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[���ϱٷ�s4]", true, true, false)){set.SetItem("Text",frm.w_hday_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s4]", true, true, false)){set.SetItem("Text",frm.w_ext_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��߰�s4]", true, true, false)){set.SetItem("Text",frm.w_night_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰�����s4]", true, true, false)){set.SetItem("Text",frm.w_hday_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�Ұ�s4]", true, true, false)){set.SetItem("Text",frm.w_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻�ñ�s4", true, true, false)){set.SetItem("Text",frm.money_time_low_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ñ�s4", true, true, false)){set.SetItem("Text",frm.money_time_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻��s4", true, true, false)){set.SetItem("Text",frm.money_month_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻����s4", true, true, false)){set.SetItem("Text",frm.ext_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��ٷ�s4", true, true, false)){set.SetItem("Text",frm.night_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ϱٷ�s4", true, true, false)){set.SetItem("Text",frm.hday_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������s4", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s4", true, true, false)){set.SetItem("Text",frm.ext_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��߰�s4", true, true, false)){set.SetItem("Text",frm.night_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����s4", true, true, false)){set.SetItem("Text",frm.hday_add_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���������s4", true, true, false)){set.SetItem("Text",frm.s_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1s4", true, true, false)){set.SetItem("Text",frm.g1_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2s4", true, true, false)){set.SetItem("Text",frm.g2_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3s4", true, true, false)){set.SetItem("Text",frm.g3_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4s4", true, true, false)){set.SetItem("Text",frm.g4_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5s4", true, true, false)){set.SetItem("Text",frm.g5_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����ӱݰ�s4", true, true, false)){set.SetItem("Text",frm.g_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1s4", true, true, false)){set.SetItem("Text",frm.b1_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2s4", true, true, false)){set.SetItem("Text",frm.b2_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3s4", true, true, false)){set.SetItem("Text",frm.b3_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4s4", true, true, false)){set.SetItem("Text",frm.b4_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ5s4", true, true, false)){set.SetItem("Text",frm.b5_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ6s4", true, true, false)){set.SetItem("Text",frm.b6_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ7s4", true, true, false)){set.SetItem("Text",frm.b7_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ8s4", true, true, false)){set.SetItem("Text",frm.b8_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ�����s4", true, true, false)){set.SetItem("Text",frm.b_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���ݺ���s4", true, true, false)){set.SetItem("Text",frm.yun_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����s4", true, true, false)){set.SetItem("Text",frm.health_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����s4", true, true, false)){set.SetItem("Text",frm.yoyang_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��s4", true, true, false)){set.SetItem("Text",frm.goyong_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ֹμ�s4", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼s4", true, true, false)){set.SetItem("Text",frm.tax_so_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����s4", true, true, false)){set.SetItem("Text",frm.minus_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("������s4", true, true, false)){set.SetItem("Text",frm.m_sum4_sum4.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�޿��Ѿ�s4", true, true, false)){set.SetItem("Text",frm.money_total_sum4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����Ѿ�s4", true, true, false)){set.SetItem("Text",frm.money_result_sum4.value);act.Execute(set);}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='index.php';
	}		
});