<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')

    <p>
    <form action="/mutasikelas/cari" method="GET">
        <div class="form-group row">
            <label>
                Kelas Tahun Ajaran 
                @foreach($thnajaranawal as $thn)
                    {{$thn->thnajaran}}
                @endforeach
            </label>
        </div>

        <div class="form-group row">
            <div class="col-md-3">
                <select type="text" class="form-control" id="carikelas" name="carikelas" required>
                    <option></option>
                    @foreach($kelasawal as $k)
                        <option value="{{ $k->idkelasdetail}}">{{ $k->kelas->namakelas }}</option>
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