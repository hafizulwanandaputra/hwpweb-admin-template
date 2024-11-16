<?php

namespace App\Controllers;

use App\Models\SessionsModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Sessions extends BaseController
{
    protected $SessionsModel;
    public function __construct()
    {
        $this->SessionsModel = new SessionsModel();
    }

    public function index()
    {
        if (session()->get('role') == "Administrator") {
            $data = [
                'title' => 'Session Manager',
                'systemName' => $this->systemName,
                'systemSubtitleName' => $this->systemSubtitleName,
                'companyName' => $this->companyName,
                'agent' => $this->request->getUserAgent()
            ];
            return view('dashboard/settings/sessions', $data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function sessionslist()
    {
        if (session()->get('role') == 'Administrator') {
            $request = $this->request->getPost();
            $search = $request['search']['value'];
            $start = $request['start'];
            $length = $request['length'];
            $draw = $request['draw'];

            $order = $request['order'];
            $sortColumnIndex = $order[0]['column'];
            $sortDirection = $order[0]['dir'];

            $columnMapping = [
                0 => 'id',
                1 => 'id',
                2 => 'username',
                3 => 'ip_address',
                4 => 'user_agent',
                5 => 'created_at',
                6 => 'expires_at',
            ];

            $sortColumn = $columnMapping[$sortColumnIndex] ?? 'id';

            $totalRecords = $this->SessionsModel->where('session_token !=', session()->get('session_token'))->countAllResults(true);

            if ($search) {
                $this->SessionsModel
                    ->join('user AS u1', 'u1.id_user = user_sessions.id_user', 'inner')
                    ->groupStart()
                    ->like('u1.username', $search)
                    ->orLike('user_sessions.ip_address', $search)
                    ->orLike('user_sessions.user_agent', $search)
                    ->groupEnd()
                    ->where('user_sessions.session_token !=', session()->get('session_token'))
                    ->orderBy($sortColumn, $sortDirection);
            }

            $filteredRecords = $this->SessionsModel
                ->join('user AS u2', 'u2.id_user = user_sessions.id_user', 'inner')
                ->where('user_sessions.session_token !=', session()->get('session_token'))
                ->countAllResults(false);

            $sessions = $this->SessionsModel
                ->join('user AS u3', 'u3.id_user = user_sessions.id_user', 'inner')
                ->where('user_sessions.session_token !=', session()->get('session_token'))
                ->orderBy($sortColumn, $sortDirection)
                ->findAll($length, $start);

            foreach ($sessions as $index => &$item) {
                $item['no'] = $start + $index + 1;
            }

            return $this->response->setJSON([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $sessions
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Page Not Found',
            ]);
        }
    }

    public function flush()
    {
        if (session()->get('role') == 'Administrator') {
            $db = db_connect();
            $current_token = session()->get('session_token');
            $builder = $db->table('user_sessions');
            $otherSessions = $builder->where('session_token !=', $current_token)->countAllResults();
            if ($otherSessions > 0) {
                $db->table('user_sessions')
                    ->where('session_token !=', $current_token)
                    ->delete();
                $db->query('ALTER TABLE `user_sessions` auto_increment = 1');
                return $this->response->setJSON(['message' => 'User sessions successfully cleaned up']);
            } else {
                return $this->response->setStatusCode(404)->setJSON([
                    'error' => 'User sessions is empty',
                ]);
            }
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Page Not Found',
            ]);
        }
    }

    public function deleteexpired()
    {
        if (session()->get('role') == 'Administrator') {
            $db = db_connect();
            $builder = $db->table('user_sessions');

            $expiredSessions = $builder->where('expires_at <', date('Y-m-d H:i:s'))->countAllResults();

            if ($expiredSessions > 0) {
                $builder->where('expires_at <', date('Y-m-d H:i:s'))->delete();

                $db->query('ALTER TABLE `user_sessions` auto_increment = 1');

                return $this->response->setJSON(['message' => 'Expired user sessions successfully deleted']);
            } else {
                return $this->response->setStatusCode(404)->setJSON([
                    'error' => 'No expired user sessions to be deleted',
                ]);
            }
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Page Not Found',
            ]);
        }
    }

    public function deletesession($id)
    {
        if (session()->get('role') == 'Administrator') {
            $session = $this->SessionsModel->find($id);
            if ($session) {
                $this->SessionsModel->delete($id);
                $db = db_connect();
                $db->query('ALTER TABLE `user_sessions` auto_increment = 1');
                return $this->response->setJSON(['message' => 'User session successfully deleted']);
            } else {
                return $this->response->setStatusCode(404)->setJSON([
                    'error' => 'Session ID not found. Probably because the user has already logged out of their session.',
                ]);
            }
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Page Not Found',
            ]);
        }
    }
}
