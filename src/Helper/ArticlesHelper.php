<?php
namespace ModFeaturedArticlesDisplay\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
class ArticlesHelper
{
    public static function getArticles($params)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select required fields from the content table
        $query->select('a.id, a.title, a.introtext, a.created, a.catid')
              ->from('#__content AS a')
              ->where('a.featured = 1') // Only featured articles
              ->where('a.state = 1'); // Only published articles

        // Apply category filter (if set)
        $categoryFilter = $params->get('category_filter');
        if (!empty($categoryFilter)) {
            $query->where('a.catid IN (' . implode(',', $categoryFilter) . ')');
        }

        // Apply sorting
        $sortOrder = $params->get('sort_order', 'newest_first');
        switch ($sortOrder) {
            case 'oldest_first':
                $query->order('a.created ASC');
                break;
            case 'alphabetical':
                $query->order('a.title ASC');
                break;
            case 'newest_first':
            default:
                $query->order('a.created DESC');
                break;
        }

        // Set the limit for the number of articles
        $query->setLimit((int) $params->get('number_of_articles', 5));

        $db->setQuery($query);
        $articles = $db->loadObjectList();

        // If 'show_introtext' is set to 0, remove the introtext field from the articles
        $showIntroText = $params->get('show_introtext', 1); // Default to 1 if not set
        if ($showIntroText == 0) {
            // If introtext is not to be shown, unset it
            foreach ($articles as &$article) {
                $article->introtext = ''; // Remove the introtext
            }
        }

         // Generate links to the full article
         foreach ($articles as &$article) {
            $article->link = Route::_('index.php?option=com_content&view=article&id=' . $article->id . '&catid=' . $article->catid);
        }

        return $articles;
    }
}
?>

