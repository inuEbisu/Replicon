<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
    $this->need('toc.php');
    $originalContent = $this->content;
    $this->content = addIDsToHeadings($originalContent);
    $this->toc = generateToc($this->content);
?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <?php postMeta($this, 'post'); ?>
        <div class="post-content <?php if ($this->options->prismjsLineNumbers) echo "line-numbers";?>" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>

    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
