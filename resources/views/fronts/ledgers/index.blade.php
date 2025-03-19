@extends('fronts.main')

@section('ledger-active','active')

@section('content')

<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row justify-content-between"
      >


          <h3 class="fw-bold"> <i class="far fa-check-circle"></i> Ledger</h3>

      </div>
      <div class="row">
        <div class="card mt-5">
            <h3 class="card-header p-3">Ledger List</h3>
            <div class="card-body table-responsive">
                <table class="table table-bordered data-table text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Chart Account</th>
                            <th>Transaction</th>
                            <th>Description</th>
                            <th>Debit Amount</th>
                            <th>Credit Amount</th>
                            <th>Balance</th>
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
          ajax: "{{ url('ledgers') }}",
          columns: [
            {data: 'id', name: 'id'},
            {data: 'date', name: 'date'},
            {data: 'name', name: 'chart_account_id'},
            {data: 'number', name: 'transaction_id'},
            {data: 'description', name: 'description'},
            {data: 'debit_amount', name: 'debit_amount'},
            {data: 'credit_amount', name: 'credit_amount'},
            {data: 'balance', name: 'balance'},
          ]
      });

    });
</script>
@endsection
