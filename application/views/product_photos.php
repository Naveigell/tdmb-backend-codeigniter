<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="modal fade" id="modalPhotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Photos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" action="<?php echo base_url('add-product-photo')?>" method="post" enctype="multipart/form-data">
			<input type="hidden" class="form-control det_product_id" name="det_product_id" value="<?php echo $product->product_id;?>">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Photos Title</label>
                <div class="col-sm-10">
					<input type="text" class="form-control det_title" name="det_title" placeholder="Title">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Photos</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="det_pic" id="det_pic" placeholder="Image">
                </div>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" id="btnSave">Save</button>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo $product->product_name;?></h5>
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
		<div class="card card-custom mt-5">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<h3 class="card-title">Photos</h3>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a class="btn btn-primary font-weight-bolder btnAdd">+ Add Photo</a>
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
	$('.btnAdd').click(function(){
		$('#modalPhotos').modal();
	})

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
                            url: '<?php echo base_url('product-photos-list/') ?><?php echo $product->product_id?>',
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
                        field: 'det_pic',
                        title: 'Image',
                        template: function(row){
                            return '<img width="50" src="<?php echo base_url('assets/img/product/');?>'+row.det_pic+'">';
                        }
                    },{
                        field: 'det_title',
                        title: 'Name'
                    },{
                        field: 'det_created_at',
                        title: 'Created at'
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<button data-id="' +
                            row.det_id +
                            '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete" title="Delete">\
                            <i class="la la-trash"></i>\
                        </button>\
		                    '
                        },
                    }
                ],

            });

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Photos?",
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
                                url: '<?php echo base_url('delete-product-photos') ?>',
                                data: {
                                    det_id: id,
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


