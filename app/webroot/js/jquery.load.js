﻿/*
* jquery.load.js
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

jQuery(document).ready(function() {

    // textlimiter for reports
    jQuery('textarea#ReportInstructionText, textarea#ReportActivityText, textarea#ReportSchoolText').textlimiter({
        maxCharsPerRow : 105,
        maxRows : 10,
        text : '%r rows or %c characters left'
    });

});