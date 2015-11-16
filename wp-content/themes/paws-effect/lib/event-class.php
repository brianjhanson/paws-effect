<?php 
  class EventTimberPost extends TimberPost {

    public function get_time($field) {
      if (have_rows($field, $this->ID)) {
        $timeArray = [];
        while (have_rows($field, $this->ID)) {
          the_row();

          $timeArray['hours'] = get_sub_field('hour', $this->ID);
          $timeArray['minutes'] = get_sub_field('minute', $this->ID) != '00' ? ':' . get_sub_field('minute', $this->ID) : '';
          $timeArray['period'] = get_sub_field('period', $this->ID);
        }

        return $timeArray;
      }
    }

    public function time_string($field) {
      $time = $this->get_time($field);
      if (!empty($time)) {
        return $time['hours'] . $time['minutes'] . ' ' . $time['period'];
      }
    }

    public function event_time() {
      $start_time = $this->time_string('start_time');
      $end_time = $this->time_string('end_time');

      if ($end_time) {
        return $start_time . ' — ' . $end_time;
      }

      return $start_time;
    }

    public function event_date($field = 'event_date') {
      return date_create_from_format('Ymd', get_field($field, $this->ID));
    }

    public function end_date($format = 'Ymd') {
      if (get_field('end_date', $this->ID)) {
        return $this->event_date('end_date')->format($format);
      }
      return false;
    }

    public function start_date($format = 'Ymd') {
      return $this->event_date()->format($format);
    }

    public function has_passed() {
      $today = date_create('now', new DateTimeZone('America/Chicago'));
      $date = $this->event_date();
      return $today->format('Ymd') > $date->format('Ymd');
    }

  }