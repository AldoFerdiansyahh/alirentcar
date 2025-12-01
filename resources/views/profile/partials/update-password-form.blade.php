<section>
    <header style="margin-bottom: 25px; border-bottom: 1px solid #444; padding-bottom: 15px;">
        <h2 style="font-size: 1.5rem; color: #d9252c; font-weight: 600; margin: 0;">
            Update Password
        </h2>
        <p style="color: #a0aec0; margin-top: 5px; font-size: 0.9rem;">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" style="color: #fff; margin-bottom: 8px; display: block;">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" style="background-color: #1a1a1a; color: white; border: 1px solid #444;">
            @if($errors->updatePassword->get('current_password'))
                <div style="color: #d9252c; font-size: 0.85rem; margin-top: 5px;">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password" style="color: #fff; margin-bottom: 8px; display: block;">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" style="background-color: #1a1a1a; color: white; border: 1px solid #444;">
            @if($errors->updatePassword->get('password'))
                <div style="color: #d9252c; font-size: 0.85rem; margin-top: 5px;">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" style="color: #fff; margin-bottom: 8px; display: block;">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" style="background-color: #1a1a1a; color: white; border: 1px solid #444;">
            @if($errors->updatePassword->get('password_confirmation'))
                <div style="color: #d9252c; font-size: 0.85rem; margin-top: 5px;">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 15px; margin-top: 20px;">
            <button type="submit" class="btn-pesan" style="width: auto; padding: 10px 30px; margin: 0;">Simpan</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="font-size: 0.9rem; color: #28a745;">
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>