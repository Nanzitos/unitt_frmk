<?php

/* index.html.twig */
class __TwigTemplate_3c8373b1571b19aac133c9c7f6bf2fd2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("inc/base.html.twig");

        $this->blocks = array(
            'metatitle' => array($this, 'block_metatitle'),
            'metadescription' => array($this, 'block_metadescription'),
            'metakeywords' => array($this, 'block_metakeywords'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'JScontainer' => array($this, 'block_JScontainer'),
            'container' => array($this, 'block_container'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "inc/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["moduleName"] = "Home";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_metatitle($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
        echo " - ";
        echo twig_escape_filter($this->env, (isset($context["moduleName"]) ? $context["moduleName"] : null), "html", null, true);
        echo " ";
    }

    // line 4
    public function block_metadescription($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "descriptions");
    }

    // line 5
    public function block_metakeywords($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "keywords");
    }

    // line 6
    public function block_stylesheet($context, array $blocks = array())
    {
    }

    // line 8
    public function block_JScontainer($context, array $blocks = array())
    {
    }

    // line 10
    public function block_container($context, array $blocks = array())
    {
        // line 11
        echo "    <section class=\"bg-color padding-top-bottom13\">
        <div class=\"container\">
            <div class=\"row nopadding\">
                <div class=\"col-md-12\">
                  <h1 class=\"center text-center\"> Olá Mundo Porque Não ?!</h1>
                </div>
                <p class=\"clearfix\"></p>
            </div>
        </div>
    </section>
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 11,  66 => 10,  61 => 8,  56 => 6,  50 => 5,  44 => 4,  35 => 3,  30 => 2,);
    }
}
