<?php
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    if ($_FILES["file"]["name"] == 'siteconfig.csv' || $_FILES["file"]["name"] == 'sitemenu.csv') {
        if (($handle = fopen($_FILES["file"]["tmp_name"], "r")) !== FALSE) {
            $i = 0;
            $string = '';
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($i != 0) {
                    if ($_FILES["file"]["name"] == 'siteconfig.csv') {
                        if ($data[0] == 'price_select_atntn') $data[1] = htmlspecialchars($data[1]);
                        $string .= ("UPDATE siteconfig SET CONFIGVALUE =" . "'" . $data[1] . "'". ' WHERE CONFIGKEY = ' . "'" . $data[0] . "'". ';') .  '<br />';
                    } else if ($_FILES["file"]["name"] == 'sitemenu.csv') {
                        $end = (count($data) - 1 == $data[0]) ? ';' : ',';
                        $string .=
                            '(' . $data[0] . ',' .
                            "'" . $data[1] . "'" . ',' .
                            "'" . $data[2] . "'" . ',' .
                            "'" . $data[3] . "'" . ',' .
                            "'" . $data[4] . "'" . ',' .
                            "'" . $data[5] . "'" . ',' .
                            "'" . $data[6] . "'" . ',' .
                            "'" . $data[7] . "'" . ',' .
                            "'" . $data[8] . "'" . ')' . $end . '<br />';
                    } else {
                        echo 'Bớt làm xàm, làm 2 file siteconfig.csv hoặc sitemenu.csv thôi !!!';
                    }
                }
                $i++;
            }
            fclose($handle);
            echo($string);
        }
    } else {
        echo 'Bớt làm xàm';
    }

}