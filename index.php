<?php 
    include('middleware/if_authenticated.php');
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mdb.min.css">
    <title>Election</title>
</head>

<body>
    <div class="row mt-5">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="text-center">
                <img src="img/ndc.png" width="120" height="120" alt="">
                <!-- <h4 class="font-weight-bold text-success">National Democratic Congress</h4> -->
                <h5 class="font-weight-bold text-danger mt-3">Election Results Collation System</h5>
                <h5 class="font-weight-bold mt-3">SYSTEM LOGIN</h5>
            </div>
            <div class="card card-body mt-3">
                <div id="myErrorMessage"></div>  
                <form id="formSignIn" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>" readonly>
                    <div class="validate mb-3">
                        <div class="form-outline">
                            <input type="text" id="username" name="username" class="form-control" />
                            <label class="form-label">Username</label>
                        </div>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="validate">
                        <div class="form-outline">
                            <input type="password" id="password" name="password" class="form-control" />
                            <label class="form-label">Password</label>
                        </div>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-md btn-primary btn_login">Log In</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/mdb.min.js"></script>

<script>
    $("#formSignIn").on("submit", function(e){
        e.stopPropagation();
        var valid = true;
        $('#formSignIn input').each(function() {
            var $this = $(this);
            
            if(!$this.val()) {
                valid = false;
                $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
            }
        });
        if(valid) {
            $('.btn_login').html('<i class="fa fa-spinner fa-spin"></i> Loging In...').attr('disabled', true);
            var data = $("#formSignIn").serialize();
            $.ajax({
                url: 'script/login.php',
                type: 'POST',
                data: data,
                success: function(resp){
                    if(resp=='success'){
                        window.location= "dashboard.php";
                    }
                    else{
                        $("#myErrorMessage").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<div class="alert-icon contrast-alert"><i class="fa fa-times"></i></div><div class="alert-message"><span><strong>Opps:</strong>'+resp+'</span></div></div>')
                        $("#formSignIn")[0].reset();
                        $('.btn_login').html('Log In').attr('disabled', false);
                    }
                },
                error: function(resp){
                    alert('Something went wrong');
                    $('.btn_login').html('Log In').attr('disabled', false);
                }
            });
        }
        return false;
    });

    $("#formSignIn input").on('input', function(){
        if($(this).val()!=''){
            $(this).parents('.validate').find('span').text('');
        }else{ $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required'); }
    });
</script>

</html>