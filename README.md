# Replicon
Replicon 是一款基于 Typecho 默认主题 [Replica](https://github.com/typecho/typecho/tree/master/usr/themes/default) 开发的博客主题。设计中融入了犬戎个人的审美偏好，希望能在简约现代的基础上提升阅读体验。

目前正在犬戎的狗窝 [犬窝闲谭](https://inuebisu.cn) 上运行。

## 特性
### 字体选择

<table>
  <thead>
    <tr>
      <th></th>
      <th>西文字体</th>
      <th>中文字体</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><b>衬线字体</b></td>
      <td>Noto Serif SC</td>
      <td>Noto Serif SC</td>
    </tr>
    <tr>
      <td><b>行内代码字体</b></td>
      <td>JetBrains Mono NL</td>
      <td>霞鹜文楷屏幕阅读版</td>
    </tr>
    <tr>
      <td><b>代码块字体</b></td>
      <td>JetBrains Mono NL</td>
      <td>霞鹜文楷屏幕阅读版</td>
    </tr>
  </tbody>
</table>

> 为什么本地托管 `JetBrains Mono NL` 和 `霞鹜文楷屏幕阅读版` 两个字体？

我搜寻互联网，没有找到它们的 CDN。:(

（不过如果去掉「NL」以及「屏幕阅读版」的话就有了。不过个人偏好是无法忍受 coding 字体中使用 ligature 特性，以及屏幕阅读版的字重更适合。）

总而言之，如果有能用的，请告诉我！

### 手 K 样式参数

为每个细节精心优化，确保整体风格协调统一。

### 中西文排版
自动处理中西文混排的间隙问题：
- 无空格时自动渲染 1/6 字宽间距。
- 有空格时自动调整为空格 1/5 字宽。

### 自动目录树
Replicon 支持自动生成目录树，可展示在侧边栏跟随您的阅读。点击目录树中任意一个标题即可平滑滚动至对应位置。

### 代码高亮
Replicon 使用了 Prism.js 进行代码高亮；同时在官方 Coy 主题的基础上自定义了一些样式，融入主题整体风格。

提示：项目中自带的 Prism.js 是犬戎在官网选择了 Minified Version 与 Coy 主题并勾选了自己常用的语言与插件之后下载的源代码。如果有其他需求，可以在 Prism.js 官网选择 Coy 主题并按需自定义，下载后将项目自带的替换掉就可以了 :D

### 打印优化
Replicon 内置针对打印的样式优化功能，在文章页面按下 `Ctrl + P` 即可轻松生成适合上交作业与纸质阅读的 PDF 文档：
- 自动隐藏导航栏与侧边栏。
- 移除 `<pre>` 标签的高度限制，确保代码完整展示。
  - 仍保留代码的宽度限制，请注意避免单行代码过长。
- 自动调整标题大小、间距等细节样式。

### 友链
生成带头像与描述的友链卡片：
```html
<div class="friend-container">
    <a class="friend-card" href="https://inuebisu.cn">
        <img class="friend-avatar" src="https://inuebisu.cn/avatar/kari_512.png" alt="犬窝闲谭">
        <div class="friend-info">
            <p class="friend-name">犬窝闲谭</p>
            <p class="friend-description">犬戎的狗窝！</p>
        </div>
    </a>

    <a class="friend-card" href="https://inuebisu.cn">
        <img class="friend-avatar" src="https://inuebisu.cn/avatar/default_avatar.png" alt="另一位">
        <div class="friend-info">
            <p class="friend-name">另一位</p>
            <p class="friend-description">神秘人</p>
        </div>
    </a>

    <a class="friend-card" href="https://inuebisu.cn">
        <img class="friend-avatar" src="https://inuebisu.cn/avatar/default_avatar.png" alt="第三位">
        <div class="friend-info">
            <p class="friend-name">第三位</p>
            <p class="friend-description">是谁呢</p>
        </div>
    </a>
</div>
```

## 安装
将 Replicon 源代码上传至 `/usr/themes` 主题目录，在 Typecho 后台的外观设置中启用 Replicon 即可。可根据个人需求调整设置。

## 示例
可以访问 [犬窝闲谭](https://inuebisu.cn) 体验主题的实际效果。:P

## 贡献
欢迎任何形式的贡献！无论是报告错误、提交功能请求、修复问题还是改进文档，犬戎汪都非常感谢您的帮助！

## License
This project is licensed under the GNU General Public License v2.0 (GPLv2).
