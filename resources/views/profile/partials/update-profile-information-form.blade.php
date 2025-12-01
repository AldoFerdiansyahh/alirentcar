<section>
    <header style="margin-bottom: 25px; border-bottom: 1px solid #444; padding-bottom: 15px;">
        <h2 style="font-size: 1.5rem; color: #d9252c; font-weight: 600; margin: 0;">
            Informasi Profil
        </h2>
        <p style="color: #a0aec0; margin-top: 5px; font-size: 0.9rem;">
            Perbarui nama profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" style="color: #fff; margin-bottom: 8px; display: block;">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" style="background-color: #1a1a1a; color: white; border: 1px solid #444;">
            @if($errors->get('name'))
                <div style="color: #d9252c; font-size: 0.85rem; margin-top: 5px;">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="email" style="color: #fff; margin-bottom: 8px; display: block;">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" style="background-color: #1a1a1a; color: white; border: 1px solid #444;">
            @if($errors->get('email'))
                <div style="color: #d9252c; font-size: 0.85rem; margin-top: 5px;">{{ $errors->first('email') }}</div>
            @endif

            {{-- Bagian Verifikasi Email (Jika perlu) --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 10px;">
                    <p style="font-size: 0.9rem; color: #ccc;">
                        Email Anda belum diverifikasi.
                        <button form="send-verification" style="background: none; border: none; color: #d9252c; text-decoration: underline; cursor: pointer; padding: 0;">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: 5px; font-weight: 500; font-size: 0.9rem; color: #28a745;">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 15px; margin-top: 20px;">
            <button type="submit" class="btn-pesan" style="width: auto; padding: 10px 30px; margin: 0;">Simpan</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="font-size: 0.9rem; color: #28a745;">
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>