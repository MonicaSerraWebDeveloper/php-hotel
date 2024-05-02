<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- /Bootstrap  -->

    <title>Php Hotel</title>
</head>
<body>
    <div class="container-xl py-4">
        <form method="GET" class="col">
            <div class="row align-items-start">
                <div class="col">
                    <select class="form-select" name="isParking" id="isParking">
                        <?php 
                        
                        $selectedOptionTrue = isset($_GET['isParking']) && $_GET['isParking'] === 'true' ? 'selected' : '';
                            var_dump ($selectedOption);

                        $selectedOptionFalse = isset($_GET['isParking']) && $_GET['isParking'] === 'false' ? 'selected' : '';   
                        ?>

                        <option value="">-Vuoi il parcheggio-</option>
                        <option <?php echo $selectedOptionTrue ?>  value="true">Parcheggio</option>
                        <option <?php echo $selectedOptionFalse ?>   value="false">No parcheggio</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" name="vote" id="vote">
                        <option value="">-Voto Hotel-</option>
                       
                        <?php for($i = 0; $i <= 5; $i++): ?>
                        <option value="<?php echo $i ?>"<?php echo (isset($_GET['vote']) && $_GET['vote'] === strval($i)) ? 'selected' : ''; ?> ><?php echo $i ?></option>
                        <!-- <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option> -->
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtra</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Parcheggio</th>
                <th scope="col">Voto</th>
                <th scope="col">Distanza dal centro</th>
                </tr>
            </thead>
            <?php 
                foreach ($hotels as $keys => $hotelKey) {

                    $shouldDisplay = true;

                    if (isset($_GET['isParking']) && $_GET['isParking'] !== '') {
                        if ($_GET['isParking'] === 'true' && $hotelKey['parking'] !== true) {
                            $shouldDisplay = false;
                        } elseif ($_GET['isParking'] === 'false' && $hotelKey['parking'] !== false) {
                            $shouldDisplay = false;
                        }
                    }
                    if (isset($_GET['vote']) && $_GET['vote'] !== '') {
                        if (intval($_GET['vote']) !== $hotelKey['vote']) {
                            $shouldDisplay = false;
                        }
                    }
                    if ($shouldDisplay) { 
                    ?> 
                    
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $keys ?></th>
                                <td><?php echo $hotelKey['name'] ?></td>
                                <td><?php echo $hotelKey['description'] ?></td>
                                <td><?php echo $hotelKey['parking'] ? 'Sì' : 'No' ?></td>
                                <td><?php echo $hotelKey['vote'] ?></td>
                                <td><?php echo $hotelKey['distance_to_center'] ?></td>
                            </tr>
                        </tbody> 
                      
                <?php  }
                
                }
            ?> 
        </table>
    </div>
</body>
</html>