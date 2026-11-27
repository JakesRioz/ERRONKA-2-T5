document.addEventListener("DOMContentLoaded", function () {
    getAll();
    document.getElementById("btnAdd").addEventListener("click", addEntry);
});

// 1. OBTENER Y PINTAR TODOS LOS DATOS
function getAll() {
    fetch("../php/getAll/index.php")
        .then(res => res.json())
        .then(response => {
            if (response.msg === "error") {
                alert("Error al cargar los datos");
            } else {
                const container = document.getElementById("idTotalGet");
                container.innerHTML = "<ul id='idUsers' style='list-style:none; padding:0;'></ul>";
                const ul = document.getElementById("idUsers");

                response.data.forEach(item => {
                    ul.innerHTML += `
                        <li style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #ddd;">
                            <span>
                                <strong>#${item.id}</strong> | Eguna: ${item.eguna} | Dirua: ${item.dirua}€
                            </span>
                            <button type="button" onclick="deleteEntry(${item.id})" style="color:red; cursor:pointer; border:none; background:none; font-weight:bold;">
                                Quitar
                            </button>
                        </li>`;
                });
            }
        })
        .catch(err => alert("Error de red: " + err));
}

// 2. AÑADIR NUEVO DATO
function addEntry() {
    const eguna = document.getElementById("inEguna").value.trim();
    const dirua = document.getElementById("inDirua").value.trim();

    if (!eguna || !dirua) {
        alert("Rellena todos los campos");
        return;
    }

    const formData = new FormData();
    formData.append("eguna", eguna);
    formData.append("dirua", dirua);

    fetch("../php/addTotal/index.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(response => {
        if (response.msg === "success") {
            // Limpiar inputs y recargar lista sin refrescar la página
            document.getElementById("inEguna").value = "";
            document.getElementById("inDirua").value = "";
            getAll();
        } else {
            alert("Error al añadir el registro");
        }
    })
    .catch(err => alert("Error de red: " + err));
}

// 3. QUITAR DATO
function deleteEntry(id) {
    if (!confirm("¿Eliminar el registro #" + id + "?")) return;

    const formData = new FormData();
    formData.append("id", id);

    fetch("../php/deleteAll/index.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(response => {
        if (response.msg === "success") {
            getAll(); // Recargar lista
        } else {
            alert("Error al eliminar");
        }
    })
    .catch(err => alert("Error de red: " + err));
}