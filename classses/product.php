<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php';

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
    public function insert_product($data, $files){
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['catId']);
        $productDescription = mysqli_real_escape_string($this->db->link, $data['productDescription']);
        $productAmount = mysqli_real_escape_string($this->db->link, $data['productAmount']);
        $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);

        //ktra va lay hinh anh vao folder upload
        $permited = array('jpg', 'png','jpeg','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['temp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName == "" || $category == "" || $productDescription == "" || $productAmount == "" || $productPrice == "" || $file_name == ""){
            $alert = "<span class='error'>không được bỏ trống!</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, productDescription, productAmount, productPrice, productImage) VALUES('$productName', '$category', '$productDescription', '$productAmount', '$productPrice', '$uploaded_image')";
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
    // public function show_product(){
    //     $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
    //     $result =$this->db->select($query);
    //     return $result;
    // }
    // public function update_product($productName, $id){
    //     $productName = $this->fm->validation($productName);
    //     $productName = mysqli_real_escape_string($this->db->link, $productName);
    //     $id = mysqli_real_escape_string($this->db->link, $id);
    //     if(empty($productName)){
    //         $alert = "<span class='error'>Sản phẩm không được bỏ trống!</span>";
    //         return $alert;
    //     }else{
    //         $query = "UPDATE tbl_product SET productName = '$productName' WHERE productId = '$id'";
    //         $result =$this->db->update($query);
    //         if($result){
    //             $alert = "<span class='success'>Sửa Sản phẩm thành công!</span>";
    //             return $alert;
    //         }else{
    //             $alert = "<span class='error'>Sửa Sản phẩm không thành công!</span>";
    //             return $alert;
    //         }
    //     }
    // }
    // public function del_product($id){
    //     $query = "DELETE FROM tbl_product WHERE productId = '$id'";
    //     $result =$this->db->delete($query);
    //     if($result){
    //         $alert = "<span class='success'>Xóa Sản phẩm thành công!</span>";
    //         return $alert;
    //     }else{
    //         $alert = "<span class='error'>Xóa Sản phẩm không thành công!</span>";
    //         return $alert;
    //     }
    // }
    // public function getproductbyId($id){
    //     $query = "SELECT * FROM tbl_product WHERE productId='$id'";
    //     $result = $this->db->select($query);
    //     return $result;
    // }
}
?>