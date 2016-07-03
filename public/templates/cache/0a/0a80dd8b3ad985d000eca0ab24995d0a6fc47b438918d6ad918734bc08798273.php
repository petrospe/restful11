<?php

/* users.twig */
class __TwigTemplate_06776d7f8af42b400a706221562b660ab60a718b82c84840c929320c169d44db extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("frontpage.twig", "users.twig", 1);
        $this->blocks = array(
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
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "<div id=\"users\">
    <div class=\"page-header\">
        <h1>Grid <small>System users</small></h1>
    </div>
    <div class=\"row\">
        <div class=\"col-md-12\">
           <div class=\"table-responsive\">
                <table class=\"table table-bordered table-striped\">
                    <thead id=\"userstablethead\"></thead>
                    <tbody id=\"userstable\"></tbody>
                </table>
            </div>
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
        echo "<script type='text/javascript' src='js/userController.js'></script>
";
    }

    public function getTemplateName()
    {
        return "users.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 27,  58 => 26,  32 => 3,  29 => 2,  11 => 1,);
    }
}
/* {% extends 'frontpage.twig' %}*/
/* {% block content %}*/
/* <div id="users">*/
/*     <div class="page-header">*/
/*         <h1>Grid <small>System users</small></h1>*/
/*     </div>*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*            <div class="table-responsive">*/
/*                 <table class="table table-bordered table-striped">*/
/*                     <thead id="userstablethead"></thead>*/
/*                     <tbody id="userstable"></tbody>*/
/*                 </table>*/
/*             </div>*/
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
/* <script type='text/javascript' src='js/userController.js'></script>*/
/* {% endblock %}*/
