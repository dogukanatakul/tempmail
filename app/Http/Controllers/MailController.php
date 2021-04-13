<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpImap\Mailbox;

class MailController extends Controller
{
    public function newMail()
    {
        session()->forget(['email']);
        return redirect()->back();
    }


    public function get($mail)
    {
        session(["email" => $mail]);
        return redirect()->back();
    }

    public function index()
    {
        if (!session()->has('email')) {
            session(["email" => strtolower(Str::random(5))]);
        }
        $mails = Mail::where("mail", session()->get("email") . "@mailcreate.space")->orderBy("id", "DESC")->paginate(5);
        $count = Mail::where("mail", session()->get("email") . "@mailcreate.space")->where("status", 2)->count();
        return view("index")->with("mails")
            ->with('count', $count)
            ->with('mails', $mails);
    }


    public function view($uuid)
    {
        $mail = Mail::where("uuid", $uuid)->where("mail", session()->get("email") . "@mailcreate.space")->first();
        if (!$mail) {
            abort(404);
        }
        $time = zaman($mail->created_at);
        if ($time > 30) {
            abort(403);
        }

        $update = Mail::where('id', $mail->id)->update(['status' => 1]);
        $html = Storage::disk('mails')->get($mail->uuid . ".html");
        if (strstr($html, "<body style")) {
            $html = str_replace('<body style=', '<body class=', $html);
        }
        return view('detail', compact('mail', 'html'));
    }

    public function refreshStatus()
    {
        $mail = Mail::where("mail", session()->get("email") . "@mailcreate.space")->where('status', 0)->first();
        Mail::where("mail", session()->get("email") . "@mailcreate.space")->update(['status' => 3]);
        if (!$mail) {
            return "false";
        } else {
            return "true";
        }

    }

    public function bot()
    {
        $count = 0;
        $unseen = filter_input(INPUT_GET, 'unseen', FILTER_SANITIZE_STRING);
        $mailbox = new Mailbox(
            '{imap.yandex.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
            'MAIL_USERNAME', // Username for the before configured mailbox
            'MAIL_PASSWORD', // Password for the before configured username
            null, // Directory, where attachments will be saved (optional)
            'UTF-8' // Server encoding (optional)
        );

        $ids = $mailbox->searchMailbox('BEFORE ' . date('d-M-Y', strtotime("+1 days ago")));
        foreach ($ids as $id) {
            $mailbox->deleteMail($id);
        }
        $mailbox->expungeDeletedMails();
//        $files = glob('downloads/*');
//        foreach ($files as $file) {
//            if (is_file($file))
//                unlink($file);
//        }

        $mailsIds = $mailbox->searchMailbox();
        if ($unseen == 1) {
            $unseenIds = $mailbox->searchMailbox("UNSEEN");
            $mailsIds = array_intersect($mailsIds, $unseenIds);
        }
        $mailDetails = [];
        foreach ($mailsIds as $mailID) {
            $mail = $mailbox->getMail($mailID);
            $toAdress = "undefined@mailcreate.space";
            foreach ($mail->to as $toMail => $toName) {
                if (strstr($toMail, "mailcreate.space")) {
                    $toAdress = $toMail;
                }
            }
            $mailDetail = [];
            $mailDetail["mailID"] = $mailID;
            $mailDetail["fromName"] = $mail->fromName;
            $mailDetail["fromAddress"] = $mail->fromAddress;
            $mailDetail["subject"] = $mail->subject;
            $mailDetail["date"] = $mail->date;
            $mailDetail["html"] = $mail->textHtml;
            $mailDetail["toString"] = $mail->toString;
            $mailDetail["mail"] = $toAdress;
            $mailDetails[] = $mailDetail;
            $count++;
        }
        if ($count == 0 && $unseen != 1) {
            return "NO_DATA";
        } else {
            foreach ($mailDetails as $mailDetail) {
                $uuid = Str::uuid()->toString();
                Storage::disk('mails')->put($uuid . '.html', $mailDetail["html"]);
                $save = new Mail();
                $save->mail = $mailDetail["mail"];
                $save->fromName = $mailDetail["fromName"];
                $save->fromAddress = $mailDetail["fromAddress"];
                $save->subject = $mailDetail["subject"];
                $save->date = $mailDetail["date"];
                $save->uuid = $uuid;
                $save->toString = $mailDetail["toString"];
                $save->save();
                if (isset($save->id)) {
                    $mailbox->deleteMail($mailDetail["mailID"]);
                }
            }
        }
    }

}
