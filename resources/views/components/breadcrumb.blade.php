@php
    $segments = request()->segments(); // contoh: ['admin', 'users', 'edit']
    $url = url('/');
@endphp

<nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex gap-4">
        {{-- <li><a href="{{ url('/') }}" class="text-blue-600 hover:underline"><i class="fas fa-home"></i> Home</a></li> --}}

        @foreach ($segments as $index => $segment)
            @php
                $url .= '/' . $segment;
                $name = ucwords(str_replace('-', ' ', $segment));
            @endphp
            <i class="fas fa-angle-right font-bold"></i>

            @if ($loop->last)
                {{-- <li><span class="mx-2">/</span></li> --}}
                <li class="text-gray-800 font-medium">{{ $name }}</li>
            @else
                {{-- <i class="fas fa-chevron-right"></i> --}}
                <li><a href="{{ $url }}" class="text-blue-600 font-medium hover:underline">{{ $name }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
