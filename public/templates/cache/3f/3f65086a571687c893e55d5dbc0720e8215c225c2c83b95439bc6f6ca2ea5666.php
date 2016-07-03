<?php

/* login.twig */
class __TwigTemplate_2995b766fb2965ac69c40b1ef42cdeeaf52546cbaa42527546246963302e6c0f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("frontpage.twig", "login.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
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
        echo "<div class=\"jumbotron\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-4\">
            <form class=\"form-horizontal\" name=\"login\" id=\"login\" method=\"post\">
                <div class=\"form-group\">
                    <h2>Please sign in</h2>
                </div>
                ";
        // line 10
        if ($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "error", array(), "array", true, true)) {
            // line 11
            echo "                <div class=\"form-group\">
                    <div class=\"alert alert-danger\">
                        ";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "error", array()), "html", null, true);
            echo "
                    </div>
                </div>
                ";
        }
        // line 17
        echo "                <div class=\"form-group\">
                    <label for=\"inputUsername\" class=\"sr-only\">Username</label>
                    <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"Username\" required autofocus>
                </div>
                <div class=\"form-group\">
                    <label for=\"inputPassword\" class=\"sr-only\">Password</label>
                    <input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"Password\" required>
                    <div class=\"checkbox\">
                        <label>
                            <input type=\"checkbox\" value=\"remember-me\"> Remember me
                        </label>
                    </div>
                </div>
                <div class=\"form-group\">
                    <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 17,  46 => 13,  42 => 11,  40 => 10,  31 => 3,  28 => 2,  11 => 1,);
    }
}
/* {% extends 'frontpage.twig' %}*/
/* {% block content %}*/
/* <div class="jumbotron">*/
/*     <div class="row">*/
/*         <div class="col-md-4 col-md-offset-4">*/
/*             <form class="form-horizontal" name="login" id="login" method="post">*/
/*                 <div class="form-group">*/
/*                     <h2>Please sign in</h2>*/
/*                 </div>*/
/*                 {% if flash['error'] is defined %}*/
/*                 <div class="form-group">*/
/*                     <div class="alert alert-danger">*/
/*                         {{ flash.error }}*/
/*                     </div>*/
/*                 </div>*/
/*                 {% endif %}*/
/*                 <div class="form-group">*/
/*                     <label for="inputUsername" class="sr-only">Username</label>*/
/*                     <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <label for="inputPassword" class="sr-only">Password</label>*/
/*                     <input type="password" class="form-control" name="password" placeholder="Password" required>*/
/*                     <div class="checkbox">*/
/*                         <label>*/
/*                             <input type="checkbox" value="remember-me"> Remember me*/
/*                         </label>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
