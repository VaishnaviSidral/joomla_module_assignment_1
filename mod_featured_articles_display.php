<?php
defined('_JEXEC') or die;

// Include the helper class
require_once __DIR__ . '/src/Helper/ArticlesHelper.php';

// Get the articles using the helper function
$articles = ModFeaturedArticlesDisplay\Helper\ArticlesHelper::getArticles($params);

// If no articles are found, display a message
if (empty($articles)) {
    echo '<p>No featured articles found.</p>';
} else {
    // Load the layout file
    require JModuleHelper::getLayoutPath('mod_featured_articles_display', $params->get('layout', 'default'));
}
?>
