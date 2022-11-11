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

// display information

function info() {
    $serializedData = file_get_contents(DATA_BASE);
    $students = unserialize($serializedData);
    ?>
    <table>
        <thead>
            <tr class="table-header">
                <th><strong>Name</strong></th>
                <th><strong>Department</strong></th>
                <th><strong>Age</strong></th>
                <th><strong>Roll</strong></th>
                <th><strong>Action</strong></th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach($students as $student) {
        ?>
            <tr class="table-body">
                <td><?php printf("%s", $student['name']) ?></td>
                <td><?php printf("%s", $student['department']) ?></td>
                <td><?php printf("%s", $student['age']) ?></td>
                <td><?php printf("%s", $student['roll']) ?></td>
                <td width='250px'><?php printf("<a class='button yellowbtn' href='./?task=edit&id=%s'>Edit</a> || <a class='button delete' href='./?task=delete&id=%s'>Delete</a>", $student['id'], $student['id']) ?></td>
            </tr>
    <?php 
    }
    ?>
    </tbody>
    </table>
    <?php
}

// add student 

function addStudent($name, $department, $age, $roll) {
    $serializedData = file_get_contents(DATA_BASE);
    $students = unserialize($serializedData);
    $found = false;
    foreach($students as $student) {
        if($student['roll'] == $roll) {
            $found = true;
            break;
        }
    }
    if(!$found) {
        $student = array(
            'id' => newId($students),
            'name' => $name,
            'department' => $department,
            'age' => $age,
            'roll' => $roll
        );
        array_push($students, $student);
        $serializedData = serialize($students);
        file_put_contents(DATA_BASE, $serializedData, LOCK_EX);
        return true;
    }return false;
    
}

// creating id

function newId($students){
    $maxId = max(array_column($students, 'id'));
    return $maxId + 1;
}

// get student

function getStudent($id) {
    $serializedData = file_get_contents(DATA_BASE);
    $students = unserialize($serializedData);
    foreach($students as $student) {
        if($student['id'] == $id) {
            return $student;
        }
    }
}

// update student

function updateStudent($id, $name, $department, $age, $roll) {
    $serializedData = file_get_contents(DATA_BASE);
    $students = unserialize($serializedData);
    $found = false;

    foreach($students as $student) {
        if($student['roll'] == $roll && $student['id'] != $id){
            $found = true;
            break;
        }
    }
    if(!$found) {
        $students[$id-1]['name'] = $name;
        $students[$id-1]['department'] = $department;
        $students[$id-1]['age'] = $age;
        $students[$id-1]['roll'] = $roll;

        $serializedData = serialize($students);
        file_put_contents(DATA_BASE, $serializedData, LOCK_EX);
        return true;
    } return false;
}