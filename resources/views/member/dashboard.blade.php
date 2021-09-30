@extends('layouts.app')
@section('content')

<center>
    <div class="col-4">
        <div class="card" >
            <img class="card-img-top" src="{{ asset('/data/images/'.$member->foto) }}" style="height: 200px;"  alt="Card image cap">
            <div class="card-body">
                <h5>Data Member Login</h5>
                <hr>
                <table width="100%" class="view-member">
                    <tr>
                        <td>Nama  </td><td> : </td><td>{{ $member->nama_member }}</td>
                       </tr>
                       <tr>
                        <td>Email </td><td> : </td><td>{{ $member->email }}</td>
                       </tr>
                       <tr>
                        <td>No Hp </td><td> : </td><td>{{ $member->no_hp }}</td>
                       </tr>
                       <tr>
                        <td>No Ktp </td><td> : </td><td>{{ $member->nomor_ktp }}</td>
                       </tr>
                       <tr>
                        <td>Tanggal Lahir </td><td> : </td><td>{{ $member->tanggal_lahir }}</td>
                       </tr>
                       <tr>
                        <td>Jenis Kelamin </td><td> : </td><td>({{ ($member->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') }}</td>
                       </tr>
                </table>
            </div>
        </div>
    </div>
</center>

@endsection

@section('script')
    <script src="{{ asset('assets/guest/book_filter.js') }}"></script>
@endsection