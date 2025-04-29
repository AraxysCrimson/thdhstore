<?php
// Kết nối database và lấy danh mục
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>
<div class="menu-wrapper">
    <!-- Logo -->
    <div class="logo-area">
        <a href="index.php">
            <img src="photo/THDH - STORE1.png" alt="THDH STORE" class="logo-img">
        </a>
    </div>

    <!-- Thanh tìm kiếm -->
    <div class="search-area">
        <form action="indexs.php?quanly=timkiem" method="POST" class="search-form">
            <input type="text" name="tukhoa" placeholder="Tìm kiếm..." class="search-input">
            <button name="timkiem" type="submit" class="search-btn">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</div>

<!-- Menu chính -->
<div class="main-menu">
    <ul>
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="indexs.php?quanly=danhmucsp&id=1">Mới</a></li>
        <li><a href="indexs.php?quanly=ao">Áo</a></li>
        <li><a href="indexs.php?quanly=quan">Quần</a></li>
        <li><a href="indexs.php?quanly=phukien">Phụ Kiện</a></li>
    </ul>
</div>

<!-- Giỏ hàng lớn bên trái -->
<div class="cart-section">
    <a href="./chitiet.php?quanly=giohang" class="cart-link" title="Giỏ hàng">
        <i class="fas fa-cart-plus"></i>
        <?php
        if (isset($_SESSION['dangky']) && isset($_SESSION['cart'])) {
            $soluongsanpham = 0;
            foreach ($_SESSION['cart'] as $cart_item) {
                $soluongsanpham += $cart_item['soluong'];
            }
            echo '<span class="cart-badge">' . $soluongsanpham . '</span>';
        } else {
            echo '<span class="cart-badge">0</span>';
        }
        ?>
    </a>
</div>

<!-- Chatbase script (bubble mặc định màu đen sẽ hiển thị) -->
<script>
(function(){
    if(!window.chatbase || window.chatbase("getState")!=="initialized"){
        window.chatbase=(...arguments)=>{
            if(!window.chatbase.q){ window.chatbase.q=[] }
            window.chatbase.q.push(arguments)
        };
        window.chatbase=new Proxy(window.chatbase,{
            get(target,prop){
                if(prop==="q"){ return target.q }
                return (...args)=>target(prop,...args)
            }
        });
    }
    const onLoad=function(){
        const script=document.createElement("script");
        script.src="https://www.chatbase.co/embed.min.js";
        script.id="VNQl833GD1QlDmJPrvGoa";
        script.setAttribute("data-chatbubble", "true"); // bật lại icon đen mặc định
        document.body.appendChild(script);
    };
    if(document.readyState==="complete"){ onLoad() }
    else{ window.addEventListener("load", onLoad) }
})();
</script>

<!-- Style -->
<style>
/* Tổng thể vùng trên cùng */
.menu-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #e0eee0;
    padding: 15px 5%;
    flex-wrap: wrap;
}
.logo-img {
    width: 160px;
    height: auto;
    display: block;
}
.search-area {
    flex-grow: 1;
    text-align: center;
}
.search-form {
    display: flex;
    justify-content: center;
}
.search-input {
    width: 60%;
    height: 48px;
    font-size: 18px;
    padding: 10px;
    border: 2px solid #ff7f00;
    border-radius: 6px 0 0 6px;
    outline: none;
}
.search-btn {
    width: 54px;
    height: 48px;
    background-color: #ee7c1a;
    color: white;
    border: none;
    border-radius: 0 6px 6px 0;
    font-size: 20px;
    cursor: pointer;
}
.main-menu {
    background-color: #e0eee0;
    text-align: center;
    padding: 12px 0;
}
.main-menu ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 35px;
    margin: 0;
    padding: 0;
    flex-wrap: wrap;
}
.main-menu li a {
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    color: #007bff;
    transition: 0.3s;
}
.main-menu li a:hover {
    color: #ee7c1a;
}

/* Giỏ hàng lớn bên trái */
.cart-section {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 999;
}
.cart-link {
    position: relative;
    color: #ff3c00;
    font-size: 50px;
    transition: 0.3s;
}
.cart-link:hover {
    color: #ff7f00;
    transform: scale(1.05);
}
.cart-badge {
    position: absolute;
    top: -10px;
    right: -15px;
    background: red;
    color: white;
    font-size: 17px;
    padding: 5px 8px;
    border-radius: 50%;
    font-weight: bold;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
}

/* Bubble Chat giống giỏ hàng */
#custom-chat-bubble {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 30px;
    z-index: 999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    cursor: pointer;
}
#custom-chat-bubble:hover {
    background-color: #0056b3;
}

/* Thu nhỏ khung iframe chatbase */
.chatbase__container iframe {
    max-width: 350px !important;
    max-height: 500px !important;
}
</style>
