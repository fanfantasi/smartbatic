<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title;?></title>
    <meta name="author" content="fan.fantasi@gmail.com">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/logo2.png" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.css">

    <link rel="stylesheet" href="<?= base_url('template/vendors/bootstrap/dist/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('template/vendors/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('template/vendors/themify-icons/css/themify-icons.css');?>">

    <link rel="stylesheet" href="<?= base_url('template/vendors/sweetalert2/sweetalert2.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('template/css/main.css');?>">
    <link rel="stylesheet" href="<?= base_url('template/loaderajax/jm.spinner.css');?>">
    </head>
	<body class="bg-image">
		<div class="content">
        <div class="brand">
		<img src="<?= base_url('logo.png');?>" width="215px" />
        </div>
        <div>

            <form class="text-center" id="lock-form" action="javascript:;" method="post">
                <h5 class="font-strong">SMART BATIK CLASS</h5>
                <p class="font-13">Your are in signin. Enter your username and password to login system</p>
                <div class="form-group">
	                <div class="input-group-icon right">
	                    <div class="input-icon"><i class="fa fa-users"></i></div>
	                    <input class="form-control" type="text" name="username" id="user" placeholder="Email or Username" autocomplete="off">
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="input-group-icon right">
	                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
	                    <input class="form-control" type="password" name="password" id="pass" placeholder="Password">
	                </div>
	            </div>
	            <div class="form-group">
	            	<div class="box well"></div>
	                <a href="javascript(0);" class="btn btn-info btn-block" type="submit" id="signin">Login</a>
	            </div>
            </form>
        </div>
        
    </div>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop login">
        <div class="page-preloader">Loading</div>
    </div>
    
    <style>
        .brand {
            font-size: 44px;
            text-align: center;
            margin: 40px 0;
        }

        .content {
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript" src="<?= base_url('template/vendors/jquery/dist/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('template/vendors/popper.js/dist/umd/popper.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('template/vendors/bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');?>"></script>
	<!-- SweetAlert2 -->
	<script type="text/javascript" src="<?= base_url('template/vendors/toastr/toastr.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('template/vendors/sweetalert2/sweetalert2.min.js');?>"></script>
	
	<script src="<?= base_url('template/loaderajax/jm.spinner.js');?>" type="text/javascript"></script>	

	<script src="<?= base_url('template/js/app.min.js');?>" type="text/javascript"></script>	
    <!-- PAGE LEVEL SCRIPTS-->
	<script type="text/javascript">
		$(document).ready(function (){
	    	const Toast = Swal.mixin({
		      toast: true,
		      position: 'top-end',
		      showConfirmButton: false,
		      timer: 3000
		    });
	     $(function() {
            $('#lock-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email:true
                    },
                    password:{
                    	required:true,
                    }
                },
                messages:{
                	email:'Please insert your email',
                	password:'Please insert your password.'
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
                errorPlacement: function(e, r) {
                    var i = $(r).parents(".input-group, .check-list");
                    i.length ? i.after(e) : r.after(e)
                },
            });
        });

	    $('#signin').on('click',function(){
	      var user = $('#user').val();
	      var pass = $('#pass').val();

	      $.ajax({
	          type: "POST",
	          url : "<?= base_url('admin/auth')?>",
	          dataType:'json',
	          data: {username:user,password:pass},
	          beforeSend:function(){
			    	$('.box').jmspinner('large');	    
			    },
	          success: function(msg){
	          	$('.box').jmspinner(false);
	            var jsondata= JSON.parse(JSON.stringify(msg));
				console.log(msg);
	            var val = jsondata.map(function(e) {
	            	return e.value;
	            });
	            var message = jsondata.map(function(e) {
	            	return e.message;
	            });
	            if (val == 0){
	              Toast.fire({
	                type: 'error',
	                title: ''+message+''
	                })
	            }else{
	              Toast.fire({
	                type: 'success',
	                title: ''+message+''
	              });
	              window.setTimeout(function(){
	                window.location.href="<?= base_url('admin')?>";
	              },1000);
	          	}
	        }
	      }); 
	      return false;
	    });
    });
	</script>
  </body>
</html>

		    
