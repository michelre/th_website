<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_homepage;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'WebsiteBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }
        not_homepage:

        // search
        if ($pathinfo === '/search') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_search;
            }

            return array (  '_controller' => 'WebsiteBundle\\Controller\\DefaultController::searchAction',  '_route' => 'search',);
        }
        not_search:

        if (0 === strpos($pathinfo, '/torrent')) {
            // website_default_torrent
            if (preg_match('#^/torrent/(?P<tracker>[^/]++)/(?P<slug>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_website_default_torrent;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'website_default_torrent')), array (  '_controller' => 'WebsiteBundle\\Controller\\DefaultController::torrentAction',));
            }
            not_website_default_torrent:

            // website_default_torrentsbycategory
            if (0 === strpos($pathinfo, '/torrents') && preg_match('#^/torrents/(?P<category>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_website_default_torrentsbycategory;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'website_default_torrentsbycategory')), array (  '_controller' => 'WebsiteBundle\\Controller\\DefaultController::torrentsByCategoryAction',));
            }
            not_website_default_torrentsbycategory:

        }

        if (0 === strpos($pathinfo, '/api')) {
            // API specification
            if (preg_match('#^/api/(?P<version>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APIspecification;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API specification')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::indexAction',));
            }
            not_APIspecification:

            // API popular torrents
            if (preg_match('#^/api/(?P<version>[^/]++)/torrents/top$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APIpopulartorrents;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API popular torrents')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::popularAction',));
            }
            not_APIpopulartorrents:

            // API search
            if (preg_match('#^/api/(?P<version>[^/]++)/search$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APIsearch;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API search')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::searchAction',));
            }
            not_APIsearch:

            // API torrent details
            if (preg_match('#^/api/(?P<version>[^/]++)/torrent/(?P<tracker>[^/]++)/(?P<slug>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APItorrentdetails;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API torrent details')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::torrentAction',));
            }
            not_APItorrentdetails:

            // API similar search
            if (preg_match('#^/api/(?P<version>[^/]++)/search/similar/(?P<slug>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APIsimilarsearch;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API similar search')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::searchSimilarAction',));
            }
            not_APIsimilarsearch:

            // API search per categories
            if (preg_match('#^/api/(?P<version>[^/]++)/torrents/(?P<category>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APIsearchpercategories;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API search per categories')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::torrentsByCategoryAction',));
            }
            not_APIsearchpercategories:

            // API get stats for one tracker
            if (preg_match('#^/api/(?P<version>[^/]++)/stats$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_APIgetstatsforonetracker;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'API get stats for one tracker')), array (  '_controller' => 'ApiBundle\\Controller\\APIController::statsTrackersAction',));
            }
            not_APIgetstatsforonetracker:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
