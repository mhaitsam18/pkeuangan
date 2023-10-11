<?php

class Auth extends CI_Controller
{
    function __construct()
    {
        Parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_pengguna');
    }
    function index()
    {
        $this->load->view('login');
    }

    function register()
    {
        $this->load->view('register');
    }

    function auth()
    {
        $username = strip_tags(str_replace("'", "", $this->input->post('username', TRUE)));
        $password = strip_tags(str_replace("'", "", $this->input->post('password', TRUE)));
        $cadmin = $this->m_login->cekadmin($username, $password);
        if ($cadmin->num_rows() > 0) {
            $xcadmin = $cadmin->row_array();
            if ($xcadmin['pengguna_status'] == 2) {
                // $this->session->set_userdata($newdata);
                $this->gagalVerifikasi('Mohon verifikasi Akun terlebih dahulu');
            }

            if ($xcadmin['pengguna_status'] == 3) {
                // $this->session->set_userdata($newdata);
                $this->gagalVerifikasi('Akun Anda telah di Ban s/d Tanggal ' . date("j F Y", strtotime($xcadmin['tanggal_aktif'])));
            }

            if ($xcadmin['pengguna_status'] == 4) {
                // $this->session->set_userdata($newdata);
                $this->gagalVerifikasi('Akun Anda Telah diblokir, Silahkan menghubungi Admin - 087720717252');
            }

            $newdata = array(
                'idadmin'   => $xcadmin['pengguna_id'],
                'username'  => $xcadmin['pengguna_username'],
                'nama'      => $xcadmin['pengguna_nama'],
                'level'     => $xcadmin['pengguna_level'],
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            redirect('admin/dashboard');
        } else {
            redirect('auth/gagallogin');
        }
    }

    function registerPost()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|is_unique[tbl_pengguna.pengguna_email]');
        if ($this->form_validation->run() == TRUE) {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $cekUsername = $this->db->query("select * from tbl_pengguna where pengguna_username = '" . $this->input->post('username') . "'");
            $cekKTP = $this->db->query("select * from tbl_pengguna where pengguna_no_ktp = '" . $this->input->post('no_ktp') . "'");

            $userktp = $cekKTP->row();
            if ($cekUsername->num_rows() > 0) {
                $this->gagalRegister('Username telah digunakan');
            }
            if ($cekKTP->num_rows() > 0) {
                if ($userktp->pengguna_status == 4) {
                    $this->gagalRegister('No. KTP Anda Telah diblokir, Silahkan menghubungi Admin ');
                } else {
                    $this->gagalRegister('No. KTP telah digunakan');
                }
            }
            if ($password != $password2) {
                $this->gagalRegister('Password Tidak Sesuai');
            }

            // $cek = $this->load->library('mailer');
            // // Subject email
            // $subject = 'Verifikasi Akun';
            // Isi email
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $unik = substr(str_shuffle($permitted_chars), 0, 16);
            var_dump($unik);

            // $message = "
            //     <h5>Verifikasi Akun<h5>
            //     <p>untuk verivikasi akun, silahkan klik link : <a href='" . base_url('verifikasi/' . $unik) . "'>" . base_url('verifikasi/' . $unik) . "</a><p>
            // ";

            $config['upload_path'] = './assets/images/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

            $this->upload->initialize($config);
            $gambar = "";
            $foto_ktp = "";
            if (!empty($_FILES['photo']['name'])) {
                if ($this->upload->do_upload('photo')) {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '60%';
                    $config['width'] = 300;
                    $config['height'] = 300;
                    $config['new_image'] = './assets/images/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $gambar = $gbr['file_name'];
                } else {
                    echo $this->session->set_flashdata('msg', 'warning');
                    redirect('admin/pengguna');
                }
            }
            if (!empty($_FILES['foto_ktp']['name'])) {
                if ($this->upload->do_upload('foto_ktp')) {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '60%';
                    $config['width'] = 300;
                    $config['height'] = 300;
                    $config['new_image'] = './assets/images/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $foto_ktp = $gbr['file_name'];
                } else {
                    echo $this->session->set_flashdata('msg', 'warning');
                    redirect('admin/pengguna');
                }
            }
            $data = array(
                'pengguna_email' => $this->input->post('email'),
                'pengguna_no_ktp' => $this->input->post('no_ktp'),
                'pengguna_jenkel' => $this->input->post('jenkel'),
                'pengguna_username' => $this->input->post('username'),
                'pengguna_password' => md5($this->input->post('password')),
                'pengguna_nohp' => $this->input->post('phone'), //bego
                'pengguna_status' => 2,
                'pengguna_level' => 2,
                'pengguna_unik' => $unik,
                'pengguna_photo' => $gambar, //bego
                'pengguna_foto_ktp' => $foto_ktp,
                'is_active' => 0,

            );
            $this->db->insert('tbl_pengguna', $data);
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email', true),
                'pengguna_id' => $this->db->insert_id(),
                'token' => $token,
                'date_created' => time()
            ];
            $this->db->insert('user_token', $user_token);
            $mail = [
                'to' => $this->input->post('email'),
                'type' => 'verifikasi',
                'token' => $token
            ];
            $this->__sendEmail($mail);
            // $regis = $this->m_pengguna->simpan_pengguna_dengan_gambar($this->input->post('nama'), $this->input->post('no_ktp'), $this->input->post('jenkel'), $this->input->post('username'), $this->input->post('password'), $this->input->post('phone'), '1', '2', $unik, $gambar, $foto_ktp);
            $dataPengguna = $this->db->query("select * from tbl_pengguna where pengguna_username = '" . $this->input->post('username') . "'")->row();
            $dataRAB = $this->db->query("select * from pos")->result_array();
            foreach ($dataRAB as $row) {
                $dataInsertRAB = array(
                    'nama' => $row['nama'],
                    'pos_id' => $row['id'],
                    'user_id' => $dataPengguna->pengguna_id,
                    'persen' => $row['min'],
                    'min' => $row['min'],
                    'max' => $row['max'],
                    'bulan' => date('m'),
                    'tahun' => date('Y'),
                    'is_default' => 1,
                );
                $this->db->insert('rab', $dataInsertRAB);
            }
            redirect(base_url('auth'));
        } else {
            $this->register();
        }
    }

    function gagallogin()
    {
        $url = base_url('auth');
        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
        redirect($url);
    }

    function gagalRegister($message)
    {
        $url = base_url('auth/register');
        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>' . $message . '</div>');
        redirect($url);
    }

    function gagalVerifikasi($message)
    {
        $url = base_url('auth');
        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>' . $message . '</div>');
        redirect($url);
    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('auth');
        redirect($url);
    }

    function berhasilRegister($message)
    {
    }

    // function verifikasi($unik)
    // {
    //     $data = $this->db->query('update tbl_pengguna set pengguna_status = 1 where pengguna_unik = "' . $unik . '"');
    //     echo $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Akun berhasil di verifikasi !!</div>');
    //     redirect(base_url('auth'));
    // }

    public function __sendEmail($mail)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'proyeka73@gmail.com',
            'smtp_pass' => 'zwnfalsvxuwlujrd',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'chatset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->email->initialize($config);
        $this->email->from('proyeka73@gmail.com', 'Aplikasi Keuangan');
        $this->email->to($mail['to']);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');

        switch ($mail['type']) {
            case 'verifikasi':
                $this->email->subject('Verifikasi Akun');
                $this->email->message('Klik link berikut ini untuk memverifikasikan Akun Anda : <a href="' . base_url('auth/verify?email=') . $this->input->post('email') . '&token=' . urlencode($mail['token']) . '">Activate</a>');
                break;

            default:
                # code...
                break;
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_pengguna', ['pengguna_email' => $email])->row_array();
        if ($user) {
            if ($user['pengguna_status'] != 1) {
                $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
                if ($user_token) {
                    if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                        $this->db->set('pengguna_status', 1);
                        $this->db->where('pengguna_email', $email);
                        $this->db->update('tbl_pengguna');
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						' . $email . ' has been activated. Please Login!
						</div>');
                        redirect('auth');
                    } else {
                        $this->db->delete('tbl_pengguna', ['pengguna_email' => $email]);
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Account activation failed: Token Expired!
						</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Account activation failed: Invalid Token!
					</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
				Your account has been activated!
				</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Account activation failed: Wrong Email!
			</div>');
            redirect('auth');
        }
    }
}
