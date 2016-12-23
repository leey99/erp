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
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

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
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		for(i=1;i<=pay_count;i++) {
			j = i;
			if(i == 1) j = "";
			if (pHwpCtrl.MoveToField("[ȸ���"+j+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿��⵵"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿���"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�ٷ��ڸ�"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+j+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+j+"]", true, true, false)){set.SetItem("Text",frm.jik[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ի���"+j+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[���ñ�"+j+"]", true, true, false)){set.SetItem("Text",frm.money_time[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�⺻�ñ�"+j+"]", true, true, false)){set.SetItem("Text",frm.money_min_base[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�⺻�޿�"+j+"]", true, true, false)){set.SetItem("Text",frm.basic_pay[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���Ұ�"+j, true, true, false)){set.SetItem("Text",frm.g_sum[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����Ұ�"+j, true, true, false)){set.SetItem("Text",frm.b_sum[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ�Ұ�"+j, true, true, false)){set.SetItem("Text",frm.e_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[�����Ѿ�"+j+"]", true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�ӱ��Ѿ�"+j+"]", true, true, false)){set.SetItem("Text",frm.money_total[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿������Ѿ�"+j+"]", true, true, false)){set.SetItem("Text",frm.gtotal[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�����޾�"+j+"]", true, true, false)){set.SetItem("Text",frm.rtotal[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1"+j, true, true, false)){set.SetItem("Text",frm.g1_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2"+j, true, true, false)){set.SetItem("Text",frm.g2_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3"+j, true, true, false)){set.SetItem("Text",frm.g3_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4"+j, true, true, false)){set.SetItem("Text",frm.g4_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5"+j, true, true, false)){set.SetItem("Text",frm.g5_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���6"+j, true, true, false)){set.SetItem("Text",frm.g6_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���7"+j, true, true, false)){set.SetItem("Text",frm.g7_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m1"+j, true, true, false)){set.SetItem("Text",frm.g1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m2"+j, true, true, false)){set.SetItem("Text",frm.g2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m3"+j, true, true, false)){set.SetItem("Text",frm.g3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m4"+j, true, true, false)){set.SetItem("Text",frm.g4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m5"+j, true, true, false)){set.SetItem("Text",frm.g5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m6"+j, true, true, false)){set.SetItem("Text",frm.g6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���m7"+j, true, true, false)){set.SetItem("Text",frm.g7[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻����"+j, true, true, false)){set.SetItem("Text",frm.b1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�⺻�߰�"+j, true, true, false)){set.SetItem("Text",frm.b2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�⺻����"+j, true, true, false)){set.SetItem("Text",frm.b3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰�����"+j, true, true, false)){set.SetItem("Text",frm.b4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰��߰�"+j, true, true, false)){set.SetItem("Text",frm.b5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰�����"+j, true, true, false)){set.SetItem("Text",frm.b6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��������"+j, true, true, false)){set.SetItem("Text",frm.b7[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1"+j, true, true, false)){set.SetItem("Text",frm.e1_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2"+j, true, true, false)){set.SetItem("Text",frm.e2_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3"+j, true, true, false)){set.SetItem("Text",frm.e3_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4"+j, true, true, false)){set.SetItem("Text",frm.e4_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ5"+j, true, true, false)){set.SetItem("Text",frm.e5_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ6"+j, true, true, false)){set.SetItem("Text",frm.e6_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ7"+j, true, true, false)){set.SetItem("Text",frm.e7_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ8"+j, true, true, false)){set.SetItem("Text",frm.e8_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ9"+j, true, true, false)){set.SetItem("Text",frm.e9_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ10"+j, true, true, false)){set.SetItem("Text",frm.e10_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ11_"+j, true, true, false)){set.SetItem("Text",frm.e11_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm1"+j, true, true, false)){set.SetItem("Text",frm.e1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm2"+j, true, true, false)){set.SetItem("Text",frm.e2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm3"+j, true, true, false)){set.SetItem("Text",frm.e3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm4"+j, true, true, false)){set.SetItem("Text",frm.e4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm5"+j, true, true, false)){set.SetItem("Text",frm.e5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm6"+j, true, true, false)){set.SetItem("Text",frm.e6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm7"+j, true, true, false)){set.SetItem("Text",frm.e7[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm8"+j, true, true, false)){set.SetItem("Text",frm.e8[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm9"+j, true, true, false)){set.SetItem("Text",frm.e9[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm10"+j, true, true, false)){set.SetItem("Text",frm.e10[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿm11_"+j, true, true, false)){set.SetItem("Text",frm.e11[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���ο���"+j, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��뺸��"+j, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ǰ�����"+j, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+j, true, true, false)){set.SetItem("Text",frm.hi2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ҵ漼"+j, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹμ�"+j, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ����1"+j, true, true, false)){set.SetItem("Text",frm.minus1_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����2"+j, true, true, false)){set.SetItem("Text",frm.minus2_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����3"+j, true, true, false)){set.SetItem("Text",frm.minus3_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����4"+j, true, true, false)){set.SetItem("Text",frm.minus4_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����5"+j, true, true, false)){set.SetItem("Text",frm.minus5_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����6"+j, true, true, false)){set.SetItem("Text",frm.minus6_text[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����m1"+j, true, true, false)){set.SetItem("Text",frm.minus1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����m2"+j, true, true, false)){set.SetItem("Text",frm.minus2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����m3"+j, true, true, false)){set.SetItem("Text",frm.minus3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����m4"+j, true, true, false)){set.SetItem("Text",frm.minus4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����m5"+j, true, true, false)){set.SetItem("Text",frm.minus5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����m6"+j, true, true, false)){set.SetItem("Text",frm.minus6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�����հ�"+j+"]", true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
		}
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
