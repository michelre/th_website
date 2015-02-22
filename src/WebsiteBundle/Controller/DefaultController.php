<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\DiExtraBundle\Annotation as DI;
use WebsiteBundle\Services\Utils;


class DefaultController
{

    private $solrService;
    private $templating;
    private $mobileDetect;
    /**
     * @DI\InjectParams({
     *     "solrService" = @DI\Inject("solrService"),
     *     "templating" = @DI\Inject("templating"),
     *     "mobileDetect" = @DI\Inject("mobile_detect.mobile_detector")
     * })
     */
    public function __construct($solrService, $templating, $mobileDetect){
        $this->solrService = $solrService;
        $this->templating = $templating;
        $this->mobileDetect = $mobileDetect;
    }

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $utils = new Utils;
        $_torrents = $this->solrService->popularAction();
        $torrents = $utils->makeTorrentsObject($_torrents);

        $templatePath = ($this->mobileDetect->isMobile()) ? "mobile/index.html.twig" : "default/index.html.twig" ;
        $tpl = $this->templating->render($templatePath, array("torrents" => $torrents));

        return new Response($tpl);
    }

    /**
     * @Route("/search", name="search")
     * @Method("GET")
     */
    public function searchAction(Request $request){
        $query = $request->query->get("query");
        $offset = ($request->query->get("offset")) ? $request->query->get("offset") : 1;
        $limit = 25;
        $utils = new Utils();
        $result = $this->solrService->searchAction($query, $limit, $offset);
        $torrents = $utils->makeTorrentsObject($result["torrents"]);

        $nbMaxPages = ($result["nbTorrentsFound"] > 10) ? 10 : $result["nbTorrentsFound"];
        $offset = ($offset < $nbMaxPages) ? $offset : $nbMaxPages;

        $templatePath = ($this->mobileDetect->isMobile()) ? "mobile/search-results.html.twig" : "default/search-results.html.twig" ;
        $tpl = $this->templating->render($templatePath,
            array("torrents" => $torrents,
                  "query" => $result["query"],
                  "pages" => $utils->createPagination($nbMaxPages, $offset),
                  "previousPage" => ($offset - 1),
                  "nextPage" => ($offset + 1),
                  "nbMaxPages" => $nbMaxPages)
        );

        return new Response($tpl);

    }

    /**
     * @Route("/torrent/{tracker}/{slug}", name="details")
     * @Method("GET")
     */
    public function torrentAction($tracker, $slug){
        $utils = new Utils();
        $torrent = $this->solrService->torrentAction($tracker, $slug);
        $moreLikeThis = $this->solrService->searchSimilarAction($slug);
        $similarTorrents = $utils->makeTorrentsObject($moreLikeThis);

        $templatePath = ($this->mobileDetect->isMobile()) ? "mobile/torrent-detail.html.twig" : "default/torrent-detail.html.twig" ;
        $tpl = $this->templating->render($templatePath,
            array("torrent" => $torrent,
                  "similarTorrents" => $similarTorrents,
                  "formattedTitle" => $utils->formatTitle($torrent['title'])));
        return new Response($tpl);
    }

    /**
     * @Route("/torrents/{category}", name="torrentsPerCategory")
     * @Method("GET")
     */
    public function torrentsByCategoryAction($category, Request $request){
        $utils = new Utils();
        $offset = ($request->query->get("offset")) ? abs($request->query->get("offset")) : 1;
        $limit = 25;
        $nbMaxPages = 20;
        $offset = ($offset < $nbMaxPages) ? $offset : $nbMaxPages;
        $torrents = $utils->makeTorrentsObject($this->solrService->torrentsByCategoryAction($category, $offset, $limit));
        $templatePath = ($this->mobileDetect->isMobile()) ? "mobile/torrents-category.html.twig" : "default/torrents-category.html.twig" ;

        $tpl = $this->templating->render($templatePath,
            array("torrents" => $torrents,
                  "pages" => $utils->createPagination($nbMaxPages, $offset),
                  "previousPage" => ($offset - 1),
                  "nextPage" => ($offset + 1),
                  "nbMaxPages" => $nbMaxPages,
                  "category" => $category,
                  "categoryIcon" => $utils->getCategoryIconName($category),
                  "categoryName" => $utils->getCategoryName($category)
            ));
        return new Response($tpl);
    }

    public function headerAction(){
        $templatePath = ($this->mobileDetect->isMobile()) ? "mobile/header.html.twig" : "default/header.html.twig" ;
        $tpl = $this->templating->render($templatePath, $this->solrService->statsTrackersAction());
        return new Response($tpl);
    }

    public function footerAction(){
        $templatePath = ($this->mobileDetect->isMobile()) ? "mobile/footer.html.twig" : "default/footer.html.twig" ;
        $tpl = $this->templating->render($templatePath, $this->solrService->statsTrackersAction());
        return new Response($tpl);
    }

}