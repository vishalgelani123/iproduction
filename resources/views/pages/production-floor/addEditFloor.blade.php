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
                {!! Form::model(isset($productionFloor) && $productionFloor ? $productionFloor : '', [
                    'method' => isset($productionFloor) && $productionFloor ? 'PATCH' : 'POST',
                    'route' => ['production-floor.update', isset($productionFloor->id) && $productionFloor->id ? $productionFloor->id : ''],
                ]) !!}
                <form>
                    @csrf
                    <div>
                        <div class="row">
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>Name <span class="required_star">*</span></label>
                                    <input type="text" name="name" id="name"
                                           class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                           value="{{ isset($productionFloor) && $productionFloor->name ? $productionFloor->name : old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description" id="description"
                                              placeholder="Description">{{ isset($productionFloor) && $productionFloor->description ? $productionFloor->description : old('description') }}</textarea>
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
                            <a class="btn bg-second-btn" href="{{ route('production-floor.index') }}">
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
