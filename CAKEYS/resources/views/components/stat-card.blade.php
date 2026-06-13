{{-- @props([
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
</div> --}}

@props([
    'judul',
    'nilai',
    'ikon' => '',
    'warna' => 'var(--primary-color)',
    'link' => '#'
])

<a href="{{ $link }}" style="text-decoration: none; color: inherit; display: block; height: 100%; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">

    <div class="card" style="height: 100%; box-sizing: border-box;">
        <h3>
            @if($ikon)
                <span style="margin-right: 5px;">{!! $ikon !!}</span>
            @endif
            {{ $judul }}
        </h3>
        <p class="angka" style="color: {{ $warna }};">{{ $nilai }}</p>
    </div>

</a>
