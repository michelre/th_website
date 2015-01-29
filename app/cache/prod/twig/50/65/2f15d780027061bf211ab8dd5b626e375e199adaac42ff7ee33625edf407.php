<?php

/* base.html.twig */
class __TwigTemplate_50652f15d780027061bf211ab8dd5b626e375e199adaac42ff7ee33625edf407 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link href=\"//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css\" rel=\"stylesheet\">

        ";
        // line 8
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 12
        echo "
        ";
        // line 13
        $this->displayBlock('javascripts', $context, $blocks);
        // line 18
        echo "

    </head>
    <body>

        <div id=\"header\">
            <div class=\"row\">
                <div class=\"column small-6\">
                    <img src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/image/logo-bw.png"), "html", null, true);
        echo "\"/>
                </div>
                <div class=\"column small-6\">
                    <form action=\"/search\" method=\"GET\">
                        <div class=\"row collapse\">
                            <div class=\"small-11 columns\">
                                <input type=\"text\" placeholder=\"Wrong Turn 6, 12 years a slave...\" name=\"query\"/>
                            </div>
                            <div class=\"small-1 columns\">
                                <button type=\"submit\" class=\"button radius postfix\"><i class=\"fa fa-search\"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id=\"categories\" class=\"row\">
                <ul class=\"inline-list\">
                    <li><a href=\"/\">Accueil</a></li>
                    <li><a href=\"/torrents/movie\">Film</a></li>
                    <li><a href=\"/torrents/serie\">Série</a></li>
                    <li><a href=\"/torrents/music\">Musique</a></li>
                    <li><a href=\"/torrents/game\">Jeux</a></li>
                    <li><a href=\"/torrents/application\">Application</a></li>
                    <li><a href=\"/torrents/ebook\">Ebook</a></li>
                </ul>
            </div>
        </div>

        <div id=\"content\">";
        // line 54
        $this->displayBlock('body', $context, $blocks);
        echo "</div>

        <div id=\"footer\" class=\"row\">
            ";
        // line 57
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("WebsiteBundle:Default:footer"));
        echo "
        </div>
    </body>

    <script type=\"text/javascript\">
        var regex = new RegExp(\"offset=(.*)\");
        var currentPage = (regex.exec(window.location.search)) ? parseInt(regex.exec(window.location.search)[1]) : 1;
        var utils = new Utils();
        utils.setCurrentPage(currentPage);
        //utils.stylingPagination();
    </script>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Torrent Hunter - Agrégateur de tracker";
    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 9
        echo "            <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("vendor/css/foundation.css"), "html", null, true);
        echo "\">
            <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/css/style.css"), "html", null, true);
        echo "\" />
        ";
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        // line 14
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("vendor/js/vendor/jquery.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("vendor/js/vendor/modernizr.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/js/utils.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    // line 54
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 54,  138 => 16,  134 => 15,  129 => 14,  126 => 13,  120 => 10,  115 => 9,  112 => 8,  106 => 5,  89 => 57,  83 => 54,  52 => 26,  42 => 18,  40 => 13,  37 => 12,  35 => 8,  29 => 5,  23 => 1,);
    }
}
