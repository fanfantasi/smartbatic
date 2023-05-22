<div class="col-12">
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title"><?= $title;?></div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
    	<div id="error_msg"></div>
		<form class="form-horizontal" id="form-users" method="post" action="javascript:;" enctype="multipart/form-data" novalidate="novalidate">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input class="form-control" type="password" name="password" id="password" placeholder="password" autocomplete="off">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="full_name" id="full_name" placeholder="Nama Lengkap" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level User</label>
                <div class="col-sm-4">
                    <select class="form-control" id="select2_level" name="is_level">
                    <option value=""></option>
                    <?php foreach ($level as $row) : ?>
                        <option value="<?= $row['_id'];?>"><?= $row['level'];?></option>
                  	<?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-4">
                    <div class="radio icheck-primary">
                        <input type="radio" value="1" name="is_active" checked>
                        <label for="1">Aktif</label>
                    </div>
                    <div class="radio icheck-primary">
                        <input type="radio"  value="0" name="is_active">
                        <label for="0">Tidak Aktif</label>
                  </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Photo</label>
                <div class="col-sm-4">
                    <input class="form-control" type="file" name="photo" placeholder="Photo">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                	<a href="javascript:void(0)" class="btn btn-warning" onclick="backButton()"><i class="fa fa-history"></i> Back</a>
                    <button class="btn btn-info submit" type="botton" name="submit"> <i class="fa fa-save"></i> Submit</button>
                </div>
            </div>
		</form>
	</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $("#select2_level").select2({
            placeholder: "Select a Level Users",
            allowClear: true
        });
        $("#form-users").validate({
            rules: {
                full_name:{
                    required: !0,
                    minlength: 2
                },
                email:{
                    required: !0,
                    email: true,
                    remote:{
                        url:"<?= base_url('admin/getUserByEmail')?>",
                        type:"POST",
                        data: { 
                            q:function(){
                                return $( "#email" ).val();
                            }
                        },
                        dataType: 'json'
                    }
                }
            },
            messages:{
                full_name:{
                    required:"Nama Lengkap Harus Diisi",
                    minlength:"Nama Lengkap Minimal 2 Karakter"
                },
                email:{
                    required: "Alamat Email Harus Diisi",
                    email: "Alamat Email Tidak Valid",
                    remote: "Alamat Email Sudah Digunakan, Mohon Diganti."
                },
            },
            errorClass: "help-block error",
            highlight: function(e) {
                $(e).closest(".form-group.row").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group.row").removeClass("has-error")
            },
            submitHandler:function(form){
                var fd = new FormData(form);
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/saveUsers')?>",
                    data: fd,
                    enctype: 'multipart/form-data',
                    processData: false,  // Important!
                    contentType: false,
                    cache: false,
                    success: function(msg){
                        var msg = eval('('+msg+')');
                        if (msg.errorMsg){
                            Toast.fire({
                              type: 'error',
                              title: ''+msg.errorMsg+'.'
                              })
                        } else {
                            Toast.fire({
                              type: 'success',
                              title: ''+msg.message+'.'
                            })
                            window.setTimeout(function(){
                              window.location.href="<?= base_url('admin/users')?>";
                            },1000);
                        }
                    },
                    error:function(msg)
                    {
                        console.log(msg);
                    }
                }); 
            }
        });
    });
    
    function backButton()
    {
        var pathparts = location.pathname.split('/');
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/users';
    }
</script>