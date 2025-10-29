<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Upload | Error</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body onload="setTimeout(function(){ window.location.href = '{{ route('wel') }}'; }, 2000);"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <!--begin::Error-->
        <div class="error error-4 d-flex flex-row-fluid">
            <!--begin::Content-->
            <div
                class="d-flex flex-column flex-row-fluid align-items-center justify-content-md-center text-center text-md-left px-10 px-md-30 py-10 py-md-0 line-height-xs">
                <img src="{{ asset('img/404.png') }}" class="bgi-size-cover bgi-position-center" width="60%"
                    alt="">
            </div>
            <!--end::Content-->
        </div>
        <!--end::Error-->
    </div>
</body>
<!--end::Body-->

</html>
