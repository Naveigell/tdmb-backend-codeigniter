<title><?php echo $title; ?></title>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" >
			<input type="hidden" class="form-control idkode" name="idkode" >
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-10">
					<input type="number" class="form-control nilai" name="nilai" placeholder="Nilai">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
					<textarea type="text" class="form-control catatan" name="catatan" rows="3" placeholder="catatan"></textarea>
                </div>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="btnSave">Simpan</button>
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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Kode <?php echo $kode;?></h5>
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
				<h3 class="card-title">Kode List - <?php echo $kode;?></h3>
				
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
	$('.addNew').click(function(){
		$('#modalAdd').modal();
	});

	$('#btnSave').click(function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('update-nilai') ?>',
			data: {
				id: $('.idkode').val(),
				nilai: $('.nilai').val(),
				catatan: $('.catatan').val(),
			},
			dataType: 'json',
			success: function(data) {
				if (data) {
					location.reload();
				} else {
					bootbox.alert({
						message: "Oops! Ada kesalahan",
						backdrop: true,
						size: 'small'
					});
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr.responseText);
			}
		});
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
                            url: '<?php echo base_url('kode-kode/') ?><?php echo $kode;?>',
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
                        title: 'Nama'
                    },{
                        field: 'praktek_link',
                        title: 'Link',
                        autoHide: false,
                        template: function(row) {
							return '<a target="_blank" href="'+row.praktek_link +'">' +row.praktek_link +'</a>'
                        },
                    },
					{
                        field: 'praktek_catatan',
                        title: 'Catatan'
                    },
					{
                        field: 'praktek_created_at',
                        title: 'Dikirim pada'
                    },
					{
                        field: 'praktek_nilai',
                        title: 'Nilai',

						template: function(row) {
							if(row.praktek_nilai == null){
								return "Belum Dinilai";
							}else{
								return ''+row.praktek_nilai;
							}
                        },
                    }, {
                        field: 'Aksi',
                        title: 'Aksi',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<button href="javascript;;" data-id="' +
							row.praktek_id +
							'" data-nilai="' +
							row.praktek_nilai+
							'" data-catatan="' +
							row.praktek_catatan_penilai +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit" title="Lihat">\
		                      <i class="la la-eye"></i>\
		                  </button>\
						  '
                        },
                    }
					
                ],

            });

			$(document).on("click", ".edit", function() {
				let id = $(this).data("id");
				let nilai = $(this).data("nilai");
								let catatan = $(this).data("catatan");

				$('.idkode').val(id);
				$('.nilai').val(nilai);
								$('.catatan').val(catatan);

				$('#modalAdd').modal();
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


