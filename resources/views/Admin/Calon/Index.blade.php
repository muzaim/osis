@extends('Admin.Layouts.Main')

@section('konten')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h2 class="m-0 font-weight-bold text-primary d-inline">Data Calon Ketua Osis</h2>
            <a href="/admin/calon/create" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="35%">Nama</th>
                            <th width="10%">Kelas</th>
                            <th width="35%">Jurusan</th>
                            <th width="5%">Detail</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataCalon as $dc)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $dc->nama }}</td>
                                <td class="text-center">{{ $dc->kelas }}</td>
                                <td>{{ $dc->jurusan->nama }}</td>
                                <td class="text-center">
                                    {{-- <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <span class="fa fa-eye">
                                    </button> --}}
                                    <a id="set_dtl" class="btn btn-info" data-target="#exampleModal" data-toggle="modal"
                                        data-nisn="{{ $dc->nisn }}" data-nama="{{ $dc->nama }}"
                                        data-kelas="{{ $dc->kelas }}" data-jurusan="{{ $dc->jurusan->nama }}"
                                        data-jenkel="{{ $dc->jenkel }}" data-visimisi="{{ $dc->visimisi }}"
                                        data-foto="{{ $dc->foto }}"><span class=" fa fa-eye"></a>

                                </td>
                                <td class="text-center">
                                    <a href="/admin/calon/{{ $dc->id }}/edit" class="btn btn-warning"><span
                                            class="fa fa-edit"></span></a>
                                    <form action="/admin/calon/{{ $dc->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger "><span class="fa fa-trash"></span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header btn-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Data Calon Ketua Osis
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Nisn : </b><span id="nisn"></span></li>
                                <li class="list-group-item"><b>Kelas : </b><span id="kelas"></li>
                                <li class="list-group-item"><b>Jurusan : </b><span id="jurusan"></li>
                                <li class="list-group-item"><b>Jenkel : </b><span id="jenkel"></li>
                                <li class="list-group-item"><b>Visi & Misi : </b><span id="visimisi"></li>
                                <img id="foto" src="" alt="">
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script> --}}

    <script>
        $(document).ready(function() {
            $(document).on('click', '#set_dtl', function() {
                var nisn = $(this).data('nisn');
                var nama = $(this).data('nama');
                var kelas = $(this).data('kelas');
                var jurusan = $(this).data('jurusan');
                var jenkel = $(this).data('jenkel');
                var visimisi = $(this).data('visimisi');
                var foto = $(this).data('foto');
                console.log(foto);
                $('#nisn').text(nisn);
                $('#nama').text(nama);
                $('#kelas').text(kelas);
                $('#jurusan').text(jurusan);
                $('#jenkel').text(jenkel);
                $('#visimisi').text(visimisi);
                $('#foto').src = foto;
            })
        })
    </script>
@endsection
