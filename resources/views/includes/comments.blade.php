<section class="todolist-comments">
   @foreach($comments as $comment)
   <article class="todolist-comment">
      <div class="row">
         <div class="col-sm-12 todolist-comment-name">
            {{$comment['name']}}
         </div>
         <!-- /.col-sm-12 -->
         <div class="col-sm-12 todolist-comment-date">
            {{Date('M j Y', strtotime($comment['created_at']))}}
         </div>
         <!-- /.col-sm-12 -->
         <div class="col-sm-12 todolist-comment-comment">
            {{$comment['comment']}}
         </div>
         <!-- /.col-sm-12 -->
      </div>
      <!-- /.row -->
   </article>
   @endforeach

   <article class="todolist-comment-hidden" style="display: none">
      <div class="row">
         <div class="col-sm-12 todolist-comment-name">
         </div>
         <!-- /.col-sm-12 -->
         <div class="col-sm-12 todolist-comment-date">
         </div>
         <!-- /.col-sm-12 -->
         <div class="col-sm-12 todolist-comment-comment">
         </div>
         <!-- /.col-sm-12 -->
      </div>
      <!-- /.row -->
   </article>
</section>
<hr/>