<?php 
class RegisterController {
    public $redirectTo = "/?c=register";
    function list() {
        $registerRepository = new RegisterRepository();
        $search = "";
        if(!empty($_GET["search"])) {
            $search = $_GET["search"];
            $registers = $registerRepository->getBySearch($search);
        }
        else {
            $registers = $registerRepository->getAll();
        }
        require "view/register/list.php";
    }

    function add() {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->getAll();

        $subjectRepository = new SubjectRepository();
        $subjects = $subjectRepository->getAll();
        require "view/register/add.php";
    }

    function save() {
        $data = $_POST;
        $registerRepository = new RegisterRepository();
        if($registerRepository->save($data)) {
            $_SESSION["success"] = "Đã tạo đăng ký thành công";
        }
        else {
            $_SESSION["error"] = $registerRepository->error;
        }
        header("location:{$this->redirectTo}");
    }

    function edit() {
        $id = $_GET["id"];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        require "view/register/edit.php";
    }

    function update() {
        $id = $_POST["id"];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        $register->score = $_POST["score"];
        if($registerRepository->update($register)) {
            $_SESSION["success"] = "Đã cập nhật đăng ký thành công";
        }
        else {
            $_SESSION["error"] = $registerRepository->error;
        }

        header("location:{$this->redirectTo}");
    }

    function delete() {
        $id = $_GET["id"];
        $registerRepository = new RegisterRepository();
        if($registerRepository->delete($id)) {
            $_SESSION["success"] = "Đã xóa đăng ký thành công";
        }
        else {
            $_SESSION["error"] = $registerRepository->error;
        }
        header("location:{$this->redirectTo}");
    }

}
?>