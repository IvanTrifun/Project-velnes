@include('layouts.header')

<div class="modal fade" id="appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('calendar.storeEvent')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="service_id">Service:</label>
                    <select name="service_id" id="service_id" class="form-control">
                        <option value="">Select a Service</option>
                        @foreach ($serviceData as $service)
                            <option value="{{ $service->id }}" required>{{ $service->service_name}}</option>
                        @endforeach
                    </select>
                    <label for="start_time">Start Time:</label>
                    <input type="datetime-local" name="start_time" id="start_time">
                    <br>
                    <label for="end_time">End Time:</label>
                    <input type="datetime-local" name="end_time" id="end_time">
                    <br>
                    <br>
                    <label for="customer_id">Customer:</label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">Select a Customer</option>
                        @foreach ($customerData as $customer)
                            <option value="{{ $customer->id }}" required>{{ $customer->full_name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="room_id">Room:</label>
                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">Select a Room</option>
                        @foreach ($roomData as $room)
                            <option value="{{ $room->id }}" required>{{ $room->room_name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="tool_id">Tool:</label>
                    <select name="tool_id" id="tool_id" class="form-control">
                        <option value="">Select a Tool</option>
                        @foreach ($toolData as $tool)
                            <option value="{{ $tool->id }}" required>{{ $tool->tool_name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="User_id">Employee:</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Employee</option>
                        @foreach ($employeeData as $employee)
                            <option value="{{ $employee->id }}" required>{{ $employee->full_name}}</option>
                        @endforeach
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-5">CALENDAR</h3>
            <div class="col-md-11 offset-1 mt-5 mb-5">

                <div id="calendar">

                </div>

            </div>
        </div>
    </div>
</div>
<script> var booking = @json($calendarData) </script>
<script src='{{mix('resources/js/calendar.js')}}'></script>

