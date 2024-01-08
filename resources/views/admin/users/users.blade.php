@include('admin.layout.header')
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">

    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.layout.front')
    <div class="main-panel">
        {!! csrf_field() !!}
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
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <h4 class="card-title">Users</h4>
                                </div>
                                <div class="d-flex">
                                    <input name="search" id="search" class="form-control me-2"
                                        placeholder="Search Users" />
                                    <button name="clear-button" id="clear-button" class="btn btn-danger">Clear</button>
                                </div>
                            </div>
                            <div class="table-responsive userDataList">

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
$(document).ready(function() {
    usersList();

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        // Check if the URL starts with "http://"
        if (url.startsWith('http://')) {
            // Replace "http://" with "https://"
            url = url.replace('http://', 'https://');
        }
        getPerPageUsersList(url);
    });
});

function usersList() {
    var search = $('#search').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: "{{ URL::to('admin/users/list', [], true) }}",
        // url: "{{ URL::to('admin/users/list') }}",
        data: { search: search },
        success: function(data) {
            $('.userDataList').html(data);
        }
    });
}

function getPerPageUsersList(get_pagination_url) {
    var search = $('#search').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: get_pagination_url,
        data: { search: search },
        success: function(data) {
            $('.userDataList').html(data);
        }
    });
}

// function deleteBooking(booking_id)
// {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Delete this booking.",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Yes',
//         confirmButtonColor: '#fe7d22',
//         cancelButtonText: 'No',
//         cancelButtonColor: '#d33',
//         allowOutsideClick: false,
//         allowEscapeKey: false
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 type:'post',
//                 headers: {'X-CSRF-TOKEN': jQuery('input[name=_token]').val()},
//                 url:'',
//                 data: { booking_id: booking_id },
//                 success:function(response)
//                 {
//                     Swal.fire({
//                         title: 'Success',
//                         text: response.message,
//                         icon: 'success',
//                         confirmButtonColor: '#fe7d22',
//                         confirmButtonText: 'OK',
//                         allowOutsideClick: false,
//                         allowEscapeKey: false
//                     }).then((result) => {
//                         if (result.isConfirmed) {
//                             usersList();
//                         }
//                     });
//                 }
//             });
//         }
//     });
// }


$('body').on('keyup', '#search', function(e) {
    usersList();
});

$('body').on('click', '#clear-button', function(e) {
    $('#search').val('');
    usersList();
});


function suspendUser(id) {
    var appUrl = @json(config('app.url'));
    var str = appUrl + "/admin/users/suspend/" + id;

    Swal.fire({
        title: 'Are you sure?',
        text: "Once Suspended, you will not be able to open this account and services",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        confirmButtonColor: '#fe7d22',
        cancelButtonText: 'No',
        cancelButtonColor: '#d33',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: str,
                success: function(result) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Your account has been suspended!',
                        icon: 'success',
                        confirmButtonColor: '#fe7d22',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            usersList();
                        }
                    });
                }
            });
        } else {
            swal("account is safe!");
        }
    });
}
</script>
<script>
function activeUser(id) {
    var appUrl = @json(config('app.url'));
    var str = appUrl + "/admin/users/active/" + id;

    Swal.fire({
        title: 'Are you sure?',
        text: "Active this account",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        confirmButtonColor: '#fe7d22',
        cancelButtonText: 'No',
        cancelButtonColor: '#d33',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: str,
                success: function(result) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Your account has been Active!',
                        icon: 'success',
                        confirmButtonColor: '#fe7d22',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            usersList();
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