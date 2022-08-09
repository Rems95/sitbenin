@extends('admin.layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">

    @can('add_adherant')
    <div class="mb-2">
      <a href="{{ route('adherant.create') }}" class="btn btn-primary ml-auto">
        <i class="fa fa-plus"></i> Add New
      </a>
    </div>
    @endcan

    @include('admin.layouts.flash')

    <div class="shadow card ">

      <div class="card-header">
        <i class="fa fa-align-justify"></i> Adherant
      </div>

      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive table-bordered yajra-datatable" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Sous-categorie</th>
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
          ajax: "{{ route('adherant.list') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {
                  data: 'Sous-categorie',
                  name: 'Sous-categorie',
                  orderable: true,
                  searchable: true
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
<script>

    function rowSelected(element) {
        console.log($(element).attr('id'));
        var id=$(element).attr('id');
        var url = '{{ route("adherant.show", ":id") }}';
        url = url.replace(':id', id);
        window.open(url);
    }

   
</script>

@endsection

