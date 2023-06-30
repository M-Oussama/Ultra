<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#ff3636",
                    "secondary": "#eee5ea",
                    "success": "#26c51b",
                    "info": "#50acfc",
                    "warning": "#ff6600",
                    "danger": "#f60303",
                    "light": "#E4E6EF",
                    "dark": "#929fec"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#ff3636",
                    "secondary": "#eee5ea",
                    "success": "#26c51b",
                    "info": "#50acfc",
                    "warning": "#ff6600",
                    "danger": "#f60303",
                    "light": "#E4E6EF",
                    "dark": "#929fec"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ff3636",
                    "secondary": "#eee5ea",
                    "success": "#26c51b",
                    "info": "#50acfc",
                    "warning": "#ff6600",
                    "danger": "#f60303",
                    "light": "#E4E6EF",
                    "dark": "#929fec"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#d0d3e5"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
@if(session('message'))
    <script>
        var toaster = $('#toaster');

        function callToaster(positionClass, rtl) {
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: false,
                progressBar: true,
                positionClass: positionClass,
                rtl: rtl,
                preventDuplicates: false,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            };
        }
        if(toaster.length != 0){
            if (document.dir != "rtl") {
                callToaster("toast-top-right", false);
            } else {
                callToaster("toast-top-left", true);
            }
        }

        @if(session('type') == 'success')
            toastr.success("{{ @session('message') }}");
        @elseif(session('type') == 'warning')
            toastr.warning("{{ @session('message') }}");
        @else
            toastr.error("{{ @session('message') }}");
        @endif
    </script>
@endif

<!--begin::Page Scripts(used by this page)-->
@yield('scripts')
<!--end::Page Scripts-->
