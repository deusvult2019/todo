@extends('layouts.app')

@section('content')
<div class="container">
<div style=" text-align: center" >
    
<div style="display: inline-block">
    @if (count($errors) > 0)    
    <div class="alert alert-danger">       
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif   

    <form action="/home" method="post">
        @csrf
        <input type="text" name="uloha" placeholder="Pridat Ulohu">
        <input type="submit">
        
        </form> 

        <form action="/home" method="post">
        @csrf
        @method('put')
        <input type="search" name="search" placeholder="Vyhladat Ulohu">
        <input type="submit">
        
        </form> 

    
        <table class="table table-striped task-table">  
            @foreach ($tasks as $task)
            @if($task->hotovo)
             <tr class="table-success">
                <td >
                     <div>{{ $task->uloha }}</div>
                </td>
            @else
            <tr >
                <td >
                     <div>{{ $task->uloha }}</div>
                </td>
                <td>
                    
                    <form action="{{ route('task.complete',$task->id)}}" method="POST">           
                        <button type="submit" class="btn btn-secondary">
                           Dokoncit
                        </button>
                        @csrf
                        @method('put')
                    </form>
                </td>
                @endif
            <tr>
            @endforeach
        </table> 

        </div>

</div>   


   
</div>
@endsection
