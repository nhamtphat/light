@extends('admin.layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Bộ hẹn giờ</h1>
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
                <h3 class="card-title">Nhập thông tin hẹn giờ</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('user.schedules.store')}}" method="post">
                {{csrf_field()}}
                <div class="card-body" id="form-field">
                  <div class="form-group">
                    <label for="name">Đặt tên: <span class="text-red">*</span></label>
                    <input name="name" type="text" class="form-control" id="name" required>
                  </div>
                  <div class="form-group">
                    <label for="name">Thời gian: <span class="text-red">*</span></label>
                    <input type="time" name="time" class="form-control" id="time" required>
                  </div>
                  <div class="form-group">
                    <label for="staff_id">Lệnh: <span class="text-red">*</span></label>
                    <select name="state" id="staff_id" class="form-control select2" style="width: 100%;">
                      <option value="setpercent">Chỉnh độ sáng</option>
                      <option value="off">Tắt đèn</option>
                      <option value="on">Bật đèn</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Độ sáng (0-10): <span class="text-red">*</span></label>
                    <input name="percent" type="number" min="0" max="10" class="form-control" id="name" required>
                  </div>
                </div> 
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Lưu</button>
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
@stop