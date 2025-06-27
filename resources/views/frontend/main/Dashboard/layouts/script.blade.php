 
<script>
 $(document).ready(function () {


/*Bed Strength one*/

  $.ajax({
    method: "GET",
    url: '/bedstrength_one_details',
    dataType: "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
        try {
            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            const chartData = data?.result?.result;
            console.log("Received chart data:", chartData);

            if (Array.isArray(chartData) && chartData.length > 0) {
                const firstItem = chartData[0];
                const functionNames = firstItem.function_name;
                const plotData = firstItem.plotchatdata;

                // Assuming you only want the first chart for now
                const chartdivname = "chartdiv3";

                $.each(functionNames, function (key, functionname) {
                    const seriesdata = plotData[key];

                    destroyExistingRoot(chartdivname); // Optional: clear any existing chart
                    commonfunction_plotchart(functionname, seriesdata, chartdivname);
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



/*Bed Strength two*/


   $.ajax({
    method: "GET",
    url: '/bedstrength_two_details',
    dataType: "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
        try {
            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            const chartData = data?.result?.result;
            console.log("Received chart data:", chartData);

            if (Array.isArray(chartData) && chartData.length > 0) {
                const firstItem = chartData[0];
                const functionNames = firstItem.function_name;
                const plotData = firstItem.plotchatdata;

                // Assuming you only want the first chart for now
                const chartdivname = "chartdiv4";

                $.each(functionNames, function (key, functionname) {
                    const seriesdata = plotData[key];

                    destroyExistingRoot(chartdivname); // Optional: clear any existing chart
                    commonfunction_plotchart(functionname, seriesdata, chartdivname);
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


   /*Health Indicators*/


   $.ajax({
    method: "GET",
    url: '/healthindicator_details',
    dataType: "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
        try {
            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            const chartData = data?.result?.result;
            console.log("Received chart data:", chartData);

            if (Array.isArray(chartData) && chartData.length > 0) {
                const firstItem = chartData[0];
                const functionNames = firstItem.function_name;
                const plotData = firstItem.plotchatdata;

                // Assuming you only want the first chart for now
                const chartdivname = "chartdiv5";

                $.each(functionNames, function (key, functionname) {
                    const seriesdata = plotData[key];

                    destroyExistingRoot(chartdivname); // Optional: clear any existing chart
                    commonfunction_plotchart(functionname, seriesdata, chartdivname);
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


/*Family HEalth*/


      $.ajax({
    method: "GET",
    url: '/familyhealth_centersdetails',
    dataType: "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
        try {
            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            const chartData = data?.result?.result;
            console.log("Received chart data:", chartData);

            if (Array.isArray(chartData) && chartData.length > 0) {
                const firstItem = chartData[0];
                const functionNames = firstItem.function_name;
                const plotData = firstItem.plotchatdata;

                // Assuming you only want the first chart for now
                const chartdivname = "chartdiv6";

                $.each(functionNames, function (key, functionname) {
                    const seriesdata = plotData[key];

                    destroyExistingRoot(chartdivname); // Optional: clear any existing chart
                    commonfunction_plotchart(functionname, seriesdata, chartdivname);
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


  /*-------------------------------------------------------*/
  $('.view-all').on('click', function (e) {
    e.preventDefault();

    var type = $(this).data('type'); // birth, death, infant, or others
    console.log("Chart type:", type);

    // Determine URL based on type
    let url = (type === "birth" || type === "death" || type === "infant") 
                ? "/birthratedetails" 
                : "/maternalmortalitydetails";

    // Show modal
    var modal = new bootstrap.Modal(document.getElementById('chartModal'));
    modal.show();

    // Title mapping
    const titleMap = {
      birth: "Birth Rate",
      death: "Death Rate",
      infant: "Infant Mortality Rate"
    };
    const modalTitle = titleMap[type] || "Maternal Mortality";
    $('.modal-title').text(modalTitle);

    $.ajax({
      method: "GET",
      url: url,
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        try {
          if (typeof data === "string") {
            data = JSON.parse(data);
          }

         

          const chartData = data?.result?.result;
          var chartCounter = 1;

          if (Array.isArray(chartData) && chartData.length > 0) {
            // Clear existing chart divs inside modal body
            $("#chartContainer").empty();

            $.each(chartData, function (i, value) {
              $.each(value.function_name, function (key, functionname) {
                var seriesdata = value.plotchatdata[key];
                var chartdivname = "chartdiv" + chartCounter;

                // Create div if missing
                if ($("#" + chartdivname).length === 0) {
                  $("#chartContainer").append(`<div id="${chartdivname}" class="chartdiv" style="width:100%; height:400px;"></div>`);
                }

                // Destroy and re-render
                destroyExistingRoot(chartdivname);
                commonfunction_plotchart(functionname, seriesdata, chartdivname);

                $("#" + chartdivname).show();
                chartCounter++;
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
});
function destroyExistingRoot(chartdivname) {
    // Loop through all registered root elements
    am5.registry.rootElements.forEach(function(root) {
        if (root.dom.id === chartdivname) {
            console.log(`Disposing existing root for: ${chartdivname}`);
            root.dispose();
        }
    });
}



/*=========================================*/

/*$('.category-radio').on('change', function () {
    const selectedCategory = $(this).val();
    $('.chart-section').each(function () {
        const category = $(this).data('category');
        if (selectedCategory === 'all' || category.includes(selectedCategory)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});*/

/*=============Demographics=========================================*/
/*$.ajax({
    method: "GET",
    url: '/demographics',
    dataType: "json",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
        try {
            console.log("Raw response:", data);

            // Parse stringified JSON if necessary
            if (typeof data === "string") {
                try {
                    data = JSON.parse(data);
                } catch (jsonErr) {
                    console.error("JSON parse error:", jsonErr);
                    alert("Invalid JSON response");
                    return;
                }
            }

            const chartData = data?.result?.result;

            if (!Array.isArray(chartData)) {
                console.error("Unexpected structure:", data);
                alert("Invalid chart data format from server");
                return;
            }

            const $container = $("#chartsContainer");
            $container.empty();

            chartData.forEach((item, index) => {
                const functionNames = Array.isArray(item.function_name) ? item.function_name : [item.function_name];
                const plotData = Array.isArray(item.plotchatdata) ? item.plotchatdata : [item.plotchatdata];
                const category = item.category || "all";

                functionNames.forEach((functionName, i) => {
                    const chartId = `chartdiv${index * functionNames.length + i + 1}`;

                    const chartCardHtml = `
                        <div class="col-xxl-6 col-sm-12 chart-section" data-category="${category}">
                            <div class="card mb-3 border">
                                <div class="card-header">
                                    <h5 class="card-title">${functionName}</h5>
                                </div>
                                <div class="card-body" style="width: 100%; height: 400px;">
                                    <div id="${chartId}" style="width: 100%; height: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    `;

                    $container.append(chartCardHtml);

                    // Use timeout to ensure DOM is updated before rendering the chart
                    setTimeout(() => {
                        try {
                            if (!plotData[i]) {
                                console.warn(`Missing plot data for function "${functionName}" at index ${i}`);
                                return;
                            }

                            destroyExistingRoot(chartId);
                            commonfunction_plotchart(functionName, plotData[i], chartId);
                        } catch (chartErr) {
                            console.error(`Chart rendering error for ${functionName} at index ${i}:`, chartErr);
                            alert(`Error rendering chart: ${functionName}`);
                        }
                    }, 0);
                });
            });

        } catch (e) {
            console.error("Unexpected error in AJAX success handler:", e);
            alert("Error parsing server response");
        }
    },

    error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
        alert("Error: " + error);
    }
});
*/


/*=========================================*/
</script>
