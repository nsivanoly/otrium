<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Otrium - @yield('title')</title>
</head>
<body>
<div class="dashboard-main-wrapper">
    @include('partial.header')
    <div class="dashboard">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Report Dashboard </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('partial.footer')
    </div>
</div>
<!-- JS -->
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
