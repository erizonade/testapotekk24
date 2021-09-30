<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Silakan Login</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/sweetalert2/sweetalert2.min.css') }}">
</head>
<body style="background-color: ">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-5">
                <div class="card card-outline">
                    <div class="card-header">
                        <h3>Silakan Login</h3>
                    </div>
                    <div class="card-body shadow rounded">
                        <form id="form-login-user">
        
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" id="email" placeholder="Masukkan Email" name="email" class="form-control" value="">
                            </div>
        
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" id="password" placeholder="Masukan Password" name="password" class="form-control" value="">
                            </div>
        
                        </form>
                        <hr>
                        <div class="form-group">
                               <button type="submit" form="form-login-user" class="btn btn-info"><i class="fas fa-sign-in-alt"></i>  Login</button>
                        </div>
                        <a type="button" class="modal-member">Register Member</a>
                    </div>
                </div>
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
    
<script src="{{ asset('assets/dist/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/jquery-form/jquery.form.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dist/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/commons.js') }}"></script>
<script src="{{ asset('assets/auth.js') }}"></script>

</body>
</html>