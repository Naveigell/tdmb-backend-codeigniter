<title><?php echo $title; ?></title>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" action="<?php echo base_url('add-category')?>" method="post" enctype="multipart/form-data">
			<!-- <input type="hidden" class="form-control det_event_id" name="det_event_id" value="<?php echo $product->event_id;?>"> -->
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-10">
					<input type="text" class="form-control cat_name" name="cat_name" placeholder="Title">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Color</label>
                <div class="col-sm-10">
                    <input type="color" class="form-control" name="cat_color" id="cat_color">
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" action="<?php echo base_url('edit-category')?>" method="post" enctype="multipart/form-data">
			<input type="hidden" class="form-control cat_id" name="cat_id">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-10">
					<input type="text" class="form-control cat_name_edit" name="cat_name_edit" placeholder="Name">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Color</label>
                <div class="col-sm-10">
                    <input type="color" class="form-control cat_color_edit" name="cat_color_edit" id="cat_color_edit">
                </div>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Update</button>
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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Categories Page</h5>
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
				<h3 class="card-title">Categories</h3>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a class="btn btn-primary font-weight-bolder btnAdd">+ Add Categories</a>
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
		$('#modalAdd').modal();
	});

	$('#ck').click(function(){
		alert($('#cat_color').val())
	});

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
                            url: '<?php echo base_url('get-categories') ?>',
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
                        field: 'cat_color',
                        title: 'Color',
                        template: function(row){
                            return '<div style="width:50px;height:50px;background-color:'+row.cat_color+'"></div>';
                        }
                    },{
                        field: 'cat_name',
                        title: 'Category'
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<button href="javascript:;" data-id="' +
							row.cat_id +
							'" data-name="' +
                            row.cat_name +
                            '" data-color="' +
                            row.cat_color +
                            '" class="btn btn-sm btn-clean btn-icon btn-icon-md edit" title="Edit details">\
		                      <i class="la la-edit"></i>\
		                  </button>\
                          <button data-id="' +
                            row.cat_id +
                            '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete" title="Delete">\
                            <i class="la la-trash"></i>\
                        </button>\
		                    '
                        },
                    }
                ],

            });
			

            $(document).on("click", ".edit", function() {
				let id = $(this).data("id");
				let name = $(this).data("name");
				let color = $(this).data("color");

				$('.cat_id').val(id);
				$('.cat_name_edit').val(name);
				$('.cat_color_edit').val(color);
				$('#modalEdit').modal();

    			// window.location.href = "<?php echo base_url('event/edit/')?>"+id
    		});

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Category?",
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
                                url: '<?php echo base_url('delete-category') ?>',
                                data: {
                                    cat_id: id,
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


