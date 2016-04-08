function getToken(element) {
    return element.find('input[name="_token"]').val();
}

// button response for ajax status
function ButtonResponse(button) {
    this.success = function () {
        button.removeClass('btn-info');
        button.addClass('btn-success');
    };
    this.beforeSend = function () {
        button.addClass('btn-info');
    };
    this.complete = function () {
        setTimeout(function () {
            button.removeClass('btn-success');
        }, 1000);
    };
}

// task create form functions
var taskCreateForm = {
    'init': function (form) {
        this.form = form;
        var that = this;

        // listen task input
        this.task = form.find('textarea[name="task"]');
        this.task.on('change', this.taskChange);

        // listen deadline input
        this.deadline = form.find('input[name="deadline"]');
        this.deadline.on('change', this.deadlineChange);

        // listen button click
        this.button = form.find('input.btn');
        this.button.on('click', function () {
            if (that.form.find('.has-success').length == (that.form.get(0).elements.length - 2)) {
                that.form.submit();
            }
        });

        // listen form submit
        this.form.on('submit', function (event) {
            event.preventDefault();
            var btnResp = new ButtonResponse(that.button);
            $.ajax(that.form.attr('action'), {
                success: function (response) {
                    that.taskId = response;
                    btnResp.success();
                    that.insertNew();
                    that.form.get(0).reset();
                    that.form.find('.has-success').removeClass('has-success');
                },
                beforeSend: function () {
                    btnResp.beforeSend();
                },
                complete: function () {
                    btnResp.complete();
                },
                data: that.form.serialize(),
                type: that.form.attr('method')
            });
        });
    },
    'taskChange': function () {
        var task = $(this);
        var div = task.parent('div.form-group');
        if (task.val().length == 0 || task.val().length > 255) {
            div.removeClass('has-success');
            div.addClass('has-error');
        } else {
            div.removeClass('has-error');
            div.addClass('has-success');
        }
    },
    'deadlineChange': function () {
        this.hasError = function (div) {
            div.removeClass('has-success');
            div.addClass('has-error');
        };
        this.hasSuccess = function (div) {
            div.removeClass('has-error');
            div.addClass('has-success');
        };
        var deadline = $(this);
        var div = deadline.parent('div.form-group');
        var flag = /^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/.test(deadline.val());
        if (flag) {
            var date = new Date(deadline.val());
            if (!isNaN(date.getTime()) && date.getTime() >= Date.now()) {
                this.hasSuccess(div);
            } else {
                this.hasError(div);
            }
        } else {
            this.hasError(div);
        }
    },
    'insertNew': function () {
        var sectionTasks = this.form.closest('section').siblings('section.todolist-tasks');

        // clone and fill
        var emptyTask = this.fillTaskHidden(sectionTasks.find('article.todolist-task-hidden').clone());

        // find where insert
        this.whereInsert(sectionTasks, emptyTask);
    },
    'fillTaskHidden': function (emptyTask) {
        emptyTask.html(emptyTask.html().replace(new RegExp('task_id', 'g'), this.taskId));
        emptyTask.find('.todolist-task-task a').text(this.task.val());
        emptyTask.find('.todolist-task-deadline').text($.datepicker.formatDate('M d yy', new Date(this.deadline.val())));
        return emptyTask;
    },
    'whereInsert': function (sectionTasks, emptyTask) {
        var that = this;
        var tasksFirst = sectionTasks.find('article.todolist-task').not('.todolist-task-done');
        if (tasksFirst.length > 0) {
            insertByComparingDates(tasksFirst, emptyTask);
            //tasksFirst.each(function (index, element) {
            //    var $element = $(element);
            //    var deadline = new Date($element.find('.todolist-task-deadline').text());
            //    var deadlineNew = new Date(that.deadline.val());
            //    if (deadlineNew < deadline) {
            //        $element.before(emptyTask);
            //        return false;
            //    }
            //    if(index == tasksFirst.length - 1){
            //        $element.after(emptyTask);
            //    }
            //});
        } else if (sectionTasks.find('article.todolist-task-done').length > 0) {
            sectionTasks.find('article.todolist-task-done').first().before(emptyTask);
        } else {
            sectionTasks.find('article.todolist-task-hidden').first().before(emptyTask);
        }
        emptyTask.removeClass('todolist-task-hidden').addClass('todolist-task').slideDown('slow');
    }
};

// compare date in tasks list and insert
function insertByComparingDates(where, what) {
    where.each(function (index, element) {
        var $element = $(element);
        var deadline = new Date($element.find('.todolist-task-deadline').text());
        var deadlineNew = new Date(what.find('.todolist-task-deadline').text());
        if (deadlineNew < deadline) {
            $element.before(what);
            return false;
        }
        if (index == where.length - 1) {
            $element.after(what);
        }
    });
}

// task's done state change
function taskDoneClick(event, url) {
    var checkbox = $(event.target);
    $.post(url, {
        '_token': getToken(checkbox.parent()),
        'done': checkbox.prop('checked') ? 'true' : 'false'
    }, function (response) {

    });
}
// task's done state change
function taskDoneChange(event) {
    this.taskChecked = function () {
        var sectionDone = sectionTasks.find('.todolist-task-done');
        article.slideUp('slow', function () {
            article.addClass('todolist-task-done').detach();
            if (sectionDone.length > 0) {
                insertByComparingDates(sectionDone, article);
            } else {
                var sectionUndone = sectionTasks.find('.todolist-task').not('.todolist-task-done');
                if (sectionUndone.length > 0) {
                    sectionUndone.last().after(article);
                } else {
                    sectionTasks.find('.todolist-task-hidden').before(article);
                }
            }
            article.slideDown('slow');
        });
    };
    this.taskUnchecked = function () {
        var sectionUndone = sectionTasks.find('.todolist-task').not('.todolist-task-done');
        article.slideUp('slow', function () {
            article.removeClass('todolist-task-done').detach();
            if (sectionUndone.length > 0) {
                insertByComparingDates(sectionUndone, article);
            } else {
                var sectionDone = sectionTasks.find('.todolist-task-done');
                if (sectionDone.length > 0) {
                    sectionDone.first().before(article);
                } else {
                    sectionTasks.find('.todolist-task-hidden').before(article);
                }
            }
            article.slideDown('slow');
        });
    };

    var checkbox = $(event.target);
    var article = checkbox.closest('.todolist-task');
    var sectionTasks = article.parent('.todolist-tasks');
    if (checkbox.prop('checked')) {
        this.taskChecked();
    } else {
        this.taskUnchecked();
    }
}

// comment form create new comment
var commentForm = {
    'init': function (form) {
        this.form = form;
        var that = this;
        var btnResp = new ButtonResponse(this.form.find('input.btn'));
        this.form.on('submit', function (event) {
            event.preventDefault();
            $.ajax(that.form.attr('action'), {
                success: function (response) {
                    btnResp.success();
                    that.insertComment(response);
                    that.resetForm();
                },
                beforeSend: function () {
                    btnResp.beforeSend();
                },
                complete: function () {
                    btnResp.complete();
                },
                data: that.form.serialize(),
                type: that.form.attr('method')
            });
        });
    },
    'insertComment': function (response) {
        var section = this.form.closest('section').siblings('section.todolist-comments');
        var emptyComment = section.find('article.todolist-comment-hidden').clone();
        emptyComment.find('.todolist-comment-name').text(this.form.find('input[name="name"]').val());
        emptyComment.find('.todolist-comment-comment').text(this.form.find('textarea[name="comment"]').val());
        emptyComment.find('.todolist-comment-date').text(response);
        section.find('article.todolist-comment-hidden').before(emptyComment);
        emptyComment.slideDown('slow');
    },
    'resetForm': function () {
        this.form.get(0).reset();
    }
};
