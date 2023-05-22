<div class="col-12">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title"><?= $title; ?></div>
      </div>
      <div class="ibox-body">
        <table id="dgGrid"
          style="min-height: 1020px;"
            toolbar="#toolbar" 
            class="easyui-datagrid" 
            rowNumbers="true" 
            pagination="true" 
            url="<?= base_url('admin/getLapKegiatan') ?>" 
            pageSize="15" 
            pageList="[10,15,20,50,75,100,125,150,200]" 
            nowrap="false" 
            singleSelect="true"
            data-options="
            collapsible:true,
            view:groupview,
            groupField:'nm_polda',
            groupFormatter:function(value,rows){
                return value + ' - ' + rows.length + '(s)';
            }">
              <thead>
                  <tr>
                      <th field="date" width="10%">Hari/Tanggal</th>
                      <th field="nm_polda" width="15%">Subsatgas</th>
                      <th field="kegiatan" width="12%">Bidang</th>
                      <th field="fungsi" width="12%">Jenis Kegiatan</th>
                      <th field="uraian" width="40%">Uraian</th>
                      <th field="file" width="15%" align="left" data-options="formatter:formatFile">Dokumentasi</th>
                  </tr>
              </thead>
          </table>
          
        <div id="toolbar" style="padding: 10px">
            <div class="row">
                <div class="col-sm-3">
                    <div id="filter_tgl" class="input-group" style="display: inline;">
                        <button class="btn btn-default" id="daterange-btn" style="line-height:16px;border:1px solid #ccc">
                            <i class="fa fa-calendar"></i> <span id="reportrange"><span> Pilih Tanggal</span></span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-3">
                    <input id="combowilayah" class="easyui-textbox" name="wilayah_id" style="width:100%" data-options="required:false, prompt:'Subsatgas'">
                </div>
                <div class="col-sm-2">
                    <input id="combokeg" class="easyui-textbox" name="keg_id" style="width:100%" data-options="required:false, prompt:'Bidang'">
                </div>
                <div class="col-sm-2">
                <select class="easyui-combobox" name="fungsi" style="width:90%;" id="combofungsi" data-options="prompt:'Jenis Kegiatan'">
                <option value=""></option>
                    <option value="Preemtif">Preemtif</option>
                    <option value="Preventif">Preventif</option>
                    <option value="Represif">Represif</option>
                    <option value="Pengawasan">Pengawasan</option>
                </select>
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0);"  id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
                    <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="doPrint('<?= base_url(); ?>/admin/laporanpdf')">Print</a>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function (){
     fm_filter_tgl();
     $('#combowilayah').combobox({
        url:'combowilayah',
        valueField:'_id',
        textField:'nm_polda',
        setText:'nm_polda'
    });
    $('#combokeg').combobox({
        url:'combokeg',
        valueField:'_id',
        textField:'kegiatan',
        setText:'kegiatan'
    });
    $("#combowilayah").combobox({
        onChange: function(value){
        doSearch();
        }
    });
    $("#combokeg").combobox({
        onChange: function(value){
        doSearch();
        }
    });
    $("#combofungsi").combobox({
        onChange: function(value){
            doSearch();
        }
    });
  });
</script>