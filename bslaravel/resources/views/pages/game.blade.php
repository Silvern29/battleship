@extends('layouts.app')

@section('title') Play @parent
@endsection

@section('content')

    <div class="container col-md-12 d-flex center">
        <div class="col-md-4">
            <h2>Your Battlefield</h2>
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    @for ($m = 'A'; $m <= 'J'; $m ++)
                        <th>{{$m}}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @for ($m = 1; $m <= 10; $m ++)
                    <tr>
                        <td>{{$m}}</td>
                        @for ($n = 'A'; $n <= 'J'; $n ++)
                            <td><input type="button" class="btn btn-block btn-info"
                                       onclick="fire('{{$m}}','{{$n}}', '{{ $user->id }}')" value=" " id="{{$m}}{{$n}}">
                            </td>
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h2>Enemies Battlefield</h2>
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    @for ($i = 'A'; $i <= 'J'; $i ++)
                        <th>{{$i}}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @for ($i = 1; $i <= 10; $i ++)
                    <tr>
                        <td>{{$i}}</td>
                        @for ($k = 'A'; $k <= 'J'; $k ++)
                            <td><input type="button" class="btn btn-block btn-info"
                                       onclick="fire('{{$i}}','{{$k}}', '{{ $user->id }}')" value=" " id="{{$i}}{{$k}}">
                            </td>
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="container col-md-12 d-flex center">


        <div class="col-md-4">
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Ship name:</th>
                    <th>Ship size/hits</th>
                    <th>Ship sunk</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ships as $ship)
                    <tr>
                        <td>{{$ship->name}}</td>
                        <td>{{$ship->size}}/{{$ship->hits}}</td>
                        <td>{{$ship->sunk ? 'true' : 'false'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3 id="msg"></h3>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Ship name:</th>
                    <th>Ship size/hits</th>
                    <th>Ship sunk</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ships as $ship)
                    <tr>
                        <td>{{$ship->name}}</td>
                        <td>{{$ship->size}}/{{$ship->hits}}</td>
                        <td>{{$ship->sunk ? 'true' : 'false'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3 id="msg"></h3>
        </div>
    </div>

@endsection
