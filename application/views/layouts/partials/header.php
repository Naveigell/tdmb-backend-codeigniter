<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <div class="topbar-item">
                <div class="btn btn-transparent-white btn-sm mr-1" id="kt_quick_panel_toggle">
                    <span></span>
                </div>
            </div>
            <!--begin::User-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto">
                        <span class="text-primary opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span class="text-primary opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4"><?php echo $this->session->userdata('admin_nama'); ?></span>
                        <span class="symbol symbol-35">
                            <span class="symbol-label text-primary font-size-h5 font-weight-bold bg-primary-o-30"><?php echo substr($this->session->userdata('admin_nama'), 0, 1); ?></span>
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center p-8 rounded-top">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                            <span class="symbol-label text-primary font-size-h5 font-weight-bold bg-primary-o-30"><?php echo substr($this->session->userdata('admin_nama'), 0, 1); ?></span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5"><?php echo $this->session->userdata('admin_nama'); ?></div>
                        <!--end::Text-->
                    </div>
                    <div class="navi navi-spacer-x-0 pt-5">
                        <!--begin::Item-->
                        <div class="navi-separator mt-3"></div>
                        <div class="navi-footer px-8 py-5">
                            <a class="btn btn-light-primary font-weight-bold btnLogout" id="logout">Sign Out</a>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>

<script>
    $(document).ready(function() {
        $('#logout').click(function() {
            bootbox.confirm({
                title: "Logout",
                message: "Are you sure to logout?",
                buttons: {
                    cancel: {
                        label: 'Cancel',
                        className: 'btn btn-secondary'
                    },
                    confirm: {
                        label: 'OK',
                        className: 'btn btn-primary'
                    }
                },
                callback: function(result) {
                    if (result) {
                        window.location.replace("<?php echo base_url('auth/logout') ?>");
                    }
                }
            });
        });
    });
</script>
