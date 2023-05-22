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
            url="<?= base_url('admin/getevaluasiesay') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true"
            data-options="
            toolbar:toolbar,
            collapsible:true,
            view:groupview,
                groupField:'materi',
                groupFormatter:function(value,rows){
                return (value == null)?'Belum ditentukan':value + ' - ' + rows.length + ' (Peserta)';
            }">
              <thead>
                  <tr>
                      <th field="userid" width="10%">NIS/NIM</th>
                      <th field="email" width="15%">Email</th>
                      <th field="displayname" width="20%">Nama Lengkap</th>
                      <th field="jenjang" width="10%">Jenjang Pendidikan</th>
                      <th field="sekolah" width="15%">Sekolah</th>
                      <th field="materi" width="20%">Materi</th>
                      <th field="soal" width="5%" align="center">Soal</th>
                      <th field="correct" width="5%" align="center">Hasil</th>
                  </tr>
              </thead>
          </table>
        <div id="toolbar" style="padding: 10px">
            <div class="d-flex justify-content-between">
                <div class="row col-sm-6">
                    <div class="col-md-6">
                        <input id="combosekolah" class="easyui-textbox" style="width:100%" data-options="required:false, prompt:'Sekolah',">
                    </div>
                    <div class="col-md-6">
                        <input id="combomateri" class="easyui-textbox" style="width:100%" data-options="required:false, prompt:'Materi',">
                    </div>
                </div>
                <div class="col-sm-4">
                <form class="mail-search" action="javascript:;">
                    <div class="input-group">
                      <input  id="search" placeholder="Please Enter Search a <?= $title;?>" class="easyui-textbox" style="width:60%;" align="right">
                      <a href="javascript:void(0);" id="btn_serach" class="btn btn-success m-r-5" onclick="doSearchData()">
                        <i class="ti-search"></i> Search
                      </a>
                    </div>
                </form>
                </div>
            </div>
            <div class="d-flex" style="padding-top: 10px" id="correct">
                <div class="col-sm-6">
                  <a href="javascript:void(0);" class="btn btn-info m-r-5" onclick="newForm()">
                    <i class="ti-plus"></i> Koreksi
                  </a>
                  <a href="javascript:void(0);" class="btn btn-danger m-r-5" onclick="destroy()">
                    <i class="ti-minus"></i> Delete
                  </a>
                </div>
            </div>
        </div>
        <div id="dialog-form" class="easyui-dialog" title="Add New Module Pembelajaran" style="width:65%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
            <table id="dgGridDialog" style="min-height: 520px;">
                <thead>
                    <tr>
                        <th field="question" width="45%">Pertanyaan</th>
                        <th field="answer" width="35%">Jawaban</th>
                        <th field="correct" width="20%" data-options="align:'right', editor:'numberbox'">Nilai</th>
                    </tr>
                </thead>
            </table>
          <div id="dialog-buttons" style="padding-top: 10px">
            <a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="javascript:jQuery('#dialog-form').dialog('close')">
              <i class="ti-back-left"></i> Cancel
            </a>
            <a href="javascript:void(0);" class="btn btn-info m-r-5" onclick="submitCorrect()">
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
    $('#combomateri').combobox({
        url:'combomateri',
        valueField:'_id',
        textField:'materi',
        setText:'materi'
    });
    $("#combomateri").combobox({
        onChange: function(value){
          doSearchData();
        }
    });
  });
</script>