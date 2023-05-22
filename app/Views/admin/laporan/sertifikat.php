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
            url="<?= base_url('admin/getsertifikat') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="avatar" width="10%" data-options="formatter:formatAvatars" align="center">Avatars</th>
                      <th field="userid" width="10%">NIS/NIM</th>
                      <th field="displayname" width="20%">Nama Peserta</th>
                      <th field="sekolah" width="20%">Asal Sekolah</th>
                      <th field="jurusan" width="20%">Jurusan/Program Study</th>
                      <!-- <th field="file" width="30%">File</th> -->
                      <th field="file" width="20%" align="center" data-options="formatter:formatFile">Lihat</th>
                  </tr>
              </thead>
          </table>
        <div id="toolbar" style="padding: 10px">
            <div class="row ml-1">
                <div class="col-sm-4">
                    <input id="combosekolah" class="easyui-textbox" style="width:100%" data-options="required:false, prompt:'Sekolah',">
                </div>
                <div class="col-sm-2">
                  <a href="javascript:void(0);" class="btn btn-danger m-r-5" onclick="destroy()">
                    <i class="ti-minus"></i> Delete
                  </a>
                  <a href="javascript:void(0);" class="btn btn-success m-r-5" onclick="ActiveUsers()">
                    <i class="ti-export"></i> Export
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