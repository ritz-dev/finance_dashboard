
@extends('fronts.main')

@section('balance-sheet-active','active')

@section('content')

<div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row justify-content-between mt-2">
            <h3 class="fw-bold"> <i class="fa-solid fa-sheet-plastic"></i> Balance Sheet</h3>
            {{-- <a href="{{route('trial_balance_add')}}"><button type="button" class="btn btn-md btn-outline-success"> <i class="fa-solid fa-plus fa-2xl"></i> Add</button></a> --}}
      </div>
      <div class="row">
        <div class="card mt-3">
            <h3 class="card-header p-3">SOFP (Statement of Financial position)</h3>
            <div class="card-body table-responsive">
                <div style="margin: 20px 0px;">
                    <strong>Month:</strong>
                    <input type="month" name="month" value="" class="py-1"/>
                    <button class="btn btn-success btn-sm filter">Search</button>
                </div>

                <table class="table table-bordered data-table text-center">
                    <thead>
                        <tr>
                            <th>Account Name</th>
                            <th>Total Debit</th>
                            <th>Total Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr class="foot1">
                            <th></th>
                        </tr>
                        <tr class="foot2">
                            <th></th>
                        </tr>
                        <tr class="foot3">
                            <th></th>
                        </tr>
                        <tr class="foot4">
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
    // $(function () {
    //     var table = $('.data-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: {
    //             url: "{{ route('balance_sheet_ajax') }}",
    //             data:function (d) {
    //                 const monthInput = $('input[name="month"]').val();
    //                 if (monthInput) {
    //                     const [year, month] = monthInput.split('-');
    //                     d.month = month;
    //                     d.year = year;
    //                 } else {
    //                     d.month = null;
    //                     d.year = null;
    //                 }
    //             }
    //         },
    //         // ajax: "{{ route('balance_sheet_ajax') }}",
    //         // data:function (d) {
    //         //     const monthInput = $('input[name="month"]').val();
    //         //     if (monthInput) {
    //         //         const [year, month] = monthInput.split('-');
    //         //         d.month = month;
    //         //         d.year = year;
    //         //     } else {
    //         //         d.month = null;
    //         //         d.year = null;
    //         //     }
    //         // }
    //         columns: [
    //             {data: 'account_name', name: 'chart_account_id'},
    //             {data: 'total_debit', name: 'total_debit'},
    //             {data: 'total_credit', name: 'total_credit'},
    //         ],
    //         drawCallback: function (settings) {
    //             var api = this.api();
    //             var info = api.page.info();
    //             var revenueNetTotal = settings.json.revenueNetTotal;
    //             var expenseNetTotal = settings.json.expenseNetTotal;
    //             var assetNetTotal = settings.json.assetNetTotal;
    //             var liaEquiNetTotal = settings.json.liaEquiNetTotal;

    //             if (info.page === info.pages - 1) {
    //                 $('.data-table tfoot').show();
    //                 $('.data-table tfoot tr.foot1 th').attr('colspan', 4).html('Revenue Net Total : ' + revenueNetTotal);
    //                 $('.data-table tfoot tr.foot2 th').attr('colspan', 4).html('Expense Net Total : ' + expenseNetTotal);
    //                 $('.data-table tfoot tr.foot3 th').attr('colspan', 4).html('Asset Net Total : ' + assetNetTotal);
    //                 $('.data-table tfoot tr.foot4 th').attr('colspan', 4).html('Liability and Equity Net Total : ' + liaEquiNetTotal);
    //             } else {
    //                 $('.data-table tfoot').hide();
    //             }
    //         }
    //     });

    //     // $(".filter").click(function(){
    //     //     table.draw();
    //     // });

    // });


    $('.filter').on('click', function () {
    const monthInput = $('input[name="month"]').val();

    if (monthInput) {
        const [year, month] = monthInput.split('-');

        // Initialize the DataTable
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('balance_sheet_ajax') }}",
                data: {
                    month: month,
                    year: year,
                }
            },
            destroy: true,
            columns: [
                {data: 'account_name', name: 'chart_account_id'},
                {data: 'total_debit', name: 'total_debit'},
                {data: 'total_credit', name: 'total_credit'},
            ],
            drawCallback: function (settings) {
                var api = this.api();
                var info = api.page.info();
                var revenueNetTotal = settings.json.revenueNetTotal;
                var expenseNetTotal = settings.json.expenseNetTotal;
                var assetNetTotal = settings.json.assetNetTotal;
                var liaEquiNetTotal = settings.json.liaEquiNetTotal;

                if (info.page === info.pages - 1) {
                    $('.data-table tfoot').show();
                    $('.data-table tfoot tr.foot1 th').attr('colspan', 4).html('Revenue Net Total : ' + revenueNetTotal);
                    $('.data-table tfoot tr.foot2 th').attr('colspan', 4).html('Expense Net Total : ' + expenseNetTotal);
                    $('.data-table tfoot tr.foot3 th').attr('colspan', 4).html('Asset Net Total : ' + assetNetTotal);
                    $('.data-table tfoot tr.foot4 th').attr('colspan', 4).html('Liability and Equity Net Total : ' + liaEquiNetTotal);
                } else {
                    $('.data-table tfoot').hide();
                }
            }
        });
    } else {
        alert("Please select a valid month.");
    }
});
</script>
@endsection
