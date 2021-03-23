@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    <hr>
                    @endif
                  
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
                                <input type="text" name="deadline" id="deadline" class="form-control"
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Kementerian</th>
                                    <th scope="col">Tarikh Aset</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asset as $curAset)
                                    <tr>
                                        <th scope="row">{{ ($asset->currentpage()-1) * $asset->perpage() + $loop->index + 1  }}.</th>
                                        <td>{{ $curAset->description }}</td>
                                        <td>{{ $curAset->ministry->name }}</td>
                                        <td>{{ $curAset->deadline }}</td>
                                        <td nowrap><a class="btn" href="{{ route('asset.edit', [$curAset->id]) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn" href="{{ route('asset.show', [$curAset->id]) }}"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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
    <script type='text/javascript'>
    $(document).ready(function() {
        $("#deadline").datepicker({
            format: 'dd/mm/yyyy',
            endDate: "today",
        });
    });
</script>
@endsection