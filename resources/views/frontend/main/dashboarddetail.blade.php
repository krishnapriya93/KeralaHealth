<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-90680653-2');
  </script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta -->
  <meta name="description" content="Kerala Health Department Dashboard">
  <meta name="author" content="Kerala Health Department">

  <title>Kerala Health Department</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/frontend/images/fav.png')}}">
  <!-- vendor css -->
  <link href="{{ asset('/assets/frontdashboard/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{ asset('/assets/frontdashboard/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('/assets/frontdashboard/lib/typicons.font/typicons.css')}}" rel="stylesheet">
  <link href="{{ asset('/assets/frontdashboard/lib/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">

  <!-- azia CSS -->
  <link rel="stylesheet" href="{{ asset('/assets/frontdashboard/css/azia.css')}}">
  <style>
    .logoplace {
      max-width: 100%;
      height: auto;
      max-height: 45px;
      display: inline-block;
      -webkit-transition: all 300ms ease;
      transition: all 300ms ease;
    }

    .textcolor {
      color: #28ab32;
    }
    .bg-green1{
      color: #098c1d !important;
    }
    .bg-green2{
      color: #6bf367 !important;
    }
    .bg-green3{
      color: #adb2bd !important;
    }
  </style>
</head>

<body>

  <div class="az-header">
    <div class="container">
      <div class="az-header-left">
        <!-- <a href="index.html" class="az-logo"><span></span> azia</a> -->

        <a href="{{ route('main.index') }}">
          <img class="logoplace" src="{{asset('assets/frontend/images/log-n.png')}}" alt="Kerala health">
        </a>


        <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
      </div><!-- az-header-left -->
      <div class="az-header-menu">
        <div class="az-header-menu-header">
          <a href="index.html" class="az-logo"><span></span> Kerala Health</a>
          <a href="" class="close">&times;</a>
        </div><!-- az-header-menu-header -->
        <ul class="nav">
          <li class="nav-item active show">
          <a href="{{ route('main.index')}}" class="nav-link" style="color: green;">
  <i class="typcn typcn-home-outline"></i> Home
</a>

          </li>
          <!-- <li class="nav-item">
            <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> Pages</a>
            <nav class="az-menu-sub">
              <a href="page-signin.html" class="nav-link">Sign In</a>
              <a href="page-signup.html" class="nav-link">Sign Up</a>
            </nav>
          </li> -->
          <!-- <li class="nav-item">
            <a href="chart-chartjs.html" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Charts</a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="form-elements.html" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Forms</a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="" class="nav-link with-sub"><i class="typcn typcn-book"></i> Components</a>
            <div class="az-menu-sub">
              <div class="container">
                <div>
                  <nav class="nav">
                    <a href="elem-buttons.html" class="nav-link">Buttons</a>
                    <a href="elem-dropdown.html" class="nav-link">Dropdown</a>
                    <a href="elem-icons.html" class="nav-link">Icons</a>
                    <a href="table-basic.html" class="nav-link">Table</a>
                  </nav>
                </div>
              </div>
            </div>
          </li> -->
        </ul>
      </div><!-- az-header-menu -->

    </div><!-- container -->
  </div><!-- az-header -->

  <div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <div class="az-dashboard-one-title">
          <div>
            <h2 class="az-dashboard-title">Health Portal Dashboard</h2>
            <p class="az-dashboard-text"> A centralized platform for tracking and managing health data efficiently</p>
          </div>
          <div class="az-content-header-right">
            <div class="media">
              <div class="media-body">
                <label><i class="fas fa-calendar-alt" style="color: #28ab32;"></i> Today</label>

                <h6>{{ now()->format('M j, Y') }}
                </h6>
              </div><!-- media-body -->
            </div><!-- media -->
            <!-- <div class="media">
              <div class="media-body">
                <label>End Date</label>
                <h6>Oct 23, 2018</h6>
              </div>
            </div> -->
            <!-- <div class="media">
              <div class="media-body">
                <label>Event Category</label>
                <h6>All Categories</h6>
              </div>
            </div> -->
            <!-- <a href="" class="btn btn-purple">Export</a> -->
          </div>
        </div><!-- az-dashboard-one-title -->

        <div class="az-dashboard-nav">
          <nav class="nav">
            <a class="nav-link active" data-toggle="tab" href="#">Overview</a>
            <!-- <a class="nav-link" data-toggle="tab" href="#">Audiences</a>
            <a class="nav-link" data-toggle="tab" href="#">Demographics</a>
            <a class="nav-link" data-toggle="tab" href="#">More</a> -->
          </nav>

          <nav class="nav">
            <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
            <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
            <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a>
            <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
          </nav>
        </div>

        <div class="row row-sm mg-b-20">
          <div class="col-lg-7 ht-lg-100p">
            <div class="card card-dashboard-one">
              <div class="card-header">
                <div>
                  <h6 class="card-title textcolor mb-1">Life Expectancy</h6>
                  <p class="card-text">Kerala boasts the highest life expectancy in India, averaging 75-77 years, thanks to advanced healthcare and strong social development.</p>
                </div>
                <!-- <div class="btn-group">
                  <button class="btn active">Day</button>
                  <button class="btn">Week</button>
                  <button class="btn">Month</button>
                </div> -->
              </div><!-- card-header -->
              <div class="card-body">
                <div class="card-body-top">
                  <div>
                    <label class="mg-b-0">Overall</label>
                    <h2>75.0</h2>
                  </div>
                  <div>
                    <label class="mg-b-0">Male</label>
                    <h2>71.9</h2>
                  </div>
                  <div>
                    <label class="mg-b-0">Female</label>
                    <h2> 78.0</h2>
                  </div>
                  <!-- <div>
                    <label class="mg-b-0">Sessions</label>
                    <h2>16,869</h2>
                  </div> -->
                </div><!-- card-body-top -->
                <div class="flot-chart-wrapper">
                  <div id="flotChart" class="flot-chart"></div>
                </div><!-- flot-chart-wrapper -->
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col -->
          <div class="col-lg-5 mg-t-20 mg-lg-t-0">
            <div class="row row-sm">
              <div class="col-sm-6">
                <div class="card card-dashboard-two">
                  <div class="card-header">
                    <h6>6/1000<i class=""></i>
                     <!-- <small>18.02%</small> -->
                    </h6>
                    <p>Infant Mortality Rate</p>
                  </div><!-- card-header -->
                  <div class="card-body">
                    <div class="chart-wrapper">
                      <div id="flotChart1" class="flot-chart"></div>
                    </div><!-- chart-wrapper -->
                  </div><!-- card-body -->
                </div><!-- card -->
              </div><!-- col -->
              <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                <div class="card card-dashboard-two">
                  <div class="card-header">
                    <h6>29/100000  <i class=""></i> 
                    <!-- <small>0.86%</small> -->
                  </h6>
                    <p>Maternal Mortality Rate</p>
                  </div>
                  <div class="card-body">
                    <div class="chart-wrapper">
                      <div id="flotChart2" class="flot-chart"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 mg-t-20">
                <div class="card card-dashboard-three">
                  <div class="card-header">
                    <h5>Healthcare Utilization <small class="tx-success"></small></h5>
                    <small>Patient Admission Rates</small>
                    <br>
                    <small>Emergency Room Visits</small>

                    <!-- Color Legend for Graph -->
                    <div style="margin-top: 10px;">
                      <span style="display: inline-block; width: 13px; height: 13px; background-color: #d8d3d3; border-radius: 3px;"></span>
                      <small>Patient Admission Rates</small>
<br>
                      <span style="display: inline-block; width: 13px; height: 13px; background-color:rgb(119, 29, 179); border-radius: 3px;"></span>
                      <small>Emergency Room Visits</small>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="chart"><canvas id="chartBar5"></canvas></div>
                  </div>
                </div>
              </div>
            </div><!-- row -->
          </div><!--col -->
        </div><!-- row -->

        <div class="row row-sm mg-b-20">
          <div class="col-lg-4">
            <div class="card card-dashboard-pageviews">
              <div class="card-header">
                <h6 class="card-title">Health Indicators by state</h6>
                <p class="card-text">Kerala's health indicators, marked by high life expectancy and low infant mortality, showcase its robust healthcare system and progressive social development.</p>
              </div><!-- card-header -->
              <div class="card-body">
                <div class="az-list-item">
                  <div>
                    <h6>Life Expectancy at Birth</h6>
                    <span></span>
                  </div>
                  <div>
                    <h6 class="tx-primary">75</h6>
                    <span>(Years)</span>
                  </div>
                </div><!-- list-group-item -->
                <div class="az-list-item">
                  <div>
                    <h6>Infant Mortality Rate</h6>
                    <span></span>
                  </div>
                  <div>
                    <h6 class="tx-primary">6</h6>
                    <span>(Per 1,000 live Births)</span>
                  </div>
                </div><!-- list-group-item -->
                <div class="az-list-item">
                  <div>
                    <h6>Maternal Mortality Ratio</h6>
                    <span></span>
                  </div>
                  <div>
                    <h6 class="tx-primary">42</h6>
                    <span>(per 100,000 live births)</span>
                  </div>
                </div><!-- list-group-item -->
                <div class="az-list-item">
                  <div>
                    <h6>Institutional Delivery Rate</h6>
                    <span></span>
                  </div>
                  <div>
                    <h6 class="tx-primary">99.80%</h6>
                    <span>(In Percentage)</span>
                  </div>
                </div><!-- list-group-item -->
                <div class="az-list-item">
                  <div>
                    <h6>Total Fertility Rate</h6>
                    <span></span>
                  </div>
                  <div>
                    <h6 class="tx-primary">1.8 Births</h6>
                    <span>(per woman)</span>
                  </div>
                </div><!-- list-group-item -->
              </div><!-- card-body -->
            </div><!-- card -->

          </div><!-- col -->
          <div class="col-lg-8 mg-t-20 mg-lg-t-0">
            <div class="card card-dashboard-four">
              <div class="card-header">
                <h6 class="card-title">Comparative Analysis of Lifestyle and Health Indicators(Kerala)</h6>
              </div><!-- card-header -->
              <div class="card-body row">
                <div class="col-md-6 d-flex align-items-center">
                  <div class="chart"><canvas id="chartDonut"></canvas></div>
                </div><!-- col -->
                <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0">
                  <div class="az-traffic-detail-item">
                    <div>
                      <span>Hypertension</span>
                      <span>(38%)<span></span></span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-purple wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><!-- progress -->
                  </div>
                  <div class="az-traffic-detail-item">
                    <div>
                      <span>Diabetes</span>
                      <span>(31%) <span></span></span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-primary wd-20p" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><!-- progress -->
                  </div>
                  <div class="az-traffic-detail-item">
                    <div>
                      <span>Other Chronic Diseases</span>
                      <span>(31%) <span></span></span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-info wd-30p" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><!-- progress -->
                  </div>
                  <!-- <div class="az-traffic-detail-item">
                    <div>
                      <span>Body Mass Index (BMI)</span>
                      <span>(38.1) <span></span></span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-teal wd-15p" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div> -->
                  <!-- <div class="az-traffic-detail-item">
                    <div>
                      <span>Other</span>
                      <span>400 <span>(10%)</span></span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-gray-500 wd-10p" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div> -->
                </div>
              </div><!-- card-body -->
            </div><!-- card-dashboard-four -->
          </div><!-- col -->
        </div><!-- row -->

        <div class="row row-sm mg-b-20 mg-lg-b-0">
          <div class="col-lg-5 col-xl-4">
            <div class="row row-sm">
              <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                <div class="card card-dashboard-five">
                  <div class="card-header">
                    <h6 class="card-title">Health Statistics</h6>
                    <span class="card-text">Tells you where your visitors originated from, such as search engines, social networks or website referrals.</span>
                  </div><!-- card-header -->
                  <div class="card-body row row-sm">
                    <div class="col-6 d-sm-flex align-items-center">
                      <div class="card-chart bg-primary">
                        <span class="peity-bar" data-peity='{"fill": ["#fff"], "width": 20, "height": 20 }'>6,4,7,5,7</span>
                      </div>
                      <div>
                        <label>Population Growth(%)</label>
                        <h4>4.91%</h4>
                      </div>
                    </div><!-- col -->
                    <div class="col-6 d-sm-flex align-items-center">
                      <div class="card-chart bg-purple">
                        <span class="peity-bar" data-peity='{"fill": ["#fff"], "width": 21, "height": 20 }'>7,4,5,7,2</span>
                      </div>
                      <div>
                        <label>Health care Accessbility(%)</label>
                        <h4>45.50%</h4>
                      </div>
                    </div><!-- col -->
                  </div><!-- card-body -->
                </div><!-- card-dashboard-five -->
              </div><!-- col -->
              <div class="col-md-6 col-lg-12">
                <div class="card card-dashboard-five">
                  <div class="card-header">
                    <h6 class="card-title">Trends(Per 1000 of population)</h6>
                    <span class="card-text"> A session is the period time a user is actively engaged with your website, app, etc.</span>
                  </div><!-- card-header -->
                  <div class="card-body row row-sm">
                    <div class="col-6 d-sm-flex align-items-center">
                      <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                        <span class="peity-donut" data-peity='{ "fill": ["#007bff", "#cad0e8"],  "innerRadius": 14, "radius": 20 }'>4/7</span>
                      </div>
                      <div>
                        <label>Birth Rate</label>
                        <h4>28/1,000</h4>
                      </div>
                    </div><!-- col -->
                    <div class="col-6 d-sm-flex align-items-center">
                      <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                        <span class="peity-donut" data-peity='{ "fill": ["#00cccc", "#cad0e8"],  "innerRadius": 14, "radius": 20 }'>2/7</span>
                      </div>
                      <div>
                        <label>Death Rate</label>
                        <h4>9.66</h4>
                      </div>
                    </div><!-- col -->
                  </div><!-- card-body -->
                </div><!-- card-dashboard-five -->
              </div><!-- col -->
            </div><!-- row -->
          </div><!-- col-lg-3 -->
          <div class="col-lg-7 col-xl-8 mg-t-20 mg-lg-t-0">
            <div class="card card-table-one">
              <h6 class="card-title">Health care Accessbility</h6>
              <p class="az-content-text mg-b-20">Part of this date range occurs before the new users metric had been calculated, so the old users metric is displayed.</p>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="wd-5p">&nbsp;</th>
                      <th class="wd-45p">District</th>
                      <th>Population(Lakhs)</th>
                      <th>Hospitals</th>
                      <th>Ratio</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><i class="fa fa-sitemap"></i></td>
                      <td><strong>Thiruvananthapuram</strong></td>
                      <td><strong>134</strong> </td>
                      <td>33</td>
                      <td>33</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-sitemap"></i></td>
                      <td><strong>Kollam</strong></td>
                      <td><strong>290</strong></td>
                      <td>9.22</td>
                      <td>7.99</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-sitemap"></i></td>
                      <td><strong>Alappuzha</strong></td>
                      <td><strong>250</strong></td>
                      <td>20.75</td>
                      <td>2.40</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-sitemap"></i></td>
                      <td><strong>Pathanamthitta</strong></td>
                      <td><strong>216</strong></td>
                      <td>32.07</td>
                      <td>15.09</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-sitemap"></i></td>
                      <td><strong>Kottayam</strong></td>
                      <td><strong>216</strong></td>
                      <td>32.07</td>
                      <td>15.09</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-sitemap"></i></td>
                      <td><strong>Idukki</strong></td>
                      <td><strong>197</strong></td>
                      <td>32.07</td>
                      <td>15.09</td>
                    </tr>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card -->
          </div><!-- col-lg -->

        </div><!-- row -->
      </div><!-- az-content-body -->
    </div>
  </div><!-- az-content -->

  <div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Data updated on : 18-Feb-2025</span>
      <div class="pbmit-footer-copyright-text-area"> Copyright © 2024 <a href="#" style="  color: var(--pbmit-global-color);"><b>C-Dit</b></a> </div>
    </div><!-- container -->

  </div><!-- az-footer -->


  <script src="{{ asset('/assets/frontdashboard/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/lib/ionicons/ionicons.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/lib/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/lib/chart.js/Chart.bundle.min.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/lib/peity/jquery.peity.min.js')}}"></script>

  <script src="{{ asset('/assets/frontdashboard/js/azia.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/js/chart.flot.sampledata.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/js/dashboard.sampledata.js')}}"></script>
  <script src="{{ asset('/assets/frontdashboard/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script>
    $(function() {
      'use strict'

      var plot = $.plot('#flotChart', [{
        data: flotSampleData3,
        color: '#007bff',
        lines: {
          fillColor: {
            colors: [{
              opacity: 0
            }, {
              opacity: 0.2
            }]
          }
        }
      }, {
        data: flotSampleData4,
        color: '#560bd0',
        lines: {
          fillColor: {
            colors: [{
              opacity: 0
            }, {
              opacity: 0.2
            }]
          }
        }
      }], {
        series: {
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 2,
            fill: true
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 8
        },
        yaxis: {
          show: true,
          min: 0,
          max: 100,
          ticks: [
            [0, ''],
            [20, '90-80'],
            [40, '81-70'],
            [60, '71-60'],
            [80, '61-50']
          ],
          tickColor: '#eee'
        },
        xaxis: {
          show: true,
          color: '#fff',
          ticks: [
            [25, '2024-25'],
            [75, '2023-24'],
            [100, '2022-23'],
            [125, '2021-22']
          ],
        }
      });

      $.plot('#flotChart1', [{
        data: dashData2,
        color: '#00cccc'
      }], {
        series: {
          shadowSize: 0,
          lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0.2
              }, {
                opacity: 0.2
              }]
            }
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 0
        },
        yaxis: {
          show: false,
          min: 0,
          max: 35
        },
        xaxis: {
          show: false,
          max: 50
        }
      });

      $.plot('#flotChart2', [{
        data: dashData2,
        color: '#007bff'
      }], {
        series: {
          shadowSize: 0,
          bars: {
            show: true,
            lineWidth: 0,
            fill: 1,
            barWidth: .5
          }
        },
        grid: {
          borderWidth: 0,
          labelMargin: 0
        },
        yaxis: {
          show: false,
          min: 0,
          max: 35
        },
        xaxis: {
          show: false,
          max: 20
        }
      });


      //-------------------------------------------------------------//


      // Line chart
      $('.peity-line').peity('line');

      // Bar charts
      $('.peity-bar').peity('bar');

      // Bar charts
      $('.peity-donut').peity('donut');

      var ctx5 = document.getElementById('chartBar5').getContext('2d');
      new Chart(ctx5, {
        type: 'bar',
        data: {
          labels: [0, 1, 2, 3, 4, 5, 6, 7],
          datasets: [{
            data: [2, 4, 10, 20, 45, 40, 35, 18],
            backgroundColor: '#560bd0'
          }, {
            data: [3, 6, 15, 35, 50, 45, 35, 25],
            backgroundColor: '#cad0e8'
          }]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            enabled: false
          },
          legend: {
            display: false,
            labels: {
              display: false
            }
          },
          scales: {
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                fontSize: 11,
                max: 80
              }
            }],
            xAxes: [{
              barPercentage: 0.6,
              gridLines: {
                color: 'rgba(0,0,0,0.08)'
              },
              ticks: {
                beginAtZero: true,
                fontSize: 11,
                display: false
              }
            }]
          }
        }
      });

      // Donut Chart
      var datapie = {
        labels: ['Hypertension', 'Diabetes', 'Other Chronic Diseases'],
        datasets: [{
          data: [38, 31, 31],
          backgroundColor: ['#6f42c1', '#007bff','#17a2b8']
        }]
      };

      var optionpie = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false,
        },
        animation: {
          animateScale: true,
          animateRotate: true
        }
      };

      // For a doughnut chart
      var ctxpie = document.getElementById('chartDonut');
      var myPieChart6 = new Chart(ctxpie, {
        type: 'doughnut',
        data: datapie,
        options: optionpie
      });

    });
  </script>
</body>

</html>