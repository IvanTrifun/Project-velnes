<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* database/designer/page_save_as.twig */
class __TwigTemplate_7ef08223f6a1a73c491b31d2a7b1bead extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<form action=\"";
        echo PhpMyAdmin\Url::getFromRoute("/database/designer");
        echo "\" method=\"post\" name=\"save_as_pages\" id=\"save_as_pages\" class=\"ajax\">
    ";
        // line 2
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
    <fieldset class=\"pma-fieldset\" id=\"page_save_as_options\">
        <table class=\"table table-borderless\">
            <tbody>
                <tr>
                    <td>
                        <input type=\"hidden\" name=\"operation\" value=\"savePage\">
                        ";
        // line 9
        $this->loadTemplate("database/designer/page_selector.twig", "database/designer/page_save_as.twig", 9)->display(twig_to_array(["pdfwork" =>         // line 10
($context["pdfwork"] ?? null), "pages" =>         // line 11
($context["pages"] ?? null)]));
        // line 13
        echo "                    </td>
                </tr>
                <tr>
                    <td>
                      <div>
                        <input type=\"radio\" name=\"save_page\" id=\"savePageSameRadio\" value=\"same\" checked>
                        <label for=\"savePageSameRadio\">";
echo _gettext("Save to selected page");
        // line 19
        echo "</label>
                      </div>
                      <div>
                        <input type=\"radio\" name=\"save_page\" id=\"savePageNewRadio\" value=\"new\">
                        <label for=\"savePageNewRadio\">";
echo _gettext("Create a page and save to it");
        // line 23
        echo "</label>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=\"selected_value\">";
echo _gettext("New page name");
        // line 29
        echo "</label>
                        <input type=\"text\" name=\"selected_value\" id=\"selected_value\">
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "database/designer/page_save_as.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 29,  72 => 23,  65 => 19,  56 => 13,  54 => 11,  53 => 10,  52 => 9,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/designer/page_save_as.twig", "D:\\coding\\velness\\velnesmk\\velnesmk\\public\\phpmyadmin\\templates\\database\\designer\\page_save_as.twig");
    }
}
