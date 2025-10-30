<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')

    <p>
    <div class="row">
        {{-- AWAL MEMBUAT TABEL ASAL KELAS --}}
                
        <div class="col-md-6">
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
                    <div class="col-md-6">
                        <select type="text" class="form-control" id="carikelas" name="carikelas">
                            <option value="{{ $kelasawal1->idkelasdetail}}">{{ $kelasawal1->kelas->namakelas }}</option>
                            @foreach($kelasawal2 as $ka2)
                                <option value="{{ $ka2->idkelasdetail}}">{{ $ka2->kelas->namakelas}}</option>
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
            {{-- AWAL SINTAK JAVA SCRIPT UNTUK PILIH SEMUA --}}
            <script type="text/javascript">
                function pilihsemua(pil) {
                    var checkboxes = document.getElementsByTagName('input');
                    if (pil.checked) 
                    {
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].type == 'checkbox' ) {
                                checkboxes[i].checked = true;
                            }
                        }
                    } 
                    else 
                    {
                        for (var i = 0; i < checkboxes.length; i++) 
                        {
                            if (checkboxes[i].type == 'checkbox') 
                            {
                                checkboxes[i].checked = false;
                            }
                        }
                    }
                }
            </script>
            {{-- AKHIR SINTAK JAVA SCRIPT UNTUK PILIH SEMUA --}}
            
            <!-- Awal membuat table-->
            <table class="table table-bordered table-striped table-hover table-sm" id="table-siswakelas">
                <!-- Awal header table-->
                <thead height="75px">
                        <th>
                            <center>Pilih Semua<p><input type="checkbox"></p></center>
                        </th>
                        
                        <th >
                            <center>No</center>
                        </th>

                        <th>
                            <center>NIS</center>
                        </th>

                        <th>
                            <center>Nama Siswa</center>
                        </th>
                    </tr>
                </thead>
                <!-- Akhir header table-->

                <!-- Awal menampilkan data dalam table-->
                <tbody>
                    @foreach ($siswakelasawal as $index => $ska)
                        <tr>
                            <td align="center"><input type="checkbox"></td>
                            <td align="center" scope="row">
                                {{ $index + 1}}
                            </td>
                            <td align="center">
                                {{ $ska->siswa->nis }}
                            </td>
                            <td>
                                {{ $ska->siswa->namasiswa }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <!-- Akhir menampilkan data dalam table-->
            </table>
        </div>
        {{-- AKHIR MEMBUAT TABEL ASAL KELAS --}}


        {{-- AWAL MEMBUAT TABEL KELAS TUJUAN --}}
        <div class="col-md-6">
            <form action="/mutasikelas/proses" method="get">
                <div class="form-group row">
                    <label>
                        Kelas Tahun Ajaran 
                        {{Session::get('namatahunajaran')}}
                    </label>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        
                        <select type="text" class="form-control" id="carikelastujuan" name="carikelastujuan" required>
                            <option value="{{ $kelastujuan1}}">{{$kelastujuan1->kelas->namakelas}}</option>
                            @foreach($kelastujuan2 as $kt)
                                <option value="{{ $kt->idkelasdetail}}">{{ $kt->kelas->namakelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="PROSES" class="btn btn-primary">
                </div>
            </form>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#carikelastujuan').select2({
                        placeholder: 'Pilih Kelas',
                        allowClear: true
                    });
                });
            </script> 

            <p>
            <!-- Awal membuat table-->
            <table class="table table-bordered table-striped table-hover table-sm" id="table-siswakelas">
                <!-- Awal header table-->
                <thead height="75px">             
                        <th >
                            <center>No</center>
                        </th>

                        <th>
                            <center>NIS</center>
                        </th>

                        <th>
                            <center>Nama Siswa</center>
                        </th>
                    </tr>
                </thead>
                <!-- Akhir header table-->

                <!-- Awal menampilkan data dalam table-->
                <tbody>
                    @foreach ($siswakelasproses as $index => $skp)
                        <tr>
                            <td align="center" scope="row">{{ $index + 1}}</td>
                            <td align="center">{{$skp->siswa->nis}}</td>
                            <td>{{$skp->siswa->namasiswa}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <!-- Akhir menampilkan data dalam table-->
            </table>  
        </div>
        {{-- AKHIR MEMBUAT TABEL KELAS TUJUAN --}}
    </div>



@endsection
<!--akhir isi konten dinamis-->