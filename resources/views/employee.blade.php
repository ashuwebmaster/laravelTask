@extends('layouts.master')
@section('title', 'Register')
@section('content')

<main class="my-form">
    <div class="container">
        <style>
            .w-5{
                display:none;
            }
        </style>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Age</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($employees as $key=>$employee )
                     
                  <tr>
                    <th scope="row">{{$employee->id}}</th>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->salary}}</td>
                    <td>{{$employee->age}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table> 
              <div>{{$employees->links()}}</div>          
        </div>
    </div>
</main>

@endsection