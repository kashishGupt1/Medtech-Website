<html>

<head>

    <meta charset="utf-8" />

    <title>Ezdatechnology Enquiry</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
    <style>
        table {
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
            margin-bottom: 0;
            caption-side: bottom;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            vertical-align: top;
            text-align: left;
        }
    </style>
  
    <div>
        <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
            <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: auto" src="{{asset('assets/images/logo/ezdat-logo.png')}}" alt="" height="108">
        </div>
        <br>
        <h3>Enquiry</h3>
        <table>
            </thead>
            <tboday>
                <tr>
                    <th> <b>Name </b> </th>
                    <td>{{$mail_data->name}}</td>
                </tr>
                <tr>
                    <th> <b>Email </b> </th>
                    <td>{{$mail_data->email}}</td>
                </tr>
                <tr>
                    <th> <b>Enquiry Type </b> </th>
                    <td>{{$mail_data->type}}</td>
                </tr>
                <tr>
                    <th> <b>Description </b> </th>
                    <td>{{$mail_data->description}}</td>
                </tr>
               
            </tboday>
        </table>

    </div>

</body>

</html>