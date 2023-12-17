@include('layouts.header')
    <div class="container">
        <div class="wrapper ms-5 col-md-3">
            <h1>Account Settings</h1>
            <form action="{{route ('accountSettings.update')}}"  method="POST">
                @csrf
                @method('PUT')

                    <div class="form-group">
                        <label for="full_name">Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{$currentUser->full_name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$currentUser->email}}" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="repeat_password">Confirm Password</label>
                        <input type="password" name="repeat_password" id="repeat_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="text" name="profile_picture" id="profile_picture" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

