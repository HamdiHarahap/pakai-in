<x-layout.auth :title="$title">
    <section class="min-h-screen flex items-center justify-center bg-slate-50 px-6">
        <div class="w-full max-w-md bg-white rounded-2xl border border-slate-200 px-10 py-12 shadow-sm">
            <div class="text-center mb-10">
                <h1 class="text-2xl font-semibold text-slate-900 mb-2">
                    Buat Akun Pakai-in
                </h1>
                <p class="text-sm text-slate-600">
                    Daftar untuk mulai menikmati pengalaman belanja terbaik.
                </p>
            </div>
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg px-4 py-3 mb-6 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama Anda"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-700
                               focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition"
                    >
                    @error('name')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-700
                               focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition"
                    >
                    @error('email')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Buat password anda"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-700
                               focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition"
                    >
                    @error('password')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="confirm" class="block text-sm font-medium text-slate-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        id="confirm"
                        name="confirm"
                        placeholder="Ulangi password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-700
                               focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition"
                    >
                    @error('confirm')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <button
                    type="submit"
                    class="w-full bg-emerald-600 text-white rounded-full py-3
                           font-medium hover:bg-emerald-700 transition"
                >
                    Daftar Sekarang
                </button>
            </form>
            <p class="text-center text-sm text-slate-600 mt-10">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-emerald-600 hover:underline font-medium">
                    Login
                </a>
            </p>
        </div>
    </section>
</x-layout.auth>
