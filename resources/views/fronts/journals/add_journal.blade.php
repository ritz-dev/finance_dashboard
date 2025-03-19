@extends('fronts.main')

@section('journal-active','active')

@section('content')

<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row"
      >
        <div>

          <h3 class="fw-bold"> <i class="fa-solid fa-shuffle"></i> Journal</h3>

        </div>
      </div>
      <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Create Journal</h5>

                <a href="{{url('finance/journals')}}"><button type="button" class="btn btn-md btn-outline-danger">Back</button></a>
            </div>
            <div class="card-body">
                <form action="{{url('finance/journal_store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Transaction Date</label>
                            <input type="date" name="transaction_date" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>

                        <div class="col-sm-6 mt-2">
                            <label class="form-label">Reference Number</label>
                            <input type="text" name="reference_number" class="form-control">
                        </div>

                        <div class="col-sm-6 mt-2">
                            <label class="form-label">Created By</label>
                            <input type="text" name="created_by" value="CC" class="form-control">
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <label class="form-label">Chart Account</label>
                            <select name="chart_account_id[]" class="form-control">
                                <option>Select an option...</option>
                                @foreach($chart_accounts as $chart_account)
                                    <option value="{{$chart_account->id}}">{{$chart_account->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <label class="form-label">Note</label>
                            <input type="text" name="note[]" class="form-control">
                        </div>

                        <div class="col-sm-2">
                            <label class="form-label">Debit</label>
                            <input type="number" name="debit[]" value="0" class="form-control">
                        </div>

                        <div class="col-sm-2">
                            <label class="form-label">Credit</label>
                            <input type="number" name="credit[]" value="0" class="form-control">
                        </div>

                        <div class="col-sm-2">
                            <br>
                            <button type="button" class="btn btn-sm btn-outline-success mt-2" id="add-button"><i class="fa-solid fa-plus fa-2xl"></i></button>
                        </div>
                    </div>

                    <div class="mt-2" id="add-journal-detail">

                    </div>

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

@section('script')
<script>
    $(document).ready(function () {

        var row = 0;
        $('#add-button').on('click', function () {
            row++;
            $('#add-journal-detail').append(`
                <div class="row" id="number-${row}">
                    <div class="col-sm-4">
                        <label class="form-label">Chart Account</label>
                        <select name="chart_account_id[]" class="form-control">
                            <option>Select an option...</option>
                            @foreach($chart_accounts as $chart_account)
                                <option value="{{$chart_account->id}}">{{$chart_account->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label class="form-label">Note</label>
                        <input type="text" name="note[]" class="form-control">
                    </div>

                    <div class="col-sm-2">
                        <label class="form-label">Debit</label>
                        <input type="number" name="debit[]" value="0" class="form-control">
                    </div>

                    <div class="col-sm-2">
                        <label class="form-label">Credit</label>
                        <input type="number" name="credit[]" value="0" class="form-control">
                    </div>

                    <div class="col-sm-2">
                        <br>
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="remove-button">-</button>
                    </div>
                </div>
            `);

        });

        $(document).on('click', '#remove-button', function () {
            $(this).closest('.row').remove();
        });
    });
</script>
@endsection
