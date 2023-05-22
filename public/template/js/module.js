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

function formatFile(index,row){
	return '<a href="#" onclick="window.open(\'http://192.168.1.5:8082/api/modules/pdf/'+row.file+'\', \'_blank\', \'fullscreen=yes\'); return false;"><img src="../uploads/file.png" width="25"></a>';
}

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Module');
	$('#ff').form('clear');
	url = 'http://192.168.1.5:8082/api/modules/add';
}


function submitFormAjax(){
	var frm = $('#ff');
	if (!frm.form('validate')) return;
	var data = new FormData();
	//Form data
	var form_data = frm.serializeArray();
	$.each(form_data, function (key, input) {
		data.append(input.name, input.value);
	});

	//File data
	var file_data = $('input[name="file"]')[0].files;
	if (file_data.length > 0){
		for (var i = 0; i < file_data.length; i++) {
			data.append("file", file_data[i]);
		}	
	}else{
		data.append("files", "");
	}

	//Custom data
	data.append('key', 'value');

	$.ajax({
		type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
		processData: false,
        contentType: false,
		beforeSend:function(){
			$('.box').jmspinner('large');	    
		},
		success: function (result) {
			$('.box').jmspinner(false);
			if (!result.status){
				Toast.fire({
	              type: 'error',
	              title: ''+result.result+'.'
	              })
			} else {
				Toast.fire({
                  type: 'success',
                  title: ''+result.result+'.'
                })
				$('#dialog-form').dialog('close');		// close the dialog
				$('#dgGrid').datagrid('reload');	// reload the user data
			}
        }
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

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Module (' + row.title + ')');
			$('#ff').form('load',row);
			url = 'http://192.168.1.5:8082/api/modules/edit/'+row._id;
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
        $.messager.confirm('Confirm','Are you sure you want to destroy this module ? '+ row.title,function(r){
            if (r){
                $.post('destroymodule',{id:row._id},function(result){
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