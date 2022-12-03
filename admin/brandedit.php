<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classses/brand.php'; ?>
<?php
    if(!isset($_GET['brandId']) || $_GET['brandId'] == NULL){
        echo "<script>window.location = 'brandlist.php'</script>";
    }else{
        $id = $_GET['brandId'];
    }

    $brand = new brand();
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$brandName = $_POST["brandName"];   
        $updateBrand = $brand->update_brand($brandName, $id);
	}
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Sửa danh mục</h2>
            <div class="block copyblock"> 
            <?php
                if(isset($updateBrand)){
                    echo $updateBrand;
            }
            ?>
            <?php 
                $get_brande_name = $brand->getbrandbyId($id);
                if($get_brande_name){
                    while($result = $get_brande_name->fetch_assoc()){
            ?>
                <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" placeholder="Nhập tên thương hiệu..." class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Sửa" />
                        </td>
                    </tr>
                </table>
                </form>
                <?php }} ?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>