function doSearch(){
	$('#dgGrid').datagrid('load',{
		search_level: $('#search').val()
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
	$('#dialog-form').dialog('open').dialog('setTitle','Add New LEvel Users');
	$('#ff').form('clear');
	url = 'saveLevel';
}

function setPermission(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			window.location.replace("permission/"+row._id);
		}
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Level' + row.level);
			$('#ff').form('load',row);
			url = 'updateLevel?id='+row._id;
		}
}

function destroyLevel(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Level ? '+ row.level,function(r){
            if (r){
                $.post('destroyLevel',{id:row._id},function(result){
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
}