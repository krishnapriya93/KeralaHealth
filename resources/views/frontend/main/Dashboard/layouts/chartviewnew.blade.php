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
                  <div class="col-sm-12">
                    <div class="card mb-3 bxs-0">
                      <div class="card-body px-0">
                        @php
                          $categories = [
                            'all' => 'All',
                            'demographics' => 'Demographics',
                            'maternal' => 'Maternal & Child Health',
                            'infrastructure' => 'Healthcare Infrastructure',
                            'disease' => 'Disease Analysis'
                          ];
                        @endphp

                        @foreach ($categories as $value => $label)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input category-radio" type="radio" name="category"
                                   id="radio{{ ucfirst($value) }}" value="{{ $value }}"
                                   @if ($value === 'all') checked @endif>
                            <label class="form-check-label" for="radio{{ ucfirst($value) }}">{{ $label }}</label>
                          </div>
                        @endforeach
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
    </div>

    <!-- Dynamic Chart Section -->
    <div class="col-12">
      <div id="chartsContainer" class="row gx-3"></div>
    </div>
  </div>
</div>
