<!doctype html>
<html class="no-js" lang="">
<head>
    @include('admin.layouts.sources')
</head>
<body>

@include('admin.layouts.aside')


<div id="right-panel" class="right-panel">
    @include('admin.layouts.header')

    @yield('breadcrumbs')

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                @yield('content');
            </div>
        </div>
    </div>


</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
@include('admin.layouts.scripts')


</body>
</html>
