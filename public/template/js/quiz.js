function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val(),
        thema: $('#combotopikAll').val()
	});
	console.log($('#combotopikAll').val());
}

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Quiz');
	$('#ff').form('clear');
	url = 'savequiz';
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
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Quiz: ' + row._id);
			$('#ff').form('load',row);
			url = 'updatequiz?id='+row._id;
		}
		
	}else{
		Toast.fire({
			type: 'error',
			title: 'Silahkan pilih Soal Quiz untuk diedit.'
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
                title: 'Quiz Sudah Tidak Bisa di Hapus.'
            });
        }else if (row.is_active == 1){
            Toast.fire({
                type: 'error',
                title: 'Quiz Sudah Tidak Bisa di Hapus.'
            });
        }else{
            $.messager.confirm('Confirm','Are you sure you want to destroy this Quiz ? ',function(r){
                if (r){
                    $.post('destroyquiz',{id:row._id},function(result){
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