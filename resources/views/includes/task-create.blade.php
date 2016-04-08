<section class="todolist-task-create">
   <div class="row">
      <form action="{{action('TaskController@create')}}" method="POST" name="taskCreateForm" id="taskCreateForm">
         <div class="form-group col-sm-7">
            <label class="control-label" for="task">Task</label>
            <textarea class="form-control" name="task" form="taskCreateForm" placeholder="Task" required></textarea>
         </div>
         <!-- /.form-group -->
         <div class="form-group col-sm-3">
            <label class="control-label" for="deadline">Deadline</label>
            <input class="form-control todolist-datepicker" type="text" name="deadline" placeholder="Deadline" required>
         </div>
         <!-- /.form-group -->
         <div class="form-group col-sm-2">
            {{csrf_field()}}
            <input class="btn btn-default" type="button" value="Add">
         </div>
         <!-- /.form-group -->
      </form>
   </div>
   <!-- /.row -->
</section>