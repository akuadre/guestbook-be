<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Pembayaran SPP')
@section('title','Pembayaran SPP')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="55%">
                    
                </td>

                <td width="45%">
                    <form action="/spp/cari" method="GET">
                        <select type="text" class="form-control col-sm-9 float-right" name="sppcari" id="sppcari">
                            <option></option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->nis}}">{{ $s->nis }} | {{ $s->namasiswa }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="CARI" class="btn btn-primary">
                    </form>
                </td>
                
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#sppcari').select2({
                            placeholder: 'Cari NIS atau Nama Siswa',
                            allowClear: true
                        });
                    });
                </script>


                {{-- <td width="50%">
                    <form action="/spp/cari" method="GET">
                        <input type="text" name="sppcari" class="input-group-text col-sm-6 float-right"
                            placeholder="Masukan NIS ..." value="{{ old('nis') }}">
                        <input type="submit" value="CARI" class="btn btn-primary float-right">
                    </form>
                </td> --}}
            </tr>
        </table>

        <p>
    


    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->