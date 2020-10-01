@extends('admin.layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Danh sách tuyến đèn</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      @if (session('error'))
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-warning"></i> Thông báo!</h5>
        {{ session('error') }}
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Nhập thông tin biên nhận</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('user.streets.store')}}" method="post">
              @csrf
              <div class="card-body" id="form-field">
                <div class="form-group">
                  <label for="province_id">Tỉnh / Thành phố: <span class="text-red">*</span></label>
                  <select name="province_id" id="province_id" onchange="getDistrictList()" class="form-control"
                    required>
                    <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                    @foreach ($provinces as $province)
                    <option value="{{$province->id}}">{{$province->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="district_id">Quận/Huyện: <span class="text-red">*</span></label>
                  <select id="district_id" name="district_id" onchange="getWardList()" class="form-control" required>
                    <option value="" disabled selected>Chọn quận/huyện</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ward_id">Phường/Xã: <span class="text-red">*</span></label>
                  <select id="ward_id" name="ward_id" class="form-control" required>
                    <option value="" disabled selected>Chọn phường/xã</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Tên tuyến đường: <span class="text-red">*</span></label>
                  <input name="name" type="text" class="form-control" id="name"
                    placeholder="Tên tuyến đường hoặc cụm đèn" value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                  <label for="domain">Tên miền / Địa chỉ IP: <span class="text-red">*</span></label>
                  <input name="domain" type="text" class="form-control" id="domain" placeholder="Tên miền / Địa chỉ IP"
                    value="{{old('domain')}}" required>
                </div>
                <div class="form-group">
                  <label for="lamps">Danh sách đèn: <span class="text-red">*</span></label>
                </div>
                @foreach(old('lamp_uid') ?? [] as $uid)
                <div class="form-group">
                  <div class="input-group">
                    <input type="number" name="lamp_uid[]" class="form-control" placeholder="UID của đèn"
                      value="{{$uid}}" required>
                    <span class="input-group-append">
                      <input type="button" class="btn btn-danger remove-field" value="Xoá dòng này">
                    </span>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="card-body">
                <div id="add-field" type="submit" class="btn btn-default">Thêm đèn</div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Lưu thông tin đường</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop

@section('scripts')
<script>
  function addField() {
    $("#form-field").append('<div class="form-group"><div class="input-group"><input type="number" name="lamp_uid[]" class="form-control" placeholder="UID của đèn" required><span class="input-group-append">\
                    <input type="button" class="btn btn-danger remove-field" value="Xoá dòng này" ></span></div></div>');
  }
  
  addField()
  $("#add-field").click(function() {addField()});

  $(document).on("click", ".remove-field", function() {
    $(this).closest(".form-group").remove();
  });
</script>

<script>
  function getDistrictList() {
    var matp = document.getElementById("province_id").value;
    $.ajax({url: '/api/getdistricts/'+matp}).done(function(data) {
      $("#district_id").html('<option value="" disabled selected>Chọn quận/huyện</option>');
        var obj  =JSON.parse(data);
      obj.forEach(function(element) {
        $("#district_id").append('<option value="'+element['id']+'">'+element['name']+'</option>');
      });
    });;
  }
  function getWardList() {
    var maqh = document.getElementById("district_id").value;
    $.ajax({url: '/api/getwards/'+maqh}).done(function(data) {
      $("#ward_id").html('<option value="" disabled selected>Chọn xã/phường/thị trấn</option>');
        var obj  =JSON.parse(data);
      obj.forEach(function(element) {
        $("#ward_id").append('<option value="'+element['id']+'">'+element['name']+'</option>');
      });
    });;
  }
</script>
@stop