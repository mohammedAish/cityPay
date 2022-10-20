<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{cp('process_details')}}</title>
    <style>
        body {
            font-family: 'dejavu sans', sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        .text-center {
            text-align: center;
        }

        .affiliate-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .affiliate-box .table td {
            padding: 5px;
            vertical-align: top;
            border: 1px solid #ddd;
        }

        .affiliate-box .table tr td:first-of-type {
            font-weight: 600;
        }

        .affiliate-box table tr.top table td {
            padding-bottom: 20px;
        }

        .affiliate-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .affiliate-box table tr.information table td {
            padding-bottom: 40px;
        }

        .affiliate-box table tr.information table thead th {
            padding-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="affiliate-box">
    <table>
        <tr class="information">
            <td colspan="2">
                <table class="table">
                    <thead>
                    <th colspan="6"><h1>{{cp('process_details_title')}}</h1></th>
                    </thead>
                    <tbody>
{{--                    <tr>--}}
{{--                        @foreach($data as $key => $value)--}}
{{--                            <th>{{ ucwords(t($key)) }}</th>--}}
{{--                        @endforeach--}}
{{--                    </tr>--}}
                    @if ($data)
                        @foreach($data as $key => $value)
                            @if(in_array($key, $allowed_data))
                                <tr>
                                    <td>{{ ucwords(cp($key)) }}</td>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endif    
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
