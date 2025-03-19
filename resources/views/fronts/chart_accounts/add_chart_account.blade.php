@extends('fronts.main')

@section('chart-account-active','active')

@section('content')

<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row"
      >
        <div>

          <h3 class="fw-bold"> <i class="fa-solid fa-shuffle"></i> Chart Account</h3>

        </div>
      </div>
      <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Create Chart Account</h5>

                <a href="{{url('finance/account-list')}}"><button type="button" class="btn btn-md btn-outline-danger">Back</button></a>
            </div>
            <div class="card-body">
                <form action="{{url('finance/chart_store')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Code</label>
                            <input type="text" name="code" class="form-control">
                        </div>

                        <div class="col-sm-6 mt-2">
                            <label class="form-label">Account Category</label>
                            <select name="account_category_id" id="account_category_id" class="form-control">
                                <option>Select an option...</option>
                                @foreach($account_categories as $account_category)
                                    <option value="{{$account_category->id}}">{{$account_category->account_category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 mt-2">
                            <label class="form-label">Total Debit</label>
                            <input type="number" name="total_debit" class="form-control" value="0">
                        </div>

                        <div class="col-sm-6 mt-2">
                            <label class="form-label">Total Credit</label>
                            <input type="number" name="total_credit" class="form-control" value="0">
                        </div>
                    </div>

                    <hr>

                    <div class="col-sm-6 offset-sm-3 mt-3">
                        <button type="submit" class="btn btn-md btn-outline-success w-100">Save</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

