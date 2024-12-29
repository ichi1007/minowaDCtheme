<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
    if (is_single()) {
      the_title();
      echo ' | ';
    }
    echo get_bloginfo("name");
    ?>
  </title>
  <meta name="description" content="蓑輪歯科クリニックの公式サイトです" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
  <?php wp_head(); ?>
</head>

<body>
  <header>
    <a href="/" class="header-logo">
      <h1 class="header-title">蓑輪歯科クリニック</h1>
      <p class="header-subtitle">Minowa dental clinic</p>
    </a>
    <div><img src="<?php echo get_template_directory_uri(); ?>/svg/menu.svg" alt="ハンバーガーメニュー" id="menu-icon"></div>
    <nav class="header-nav">
      <img src="<?php echo get_template_directory_uri(); ?>/svg/close.svg" alt="閉じるボタン" id="close-icon" style="display:none;">
      <ul>
        <li><a href="#notice">お知らせ</a></li>
        <li><a href="#about">院長挨拶</a></li>
        <li><a href="#feature">当院の特徴</a></li>
        <li><a href="#menu">診療案内</a></li>
        <li><a href="#info">当院について</a></li>
        <li><a href="#access">アクセス</a></li>
      </ul>
    </nav>
  </header>