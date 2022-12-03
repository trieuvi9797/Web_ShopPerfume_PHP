<?php
    include '../lib/database.php';
    include '../helpers/format.php';

?>
<?php
    class product{
        private $db;
        private $fm;
    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($productName){
        $productName = $this->fm->validation($productName);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        if(empty($productName)){
            $alert = "<span class='error'>Sản phẩm không được bỏ trống!</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_product(productName) VALUES('$productName')";
            $result =$this->db->insert($query);
            if($result){
                $alert = "<span class='success'>Thêm Sản phẩm thành công!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm Sản phẩm không thành công!</span>";
                return $alert;
            }
        }
    }
    public function show_product(){
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
        $result =$this->db->select($query);
        return $result;
    }
    public function update_product($productName, $id){
        $productName = $this->fm->validation($productName);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($productName)){
            $alert = "<span class='error'>Sản phẩm không được bỏ trống!</span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_product SET productName = '$productName' WHERE productId = '$id'";
            $result =$this->db->update($query);
            if($result){
                $alert = "<span class='success'>Sửa Sản phẩm thành công!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Sửa Sản phẩm không thành công!</span>";
                return $alert;
            }
        }
    }
    public function del_product($id){
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result =$this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Xóa Sản phẩm thành công!</span>";
            return $alert;
        }else{
            $alert = "<span class='error'>Xóa Sản phẩm không thành công!</span>";
            return $alert;
        }
    }
    public function getproductbyId($id){
        $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>