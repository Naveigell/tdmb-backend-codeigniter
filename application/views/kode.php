<title><?php echo $title; ?></title>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner" >
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
					<input type="text" class="form-control kode" name="kode" placeholder="Kode">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
					<input type="text" class="form-control judul" name="judul" placeholder="Judul">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
					<textarea type="text" class="form-control deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"></textarea>
                </div>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="btnSave">Tambah</button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Kode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="form-partner">
			<input type="hidden" class="form-control id-edit" name="id-edit"></input>

			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
					<input type="text" class="form-control kode-edit" name="kode-edit" placeholder="Kode" disabled>
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
					<input type="text" class="form-control judul-edit" name="judul-edit" placeholder="Judul">
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
					<textarea type="text" class="form-control deskripsi-edit" name="deskripsi-edit" rows="3" placeholder="Deskripsi"></textarea>
                </div>
            </div>
			<div class="modal-footer mb-0 pb-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="btnEdit">Edit</button>
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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Kode List Page</h5>
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
				<h3 class="card-title">Kode List</h3>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a class="btn btn-primary font-weight-bolder addNew">+ Tambah Kode</a>
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
	$('.addNew').click(function(){
		$('#modalAdd').modal();
	});

	$('#btnSave').click(function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('add-kode') ?>',
			data: {
				kode: $('.kode').val(),
				judul: $('.judul').val(),
				deskripsi: $('.deskripsi').val(),
			},
			dataType: 'json',
			success: function(data) {
				if (data) {
					location.reload();
				} else {
					bootbox.alert({
						message: "Kode telah dibuat sebelumnya",
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

	$('#btnEdit').click(function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('edit-kode') ?>',
			data: {
				id: $('.id-edit').val(),
				kode: $('.kode-edit').val(),
				judul: $('.judul-edit').val(),
				deskripsi: $('.deskripsi-edit').val()
			},
			dataType: 'json',
			success: function(data) {
				if (data) {
					location.reload();
				} else {
					bootbox.alert({
						message: "Kode telah dibuat sebelumnya",
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
                            url: '<?php echo base_url('kode-list') ?>',
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
                        field: 'kode_kode',
                        title: 'Kode'
                    },
					{
                        field: 'kode_judul',
                        title: 'Judul'
                    },
					{
                        field: 'kode_deskripsi',
                        title: 'Deskripsi'
                    },
					{
                        field: 'kode_created_at',
                        title: 'Dibuat pada'
                    },
					{
                        field: 'terkumpul',
                        title: 'Terkumpul'
                    }, {
                        field: 'Aksi',
                        title: 'Aksi',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
							return '<a href="<?php echo base_url("kode/")?>' +
							row.kode_kode +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md photos" title="Photos">\
		                      <i class="la la-eye"></i>\
		                  </a>\<button href="javascript:;" data-id="' +
							row.kode_id +
							'" data-judul="' +
							row.kode_judul +
							'"data-kode="' +
							row.kode_kode +
							'"data-deskripsi="' +
							row.kode_deskripsi +
							'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit" title="Edit details">\
		                      <i class="la la-edit"></i>\
		                  </button>\
                          <button data-id="' +
                            row.kode_kode+
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
				let judul = $(this).data("judul");
				let kode = $(this).data("kode");
				let deskripsi = $(this).data("deskripsi");

				$('.id-edit').val(id);
				$('.judul-edit').val(judul);
				$('.kode-edit').val(kode);
				$('.deskripsi-edit').val(deskripsi);

				$('#modalEdit').modal();
    		});

			$(document).on("click", ".delete", function() {
                let id = $(this).data("id");
                bootbox.confirm({
                    title: "Hapus Kode?",
                    message: "Yakin untuk menghapus?",
                    buttons: {
                        cancel: {
                            label: 'Batal'
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
                                url: '<?php echo base_url('delete-kode') ?>',
                                data: {
                                    kode: id,
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


