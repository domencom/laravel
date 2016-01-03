@extends('layouts.app')

@section('content')
 <h1>Edit {!! $task->name !!}</h1>
 @include('common.errors')
 {!! Form::open(['method' => 'PATCH', 'url' => "task/{$task->id}/update", 'class' => 'form-horizontal']) !!}

         <!-- Task Name -->
 <div class="form-group">
     <label for="task" class="col-sm-3 control-label">Task</label>

     <div class="col-sm-6">
         <input value="{{$task->name}}" type="text" name="name" id="task-name" class="form-control">
     </div>
 </div>

 <!-- Add Task Button -->
 <div class="form-group">
     <div class="col-sm-offset-3 col-sm-6">
         <button type="submit" class="btn btn-default">
             <i class="fa fa-plus"></i> Add Task
         </button>
     </div>
 </div>
 {!! Form::close() !!}
@endsection

@section('footer')
    <div class="navbar navbar-default">Footer info</div>
@endsection