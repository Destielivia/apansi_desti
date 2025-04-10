@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h3>Siswa</h3>

                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8 offset-md-2">
            <form method="post" action="{{ route($url, $siswa->id ?? '' ) }}" enctype="multipart/form-data">
                @csrf
                @if(isset($siswa))
                    @method('put')
                @endif

                    <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}">
                            @error('nisn')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" value="{{ old('nik', $siswa->nik ?? '') }}">
                        @error('nik')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama', $siswa->nama ?? '') }}">
                        @error('nama')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="asal_sekolah">Asal Sekolah</label>
                        <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah ?? '') }}">
                        @error('asal_sekolah')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" name="agama" value="{{ old('agama', $siswa->agama ?? '') }}">
                        @error('agama')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $siswa->alamat ?? '') }}">
                        @error('alamat')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ttl">Tempat Tanggal Lahir</label>
                        <input type="text" class="form-control" name="ttl" value="{{ old('ttl', $siswa->ttl ?? '') }}">
                        @error('ttl')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="custom-file">
                        <input type="file" name="pas_poto" class="custom-file-input">
                        <label for="pas_poto" class="custom-file-label">Pas Poto</label><br><div class="text-danger">*pas poto HARUS DIISII</div>
                        @error('pas_poto')
                             <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-4">
                        <button type="button" onclick="window.history.back()" class="btn btn-sm btn-primary button-spacing">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm m-4">{{ $button }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(isset($siswa))
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Siswa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus siswa {{ $siswa->nama }}?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('dashboard.siswa.delete', $siswa->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection