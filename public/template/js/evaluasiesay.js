function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val(),
        sekolahid: $('#combosekolah').val(),
        materiid: $('#combomateri').val()
	});
}
function formatbath(index, row){
	if (row.batch == 0){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success">Semua</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text text text-danger">'+row.batch+'</span></span>';
	}
}
function formatNilai(index, row){
	return row.correct/row.quix * 100;
}
function doSearchDataDialog(row){
    var dg = $('#dgGridDialog').datagrid({
        url: 'getevaluasianswers',
        pagination: false,
        clientPaging: false,
        remoteFilter: true,
        rownumbers: true
    });
	dg.datagrid('load',{
		uid: row.uid,
        topicid: row.topicid,
	});
}

function newForm(){
	var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $('#dialog-form').dialog('open').dialog('setTitle','Koreksi Soal (' + row.displayname + ')');
        doSearchDataDialog(row)
        $('#dgGridDialog').datagrid('enableCellEditing').datagrid('gotoCell', {
            index: 0,
            field: 'uid'
        });
    }else{
        Toast.fire({
            type: 'error',
            title: 'Please Select data.'
        });
    }
}

function submitCorrect(){
    var rows = $('#dgGridDialog').datagrid('getChanges');
    var correct=[];
    for (var i =0; i<rows.length; i++) {
        correct.push({id:rows[i].id,uid:rows[i].uid,topicid:rows[i].topicid,esayid:rows[i].esayid,answer:rows[i].answer,correct:rows[i].correct});
    }
    if (correct.length == 0){
        $.messager.alert('Warning','Tidak ada data yang disimpan. :(');
    }else{
        $.ajax({
            url     : 'saveAnswerEsay',
            type    : 'POST',
            data    : {kondisi: JSON.stringify(correct)},
            dataType: 'json',
            success : function (result) 
            {
                if (result.message){
                    Toast.fire({
                      type: 'success',
                      title: ''+result.message+'.'
                    })
                }else{
                    Toast.fire({
                      type: 'error',
                      title: ''+result.errorMsg+'.'
                     })
                }
                $('#dialog-form').window('close');
            }
        });
    }
}

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Answer Esay ? '+ row.displayname,function(r){
            if (r){
                $.post('destroyAnswer',{uid:row.uid, topicid:row.topicid},function(result){
                    if (result.errorMsg){
                        Toast.fire({
			              type: 'error',
			              title: ''+result.errorMsg+'.'
			            })
                    } else {
                        Toast.fire({
		                  type: 'success',
		                  title: ''+result.message+'.'
		                })
                        $('#dgGrid').datagrid('reload');
                    }
                },'json');
            }
        });
    }else{
		Toast.fire({
			type: 'error',
			title: 'Please Select data.'
		});
	}
}