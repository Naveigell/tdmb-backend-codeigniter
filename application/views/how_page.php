<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Youtube</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" action="<?php echo base_url('add-new-youtube')?>" method="post" enctype="multipart/form-data">
			<!-- <input type="hidden" class="form-control det_product_id" name="det_product_id" value="<?php echo $product->product_id;?>"> -->
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Youtube Link</label>
                <div class="col-sm-10">
					<input type="text" class="form-control youtube_link" name="youtube_link" placeholder="Youtube Link">
                </div>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" id="btnSave">Add</button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Youtube</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" action="<?php echo base_url('edit-youtube')?>" method="post" enctype="multipart/form-data">
			<input type="hidden" class="form-control youtube_id" name="youtube_id">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Youtube Link</label>
                <div class="col-sm-10">
					<input type="text" class="form-control youtube_link_edit" name="youtube_link_edit" placeholder="Youtube Link">
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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">How Page</h5>
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
				<form class="kt-form mb-10" id="form-partner" action="<?php echo base_url('update-how-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>How's Title</label>
                            <input type="text" class="form-control" name="how_title" id="how_title" placeholder="How Title" value="<?php echo $home->how_title?>">
                        </div>
						<div class="form-group">
                            <label>How's Description</label> 
                            <textarea class="form-control" name="how_desc" id="how_desc"><?php echo $home->how_desc?></textarea>
                        </div>
						<div class="form-group">
                            <label>How's Image</label>
                            <input type="file" class="form-control" name="how_pic" id="how_pic" placeholder="Slider">
							<img width="150" src="<?php echo base_url('assets/img/how/')?><?php echo $home->how_pic?>">
                        </div>
						
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
				<hr>
				<div class="mb-10 mt-10">
					<div class="row align-items-center">
						<div class="col-md-10">
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
						<div class="col-md-2">
							<div class="row align-items-center text-right">
								<a href="<?php echo base_url('step/add');?>" class="btn btn-success font-weight-bolder">+ Add Step</a>
							</div>
						</div>
					</div>
				</div>
				<!--begin: Datatable-->
				<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable1"></div>
				<!--end: Datatable-->
			</div>
		</div>

		<div class="card card-custom mt-10">
			<div class="card-body">
				<form class="kt-form mb-10" id="form-partner" action="<?php echo base_url('update-how-page-related')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
						<div class="form-group">
                            <label>Videos Title</label>
                            <input type="text" class="form-control" name="related_title" id="related_title" placeholder="Videos Title" value="<?php echo $home->related_title?>">
                        </div>
						<div class="form-group">
                            <label>Videos Description</label> 
                            <textarea class="form-control" name="related_desc" id="related_desc"><?php echo $home->related_desc?></textarea>
                        </div>

						
						
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" id="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
				<hr>
				<div class="mb-10 mt-10">
					<div class="row align-items-center">
						<div class="col-md-10">
							<div class="row align-items-center">
								<div class="col-md-3 my-2 my-md-0">
									<div class="input-icon">
										<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query2" />
										<span>
											<i class="flaticon2-search-1 text-muted"></i>
										</span>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-md-2">
							<div class="row align-items-center text-right">
								<button type="button" id="btnAddYoutube" class="btn btn-success font-weight-bolder">+ Add Youtube Link</button>
							</div>
						</div>
					</div>
				</div>
				<!--begin: Datatable-->
				<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable2"></div>
				<!--end: Datatable-->
			</div>
		</div>
	</div>
    <!--end::Container-->
</div>
<!--end::Entry-->


<script type="text/javascript">
	$('.preloader').fadeOut();

	$('#btnAddYoutube').click(function(){
		$('#modalAdd').modal();
	});


	var KTDatatableRemoteAjaxDemo = function() {
        // Private functions

        // basic demo
        var demo = function() {

            var datatable = $('#kt_datatable1').KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '<?php echo base_url('get-list-step') ?>',
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
                        field: 'step_pic',
                        title: 'Image',
                        template: function(row){
                            return '<img width="50" src="<?php echo base_url('assets/img/how/');?>'+row.step_pic+'">';
                        }
                    },{
                        field: 'step_number',
                        title: 'Number'
                    },{
                        field: 'step_title',
                        title: 'Name'
                    },{
                        field: 'step_desc',
                        title: 'Description'
                    },{
                        field: 'step_created_at',
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
							row.step_id +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit" title="Edit details">\
		                      <i class="la la-edit"></i>\
		                  </button>\
                          <button data-id="' +
                            row.step_id +
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
    			window.location.href = "<?php echo base_url('step/edit/')?>"+id
    		});

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Step?",
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
                                url: '<?php echo base_url('delete-step') ?>',
                                data: {
                                    step_id: id,
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

    var KTDatatableRemoteAjaxDemo2 = function() {
        // Private functions

        // basic demo
        var demo2 = function() {

            var datatable = $('#kt_datatable2').KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '<?php echo base_url('get-list-youtube') ?>',
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
                    input: $('#kt_datatable_search_query2'),
                    key: 'generalSearch'
                },

                // columns definition
                columns: [
					{
                        field: 'step_pic',
                        title: 'Image',
                        template: function(row){
                            return '<img width="50" src="https://img.youtube.com/vi/'+row.youtube_image+'/0.jpg">';
                        }
                    },{
                        field: 'youtube_link',
                        title: 'Link'
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<button href="javascript:;" data-id="' +
							row.youtube_id +
							'" data-link="' +
							row.youtube_link +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-youtube" title="Edit details">\
		                      <i class="la la-edit"></i>\
		                  </button>\
                          <button data-id="' +
                            row.youtube_id +
                            '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-youtube" title="Delete">\
                            <i class="la la-trash"></i>\
                        </button>\
		                    '
                        },
                    }
                ],

            });

            $(document).on("click", ".edit-youtube", function() {
				let id = $(this).data("id");
				let link = $(this).data("link");
				$('.youtube_id').val(id);
				$('.youtube_link_edit').val(link);
				$('#modalEdit').modal();
    		});

            $(document).on("click", ".delete-youtube", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Youtube?",
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
                                url: '<?php echo base_url('delete-youtube') ?>',
                                data: {
                                    youtube_id: id,
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
                demo2();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTDatatableRemoteAjaxDemo.init();
        KTDatatableRemoteAjaxDemo2.init();
    });
	
</script>
<!-- end:: Content -->


