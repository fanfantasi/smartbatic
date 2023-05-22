function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val(),
        sekolahid: $('#combosekolah').val()
	});
}

function formatFile(index,row){
	return '<a href="#" onclick="window.open(\'http://192.168.1.10:8082/api/sertifikat/pdf/'+row.file+'\', \'_blank\', \'fullscreen=yes\'); return false;"><img src="../uploads/file.png" width="25"></a>';
}

function formatAvatars(index,row){
	if (row.avatar == '' || row.avatar == null){
		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="../uploads/avatars/profil.png" width="25"></a>';		
	}else{
		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="'+row.avatar+'" width="25" height="20"></a>';
	}
}

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Sertifikat ? '+ row.displayname,function(r){
            if (r){
                $.post('destroysertifikat',{id:row._id},function(result){
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