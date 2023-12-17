@include('layouts.header')
<div class="container mt-4">

    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewGroup">Create New Customer</button>
    </div>

    <div class="modal fade" id="createNewGroupModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('customer.store')}}"  method="POST">
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
                                <label for="contact_number">Phone Number</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="group_id">Group:</label>
                                <select name="group_id" id="group_id" class="form-control">
                                    <option value="">Select a Group</option>
                                    @foreach (App\Models\Group::all() as $group)
                                        <option value="{{ $group->id }}">{{ $group->group}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-no-border">
        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Customer Group</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredCustomers as $customer)
                    <tr>
                        <td>{{$customer->full_name}}</td>
                        @if ($customer->group !== null)
                            <td>{{$customer->group->group}}</td>
                        @else
                            <td style="color: rgba(175, 174, 174, 0.733) !important">NULL</td>
                        @endif

                        <td>{{$customer->contact_number}}</td>
                        <td>{{$customer->email}}</td>
                        <td>
                            <!-- Trigger link for the modal -->
                            <a href="#" class="options" data-each-id="{{$customer->id}}">
                                <i class="fa-solid fa-ellipsis"></i>
                            </a>
                            <!-- Modal Main -->
                            <div class="modal fade optionsModal-{{$customer->id}}" id="myModal{{$loop->index}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog position-absolute">
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-start align-items-center">
                                            <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <button class='btn btn-primary btn-sm form-control edit-{{$customer->id}}' data-toggle="modal" data-target="#editModal-{{$customer->id}}">Edit</button>
                                            <form action="{{route ('customer.destroy')}}"  method="POST" class="m-0 ms-1">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="form-group">
                                                        <input type="text" name="customer_id" id="customer_id" class="form-control" value='{{$customer->id}}' hidden>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" tabindex="-1" id="editModal-{{$customer->id}}" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route ('customer.update')}}"  method="POST">
                                                @csrf
                                                @method('PUT')

                                                    <input type="text" name="customer_id" id='customer_id' value="{{$customer->id}}" hidden>
                                                    <div class="form-group">
                                                        <label for="full_name">Full Name</label>
                                                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{$customer->full_name}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" name="email" id="email" class="form-control" value="{{$customer->email}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact_number">Phone Number</label>
                                                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{$customer->contact_number}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="group_id">Group:</label>
                                                        <select name="group_id" id="group_id" class="form-control">
                                                            <option value="">Select a Group</option>
                                                            @foreach (App\Models\Group::all() as $group)
                                                                <option value="{{ $group->id }}" required>{{ $group->group}}</option>
                                                            @endforeach
                                                        </select>
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
