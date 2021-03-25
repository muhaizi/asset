@php
$filename = "asset.xls";
$now = gmdate ( 'D, d M Y H:i:s' ) . ' GMT';
header ( 'Content-Type: application/msexcel' );
header ( 'Expires: ' . $now );
header ( 'Content-Disposition: inline; filename="' . $filename . '"' );
header ( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
header ( 'Pragma: public' );
@endphp
<div class="container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Kementerian</th>
                                    <th scope="col">{{__('asset.tarikh')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asset as $curAset)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration  }}.</th>
                                        <td>{{ $curAset->description }}</td>
                                        <td>{{ $curAset->ministry->name }}</td>
                                        <td>{{ $curAset->deadline }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

@php
exit;    
@endphp