<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')

    <p>
    <form action="/siswadetail/cari" method="GET">
        <div class="form-group row">
            <div class="col-md-3">
                <select type="text" class="form-control" id="carisiswa" name="carisiswa">
                    <option></option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->idsiswa}}">{{ $s->nis }} | {{ $s->namasiswa }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="CARI" class="btn btn-primary">
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#carisiswa').select2({
                placeholder: 'Pilih Siswa',
                allowClear: true
            });
        });
    </script>

    <p>


@endsection
<!--akhir isi konten dinamis-->