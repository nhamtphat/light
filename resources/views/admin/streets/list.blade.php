@extends('admin.layouts.master')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bảng điều khiển</h1>
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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách tuyến đường</h3>
              <a href="{{ route('user.streets.create') }}" class="btn btn-primary float-right">Thêm mới</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tuyến/cụm đèn đường</th>
                  <th>Phường/Xã</th>
                  <th>Quận/Huyện</th>
                  <th>Tỉnh/Thành phố</th>
                  <th width="100px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($streets as $street)
                <tr>
                  <td>{{$street->name}}</td>
                  <td>{{$street->ward->name}}</td>
                  <td>{{$street->district->name}}</td>
                  <td>{{$street->province->name}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('user.streets.edit', ['street' => $street->id]) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                      <a href="{{ route('user.streets.delete', ['street' => $street->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable_parameters.js') }}"></script>
<script>
  $(function () {
    $('#example2').DataTable(datatable_parameters);
  });
</script>
@stop