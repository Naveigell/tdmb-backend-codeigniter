<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Update Product Page</h5>
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
				<form class="kt-form" id="form-partner" action="<?php echo base_url('edit-product')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
					    <input type="hidden" class="form-control" name="product_id" id="product_id" value="<?php echo $product->product_id?>">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="<?php echo $product->product_name?>">
                        </div>
						<div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Product Price" value="<?php echo $product->product_price?>">
                        </div>
						<div class="form-group">
                            <label>Product Description</label> 
                            <textarea class="form-control" name="product_desc" id="product_desc"><?php echo $product->product_desc?></textarea>
                        </div>
						<div class="form-group">
                            <label>Product Pic</label>
                            <input type="file" class="form-control" name="product_pic" id="product_pic" placeholder="Image">
							<img width="150" src="<?php echo base_url('assets/img/product/')?><?php echo $product->product_pic?>">
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


