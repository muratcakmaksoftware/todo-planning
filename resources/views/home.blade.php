<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1 style="text-align: center;font-weight: bold">To-Do Planning</h1>
            <div style="font-size:15px;font-weight: bold;text-align: right">Tespit edilen iş bitiş haftası : {{$endWeek}} Hafta</div>
            <div style="font-size:15px;font-weight: bold;text-align: right">Günlük çalışma saati : {{$dailyWorkHours}} Saattir</div>
            <p></p>

            @foreach($developerTasks as $developer)
                <table class="table table-bordered table-striped table-dark" style="text-align: center;">
                    <thead>
                        <tr>
                            <td style="font-weight: bold;font-size: 17px;" colspan="{{$endWeek+1}}">{{$developer['name']}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Gün</th>
                            @for($i = 1; $i <= $endWeek; $i++)
                                <th scope="col">{{$i}}.Hafta</th>
                            @endfor
                        </tr>
                    </thead>

                    <tbody>
                        @for($day = 1; $day <= $dayLimit; $day++)
                            <tr>
                                <td>{{$day}}</td>
                                @for($i = 1; $i <= $endWeek; $i++)
                                    @if(isset($developer['weeks'][$i]['days'][$day]['tasks']))
                                        <td>
                                            @foreach($developer['weeks'][$i]['days'][$day]['tasks'] as $task)
                                                {{$task['name'] . ' - Süresi: '. $task['estimated_duration']}} <br/>
                                            @endforeach
                                        </td>
                                    @else
                                        <td>YOK</td>
                                    @endif
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            @endforeach
        </div>
    </body>
</html>
