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
                            @foreach($profileList as $profileList)
                            @php 
                              $imgUrl = isset($profileList->profileImages[0]['image_path']) ? asset('storage/app/public').'/'.$profileList->profileImages[0]['image_path'] : []; 
                          @endphp
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $profileList->name }}</td>
                            <td> @if($imgUrl)<img src="{{ $imgUrl }}" style="width: 50px; height: 50px;" />@else - @endif </td>
                            <td>{{ $profileList->ethnicity }}</td>
                            <td>{{ $profileList->personality }}</td>
                            <td>{{ $profileList->age }}</td>
                            <td>{{ $profileList->gender }}</td>
                            <td>{{ $profileList->occupation }}</td>
                            <td>{{ $profileList->hobbies }}</td>
                            <td>{{ $profileList->relationship_status }}</td>
                            <td>{{ $profileList->body_description }}</td>
                            <td><audio id="audio-preview" name="audio_preview" controls>
                                    <source src="{{ $profileList->voice_preview_url }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                            </audio>
                            </td>
                            <td>  
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{  URL::to('admin/profiles/edit', ['profile_id' => $profileList->profile_id]) }}"><button class="btn btn-primary btn-rounded btn-icon" onclick="editProfile('{{$profileList->profile_id}}')" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-tooltip-edit"></i> </button></a>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-danger btn-rounded btn-icon" onclick="deleteProfile('{{$profileList->profile_id}}')" id="get_id" value=""
                            type="submit"> <i class="mdi mdi-delete-forever"></i> </button>
                               
                            </div>
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