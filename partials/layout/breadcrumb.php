<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (isset($entries) && is_array($entries)) : ?>
<ol class="breadcrumb clearfix <?php
    if ( ! is_visible_breadcrumb()) echo "hidden";
?>" itemscope itemtype="http://schema.org/BreadcrumbList">

<?php foreach ($entries as $i=>$entry) : ?>

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"<?php
        if ($i==count($entries)-1) echo ' class="active"';
    ?>>

    <?php if ($i!=count($entries)-1 && isset($entry['url'])) : ?>
        <a href="<?php echo $entry['url']; ?>" itemprop="item" typeof="WebPage">
    <?php endif; ?>

        <span itemprop="name"><?php echo $entry['title']; ?></span>

    <?php if ($i!=count($entries)-1 && isset($entry['url'])) : ?>
        </a>
    <?php endif; ?>

        <meta itemprop="position" content="<?php echo $i+1; ?>">

    </li>

<?php endforeach; ?>

</ol>
<?php endif; ?>
