<html lang="en">
<!--begin::Head-->
<head>
	<title>Masuk - Teknik Dasar Mesatua Bali</title>
    <?php $this->load->view('layouts/css.php'); ?>
	<link href="<?php echo base_url('assets/css/login-custom.css') ?>" rel="stylesheet" type="text/css" />
    <?php $this->load->view('layouts/js.php'); ?>
    <style>
        #anim {
            position:absolute;top:-100;z-index:0;width:40%;text-align:center;right:0;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            width: 100%;
			position: relative;
			background-color: #F3F6F9;
			border-color: #F3F6F9;
			color: #464E5F;
			border-radius: 10px;
			padding: 1.75rem 1.5rem 1.75rem 1.5rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #464E5F;
        }

        .select2-container--default .select2-selection--single {
            /* background-color: #fff; */
            /* border: 1px solid #aaa; */
			border:0px;
			border-radius: 10px;
			background-color: #F3F6F9;
			border-color: #F3F6F9;
			color: #464E5F;
            /* border-radius: 50%; */
        }

        /* Smartphones (portrait and landscape) ----------- */
        @media only screen 
        and (min-device-width : 320px) 
        and (max-device-width : 480px) {
            #anim {
                position:absolute;right:0;top:-30;z-index:0;width:100%;
            }
        }

    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<?php $this->load->view('layouts/partials/loader.php') ?>
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Content-->
				<div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
					<!--begin::Wrapper-->
					<div class="login-content d-flex flex-column pt-lg-0 pt-12">
						<!--begin::Logo-->
						<!-- <a href="#" class="login-logo pb-xl-20 pb-15">
							<img src="/metronic/theme/html/demo1/dist/assets/media/logos/logo-4.png" class="max-h-70px" alt="" />
						</a> -->
						<!--end::Logo-->
						<!--begin::Signin-->
						<div class="login-form">
							<!--begin::Form-->
							<form class="form" id="kt_login_singin_form">
								<!--begin::Title-->
								<div class="pb-5 pb-lg-15">
									<h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Masuk</h3>
									<!-- <div class="text-muted font-weight-bold font-size-h4">New Here? 
									<a href="/metronic/demo1/custom/pages/login/login-4/signup.html" class="text-primary font-weight-bolder">Create Account</a></div> -->
									<div class="text-muted font-weight-bold font-size-h4">Masuk dengan akun Anda</div>
								</div>
								<!--begin::Title-->
								<!--begin::Form group-->
								<div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark">Username</label>
									<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0 username" type="text" name="username" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">
									<div class="d-flex justify-content-between mt-n5">
										<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
										<!-- <a href="/metronic/demo1/custom/pages/login/login-4/forgot.html" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Forgot Password ?</a> -->
									</div>
									<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0 password" type="password" name="password" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Action-->
								<div class="pb-lg-0 pb-5">
									<button type="button" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btnSubmit">Sign In</button>
									
								</div>
								<!--end::Action-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--begin::Content-->
				<!--begin::Aside-->
				<div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
					<div class="login-container bgi-no-repeat bgi-position-x-right bgi-position-y-bottom bg-pattern h-100">
						<div style="height:85%;">
							<h3 class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 font-weight-boldest display5 display1-lg text-white">Teknik 
								<br />Dasar
								<br />Mesatua<br />Bali</h3>
						</div>
					</div>
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Login-->
		</div>
	</body>
	<!--end::Body-->
	<script>
		$('.select-app').select2();

		$('.btnSubmit').click(function(){
			if($('.username').val() == ''){
				bootbox.alert({
					message: "Username can not empty",
					backdrop: true,
					size: 'small'
				});
			}else if($('.password').val() == ''){
				bootbox.alert({
					message: "Password can not empty",
					backdrop: true,
					size: 'small'
				});
			}else{
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('post_login') ?>',
					dataType: 'json',
					data: {
						username: $('.username').val(),
						password: $('.password').val()
					},
					success: function(data) {
						if(data){
							window.location = '<?php echo base_url('/')?>';
						}else{
							bootbox.alert({
								message: "Wrong username or password",
								backdrop: true,
								size: 'small'
							});
						}
					},
					error: function(xhr, desc, err) {
						console.log(xhr.responseText);
					}
				});
			}
		})
	</script>
</html>
