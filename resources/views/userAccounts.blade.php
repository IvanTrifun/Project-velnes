@include('layouts.header')
@include('layouts.settingsSidebar')
<div class="container mt-4">
    <div class="wrapper ms-5">
    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewGroup">Create New User</button>
    </div>

    <div class="modal fade" id="createNewGroupModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('userAccounts.store')}}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="repeat_password">Confirm Password</label>
                            <input type="text" name="repeat_password" id="repeat_password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-no-border">
        <thead>
        <tr>
            <th></th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">User Access</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($coworkersData->groupBy('user_id') as $user_id => $groupData)
                <tr>
                    <td><img src="{{$groupData->first()['profile_picture']}}" alt="" style='width: 50px !important; height: 50px !important; object-fit: cover; border-radius: 50% !important;'></td>
                    <td>{{$groupData->first()['email']}}</td>
                    <td>{{$groupData->first()['user_name']}}</td>
                    <td>{{implode(', ', $groupData->first()['role_type'])}}</td>
                    <td>
                         <!-- Trigger link for the modal -->
                        <a href="#" class="options" data-each-id="{{$groupData->first()['user_id']}}">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        <!-- Modal Main -->
                        <div class="modal fade optionsModal-{{$groupData->first()['user_id']}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog position-absolute">
                                <div class="modal-content">
                                    <div class="modal-body d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button class='btn btn-primary btn-sm form-control edit-{{$groupData->first()['user_id']}}' data-toggle="modal" data-target="#editModal-{{$groupData->first()['user_id']}}">Edit</button>
                                        <form action="{{route ('userAccounts.destroy')}}" class=" my-0 ms-1" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <div class="form-group">
                                                    <input type="text" name="user_id" id="user_id" class="form-control" value='{{$groupData->first()['user_id']}}' hidden>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" tabindex="-1" id="editModal-{{$groupData->first()['user_id']}}" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route ('userAccounts.update', $groupData->first()['user_id'])}}"  method="POST">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="full_name">Name</label>
                                                    <input type="text" name="full_name" id="full_name" class="form-control" value="{{$groupData->first()['user_name']}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" id="email" class="form-control" value="{{$groupData->first()['email']}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password">New Password</label>
                                                    <input type="text" name="new_password" id="new_password" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="repeat_password">Confirm Password</label>
                                                    <input type="text" name="repeat_password" id="repeat_password" class="form-control" required>
                                                </div>
                                                    @foreach (App\Models\Role::all() as $role)
                                                        <input type="checkbox" name="selectedRoles[]" value="{{$role->id}}">{{$role->role_type}}<br>
                                                    @endforeach
                                                <input type="text" name="user_id" id="user_id" class="form-control" value='{{$groupData->first()['user_id']}}' hidden>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
