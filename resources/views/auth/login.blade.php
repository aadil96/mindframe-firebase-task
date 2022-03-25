@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Login
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                @include('common.notifications')

                <!-- New Task Form -->
                <form action="{{ route('login') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-6">
                            <input type="text" name="email" id="task-name" class="form-control" value="{{ old('email') ?? 'mail@test.com'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-6">
                            <input type="password" name="password" id="task-name" class="form-control" value="{{ old('password') ?? 'password' }}">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
