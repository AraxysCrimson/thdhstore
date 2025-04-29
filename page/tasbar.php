<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Banner Carousel</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .banner__carousel {
      position: relative;
      width: 100%;
      max-width: 1600px;
      height: 600px;
      margin: 40px auto;
      overflow: hidden;
      border-radius: 16px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      background-color: #e4f1e7;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .banner__carousel img.banner {
      max-height: 92%;
      max-width: 92%;
      object-fit: contain;
      opacity: 0;
      transition: opacity 1s ease-in-out;
      position: absolute;
    }

    .banner__carousel img.banner.active {
      opacity: 1;
      z-index: 1;
    }

    .banner__controls {
      position: absolute;
      bottom: 25px;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      z-index: 2;
    }

    .banner__dot {
      width: 14px;
      height: 14px;
      background-color: rgba(0, 0, 0, 0.3);
      border-radius: 50%;
      margin: 0 6px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .banner__dot.active {
      background-color: rgba(0, 0, 0, 0.7);
    }

    .banner__nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 50px;
      height: 50px;
      background-color: rgba(255, 255, 255, 0.7);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 2;
      font-size: 24px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .banner__nav:hover {
      background-color: rgba(255, 255, 255, 0.9);
    }

    .banner__nav--prev {
      left: 25px;
    }

    .banner__nav--next {
      right: 25px;
    }

    @media (max-width: 1200px) {
      .banner__carousel {
        height: 500px;
        max-width: 1200px;
      }
    }

    @media (max-width: 768px) {
      .banner__carousel {
        height: 400px;
      }
      
      .banner__nav {
        width: 40px;
        height: 40px;
        font-size: 20px;
      }
    }

    @media (max-width: 480px) {
      .banner__carousel {
        height: 300px;
        border-radius: 12px;
      }
      
      .banner__nav {
        width: 36px;
        height: 36px;
        font-size: 18px;
      }
      
      .banner__dot {
        width: 10px;
        height: 10px;
        margin: 0 4px;
      }
    }
  </style>
</head>
<body>

  <div class="banner__carousel">
    <img class="banner active" src="video/Banner Ra Mắt Sản Phẩm Mới(1920x600px).png" alt="Banner 1">
    <img class="banner" src="video/Banner Giảm Giá Đặc Biệt(1080x1080px).png" alt="Banner 2">
    <img class="banner" src="video/Banner(1920x1080px).png" alt="Banner 3">
    <img class="banner" src="video/Banner(1080x1080px).png" alt="Banner 4">
    <img class="banner" src="video/Banner Flash Sale(1200x628px).png" alt="Banner 5">
    
    <div class="banner__nav banner__nav--prev">&lt;</div>
    <div class="banner__nav banner__nav--next">&gt;</div>
    
    <div class="banner__controls"></div>
  </div>

  <script>
    // Biến cơ bản
    let currentBanner = 0;
    const banners = document.querySelectorAll('.banner__carousel .banner');
    const totalBanners = banners.length;
    const controlsContainer = document.querySelector('.banner__controls');
    const prevButton = document.querySelector('.banner__nav--prev');
    const nextButton = document.querySelector('.banner__nav--next');
    
    // Tạo các nút điều khiển chấm
    for (let i = 0; i < totalBanners; i++) {
      const dot = document.createElement('div');
      dot.classList.add('banner__dot');
      if (i === 0) dot.classList.add('active');
      
      dot.addEventListener('click', function() {
        clearInterval(autoSlide);
        currentBanner = i;
        updateBanner();
        autoSlide = setInterval(nextSlide, 5000);
      });
      
      controlsContainer.appendChild(dot);
    }
    
    const dots = document.querySelectorAll('.banner__dot');
    
    // Cập nhật hiển thị banner
    function updateBanner() {
      banners.forEach((banner, i) => {
        banner.classList.remove('active');
        dots[i].classList.remove('active');
      });
      
      banners[currentBanner].classList.add('active');
      dots[currentBanner].classList.add('active');
    }
    
    // Chuyển đến banner tiếp theo
    function nextSlide() {
      currentBanner = (currentBanner + 1) % totalBanners;
      updateBanner();
    }
    
    // Chuyển đến banner trước đó
    function prevSlide() {
      currentBanner = (currentBanner - 1 + totalBanners) % totalBanners;
      updateBanner();
    }
    
    // Thêm sự kiện cho nút điều hướng
    prevButton.addEventListener('click', function() {
      clearInterval(autoSlide);
      prevSlide();
      autoSlide = setInterval(nextSlide, 5000);
    });
    
    nextButton.addEventListener('click', function() {
      clearInterval(autoSlide);
      nextSlide();
      autoSlide = setInterval(nextSlide, 5000);
    });
    
    // Bắt đầu tự động chuyển đổi
    let autoSlide = setInterval(nextSlide, 5000);
  </script>

</body>
</html>
