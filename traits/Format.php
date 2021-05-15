<?php
trait Format {
    /**
    *  function formattage de la date
    *
    * @param  $date
    * @return date 
    */
    function formatDate($date)
    {
        $date = date("F j, Y, g:i a", strtotime($date));
        return $date;
    }

    /**
     * Get array calendar of a specified year
     * @param string $year The year of the calendar you want to generate
     * @return array Return Format $r[$y][$m][$d]
     */
     private function getCalendar($year){
        $r = array();
        $date = new DateTime($year.'-01-01');

        while($date->format('Y') <= $year){
            //$r = [ANNEE] [MOIS] [JOUR] = Jour de la semaine
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0', '7', $date->format('w'));
            $r[$y][$m][$d] = $w;
            $date->add(new DateInterval('P1D'));
        }

        return $r;
    }
}
