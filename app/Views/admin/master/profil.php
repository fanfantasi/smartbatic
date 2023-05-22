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
			<input type="hidden" name="id" value="<?= $profil['_id']; ?>">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="email" name="email" value="<?= $profil['email']; ?>" placeholder="Email" autocomplete="off">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" id="full_name" name="displayname" value="<?= $profil['displayname']; ?>"  placeholder="Nama Lengkap" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ganti Password</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="password" name="password"  placeholder="Ganti Password" autocomplete="off">
                    <span class="span"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                	<a href="javascript:void(0)" class="btn btn-warning" onclick="backButton()"><i class="fa fa-history"></i> Back</a>
                    <button type="submit" onclick="kirim()" class="btn btn-primary">Submit</button>
                </div>
            </div>
		</form>
	</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        var password = $('#password').val();
        var email = $('#email').val();
        var full_name = $('#full_name').val();
        var photo = $('#photo').val();
        $("#form-users").on('submit',(function(e){
          e.preventDefault();
          $.ajax({
            url: "<?php echo base_url('admin/updateProfil')?>",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
              var result = eval('('+result+')');
                if (result.errorMsg){
                  Toast.fire({
                          type: 'error',
                          title: ''+result.errorMsg+'.'
                          })
                } else {
                  Toast.fire({
                            type: 'success',
                            title: ''+result.message+'.'
                          })
                }
            }
          });
        }));
    });
</script>