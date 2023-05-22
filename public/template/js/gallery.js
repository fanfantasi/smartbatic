function submitForm(){
	var string = $("#ff").serialize();
	var spinner = new jQuerySpinner({
        parentId: 'container'
      });
	spinner.show();
	$('#ff').form('submit',{
		url: url,
		onSubmit: function(){
			spinner.hide();
			return $(this).form('validate');
		},
		success: function(result){
			spinner.hide();
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
				$('#dialog-image').dialog('close');
			    showImages();	
			}
		}
	});
}

function newForm(){
	$('#dialog-image').dialog('open').dialog('setTitle','Add New Image Banner');
	$('#ff').form('clear');
	url = 'saveItemImage';
}

function destroyImageItem(e){
    if (e){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Image Item Selected ? ',function(r){
            if (r){
            	var spinner = new jQuerySpinner({
			        parentId: 'container'
			      });
				spinner.show();
                $.post('destroyImageItem',{id:e},function(result){
                	spinner.hide();
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
                        showImages();
                    }
                },'json');
            }
        });
    }
}

