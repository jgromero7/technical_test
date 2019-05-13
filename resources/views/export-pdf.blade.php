<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin: 0;
            width: 100%; 
            text-align: left;    
            border-collapse: collapse;
        }

        th {     
            font-size: 13px;
            font-weight: normal;
            padding: 8px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff; 
            color: #039; 
        }

        td {
            padding: 8px;
            background: #e8edff;
            border-bottom: 1px solid #fff;
            color: #669;
            border-top: 1px solid transparent; 
        }
    </style>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Buscado</th>
                <th>Porcentaje Buscado</th>
                <th>Nombre Encontrado</th>
                <th>Porcentaje Encontrado</th>
                <th>Tipo de Cargo</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($search as $name)
            <tr>
                <td>{{ $name["nombre_buscado"] }}</td>
                <td>{{ $name["porcentaje_buscado"] }}%</td>
                <td>{{ $name["nombre_encontrado"] }}</td>
                <td>{{ $name["porcentaje_encontrado"] }}%</td>
                <td>{{ $name["otros_campos"]["tipo_cargo"] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table> 

</body>
</html>