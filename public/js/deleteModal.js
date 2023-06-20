document.addEventListener("DOMContentLoaded", function() {
    var elementsDelete= document.getElementsByClassName("deleteQuestion");
    console.log(elementsDelete);
    var modal = new bootstrap.Modal(document.getElementById("deleteModal"));
    for (var i=0; i<elementsDelete.length; i++ ){
        elementsDelete[i].addEventListener("click",function (){
            modal.show();
        })
    }
});

