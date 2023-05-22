<div class="col-12">
	<div class="ibox">
	    <div class="ibox-head">
	        <div class="ibox-title"><?= $title; ?></div>
	    </div>
	    <div class="ibox-body">
	    	<table id="dgGrid"
			style="min-height: 520px;"
            toolbar="#toolbar" 
            class="easyui-datagrid" 
            rowNumbers="true" 
            pagination="true" 
            url="<?= base_url('admin/getLevel') ?>" 
            pageSize="10" 
            pageList="[10,15, 20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="level" width="100%">Level</th>
                  </tr>
              </thead>
          	</table>
          	<div id="toolbar" style="padding: 10px">
              <div class="row ml-1">
                  <div class="col-sm-6">
                  	<a href="javascript:void(0);" class="btn btn-info m-r-5" onclick="newForm()">
                  		<i class="ti-plus"></i> New
                  	</a>
                  	<a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="editForm()">
                  		<i class="ti-pencil-alt"></i> Edit
                  	</a>
                  	<a href="javascript:void(0);" class="btn btn-danger m-r-5" onclick="destroyLevel()">
                  		<i class="ti-minus"></i> Delete
                  	</a>
                    <a href="javascript:void(0);" class="btn btn-success m-r-5" onclick="setPermission()">
                      <i class="ti-link"></i> Set Permission
                    </a>
                  </div>
                  
                  <div class="col-sm-6 pull-right">
                      <input  id="search" placeholder="Please Enter Search a Level Users" class="easyui-textbox" style="width:60%;" align="right">
                      <a href="javascript:void(0);" id="btn_serach" class="btn btn-success m-r-5" onclick="doSearch()">
                  		<i class="ti-search"></i> Search
                  	  </a>
                  </div>
              </div>
            </div>
            <div id="dialog-form" class="easyui-dialog" title="Add New Menu" style="width:45%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
		      	<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
		      		<div style="margin-bottom:20px">
						<input class="easyui-textbox" name="level" style="width:100%" data-options="label:'Level Users ',required:true">
					</div>
					</form>
					<div id="dialog-buttons">
						<a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="javascript:jQuery('#dialog-form').dialog('close')">
	                  		<i class="ti-back-left"></i> Cancel
	                  	</a>
	                  	<a href="javascript:void(0);" class="btn btn-info m-r-5" onclick="submitForm()">
	                  		<i class="ti-save"></i> Save
	                  	</a>
					</div>
		    </div>
	    </div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$('#search').keyup(function(event){
	      if(event.keyCode == 13){
	        $('#btn_serach').click();
	      }
	    });
	});
</script>