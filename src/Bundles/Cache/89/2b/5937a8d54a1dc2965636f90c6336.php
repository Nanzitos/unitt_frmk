<?php

/* 404.html.twig */
class __TwigTemplate_892b5937a8d54a1dc2965636f90c6336 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'metatitle' => array($this, 'block_metatitle'),
            'metadescription' => array($this, 'block_metadescription'),
            'metakeywords' => array($this, 'block_metakeywords'),
            'og_title' => array($this, 'block_og_title'),
            'og_site_name' => array($this, 'block_og_site_name'),
            'og_image' => array($this, 'block_og_image'),
            'og_url' => array($this, 'block_og_url'),
            'og_description' => array($this, 'block_og_description'),
            'og_type' => array($this, 'block_og_type'),
            'og_locale' => array($this, 'block_og_locale'),
            'twitterimage' => array($this, 'block_twitterimage'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<!--{/*
@info
Generated on: Tue, 20 Feb 2018 22:12:09 GMT
Initiator: Rabbit AMP Generator
Generator version: 0.9.6
*/}-->
<html ⚡ lang=\"en\">
<head>
  <meta charset=\"utf-8\">
  <title>Afiasoccer | 404 Página não encontrada</title>
  <script async src=\"https://cdn.ampproject.org/v0.js\"></script>
  <link rel=\"canonical\" href=\"http://afiasoccer.com/404\">
  <meta name=\"viewport\" content=\"width=device-width,minimum-scale=1,initial-scale=1\">
  <meta name=\"ẗitle\" content=\"";
        // line 15
        $this->displayBlock('metatitle', $context, $blocks);
        echo "\">
  <meta name=\"description\" content=\"";
        // line 16
        $this->displayBlock('metadescription', $context, $blocks);
        echo "\">
  <meta name=\"keywords\" content=\"";
        // line 17
        $this->displayBlock('metakeywords', $context, $blocks);
        echo "\">
  <meta name=\"site\" content=\"";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
        echo "\">
  <meta name=\"author\" content=\"Unittá, www.unitta.com.br\">
  <meta name=\"language\" content=\"pt-BR\" />
  <meta name=\"country\" content=\"BRA\" />
  <meta name=\"robots\" content=\"all\" >
  <meta name=\"Googlebot\" content=\"index, follow\">
  <meta content=\"7 days\" name=revisit-after>
  <link rel=\"amphtml\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
        echo "amp-home\">
  <meta property=\"og:title\" content=\"";
        // line 26
        $this->displayBlock('og_title', $context, $blocks);
        echo "\" />
  <meta property=\"og:site_name\" content=\"";
        // line 27
        $this->displayBlock('og_site_name', $context, $blocks);
        echo "\"/>
  <meta property=\"og:image\" content=\"";
        // line 28
        $this->displayBlock('og_image', $context, $blocks);
        echo "\"/>
  <meta property=\"og:url\" content=\"";
        // line 29
        $this->displayBlock('og_url', $context, $blocks);
        echo "\" />
  <meta property=\"og:description\" content=\"";
        // line 30
        $this->displayBlock('og_description', $context, $blocks);
        echo "\" />
  <meta property=\"og:type\" content=\"";
        // line 31
        $this->displayBlock('og_type', $context, $blocks);
        echo "\" />
  <meta property=\"og:locale\" content=\"";
        // line 32
        $this->displayBlock('og_locale', $context, $blocks);
        echo "\" />
  <meta property=\"place:location:latitude\" content=\"";
        // line 33
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "latitude");
        echo "\"/>
  <meta property=\"place:location:longitude\" content=\"";
        // line 34
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "longitude");
        echo "\"/>
  <meta property=\"business:contact_data:street_address\" content=\"";
        // line 35
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "endereco");
        echo ", ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "nm_endereco");
        echo " - ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "complemento");
        echo "\"/>
  <meta property=\"business:contact_data:locality\" content=\"";
        // line 36
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "cidade");
        echo ", ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "uf");
        echo "\"/>
  <meta property=\"business:contact_data:postal_code\" content=\"";
        // line 37
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "cep");
        echo "\"/>
  <meta property=\"business:contact_data:country_name\" content=\"";
        // line 38
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "pais");
        echo "\"/>
  <meta property=\"business:contact_data:email\" content=\"";
        // line 39
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "email_site");
        echo "\"/>
  <meta property=\"business:contact_data:phone_number\" content=\"";
        // line 40
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "phone");
        echo "\"/>
  <meta property=\"business:contact_data:website\" content=\"";
        // line 41
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
        echo "\"/>
  <meta name=\"twitter:card\" content=\"summary\" />
  <meta name=\"twitter:title\" content=\"";
        // line 43
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
        echo "\" />
  <meta name=\"twitter:image\" content=\"";
        // line 44
        $this->displayBlock('twitterimage', $context, $blocks);
        echo "\" />
  <meta name=\"twitter:site\" content=\"";
        // line 45
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "twitter_Account");
        echo "\" />
  <meta name=\"google-site-verification\" content=\"";
        // line 46
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "googlesiteverification");
        echo "\" />
  <style amp-boilerplate=\"\">body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
  <noscript data-amp-spec=\"\"><style amp-boilerplate=\"\">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Tangerine\">
  <style amp-custom=\"\">body {
    font-family: Tangerine,cursive
  }
  body {
    background: #eaeaea
  }
  .wrap {
    margin: 0 auto;
    width: 1000px
  }
  .logo {
    text-align: center;
    margin-top: 200px
  }
  .logo amp-img {
    width: 350px
  }
  .logo p {
    color: #272727;
    font-size: 40px;
    margin-top: 1px
  }
  .sub a {
    color: #fff;
    background: #272727;
    text-decoration: none;
    padding: 10px 20px;
    font-size: 13px;
    font-family: arial,serif;
    font-weight: 700;
    -webkit-border-radius: .5em;
    -moz-border-radius: .5em;
    -border-radius: .5em
  }
  .footer {
    color: #000;
    position: absolute;
    right: 10px;
    bottom: 10px
    }</style>
  </head>
  <body>
    <div class=\"wrap\">
      <div class=\"logo\">
        <amp-img src=\"http://afiasoccer.com/assets/images/logo.png\" width=\"350\" height=\"350\" layout=\"fixed\"></amp-img>
        <br><br><br>
        <p>O endereco que você digitou não existe. ";
        // line 96
        echo twig_escape_filter($this->env, (isset($context["Message"]) ? $context["Message"] : null), "html", null, true);
        echo "</p>
        <div class=\"sub\">
          <p><a href=\"http://afiasoccer.com/\">Voltar </a></p>
        </div>
      </div>
    </div>
    <div class=\"footer\">
    </div>
  </body>
  </html>
";
    }

    // line 15
    public function block_metatitle($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
    }

    // line 16
    public function block_metadescription($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "descriptions");
    }

    // line 17
    public function block_metakeywords($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "keywords");
    }

    // line 26
    public function block_og_title($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
    }

    // line 27
    public function block_og_site_name($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
    }

    // line 28
    public function block_og_image($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("img/ICTS-Premio-Pro-Etica_336X280.gif")), "html", null, true);
    }

    // line 29
    public function block_og_url($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
    }

    // line 30
    public function block_og_description($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "descriptions");
    }

    // line 31
    public function block_og_type($context, array $blocks = array())
    {
        echo "content";
    }

    // line 32
    public function block_og_locale($context, array $blocks = array())
    {
        echo "pt_BR";
    }

    // line 44
    public function block_twitterimage($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("img/ICTS-Premio-Pro-Etica_336X280.gif")), "html", null, true);
    }

    public function getTemplateName()
    {
        return "404.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  283 => 44,  277 => 32,  271 => 31,  265 => 30,  259 => 29,  253 => 28,  247 => 27,  241 => 26,  235 => 17,  229 => 16,  223 => 15,  208 => 96,  155 => 46,  151 => 45,  147 => 44,  143 => 43,  138 => 41,  134 => 40,  130 => 39,  126 => 38,  122 => 37,  116 => 36,  108 => 35,  104 => 34,  100 => 33,  96 => 32,  92 => 31,  88 => 30,  84 => 29,  80 => 28,  76 => 27,  72 => 26,  68 => 25,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  30 => 1,);
    }
}
