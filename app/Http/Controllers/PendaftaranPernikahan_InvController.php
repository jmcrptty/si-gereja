<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use GuzzleHttp\Client;
use App\Models\Invitation;
use App\Models\Krisma;
use App\Models\Pernikahan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Api\TransactionalEmailsApi;


class PendaftaranPernikahan_InvController extends Controller

   {
    public function sendEmailPendaftaran(Request $request) {

        // validasi email
        $request->validate(['email' => 'required|email']);

        // cek apakah ada umat yang memiliki email tersebut
        $umat = Umat::where('email', $request->email)->first();

        if(!$umat){
            // jika umat belum terdaftar
            return back()->with('Pemberitahuan', 'Belum terdaftar sebagai umat, silahkan melakukan pendaftaran');
        }
        
        $sudahMenikah = Pernikahan::where('umat_id_pria', $umat->id)
                           ->orWhere('umat_id_wanita', $umat->id)
                           ->first();

        if($sudahMenikah){
            return back()->with('Pemberitahuan', 'Anda sudah terdaftar');
        }

        if($umat->status_pendaftaran == 'Diterima'){
            // jika umat ditemukan dan telah diterima

            // 1. ganti sesi sebelumnya (jika ada) yang masih aktif menjadi tidak aktif
            Invitation::where('email', $request->email)->where('aktif', true)->update(['aktif' => false]);

            // 2. buat token random
            $token = Str::random(32);

            // 3. masukkan token dan email ke dalam database
            Invitation::create([
                'token' => $token,
                'email' => $request->email,
                'aktif' => true
            ]);

            // 4. susun menjadi link
            $link = url('pernikahan/formulir/' . $token); // kalau ubah ini plis ingat untuk ubah routenya di web.php (nama: pernikahan.create)

            // 5. buat email
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
            $apiInstance = new TransactionalEmailsApi(new Client(), $config);

            $sendSmtpEmail = new SendSmtpEmail([
                'subject' => 'Link Pendaftaran Umat Gereja Katedral Merauke',
                'sender' => ['name' => 'Gereja Katedral Merauke', 'email' => env('MAIL_FROM_ADDRESS')],
                'to' => [['email' => $request->email]],
                'htmlContent' => "
                    <p>Salam damai,</p>
                    <p>Panitia Pendaftaran Gereja Katedral Merauke dengan ini mengirimkan undangan resmi untuk melanjutkan proses <strong>pendaftaran Sakramen Pernikahan</strong>.</p>
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
            return back()->with('Pemberitahuan', 'Link Formulir telah dikirim ke email anda!');
        }
        elseif($umat->status_pendaftaran == 'Pending'){
            // jika umat statusnya masih pending
            return back()->with('Pemberitahuan', 'Pendaftaran masih menunggu persetujuan, Mohon periksa kembali nanti');
        }
    }
}
