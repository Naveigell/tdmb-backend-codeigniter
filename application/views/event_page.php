<title><?php echo $title; ?></title>
<?php $this->load->view('layouts/get_image');?>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Newest Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" action="<?php echo base_url('add-newest-event')?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
                <label class="form-label">Event</label><br>
                <select class="form-control new_event_id" name="new_event_id" style="width:100%;" required>
					<option value="">Select Event</option>
					<?php foreach ($event as $key => $value) { ?>
						<option value="<?php echo $value->event_id;?>"><?php echo $value->event_name;?></option>
					<?php } ?>
				</select>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Event Page</h5>
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
				<form class="kt-form" id="form-partner" action="<?php echo base_url('update-event-page')?>" method="post" enctype="multipart/form-data">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" class="form-control" name="event_title" id="event_title" placeholder="Event Title" value="<?php echo $home->event_title?>">
                        </div>
						<div class="form-group">
                            <label>Event Description</label> 
                            <textarea class="form-control" name="event_desc" id="event_desc"><?php echo $home->event_desc?></textarea>
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
				<h3 class="card-title">Newest Event List</h3>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a class="btn btn-primary font-weight-bolder addNew">+ Add Newest Event</a>
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
                                            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query2" />
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
                    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable2"></div>
                    <!--end: Datatable-->
			</div>
		</div>

		<div class="card card-custom mt-5">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<h3 class="card-title">Event List</h3>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a href="<?php echo base_url('event/add');?>" class="btn btn-primary font-weight-bolder">+ Add Event</a>
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
	$('.new_event_id').select2();

	$('.addNew').click(function(){
		$('#modalAdd').modal();
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
                            url: '<?php echo base_url('event-list') ?>',
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
                        field: 'event_pic',
                        title: 'Image',
                        template: function(row){
                            return '<img width="50" src="<?php echo base_url('assets/img/event/');?>'+row.event_pic+'">';
                        }
                    },{
                        field: 'cat_name',
                        title: 'Category'
                    },{
                        field: 'event_name',
                        title: 'Name'
                    },{
                        field: 'event_date',
                        title: 'Date'
                    },{
                        field: 'event_desc',
                        title: 'Description'
                    },{
                        field: 'event_created_at',
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
							row.event_id +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md photos" title="Photos">\
		                      <i class="la la-photo"></i>\
		                  </button>\<button href="javascript:;" data-id="' +
							row.event_id +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit" title="Edit details">\
		                      <i class="la la-edit"></i>\
		                  </button>\
                          <button data-id="' +
                            row.event_id +
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
    			window.location.href = "<?php echo base_url('event/photos/')?>"+id
    		});

            $(document).on("click", ".edit", function() {
				let id = $(this).data("id");
    			window.location.href = "<?php echo base_url('event/edit/')?>"+id
    		});

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Event?",
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
                                url: '<?php echo base_url('delete-event') ?>',
                                data: {
                                    event_id: id,
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
                            url: '<?php echo base_url('event-list-newest') ?>',
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
                        field: 'event_pic',
                        title: 'Image',
                        template: function(row){
                            return '<img width="50" src="<?php echo base_url('assets/img/event/');?>'+row.event_pic+'">';
                        }
                    },{
                        field: 'cat_name',
                        title: 'Category'
                    },{
                        field: 'event_name',
                        title: 'Name'
                    },{
                        field: 'event_desc',
                        title: 'Description'
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<button data-id="' +
                            row.new_id +
                            '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete2" title="Delete">\
                            <i class="la la-trash"></i>\
                        </button>\
		                    '
                        },
                    }
                ],

            });

            $(document).on("click", ".delete2", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Delete Newest Event?",
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
                                url: '<?php echo base_url('delete-newest-event') ?>',
                                data: {
                                    new_id: id,
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
        KTDatatableRemoteAjaxDemo2.init();
    });
</script>
<!-- end:: Content -->


