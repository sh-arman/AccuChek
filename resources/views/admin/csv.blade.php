<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    @page {
        margin: 1cm 0.3cm;
        /*width: 450px;*/
        padding:15px;
    }
    body {
        font-family: 'IBM Plex Sans,Helvetica,Arial,sans-serif';
        font-size: 20px;
    }
    table{
        border-collapse:collapse;

    }
    table tr td,
    table tr th{
        font-size: 19px;
        border: 1px solid #222;
        font-family: 'IBM Plex Sans,Helvetica,Arial,sans-serif';
        padding: 20px;
    }
    .none {
        display: none;
    }
</style>
  </head>
  <body>
      <table>
        <p>ACCU Chek Radiant LiveCheck - Live Check Report</p>
        <p> From: {{ Carbon\Carbon::parse($sDate)->format('d M y') }} <br>
            To: {{ Carbon\Carbon::parse($eDate)->format('d M y') }}
        </p>
        <thead>
            <tr>
                <th>Total Verification's</th>
                <th>Web</th>
                <th>Sms</th>
                <th class="@if( $firstTime == NULL ) ? none : ''  @endif">First Time</th>
                <th class="@if( $verified == NULL ) ? none : ''  @endif">Verified</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> {{ $total }}</td>
                <td> {{ $totalWeb }}</td>
                <td> {{ $totalSms }}</td>
                <td class="@if( $firstTime == NULL ) ? none : ''  @endif">{{ $firstTime }}</td>
                <td class="@if( $verified == NULL ) ? none : ''  @endif">{{ $verified }}</td>
            </tr>
    </table>

    <br>


        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Phone Number</th>
                    <th>Code</th>
                    <th>Reamrks</th>
                    <th>Source</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($datas as $data)
                    @foreach ($data as $d)
                    <tr>
                           <td>{{ $d->id }}</td>
                           <td>{{ $d->phone_number }}</td>
                           <td>{{ $d->code }}</td>
                           <td>{{ $d->remarks }}</td>
                           <td>{{ $d->source }}</td>
                           <td>{{ Carbon\Carbon::parse( $d->created_at )->format('d-M-y') }}</td>
                           <td>{{ Carbon\Carbon::parse( $d->created_at )->format('g:i a') }}</td>
                       </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
  </body>
</html>
