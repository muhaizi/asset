@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                  
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Senarai Aset</a></li>
                    <li class="breadcrumb-item active">Tambah Aset</li>
                  </ol>

                <div class="card">
                    <div class="card-header">{{ __('Pendaftaran Aset') }}</div>
                    <div class="card-body">
                        <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-row">
                                <div class="col-md-9 mb-3">
                                    <label for="premise_id">Premis</label>
                                    <div class="input-group mb-3">
                                      <select name="premise_id" id="premise_id"
                                      class="form-control @error('premise_id') is-invalid @enderror" autofocus>
                                      <option value="">Sila Pilih Premis</option>
                                      @foreach ($premises as $curPremise)
                                          <option {{ old('premise_id') == $curPremise->id ? 'selected' : '' }}
                                              value="{{ $curPremise->id }}">{{ $curPremise->name }}</option>
                                      @endforeach
                                  </select>
                                      <div class="input-group-append">
                                        <a href="#" 
                                        data-toggle="modal"
                                        data-target="#modal-add-premise"
                                        class="btn btn-outline-secondary">
                                        Tambah Premis</a>
                                      </div>
                                      @error('premise_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="deadline">Tarikh Aset</label>
                                    <input type="text" name="deadline" id="deadline" value="{{old('deadline')}}" autocomplete="off" class="form-control @error('deadline') is-invalid @enderror">
                                        @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault03">Harga Aset</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">MYR</span>
                                      </div>
                                      <input type="text" name="amount" value="{{old('amount')}}" id=amount maxlength="6" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault04">Kementerian</label>
                                    <select name="ministry_id" id="ministry_id"
                                        class="form-control @error('ministry_id') is-invalid @enderror" autofocus>
                                        <option value="">Sila Pilih</option>
                                        @foreach ($ministries as $curMinistry)
                                            <option {{ old('ministry_id') == $curMinistry->id ? 'selected' : '' }}
                                                value="{{ $curMinistry->id }}">{{ $curMinistry->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('ministry_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault05">Zip</label>
                                    <input type="number" class="form-control" id="validationDefault05" maxlength="4">
                                </div>
                              </div>
                              <hr class="mt-0">
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label @error('keterangan') is-invalid @enderror">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="description" cols=10 rows=4 class="form-control"
                                        id="description">{{old('description')}}</textarea>
                                        @error('ministry_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <!--The value of a file input cannot be retained once it’s submitted and that’s the default behavior of the browser.-->
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label ">Lampiran</label>
                                <div class="col-sm-10">
                                  <input type="file" name="attachment" class="form-control-file @error('attachment') is-invalid @enderror" id="attachment" accept=".pdf,.png">
                                  @error('attachment')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="1" {{ old("status") == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status1">
                                            Baru
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status2"
                                            value="2" {{ old("status") == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status2">
                                            Diluluskan
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
                                        <input class="form-check-input" type="checkbox" name="checkKnowledge" id="gridCheck1" value="1" {{ old("checkKnowledge") == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridCheck1">
                                            This is to acknowledge
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('premise.create_modal')
    
    <script type='text/javascript'>
    $(document).ready(function() {
      $("#deadline").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight:'TRUE',
                endDate: "today",
       });

       //modal here
        $('#form-add-premise').on('submit', function(event) {
            event.preventDefault();

            var formData = {
                'name'                  : $('#name').val(),
                '_token'                : $('input[name="_token"]').val(),
            };

            var postUrl = '{{ route("premise.store") }}';
            //console.log(formData);
            $.ajax({
                type        : 'POST',
                url         : postUrl,
                data        : formData,
                dataType    : 'json',
                encode      : true
            })
            .done(function(data) {
                var option = $('<option>').val(data.id)
                    .html(data.name)
                    .attr('selected', 'selected');
                $('#premise_id').append(option);
                $('#modal-add-premise').modal('hide');
            });
        });
    }); 

    $('#amount').keyup(function(){
          var val = $(this).val();
          if(isNaN(val)){
              val = val.replace(/[^0-9\.]/g,'');
              if(val.split('.').length>2) 
                  val =val.replace(/\.+$/,"");
          }
          $(this).val(val); 
        });
    </script>
    @endsection
    
