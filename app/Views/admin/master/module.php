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
            url="<?= base_url('admin/getmodule') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="title" width="50%">Module</th>
                      <th field="batch" width="10%" align="center" data-options="formatter:formatbath">Kelompok</th>
                      <th field="jenjang" width="10%">Jenjang</th>
                      <th field="read" width="10%" align="center">Read</th>
                      <!-- <th field="file" width="30%">File</th> -->
                      <th field="file" width="20%" align="center" data-options="formatter:formatFile">Lihat</th>
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
                    <label class="col-sm-3 control-label">Nama Module</label>
                    <div class="col-sm-8">
                        <input class="easyui-textbox" name="title" style="width:100%" data-options="required:true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Kelompok</label>
                    <div class="col-sm-8">
                        <input class="easyui-numberbox" name="batch" value="0" style="width:100%" data-options="required:true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Jenjang Pendidikan</label>
                    <div class="col-sm-8">
                        <select class="easyui-combobox" name="jenjang" data-options="required:true" style="width:100%">
                            <option value="SD">Sekolah Dasar</option>
                            <option value="SMP">Sekolah Menengah Pertama</option>
                            <option value="SMA">Sekolah Menengah Atas</option>
                            <option value="PT">Perguruan Tinggi</option>
                        </select>
                    </div>
                </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">File Module</label>
                <div class="col-sm-8">
                  <input class="form-control easyui-filebox" name="file" style="width:100%" data-options="required:false">
                  <span class="text text-danger">Extensi File PDF *)</span>
                </div>
              </div>
          </form>
          <div id="dialog-buttons">
            <a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="javascript:jQuery('#dialog-form').dialog('close')">
              <i class="ti-back-left"></i> Cancel
            </a>
            <!-- <div class="box well"></div> -->
            <a href="javascript:void(0);" class="box btn btn-info m-r-5" onclick="submitFormAjax()">
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


  });
</script>