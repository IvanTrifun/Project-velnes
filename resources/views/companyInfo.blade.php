@include('layouts.header')
@include('layouts.settingsSidebar')
<div class="container mt-4">
    <div class="wrapper ms-5">
    <form action="{{route ('companyInfo.update')}}"  method="POST">
        @csrf
        @method('PUT')

            <input type="text" name="company_id" id='company_id' value="{{$company->id}}" hidden>
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" value="{{$company->company_name}}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{$company->email}}" required>
            </div>
            <div class="form-group">
                <label for="work_number">Work Number</label>
                <input type="text" name="work_number" id="work_number" class="form-control" value="{{$company->work_number}}" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{$company->city}}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{$company->address}}" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{$company->postal_code}}" required>
            </div>
            <div class="form-group">
                <label for="logo">Company Logo</label>
                <input type="text" name="logo" id="logo" class="form-control" value="{{$company->logo}}" required>
                <img src="{{$company->logo}}" alt="" style='width:50 !important; height:50 !important;'>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
    </form>
    </div>
</div>
