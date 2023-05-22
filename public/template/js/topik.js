function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val()
	});
}

function formatbath(index, row){
	if (row.batch == 0){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success">Semua</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text text text-danger">'+row.batch+'</span></span>';
	}
}

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Topik');
	$('#ff').form('clear');
	url = 'savetopik';
}

function submitForm(){
	var string = $("#ff").serialize();
	$('#ff').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
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
				$('#dialog-form').dialog('close');		// close the dialog
				$('#dgGrid').datagrid('reload');	// reload the user data
			}
		}
	});
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
            $('#dialog-form').dialog('open').dialog('setTitle','Edit Topik (' + row.thema + ')');
                $('#ff').form('load',row);
                url = 'updatetopik?id='+row._id;
		}else{
			Toast.fire({
				type: 'error',
				title: 'Please Select data.'
			});
		}
}

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        if (row.is_active == 2){
            Toast.fire({
                type: 'error',
                title: 'Topik Quiz Sudah Tidak Bisa di Hapus.'
            });
        }else if (row.is_active == 1){
            Toast.fire({
                type: 'error',
                title: 'Topik Quiz Sudah Tidak Bisa di Hapus.'
            });
        }else{
            $.messager.confirm('Confirm','Are you sure you want to destroy this Topik ? '+ row.thema,function(r){
                if (r){
                    $.post('destroytopik',{id:row._id},function(result){
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
        }
    }else{
		Toast.fire({
			type: 'error',
			title: 'Please Select data.'
		});
	}
}

function formatDetailactive(index, row){
	if (row.is_active == 1){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success"><i class="ti-face-smile"></i> Mulai</span></span>';
	}else if(row.is_active == 0){
		return '<span class="l-btn-left"><span class="l-btn-text text text-info"><i class="ti-face-sad"></i> Belum Mulai</span></span>';
	}else{
        return '<span class="l-btn-left"><span class="l-btn-text text text-danger"><i class="ti-face-sad"></i> Selesai</span></span>';
    }
}

function mulai(){
	var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        if (row.is_active == 0){
            $.messager.confirm('Confirm','Apakah yakin akan memulai quiz untuk topik ini? ',function(r){
                if (r){
                    $.post('mulaiquiz',{id:row._id},function(result){
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
                title: 'Topik Quiz ini tidak bisa dimulai.'
            });
        }
        
    }
}

function selesai(){
	var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        if (row.is_active == 1){
            $.messager.confirm('Confirm','Apakah yakin akan mengakhiri quiz untuk topik ini? ',function(r){
                if (r){
                    $.post('selesaiquiz',{id:row._id},function(result){
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
                title: 'Topik Quiz ini tidak bisa dibuah ke selesai.'
            });
        }
        
    }
}