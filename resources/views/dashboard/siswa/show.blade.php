@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 aligh-self-center">
                    <h3>Siswa</h3>
                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
            <div class="col-3 d-flex justify-content-center align-items-center flex-colum">
                 <img src="{{asset('storage/siswa/'.$siswa->pas_poto)}}" class="img-fluid"  width=200px>
            </div>   
                <div class="col-6">
                <ul class="list-group">
                    <li class="list-group-item">NISN : {{ $siswa->nisn }}</li>
                    <li class="list-group-item">NIK : {{ $siswa->nik }}</li>
                    <li class="list-group-item">Nama : {{ $siswa->nama }}</li>
                    <li class="list-group-item">Asal Sekolah : {{ $siswa->asal_sekolah }}</li>
                    <li class="list-group-item">Agama : {{ $siswa->agama }}</li>
                    <li class="list-group-item">Tempat,Tanggal Lahir : {{ $siswa->ttl }}</li>
                    <li class="list-group-item">Alamat : {{ $siswa->alamat }}</li>
                    <li class="list-group-item">Jenis Kelamin : {{ $siswa->jenis_kelamin }}</li>
                </ul>
                    <td><a href="{{ route('dashboard.siswa', $siswa->id) }}" class="btn btn-primary m-2 btn-sm"></i>Cancel</a></td>
                    <td><a href="{{ route('dashboard.siswa.edit', $siswa->id) }}" class="btn btn-success btn-sm"></i>Edit</a></td>
                </div>
            </div>
        </div>
        <div class="form-group mt-4">
            
        </div>
    </div>
    @if(isset($siswa))
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus user {{$siswa->id_siswa}} </p>
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('dashboard.siswa.delete', $siswa->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection