@include('admin.layout.header')
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
.pagination-link {
    @apply inline-block px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150;
}

</style>
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">

    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.layout.front')
    <div class="main-panel">
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
                            <h4 class="card-title">Profiles</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Images</th>
                                            <th>Ethnicity</th>
                                            <th>Personality</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Occupation</th>
                                            <th>Hobbies</th>
                                            <th>Relationship status</th>
                                            <th>Body description</th>
                                            <th>Voice</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if(count($profileList) > 0)
                                        @php $i = 1; @endphp
                                        @foreach($profileList as $profileList1)
                                        @php
                                        $imgUrl = isset($profileList1->profileImages[0]['image_path']) ?
                                        asset('storage/app/public').'/'.$profileList1->profileImages[0]['image_path'] :
                                        [];
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $profileList1->name }}</td>
                                            <td> @if($imgUrl)<img src="{{ $imgUrl }}"
                                                    style="width: 50px; height: 50px;" />@else - @endif </td>
                                            <td>{{ $profileList1->ethnicity }}</td>
                                            <td>{{ $profileList1->personality }}</td>
                                            <td>{{ $profileList1->age }}</td>
                                            <td>{{ $profileList1->gender }}</td>
                                            <td>{{ $profileList1->occupation }}</td>
                                            <td>{{ $profileList1->hobbies }}</td>
                                            <td>{{ $profileList1->relationship_status }}</td>
                                            <td>{{ $profileList1->body_description }}</td>
                                            <td><audio id="audio-preview" name="audio_preview" controls>
                                                    <source src="{{ $profileList1->voice_preview_url }}"
                                                        type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </td>
                                            <td>
                                                    <a href="{{  URL::to('admin/profiles/edit', ['profile_id' => $profileList1->profile_id]) }}"><button
                                                            class="btn btn-primary btn-rounded btn-icon"
                                                            onclick="editProfile('{{$profileList1->profile_id}}')"
                                                            id="get_id" value="" type="submit"> <i
                                                                class="mdi mdi-tooltip-edit"></i> </button></a>

                                                        <button class="btn btn-danger btn-rounded btn-icon"
                                                            onclick="deleteProfile('{{$profileList1->profile_id}}')"
                                                            id="get_id" value="" type="submit"> <i
                                                                class="mdi mdi-delete-forever"></i> </button>

                                            </td>
                                        </tr>

                                        @php $i++; @endphp
                                        @endforeach
                                        @else
                                        <tr scope="row" style="text-align: center;">
                                            <td colspan="3">User List Not Found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                   
                                </table>
                                {!! $profileList->links('pagination') !!}
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

<script>
function deleteProfile(id) {

    var str = "{{URL::to('admin/profiles/destroy')}}/" + id;
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: str,
                    success: function(result) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        }).then((willDelete) => {
                            if (willDelete) {
                                location.reload(true);
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

@include('admin.layout.footer')
