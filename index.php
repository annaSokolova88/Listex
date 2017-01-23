<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8" />
<title>Import CSV to MySQL in PHP</title>
<link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>
    <div class="container">
		<div class="content">
            <form action="import.php" method="post" enctype="multipart/form-data">
			    <table>
                    <tr>
                        <td> Use default config  </td>
                        <td><input type="checkbox" name="is_defaultConfig" id="check"></td>
                    </tr>
                    <tr id="host">
                        <td> Host </td>
                        <td> <input type="text" name="host"> </td>
                    </tr>
                    <tr id="dbName">
                        <td> DB name </td>
                        <td> <input type="text" name="dbName"> </td>
                    </tr>
                    <tr id = "dbUser">
                        <td> DB user  </td>
                        <td> <input type="text" name="dbUser"> </td>
                    </tr>
                    <tr id = "dbPassword">
                        <td> DB Password </td>
                        <td> <input type="password" name="dbPassword"> </td>
                    </tr>
                    <tr>
                        <td><input type="file" name="csv_file"></td>
                    </tr>
                    <tr>
                         <td></td>
                         <td> <input type="submit" value = "Import"> </td>
                    </tr>
			    </table>
		    </form>
		</div>		
    </div>
    <script type = "text/javascript">
        document.getElementById('check').onclick = function() {
            var host = document.getElementById('host');
            var dbName = document.getElementById('dbName');
            var dbPassword = document.getElementById('dbPassword');
            var dbUser = document.getElementById('dbUser');
            if ( this.checked ) {
                host.style.display = 'none';
                dbName.style.display = 'none';
                dbPassword.style.display = 'none';
                dbUser.style.display = 'none';
            } else {
                host.style.display = '';
                dbName.style.display = '';
                dbPassword.style.display = '';
                dbUser.style.display = '';
            }
        };
    </script>
</body>
</html>
