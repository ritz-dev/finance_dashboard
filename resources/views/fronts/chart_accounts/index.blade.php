@extends('fronts.main')

@section('chart-account-active','active')

@section('content')
<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row justify-content-between">


          <h3 class="fw-bold"><i class="fa-solid fa-chart-column"></i> Chart Account</h3>
          <a href="{{url('finance/chart_accounts/create')}}"><button type="button" class="btn btn-md btn-outline-success"> <i class="fa-solid fa-plus fa-2xl"></i> Create</button></a>

      </div>
      <div class="row">
        <div class="card mt-5">
            <h3 class="card-header p-3">Chart Account List</h3>
            <div class="card-body">
                <table class="table table-bordered data-table text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Account Category</th>
                            <th>Total Debit</th>
                            <th>Total Credit</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('account-list') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'code', name: 'code'},
              {data: 'account_category', name: 'account_category'},
              {data: 'total_debit', name: 'total_debit'},
              {data: 'total_credit', name: 'total_credit'},
              {data: 'description', name: 'description'},
          ]
      });

    });
  </script>
@endsection
