@extends('layouts.app')

@section('main-content')
    <div class="min-height-300 bg-primary w-100 position-absolute top-0 start-0 z-1"></div>

    <section class="position-relative z-1 container-fluid"> 
        <div class="row">
            <div class="col">
                <div class="card custom-bg-white">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold custom-text-dark">Today's Money</p>
                                    <h5 class="font-weight-bolder custom-text-dark">
                                        $53,000
                                    </h5>
                                    <p class="mb-0 custom-text-dark">
                                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                                        since yesterday
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div>
                                    <i class="fa-solid fa-money-bill-trend-up rounded-circle p-3 custom-bg-success fs-4 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card custom-bg-white">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold custom-text-dark">Today's Users</p>
                                    <h5 class="font-weight-bolder custom-text-dark">
                                        2,300
                                    </h5>
                                    <p class="mb-0 custom-text-dark">
                                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                                        since last week
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div>
                                    <i class="fa-solid fa-users rounded-circle p-3 bg-primary fs-4 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card custom-bg-white">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold custom-text-dark">New Clients</p>
                                    <h5 class="font-weight-bolder custom-text-dark">
                                        +3,462
                                    </h5>
                                    <p class="mb-0 custom-text-dark">
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div>
                                    <i class="fa-solid fa-user-plus rounded-circle p-3 fs-4 bg-info text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
