<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Images</th>
            <th>Ethnicity</th>
            <th>Image Prompt</th>
            <th>Negative Prompt</th>
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
            @foreach($profileList as $key => $profileList1)
                @php
                    $imgUrl = isset($profileList1->profileImages[0]['image_path']) ? asset('storage/app/public').'/'.$profileList1->profileImages[0]['image_path'] : [];
                    $profileId = Crypt::encryptString($profileList1->profile_id);
                @endphp
                <tr>
                    <td>{{ ($key + 1) }}</td>
                    <td>{{ $profileList1->name }}</td>
                    <td> @if($imgUrl)<img src="{{ $imgUrl }}" style="width: 50px; height: 50px;" />@else - @endif </td>
                    <td>{{ $profileList1->ethnicity }}</td>
                    <td>@if($profileList1->image_prompt)<textarea  style="width: 300px; background-color: #191c24; height: 100px; " class="form-control" cols="30" rows="30" readonly>{{ $profileList1->image_prompt }}</textarea>@endif</td>
                    <td>@if($profileList1->negative_prompt)<textarea  style="width: 300px; background-color: #191c24; height: 100px; " class="form-control" cols="30" rows="30" readonly>{{ $profileList1->negative_prompt }}</textarea>@endif</td>
                    <td>{{ $profileList1->personality }}</td>
                    <td>{{ $profileList1->age }}</td>
                    <td>{{ $profileList1->gender }}</td>
                    <td>{{ $profileList1->occupation }}</td>
                    <td>{{ $profileList1->hobbies }}</td>
                    <td>{{ $profileList1->relationship_status }}</td>
                    <td>{{ $profileList1->body_description }}</td>
                    <td>
                        <audio id="audio-preview" name="audio_preview" controls>
                            <source src="{{ $profileList1->voice_preview_url }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </td>
                    <td>
                        <a href="{{  URL::to('admin/profiles/edit', ['profile_id' => $profileId]) }}" role="button" title="Edit">
                            <i class="mdi mdi-pencil-box-outline" style="color: green; font-size: 24px;"></i>
                        </a>
                        <!-- <button class="btn btn-danger btn-rounded btn-icon"
                                                                    onclick="deleteProfile('{{$profileList1->profile_id}}')"
                                                                    id="get_id" value="" type="submit"> <i
                                                                        class="mdi mdi-delete-forever"></i> </button> -->

                    </td>
                </tr>
            @endforeach
        @else
            <tr scope="row" style="text-align: center;">
                <td colspan="20">Profile List Not Found.</td>
            </tr>
        @endif
    </tbody>
</table>
{!! $profileList->links('pagination') !!}