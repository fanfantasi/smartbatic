function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val(),
        sekolahid: $('#combosekolah').val()
	});
}
function formatDetailactive(index, row){
	if (row.is_active == 1){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success"><i class="ti-face-smile"></i> Active</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text text text-danger"><i class="ti-face-sad"></i> Non Active</span></span>';
	}
}

function ActiveUsers(){
	var row = $('#dgGrid').datagrid('getSelected');
	if (row){
        $('#dialog-form').dialog('open').dialog('setTitle','Aktivasi Peserta: ' + row.displayname);
        $('#ff').form('load',row);
        url = 'aktivasipeserta?id='+row._id;
    }else{
        Toast.fire({
            type: 'error',
            title: 'Silahkan Pilih Peserta yang akan di aktifkan.'
        })
    }
}

function formatbath(index, row){
	if (row.batch == 0){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success">Semua</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text text text-danger">'+row.batch+'</span></span>';
	}
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