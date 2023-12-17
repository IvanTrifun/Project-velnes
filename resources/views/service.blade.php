@include('layouts.header')
@include('layouts.settingsSidebar')
<div class="container mt-4">
    <div class="wrapper ms-5">
    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewGroup">New Service</button>
    </div>

    <div class="modal fade" id="createNewGroupModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('service.store')}}"  method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="service_name">Name</label>
                                <input type="text" name="service_name" id="service_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" required>
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
            <th scope="col">Service Name</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($serviceData as $data)
                <tr>
                    <td>{{$data->service_name}}</td>
                    <td>{{$data->price}}</td>
                    <td>
                         <!-- Trigger link for the modal -->
                        <a href="#" class="options" data-each-id="{{$data->service_id}}">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        <!-- Modal Main -->
                        <div class="modal fade optionsModal-{{$data->service_id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog position-absolute">
                                <div class="modal-content">
                                    <div class="modal-body d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button class='btn btn-primary btn-sm form-control edit-{{$data->service_id}}' data-toggle="modal" data-target="#editModal-{{$data->service_id}}">Edit</button>
                                        <form action="{{route ('service.destroy')}}"  method="POST" class=" my-0 ms-1">
                                            @csrf
                                            @method('DELETE')

                                                <div class="form-group">
                                                    <input type="text" name="service_id" id="service_id" class="form-control" value='{{$data->service_id}}' hidden>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" tabindex="-1" id="editModal-{{$data->service_id}}" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route ('service.update')}}"  method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="text" name="service_id" id="service_id" value="{{$data->service_id}}" hidden>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" id="price" class="form-control" value="{{$data->price}}" required>
                                            </div>
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

