<?php

class DateTimeComponent extends Component
{
    
    public function mkdate($day, $month, $year)
    {
        return mktime(0, 0, 0, $month, $day, $year);
    }
    
    public function get_date($year, $week, $day)
    {
        return date('Y-m-d', strtotime($year . 'W' . str_pad($week, 2 ,'0', STR_PAD_LEFT) . $day));
    }
    
    public function get_report_number($training_start, $year, $week)
    {
        return
            $this->diff('W',
                $training_start,
                $year . 'W' . str_pad($week, 2 ,'0', STR_PAD_LEFT)
            ) + 1;
    }

    public function diff($interval, $datefrom, $dateto, $using_timestamps = false)
    {
        /*
          $interval can be:
          yyyy - Number of full years
          q - Number of full quarters
          m - Number of full months
          y - Difference between day numbers
          (eg 1st Jan 2004 is '1', the first day. 2nd Feb 2003 is '33'. The datediff is '-32'.)
          d - Number of full days
          w - Number of full weekdays
          W - Number of full weeks
          h - Number of full hours
          n - Number of full minutes
          s - Number of full seconds (default)
         */

        if (!$using_timestamps)
        {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        }
        $difference = $dateto - $datefrom; // Difference in seconds

        switch ($interval)
        {

            case 'yyyy': // Number of full years

                $years_difference = floor($difference / 31536000);
                if (mktime(date('H', $datefrom), date('i', $datefrom), date('s', $datefrom), date('n', $datefrom), date('j', $datefrom), date('Y', $datefrom) + $years_difference) > $dateto)
                {
                    $years_difference--;
                }
                if (mktime(date('H', $dateto), date('i', $dateto), date('s', $dateto), date('n', $dateto), date('j', $dateto), date('Y', $dateto) - ($years_difference + 1)) > $datefrom)
                {
                    $years_difference++;
                }
                $datediff = $years_difference;
                break;

            case 'q': // Number of full quarters

                $quarters_difference = floor($difference / 8035200);
                while (mktime(date('H', $datefrom), date('i', $datefrom), date('s', $datefrom), date('n', $datefrom) + ($quarters_difference * 3), date('j', $dateto), date('Y', $datefrom)) < $dateto)
                {
                    $months_difference++;
                }
                $quarters_difference--;
                $datediff = $quarters_difference;
                break;

            case 'm': // Number of full months

                $months_difference = floor($difference / 2678400);
                while (mktime(date('H', $datefrom), date('i', $datefrom), date('s', $datefrom), date('n', $datefrom) + ($months_difference), date('j', $dateto), date('Y', $datefrom)) < $dateto)
                {
                    $months_difference++;
                }
                $months_difference--;
                $datediff = $months_difference;
                break;

            case 'y': // Difference between day numbers

                $datediff = date('z', $dateto) - date('z', $datefrom);
                break;

            case 'd': // Number of full days

                $datediff = floor($difference / 86400);
                break;

            case 'w': // Number of full weekdays

                $days_difference = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7); // Complete weeks
                $first_day = date('w', $datefrom);
                $days_remainder = floor($days_difference % 7);
                $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
                if ($odd_days > 7)
                { // Sunday
                    $days_remainder--;
                }
                if ($odd_days > 6)
                { // Saturday
                    $days_remainder--;
                }
                $datediff = ($weeks_difference * 5) + $days_remainder;
                break;

            case 'W': // Number of full weeks

                $datediff = floor($difference / 604800);
                break;

            case 'h': // Number of full hours

                $datediff = floor($difference / 3600);
                break;

            case 'n': // Number of full minutes

                $datediff = floor($difference / 60);
                break;

            default: // Number of full seconds (default)

                $datediff = $difference;
                break;
        }

        return $datediff;
    }

}

?>