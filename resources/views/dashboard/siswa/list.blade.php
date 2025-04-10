@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href ="{{route('dashboard.siswa.create')}}" class="btn btn-primary">+ Siswa</a>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        <strong>{{session()->get('message')}}</strong>
        <button type="button" class="btn-close" data-dismiss="alert">
        </button>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Siswa</h3>
                </div>
                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.siswa') }}">
                        <div class="input-grup">
                            <input type="text" class="form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <div class="input-grup-append">
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($siswas->total())
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pas poto</th>
                            <th>Nama</th>
                            <th>Agama</th>
                            <th>Asal Sekolah</th>
                            <th>Selengkapnya</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                        <tr>
                            <th>{{ ($siswas->currentPage() -1) * $siswas->perPage() + $loop->iteration }}</td>
                            <td class="col-pas_poto">
                                <img src="{{ asset('storage/siswa/'.$siswa->pas_poto)}}" class="img-fluid" width="100px">
                            </td>
                            <td>{{  $siswa->nama}}</td>
                            <td>{{  $siswa->agama}}</td>
                            <td>{{  $siswa->asal_sekolah}}</td>
                            <td><a href="{{ route('dashboard.siswa.show', $siswa->id) }}" class="btn btn-info text-white btn"><i class="fas fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                </body>
            </table>
            {{ $siswas->links() }}
        @else
            <h5 class="text-center p-3">Belum ada data Siswa</h5>
        @endif
        </div>
    </div>

@endsection