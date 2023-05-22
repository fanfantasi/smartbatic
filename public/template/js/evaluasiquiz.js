function doSearchData(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val(),
        sekolahid: $('#combosekolah').val(),
        materiid: $('#combomateri').val()
	});
}
function formatbath(index, row){
	if (row.batch == 0){
		return '<span class="l-btn-left"><span class="l-btn-text text text-success">Semua</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text text text-danger">'+row.batch+'</span></span>';
	}
}
function formatNilai(index, row){
	return row.correct/row.quix * 100;
}
