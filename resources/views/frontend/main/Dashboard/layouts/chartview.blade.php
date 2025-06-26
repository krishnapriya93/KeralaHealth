<div class="container mt-4">
  <!-- Category Selection -->
  <div class="row gx-3">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="card-title">Select Category</h5>
        </div>
        <div class="card-body pt-0">
          <div class="custom-tabs-container">
            <div class="tab-content pt-1" id="customTabContent3">
              <div class="tab-pane fade active show" id="oneAA" role="tabpanel" aria-labelledby="tab-oneAA">
                <div class="px-3">
                  <div class="col-sm-12 col-12">
                    <div class="card mb-3 bxs-0">
                      <div class="card-body px-0">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input category-radio" type="radio" name="category" id="radioAll" value="all" checked>
                          <label class="form-check-label" for="radioAll">All</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input category-radio" type="radio" name="category" id="radioDemo" value="demographics">
                          <label class="form-check-label" for="radioDemo">Demographics</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input category-radio" type="radio" name="category" id="radioMaternal" value="maternal">
                          <label class="form-check-label" for="radioMaternal">Maternal & Child Health</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input category-radio" type="radio" name="category" id="radioInfra" value="infrastructure">
                          <label class="form-check-label" for="radioInfra">Healthcare Infrastructure</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input category-radio" type="radio" name="category" id="radioDisease" value="disease">
                          <label class="form-check-label" for="radioDisease">Disease Analysis</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <a href="https://projectaudit.cditproject.org/healthsector_wise/eyJpdiI6ImVXbmcrMmlqRmpOWnVlK3M4YTZaVXc9PSIsInZhbHVlIjoiUkc3b3JrMThXZ082QlVBWWJ3MVpiZz09IiwibWFjIjoiNDdiNGIwNTZkMTMxMmEwOTRjNmJhZjc2NjU4ZjlmNzQ0ZWEyN2EzMmIyNDViY2I5NDhkNjVlZjhjZmFjMjY5NSIsInRhZyI6IiJ9"
                 class="gallery-view-button btn btn-info mt-2">
                Health Dashboard
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chart Cards -->
    <div class="col-xxl-6 col-sm-12 chart-section" data-category="infrastructure">
      <div class="card mb-3 border">
        <div class="card-header">
          <h5 class="card-title">Bed Strength In the Institutions Under DHS by Type of Institution</h5>
        </div>
        <div class="card-body" id="bedstrengthone" style="width: 100%;height: 400px;">
          <div id="chartdiv3" style="width: 100%; height: 100%;">[Chart 1]</div>
        </div>
      </div>
    </div>

    <div class="col-xxl-6 col-sm-12 chart-section" data-category="infrastructure">
      <div class="card mb-3 border">
        <div class="card-header">
          <h5 class="card-title">Bed Strength In the Institutions Under DHS by Type of Institution</h5>
        </div>
        <div class="card-body" id="bedstrengthtwo" style="width: 100%;height: 400px;">
          <div id="chartdiv4" style="width: 100%; height: 100%;">[Chart 2]</div>
        </div>
      </div>
    </div>

    <div class="col-xxl-6 col-sm-12 chart-section" data-category="maternal">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="card-title">Number of Institutions Selected or Converted as Family Health Centres</h5>
        </div>
        <div class="card-body" id="bedstrengthfour" style="width: 100%;height: 400px;">
          <div id="chartdiv6" style="width: 100%; height: 100%;">[Chart 3]</div>
        </div>
      </div>
    </div>

    <div class="col-xxl-6 col-sm-12 chart-section" data-category="disease demographics">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="card-title">Comparative Analysis of Lifestyle and Health Indicators</h5>
        </div>
        <div class="card-body" id="bedstrengththree" style="width: 100%;height: 400px;">
          <div id="chartdiv5" style="width: 100%; height: 100%;">[Chart 4]</div>
        </div>
      </div>
    </div>

    <!-- ------------ -->
  </div><!-- row gx-3 close -->
</div> <!-- container mt-4 close -->
