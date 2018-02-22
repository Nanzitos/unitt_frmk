<?php

/* inc/base.html.twig */
class __TwigTemplate_bb4e0df06897d7f3a76c90a346f966b7 extends Twig_Template
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
            'stylesheet' => array($this, 'block_stylesheet'),
            'bodyfunctions' => array($this, 'block_bodyfunctions'),
            'container' => array($this, 'block_container'),
            'JScontainer' => array($this, 'block_JScontainer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"pt-br\">
<head>
  <meta charset=\"utf-8\">
  <!--[if IE]><meta http-equiv=\"x-ua-compatible\" content=\"IE=9\" /><![endif]-->
  <link rel=\"shortcut icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/favicon.ico")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-57x57.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-60x60.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-72x72.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-76x76.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-114x114.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-120x120.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-144x144.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-152x152.png")), "html", null, true);
        echo "\">
  <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/apple-icon-180x180.png")), "html", null, true);
        echo "\">
  <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\"  href=\"";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/android-icon-192x192.png")), "html", null, true);
        echo "\">
  <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/favicon-32x32.png")), "html", null, true);
        echo "\">
  <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/favicon-96x96.png")), "html", null, true);
        echo "\">
  <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/favicon-16x16.png")), "html", null, true);
        echo "\">
  <link rel=\"manifest\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("favicon/manifest.json")), "html", null, true);
        echo "\">
  <!-- Titulo da página -->
  <title>";
        // line 22
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
        echo " | ";
        echo twig_escape_filter($this->env, (isset($context["moduleName"]) ? $context["moduleName"] : null), "html", null, true);
        echo "</title>
  <!-- Titulo da página -->
  <meta name=\"ẗitle\" content=\"";
        // line 24
        $this->displayBlock('metatitle', $context, $blocks);
        echo "\">
  <meta name=\"description\" content=\"";
        // line 25
        $this->displayBlock('metadescription', $context, $blocks);
        echo "\">
  <meta name=\"keywords\" content=\"";
        // line 26
        $this->displayBlock('metakeywords', $context, $blocks);
        echo "\">
  <meta name=\"site\" content=\"";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
        echo "\">
  <meta name=\"author\" content=\"Unittá, www.unitta.com.br\">
  <meta name=\"language\" content=\"pt-BR\" />
  <meta name=\"country\" content=\"BRA\" />
  <meta name=\"robots\" content=\"all\" >
  <meta name=\"Googlebot\" content=\"index, follow\">
  <meta content=\"7 days\" name=revisit-after>
  <link rel=\"amphtml\" href=\"";
        // line 34
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
        echo "amp-home\">
  <meta property=\"og:title\" content=\"";
        // line 35
        $this->displayBlock('og_title', $context, $blocks);
        echo "\" />
  <meta property=\"og:site_name\" content=\"";
        // line 36
        $this->displayBlock('og_site_name', $context, $blocks);
        echo "\"/>
  <meta property=\"og:image\" content=\"";
        // line 37
        $this->displayBlock('og_image', $context, $blocks);
        echo "\"/>
  <meta property=\"og:url\" content=\"";
        // line 38
        $this->displayBlock('og_url', $context, $blocks);
        echo "\" />
  <meta property=\"og:description\" content=\"";
        // line 39
        $this->displayBlock('og_description', $context, $blocks);
        echo "\" />
  <meta property=\"og:type\" content=\"";
        // line 40
        $this->displayBlock('og_type', $context, $blocks);
        echo "\" />
  <meta property=\"og:locale\" content=\"";
        // line 41
        $this->displayBlock('og_locale', $context, $blocks);
        echo "\" />
  <meta property=\"place:location:latitude\" content=\"";
        // line 42
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "latitude");
        echo "\"/>
  <meta property=\"place:location:longitude\" content=\"";
        // line 43
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "longitude");
        echo "\"/>
  <meta property=\"business:contact_data:street_address\" content=\"";
        // line 44
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "endereco");
        echo ", ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "nm_endereco");
        echo " - ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "complemento");
        echo "\"/>
  <meta property=\"business:contact_data:locality\" content=\"";
        // line 45
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "cidade");
        echo ", ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "uf");
        echo "\"/>
  <meta property=\"business:contact_data:postal_code\" content=\"";
        // line 46
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "cep");
        echo "\"/>
  <meta property=\"business:contact_data:country_name\" content=\"";
        // line 47
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "pais");
        echo "\"/>
  <meta property=\"business:contact_data:email\" content=\"";
        // line 48
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "email_site");
        echo "\"/>
  <meta property=\"business:contact_data:phone_number\" content=\"";
        // line 49
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "phone");
        echo "\"/>
  <meta property=\"business:contact_data:website\" content=\"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
        echo "\"/>
  <meta name=\"twitter:card\" content=\"summary\" />
  <meta name=\"twitter:title\" content=\"";
        // line 52
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
        echo "\" />
  <meta name=\"twitter:image\" content=\"";
        // line 53
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("img/logo.png")), "html", null, true);
        echo "\" />
  <meta name=\"twitter:site\" content=\"";
        // line 54
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "twitter_Account");
        echo "\" />
  <meta name=\"google-site-verification\" content=\"";
        // line 55
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "googlesiteverification");
        echo "\" />
  <!-- Google Authorship & Publisher Markup - Utilizado para definir quem é o autor e quem publicou o link -->
  <link rel=\"author\" href=\"https://plus.google.com/";
        // line 57
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "googleprofile");
        echo "/posts\"/>
  <link rel=\"publisher\" href=\"https://plus.google.com/";
        // line 58
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "googlepageprofile");
        echo "\"/>
  <!-- Schema.org markup para o Google+ -->
  <meta itemprop=\"name\" content=\"";
        // line 60
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
        echo "\">
  <meta itemprop=\"description\" content=\"";
        // line 61
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "descriptions");
        echo "\">
  <meta itemprop=\"image\" content=\"";
        // line 62
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("img/logo.png")), "html", null, true);
        echo "\" />
  <!-- =======================Stylesheet=========================== -->
  <!-- Font-Lato-->
  ";
        // line 66
        echo "  <link href=\"https://fonts.googleapis.com/css?family=Lato:300\" rel=\"stylesheet\">
  <!-- Bootstrap -->
  <link href=\"";
        // line 68
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/bootstrap/bootstrap.min.css")), "html", null, true);
        echo "\" rel=\"stylesheet\">
  <!--[if lt IE 9]>
  <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
  <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
  <![endif]-->
  <link rel=\"stylesheet\" href=\"";
        // line 73
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/reset.css")), "html", null, true);
        echo "\" type=\"text/css\" /><!-- Formatação -->
  <link rel=\"stylesheet\" href=\"";
        // line 74
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/style.css")), "html", null, true);
        echo "\" type=\"text/css\" /><!-- Styles CSS -->
  <link rel=\"stylesheet\" href=\"";
        // line 75
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/font-awesome/css/font-awesome.min.css")), "html", null, true);
        echo "\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 76
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/simpleline-icons/css/simple-line-icons.css")), "html", null, true);
        echo "\" media=\"screen\" />
  <link rel=\"stylesheet\" href=\"";
        // line 77
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/et-linefont/etlinefont.css")), "html", null, true);
        echo "\">
  <link rel=\"stylesheet\" media=\"screen\" href=\"";
        // line 78
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/responsive-layouts.css")), "html", null, true);
        echo "\" type=\"text/css\" /><!-- Responsivo -->
  <!-- =======================/Stylesheet========================== -->

  ";
        // line 81
        $this->displayBlock('stylesheet', $context, $blocks);
        // line 82
        echo "  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
  <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
  <![endif]-->
  <!--Google Analytics-->
  ";
        // line 89
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "cod_GoogleAnalytics");
        echo "
  <!--/Google Analytics-->
</head>
<body>
";
        // line 93
        $this->displayBlock('bodyfunctions', $context, $blocks);
        // line 94
        echo "<div class=\"site-wrapper\">
  ";
        // line 95
        $this->env->loadTemplate("inc/header.html.twig")->display($context);
        // line 96
        echo "  ";
        if ((isset($context["setFlash"]) ? $context["setFlash"] : null)) {
            // line 97
            echo "  <section style=\"position: fixed;top: 47%; left: 36%;z-index: 9999999;\">
    <div class=\"row nopadding\">
      <div class=\"col-md-12\">
        <div class=\"alert ";
            // line 100
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setFlash"]) ? $context["setFlash"] : null), "status"), "html", null, true);
            echo "\">
          <span class=\"closebtn\">×</span>
          <h6 class=\"white lato\"><strong class=\"caps\">";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setFlash"]) ? $context["setFlash"] : null), "title"), "html", null, true);
            echo "!</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setFlash"]) ? $context["setFlash"] : null), "message"), "html", null, true);
            echo "</h6>
        </div>
      </div>
    </div>
  </section>
  ";
        }
        // line 108
        echo "  ";
        $this->displayBlock('container', $context, $blocks);
        // line 109
        echo "  ";
        $this->env->loadTemplate("inc/footer.html.twig")->display($context);
        // line 110
        echo "</div>
<!-- =======================Javascripts=========================== -->
<!-- Fecha Bottão de Contato -->
<script type=\"text/javascript\">
var close = document.getElementsByClassName(\"closebtn\");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function () {
    var div = this.parentElement;
    div.style.opacity = \"0\";
    setTimeout(function () {
      div.style.display = \"none\";
    }, 600);
  }
}
</script>
<!-- =======================/Javascripts========================== -->
";
        // line 128
        $this->displayBlock('JScontainer', $context, $blocks);
        // line 129
        echo "</body>
</html>
";
    }

    // line 24
    public function block_metatitle($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
    }

    // line 25
    public function block_metadescription($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "descriptions");
    }

    // line 26
    public function block_metakeywords($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "keywords");
    }

    // line 35
    public function block_og_title($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
    }

    // line 36
    public function block_og_site_name($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title");
    }

    // line 37
    public function block_og_image($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("img/ICTS-Premio-Pro-Etica_336X280.gif")), "html", null, true);
    }

    // line 38
    public function block_og_url($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, (isset($context["route"]) ? $context["route"] : null), "html", null, true);
    }

    // line 39
    public function block_og_description($context, array $blocks = array())
    {
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "descriptions");
    }

    // line 40
    public function block_og_type($context, array $blocks = array())
    {
        echo "content";
    }

    // line 41
    public function block_og_locale($context, array $blocks = array())
    {
        echo "pt_BR";
    }

    // line 81
    public function block_stylesheet($context, array $blocks = array())
    {
    }

    // line 93
    public function block_bodyfunctions($context, array $blocks = array())
    {
    }

    // line 108
    public function block_container($context, array $blocks = array())
    {
        echo "  ";
    }

    // line 128
    public function block_JScontainer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "inc/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  442 => 128,  436 => 108,  431 => 93,  426 => 81,  420 => 41,  414 => 40,  408 => 39,  402 => 38,  396 => 37,  390 => 36,  384 => 35,  378 => 26,  372 => 25,  366 => 24,  360 => 129,  358 => 128,  338 => 110,  335 => 109,  332 => 108,  321 => 102,  316 => 100,  311 => 97,  308 => 96,  306 => 95,  303 => 94,  301 => 93,  294 => 89,  285 => 82,  283 => 81,  277 => 78,  273 => 77,  269 => 76,  265 => 75,  261 => 74,  257 => 73,  249 => 68,  245 => 66,  239 => 62,  235 => 61,  231 => 60,  226 => 58,  222 => 57,  217 => 55,  213 => 54,  209 => 53,  205 => 52,  200 => 50,  196 => 49,  192 => 48,  188 => 47,  184 => 46,  178 => 45,  170 => 44,  166 => 43,  162 => 42,  158 => 41,  154 => 40,  150 => 39,  146 => 38,  142 => 37,  138 => 36,  134 => 35,  130 => 34,  120 => 27,  116 => 26,  112 => 25,  108 => 24,  101 => 22,  96 => 20,  92 => 19,  88 => 18,  84 => 17,  80 => 16,  76 => 15,  72 => 14,  68 => 13,  64 => 12,  60 => 11,  52 => 9,  48 => 8,  40 => 6,  33 => 1,  69 => 11,  66 => 10,  61 => 8,  56 => 10,  50 => 5,  44 => 7,  35 => 3,  30 => 2,);
    }
}
