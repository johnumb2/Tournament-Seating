
<div class="container-fluid">
    
    <form method="post">
        <input type="hidden" name="login" value="test">
        <div class="row">
            <div class="form-group-lg col-sm-pull-4 col-sm-push-4 col-sm-4">
                <h2>Login</h2>
                <div class="text-danger text-center bg-info ui-corner-all text-uppercase"><?php echo $error;?></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group-lg col-sm-pull-4 col-sm-push-4 col-sm-4">
                <label class="label label-primary">Email</label>
                <input type="text" class="form-control focus" name="email" value="<?php echo $email ?>" placeholder="Email Address">
            </div>
        </div>
        <div class="row">
            <div class="form-group-lg col-sm-pull-4 col-sm-push-4 col-sm-4">
                <label class="label label-primary">Password</label>
                <input type="password" class="form-control" name="password" value="">
            </div>
        </div>
        <div class="row">
            <div class="form-group-lg col-sm-pull-4 col-sm-push-4 col-sm-4">
                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
            </div>
        </div>
    </form>
</div>