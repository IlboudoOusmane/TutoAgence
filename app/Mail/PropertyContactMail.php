<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyContactMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(public Property $property, public array $data) // Crée une nouvelle instance du message.
    {
    }


    public function envelope(): Envelope // Obtient l'enveloppe du message (sujet, expéditeur, etc.).
    {
        return new Envelope(
          to: 'admin@jean.fr',
          replyTo: $this->data['email'],
          subject: 'Property Contact Mail'
        );

    }


    public function content(): Content // Obtient la définition du contenu du message (vue Markdown, etc.).
    {
        return new Content(
            markdown: 'emails.property.contact', // Chemin vers la vue markdown pour l'email
        );
    }


    public function attachments(): array // Obtient les pièces jointes pour le message et Retourne un tableau des pièces jointes
    {
        return [];
    }
}
