@extends('layouts.app')

@section('content')

@php
    $ministries = \App\Models\Ministry::all();
    //dd($ministries);
    $roles = \App\Models\Role::all();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kementerian') }}</label>

                            <div class="col-md-6">
                                <select name="ministry_id" id="ministry_id" class="form-control @error('ministry_id') is-invalid @enderror" required autofocus>
                                    <option value="">Sila Pilih</option>
                                    @foreach ($ministries as $curMinistry) 
                                        <option {{ old('ministry_id') == $curMinistry->id ? "selected" : "" }}  value="{{$curMinistry->id}}">{{$curMinistry->name}}</option>
                                    @endforeach

                        
                                </select>
                                @error('ministry_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                            <div class="col-md-6">
                                <select name="department_id" id="department_id" data-selected-department="{{ old('department_id') }}" class="form-control @error('department_id') is-invalid @enderror">
                                    <option value="">Sila Pilih</option>
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="peranan" class="col-md-4 col-form-label text-md-right">{{ __('Peranan') }}</label>

                            <div class="col-md-6">
                                @foreach ($roles as $curRole) 
                                        <label><input type="checkbox" name='roles[]'  {{ in_array($curRole->id, old('roles', [])) ? 'checked' : '' }} value="{{$curRole->id}}"> {{$curRole->display_name}}</label><BR>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
$(document).ready(function(){
    updateDepartment($('#ministry_id').val());
    $('#ministry_id').on('change', function() {
        var ministryId = $(this).val();
        if (ministryId > 0) {
            updateDepartment(ministryId);
        }else{
            $('#department_id').html('').append($('<option>').val('').html('-Sila Pilih-'));
        }
    });
});

function updateDepartment(ministryId, departmentId = 0) {
    var url = "{{ route('get.department', 0) }}";
    url = url.split('/').slice(0,-1).join('/')+'/'+ministryId;
    $.get(url, function(data){
        var departmentId = $("#department_id").attr("data-selected-department");

        var departmentDropdown = $('#department_id');
        departmentDropdown.html('').append(
            $('<option>').val('').html('-Sila Pilih-')
                );
                
                console.log(data);
                $.each(data, function(department, id) {
                    var option = $('<option>').val(id).html(department.toUpperCase());
                        
                        if (departmentId == id) {
                            option.attr('selected', 'selected');
                        }
                        
                        departmentDropdown.append(option);
                    });
                });
            }
            
</script>
@endsection
