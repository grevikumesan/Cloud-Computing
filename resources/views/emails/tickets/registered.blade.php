<x-mail::message>
# Halo, {{ $ticketRegistration->name }}!

Terima kasih, registrasi tiket konser kamu sudah kami terima. Berikut detailnya:

<x-mail::table>
| Data | Keterangan |
|:-----|:-----------|
| No. Registrasi | #{{ $ticketRegistration->id }} |
| Nama | {{ $ticketRegistration->name }} |
| Email | {{ $ticketRegistration->email }} |
| Nomor HP | {{ $ticketRegistration->phone }} |
| Kategori | {{ $categoryLabel }} |
| Jumlah Tiket | {{ $ticketRegistration->quantity }} |
| Tanggal Daftar | {{ $ticketRegistration->created_at->format('d M Y, H:i') }} |
</x-mail::table>

Simpan email ini sebagai bukti registrasi.

Salam,<br>
{{ config('mail.from.name') }}
</x-mail::message>
