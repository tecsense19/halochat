<style>
  <style>
  i.mdi.mdi-block-helper::before {
    margin-top: 3px;
}

i.mdi.mdi-tooltip-edit::before {
    margin-top: 5px;
}

i.mdi.mdi-tooltip-edit {
    margin-right: 0px;
    font-size: 25px;
    
}

i.mdi.mdi-block-helper {
    margin-right: 0px;
    font-size: 25px;
}

i.mdi.mdi-rocket {
    margin-right: 0px;
    font-size: 25px;
}


</style>
@include('admin.layout.header')
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
     
    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.layout.front')
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Credit Report </h3>
              <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
              </nav> -->
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Credit Debit Report</h4>
                
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Payment id</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($credit_debit) > 0)
                            @php $i = 1; $totalCredit = 0; $totalDebit = 0; @endphp
                            @foreach($credit_debit as $credit_debit_1)
                              @foreach($credit_debit_1->creditdebit as $usersListcredit)
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $usersListcredit->name }}</td>
                            <td>{{ isset($credit_debit_1->credit) ? $credit_debit_1->credit : '-' }}</td>
                            <td>{{ isset($credit_debit_1->debit) ? $credit_debit_1->debit : '-' }}</td>
                            <td>{{ $credit_debit_1->credit_debit_date }}</td>
                            <th>{{ isset($credit_debit_1->order_id) ? $credit_debit_1->order_id : '-' }}</th>
                            <td>{{ isset($credit_debit_1->payment_id) ? $credit_debit_1->payment_id : '-' }}</td>
                          </tr>
                          @php
                            $totalCredit = ($totalCredit + $credit_debit_1->credit);
                            $totalDebit = ($totalDebit + $credit_debit_1->debit);
                        @endphp
                          @php $i++; @endphp
                          @endforeach
                        @endforeach
                    @else
                    <tr scope="row" style="text-align: center;">
                            <td colspan="6">No credit debit Found.</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2">Total:</td>
                            <td>{{ isset($totalCredit) ? $totalCredit : '' }}</td>
                            <td>{{ isset($totalDebit) ? $totalCredit : '' }}</td>
                        </tr>
                        </tbody>
                      </table>
                      {!! $credit_debit->links('pagination') !!}
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>
</div>
</div>
</div>
</div>


@include('admin.layout.footer')