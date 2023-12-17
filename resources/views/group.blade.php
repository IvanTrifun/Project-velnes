@include('layouts.header')
@include('layouts.settingsSidebar')
<div class="container mt-4">
    <div class="wrapper ms-5">
    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewGroup">Create New Group</button>
    </div>

    <div class="modal fade" id="createNewGroupModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('group.store')}}"  method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="full_name">Group Name</label>
                                <input type="text" name="group_name" id="group_name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Create Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-no-border">
        <thead>
        <tr>
            <th scope="col">Group</th>
            <th scope="col">Customer Count</th>
        </tr>
        </thead>
        <tbody>
            @foreach($groupsData as $group)
                <tr>
                    <td>{{$group->group}}</td>
                    <td>{{$group->customerCount}}</td>
                    <td>
                         <!-- Trigger link for the modal -->
                        <a href="#" class="options" data-each-id="{{$group->group_id}}">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        <!-- Modal Main -->
                        <div class="modal fade optionsModal-{{$group->group_id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog position-absolute">
                                <div class="modal-content">
                                    <div class="modal-body d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button class='btn btn-primary btn-sm form-control edit-{{$group->group_id}}' data-toggle="modal" data-target="#editModal-{{$group->group_id}}">Edit</button>
                                        <form action="{{route ('group.destroy')}}" class=" my-0 ms-1" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <div class="form-group">
                                                    <input type="text" name="group_id" id="group_id" class="form-control" value='{{$group->group_id}}' hidden>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" tabindex="-1" id="editModal-{{$group->group_id}}" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route ('group.update', $group->group_id)}}"  method="POST">
                                            @csrf
                                            @method('PUT')

                                                <input type="text" name='group_id' value="{{$group->group_id}}" hidden>
                                                <div class="form-group">
                                                    <label for="full_name">Group Name</label>
                                                    <input type="text" name="group_name" id="group_name" class="form-control" value="{{$group->group}}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Update Group</button>
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


