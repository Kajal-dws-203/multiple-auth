@extends('admin.layout.app1')

@section('content')
    <div class="container pt-4">
        <form  action="{{ route('user.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="texy" class="form-control" id="exampleInputPassword1" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">
                <label for="role"> Role : </label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                    <label class="form-check-label" for="role">
                        Admin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="user" value="user">
                    <label class="form-check-label" for="flexRadioDefault2">
                        User
                    </label>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-secondary">Submit</button>
                <a type="buttton" class="btn btn-secondary" href="{{ route('show.admin.dashboard') }}">Back</a>
            </div>
        </form>
    </div>
@endsection