@extends('layout.main')
@section('content')
    <x-nav />
    @include ('layout.flashMessages')
    <x-nav-bottom heading="Users" btn="Create User" route="users.create"/>
    <div class="rest-body">
        <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Designation</th>
            <th></th>
        </tr>

        @if ($users->count()>0)
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>

                    <td>
                            <div class="btn-group">
                                <button class="icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li>
                                    
                                    <form action="{{ route('users.status', $user) }}" method="post">
                                        @csrf
                                        <div class="drop-items-icon">
                                            @if($user->status)
                                                <i class="bi bi-slash-circle"></i>
                                                <input type="submit" value="Deactive" name="deactive" class="drop-items">
                                            @else
                                                <i class="bi bi-circle"></i>
                                                <input type="submit" value="Active" name="active" class="drop-items">
                                            @endif
                                        </div>
                                    </form>
                                </li>
                                    
                                <li class="drop-items">
                                    <div class="drop-items-icon">
                                        <i class="bi bi-wrench-adjustable"></i>
                                        <a href="{{ route('users.edit', $user) }}" confirm="want to proceed ? ">Edit</a>
                                    </div>
                                </li>
                                    
                                <li>
                                    <form action="" method="post">
                                        @csrf
                                        <div class="drop-items-icon">
                                            <i class="bi bi-arrow-clockwise"></i>
                                            <input type="submit" value="Reset Password" name="reset" class="drop-items">
                                        </div>
                                    </form>
                                </li>

                                <li>
                                    <form action="{{ route('users.delete', $user) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="drop-items-icon">
                                            <i class="bi bi-trash"></i>
                                            <input type="submit" value="Delete" name="delete" class="drop-items">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            </table>
            <h2 style="text-align: center">No User Exist</h2>
        @endif
    </table>
    </div>
    
@endsection