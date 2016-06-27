<!-- Frontpage Template file -->
<!DOCTYPE html>
<html>
    <head>
        <title>Restful Taskmanager App</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Manage tasks web application">
        <meta name="author" content="Peter Petropoulos">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!--FullCalendar Dependencies-->
        <?php if(!empty($tasks)){
            echo "<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css'>\n";
            echo "<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css' media='print'>\n";
        }
        ?>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button class="navbar-toggle" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href=".">Task App</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="tasks"><span class="glyphicon glyphicon-calendar"></span> Tasks</a>
                            </li>
                            <li>
                                <a href="users"><span class="glyphicon glyphicon-user"></span> Users</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                              <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php
            /* Render dynamic data */
            if(!empty($intro)){
                echo $intro;
            }
            if(!empty($tasks)){
                echo $tasks;
            }
            if(!empty($users)){
                echo $users;
            }
            ?>
            <ul class="nav pull-right scroll-top">
                <li>
                    <a title="Scroll to top" onclick=" window.scrollTo(0,0)">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </a>
                </li>
            </ul>
            <div>
            <hr>
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Taskmanager App &copy; <script>document.write(new Date().getFullYear())</script></p>
                            <p>
                                Featured snippets are 
                                <a target="_blank" href="http://getbootstrap.com/"><img src="http://getbootstrap.com/favicon.ico" width="15px"> Bootstrap</a>
                                |
                                <a target="_blank" href="https://jquery.com/"><img src="https://jquery.com/favicon.ico" width="15px"> Jquery</a>
                                |
                                <a target="_blank" href="http://www.slimframework.com/">Slim Framework</a>
                                |
                                <a target="_blank" href="http://fullcalendar.io/">FullCalendar</a>
                                |
                                <a target="_blank" href="https://vitalets.github.io/x-editable/">X-editable</a>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!--Application scripts-->
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <!--User controller-->
        <?php if(!empty($users)){
            echo "<script type='text/javascript' src='js/userController.js'></script>";
        }
        ?>
        <!--Calendar script-->
        <?php if(!empty($tasks)){
            echo "<script type='text/javascript' src='js/moment.min.js'></script>\n";
            echo "<script type='text/javascript' src='js/moment-duration-format.js'></script>\n";
            echo "<script type='text/javascript' src='js/jquery-ui.custom.min.js'></script>\n";
            echo "<script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js'></script>\n";
            echo "<script type='text/javascript' src='js/calendarController.js'></script>";
        }
        ?>
    </body>
</html>