<?php 
class StudentController {
    function list() {
        $studentRepository = new StudentRepository();
        $search = "";
        if(!empty($_GET["search"])) {
            $search = $_GET["search"];
            $students = $studentRepository->getBySearch($search);
        }
        else {
            $students = $studentRepository->getAll();
        }
        require "view/student/list.php";
    }

    function add() {
        require "view/student/add.php";
    }

    function save() {
        $data = $_POST;
        $studentRepository = new StudentRepository();
        if($studentRepository->save($data)) {
            $_SESSION["success"] = "Đã tạo sinh viên thành công";
        }
        else {
            $_SESSION["error"] = $studentRepository->error;
        }
        header("location:/");
    }

    function edit() {
        $id = $_GET["id"];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);
        require "view/student/edit.php";
    }

    function update() {
        $id = $_POST["id"];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);
        $student->name = $_POST["name"];
        $student->birthday = $_POST["birthday"];
        $student->gender = $_POST["gender"];
        if($studentRepository->update($student)) {
            $_SESSION["success"] = "Đã cập nhật môn học thành công";
        }
        else {
            $_SESSION["error"] = $studentRepository->error;
        }

        header("location:/");
    }

    function delete() {
        $id = $_GET["id"];
        $studentRepository = new StudentRepository();
        if($studentRepository->delete($id)) {
            $_SESSION["success"] = "Đã xóa sinh viên thành công";
        }
        else {
            $_SESSION["error"] = $studentRepository->error;
        }
        header("location:/");
    }

}
?>