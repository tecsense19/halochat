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
            <th>Created At</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($usersList) > 0)
            @foreach($usersList as $keys => $usersList1)
                @php 
                    $userId = Crypt::encryptString($usersList1->id);
                @endphp
                @foreach($usersList1->credit as $usersListcredit)
                <tr>
                    <td>{{ ($keys + 1) }}</td>
                    <td>{{ $usersList1->name }}</td>
                    <td>{{ $usersList1->email }}</td>
                    <td>{{ $usersList1->gender }}</td>
                    <td>{{ $usersList1->role }}</td>
                    <td>{{ $usersListcredit->currentcredit }}</td>
                    <td>{{ $usersListcredit->totalcredit }}</td>
                    <td>{{ $usersList1->plans }}</td>
                    <td>{{ $usersList1->status }}</td>
                    <td>{{ date('Y-m-d', strtotime($usersList1->created_at)) }}</td>
                    <td>
                        <div class="d-flex justify-content-around align-items-center">
                            <a href="{{  URL::to('admin/users/edit', ['id' => $usersList1->id]) }}" role="button" title="Edit">
                                <i class="mdi mdi-pencil-box-outline" style="color: green; font-size: 24px;"></i>
                            </a>
                            <?php if($usersList1->status == "Suspend") { ?>
                                <a class="" onclick="activeUser('{{$usersList1->id}}')" id="get_id" style="color: green;" role="button" title="Active">
                                    <i class="mdi mdi-rocket" style="font-size: 24px;"></i>
                                </a>
                            <?php } else { ?>
                                <a class="" onclick="suspendUser('{{$usersList1->id}}')" id="get_id" style="color: red;" role="button" title="In-Active">
                                    <i class="mdi mdi-block-helper" style="font-size: 18px;"></i>
                                </a>
                            <?php } ?>
                            <a href="{{  URL::to('admin/users/edit', ['id' => $usersList1->id]) }}" role="button" title="Subscription">
                                <i class="mdi mdi-credit-card" style="font-size: 24px;"></i>
                            </a>
                            <a href="{{  URL::to('admin/users/credit_debit', ['id' => $userId]) }}" role="button" title="Credit-Debit">
                                <i class="mdi mdi-coin" style="font-size: 24px;"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            @endforeach
        @else
            <tr scope="row" class="text-center">
                <td colspan="20">User List Not Found.</td>
            </tr>
        @endif
    </tbody>
</table>
{{ $usersList->links('pagination') }}