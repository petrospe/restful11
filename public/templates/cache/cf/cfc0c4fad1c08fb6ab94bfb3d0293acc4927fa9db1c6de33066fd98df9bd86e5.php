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
        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css\">
        <link href=\"//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css\" rel=\"stylesheet\"/>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\" />
        ";
        // line 14
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 15
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
        // line 32
        echo twig_escape_filter($this->env, (isset($context["memberClass"]) ? $context["memberClass"] : null), "html", null, true);
        echo "\"><span class=\"glyphicon glyphicon-calendar\"></span> Tasks</a>
                            </li>
                            <li>
                                <a href=\"users\" class=\"btn ";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["adminClass"]) ? $context["adminClass"] : null), "html", null, true);
        echo "\"><span class=\"glyphicon glyphicon-th-list\"></span> Users</a>
                            </li>
                        </ul>
                        <ul class=\"nav navbar-nav navbar-right\">
                            ";
        // line 39
        if ((isset($context["hasIdentity"]) ? $context["hasIdentity"] : null)) {
            // line 40
            echo "                                <li class=\"identity\"><span class=\"glyphicon glyphicon-user\"></span> ";
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $this->getAttribute((isset($context["identity"]) ? $context["identity"] : null), "username", array(), "array")), "html", null, true);
            echo "</li>
                                <li><a href=\"logout\" class=\"btn\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>
                            ";
        } else {
            // line 43
            echo "                                <li><a href=\"login\" class=\"btn\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>
                            ";
        }
        // line 45
        echo "                        </ul>
                    </div>
                </div>
            </nav>
            ";
        // line 49
        echo (isset($context["intro"]) ? $context["intro"] : null);
        echo "
            ";
        // line 50
        $this->displayBlock('content', $context, $blocks);
        // line 51
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
                                <a target=\"_blank\" href=\"http://www.slimframework.com/\">Slim Framework</a>
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
        // line 81
        $this->displayBlock('javascript', $context, $blocks);
        // line 82
        echo "    </body>
</html>";
    }

    // line 14
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 50
    public function block_content($context, array $blocks = array())
    {
        echo " ";
    }

    // line 81
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
        return array (  146 => 81,  140 => 50,  135 => 14,  130 => 82,  128 => 81,  96 => 51,  94 => 50,  90 => 49,  84 => 45,  80 => 43,  73 => 40,  71 => 39,  64 => 35,  58 => 32,  39 => 15,  37 => 14,  22 => 1,);
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
/*                                 <a target="_blank" href="http://www.slimframework.com/">Slim Framework</a>*/
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
