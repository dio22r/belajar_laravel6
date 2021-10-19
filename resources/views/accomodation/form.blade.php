@extends('layouts.main')

@section('title', 'Form Product')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form Akomodasi
        </div>
        <div class="card-body">

            <form method="get">
                <div class="row mb-3">
                    <label for="category_id" class="col-sm-2 col-form-label">Peserta</label>
                    <div class="col-sm-3">
                        <select name="mh_participant_id[]" class="form-select  @error('mh_participant_id') is-invalid @enderror" aria-label="Default select example">
                            <option value="" selected> -- </option>
                            @foreach ($participants as $participant)
                            <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                            @endforeach
                        </select>
                        @error('mh_participant_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-success">Pilih Peserta</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10 offset-sm-2">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Kontak</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selParticipants as $participant)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $participant->name }}
                                        <input type="hidden" name="mh_participant_id[]" value="{{ $participant->id }}" />
                                    </td>
                                    <td>{{ $participant->address }}</td>
                                    <td>{{ $participant->contact }}</td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-danger" name="hapus" value="{{ $participant->id }}">&times;</button>
                                    </td>
                                </tr>
                                @endforeach

                                @if (!$selParticipants)
                                <tr>
                                    <td class="text-center" colspan="5">Belum ada yang dipilih.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)


                @foreach ($selParticipants as $participant)
                <input type="hidden" name="mh_participant_id[]" value="{{ $participant->id }}" />
                @endforeach

                <div class="row mb-3">
                    <label for="location" class="col-sm-2 col-form-label">Lokasi Penginapan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('total') is-invalid @enderror" id="location" name="location" value="{{ $accomodation->location }}">
                        @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="room" class="col-sm-2 col-form-label">Kamar</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control @error('room') is-invalid @enderror" id="room" name="room" value="{{ $accomodation->room }}" />
                        @error('room')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ url('/accomodation') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
