$(function(){

    // datapicker
    $('.todolist-datepicker').datepicker({
        "dateFormat": "yy-mm-dd",
        minDate: 0
    });

    // validation for a task form
    taskCreateForm.init($('#taskCreateForm'));
});