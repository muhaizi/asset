@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                <div class="card">
                    
                  
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __('Senarai Aset') }}
                    @permission('create-asset')
                    <a class="btn btn-primary" href="{{ route('asset.create') }}"> Tambah Aset</a>
                    @endpermission
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asset.index') }}" method="GET">
                            @csrf
                            
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Kementerian</label>
                            <div class="col-md-8">
                                <select name="ministry_id" id="ministry_id"
                                class="form-control">
                                <option value="">Sila Pilih</option>
                                @foreach ($ministries as $curMinistry)
                                    <option {{ old('ministry_id', $ministry) == $curMinistry->id ? 'selected' : '' }}
                                        value="{{ $curMinistry->id }}">{{ $curMinistry->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Tarikh</label>
                            <div class="col-md-4">
                                <input type="text" name="deadline" id="deadline" class="form-control" autocomplete="off"
                                value="{{old('deadline', $deadline)}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search mr-2"></i>Cari</button>

                            </div>
                        </div>
                        </form>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="checkAll" name="checkAll"></th>
                                    <th scope="col">#</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Kementerian</th>
                                    <th scope="col">{{__('asset.tarikh')}}</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asset as $curAset)
                                    <tr id="trchk_{{$curAset->id}}">
                                        <th><input name='id' onclick="doEnableInput(this.checked)" class="asset" type="checkbox" id="checkItem" value="{{$curAset->id}}"></th>
                                        <th scope="row">{{ ($asset->currentpage()-1) * $asset->perpage() + $loop->index + 1  }}.</th>
                                        <td>{{ $curAset->description }}</td>
                                        <td>{{ $curAset->ministry->name }}</td>
                                        <td>{{ $curAset->deadline }}</td>
                                        <td nowrap>
                                        @permission('edit-asset')
                                        <a class="btn" href="{{ route('asset.edit', [$curAset->id]) }}"><i class="fas fa-edit"></i></a>
                                        @endpermission
                                        <a class="btn" href="{{ route('asset.show', [$curAset->id]) }}"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <div class="my-2">
                            @if(!$asset->isEmpty())
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a title="Delete" id="btn-delete" data-placement="top" data-toggle="modal" data-target="#modal-deleteall" class="btn btn-danger btn-sm btn-delete" href="#"><i class="fas fa-trash mr-2"></i>Hapus</a>
                                <a title="Approved" data-placement="top" data-toggle="modal" data-target="#modal-approveall" class="btn btn-primary btn-sm btn-pengesahan" href="#"><i class="fas fa-check mr-2"></i>Pengesahan</a>
                                <a class="btn btn-success btn-sm btn-print" target="_blank" href="{{route('asset.index', ['ministry_id'=> $ministry, 'deadline' => $deadline, 'excel'=>1])}}"><i class="fa fa-file-excel-o mr-2"></i>Excel</a>
                              </div>
                            @endif
                        </div>
                    </form>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  {{ $pagination }}
                                </div>
                                <div>
                                  {{ $asset->links() }}
                                </div>
                            </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
    </div>
    @include('asset.deleteall')
    @include('asset.updateall')
    <script type='text/javascript'>
    $(document).ready(function() {
        $("#deadline").datepicker({
            format: 'dd/mm/yyyy',
            endDate: "today",
            autoclose: true,
        });

        $(".btn-delete").addClass('disabled');
        $(".btn-pengesahan").addClass('disabled');

     
    });

    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);

        if($('input[name=checkAll]').is(':checked')){
             $(".btn-delete").removeClass('disabled');
             $(".btn-pengesahan").removeClass('disabled');
        }else{
            $(".btn-delete").addClass('disabled');
            $(".btn-pengesahan").addClass('disabled');
        }
    });

    function doEnableInput(status) {
        var bilChk = $("tr[id^='trchk_'] :checked").length; // count checked checkboxes only
        $(".btn-delete").addClass('disabled');
        $(".btn-pengesahan").addClass('disabled');

        if(status == true) {
            $(".btn-delete").removeClass('disabled');
            $(".btn-pengesahan").removeClass('disabled');

        }   else {
            if(bilChk == '0'){
                $(".btn-delete").addClass('disabled');
                $(".btn-pengesahan").addClass('disabled');

                $("#checkAll").prop('checked', false);
            }else{
                $(".btn-delete").removeClass('disabled');
                $(".btn-pengesahan").removeClass('disabled');

                $("#checkAll").prop('checked', true);
            }
        }
    }
    
    
    var deleteAssetUrl = '{{ route("asset.deleteall") }}';
    
    $(document.body).on('click', '.btn-delete', function(){
        var id = []; // initialize empty array 
        $(".asset:checked").each(function(){
            id.push($(this).val());
        });
        var newDeleteAssetUrl = deleteAssetUrl+'/'+id;
        console.log(newDeleteAssetUrl);
        $('#form-deleteall').attr('action', newDeleteAssetUrl);
    });

    var updateAssetUrl = '{{ route("asset.updateall") }}';
    
    $(document.body).on('click', '.btn-pengesahan', function(){
        var assetId = []; // initialize empty array 
        $(".asset:checked").each(function(){
            assetId.push($(this).val());
        });

        var newUpdateAssetUrl = updateAssetUrl+'/'+assetId;
        //console.log(newUpdateAssetUrl);
        $('#form-updateall').attr('action', newUpdateAssetUrl);
    });
</script>
@endsection