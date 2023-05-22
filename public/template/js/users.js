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
			console.log(result);
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
	var pathparts = location.pathname.split('/');
    window.location = location.origin+'/'+pathparts[1].trim('/')+'/newuser';
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
	if (row.is_level !=1){
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Users: ' + row.displayname);
			$('#ff').form('load',row);
			$('#pass').passwordbox('setValue', '');
			url = 'updateUser?id='+row._id;
		}
	}else{
		Toast.fire({
			type: 'error',
			title: 'User '+row.displayname+' tidak bisa di edit.'
		  })
	}
}

function mulai(){
	var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to Active or Non Aktive ? '+ row.displayname,function(r){
            if (r){
                $.post('activeUsers',{id:row._id,'is_active':row.is_active},function(result){
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

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Users ? '+ row.username,function(r){
            if (r){
                $.post('destroyuser',{id:row._id},function(result){
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

function formatDetailactive(index, row){
	if (row.is_active == 1){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success"><i class="ti-face-smile"></i> Active</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text text text-danger"><i class="ti-face-sad"></i> Non Active</span></span>';
	}
}

function formatAvatars(index,row){
	if (row.avatar == '' || row.avatar == null){
		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="../uploads/avatars/profil.png" width="25"></a>';		
	}else{
		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="'+row.avatar+'" width="25" height="20"></a>';
	}
}