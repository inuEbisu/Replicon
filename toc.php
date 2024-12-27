<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 解析内容、为标题元素添加唯一的ID
 *
 * @param string $content 原始内容
 * @return string 更新后的内容
 */
function addIDsToHeadings($content) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
    libxml_clear_errors();

    $idCounts = [];
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

    foreach ($nodes as $node) {
        $text = trim($node->textContent);
        if (empty($text)) continue;

        // 生成唯一 ID
        if (!$node->hasAttribute('id')) {
            // 使用标题文本作为基础ID
            $baseId = preg_replace('/\s+/', '-', $text);
            $baseId = preg_replace('/[^\p{L}\p{N}-]+/u', '', $baseId);
            $id = $baseId;

            // 若需要，则加上计数器
            if (isset($idCounts[$baseId])) {
                $idCounts[$baseId]++;
                $id .= '-' . $idCounts[$baseId];
            } else {
                $idCounts[$baseId] = 1;
            }

            $node->setAttribute('id', $id);
        }
    }

    $body = $dom->getElementsByTagName('body')->item(0);
    $updatedContent = '';
    if (!empty($body->childNodes)) {
        foreach ($body->childNodes as $child) {
            $updatedContent .= $dom->saveHTML($child);
        }
    }

    return $updatedContent;
}

/**
 * 从内容中提取标题信息
 *
 * @param string $content 已解析并添加ID的内容
 * @return array 标题列表，每个标题包含级别、标题文本和ID
 */
function extractHeadings($content) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
    libxml_clear_errors();

    $headings = [];
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

    foreach ($nodes as $node) {
        $text = trim($node->textContent);
        if (empty($text)) continue;

        $headings[] = [
            'level' => intval(substr($node->tagName, 1)),
            'title' => $text,
            'id' => $node->getAttribute('id')
        ];
    }

    return $headings;
}

/**
 * 通过标题列表生成目录（TOC）
 *
 * @param array $headings 标题列表
 * @return string 生成的TOC HTML
 */
function generateTocByHeadings($headings) {
    if (empty($headings)) return '';

    $toc = '<ul class="widget-list">';
    $prevLevel = $headings[0]['level'];

    foreach ($headings as $heading) {
        $level = $heading['level'];
        if ($level > $prevLevel) {
            $toc .= '<ul>';
        } elseif ($level < $prevLevel) {
            $toc .= str_repeat('</ul>', $prevLevel - $level);
        }
        $toc .= '<li class="toc-level-' . $level . '"><a href="#' . htmlspecialchars($heading['id'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($heading['title'], ENT_QUOTES, 'UTF-8') . '</a></li>';
        $prevLevel = $level;
    }
    $toc .= str_repeat('</ul>', $prevLevel - $headings[0]['level']) . '</ul>';

    return $toc;
}

/**
 * 根据内容生成目录（TOC）
 *
 * @param array $modifiedContent 加过ID的内容
 * @return string 生成的TOC HTML
 */

function generateToc($modifiedContent) {
    $headings = extractHeadings($modifiedContent);
    $toc = generateTocByHeadings($headings);
    return $toc;
}