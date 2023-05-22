function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val(),
        thema: $('#combotopikAll').val()
	});
}

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Esay');
	$('#ff').form('clear');
	url = 'saveesay';
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
	if (row){
		if (row.is_active != 0){
			Toast.fire({
				type: 'error',
				title: 'Soal Quiz sudah tidak bisa di edit.'
			  })
		}else{
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Esay: ' + row._id);
			$('#ff').form('load',row);
			url = 'updateesay?id='+row._id;
		}
		
	}else{
		Toast.fire({
			type: 'error',
			title: 'Silahkan pilih Soal Esay untuk diedit.'
		  })
	}
}

function submitForm(){
	var string = $("#ff").serialize();
	$('#ff').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		beforeSend:function(){
			$('.box').jmspinner('large');	    
		},
		success: function(result){
			$('.box').jmspinner(false);
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

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        if (row.is_active == 2){
            Toast.fire({
                type: 'error',
                title: 'Esay Sudah Tidak Bisa di Hapus.'
            });
        }else if (row.is_active == 1){
            Toast.fire({
                type: 'error',
                title: 'Esay Sudah Tidak Bisa di Hapus.'
            });
        }else{
            $.messager.confirm('Confirm','Are you sure you want to destroy this Esay ? ',function(r){
                if (r){
                    $.post('destroyesay',{id:row._id},function(result){
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