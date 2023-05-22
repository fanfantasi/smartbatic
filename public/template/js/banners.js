function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val()
	});
}

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Banners');
	$('#ff').form('clear');
	url = 'http://192.168.1.10:8082/api/banners/add';
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

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
	if (row){
        $('#dialog-form').dialog('open').dialog('setTitle','Edit Banner');
        $('#ff').form('load',row);
        $('#pass').passwordbox('setValue', '');
        url = 'http://192.168.1.10:8082/api/banners/edit/'+row._id;
    }
}

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Banner ? ',function(r){
            if (r){
                $.post('destroybanners',{id:row._id},function(result){
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

function formatBanners(index,row){
	if (row.image == '' || row.image == null){
		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="../uploads/avatars/profil.png" width="25"></a>';		
	}else{
		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="http://192.168.1.10:8082/uploads/banners/'+row.image+'" width="250" height="150"></a>';
	}
}

function formatFile(index,row){
	return '<a href="#" onclick="window.open(\''+row.url+'\', \'_blank\', \'fullscreen=yes\'); return false;"><img src="../uploads/photo.png" width="25"></a>';
}