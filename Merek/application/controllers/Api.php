<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function user_get($id = "")
    {
        if ($id == "") {
            $user = $this->db->get('user')->result();
        } else {
            $this->db->where('id', $id);
            $user = $this->db->get('user');
        }
        $this->response($user, 200);
    }

    function user_post()
    {
        $data = array(
            'nama' => htmlspecialchars($this->post('nama', true)),
            'email' => htmlspecialchars($this->post('email', true)),
            'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
            'date_created' => time(),
            'role_id' => 2,
            'is_active' => 1
        );

        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function user_put()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");

        $formdata = json_decode(file_get_contents('php://input'), true);

        if (!empty($formdata)) {
            $nama_user = $formdata['nama'];
            $email_user = $formdata['email'];
            $password_user = $formdata['password'];
            $role_id = $formdata['role_id'];
            $is_active = $formdata['is_active'];

            $this->db->set('nama', $nama_user);
            if (!$password_user == "") {
                $password_user = password_hash($password_user, PASSWORD_DEFAULT);
                $this->db->set('password', $password_user);
            }
            $this->db->set('email', $email_user);
            $this->db->set('role_id', $role_id);
            $this->db->set('is_active', $is_active);
            $this->db->where('email', $email_user);
            $this->db->update('user');

            $response = array(
                'status' => 'success',
                'message' => 'User Berhasil Di Update'
            );
        } else {
            $response = array(
                'status' => 'error'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function user_delete()
    {
        $id  = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success', 201));
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
