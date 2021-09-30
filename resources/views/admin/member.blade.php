@extends('layouts.app')
@section('content')


<div class="card">
    <div class="card-header">
        <h3  class="card-title"> Member 
          <button class="btn btn-sm btn-info float-right created"><i class="fas fa-plus-circle"></i> Create</button></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="member" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Member</th>
                        <th>Jenis Kelamin</th>
                        <th>No Ktp</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-member">
              <input type="hidden" id="id" name="id">

              <div class="form-group row">
                <div class="col-md-6">
                    <label  for="">No KTP</label>
                    <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control">
                </div>
                
                <div class="col-md-6">
                      <label for="">Nama</label>
                      <input type="text" name="nama_member" id="nama_member" class="form-control">
                </div>
             </div>

             <div class="form-group row">
              <div class="col-md-6">
                  <label for="">Email</label>
                  <input type="text" name="email" id="email" class="form-control">
              </div>

              <div class="col-md-6">
                  <label for="">Password</label>
                  <input type="password" name="password" id="password" class="form-control">
              </div>  
             </div>

             <div class="form-group row">
              <div class="col-md-6">
                <label for="">No Hp</label>
                <input type="text" name="no_hp" id="no_hp"  class="form-control">
              </div>
             
              <div class="col-md-6">
                <label for="">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
              </div>
             </div>
            
             <div class="form-group row">
              <div class="col-md-6">
               <label for="">Jenis Kelamin</label>
               <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                 <option value="">Pilih</option>
                 <option value="L">Laki - laki</option>
                 <option value="P">Perempuan</option>
               </select>
             </div>

             <div class="col-md-6">
              <label for="">Foto Diri</label>
              <input type="file" name="foto" id="foto" class="form-control">
             </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="form-member" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img class="card-img-top foto-member" style="height: 200px;" src="" alt="Card image cap">
            <br>
            <table width="100%" class="view-member">
                
            </table>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script src="{{ asset('assets/admin/member.js') }}"></script>
@endsection