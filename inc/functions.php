<?php

// data seeding

define("DATA_BASE", "E:/Local Server/htdocs/PHP CRUD Project/data/database.txt");

function seed() {
    $students = array(
        array(
            'id' => '1',
            'name' => 'Abir Hasan',
            'department' => 'CSE',
            'age' => '25',
            'roll' => '1044'
        ),
        array(
            'id' => '2',
            'name' => 'Kamal Pasha',
            'department' => 'CSE',
            'age' => '35',
            'roll' => '1011'
        ),
        array(
            'id' => '3',
            'name' => 'SK Aminur Rahman',
            'department' => 'CSE',
            'age' => '27',
            'roll' => '1004'
        ),
        array(
            'id' => '4',
            'name' => 'Pranob Mandol',
            'department' => 'CSE',
            'age' => '25',
            'roll' => '1006'
        ),
        array(
            'id' => '5',
            'name' => 'KM Zunaeed',
            'department' => 'CSE',
            'age' => '26',
            'roll' => '1008'
        ),
        array(
            'id' => '6',
            'name' => 'Sobuj Ahmed',
            'department' => 'CSE',
            'age' => '24',
            'roll' => '1014'
        ),
        array(
            'id' => '7',
            'name' => 'Jakir Hossain',
            'department' => 'CSE',
            'age' => '24',
            'roll' => '1076'
        )
        );
        $serializedData = serialize($students);

        file_put_contents(DATA_BASE, $serializedData, LOCK_EX);
}