@extends('layouts.master')

@section('title')
   Task
@endsection

@section('content')
   <section>
      <div class="container-fluid">
         <div>
            @include('includes.heading', ['headingTitle' => 'Task'])

            @include('includes.task-show')

            @include('includes.comments')

            @include('includes.comment-create')

            <hr/>
            <a href="{{URL::to('/')}}">Back</a>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
@endsection

@section('scripts')
   <script src="{{asset('src/js/lib.js')}}" type="text/javascript"></script>
   <script src="{{asset('src/js/task.js')}}" type="text/javascript"></script>
@endsection