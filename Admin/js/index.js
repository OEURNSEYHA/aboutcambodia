
$(document).ready(function() {
    let btnlogin = $('.btn-login');
    let email = $('#email');
    let pass = $('#password');
  
    btnlogin.click(function() {
     
        $.ajax({
            url:"Login/Login.php",
            type:"POST",
            data: {
                useremail: email.val(),
                userpass: pass.val(),
            },
            caches: false,
            dataType: "json",
            beforsend:function(){

            },
            success: function(data){
                alert("hdhdh")
                if (data.checkemail == false) {
                    alert("Please check your email again ⚡!");
                    email.focus();
                    return;
                } else {
               
                    if (data.checkpass == false) {
                        alert("Please check your PassWord again ⚡💀!");
                        pass.focus();
                        return;

                    } else {
                        window.location.href = ("Admin.php");
                        email.val("");
                        pass.val("");
                    }
                }
            }

            
        })
    })
})