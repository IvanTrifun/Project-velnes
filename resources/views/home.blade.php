@include('layouts.header')
<div class="container mt-5">
    <div class="col-md-7 mb-5">
        <div class="col-md-7">
            <h1>Welcome to velness!</h1>
        </div>
        <div class="col-lg">
            <p>
                Fromnow on we will make your everyday work ife easier, so you cam focus on
                what you do best! Start setting up your business in Velnes and discover all
                features Prefer talking to human?
            </p>
            <div class="d-flex tourButtons">
                <button class="btn btn-primary btn-lg me-2" herf="#">Start the product tour</button>
                <button class="btn btn-primary btn-lg" herf="#">Schedule free demo</button>
            </div>
        </div>
    </div>
    <div class="table-wrapper col-lg-6">
        <table class="table">
            <thead class="table-header border border-bottom-1 border-secondary-subtle">
                <tr>
                    <div class="th-wrapper mb-3 d-flex flex-row">
                        <div class="rounded me-1 border bg-body-secondary border-secondary-subtle p-3">
                            <a class="text-decoration-none text-secondary" href="#">Schedule</a>
                        </div>
                        <div class="rounded me-2 border border-secondary-subtle p-3">
                            <a class="text-decoration-none text-secondary" href="#">Activity</a>
                        </div>
                        <select class="form-control">
                            <option>All Employees &#9660;</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" required>{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </tr>

            </thead>
            <tbody>
                @foreach ($pivotData->groupBy('transaction_id') as $transactionId => $groupData)
                    <td class="d-flex flex-row">
                        <div class="time-wrapper">
                            {{$groupData->first()['start_hours_minutes']}}
                            <br>
                            {{$groupData->first()['end_hours_minutes']}}
                        </div>
                        <div class="img-wrapper">
                            <img class="img-thumbnail rounded-circle-thumbnail" src="{{$groupData->first()['img_src']}}" alt="">
                        </div>
                        <div class="d-flex flex-column text-box-wrapper">
                            <p class="home-name mb-0">{{$groupData->first()['user_full_name']}}</p>
                            <p class="home-service mb-0 text-secondary-emphasis">{{$groupData->first()['service_name']}}</p>
                        </div>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>


        {{-- <h1>Service : {{$groupData->first()['service_name']}}</h1>
        <h4>Employee Name : {{$groupData->first()['user_full_name']}}</h4>
        <small>Start Time : {{$groupData->first()['start_time']}}</small>
        <br>
            <small>End Time : {{$groupData->first()['end_time']}}</small>
            <br>
            <br> --}}
    </div>

