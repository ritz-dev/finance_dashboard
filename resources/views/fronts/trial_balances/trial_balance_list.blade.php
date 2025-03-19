
@extends('fronts.main')

@section('trial-balance-active','active')

@section('content')

<div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row justify-content-between">
            <h3 class="fw-bold"> <i class="fa-solid fa-scale-balanced"></i> Trial Balance</h3>
            {{-- <a href="{{route('trial_balance_add')}}"><button type="button" class="btn btn-md btn-outline-success"> <i class="fa-solid fa-plus fa-2xl"></i> Add</button></a> --}}
      </div>
      <div class="row">
        <div class="card mt-5">
            <h3 class="card-header p-3">Trial Balance List</h3>
            <div class="card-body table-responsive">
                <table class="table table-bordered data-table text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Account Name</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
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
          ajax: "{{ url('finance/trial_balance_list') }}",
          columns: [
            {data: 'id', name: 'id'},
            {data: 'account_name', name: 'chart_account_id'},
            {data: 'debit_amount', name: 'debit_amount'},
            {data: 'credit_amount', name: 'credit_amount'},
          ],
          drawCallback: function (settings) {
            var api = this.api();
            var info = api.page.info();
            var total_debit = settings.json.total_debit;
            var total_credit = settings.json.total_credit;

            if (info.page === info.pages - 1) {
                $('.data-table tfoot').show();
                $('.data-table tfoot tr th').eq(2).html('Total Debit: ' + total_debit);
                $('.data-table tfoot tr th').eq(3).html('Total Credit: ' + total_credit);
            } else {
                $('.data-table tfoot').hide();
            }
        }
      });

    });
</script>
@endsection
