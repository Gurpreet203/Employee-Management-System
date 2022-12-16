<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section class="main">
        <div class="side-bar">
            <ul class="link-listing">
                <li>
                    <img src="https://img.freepik.com/free-vector/gradient-car-wash-logo-design_23-2149925894.jpg?w=740&t=st=1671085567~exp=1671086167~hmac=8098943615e7aa85f2e90676b8a0870d38ccf924172ef659e8cf5e45d2143685" alt="logo">
                </li>

                @admin
                    <a href="{{ route('users.index') }}" id="{{ Request::url() == route('users.index') ? 'hovereffect' : '' }}"><li><i class="bi bi-people-fill"></i> Users</li></a>

                    <a href="{{ route('leaves') }}" id="{{ Request::url() == route('leaves') ? 'hovereffect' : '' }}"><li><i class="bi bi-files"></i> Pending Leaves</li></a>

                    <a href="{{ route('leaves.show') }}" id="{{ Request::url() == route('leaves.show') ? 'hovereffect' : '' }}"><li><i class="bi bi-file-check"></i> Leaves</li></a>

                @else
                    
                    <a href="{{ route('attendance') }}" @if(App\Models\Attendance::exist(Auth::user())->first()) class="disable" @endif id="{{ Request::url() == route('attendance') ? 'hovereffect' : '' }}"><li><i class="bi bi-person-check"></i> Attendance</li></a>
                    <a href="{{ route('employees.index') }}" id="{{ Request::url() == route('employees.index') ? 'hovereffect' : '' }}"><li><i class="bi bi-list"></i> Leaves</li></a>
                    <a href="{{ route('leaves.create') }}" id="{{ Request::url() == route('leaves.create') ? 'hovereffect' : '' }}"><li><i class="bi bi-files"></i> Create Leave</li></a>
                    <a href="{{ route('penality.list') }}" id="{{ Request::url() == route('penality.list') ? 'hovereffect' : '' }}"><li><i class="bi bi-bookmark-x"></i> Penality</li></a>

                @endadmin
            </ul>
        </div>

        <div>
            @yield('content')
        </div>
    </section>
</body>
</html>