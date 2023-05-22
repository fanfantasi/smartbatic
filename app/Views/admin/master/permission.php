<section class="content-header"></section>
<div class="col-12">
    <div class="card">
    <!-- BEGIN card-body -->
        <div class="card-body">
            <div id="error-msg" class="p-b-10">

            </div>
            <div class="p-b-10 ">
            <a href="<?php echo base_url('admin/level') ?>" class="btn btn-warning"> Kembali</a>
            </div>
            <table id="dgGrid"
	            toolbar="#toolbar" 
	            class="easyui-treegrid"
	            url="<?= base_url('admin/getPermission/'.$leveluser.'')?>"
	            nowrap="false"
	            singleSelect="false"
	            data-options="
	            	checkbox:true,
	                rownumbers: true,
	                idField: '_id',
	                treeField: 'title',
	                showFooter:true,
	                animate:true,
	                cascadeCheck:true
            	">
	              <thead>
	                  <tr>
	                      <th field="title" width="80%">Title</th>
	                      <th field="icon" width="20%" data-options="formatter:formaticon">Icon</th>
	                  </tr>
	              </thead>
	        </table>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('#dgGrid').treegrid({
      rowStyler:function(index,row){
          if (index._parentId == null){
              return 'background-color:#f8f9fa; color:#343a40; font-weight:bold;';
          }
      }
    });
	$('#dgGrid').treegrid({
      onCheckNode:function(row,checked){
      	if (row.children){
      		if (row.checked == false){
      			for(var i=0; i<row.children.length; i++){
      				console.log(row.children[i].title)
	      			$.ajax({
		                type: "POST",
		                url : "<?= base_url('admin/deletedPermission')?>",
		                data: {user_level:<?= $leveluser;?>,menu_id:row.children[i]._id},
		                success: function(msg){
		                    var msg = eval('('+msg+')');
		                    if (msg.errorMsg){
		                        toastr.error(msg.errorMsg+ ' error');
		                        toastr.options={
		                        	"progressBar": true,
		                        }
		                    } else {
		                        toastr.success(msg.message +' success');
		                        toastr.options={
		                        	"progressBar": true,
		                        }
		                    }
		                },
		                error:function(msg)
		                {
		                    toastr.error('Some errors occured.');
	                        toastr.options={
	                        	"progressBar": true,
	                        }
		                }
		            }); 
      			}
      		}else{
      			for(var i=0; i<row.children.length; i++){
					$.ajax({
		                type: "POST",
		                url : "<?= base_url('admin/insertPermission')?>",
		                data: {user_level:<?= $leveluser;?>,menu_id:row.children[i]._id},
		                success: function(msg){
		                    var msg = eval('('+msg+')');
		                    if (msg.errorMsg){
		                        toastr.error(msg.errorMsg+' error');
		                        toastr.options={
		                        	"progressBar": true,
		                        }
		                    } else {
		                        toastr.success(msg.message+' success');
		                        toastr.options={
		                        	"progressBar": true,
		                        }
		                    }
		                },
		                error:function(msg)
		                {
		                    toastr.error('Some errors occured.');
	                        toastr.options={
	                        	"progressBar": true,
	                        }
		                }
		            }); 
				}
      		}
      	}else{
      	  if (row.checked == false){
             $.ajax({
                type: "POST",
                url : "<?= base_url('admin/deletedPermission')?>",
                data: {user_level:<?= $leveluser;?>,menu_id:row._id},
                success: function(msg){
                    var msg = eval('('+msg+')');
                    if (msg.errorMsg){
                        toastr.error(msg.errorMsg+' '+row.title+' error');
                        toastr.options={
                        	"progressBar": true,
                        }
                    } else {
                        toastr.success(msg.message+' '+row.title+' success');
                        toastr.options={
                        	"progressBar": true,
                        }
                    }
                },
                error:function(msg)
                {
                    toastr.error('Some errors occured.');
                    toastr.options={
                    	"progressBar": true,
                    }
                }
            }); 
          }else{
            $.ajax({
                type: "POST",
                url : "<?= base_url('admin/insertPermission')?>",
                data: {user_level:<?= $leveluser;?>,menu_id:row._id},
                success: function(msg){
                    var msg = eval('('+msg+')');
                    if (msg.errorMsg){
                        toastr.error(msg.errorMsg+' '+row.title+' error');
                        toastr.options={
                        	"progressBar": true,
                        }
                    } else {
                        toastr.success(msg.message+' '+row.title+' success');
                        toastr.options={
                        	"progressBar": true,
                        }
                    }
                },
                error:function(msg)
                {
                    toastr.error('Some errors occured.');
                    toastr.options={
                    	"progressBar": true,
                    }
                }
            }); 
          }
      	}
      }
    });

	function formaticon(index, row){
		if (row.icon != null){
			return '<i class="'+row.icon+'"></i>';
		}
	}
</script>