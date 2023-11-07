<style>
  <style>
  i.mdi.mdi-delete-forever::before {
    margin-top: 3px;
}

i.mdi.mdi-tooltip-edit::before {
    margin-top: 5px;
}

i.mdi.mdi-tooltip-edit {
    margin-right: 0px;
    font-size: 25px;
    
}

i.mdi.mdi-delete-forever {
    margin-right: 0px;
    font-size: 25px;
}

</style>
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
              <h3 class="page-title"> Manage Users </h3>
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
                    <h4 class="card-title">Users</h4>
                
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>Current credit</th>
                            <th>Total credit</th>
                            <th>Plans</th>
                            <th>Created date</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($usersList) > 0)
                            @php $i = 1; @endphp
                            @foreach($usersList as $usersList)
                              @foreach($usersList->credit as $usersListcredit)
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $usersList->name }}</td>
                            <td>{{ $usersList->email }}</td>
                            <td>{{ $usersList->gender }}</td>
                            <td>{{ $usersList->role }}</td>
                            <td>{{ $usersListcredit->currentcredit }}</td>
                            <td>{{ $usersListcredit->totalcredit + $usersListcredit->usedcredit }}</td>
                            <td>{{ $usersList->plans }}</td>
                            <td>{{ $usersList->created_at }}</td>
                            <!-- <td>  
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-danger btn-rounded btn-icon" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-delete-forever"></i> </button>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary btn-rounded btn-icon" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-tooltip-edit"></i> </button>
                           </td> -->
                          </tr>
                         
                          @php $i++; @endphp
                          @endforeach
                        @endforeach
                    @else
                    <tr scope="row" style="text-align: center;">
                            <td colspan="3">User List Not Found.</td>
                        </tr>
                        @endif
                        </tbody>
                      </table>
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