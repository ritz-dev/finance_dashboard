@extends('fronts.main')

@section('dashboard-active','active')

@section('content')
<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pb-4"
      >
        <div>

          <h3 class="fw-bold mb-3"><i class="fa-solid fa-house"></i> Dashboard</h3>
        </div>
      </div>
      <div class="row">

            <div class="col-sm-6 col-md-3">
                <!-- <a href="{{route('account-list')}}"> -->
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                    <div
                        class="icon-big text-center icon-primary bubble-shadow-small"
                    >
                    <i class="fa-solid fa-chart-column"></i>
                    </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Chart Account</p>
                        <h4 class="card-title">{{$chart_accounts_count}}</h4>
                    </div>
                    </div>

                </div>
                </div>
            </div>
        <!-- </a> -->
            </div>

        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-info bubble-shadow-small"
                  >
                  <i class="fa-solid fa-right-left"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Transaction</p>
                    <h4 class="card-title">{{$transactions_count}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-success bubble-shadow-small"
                  >
                  <i class="fa-solid fa-shuffle"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Journal</p>
                    <h4 class="card-title">{{$journals_count}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-secondary bubble-shadow-small"
                  >
                    <i class="far fa-check-circle"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Ledger</p>
                    <h4 class="card-title">{{$ledgers_count}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
