<?php
/*
 * PdfGeneratorComponent.php
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
 *
 */

class PdfGeneratorComponent extends Component {

    public function mergeTextFromArray(array $data, $fieldName) {
        $text = '';
        $sizeOfData = sizeof($data);
        $counter = 0;

        foreach($data as $row) {
            $counter++;
            $text.=$row[$fieldName];
            if($sizeOfData != $counter) $text.= "\n";
        }
        return $text;
    }

    public function prepareTextWithTitleAndText(array $data, $titleField, $textField) {
        $text = '';
        $sizeOfData = sizeof($data);
        $counter = 0;

        foreach($data as $row) {
            $counter++;
            $text.= "<strong>{$row[$titleField]}</strong>\n{$row[$textField]}";
            if ($sizeOfData != $counter) $text.="\n\n";
        }
        return $text;
    }

    public function prepareSchoolTextWithTitleAndText(array $data, $titleField, $textField) {
        $text = '';
        $sizeOfData = sizeof($data);
        $counter = 0;

        foreach($data as $row) {
            $counter++;
            if($row[$textField]) {
                $text.= "<strong>{$row[$titleField]}:</strong> {$row[$textField]}";
            } else {
                $text.= "{$row[$titleField]}";
            }
            if ($sizeOfData != $counter) $text.="\n";
        }
        return $text;
    }



}