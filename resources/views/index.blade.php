@extends('layouts.master')

@section('title')
   Todo list
@endsection

@section('content')
   <section>
      <div class="container-fluid">
         @include('includes.heading', ['headingTitle' => 'Todo List'])

         @include('includes.tasks')

         @include('includes.task-create')

         @include('includes.text')
      </div>
      <!-- /.container-fluid -->
   </section>
@endsection

@section('scripts')
   <script src="{{asset('src/js/lib.js')}}" type="text/javascript"></script>
   <script src="{{asset('src/js/index.js')}}" type="text/javascript"></script>
@endsection
