<?php

/* default/torrent-detail.html.twig */
class __TwigTemplate_1f80efc2221cade236074dc4e80547df16377c69b39dbf4e8b51585f02c22a09 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <ul class=\"pricing-table\">
        <li class=\"title\">";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "title", array()), "html", null, true);
        echo "</li>
        <li class=\"price\">";
        // line 6
        echo twig_escape_filter($this->env, strtr($this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "size", array()), array("Mo" => "MB", "Go" => "GB", "Ko" => "KB", "Mb" => "MB", "Gb" => "GB", "Kb" => "KB")), "html", null, true);
        echo "</li>
        <li class=\"description\">Tracker: ";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "tracker", array()), "html", null, true);
        echo "</li>
        <li class=\"bullet-item\">Catégorie: ";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "category", array()), "html", null, true);
        echo "</li>
        <li class=\"bullet-item\">";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "seeds", array()), "html", null, true);
        echo " seeders</li>
        <li class=\"bullet-item\">";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "leechs", array()), "html", null, true);
        echo " leechers</li>
        <li class=\"description\">Lien original: <a href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "url", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "url", array()), "html", null, true);
        echo "</a></li>
        <li class=\"cta-button\"><a rel=\"no-follow\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["torrent"]) ? $context["torrent"] : null), "downloadLink", array()), "html", null, true);
        echo "\" class=\"button\" download>Télécharger</a></li>
    </ul>

    <div class=\"torrents-similar\">
        <h4>Ces fichiers peuvent vous intéresser:</h4>
        <div class=\"table-container row\">
            <div class=\"column small-12\">
                <table class=\"column small-12\">
                    <thead>
                    <th>Catégorie</th>
                    <th>Titre</th>
                    <th>Taille</th>
                    <th>Seeders</th>
                    <th>Leechers</th>
                    <th>Tracker</th>
                    </thead>
                    <tbody>
                    ";
        // line 29
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["similarTorrents"]) ? $context["similarTorrents"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["torrent"]) {
            // line 30
            echo "                        <tr>
                            <td class=\"text-center\"><i title=\"";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "category", array()), "html", null, true);
            echo "\" class=\"fa fa-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "category", array()), "html", null, true);
            echo " fa-2x\"></i></td>
                            <td><a href=\"/torrent/";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "tracker", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "slug", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "title", array()), "html", null, true);
            echo "</a></td>
                            <td>";
            // line 33
            echo twig_escape_filter($this->env, strtr($this->getAttribute($context["torrent"], "size", array()), array("Mo" => "MB", "Go" => "GB", "Ko" => "KB", "Mb" => "MB", "Gb" => "GB", "Kb" => "KB")), "html", null, true);
            echo "</td>
                            <td><i class=\"fa fa-arrow-up\"></i>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "seeds", array()), "html", null, true);
            echo "</td>
                            <td><i class=\"fa fa-arrow-down\"></i>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($context["torrent"], "leechs", array()), "html", null, true);
            echo "</td>
                            <td><img src=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((("bundles/app/image/" . $this->getAttribute($context["torrent"], "tracker", array())) . "-thumb.jpg")), "html", null, true);
            echo "\"/></td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['torrent'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "                    </tbody>
                </table>
            </div>
        </div>

    </div>

";
    }

    public function getTemplateName()
    {
        return "default/torrent-detail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 39,  125 => 36,  121 => 35,  117 => 34,  113 => 33,  105 => 32,  99 => 31,  96 => 30,  92 => 29,  72 => 12,  66 => 11,  62 => 10,  58 => 9,  54 => 8,  50 => 7,  46 => 6,  42 => 5,  39 => 4,  36 => 3,  11 => 1,);
    }
}
