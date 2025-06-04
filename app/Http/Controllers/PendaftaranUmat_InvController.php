<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use GuzzleHttp\Client;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Api\TransactionalEmailsApi;

class PendaftaranUmat_InvController extends Controller
{
    public function index(){
        // ke halaman utama pendaftaran umat
        return view('layouts.pendaftaranumat.pendaftaranumat');
    }

    public function sendStatusPendaftaranEmail(Request $request) {

        // validasi email
        $request->validate(['email' => 'required|email']);

        // cek apakah ada umat yang memiliki email tersebut
        $umat = Umat::where('email', $request->email)->first();

        if ($umat){
            // jika umat ditemukan
            if ($umat->status_pendaftaran == 'Diterima'){
                // .. dan sudah diterima mendaftar
                return back()->with('Pemberitahuan', 'Email ini telah terdaftar sebagai Umat');
            }
            else{
                // .. dan masih menunggu status pending
                return back()->with('Pemberitahuan', 'Pendaftaran masih menunggu persetujuan, Mohon periksa kembali nanti');
            }
        }

        // jika umat tidak ditemukan atau ditolak

        // ganti sesi sebelumnya (jika ada) yang masih aktif menjadi tidak aktif
        Invitation::where('email', $request->email)->where('aktif', true)->update(['aktif' => false]);

        // buat token random
        $token = Str::random(32);

        // masukkan token dan email ke dalam database
        Invitation::create([
            'token' => $token,
            'email' => $request->email,
            'aktif' => true
        ]);

        // susun menjadi link
        $link = url('pendaftaran-umat/formulir/' . $token); // kalau ubah ini plis ingat untuk ubah routenya di web.php (nama: pendaftaran-umat.create)

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'subject' => 'Link Pendaftaran Umat Gereja Katedral Merauke',
            'sender' => ['name' => 'Gereja Katedral Merauke', 'email' => env('MAIL_FROM_ADDRESS')],
            'to' => [['email' => $request->email]],
            'htmlContent' => "
                <p>Salam damai,</p>
                <p>Panitia Pendaftaran Gereja Katedral Merauke dengan ini mengirimkan undangan resmi untuk melanjutkan proses <strong>Pendaftaran Umat</strong>.</p>
                <p>Silakan klik tautan berikut untuk mengisi formulir pendaftaran:</p>
                <p><a href=\"$link\" style=\"color: #1a73e8;\">$link</a></p>
                <p>Mohon untuk tidak membagikan tautan ini kepada orang lain demi menjaga keamanan data pribadi Anda.</p>
                <p>Jika Anda tidak merasa mengajukan permohonan ini, Anda dapat mengabaikan email ini.</p>
                <p>Terima kasih atas perhatian dan kerja samanya.</p>
                <br>
                <p>Hormat kami,<br>
                <strong>Sekretariat Gereja Katedral</strong><br>
                Gereja Katedral Merauke</p>
            "
        ]);

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            return back()->with('Pemberitahuan', 'Gagal mengirim email: ' . $e->getMessage());
        }


        return back()->with('Pemberitahuan', 'Link undangan telah dikirim ke email anda!');

    }
}
