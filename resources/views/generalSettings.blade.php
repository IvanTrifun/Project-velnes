@include('layouts.header')
@include('layouts.settingsSidebar')
<div class="container mt-4">
    <div class="wrapper ms-5">
    <form action="{{route ('generalSettings.destroy')}}"  method="POST">
        @csrf
        @method('DELETE')
            <div class="form-group">
                <label for="password">Confirm deletion (PASSWORD)</label>
                <input type="text" name="password" id="password" class="form-control"  required>
            </div>
            <button type="submit" class="btn btn-primary">Delete account</button>
    </form>
    </div>
</div>
