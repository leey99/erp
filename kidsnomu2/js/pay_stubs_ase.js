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

	pay_table='pay_stubs_ase.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("[ȸ���]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�޿��⵵]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�޿���]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�ٷ��ڸ�]", true, true, false)){set.SetItem("Text",frm.pay_name.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�ٷ��ڸ�1]", true, true, false)){set.SetItem("Text",frm.pay_name.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�Ի���]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("[���ñ�]", true, true, false)){set.SetItem("Text",frm.money_time.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�⺻�޿�]", true, true, false)){set.SetItem("Text",frm.basic_pay.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���Ұ�", true, true, false)){set.SetItem("Text",frm.g_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����Ұ�", true, true, false)){set.SetItem("Text",frm.b_sum.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ�Ұ�", true, true, false)){set.SetItem("Text",frm.e_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("[�����Ѿ�]", true, true, false)){set.SetItem("Text",frm.minus.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�ӱ��Ѿ�]", true, true, false)){set.SetItem("Text",frm.money_total.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�޿������Ѿ�]", true, true, false)){set.SetItem("Text",frm.gtotal.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�����޾�]", true, true, false)){set.SetItem("Text",frm.rtotal.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1", true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2", true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3", true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4", true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5", true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���6", true, true, false)){set.SetItem("Text",frm.g6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���7", true, true, false)){set.SetItem("Text",frm.g7_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m1", true, true, false)){set.SetItem("Text",frm.g1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m2", true, true, false)){set.SetItem("Text",frm.g2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m3", true, true, false)){set.SetItem("Text",frm.g3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m4", true, true, false)){set.SetItem("Text",frm.g4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m5", true, true, false)){set.SetItem("Text",frm.g5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m6", true, true, false)){set.SetItem("Text",frm.g6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���m7", true, true, false)){set.SetItem("Text",frm.g7.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻����", true, true, false)){set.SetItem("Text",frm.b1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻�߰�", true, true, false)){set.SetItem("Text",frm.b2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻����", true, true, false)){set.SetItem("Text",frm.b3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����", true, true, false)){set.SetItem("Text",frm.b4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��߰�", true, true, false)){set.SetItem("Text",frm.b5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰�����", true, true, false)){set.SetItem("Text",frm.b6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.b7.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1", true, true, false)){set.SetItem("Text",frm.e1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2", true, true, false)){set.SetItem("Text",frm.e2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3", true, true, false)){set.SetItem("Text",frm.e3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4", true, true, false)){set.SetItem("Text",frm.e4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ5", true, true, false)){set.SetItem("Text",frm.e5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ6", true, true, false)){set.SetItem("Text",frm.e6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ7", true, true, false)){set.SetItem("Text",frm.e7_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ8", true, true, false)){set.SetItem("Text",frm.e8_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ9", true, true, false)){set.SetItem("Text",frm.e9_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ10", true, true, false)){set.SetItem("Text",frm.e10_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ11", true, true, false)){set.SetItem("Text",frm.e11_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm1", true, true, false)){set.SetItem("Text",frm.e1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm2", true, true, false)){set.SetItem("Text",frm.e2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm3", true, true, false)){set.SetItem("Text",frm.e3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm4", true, true, false)){set.SetItem("Text",frm.e4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm5", true, true, false)){set.SetItem("Text",frm.e5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm6", true, true, false)){set.SetItem("Text",frm.e6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm7", true, true, false)){set.SetItem("Text",frm.e7.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm8", true, true, false)){set.SetItem("Text",frm.e8.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm9", true, true, false)){set.SetItem("Text",frm.e9.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm10", true, true, false)){set.SetItem("Text",frm.e10.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿm11", true, true, false)){set.SetItem("Text",frm.e11.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�������", true, true, false)){set.SetItem("Text",frm.v_sum.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���ο���", true, true, false)){set.SetItem("Text",frm.yun.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��", true, true, false)){set.SetItem("Text",frm.goyong.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����", true, true, false)){set.SetItem("Text",frm.health.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.hi2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼", true, true, false)){set.SetItem("Text",frm.tax_so.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ֹμ�", true, true, false)){set.SetItem("Text",frm.tax_jumin.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ����1", true, true, false)){set.SetItem("Text",frm.minus1_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����2", true, true, false)){set.SetItem("Text",frm.minus2_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����3", true, true, false)){set.SetItem("Text",frm.minus3_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����4", true, true, false)){set.SetItem("Text",frm.minus4_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����5", true, true, false)){set.SetItem("Text",frm.minus5_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����6", true, true, false)){set.SetItem("Text",frm.minus6_text.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����m1", true, true, false)){set.SetItem("Text",frm.minus1.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����m2", true, true, false)){set.SetItem("Text",frm.minus2.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����m3", true, true, false)){set.SetItem("Text",frm.minus3.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����m4", true, true, false)){set.SetItem("Text",frm.minus4.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����m5", true, true, false)){set.SetItem("Text",frm.minus5.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����m6", true, true, false)){set.SetItem("Text",frm.minus6.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�����հ�]", true, true, false)){set.SetItem("Text",frm.minus.value);act.Execute(set);}
		if(frm.comp_type.value=='D') {
			if (pHwpCtrl.MoveToField("[��Ÿ�հ�]", true, true, false)){set.SetItem("Text",frm.etc_sum.value);act.Execute(set);}
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
