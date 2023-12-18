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
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="d-flex">
                                        <div><h4 class="card-title">Credit Debit Report</h4></div>
                                        <div class="ms-5 text-success">Total Credit - <label class="badge badge-success">{{ $totalCredit }}</label></div>
                                        <div class="ms-5 text-danger">Total Debit - <label class="badge badge-danger">{{ $totalDebit }}</label></div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <input name="search" id="search" class="form-control me-2"
                                        placeholder="Search Users" />
                                    <button name="clear-button" id="clear-button" class="btn btn-danger">Clear</button>
                                </div>
                            </div>
                            <div class="table-responsive creditDebitList">

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
    usersList();

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        if (url.startsWith('http://')) {
            // Replace "http://" with "https://"
            url = url.replace('http://', 'https://');
        }
        getPerPageUsersList(url);
    });
});

function usersList() {
    var search = $('#search').val();
    var userId = '{{ $userId }}';
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: "{{ URL::to('admin/users/credit/debit/list', [], true) }}",
        data: { search: search, user_id: userId },
        success: function(data) {
            $('.creditDebitList').html(data);
        }
    });
}

function getPerPageUsersList(get_pagination_url) {
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
            $('.creditDebitList').html(data);
        }
    });
}

$('body').on('keyup', '#search', function(e) {
    usersList();
});

$('body').on('click', '#clear-button', function(e) {
    $('#search').val('');
    usersList();
});
</script>