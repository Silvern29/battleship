@extends('layouts.app')

@section('title') Play @parent
@endsection

@section('content')
    <div class="container col-md-12 d-flex center">
        <div class="col-md-5">
            <h2>Your Battlefield</h2>
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    @for ($m = "A"; $m <= "J"; $m ++)
                        <th>{{$m}}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @for ($m = 1; $m <= 10; $m ++)
                    <tr>
                        <td>{{$m}}</td>
                        @for ($n = 'A'; $n <= 'J'; $n ++)
                            @if($uField[$n][$m] === ' ')
                                <td><input type="button" class="btn btn-block btn-success disabled"
                                           value=" " id="user{{$n}}{{$m}}">
                                </td>
                            @elseif($uField[$n][$m] === 'X')
                                <td><input type="button" class="btn btn-block btn-danger disabled"
                                           value=" " id="user{{$n}}{{$m}}">
                                </td>
                            @elseif($uField[$n][$m] === '~')
                                <td><input type="button" class="btn btn-block btn-info disabled"
                                           value=" " id="user{{$n}}{{$m}}">
                                </td>
                            @else
                                <td><input type="button" class="btn btn-block btn-info disabled"
                                           value="{{$uField[$n][$m]}}" id="user{{$n}}{{$m}}">
                                </td>
                            @endif
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
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
                            @if($nField[$k][$i] === ' ')
                                <td><input type="button" class="btn btn-block btn-success disabled"
                                           onclick="fire('{{$k}}', '{{$i}}')" value=" " id="npc{{$k}}{{$i}}">
                                </td>
                            @elseif($nField[$k][$i] === 'X')
                                <td><input type="button" class="btn btn-block btn-danger disabled"
                                           onclick="fire('{{$k}}', '{{$i}}')" value=" " id="npc{{$k}}{{$i}}">
                                </td>
                            @else
                                <td><input type="button" class="btn btn-block btn-info"
                                           onclick="fire('{{$k}}', '{{$i}}')" value=" " id="npc{{$k}}{{$i}}">
                                </td>
                            @endif
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <h3 id="msg"></h3>

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
                        @if($ship->sunk)
                            <td>true</td>
                        @else
                            <td>false</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                @foreach($npcUser->ships as $ship)
                    <tr>
                        <td>{{$ship->name}}</td>
                        <td>{{$ship->size}}/{{$ship->hits}}</td>
                        <td>{{$ship->sunk ? 'true' : 'false'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
