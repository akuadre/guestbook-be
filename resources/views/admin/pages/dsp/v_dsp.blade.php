<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Pembayaran DSP')
@section('title','Pembayaran DSP')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="55%">
                    
                </td>


                <td width="45%">
                    <form action="/dsp/cari" method="GET">
                        <select type="text" class="form-control col-sm-9 float-right" name="dspcari" id="dspcari">
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
                        $('#dspcari').select2({
                            placeholder: 'Cari NIS atau Nama Siswa',
                            allowClear: true
                        });
                    });
                </script>

            </tr>
        </table>

        <p>
    


    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->