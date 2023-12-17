<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 Custom Login and Registration - Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </head>
  <body>

    {{-- <h1>{{$usersCollection}}</h1> --}}
    {{-- @foreach ($usersCollection as $user)
     <h1>{{$user}}</h1>
    @endforeach

    <br>
    <h1>{{$companies}}</h1>

    <br>
    <br>
    <br>

    @foreach ($rolesCollection as $role ){
        <h1>{{$role}}</h1>
    }




    @endforeach --}}

    <br>
    <br>
    <br>

    @foreach ($servicesCollection as $service)
        <h1>{{$service->pivot->price}}</h1>


    @endforeach
    {{-- @foreach ($companies as $company)
    <h1>{{$company->company_name}}</h1>
    @endforeach --}}
  </body>
</html>
