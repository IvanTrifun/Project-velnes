@include('layouts.header')
<div class="container mt-4">

    <div class="wrapper button-wrapper d-flex justify-content-end my-2">
        <button class="btn btn-primary btn-lg" id="createNewGroup">Create New Product</button>
    </div>

    <div class="modal fade" id="createNewGroupModal" tabindex="-1" aria-labelledby="createNewGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewGroupModalLabel">Create New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('product.store')}}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" name="stock" id="stock" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
    <h2 class="me-5">TOTAL ITEMS : {{$totalitems}}</h2>
    <h2>TOTAL STOCK VALUE : {{$totalstockvalue}}</h2>
    </div>
    <br>
    <br>
    <table class="table table-no-border">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($productData->groupBy('product_id') as $productId => $groupData)
                <tr>
                  <td>  {{$groupData->first()['product_name']}}</td>
                  <td>  {{$groupData->first()['category']}}</td>
                  <td>  {{$groupData->first()['price']}}</td>
                  <td>  {{$groupData->first()['stock']}}</td>
                    <td>
                         <!-- Trigger link for the modal -->
                        <a href="#" class="options" data-each-id="{{$groupData->first()['product_id']}}">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        <!-- Modal Main -->
                        <div class="modal fade optionsModal-{{$groupData->first()['product_id']}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog position-absolute">
                                <div class="modal-content">
                                    <div class="modal-body d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button class='btn btn-primary btn-sm form-control edit-{{$groupData->first()['product_id']}}' data-toggle="modal" data-target="#editModal-{{$groupData->first()['product_id']}}">Edit</button>
                                        <form action="{{route ('product.destroy')}}" class=" my-0 ms-1" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <div class="form-group">
                                                    <input type="text" name="product_id" id="product_id" class="form-control" value='{{$groupData->first()['product_id']}}' hidden>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" tabindex="-1" id="editModal-{{$groupData->first()['product_id']}}" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route ('product.update', $groupData->first()['product_id'])}}"  method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="text" name="product_id" id="product_id" value="{{$groupData->first()['product_id']}}" hidden>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" id="price" class="form-control" value="{{$groupData->first()['price']}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="text" name="stock" id="stock" class="form-control" value="{{$groupData->first()['stock']}}" required>
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


