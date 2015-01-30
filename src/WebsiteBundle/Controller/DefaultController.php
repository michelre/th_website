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
    /**
     * @DI\InjectParams({
     *     "solrService" = @DI\Inject("solrService"),
     *     "templating" = @DI\Inject("templating")
     * })
     */
    public function __construct($solrService, $templating){
        $this->solrService = $solrService;
        $this->templating = $templating;
    }

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $utils = new Utils;
        $_torrents = $this->solrService->popularAction();
        $torrents = array_map(function($torrent) use(&$utils){
            return array("torrent" => $torrent, "categoryIcon" => $utils->getCategoryIconName($torrent["category"]));
        }, $_torrents);
        $tpl = $this->templating->render('default/index.html.twig', array("torrents" => $torrents));

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
        $torrents = array_map(function($torrent) use(&$utils){
            return array("torrent" => $torrent, "iconCategory" => $utils->getCategoryIconName($torrent["category"]));
        }, $result["torrents"]);
        $nbMaxPages = ($result["nbTorrentsFound"] > 10) ? 10 : $result["nbTorrentsFound"];
        $offset = ($offset < $nbMaxPages) ? $offset : $nbMaxPages;
        $tpl = $this->templating->render('default/search-results.html.twig',
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
        $torrent = $this->solrService->torrentAction($tracker, $slug);
        $moreLikeThis = $this->solrService->searchSimilarAction($slug);
        $tpl = $this->templating->render('default/torrent-detail.html.twig',
            array("torrent" => $torrent,
                "similarTorrents" => $moreLikeThis));
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
        $torrents = $this->solrService->torrentsByCategoryAction($category, $offset, $limit);

        $tpl = $this->templating->render('default/torrents-category.html.twig',
            array("torrents" => $torrents,
                  "pages" => $utils->createPagination($nbMaxPages, $offset),
                  "previousPage" => ($offset - 1),
                  "nextPage" => ($offset + 1),
                  "nbMaxPages" => $nbMaxPages,
                  "category" => $category,
                  "categoryIcon" => $utils->getCategoryIconName($category)));
        return new Response($tpl);
    }

    public function footerAction(){
        $tpl = $this->templating->render('footer.html.twig', $this->solrService->statsTrackersAction());
        return new Response($tpl);

    }

}