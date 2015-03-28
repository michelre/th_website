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
use WebsiteBundle\Services\Utils;


class DefaultController extends Controller
{

    private $solrService;
    private $mobileDetect;

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $utils = new Utils;
        $solrService = $this->get('torrenthunter.solr_service');
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $_torrents = $solrService->popularAction();
        $torrents = $utils->makeTorrentsObject($_torrents);
        $templatePath = ($mobileDetect->isMobile()) ? "mobile/index.html.twig" : "default/index.html.twig" ;

        return $this->render($templatePath, array("torrents" => $torrents));
    }

    /**
     * @Route("/search", name="search")
     * @Method("GET")
     */
    public function searchAction(Request $request){
        $solrService = $this->get('torrenthunter.solr_service');
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $query = $request->query->get("query");
        $offset = ($request->query->get("offset")) ? $request->query->get("offset") : 1;
        $limit = 25;
        $utils = new Utils();
        $result = $solrService->searchAction($query, $limit, $offset);
        $torrents = $utils->makeTorrentsObject($result["torrents"]);

        $nbMaxPages = ($result["nbTorrentsFound"] > 10) ? 10 : $result["nbTorrentsFound"];
        $offset = ($offset < $nbMaxPages) ? $offset : $nbMaxPages;

        $templatePath = ($mobileDetect->isMobile()) ? "mobile/search-results.html.twig" : "default/search-results.html.twig" ;
        return $this->render($templatePath,
            array("torrents" => $torrents,
                  "query" => $result["query"],
                  "pages" => $utils->createPagination($nbMaxPages, $offset),
                  "previousPage" => ($offset - 1),
                  "nextPage" => ($offset + 1),
                  "nbMaxPages" => $nbMaxPages)
        );
    }

    /**
     * @Route("/torrent/{tracker}/{slug}", name="details")
     * @Method("GET")
     */
    public function torrentAction($tracker, $slug){
        $solrService = $this->get('torrenthunter.solr_service');
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $utils = new Utils();
        $torrent = $solrService->torrentAction($tracker, $slug);
        $moreLikeThis = $solrService->searchSimilarAction($slug);
        $similarTorrents = $utils->makeTorrentsObject($moreLikeThis);

        $templatePath = ($mobileDetect->isMobile()) ? "mobile/torrent-detail.html.twig" : "default/torrent-detail.html.twig" ;
        return $this->render($templatePath,
            array("torrent" => $torrent,
                  "similarTorrents" => $similarTorrents,
                  "formattedTitle" => $utils->formatTitle($torrent['title'])));
    }

    /**
     * @Route("/torrents/{category}", name="torrentsPerCategory")
     * @Method("GET")
     */
    public function torrentsByCategoryAction($category, Request $request){
        $solrService = $this->get('torrenthunter.solr_service');
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $utils = new Utils();
        $offset = ($request->query->get("offset")) ? abs($request->query->get("offset")) : 1;
        $limit = 25;
        $result = $solrService->torrentsByCategoryAction($category, $offset, $limit);
        $nbMaxPages = ceil($result['numFound'] / $limit);
        $torrents = $utils->makeTorrentsObject($result['torrents']);
        $templatePath = ($mobileDetect->isMobile()) ? "mobile/torrents-category.html.twig" : "default/torrents-category.html.twig" ;

        return $this->render($templatePath,
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

    /**
     * @Route("/torrents2transmission", name="torrents2transmission")
     * @Method("GET")
     */
    public function torrents2TransmissionAction(){
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $templatePath = ($mobileDetect->isMobile()) ? "mobile/torrents2transmission.html.twig" : "default/torrents2transmission.html.twig" ;
        return $this->render($templatePath);
    }

    public function headerAction(){
        $solrService = $this->get('torrenthunter.solr_service');
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $templatePath = ($mobileDetect->isMobile()) ? "mobile/header.html.twig" : "default/header.html.twig" ;
        return $this->render($templatePath, $solrService->statsTrackersAction());
    }

    public function footerAction(){
        $solrService = $this->get('torrenthunter.solr_service');
        $mobileDetect = $this->get('mobile_detect.mobile_detector');
        $templatePath = ($mobileDetect->isMobile()) ? "mobile/footer.html.twig" : "default/footer.html.twig" ;
        return $this->render($templatePath, $solrService->statsTrackersAction());
    }

}