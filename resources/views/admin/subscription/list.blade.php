<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subscription id</th>
            <th>Subscription type</th>
            <th>Authantication Id</th>
            <th>Transaction ID</th>
            <th>Order Total</th>
            <th>Quantity</th>
            <th>Subscription Start date</th>
            <th>Subscription Next date</th>
            <th>Decline reason</th>
            <th>Error</th>
            <th>Status</th>
            
            <!-- <th style="text-align: center;">Action</th> -->
        </tr>
    </thead>
    <tbody>
        @if(count($subscriptionList) > 0)
            @foreach($subscriptionList as $keys => $subscriptionList1)
                @php 
                    $userId = Crypt::encryptString($subscriptionList1->id);
                @endphp
                @foreach($subscriptionList1->subscription_user as $subscriptionUser)
                <tr>
                    <td>{{ ($keys + 1) }}</td>
                    <td>{{ $subscriptionUser->name }}</td>
                    <td>{{ $subscriptionUser->email }}</td>
                    <td>{{ $subscriptionList1->subscription_id }}</td>
                    <td>{{ $subscriptionList1->authId }}</td>
                    <td>{{ $subscriptionList1->transactionID }}</td>
                    <td>{{ $subscriptionList1->orderTotal }}</td>
                    <td>{{ $subscriptionList1->quantity }}</td>
                    <td>{{ date('Y-m-d', strtotime($subscriptionList1->subscription_start_date)) }}</td>
                    <td>{{ date('Y-m-d', strtotime($subscriptionList1->subscription_next_date)) }}</td>
                    <td>{{ $subscriptionList1->decline_reason }}</td>
                    <td>{{ $subscriptionList1->error_message }}</td>
                    <td>{{ $subscriptionList1->resp_msg }}</td>
                
                    <td>
                        <!-- <div class="d-flex justify-content-around align-items-center">
                            <a href="{{  URL::to('admin/users/edit', ['id' => $subscriptionList1->id]) }}" role="button" title="Edit">
                                <i class="mdi mdi-pencil-box-outline" style="color: green; font-size: 24px;"></i>
                            </a>
                            <?php if($subscriptionList1->status == "Suspend") { ?>
                                <a class="" onclick="activeUser('{{$subscriptionList1->id}}')" id="get_id" style="color: green;" role="button" title="Active">
                                    <i class="mdi mdi-rocket" style="font-size: 24px;"></i>
                                </a>
                            <?php } else { ?>
                                <a class="" onclick="suspendUser('{{$subscriptionList1->id}}')" id="get_id" style="color: red;" role="button" title="In-Active">
                                    <i class="mdi mdi-block-helper" style="font-size: 18px;"></i>
                                </a>
                            <?php } ?>
                            <a href="{{  URL::to('admin/users/edit', ['id' => $subscriptionList1->id]) }}" role="button" title="Subscription">
                                <i class="mdi mdi-credit-card" style="font-size: 24px;"></i>
                            </a>
                            <a href="{{  URL::to('admin/users/credit_debit', ['id' => $userId]) }}" role="button" title="Credit-Debit">
                                <i class="mdi mdi-coin" style="font-size: 24px;"></i>
                            </a>
                        </div> -->
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
{{ $subscriptionList->links('pagination') }}