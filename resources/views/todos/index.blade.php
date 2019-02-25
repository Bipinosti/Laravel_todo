@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">



    {{-- bootstrap css CDN --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    {{-- bootstrap js CDN --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



    <title>Todo List App</title>
</head>
<body>

<div class="container">
    <div class="col-md-offset-2 col-md-8">
        <div class="row">
            <h1>Todo List</h1>
        </div>

        {{-- display success message --}}
        @if (Session::has('success'))
            <div class="alert alert-success">
                <strong>Success:</strong> {{ Session::get('success') }}
            </div>
        @endif

        {{-- display error message --}}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row" style='margin-top: 10px; margin-bottom: 10px;'>
            <form action="{{ route('todos.store') }}" method='POST'>
                {{ csrf_field() }}

                <div class="col-md-9">
                    <input type="text" name='newTaskName' class='form-control'>
                </div>

                <div class="col-md-3">
                    <input type="submit" class='btn btn-primary btn-block' value='Add Task'>
                </div>
            </form>
        </div>

         {{--display stored tasks--}}
        @if (count($todos) > 0)
            <table class="table">
                <thead>
                <th>Task #</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>

                <tbody>
                @foreach ($todos as $todo)
                    <tr>
                        <th>{{ $todo->id }}</th>
                        <td>{{ $todo->name }}</td>
                        <td><a href="{{ route('todos.edit', ['tasks'=> $todo->id]) }}" class='btn btn-default'>Edit</a></td>
                        <td>
                            <form action="{{ route('todos.destroy', ['tasks'=> $todo->id]) }}" method='POST'>
                                {{ csrf_field() }}
                                <input type="hidden" name='_method' value='DELETE'>

                                <input type="submit" class='btn btn-danger' value='Delete'>
                            </form>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <div class="row text-center">
            {{ $todos->links() }}
        </div>

    </div>
</div>
</body>
</html>