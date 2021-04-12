@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Senarai Aset</a></li>
                    <li class="breadcrumb-item active">Paparan Aset</li>
                  </ol>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __('Paparan Aset') }}
                       @include('asset/menu')
                    </div>
                    <div class="card-body">
                          <div class="form-row">
                                <div class="col-md-9 mb-3">
                                    <label for="validationDefault01">Premise</label>
                                    <div class="input-group mb-3">
                                      {{$asset->premise->name}}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault02">Tarikh Aset</label>
                                    <div class="input-group mb-3">
                                    {{$asset->deadline}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault03">Jumlah</label>
                                    <div class="input-group mb-3">
                                      {{$asset->amount}}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault04"><strong>Kementerian</strong></label>
                                    <div class="input-group mb-3">
                                        {{$asset->ministry->name}}
                                      </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault05">Zip</label>
                                    <input type="number" class="form-control" id="validationDefault05" disabled maxlength="4" value="{{$asset->amount}}">
                                </div>
                              </div>
                              <hr class="mt-0">
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    {!!$asset->description!!}
                                    {{-- https://laravel.com/docs/8.x/blade#displaying-unescaped-data --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Attachment</label>
                                <div class="col-sm-10">
                                    <a target="_blank" href="/uploads/{{$asset->attachment}}">{{$asset->attachment}}</a>
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"  disabled
                                            value="1" {{ ($asset->status=="1")? "checked" : "" }}>
                                        <label class="form-check-label" for="status1">
                                            First radio
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status2" disabled {{ ($asset->status == 2)? "checked" : "" }}
                                            value="2" >
                                        <label class="form-check-label" for="status2" >
                                            Second radio
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="status" id="status3"
                                            value="3" disabled>
                                        <label class="form-check-label" for="status3">
                                            Third disabled radio
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck1" {{ ($asset->status == 2)? "checked" : "" }}>
                                        <label class="form-check-label" for="gridCheck1">
                                            This is to acknowledge
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-primary mr-1" href="{{route('asset.edit', [$asset->id])}}"><i class="fas fa-save mr-2"></i>Kemaskini</a>
                                <a title="Delete" data-placement="top" data-id="{{ $asset->id }}" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-delete" href="#"><i class="fas fa-trash mr-2"></i>Hapus</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('asset.delete')

<script type="text/javascript">
    var deleteAssetUrl = '{{ route("asset.destroy", 0) }}';
    
    $(document.body).on('click', '.btn-delete', function(){
        var assetId = $(this).data('id');
        var newDeleteAssetUrl = deleteAssetUrl.split('/').slice(0,-1).join('/')+'/'+assetId;
        $('#form-delete').attr('action', newDeleteAssetUrl);
    });
</script>
@endsection
    