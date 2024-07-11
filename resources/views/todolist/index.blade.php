@extends('layouts.app')

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if (isset($error))
        <div class="row">
            <div class="alert alert-danger" role="alert">
                {{ $error }}
                <!-- Corrected typo here -->
            </div>
        </div>
        @endif
        <div class="row">
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="w-15 btn btn-lg btn-danger" type="submit">Sign Out</button>
            </form>
        </div>
        <div class="row align-items-center g-lg-5 py-2">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Todolist</h1>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="{{ route('add') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="todo" placeholder="todo" autofocus>
                        <label for="todo">Todo</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Add Todo</button>
                </form>
            </div>
        </div>
        <div class="row align-items-right g-lg-5 py-4">
            <div class="mx-auto">
                <form id="deleteForm" method="post" style="display: none">
    
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Todo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($todolist as $todo)
                        <tr>
                            <th scope="row">{{ $todo['id'] }}</th>
                            <td>{{ $todo['todo'] }}</td>
                            <td>
                               <form action="{{ route('remove', $todo['id']) }}" method="post">
                                @csrf
                                    <button class="w-100 btn btn-lg btn-danger" type="submit">Remove</button>
                               </form>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection