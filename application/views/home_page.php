<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Home Page</h5>
            <!--end::Page Title-->
            <!--end::Actions-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
		<div class="card card-custom">
			<div class="card-body">
				<form class="kt-form" id="form-partner" action="<?php echo base_url('update-home-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Mission Title</label>
                            <input type="text" class="form-control" name="mission_title" id="mission_title" placeholder="Mission Title" value="<?php echo $home->mission_title?>">
                        </div>
						<div class="form-group">
                            <label>Mission Description</label> 
                            <textarea class="form-control" name="mission_desc" id="mission_desc"><?php echo $home->mission_desc?></textarea>
                        </div>
						<hr>
						
						<div class="form-group">
                            <label>Introduction Title</label>
                            <input type="text" class="form-control" name="intro_title" id="intro_title" placeholder="Introduction Title" value="<?php echo $home->intro_title?>">
                        </div>
						<div class="form-group">
                            <label>Introduction Description</label> 
                            <textarea class="form-control" name="intro_desc" id="intro_desc"><?php echo $home->intro_desc?></textarea>
                        </div>
						<div class="form-group">
                            <label>Introduction Image</label>
                            <input type="file" class="form-control" name="intro_pic" id="intro_pic" placeholder="Intro Pic">
							<img width="150" src="<?php echo base_url('assets/img/intro/')?><?php echo $home->intro_pic?>">
                        </div>
						
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>

		<div class="card card-custom mt-5">
			<div class="card-body">
				<form class="kt-form" id="form-partner" action="<?php echo base_url('update-slider1-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
                       
						<div class="form-group">
                            <label>Slider 1 Title</label>
                            <input type="text" class="form-control" name="slider1_title" id="slider1_title" placeholder="Slider 1 Title" value="<?php echo $home->slider1_title?>">
                        </div>
						<div class="form-group">
                            <label>Slider 1 Title</label>
                            <input type="file" class="form-control" name="slider1" id="slider1" placeholder="Slider">
							<img width="150" src="<?php echo base_url('assets/img/slider/')?><?php echo $home->slider1?>">
                        </div>
						
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>

		<div class="card card-custom mt-5">
			<div class="card-body">
				<form class="kt-form" id="form-partner" action="<?php echo base_url('update-slider2-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
                       
						<div class="form-group">
                            <label>Slider 2 Title</label>
                            <input type="text" class="form-control" name="slider2_title" id="slider2_title" placeholder="Slider 2 Title" value="<?php echo $home->slider2_title?>">
                        </div>
						<div class="form-group">
                            <label>Slider 2 Title</label>
                            <input type="file" class="form-control" name="slider2" id="slider2" placeholder="Slider">
							<img width="150" src="<?php echo base_url('assets/img/slider/')?><?php echo $home->slider2?>">
                        </div>
						
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>

		<div class="card card-custom mt-5">
			<div class="card-body">
				<form class="kt-form" id="form-partner" action="<?php echo base_url('update-slider3-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
						<div class="form-group">
                            <label>Slider 3 Title</label>
                            <input type="text" class="form-control" name="slider3_title" id="slider3_title" placeholder="Slider 3 Title" value="<?php echo $home->slider3_title?>">
                        </div>
						<div class="form-group">
                            <label>Slider 3 Title</label>
                            <input type="file" class="form-control" name="slider3" id="slider3" placeholder="Slider">
							<img width="150" src="<?php echo base_url('assets/img/slider/')?><?php echo $home->slider3?>">
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
    <!--end::Container-->
</div>
<!--end::Entry-->


<script type="text/javascript">
	$('.preloader').fadeOut();
	// ClassicEditor
	// 	.create( document.querySelector( '#top_desc' ) )
	// 	.then( editor => {
	// 		console.log( editor );
	// 	} )
	// 	.catch( error => {
	// 		console.error( error );
	// 	} );
	
	// var limit = 0;
	// var datas = <?php echo json_encode($top)?>;
	// $('#img_top').attr('src', 'https://upload.cwb.asia/assets/uploads/'+datas.top_pic);


	// $('#select-image').click(function(){
	// 	$('#modalImage').modal();
	// })

	// getImage('');

	// $('.btnSearch').click(function(){
	// 	getImage($('.search_input').val());
	// })

	// function getImage(param){
	// 	$.ajax({
	// 	type: 'POST',
	// 	url: 'https://upload.cwb.asia/get-all-image',
	// 	data: {
	// 		param: param,
	// 	},
	// 	dataType: 'json',
	// 	success: function(data) {
	// 		console.log(data)
	// 		let html = '';
	// 		for (let i = 0; i < data.length; i++) {
	// 			html+='<div id="'+data[i].upload_path+'" class="col-md-2 p-2 select-image" style="height: 150px;cursor:pointer;">'+
	// 			'<img width="100%" height="60%" style="object-fit: contain;" src="https://upload.cwb.asia/assets/uploads/'+data[i].upload_path+'">'+
	// 			'<p class="mt-3" style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;">'+data[i].upload_title+'</p>'+
	// 			'</div>';
	// 		}

	// 		$('.data-image').html(html);
	// 		$('.select-image').click(function(){
	// 			let path = $(this).attr('id');
	// 			$('#img_top').attr('src', 'https://upload.cwb.asia/assets/uploads/'+path);
	// 			$('#top_pic').val(path);
	// 			$('#modalImage').modal('hide');
	// 		})
	// 	},
	// 	error: function(xhr, desc, err) {
	// 		console.log(xhr.responseText);
	// 	}
	// });
	// }
</script>
<!-- end:: Content -->


