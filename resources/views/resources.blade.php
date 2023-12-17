@include('layouts.header')
@include('layouts.settingsSidebar')
<div class="container mt-4">
        <div class="wrapper ms-5">
    <h1>Tools</h1>
    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewTool">Create New Tool</button>
    </div>

    <div class="modal fade" id="ceateToolsModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New Tool</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('resources.storeTool')}}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tool_name">Tool Name</label>
                            <input type="text" name="tool_name" id="tool_name" class="form-control" required>
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
            <th scope="col">Active Tools</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($tools as $tool)
                <tr>
                    <td>{{$tool->tool_name}}</td>
                    <td>
                         <!-- Trigger link for the modal -->
                        <a href="#" class="options" id='options' data-each-id="{{$tool->id}}-Tools">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        {{--  onclick="openModal({{$loop->index}}, this)" --}}
                        <!-- Modal Main -->
                        <div class="modal fade optionsModal-{{$tool->id}}-Tools" id="optionsModal-{{$tool->id}}-Tools" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog position-absolute">
                                <div class="modal-content">
                                    <div class="modal-body d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button class='btn btn-primary btn-sm form-control edit-{{$tool->id}}-Tools' data-toggle="modal" data-target="#editModal-{{$tool->id}}-Tools">Edit</button>
                                        <form action="{{route ('resources.destroyTool')}}" class=" my-0 ms-1" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <div class="form-group">
                                                    <input type="text" name="tool_id" id="tool_id" class="form-control" value="{{$tool->id}}" hidden>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" tabindex="-1" id="editModal-{{$tool->id}}-Tools" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route ('resources.updateTool', $tool->id)}}"  method="POST">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="tool_name">Tool Name</label>
                                                    <input type="text" name="tool_name" id="tool_name" value="{{$tool->tool_name}}" class="form-control" required>
                                                    <input type="text" name="tool_id" id="tool_id" class="form-control" value="{{$tool->id}}" hidden>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
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

{{-- ==========================================================ROOMS!============================================================================================================ --}}
<div class="container mt-4">
    <div class="wrapper ms-5">
    <h1>Rooms</h1>
    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewRoom">Create New Room</button>
    </div>

    <div class="modal fade" id="createRoomsModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('resources.storeRoom')}}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="room_name">Room Name</label>
                            <input type="text" name="room_name" id="room_name" class="form-control" required>
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
            <th scope="col">Active Room</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{$room->room_name}}</td>
                    <td>
                         <!-- Trigger link for the modal -->
                        <a href="#" class="options" id="options" data-each-id="{{$room->id}}-Rooms">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        {{-- onclick="openModal({{$loop->index}}, this)" --}}
                        <!-- Modal Main -->
                        <div class="modal fade optionsModal-{{$room->id}}-Rooms" id="myModal{{$loop->index}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog position-absolute">
                                <div class="modal-content">
                                    <div class="modal-body d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button class='btn btn-primary btn-sm form-control edit-{{$room->id}}-Rooms' data-toggle="modal" data-target="#editModal-{{$room->id}}">Edit</button>
                                        <form action="{{route ('resources.destroyRoom')}}" class=" my-0 ms-1" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <div class="form-group">
                                                    <input type="text" name="room_id" id="room_id" class="form-control" value="{{$room->id}}" hidden>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" tabindex="-1" id="editModal-{{$room->id}}-Rooms" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Room</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" value="{{$room->room_name}}" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route ('resources.updateRoom', $room->id)}}"  method="POST">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="room_name">Room Name</label>
                                                    <input type="text" name="room_name" id="room_name" class="form-control" value="{{$room->room_name}}" required>
                                                    <input type="text" name="room_id" id="room_id" class="form-control" value="{{$room->id}}" hidden>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
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

