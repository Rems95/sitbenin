@extends('admin.layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">

    @can('add_event')
    <div class="mb-2">
      <a href="{{ route('event.create') }}" class="btn btn-primary ml-auto">
        <i class="fa fa-plus"></i> Add New
      </a>
    </div>
    @endcan

    @include('admin.layouts.flash')

    <div class="shadow card ">

      <div class="card-header">
        <i class="fa fa-align-justify"></i> event
      </div>

      <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>IMAGE</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {

      var table = $('.yajra-datatable').DataTable({
          processing: true,
          responsive:true,
          ajax: "{{ route('event.list') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {
                  data: 'image',
                  name: 'image',
                  orderable: false,
                  searchable: false
              },

              {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false
              },
          ]
      });

    });

  </script>

@endsection

