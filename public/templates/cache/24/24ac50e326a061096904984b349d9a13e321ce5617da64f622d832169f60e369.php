<?php

/* tasks.twig */
class __TwigTemplate_92a28e4af277b49d5e2bdd5685b8ee590d48a9fd734f104134a33140a1707cf0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("frontpage.twig", "tasks.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'javascript' => array($this, 'block_javascript'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "frontpage.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css'>
<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css' media='print'>
";
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "<div id=\"tasks\">
    <div class=\"page-header\">
        <h1>Tasks <small>System task</small></h1>
    </div>
    <div class=\"row\">
        <div class=\"col-md-12\">
           <div id=\"calendar\"></div> 
           <div id=\"taskdialog\" title=\"Task\" style=\"display:none\"></div>
        </div>
    </div>
</div>
<ul class=\"nav pull-right scroll-top\">
    <li>
        <a title=\"Scroll to top\" onclick=\" window.scrollTo(0,0)\">
            <i class=\"glyphicon glyphicon-chevron-up\"></i>
        </a>
    </li>
</ul>
";
    }

    // line 26
    public function block_javascript($context, array $blocks = array())
    {
        // line 27
        echo "<script type='text/javascript' src='js/moment.min.js'></script>
<script type='text/javascript' src='js/moment-duration-format.js'></script>
<script type='text/javascript' src='js/jquery-ui.custom.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js'></script>
<script type='text/javascript' src='js/calendarController.js'></script>
";
    }

    public function getTemplateName()
    {
        return "tasks.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 27,  64 => 26,  42 => 7,  39 => 6,  33 => 3,  30 => 2,  11 => 1,);
    }
}
/* {% extends 'frontpage.twig' %}*/
/* {% block stylesheets %}*/
/* <link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css'>*/
/* <link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css' media='print'>*/
/* {% endblock %}*/
/* {% block content %}*/
/* <div id="tasks">*/
/*     <div class="page-header">*/
/*         <h1>Tasks <small>System task</small></h1>*/
/*     </div>*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*            <div id="calendar"></div> */
/*            <div id="taskdialog" title="Task" style="display:none"></div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <ul class="nav pull-right scroll-top">*/
/*     <li>*/
/*         <a title="Scroll to top" onclick=" window.scrollTo(0,0)">*/
/*             <i class="glyphicon glyphicon-chevron-up"></i>*/
/*         </a>*/
/*     </li>*/
/* </ul>*/
/* {% endblock %}*/
/* {% block javascript %}*/
/* <script type='text/javascript' src='js/moment.min.js'></script>*/
/* <script type='text/javascript' src='js/moment-duration-format.js'></script>*/
/* <script type='text/javascript' src='js/jquery-ui.custom.min.js'></script>*/
/* <script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js'></script>*/
/* <script type='text/javascript' src='js/calendarController.js'></script>*/
/* {% endblock %}*/
