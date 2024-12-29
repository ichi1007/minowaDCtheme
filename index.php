<?php get_header(); ?>
<main>
  <!-- スライドショー -->
  <div class="home-slideshow">
    <img src="<?php echo get_template_directory_uri(); ?>/img/slideIMG/slide1.jpg" alt="Slide 1" class="active">
    <img src="<?php echo get_template_directory_uri(); ?>/img/slideIMG/slide2.jpg" alt="Slide 2">
    <img src="<?php echo get_template_directory_uri(); ?>/img/slideIMG/slide3.jpg" alt="Slide 3">
  </div>
  <!-- お知らせ -->
  <div class="news" id="notice">
    <div class="sec-title">
      <p>Notice</p>
      <h2>1.お知らせ</h2>
      <div class="sec-title-underbar"></div>
    </div>
    <ul class="news">
      <?php
      $posts = get_posts([
        'numberposts' => 3,
        'post_status' => 'publish',
      ]);

      foreach ($posts as $post) :
        setup_postdata($post);
      ?>
        <li>
          <p><?php echo get_the_date("Y.m.d", $post); ?></p>
          <a href="<?php echo get_permalink($post); ?>">
            <?php echo get_the_title($post); ?>
          </a>
        </li>
      <?php
      endforeach;
      wp_reset_postdata();
      ?>
    </ul>
  </div>
  <!-- 院長挨拶 -->
  <div class="about-headDoctor" id="about">
    <img src="<?php echo get_template_directory_uri(); ?>/img/headDoctor.jpg"
      alt="医院長画像" class="about-headDoctor-img">
    <div>
      <h3>院長　蓑輪 〇〇</h3>
      <p>こんにちは。当院のホームページをご覧いただきありがとうございます。院長の〇〇〇〇です。私たちのクリニックは、患者様一人ひとりに寄り添い、安心して治療を受けていただける環境づくりを大切にしています。「痛みが少なく、笑顔が増える歯科治療」をモットーに、虫歯治療や予防歯科を中心に地域医療へ貢献します。お気軽にご相談ください。</p>
    </div>
  </div>
  <!-- 特徴 -->
  <div class="feature" id="feature">
    <div class="featuer-top"></div>
    <div class="featuer-center">
      <div class="sec-title">
        <p>Feature</p>
        <h2>2.当院の特徴</h2>
        <div class="sec-title-underbar"></div>
      </div>
      <!-- 特徴リスト -->
      <ul>
        <!-- 01 -->
        <li class="feature-01">
          <div>
            <h3 class="feature-number">01</h3>
            <img src="<?php echo get_template_directory_uri(); ?>/img/examiningRoom.jpg"
              alt="休日診察" class="feature-img-01">
          </div>
          <div class="feature-text">
            <h3>休日診療</h3>
            <p>当院では、土曜・日曜の診療を承っております。平日にご来院が難しい方も、休日に診療を受けていただけますので、どうぞお気軽にご利用ください。</p>
          </div>
        </li>
        <!-- 02 -->
        <li class="feature-02">
          <div class="feature-text">
            <h3>休日診療</h3>
            <p>当院では、土曜・日曜の診療を承っております。平日にご来院が難しい方も、休日に診療を受けていただけますので、どうぞお気軽にご利用ください。</p>
          </div>
          <div>
            <h3 class="feature-number">02</h3>
            <img src="<?php echo get_template_directory_uri(); ?>/img/myNumberReader.jpg"
              alt="休日診察" class="feature-img-02">
          </div>
        </li>
      </ul>
    </div>
    <div class="featuer-bottom"></div>
  </div>
  <!-- 診察案内 -->
  <div class="medical-menu" id="menu">
    <div class="sec-title">
      <p>Menu</p>
      <h2>3.診療案内</h2>
      <div class="sec-title-underbar"></div>
    </div>
    <p class="medical-discription">当院では、一般歯科・小児歯科、矯正歯科それぞれの専門医師により、虫歯や歯周病治療だけでなく、矯正治療まで総合的に治療することが可能です。</p>
    <ul class="medical-text">
      <li>
        <img src="<?php echo get_template_directory_uri(); ?>/svg/toothIcon.svg"
          alt="笑った歯のイラスト" class="medical-icon">
        <p>審美歯科<br>ホワイトニング</p>
      </li>
      <li>
        <img src="<?php echo get_template_directory_uri(); ?>/svg/toothIcon.svg"
          alt="笑った歯のイラスト" class="medical-icon">
        <p>審美歯科<br>ホワイトニング</p>
      </li>
      <li>
        <img src="<?php echo get_template_directory_uri(); ?>/svg/toothIcon.svg"
          alt="笑った歯のイラスト" class="medical-icon">
        <p>審美歯科<br>ホワイトニング</p>
      </li>
      <li>
        <img src="<?php echo get_template_directory_uri(); ?>/svg/toothIcon.svg"
          alt="笑った歯のイラスト" class="medical-icon">
        <p>審美歯科<br>ホワイトニング</p>
      </li>
      <li>
        <img src="<?php echo get_template_directory_uri(); ?>/svg/toothIcon.svg"
          alt="笑った歯のイラスト" class="medical-icon">
        <p>審美歯科<br>ホワイトニング</p>
      </li>
    </ul>
  </div>
  <!-- 当院について -->
  <div class="info" id="info">
    <div class="info_top">
      <svg class="editorial"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none">
        <defs>
          <path id="gentle-wave"
            d="M-160 44c30 0 
          58-18 88-18s
          58 18 88 18 
          58-18 88-18 
          58 18 88 18
          v44h-352z" />
        </defs>
        <g class="parallax">
          <use xlink:href="#gentle-wave" x="50" y="0" fill="#FFA72C" />
          <use xlink:href="#gentle-wave" x="50" y="3" fill="#FFCD87" />
          <use xlink:href="#gentle-wave" x="50" y="6" fill="#FFB349" />
        </g>
      </svg>
    </div>
    <div class="info-center">
      <div class="sec-title">
        <p>Info</p>
        <h2>4.当院について</h2>
        <div class="sec-title-underbar"></div>
      </div>
      <div class="calendar-sec">
        <div class="info-calendar">
          <div id="frontend-calendar-current" class="current-month">
            <h2><?php echo date_i18n('Y'); ?>年<?php echo date_i18n('n', strtotime('month')); ?>月</h2>
            <div class="calendar">
              <?php
              $current_month = date('n');
              $current_year = date('Y');
              $closed_days = json_decode(get_option('clinic_closed_days', '[]'), true);
              echo generate_calendar($current_month, $current_year, $closed_days);
              ?>
            </div>
          </div>
          <div id="frontend-calendar-next" class="next-month">
            <h2><?php echo date_i18n('Y年n月', strtotime('+1 month')); ?></h2>
            <div class="calendar">
              <?php
              $next_month = date('n', strtotime('+1 month'));
              $next_year = date('Y', strtotime('+1 month'));
              $next_month_closed_days = array_filter($closed_days, function ($day) use ($next_year, $next_month) {
                $timestamp = strtotime($day);
                return date('Y', $timestamp) == $next_year && date('n', $timestamp) == $next_month;
              });
              echo generate_calendar($next_month, $next_year, $next_month_closed_days);
              ?>
            </div>
          </div>
        </div>
        <div class="info-holiday-description">
          <div></div>
          <p>休診日</p>
        </div>
      </div>
      <div class="info-schedule">
        <img src="<?php echo get_template_directory_uri(); ?>/svg/infoSchedule.svg" alt="スケジュール表">
      </div>
    </div>
    <div class=info_bottom>
      <svg class="editorial"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none">
        <defs>
          <path id="gentle-wave"
            d="M-160 44c30 0 
          58-18 88-18s
          58 18 88 18 
          58-18 88-18 
          58 18 88 18
          v44h-352z" />
        </defs>
        <g class="parallax">
          <use xlink:href="#gentle-wave" x="50" y="0" fill="#FFA72C" />
          <use xlink:href="#gentle-wave" x="50" y="3" fill="#FFCD87" />
          <use xlink:href="#gentle-wave" x="50" y="6" fill="#FFB349" />
        </g>
      </svg>
    </div>
  </div>
  <!-- アクセス -->
  <div class="access" id="access">
    <div class="sec-title">
      <p>Access</p>
      <h2>5.アクセス</h2>
      <div class="sec-title-underbar"></div>
    </div>
    <div class="access-text">
      <div class="access-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3253.311919133464!2d139.928268!3d35.37271899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60180ca56566457d%3A0x872a82126cadb5fe!2z6JOR6Lyq5q2v56eR44Kv44Oq44OL44OD44Kv!5e0!3m2!1sja!2sjp!4v1734542109823!5m2!1sja!2sjp"
          width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="clinic-info">
        <div class="clinic-info-text">
          <p>
            <a href="https://maps.app.goo.gl/B8GHJuEfNJ4BXRrK9" target="_blank">
              <img src="<?php echo get_template_directory_uri(); ?>/svg/location.svg" alt="">
              Google Map を開く
            </a>
          </p>
        </div>
        <div class="clinic-info-text">
          <p>
            <a href="mailto:info@minowadc.com">
              <img src="<?php echo get_template_directory_uri(); ?>/svg/mail.svg" alt="">
              info@minowadc.com
            </a>
          </p>
        </div>
        <div class="clinic-info-text">
          <p>
            <a href="tel:0438-37-8080">
              <img src="<?php echo get_template_directory_uri(); ?>/svg/phoneInTalk.svg" alt="">
              0438-37-8080
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>