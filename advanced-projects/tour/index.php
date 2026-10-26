<?php
    $pageTitle = "Tour Finder | Book Your Vacation";
    $message = "Find your dream vacation with us";
    $redirect = "country.php";

    if (isset($_POST['formSubmit'])) {
        if (empty($_POST['country']) || empty($_POST['stars']) || !isset($_POST['price'])) {
            $message = "Please, fill all fields in the form";
        } else {
            $country = $_POST['country'];
            $stars = $_POST['stars'];
            $price = intval($_POST['price']);
            
            // Округляем цену до сотен вниз (например, 350 -> 300)
            if ($price % 100 != 0) {
                $price = $price - ($price % 100);
            }

            // Перенаправление на страницу результатов
            header("Location: $redirect?country=" . urlencode($country) . "&stars=" . urlencode($stars) . "&price=" . urlencode($price));
            exit;
        }
    }

    include 'header.php';
?>

<style>
    .search-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 500px;
        padding: 35px;
    }
    .search-card h2 {
        font-size: 1.2rem;
        color: #0072ff;
        margin-bottom: 20px;
        text-align: center;
    }
    .form-group { margin-bottom: 22px; }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
        color: #444;
    }
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-family: inherit;
        font-size: 1rem;
    }
    .range-wrap { display: flex; align-items: center; gap: 15px; }
    .range-wrap input[type="range"] { flex: 1; accent-color: #0072ff; cursor: pointer; }
    .price-badge {
        background: #e6f2ff;
        color: #0072ff;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.95rem;
    }
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #0072ff, #00c6ff);
        color: white;
        border: none;
        padding: 14px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .btn-submit:hover { transform: translateY(-2px); }
</style>

<div class="main-container">
    <div class="search-card">
        <h2><?php echo htmlspecialchars($message); ?></h2>
        
        <!-- Явно указываем метод POST и отправку на текущий файл -->
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="country">Destination Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="France">France</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Japan">Japan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stars">Hotel Rating (Stars)</label>
                <select name="stars" id="stars" class="form-control" required>
                    <option value="3">3 Stars ⭐⭐⭐</option>
                    <option value="4">4 Stars ⭐⭐⭐⭐</option>
                    <option value="5">5 Stars ⭐⭐⭐⭐⭐</option>
                </select>
            </div>

            <div class="form-group">
                <label for="customRange">Max Price Budget ($)</label>
                <div class="range-wrap">
                    <input type="range" name="price" id="customRange" min="100" max="1000" step="100" value="300">
                    <span class="price-badge">$<span id="rangeValue">300</span></span>
                </div>
            </div>

            <button type="submit" name="formSubmit" class="btn-submit">Search Tours</button>
        </form>
    </div>
</div>

<script>
    const rangeInput = document.getElementById('customRange');
    const rangeValue = document.getElementById('rangeValue');

    rangeInput.addEventListener('input', function() {
        rangeValue.textContent = rangeInput.value;
    });
</script>

<?php include 'footer.php'; ?>