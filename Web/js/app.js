document.addEventListener("DOMContentLoaded", function(event)
    {
        getAll();
        document.getElementById("btnAdd").addEventListener("click", addId);
    })

    function getAll()
{
    $.ajax({
        url: "./php/getAll/index.php",
        dataType: 'json',
        success: function (response)
        {

            if (response.success=="error") // PHP-k error mezua bidali badu
            {
                alert(response.msg); // mezua inprimatu
            }else{
                // bestela zerrenda batean sartuko dira datu horiek idContainerGet barruan sartu dugun idUsers <UL>-an
                document.getElementById('idTotalGet').innerHTML="<ul id='idUsers'></ul>";
                for (var i=0;i<response.data.length;i++)
                {
                    document.getElementById('idUsers').innerHTML+="<li>ID: "+response.data[i].id+" Username: "+response.data[i].username+"</li>";
                }
            }
        },
        error: function(xhr){
            alert("An AJAX error occurred: " + xhr.status + " " + xhr.statusText);
        }
    });
};