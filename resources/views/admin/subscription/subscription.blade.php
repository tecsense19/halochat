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
                <h3 class="page-title"> Manage Subscription </h3>
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
                                    <h4 class="card-title">Subscription</h4>
                                </div>
                                <div class="d-flex">
                                    <input name="search" id="search" class="form-control me-2"
                                        placeholder="Search Subscription" />
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

<script type="text/javascript">
$(document).ready(function() {
    subscriptionList();

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        getPerPageSubscriptionList(url);
    });
});

function subscriptionList() {
    var search = $('#search').val();
    var userId = '{{ $userId }}';

    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: '{{ route("admin.subscription.list") }}',
        data: { search: search, user_id: userId },
        success: function(data) {
            $('.userDataList').html(data);
        }
    });
}

function getPerPageSubscriptionList(get_pagination_url) {
    var search = $('#search').val();
    var userId = '{{ $userId }}';

    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: get_pagination_url,
        data: { search: search, user_id: userId },
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
//                             subscriptionList();
//                         }
//                     });
//                 }
//             });
//         }
//     });
// }



function cancelSubscription(status, id) {
    Swal.fire({
        title: 'Are you sure?',
        text: status.charAt(0).toUpperCase() + status.slice(1) + " Subscription",
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
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
                },
                url: '{{ route("admin.subscription.cancel") }}',
                data: { status: status, user_id: id },
                success: function(result) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Subscription has been '+ status + '!',
                        icon: 'success',
                        confirmButtonColor: '#fe7d22',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            subscriptionList();
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

$('body').on('keyup', '#search', function(e) {
    subscriptionList();
});

$('body').on('click', '#clear-button', function(e) {
    $('#search').val('');
    subscriptionList();
});


</script>
