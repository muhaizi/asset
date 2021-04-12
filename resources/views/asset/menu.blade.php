@php
    $done = "<i class=\"fas fa-check-square text-success\"></i>";
    $cancel = "<i class=\"fas fa-times text-danger\"></i>";
    $mapExists = ($asset->maps()->first())?$done:$cancel;
    $costExists = ($asset->costs()->first())?"<i class=\"fas fa-check-square text-success\"></i>":"<i class=\"fas fa-times text-danger\"></i>";
@endphp

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Maklumat Aset
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="{{route('map.create',[$asset->id])}}">{!! $mapExists !!} Asas</a>
      <a class="dropdown-item" href="#">{!! $costExists !!} Kos</a>
      <a class="dropdown-item" href="#">Status</a>
      <a class="dropdown-item" href="#">Tanah</a>
      <a class="dropdown-item" href="#">Gambar & Fail</a>
    </div>
  </div>