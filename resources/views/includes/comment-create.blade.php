<section class="todolist-comment-create">
   <div class="row">
      <form action="{{action('CommentController@create', ['task_id' => $task['id']])}}" method="POST"
            name="commentCreateForm" id="commentCreateForm">
         <div class="form-group col-sm-4">
            <label class="control-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Name" required>
         </div>
         <!-- /.form-group col-sm-4 -->
         <div class="form-group col-sm-8">
            <label class="control-label" for="comment">Comment</label>
            <textarea class="form-control" name="comment" form="commentCreateForm" placeholder="Comments"
                      required></textarea>
         </div>
         <!-- /.form-group col-sm-8 -->
         <div class="form-group col-sm-3">
            {{csrf_field()}}
            <input type="submit" class="btn btn-default" value="Add comment">
         </div>
         <!-- /.form-group -->
      </form>
   </div>
   <!-- /.row -->
</section>