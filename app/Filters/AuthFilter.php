<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Connect to the database and retrieve session token
        $db = db_connect();
        $token = session()->get('session_token');
        $currentIP = $_SERVER['REMOTE_ADDR'];
        $currentUserAgent = service('request')->getUserAgent()->getAgentString();

        // Get session data based on session token
        $session = $db->table('user_sessions')
            ->where('session_token', $token)
            ->get()
            ->getRowArray();

        // Check for session validity
        if (!$session || strtotime($session['expires_at']) < time()) {
            $db->table('user_sessions')
                ->where('session_token', $token)
                ->delete();
            $db->query('ALTER TABLE `user_sessions` auto_increment = 1');
            session()->remove('id_user');
            session()->remove('fullname');
            session()->remove('username');
            session()->remove('password');
            session()->remove('profilephoto');
            session()->remove('role');
            session()->remove('session_token');
            session()->remove('created_at');
            session()->remove('expires_at');

            // Handle redirection
            $data = array('redirect' => urlencode(uri_string()));
            if (uri_string() == 'home' || uri_string() == '') {
                session()->setFlashdata('url', base_url('home'));
                return redirect()->to(base_url());
            } else {
                session()->setFlashdata('url', http_build_query($data));
                return redirect()->to(base_url('/?' . session()->getFlashdata('url')));
            }
        }

        // Check if IP or user agent has changed
        $updateData = [];
        if ($session['ip_address'] !== $currentIP) {
            $updateData['ip_address'] = $currentIP;
        }
        if ($session['user_agent'] !== $currentUserAgent) {
            $updateData['user_agent'] = $currentUserAgent;
        }

        // Update the session record if either IP or user agent has changed
        if (!empty($updateData)) {
            $db->table('user_sessions')
                ->where('session_token', $token)
                ->update($updateData);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Connect to the database and retrieve session token
        $db = db_connect();
        $token = session()->get('session_token');
        // Get session data based on session token
        $session = $db->table('user_sessions')
            ->where('session_token', $token)
            ->get()
            ->getRowArray();
        if ($session) {
            // GREETINGS
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
            $url = session()->get('url');
            if ($url == base_url('home')) {
                if (current_url() != base_url()) {
                    session()->setFlashdata('msg', 'Login successful!');
                }
                return redirect()->to($url);
            } else {
                session()->remove('url');
                session()->set('url', base_url('home'));
                session()->setFlashdata('msg', 'Login successful!<br>' . $txtGreeting . ', ' . session()->get('fullname') . '!');
                return redirect()->to($url);
            }
        }
    }
}
