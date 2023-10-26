
$(document).ready(function (){
    $('#registrationForm').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"../serverActions/registrationActions.php",
            data: $(this).serialize(),
            success:function (){
            },
            error:function (){

            }
        })
    })
})