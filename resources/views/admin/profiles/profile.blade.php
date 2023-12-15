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
                <h3 class="page-title"> Manage Profiles </h3>
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
                                    <h4 class="card-title">Profiles</h4>
                                </div>
                                <div class="d-flex">
                                    <input name="search" id="search" class="form-control me-2"
                                        placeholder="Search Profiles" />
                                    <button name="clear-button" id="clear-button" class="btn btn-danger">Clear</button>
                                </div>
                            </div>
                            <div class="table-responsive profileList">
                                
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
    profilesList();

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        getPerPageProfilesList(url);
    });
});

function profilesList() {
    var search = $('#search').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: '{{ route("admin.profile.lists", [], true) }}',
        data: { search: search },
        success: function(data) {
            $('.profileList').html(data);
        }
    });
}

function getPerPageProfilesList(get_pagination_url) {
    var search = $('#search').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': jQuery('input[name=_token]').val()
        },
        url: get_pagination_url,
        data: { search: search },
        success: function(data) {
            $('.profileList').html(data);
        }
    });
}

$('body').on('keyup', '#search', function(e) {
    profilesList();
});

$('body').on('click', '#clear-button', function(e) {
    $('#search').val('');
    profilesList();
});

function deleteProfile(id) {
    var str = "{{URL::to('admin/profiles/destroy', [], true)}}/" + id;
        
    Swal.fire({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover this imaginary file!",
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
                        text: 'Your imaginary file has been deleted!',
                        icon: 'success',
                        confirmButtonColor: '#fe7d22',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            profilesList();
                        }
                    });
                }
            });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
}
</script>
