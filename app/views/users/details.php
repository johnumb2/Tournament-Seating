<form method="post" action="/users/put">
    <input type="hidden" name="users[id]" value="<?php echo $data[0]['id'];?>">
    <input type="hidden" name="accounts[id]" value="<?php echo $data[0]['accountId'];?>">
    
    <div class="col-sm-push-3 col-sm-pull-3 col-sm-6">
        <h2>User <small>(<?php echo $name;?>)</small></h2>
        <div class="col-sm-12">
            <label class="control-label col-sm-4" for="firstName">First Name:</label>
            <div class="col-sm-8 form-group-sm">
                <input type="text" name="users[firstName]" value="<?php echo $data[0]['firstName'];?>" placeholder="First Name" class="form-control">
            </div>
        </div>
        <div class="col-sm-12">
            <label class="control-label col-sm-4" for="lastName">Last Name:</label>
            <div class="col-sm-8 form-group-sm">
                <input type="text" name="users[lastName]" value="<?php echo $data[0]['lastName'];?>" placeholder="Last Name" class="form-control">
            </div>
        </div>
        <div class="col-sm-12">
            <label class="control-label col-sm-4" for="email">Email:</label>
            <div class="col-sm-8 form-group-sm">
                <input type="text" name="users[email]" value="<?php echo $data[0]['email'];?>" placeholder="Email" class="form-control">
            </div>
        </div>
        <div class="col-sm-12">
            <label class="control-label col-sm-4" for="password">Password:</label>
            <div class="col-sm-8 form-group-sm">
                <input type="password" name="users[password]" placeholder="Password" class="form-control">
            </div>
        </div>
        <div class="col-sm-12">
            <label class="control-label col-sm-4"></label>
            <div class="col-sm-8 form-group-sm">
                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('.edit').click(function(){
            var data = $(this).parent().data();
            window.location.href = '/bills/view/'+data.id+'/'+data.name;
        });
    });
</script>