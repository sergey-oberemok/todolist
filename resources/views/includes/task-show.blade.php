<section class="todolist-task">
   <div class="row">
      <article>
         <div class="col-sm-2">
            {{csrf_field()}}
            <input type="checkbox" name="done" class="checkbox" onclick="taskDoneClick(event, '{{action('TaskController@editDone', ['id' => $task['id']])}}')"
                   value="{{$task['done']}}" <?= $task['done'] ? "checked" : "" ?>>
         </div>
         <!-- /.col-sm-1 -->
         <div class="col-sm-7">
            <span>{{$task['task']}}</span>
         </div>
         <!-- /.col-sm-7 -->
         <div class="col-sm-3">
            <span><?= Date('M j Y', strtotime($task['deadline'])); ?></span>
         </div>
         <!-- /.col-sm-3 -->
      </article>
   </div>
   <!-- /.row -->
</section>
<hr/>