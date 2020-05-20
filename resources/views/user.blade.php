<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Requests</title>
    <meta name="csrf-token">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/js/app.js') }}">
    <link rel= "stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<body>

<!-------------------Auth header------------------------->
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <ul class="navbar-nav mr-auto">
            <a class="nav-link" href="{{ route('start') }}">Create new request</a>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </ul>
    </div>
</nav>
<!-------------------End of Auth header------------------------->

<div class="align-content-center">
        <div class="text-center">
            <h2>USER REQUESTS</h2>
    </div>
    <table style='width: 100%' class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Zip</th>
            <th scope="col">Address</th>
            <th scope="col">Status</th>
            <th scope="col">Created_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userRequests as $field)
            <tr>
            <td>{{$field->email}}</td>
            <td>{{$field->zip}}</td>
            <td>{{$field->address}}</td>
            <td>{{$field->status}}
                @if ($field->status === 'Ready')
                    <a type="button" class="btn btn-success" href="invoices/download/{{$field->taxData->id}}">Download pdf</a>
                    <a type="button" class="btn btn-success" href="invoices/sendmail/{{$field->taxData->id}}">Send to email</a>
                    @endif
                    </td>
            <td>{{$field->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
</div>

<script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>
