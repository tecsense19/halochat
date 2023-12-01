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

.pagination-link {
    @apply inline-block px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150;
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
                            <th>Status</th>
                            <th>Created date</th>
                            <th style="text-align: center;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($usersList) > 0)
                            @php $i = 1; @endphp
                            @foreach($usersList as $usersList1)
                              @foreach($usersList1->credit as $usersListcredit)
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $usersList1->name }}</td>
                            <td><a href="{{  URL::to('admin/users/credit_debit', ['id' => $usersList1->id]) }}">{{ $usersList1->email }}</a></td>
                            <td>{{ $usersList1->gender }}</td>
                            <td>{{ $usersList1->role }}</td>
                            <td>{{ $usersListcredit->currentcredit }}</td>
                            <td>{{ $usersListcredit->totalcredit }}</td>
                            <td>{{ $usersList1->plans }}</td>
                            <td>{{ $usersList1->status }}</td>
                            <td>{{ $usersList1->created_at }}</td>
                            <td>  
                            <div class="d-flex justify-content-around">
                            
                             
                            <a href="{{  URL::to('admin/users/edit', ['id' => $usersList1->id]) }}"> 
                                <button class="btn btn-primary btn-rounded btn-icon" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-tooltip-edit"></i> </button></a>
                            <?php if($usersList1->status == "Suspend") { ?>
                              <button class="btn btn-success btn-rounded btn-icon"  onclick="activeUser('{{$usersList1->id}}')" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-rocket"></i> </button> 
                           
                            <?php } else { ?>
                              <button class="btn btn-danger btn-rounded btn-icon"  onclick="suspendUser('{{$usersList1->id}}')" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-block-helper"></i> </button> 
                              <?php } ?>
                          </div>
                           </td>
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
                      {{ $usersList->links('pagination') }}
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


<script>
function suspendUser(id) {
  var appUrl = @json(config('app.url'));
    var str = appUrl + "/admin/users/suspend/" + id;
    swal({
            title: "Are you sure?",
            text: "Once Suspended, you will not be able to open this account and services",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: str,
                    success: function(result) {
                        swal("Poof! Your account has been suspended!", {
                            icon: "success",
                        }).then((willDelete) => {
                            if (willDelete) {
                                location.reload(true);
                            }
                        });
                    }
                });
            } else {
                swal("account is safe!"); 
            }
        });
}

function activeUser(id) {
  var appUrl = @json(config('app.url'));
var str = appUrl + "/admin/users/active/" + id;
swal({
        title: "Are you sure?",
        text: "Active this account",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: str,
                success: function(result) {
                    swal("Poof! Your account has been Active!", {
                        icon: "success",
                    }).then((willDelete) => {
                        if (willDelete) {
                            location.reload(true);
                        }
                    });
                }
            });
        } else {
            swal("account is not update!"); 
        }
    });
}
</script>