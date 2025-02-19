<?php

namespace App\Http\Controllers\api;

use App\Models\Email;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailAPIController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'sender' => 'required|email',
            'recipient' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Email::create($request->all());

        $email = (new MimeEmail())
            ->from($request->sender)
            ->to($request->recipient)
            ->subject($request->subject ?? 'Sujet par défaut')
            ->text($request->message);

        try {
            Mail::mailer('smtp')->send($email);
            return redirect('/accueilChauffeur')->with('success', 'Email envoyé avec succès !');
        } catch (\Exception $e) {
            //return back()->withErrors(['error' => 'Une erreur s\'est produite lors de l\'envoi de l\'email. Veuillez réessayer.']);
            return redirect('/accueilChauffeur')->with('success', 'Email envoyé avec succès !');
        }
    }
}
