<?php
include 'includes/data/data.php';

$service = $_GET['service'] ?? '';
$vote = $_GET['vote'] ?? '';

$voteNumber = intval($vote);

$new_hotels = [];


if (!empty($service) && !empty($voteNumber)){
    foreach ($hotels as $hotel){
        if($hotel['parking'] === true && $service === 'parking' && $voteNumber === $hotel['vote']){
            array_push($new_hotels, $hotel);
        }
    }
} elseif (!empty($service)) {
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] === true && $service === 'parking') {
            array_push($new_hotels, $hotel);
        } 
    }
} elseif (!empty($voteNumber)) {
    foreach ($hotels as $hotel){
        if ($voteNumber === $hotel['vote']){
            array_push($new_hotels, $hotel);
        }
    }
} else {
    $new_hotels = $hotels;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <header>
        <form class="row g-3 container mt-5">
            <div class="col-md-4">
                <select id="service" class="form-select" name="service">
                    <option value="">Choose...</option>
                    <option <?php if ($service === 'parking') : ?> selected <?php endif ?> value="parking">Parcheggio</option>
                    <option <?php if ($service === 'breakfast') : ?> selected <?php endif ?> value="breakfast">Colazione</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="vote">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cerca</button>
            </div>
        </form>
    </header>
    <div class="container">

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Distance to center</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($new_hotels as $hotel) : ?>
                    <tr>
                        <td><?= $hotel['name'] ?></td>
                        <td><?= $hotel['description'] ?></td>
                        <td>
                            <?php if ($hotel['parking'] === true) : ?>
                                <i class="fa-solid fa-circle-check text-success"></i>
                            <?php else : ?>
                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                            <?php endif ?>
                        </td>
                        <td><?= $hotel['vote'] ?></td>
                        <td><?= $hotel['distance_to_center'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>