<?php

/* frontpage.twig */
class __TwigTemplate_140c9b1cdabde70e9baa16fc0a547b38681f0d5e465752b3666570c3dc0543f1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'javascript' => array($this, 'block_javascript'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- Frontpage Template file -->
<!DOCTYPE html>
<html>
    <head>
        <title>Restful Taskmanager App</title>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"Manage tasks web application\">
        <meta name=\"author\" content=\"Peter Petropoulos\">
\t\t<link rel=\"icon\" href=\"images/favicon.png\" type=\"image/png\" sizes=\"16x16\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css\">
        <link href=\"//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css\" rel=\"stylesheet\"/>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\" />
        ";
        // line 15
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 16
        echo "    </head>
    <body>
        <div class=\"container\">
            <nav class=\"navbar navbar-default\">
                <div class=\"container-fluid\">
                    <div class=\"navbar-header\">
                        <button class=\"navbar-toggle\" aria-controls=\"navbar\" aria-expanded=\"false\" data-target=\"#navbar\" data-toggle=\"collapse\" type=\"button\">
                            <span class=\"sr-only\">Toggle navigation</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\".\">Task App</a>
                    </div>
                    <div id=\"navbar\" class=\"navbar-collapse collapse\">
                        <ul class=\"nav navbar-nav\">
                            <li>
                                <a href=\"tasks\" class=\"btn ";
        // line 33
        echo twig_escape_filter($this->env, (isset($context["memberClass"]) ? $context["memberClass"] : null), "html", null, true);
        echo "\"><span class=\"glyphicon glyphicon-calendar\"></span> Tasks</a>
                            </li>
                            <li>
                                <a href=\"users\" class=\"btn ";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["adminClass"]) ? $context["adminClass"] : null), "html", null, true);
        echo "\"><span class=\"glyphicon glyphicon-th-list\"></span> Users</a>
                            </li>
                        </ul>
                        <ul class=\"nav navbar-nav navbar-right\">
                            ";
        // line 40
        if ((isset($context["hasIdentity"]) ? $context["hasIdentity"] : null)) {
            // line 41
            echo "                                <li class=\"identity\"><span class=\"glyphicon glyphicon-user\"></span> ";
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $this->getAttribute((isset($context["identity"]) ? $context["identity"] : null), "username", array(), "array")), "html", null, true);
            echo "</li>
                                <li><a href=\"logout\" class=\"btn\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>
                            ";
        } else {
            // line 44
            echo "                                <li><a href=\"login\" class=\"btn\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>
                            ";
        }
        // line 46
        echo "                        </ul>
                    </div>
                </div>
            </nav>
            ";
        // line 50
        echo (isset($context["intro"]) ? $context["intro"] : null);
        echo "
            ";
        // line 51
        $this->displayBlock('content', $context, $blocks);
        // line 52
        echo "            <div>
            <hr>
                <footer>
                    <div class=\"row\">
                        <div class=\"col-lg-12\">
                            <p>Taskmanager App &copy; <script>document.write(new Date().getFullYear())</script></p>
                            <p>
                                Featured snippets are 
                                <a target=\"_blank\" href=\"http://getbootstrap.com/\"><img src=\"http://getbootstrap.com/favicon.ico\" width=\"15px\"> Bootstrap</a>
                                |
                                <a target=\"_blank\" href=\"https://jquery.com/\"><img src=\"https://jquery.com/favicon.ico\" width=\"15px\"> Jquery</a>
                                |
                                <a target=\"_blank\" href=\"http://www.slimframework.com/\"><img src=\"http://www.slimframework.com/assets/images/favicon.png\" width=\"15px\"> Slim Framework</a>
                                |
                                <a target=\"_blank\" href=\"http://fullcalendar.io/\">FullCalendar</a>
                                |
                                <a target=\"_blank\" href=\"https://vitalets.github.io/x-editable/\">X-editable</a>
                                |
                                <a target=\"_blank\" href=\"http://twig.sensiolabs.org/\"><img src=\"http://twig.sensiolabs.org//favicon.ico\" width=\"15px\"> Twig</a>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!--Application scripts-->
        <script src=\"//code.jquery.com/jquery-2.1.4.min.js\"></script>
        <script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>
        <script src=\"//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js\"></script>
        <script type=\"text/javascript\" src=\"js/scripts.js\"></script>
        ";
        // line 82
        $this->displayBlock('javascript', $context, $blocks);
        // line 83
        echo "    </body>
</html>";
    }

    // line 15
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 51
    public function block_content($context, array $blocks = array())
    {
        echo " ";
    }

    // line 82
    public function block_javascript($context, array $blocks = array())
    {
        echo " ";
    }

    public function getTemplateName()
    {
        return "frontpage.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 82,  141 => 51,  136 => 15,  131 => 83,  129 => 82,  97 => 52,  95 => 51,  91 => 50,  85 => 46,  81 => 44,  74 => 41,  72 => 40,  65 => 36,  59 => 33,  40 => 16,  38 => 15,  22 => 1,);
    }
}
/* <!-- Frontpage Template file -->*/
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <title>Restful Taskmanager App</title>*/
/*         <meta charset="utf-8">*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*         <meta name="description" content="Manage tasks web application">*/
/*         <meta name="author" content="Peter Petropoulos">*/
/* 		<link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16">*/
/*         <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">*/
/*         <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">*/
/*         <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>*/
/*         <link rel="stylesheet" type="text/css" href="css/style.css" />*/
/*         {% block stylesheets %}{% endblock %}*/
/*     </head>*/
/*     <body>*/
/*         <div class="container">*/
/*             <nav class="navbar navbar-default">*/
/*                 <div class="container-fluid">*/
/*                     <div class="navbar-header">*/
/*                         <button class="navbar-toggle" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" type="button">*/
/*                             <span class="sr-only">Toggle navigation</span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                         </button>*/
/*                         <a class="navbar-brand" href=".">Task App</a>*/
/*                     </div>*/
/*                     <div id="navbar" class="navbar-collapse collapse">*/
/*                         <ul class="nav navbar-nav">*/
/*                             <li>*/
/*                                 <a href="tasks" class="btn {{ memberClass }}"><span class="glyphicon glyphicon-calendar"></span> Tasks</a>*/
/*                             </li>*/
/*                             <li>*/
/*                                 <a href="users" class="btn {{ adminClass }}"><span class="glyphicon glyphicon-th-list"></span> Users</a>*/
/*                             </li>*/
/*                         </ul>*/
/*                         <ul class="nav navbar-nav navbar-right">*/
/*                             {% if hasIdentity %}*/
/*                                 <li class="identity"><span class="glyphicon glyphicon-user"></span> {{ identity['username']|capitalize }}</li>*/
/*                                 <li><a href="logout" class="btn"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>*/
/*                             {% else %}*/
/*                                 <li><a href="login" class="btn"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>*/
/*                             {% endif %}*/
/*                         </ul>*/
/*                     </div>*/
/*                 </div>*/
/*             </nav>*/
/*             {{ intro|raw }}*/
/*             {% block content %} {% endblock %}*/
/*             <div>*/
/*             <hr>*/
/*                 <footer>*/
/*                     <div class="row">*/
/*                         <div class="col-lg-12">*/
/*                             <p>Taskmanager App &copy; <script>document.write(new Date().getFullYear())</script></p>*/
/*                             <p>*/
/*                                 Featured snippets are */
/*                                 <a target="_blank" href="http://getbootstrap.com/"><img src="http://getbootstrap.com/favicon.ico" width="15px"> Bootstrap</a>*/
/*                                 |*/
/*                                 <a target="_blank" href="https://jquery.com/"><img src="https://jquery.com/favicon.ico" width="15px"> Jquery</a>*/
/*                                 |*/
/*                                 <a target="_blank" href="http://www.slimframework.com/"><img src="http://www.slimframework.com/assets/images/favicon.png" width="15px"> Slim Framework</a>*/
/*                                 |*/
/*                                 <a target="_blank" href="http://fullcalendar.io/">FullCalendar</a>*/
/*                                 |*/
/*                                 <a target="_blank" href="https://vitalets.github.io/x-editable/">X-editable</a>*/
/*                                 |*/
/*                                 <a target="_blank" href="http://twig.sensiolabs.org/"><img src="http://twig.sensiolabs.org//favicon.ico" width="15px"> Twig</a>*/
/*                             </p>*/
/*                         </div>*/
/*                     </div>*/
/*                 </footer>*/
/*             </div>*/
/*         </div>*/
/*         <!--Application scripts-->*/
/*         <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>*/
/*         <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>*/
/*         <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>*/
/*         <script type="text/javascript" src="js/scripts.js"></script>*/
/*         {% block javascript %} {% endblock %}*/
/*     </body>*/
/* </html>*/
