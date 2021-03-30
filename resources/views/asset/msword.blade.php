@php
if ($type == 'word') {
    $filename = "asset.doc";
    $now = gmdate ( 'D, d M Y H:i:s' ) . ' GMT';
    header ( 'Content-Type: application/vnd.ms-word' );
    header ( 'Expires: ' . $now );
    header ( 'Content-Disposition: inline; filename="' . $filename . '"' );
    header ( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
    header ( 'Pragma: public' );
}
@endphp
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    .page-break {
        page-break-after: always;
    }
    </style>
   
<table style="border-collapse: collapse; width: 100%" border="1">
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
<div class="page-break"></div>
<h1>Sistem Aset Alih</h1>
@php
if ($type == 'word') {
exit;
}
@endphp