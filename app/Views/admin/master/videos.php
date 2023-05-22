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
            url="<?= base_url('admin/getvideos') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="title" width="40%">Video</th>
                      <th field="materi" width="30%">Materi</th>
                      <th field="batch" width="10%" align="center" data-options="formatter:formatbath">Kelompok</th>
                      <th field="read" width="10%" align="center">Read</th>
                      <th field="url" width="10%" align="center" data-options="formatter:formatFile">Lihat</th>
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
        <div id="dialog-form" class="easyui-dialog" title="Add New Module Pembelajaran" style="width:45%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
            <form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Nama Video</label>
                    <div class="col-sm-8">
                        <input class="easyui-textbox" name="title" style="width:100%" data-options="required:true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Materi</label>
                    <div class="col-sm-8">
                      <input id="combomateri" name="materiid" class="easyui-textbox" style="width:100%" data-options="required:true, prompt:'Materi',">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Kelompok</label>
                    <div class="col-sm-8">
                        <input class="easyui-numberbox" name="batch" value="0" style="width:100%" data-options="required:true">
                        <span class="text text-danger">Isi 0 untuk Semua Kelompok</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">URL Video Youtube</label>
                    <div class="col-sm-8">
                        <input class="easyui-textbox" name="url" style="width:100%" data-options="required:true">
                        <span class="text text-danger">https://www.youtube.com/watch?v=BLxrfNp4Oak Copy Url Hanya yang ini = BLxrfNp4Oak</span>
                    </div>
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
    var t = $('#search');
    t.textbox('textbox').bind('keydown', function(e){
       if (e.keyCode == 13){   
         $('#btn_serach').click();
       }
    });
    $('#combomateri').combobox({
        url:'combomateri',
        valueField:'_id',
        textField:'materi',
        setText:'materi'
    });
  });
</script>