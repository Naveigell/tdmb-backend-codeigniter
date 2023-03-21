<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Product Page</h5>
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
				<form class="kt-form" id="form-partner" action="<?php echo base_url('update-product-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Newest Title</label>
                            <input type="text" class="form-control" name="newest_title" id="newest_title" placeholder="Newest Title" value="<?php echo $home->newest_title?>">
                        </div>
						<div class="form-group">
                            <label>Newest Description</label> 
                            <textarea class="form-control" name="newest_desc" id="newest_desc"><?php echo $home->newest_desc?></textarea>
                        </div>
						<hr>
						
						<div class="form-group">
                            <label>Our Product Title</label>
                            <input type="text" class="form-control" name="our_title" id="our_title" placeholder="Our Product Title" value="<?php echo $home->our_title?>">
                        </div>
						<div class="form-group">
                            <label>Our Product Description</label> 
                            <textarea class="form-control" name="our_desc" id="our_desc"><?php echo $home->our_desc?></textarea>
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
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<h3 class="card-title">Products</h3>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a href="<?php echo base_url('product/add');?>" class="btn btn-primary font-weight-bolder">+ Add Product</a>
					<!--end::Button-->
				</div>
			</div>
			<div class="card-body">
				<!--begin: Search Form-->
                    <!--begin::Search Form-->
                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-9 col-xl-12">
                                <div class="row align-items-center">
                                    <div class="col-md-3 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin: Datatable-->
                    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                    <!--end: Datatable-->
			</div>
		</div>
	</div>
    <!--end::Container-->
</div>
<!--end::Entry-->


<script type="text/javascript">
	$('.preloader').fadeOut();
	var KTDatatableRemoteAjaxDemo = function() {
        // Private functions

        // basic demo
        var demo = function() {

            var datatable = $('#kt_datatable').KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '<?php echo base_url('product-list') ?>',
                            map: function(raw) {
                                // sample data mapping
                                var dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }
                                return dataSet;
                            },
                        },
                    },
                    pageSize: 10,
                    serverPaging: true,
                    // serverFiltering: true,
                    serverSorting: true,
                },

                // layout definition
                layout: {
                    scroll: false,
                    footer: false,
                },

                // column sorting
                sortable: true,

                pagination: true,

                search: {
                    input: $('#kt_datatable_search_query'),
                    key: 'generalSearch'
                },

                // columns definition
                columns: [
					{
                        field: 'product_pic',
                        title: 'Image',
                        template: function(row){
                            return '<img width="50" src="<?php echo base_url('assets/img/product/');?>'+row.product_pic+'">';
                        }
                    },{
                        field: 'product_name',
                        title: 'Name'
                    },{
                        field: 'product_price',
                        title: 'Price'
                    },{
                        field: 'product_desc',
                        title: 'Description'
                    },{
                        field: 'product_created_at',
                        title: 'Created at'
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<button href="javascript:;" data-id="' +
							row.product_id +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md photos" title="Photos">\
		                      <i class="la la-photo"></i>\
		                  </button>\<button href="javascript:;" data-id="' +
							row.product_id +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit" title="Edit details">\
		                      <i class="la la-edit"></i>\
		                  </button>\
                          <button data-id="' +
                            row.product_id +
                            '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete" title="Delete">\
                            <i class="la la-trash"></i>\
                        </button>\
		                    '
                        },
                    }
                ],

            });
			
			$(document).on("click", ".photos", function() {
				let id = $(this).data("id");
    			window.location.href = "<?php echo base_url('product/photos/')?>"+id
    		});

            $(document).on("click", ".edit", function() {
				let id = $(this).data("id");
    			window.location.href = "<?php echo base_url('product/edit/')?>"+id
    		});

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Product?",
                    message: "Are you sure to delete? Your data will lost",
                    buttons: {
                        cancel: {
                            label: 'Cancel'
                        },
                        confirm: {
                            label: 'OK',
                            className: 'btn btn-primary'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url('delete-product') ?>',
                                data: {
                                    product_id: id,
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data) {
                                        location.reload();
                                    } else {
                                        bootbox.alert({
                                            message: "Oops! Something wrong",
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
                    }
                });
            });

           
        };

        return {
            // public functions
            init: function() {
                demo();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTDatatableRemoteAjaxDemo.init();
    });
</script>
<!-- end:: Content -->


