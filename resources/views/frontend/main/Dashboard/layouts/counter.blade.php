                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 border border-primary rounded-circle me-3">
                                            <div class="icon-box md bg-primary-subtle rounded-5">
                                                <i class="ri-numbers-fill text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h1 class="lh-1">28</h1>
                                            <h5 class="m-0 b-0">Birth Rate</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-end mt-1">
                                        <a class="text-primary view-all" href="#" data-type="birth">
                                            <span>View chart</span>
                                            <i class="ri-arrow-right-line ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 border border-primary rounded-circle me-3">
                                            <div class="icon-box md bg-primary-subtle rounded-5">
                                                <i class="ri-numbers-fill text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h2 class="lh-1">9.66</h2>
                                            <h5 class="m-0 b-0">Death Rate</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-end mt-1">
                                        <a class="text-primary view-all" href="#" data-type="death">
                                            <span>View chart</span>
                                            <i class="ri-arrow-right-line ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 border border-primary rounded-circle me-3">
                                            <div class="icon-box md bg-primary-subtle rounded-5">
                                                <i class="ri-numbers-fill text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h2 class="lh-1">29</h2>
                                            <h5 class="m-0 b-0">Maternal Mortality</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-end mt-1">
                                       <a class="text-primary view-all" href="#" data-type="maternal">
                                            <span>View chart</span>
                                            <i class="ri-arrow-right-line ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 border border-primary rounded-circle me-3">
                                            <div class="icon-box md bg-primary-subtle rounded-5">
                                                <i class="ri-numbers-fill text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h2 class="lh-1">6</h2>
                                            <h5 class="m-0 b-0">Infant Mortality Rate</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-end mt-1">
                                        <a class="text-primary view-all" href="#" data-type="infant">
                                            <span>View chart</span>
                                            <i class="ri-arrow-right-line ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

                    <!-- Modal -->
<div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chartModalLabel">Detailed Chart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="chartdiv1" style="width: 100%; height: 500px;"></div>
      </div>
    </div>
  </div>
</div>