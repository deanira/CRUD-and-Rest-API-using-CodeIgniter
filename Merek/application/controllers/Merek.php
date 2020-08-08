<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $data['title'] = 'Permohonan Online';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['permohonan'] = $this->db->get_where('permohonan', ['user_id' => $data['user']['id']])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('merek/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Data Pemohon';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
        //     'matches' => 'Password tidak cocok!',
        //     'min_length' => 'Password terlalu pendek!'
        // ]);
        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|min_length[10]', [
            'min_length' => 'Nomor HP terlalu pendek!'
        ]);
        $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|trim|min_length[16]', [
            'min_length' => 'Nomor KTP terlalu pendek!'
        ]);
        $this->form_validation->set_rules('kab_kota', 'Kabupaten/Kota', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim');
        $this->form_validation->set_rules('whatsapp', 'Nomor Whatsapp', 'required|trim|min_length[10]', [
            'min_length' => 'Nomor Whatsapp terlalu pendek!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('merek/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $_SESSION['nama_pemohon'] = $this->input->post('nama');
            $_SESSION['email'] = $this->input->post('email');
            $_SESSION['alamat'] = $this->input->post('alamat');
            $_SESSION['no_hp'] = $this->input->post('no_hp');
            $_SESSION['no_ktp'] = $this->input->post('no_ktp');
            $_SESSION['kab_kota'] = $this->input->post('kab_kota');
            $_SESSION['kode_pos'] = $this->input->post('kode_pos');
            $_SESSION['whatsapp'] = $this->input->post('whatsapp');

            redirect('merek/tambah2');
        }
    }

    // public function tambah2()
    // {
    //     $data['title'] = 'Data Merek';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->form_validation->set_rules('image', 'Label Merek', 'required');
    //     $this->form_validation->set_rules('merek', 'Merek', 'required|trim');

    //     // $upload_image = $_FILES['image']['name'];

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('merek/tambah2', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $config['allowed_types'] = 'gif|jpg|png';
    //         $config['max_size']     = '2048';
    //         $config['upload_path'] = './assets/img/merek/';

    //         $this->load->library('upload', $config);

    //         if ($this->upload->do_upload('image')) {
    //             $new_image = $this->upload->data('file_name');

    //             $data = [
    //                 'user_id' => $data['user']['id'],
    //                 'nama_pemohon' => $_SESSION['nama_pemohon'],
    //                 'email' => $_SESSION['email'],
    //                 'alamat' => $_SESSION['alamat'],
    //                 'no_hp' => $_SESSION['no_hp'],
    //                 'no_ktp' => $_SESSION['no_ktp'],
    //                 'kab_kota' => $_SESSION['kab_kota'],
    //                 'kode_pos' => $_SESSION['kode_pos'],
    //                 'whatsapp' => $_SESSION['whatsapp'],
    //                 'merek' => $this->input->post('merek'),
    //                 'deskripsi' => $this->input->post('deskripsi'),
    //                 'label_merek' => $new_image,
    //                 'date_created' => time(),
    //                 'status' => 0
    //             ];

    //             $this->db->insert('permohonan', $data);
    //             redirect('merek');
    //         } else {
    //             echo $this->upload->display_errors();
    //         }
    //     }
    // }

    private function do_upload_foto()
    {
        $foto = $_FILES['image'];
        if ($foto = null) {
            echo "null";
        } else {
            $config['upload_path']          = './assets/img/merek/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                echo "gagal upload";
                die();
            } else {
                $foto = $this->upload->data('file_name');
                return $foto;
            }
        }
    }

    public function tambah2()
    {
        $data['title'] = 'Data Merek';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('merek', 'Merek', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('merek/tambah2', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'user_id' => $data['user']['id'],
                'nama_pemohon' => $_SESSION['nama_pemohon'],
                'email' => $_SESSION['email'],
                'alamat' => $_SESSION['alamat'],
                'no_hp' => $_SESSION['no_hp'],
                'no_ktp' => $_SESSION['no_ktp'],
                'kab_kota' => $_SESSION['kab_kota'],
                'kode_pos' => $_SESSION['kode_pos'],
                'whatsapp' => $_SESSION['whatsapp'],
                'merek' => $this->input->post('merek'),
                'deskripsi' => $this->input->post('deskripsi'),
                'label_merek' => $this->do_upload_foto(),
                'date_created' => time(),
                'status' => 0
            ];
            // var_dump($data);
            $this->db->insert('permohonan', $data);
            redirect('merek');
        }
    }

    public function pratinjau($id)
    {
        $data['title'] = 'Permohonan Online';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['permohonan'] = $this->db->get_where('permohonan', ['id' => $id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('merek/pratinjau', $data);
        $this->load->view('templates/footer');
    }
}
