@extends('layouts.app')

@section('title', 'Registrasi Tiket Konser')

@section('content')
<div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Registrasi Tiket Konser</h1>
        <p class="mt-1 text-sm text-slate-500">Isi data di bawah untuk memesan tiket. Kolom bertanda <span class="text-red-600">*</span> wajib diisi.</p>
    </header>

    @if (session('success'))
        <div role="status" class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div role="alert" class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            Periksa kembali isian yang ditandai merah.
        </div>
    @endif

    <form method="POST" action="{{ route('tickets.store') }}" class="space-y-5" novalidate>
        @csrf

        <div>
            <label for="name" class="mb-1 block text-sm font-medium">Nama Lengkap <span class="text-red-600">*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required
                placeholder="Sesuai KTP"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                class="w-full rounded-lg border px-3 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @else border-slate-300 @enderror">
            @error('name') <p id="name-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email <span class="text-red-600">*</span></label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required
                placeholder="nama@email.com"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                class="w-full rounded-lg border px-3 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @else border-slate-300 @enderror">
            @error('email') <p id="email-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="phone" class="mb-1 block text-sm font-medium">Nomor HP <span class="text-red-600">*</span></label>
            <input id="phone" name="phone" type="tel" inputmode="numeric" value="{{ old('phone') }}" autocomplete="tel" required
                placeholder="081234567890"
                @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror
                class="w-full rounded-lg border px-3 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500 @error('phone') border-red-500 @else border-slate-300 @enderror">
            @error('phone') <p id="phone-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <label for="category" class="mb-1 block text-sm font-medium">Kategori <span class="text-red-600">*</span></label>
                <select id="category" name="category" required
                    @error('category') aria-invalid="true" aria-describedby="category-error" @enderror
                    class="w-full rounded-lg border bg-white px-3 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500 @error('category') border-red-500 @else border-slate-300 @enderror">
                    <option value="" disabled @selected(! old('category'))>Pilih kategori</option>
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category') <p id="category-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="quantity" class="mb-1 block text-sm font-medium">Jumlah <span class="text-red-600">*</span></label>
                <input id="quantity" name="quantity" type="number" min="1" max="4" value="{{ old('quantity', 1) }}" required
                    @error('quantity') aria-invalid="true" aria-describedby="quantity-error" @enderror
                    class="w-full rounded-lg border px-3 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500 @error('quantity') border-red-500 @else border-slate-300 @enderror">
                @error('quantity') <p id="quantity-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <p class="-mt-3 text-xs text-slate-500">Maksimal 4 tiket per pemesanan.</p>

        <button type="submit"
            class="w-full rounded-lg bg-indigo-600 px-4 py-3 font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Daftar Sekarang
        </button>
    </form>
</div>
@endsection
