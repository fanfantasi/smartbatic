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
            url="<?= base_url('admin/getpeserta') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="userid" width="10%">NIS/NIM</th>
                      <th field="email" width="20%">Email</th>
                      <th field="displayname" width="20%">Nama Lengkap</th>
                      <th field="jenjang" width="10%">Jenjang Pendidikan</th>
                      <th field="sekolah" width="20%">Sekolah</th>
                      <th field="jurusan" width="15%">Jurusan</th>
                      <th field="batch" width="5%" data-options="formatter:formatbath">Kelompok</th>
                      <th field="is_active" width="8%" data-options="formatter:formatDetailactive">Status</th>
                  </tr>
              </thead>
          </table>
        <div id="toolbar" style="padding: 10px">
            <div class="row ml-1">
                <div class="col-sm-2">
                  <a href="javascript:void(0);" class="btn btn-default m-r-5" onclick="ActiveUsers()">
                    <i class="ti-lock"></i> Active
                  </a>
                </div>
                <div class="col-sm-4">
                    <input id="combosekolah" class="easyui-textbox" style="width:100%" data-options="required:false, prompt:'Sekolah',">
                </div>
                
                <div class="col-sm-6 pull-right">
                    <input  id="search" placeholder="Please Enter Search a <?= $title;?>" class="easyui-textbox" style="width:60%;" align="right">
                    <a href="javascript:void(0);" id="btn_serach" class="btn btn-success m-r-5" onclick="doSearchData()">
                      <i class="ti-search"></i> Search
                    </a>
                </div>
            </div>
        </div>
        <div id="dialog-form" class="easyui-dialog" title="Aktivasi Peserta" style="width:45%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
            <form id="ff" class="easyui-form" method="post" data-options="novalidate:false">
              <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="userid" style="width:100%" data-options="label:'NIS/NIM :',required:false,labelPosition:'left', labelWidth:200, labelAlign:'right'">
              </div>
              <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="displayname" style="width:100%" disabled="true" data-options="label:'Nama Peserta :',required:true,labelPosition:'left', labelWidth:200, labelAlign:'right'">
              </div>
              <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="email" style="width:100%" disabled="true" data-options="label:'Email :',required:true,labelPosition:'left', labelWidth:200, labelAlign:'right'">
              </div>
              <div style="margin-bottom:20px">
                <input class="easyui-textbox" id="combosekolah_id" name="sekolahid" style="width:100%" data-options="label:'Sekolah :',required:true,labelPosition:'left', labelWidth:200, labelAlign:'right'">
              </div>
              <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="jurusan" style="width:100%" data-options="label:'Jurusan/Program Studi :',required:false,labelPosition:'left', labelWidth:200, labelAlign:'right'">
              </div>
              <div style="margin-bottom:20px">
                <input class="easyui-numberbox" name="batch" style="width:100%" value="0" data-options="label:'Kelompok :',required:true,labelPosition:'left', labelWidth:200, labelAlign:'right'">
              </div>
              <div style="margin-bottom:20px">
                <input class="easyui-radiobutton" name="is_active" value="1" data-options="label:'Status :',required:true,labelPosition:'left', labelWidth:200, labelAlign:'right'"> Ya
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
    var t = $('#search');
    t.textbox('textbox').bind('keydown', function(e){
       if (e.keyCode == 13){   
         $('#btn_serach').click();
       }
    });
    $('#combosekolah_id').combobox({
        url:'combosekolah',
        valueField:'_id',
        textField:'sekolah',
        setText:'sekolah'
    });
    $('#combosekolah').combobox({
        url:'combosekolah',
        valueField:'_id',
        textField:'sekolah',
        setText:'sekolah'
    });
    $("#combosekolah").combobox({
        onChange: function(value){
          doSearchData();
        }
    });
  });
</script>