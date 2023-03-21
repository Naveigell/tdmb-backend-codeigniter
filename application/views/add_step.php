<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Step Page</h5>
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
				<form class="kt-form" id="form-partner" action="<?php echo base_url('add-new-step')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
						<div class="form-group">
                            <label>Step Number</label>
                            <input type="number" class="form-control" name="step_number" id="step_number" placeholder="Step Number">
                        </div>
                        <div class="form-group">
                            <label>Step Title</label>
                            <input type="text" class="form-control" name="step_title" id="step_title" placeholder="Step Title">
                        </div>
						<div class="form-group">
                            <label>Step Description</label> 
                            <textarea class="form-control" name="step_desc" id="step_desc"></textarea>
                        </div>
						<div class="form-group">
                            <label>Step Pic</label>
                            <input type="file" class="form-control" name="step_pic" id="step_pic" placeholder="Image">
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Add</button>
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
	
</script>
<!-- end:: Content -->


