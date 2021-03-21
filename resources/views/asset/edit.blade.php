@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Kemaskini Aset') }}</div>
                    <div class="card-body">
                        <form action="{{ route('asset.update',[$asset->id]) }}" method="POST" enctype="multipart/form-data">
                          @method('PUT')
                          @csrf
                          
                          <div class="form-row">
                                <div class="col-md-9 mb-3">
                                    <label for="validationDefault01">Premise</label>
                                    <div class="input-group mb-3">
                                      <select name="premise_id" id="premise_id"
                                      class="form-control @error('premise_id') is-invalid @enderror" required autofocus>
                                      <option value="">Sila Pilih Premise</option>
                                      @foreach ($premises as $curPremise)
                                          <option {{ old('premise_id', $asset->premise_id) == $curPremise->id ? 'selected' : '' }}
                                              value="{{ $curPremise->id }}">{{ $curPremise->name }}</option>
                                      @endforeach
                                  </select>
                                      <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Add Premise</button>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault02">Request Date</label>
                                    <input type="text" name="deadline" id="deadline" class="form-control"
                                        value="{{$asset->deadline}}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault03">Amount</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">MYR</span>
                                      </div>
                                      <input type="text" name="amount" id=amount class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault04">Ministry</label>
                                    <select name="ministry_id" id="ministry_id"
                                        class="form-control @error('ministry_id') is-invalid @enderror" required autofocus>
                                        <option value="">Sila Pilih</option>
                                        @foreach ($ministries as $curMinistry)
                                            <option {{ old('ministry_id') == $curMinistry->id ? 'selected' : '' }}
                                                value="{{ $curMinistry->id }}">{{ $curMinistry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault05">Zip</label>
                                    <input type="number" class="form-control" id="validationDefault05" maxlength="4" required>
                                </div>
                              </div>
                              <hr class="mt-0">
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" cols=10 rows=4 class="form-control"
                                        id="inputEmail3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Attachment</label>
                                <div class="col-sm-10">
                                  <input type="file" name="attachment" class="form-control-file" id="attachment">
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="1" checked>
                                        <label class="form-check-label" for="status1">
                                            First radio
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status2"
                                            value="2">
                                        <label class="form-check-label" for="status2">
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
                                        <input class="form-check-input" type="checkbox" id="gridCheck1">
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
    
    <script type='text/javascript'>
    $(document).ready(function() {
      $("#deadline").datepicker({
                format: 'dd/mm/yyyy',
                endDate: "today",
                autoclose: true,
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
    