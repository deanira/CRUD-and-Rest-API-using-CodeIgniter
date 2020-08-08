<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        // if (!$this->session->userdata('email')) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        //             Anda harus login terlebih dahulu!
        //             </div>');
        //     redirect('auth');
        // }
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $client = new Client();

        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', "Full name", "required|trim");

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $response = $client->request('PUT', 'http://localhost/Merek/index.php/api/user', [
                'json' => [
                    'nama' => htmlspecialchars($name),
                    'email' => htmlspecialchars($email),
                    'password' => "",
                    'role_id' => $data['user']['role_id'],
                    'is_active' => 1
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            //cek jika ada gambar yang ingin diupload
            // $upload_image = $_FILES['image']['name'];

            // if ($upload_image) {
            //     $config['allowed_types'] = 'gif|jpg|png';
            //     $config['max_size']     = '2048';
            //     $config['upload_path'] = './assets/img/profile/';

            //     $this->load->library('upload', $config);

            //     if ($this->upload->do_upload('image')) {
            //         $old_image = $data['user']['image'];

            //         if ($old_image != 'default.png') {
            //             unlink(FCPATH . 'assets/img/profile/' . $old_image);
            //         }

            //         $new_image = $this->upload->data('file_name');
            //         $this->db->set('image', $new_image);
            //     } else {
            //         echo $this->upload->display_errors();
            //     }
            // }

            // $this->db->set('nama', $name);
            // $this->db->where('email', $email);
            // $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Your profile has been updated!
          </div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Wrong password!
          </div>');
                redirect('user/changePassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           New password cannot be the same as current password!
          </div>');
                    redirect('user/changePassword');
                } else {
                    $client = new Client();
                    //password benar
                    // $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $response = $client->request('PUT', 'http://localhost/Merek/index.php/api/user', [
                        'json' => [
                            'nama' => $data['user']['nama'],
                            'email' => $data['user']['email'],
                            'password' => $new_password,
                            'role_id' => $data['user']['role_id'],
                            'is_active' => 1
                        ]
                    ]);

                    //$this->db->set('password', $password_hash);
                    // $this->db->where('email', $data['user']['email']);
                    // $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Password changed!
          </div>');
                    redirect('user/changePassword');
                }
            }
        }
    }
}
