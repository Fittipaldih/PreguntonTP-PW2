document.addEventListener("DOMContentLoaded", function() {
    var elementsDelete= document.getElementsByClassName("deleteQuestion");
    var modal = new bootstrap.Modal(document.getElementById("deleteModal"));
    for (var i=0; i<elementsDelete.length; i++ ){
        elementsDelete[i].addEventListener("click",function (){
            var questionId = this.getAttribute("id");
            var deleteForm = document.getElementById("deleteForm");
            deleteForm.setAttribute("action", "/question/delete&id="+questionId);
            modal.show();
        })
    }
});

