<?php 

class SubjectRepository {
    public $error;

    function getBySearch($search) {
        $condition = "name LIKE '%$search%'";
        $subjects = $this->fetch($condition);
        return $subjects;
    }

    function getAll() {
        return $this->fetch();
    }

    function fetch($condition = null) {
        global $conn;
        $sql = "SELECT * FROM subject";
        if($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $subjects = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $subject = new Subject($row["id"], $row["name"], $row["number_of_credit"]);
                $subjects[] = $subject;
            }
        }
        return $subjects;
    }

    function save($data) {
        global $conn;
        $name = $data["name"];
        $number_of_credit = $data["number_of_credit"];
        $sql = "INSERT INTO subject (name, number_of_credit)
            VALUE('$name', $number_of_credit)";
        if($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" .$conn->error;
        return false;
    }

    function find($id) {
        $condition = "id = $id";
        $subjects = $this->fetch($condition);
        $subject = current($subjects); //Lấy subject tại vị trí con trỏ
        return $subject;
    }

    function update($subject) {
        global $conn;
        $name = $subject->name;
        $number_of_credit = $subject->number_of_credit;
        $id = $subject->id;
        $sql = "UPDATE subject SET name='$name', number_of_credit=$number_of_credit WHERE id=$id";
        if($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" .$conn->error;
        return false;
    }

    function delete($id) {
        global $conn;
        $sql = "DELETE FROM subject WHERE id=$id";
        if($conn->query($sql)) {
            return true;
        }
        $this->error = "Error: $sql <br>" .$conn->error;
        return false;
    }
}

?>