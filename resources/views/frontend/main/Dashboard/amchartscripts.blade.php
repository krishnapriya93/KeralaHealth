 <!-- AmCharts scripts -->
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/index.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/percent.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/xy.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/radar.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/themes/Animated.js') }}"></script>
    <script src="{{ asset('assets/frontdashboardnew/amcharts5/plugins/exporting.js') }}"></script>
<script type="text/javascript">
  
am5.addLicense("AM5C296394986");
/*S W I T C H      C A S E */


function commonfunction_plotchart(function_name,series_data,chartdivname)
{

switch (function_name) {
  case "ColumnwithRotatedLabels":ColumnwithRotatedLabels(series_data,chartdivname);
                                  break;
  case "SimpleColumnChart":SimpleColumnChart(series_data,chartdivname);
                                  break;
  case "HundredPercentStackedColumnChart":HundredPercentStackedColumnChart(series_data,chartdivname);
                                  break;
  case "ClusteredColumnChart":ClusteredColumnChart(series_data,chartdivname);
                                  break; 
  case "ImagesAsCategories":ImagesAsCategories(series_data,chartdivname);
                                  break;
  case "StackedClusteredColumnChart":StackedClusteredColumnChart(series_data,chartdivname);
                                  break;
  case "StackedColumnChart":StackedColumnChart(series_data,chartdivname);
                                  break;
  case "StackedBarChart":StackedBarChart(series_data,chartdivname);
                                  break;
  case "ClusteredBarChart":ClusteredBarChart(series_data,chartdivname);
                                  break;
  case "ColumnswithMovingBullets":ColumnswithMovingBullets(series_data,chartdivname);
                                  break;
  case "StepCountChart":StepCountChart(series_data,chartdivname);
                                  break;
  case "CurvedColumnchart":CurvedColumnchart(series_data,chartdivname);
                                  break;
  case "ParetoDiagramChart":ParetoDiagramChart(series_data,chartdivname);
                                  break;
  case "DragorderingofBarsChart":DragorderingofBarsChart(series_data,chartdivname);
                                  break;
  case "VarianceIndicatorsChart":VarianceIndicatorsChart(series_data,chartdivname);
                                  break;
  case "AnimatedBulletEndofSeries":AnimatedBulletEndofSeries(series_data,chartdivname);
                                  break;
  case "ControlChart":ControlChart(series_data,chartdivname);
                                  break;
  case "LogarithmicScale":LogarithmicScale(series_data,chartdivname);
                                  break;
  case "PieChart":PieChart(series_data,chartdivname);
                                  break;
  case "DraggingPieSlices":DraggingPieSlices(series_data,chartdivname);
                                  break;
  case "SimplePieChart":SimplePieChart(series_data,chartdivname);
                                  break;
  case "DonutwithRadialGradient":DonutwithRadialGradient(series_data,chartdivname);
                                  break;
  case "PieChartwithLegend":PieChartwithLegend(series_data,chartdivname);
                                  break;
  case "VariableRadiusPieChart":VariableRadiusPieChart(series_data,chartdivname);
                                  break;
  case "SemiCirclePieChart":SemiCirclePieChart(series_data,chartdivname);
                                  break;
  case "LiveSortingRadarColumns":LiveSortingRadarColumns(series_data,chartdivname);
                                  break;
  case "FunnelwithGradientFill":FunnelwithGradientFill(series_data,chartdivname);
                                  break;
  case "ColumnswithGrainyGradients":ColumnswithGrainyGradients(series_data,chartdivname);
                                  break;

  
              
  default:
              console.log("I don't own a pet");
              break;
}


}



/*switch function close----*/

//Column with Rotated Labels
function ColumnwithRotatedLabels(series_data,chartdivname)
{


  // Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX: true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

xRenderer.grid.template.setAll({
  location: 1
})

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0.3,
  categoryField: "category",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.3,
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  sequencedInterpolation: true,
  categoryXField: "category",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  })
}));

series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
series.columns.template.adapters.add("fill", function(fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", function(stroke, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});


// Set data
/*var data = [{
  country: "USA",
  value: 2025
}, {
  country: "China",
  value: 1882
}, {
  country: "Germany",
  value: 1322
}, {
  country: "Canada",
  value: 441
}];*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
xAxis.data.setAll(series_data);
series.data.setAll(series_data);
//console.log(series_data);


/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}
/*============================================================================*/
//mainly used for data having date field and corresponding value
function SimpleColumnChart(series_data,chartdivname)
{
  // Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX"
}));


// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "zoomX"
}));
cursor.lineY.set("visible", false);

/*var date = new Date();
date.setHours(0, 0, 0, 0);
var value = 100;

function generateData() {
  value = Math.round((Math.random() * 10 - 5) + value);
  am5.time.add(date, "day", 1);
  return {

    date: date.getTime(),
    value: value
  };
}

function generateDatas(count) {
  var data = [];
  for (var i = 0; i < count; ++i) {
    data.push(generateData());
  }
 
  return data;
}*/


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0,
  baseInterval: {
    timeUnit: "day",
    count: 1
  },
  renderer: am5xy.AxisRendererX.new(root, {
    minGridDistance: 60
  }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {})
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  valueXField: "date",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  })
}));

series.columns.template.setAll({ strokeOpacity: 0 })


// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set("scrollbarX", am5.Scrollbar.new(root, {
  orientation: "horizontal"
}));

//var data = generateDatas(10);
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
//console.log(series_data);
series.data.setAll(series_data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);
}
function HundredPercentStackedColumnChart(series_data,chartdivname)
{


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));

// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set("scrollbarX", am5.Scrollbar.new(root, {
  orientation: "horizontal"
}));

/*var data = [{
  "year": "2021",
  "europe": 2.5,
  "namerica": 2.5,
  "asia": 2.1,
  "lamerica": 1,
  "meast": 0.8,
  "africa": 0.4
}, {
  "year": "2022",
  "europe": 2.6,
  "namerica": 2.7,
  "asia": 2.2,
  "lamerica": 0.5,
  "meast": 0.4,
  "africa": 0.3
}, {
  "year": "2023",
  "europe": 2.8,
  "namerica": 2.9,
  "asia": 2.4,
  "lamerica": 0.3,
  "meast": 0.9,
  "africa": 0.5
}];
*/




// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {});
var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

xRenderer.grid.template.setAll({
  location: 1
})

xAxis.data.setAll(series_data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  min: 0,
  max: 100,
  numberFormat: "#'%'",
  strictMinMax: true,
  calculateTotals: true,
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
/*function makeSeries(name, fieldName) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: name,
    stacked: true,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: fieldName,
    valueYShow: "valueYTotalPercent",
    categoryXField: "category"
  }));


  

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}:{valueYTotalPercent.formatNumber('#.#')}%",
    tooltipY: am5.percent(10)
  });
  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      sprite: am5.Label.new(root, {
        text: "{valueYTotalPercent.formatNumber('#.#')}%",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.p50,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
}

makeSeries("Value 1", "value1");
makeSeries("Value 2", "value2");*/

// Create series dynamically based on data
    Object.keys(series_data[0]).forEach((key, index) => {
      if (key !== "category") {
       // console.log(key);
         var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: key,
    stacked: true,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: key,
    valueYShow: "valueYTotalPercent",
    categoryXField: "category"
  }));


  

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}:{valueYTotalPercent.formatNumber('#.#')}%",
    tooltipY: am5.percent(10)
  });
  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      sprite: am5.Label.new(root, {
        text: "{valueYTotalPercent.formatNumber('#.#')}%",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.p50,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
     
      }
    });

/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);
}

/*Clustered Column Chart=========================================================================*/

function ClusteredColumnChart(series_data,chartdivname){
// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(
  am5.Legend.new(root, {
    centerX: am5.p50,
    x: am5.p50
  })
);

/*var data = [{
  "year": "2021",
  "europe": 2.5,
  "namerica": 2.5,
  "asia": 2.1,
  "lamerica": 1,
  "meast": 0.8,
  "africa": 0.4
}, {
  "year": "2022",
  "europe": 2.6,
  "namerica": 2.7,
  "asia": 2.2,
  "lamerica": 0.5,
  "meast": 0.4,
  "africa": 0.3
}, {
  "year": "2023",
  "europe": 2.8,
  "namerica": 2.9,
  "asia": 2.4,
  "lamerica": 0.3,
  "meast": 0.9,
  "africa": 0.5
}]*/


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
 cellStartLocation: 0.05,
  cellEndLocation: 0.95 ,
  minGridDistance: 10
})

xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

xRenderer.grid.template.setAll({
  location: 1
})

xAxis.data.setAll(series_data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
/*function makeSeries(name, fieldName) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: name,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: fieldName,
    categoryXField: "year"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}:{valueY}",
    width: am5.percent(90),
    tooltipY: 0,
    strokeOpacity: 0
  });

  series.data.setAll(data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      locationY: 0,
      sprite: am5.Label.new(root, {
        text: "{valueY}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: 0,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
}

makeSeries("Europe", "europe");
makeSeries("North America", "namerica");
makeSeries("Asia", "asia");
makeSeries("Latin America", "lamerica");
makeSeries("Middle East", "meast");
makeSeries("Africa", "africa");*/


// Create series dynamically based on data
    Object.keys(series_data[0]).forEach((key, index) => {

      if (key !== "category") {
       var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: key,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: key,
    categoryXField: "category"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}:{valueY}",
    width: am5.percent(80),
    tooltipY: 0,
    strokeOpacity: 0
  });

  series.data.setAll(series_data);
  console.log(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      locationY: 0,
      sprite: am5.Label.new(root, {
        text: "{valueY}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: 0,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
     
      }
    });


 /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*var exporting = am5plugins.Exporting.new(root, {
    filePrefix: "myChart",
    backgroundColor: am5.color(0xffffff), // Default background color
    backgroundOpacity: 1,  // Full opacity
    jpgOptions: {
        backgroundColor: am5.color(0xffffff),  // White background only for JPG
        quality: 0.9
    }
});*/
/*Exporting to PNG*/   

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);
}

/*Stacked and Clustered Column Chart=======================================================*/

function StackedClusteredColumnChart(series_data,chartdivname)
{


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}));

/*var data = [{
  "year": "2021",
  "europe": 2.5,
  "namerica": 2.5,
  "asia": 2.1,
  "lamerica": 1,
  "meast": 0.8,
  "africa": 0.4
}, {
  "year": "2022",
  "europe": 2.6,
  "namerica": 2.7,
  "asia": 2.2,
  "lamerica": 0.5,
  "meast": 0.4,
  "africa": 0.3
}, {
  "year": "2023",
  "europe": 2.8,
  "namerica": 2.9,
  "asia": 2.4,
  "lamerica": 0.3,
  "meast": 0.9,
  "africa": 0.5
}];
*/

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
  cellStartLocation: 0.1,
  cellEndLocation: 0.9,
   minGridDistance: 10
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

xRenderer.grid.template.setAll({
  location: 1
})

xAxis.data.setAll(series_data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  min: 0,
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
/*function makeSeries(name, fieldName, stacked) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    stacked: stacked,
    name: name,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: fieldName,
    categoryXField: "year"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}:{valueY}",
    width: am5.percent(90),
    tooltipY: am5.percent(10)
  });
  series.data.setAll(data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      locationY: 0.5,
      sprite: am5.Label.new(root, {
        text: "{valueY}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.percent(50),
        centerX: am5.percent(50),
        populateText: true
      })
    });
  });

  legend.data.push(series);
}

makeSeries("Europe", "europe", false);
makeSeries("North America", "namerica", true);
makeSeries("Asia", "asia", false);
makeSeries("Latin America", "lamerica", true);
makeSeries("Middle East", "meast", true);
makeSeries("Africa", "africa", true);
*/



// Create series dynamically based on data
    Object.keys(series_data[0]).forEach((key, index) => {
      if (key !== "category") {
      var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    stacked: true,
    name: key,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: key,
    categoryXField: "category"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}:{valueY}",
    width: am5.percent(90),
    tooltipY: am5.percent(10)
  });
  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      locationY: 0.5,
      sprite: am5.Label.new(root, {
        text: "{valueY}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.percent(50),
        centerX: am5.percent(50),
        populateText: true
      })
    });
  });

  legend.data.push(series);
     
      }
    });


    /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}


/*Stacked Column Chart=====================================================*/

function StackedColumnChart(series_data,chartdivname)
{

  // Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));

// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set("scrollbarX", am5.Scrollbar.new(root, {
  orientation: "horizontal"
}));

/*var data = [{
  "year": "2021",
  "europe": 2.5,
  "namerica": 2.5,
  "asia": 2.1,
  "lamerica": 1,
  "meast": 0.8,
  "africa": 0.4
}, {
  "year": "2022",
  "europe": 2.6,
  "namerica": 2.7,
  "asia": 2.2,
  "lamerica": 0.5,
  "meast": 0.4,
  "africa": 0.3
}, {
  "year": "2023",
  "europe": 2.8,
  "namerica": 2.9,
  "asia": 2.4,
  "lamerica": 0.3,
  "meast": 0.9,
  "africa": 0.5
}]*/


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {});
var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

xRenderer.grid.template.setAll({
  location: 1
})

xAxis.data.setAll(series_data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  min: 0,
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
/*function makeSeries(name, fieldName) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: name,
    stacked: true,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: fieldName,
    categoryXField: "year"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}: {valueY}",
    tooltipY: am5.percent(10)
  });
  series.data.setAll(data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      sprite: am5.Label.new(root, {
        text: "{valueY}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.p50,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
}

makeSeries("Europe", "europe");
makeSeries("North America", "namerica");
makeSeries("Asia", "asia");
makeSeries("Latin America", "lamerica");
makeSeries("Middle East", "meast");
makeSeries("Africa", "africa");

*/
Object.keys(series_data[0]).forEach((key, index) => {
      if (key !== "category") {

      var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: key,
    stacked: true,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: key,
    categoryXField: "category"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryX}: {valueY}",
    tooltipY: am5.percent(10)
  });
  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      sprite: am5.Label.new(root, {
        text: "{valueY}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.p50,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
      }
    });


/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}


/*Stacked Bar Chart=================================================================*/

function  StackedBarChart(series_data,chartdivname){



// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


var myTheme = am5.Theme.new(root);

myTheme.rule("Grid", ["base"]).setAll({
  strokeOpacity: 0.1
});


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root),
  myTheme
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panY",
  wheelY: "zoomY",
  layout: root.verticalLayout
}));

// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set("scrollbarY", am5.Scrollbar.new(root, {
  orientation: "vertical"
}));

/*var data = [{
  "year": "2021",
  "europe": 2.5,
  "namerica": 2.5,
  "asia": 2.1,
  "lamerica": 1,
  "meast": 0.8,
  "africa": 0.4
}, {
  "year": "2022",
  "europe": 2.6,
  "namerica": 2.7,
  "asia": 2.2,
  "lamerica": 0.5,
  "meast": 0.4,
  "africa": 0.3
}, {
  "year": "2023",
  "europe": 2.8,
  "namerica": 2.9,
  "asia": 2.4,
  "lamerica": 0.3,
  "meast": 0.9,
  "africa": 0.5
}]
*/

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var yRenderer = am5xy.AxisRendererY.new(root, {});
var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: yRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

yRenderer.grid.template.setAll({
  location: 1
})

yAxis.data.setAll(series_data);

var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
  min: 0,
  renderer: am5xy.AxisRendererX.new(root, {
    strokeOpacity: 0.1
  })
}));

// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
/*function makeSeries(name, fieldName) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: name,
    stacked: true,
    xAxis: xAxis,
    yAxis: yAxis,
    baseAxis: yAxis,
    valueXField: fieldName,
    categoryYField: "year"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryY}: {valueX}",
    tooltipY: am5.percent(90)
  });
  series.data.setAll(data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      sprite: am5.Label.new(root, {
        text: "{valueX}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.p50,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
}

makeSeries("Europe", "europe");
makeSeries("North America", "namerica");
makeSeries("Asia", "asia");
makeSeries("Latin America", "lamerica");
makeSeries("Middle East", "meast");
makeSeries("Africa", "africa");
*/


Object.keys(series_data[0]).forEach((key, index) => {
      if (key !== "category") {

         var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: key,
    stacked: true,
    xAxis: xAxis,
    yAxis: yAxis,
    baseAxis: yAxis,
    valueXField: key,
    categoryYField: "category"
  }));

  series.columns.template.setAll({
    tooltipText: "{name}, {categoryY}: {valueX}",
    tooltipY: am5.percent(90)
  });
  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      sprite: am5.Label.new(root, {
        text: "{valueX}",
        fill: root.interfaceColors.get("alternativeText"),
        centerY: am5.p50,
        centerX: am5.p50,
        populateText: true
      })
    });
  });

  legend.data.push(series);
      }
    });


/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}


/* =================Step Count Chart================================================ */

function StepCountChart(series_data,chartdivname)
{

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  root.dateFormatter.setAll({
    dateFormat: "yyyy-MM-dd",
    dateFields: ["valueX"]
  });

  /*var data = [
    {
      date: "2021-01-01",
      steps: 4561
    },
    {
      date: "2021-01-02",
      steps: 5687
    },
    {
      date: "2021-01-03",
      steps: 6348
    },
    {
      date: "2021-01-04",
      steps: 4878
    },
    {
      date: "2021-01-05",
      steps: 9867
    },
    {
      date: "2021-01-06",
      steps: 7561
    },
    {
      date: "2021-01-07",
      steps: 1287
    },
    {
      date: "2021-01-08",
      steps: 3298
    },
    {
      date: "2021-01-09",
      steps: 5697
    },
    {
      date: "2021-01-10",
      steps: 4878
    },
    {
      date: "2021-01-11",
      steps: 8788
    },
    {
      date: "2021-01-12",
      steps: 9560
    },
    {
      date: "2021-01-13",
      steps: 11687
    },
    {
      date: "2021-01-14",
      steps: 5878
    },
    {
      date: "2021-01-15",
      steps: 9789
    },
    {
      date: "2021-01-16",
      steps: 3987
    },
    {
      date: "2021-01-17",
      steps: 5898
    },
    {
      date: "2021-01-18",
      steps: 9878
    },
    {
      date: "2021-01-19",
      steps: 13687
    },
    {
      date: "2021-01-20",
      steps: 6789
    },
    {
      date: "2021-01-21",
      steps: 4531
    },
    {
      date: "2021-01-22",
      steps: 5856
    },
    {
      date: "2021-01-23",
      steps: 5737
    },
    {
      date: "2021-01-24",
      steps: 9987
    },
    {
      date: "2021-01-25",
      steps: 16457
    },
    {
      date: "2021-01-26",
      steps: 7878
    },
    {
      date: "2021-01-27",
      steps: 6845
    },
    {
      date: "2021-01-28",
      steps: 4659
    },
    {
      date: "2021-01-29",
      steps: 7892
    },
    {
      date: "2021-01-30",
      steps: 7362
    },
    {
      date: "2021-01-31",
      steps: 3268
    }
  ];*/

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
      focusable: true,
      panX: true,
      panY: false,
      wheelX: "panX",
      wheelY: "none"
    })
  );

  var easing = am5.ease.linear;

  // hide zoomout button
  chart.zoomOutButton.set("forceHidden", true);

  // add label
  chart.plotContainer.children.push(
    am5.Label.new(root, { text: "Pan chart to change date", x: 100, y: 50 })
  );

  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xRenderer = am5xy.AxisRendererX.new(root, {
    minGridDistance: 50,
    strokeOpacity: 0.2
  });
  xRenderer.grid.template.set("forceHidden", true);

  var xAxis = chart.xAxes.push(
    am5xy.DateAxis.new(root, {
      maxDeviation: 0.49,
      snapTooltip: false,
      baseInterval: {
        timeUnit: "day",
        count: 1
      },
      renderer: xRenderer,
      tooltip: am5.Tooltip.new(root, {})
    })
  );

  var yRenderer = am5xy.AxisRendererY.new(root, { inside: true });
  yRenderer.grid.template.set("forceHidden", true);

  var yAxis = chart.yAxes.push(
    am5xy.ValueAxis.new(root, {
      maxDeviation: 0,
      renderer: yRenderer
    })
  );

  // Add series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(
    am5xy.ColumnSeries.new(root, {
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "value",
      valueXField: "date",
      tooltip: am5.Tooltip.new(root, {
        pointerOrientation: "vertical",
        labelText: "{valueY}"
      })
    })
  );

  series.columns.template.setAll({
    cornerRadiusTL: 15,
    cornerRadiusTR: 15,
    maxWidth: 30,
    strokeOpacity: 0
  });

  series.columns.template.adapters.add("fill", function (fill, target) {
    if (target.dataItem.get("valueY") < 6000) {
      return am5.color(0xdadada);
    }
    return fill;
  });

  // Set up data processor to parse string dates
  // https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
  series.data.processor = am5.DataProcessor.new(root, {
    dateFormat: "yyyy-MM-dd",
    dateFields: ["date"]
  });

  series.data.setAll(series_data);

  /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

  // do not allow tooltip  to move horizontally
  series.get("tooltip").adapters.add("x", function (x) {
    return chart.plotContainer.toGlobal({
      x: chart.plotContainer.width() / 2,
      y: 0
    }).x;
  });

  // add ranges
  var goalRange = yAxis.createAxisRange(yAxis.makeDataItem({
    value: 6000
  }));

  goalRange.get("grid").setAll({
    forceHidden: false,
    strokeOpacity: 0.2
  });

  var goalLabel = goalRange.get("label");

  goalLabel.setAll({
    centerY: am5.p100,
    centerX: am5.p100,
    text: "Goal"
  });

  // put to other side
  goalLabel.adapters.add("x", function (x) {
    return chart.plotContainer.width();
  });

  var goalRange2 = yAxis.createAxisRange(yAxis.makeDataItem({
    value: 12000
  }));

  goalRange2.get("grid").setAll({
    forceHidden: false,
    strokeOpacity: 0.2
  });

  var goalLabel2 = goalRange2.get("label");

  goalLabel2.setAll({
    centerY: am5.p100,
    centerX: am5.p100,
    text: "2 x Goal"
  });

  // put to other side
  goalLabel2.adapters.add("x", function (x) {
    return chart.plotContainer.width();
  });

  // reposition when width changes
  chart.plotContainer.onPrivate("width", function () {
    goalLabel.markDirtyPosition();
    goalLabel2.markDirtyPosition();
  });

  // Add cursor
  // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
    alwaysShow: true,
    behavior: "none",
    positionX: 0.5 // make it always be at the center
  }));
  cursor.lineY.set("visible", false);

  // zoom to last 11 days   commented on 27/03/2024
  /*-----------commented on 27/03/2024-----------------------------------
  series.events.on("datavalidated", function () {
    var toTime =
      series.dataItems[series.dataItems.length - 1].get("valueX") +
      am5.time.getDuration("day", 1);
    var fromTime = series.dataItems[series.dataItems.length - 11].get("valueX");

    xAxis.zoomToValues(fromTime, toTime);
  });-----------commented on 27/03/2024-----------------------------------*/

  // when plot are is released, round zoom to nearest days
  chart.plotContainer.events.on("globalpointerup", function () {
    var dayDuration = am5.time.getDuration("day", 1);

    var firstTime = am5.time
      .round(new Date(series.dataItems[0].get("valueX")), "day", 1)
      .getTime();
    var lastTime =
      series.dataItems[series.dataItems.length - 1].get("valueX") + dayDuration;
    var totalTime = lastTime - firstTime;
    var days = totalTime / dayDuration;

    var roundedStart =
      firstTime + Math.round(days * xAxis.get("start")) * dayDuration;
    var roundedEnd =
      firstTime + Math.round(days * xAxis.get("end")) * dayDuration;

    xAxis.zoomToValues(roundedStart, roundedEnd);
  });

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  chart.appear(1000, 50);

}

/* =========================Curved Columns Chart==================================== */

function CurvedColumnchart(series_data,chartdivname)
{

  var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
      panX: true,
      panY: true,
      wheelX: "panX",
      wheelY: "zoomX"
    })
  );

  // Add cursor
  // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
  cursor.lineY.set("visible", false);

  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });

  var xAxis = chart.xAxes.push(
    am5xy.CategoryAxis.new(root, {
      maxDeviation: 0.3,
      categoryField: "category",
      renderer: xRenderer,
      tooltip: am5.Tooltip.new(root, {})
    })
  );

  xRenderer.grid.template.setAll({
    location: 1
  })

  var yAxis = chart.yAxes.push(
    am5xy.ValueAxis.new(root, {
      maxDeviation: 0.3,
      renderer: am5xy.AxisRendererY.new(root, {
        strokeOpacity: 0.1
      })
    })
  );

  // Create series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(
    am5xy.ColumnSeries.new(root, {
      name: "Series 1",
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "value",
      sequencedInterpolation: true,
      categoryXField: "category"
    })
  );

  series.columns.template.setAll({
    width: am5.percent(120),
    fillOpacity: 0.9,
    strokeOpacity: 0
  });
  series.columns.template.adapters.add("fill", (fill, target) => {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
  });

  series.columns.template.adapters.add("stroke", (stroke, target) => {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
  });

  series.columns.template.set("draw", function(display, target) {
    var w = target.getPrivate("width", 0);
    var h = target.getPrivate("height", 0);
    display.moveTo(0, h);
    display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
    display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
  });

  // Set data
 /* var data = [{
    country: "USA",
    value: 2025
  }, {
    country: "China",
    value: 1882
  }, {
    country: "Japan",
    value: 1809
  }, {
    country: "Germany",
    value: 1322
  }, {
    country: "UK",
    value: 1122
  }, {
    country: "France",
    value: 1114
  }, {
    country: "India",
    value: 984
  }, {
    country: "Spain",
    value: 711
  }, {
    country: "Netherlands",
    value: 665
  }, {
    country: "South Korea",
    value: 443
  }, {
    country: "Canada",
    value: 441
  }];*/

  xAxis.data.setAll(series_data);
  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear(1000);
  chart.appear(1000, 100);

}

/* ============================ParetoDiagram Chart=================================== */

function ParetoDiagramChart(series_data,chartdivname){
  // Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

  root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  paddingLeft: 0,
  paddingRight: 0,
  layout: root.verticalLayout
}));

var colors = chart.get("colors");

/*var data = [{
  country: "US",
  visits: 725
}, {
  country: "UK",
  visits: 625
}, {
  country: "China",
  visits: 602
}, {
  country: "Japan",
  visits: 509
}, {
  country: "Germany",
  visits: 322
}, {
  country: "France",
  visits: 214
}, {
  country: "India",
  visits: 204
}, {
  country: "Spain",
  visits: 198
}, {
  country: "Netherlands",
  visits: 165
}, {
  country: "South Korea",
  visits: 93
}, {
  country: "Canada",
  visits: 41
}];
*/
prepareParetoData();

function prepareParetoData() {
  var total = 0;

  for (var i = 0; i < series_data.length; i++) {
    var value = series_data[i].valuedata;
    total += value;
  }

  var sum = 0;
  for (var i = 0; i < series_data.length; i++) {
    var value = series_data[i].valuedata;
    sum += value;
    series_data[i].pareto = sum / total * 100;
  }
}



// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
  minGridDistance: 85,
  minorGridEnabled: true
})

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: xRenderer
}));

xRenderer.grid.template.setAll({
  location: 1
})

xRenderer.labels.template.setAll({
  paddingTop: 20
});

xAxis.data.setAll(series_data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));

var paretoAxisRenderer = am5xy.AxisRendererY.new(root, { opposite: true });
var paretoAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: paretoAxisRenderer,
  min: 0,
  max: 100,
  strictMinMax: true
}));

paretoAxisRenderer.grid.template.set("forceHidden", false);
paretoAxis.set("numberFormat", "#'%");


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "valuedata",
  categoryXField: "category"
}));

series.columns.template.setAll({
  tooltipText: "{categoryX}: {valueY}",
  tooltipY: 0,
  strokeOpacity: 0,
  cornerRadiusTL: 6,
  cornerRadiusTR: 6
});

series.columns.template.adapters.add("fill", function (fill, target) {
  return chart.get("colors").getIndex(series.dataItems.indexOf(target.dataItem));
})


// pareto series
var paretoSeries = chart.series.push(am5xy.LineSeries.new(root, {
  xAxis: xAxis,
  yAxis: paretoAxis,
  valueYField: "pareto",
  categoryXField: "category",
  stroke: root.interfaceColors.get("alternativeBackground"),
  maskBullets: true
}));

paretoSeries.bullets.push(function () {
  return am5.Bullet.new(root, {
    locationY: 1,
    sprite: am5.Circle.new(root, {
      radius: 5,
      fill: series.get("fill"),
      stroke: root.interfaceColors.get("alternativeBackground")
    })
  })
});
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

series.data.setAll(series_data);
paretoSeries.data.setAll(series_data);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear();
chart.appear(1000, 100);
}

/* ======================Drag ordering of Bars Chart================== */

function DragorderingofBarsChart(series_data,chartdivname){
  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);


  var myTheme = am5.Theme.new(root);

  myTheme.rule("Grid", ["base"]).setAll({
    strokeOpacity: 0.1
  });


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root),
    myTheme
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
      panX: false,
      panY: false,
      wheelX: "none",
      wheelY: "none"
    })
  );


  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var yRenderer = am5xy.AxisRendererY.new(root, { minGridDistance: 30 });
  yRenderer.grid.template.set("location", 1);

  var yAxis = chart.yAxes.push(
    am5xy.CategoryAxis.new(root, {
      maxDeviation: 0,
      categoryField: "category",
      renderer: yRenderer
    })
  );

  var xAxis = chart.xAxes.push(
    am5xy.ValueAxis.new(root, {
      maxDeviation: 0,
      min: 0,
      renderer: am5xy.AxisRendererX.new(root, {
        visible: true,
        strokeOpacity: 0.1
      })
    })
  );


  // Create series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(
    am5xy.ColumnSeries.new(root, {
      name: "Series 1",
      xAxis: xAxis,
      yAxis: yAxis,
      valueXField: "value",
      sequencedInterpolation: true,
      categoryYField: "category"
    })
  );

  var columnTemplate = series.columns.template;

  columnTemplate.setAll({
    draggable: true,
    cursorOverStyle: "pointer",
    tooltipText: "drag to rearrange",
    cornerRadiusBR: 10,
    cornerRadiusTR: 10,
    strokeOpacity: 0
  });
  columnTemplate.adapters.add("fill", (fill, target) => {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
  });

  columnTemplate.adapters.add("stroke", (stroke, target) => {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
  });

  columnTemplate.events.on("dragstop", () => {
    sortCategoryAxis();
  });

  // Get series item by category
  function getSeriesItem(category) {
    for (var i = 0; i < series.dataItems.length; i++) {
      var dataItem = series.dataItems[i];
      if (dataItem.get("categoryY") == category) {
        return dataItem;
      }
    }
  }


  // Axis sorting
  function sortCategoryAxis() {
    // Sort by value
    series.dataItems.sort(function(x, y) {
      return y.get("graphics").y() - x.get("graphics").y();
    });

    var easing = am5.ease.out(am5.ease.cubic);

    // Go through each axis item
    am5.array.each(yAxis.dataItems, function(dataItem) {
      // get corresponding series item
      var seriesDataItem = getSeriesItem(dataItem.get("category"));

      if (seriesDataItem) {
        // get index of series data item
        var index = series.dataItems.indexOf(seriesDataItem);

        var column = seriesDataItem.get("graphics");

        // position after sorting
        var fy =
          yRenderer.positionToCoordinate(yAxis.indexToPosition(index)) -
          column.height() / 2;

        // set index to be the same as series data item index
        if (index != dataItem.get("index")) {
          dataItem.set("index", index);

          // current position
          var x = column.x();
          var y = column.y();

          column.set("dy", -(fy - y));
          column.set("dx", x);

          column.animate({ key: "dy", to: 0, duration: 600, easing: easing });
          column.animate({ key: "dx", to: 0, duration: 600, easing: easing });
        } else {
          column.animate({ key: "y", to: fy, duration: 600, easing: easing });
          column.animate({ key: "x", to: 0, duration: 600, easing: easing });
        }
      }
    });

    // Sort axis items by index.
    // This changes the order instantly, but as dx and dy is set and animated,
    // they keep in the same places and then animate to true positions.
    yAxis.dataItems.sort(function(x, y) {
      return x.get("index") - y.get("index");
    });
  }

  // Set data
  /*var data = [{
    country: "USA",
    value: 2025
  }, {
    country: "China",
    value: 1882
  }, {
    country: "Japan",
    value: 1809
  }, {
    country: "Germany",
    value: 1322
  }, {
    country: "UK",
    value: 1122
  }];*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
  yAxis.data.setAll(series_data);
  series.data.setAll(series_data);


  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear(1000);
  chart.appear(1000, 100);

}

/* ===================Variance Indicators Chart============================ */ 

function VarianceIndicatorsChart(series_data,chartdivname){


var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "none",
    wheelY: "none",
    layout: root.verticalLayout
  }));


  // Data
  /*var data = [{
    year: "2015",
    value: 600000
  }, {
    year: "2016",
    value: 900000
  }, {
    year: "2017",
    value: 180000
  }, {
    year: "2018",
    value: 600000
  }, {
    year: "2019",
    value: 350000
  }, {
    year: "2020",
    value: 600000
  }, {
    year: "2021",
    value: 670000
  }];*/

  // Populate data
  for (var i = 0; i < (series_data.length - 1); i++) {
    series_data[i].valueNext = series_data[i + 1].value;
  }


  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xRenderer = am5xy.AxisRendererX.new(root, {
    cellStartLocation: 0.1,
    cellEndLocation: 0.9,
    minGridDistance: 30
  });

  var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
    categoryField: "category",
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root, {})
  }));

  xRenderer.grid.template.setAll({
    location: 1
  })

  xAxis.data.setAll(series_data);

  var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    min: 0,
    renderer: am5xy.AxisRendererY.new(root, {
      strokeOpacity: 0.1
    })
  }));


  // Add series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/

  // Column series
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    categoryXField: "category"
  }));

  series.columns.template.setAll({
    tooltipText: "{categoryX}: {valueY}",
    width: am5.percent(90),
    tooltipY: 0
  });
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
  series.data.setAll(series_data);

  // Variance indicator series
  var series2 = chart.series.push(am5xy.ColumnSeries.new(root, {
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "valueNext",
    openValueYField: "value",
    categoryXField: "category",
    fill: am5.color(0x555555),
    stroke: am5.color(0x555555)
  }));

  series2.columns.template.setAll({
    width: 1
  });

  series2.data.setAll(series_data);

  series2.bullets.push(function() {
    var label = am5.Label.new(root, {
      text: "{valueY}",
      fontWeight: "500",
      fill: am5.color(0x00cc00),
      centerY: am5.p100,
      centerX: am5.p50,
      populateText: true
    });

    // Modify text of the bullet with percent
    label.adapters.add("text", function(text, target) {
      var percent = getVariancePercent(target.dataItem);
      return percent ? percent + "%" : text;
    });

    // Set dynamic color of the bullet
    label.adapters.add("centerY", function(center, target) {
      return getVariancePercent(target.dataItem) < 0 ? 0 : center;
    });

    // Set dynamic color of the bullet
    label.adapters.add("fill", function(fill, target) {
      return getVariancePercent(target.dataItem) < 0 ? am5.color(0xcc0000) : fill;
    });

    return am5.Bullet.new(root, {
      locationY: 1,
      sprite: label
    });
  });

  series2.bullets.push(function() {
    var arrow = am5.Graphics.new(root, {
      rotation: -90,
      centerX: am5.p50,
      centerY: am5.p50,
      dy: 3,
      fill: am5.color(0x555555),
      stroke: am5.color(0x555555),
      draw: function(display) {
        display.moveTo(0, -3);
        display.lineTo(8, 0);
        display.lineTo(0, 3);
        display.lineTo(0, -3);
      }
    });

    arrow.adapters.add("rotation", function(rotation, target) {
      return getVariancePercent(target.dataItem) < 0 ? 90 : rotation;
    });

    arrow.adapters.add("dy", function(dy, target) {
      return getVariancePercent(target.dataItem) < 0 ? -3 : dy;
    });

    return am5.Bullet.new(root, {
      locationY: 1,
      sprite: arrow
    })
  })


  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear();
  chart.appear(1000, 100);


  function getVariancePercent(dataItem) {
    if (dataItem) {
      var value = dataItem.get("valueY");
      var openValue = dataItem.get("openValueY");
      var change = value - openValue;
      return Math.round(change / openValue * 100);
    }
    return 0;
  }
}


/* --------Animated Bullet End of Series Chart----------- */

function AnimatedBulletEndofSeries(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    pinchZoomX:true
  }));

  chart.get("colors").set("step", 3);


  // Add cursor
  // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
  cursor.lineY.set("visible", false);


  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
    maxDeviation: 0.3,
    baseInterval: {
      timeUnit: "day",
      count: 1
    },
    renderer: am5xy.AxisRendererX.new(root, {}),
    tooltip: am5.Tooltip.new(root, {})
  }));

  var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    maxDeviation: 0.3,
    renderer: am5xy.AxisRendererY.new(root, {})
  }));


  // Create series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(am5xy.LineSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    valueXField: "date",
    tooltip: am5.Tooltip.new(root, {
      labelText: "{valueY}"
    })
  }));
  series.strokes.template.setAll({
    strokeWidth: 2,
    strokeDasharray: [3, 3]
  });

  // Create animating bullet by adding two circles in a bullet container and
  // animating radius and opacity of one of them.
  series.bullets.push(function(root, series, dataItem) {  
    if (dataItem.dataContext.bullet) {    
      var container = am5.Container.new(root, {});
      var circle0 = container.children.push(am5.Circle.new(root, {
        radius: 5,
        fill: am5.color(0xff0000)
      }));
      var circle1 = container.children.push(am5.Circle.new(root, {
        radius: 5,
        fill: am5.color(0xff0000)
      }));

      circle1.animate({
        key: "radius",
        to: 20,
        duration: 1000,
        easing: am5.ease.out(am5.ease.cubic),
        loops: Infinity
      });
      circle1.animate({
        key: "opacity",
        to: 0,
        from: 1,
        duration: 1000,
        easing: am5.ease.out(am5.ease.cubic),
        loops: Infinity
      });

      return am5.Bullet.new(root, {
        sprite: container
      })
    }
  })

  // Set data
  /*var data = [{
    date: new Date(2021, 5, 12).getTime(),
    value: 50
  }, {
    date: new Date(2021, 5, 13).getTime(),
    value: 53
  }, {
    date: new Date(2021, 5, 14).getTime(),
    value: 56
  }, {
    date: new Date(2021, 5, 15).getTime(),
    value: 52
  }, {
    date: new Date(2021, 5, 16).getTime(),
    value: 48
  }, {
    date: new Date(2021, 5, 17).getTime(),
    value: 47
  }, {
    date: new Date(2021, 5, 18).getTime(),
    value: 59,
    bullet: true
  }]*/

  /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

  series.data.setAll(series_data);


  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear(1000);
  chart.appear(1000, 100);
}

/* ==============================Control Chart======================================= */

function ControlChart(series_data,chartdivname){


   var root = am5.Root.new(chartdivname);
  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    pinchZoomX:true
  }));

  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xRenderer = am5xy.AxisRendererX.new(root, {});
  xRenderer.grid.template.set("forceHidden", true);
  xRenderer.labels.template.setAll({multiLocation: 0, location:0});

  var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
    baseInterval: { timeUnit: "minute", count: 30 },
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root, {}),
    extraMin: 0.01,
    extraMax: 0.01,
    tooltipLocation: 0
  }));

  var yRenderer = am5xy.AxisRendererY.new(root, {});
  yRenderer.grid.template.set("forceHidden", true);

  var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    renderer: yRenderer
  }));

  // Add cursor
  // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
    behavior: "none",
    xAxis: xAxis
  }));
  cursor.lineY.set("visible", false);

  // Add series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(am5xy.LineSeries.new(root, {
    name: "Series",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    valueXField: "timestamp",
    locationX: 0,
    seriesTooltipTarget: "bullet",
    tooltip: am5.Tooltip.new(root, {
      labelText: "{valueY}"
    })
  }));

  series.bullets.push(function() {
    var circleTemplate = am5.Template.new({
      radius: 6,
      templateField: "bulletSettings",
      fill: series.get("fill"),
      strokeWidth: 2,
      stroke: root.interfaceColors.get("background")
    })

    var circle = am5.Circle.new(root, {}, circleTemplate);

    return am5.Bullet.new(root, {
      sprite: circle,
      locationX: 0
    });
  });

  function createGuide(value, text, dashArray) {
    var guideDataItem = yAxis.makeDataItem({ value: value });
    yAxis.createAxisRange(guideDataItem);
    guideDataItem.get("grid").setAll({
      forceHidden: false,
      strokeOpacity: 0.2,
      strokeDasharray: dashArray
    });

    var label = guideDataItem.get("label");
    label.setAll({
      text: text,
      isMeasured: false,
      centerY: am5.p100
    });

    label.adapters.add("x", function(x) {
      return chart.plotContainer.width();
    })
    
    chart.events.on("boundschanged", function(){
      label.set("x", label.get("x"))
    })  
  }


  createGuide(98.8, "LCL", [2, 2]);
  createGuide(100.1, "CL");
  createGuide(101.2, "UCL", [2, 2]);


 /* var data = [{
    "timestamp": new Date(2020, 0, 1, 22, 30).getTime(),
    "value": 99.71
  }, {
    "timestamp": new Date(2020, 0, 1, 23, 0).getTime(),
    "value": 99.13
  }, {
    "timestamp": new Date(2020, 0, 1, 23, 30).getTime(),
    "value": 98.5
  }, {
    "timestamp": new Date(2020, 0, 2, 0, 0).getTime(),
    "value": 101
  }, {
    "timestamp": new Date(2020, 0, 2, 0, 30).getTime(),
    "value": 99.45
  }, {
    "timestamp": new Date(2020, 0, 2, 1, 0).getTime(),
    "value": 100.9
  }, {
    "timestamp": new Date(2020, 0, 2, 1, 30).getTime(),
    "value": 100.39
  }, {
    "timestamp": new Date(2020, 0, 2, 2, 0).getTime(),
    "value": 101.1
  }, {
    "timestamp": new Date(2020, 0, 2, 2, 30).getTime(),
    "value": 101.45
  }, {
    "timestamp": new Date(2020, 0, 2, 3, 0).getTime(),
    "value": 101.15
  }, {
    "timestamp": new Date(2020, 0, 2, 3, 30).getTime(),
    "value": 100.5
  }, {
    "timestamp": new Date(2020, 0, 2, 4, 0).getTime(),
    "value": 101.55,
    "bulletSettings": { fill: am5.color("#f0c803") }
  }, {
    "timestamp": new Date(2020, 0, 2, 4, 30).getTime(),
    "value": 101.7,
    "bulletSettings": { fill: am5.color("#970505") }
  }, {
    "timestamp": new Date(2020, 0, 2, 5, 0).getTime(),
    "value": 100.5,
    "bulletSettings": { fill: am5.color("#f0c803") }
  }, {
    "timestamp": new Date(2020, 0, 2, 5, 30).getTime(),
    "value": 100.92,
    "bulletSettings": { fill: am5.color("#f0c803") }
  }, {
    "timestamp": new Date(2020, 0, 2, 6, 0).getTime(),
    "value": 102.2,
    "bulletSettings": { fill: am5.color("#970505") }
  }];*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

  series.data.setAll(series_data);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear(1000);
  chart.appear(1000, 100);
}

/* =========== Logarithmic Scale Chart================================ */

function LogarithmicScale(series_data,chartdivname){
  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  root.dateFormatter.setAll({
    dateFormat: "yyyy",
    dateFields: ["valueX"]
  });


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    pinchZoomX:true
  }));


  // Add cursor
  // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
    behavior: "none"
  }));
  cursor.lineY.set("visible", false);


  // Data
  /*var data = [
    { year: "1950", value: 2 },
    { year: "1951", value: 4 },
    { year: "1952", value: 15 },
    { year: "1953", value: 21 },
    { year: "1954", value: 25 },
    { year: "1955", value: 18 },
    { year: "1956", value: 33 },
    { year: "1957", value: 103 },
    { year: "1958", value: 88 },
    { year: "1959", value: 205 },
    { year: "1960", value: 333 },
    { year: "1961", value: 185 },
    { year: "1962", value: 788 },
    { year: "1963", value: 1020 },
    { year: "1964", value: 658 },
    { year: "1965", value: 201 },
    { year: "1966", value: 1054 },
    { year: "1967", value: 999 },
    { year: "1968", value: 2002 },
    { year: "1969", value: 2235 },
    { year: "1970", value: 1423 },
    { year: "1971", value: 3564 },
    { year: "1972", value: 3987 },
    { year: "1973", value: 4235 },
    { year: "1974", value: 3487 },
    { year: "1975", value: 2987 },
    { year: "1976", value: 6789 },
    { year: "1977", value: 7354 },
    { year: "1978", value: 5457 },
    { year: "1979", value: 6784 },
    { year: "1980", value: 7878 },
    { year: "1981", value: 6987 },
    { year: "1982", value: 5787 },
    { year: "1983", value: 8978 },
    { year: "1984", value: 10003 },
    { year: "1985", value: 7898 },
    { year: "1986", value: 9878 },
    { year: "1987", value: 11235 },
    { year: "1988", value: 10248 },
    { year: "1989", value: 14589 },
    { year: "1990", value: 19878 },
    { year: "1991", value: 20325 },
    { year: "1992", value: 18978 },
    { year: "1993", value: 17485 },
    { year: "1994", value: 15234 },
    { year: "1995", value: 12345 },
    { year: "1996", value: 12584 },
    { year: "1997", value: 13698 },
    { year: "1998", value: 12568 },
    { year: "1999", value: 12587 },
    { year: "2000", value: 16987 },
    { year: "2001", value: 16779 },
    { year: "2002", value: 19878 },
    { year: "2003", value: 15687 },
    { year: "2004", value: 19878 },
    { year: "2005", value: 23212 }
  ];*/

  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
    baseInterval: { timeUnit: "year", count: 1 },
    renderer: am5xy.AxisRendererX.new(root, {}),
    tooltip: am5.Tooltip.new(root, {})
  }));

  var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    logarithmic: true,
    renderer: am5xy.AxisRendererY.new(root, {})
  }));

  // Add series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(am5xy.LineSeries.new(root, {
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    valueXField: "year",
    tooltip: am5.Tooltip.new(root, {
      labelText: "{valueX}: {valueY}"
    })
  }));

  series.strokes.template.setAll({
    strokeWidth: 3
  });

  // Set up data processor to parse string dates
  // https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
  series.data.processor = am5.DataProcessor.new(root, {
    dateFormat: "yyyy",
    dateFields: ["year"]
  });

  series.data.setAll(series_data);

/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
  // Add scrollbar
  // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
  chart.set("scrollbarX", am5.Scrollbar.new(root, {
    orientation: "horizontal"
  }));


  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear(1000);
  chart.appear(1000, 100);

}

/* ==================Pie Chart========================================*/

function PieChart(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = root.container.children.push(
    am5percent.PieChart.new(root, {
      endAngle: 270
    })
  );

  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(
    am5percent.PieSeries.new(root, {
      valueField: "value",
      categoryField: "category",
      endAngle: 270
    })
  );

  series.states.create("hidden", {
    endAngle: -90
  });

/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/

  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  series.data.setAll(series_data);

  series.appear(1000, 100);
}


/* ================Dragging Pie Slices Chart========================= */

function DraggingPieSlices(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  // Create custom theme
  // https://www.amcharts.com/docs/v5/concepts/themes/#Quick_custom_theme
  var myTheme = am5.Theme.new(root);
  myTheme.rule("Label").set("fontSize", "0.8em");

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root),
    myTheme
  ]);

  root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create wrapper container
  var container = root.container.children.push(am5.Container.new(root, {
    width: am5.p100,
    height: am5.p100,
    layout: root.horizontalLayout
  }));

  // Create first chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart0 = container.children.push(am5percent.PieChart.new(root, {
    innerRadius: am5.p50,
    tooltip: am5.Tooltip.new(root, {})
  }));

  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series0 = chart0.series.push(am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category",
    alignLabels: false
  }));

  series0.labels.template.setAll({
    textType: "circular",
    templateField: "dummyLabelSettings"
  });

  series0.ticks.template.set("forceHidden", true);

  var sliceTemplate0 = series0.slices.template;
  sliceTemplate0.setAll({
    draggable: true,
    templateField: "settings",
    cornerRadius: 5
  });

  // Separator line
  container.children.push(am5.Line.new(root, {
    layer: 1,
    height: am5.percent(60),
    y: am5.p50,
    centerY: am5.p50,
    strokeDasharray: [4, 4],
    stroke: root.interfaceColors.get("alternativeBackground"),
    strokeOpacity: 0.5
  }));

  // Label
  container.children.push(am5.Label.new(root, {
    layer: 1,
    text: "Drag slices over the line",
    y: am5.p50,
    textAlign: "center",
    rotation: -90,
    isMeasured: false
  }));

  // Create second chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart1 = container.children.push(am5percent.PieChart.new(root, {
    innerRadius: am5.p50,
    tooltip: am5.Tooltip.new(root, {})
  }));

  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series1 = chart1.series.push(am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category",
    alignLabels: false
  }));

  series1.labels.template.setAll({
    textType: "circular",
    radius: 20,
    templateField: "dummyLabelSettings"
  });

  series1.ticks.template.set("forceHidden", true);

  var sliceTemplate1 = series1.slices.template;
  sliceTemplate1.setAll({
    draggable: true,
    templateField: "settings",
    cornerRadius: 5
  });

  var previousDownSlice;

  // change layers when down
  sliceTemplate0.events.on("pointerdown", function (e) {
    if (previousDownSlice) {
      //  previousDownSlice.set("layer", 0);
    }
    e.target.set("layer", 1);
    previousDownSlice = e.target;
  });

  sliceTemplate1.events.on("pointerdown", function (e) {
    if (previousDownSlice) {
      // previousDownSlice.set("layer", 0);
    }
    e.target.set("layer", 1);
    previousDownSlice = e.target;
  });

  // when released, do all the magic
  sliceTemplate0.events.on("pointerup", function (e) {
    series0.hideTooltip();
    series1.hideTooltip();

    var slice = e.target;
    if (slice.x() > container.width() / 4) {
      var index = series0.slices.indexOf(slice);
      slice.dataItem.hide();

      var series1DataItem = series1.dataItems[index];
      series1DataItem.show();
      series1DataItem.get("slice").setAll({ x: 0, y: 0 });

      handleDummy(series0);
      handleDummy(series1);
    } else {
      slice.animate({
        key: "x",
        to: 0,
        duration: 500,
        easing: am5.ease.out(am5.ease.cubic)
      });
      slice.animate({
        key: "y",
        to: 0,
        duration: 500,
        easing: am5.ease.out(am5.ease.cubic)
      });
    }
  });

  sliceTemplate1.events.on("pointerup", function (e) {
    var slice = e.target;

    series0.hideTooltip();
    series1.hideTooltip();

    if (slice.x() < container.width() / 4) {
      var index = series1.slices.indexOf(slice);
      slice.dataItem.hide();

      var series0DataItem = series0.dataItems[index];
      series0DataItem.show();
      series0DataItem.get("slice").setAll({ x: 0, y: 0 });

      handleDummy(series0);
      handleDummy(series1);
    } else {
      slice.animate({
        key: "x",
        to: 0,
        duration: 500,
        easing: am5.ease.out(am5.ease.cubic)
      });
      slice.animate({
        key: "y",
        to: 0,
        duration: 500,
        easing: am5.ease.out(am5.ease.cubic)
      });
    }
  });

  // data
  /*var data = [
    {
      category: "Dummy",
      value: 1000,
      settings: {
        fill: am5.color(0xdadada),
        stroke: am5.color(0xdadada),
        fillOpacity: 0.3,
        strokeDasharray: [4, 4],
        tooltipText: null,
        draggable: false
      },
      dummyLabelSettings: {
        forceHidden: true
      }
    },
    {
      category: "Lithuania",
      value: 501.9
    },
    {
      category: "Estonia",
      value: 301.9
    },
    {
      category: "Ireland",
      value: 201.1
    },
    {
      category: "Germany",
      value: 165.8
    },
    {
      category: "Australia",
      value: 139.9
    },
    {
      category: "Austria",
      value: 128.3
    }
  ];*/

  // show/hide dummy slice depending if there are other visible slices
  function handleDummy(series) {
    // count visible data items
    var visibleCount = 0;
    am5.array.each(series.dataItems, function (dataItem) {
      if (!dataItem.isHidden()) {
        visibleCount++;
      }
    });
    // if all hidden, show dummy
    if (visibleCount == 0) {
      series.dataItems[0].show();
    } else {
      series.dataItems[0].hide();
    }
  }
  // set data
  series0.data.setAll(series_data);
  series1.data.setAll(series_data);

  // hide all except dummy
  am5.array.each(series1.dataItems, function (dataItem) {
    if (dataItem.get("category") != "Dummy") {
      dataItem.hide(0);
    }
  });

  // hide dummy
  series0.dataItems[0].hide(0);

  // reveal container
  container.appear(1000, 100);
}


/* ================Simple Pie Chart======================== */

function SimplePieChart(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = root.container.children.push(am5percent.PieChart.new(root, {
    layout: root.verticalLayout
  }));


  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category"
  }));


  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  /*series.data.setAll([
    { value: 10, category: "One" },
    { value: 9, category: "Two" },
    { value: 6, category: "Three" },
    { value: 5, category: "Four" },
    { value: 4, category: "Five" },
    { value: 3, category: "Six" },
    { value: 1, category: "Seven" },
  ]);*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
series.data.setAll(series_data);
  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear(1000, 100);
}

/* ====================Donut with Radial Gradient Chart==================== */

function DonutwithRadialGradient(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = root.container.children.push(am5percent.PieChart.new(root, {
    radius: am5.percent(90),
    innerRadius: am5.percent(50),
    layout: root.horizontalLayout
  }));

  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(am5percent.PieSeries.new(root, {
    name: "Series",
    valueField: "value",
    categoryField: "category"
  }));

  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
 /* series.data.setAll([{
    country: "Lithuania",
    sales: 501.9
  }, {
    country: "Czechia",
    sales: 301.9
  }, {
    country: "Ireland",
    sales: 201.1
  }, {
    country: "Germany",
    sales: 165.8
  }, {
    country: "Australia",
    sales: 139.9
  }, {
    country: "Austria",
    sales: 128.3
  }, {
    country: "UK",
    sales: 99
  }, {
    country: "Belgium",
    sales: 60
  }, {
    country: "The Netherlands",
    sales: 50
  }]);*/
  /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
series.data.setAll(series_data);
  // Disabling labels and ticks
  series.labels.template.set("visible", false);
  series.ticks.template.set("visible", false);

  // Adding gradients
  series.slices.template.set("strokeOpacity", 0);
  series.slices.template.set("fillGradient", am5.RadialGradient.new(root, {
    stops: [{
      brighten: -0.8
    }, {
      brighten: -0.8
    }, {
      brighten: -0.5
    }, {
      brighten: 0
    }, {
      brighten: -0.5
    }]
  }));

  // Create legend
  // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
  var legend = chart.children.push(am5.Legend.new(root, {
    centerY: am5.percent(50),
    y: am5.percent(50),
    layout: root.verticalLayout
  }));
  // set value labels align to right
  legend.valueLabels.template.setAll({ textAlign: "right" })
  // set width and max width of labels
  legend.labels.template.setAll({ 
    maxWidth: 140,
    width: 140,
    oversizedBehavior: "wrap"
  });

  legend.data.setAll(series.dataItems);


  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear(1000, 100);
}

/* =====================Pie Chart with Legend====================== */

function PieChartwithLegend(series_data,chartdivname){
  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = root.container.children.push(am5percent.PieChart.new(root, {
    layout: root.verticalLayout
  }));


  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category"
  }));


  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  /*series.data.setAll([
    { value: 10, category: "One" },
    { value: 9, category: "Two" },
    { value: 6, category: "Three" },
    { value: 5, category: "Four" },
    { value: 4, category: "Five" },
    { value: 3, category: "Six" },
    { value: 1, category: "Seven" },
  ]);*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
series.data.setAll(series_data);
  // Create legend
  // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
  var legend = chart.children.push(am5.Legend.new(root, {
    centerX: am5.percent(50),
    x: am5.percent(50),
    marginTop: 15,
    marginBottom: 15
  }));

  legend.data.setAll(series.dataItems);


  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear(1000, 100);
}


/* --------Variable Radius Pie Chart----------- */

function VariableRadiusPieChart(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = root.container.children.push(am5percent.PieChart.new(root, {
    layout: root.verticalLayout
  }));


  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(am5percent.PieSeries.new(root, {
    alignLabels: true,
    calculateAggregates: true,
    valueField: "value",
    categoryField: "category"
  }));

  series.slices.template.setAll({
    strokeWidth: 3,
    stroke: am5.color(0xffffff)
  });

  series.labelsContainer.set("paddingTop", 30)


  // Set up adapters for variable slice radius
  // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
  series.slices.template.adapters.add("radius", function (radius, target) {
    var dataItem = target.dataItem;
    var high = series.getPrivate("valueHigh");

    if (dataItem) {
      var value = target.dataItem.get("valueWorking", 0);
      return radius * value / high
    }
    return radius;
  });


  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  /*series.data.setAll([{
    value: 10,
    category: "One"
  }, {
    value: 9,
    category: "Two"
  }, {
    value: 6,
    category: "Three"
  }, {
    value: 5,
    category: "Four"
  }, {
    value: 4,
    category: "Five"
  }, {
    value: 3,
    category: "Six"
  }]);
*/
  /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
series.data.setAll(series_data);
  // Create legend
  // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
  var legend = chart.children.push(am5.Legend.new(root, {
    centerX: am5.p50,
    x: am5.p50,
    marginTop: 15,
    marginBottom: 15
  }));

  legend.data.setAll(series.dataItems);


  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear(1000, 100);
}



/* =================Semi-Circle Pie Chart================== */

function SemiCirclePieChart(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  // start and end angle must be set both for chart and series
  var chart = root.container.children.push(am5percent.PieChart.new(root, {
    startAngle: 180,
    endAngle: 360,
    layout: root.verticalLayout,
    innerRadius: am5.percent(50)
  }));

  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  // start and end angle must be set both for chart and series
  var series = chart.series.push(am5percent.PieSeries.new(root, {
    startAngle: 180,
    endAngle: 360,
    valueField: "value",
    categoryField: "category",
    alignLabels: false
  }));

  series.states.create("hidden", {
    startAngle: 180,
    endAngle: 180
  });

  series.slices.template.setAll({
    cornerRadius: 5
  });

  series.ticks.template.setAll({
    forceHidden: true
  });

  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
 /* series.data.setAll([
    { value: 10, category: "One" },
    { value: 9, category: "Two" },
    { value: 6, category: "Three" },
    { value: 5, category: "Four" },
    { value: 4, category: "Five" },
    { value: 3, category: "Six" },
    { value: 1, category: "Seven" }
  ]);*/
  /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
series.data.setAll(series_data);
  series.appear(1000, 100);
}

/* ==============Live Sorting of Radar Columns================== */

function LiveSortingRadarColumns(series_data,chartdivname){
  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);


  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(am5radar.RadarChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "none",
    wheelY: "none",
    innerRadius:am5.percent(40)
  }));

  // We don't want zoom-out button to appear while animating, so we hide it
  chart.zoomOutButton.set("forceHidden", true);


  // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var xRenderer = am5radar.AxisRendererCircular.new(root, {
    minGridDistance: 30
  });

  xRenderer.grid.template.set("visible", false);

  var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
    maxDeviation: 0.3,
    categoryField: "category",
    renderer: xRenderer
  }));

  var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    maxDeviation: 0.3,
    min: 0,
    renderer: am5radar.AxisRendererRadial.new(root, {})
  }));


  // Add series
  // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
  var series = chart.series.push(am5radar.RadarColumnSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    categoryXField: "category"
  }));

  // Rounded corners for columns
  series.columns.template.setAll({
    cornerRadius: 5,
    tooltipText:"{categoryX}: {valueY}"
  });

  // Make each column to be of a different color
  series.columns.template.adapters.add("fill", function (fill, target) {
    return chart.get("colors").getIndex(series.columns.indexOf(target ));
  });

  series.columns.template.adapters.add("stroke", function (stroke, target) {
    return chart.get("colors").getIndex(series.columns.indexOf(target ));
  });

  // Set data
  /*var data = [{
    "country": "USA",
    "value": 2025
  }, {
    "country": "China",
    "value": 1882
  }, {
    "country": "Japan",
    "value": 1809
  }, {
    "country": "Germany",
    "value": 1322
  }, {
    "country": "UK",
    "value": 1122
  }, {
    "country": "France",
    "value": 1114
  }, {
    "country": "India",
    "value": 984
  }, {
    "country": "Spain",
    "value": 711
  }, {
    "country": "Netherlands",
    "value": 665
  }, {
    "country": "South Korea",
    "value": 443
  }, {
    "country": "Canada",
    "value": 441
  }];*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
  xAxis.data.setAll(series_data);
  series.data.setAll(series_data);

  // update data with random values each 1.5 sec
  setInterval(function () {
    updateData();
  }, 1500)

  function updateData() {
    am5.array.each(series.dataItems, function (dataItem) {
      var value = dataItem.get("valueY") + Math.round(Math.random() * 400 - 200);
      if (value < 0) {
        value = 10;
      }
      // both valueY and workingValueY should be changed, we only animate workingValueY
      dataItem.set("valueY", value);
      dataItem.animate({
        key: "valueYWorking",
        to: value,
        duration: 600,
        easing: am5.ease.out(am5.ease.cubic)
      });
    })

    sortCategoryAxis();
  }


  // Get series item by category
  function getSeriesItem(category) {
    for (var i = 0; i < series.dataItems.length; i++) {
      var dataItem = series.dataItems[i];
      if (dataItem.get("categoryX") == category) {
        return dataItem;
      }
    }
  }


  // Axis sorting
  function sortCategoryAxis() {

    // Sort by value
    series.dataItems.sort(function (x, y) {
      return y.get("valueY") - x.get("valueY"); // descending
      //return y.get("valueY") - x.get("valueY"); // ascending
    })

    // Go through each axis item
    am5.array.each(xAxis.dataItems, function (dataItem) {
      // get corresponding series item
      var seriesDataItem = getSeriesItem(dataItem.get("category"));

      if (seriesDataItem) {
        // get index of series data item
        var index = series.dataItems.indexOf(seriesDataItem);
        // calculate delta position
        var deltaPosition = (index - dataItem.get("index", 0)) / series.dataItems.length;
        // set index to be the same as series data item index
        dataItem.set("index", index);
        // set deltaPosition instanlty
        dataItem.set("deltaPosition", -deltaPosition);
        // animate delta position to 0
        dataItem.animate({
          key: "deltaPosition",
          to: 0,
          duration: 1000,
          easing: am5.ease.out(am5.ease.cubic)
        })
      }
    });

    // Sort axis items by index.
    // This changes the order instantly, but as deltaPosition is set,
    // they keep in the same places and then animate to true positions.
    xAxis.dataItems.sort(function (x, y) {
      return x.get("index") - y.get("index");
    });
  }


  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  series.appear(1000);
  chart.appear(1000, 100);
}

/* =================Funnel with Gradient Fill Chart===================== */

function FunnelwithGradientFill(series_data,chartdivname){

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(chartdivname);

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([am5themes_Animated.new(root)]);
root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/sliced-chart/
  var chart = root.container.children.push(
    am5percent.SlicedChart.new(root, {
      layout: root.verticalLayout
    })
  );

  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/sliced-chart/#Series
  var series = chart.series.push(
    am5percent.FunnelSeries.new(root, {
      alignLabels: false,
      orientation: "vertical",
      valueField: "value",
      categoryField: "category"
    })
  );

  // make fills gradients
  series.slices.template.setAll({
    strokeOpacity: 0,
    fillGradient: am5.LinearGradient.new(root, {
      rotation: 0,
      stops: [{ brighten: -0.4 }, { brighten: 0.4 }, { brighten: -0.4 }]
    })
  });

  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/sliced-chart/#Setting_data
 /* series.data.setAll([
    { value: 10, category: "One" },
    { value: 9, category: "Two" },
    { value: 6, category: "Three" },
    { value: 5, category: "Four" },
    { value: 4, category: "Five" },
    { value: 3, category: "Six" },
    { value: 1, category: "Seven" }
  ]);*/
  /*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
series.data.setAll(series_data);
  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear();

  // Create legend
  // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
  var legend = chart.children.push(
    am5.Legend.new(root, {
      centerX: am5.p50,
      x: am5.p50,
      marginTop: 15,
      marginBottom: 15
    })
  );

  legend.data.setAll(series.dataItems);

  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  chart.appear(1000, 100);
}

/* =================Column with Grainy Gradients Chart===================== */

function ColumnswithGrainyGradients(series_data,chartdivname)
{

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX: true,
  paddingLeft:0,
  layout: root.verticalLayout
}));

chart.set("colors", am5.ColorSet.new(root, {
  colors: [
    am5.color(0x73556E),
    am5.color(0x9FA1A6),
    am5.color(0xF2AA6B),
    am5.color(0xF28F6B),
    am5.color(0xA95A52),
    am5.color(0xE35B5D),
    am5.color(0xFFA446)
  ]
}))

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
  minGridDistance: 50,
  minorGridEnabled: true
});

xRenderer.grid.template.setAll({
  location: 1
})

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0.3,
  categoryField: "category",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.3,
  min: 0,
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  categoryXField: "category",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  }),
}));

series.columns.template.setAll({
  tooltipY: 0,
  tooltipText: "{categoryX}: {valueY}",
  shadowOpacity: 0.1,
  shadowOffsetX: 2,
  shadowOffsetY: 2,
  shadowBlur: 1,
  strokeWidth: 2,
  stroke: am5.color(0xffffff),
  shadowColor: am5.color(0x000000),
  cornerRadiusTL: 50,
  cornerRadiusTR: 50,
  fillGradient: am5.LinearGradient.new(root, {
    stops: [
      {}, // will use original column color
      { color: am5.color(0x000000) }
    ]
  }),
  fillPattern: am5.GrainPattern.new(root, {
    maxOpacity: 0.15,
    density: 0.5,
    colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
  })
});


series.columns.template.states.create("hover", {
  shadowOpacity: 1,
  shadowBlur: 10,
  cornerRadiusTL: 10,
  cornerRadiusTR: 10
})

series.columns.template.adapters.add("fill", function (fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

// Set data
/*var data = [{
  country: "USA",
  value: 2025
}, {
  country: "China",
  value: 1282
}, {
  country: "Japan",
  value: 909
}, {
  country: "Germany",
  value: 752
}, {
  country: "UK",
  value: 652
}, {
  country: "Italy",
  value: 452
}];*/
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
xAxis.data.setAll(series_data);
series.data.setAll(series_data);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);
}

/* =================Clustered Bar Chart===================== */

function ClusteredBarChart(series_data,chartdivname){
  // Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new(chartdivname);


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


root.container.set("background", am5.Rectangle.new(root, {
  fill: am5.color(0xFFFFFF), // Set desired background color
  fillOpacity: 1
}));

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  paddingLeft:0,
  layout: root.verticalLayout
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}))


// Data
/*var data = [{
  year: "2017",
  income: 23.5,
  expenses: 18.1
}, {
  year: "2018",
  income: 26.2,
  expenses: 22.8
}, {
  year: "2019",
  income: 30.1,
  expenses: 23.9
}, {
  year: "2020",
  income: 29.5,
  expenses: 25.1
}, {
  year: "2021",
  income: 24.6,
  expenses: 25
}];*/


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: am5xy.AxisRendererY.new(root, {
    inversed: true,
    cellStartLocation: 0.1,
    cellEndLocation: 0.9,
    minorGridEnabled: true
  })
}));

yAxis.data.setAll(series_data);

var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererX.new(root, {
    strokeOpacity: 0.1,
    minGridDistance: 50
  }),
  min: 0
}));


xAxis.get("renderer").labels.template.setAll({
  visible: true,
  fontSize: 14, // or any desired size
  fill: am5.color(0x000000) // or any desired color
});



// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
/*function createSeries(field, name) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: name,
    xAxis: xAxis,
    yAxis: yAxis,
    valueXField: field,
    categoryYField: "category",
    sequencedInterpolation: true,
    tooltip: am5.Tooltip.new(root, {
      pointerOrientation: "horizontal",
      labelText: "[bold]{name}[/]\n{categoryY}: {valueX}"
    })
  }));

  series.columns.template.setAll({
    height: am5.p100,
    strokeOpacity: 0
  });


  series.bullets.push(function () {
    return am5.Bullet.new(root, {
      locationX: 1,
      locationY: 0.5,
      sprite: am5.Label.new(root, {
        centerY: am5.p50,
        text: "{valueX}",
        populateText: true
      })
    });
  });

  series.bullets.push(function () {
    return am5.Bullet.new(root, {
      locationX: 1,
      locationY: 0.5,
      sprite: am5.Label.new(root, {
        centerX: am5.p100,
        centerY: am5.p50,
        text: "{name}",
        fill: am5.color(0xffffff),
        populateText: true
      })
    });
  });

  series.data.setAll(data);
  series.appear();

  return series;
}

createSeries("income", "Income");
createSeries("expenses", "Expenses");*/

Object.keys(series_data[0]).forEach((key, index) => {
      if (key !== "category") {
      var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: key,
        xAxis: xAxis,
        yAxis: yAxis,
        valueXField: key,
        categoryYField: "category",
        sequencedInterpolation: true,
        tooltip: am5.Tooltip.new(root, {
          pointerOrientation: "horizontal",
          labelText: "[bold]{name}[/]\n{categoryY}: {valueX}"
        })
      }));

      series.columns.template.setAll({
        height: am5.p100,
        strokeOpacity: 0
      });


      series.bullets.push(function () {
        return am5.Bullet.new(root, {
          locationX: 1,
          locationY: 0.5,
          sprite: am5.Label.new(root, {
            centerY: am5.p50,
            text: "{valueX}",
            populateText: true
          })
        });
      });

      series.bullets.push(function () {
        return am5.Bullet.new(root, {
          locationX: 1,
          locationY: 0.5,
          sprite: am5.Label.new(root, {
            centerX: am5.p100,
            centerY: am5.p50,
            text: "{name}",
            fill: am5.color(0xffffff),
            populateText: true
          })
        });
      });
/*Exporting to PNG*/
var exporting = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});
/*Exporting to PNG*/
      series.data.setAll(series_data);
      series.appear();

      return series;
    }

});

// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}));

legend.data.setAll(chart.series.values);


// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "zoomY"
}));
cursor.lineY.set("forceHidden", true);
cursor.lineX.set("forceHidden", true);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}
</script>