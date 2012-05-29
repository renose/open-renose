<?php
/*
 * reNoseDateHelper.php
 *
 * Copyright (c) 2011-2012 open reNose team <info at renose.de>.
 * Simon Wörner, Patrick Hafner and Daniel Greiner.
 *
 * This file is part of open reNose.
 *
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */

App::uses('TimeHelper', 'View/Helper');

class reNoseDateHelper extends TimeHelper {

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    /*
     * calculates Monday of the week from year and week (useful for reports)
     *
     * @param int $year
     * @param int $week
     * @param int $startDate - training start to avoid returning monday, when training starts e.g. wednesday.
     *
     * @return string $date - "d.m.Y"
     */
    public function getMondayByYearAndWeek($year, $week, $startDate = NULL) {
        $startDate = $this->toUnix($startDate);
        $mondayThisWeek = date('d.m.Y', $mondayThisWeekUnix = strtotime('Monday this week', strtotime($year.'W'.$week)));
        if($startDate > $mondayThisWeekUnix) {
            return $this->format('d.m.Y', $startDate);
        } else {
            return $mondayThisWeek;
        }
    }

    /*
     * calculates Friday of the week from year and week (useful for reports)
     *
     * @param int $year
     * @param int $week
     * @param int $endDate - training end to avoid returning friday, when training ends e.g. wednesday.
     *
     * @return string $date - "d.m.Y"
     */
    public function getFridayByYearAndWeek($year, $week, $endDate = NULL) {
        $endDate = $this->toUnix($endDate);
        $fridayThisWeek = date('d.m.Y', $fridayThisWeekUnix = strtotime('Friday this week', strtotime($year.'W'.$week)));
        if($endDate < $fridayThisWeekUnix) {
            return $this->format('d.m.Y', $endDate);
        } else {
            return $fridayThisWeek;
        }
    }



}