@extends('frontend.layouts.main_header')

@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->

    <!-- page content -->

    <style>
        /* Use a shared class for all chart divs */
        .chartdiv {
            width: 100%;
            height: 500px;
           // display: none; /* Hide initially, show when chart is rendered */
        }
    </style>

    <!-- Chart div containers -->
    <div id="chartContainer" class="row">
    <div id="chartdiv1" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv2" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv3" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv4" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv5" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv6" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv7" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv8" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv9" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv10" class="chartdiv col-md-4 mb-4"></div>
    <div id="chartdiv11" class="chartdiv col-md-4 mb-4"></div>
</div>


    <!-- jQuery (make sure it's only loaded once, check your includes) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- AmCharts scripts -->
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/index.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/percent.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/xy.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/radar.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/themes/Animated.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/plugins/exporting.js') }}"></script>

    <!-- Include the common chart plotting function before AJAX -->
    @include('frontend.main.Dashboard.amchartscripts')
   
    <script>
        $(document).ready(function () {
    // Confirm the plotting function is defined globally
    if (typeof commonfunction_plotchart !== 'function') {
        console.error('commonfunction_plotchart is not defined');
        return;
    }

    $.ajax({
        method: "GET",
        url: "{{ url('/dashboarddetails') }}",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            try {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }

              // console.log("Full response:", data);
              // console.log("Type of data.result:", typeof data.result);
               // console.log("Data.result:", data.result);

                const chartData = data?.result?.result;
                var p=1;
                if (Array.isArray(chartData) && chartData.length > 0) {
                    $.each(chartData, function (i, value) {
                        $.each(value.function_name, function (key, functionname) {
                            var seriesdata = value.plotchatdata[key];
                            var chartdivname = "chartdiv"+p;

                           // console.log("Plotting chart:", functionname, chartdivname);
                            //console.log("Series data:", seriesdata);

                            // Create div if missing
                            if ($("#" + chartdivname).length === 0) {
                                $("#chartContainer").append(`<div id="${chartdivname}" class="chartdiv"></div>`);
                            }
                            // Plot chart
                            destroyExistingRoot(chartdivname);
                            commonfunction_plotchart(functionname, seriesdata, chartdivname);
                            $("#" + chartdivname).show();
                            p++;
                        });
                    });
                } else {
                    alert('No chart data found.');
                }
            } catch (e) {
                console.error("Parsing error:", e);
                alert("Error parsing server response");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            alert("Error: " + error);
        }
    });
});

        //----------------------

        function destroyExistingRoot(chartdivname) {
    // Loop through all registered root elements
    am5.registry.rootElements.forEach(function(root) {
        if (root.dom.id === chartdivname) {
            console.log(`Disposing existing root for: ${chartdivname}`);
            root.dispose();
        }
    });
}

    </script>

    <!-- page content End -->

    <!-- footer -->
    @include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->

@include('frontend.layouts.search_scroll')

<!-- Additional JS includes -->
@include('frontend.layouts.include_scripts')

@endsection
