<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/individual.css">  
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<button class="" onclick="openModal()">Open modal</button>

<div class="m-simple-modal u-d-none" id="modal">
    <div class="m-simple-modal__body m-simple-modal--lg">
        <i class="m-simple-modal__close fas fa-times" onclick="closeModal()"></i>
        MI MODAL
    </div>
</div>

<script>
    function openModal()
    {
        /*const modal = document.getElementById("modal");
        modal.classList.remove("u-d-none");
        modal.classList.add("u-d-flex");*/
        alert('Lorena!');
    }

    function closeModal()
    {
        const modal = document.getElementById("modal");
        modal.classList.remove("u-d-flex");
        modal.classList.add("u-d-none");
    }
</script>
</body>
</html>