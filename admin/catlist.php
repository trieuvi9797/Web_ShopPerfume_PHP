<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classses/category.php';?>
<?php 
	$cat = new category();
	if(isset($_GET['delcat'])){
		$id = $_GET['delcat'];
		$delCat = $cat->del_category($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">      
				<?php
					if(isset($delcat)){
						echo $delcat;
					}  
				?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên danh mục</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $show_cate = $cat->show_category();
							if($show_cate){
								$i=0;
								while($result = $show_cate->fetch_assoc()){
									$i++;
									?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="catedit.php?catId=<?php echo $result['catId'] ?>">Edit</a> || <a onclick="return confirm('Bạn có chắc muốn xóa không!')" href="?delcat=<?php echo $result['catId'] ?>">Delete</a></td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

