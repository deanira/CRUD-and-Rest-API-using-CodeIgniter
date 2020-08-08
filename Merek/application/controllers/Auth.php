<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'nama' => $user['nama']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Admin');
                    } else {
                        redirect('User');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah!
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email belum aktif!
          </div>');
                redirect('auth');
            }
        } else {
            //email tidak ad d database
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email tidak terdaftar!
          </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $client = new Client();

        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');

        // $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|min_length[10]', [
        //     'min_length' => 'Nomor HP terlalu pendek!'
        // ]);
        // $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|trim|min_length[16]', [
        //     'min_length' => 'Nomor KTP terlalu pendek!'
        // ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Halaman Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $response = $client->request('POST', 'http://localhost/Merek/index.php/api/user', [
                'form_params' => [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'password' => $this->input->post('password'),
                    'date_created' => time(),
                    'role_id' => 2,
                    'is_active' => 1
                ]
            ]);

            // $data = [
            //     'nama' => htmlspecialchars($this->input->post('nama', true)),
            //     'email' => htmlspecialchars($this->input->post('email', true)),
            //     'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            //     // 'alamat' => $this->input->post('alamat'),
            //     // 'no_hp' => $this->input->post('no_hp'),
            //     // 'no_ktp' => $this->input->post('no_ktp'),
            //     'date_created' => time(),
            //     'role_id' => 2,
            //     'is_active' => 1
            // ];

            // $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun sudah dibuat! Silahkan Login :)
          </div>');
            redirect('auth');
        }
    }

    function cekphp()
    {
        $this->load->view('cekphp');
    }

    function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Anda berhasil Logout!
          </div>');
        redirect('auth');
    }

    function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
