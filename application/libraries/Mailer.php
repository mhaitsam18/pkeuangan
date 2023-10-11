<?php defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    protected $_ci;

    public function __construct(){
        $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter
        require_once(APPPATH.'third_party/phpmailer/Exception.php');
        require_once(APPPATH.'third_party/phpmailer/PHPMailer.php');
        require_once(APPPATH.'third_party/phpmailer/SMTP.php');
    }
    
    public function send($data){
        $mail = new PHPMailer;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
                    
        $mail->IsSMTP();
        $mail->Host     = "mail.lokalan.co.id";
        $mail->SMTPAuth = true;
        $mail->Username = "admin@lokalan.co.id";  // SMTP username
        $mail->Password = "GIm3zjPa2Mfk"; // SMTP password
        $mail->post     = 465;

        // Siapa yang mengirim email
        $mail->From     = "admin@lokalan.co.id";
        $mail->FromName = "Admin";

        // Siapa yang akan menerima email
        $mail->addAddress($data['email']);

        // Set email format to HTML
        $mail->isHTML(true);                                  
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['message'];
        $send = $mail->send();
        if($send){ // Jika Email berhasil dikirim
            $response = array('status'=>'Sukses', 'message'=>'Email berhasil dikirim');
        }else{ // Jika Email Gagal dikirim
            $response = array('status'=>'Gagal', 'message'=>$mail->ErrorInfo);
        }
        return $response;
    }
}