@extends('Admin.Layouts.Main')

@section('konten')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Edit Data Calon Ketua Osis</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/calon/{{ $dataCalon->id }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN :</label>
                    <input value="{{ old('nisn', $dataCalon->nisn) }}" type="text"
                        class="form-control @error('nisn')
                        is-invalid
                    @enderror"
                        id="nisn" name="nisn">
                    @error('nisn')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama :</label>
                    <input value="{{ old('nama', $dataCalon->nama) }}" type="text"
                        class="form-control @error('nama')
                    is-invalid
                @enderror"" id="
                        nama" name="nama">
                    @error('nama')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas :</label>
                    <select
                        class="form-control @error('kelas')
                    is-invalid
                @enderror"" aria-label="
                        Default select example" name="kelas">
                        @if (old('kelas', $dataCalon->kelas))
                            <option value="{{ $dataCalon->kelas }}" selected>{{ $dataCalon->kelas }}</option>
                        @else
                            <option selected>-- Pilih --</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        @endif
                    </select>
                    @error('kelas')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan :</label>
                    <select
                        class="form-control @error('jurusan')
                    is-invalid
                @enderror"" id="
                        jurusan"
                        aria-label="
                                                                                                                                                                                                                        Default select example"
                        name="jurusan">
                        <option selected>-- Pilih --</option>
                        @foreach ($dataJurusanOnly as $dj)
                            @if (old('jurusan', $dj->id) == $dj->id)
                                <option value="{{ $dj->id }}" selected>{{ $dj->nama }}</option>
                            @else
                                <option value="{{ $dj->id }}">{{ $dj->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('jurusan')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenkel" class="form-label">Jenkel :</label>
                    <select
                        class="form-control @error('jenkel')
                    is-invalid
                @enderror"" aria-label="
                        Default select example" id="jenkel" name="jenkel">
                        <option selected>-- Pilih --</option>
                        @if (old('jenkel', $dataCalon->jenkel))
                            <option value="{{ $dataCalon->jenkel }}" selected>{{ $dataCalon->jenkel }}</option>
                        @else
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @endif
                    </select>
                    @error('jenkel')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label d-block">Foto :</label>
                    <input type="hidden" name="oldFoto" value="{{ $dataCalon->foto }}">
                    @if ($dataCalon->foto)
                        <img class="img-preview img-fluid mb-3 col-sm-5" alt=""
                            src="{{ asset('/storage/' . $dataCalon->foto) }}">
                    @else
                        <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                    @endif
                    <input
                        class="form-control @error('foto')
                        is-invalid
                    @enderror"
                        type="file" id="foto" name="foto" onchange="previewImage()">
                    @error('foto')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="visimisi" class="form-label">Visi & Misi :</label>
                    <input id="visimisi" type="hidden" name="visimisi"
                        value="{{ old('visimisi', $dataCalon->visimisi) }}">
                    <trix-editor input="visimisi"></trix-editor>
                    @error('visimisi')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
