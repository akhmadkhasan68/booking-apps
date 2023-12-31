@extends('admin.admin')
@section('title')

@endsection
@section('content')
<div class="container">
    <div class="card-body">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('usermanagement') }}" class="btn btn-danger mb-5">Back</a>
            <div class="card">
                <div class="card-header">
                    Create User
                </div>

                <div class="card-body">
                    <form action="{{ route('storeuser') }}" method="POST" >
                       @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Masukan Nama</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-10" placeholder="Masukan Nama" id="name" name="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Masukan Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control col-md-10" placeholder="Masukan Email" id="email" name="email">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Masukan Password</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-10" placeholder="Masukan Password" id="password" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">ROLE</label>

                            <div class="col-md-6">
                                <div class="col-md-5">
                                    <select class="form-control col-md-10" name="roles">
                                        <option selected>------ Role ------</option>
                                        @php
                                            $optionsAdded = 0;
                                        @endphp
                                        @foreach ($users as $user)
                                            {{-- Hanya tampilkan opsi "admin" dan "member" --}}
                                            @if(in_array($user->roles, ['ADMIN', 'MEMBER']) && $optionsAdded < 2)
                                                <option value="{{ $user->roles }}">{{ $user->roles }}</option>
                                                @php
                                                    $optionsAdded++;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Masukan Divisi</label>

                            <div class="col-md-6">
                                <div class="col-md-5">
                                    <select class="form-control col-md-10" name="division_id">
                                        <option selected>------ Silahkan Pilih divisi ------</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Masukan No HP</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-10" placeholder="Phone" id="phone" name="phone" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Masukan Jenis Kelamin</label>

                            <div class="col-md-6">
                                {{-- <input type="text" class="form-control col-md-10" placeholder="Gender" id="name" name="name" value=""> --}}
                                <select class="form-control col-md-10" name="gender" id="gender">
                                    <option value="MALE">Laki-laki</option>
                                    <option value="FEMALE">Perempuan</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Masukan Alamat</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-10" placeholder="Address" id="address" name="address" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Masukan NIP</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-10" placeholder="Masukan NIP" id="nip" name="nip" value="">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="addUser()">
                                    Create User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@show

{{-- @section('js')
<script>
    const addUser = () => {
        alert ('Success');
    }

    $(document).on("click", ".button-delete-facility", function() {
        $(this).parents().remove(".facility-wrapper");
    });

    $(document).on('submit', "#formuser", function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const method = form.attr('method');
        const redirect = '{{ route("usermanagement") }}';
        const data = new FormData(form[0]);

        submitForm(url, method, data, redirect);
    })
</script> --}}
