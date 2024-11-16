<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        // Init Models
    }

    public function index()
    {
        // Set Greetings
        $seasonalGreetingA = array();
        $seasonalGreetingA[] = array('dayBegin' => 30, 'monthBegin' => 12, 'dayEnd' => 31, 'monthEnd' => 12, 'text' => 'Happy New Year');
        $seasonalGreetingA[] = array('dayBegin' => 1, 'monthBegin' => 1, 'dayEnd' => 2, 'monthEnd' => 1, 'text' => 'Happy New Year');

        $dateGreetingA = array();
        $dateGreetingA[] = array('date' => date('Y') . '-03-11', 'text' => 'Happy Birthday');

        $timeGreetingA = array();
        $timeGreetingA[] = array('timeBegin' => 0, 'timeEnd' => 5, 'text' => 'Good night');
        $timeGreetingA[] = array('timeBegin' => 5, 'timeEnd' => 11, 'text' => 'Good morning');
        $timeGreetingA[] = array('timeBegin' => 11, 'timeEnd' => 18, 'text' => 'Good afternoon');
        $timeGreetingA[] = array('timeBegin' => 18, 'timeEnd' => 24, 'text' => 'Good evening');

        $standardGreetingA = array();
        $standardGreetingA[] = array('text' => 'Hello');
        $standardGreetingA[] = array('text' => 'Howdy');
        $standardGreetingA[] = array('text' => 'Hi');

        $txtGreeting = '';

        $date = date('Y-m-d');
        if ($txtGreeting == '')
            if (count($dateGreetingA) > 0)
                foreach ($dateGreetingA as $dgA) {
                    if ($dgA['date'] == $date) {
                        $txtGreeting = $dgA['text'];
                        break;
                    }
                }

        $d = (int)date('d');
        $m = (int)date('m');
        if ($txtGreeting == '')
            if (count($seasonalGreetingA) > 0)
                foreach ($seasonalGreetingA as $sgA) {
                    $d1 = $sgA['dayBegin'];
                    $m1 = $sgA['monthBegin'];

                    $d2 = $sgA['dayEnd'];
                    $m2 = $sgA['monthEnd'];

                    //echo $m1.' >= '.$m.' <= '.$m2.'<br />';
                    if ($m >= $m1 and $m <= $m2)
                        if ($d >= $d1 and $d <= $d2)
                            $txtGreeting = $sgA['text'];
                }

        $time = (int)date('H');
        if ($txtGreeting == '')
            if (count($timeGreetingA) > 0)
                foreach ($timeGreetingA as $tgA) {
                    if ($time >= $tgA['timeBegin'] and $time <= $tgA['timeEnd']) {
                        $txtGreeting = $tgA['text'];
                        break;
                    }
                }

        if ($txtGreeting == '')
            if (count($standardGreetingA) > 0) {
                $ind = rand(0, count($standardGreetingA) - 1);
                if (isset($standardGreetingA[$ind])) $txtGreeting = $standardGreetingA[$ind]['text'];
            }
        $data = [
            'txtgreeting' => $txtGreeting,
            'title' => 'Home - ' . $this->systemName,
            'agent' => $this->request->getUserAgent()
        ];
        return view('dashboard/home/index', $data);
    }
}
