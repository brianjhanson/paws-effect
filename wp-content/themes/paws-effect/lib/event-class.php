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

    public function event_date() {
      return date_create_from_format('Ymd', get_field('event_date', $this->ID));
    }
  }