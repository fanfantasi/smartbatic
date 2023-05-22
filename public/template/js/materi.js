function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val()
	});
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

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Materi');
	$('#ff').form('clear');
	url = 'saveMateri';
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit (' + row.materi + ')');
			$('#ff').form('load',row);
			url = 'updatemateri?id='+row._id;
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
        $.messager.confirm('Confirm','Are you sure you want to destroy this materi ? '+ row.materi,function(r){
            if (r){
                $.post('destroymateri',{id:row._id},function(result){
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
