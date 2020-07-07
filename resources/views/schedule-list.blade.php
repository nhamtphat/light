@extends('master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hẹn giờ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>Tên nhiệm vụ</th>
                    <th>Thời gian</th>
                    <th>Lệnh</th>
                    <th>Độ sáng</th>
                    <th>Chỉnh sửa/Xoá</th>
                  </tr>
                  @php $i = 1; @endphp
                  @foreach($schedules as $schedule)
                  <tr>
                    <td>{{ $i++ }}.</td>
                    <td>{{ $schedule->name }}</td>
                    <td>{{ $schedule->time }}</td>
                    <td>
                      @if($schedule->state == 'on')
                      <div class="btn btn-success">Bật đèn</div>
                      @elseif($schedule->state == 'off')
                      <div class="btn btn-danger">Tắt đèn</div>
                      @elseif($schedule->state == 'setpercent')
                      <div class="btn btn-info">Chỉnh độ sáng</div>
                      @endif
                    </td>
                    <td>{{ $schedule->percent }}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button>
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop