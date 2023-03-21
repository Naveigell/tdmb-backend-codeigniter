<title><?php echo $title; ?></title>
<div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Data</h5>
            </div>
            <form enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Start Date:</label>
                        <input type="date" class="form-control tgl1" name="tgl1" placeholder="Tanggal">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">End Date:</label>
                        <input type="date" class="form-control tgl2" name="tgl2" placeholder="Tanggal">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary submitExport">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Analytic Page</h5>
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
		<div class="row">
			<div class="col-xl-6">
				<!--begin::Tiles Widget 11-->
				<div class="card card-custom bg-primary gutter-b" style="height: 150px">
					<div class="card-body">
						<div class="text-inverse-primary font-weight-bolder font-size-h4">Today</div>
						<div class="text-white font-weight-bolder font-size-h2 mt-3"><?php echo $today;?></div>
						<a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">time to access our page</a>
					</div>
				</div>
				<!--end::Tiles Widget 11-->
			</div>
			<div class="col-xl-6">
				<!--begin::Tiles Widget 12-->
				<div class="card card-custom bg-success gutter-b" style="height: 150px">
					<div class="card-body">
						<div class="text-inverse-success font-weight-bolder font-size-h4">All Time</div>
						<div class="text-white font-weight-bolder font-size-h2 mt-3"><?php echo $all;?></div>
						<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">time to access our page</a>
					</div>
				</div>
				<!--end::Tiles Widget 12-->
			</div>
		</div>
		<div class="card card-custom mt-5">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<h3 class="card-title">Who Saw Our Post</h3>
				<div class="card-toolbar">
                        <a class="btn btn-light-primary font-weight-bolder btnExport mr-4">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>Export Data
                        </a>
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
	$('.btnExport').click(function(){
		$('.tgl1').val('<?php echo date('Y-m-d')?>')
		$('.tgl2').val('<?php echo date('Y-m-d')?>')
		$('#modalExport').modal()
	})

	$('.submitExport').click(function() {
        window.open('<?php echo base_url('export/') ?>' + $('.tgl1').val() + '/' + $('.tgl2').val() , '_blank');
        $('#modalExport').modal('hide');
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
                            url: '<?php echo base_url('analytic-list') ?>',
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
                        field: 'user_name',
                        title: 'Customer Name'
                    },
					{
                        field: 'act_date',
                        title: 'Date Time'
                    },
					{
                        field: 'product_pic',
                        title: 'Note',
                        template: function(row){
							if(row.event != null){
								return row.user_name+' has opened the page <span class="font-weight-bolder">'+row.event.event_name+'</span>';
							}else{
								return row.user_name+' has opened the page <span class="font-weight-bolder">'+row.product.product_name+'</span>';
							}
							
                        }
                    },
                ],

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


