<h2>Halo, {{ $staf->nama }}</h2>

<p>Terima kasih telah mengajukan permintaan inventaris pada tanggal <strong>{{ $tanggal }}</strong>.</p>

<p>Berikut detail item yang diajukan:</p>

<ul>
    @foreach($items as $item)
        <li>{{ $item['name'] }} - Jumlah: {{ $item['quantity'] }}</li>
    @endforeach
</ul>

<p>Status pengajuan Anda saat ini: <strong>Pending</strong>.</p>

<p>Terima kasih,</p>
<p>Tim Inventaris Kesbangpol</p>
