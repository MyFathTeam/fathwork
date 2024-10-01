@props([
    'type' => null
])

<!DOCTYPE html>
<html>
    <head>
        <title>{{config('app.name') ? : env('APP_NAME')}}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <style>
            * {
                font-family: 'Helvetica';
                font-size: 14px;
                line-height: 16px;
            }

            body {
                @if ($type == 'invoice')
                    width: 800px;
                @else
                    width: auto;
                    max-width: 1200px;
                    min-width: 600px;
                @endif
                margin: 10px auto;
                padding: 20px;
            }

            h2 {
                font-weight: bold;
            }

            .heading {
                font-weight: 800;
                font-size: 120%;
                text-transform: uppercase;
                text-align: center;
            }

            .sub-heading {
                font-weight: 600;
                font-size: 110%;
                text-align: center;
            }

            .sub-title {
                font-size: 90%;
            }

            .footer {
                margin-top: 10px;
                font-size: 90%;
            }

            .footer .timestamp {
                font-style: italic;
                text-align: right !important;
            }

            .text-right {
                text-align: right !important;
            }

            .font-weight-bold {
                font-weight: bold;
            }

            .font-120pc {
                font-size: 120%;
            }

            .font-90pc {
                font-size: 90%;
            }

            .text-xl {
                font-size: 140%;
            }

            .mt-1 {
                margin-top: 4px;
            }

            .mt-2 {
                margin-top: 8px;
            }

            table.table {
                width: 100%;
                border-collapse: collapse;
                border: .0625rem solid #dee2e9;
            }

            table.table thead, table.table tfoot {
                display: table-header-group;
                vertical-align: middle;
                border-color: inherit;
                background-color: #e9ecf1;
            }

            table.table tr {
                display: table-row;
                vertical-align: inherit;
                border-color: inherit;
            }

            table.table tr:nth-child(even) {
                background-color: rgba(0,0,0,.05);
            }

            table.table th, table.table tfoot td {
                font-weight: bold;
                text-align: left;
                padding: 10px;
            }

            table.table tbody {
                display: table-row-group;
                vertical-align: middle;
                border-color: inherit;
            }

            table.table td {
                padding: 5px 10px;
            }

            @media print
            {
                .no-print, .no-print *
                {
                    display: none !important;
                }
            }
        </style>
    </head>
<body>
    <div id="app">
        {{$slot}}
    </div>
</body>
</html>
