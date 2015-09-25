<h2>*ADMIN ONLY* Users</h2>
<table class="table table-striped table-hover">
    <thead>
        <th>Name</th>
        <th>Account</th>
        <th>Type</th>
        <th>Email</th>
    </thead>
    <tbody>
        <?php
        foreach($data AS $dataItem){
            echo "
                <tr data-id=\"".$dataItem['id']."\" data-name=\"".$dataItem['firstName']." ".$dataItem['lastName']."\">
                    <td class=\"edit\">".$dataItem['firstName']." ".$dataItem['lastName']."</td>
                    <td class=\"edit\">".$dataItem['userType']."</td>
                    <td class=\"edit\">".$dataItem['email']."</td>
                </tr>
            ";
        }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $('.edit').click(function(){
            var data = $(this).parent().data();
            window.location.href = '/users/details/'+data.id+'/'+data.name;
        });
    });
</script>