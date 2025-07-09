<?php

namespace App\Http\Controllers;

use App\Models\Baptis;
use App\Models\Komuni;
use App\Models\Krisma;
use App\Models\Pernikahan;
use Illuminate\Http\Request;
use App\Models\Umat;
use GuzzleHttp\Client;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Api\TransactionalEmailsApi;

class SekretarisPersetujuanController extends Controller
{
    public function setujuPendaftaranBaptis(Baptis $baptis)
    {
        $baptis->update(['status_pendaftaran' => 'Diterima']);

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'subject' => 'Persetujuan Pendaftaran Sakramen Gereja Katedral Merauke',
            'sender' => ['name' => 'Gereja Katedral Merauke', 'email' => env('MAIL_FROM_ADDRESS')],
            'to' => [['email' => $baptis->umat->email]],
            'htmlContent' => "
                <p>Salam damai dalam Kristus,</p>

                <p>Kami dari Sekretariat Gereja Katedral Merauke ingin menyampaikan bahwa pendaftaran Anda untuk menerima <strong>Sakramen Baptis</strong> telah kami tinjau dan <strong>disetujui</strong>.</p>

                <p>Mohon menunggu informasi selanjutnya dari kami terkait jadwal pelaksanaan dan persiapan lainnya. Informasi akan kami kirimkan melalui email atau saluran resmi gereja.</p>

                <p>Terima kasih atas kesediaan dan komitmen Anda dalam mengikuti proses sakramen ini.</p>

                <br>
                <p>Salam hormat,</p>
                <p><strong>Sekretariat Paroki</strong><br>
                Gereja Katedral Merauke</p>
            "
        ]);

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            return back()->with('Pemberitahuan', 'Gagal mengirim email: ' . $e->getMessage());
        }

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function setujuPendaftaranKomuni(Komuni $komuni)
    {
        // tolak kalau tidak ada baptis yang status pendaftarannya belum disetujui
        $baptis = Baptis::where('umat_id', $komuni->umat_id)->first();
        if (!$baptis || $baptis->status_pendaftaran !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena data baptis belum disetujui.');
        }

        $komuni->update(['status_pendaftaran' => 'Diterima']);

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'subject' => 'Persetujuan Pendaftaran Sakramen Gereja Katedral Merauke',
            'sender' => ['name' => 'Gereja Katedral Merauke', 'email' => env('MAIL_FROM_ADDRESS')],
            'to' => [['email' => $komuni->umat->email]],
            'htmlContent' => "
                <p>Salam damai dalam Kristus,</p>

                <p>Kami dari Sekretariat Gereja Katedral Merauke ingin menyampaikan bahwa pendaftaran Anda untuk menerima <strong>Sakramen Komuni</strong> telah kami tinjau dan <strong>disetujui</strong>.</p>

                <p>Mohon menunggu informasi selanjutnya dari kami terkait jadwal pelaksanaan dan persiapan lainnya. Informasi akan kami kirimkan melalui email atau saluran resmi gereja.</p>

                <p>Terima kasih atas kesediaan dan komitmen Anda dalam mengikuti proses sakramen ini.</p>

                <br>
                <p>Salam hormat,</p>
                <p><strong>Sekretariat Paroki</strong><br>
                Gereja Katedral Merauke</p>
            "
        ]);

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            return back()->with('Pemberitahuan', 'Gagal mengirim email: ' . $e->getMessage());
        }

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function setujuPendaftaranKrisma(Krisma $krisma)
    {
        // tolak kalau tidak ada baptis atau komuni yang status pendaftarannya belum disetujui
        $baptis = Baptis::where('umat_id', $krisma->umat_id)->first();
        $komuni = Komuni::where('umat_id', $krisma->umat_id)->first();

        if ((!$baptis || $baptis->status_pendaftaran !== 'Diterima') && (!$komuni || $komuni->status_penerimaan !== 'Diterima')) {
            return back()->with('status_error', 'Gagal memverifikasi karena data baptis dan komuni belum disetujui.');
        }

        if (!$baptis || $baptis->status_pendaftaran !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena data baptis belum disetujui.');
        }

        if (!$komuni || $komuni->status_pendaftaran !== 'Diterima') {
            return back()->with('status_error', 'Gagal memverifikasi karena data komuni belum disetujui.');
        }

        $krisma->update(['status_pendaftaran' => 'Diterima']);

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'subject' => 'Persetujuan Pendaftaran Sakramen Gereja Katedral Merauke',
            'sender' => ['name' => 'Gereja Katedral Merauke', 'email' => env('MAIL_FROM_ADDRESS')],
            'to' => [['email' => $krisma->umat->email]],
            'htmlContent' => "
                <p>Salam damai dalam Kristus,</p>

                <p>Kami dari Sekretariat Gereja Katedral Merauke ingin menyampaikan bahwa pendaftaran Anda untuk menerima <strong>Sakramen Krisma</strong> telah kami tinjau dan <strong>disetujui</strong>.</p>

                <p>Mohon menunggu informasi selanjutnya dari kami terkait jadwal pelaksanaan dan persiapan lainnya. Informasi akan kami kirimkan melalui email atau saluran resmi gereja.</p>

                <p>Terima kasih atas kesediaan dan komitmen Anda dalam mengikuti proses sakramen ini.</p>

                <br>
                <p>Salam hormat,</p>
                <p><strong>Sekretariat Paroki</strong><br>
                Gereja Katedral Merauke</p>
            "
        ]);

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            return back()->with('Pemberitahuan', 'Gagal mengirim email: ' . $e->getMessage());
        }

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }

    public function setujuPendaftaranPernikahan(Pernikahan $pernikahan)
    {
        $pernikahan->update(['status_pendaftaran' => 'Diterima']);

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'subject' => 'Persetujuan Pendaftaran Sakramen Gereja Katedral Merauke',
            'sender' => ['name' => 'Gereja Katedral Merauke', 'email' => env('MAIL_FROM_ADDRESS')],
            'to' => [
                ['email' => $pernikahan->email_pria], ['email' => $pernikahan->email_wanita],
            ],
            'htmlContent' => "
                <p>Salam damai dalam Kristus,</p>

                <p>Kami dari Sekretariat Gereja Katedral Merauke ingin menyampaikan bahwa pendaftaran Anda untuk menerima <strong>Sakramen Pernikahan</strong> telah kami tinjau dan <strong>disetujui</strong>.</p>

                <p>Mohon menunggu informasi selanjutnya dari kami terkait jadwal pelaksanaan dan persiapan lainnya. Informasi akan kami kirimkan melalui email atau saluran resmi gereja.</p>

                <p>Terima kasih atas kesediaan dan komitmen Anda dalam mengikuti proses sakramen ini.</p>

                <br>
                <p>Salam hormat,</p>
                <p><strong>Sekretariat Paroki</strong><br>
                Gereja Katedral Merauke</p>
            "
        ]);

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            return back()->with('Pemberitahuan', 'Gagal mengirim email: ' . $e->getMessage());
        }

        return redirect()->route('sekretaris.pendaftaransakramen')->with('status', 'Umat berhasil diverifikasi!');
    }
}
