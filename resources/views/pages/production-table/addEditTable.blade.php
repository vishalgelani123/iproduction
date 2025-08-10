@extends('layouts.app')
@section('script_top')
@endsection

@section('content')
    <section class="main-content-wrapper">
        <section class="content-header">
            <h3 class="top-left-header">
                {{ isset($title) && $title ? $title : '' }}
            </h3>
        </section>


        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                {!! Form::model(isset($productionTable) && $productionTable ? $productionTable : '', [
                    'method' => isset($productionTable) && $productionTable ? 'PATCH' : 'POST',
                    'route' => ['production-table.update', isset($productionTable->id) && $productionTable->id ? $productionTable->id : ''],
                ]) !!}
                <form>
                    @csrf
                    <div>
                        <div class="row">
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>Floor <span class="required_star">*</span></label>
                                    <select class="form-control @error('floor_id') is-invalid @enderror select2"
                                            name="floor_id" id="floor_id">
                                        @foreach($floors as $i => $floor)
                                            <option value="{{$floor->id}}" {{@$productionTable->id==$floor->id ? 'selected' : ""}}>{{$floor->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('floor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>Table Name</label>
                                    <input id="table_name" type="text"
                                           class="form-control @error('table_name') is-invalid @enderror"
                                           name="table_name"
                                           value="{{ isset($productionTable) && $productionTable->table_name ? $productionTable->table_name : old('table_name') }}"
                                           required>
                                    @error('table_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>Number Of Seats</label>
                                    <input id="number_of_seats" type="number" min="1"
                                           class="form-control @error('number_of_seats') is-invalid @enderror"
                                           name="number_of_seats"
                                           value="{{ isset($productionTable) && $productionTable->number_of_seats ? $productionTable->number_of_seats : old('number_of_seats') }}"
                                           required>
                                    @error('number_of_seats')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description" id="description"
                                              placeholder="Description">{{ isset($productionTable) && $productionTable->description ? $productionTable->description : old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn">
                                <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                                Submit
                            </button>
                            <a class="btn bg-second-btn" href="{{ route('production-table.index') }}">
                                <iconify-icon icon="solar:round-arrow-left-broken"></iconify-icon>
                                Back</a>
                        </div>
                    </div>
                </form>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('script_bottom')
@endsection
