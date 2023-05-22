<div class="col-12" id="container">
	<div class="ibox">
	    <div class="ibox-head">
	        <div class="ibox-title"><?= $title; ?></div>
	    </div>
	    <div class="ibox-body">
	    	<div class="d-flex justify-content-between">
                <div class="col-sm-4">
                    <input id="combosekolah" class="easyui-textbox" style="width:100%" data-options="required:false, prompt:'Sekolah',">
                </div>
                <div class="col-sm-4">
                <form class="mail-search" action="javascript:;">
                    <div class="input-group">
                        <input class="form-control" type="text" id="search" style="width:100%" placeholder="Search Peserta">
                        <div class="input-group-btn">
                            <button class="btn btn-info" id="searchbtn">Search</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
           
            <hr>
            <h4 class="m-b-20 font-strong">Gallery Photo Hasil Membatik</h4>
            	<div class="loader loader-default"></div>
            	<div id="card">
            </div>
	    </div>
	</div>
</div>
<div id="dialog-image" class="easyui-dialog" title="Add New Menu" style="width:45%; padding:10px 10px 10px 10px;" data-options="closed:true,modal:true, border:'thin',shadow:false">
  	<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
  		<div style="margin-bottom:10px;">
           <input class="easyui-textbox" name="item_id" id="item_id" style="width:100%" data-options="label:'Title',required:true,">
        </div>
        <div style="margin-bottom:20px">
			<input class="easyui-filebox" name="photo_image" style="width:100%" data-options="label:'Image:',required:false">
		</div>
		</form>
		<div id="dialog-buttons">
		  <a href="javascript:void(0);" class="btn btn-warning m-r-5" onclick="javascript:jQuery('#dialog-image').dialog('close')">
                <i class="ti-back-left"></i> Cancel
          </a>
          <a href="javascript:void(0);" class="btn btn-info m-r-5" onclick="submitForm()">
            <i class="ti-save"></i> Save
          </a>
		</div>
</div>
<script src="<?= base_url('template/js/gallery.js?v='.date('YmdHis'));?>"></script>
<script type="text/javascript">
	$(document).ready(function (){
		showImages();
	});

    $('#searchbtn').click(function(){
        showImages();
    });
	function showImages()
	{
		$.ajax({
			type:'POST',
			url:'<?= base_url('admin/getgallery')?>',
			data:'search_data='+$('#search').val()+'&sekolahid='+$('#combosekolah').combobox('getValue'),
			cache: false,
			beforeSend:function(){
		    	if(!$(".loader").hasClass("is-active")){
	                $(".loader").addClass("is-active");
	            }	    
		    },
			success:function(response){
				if($(".loader").hasClass("is-active")){
                    $(".loader").removeClass("is-active");
                }
				$('#card').html(response)
			},
			error:function(e){
				if($(".loader").hasClass("is-active")){
                    $(".loader").removeClass("is-active");
                }
	        }
		});
	}
	$("#search").keydown(function(e){
        if (e.keyCode == 13){  
            $.ajax({
                type:'POST',
                url:'<?= base_url('admin/getgallery')?>',
                cache:false,
                data:'search_data='+$('#search').val()+'&sekolahid='+$('#combosekolah').combobox('getValue'),
                beforeSend:function(){
                    if(!$(".loader").hasClass("is-active")){
                        $(".loader").addClass("is-active");
                    }
                },
                success:function(response){
                    if($(".loader").hasClass("is-active")){
                        $(".loader").removeClass("is-active");
                    }
                    $('#card').html(response)
                },
                error:function(e){
                    if($(".loader").hasClass("is-active")){
                    $(".loader").removeClass("is-active");
                    }
                }
            });
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
            
            $.ajax({
                type:'POST',
                url:'<?= base_url('admin/getgallery')?>',
                cache:false,
                data:'search_data='+$('#search').val()+'&sekolahid='+value,
                beforeSend:function(){
                    if(!$(".loader").hasClass("is-active")){
                        $(".loader").addClass("is-active");
                    }
                },
                success:function(response){
                    if($(".loader").hasClass("is-active")){
                        $(".loader").removeClass("is-active");
                    }
                    $('#card').html(response)
                },
                error:function(e){
                    if($(".loader").hasClass("is-active")){
                    $(".loader").removeClass("is-active");
                    }
                }
            });
        }
    });
</script>