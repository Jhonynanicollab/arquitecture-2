<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Estilo CSS -->
</head>
<body>
    <header>
        <h1>Gestión de Usuarios</h1>
    </header>

    <main>
        <h2>Lista de Usuarios</h2>
        
        <div class="crud-buttons">
            <button id="btnAgregar" class="btn btn-success">Agregar Usuario</button>
        </div>

        <table id="usuarios-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th> <!-- Nueva columna para acciones -->
                </tr>
            </thead>
            <tbody>
                <!-- Los usuarios se cargarán aquí -->
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Tu Nombre. Todos los derechos reservados.</p>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        cargarUsuarios();

        document.getElementById('btnAgregar').addEventListener('click', function() {
            const nombre = prompt("Ingrese el nombre del usuario:");
            const email = prompt("Ingrese el email del usuario:");
            if (nombre && email) {
                crearUsuario({ nombre, email });
            }
        });
    });

    function cargarUsuarios() {
        fetch('api.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red');
                }
                return response.json();
            })
            .then(data => {
                const tbody = document.querySelector('#usuarios-table tbody');
                tbody.innerHTML = '';

                data.forEach(usuario => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${usuario.id}</td>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.email}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editarUsuario(${usuario.id})">Editar</button>
                            <button class="btn btn-danger" onclick="eliminarUsuario(${usuario.id})">Eliminar</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error al cargar usuarios:', error);
                const tbody = document.querySelector('#usuarios-table tbody');
                tbody.innerHTML = '<tr><td colspan="4">Error al cargar usuarios</td></tr>';
            });
    }

    function crearUsuario(usuario) {
        fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(usuario)
        })
        .then(response => {
            if (response.ok) {
                cargarUsuarios(); // Recargar usuarios después de agregar
            } else {
                console.error('Error al crear usuario');
            }
        });
    }

    function editarUsuario(id) {
        const nombre = prompt("Ingrese el nuevo nombre del usuario:");
        const email = prompt("Ingrese el nuevo email del usuario:");
        if (nombre && email) {
            fetch(`api.php?id=${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ nombre, email })
            })
            .then(response => {
                if (response.ok) {
                    cargarUsuarios(); // Recargar usuarios después de editar
                } else {
                    console.error('Error al editar usuario');
                }
            });
        }
    }

    function eliminarUsuario(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            fetch(`api.php?id=${id}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    cargarUsuarios(); // Recargar usuarios después de eliminar
                } else {
                    console.error('Error al eliminar usuario');
                }
            });
        }
    }
    </script>
</body>
</html>
