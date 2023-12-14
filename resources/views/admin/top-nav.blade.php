@extends('admin.layout.app1')

@section('content')
    <div class="container pt-4">
        <div class="d-flex bd-highlight">
            <div class="bd-highlight">
                <h1 class="pb-3">User List</h1>
            </div>
            <div class="ms-auto bd-highlight">
                <a href="{{ route('user.create') }}" class="btn btn-secondary"> Add User +</a>
            </div>
        </div>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('show.admin.dashboard') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
        
    });
  </script>
@endsection