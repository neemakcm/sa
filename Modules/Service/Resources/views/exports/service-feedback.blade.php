<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
   @foreach ($feedbacks as $feedback)
        <tr>
           <td >{{ $feedback->id }}</td>
           <td >{{ $feedback->id }}</td>
        </tr>
    @endforeach
    </tbody>
   </table>