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
            url="<?= base_url('admin/getquiz') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="true" 
            singleSelect="true"
            data-options="
            collapsible:true,
            view:groupview,
                groupField:'thema',
                groupFormatter:function(value,rows){
                return (value == null)?'Belum ditentukan':value + ' - ' + rows.length + ' (Quiz)';
            }">
              <thead>
                  <tr>
                      <!-- <th field="thema" width="20%">Topik Quiz</th> -->
                      <th field="question" width="80%">Pertanyaan</th>
                      <th field="answer" width="20%">Jawaban</th>
                  </tr>
              </thead>
          </table>
        <div id="toolbar" style="padding: 10px">
            <div class="row ml-1">
                <div class="col-sm-3">
                  <a href="javascript:void(0);" class="btn btn-info m-r-5" onclick="newForm()">
                    <i class="ti-plus"></i> Add Quiz
                  </a>
                  <a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="editForm()">
                    <i class="ti-pencil-alt"></i> Edit
                  </a>
                  <a href="javascript:void(0);" class="btn btn-danger m-r-5" onclick="destroy()">
                    <i class="ti-minus"></i> Delete
                  </a>
                  
                </div>
                <div class="col-sm-4">
                      <input id="combotopikAll" class="easyui-textbox" name="thema"  style="width:100%" data-options="required:false, prompt:'Topik Quiz',">
                  </div>

                <div class="col-sm-5 pull-right">
                    <input  id="search" placeholder="Please Enter Search a <?= $title;?>" class="easyui-textbox" style="width:60%;" align="right">
                    <a href="javascript:void(0);" id="btn_serach" class="btn btn-success m-r-5" onclick="doSearchData()">
                      <i class="ti-search"></i> Search
                    </a>
                </div>
            </div>
        </div>

        <div id="dialog-form" class="easyui-dialog" title="Add New Quiz" style="width:45%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
            <form id="ff" class="easyui-form" method="post" data-options="novalidate:false">
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Topik Quiz</label>
                    <div class="col-sm-8">
                    <input class="easyui-textbox" id="combotopik" name="topic_id" style="width:100%" data-options="required:true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Pertanyaan</label>
                    <div class="col-sm-8">
                        <input class="easyui-textbox" name="question" style="width:100%; height: 80px" data-options="required:true, multiline:true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Jawaban</label>
                    <div class="col-sm-8">
                        <input class="easyui-textbox" id="answer" name="answer" style="width:100%" data-options="required:true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Pilihan Jawaban</label>
                    <div class="col-sm-8">
                        <input class="easyui-tagbox" id="options" name="options[]" style="width:100%" data-options="required:true">
                    </div>
                </div>
                
          </form>
          <div id="dialog-buttons">
            <a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="javascript:jQuery('#dialog-form').dialog('close')">
              <i class="ti-back-left"></i> Cancel
            </a>
            <a href="javascript:void(0);" class="box btn btn-info m-r-5" onclick="submitForm()">
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
    $('#combotopik').combobox({
        url:'combotopik',
        valueField:'_id',
        textField:'thema',
        setText:'thema'
    });

    $('#combotopikAll').combobox({
        url:'combotopikAll',
        valueField:'_id',
        textField:'thema',
        setText:'thema'
    });
    $("#combotopikAll").combobox({
        onChange: function(value){
          doSearchData();
        }
    });
    var ans = $('#answer');
    $('#options').tagbox({
        tagFormatter: function(value,row){
            var opts = $(this).tagbox('options');
            return row ? row[opts.textField] : value;
        },
        tagStyler: function(value){
            if (value == ans.val()){
                return 'background:#b8eecf;color:#45872c';
            }
        }
    });
    
    
  });
</script>