@component('mail::message')
# Hi {{$name}}!

Terima kasih di atas pendaftaran anda di sistem SPFB.<BR>
Berikut ialah maklumat pendaftaran anda.

<table class="table2">
    <thead>
      <tr>
        <th>Nama</th>
        <th>{{$name}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td >Emel</td>
        <td>{{$email}}</td>
      </tr>
      <tr>
        <td>Kementerian</td>
        <td>{{$ministry}}</td>
      </tr>
    </tbody>
  </table>
<BR><BR>
Terima kasih,<br>
Administrator,
SPFB<br><br>

This is a computer-generated document. No signature is required<br>
@endcomponent
