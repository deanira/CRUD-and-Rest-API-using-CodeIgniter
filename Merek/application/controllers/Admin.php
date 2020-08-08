<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Admin extends CI_Controller
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
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->order_by('id', 'DESC');
        $data['permohonansemua'] = $this->db->get('permohonan')->result_array();
        $data['permohonanbelum'] = $this->db->get_where('permohonan', ['status' => 0])->result_array();
        $data['permohonansedang'] = $this->db->get_where('permohonan', ['status' => 1])->result_array();
        $data['permohonanselesai'] = $this->db->get_where('permohonan', ['status' => 2])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Role Added!
                    </div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access successfully changed!
          </div>');
    }

    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus!
          </div>');
        redirect('admin/role');
    }

    public function user()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost/Merek/index.php/api/user');
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['user_list'] = json_decode($response->getBody()->getContents(), true);

        //$data['user_list'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function deleteUser($id)
    {
        $client = new Client();
        $response = $client->request('DELETE', 'http://localhost/Merek/index.php/api/user', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        // $this->db->delete('user', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus!
          </div>');
        redirect('admin/user');
    }

    public function lihatPermohonan($id)
    {
        $data['title'] = 'Lihat Permohonan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['permohonan'] = $this->db->get_where('permohonan', ['id' => $id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lihatPermohonan', $data);
        $this->load->view('templates/footer');
    }

    public function hapusPermohonan($id)
    {
        $this->db->delete('permohonan', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus!
          </div>');
        redirect('admin/index');
    }

    public function editPermohonan($id)
    {
        $data['title'] = 'Edit Permohonan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['permohonan'] = $this->db->get_where('permohonan', ['id' => $id])->row_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editPermohonan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->set('status', $this->input->post('status'));
            $this->db->set('keterangan', $this->input->post('keterangan'));
            $this->db->where('id', $id);
            $this->db->update('permohonan');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil diubah!
          </div>');
            redirect('admin/index');
        }
    }
}
