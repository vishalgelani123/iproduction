@extends('layouts.app')
@section('content')

    <section class="main-content-wrapper">
        @include('utilities.messages')
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header">{{ isset($title) && $title ? $title : '' }}</h2>
                    <input type="hidden" class="datatable_name" data-title="{{ isset($title) && $title ? $title : '' }}"
                        data-id_name="datatable">
                </div>
                <div class="col-md-offset-4 col-md-2">

                </div>
            </div>
        </section>


        <div class="box-wrapper">

            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="ir_w_1"> Serial No.</th>
                                <th class="ir_w_25">Floor Name</th>
                                <th class="ir_w_16">Table Name</th>
                                <th class="ir_w_16">Seats</th>
                                <th class="ir_w_16">Availability</th>
                                <th class="ir_w_16">Created At</th>
                                <th class="ir_w_1 ir_txt_center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($productionTables as $i => $productionTable)
                                <tr>
                                    <td class="ir_txt_center">{{ $i+1 }}</td>
                                    <td>{{ $productionTable->floor->name }}</td>
                                    <td>{{ $productionTable->table_name }}</td>
                                    <td>{{ $productionTable->number_of_seats }}</td>
                                    <td>{{ $productionTable->availability_status }}</td>
                                    <td>{{ $productionTable->created_at->format('Y-M-d') }}</td>
                                    <td class="ir_txt_center">
                                            <a href="{{ url('production-table') }}/{{ encrypt_decrypt($productionTable->id, 'encrypt') }}/edit" class="button-success"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Edit"><i class="fa fa-edit tiny-icon"></i></a>


                                            <a href="#" class="delete button-danger"
                                                data-form_class="alertDelete{{ $productionTable->id }}" type="submit"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <form action="{{ route('production-table.destroy', $productionTable->id) }}"
                                                    class="alertDelete{{ $productionTable->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <i class="fa fa-trash tiny-icon"></i>
                                                </form>
                                            </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </section>
@endsection
@section('script')

@endsection
