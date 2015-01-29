<?php

/* footer.html.twig */
class __TwigTemplate_f1f6dd0325c977fa91b8fd3cbf0a4f441ec7e0919eed963e003606f70f0a6d4b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<ul>
    ";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["stats"]) ? $context["stats"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["stat"]) {
            // line 3
            echo "        <li>
            <div class=\"row\">
                <div class=\"columns large-6\">
                    <span class=\"columns large-6\">Nombre de torrents (";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["stat"], "tracker", array()), "html", null, true);
            echo "):</span>
                    <span class=\"columns large-6\">";
            // line 7
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["stat"], "nb", array()), 0, ".", " "), "html", null, true);
            echo " (maj le ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["stat"], "lastIndexationDate", array()), "d/m/Y", "Europe/Paris"), "html", null, true);
            echo ")</span>
                </div>
            </div>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "    <li>
        <div class=\"row\">
            <div class=\"columns large-6\">
                <span class=\"columns large-6\">Nombre total de torrents:</span>
                <span class=\"columns large-6\">";
        // line 16
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["nbTotal"]) ? $context["nbTotal"] : null), 0, ".", " "), "html", null, true);
        echo "</span>
            </div>
        </div>
    </li>
</ul>";
    }

    public function getTemplateName()
    {
        return "footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 16,  48 => 12,  35 => 7,  31 => 6,  26 => 3,  22 => 2,  19 => 1,);
    }
}
