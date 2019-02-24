<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    {{-- bootstrap css CDN --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    {{-- bootstrap js CDN --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                <th>Check</th>
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
                        <td>
                            <div class="[ form-group ]">
                                    <input type="checkbox" name="fancy-checkbox-success[]" id="fancy-checkbox-success" autocomplete="off" />
                                <div class="[ btn-group ]">
                                    <label for="fancy-checkbox-success" class="[ btn btn-success ]">
                                          <span class="[ glyphicon glyphicon-ok ]"></span>
                                           <span> </span>
                                    </label>
                                     <label for="fancy-checkbox-success" class="[ btn btn-default active ]">
                                          Success Checkbox
                                     </label>

                                </div>
                            </div>
                        </td>

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