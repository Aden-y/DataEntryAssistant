<?php
/***
 * Connects to the movies_db database
 * @return mysqli database connection
 */
function connect(): mysqli
{
    $user = 'root';
    $host = 'localhost';
    $password = '';
    $database = 'counties';
    return $conn = new mysqli($host, $user, $password, $database);
}

function query_all(string $sql) : mixed {
    $con = connect();
    $result = $con->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->free_result();
    $con->close();
    return $data;
}

function update(string $sql) {
    $con = connect();
    $con->query($sql);
    $con->close();
}


function insert_counties() {
    $sql = "truncate table counties;  insert into counties(name) values ";
    $handle = fopen("counties_data.dat", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            $sql.= "('$line'),";
        }
        fclose($handle);
    } else {
        echo "Could not open file";
    }

    $sql = rtrim($sql, ", ");
    update($sql);
}

/**
 * @param int $county_id the county id
 * @param array $sub_counties array of sub-counties
 */
function insert_sub_counties(int $county_id, array $sub_counties) {
    $sql = "insert into constituencies (county_id, name) values ";
    foreach ($sub_counties as $sub_county) {
        $sub_county = trim($sub_county);
        $sql.="($county_id, '$sub_county'),";
    }
    $sql = rtrim($sql, ", ");
    update($sql);
}

function insert_wards(int $sub_county, array $wards_array) {
    $sql = "insert into wards (constituency_id, name) values ";
    foreach ($wards_array as $ward) {
        $ward = trim($ward);
        $sql.="($sub_county, '$ward'),";
    }
    $sql = rtrim($sql, ", ");
    update($sql);
}

function all_counties(): mixed
{
    $sql = 'SELECT * FROM counties';
    return query_all($sql);
}

function all_constituencies() {
    return query_all("select * from constituencies");
}

function get_sub_counties(int $county_id) {
    return query_all("select * from constituencies where county_id = $county_id");
}

function get_wards($sub_county) {
    return query_all("select * from wards where constituency_id = $sub_county");
}
