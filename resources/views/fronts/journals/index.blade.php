@extends('fronts.main')

@section('journal-active','active')

@section('content')

<div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row justify-content-between">
          <h3 class="fw-bold"> <i class="fa-solid fa-shuffle"></i> Journal</h3>
          <a href="{{url('journals/create')}}"><button type="button" class="btn btn-md btn-outline-success"> <i class="fa-solid fa-plus fa-2xl"></i> Create</button></a>

      </div>
      <div class="row">
        <div class="card mt-5">
            <h3 class="card-header p-3">Journal List</h3>
            <div class="card-body table-responsive">
                <table class="table table-bordered data-table text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Transaction Date</th>
                            <th>Number</th>
                            <th>Ref No</th>
                            <th>Des</th>
                            <th style="width: 300px;">Account Name</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Created By</th>
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
          ajax: "{{ url('journals') }}",
          columnDefs: [
            { targets: 5, width: '300px' },
        ],
          columns: [
            {data: 'id', name: 'id'},
            {data: 'transaction_date', name: 'transaction_date'},
            {data: 'number', name: 'number'},
            {data: 'reference_number', name: 'reference_number'},
            {data: 'description', name: 'description'},
            {data: 'account_name', name: 'account_name'},
            {data: 'debit', name: 'debit'},
            {data: 'credit', name: 'credit'},
            {data: 'created_by', name: 'created_by'},
          ]
      });

    });
</script>
@endsection
