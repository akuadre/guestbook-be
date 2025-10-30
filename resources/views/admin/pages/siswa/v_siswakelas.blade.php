<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')

    <p>

    {{-- <form action="/siswakelas/cari" method="GET">
        <div class="form-group row">
            <div class="col-sm-3">
                <input type="text" name="carikelas" id="carikelas" class="input-group-text" placeholder="Cari Kelas Siswa .."
            value="{{ old('siswakelascari') }}">
            </div>
            <input type="submit" value="CARI" class="btn btn-primary">
        </div>
    </form> --}}


    <form action="/siswakelas/cari" method="GET">
        <div class="form-group row">
            <div class="col-md-3">
                <select type="text" class="form-control" id="carikelas" name="carikelas">
                    <option></option>
                    @foreach($kelasdetail as $kd)
                        <option value="{{ optional($kd->kelas)->namakelas}}">{{ optional($kd->kelas)->namakelas }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="CARI" class="btn btn-primary">
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#carikelas').select2({
                placeholder: 'Pilih Kelas',
                allowClear: true
            });
        });
    </script>

    <p>


@endsection
<!--akhir isi konten dinamis-->