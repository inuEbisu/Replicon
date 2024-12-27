<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'logoUrl',
        null,
        null,
        _t('站点 LOGO 地址'),
        _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO')
    );

    $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox(
        'sidebarBlock',
        [
            'ShowTOC'            => _t('显示文章目录'),
            'ShowRecentPosts'    => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory'       => _t('显示分类'),
            'ShowArchive'        => _t('显示归档'),
            'ShowOther'          => _t('显示其它杂项')
        ],
        ['ShowTOC', 'ShowCategory', 'ShowArchive'],
        _t('侧边栏显示')
    );

    $copyrightInfo = new \Typecho\Widget\Helper\Form\Element\Text(
        'copyrightInfo',
        null,
        null,
        _t('页脚版权信息'),
        _t('在这里填入你的大名（将在页脚显示为 "&copy; 今年年份 你的大名"）')
    );

    $beianInfo = new \Typecho\Widget\Helper\Form\Element\Text(
        'beianInfo',
        null,
        null,
        _t('页脚备案信息'),
        _t('在这里填入你的备案号（将在页脚显示；为空则不显示）')
    );

    $prismjsLineNumbers = new \Typecho\Widget\Helper\Form\Element\Radio(
        'prismjsLineNumbers',
        [
            true => _t('启用'),
            false => _t('禁用')
        ],
        false,
        _t('Prism.js 代码块行数显示'),
        _t('需要您的 Prism.js 安装了行数显示插件。<br>该选项对打印功能无效，打印时始终不显示行数')
    );

    $form->addInput($logoUrl->addRule('url', _t('请填写一个合法的URL地址')));
    $form->addInput($sidebarBlock->multiMode());
    $form->addInput($copyrightInfo);
    $form->addInput($beianInfo);
    $form->addInput($prismjsLineNumbers);
}

function postMeta(
    \Widget\Archive $archive,
    string $metaType = 'archive'
)
{
    $titleTag = $metaType == 'archive' ? 'h2' : 'h1';
?>
    <<?php echo $titleTag ?> class="post-title" itemprop="name headline">
        <a itemprop="url"
           href="<?php $archive->permalink() ?>"><?php $archive->title() ?></a>
    </<?php echo $titleTag ?>>
    <ul class="post-meta">
        <li>
            <time datetime="<?php $archive->date('c'); ?>" itemprop="datePublished"><?php $archive->date(); ?></time>
        </li>
        <?php if ($metaType != 'page'): ?>
            <li><?php $archive->category(', ', true, _t('無')); ?></li>
            <li><?php $archive->tags(', ', true, _t('無')); ?></li>
        <?php endif; ?>
    </ul>
<?php
}

/*
function themeFields($layout)
{
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'logoUrl',
        null,
        null,
        _t('站点LOGO地址'),
        _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO')
    );
    $layout->addItem($logoUrl);
}
*/
