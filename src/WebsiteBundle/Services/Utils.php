<?php
/**
 * Created by PhpStorm.
 * User: remimichel
 * Date: 28/01/15
 * Time: 20:05
 */

namespace WebsiteBundle\Services;
use Cocur\Slugify\Slugify;


class Utils
{

    public function createPagination($total_pages, $current_page)
    {
        $grace = 3;
        $range = $grace * 2;
        $pages = array();

        $start = ($current_page - $grace) > 0 ? ($current_page - $grace) : 1;
        $end = $start + $range;
        if ($end > $total_pages) {
            $end = $total_pages;
            $start = ($end - $range) > 0 ? ($end - $range) : 1;
        }
        if ($start > 1) {
            array_push($pages, 1);
            array_push($pages, 0);
        }
        for ($i = $start; $i <= $end; $i++) {
            array_push($pages, $i);
        }
        if ($end < $total_pages) {
            array_push($pages, 0);
            array_push($pages, $total_pages);
        }
        return $pages;
    }

    public function getCategoryIconName($category){
        $iconsMovie = array(
            "Films" => "fa fa-film",
            "DVDRip" => "fa fa-film",
            "BDRip" => "fa fa-film",
            "HD - 1080p" => "fa fa-film",
            "HD - 720p" => "fa fa-film",
            "VOSTFR" => "fa fa-film",
            "Screener" => "fa fa-film",
            "R5 / DVDScreener" => "fa fa-film",
            "films" => "fa fa-film",
            "movie" => "fa fa-film",
            "Anime" => "fa fa-film"
        );
        $iconsMusic = array(
            "Albums" => "fa fa-music",
            "Musique" => "fa fa-music",
            "musique" => "fa fa-music",
            "music" => "fa fa-music",
            "Misc" => "fa fa-music"
        );
        $iconsSeries = array(
            "Séries" => "fa fa-desktop",
            "Série" => "fa fa-desktop",
            "Série VF" => "fa fa-desktop",
            "Série VOSTFR" => "fa fa-desktop",
            "Pack Série" => "fa fa-desktop",
            "serie" => "fa fa-desktop",
            "series" => "fa fa-desktop",
            "Series" => "fa fa-desktop"
        );
        $iconsGame = array(
            "Jeux PC" => "fa fa-gamepad",
            "Jeux Consoles" => "fa fa-gamepad",
            "game" => "fa fa-gamepad"
        );
        $iconsSoftware = array(
            "Logiciels" => "fa fa-windows",
            "Application" => "fa fa-windows",
            "application" => "fa fa-windows"

        );
        $iconsEbook = array(
            "Ebooks" => "fa fa-book",
            "Ebook" => "fa fa-book",
            "ebook" => "fa fa-book"
        );

        $icons = array_merge($iconsMovie, $iconsMusic, $iconsSeries, $iconsGame, $iconsSoftware, $iconsEbook);
        return (array_key_exists($category, $icons)) ? $icons[$category] : $category;
    }

    public function getCategoryName($categorySlug){
        $categories = array(
            "movie" => "Film",
            "serie" => "Série",
            "music" => "Musique",
            "game"  => "Jeux",
            "application" => "Application",
            "ebook" => "Ebook"
        );
        return $categories[$categorySlug];
    }

    public function makeTorrentsObject($torrents){
        return array_map(function($torrent) use(&$utils){
            return array("torrent" => $torrent, "categoryIcon" => $this->getCategoryIconName($torrent["category"]));
        }, $torrents);
    }

    public function formatTitle($title){
        $slugify = new Slugify("/([^a-z0-9'.]|-)+/");
        $stopWords = array("dvdscr", "720p", "1080p", "dvdrip", "brrip", "hdrip", "xvid", "cam", "limited", "mkv",
                           "hc", "bdrip", "x264", "ld", "hdtv", "rnt", "web", "mp3", "bluworld", "itunes", "mp3vbr",
                           "codex", "reloaded", "flt", "prophet", "skidrow", "mephisto", "dlc", "nosteam", "cracked", "hd",
                           "amd64", "bg", "dvd", "64bit", "x86_64", "x86", "x64");
        $tokens = explode("-", $slugify->slugify($title));
        $formattedTitle = '';
        $i = 0;
        $found = false;
        while($i < sizeof($tokens) && !$found){
            $current = $tokens[$i];
            if(!in_array($current, $stopWords))
                $formattedTitle .= " " . $current;
            else
                $found = true;
            $i += 1;
        }
        return trim($formattedTitle);
    }

} 