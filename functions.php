<?php
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('home-style', get_template_directory_uri() . '/css/home.css');
  wp_enqueue_style('hamburger-style', get_template_directory_uri() . '/css/hamburger.css');
  wp_enqueue_style('calendar-style', get_template_directory_uri() . '/css/calendar.css');
  wp_enqueue_script('hamburger-script', get_template_directory_uri() . '/js/hamburger.js', array(), null, true);
  wp_enqueue_script('slideshow-script', get_template_directory_uri() . '/js/slideshow.js', array(), null, true);
  wp_enqueue_script('fullcalendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js', [], null, true);
}

add_action('admin_enqueue_scripts', function ($hook) {
  if ($hook === 'toplevel_page_clinic-calendar') {
    wp_enqueue_script('fullcalendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js', [], null, true);
    wp_enqueue_style('fullcalendar-css', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.css', [], null);
    wp_localize_script('fullcalendar-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
  }
});

add_action('admin_menu', function () {
  add_menu_page('休診日管理', '休診日管理', 'manage_options', 'clinic-calendar', 'clinic_calendar_admin_page');
});

function clinic_calendar_admin_page()
{
?>
  <div class="wrap">
    <h1>休診日管理</h1>
    <div id="calendar"></div>
    <button id="save-closed-days" class="button button-primary">保存</button>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let closedDays = <?php echo json_encode(json_decode(get_option('clinic_closed_days', '[]'), true)); ?>;
      let tempClosedDays = [...closedDays];
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ja',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: ''
        },
        showNonCurrentDates: false,
        selectable: true,
        dateClick: function(info) {
          if (tempClosedDays.includes(info.dateStr)) {
            tempClosedDays = tempClosedDays.filter(date => date !== info.dateStr);
            info.dayEl.style.backgroundColor = 'lightgreen';
          } else {
            tempClosedDays.push(info.dateStr);
            info.dayEl.style.backgroundColor = 'lightcoral';
          }
        },
        events: closedDays.map(date => ({
          start: date,
          allDay: true,
          display: 'background',
          backgroundColor: 'lightcoral'
        }))
      });
      calendar.render();

      document.getElementById('save-closed-days').addEventListener('click', function() {
        fetch(ajax_object.ajax_url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            action: 'save_closed_days',
            closedDays: JSON.stringify(tempClosedDays)
          })
        }).then(response => response.json()).then(data => {
          if (data.success) {
            alert('休診日が保存されました。');
            closedDays = [...tempClosedDays];
          } else {
            alert('休診日の保存に失敗しました。');
          }
        });
      });
    });
  </script>
<?php
}

add_action('wp_ajax_save_closed_days', function () {
  if (!current_user_can('manage_options')) {
    wp_send_json_error(['message' => '権限がありません。']);
  }

  $closed_days = isset($_POST['closedDays']) ? json_decode(stripslashes($_POST['closedDays']), true) : null;

  if ($closed_days === null || !is_array($closed_days)) {
    wp_send_json_error(['message' => '無効なデータ形式です。']);
  }

  update_option('clinic_closed_days', json_encode($closed_days));
  wp_send_json_success(['message' => '保存が完了しました。']);
});

add_shortcode('clinic_calendar', function ($atts) {
  $atts = shortcode_atts(array(
    'next_month' => 'false',
  ), $atts, 'clinic_calendar');

  $closed_days = json_decode(get_option('clinic_closed_days', '[]'), true);
  ob_start();
?>
  <div id="frontend-calendar-<?php echo $atts['next_month'] === 'true' ? 'next' : 'current'; ?>"></div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('frontend-calendar-<?php echo $atts['next_month'] === 'true' ? 'next' : 'current'; ?>');
      const closedDays = <?php echo json_encode($closed_days); ?>;
      const initialDate = <?php echo $atts['next_month'] === 'true' ? 'new Date(new Date().setMonth(new Date().getMonth() + 1))' : 'new Date()'; ?>;
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ja',
        headerToolbar: {
          left: '',
          center: 'title',
          right: ''
        },
        initialDate: initialDate,
        showNonCurrentDates: false,
        events: closedDays.map(date => ({
          start: date,
          allDay: true,
          display: 'background',
          backgroundColor: 'lightcoral'
        }))
      });
      calendar.render();
    });
  </script>
<?php
  return ob_get_clean();
});

function generate_calendar($month, $year, $closed_days)
{
  $days_of_week = ['日', '月', '火', '水', '木', '金', '土'];
  $first_day_of_month = mktime(0, 0, 0, $month, 1, $year);
  $number_days = date('t', $first_day_of_month);
  $date_components = getdate($first_day_of_month);
  $day_of_week = $date_components['wday'];

  $calendar = "<table class='calendar'>";
  $calendar .= "<tr>";

  // 曜日ヘッダーを表示
  foreach ($days_of_week as $day) {
    $calendar .= "<th class='calendar-header'>$day</th>";
  }

  $calendar .= "</tr><tr>";

  // カレンダー開始用スペースを調整
  if ($day_of_week > 0) {
    for ($k = 0; $k < $day_of_week; $k++) {
      $calendar .= "<td class='calendar-empty'></td>";
    }
  }

  $current_day = 1;

  // 日付を生成
  while ($current_day <= $number_days) {
    if ($day_of_week == 7) {
      $day_of_week = 0;
      $calendar .= "</tr><tr>";
    }

    $date_str = sprintf('%04d-%02d-%02d', $year, $month, $current_day);
    $class = in_array($date_str, $closed_days) ? 'holiday' : 'calendar-day';
    $calendar .= "<td><p class='$class'>$current_day</p></>";

    $current_day++;
    $day_of_week++;
  }

  // 最後の行を埋める
  if ($day_of_week != 7) {
    $remaining_days = 7 - $day_of_week;
    for ($i = 0; $i < $remaining_days; $i++) {
      $calendar .= "<td class='calendar-empty'></td>";
    }
  }

  $calendar .= "</tr>";
  $calendar .= "</table>";

  return $calendar;
}
?>