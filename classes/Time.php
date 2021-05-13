<?php
/**
 * Calender functionalities
 */
class Time extends Account
{
    public $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    public $months = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
    
    function getEvents($year){
        global $DB;
        $req = $DB->query('SELECT event_id,title,date FROM events WHERE YEAR(date)='.$year);
        $r = array();
        /*
         *  Ce que je veux $r[TIMESTAMP][id] = title;
         */
        while ($d = $req->fetch(PDO::FETCH_OBJ)){
            $r[strtotime($d->date)][$d->event_id] = $d->title;
        }
        return $r;
    }

    /**
     * Get array calendar of a specified year
     * @param string $year The year of the calendar you want to generate
     * @return array Return Format $r[$y][$m][$d]
     */
    function getAll($year){
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
