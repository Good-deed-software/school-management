@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form method="post" action="@if($teacher){{route ('teachers_update')}}@else{{ route ('teachers_data') }}@endif">
                        @csrf
                            @if($teacher)
                        <input id="teachername" type="hidden" name="id" value="{{$teacher->id }}">
                                @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TeacherName') }}</label>

                            <div class="col-md-6">
                                <input id="teachername" type="text" class="form-control @error('name') is-invalid @enderror" name="teachername" value="@if($teacher){{$teacher->teachername }} @endif " required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FathersName') }}</label>

                            <div class="col-md-6">
                                <input id="fathername" type="text" class="form-control @error('name') is-invalid @enderror" name="fathername"  value="@if($teacher){{$teacher->fathername }} @endif " required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MothersName') }}</label>

                            <div class="col-md-6">
                                <input id="mothername" type="text" class="form-control @error('name') is-invalid @enderror" name="mothername" value="@if($teacher){{$teacher->mothername }} @endif " required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="@if($teacher){{$teacher->address }} @endif "  required autocomplete="name" autofocus>

                            </div>
                        </div>
                        
                       <div class="form-group row">
                           <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        
                          <div class="col-md-6">
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if($teacher){{$teacher->email }} @endif " " required autocomplete="email">
                        
                                @error('email')
                                  <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                            </div>
                       </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MobileNumber') }}</label>

                            <div class="col-md-6">
                                <input id="mobilenumber" type="text" class="form-control @error('name') is-invalid @enderror" name="mobilenumber" value="@if($teacher){{$teacher->mobilenumber }} @endif "  required autocomplete="mobilenumber" autofocus>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
