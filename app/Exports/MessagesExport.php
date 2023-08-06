<?php

namespace App\Exports;

use App\Models\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class MessagesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Message::oldest('received')->get();
    }

    public function map($message): array
    {
        if ($message->sender === 0) {
            $sender = 'Ulrieke naar '. $message->contact->name;
        } else {
            $sender = $message->contact->name.' naar Ulrieke';
        }
        return [
            $message->id,
            $message->message,
            $sender,
            $message->received,
            $message->contact->id,
            $message->sender,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Bericht',
            'Contact',
            'Ontvangen op',
            'Contact ID',
            'Sender'
        ];
    }
}
