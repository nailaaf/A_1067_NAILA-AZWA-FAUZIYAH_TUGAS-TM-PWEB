@props([
    'judul',
    'nilai',
    'ikon' => '',
    'warna' => 'var(--primary-color)'
])

<div class="card">
    <h3>
        @if($ikon)
            <span style="margin-right: 5px;">{!! $ikon !!}</span>
        @endif
        {{ $judul }}
    </h3>
    <p class="angka" style="color: {{ $warna }};">{{ $nilai }}</p>
</div>
