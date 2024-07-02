@extends('Layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-lock"></i> Change Password</h4>
        </div>
        <div data-session="{{ session('loginError') }}"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('profile.change-password', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="old-password">Password Lama</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                name="old_password" id="old-password">
                            @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new-password">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation">
                            <div class="text-danger passwordConfirm d-none">Password Konfirmasi Tidak Cocok</div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            const loginError = $('div[data-session]').data('session');
            if (loginError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Password Lama Tidak Sesuai!"
                })
            }



            $(document).on('keyup', '#password_confirmation', function() {
                let password = $('#password').val();
                let password_confirmation = $('#password_confirmation').val();

                if (password != password_confirmation) {
                    $('.passwordConfirm').removeClass('d-none');
                } else {
                    $('.passwordConfirm').addClass('d-none');
                }
            })

        })
    </script>
@endpush
