<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Update Event Page</h5>
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
				<form class="kt-form" id="form-partner" action="<?php echo base_url('edit-event')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
					    <input type="hidden" class="form-control" name="event_id" id="event_id" value="<?php echo $product->event_id?>">
                        <div class="form-group">
                            <label>Category Event</label><br>
							<select class="form-control event_cat_id" name="event_cat_id" style="width:100%;" required>
								<option value="">Select Category</option>
								<?php foreach ($categories as $key => $value) { ?>
									<option value="<?php echo $value->cat_id;?>" <?php if($value->cat_id == $product->event_cat_id){echo "selected";}?>><?php echo $value->cat_name;?></option>
								<?php } ?>
							</select>
                        </div>
						<div class="form-group">
                            <label>Event Name</label>
                            <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Event Name" value="<?php echo $product->event_name?>">
                        </div>
						<div class="form-group">
                            <label>Event Date</label>
                            <input type="date" class="form-control" name="event_date" id="event_date" placeholder="Event Date" value="<?php echo $product->event_date?>">
                        </div>
						<div class="form-group">
                            <label>Event Description</label> 
                            <textarea class="form-control" name="event_desc" id="event_desc"><?php echo $product->event_desc?></textarea>
                        </div>
						<div class="form-group">
                            <label>Event Pic</label>
                            <input type="file" class="form-control" name="event_pic" id="event_pic" placeholder="Image">
							<img width="150" src="<?php echo base_url('assets/img/event/')?><?php echo $product->event_pic?>">
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
</script>
<!-- end:: Content -->


