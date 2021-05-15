<?php
/**
 * Calender functionalities
 */
class Time extends Manager
{
    use View;
    use Format;

    public $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    public $months = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
    
    public function displayMyCalendar($targets, $currentYear)
    {
        $dates = $this->getCalendar($currentYear);
        $dates = current($dates);
        $events = $this->getEvents($targets, $currentYear);

        $this->displayCalendar($currentYear, $dates, new Time, $events);
    }

    private function getEvents($targets, $year){

        $events = $this->selectObject($targets, EVENTS_TABLE, YEAR_DATE_KEY, $year);

        /*
         *  Ce que je veux $r[TIMESTAMP][id] = title;
         */
        foreach ($events as $e) {
            $r[strtotime($e->date)][$e->event_id] = $e->title;
        }
        return $r;
    }
}
