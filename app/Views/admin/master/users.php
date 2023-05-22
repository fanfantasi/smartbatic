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
            url="<?= base_url('admin/getUsers') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="photo" width="10%" data-options="formatter:formatAvatars" align="center">Avatars</th>
                      <th field="email" width="20%">Email</th>
                      <th field="displayname" width="20%">Full Name</th>
                      <th field="level" width="15%">Level user</th>
                      <th field="sekolah" width="25%">Sekolah</th>
                      <th field="is_active" width="10%" align="left" data-options="formatter:formatDetailactive">Status</th>
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
                  <a href="javascript:void(0);" class="btn btn-default m-r-5" onclick="ActiveUsers()">
                    <i class="ti-lock"></i> Active
                  </a>
                  <a href="javascript:void(0);" class="btn btn-danger m-r-5" onclick="destroy()">
                    <i class="ti-minus"></i> Delete
                  </a>
                </div>
                
                <div class="col-sm-6 pull-right">
                    <input  id="search" placeholder="Please Enter Search a <?= $title;?>" class="easyui-textbox" style="width:60%;" align="right">
                    <a href="javascript:void(0);" id="btn_serach" class="btn btn-success m-r-5" onclick="doSearchData()">
                      <i class="ti-search"></i> Search
                    </a>
                </div>
            </div>
        </div>

        <div id="dialog-form" class="easyui-dialog" title="Add New Menu" style="width:45%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
            <form id="ff" class="easyui-form" method="post" data-options="novalidate:false">
                <div style="margin-bottom:10px">
                  <input class="easyui-textbox" name="email" style="width:100%" data-options="label:'Email:',required:true, labelPosition:'top'">
                </div>
                <div style="margin-bottom:10px">
                  <input id="pass" class="easyui-passwordbox" name="password" prompt="Password" iconWidth="28" style="width:100%" data-options="label:'Password:',required:false, labelPosition:'top'">
                </div>
                <div style="margin-bottom:10px">
                  <input class="easyui-textbox" name="displayname" style="width:100%" data-options="label:'Full Name:',required:true, labelPosition:'top'">
                </div>
                <div style="margin-bottom:10px">
                  <input class="easyui-textbox" name="is_level" id="is_level" style="width:100%" data-options="label:'Level User ',required:true, labelPosition:'top'">
                </div>
                <div style="margin-bottom:10px">
                  <input class="easyui-radiobutton" name="is_active" value="1" label="Status"> Ya
                  <input class="easyui-radiobutton" name="is_active" value="0" label=""> Tidak
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
    $('#is_level').combobox({
        url:'comboLevel',
        valueField:'_id',
        textField:'level',
        setText:'level'
    });
    var t = $('#search');
    t.textbox('textbox').bind('keydown', function(e){
       if (e.keyCode == 13){   
         $('#btn_serach').click();
       }
    });
  });
</script>