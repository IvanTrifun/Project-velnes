@include('layouts.header')
@include('layouts.settingsSidebar')

<div class="container mt-4">
    <div class="wrapper ms-5">
        <h1>Employees</h1>
    <table class="table table-no-border">
        <tbody>
            @foreach($employees->groupBy('employee_id') as $employee_id => $employeeData)
                <tr>
                    <td><img src="{{$employeeData->first()['profile_picture']}}" style="width: 50px !important; height: 50px !important; object-fit: cover; border-radius: 50% !important;" alt=""></td>
                    <td>{{$employeeData->first()['full_name']}}</td>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

