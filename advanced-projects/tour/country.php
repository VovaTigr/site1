<?php
    require "database.php";

    $country = $_GET["country"] ?? "";
    $stars = $_GET["stars"] ?? "";
    $price = intval($_GET["price"] ?? 0);

    $found_tour = null;

    if (isset($tours) && is_array($tours)) {
        foreach ($tours as $tour) {
            if ($tour['country'] === $country && $tour['stars'] == $stars && $tour['price'] <= $price) {
                $found_tour = $tour;
                break;
            }
        }
    }

    if (!$found_tour) {
        header('Location: resort-not-found.php');
        exit;
    }

    $pageTitle = htmlspecialchars($found_tour['name']) . " - Resort";
    include 'header.php';

    $gallery = [
        "https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80",
        "https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80",
        "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80"
    ];
?>

<style>
    .content-container { max-width: 900px; margin: 40px auto; padding: 0 20px; flex: 1; width: 100%; }
    .resort-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
    .resort-header { padding: 25px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; }
    .resort-title h1 { font-size: 1.8rem; color: #1e293b; }
    .resort-title .location { color: #64748b; font-size: 0.95rem; }
    .price-tag { background: #10b981; color: white; padding: 10px 20px; border-radius: 12px; text-align: right; }
    .price-tag .amount { font-size: 1.5rem; font-weight: 700; display: block; line-height: 1; }
    .price-tag .label { font-size: 0.75rem; text-transform: uppercase; opacity: 0.9; }
    
    .slideshow-container { position: relative; max-width: 100%; height: 400px; overflow: hidden; background-color: #111; }
    .slide { display: none; height: 100%; width: 100%; }
    .slide img { width: 100%; height: 100%; object-fit: cover; }
    .prev, .next {
        cursor: pointer; position: absolute; top: 50%; transform: translateY(-50%);
        padding: 14px 18px; color: white; font-weight: bold; font-size: 18px;
        background-color: rgba(0,0,0,0.5); border-radius: 50%; user-select: none; margin: 0 15px;
    }
    .next { right: 0; }
    .prev:hover, .next:hover { background-color: rgba(0,0,0,0.8); }

    .resort-body { padding: 30px; }
    .stars-rating { color: #f59e0b; font-size: 1.2rem; margin-bottom: 15px; }
    .description { color: #475569; line-height: 1.7; font-size: 1rem; }
</style>

<div class="content-container">
    <div class="resort-card">
        <div class="resort-header">
            <div class="resort-title">
                <h1><?php echo htmlspecialchars($found_tour['name']); ?></h1>
                <span class="location">📍 Destination: <?php echo htmlspecialchars($found_tour['country']); ?></span>
            </div>
            <div class="price-tag">
                <span class="amount">$<?php echo htmlspecialchars($found_tour['price']); ?></span>
                <span class="label">Total Price</span>
            </div>
        </div>

        <div class="slideshow-container">
            <?php foreach ($gallery as $index => $imgUrl): ?>
                <div class="slide">
                    <img src="<?php echo $imgUrl; ?>" alt="Resort photo <?php echo $index + 1; ?>">
                </div>
            <?php endforeach; ?>
            <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
            <a class="next" onclick="moveSlide(1)">&#10095;</a>
        </div>

        <div class="resort-body">
            <div class="stars-rating">
                Rating: <?php echo str_repeat('⭐', intval($found_tour['stars'])); ?>
            </div>
            <p class="description">
                We decided that the perfect choice for you would be <strong><?php echo htmlspecialchars($found_tour['name']); ?></strong>!
            </p>
        </div>
    </div>
</div>

<script>
    let slideIndex = 0;
    const slides = document.getElementsByClassName("slide");

    function showSlide(n) {
        if (n >= slides.length) { slideIndex = 0; }
        if (n < 0) { slideIndex = slides.length - 1; }
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex].style.display = "block";
    }

    function moveSlide(n) { showSlide(slideIndex += n); }
    showSlide(slideIndex);
</script>

<?php include 'footer.php'; ?>