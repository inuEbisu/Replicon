<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <?php if ($this->options->copyrightInfo): ?>
        <span id="copyright">&copy; <?php echo date('Y'); ?>
        <a href="<?php $this->options->siteUrl(); ?>"><?php echo $this->options->copyrightInfo; ?></a>.</span>
    <?php endif ?>
    <span id="power">Powered by <a href="https://typecho.org">Typecho</a> & <a href="https://github.com/inuEbisu/Replicon">Replicon</a>.</span>
    <br>
    <?php if ($this->options->beianInfo): ?>
        <span id="beian"><a href="https://beian.miit.gov.cn/"><?php echo $this->options->beianInfo; ?></a></span>
    <?php endif ?>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
