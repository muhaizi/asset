@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body bg-success">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Pendaftaran anda telah berjaya!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type='text/javascript'>
    $(document).ready(function(){
        alert('asdad');
    });
</script>
@endsection