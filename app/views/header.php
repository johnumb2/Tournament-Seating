<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="/css/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="/css/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,dt-1.10.9/datatables.min.css"/>
 
        <link href="/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="/js/jquery-2.1.4.min.js" type="text/javascript"></script>
        
        <script src="/js/jquery-ui.js" type="text/javascript"></script>
        
        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,dt-1.10.9/datatables.min.js"></script>
    </head>
    <body>
        <div class="container-fluid nopadding">
            <div>
            <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Tournament Seating</a>
                    </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div>
                      
                    <ul class="nav navbar-nav navbar-right">
                        <li class="admin">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/users/view"><i class="fa fa-file text-danger"></i>&nbsp;&nbsp;Users</a></li>
                                <li><a href="/users/details/0/Add New"><i class="fa fa-plus text-danger"></i>&nbsp;&nbsp;Add User</a></li>
                                <li role="separator" class="divider"></li>
                            </ul>
                        </li>
                        <li><a class="navbar nav" href="/security/logout">Logout</a></li>
                    </ul>
                    
                  </div><!-- /.navbar-collapse -->
              </nav>
            </div>
            <div class="col-sm-12 content">