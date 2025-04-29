<?php
$sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc ='$_GET[iddanhmuc]' LIMIT 1";
$query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);
$row = mysqli_fetch_array($query_sua_danhmucsp);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-edit"></i> Sửa Danh Mục</h2>
    
    <form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc']; ?>">
        <div class="form-group">
            <label for="id_danhmuc"><strong>ID Danh mục:</strong></label>
            <input type="text" class="form-control" id="id_danhmuc" value="<?php echo $row['id_danhmuc']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="tendanhmuc"><strong>Tên Danh Mục:</strong></label>
            <input type="text" class="form-control" id="tendanhmuc" name="tendanhmuc" required 
                   value="<?php echo htmlspecialchars($row['tendanhmuc']); ?>">
        </div>
        <div class="form-group">
            <label for="thutu"><strong>Thứ tự:</strong></label>
            <input type="number" class="form-control" id="thutu" name="thutu" required 
                   value="<?php echo $row['thutu']; ?>">
        </div>
        <button type="submit" name="suadanhmuc" class="btn btn-success">
            <i class="fas fa-save"></i> Lưu thay đổi
        </button>
    </form>
</div>
