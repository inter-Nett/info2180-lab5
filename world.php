<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;port=8889;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($lookup === 'cities') {
    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");
} else {
    $stmt = $conn->prepare("
        SELECT * FROM countries
        WHERE name LIKE :country
    ");
}

$stmt->execute(['country' => "%$country%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <thead>
        <tr>
            <?php if ($lookup === 'cities'): ?>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            <?php else: ?>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <?php if ($lookup === 'cities'): ?>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['district'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars((string) $row['population']) ?></td>
                <?php else: ?>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['continent']) ?></td>
                    <td><?= htmlspecialchars((string) ($row['independence_year'] ?? 'N/A')) ?></td>
                    <td><?= htmlspecialchars($row['head_of_state'] ?? 'N/A') ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
