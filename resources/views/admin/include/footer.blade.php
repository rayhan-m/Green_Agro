            </div>
        <div class="sidebar-overlay open"></div><!-- Footer Start -->
    <div class="flex-grow-1"></div>
            
            <div class="app-footer">
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                     <img class="logo" src="{{asset('/')}}{{$setting->logo}}" alt="">
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                       
                        <div>
                            <p class="m-0">{!! $setting->copyright_text !!} </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fotter end -->
        </div>
    </div>
    
    <script src="{{ asset('backend/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/tooltip.script.min.js') }}"></script>
    <script src="{{ asset('backend/js/file-upload.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/script_2.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/layout-sidebar-vertical.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/echarts.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/dashboard.v1.script.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/datatables.script.min.js') }}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
        $('#date_of_birth').datepicker({
            uiLibrary: 'bootstrap'
        });
        $('#expense_date').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
    
    {!! Toastr::message() !!}
    {{-- {!! Toastr::message() !!} --}}
</body>


<!-- Mirrored from demos.ui-lib.com/gull/html/layout4/dashboard1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Feb 2020 18:10:07 GMT -->
</html>