<section class="todolist-tasks-heading">
   <div class="row">
      <?php
      $colSmDone = 1;
      $colSmTask = 6;
      $colSmDeadline = 3;
      $colSmComments = 1;
      $colSmRemove = 1;
      ?>
      <div class="col-sm-<?= $colSmDone; ?>">
         Done
      </div>
      <!-- /.col-sm -->
      <div class="col-sm-<?= $colSmTask; ?>">
         Task
      </div>
      <!-- /.col-sm -->
      <div class="col-sm-<?= $colSmDeadline; ?>">
         Deadline date
      </div>
      <!-- /.col-sm -->
      <div class="col-sm-<?= $colSmComments; ?>">
         Comments
      </div>
      <!-- /.col-sm -->
      <div class="col-sm-<?= $colSmRemove; ?>">
         Remove
      </div>
      <!-- /.col-sm- -->
   </div>
   <!-- /.row -->
</section>

<section class="todolist-tasks">
   @foreach($tasks as $task)
      <article class="todolist-task <?= $task->done ? 'todolist-task-done' : ''?>">
         <div class="row">
            <div class="col-sm-<?= $colSmDone; ?>">
               {{csrf_field()}}
               <input class="checkbox" type="checkbox" name="done" value="{{$task->done}}"
                      onclick="taskDoneClick(event, '{{action('TaskController@editDone', ['id' => $task->id])}}')"
                      onchange="taskDoneChange(event)" <?= $task->done ? 'checked' : '' ?>/>
            </div>
            <!-- /.form-group -->
            <div class="col-sm-<?= $colSmTask; ?>">
               <a href="{{action('TaskController@show', ['id' => $task->id])}}">{{$task->task}}</a>
            </div>
            <!-- /.form-group -->
            <div class="col-sm-<?= $colSmDeadline; ?> todolist-task-deadline" data-deadline="{{$task->deadline}}">
               {{date('M j Y', strtotime($task->deadline))}}
            </div>
            <!-- /.form-group -->
            <div class="col-sm-<?= $colSmComments; ?>">
               {{$task->comments}}
            </div>
            <!-- /.form-group -->
            <div class="col-sm-<?= $colSmRemove; ?>">
               <span class="glyphicon glyphicon-minus"
                     onclick="removeTask(event, '{{action('TaskController@remove', ['id' => $task->id])}}')"></span>
               <!-- /.glyphicon glyphicon-minus -->
            </div>
            <!-- /.col-sm- -->
         </div>
         <!-- /.row -->
      </article>
   @endforeach


   <article class="todolist-task-hidden" style="display: none">
      <div class="row">
         <div class="col-sm-<?= $colSmDone; ?>">
            {{csrf_field()}}
            <input class="checkbox" type="checkbox" name="done" value=""
                   onclick="taskDoneClick(event, '{{action('TaskController@editDone', ['id' => 'task_id'])}}')"
                   onchange="taskDoneChange(event)"/>
         </div>
         <!-- /.form-group -->
         <div class="col-sm-<?= $colSmTask; ?> todolist-task-task">
            <a href="{{action('TaskController@show', ['id' => 'task_id'])}}"></a>
         </div>
         <!-- /.form-group -->
         <div class="col-sm-<?= $colSmDeadline; ?> todolist-task-deadline">
         </div>
         <!-- /.form-group -->
         <div class="col-sm-<?= $colSmComments; ?>">
            0
         </div>
         <!-- /.form-group -->
         <div class="col-sm-<?= $colSmRemove; ?>">
            <span class="glyphicon glyphicon-minus"
                  onclick="removeTask(event, '{{action('TaskController@remove', ['id' => 'task_id'])}}')"></span>
            <!-- /.glyphicon glyphicon-minus -->
         </div>
         <!-- /.col-sm- -->
      </div>
      <!-- /.row -->
   </article>
</section>
<hr/>