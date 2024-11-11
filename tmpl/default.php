<?php
defined('_JEXEC') or die;
?>

<head>
    <style>
        /* Container for the grid */
        .article-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            /* Creates a responsive grid */
            gap: 20px;
            margin: 20px;
        }

        /* Individual article card style */
        .article-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Hover effect for the article card */
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Title styling */
        .article-card .article-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s ease;
        }

        /* Hover effect on title */
        .article-card .article-title:hover {
            color: #3498db;
        }

        /* Date styling */
        .article-card .article-date {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        /* Intro text */
        .article-card .intro-text {
            font-size: 16px;
            color: #2c3e50;
            line-height: 1.5;
            margin-top: 10px;
        }

        /* Add spacing at the bottom of the intro text */
        .article-card .intro-text:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<div class="article-grid">
    <!-- fetch the articles and show them in grid format -->
    <?php foreach ($articles as $article): ?>
        <div class="article-card">

        <!-- link to each specific article  -->
            <a href="<?php echo $article->link; ?>" class="article-title">

                <?php echo $article->title; ?>
            </a>
            <div class="article-date">
                <!-- format the date in 'Date Month Year' -->
                <?php echo JHtml::_('date', $article->created, JText::_('DATE_FORMAT_LC3')); ?>
            </div>

            <!-- show introtext based on settings -->
            <?php if ($params->get('show_introtext', 1) && !empty($article->introtext)): ?>
                <div class="intro-text">
                    <?php echo $article->introtext; ?>
                </div>
            <?php endif; ?>

        
        </div>
    <?php endforeach; ?>
</div>